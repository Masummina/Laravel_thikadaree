@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header clearfix">
        <h1 class="pull-left">  Activity Report </h1>
        @php
           $group_id = \Auth::user()->group_id;
           DB::enableQueryLog();
           $report_date = '';
           if(isset($_GET['report_from']))
               $report_from = $_GET['report_from'];
           else
               $report_from = date("Y-m-d");
           if(isset($_GET['report_to']))
               $report_to = $_GET['report_to'];
           else
               $report_to = date("Y-m-d");
           if($report_from==$report_to)
           {
              $report_date = $report_from;
           }
        @endphp
          <div class="row">
              <div class="col-xs-12">
                @if (Session::has('msg') && Session::get('msg')!='')
                    <div class="alert alert-info">{{ Session::get('msg') }}</div>    
                @endif
            <form method="get" class="  form-inline my-2 my-lg-0" action="">
              <div class="row mt-1">
                  <div class="col-sm-5">
                      <span class="report-headline"> Select Date : </span>
                      From <input name="report_from" type="date"  class="form-control" value="{{@$_GET["report_from"]}}">
                      To <input name="report_to" type="date"  class="form-control" value="{{@$_GET["report_to"]}}">
                  </div>
                  <div class="col-sm-2">
                      <input  type="submit" class="btn btn-primary" value=" Search " name="submit">
                  </div>
              </div>
          </form>
          <p class="pull-right">  &nbsp;&nbsp;&nbsp;
                <span class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" > <i class="glyphicon glyphicon-cog"> Activity Report Setup </i> </span>
                <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_able')"> <i class="glyphicon glyphicon-print"> Print </i> </span>
                <span title="Download" class="btn btn-primary" onclick="wordDownload('print_able')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
          </p>
          </div>
       </div>
      </section>
      
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body" style="overflow: scroll;">
                @if(session()->has('success'))
                   <div class="alert alert-success">
                      {{ session()->get('success') }}
                   </div>
                @endif
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="col-md-12">
                  <div class="row clearfix" id="print_able">
                      <div class="box-header with-border" style="width:1791px;  text-align: center">
                          <h3 class="box-title" style="font-weight: bold; font-size: 20px; margin: 0; margin-bottom: -10px;">
                              {!! Config('app.project_name'); !!}
                          </h3><br/>
                          <h3 class="box-title" style="font-size: 16px; margin: 0; margin-bottom: 10px;">{!! Config('app.project_address'); !!}</h3>
                      </div>
                      <div style="width:1791px;  text-align: center; padding: 5px; background-color: #9ad717; font-size: 17px; font-weight: bold;">
                          Team Activities Report for {!! date("j F Y",strtotime($report_from)) !!} to {!! date("j F Y",strtotime($report_to)) !!}
                      </div>
                      
                            
                      <table class="table  ">
                          
                          <thead>
                          <tr>
                              <th rowspan="2" >Team </th>
                              <th rowspan="2">S# </th>
                              <th rowspan="2">Execution Person </th>
                              <th rowspan="2"> In-hand Call Report </th>
                              <th rowspan="2"> New Gener </th>
                              <th rowspan="2"> Total Call Report </th>
                              <th colspan="4" style="text-align: center;"> Call To </th>
                              <th colspan="4" style="text-align: center;"> Call Received </th>
                              <th colspan="4" style="text-align: center;"> Project Visit </th>
                              <th colspan="4" style="text-align: center;"> External Visit </th>
                              <th colspan="4" style="text-align: center;"> Internal Visit </th>
                              <th rowspan="2"> Total Visit </th>
                              <th rowspan="2"> Last Sale Date </th>
                              <th rowspan="2"> Day Gap </th>
                              <th colspan="3" style="text-align: center;"> Sale Status </th>
                          </tr>
                          <tr>
                              <th > Prev.  </th>
                              <th > Exist Pros. </th>
                              <th > Exist Client </th>
                              <th > Total Call To </th>
                              <th > Prev. </th>
                              <th > Exist Pros. </th>
                              <th > Exist Client </th>
                              <th > Total Call Recei.</th>
                              <th > Prev. </th>
                              <th > Exist Pros. </th>
                              <th > Exist Client </th>
                              <th > Total Proj. Visit</th>
                              <th > Prev. </th>
                              <th > Exist Pros. </th>
                              <th > Exist Client </th>
                              <th > Total Ext. Visit </th>
                              <th > Prev. </th>
                              <th > Exist Pros. </th>
                              <th > Exist Client </th>
                              <th > Total Int. Visit</th>
                              <th > Last Sale </th>
                              <th > Curr. Sale </th>
                              <th > Total Sale</th>
                          </tr>
                          </thead>
                          <tbody>
                        @php
 
                           $teams = DB::table('users')
                               ->select('team_id',
                                   DB::raw("(SELECT `name`  FROM `teams` WHERE `id`=`users`.`team_id` LIMIT 1) as team_name")
                               )
                               ->whereRaw('status=1 AND team_id>0')
                               ->groupBy('team_id')
                               ->get();
                            $ihcr = 0;
                            $ng = 0;
                            $tcr = 0;
                            $ctp = 0;
                            $ctep = 0;
                            $ctec = 0;
                            $cttc = 0;
                            $crp = 0;
                            $crep = 0;
                            $crec = 0;
                            $crtc = 0;
                            $pvp = 0;
                            $pvep = 0;
                            $pvec = 0;
                            $pvtp = 0;
                            $evp = 0;
                            $evep = 0;
                            $evec = 0;
                            $evte = 0;
                            $ivp = 0;
                            $ivep = 0;
                            $ivec = 0;
                            $ivti = 0;
                            $tv = 0;
                            $lsd = 0;
                            $dg = 0;
                            $ssls = 0;
                            $sscs = 0;
                            $ssts = 0;
                            $modal_td ='';
                            @endphp
                                @foreach($teams as $t)
                                    @php
                                    $team_id = $t->team_id;
                                    $team_members = DB::table('users')
                                        //->select('name','id')
                                        ->whereRaw('status=1 AND team_id='.$team_id)
                                        ->get();
                                    $j=1;
                                    $total_member = count($team_members);
                                    $InHandCall_T = 0;
                                    $NewCall_T = 0;
                                    $InHand_plus_New_T = 0;
                                    $call_to_previuos_T = 0;
                                    $call_to_exist_pros_T = 0;
                                    $call_to_exist_client_T = 0;
                                    $call_to_T = 0;
                                    $call_Rec_previuos_T = 0;
                                    $call_Rec_exist_pros_T = 0;
                                    $call_Rec_exist_client_T = 0;
                                    $call_Rec_T = 0;
                                    $V_to_P_previuos_T = 0;
                                    $V_to_P_exist_pros_T = 0;
                                    $V_to_P_exist_client_T = 0;
                                    $V_to_P_T = 0;
                                    $E_V_previuos_T = 0;
                                    $E_V_exist_pros_T = 0;
                                    $E_V_exist_client_T = 0;
                                    $E_V_T = 0;
                                    $I_V_previuos_T = 0;
                                    $I_V_exist_pros_T = 0;
                                    $I_V_exist_client_T = 0;
                                    $I_V_exist_T = 0;
                                    $grand_total = 0;
                                    $sales_last_T = 0;
                                    $sales_current_T = 0;
                                    $sales_T = 0;  
 
                                    $report_from_back_1 = date('Y-m-d',strtotime($report_from . "-1 days"));
                                    @endphp
                                    @foreach($team_members as $m)
                                        @php
                                            $user_id = $m->id;
                                            $from = date("Y-01-01");
                                            $to = date('Y-m-d',strtotime($report_date . "-1 days"));
                                            $tt=0;
                                          
                                            if($report_date=='')
                                            {
                                                                                                    
                                                $InHandCall = DB::table('customers')
                                                ->selectRaw('count(id) as in_hand_call')
                                                ->whereRaw("date(created_at)<='".$report_to."' ")
                                                ->whereRaw("created_by=".$user_id)
                                                ->whereRaw("status=1")
                                                ->first(); //if($user_id == 17) dd($InHandCall); 
                                                $NewCall = DB::table('customers')
                                                ->selectRaw('count(id) as new_call')
                                                ->whereRaw("date(created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("created_by=".$user_id)
                                                ->first();
                                                $Y = date("Y",strtotime($report_date));
                                                $report_year_first_day = $Y."01-01";
                                                /************* Call To *************/
                                                $call_to_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_year_first_day."' and '".$report_from_back_1."'")
                                                ->whereRaw("activities.contact_method='Call to'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $call_to_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("activities.contact_method='Call to'")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $call_to_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("activities.contact_method='Call to'")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                /************* Call received *************/
                                                $call_Rec_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_year_first_day."' and '".$report_from_back_1."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $call_Rec_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $call_Rec_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                /************* Visit to Project *************/
                                                $V_to_P_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_year_first_day."' and '".$report_from_back_1."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $V_to_P_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $V_to_P_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                /********** External Visit,Visit to Home,Both **********/
                                                $E_V_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_year_first_day."' and '".$report_from_back_1."'")
                                                ->whereRaw("(`contact_method` LIKE '%both%' or `contact_method` LIKE '%home%' or `contact_method` LIKE '%office%')")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $E_V_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("(`contact_method` LIKE '%both%' or `contact_method` LIKE '%home%' or `contact_method` LIKE '%office%')")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $E_V_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("(`contact_method` LIKE '%both%' or `contact_method` LIKE '%home%' or `contact_method` LIKE '%office%')")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                /************* Internal Visit *************/
                                                $I_V_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_year_first_day."' and '".$report_from_back_1."'")
                                                ->whereRaw("`contact_method` LIKE '%Internal%' ")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $I_V_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("`contact_method` LIKE '%Internal%' ")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $I_V_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at) between '".$report_from."' and '".$report_to."'")
                                                ->whereRaw("`contact_method` LIKE '%Internal%' ")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $from = date("Y-01-01");
                                                $to = date('Y-m-d',strtotime($report_from . "-1 days"));
                                                $sales_last = DB::table('accounts')
                                                ->selectRaw('count(id) as total')
                                                ->whereRaw("saler_id=".$user_id)
                                                ->whereRaw("date(created_at) between '".$from."' and '".$to."'")
                                                ->first();
                                                $sales_current = DB::table('accounts')
                                                ->selectRaw('count(id) as total')
                                                ->whereRaw("saler_id=".$user_id)
                                                ->whereRaw("date(created_at)='".$report_date."'")
                                                ->first();
                                            } else {
                                                $report_date_1_day_back = date('Y-m-d',strtotime($report_date . "-1 days"));
                                                $InHandCall = DB::table('customers')
                                                ->selectRaw('count(id) as in_hand_call')
                                                ->whereRaw("date(created_at)<='".$report_date_1_day_back."' ")
                                                ->whereRaw("created_by=".$user_id)
                                                ->whereRaw("status=1")
                                                ->first();
                                                $NewCall = DB::table('customers')
                                                ->selectRaw('count(id) as new_call')
                                                ->whereRaw("date(created_at)='".$report_date."'")
                                                ->whereRaw("created_by=".$user_id)
                                                ->first();
                                                $YM = date("Y-m",strtotime($report_date));
                                                $report_month_first_day = $YM."-01";
                                                /************* Call To *************/
                                                $call_to_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_month_first_day."' and '".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call to'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $call_to_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call to'")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $call_to_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call to'")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                /************* Call Received *************/
                                                $call_Rec_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_month_first_day."' and '".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $call_Rec_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $call_Rec_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                /************* Visit to Project *************/
                                                $V_to_P_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_month_first_day."' and '".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $V_to_P_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $V_to_P_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("activities.contact_method='Call received'")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                /********** External Visit,Visit to Home,Both **********/
                                                $E_V_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_month_first_day."' and '".$report_date."'")
                                                ->whereRaw("(`contact_method` LIKE '%both%' or `contact_method` LIKE '%home%' or `contact_method` LIKE '%office%')")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $E_V_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("(`contact_method` LIKE '%both%' or `contact_method` LIKE '%home%' or `contact_method` LIKE '%office%')")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $E_V_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("(`contact_method` LIKE '%both%' or `contact_method` LIKE '%home%' or `contact_method` LIKE '%office%')")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                /************* Internal Visit *************/
                                                $I_V_previuos = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as previuos')
                                                ->whereRaw("date(activities.created_at) between '".$report_month_first_day."' and '".$report_date."'")
                                                ->whereRaw("`contact_method` LIKE '%Internal%' ")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $I_V_exist_pros = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_pros')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("`contact_method` LIKE '%Internal%' ")
                                                ->whereRaw("customers.type='Prospect'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $I_V_exist_client = DB::table('activities')
                                                ->join ('customers','customers.id','=','activities.customer_id')
                                                ->selectRaw('count(activities.id) as exist_client')
                                                ->whereRaw("date(activities.created_at)='".$report_date."'")
                                                ->whereRaw("`contact_method` LIKE '%Internal%' ")
                                                ->whereRaw("customers.type='Client'")
                                                ->whereRaw("activities.created_by=".$user_id)
                                                ->first();
                                                $from = date("Y-01-01");
                                                $to = date('Y-m-d',strtotime($report_date . "-1 days"));
                                                $sales_last = DB::table('accounts')
                                                ->selectRaw('count(id) as total')
                                                ->whereRaw("saler_id=".$user_id)
                                                ->whereRaw("date(created_at) between '".$from."' and '".$to."'")
                                                ->first();
                                                $sales_current = DB::table('accounts')
                                                ->selectRaw('count(id) as total')
                                                ->whereRaw("saler_id=".$user_id)
                                                ->whereRaw("date(created_at)='".$report_date."'")
                                                ->first();
                                            }
                                            $last_sale_date = DB::table('accounts')
                                                ->selectRaw('created_at')
                                                ->whereRaw("saler_id=".$user_id)
                                                ->orderBy('created_at','desc')
                                                ->first();
 
                                            //if(isset($last_sale_date->created_at))
                                            if($m->last_sale_date !='0000-00-00') 
                                            {
                                                //$Last_Sale_Date = date("j F, y", strtotime($last_sale_date->created_at));
                                                $Last_Sale_Date = date("j F, y", strtotime($m->last_sale_date)); 
                                                $Days_Gap = round(abs(time()-strtotime($m->last_sale_date))/86400);
                                            } else {
                                                $Last_Sale_Date = '--';
                                                $Days_Gap = '--';
                                            }
                                            $total = $call_to_exist_pros->exist_pros+$call_to_exist_client->exist_client;
                                            $total += $call_Rec_exist_pros->exist_pros+$call_Rec_exist_client->exist_client;
                                            $total += $V_to_P_exist_pros->exist_pros+$V_to_P_exist_client->exist_client;
                                            $total += $E_V_exist_pros->exist_pros+$E_V_exist_client->exist_client;
                                            $total += $I_V_exist_pros->exist_pros+$I_V_exist_client->exist_client;
                                            $InHandCall_T += $InHandCall->in_hand_call;
                                            $NewCall_T += $NewCall->new_call;
                                            $InHand_plus_New_T += $InHandCall->in_hand_call+$NewCall->new_call;
                                            $call_to_previuos_T += $call_to_previuos->previuos;
                                            $call_to_exist_pros_T += $call_to_exist_pros->exist_pros;
                                            $call_to_exist_client_T += $call_to_exist_client->exist_client;
                                            $call_to_T += $call_to_exist_pros->exist_pros+$call_to_exist_client->exist_client;
                                            $call_Rec_previuos_T += $call_Rec_previuos->previuos;
                                            $call_Rec_exist_pros_T += $call_Rec_exist_pros->exist_pros;
                                            $call_Rec_exist_client_T += $call_Rec_exist_client->exist_client;
                                            $call_Rec_T += $call_Rec_exist_pros->exist_pros+$call_Rec_exist_client->exist_client;
                                            $V_to_P_previuos_T += $V_to_P_previuos->previuos;
                                            $V_to_P_exist_pros_T += $V_to_P_exist_pros->exist_pros;
                                            $V_to_P_exist_client_T += $V_to_P_exist_client->exist_client;
                                            $V_to_P_T += $V_to_P_exist_pros->exist_pros+$V_to_P_exist_client->exist_client;
                                            $E_V_previuos_T += $E_V_previuos->previuos;
                                            $E_V_exist_pros_T += $E_V_exist_pros->exist_pros;
                                            $E_V_exist_client_T += $E_V_exist_client->exist_client;
                                            $E_V_T += $E_V_exist_pros->exist_pros+$E_V_exist_client->exist_client;
                                            $I_V_previuos_T += $I_V_previuos->previuos;
                                            $I_V_exist_pros_T += $I_V_exist_pros->exist_pros;
                                            $I_V_exist_client_T += $I_V_exist_client->exist_client;
                                            $I_V_exist_T += $I_V_exist_pros->exist_pros+$I_V_exist_client->exist_client;
                                            $grand_total += $total;
                                            // Force Update below two variable
                                            $sales_last->total = $m->last_sale;
                                            $sales_current->total = $m->curr_sale;
                                            $sales_last_T += $sales_last->total;
                                            $sales_current_T += $sales_current->total;
                                            $sales_T += $sales_last->total+$sales_current->total;
                                             
                                            $modal_td .='<tr>';   
                                            $modal_td .='<td><strong>'.$t->team_name.'</strong> </td>';   
                                            $modal_td .='<td><strong>'.$m->name.'</strong> </td>';
                                            $modal_td .='<td><input type="date" class="form-control" value="'.$m->last_sale_date.'" name="last_sale_date['.$m->id.']" ></td>';
                                            $modal_td .='<td><input type="text" class="form-control" value="'.$m->last_sale.'" name="last_sale['.$m->id.']" ></td>';
                                            $modal_td .='<td><input type="text" class="form-control" value="'.$m->curr_sale.'" name="curr_sale['.$m->id.']" ></td>';
                                            $modal_td .='</tr>';
                                            
                                        @endphp
                                        <tr>
                                            @if($j==1) <td rowspan="{!! $total_member !!}"> <strong> {!! $t->team_name !!} </strong> </td> @endif
                                            <td>{!! $j++ !!} </td>
                                            <td class="td-rd"><strong> {!! $m->name !!} </strong>   </td>
                                            <td>{!! $InHandCall->in_hand_call !!}  </td>
                                            <td>{!! $NewCall->new_call !!}  </td>
                                            <td class="td-rd"><strong>{!! $InHandCall->in_hand_call+$NewCall->new_call !!}</strong>  </td>
                                            <td>{!! $call_to_previuos->previuos !!} </td>
                                            <td>{!! $call_to_exist_pros->exist_pros !!} </td>
                                            <td>{!! $call_to_exist_client->exist_client !!} </td>
                                            <td class="td-rd"><strong>{!! $call_to_exist_pros->exist_pros+$call_to_exist_client->exist_client !!}</strong> </td>
                                            <td>{!! $call_Rec_previuos->previuos !!} </td>
                                            <td>{!! $call_Rec_exist_pros->exist_pros !!} </td>
                                            <td>{!! $call_Rec_exist_client->exist_client !!} </td>
                                            <td class="td-rd"><strong>{!! $call_Rec_exist_pros->exist_pros+$call_Rec_exist_client->exist_client !!}</strong> </td>
                                            <td>{!! $V_to_P_previuos->previuos !!} </td>
                                            <td>{!! $V_to_P_exist_pros->exist_pros !!} </td>
                                            <td>{!! $V_to_P_exist_client->exist_client !!} </td>
                                            <td class="td-rd"><strong>{!! $V_to_P_exist_pros->exist_pros+$V_to_P_exist_client->exist_client !!}</strong> </td>
                                            <td>{!! $E_V_previuos->previuos !!} </td>
                                            <td>{!! $E_V_exist_pros->exist_pros !!} </td>
                                            <td>{!! $E_V_exist_client->exist_client !!} </td>
                                            <td class="td-rd"><strong>{!! $E_V_exist_pros->exist_pros+$E_V_exist_client->exist_client !!}</strong> </td>
                                            <td>{!! $I_V_previuos->previuos !!} </td>
                                            <td>{!! $I_V_exist_pros->exist_pros !!} </td>
                                            <td>{!! $I_V_exist_client->exist_client !!} </td>
                                            <td class="td-rd">{!! $I_V_exist_pros->exist_pros+$I_V_exist_client->exist_client !!} </td>
                                            <td> <strong> {!! $total !!} </strong>   </td>
                                            <td> {!! $Last_Sale_Date !!}  </td>
                                            <td class="td-rd"> {!! $Days_Gap !!}  </td>
                                            <td> <strong>{!! $sales_last->total !!}</strong> </td>
                                            <td> {!! $sales_current->total !!} </td>
                                            <td> <strong>{!! $sales_last->total+$sales_current->total !!}</strong> </td>
                                        </tr>
                                    @endforeach
                                    @php
                                        $ihcr =  $ihcr + $InHandCall_T ;
                                        $ng = $ng + $NewCall_T;
                                        $tcr = $tcr + $InHand_plus_New_T;
                                        $ctp = $ctp + $call_to_previuos_T;
                                        $ctep = $ctep + $call_to_exist_pros_T;
                                        $ctec = $ctec + $call_to_exist_client_T;
                                        $cttc = $cttc + $call_to_T;
                                        $crp = $crp + $call_Rec_previuos_T;
                                        $crep = $crep + $call_Rec_exist_pros_T;
                                        $crec = $crec + $call_Rec_exist_client_T;
                                        $crtc = $crtc + $call_Rec_T;
                                        $pvp = $pvp + $V_to_P_previuos_T;
                                        $pvep = $pvep + $V_to_P_exist_pros_T;
                                        $pvec = $pvec + $V_to_P_exist_client_T;
                                        $pvtp = $pvtp + $V_to_P_T;
                                        $evp = $evp + $E_V_previuos_T;
                                        $evep = $evep + $E_V_exist_pros_T;
                                        $evec = $evec + $E_V_exist_client_T;
                                        $evte = $evte + $E_V_T;
                                        $ivp = $ivp + $I_V_previuos_T;
                                        $ivep = $ivep + $I_V_exist_pros_T;
                                        $ivec = $ivec + $I_V_exist_client_T;
                                        $ivti = $ivti + $I_V_exist_T;
                                        $tv = $tv + $grand_total;
                                        //$lsd = $lsd + ;
                                        //$dg = $dg + ;
                                        $ssls = $ssls + $sales_last_T;
                                        $sscs = $sscs + $sales_current_T;
                                        $ssts = $ssts + $sales_T;
 
                                    @endphp
                                        <tr style="background-color: #eeeeee;">
                                            <td colspan="3" class="td-rd" style="text-align: center"> <strong>Total</strong>    </td>
                                            <td><strong>{!! $InHandCall_T !!} </strong> </td>
                                            <td><strong>{!! $NewCall_T !!} </strong> </td>
                                            <td class="td-rd"><strong>{!! $InHand_plus_New_T !!}</strong>  </td>
                                            <td><strong>{!! $call_to_previuos_T !!}</strong> </td>
                                            <td><strong>{!! $call_to_exist_pros_T !!} </strong></td>
                                            <td><strong>{!! $call_to_exist_client_T !!} </strong></td>
                                            <td class="td-rd"><strong>{!! $call_to_T !!}</strong> </td>
                                            <td><strong>{!! $call_Rec_previuos_T !!} </strong></td>
                                            <td><strong>{!! $call_Rec_exist_pros_T !!}</strong> </td>
                                            <td><strong>{!! $call_Rec_exist_client_T !!}</strong> </td>
                                            <td class="td-rd"><strong>{!! $call_Rec_T !!}</strong> </td>
                                            <td><strong>{!! $V_to_P_previuos_T !!} </strong></td>
                                            <td><strong>{!! $V_to_P_exist_pros_T !!}</strong> </td>
                                            <td><strong>{!! $V_to_P_exist_client_T !!}</strong> </td>
                                            <td class="td-rd"><strong>{!! $V_to_P_T !!}</strong> </td>
                                            <td><strong>{!! $E_V_previuos_T !!}</strong> </td>
                                            <td><strong>{!! $E_V_exist_pros_T !!} </strong></td>
                                            <td><strong>{!! $E_V_exist_client_T !!}</strong> </td>
                                            <td class="td-rd"><strong>{!! $E_V_T !!}</strong> </td>
                                            <td><strong>{!! $I_V_previuos_T !!} </strong></td>
                                            <td><strong>{!! $I_V_exist_pros_T !!}</strong> </td>
                                            <td><strong>{!! $I_V_exist_client_T !!}</strong> </td>
                                            <td class="td-rd"><strong>{!! $I_V_exist_T !!}</strong> </td>
                                            <td> <strong> {!! $grand_total !!} </strong>   </td>
                                            <td> --  </td>
                                            <td class="td-rd"> --  </td>
                                            <td> <strong> {!! $sales_last_T !!} </strong> </td>
                                            <td> <strong>{!! $sales_current_T !!}</strong> </td>
                                            <td> <strong> {!! $sales_T !!} </strong> </td>
                                        </tr>
                                @endforeach
                               <tr>
                                   <td colspan="3" ><strong> Grand Total </strong></td>
                                   <td ><strong>{{ $ihcr }}</strong></td>
                                   <td ><strong>{{ $ng }}</strong></td>
                                   <td ><strong>{{ $tcr }}</strong></td>
                                   <td ><strong>{{ $ctp }}</strong></td>
                                   <td ><strong>{{ $ctep }}</strong></td>
                                   <td ><strong>{{ $ctec }}</strong></td>
                                   <td ><strong>{{ $cttc }}</strong></td>
                                   <td ><strong>{{ $crp }}</strong></td>
                                   <td ><strong>{{ $crep }}</strong></td>
                                   <td ><strong>{{ $crec }}</strong></td>
                                   <td ><strong>{{ $crtc }}</strong></td>
                                   <td ><strong>{{ $pvp }}</strong></td>
                                   <td ><strong>{{ $pvep }}</strong></td>
                                   <td ><strong>{{ $pvec }}</strong></td>
                                   <td ><strong>{{ $pvtp }}</strong></td>
                                   <td ><strong>{{ $evp }}</strong></td>
                                   <td ><strong>{{ $evep }}</strong></td>
                                   <td ><strong>{{ $evec }}</strong></td>
                                   <td ><strong>{{ $evte }}</strong></td>
                                   <td ><strong>{{ $ivp }}</strong></td>
                                   <td ><strong>{{ $ivep }}</strong></td>
                                   <td ><strong>{{ $ivec }}</strong></td>
                                   <td ><strong>{{ $ivti }}</strong></td>
                                   <td ><strong>{{ $tv }}</strong></td>
                                   <td ><strong>--</strong></td>
                                   <td ><strong>--</strong></td>
                                   <td ><strong>{{ $ssls }}</strong></td>
                                   <td ><strong>{{ $sscs }}</strong></td>
                                   <td ><strong>{{ $ssts }}</strong></td>
                               </tr>
                      </tbody>
                  </table>
                  </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Activities Report Setup  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/activity-report-setup-update') }}" method="POST">
                <div class="modal-body">
                         
    
                        <div class="panel-body">
                                                          
                            <table id="myTable" class="table table-striped table-hover clearfix" style="width: 100%">
                                <thead>
                                <tr>
                                  
                                    <th width="12%"> Team  </th>
                                    <th width="24%"> Execution Person  </th>
                                    <th width="20%"> Last Sale Date  </th>
                                    <th width="20%"> Last Sale </th>
                                    <th width="20%"> Curr. Sale </th>
                                </tr>
                                </thead>
                                <tbody>
                                   {!! $modal_td !!}   
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
            </div>
        </div>
    </section>
      <style>
        .right_btn {
              float: right;
              margin: 10px 5px 10px 10px;
          }
        .bg-green { background-color: #398439 }
        .bg-red { background-color: #c12e2a }
        .bg-yellow { background-color: #9ad717 }
        .flate-box { height: 80px; width: 100%; margin-bottom: 6px; text-align: center; padding-top: 10px; font-size: 16px; }
          table tr td{
              text-align: center;
          }
      </style>
  <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection    