<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Event;
use App\EventResponse;
use App\Purpose;
use App\Product;
use App\EventPurpose;
use App\EventType;
use App\PurposeTranslation;
use App\University;
use App\Survey;
use App\EventCofig;
use PDF;
use Indonesia;
use View;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $events = Event::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $eventStatus = $events->pluck('approval')->toArray();
        $statusInfo = (in_array('pending', $eventStatus)) ? trans('general.event_info') : '';

        return view('event.index', compact('events', 'statusInfo'));
    }

    public function create()
    {
        $e = eventvar();

        $event = new Event;
        return view('event.create', array(
            'event' => $event,
            'startDate' => $e['startDate'],
            'endDate' => $e['endDate'],
            'purposes' => $e['purposes'],
            'products' => $e['products'],
            'language' => $e['language'],
            'disableddate' => $e['disableddate'],
            'eventapproved' => $e['eventapproved'],
            'university' => $e['university'],
            'types' => $e['types']
        ));

    }

    public function store(Request $request)
    {
        $input = $request->all();

        $messages = [
            'time.after' => 'The event should start two days after today'
        ];


        $Validator = Validator::make($input, [
            'username' => 'required|max:255',
            'contact' => 'required|max:15',
            'email' => 'required|max:255',
            'university' => 'required',
            'faculty' => 'required|max:255',
            'type' => 'required',
            'credits' => 'required|max:255',
            'description' => 'required|max:255',
            //'time' => 'required|date|date_format:Y-m-d|after:'.date('Y-m-d', strtotime("+1 days")),
            'attachment' => 'required|max:1024',
            'pakta' => 'required|max:1024',
        ], $messages);

        if ($Validator->fails()) {
            return $Validator->errors()->all();
            return back()->withErrors($Validator)->withInput();
        }

        $event = Event::create([
            'user_id' => Auth::user()->id,
            'username' => $input['username'],
            'contact' => $input['contact'],
            'email' => $input['email'],
            'type' => $input['type'],
            'university' => $input['university'],
            'faculty' => $input['faculty'],
            'credits' => $input['credits'],
            'description' => $input['description'],
            //'start_date' => $input['time'],
            //'end_date' => $input['time'],
            'attachment' => isset($input['attachment']) ? $input['attachment'] : null,
            'pakta' => isset($input['pakta']) ? $input['pakta'] : null,
            'approval' => 'pending'
        ]);

        $event->purpose()->attach($request->purpose);
        $event->product()->attach($request->product);

        return redirect(route('event.index'));
    }

    public function show($id)
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');

        $event = Event::find($id);
        $statusInfo = ($event->approval == 'pending') ? trans('general.event_info') : '';
        $hasSurvey = false;

        $purposes = Purpose::whereIn('id', $event->getPurposeIds())->get();

        //$tab['register']    = 'disabled';
        $tab['booking']     = '';
        $tab['interview']    = 'disabled';
        $tab['approval']    = 'disabled';
        $tab['survey']      = 'disabled';
        $tab['completed']   = 'disabled';

        //$status['register'] = 'done';
        $status['booking'] = 'done';
        $status['interview'] = '';
        $status['approval'] = '';
        $status['survey'] = '';
        $status['completed'] = '';

        $referral['id'] = '';
        $referral['url'] = '';

        if ($event) :
            if ($event->approval == 'pending') {
                $tab['booking'] = 'active';
                $status['booking'] = 'done';
            } elseif ($event->approval == 'interview') {
                $tab['interview'] = 'active';
                $status['interview'] = 'done';
            } elseif ($event->approval == 'approved') {
                $tab['interview'] = '';
                $status['interview'] = 'done';

                $tab['approval'] = 'active';
                $status['approval'] = 'done';

                //$tab['survey'] = 'active';
                //$status['survey'] = 'done';
            } elseif ($event->approval == 'completed') {
                $tab['interview'] = '';
                $status['interview'] = 'done';

                $tab['approval'] = '';
                $status['approval'] = 'done';

                $tab['survey'] = '';
                $status['survey'] = 'done';

                $tab['completed'] = 'active';
                $status['completed'] = 'done';
            } elseif ($event->approval == 'rejected') {
                $tab['booking'] = '';
                $status['booking'] = 'reject';

                $tab['interview'] = 'active';
                $status['interview'] = 'reject';
            }

            $survey = Survey::where('id', $event->survey_id)->first();

            if ($survey) :
                $hasSurvey = true;
                $referral['id'] = $event->survey_id.date_format(date_create(isset($event) ? $event->date : date('Y-m-d')), "Ymd");
                $referral['url'] =  route('survey.show', $survey->id).'?no_ref='.$id;
                $survey = Survey::where('id', $event->survey_id)->with('questions')->first();
            endif;
        endif;

        $referral['id'] = Auth::user()->id;

        return view('event.show', compact('language', 'tab', 'status', 'event', 'purposes', 'hasSurvey', 'survey', 'referral', 'statusInfo'));
    }

    public function response($id)
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');
        Event::find($id)->update(['is_read'=>true]);
        $event = Event::where('id', $id)->with('responses')->first();
        $purposes = Purpose::whereIn('id', $event->getPurposeIds())->get();
        return view('event.response', compact('event', 'purposes', 'language'));
    }

    public function responsePdf($id)
    {
        $language = session('locale') ? session('locale') : config('app.fallback_locale');
        Event::find($id)->update(['is_read'=>true]);
        $event=Event::where('id', $id)->with('responses')->first();
        $purposes = Purpose::whereIn('id', $event->getPurposeIds())->get();
        $pdf = PDF::loadView('event.pdf', compact('event', 'purposes', 'language'));
        return $pdf->download();
    }

    public function edit($id)
    {
        $e = eventvar();

        $event = Event::find($id);

        // get event approved without data event being edited
        $eventapproved = Event::where('approval', 'approved')->whereNotIn('id', [$event->id])->get();

        $eventapproveds = [];
        foreach ($eventapproved as $key => $value) {
            $eventapproveds[] = "'".date("Y-m-d", strtotime("$value->start_date"))."'";
        }

        $eventapproved = implode(",", $eventapproveds);
        
        return view('event.edit', [
            'event' => $event,
            //'startDate' => $e['startDate'],
            'endDate' => $e['endDate'],
            'purposes' => $e['purposes'],
            'products' => $e['products'],
            'language' => $e['language'],
            'disableddate' => $e['disableddate'],
            'eventapproved' => $eventapproved,
            'university' => $e['university'],
            'types' => $e['types']
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $messages = [
            'time.after' => 'The event should start two days after today'
        ];


        $Validator = Validator::make($input, [
            'username' => 'required|max:255',
            'contact' => 'required|max:15',
            'email' => 'required|max:255',
            'university' => 'required',
            'faculty' => 'required|max:255',
            'type' => 'required',
            'credits' => 'required|max:255',
            //'location' => 'required|max:255',
            'description' => 'required|max:255',
            //'time' => 'required|date|date_format:Y-m-d|after:'.date('Y-m-d', strtotime("+1 days")),
            'attachment' => 'required|max:1024',
            'attachment' => 'required|max:1024',
        ], $messages);

        if ($Validator->fails()) {
            return back()->withErrors($Validator)->withInput();
        }

        $event = Event::find($id);
        $event->purpose()->sync($input['purpose']);
        $event->product()->sync($input['product']);

        $event->update([
            'user_id' => Auth::user()->id,
            'username' => $input['username'],
            'contact' => $input['contact'],
            'email' => $input['email'],
            'type' => $input['type'],
            'university' => $input['university'],
            'faculty' => $input['faculty'],
            'credits' => $input['credits'],
            'description' => $input['description'],
            //'start_date' => $input['time'],
            //'end_date' => $input['time'],
            'attachment' => isset($input['attachment']) ? $input['attachment'] : null,
            'pakta' => isset($input['pakta']) ? $input['pakta'] : null,
            'approval' => 'revised'
        ]);

        return redirect(route('event.show', $id));
    }
}
