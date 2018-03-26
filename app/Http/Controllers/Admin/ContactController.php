<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contact;
use App\ContactReply;
use Auth;
use Mail;


class ContactController extends Controller
{

    public function index()
    {
        //
        $contacts = Contact::all();
        $title = "Contact List";
        return view('admin.contact.index', compact('contacts', 'title'));
    }

    public function create()
    {
        $contact = new Contact();
        $title = "Contact Create";
        return view('admin.contact.create', compact('title', 'contact'));
    }

    public function store(Request $request)
    {
        $input= $request->all();

        Contact::create(
            ['user_id' => $input['user_id'], 
            'name' => $input['name'], 
            'email' => $input['email'], 
            'subject'=>$input['subject'], 
            'message'=>$input['message']]);

        flash('contact successfully created', 'success');
        return redirect(route('admin.contact.index'));
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        $title = "Contact Detail";

        // update read status to true
        if (!$contact->read) {
            $contact->read = 1;
            $contact->save();
        }

        return view('admin.contact.detail', compact('title', 'contact'));
    }

    public function reply(Request $request, $id)
    {
        $input = $request->all();

        $reply = new ContactReply; // create New Instance of ContactReply Model
        $reply->sender_id = Auth::guard('admin')->user()->id;
        $reply->recipient_id = $input['recipient_id'];
        $reply->message = $input['reply_message'];

        // prepare $data to be accessed email view
        $data = [
            'recipient_name' => $input['recipient_name'],
            'reply_message' => $input['reply_message'],
        ];

        if ($reply->save()) {
            Mail::send('mails.contact_reply', $data, function ($email) use ($input) {
                $email->to($input['recipient_email']);
                $email->subject('Reply of: '.$input['recipient_subject']);
            });
        }

        flash('contact successfully replayed', 'success');
        return redirect(route('admin.contact.edit', [$id]));

    }
}
