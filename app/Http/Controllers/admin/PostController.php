<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Faker\Provider\DateTime;
use App\User;
use App\Categorie;
use App\Acl;
use App\Project;
use App\Post;
use DB,Session,Auth;
use Illuminate\Routing\Route;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        if(isset($_GET['location'])){
            $url_parameter = $_GET['location'];
            $url_parameter = explode(',', $url_parameter);
            $post = DB::table('posts')->whereIn('post_type', $url_parameter)->paginate(15);;
        }else{
            $post = DB::table('posts')->paginate(15);
           
        }
        return view('admin.post.index', compact('post'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //dd($request);
            // $validator = Validator::make($request->all(), [
            // 'title'     => 'required|max:255',
            // 'post_type' => 'required',
            // 'discription' => 'required',
            // 'image' => 'required'
            // ]);

              $this->validate($request, [
                'title'     => 'required|max:255',
                'post_type' => 'required',
                'discription' => 'required',
                'short_discription' => 'required',
                'image' => 'required'
            ]);

            // if ($validator->fails()) {
            //     return redirect('bem-posts')
            //                 ->withErrors($validator)
            //                 ->withInput();
            // }


            if($request->hasFile('image')){
                $image = $request->file('image');
                $name =$request->post_type.'_'.time().'.'.$image->getClientOriginalExtension();
                $destination = public_path('/images/post');
                $image->move($destination, $name);
            }


            $data = new Post();
            //insert post

            $data->title = $request->title;
            $data->parent_id = 0;
            $data->discription = $request->discription;
            $data->short_desc = $request->short_discription;
            $data->post_type = $request->post_type;
            $data->image = $name;

        //dd($request);

            if($data->save())
                {
                    Session::flash('success', 'Post create successfully completed!');
                    return redirect('bem-posts');
                }else{
                    Session::flash('error', 'Sorry form submission fail!');
                    return redirect()->back();
                }


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
        $post_edit = Post::find($id);
        //enable and disable
        $status = 1;
        if(isset($_GET['action'])){
            $status = $_GET['status'];
            $post_edit->status = $status;
           if($post_edit->save())
            {
                Session::flash('success', 'Status successfully updated!');
                return redirect('bem-posts');
            }else{
                Session::flash('error', 'Sorry updated fail!');
                return redirect()->back();
            }
        }






        
        return view('admin.post.edit', compact('post_edit'));
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
            $data = Post::find($id);
            $this->validate($request, [
                'title'     => 'required|max:255',
                'post_type' => 'required',
                'discription' => 'required',
                'short_discription' => 'required',
            ]);

             if($request->hasFile('image')){
                $image = $request->file('image');
                $name =$request->post_type.'_'.time().'.'.$image->getClientOriginalExtension();
                $destination = public_path('/images/post');
                $image->move($destination, $name);
            }else{
                $name = $data->image;
            }

            $data->title = $request->title;
            $data->discription = $request->discription;
            $data->post_type = $request->post_type;
            $data->short_desc = $request->short_discription;
            $data->image = $name;

            if($data->save()){
                Session::flash('success', 'Post Update successfully!');
                return redirect('bem-posts');
            }else{
                Session::flash('error', 'Sorry form submission fail!');
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
        //
        $item = Post::find($id);

        $item->delete();

        return redirect('bem-posts')->with('success', 'Category deleted successfully!');
    }
}
