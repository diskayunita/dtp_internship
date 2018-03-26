<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ParticipantLimit;

class ParticipantLimitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participant_limit = ParticipantLimit::all();
        $title = "Participant Limit List";
        return view('admin.participant.index', compact('participant_limit', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $participant_limit = new ParticipantLimit();
        $title = "Participant Limit Create";
        return view('admin.participant.create', compact('title', 'participant_limit'));
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

        $participant_limit = new ParticipantLimit();

        if ($participant_limit->validate($input)) {
            $participant_limit->create($input);
            flash('Participant Limit successfully created', 'success');
            return redirect(route('admin.participant.index'));
        } else {
            return redirect(route('admin.participant.create'))->withErrors($participant_limit->errors())->withInput();
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
        $participant_limit = ParticipantLimit::find($id);

        $title = $participant_limit ? $participant_limit->name : 'Participant Limit Details';

        return view('admin.participant.show', compact('participant_limit', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $participant_limit = ParticipantLimit::find($id);
        $title = "Participant Limit Edit";
        return view('admin.participant.edit', compact('title', 'participant_limit'));
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

        $participant_limit = ParticipantLimit::find($id);

        if ($participant_limit->validate($input)) {
            $participant_limit->update($input);
            flash('Participant Limit successfully updated', 'success');
            return redirect(route('admin.participant.edit', $id));
        } else {
            return redirect(route('admin.participant.edit', $id))->withErrors($participant_limit->errors())->withInput();
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
        $participant_limit = ParticipantLimit::find($id);

        if ($participant_limit) {
            $participant_limit->delete();
            flash('Participant Limit successfully deleted', 'success');
        } else {
            flash('Participant Limit unsuccessfully deleted', 'error');
        }
        
        return redirect(route('admin.participant.index'));
    }
}
