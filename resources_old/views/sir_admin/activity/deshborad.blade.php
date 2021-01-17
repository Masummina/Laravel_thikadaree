@extends('admin.layouts.layout')

@section('content')

    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

     <section class="content-header clearfix">

    <h1 class="pull-left">  Dashboard </h1>

     @php

     $group_id = \Auth::user()->group_id;

        if($group_id==1||$group_id==2)

        {

      @endphp    

      @if($teams)

          <form method="get" class="pull-right form-inline my-2 my-lg-0" action="">

              <span class="report-headline">  Search by Member </span>

                <select name="team" class="form-control" id="exampleSelect1">

                  <option>Select Memeber</option>

                  @foreach ($team_memebers as $team)

                        <option @if(@$_GET["team"]==$team->id) selected @endif value="{{$team->id}}">{{$team->name}}</option>

                     @endforeach

                    

                  

                </select>

              <input type="submit" class="btn btn-secondary my-2 my-sm-0" value=" Search " name="submit">

          </form>

           @endif

           @php } @endphp

          

                 @php echo '<input type="button" value="Print Report" onclick="PrintElem('."'#print_able'".')" class="btn btn-primary printbt" />';

     @endphp

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

                  <div class="row clearfix">



                  @php //print_r($property_list); @endphp

                  @if($activities)

                    <div id='print_able'>

                      <table  class="table  table-striped">

                          <thead>

                          <tr>

                              <th>S# </th>

                              <th>Activity Date </th>

                              <th>Name </th>

                              <th>Project </th>

                               <th>Property </th>

                              <th>Mobile </th>

                              <th>Team Member </th>

                              <th>Team </th>

                              <th>Status</th>

                              <th>Next Action </th>

                              <th>Action Date </th>

                              <th>Remain </th>

                              <th>Cantact </th>

                          </tr>

                          </thead>

                          <tbody>



                          @foreach($pre_schedule as $row)

                          

                           <tr>



                                  <td>0000{{ $row->customer_id }} </td>

                                  <td>@php 

                                      echo date('l jS  F Y ', strtotime($row->created_at));

                                  @endphp </td>

                                  <td><b>{{ $row->prefix }} {{ $row->name }} </b></td>

                                  @php

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

                          $property_name=null;

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



                       @endphp

                        <td>{{$project_name}} </td>

                      <td>{!!$property_name!!} </td>

                                  <td>{{ $row->mobile }} </td>

                                  <td>{!! $row->created !!} </td>

                                  <td>

                                    @php



                            $users = DB::table('users')

                                         ->select('team_id')

                                         ->where('id','=', $row->

                                         created_by)->first(); 

                           

                            if(isset($users->team_id)){

                            $teams = DB::table('teams')

                                         ->select('name')

                                         ->where('id','=', $users->team_id)->first();

                              echo  $teams->name;          

                            }             

                           @endphp

                                   </td>

                                  <td>{{ $row->lead_status }}</td>

                                  <td>{{ $row->next_action }}</td>

                                  <td>@php 

                                      echo date('l jS  F Y h:i:s A', strtotime($row->next_action_date));

                                  @endphp</td>

                                  <td></td>



                                  <td>



                                      <a href="{!! url('activity/create?id='.$row->customer_id) !!}"  class="btn btn-success">Contact</a>





                                  </td>

                              </tr>

                                    

                          @endforeach  

                          @foreach($today_activities as $row)

                          

                           <tr>



                                  <td>0000{{ $row->customer_id }} </td>

                                  <td>@php 

                                      echo date('l jS  F Y ', strtotime($row->created_at));

                                  @endphp </td>



                                  <td><b>{{ $row->prefix }} {{ $row->name }} </b></td>

                                  @php

                        

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

                          $property_name=null;

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



                       @endphp

                                 <td>{{$project_name}} </td>

                      <td>{!!$property_name!!} </td>

                                  <td>{{ $row->mobile }} </td>

                                  <td>{!! $row->created !!} </td>

                                  <td>

                                    @php



                            $users = DB::table('users')

                                         ->select('team_id')

                                         ->where('id','=', $row->

                                         created_by)->first(); 

                           

                            if(isset($users->team_id)){

                            $teams = DB::table('teams')

                                         ->select('name')

                                         ->where('id','=', $users->team_id)->first();

                              echo  $teams->name;          

                            }             

                           @endphp

                                   </td>

                                  <td>{{ $row->lead_status }}</td>

                                  <td>{{ $row->next_action }}</td>

                                  <td>@php 

                                      echo date('l jS  F Y h:i:s A', strtotime($row->next_action_date));

                                  @endphp</td>

                                  <td></td>



                                  <td>



                                      <a href="{!! url('activity/create?id='.$row->customer_id) !!}"  class="btn btn-success">Contact</a>





                                  </td>

                              </tr>

                                    

                          @endforeach 

                          @foreach($pasted_activities_yellow as $row)

                          

                           <tr class="yellow">



                                  <td>0000{{ $row->customer_id }} </td>

                                  <td>@php 

                                      echo date('l jS  F Y ', strtotime($row->created_at));

                                  @endphp </td>

                                  <td><b>{{ $row->prefix }} {{ $row->name }} </b></td>

                                   @php

                       

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

                          $property_name=null;

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



                       @endphp

                                 <td>{{$project_name}} </td>

                      <td>{!!$property_name!!} </td>

                                  <td>{{ $row->mobile }} </td>

                                  <td>{!! $row->created !!} </td>

                                  <td>

                                    @php



                            $users = DB::table('users')

                                         ->select('team_id')

                                         ->where('id','=', $row->

                                         created_by)->first(); 

                           

                            if(isset($users->team_id)){

                            $teams = DB::table('teams')

                                         ->select('name')

                                         ->where('id','=', $users->team_id)->first();

                              echo  $teams->name;          

                            }             

                           @endphp

                                   </td>

                                  <td>{{ $row->lead_status }}</td>

                                  <td>{{ $row->next_action }}</td>

                                  <td>@php 

                                      echo date('l jS  F Y h:i:s A', strtotime($row->next_action_date));

                                  @endphp</td>

                                  <td>@php

                                    $timeFirst  = strtotime($row->created_at);

                                    $timeSecond = strtotime(date("y-m-d H:i:s"));

                                    $differenceInSeconds = $timeFirst-$timeSecond;

                                    $days = floor($differenceInSeconds/86400);

                                    $created_at= strtotime($row->created_at);

                                    $diff=$timeSecond-$created_at;

                                    $c_days= floor($diff/86400);

                                    echo $c_days." day's passed";

                              @endphp</td>



                                  <td>



                                      <a href="{!! url('activity/create?id='.$row->customer_id) !!}"  class="btn btn-success">Contact</a>





                                  </td>

                              </tr>

                                    

                          @endforeach   

                          @foreach($pasted_activities_red as $row)

                          

                           <tr class="red">



                                  <td>0000{{ $row->customer_id }} </td>

                                  <td>@php 

                                      echo date('l jS  F Y h:i:s A', strtotime($row->created_at));

                                  @endphp </td>

                                  <td><b>{{ $row->prefix }} {{ $row->name }} </b></td>

                                   @php

                        

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

                          $property_name=null;

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



                       @endphp

                                 <td>{{$project_name}} </td>

                      <td>{!!$property_name!!} </td>

                                  <td>{{ $row->mobile }} </td>

                                  <td>{!! $row->created !!} </td>

                                  <td>

                                    @php



                            $users = DB::table('users')

                                         ->select('team_id')

                                         ->where('id','=', $row->

                                         created_by)->first(); 

                           

                            if(isset($users->team_id)){

                            $teams = DB::table('teams')

                                         ->select('name')

                                         ->where('id','=', $users->team_id)->first();

                              echo  $teams->name;          

                            }             

                           @endphp

                                   </td>

                                  <td>{{ $row->lead_status }}</td>

                                  <td>{{ $row->next_action }}</td>

                                  <td>@php 

                                      echo date('l jS  F Y h:i:s A', strtotime($row->next_action_date));

                                  @endphp</td>

                                  <td>@php

                                    $timeFirst  = strtotime($row->created_at);

                                    $timeSecond = strtotime(date("y-m-d H:i:s"));

                                    $differenceInSeconds = $timeFirst-$timeSecond;

                                    $days = floor($differenceInSeconds/86400);

                                    $created_at= strtotime($row->created_at);

                                    $diff=$timeSecond-$created_at;

                                    $c_days= floor($diff/86400);

                                    echo $c_days.' days passed';

                              @endphp</td>



                                  <td>



                                      <a href="{!! url('activity/create?id='.$row->customer_id) !!}"  class="btn btn-success">Contact</a>





                                  </td>

                              </tr>

                                    

                          @endforeach

                          </tbody>

                      </table>

                    </div>

                      @php 

                        $pre_schedule_pag = $pre_schedule->lastPage();



                        $today_activities_pag = $today_activities->lastPage();



                        $pasted_activities_yellow_pag = $pasted_activities_yellow->lastPage();



                        $pasted_activities_red_pag = $pasted_activities_red->lastPage();





                        $page_max = array ("pre_schedule" => $pre_schedule_pag, "today_activities" => $today_activities_pag, "pasted_activities_yellow" => $pasted_activities_yellow_pag, "pasted_activities_red" => $pasted_activities_red_pag);

$top_page = array_search(max($page_max),$page_max); 

//echo $top_page;



                            //print_r($pasted_activities_red->lastPage());

                            @endphp

                            @if(isset($top_page))

                             @if($top_page=="pre_schedule")

                              <div class="pull-right">{{ $pre_schedule->links() }}</div>

                              @endif

                               @if($top_page=="today_activities")

                              <div class="pull-right">{{ $today_activities->links() }}</div>

                              @endif

                               @if($top_page=="pasted_activities_yellow")

                              <div class="pull-right">{{ $pasted_activities_yellow->links() }}</div>

                              @endif

                               @if($top_page=="pasted_activities_red")

                              <div class="pull-right">{{ $pasted_activities_red->links() }}</div>

                              @endif

                            @endif

                  @endif



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

        .right_btn {

              float: right;

              margin: 10px 5px 10px 10px;

          }

        .bg-green { background-color: #398439 }

        .bg-red { background-color: #c12e2a }

        .bg-yellow { background-color: #9ad717 }

        .flate-box { height: 80px; width: 100%; margin-bottom: 6px; text-align: center; padding-top: 10px; font-size: 16px; }

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