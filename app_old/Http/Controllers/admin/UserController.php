<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;


use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\User;
use App\Acl;
use DB,Session,Auth;
use Illuminate\Routing\Route;

class UserController extends Controller
{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */




    public function index(Request $request)

    {        

        //dd($request->all());
  
        $user_id = \Auth::user()->id;


        $user_list = DB::table('users')
            //->where('usertype','!=','admin')
            //->whereNull('usertype')
            ->orderBy('users.id','DESC')
            ->get();


            //dd($user_list);

        return view('admin.user.index',compact('user_list'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()
    {

        return view('admin.user.create');
    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)
    {

        //dd($team_id);
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = new User();
 
        $data->name = $request->name;
        $data->usertype = $request->usertype;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->status = 1;

        if(isset($request->photo) && $request->photo!='')
        {
            $img = 'user_pic_'.time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('../property/img'), $img);
            $data->photo = $img;
        }

        if($data->save())
        {
            Session::flash('success', 'User create successfully completed!');
            return redirect('bem-users');
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

        $item = User::where(['id' => $id])->first();

        return view('admin.user.edit',compact('item'));

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

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required'
        ]);



        $is_email= DB::table('users')
            ->select('*')
            ->whereRaw('`email`='."'".$request->email."'".' AND `id`!='.$id)
            ->get();


        if(count($is_email)>0)
        {
            Session::flash('error', 'Email "'.$request->email.'" already exist!');
            return redirect()->back();
        }

        $data = User::find($id);


        $data->name = $request->name;
        $data->usertype = $request->usertype;
        $data->email = $request->email;

        if(isset($request->photo) && $request->photo!='')
        {
            $img = 'user_pic_'.time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('../property/img'), $img);
            $data->photo = $img;
        }


        if(isset($request->password) && strlen($request->password)>5)
        {
            $data->password = bcrypt($request->password);
        }

        if($data->save())
        {
            Session::flash('success', 'user successfully updated!');
            return redirect('bem-users');
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

        if(AclController::uacl(Auth::user()->id)==false){                   

            return redirect('access-denied')->with('error', 'Access Denied, You don’t have permission to access');

        }

        

        if(Auth::user()->group_id==4 || Auth::user()->group_id==3)

        {

            return redirect('404');

        }

        $item = User::find($id);

        $item->delete();

        return redirect('users')->with('success', 'User deleted!');

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



      $user_list = DB::table('users')->select('*')->get();



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



          return view('admin.user.activity_report',compact('activity_list','total_row'));



    }





}

