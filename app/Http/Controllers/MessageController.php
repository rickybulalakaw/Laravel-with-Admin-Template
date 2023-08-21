<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    private function userContext(){


        
        $accountable_form_types_of_user = DB::table('accountable_form_types')
        ->join('accountable_forms', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
        ->join('users', 'accountable_forms.user_id', '=', 'users.id')
        // ->select('accountable_form_types.name')->distinct()
        ->select('accountable_form_types.id', 'accountable_form_types.name')->distinct()
        ->where('accountable_forms.user_id', auth()->user()->id)
        ->where('accountable_forms.use_status', AccountableForm::IS_ASSIGNED)
        ->get();

        // $collectors = User::get();

        // get messages 

        $message_count = DB::table('messages')
        ->select('sender.name as first_name', 'sender.last_name as last_name', 'messages.subject as subject', 'messages.created_at as created_at')
        // ->join('users as recipient', 'messages.recipient_user_id', '=', 'recipient.id')
        ->join('users as sender', 'messages.user_id', '=', 'sender.id')
        ->where('messages.recipient_user_id', auth()->user()->id)
        ->where('messages.status', Message::STATUS_UNREAD)
        ->count();

        $context = [
            'accountable_form_types_of_user' => $accountable_form_types_of_user,
            'message_count' => $message_count,
            // 'collectors' => $collectors
        ];
        return $context;
    
}

    public function index()
    {
        // this function displays messages routed to this user
        $thisUser = auth()->user()->id;

        
        // $messages = DB::table('messages')
        // ->select('sender.name as first_name', 'sender.last_name as last_name', 'messages.subject as subject', 'messages.created_at as created_at')
        // ->join('users as recipient', 'messages.recipient_user_id', '=', 'recipient.id')
        // ->join('users as sender', 'messages.user_id', '=', 'sender.id')
        // ->where('messages.recipient_user_id', auth()->user()->id)
        // ->where('messages.status', Message::STATUS_UNREAD)
        // ->get();

        $context = $this->userContext();


        return view('message.index', $context);
        

    }

    public function store(Request $request)
    {
        $thisUser = auth()->user()->id;

        $this->validate($request, [
            'subject' => 'required',
            'message' => 'required',
            'recipient_user_id' => 'required'
        ]);

        Message::create([
            'user_id' => $thisUser,
            'subject' => $request->subject,
            'message' => $request->message,
            'entity' => $request->entity,
            'entity_id' => $request->entity_id,
            'recipient_user_id' => $request->recipient_user_id,
            'message_id' => $request->message_id,
            'status' => Message::STATUS_UNREAD
            ]);

            return back();    

    }
}
