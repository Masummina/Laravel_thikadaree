<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session,Auth;
use App\Project;
use App\Bid;
use App\User;

 class AdminController extends Controller
 {
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function Index(Request $request)
    {   
 

        return view('project_details');

    }
 }
