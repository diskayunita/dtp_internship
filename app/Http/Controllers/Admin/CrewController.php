<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Crew;

class CrewController extends Controller
{
    private $page_name = 'Telkom DDS Team';

    public function index()
    {
        $crews = Crew::all();
        $title = $this->page_name;
        return view('admin.crew.index', compact('crews', 'title'));
    }

    public function show($id)
    {
        $crew = Crew::find($id);
        $title = $this->page_name;
        return view('admin.crew.show', compact('crew', 'title'));
    }

    public function edit($id)
    {
        $crew = Crew::find($id);
        $title = $this->page_name;
        return view('admin.crew.edit', compact('crew', 'title'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|min:4',
            'position' => 'required',
        ]);

        $crew = Crew::find($id);

        if ($crew->update($input)) {
            $message = sprintf('%s info has been successfully updated', $crew->name);
            $level = 'success';
        } else {
            $message = sprintf('Oops!!, Failed to update %s info', $crew->name);
            $level = 'error';
        }

        flash($message, $level);

        return redirect(route('admin.crew.index'))
            ->withErrors($validator)
            ->withInput();
    }

    public function create()
    {
        $crew = new Crew();
        $title = $this->page_name;
        return view('admin.crew.create', compact('crew', 'title'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|min:4',
            'position' => 'required',
        ]);

        if (Crew::create($input)) {
            $message = sprintf('%s has been successfully added to the crew list', $input['name']);
            $level = 'success';
        } else {
            $message = sprintf('Oops!!, Failed to add %s to crew list', $input['name']);
            $level = 'error';
        }

        flash($message, $level);

        return redirect(route('admin.crew.index'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id)
    {
        $crew = Crew::find($id);
        if ($crew) {
            if ($crew->delete()) :
                $message = sprintf('%s has been successfully deleted from crew list', $crew->name);
                $level = 'success';
            else:
                $message = sprintf('Oops!!, Unable to delete %s from crew list', $crew->name);
                $level = 'error';
            endif;
        } else {
            $message = 'Oops!!, Unable to delete crew, Record\'s not found';
            $level = 'error';
        }

        flash($message, $level);
        return redirect(route('admin.crew.index'));
    }

}