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
use App\Message;
use App\User;

class IndexController extends Controller
{
    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $homeneed = DB::table('posts')
            ->where('posts.post_type', '=', 'home_need')
            ->limit(4)->get();

        $homeinfo = DB::table('posts')->get();

        $homebenefit = DB::table('posts')
        ->where('posts.post_type', '=', 'benefit')
        ->get();
        //dd($homebenefit);

        $homeproject = DB::table('projects')
        ->where('projects.status', '=', 0)
        ->limit(6)->get();

        $home_categories = DB::table('categories')->where('parent_id', 0)->get();

        //dd($home_categories);
        return view('index', compact('homeneed', 'homebenefit', 'homeproject', 'home_categories', 'homeinfo'));
        
    }   

    // Something need

    public function somethingNeed($name=false)
    {
            $link_array = explode('-',$name);
            $needId = end($link_array);
            $neesomething = DB::table('posts')
            ->where('posts.id', $needId)
            ->first();
            // dd($neesomething);
  

            return view('customer.needDetails', compact('neesomething'));
    }
	
    public function jobscc(Request $request, $parms)
    {
        //dd($parms);

        $category_info = DB::table('categories')
            ->where('seo_title', $parms)
            ->first();
        if(isset($category_info->id) && $category_info->id !='')
        {
            echo $this->SingleCategory($parms);
        } else {
            echo $this->ProjectDetails($request,$parms);
        }
        
    }

    public function jobs(Request $request, $category=false)
    {

        if($category==true)
        {
            $category_info = DB::table('categories')
                ->where('seo_title', $category)
                ->first();


            if(isset($category_info->id))
            {
                $sub_categories = DB::table('categories')
                                ->select('id')
                                ->where('parent_id', $category_info->id)
                                ->get();
                $all_cats[] = $category_info->id;
                foreach($sub_categories as $val) {
                    $all_cats[] = $val->id;
                } 

                //dd($all_cats);
                DB::enableQueryLog();
                
                $projects = DB::table('projects')
                    ->select('projects.*')
                    ->join('projects_category', 'projects.id', '=', 'projects_category.project_id')
                    ->whereIn('projects_category.cat_id', $all_cats)
                    ->paginate(20);

                //dd(DB::getQueryLog());

                //dd($projects);

                $total_jobs = DB::table('projects')
                    ->select(DB::raw('count(id) as total_jobs'))
                    ->where('category', '=', $category_info->id)
                    ->get(); 
            }  else {
                return $this->ProjectDetails($request, $category);  
            } 
  
               

        } else {

            if(isset($request->search)) 
            {
                $projects = DB::table('projects')
                    ->where('title','Like','%'.$request->search. '%') 
                    ->orderBy('id', 'DESC')
                    ->paginate(20);

            } elseif(isset($_GET['location'])){
                $location = $_GET['location'];
                $location = explode(',', $location);
                $projects = DB::table('projects')
                    ->whereIn('district', $location)
                    ->orderBy('id', 'DESC')
                    ->paginate(20);
            }
            
            
            else {
                $projects = DB::table('projects')
                    ->orderBy('id', 'DESC')
                    ->paginate(20);
            }

        }

        
        
        $categories = Categorie::where('parent_id', 0)->get();
   
        $recent_project = DB::table('projects')->orderBy('id', 'DESC')->limit(3)->get();

        // get all district

        $all_district = DB::table('projects')
                        ->select('district')
                        ->distinct()
                        ->get();

                       // dd($all_district);

        return view('projects', compact('categories', 'projects', 'recent_project', 'all_district'));
    }
	
	public function about()
    {
        //		
		return view('about');
    }	
	
	public function welcome()
    {
        //		
		return view('welcome');
    }

    public function ProjectDetails(Request $request, $name)
    {   

        

         // dd($request);
        if(isset(Auth::user()->id)){
            $user_id = Auth::user()->id;
        }
        
        $link_array = explode('-',$name);
        $projectId = end($link_array);

        $project_info = DB::table('projects')->where('id', $projectId)->first();
 

        if(!isset($project_info->title))
        {   
            Session::flash('error', 'Sorry content not found!');         
            return redirect()->back();
        }

        if(isset($request->comment))
        {
            if (!Auth::check()) { return redirect()->back()->with('msg', 'Please login first!'); }

            $date = date("F d, Y h:i:s A");
            $user_id = Auth::user()->id;
            $data = Project::find($projectId);
            $comment = $request->comment;
            
            $pre_comment = array();
            if(strlen($project_info->comment)>3)
            {                
                $pre_comment = array_values(json_decode($project_info->comment, true));
            } 
            //echo "<pre>";
            //print_r($pre_comment);

            //echo "<br>";
            $comments[] = ["user_id"=>$user_id,"comments"=>$comment,'time'=>$date];
            if(isset($pre_comment[0]))
            {
                foreach ($pre_comment as $key => $value) {
                    $comments[] = $value;
                }
            }
             

            // dd($comments);

            $data->comment = json_encode($comments);

            if($data->save()){
                Session::flash('success', 'Post Update successfully!');
                return redirect('jobs/'.$name);
            }else{
                Session::flash('error', 'Sorry form submission fail!');
                return redirect()->back();
            }
        }

        /******** Comment Reply ********/
        if(isset($request->reply))
        {
            $date = date("F d, Y h:i:s A");
            $data = Project::find($projectId);
            $reply = $request->reply;
            $cid = $request->cid;
            
            $pre_comment = array();
            if(strlen($project_info->comment)>3)
            {                
                $pre_comment = array_values(json_decode($project_info->comment, true));
            } 
           // echo "<pre>";
           // print_r($pre_comment);

            //echo "<br>";

            
            if(isset($pre_comment[0]))
            {
                foreach ($pre_comment as $key => $value) {
                    $comments[] = $value;
                    if($key == $cid){
                        $comments[] = ["user_id"=>$user_id,"reply"=>$reply,'time'=>$date, 'cid'=> $cid];
                    }
                }
            }
             

            // dd($comments);

            $data->comment = json_encode($comments);

            if($data->save()){
                Session::flash('success', 'Post Update successfully!');
                return redirect('jobs/'.$name);
            }else{
                Session::flash('error', 'Sorry form submission fail!');
                return redirect()->back();
            }
        }
        /******** Comment Reply END ********/

        // $data = $request->session('status');

        // dd($data);

        /******** Bid update ********/
        $link_array = explode('-',$name);
        $projectId = end($link_array);
        $reqUrl=$request->url();
        if(isset($request->updatemoney) && $request->session('status'))
        {
            $editUrl = $request->url();
            $editUrl = explode('-', $editUrl);
            $editUrl_projectID = end($editUrl);
            $userId = $request->userid;

            $data = array(
                'project_id' =>$editUrl_projectID,
                'user_id' => $userId,
                'bid_amount' => $request->updatemoney,
                'discription' => $request->discription,
                'days'=>$request->days        
            );

            $bidEdit_info = DB::table('bids')
            ->where('user_id',$userId)
            ->where('project_id',$editUrl_projectID)
            ->update($data);
            return Redirect::to('projects/'.$name)->with('message', 'Updated successfuly');
        }

        /******** Bid update End ********/

        /******** Bid submit Proposal********/
        if(isset($request->proposal_file))
        { 
           
            if (!Auth::check()) { return redirect()->back()->with('msg', 'Please login first!'); }
            $user_id = Auth::user()->id;
            $validator = Validator::make($request->all(), [
                'proposal_file' => 'required'
                ]);

            // Proposal file
            
            // if($request->hasFile('proposal_file')){
		    //     $image = $request->file('proposal_file');
		    //     $vat_image ='PRO'.time().'.'.$image->getClientOriginalExtension();
		    //     $destinationPath = public_path('/images/upload/proposal');
		    //     $image->move($destinationPath, $vat_image);
		    //     //dd($name);
            // }

            
            if ($request->hasFile('proposal_file')) 
			{
				$tor_files = [];
				$images = $request->file('proposal_file');
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


            $data = array(
                'project_id' =>  $request->project_id,
                'discription' =>  $request->discription,
                'user_id' => $user_id,
                'proposal'=>$tor_files       
                );
            $submit = DB::table('bids')->insert($data);
            if($submit){
                return Redirect::to('job-details/'.$name)->with('message', 'Project bid submission successfuly' );
            }
            
            

         }

        /******** Bid submit ********/
        if(isset($request->BidAmount) && $request->session('status'))
        {   
             
            if (!Auth::check()) { return redirect()->back()->with('msg', 'Please login first!'); }

            $validator = Validator::make($request->all(), [
                'BidAmount' => 'required',
                'discription' => 'required',
                'delivary_time'=>'required'
                ]);
            
            if ($validator->fails()) {
                return redirect('jobs/'.$name)
                            ->withErrors($validator)
                            ->withInput();
            }

            //dd($request);

            $reqUrl=$request->url();
            $urlExp = explode('-', $reqUrl);
            $projectId = end($urlExp);
            
            // check bid permition

            $permission = User::CheckBidSubmit($projectId);

            if($permission == false){
                return redirect()->back();
            }
                        
            // if (session('status'))
            $user_id = Auth::user()->id;


            // bid unit section start



            $items = '';
			if(isset($request->items_title) OR isset($request->items)) 
			{
				 $item_array['items_title'] = $request->items_title;
				 $item_array['items_quantity'] = $request->items_quantity;
				 $item_array['items_unit'] = $request->items_unit;
				 $item_array['unit_price'] = $request->unit_price;
				 $item_array['items'] = $request->items;
				 $item_array['units'] = $request->units;
				 $item_array['quantity'] = $request->quantity;
				 $item_array['amount'] = $request->amount;
				 $items = json_encode($item_array);
            }

            
             // bid unit section End

 
            $data = array(
                'project_id' =>  $projectId,
                'user_id' => $user_id,
                'bid_amount' => $request->BidAmount,
                'unit_price' => $items,
                'discription' => $request->discription,
                'days'=>$request->delivary_time        
                );
            DB::table('bids')->insert($data);

            $seo_name = '';
            
            return Redirect::to('jobs/'.$name)->with('message', 'Project bid submission successfuly' );
            
        }

        /******** Bid submit end ********/
                
        //return view('project_details');
        //exit;
        //$item = Student::find($student_id);
        $categories = Categorie::where('parent_id', 0)->get();
        $bid_list = DB::table('bids')
            ->join ('users', 'users.id','=','bids.user_id')
            ->select('users.name', 'bids.*')
            ->where('bids.project_id', '=', $projectId)            
            ->get();
            //dd($bid_list);

        $project_client = DB::table('userprofile')
            ->join ('users', 'users.id','=','userprofile.user_id')
            ->where('users.id', '=', $project_info->user_id)
            ->first();

        $client_name = DB::table('users')
        ->where('users.id', '=', $project_info->user_id)
        ->first();

        //dd($client_name);

        $recent_project = DB::table('projects')
        ->where('projects.user_id', '=', $project_info->user_id)
        ->orderBy('id', 'DESC')->limit(3)->get();

        // Child category list

        $project_categories = DB::table('projects_category')
            ->select('cat_id')
            ->where('project_id', '=', $project_info->id)
            ->get();
        //dd($project_categories);
        $categories = [];
        foreach ($project_categories as $key => $value) {
                $categories[] = $value->cat_id;
            }    

        $related_project = DB::table('projects')
            ->join ('projects_category', 'projects.id','=','projects_category.project_id')
            ->whereIn('projects_category.cat_id', $categories)
            ->limit(3)
            ->get();

          // dd($related_project);
    
        return view('project_details', compact('categories', 'project_info','bid_list', 'projectId', 'project_client', 'recent_project', 'client_name','related_project'));
        // //return view('project_details');

    }

    // How it work start

    public function howWork(){
        return view('how_work');
    }

    // project win method

    public function projectwin(){
        if(isset($_GET['project_id'])){
            $projectID = $_GET['project_id'];
            $userID = $_GET['bid_id'];

            $affected = DB::table('projects')
                ->where('id', $projectID)
                ->update(['status' => 1, 'win_bid_id'=> $userID]);
            }
            return Redirect::to('jobs');
    }

    public function SingleCategory($seo_title)
    {
        //echo $cname; exit;

            $category_info = DB::table('categories')
                ->where('seo_title', $seo_title)
                ->first();
  
            $catProject = DB::table('categories')
                ->join('projects', 'categories.id', '=', 'projects.category')
                ->where('categories.id', $category_info->id)
                ->get();

            $categories = Categorie::get();
            // return view('categoryProject');
            return view('projects', compact('categories', 'catProject'));
      
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploaddata()
    {
        //echo "uploaddata";
		
		$parent_id = 20;
		
		$myfile = fopen("H:/XAMPP_NEW/htdocs/thikadary/tenderBazar/20.txt", "r") or die("Unable to open file!");
		// Output one line until end-of-file
		while(!feof($myfile)) {
			$cat_title = fgets($myfile);
		  
			$seo_title = str_replace(['& '],'',$cat_title);
			$seo_title = str_replace(['/',' ',','],'-',strtolower($seo_title));

			if($parent_id!=0){
				$last_id = DB::table('categories')->orderBy('id', 'desc')->first();
				$seo_title = $seo_title.'-'.($last_id->id+1); 
			} 
			
			//echo $seo_title; exit;
		  
			$data = array (
				'parent_id' =>$parent_id,
				'title' => $cat_title,
				'seo_title' => $seo_title,
				'status' => 1);
			
			DB::table('categories')->insert($data);
		}
		fclose($myfile);
    }
}
