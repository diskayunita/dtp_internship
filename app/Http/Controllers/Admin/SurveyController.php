<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Survey;
use App\Answer;
use App\Question;
use PDF;
use Excel;
use DB;

class SurveyController extends Controller
{
    //
    public function index()
    {
        $surveys = Survey::all();
        $title = 'Survey lists';
        return view('admin.survey.index', compact('surveys','title'));
    }

    public function show(Survey $survey)
    {
        // $survey = Survey::find($id);
        $survey->option_name = unserialize($survey->option_name);
        $title = "Survey Detail";
        return view('admin.survey.show', compact('survey', 'title'));
    }

    public function create()
    {
        $survey = new Survey();
        $title = 'Add Survey';
        return view('admin.survey.create', compact('survey', 'title'));
    }

    public function store(Request $request, Survey $survey)
    {
        $arr = $request->all();

        $messages = array(
            'global_type.required' => 'A Survey Type is required'
        );

        $validator = Validator::make($arr, [
            'title' => 'required|min:4',
            'global_type' => 'required',
            'description' => 'required|min:10'
        ], $messages);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $survey = $survey->create($arr);

        flash('Survey successfully created', 'success');
        return redirect(route('admin.detail_survey', $survey));
    }

    public function edit($id)
    {
        $survey = Survey::find($id);
        $title = "Edit Survey";
        return view('admin.survey.edit', compact('survey', 'title'));
    }

    public function update(Request $request, Survey $survey)
    {
        $survey->update($request->only(['title', 'description','global_type']));
        flash('Survey successfully updated', 'success');
        
        return redirect()->back();
    }

    public function destroy($id) 
    {
        $survey = Survey::find($id);
        if ($survey) {
            if ($survey->questions()) {
                $survey->questions()->delete();
            }
            if ($survey->answers()) {
                $survey->answers()->delete();
            }

            $survey->delete();
        }
        return redirect(route('admin.survey.index'));
    }

    public function publish($id)
    {
        DB::beginTransaction();
        try {
            Survey::find($id)->update(['published'=>true]);
            Survey::whereNotIn('id', [$id])->update(['published'=>false]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect(route('admin.survey.index'));
    }
    public function unPublish($id)
    {
        DB::beginTransaction();
        try {
            Survey::find($id)->update(['published'=>false]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect(route('admin.survey.index'));
    }

    public function exportExcel(){
        Excel::create('Surveys Report', function ($excel) {
            $surveys=$this->getReport();
            $excel->sheet('New sheet', function ($sheet) use ($surveys) {
                $sheet->loadView('admin.survey.export.excel', compact('surveys'));
            });
        })->export('xlsx');
    }

    public function exportPdf()
    {
        $surveys=$this->getReport();
        $pdf = PDF::loadView('admin.survey.export.pdf', compact('surveys'));
        return $pdf->download();
    }

    private function getReport()
    {
        $report = Survey::orderBy('created_at', 'desc')->get();
        return $report;
    }

    public function getAnswer($id)
    {
        $title = "Surveys Answers Report";
        $survey=$this->hasAnswers($id);

        $question_list = [];
        foreach ($survey->questions as $question):
            if ($survey->global_type == 1 ) {
                $answer_list = $question->public_answers->pluck('answer')->toArray();
            } else {
                $answer_list = $question->answers->pluck('answer')->toArray();
            }
            $total_respondent = count($answer_list);

            if ($question->question_type == 'radio' || $question->question_type == 'checkbox'):
                $count_option_value = array_count_values($answer_list);
                $answer_data = [];
                foreach ($count_option_value as $option => $value) :
                    $percentage = round(($value / $total_respondent ) * 100, 2, PHP_ROUND_HALF_UP);
                    array_push($answer_data, [
                        'label' => $option .' '. number_format($percentage, 2, ',', '.') . '%',
                        'y' => $value,
                        'legendText' => $option]);
                endforeach;

                array_push($question_list, [
                    'type' => $question->question_type,
                    'title' => $question->title,
                    'respondent' => $total_respondent,
                    'answer' => $answer_data
                ]);
            else:
                $answer_essay = [];
                foreach ($answer_list as $aKey => $value) {
                    array_push($answer_essay, ($aKey+1) .'. '. $value.'</p>');
                }
                array_push($question_list, [
                    'type' => $question->question_type,
                    'title' => $question->title,
                    'respondent' => $total_respondent,
                    'answer' => implode("<p class='breakContent'> ", $answer_essay)
                ]);
            endif;
        endforeach;

        return view('admin.survey.answer', compact('title', 'survey', 'question_list'));
    }

    public function answerPdf($id)
    {
        $surveys=$this->hasAnswers($id);
        $pdf = PDF::loadView('admin.survey.export.answer', compact('surveys'));
        return $pdf->download();
    }

    public function answerExcel($id)
    {
        Excel::create('Surveys Answers Report', function ($excel) use (&$id){
            $surveys=$this->hasAnswers($id);
            $excel->sheet('New sheet', function ($sheet) use ($surveys) {
                $sheet->loadView('admin.survey.export.answer', compact('surveys'));
            });
        })->export('xlsx');
    }

    protected function hasAnswers($id)
    {
        $checkSurvey = Survey::where('id', $id)->first();
        if ($checkSurvey->global_type == 1) {
            $survey=Survey::where('id', $id)->with('questions', 'questions.public_answers')->first();
        } else {
            $survey=Survey::where('id', $id)->with('questions', 'questions.answers')->first();
        }
        return $survey;
    }

}