<?php
use Illuminate\Support\Facades\DB;
use App\Contact;
use App\Event;
use App\Avatar;
use App\EventResponse;
use App\Purpose;
use App\Product;
use App\EventPurpose;
use App\EventType;
use App\PurposeTranslation;
use App\University;
use App\Survey;
use App\BlockedDate;
use App\ParticipantLimit;
use App\EventCofig;
// use Auth;

function countUnreadContact()
{
    return Contact::where('read', 0)->count();
}

function countPendingEvents()
{
    return Event::whereIn('approval', ['pending','Pending','revised','Revised'])->count();
}

function findEventApproved()
{
    return Event::where('approval', 'approved')->get();
}

function valPIC($old, $content, $auth)
{
    return isset($old) ? $old : ($content ? $content : $auth) ;
}

function valdate($old, $content)
{
    return isset($old) ? date("Y-m-d", strtotime("$old")) : ($content ? date("Y-m-d", strtotime("$content")) : null) ;
}

function val($old, $content)
{
    return isset($old) ? $old : ($content ? $content : null) ;
}

function selecting($old, $content, $fk)
{
    return ($old == $content || $fk == $content)  ? 'selected' : '';
}

function select_s($old, $content, $value)
{
    $c_en = $content->translation('en')->first()->name;
    $c_id = $content->translation('id')->first()->name;
    return isset($old) ? ( ($c_en == $old || $c_id == $old) ? 'selected' : '' ) : ( ($c_en == $value || $c_id == $value) ? 'selected' : '' );
}

function multiselect($old, $content, $fk)
{
    return isset($old) ? ((collect($old)->contains($fk)) ? 'selected':'') : ((collect($content)->contains($fk)) ? 'selected':'');
}

function eventvar()
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

    $eventapproved = implode(",",$eventapproveds);

    //date disabled
    $disableddate =  BlockedDate::pluck('date')->toArray();
    $disableddates = [];

    foreach ($disableddate as &$datedisabled) {
        $disableddates[] = "'".$datedisabled."'";
    }

    //$disableddate = count($disableddate) > 0 ? implode(",",$disableddates) : null;
    //$minDate = '1';
    //$limit = EventCofig::orderBy('created_at','desc')->first();

    //if ($limit) {
        //$minDate = $limit->minimumdate;
    //}

    return compact([
        'event','startDate','endDate','provinces', 'purposes','products','language','disableddate', 'eventapproved','university','faculty','credits','location','types'
    ]);
}

function uservar()
{
    $university = University::orderBy('name')->get();

    
    return compact([
        'user','name','email','password', 'remember_token','mobile_number', 'address','university','nim','major','faculty'
    ]);
}
// function multiselecting($old, $id, $content)
// {
//     return $old == $id ? 'selected' : '';
// }

function checking($old,$event, $value)
{
    return ($old || $event) == $value ? 'checked' : '';
}

function useravatar()
{
	// if (Auth::check()) {
    $avatar = Avatar::find(Auth::user()->id);
    $useravatar = $avatar->avatar;
    return $useravatar;
	// }
}

function bitly_url_shorten($long_url, $access_token, $domain)
{
    $url = 'https://api-ssl.bitly.com/v3/shorten?access_token='.$access_token.'&longUrl='.urlencode($long_url).'&domain='.$domain;
    try {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        $output = json_decode(curl_exec($ch));
    } catch (Exception $e) {
    }
    if (isset($output)) { return $output->data->url; }
}

/**
 * @var $eventStatus string
 * @label('Name of event status')
 *
 * @return string
 */
function statusLabelColor($eventStatus)
{
    $status = strtolower($eventStatus); // cast all string to lower
    switch($status) {
        case 'pending':
                $labelColor = 'label label-warning';
            break;
        case 'interview':
                $labelColor = 'label label-info';
            break;
        case 'approved':
                $labelColor = 'label label-success';
            break;
        case 'rejected':
                $labelColor = 'label label-danger';
            break;
        case 'completed':
                $labelColor = 'label label-primary';
            break;
        default:
            $labelColor = 'label label-default';
    }

    return $labelColor;
}
