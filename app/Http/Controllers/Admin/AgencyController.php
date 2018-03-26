<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agency;
use App\AgencyTranslation;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::all();
        $title = "Agency List";
        return view('admin.agency.index', compact('agencies', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agency = new Agency();
        $title = "Agency Create";
        return view('admin.agency.create',compact('title','agency'));
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

        $agency = new Agency();

        if ($agency->validate($input)) {
            $agency->name = $input['name'];
            $agency->description = $input['description'];
            if ($agency->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    $agency->translation()->save(
                        new AgencyTranslation([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ])
                    );
                }
            }
            flash('Agency successfully created', 'success');
            return redirect(route('admin.agency.index'));
        } else {
            return redirect(route('admin.agency.create'))->withErrors($agency->errors())->withInput();
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
        $agency = Agency::find($id);

        $title = $agency ? $agency->name : 'Agency Details';

        return view('admin.agency.show', compact('agency', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = Agency::find($id);
        $title = "Agency Edit";
        return view('admin.agency.edit', compact('title', 'agency'));
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

        $agency = Agency::find($id);

        if ($agency->validate($input)) {
            $agency->name = $input['name'];
            $agency->description = $input['description'];
            if ($agency->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    if (!is_null($agency->translation($lang)->first())) {
                        $agency->translation($lang)->first()->update([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ]);
                    } else {
                        $agency->translation()->save(
                            new AgencyTranslation([
                                'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                                'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                                'language'  => $lang,
                            ])
                        );
                    }
                }
            }
            flash('Agency successfully updated', 'success');
            return redirect(route('admin.agency.index'));
        } else {
            return redirect(route('admin.agency.edit'))->withErrors($agency->errors())->withInput();
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
        $agency = Agency::find($id);

        if ($agency) {
            $agency->delete();
            flash('Agency successfully deleted', 'success');
        } else {
            flash('Agency unsuccessfully deleted', 'error');
        }
        
        return redirect(route('admin.agency.index'));
    }
}
