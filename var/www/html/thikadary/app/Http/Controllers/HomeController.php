<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session,Auth;
use App\Categorie;
use App\Project;
use App\User;
use App\Userprofile;
use App\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$categories = Categorie::get();
        $projects = Project::get();
        return view('customer.dashboard', compact('categories', 'projects'));
    }
	
	// public function profile()
 //    {
 //        return view('customer.profile');
 //    }

    public function MyProject()
    {
    	//	
		//$item = Student::find($student_id);
		$categories = Categorie::get();
		$user_id = Auth::user()->id;
        $projects = Project::where('user_id',$user_id)->get();
		//dd($categories); 

		return view('customer.MyProjects', compact('categories', 'projects'));
        //return view('customer.MyProjects');
    }

	
	public function PostProject(Request $request)
    {
        
		if(isset($request->title))
		{	
			//dd($request);
			
			$validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'discription' => 'required',
            'skills' => 'required'
			]);
			
			if ($validator->fails()) {
				return redirect('post-a-project')
							->withErrors($validator)
							->withInput();
			}

			$user_id = Auth::user()->id;

			
			$data = array(
				'user_id' => $user_id,
				'title' => $request->title,
				'discription' => $request->discription ,
				'skills'  => $request->skills,
				'fixed_budget' => $request->fixed_budget 
				);
			DB::table('projects')->insert($data);
			
			return Redirect::to('post-a-project')->with('message', 'Project submission successfuly');
			
		}
				
		return view('customer.post_project');
    }


    public function profile()
    {
        // return view('customer.profile');
        // $catProject = DB::table('projects')
        // ->join('categories', 'projects.category', '=', 'categories.id')
        // ->get();
         $useridd = Auth::user()->id;
        //$categories = Categorie::get();

        $userid = User::find($useridd);
        $userPro = DB::table('users')
        ->join('userprofile', 'users.id', '=', 'userprofile.user_id')
        ->where('users.id', $useridd)
        ->first();

        // return view('categoryProject');
        return view('customer.profile', compact('userPro'));
        //return view('categoryProject', compact('categories', 'catProject'));
    }


    public function editUserprofile(Request $request)
    {
    	$categories = Categorie::get();
        $projects = Project::get();
        	// dd($request);
        if(isset($request->username)){
        	
        	$validator = Validator::make($request->all(), [
            'username' => 'required',
            'images' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'district' => 'required',
            'skills' => 'required'
			]);

			if ($validator->fails()) {
				return redirect('profile')
					->withErrors($validator)
					->withInput();
			}

			$user_id = Auth::user()->id;

			$profile_info = DB::table('userprofile')->where('user_id',$user_id)->first();
			if(isset($profile_info->user_id)){

				/// Update
				$data = DB::table('userprofile')
	              ->where('user_id', $user_id)
	              ->update([
					'details' => $request->details,
					'address' => $request->address,
					'images' => $request->images,
					'mobile' => $request->mobile,
					'district'  => $request->district,
					'skills' => $request->skills 
				]);

			} else {
				DB::table('userprofile')->insert($data);


			}


			$data2 = DB::table('users')
	              ->where('id', $user_id)
	              ->update(['name' => $request->username]);

				return Redirect::to('profile')->with('message', 'Profile update successfuly');
	        }


        return view('customer.edit_profile');
    }


    public function Members($name2=false)
    {
    	
    	if($name2==true)
    	 {

    		$link_array = explode('-',$name2);
		    $userId = end($link_array);
		     //dd($muserId);
	 		
	 		// $userprofile = DB::table('userprofile')->where('user_id',$userId)->first();


	 		$memberprofile = DB::table('users')
            ->leftJoin('userprofile', 'userprofile.user_id', '=', 'users.id')
            ->select('users.id','users.name','users.email','userprofile.mobile','userprofile.address','userprofile.details','userprofile.skills','userprofile.district', 'userprofile.images')
            ->where('users.id',$userId)->first();
	 //    $userprofile = Project::where('user_id',$user_id)->get();

			// dd($memberprofile);

	 		if($memberprofile){
	 			return view('customer.member', compact('memberprofile'));
	 		}else{
	 			 return Redirect::to('users')->with('message', 'Your searching value in invalid');
	 		}

 			}
	        
    	
    }

     public function Allmembers()
	    {

		$allmembers = DB::table('users')
            ->leftJoin('userprofile', 'userprofile.user_id', '=', 'users.id')
            ->select('users.id','users.name','users.email','userprofile.mobile','userprofile.address','userprofile.details','userprofile.skills','userprofile.district', 'userprofile.images')->get();

		return view('customer.members', compact('allmembers'));

	    	
	    }




	     public function usermessage(Request $request, $memberid)
	     {
	     	$user_id = Auth::user()->id;
	     	$sentID = $memberid;
     		if(isset($_GET['pid'])){
     			$proid = $_GET['pid'];
          $proUderId = $_GET['prouid'];
     		}
     		if(isset($request->messagewrite)){

     			$validator = Validator::make($request->all(), [
	            'messagewrite' => 'required'
	            ]);

     			$data = array(
                'project_id' =>  $proid ,
                'message_from' => $user_id,
                'messate_to' => $sentID,
                'status' => 1,
                'messageall' => $request->messagewrite       
                );
	     		DB::table('messages')->insert($data);
     		}


     		
	     	
	     	// dd($user_id);
        $projectUserid = DB::table('users')
                      ->where([
                      ['id', '=', $proUderId]])
                      ->first();

	     	$messageTo = DB::table('messages')
                    ->where([
                      ['messate_to', '=', $user_id],
                      ['project_id', '=', $proid],
                    ]) 

                    // ('messate_to', $user_id) 
                    // ->where('project_id', $proid)
                    ->get();
        //dd($messageTo);

	     	$messageForm = DB::table('messages')
                     ->where([
                      ['message_from', '=', $user_id],
                      ['project_id', '=', $proid]
                    ]) 

                    ->get();
                    
                    // dd($messageForm);
            

                  // dd($messageForm);
	    	return view('customer.message', compact('messageForm', 'messageTo', 'projectUserid'));
	     }



}
