<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

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
        $runnig_projects = DB::table('projects')
            ->where('status', '=' , 0)
            ->count();   

        return view('admin.index', compact('runnig_projects'));

    }
        // remittance section 


    public function remittance()
    {
        if (!Auth::check()) { return redirect()->back()->with('msg', 'Please login first!'); }
        $user_id = Auth::user()->id;
        $remittance =  DB::table('remittance')->orderBy('id','desc')->where('status', 1)->paginate(10);
        // dd($remittance);
        return view('admin.transaction.remittance', compact('remittance'));
    }

    public function notification()
    {        
        $user_id = Auth::user()->id;
        $notifications =  DB::table('notifications')
                        ->where('user_id', $user_id)    
                        ->orderBy('id','desc')                    
                        ->paginate(50);
        // dd($remittance);
        return view('admin.notifications', compact('notifications'));
    }

    

    public function manageCharges(Request $request)
    {        
        $charges =  DB::table('charges')            
                        ->orderBy('id','desc')                    
                        ->get();
        // dd($remittance);
        return view('admin.charges.index', compact('charges'));     
    }


    
 }
