<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index () 
    {

    }

    public function assignUser(User $user)
    {

    }

    public function storeAssignUser(User $user, Request $request)
    {

    }
    
}
