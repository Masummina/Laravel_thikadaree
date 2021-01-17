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

class UserController extends Controller
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
    public function index(Request $request )
    {
		
		if(!Auth::check()) { return redirect()->back()->with('message', 'Please login first!'); }
		$categories = Categorie::get();
		$user_id = Auth::user()->id;

		if(isset($request->type) && $request->type =='employer')
		{
			
			$my_projectList = DB::table('projects')				
				->select('projects.*', DB::raw("(SELECT COUNT(`id`) FROM `bids` WHERE `project_id`=`projects`.`id`) as t_bid"))
				->where('projects.user_id', $user_id)				
				->get();
			//dd($my_projectList);	

			return view('customer.dashboard_employer', compact('categories', 'my_projectList'));

		} else {

			$projects = Project::get();
			$totalbids = DB::table('bids')->where('user_id',$user_id)->count();

			// live project start

			$liveprojectList = DB::table('projects')
			->Join('bids', 'projects.id', '=', 'bids.project_id')
			->select('projects.id','projects.joblocation','projects.title','projects.status','projects.close_date','projects.prebit_meeting','projects.min_budget','projects.max_budget','projects.created_at','bids.bid_amount','bids.created_at as biddate','bids.days')
			->where('bids.user_id', $user_id)
			->where('projects.status', 0)->get();
			
			// Active project start

			$activeProjectList = DB::table('projects')
			->Join('bids', 'projects.id', '=', 'bids.project_id')
			->select('projects.id','projects.joblocation','projects.title','projects.status','projects.close_date','projects.prebit_meeting','projects.min_budget','projects.max_budget','projects.created_at','projects.status','bids.bid_amount','bids.created_at as biddate','bids.days')
			->where('bids.user_id', $user_id)
			->where('bids.win', 1)
			->where('projects.win_bid_id', $user_id)->get();

			// dd($activeProjectList);

			// Archive project start

	        return view('customer.dashboard', compact('categories', 'projects', 'activeProjectList', 'liveprojectList'));

		}

	}
	

	// Servie controller start

		public function services(){

		}
	// Servie controller End




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
    	

		//dd($request);
		
		if(isset($request->title))
		{
			$project_budget =  $request->project_budget;
			//dd($project_budget);
			$budgetRequest = explode('-',$project_budget);
			$validator = Validator::make($request->all(), [
				'title' => 'required',
				'discription' => 'required',
				'project_budget' => 'required',
				'paycondition' => 'required',
				'joblocation' => 'required'
			]);
			
			if ($validator->fails()) 
			{
				return redirect('projects')
							->withErrors($validator)
							->withInput();
			}
			
			$user_id = Auth::user()->id;



			if ($request->hasFile('images')) 
			{
				$tor_files = [];
				$images = $request->file('images');
				if(isset($images[0]))
				{
					foreach($images as $image)
					{
						$rand = rand(1000,9999);
						$tor_file_name = (time()+$rand).'.'.$image->getClientOriginalExtension();
						$destinationPath = public_path('/images/tor');
						$image->move($destinationPath, $tor_file_name);
						$tor_files[] = $tor_file_name;
					}
				}
 			 	$tor_files = json_encode($tor_files);
				//dd($name);
			}else{
				$tor_files = '';
			}
			

			$project_all_cats = [];
			if(isset($request->sub_categories[0]))
			{
				$sub_categories = array_unique($request->sub_categories);
				
				foreach($sub_categories as $values){
					$sub_cat = $values;
					$sub_cat_info = DB::table('categories')->select('parent_id')->where('id',$sub_cat)->first();					 
					$project_all_cats[] = $sub_cat;
					$project_all_cats[] = $sub_cat_info->parent_id;
				}
				$project_all_cats = array_unique($project_all_cats);
			}


			$items = '';
			if(isset($request->items[0]))
			{
				 $item_array['items'] = $request->items;
				 $item_array['units'] = $request->units;
				 $item_array['quantity'] = $request->quantity;
				 $items = json_encode($item_array);
			}
 
			// exit();

			$data = array (
			'user_id' =>$user_id,
			'title' => $request->title,
			'category' => $request->category,
			'discription' => $request->discription,
			'area' => $request->area,
			'images' => $tor_files,
			'items' => $items,
			'paycondition' => $request->paycondition,
			'prebit_meeting' => $request->prebit_meeting,
			'experience' => $request->experience,
			'liquid_asset' => $request->liquid_asset,
			'charge_id' => $budgetRequest[0],
			'project_budget' => $budgetRequest[1],
			'open_date' => now(),
			'close_date' => $request->close_date,
			'district' => $request->district,
			'joblocation' => $request->joblocation,
			'skills' => $request->skills
		);

			//dd($data);

			DB::table('projects')->insert($data);

			$project_id = DB::getPdo()->lastInsertId();

			if(isset($project_all_cats[0]))
			{			 
				foreach($project_all_cats as $values){
				
						$proCat = array (
							'project_id' =>$project_id,
							'cat_id' =>$values,
						);
						DB::table('projects_category')->insert($proCat);
				}
			}
 
			return Redirect::to('post-a-project')->with('message', 'Project submission successfuly');
			
		}
		// Estimate Pudget query
		$budget = DB::table('charges')->get();

		$categories = Categorie::where('parent_id', 0)->get();
		//dd($categories);
				
		return view('customer.post_project', compact('categories', 'budget'));
    }


    public function profile(Request $request)
    {
		if (!Auth::check()) { return redirect()->back()->with('msg', 'Please login first!'); }
		$user_id = Auth::user()->id;
		//dd($request);
		// experience and education add query start
			if(isset($request->exp_title)){
				$validator = Validator::make($request->all(), [
					'exp_title' => 'required',
					'company_name' => 'required',
					'start_month' => 'required',
					'start_year' => 'required'
				]);

				if($validator->fails()){
					return Redirect::to('profile')->with('message', 'Profile update Fail');
				}
				$startDate = '';
				if(isset($request->start_month) && $request->start_year ){
					$startDate = $request->start_month .' '. $request->start_year;
					$endDate = 'Running';
				}
				
				if(isset($request->end_month) && $request->end_month ){
					$endDate = $request->end_month .' '. $request->end_month;
				}
				// dd($endDate);
				

				
				$data = array(
					'exp_edu_title' => $request->exp_title,
					'com_edu_name' => $request->company_name,
					'start_date' => $startDate,
					'end_date' => $endDate,
					'user_id' => $user_id,
					'exp_edu_summary' => $request->experience_summary,
					'type' => $request->profile_add_type
					
				);
				DB::table('userprofile')->insert($data);
			};

			// Education start


			if(isset($request->edu_country)){
				$validator = Validator::make($request->all(), [
					'edu_country' => 'required',
					'collage' => 'required',
					'degree' => 'required'
				]);

				if($validator->fails()){
					return Redirect::to('profile')->with('message', 'Education added  Fail');
				}
				
				$data = array(
					'country' => $request->edu_country,
					'exp_edu_title' => $request->collage,
					'com_edu_name' => $request->degree,
					'start_date' => $request->start_year,
					'end_date' => $request->end_year,
					'user_id' => $user_id,
					'type' => $request->post_type
					
				);
				DB::table('userprofile')->insert($data);
				return Redirect::to('profile')->with('message', 'Education added successfuly');
			};




		// experience and education add query End

         $useridd = Auth::user()->id;
        //$categories = Categorie::get();

        $userid = User::find($useridd);
        $userPro = DB::table('users')
        ->join('userprofile', 'users.id', '=', 'userprofile.user_id')
        ->where('users.id', $useridd)
		->first();
		$experience = DB::table('userprofile')->where('user_id', $useridd)->where('type', 'experience')->get();
		$education = DB::table('userprofile')->where('user_id', $useridd)->where('type', 'education')->get();
		//dd($education);

		
        return view('customer.profile', compact('userPro', 'experience', 'education'));
    }


    public function editUserprofile(Request $request)
    {
		//dd($request);
    	$categories = Categorie::get();
        $projects = Project::get();
        $user_id = Auth::user()->id;
        
        	// dd($request);
        if(isset($request->username)){
        	$validator = Validator::make($request->all(), [
            'username' => 'required',
			]);

			if ($validator->fails()) {
				return Redirect::to('editprofile')->withErrors($validator)->with('error', 'Profile Update is Fail');
				
			}

			
			$profile_info = DB::table('userprofile')->where('user_id',$user_id)->first();

			if ($request->hasFile('images')) {
		        $image = $request->file('images');
		        $name = time().'.'.$image->getClientOriginalExtension();
		        $destinationPath = public_path('/images/upload/profile');
		        $image->move($destinationPath, $name);
		        //dd($name);
		    }else{
		    	$name = $profile_info->images;
			}
			
			// trade image start

			if ($request->hasFile('trade_image')) {
		        $trade_image = $request->file('trade_image');
		        $trade_image_name = 'trade'.time().'.'.$trade_image->getClientOriginalExtension();
		        $destinationPath = public_path('/images/upload/cartificate');
		        $trade_image->move($destinationPath, $trade_image_name);
		        //dd($name);
		    }else{
		    	$trade_image_name = $profile_info->trade_image;
			}
			
			// vat image start

			if ($request->hasFile('vat_image')) {
		        $image = $request->file('vat_image');
		        $vat_image = 'vat'.time().'.'.$image->getClientOriginalExtension();
		        $destinationPath = public_path('/images/upload/cartificate');
		        $image->move($destinationPath, $vat_image);
		        //dd($name);
		    }else{
		    	$vat_image = $profile_info->vat_image;
			}

			// tin_image image start

			if ($request->hasFile('tin_image')) {
		        $image = $request->file('tin_image');
		        $tin_image = 'tin'.time().'.'.$image->getClientOriginalExtension();
		        $destinationPath = public_path('/images/upload/cartificate');
		        $image->move($destinationPath, $tin_image);
		        //dd($name);
		    }else{
		    	$tin_image = $profile_info->tin_image;
			}

			// pwd_image image start

			if ($request->hasFile('pwd_image')) {
		        $image = $request->file('pwd_image');
		        $pwd_image = 'pwd'.time().'.'.$image->getClientOriginalExtension();
		        $destinationPath = public_path('/images/upload/cartificate');
		        $image->move($destinationPath, $pwd_image);
		        //dd($name);
		    }else{
		    	$pwd_image = $profile_info->pwd_image;
			}

			// other_image image start

			if ($request->hasFile('other_image')) {
		        $image = $request->file('other_image');
		        $other_image = 'other'.time().'.'.$image->getClientOriginalExtension();
		        $destinationPath = public_path('/images/upload/cartificate');
		        $image->move($destinationPath, $other_image);
		        //dd($name);
		    }else{
		    	$other_image = $profile_info->other_image;
			}

		    
		    $data = array(
		    	'details' => $request->details,
				'address' => $request->address,
				'images' => $name,
				'mobile' => $request->mobile,
				'district'  => $request->district,
				'professional' => $request->professional, 
				'skills' => $request->skills,
				'liquid_asset' => $request->liquid_asset,
				'trade_name' => $request->trade_name,
				'trade_image' => $trade_image_name,
				'vat_name' => $request->vat_name,
				'vat_image' => $vat_image,
				'tin_name' => $request->tin_name,
				'tin_image' => $tin_image,
				'pwd_name' => $request->pwd_name,
				'pwd_image' => $pwd_image,
				'other_name' => $request->other_name,
				'other_image' => $other_image,

		    );
			
			
			if(isset($profile_info->user_id)){

				/// Update
				DB::table('userprofile')
	              ->where('user_id', $user_id)
	              ->update($data);

			} else {
				DB::table('userprofile')->insert($data);


			}


			$data2 = DB::table('users')
	              ->where('id', $user_id)
	              ->update(['name' => $request->username]);

				return Redirect::to('profile')->with('message', 'Profile update successfuly');
	        }

	    $user_id = Auth::user()->id;
	    $profile_info = DB::table('userprofile')->where('user_id',$user_id)->first();
        return view('customer.edit_profile', compact('profile_info'));
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

	public function usermessage(Request $request, $user_name=false, $project_name=false)
	{


	     	
	     	if(isset($user_name)){
	     		$user_nameId = explode('-', $user_name);
	     		$user_nameId = end($user_nameId);
	     	}
	     	if(isset($project_name)){
	     		$project_name = explode('-', $project_name);
	     		$project_Id = end($project_name);
	     	}


	     	$auth_id = Auth::user()->id;

     		if(isset($_GET['bider_id'])){
     			$bider_id = $_GET['bider_id'];
          		$pro_id = $_GET['pro_id'];
     		}
     		if(isset($request->message)){
     			$validator = Validator::make($request->all(), [
	            'message' => 'required'
	            ]);

     			$data = array(
                'project_id' =>  $project_Id,
                'message_from' => $auth_id,
                'message_to' => $user_nameId,
                'status' => 1,
                'message_content' => $request->message       
                );
	     		DB::table('messages')->insert($data);
     		}


     		
	     	
	     	// 
	        $bider_info = DB::table('users')
	                      ->where([
	                      ['id', '=', $user_nameId]])
	                      ->first();
	        $bider_id = $bider_info->id;              
	        // ['project_id', '=', $project_Id]
	     	$messages = DB::table('messages')
                    ->whereRaw(" message_from = $auth_id OR message_from = $bider_id")
                    ->whereRaw("message_to = $auth_id OR message_to = $bider_id")
                    ->orderBy('id', 'desc')
                    ->get();

	         //dd($messageTo);

            

                  // dd($messageForm);
	    	return view('customer.message', compact('messages', 'bider_info'));
	     }


	     public function edit_bid(Request $request, $name){
	     	
	     	$editUrl = $request->url();
	     	$editUrl = explode('-', $editUrl);
	     	$editUrl_projectID = end($editUrl);
	     	$userId = $request->userid;

	     	// dd($editUrl_projectID);

	     	 $bidEdit_info = DB::table('bids')
            ->where('user_id',$userId)
            ->where('project_id',$editUrl_projectID)
            ->first();

	     	// dd($bidEdit_info);

	     	return view('project_details', compact('bidEdit_info'));

	     }

		 public function transaction(Request $request)
		 {

			if (!Auth::check()) { return redirect()->back()->with('msg', 'Please login first!'); }
			$auth_id = Auth::user()->id;

			$notification_text = DB::table('settings')
				->where('title_key','add_money_request_text')
				->first();

			if(isset($notification_text->value) && $notification_text->value) 
			{				
				$notification_content['notification_text'] = $notification_text->value;
				$notification_content['action_url'] = 'bem-transaction';
				$notification_content['user_id'] = '1';
			} 

			if(isset($request->wit_amount))
			{
				
				$notification_text = DB::table('settings')
					->where('title_key','withdrawal_money_request_text')
					->first();

				if(isset($notification_text->value) && $notification_text->value) 
				{				
					$notification_content['notification_text'] = $notification_text->value;
					$notification_content['action_url'] = 'bem-transaction';
					$notification_content['user_id'] = '1';
				}
				
				$validator = Validator::make($request->all(), [
					'wit_amount' => 'required'
				]);
				
				if ($validator->fails()) {
					return Redirect::to('transaction')->with('error', 'Witdrawal Fail');
				}

				$balance = User::GetCurrentBalance();
				$amount = (int) $request->wit_amount;

				if ( $amount < 10 || $balance < $amount ) {
					return Redirect::to('transaction')->with('error', 'Invalid withdrawal amount ');
				}

				$data = array(
					'particulars' => 'Withdrawal',
					'bank_name' =>  Auth::user()->bankInfo,
					'txn_date'  => Date('Y/m/d'),
					'transaction_id'  => rand(1000,10000),
					'user_id'  => $auth_id,
					'remarks' => 'Witdrawal request from user',
					'amount' => $amount,
					'trans_type' => $request->trans_type,
					'status' => '0',
					'narration' => 'Withdrawal request'
				);
				DB::table('transactions')->insert($data);
				
				User::SendNotification($notification_content);

				return Redirect::to('transaction')->with('success', 'Your withdrawal request successfully received!');

			}
			

			if(isset($request->bank_name))
			{
									
				$validator = Validator::make($request->all(), [
					'branch_name' => 'required',
					'amount' => 'required',
					'deposit_num' => 'required',
					'txn_date' => 'required',
					'deposit_slip' => 'required',
					'deposit_num' => 'required'
				]);

				if ($validator->fails()) {
					return Redirect::to('transaction')->with('error', 'Deposit added Fail');
				}
				
				if ($request->hasFile('deposit_slip')) 
				{
					$deposit_slips = '';
					$images = $request->file('deposit_slip');
					if(isset($images[0]))
					{
						foreach($images as $image)
						{
							$rand = rand(1000,9999);
							$deposit_slip_file_name = (time()+$rand).'.'.$image->getClientOriginalExtension();
							$destinationPath = public_path('/images/depositSlip');
							$image->move($destinationPath, $deposit_slip_file_name);
							$deposit_slips .= $deposit_slip_file_name.',';
						}
					}
					$deposit_slips = rtrim($deposit_slips , ',');			 
					//dd($name);
				}else{
					$deposit_slips = '';
				}

				if ($deposit_slips == '') {
					return Redirect::to('transaction')->with('error', 'Invalid deposit slip ');
				}
				
				$amount = (int) $request->amount;

				if ( $amount < 100 ) {
					return Redirect::to('transaction')->with('error', 'Invalid deposit amount ');
				}
				
				$data = array(
					'particulars' => $request->paymentmethod,
					'bank_name' => $request->bank_name,
					'deposit_slip' => $deposit_slips,
					'txn_date'  => $request->txn_date,
					'branch_name'  => $request->branch_name,
					'user_id'  => $auth_id,
					'transaction_id' => $request->deposit_num,
					'remarks' => 'Add deposit from bank',
					'amount' => $amount ,
					'trans_type' => $request->trans_type,
					'narration' => 'Add Money',
					'status' => '0'
				);
				DB::table('transactions')->insert($data);
				User::SendNotification($notification_content);
				return Redirect::to('transaction')->with('success', 'Your deposit request successfuly done!');
				

				
			} elseif(isset($request->bkash_amount)) {

				$validator = Validator::make($request->all(), [
					'bkash_amount' => 'required' 
				]);

				if ($validator->fails()) {
					return Redirect::to('transaction')->with('error', 'Deposit added Fail');
				}

				$amount = (int) $request->bkash_amount;

				if ( $amount < 50 ) {
					return Redirect::to('transaction')->with('error', 'Invalid deposit amount ');
				}

				/********** API request ***********/
				
				/************ After success return *********/
				$transaction_id = rand(1000,99999);
				$data = array(
					'particulars' => $request->paymentmethod,
					'bank_name' => 'Bkash',
					'deposit_date'  => Date('Y/m/d'),
					'txn_date'  => Date('Y/m/d'),
					'transaction_id'  => $transaction_id,
					'user_id'  => $auth_id,
					'remarks' => 'Add deposit from bKash',
					'amount' => $amount ,
					'trans_type' => $request->trans_type,
					'status' => '1',
					'narration' => 'Add Money'
				);
				$txn_id = DB::table('transactions')->insertGetId($data);


				/************ After success return *********/
				$remittance_data = array(
					'vch_type' => 'Receive',
					'vch_no' => $transaction_id,
					'credit_amount' => $amount,
					'particulars' => 'bKash Payment',
					'txn_date'  => Date('Y/m/d'),
					'narration'  => 'Add Money',
					'user_id'  => $auth_id,
					'remarks' => 'Add deposit from bKash',
					'transaction_id' => $txn_id ,
					'status' => '1',
					'narration' => 'Add Money'
				);
				DB::table('remittance')->insert($remittance_data);
				/************ End *********/

				//User::SendNotification($notification_content);
				return Redirect::to('transaction')->with('success', 'Deposit added successfuly');
			}

			$transaction = DB::table('transactions')->where('user_id', $auth_id)->orderBy('id', 'DESC')->get();
			//dd($transaction);
			return view('customer.transaction', compact('transaction'));
			
	}

}
