<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ArticleCompleted;
use Validator;
use App\Category;
use App\Event;
use App\EventResponse;
use App\Purpose;
use App\Product;
use App\University;
use App\EventCofig;
use App\Survey;
use App\BlockedDate;
use App\EventType;
use Illuminate\Support\Facades\View;
use PDF;
use Excel;
use Indonesia;
use DB;
use Mail;

class EventController extends Controller
{
    protected $page_title = 'Manage Events';

    public function __construct()
    {
        View::share('title', $this->page_title);
    }

    public function index()
    {
        $university = University::orderBy('name')->get();
        $events = $this->getReport();

        return view('admin.event.index', compact('events', 'university'));
    }

    public function show($id)
    {
        //$no_ref     = $this->generateReferenceNumber($id);
        $event      = Event::find($id);
        $hasSurvey  = true;
        $survey     = Survey::where('id', $event->survey_id)->first();

        if (!$survey) {
            $hasSurvey = false;
        } else {
            $refUrl = route('survey.show', $survey->id).'?no_ref='.$id;
            $survey = Survey::where('id', $event->survey_id)->with('questions')->first();
        }

        $purpose_id = [];

        foreach ($event->purpose as $key => $value) {
            $purpose_id[] = $value->id;
        }

        $product_id = [];

        foreach ($event->product as $key => $value) {
            $product_id[] = $value->id;
        }

        $purposes = Purpose::whereIn('id', $purpose_id)->get();
        $product = Product::whereIn('id', $product_id)->get();

        return view('admin.event.show', compact('event', 'purposes', 'product', 'hasSurvey', 'refUrl', 'no_ref'));
    }

    public function approve($id)
    {
        DB::beginTransaction();

        try {
            $survey = Survey::published()->first();
            
            if ($survey) {
                $data['survey_id']=$survey->id;
            }

            $data['approval']='approved';
            $data['is_read']=false;
            $event = Event::find($id)->update($data);
            DB::commit();
            flash('Event has been approved', 'success');
        } catch (Exception $e) {
            DB::rollback();
            flash('Event has not approved', 'failed');
        }

        return redirect(route('admin.event.index', compact('kode')));
    }

    public function unapprove($id)
    {
        $event = Event::find($id);
        $event->update(['approval'  => 0,'is_read'=>false]);
        flash('Event has been unapproved', 'success');

        return redirect(route('admin.event.index'));
    }

