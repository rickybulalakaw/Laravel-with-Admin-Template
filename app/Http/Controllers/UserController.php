<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\AccountableForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

    }

    private function userContext(){


        
            $accountable_form_types_of_user = DB::table('accountable_form_types')
            ->join('accountable_forms', 'accountable_forms.accountable_form_type_id', '=', 'accountable_form_types.id')
            ->join('users', 'accountable_forms.user_id', '=', 'users.id')
            ->select('accountable_form_types.id', 'accountable_form_types.name')->distinct()
            ->where('accountable_forms.user_id', auth()->user()->id)
            ->where('accountable_forms.use_status', AccountableForm::IS_ASSIGNED)
            ->get();

            // get messages 

            $message_count = DB::table('messages')
            ->select('sender.first_name as first_name', 'sender.last_name as last_name', 'messages.subject as subject', 'messages.created_at as created_at')
            ->join('users as recipient', 'messages.recipient_user_id', '=', 'recipient.id')
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
        // lists alll users 


        if(! Gate::allows('admin', auth()->user()->id )) {
            abort(403, 'This is restricted to the System Administrator');
        }

        $context = $this->userContext();
        // get all users except Admin

        $users = DB::table('users')->where('function', '!=', User::IS_ADMIN)
        ->get();

        // dd($users);



        $headers = [
            ['class' => 'text-xl text-slate-800 dark:text-white', 'value' => 'Name'],
            ['class' => 'text-xl text-slate-800 dark:text-white', 'value' => 'Function'],
            ['class' => 'text-xl text-slate-800 dark:text-white', 'value' => 'Office'],
            ['class' => 'text-xl text-slate-800 dark:text-white', 'value' => 'Edit'],
        ];

        foreach($users as $userd)
        {
            $user_array[] = [
                ['class' => 'border-b-2 border-yellow-500 dark:text-white dark:border-yellow-900', 'value' => $userd->name . ' ' . $userd->last_name],
                ['class' => 'border-b-2 border-yellow-500 dark:text-white text-center dark:border-yellow-900', 'value' => $userd->function],
                ['class' => 'border-b-2 border-yellow-500 dark:text-white text-center dark:border-yellow-900 text-center', 'value' => $userd->office_id],
                ['class' => 'border-b-2 border-yellow-500 dark:text-white text-center dark:border-yellow-900 text-center', 'value' => 'Edit'],
            ];

        }

        $table_class = "w-full";



        $context['user_values'] = [
            'table_class' => $table_class,
            'tableheaders' => $headers,
            'tablebody' => $user_array,
        ];



        return view('user.user-table', $context);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
