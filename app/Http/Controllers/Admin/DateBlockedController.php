<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BlockedDate;
use App\EventCofig;

class DateBlockedController extends Controller
{
    public function index()
    {
        $blockeds = BlockedDate::all();
        $title = "Blocked Date List";
        return view('admin.bloceddate.index', compact('blockeds', 'title'));
    }

    public function create()
    {
        $blocked = new BlockedDate();
        $title = "Blocked Date List";
        $disableddates =  BlockedDate::pluck('date')->toArray();
        $disableddate = [];
        
        foreach ($disableddates as &$data) {
            $disableddate[] = '"'.$data.'"';
        }
        
        $disableddate = count($disableddate) > 0 ? implode(",", $disableddate) : null;
        $mindate=1;
        $limit=EventCofig::orderBy('created_at', 'desc')->first();

        if (isset($limit)) {
            $mindate=$limit->minimumdate;
        }
        return view('admin.bloceddate.create', compact('title', 'blocked', 'mindate', 'disableddate'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $blocked = new BlockedDate();

        if ($blocked->validate($input)) {
            $blocked->title = $input['title'];
            $blocked->date = $input['date'];
            $blocked->save();
            flash('Blocked Date successfully created', 'success');
            return redirect(route('admin.blokeddate.index'));
        } else {
            return redirect(route('admin.blokeddate.create'))->withErrors($blocked->errors())->withInput();
        }
    }

    public function edit($id)
    {
        $blocked = BlockedDate::find($id);
        $disableddates =  BlockedDate::whereNotIn('id', array($blocked->id))->pluck('date')->toArray();
        $disableddate = [];

        foreach ($disableddates as &$data) {
            $disableddate[] = '"'.$data.'"';
        }

        $title = "Blocked Date Edit";
        $disableddate = count($disableddate) > 0 ? implode(",", $disableddate) : null;
        $mindate = 1;
        $limit = EventCofig::orderBy('created_at', 'desc')->first();

        if ($limit) {
            $mindate = $limit->minimumdate;
        }

        return view('admin.bloceddate.edit', compact('title', 'blocked', 'mindate', 'disableddate'));
    }

    public function update(Request $request, $id)
    {
        $input= $request->all();

        $blocked = BlockedDate::find($id);

        if ($blocked->validate($input)) {
            $blocked->title = $input['title'];
            $blocked->date = $input['date'];
            $blocked->save();
            flash('Blocked Date successfully updated', 'success');
            return redirect(route('admin.blokeddate.index'));
        } else {
            return redirect(route('admin.blokeddate.edit'))->withErrors($blocked->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        $blocked = BlockedDate::find($id);
        if ($blocked) {
            $blocked->delete();
            flash('Blocked Date successfully deleted', 'success');
        } else {
            flash('Blocked Date unsuccessfully deleted', 'error');
        }
        return redirect(route('admin.blokeddate.index'));
    }
}
