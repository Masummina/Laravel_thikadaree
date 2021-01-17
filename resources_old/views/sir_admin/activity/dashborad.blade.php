@extends('admin.layouts.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

     <section class="content-header clearfix">

        <h1 class="pull-left">  Dashboard </h1>

        @php

            $group_id = \Auth::user()->group_id;

            $download_link = url('dashboard-report-download');

        @endphp



         <p class="pull-right" >  &nbsp;&nbsp;&nbsp;

             <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_able')" > <i class="glyphicon glyphicon-print"  > </i> </span>

             <a title="Download" href="{!! $download_link !!}" target="_blank" class="btn btn-success" >  <i class="glyphicon glyphicon-download-alt"  > </i> </a>

         </p>



         <form method="get" class="pull-right form-inline my-2 my-lg-0" action="">

         <!-- Admin & Superadmin -->

         @if($group_id==1||$group_id==2)



            @if($teams)

                <span class="report-headline">  Search by Team </span>

                <select name="team" class="form-control" id="exampleSelect1" >

                  <option> All Team </option>

                     @foreach ($teams as $team)

                        <option @if(@$_GET["team"]==$team->id) selected @endif value="{{$team->id}}">{{$team->name}}</option>

                     @endforeach

                </select>

            @endif

         @endif



            @if(count($team_memebers)>1 && Auth::user()->group_id<4)



                @php if(!isset($_GET["user"])) $_GET["user"]= Auth::user()->id; @endphp

                <span class="report-headline"> Member </span>

                <select name="user" class="form-control" id="exampleSelect1" >

                    <option value="all" > All Member</option>

                    @foreach ($team_memebers as $team)

                        <option @if(@$_GET["user"]==$team->id) selected @endif value="{{$team->id}}">{{$team->name}}</option>

                    @endforeach

                </select>



            @endif

            <input name="search" type="submit" class="btn btn-primary" value="Search">

         </form>



      </section>

      

      

      <section class="content">

      <div class="row">

        <div class="col-xs-12">

          <div class="box">



            <!-- /.box-header -->

            <div class="box-body">



                @if(session()->has('success'))

                   <div class="alert alert-success">

                      {{ session()->get('success') }}

                   </div>

                @endif



                @if(session()->has('message'))

                    <div class="alert alert-danger">

                        {{ session()->get('message') }}

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

                  <div class="row clearfix"  >





                  @php //print_r($property_list);

                    $j=0;

                    if(isset($_GET['page'])) $j = (100*((int)$_GET['page']-1));

                    $j++;

                  @endphp



                    <div id='print_able'>

                      <table  class="table table-fixed">

                          <thead>

                          <tr>

                              <th style="width: 3%; float: left">S# </th>

                              <th style="width: 8%; float: left">ID </th>

                              <th style="width: 10%; float: left">Activity Date </th>

                              <th style="width: 25%; float: left">Name </th>

                              <th style="width: 15%; float: left">Project </th>

                              <th style="width: 12%; float: left">Team Member </th>

                              <th style="width: 10%; float: left">Next Action </th>

                              <th style="width: 17%; float: left">Action Date </th>

                          </tr>

                          </thead>

                          <tbody>



            <!-- 1st Section Today’s action will be visible (after action will remove) -->

                            @if(count($todays_action)>0)

                            <tr>

                                <td style="text-align: center;" class="alert-success" colspan="8"> <strong> Today’s action </strong> </td>

                            </tr>

                            @endif

                            @foreach($todays_action as $row)



                              @php

                                  $CID = 10000000+$row->customer_id;

                                  $CID = substr($CID,1,7);

                              @endphp

                              <tr>

                                  <td style="width: 3%; float: left"> {{ $j }} </td>

                                  <td style="width: 8%; float: left"> {{ $CID }} </td>

                                  <td style="width: 10%; float: left">@php

                                      echo date('jS  M y g:i a', strtotime($row->created_at));

                                  @endphp

                                  </td>

                                  <td style="width: 25%; float: left"><b> {{ $row->prefix.' '.$row->name }} </b></td>

                                  @php

                                      $j++;

                                      $project_name=null;

                                      if(isset($project))

                                      {

                                                foreach ($project as  $p)

                                                {

                                                        if($row->project_id == $p->id)

                                                        {

                                                            $project_name=$p->title;

                                                            break;

                                                        }



                                                }



                                      }

                                      $property_name='';

                                      if(isset($property_list))

                                      {

                                                foreach ($property_list as $p)

                                                {

                                                        if($row->property_id == $p->id)

                                                        {

                                                            $property_name=$p->title;

                                                            break;

                                                        }



                                                }



                                      }

                                      if($project_name=='') $project_name = $row->area_of_interest;



                                   @endphp

                                <td style="width: 15%; float: left">{{$project_name}} </td>

                                <!-- <td class="col-xs-1">{!!$property_name!!} </td> -->

                                <!-- <td class="col-xs-1">{{ $row->mobile }} </td> -->

                                  @php

                                      $users = DB::table('users')

                                                        ->select('team_id','name')

                                                        ->where('id','=', $row->

                                                        created_id)->first();

                                  @endphp

                                  <td style="width: 12%; float: left"> @if(isset($users->name)) {{ $users->name }} @endif </td>

                                <!-- <td class="col-xs-1">

                                    @php



                                        if(isset($users->team_id)){

                                        $teams = DB::table('teams')

                                                     ->select('name')

                                                     ->where('id','=', $users->team_id)->first();

                                          echo  $teams->name;

                                        }

                                    @endphp

                                   </td> -->



                                  <td style="width: 10%; float: left">{{ $row->next_action }}</td>

                                  <td style="width: 17%; float: left">@php

                                      echo date('jS  M y g:i a', strtotime($row->next_action_date));

                                  @endphp



                                      <a href="{!! url('activity/create?id='.$row->customer_id) !!}"  class="btn btn-success" title="Contact"> <i class="glyphicon glyphicon-phone-alt" title="Contact" ></i> </a>





                                  </td>

                              </tr>

                                    

                          @endforeach



                          <!-- 2nd section Yesterday’s action not yet done will be visible with different color -->

                          @if(count($yesterdays_action)>0)

                          <tr>

                              <td style="text-align: center;" class="alert-success" colspan="8"> <strong>Yesterday’s action</strong> </td>

                          </tr>

                          @endif

                          @foreach($yesterdays_action as $row)

                          

                           <tr class="bg-silver">

                                   @php

                                       $CID = 10000000+$row->customer_id;

                                       $CID = substr($CID,1,7);

                                   @endphp

                                  <td style="width: 3%; float: left"> {{ $j }} </td>

                                  <td style="width: 8%; float: left">{{ $CID }} </td>

                                  <td style="width: 10%; float: left">@php

                                      echo date('jS  M y g:i a', strtotime($row->created_at));

                                  @endphp </td>



                                  <td style="width: 25%; float: left"><b> {{ $row->prefix.' '.$row->name }} </b></td>

                                  @php

                                      $j++;

                                        $project_name=null;

                                        if(isset($project))

                                        {

                                                  foreach ($project as  $p)

                                                  {

                                                          if($row->project_id == $p->id)

                                                          {

                                                              $project_name=$p->title;

                                                              break;

                                                          }



                                                  }



                                        }

                                        $property_name='';

                                        if(isset($property_list))

                                        {

                                                  foreach ($property_list as $p)

                                                  {

                                                          if($row->property_id == $p->id)

                                                          {

                                                              $property_name=$p->title;

                                                              break;

                                                          }



                                                  }



                                        }

                                        if($project_name=='') $project_name = $row->area_of_interest;



                               @endphp

                               <td style="width: 15%; float: left">{{$project_name}} </td>

                               <!-- <td class="col-xs-1">{!!$property_name!!} </td> -->

                               <!-- <td class="col-xs-1">{{ $row->mobile }} </td> -->

                               @php

                                   $users = DB::table('users')

                                                     ->select('team_id','name')

                                                     ->where('id','=', $row->

                                                     created_id)->first();

                               @endphp

                               <td style="width: 12%; float: left"> @if(isset($users->name)) {{ $users->name }} @endif </td>

                               <!-- <td class="col-xs-1">

                               @php

                                    if(isset($users->team_id)){

                                    $teams = DB::table('teams')

                                                 ->select('name')

                                                 ->where('id','=', $users->team_id)->first();

                                      echo  $teams->name;

                                    }

                               @endphp

                               </td> -->



                               <td style="width: 10%; float: left">{{ $row->next_action }}</td>

                               <td style="width: 17%; float: left">

                                   @php

                                    echo date('jS  M y g:i a', strtotime($row->next_action_date));

                                   @endphp

                                   <a href="{!! url('activity/create?id='.$row->customer_id) !!}"  class="btn btn-success" > <i class="glyphicon glyphicon-phone-alt" title="Contact" ></i>  </a>

                                   <br/>

                                   @php

                                       //$timeFirst  = strtotime($row->created_at);

                                       $timeFirst  = strtotime(date("Y-m-d",strtotime($row->created_at)));

                                       $timeSecond = strtotime(date("y-m-d"));

                                       $differenceInSeconds = $timeFirst-$timeSecond;

                                       $days = floor($differenceInSeconds/86400);

                                       $created_at= strtotime($row->created_at);

                                       $diff=$timeSecond-$created_at;

                                       $c_days= floor($diff/86400);

                                       //$c_days= date("Y-m-d",strtotime($row->created_at))-date("Y-m-d");

                                       //$c_days=date_diff(date("Y-m-d",strtotime($row->created_at)),date("Y-m-d"));

                                       echo $c_days." day's passed";

                                   @endphp





                               </td>

                              </tr>

                          @endforeach



                          <!-- 3rd section 3 to 30 days past action not yet done will be visible with yellow color  -->

                          @if(count($action_3_30_days_yellow)>0)

                                <tr>

                                    <td style="text-align: center;" class="alert-success" colspan="8"> <strong>3 to 30 Day's passed action</strong> </td>

                                </tr>

                          @endif

                          @foreach($action_3_30_days_yellow as $row)

                          

                           <tr class="bg-yellow">

                                   @php

                                       $CID = 10000000+$row->customer_id;

                                       $CID = substr($CID,1,7);

                                   @endphp

                                  <td style="width: 3%; float: left"> {{ $j }} </td>

                                  <td style="width: 8%; float: left">{{ $CID }} </td>

                                  <td style="width: 10%; float: left">@php

                                      echo date('jS  M y g:i a', strtotime($row->created_at));

                                  @endphp </td>

                                  <td style="width: 25%; float: left"><b> {{ $row->prefix.' '.$row->name }} </b></td>

                                   @php

                                       $j++;

                                          $project_name=null;

                                          if(isset($project))

                                          {

                                                    foreach ($project as  $p)

                                                    {

                                                            if($row->project_id == $p->id)

                                                            {

                                                                $project_name=$p->title;

                                                                break;

                                                            }



                                                    }



                                          }

                                          $property_name='';

                                          if(isset($property_list))

                                          {

                                                    foreach ($property_list as $p)

                                                    {

                                                            if($row->property_id == $p->id)

                                                            {

                                                                $property_name=$p->title;

                                                                break;

                                                            }



                                                    }



                                          }

                                          if($project_name=='') $project_name = $row->area_of_interest;



                       @endphp

                                <td style="width: 15%; float: left">{{$project_name}} </td>

                                <!-- <td class="col-xs-1">{!!$property_name!!} </td> -->

                                <!-- <td class="col-xs-1">{{ $row->mobile }} </td> -->

                               @php

                                   $users = DB::table('users')

                                                     ->select('team_id','name')

                                                     ->where('id','=', $row->

                                                     created_id)->first();

                               @endphp

                               <td style="width: 12%; float: left"> @if(isset($users->name)) {{ $users->name }} @endif </td>

                                <!-- <td class="col-xs-1">

                                @php

                           

                                    if(isset($users->team_id)){

                                    $teams = DB::table('teams')

                                                 ->select('name')

                                                 ->where('id','=', $users->team_id)->first();

                                      echo  $teams->name;

                                    }

                                   @endphp

                                  </td> -->



                                  <td style="width: 10%; float: left">{{ $row->next_action }}</td>

                                  <td style="width: 17%; float: left">@php

                                      echo date('jS  M y g:i a', strtotime($row->next_action_date));

                                  @endphp

                                      <a href="{!! url('activity/create?id='.$row->customer_id) !!}"  class="btn btn-success" > <i class="glyphicon glyphicon-phone-alt" title="Contact" ></i> </a>

                                      <br/>

                                  @php

                                    //$timeFirst  = strtotime($row->next_action_date);

                                    $timeFirst  = strtotime($row->created_at);

                                    $timeSecond = strtotime(date("y-m-d H:i:s"));

                                    $differenceInSeconds = time()-$timeFirst;

                                    $days = floor($differenceInSeconds/86400);

                                    //$created_at= strtotime($row->created_at);

                                    //$diff=$timeSecond-$created_at;

                                    //$c_days= floor($diff/86400);

                                    echo $days.' days passed';

                              @endphp







                                  </td>

                              </tr>

                          @endforeach



                        <!-- 4th section 31 days + past action not yet done will be visible with red color  -->

                          @if(count($action_31_days_red)>0)

                                <tr>

                                    <td style="text-align: center;" class="alert-success" colspan="8"> <strong>30 plus passed action</strong> </td>

                                </tr>

                          @endif

                          @foreach($action_31_days_red as $row)

                          

                           <tr class="bg-red">

                               @php

                                   $CID = 10000000+$row->customer_id;

                                   $CID = substr($CID,1,7);

                               @endphp

                                  <td style="width: 3%; float: left"> {{ $j }} </td>

                                  <td style="width: 8%; float: left"> {{ $CID }} </td>

                                  <td style="width: 10%; float: left">@php

                                      echo date('jS  M y g:i a', strtotime($row->created_at));

                                  @endphp </td>

                                  <td style="width: 25%; float: left"><b>{{ $row->prefix.' '.$row->name }} </b></td>

                                   @php

                                       $j++;

                                         $project_name=null;

                                         if(isset($project))

                                         {

                                                   foreach ($project as  $p)

                                                   {

                                                           if($row->project_id == $p->id)

                                                           {

                                                               $project_name=$p->title;

                                                               break;

                                                           }



                                                   }



                                         }

                                         $property_name='';

                                         if(isset($property_list))

                                         {

                                                   foreach ($property_list as $p)

                                                   {

                                                           if($row->property_id == $p->id)

                                                           {

                                                               $property_name=$p->title;

                                                               break;

                                                           }



                                                   }



                                         }

                                         if($project_name=='') $project_name = $row->area_of_interest;



                       @endphp

                                <td style="width: 15%; float: left">{{$project_name}} </td>

                                <!-- <td class="col-xs-1">{!!$property_name!!} </td> -->

                                <!-- <td class="col-xs-1">{{ $row->mobile }} </td>-->

                               @php

                                   $users = DB::table('users')

                                                     ->select('team_id','name')

                                                     ->where('id','=', $row->

                                                     created_id)->first();

                               @endphp

                               <td style="width: 12%; float: left"> @if(isset($users->name)) {{ $users->name }} @endif </td>

                                <!-- <td class="col-xs-1">

                                   @php



                                    if(isset($users->team_id)){

                                    $teams = DB::table('teams')

                                                 ->select('name')

                                                 ->where('id','=', $users->team_id)->first();

                                      echo  $teams->name;

                                    }

                                   @endphp

                                   </td>-->



                                  <td style="width: 10%; float: left">{{ $row->next_action }}</td>

                                  <td style="width: 17%; float: left">

                                      @php

                                          echo date('jS  M y g:i a', strtotime($row->next_action_date));

                                      @endphp

                                      <a href="{!! url('activity/create?id='.$row->customer_id) !!}" class="btn btn-success" title="Contact"> <i class="glyphicon glyphicon-phone-alt" ></i> </a>

                                      <br/>

                                      @php

                                        $timeFirst  = strtotime($row->created_at);

                                        $timeSecond = strtotime(date("y-m-d H:i:s"));

                                        $differenceInSeconds = $timeFirst-$timeSecond;

                                        $days = floor($differenceInSeconds/86400);

                                        $created_at= strtotime($row->created_at);

                                        $diff=$timeSecond-$created_at;

                                        $c_days= floor($diff/86400);

                                        echo $c_days.' days passed';

                                      @endphp



                                  </td>

                              </tr>

                                    

                          @endforeach

                          </tbody>

                      </table>

                    </div>





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

    </section>

      <style>



          @php

           $total_c = count($todays_action)+count($todays_action)+count($yesterdays_action)+count($action_3_30_days_yellow)+count($action_31_days_red);

           if($total_c>12)

           {

          @endphp

          .table-fixed thead { margin-right: 15px; }

          @php } @endphp



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



        <style>

            .bg-silver { background-color: #eeeeee; }

        </style>



@endsection    