<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Purpose;
use App\PurposeTranslation;
use View;

class PurposeController extends Controller
{
    private $page_title = 'Events : Manage Destination';

    public function __construct()
    {
        View::share('title', $this->page_title);
    }

    public function index()
    {
        $purposes = Purpose::all();
        return view('admin.purpose.index', compact('purposes'));
    }

    public function create()
    {
        $purpose = new Purpose();
        return view('admin.purpose.create', compact('purpose'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $purpose = new Purpose();

        if ($purpose->save()) {
            foreach (config('app.languages') as $key=>$lang) {
                $purpose->translation()->save(
                    new PurposeTranslation([
                        'name' => isset($input['name'][$key]) ? $input['name'][$key] : current(array_filter($input['name'])),
                        'language'  => $lang,
                    ])
                );
            }
            flash('Event Purpose successfully created', 'success');
            return redirect(route('admin.purpose.index'));
        }

        return redirect(route('admin.purpose.create'))->withErrors($purpose->errors())->withInput();
    }

    public function edit($id)
    {
        $purpose = Purpose::find($id);
        return view('admin.purpose.edit', compact('purpose'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $purpose = Purpose::find($id);

        foreach (config('app.languages') as $key=>$lang) {
            if ($purpose->translation($lang)->first()) {
                $purpose->translation($lang)->first()->update([
                    'name' => isset($input['name'][$key]) ? $input['name'][$key] : current(array_filter($input['name'])),
                    'language'  => $lang,
                ]);
            }
        }

        flash('Purpose successfully updated', 'success');
        return redirect(route('admin.purpose.index'));
    }

    public function destroy($id)
    {
        $purpose = Purpose::find($id);
        if ($purpose) {
            
            if ($purpose->purpose_translations()) {
                $purpose->purpose_translations()->delete();
            }

            if ($purpose->delete()) {
                flash('Purpose successfully deleted', 'success');
            } else {
                flash('Purpose unsuccessfully deleted', 'error');
            }
        } else {
            flash('Purpose unsuccessfully deleted', 'error');
        }

        return redirect(route('admin.purpose.index'));
    }

}