<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountableForm;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        
    }

    public function store(AccountableForm $accountableForm, Request $request)
    {

        // dd ($request);
        // dd (auth());
        $save = $request->user()->comments()->create([
            'body' => $request->comment,            
            'accountable_form_id' => $accountableForm->id
        ]);

        return redirect()->back()->with('success', 'Comment Added');

    }
}
