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
		return view('index');
    }   
	
    public function projects(Request $request)
    {
        //  
        //$item = Student::find($student_id);

        $categories = Categorie::get();
       
        if(isset($request)){
             $projects = DB::table('projects')
                    ->where('title','Like','%'.$request->search. '%') 
                    ->get();
        }
        else {
             $projects = Project::get();
        }
              
        return view('projects', compact('categories', 'projects'));
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
        $link_array = explode('-',$name);
        $projectId = end($link_array);


        if(isset($request->money) && session('status'))
        {   
            //dd($request);
            
            $validator = Validator::make($request->all(), [
            'money' => 'required',
            'discription' => 'required',
            'days'=>'required'
            ]);
            
            if ($validator->fails()) {
                return redirect('projects/'.$name)
                            ->withErrors($validator)
                            ->withInput();
            }
        // if (session('status'))
            $user_id = Auth::user()->id;
           
            
            $data = array(
                'project_id' =>  $projectId ,
                'user_id' => $user_id,
                'money' => $request->money,
                'discription' => $request->discription,
                'days'=>$request->days        
                );
            DB::table('bids')->insert($data);

            $seo_name = '';
            
            return Redirect::to('projects/'.$name)->with('message', 'Project bid submission successfuly');
            
        }
                
        //return view('project_details');
        //exit;
        //$item = Student::find($student_id);
        $categories = Categorie::get();

        $project_info = Project::where('id', $projectId)->first();
 

       $bid_list = DB::table('bids')
            ->join ('users', 'users.id','=','bids.user_id')
            ->select('users.name', 'bids.*')
            ->where('bids.project_id', '=', $projectId)            
            ->get();



        //messaging details

        // $user_id = Auth::user()->id;
        // //$item = Student::find($student_id);

        //dd($messagingdata);

        return view('project_details', compact('categories', 'project_info','bid_list','user_id', 'projectId'));
        // //return view('project_details');

    }

    public function SingleCategory($cname)
        {
            $link_array = explode('-',$cname);
            $projectId = end($link_array);
            // $catProject = DB::table('projects')
            // ->join('categories', 'projects.category', '=', 'categories.id')
            // ->get();

            $catProject = DB::table('categories')
            ->join('projects', 'categories.id', '=', 'projects.category')
            ->where('categories.id', $projectId)
            ->get();

            $categories = Categorie::get();
            // return view('categoryProject');
            return view('categoryProject', compact('categories', 'catProject'));
      
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
    public function destroy($id)
    {
        //
    }
}
