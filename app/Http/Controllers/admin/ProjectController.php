<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;


use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\User;
use App\Categorie;
use App\Acl;
use App\Project;
use DB,Session,Auth;
use Illuminate\Routing\Route;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //project list
        $project = Project::all();
        //dd($categories);
        return view('admin.project.index', compact('project'));
        //return view('admin.category.index',compact('categories'));
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

        if(isset($_GET['status'])){
            $status = $_GET['status'];
        }
        $project_status = Project::find($id);
        $project_status->status = $status;
        

            if($project_status->save())
            {
                Session::flash('success', 'Project successfully updated!');
                return redirect('bem-projects');
            }else{
                Session::flash('error', 'Sorry updated fail!');
                return redirect()->back();
            }



        //edit project
        $project_edit = Project::find($id);
        //dd($project_edit);
        return view('admin.project.edit', compact('project_edit'));

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
        

        $data = Project::find($id);

         $this->validate($request, [
            'title' => 'required'
        ]);
        $data->title = $request->title;
        $data->discription = $request->discription;
        $data->skills = $request->skills;

        if($data->save())
        {
            Session::flash('success', 'Project successfully updated!');
            return redirect('bem-projects');
        }else{
            Session::flash('error', 'Sorry updated fail!');
            return redirect()->back();
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Project::find($id);

        if(Auth::user()->usertype !== 'admin')

        {

            return redirect('404');

        }

        $data->delete();
            return redirect('bem-projects')->with('success', 'Project deleted successfully!');
        }
}
