<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Office;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AssignmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        
    }

    public function index () 
    {
        // this function shows all assignments
        $users = User::where('id', '!=', auth()->user()->id)
            ->with('office', 'position')
            ->get();
        
    }

    public function edit (User $user)
    {

        // shows update user profile page 
        if (! Gate::allows('admin', $user)) {
            abort(403);
        }

        return "allowed";

       
    }

    public function update (User $user, Request $request,)
    {
        // updates user assignment details 

    }


}
