<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Division;
use App\DivisionTranslation;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::all();
        $title = "Division List";
        return view('admin.division.index', compact('divisions', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $division = new Division();
        $title = "Division Create";
        return view('admin.division.create', compact('title', 'division'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $division = new Division();
        $division->avatar = $input['avatar'];
        
        if ($division->save()) {
            foreach (config('app.languages') as $key=>$lang) {
                $division->translation()->save(
                    new DivisionTranslation([
                        'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                        'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                        'language'  => $lang,
                    ])
                );
            }
            flash('Division successfully created', 'success');
        } else {
            flash('Division unsuccessfully created', 'error');
        }
        return redirect(route('admin.division.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $division = Division::find($id);

        $title = $division ? $division->name : 'division Details';

        return view('admin.division.show', compact('division', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $division = Division::find($id);
        $title = "Division Edit";
        return view('admin.division.edit',compact('title','division'));
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
        $division = Division::find($id);
    
        if ($request->hasFile('avatar')) {
            $input['avatar'] = $input['avatar'];
            $division->avatar = $input['avatar'];
        
            if ($division->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    if ($division->translation($lang)->first()) {
                        $division->translation($lang)->first()->update([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ]);
                    }
                }
            }
      
            flash('Division successfully updated', 'success');
            return redirect(route('admin.division.index'));
        } else {
            foreach (config('app.languages') as $key=>$lang) {
                if ($division->translation($lang)->first()) {
                    $division->translation($lang)->first()->update([
                        'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                        'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                        'language'  => $lang,
                    ]);
                }
            }
            flash('Division successfully updated', 'success');
            return redirect(route('admin.division.index'));
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
        $division = Division::find($id);
        if ($division) {
            $division->delete();
            flash('Division successfully deleted', 'success');
        } else {
            flash('Division unsuccessfully deleted', 'error');
        }
        return redirect(route('admin.division.index'));
    }
}
