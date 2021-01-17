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
use App\Charge;

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


    public function remittance($id=false)
    {
        if (!Auth::check()) { return redirect()->back()->with('msg', 'Please login first!'); }
        $user_id = Auth::user()->id;
        $remittance =  DB::table('remittance')->orderBy('id', 'desc')->where('status', 1)->paginate(10);
        // dd($remittance);
        if(isset($_GET['status'])){
            //dd('fffffff');
        }
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

    public function notificationSeen(Request $request)
    {        
        $notification_id = $request->notification_id;        
        DB::table('notifications')
	              ->where('id', $notification_id)
	              ->update(['status'=>1]);        
    }

    public function manageCharges(Request $request, $charge=false)
    {   
        
        
            if($charge == true)
            {
                if(isset($request->title))
                    {
                        $data = array(
                            'title' =>$request->title,       
                            'title_bn' =>$request->title_bn,       
                            'bid_charge' =>$request->bid_charge,       
                            'service_charge_employee' =>$request->service_charge_employee,       
                            'security_deposit_employer' =>$request->security_deposit_employer,       
                            'budget_range' =>$request->budget_range       
                        );
            
                        $chageEdit = DB::table('charges')
                        ->where('id', $charge)
                        ->update($data);

                        if($chageEdit){
                            Session::flash('success', 'Post Update successfully!');
                            return redirect('bem-charge');
                        }else{
                            Session::flash('error', 'Sorry form submission fail!');
                            return redirect()->back();
                        }
                    }
                $charges =  DB::table('charges')
                        ->where('id', $charge)            
                        ->orderBy('id','desc')                    
                        ->first();
                return view('admin.charges.edit', compact('charges'));  
            }

            // charge update sql
        $charges =  DB::table('charges')            
                        ->orderBy('id','desc')                    
                        ->get();
        // dd($remittance);
        return view('admin.charges.index', compact('charges'));     
    }


    // settings method start

    public function manageSettings(Request $request, $setting=false)
    {   
        
        
            if($setting == true)
            {
                if(isset($request->title))
                    {
                        $data = array(
                            'title_key' =>$request->title_key,       
                            'title' =>$request->title,       
                            'value' =>$request->value      
                        );
            
                        $settingsEdit = DB::table('settings')
                        ->where('id', $setting)
                        ->update($data);

                        if($settingsEdit){
                            Session::flash('success', 'Post Update successfully!');
                            return redirect('bem-settings');
                        }else{
                            Session::flash('error', 'Sorry form submission fail!');
                            return redirect()->back();
                        }
                    }
                $setting_edit =  DB::table('settings')
                        ->where('id', $setting)            
                        ->orderBy('id','desc')                    
                        ->first();
                return view('admin.setting.edit', compact('setting_edit'));  
            }

            // charge update sql
        $settings =  DB::table('settings')            
                        ->orderBy('id','desc')                    
                        ->get();
        // dd($remittance);
        return view('admin.setting.index', compact('settings'));     
    }





    
 }
