<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\EventType;
use App\EventTypeTranslation;

class EventTypeController extends Controller
{
    public function index()
    {
        $types = EventType::all();
        $title = "Event Purpose List";
        return view('admin.e-type.index', compact('types', 'title'));
    }

    public function create()
    {
        $type = new EventType();
        $title = "Event Type Create";
        return view('admin.e-type.create',compact('title','type'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $input['name'] = $input['nameTrans'][1];
        $input['description'] = $input['descriptionTrans'][1];

        $type = new EventType();

        if ($type->validate($input)) {
            $type->name = $input['name'];
            $type->description = $input['description'];
            if ($type->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    $type->translation()->save(
                        new EventTypeTranslation([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ])
                    );
                }
            }
            flash('Event Type successfully created', 'success');
            return redirect(route('admin.type.index'));
        } else {
            return redirect(route('admin.type.create'))->withErrors($type->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $type = EventType::find($id);
        $title = "Event Type Edit";
        return view('admin.e-type.edit', compact('title', 'type'));
    }

    public function update(Request $request, $id)
    {
        $input= $request->all();
        $input['name'] = $input['nameTrans'][1];
        $input['description'] = $input['descriptionTrans'][1];

        $type = EventType::find($id);

        if ($type->validate($input)) {
            $type->name = $input['name'];
            $type->description = $input['description'];
            if ($type->save()) {
                foreach (config('app.languages') as $key=>$lang) {
                    if ($type->translation($lang)->first()) {
                        $type->translation($lang)->first()->update([
                            'name' => isset($input['nameTrans'][$key]) ? $input['nameTrans'][$key] : current(array_filter($input['nameTrans'])),
                            'description' => isset($input['descriptionTrans'][$key]) ? $input['descriptionTrans'][$key] : current(array_filter($input['descriptionTrans'])),
                            'language'  => $lang,
                        ]);
                    }
                }
            }
            flash('Event Type successfully updated', 'success');
            return redirect(route('admin.type.index'));
        } else {
            return redirect(route('admin.type.edit'))->withErrors($type->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $type = EventType::find($id);

        if ($type) {
            $type->delete();
            flash('Event Type successfully deleted', 'success');
        } else {
            flash('Event Type unsuccessfully deleted', 'error');
        }
        return redirect(route('admin.type.index'));
    }
}