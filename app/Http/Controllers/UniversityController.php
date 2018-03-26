<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\University;
use App\UniversityTranslation;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = University::all();
        $title = "University List";
        return view('admin.university.index', compact('universities', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $university = new University();
        $title = "University Create";
        return view('admin.university.create',compact('title','university'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input= $request->all();
        $input['name'] = $input['nameTrans'][1];
        $input['description'] = $input['descriptionTrans'][1];

        $university = new University();

        if ($university->validate($input)) {
            $university->name = $input['name'];
            $university->description = $input['description'];
            if ($university->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    $university->translation()->save(
                        new UniversityTranslation([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ])
                    );
                }
            }
            flash('University successfully created', 'success');
            return redirect(route('admin.university.index'));
        } else {
            return redirect(route('admin.university.create'))->withErrors($university->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $university = University::find($id);

        $title = $university ? $university->name : 'University Details';

        return view('admin.university.show', compact('university', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $university = University::find($id);
        $title = "University Edit";
        return view('admin.university.edit', compact('title', 'university'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input= $request->all();
        $input['name'] = $input['nameTrans'][1];
        $input['description'] = $input['descriptionTrans'][1];

        $university = University::find($id);

        if ($university->validate($input)) {
            $university->name = $input['name'];
            $university->description = $input['description'];
            if ($university->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    if (!is_null($university->translation($lang)->first())) {
                        $university->translation($lang)->first()->update([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ]);
                    } else {
                        $university->translation()->save(
                            new UniversityTranslation([
                                'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                                'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                                'language'  => $lang,
                            ])
                        );
                    }
                }
            }
            flash('University successfully updated', 'success');
            return redirect(route('admin.university.index'));
        } else {
            return redirect(route('admin.university.edit'))->withErrors($university->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $university = University::find($id);

        if ($university) {
            $university->delete();
            flash('University successfully deleted', 'success');
        } else {
            flash('University unsuccessfully deleted', 'error');
        }
        
        return redirect(route('admin.university.index'));
    }
}