    public function create()
    {
        $category = new Category();
        $title = "Category Create";

        return view('admin.category.create', compact('title', 'category'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        Category::create([
            'name' => $input['name'],
            'description' => $input['description']
        ]);

        flash('Category successfully created', 'success');

        return redirect(route('admin.category.index'));
    }

    public function eventresponse(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'response_type' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $survey = Survey::published()->first();
        $survey_id = null;

        if ($survey) {
            $survey_id = $survey->id;
        }

        $event = Event::find($id);
        $event->approval = $input['response_type'];
        $event->survey_id = $survey_id;
        $event->is_read = false;

        // check if reference_number is in input array
        if (array_key_exists('reference_number', $input)) {
            $event->reference_number = $input['reference_number'];
        }

        if ($event->save() ) {
            $input['event_id'] = $event->id;
            $input['admin_id'] = Auth::guard('admin')->user()->id;

            EventResponse::create($input);

            if ($input['response_type'] == 'approved') {
                $email = $request->except('_token', 'message');
                $email['content'] = $request->message;
                $email['email'] = $event->email;
                $sendMail=$this->sendEmail($email);
            }
        }

        flash('Event response successfully sent', 'success');

        return redirect(route('admin.event.show', [$event->id]));
    }

    public function exportExcel()
    {
        Excel::create('Events Report', function ($excel) {
            $events = $this->Excel();
            $excel->sheet('New sheet', function ($sheet) use ($events) {
                $sheet->loadView('admin.event.export.excel', compact('events'));
            });
        })->export('xlsx');
    }

    private function Excel(){

        $input = \Input::all();
        $eventtab = DB::table('events')
                    ->join('event_products', 'events.id', '=', 'event_products.event_id')
                    ->join('event_purposes', 'events.id', '=', 'event_purposes.event_id')
                    ->join('product_translations', 'event_products.product_id', '=', 'product_translations.product_id')
                    ->join('purpose_translations', 'event_purposes.purpose_id', '=', 'purpose_translations.purpose_id')
                    ->select('events.*', 'name_product', 'name_purpose', 'language_product', 'language_purpose')
                    ->where('language_product', 'en');
                    
        $orderBy = 'events.id';

        return $eventtab->groupby($orderBy)->get();
    }
    public function exportPdf()
    {
        $events = $this->getReport();
        $pdf = PDF::loadView('admin.event.export.pdf', compact('events'));
        return $pdf->download();
    }

    private function getReport()
    {
        $request = \Input::all();

        $report = DB::table('events');

        $orderBy = 'created_at';

     
        if (count($request) >= 1) {

            foreach ($request as $key => $value) {

                if (!empty($value)) {
                    if ($key == 'periode') {
                        $periode = explode(' - ', $value);

                        if (count($periode) == 2) {
                            $report->whereBetween('created_at', [$periode[0], $periode[1]]);
                        }

                    } elseif ($key == 'date') {
                        $orderBy = 'start_date';
                        $date = explode(' - ', $value);

                        if (count($date) == 2) {
                            $report->whereBetween('start_date', [$date[0], $date[1]]);
                        }
                    } else {
                        $report->where($key, '=', $value);
                    }
                }
            }
        }

        return $report->orderBy($orderBy, 'DESC')->get();
    }

    public function destroy($id)
    {
        $event = Event::find($id);

        if ($event) {
            $event->delete();
            flash('Event successfully deleted', 'success');
        } else {
            flash('Event unsuccessfully deleted', 'error');
        }
        return redirect(route('admin.event.index'));
    }

    public function createEvent()
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        $startDate = "'".date('Y-m-d')."'";
        $endDate = "'".date('Y-m-d')."'";
        $purposes = Purpose::all();
        $products = Product::all();
        $types = EventType::all();
        $university = University::orderBy('name')->get();

        //event approved
        $eventapproved = Event::where('approval','approved')->get();
        $eventapproveds = [];

        foreach ($eventapproved as $key => $value) {
            $eventapproveds[] = "'".date("Y-m-d", strtotime("$value->start_date"))."'";
        }

        $eventapproved = implode(",", $eventapproveds);
        $disableddate =  BlockedDate::pluck('date')->toArray(); //date disabled
        $disableddates = [];

        foreach ($disableddate as &$datedisabled) {
            $disableddates[] = "'".$datedisabled."'";
        }

        $disableddate = count($disableddate) > 0 ? implode(",", $disableddates) : null;
        $minDate = '1';
        $limit = EventCofig::orderBy('created_at', 'desc')->first();

        if ($limit) {
            $minDate = $limit->minimumdate;
        }

        return view('admin.event.create_event', compact('startDate', 'endDate', 'purposes', 'products', 'language', 'disableddate', 'eventapproved', 'university', 'types'));
    }

    public function storeEvent(Request $request)
    {
        $input = $request->all();
        $messages = ['time.after' => 'The event should start two days after today'];
        $Validator = Validator::make($input, [
            'username' => 'required|max:255',
            'contact' => 'required|max:15',
            'email' => 'required|max:255',
            'university' => 'required',
            'faculty' => 'required|max:255',
            'title' => 'required|max:255',
            'credits' => 'required|max:255',
            'location' => 'required|max:255',
            'description' => 'required|max:255',
            'time' => 'required|date|date_format:Y-m-d|after:'.date('Y-m-d', strtotime("+1 days")),
            'attachment' => 'max:2048',
            'pakta' => 'max:2048',
        ], $messages);

        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }

        $event = Event::create([
            'user_id' => Auth::user()->id,
            'username' => $input['username'],
            'contact' => $input['contact'],
            'email' => $input['email'],
            'universities' => $input['universities'],
            'faculty' => $input['faculty'],
            'title' => $input['title'],
            'credits' => $input['credits'],
            'location' => $input['location'],
            'description' => $input['description'],
            //'start_date' => $input['time'],
            //'end_date' => $input['time'],
            'attachment' => $input['attachment'],
            'pakta' => $input['pakta'],
            'approval' => 'pending',
        ]);

        if ($request->purpose) {
            foreach ($request->purpose as $purpose_id => $value) {
                $event->purpose()->attach($value);
            }
        }

        if ($request->product) {
            foreach ($request->product as $product_id => $value) {
                $event->product()->attach($value);
            }
        }

        return redirect(route('admin.event.index'));
    }

    public function config()
    {
        $config = EventCofig::first();
        $title = "Config Event";

        return view('admin.event.config', compact('title', 'config'));
    }

    public function storeConfig(Request $request)
    {
        $input = $request->all();
        $config = EventCofig::first();

        if (is_null($config)) {
            EventCofig::create([
                'minparticipant' => $input['minparticipant'],
                'maxparticipant' => $input['maxparticipant'],
                'minimumdate' => $input['minimumdate']
            ]);
        } else {
            $config = EventCofig::find($config->id);
            $config->minparticipant =   $input['minparticipant'];
            $config->maxparticipant =   $input['maxparticipant'];
            $config->minimumdate    =   $input['minimumdate'];
            $config->save();
        }

        return view('admin.event.config', compact('title', 'config'));
    }

    public function sendEmail($data)
    {
        $sendEmail = Mail::send('mails.response', $data, function ($mail) use ($data) {
            $mail->to($data['email']);
            $mail->subject('Response of Event');
        });

        return $sendEmail;
    }

    
}
