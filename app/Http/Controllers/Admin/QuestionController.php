<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use App\Survey;
use App\Question;

class QuestionController extends Controller
{
    //
    public function store(Request $request, Survey $survey) 
    {
        $arr = $request->all();
      
        $validator = Validator::make($arr, [
            'question_type' => 'required',
            'title' => 'required|min:4'
        ]);

        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }
      
        $survey->questions()->create($arr);
      
        return back();
    }

    public function edit(Question $question) 
    {
        $title = "Edit Question";
        return view('admin.question.edit', compact('question', 'title'));
    }

    public function update(Request $request, Question $question) 
    {
        if ($question->question_type!=$request->question_type) {
            $question->update($request->all());
        } else {
            if ($question->question_type=='radio' || $question->question_type=='checkbox') {
                if ($question->option_name) {
                    $question->update($request->all());
                }
            }
        }
      
        return redirect(route('admin.detail_survey', [$question->survey_id]));
    }

    public function destroy($id)
    {
        $question = Question::find($id);
        if ($question) {
            if ($question->answers()) {
                $question->answers()->delete();
            }

            $question->delete();
        }

        $message = sprintf('Question %s has been deleted', $question->title);
        return redirect()->back()->with('success', $message);
    }
}
