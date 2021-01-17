<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator ;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session,Auth;
use App\Categorie;
use App\Project;
use App\Bid;
use App\User;

 class ShuvoController extends Controller
 {
    
    public function projectwin(Request $request)
    {   

        $p_id = $request->project_id;
        $b_id = $request->bid_id;
  
        DB::table('bids')
            ->where('id',$b_id)
            ->update(['win' => '1']);

        $bid_info = DB::table('bids')
            ->where('id',$b_id)
            ->first();

        DB::table('projects')
            ->where('id',$p_id)
            ->update(['hire_user' => $bid_info->user_id,'hire_value' => $bid_info->money,'win_bid_id' => $bid_info->id]);

        return Redirect::back()->with('message', 'update successfuly');

      
        return view('project_details');


    }
 }
