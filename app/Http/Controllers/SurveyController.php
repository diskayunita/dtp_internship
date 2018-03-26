<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Survey;
use App\Answer;
use App\PublicAnswer;
use App\Event;
use App\Question;


class SurveyController extends Controller
{
    public function show(Request $request, $referral_id=null)
    {
        $survey_id = substr($referral_id, 0, 1);
        $survey = Survey::where('id', $survey_id)->with('questions')->first();

        $participant = 0;

        if ($survey) {
            // To open event survey you must add no_ref params
            // for example http://visit.ddstelkom.id/survey/{survey_id}?no_ref={event_id}
            if ($request->no_ref && !$survey->global_type) {
                $event = $survey->event()->where('events.id', $request->no_ref)->first();
                if ($event) {
                    $participant = $event->number_participant;
                    
                    $now = strtotime(date('Y-m-d'));
                    $startDate = strtotime(Carbon::parse($event->start_date)->format('Y-m-d'));
                    $endDate = strtotime(Carbon::parse($event->end_date)->addDays(3)->format('Y-m-d'));

                    if ($now >= $startDate && $now <= $endDate) {
                        $countAnswer = Answer::where(['survey_id'=>$survey_id, 'event_id'=>$event->id])->count();
                        if ($participant >= $countAnswer) {
                            $referral_id = $event->id;
                            return view('survey.front-end', compact('survey', 'referral_id'));
                        } else {
                            return abort(404);
                        }
                    }
                }
            } 
            
            if ($survey->global_type) {
                return view('survey.front-end', compact('survey', 'referral_id'));
            }

            // return abort(404);
            return view('survey.not-accessible');
        }

        return abort(404);
    }
    
    public function store(Request $request, $id, $referral_id=null)
    {
        $referral_id = $request->event_id;
        $event = Event::find($referral_id);
        $_data = $request->except('_token', 'event_id', 'survey_id');

        $checkSurvey = Survey::find($request->survey_id);
        
        if ($checkSurvey->global_type == 1) {
            \DB::beginTransaction();
            try {
                foreach ($_data as $key => $value) {
                    $answer = ($value) ? $value : '-';
                    $data['answer'] = (is_array($answer) == true) ? json_encode($answer) : $answer;
                    $data['question_id'] = $key;
                    $data['survey_id'] = $request->survey_id;
                    $data['ip_user'] = $request->ip();
                    PublicAnswer::create($data);
                    \DB::commit();
                }
            }
            catch (Exception $e) {
                DB::rollback();
            }
            return view('survey.finish');
        }

        if (!$event) {
            return abort(404);
        }
        
        \DB::beginTransaction();
        
        try {
            foreach ($_data as $key => $value) {
                $answer = ($value) ? $value : '-';
                $data['answer'] = $answer;
                $data['question_id'] = $key;
                $data['survey_id'] = $request->survey_id;
                $data['visit_number'] = '1';
                $data['event_id'] = $event->id;
                Answer::create($data);
                \DB::commit();
            }
            $event->update(['is_surveyed' => true, 'approval' => 'completed']);
        }
        catch (Exception $e) {
            DB::rollback();
        }
        
        return view('survey.finish');
    }
}