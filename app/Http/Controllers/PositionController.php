<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        
    }

    public function index () 
    {

    }

    public function create () 
    {
        
    }
}
