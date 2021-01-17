<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;


use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\User;
use App\Categorie;
use App\Acl;
use DB,Session,Auth;
use Illuminate\Routing\Route;

class CategoryController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */




    public function index(Request $request)

    {   
      if(isset($_GET['parent'])){
        $parent_id = $_GET['parent'];
      }else{
        $parent_id = 0;
      }

        //dd($_GET['parent']);
  
        $user_id = \Auth::user()->id;

        //DB::enableQueryLog();

          //$parent_id = 1;

          $categories = DB::table('categories')
            ->select('title','id', 'status',
                DB::raw("(SELECT COUNT(`id`) FROM `categories` cat WHERE `cat`.`parent_id`=`categories`.`id`) as subTotal"))
            ->where('parent_id','=', $parent_id)
            //->whereNull('usertype')
            ->orderBy('categories.title','ASC')
            ->get();


          //dd(DB::getQueryLog());

        //$subcategory = DB::table('projects_category');

        //dd($categories);

        return view('admin.category.index',compact('categories'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {
        $root_category = Categorie::where('parent_id', 0)->get();
        //dd($root_category);
        return view('admin.category.create', compact('root_category'));
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
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        $data = new Categorie();
        $cat_title = $request->title;
        $data->title = $cat_title;

        // seo title create

        $seo_title = str_replace(['& '],'',$cat_title);
        $seo_title = str_replace(['/',' ',','],'-',strtolower($seo_title));

        $data->title = $cat_title;

        if($request->parent_id){
          $data->parent_id = $request->parent_id;
        }

        
        $data->seo_title = $seo_title;
        $data->status = 1;

        if($data->save())
        {
            Session::flash('success', 'User create successfully completed!');
            return redirect('bem-categories');
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


    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */
 

    public function edit($id)
    {

      // if(isset($_GET['parent'])){
      //   $parent_id = $_GET['parent'];
      // }else{
      //   $parent_id = 0;
      // }



        
        if(isset($_GET['action']))
        {
            $data = Categorie::find($id);
            $data->status = $_GET['status'];
            $parentid = $data->parent_id;

            if($parentid != 0){
              $refirect_url = 'bem-categories?parent='.$parentid;
            }else{
              $refirect_url ='bem-categories';
            }
            
            if($data->save())
            {
                Session::flash('success', 'Categories successfully updated!');
                return redirect($refirect_url);
            }else{
                Session::flash('error', 'Sorry updated fail!');
                return redirect()->back();
            }
        }

        $item = DB::table('categories')
                ->where('id', $id)
                ->first();
        $root_category = DB::table('categories')
        ->where('parent_id', 0)
        ->get();



        return view('admin.category.edit',compact('item', 'root_category'));

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

      //dd($request);

      //"parent_id" => "5"
      //"title" => "Chemicals/Fertilizers/Paints/Dyes/gggg"

        $this->validate($request, [
            'title' => 'required'
        ]);


        // $data = DB::table('categories')
        //         ->where('id', $id)
        //         ->first();

        $data = Categorie::find($id);

        $title = $request->title;

        $seo_title = str_replace(['& '],'',$title);
        $seo_title = str_replace(['/',' ',','],'-',strtolower($seo_title));

        if($data->parent_id!=0){
          $data->parent_id = $request->parent_id;
          $refirect_url = 'bem-categories?parent='.$data->parent_id;
        } else {
          $refirect_url = 'bem-categories';
        }

        $data->title     = $request->title;
        $data->seo_title = $seo_title;
        //dd($data->title);

        if($data->save())
        {
            Session::flash('success', 'Category successfully updated!');
            return redirect($refirect_url);
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

        

        if(Auth::user()->usertype !== 'admin')

        {

            return redirect('404');

        }



        $item = Categorie::find($id);
        if($item->parent_id!=0){
          $redirect_url = 'bem-categories?parent='.$item->parent_id;
        }else{
          $redirect_url = 'bem-categories';
        }

        $item->delete();

        return redirect($redirect_url)->with('success', 'Category deleted successfully!');

    }



    public function team_activityreport()

    {



     // $where= "( YEAR(customers.created_at) <= YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(customers.created_at) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH) ";

      //$where = "  MONTH(customers.created_at) = MONTH(CURRENT_DATE) ) ";





      $where = "  customers.type != 'Others' ";



     // $where =



    // DB::enableQueryLog();

      $customer_list = DB::table('customers')

          ->join('users', 'users.id', '=', 'customers.created_by')

          ->select('customers.id as custids', 'users.id' , 'customers.status','customers.created_at' , 'customers.type')

          //->select('customers.id','customers.created_by as created_id','customers.organization','contacts.mobile as mobile','personals.name as name','personals.prefix','users.name as created_by')

          ->whereRaw($where)

         ->Paginate(1000)

          ->toArray();



      //dd(DB::getQueryLog());



      $user_list = DB::table('categories')->select('*')->get();



      $activity_list =array();

      $total_row =array();

      $total_row ['prev_prospect']=0;

      $total_row['current_prospect']=0;

      $total_row['client'] =0;

      $total_row['escaped']=0;

      $total_row['total']=0;

      foreach ($user_list as $user)

      {

        $data =array();

        $data['cid']=$user->id;

        $data['name']=$user->name;

        $data ['prev_prospect']=0;

        $data['current_prospect']=0;

        $data['client'] =0;

        $curr_escape = 0;



        foreach ( $customer_list['data'] as $c)

        {

          if($c->id == $user->id)

          {

            $now = date ('Y-m');

            $month = date('Y-m',strtotime($c->created_at));

            if($c->status == 0)

            {

                if($now==$month)

                {

                  $curr_escape++;



                }



            }

            else

            {

              if($c->type=="Prospect")

              {

                if($now == $month)

                {

                  $data['current_prospect']++;

                  $total_row['current_prospect']++;

                }

                else

                {

                  $data['prev_prospect']++;

                  $total_row['prev_prospect']++;

                }

              }

              else

              {

                $data['client']++;

                $total_row['client']++;



              }

            }





          }

        }

       // $diff = $prev_escape - $curr_escape;

        $data['escaped']=$curr_escape;

        $data['total'] = $data['prev_prospect']+$data['current_prospect']-$curr_escape;

        $total_row['escaped']+=$data['escaped'];

        $total_row['total']+=$data['total'];

        $activity_list[]=$data;



      }



          return view('admin.category.activity_report',compact('activity_list','total_row'));



    }





}

