@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header clearfix" id="fixednavbar">
        <h1 class="pull-left">  All Clients </h1>
        @php $group_id = \Auth::user()->group_id; @endphp

          <div class="row">
              <div class="col-xs-12 ">

                  <form id="advanced_s" method="get" class="  form-inline my-2 my-lg-0" action="">

                      <div class="row mt-1">

                          @if($group_id<4)
                              @php if(!isset($_GET["user"])) $_GET["user"]= Auth::user()->id; @endphp
                              @if(count($team_memebers)>1 && Auth::user()->group_id<4)
                                  <div class="col-sm-3">
                                  <span class="report-headline"> Member : </span>
                                  <select name="user" class="form-control" id="exampleSelect1" style="width: 170px !important;">
                                      <option value="all">All Member</option>
                                      @foreach ($team_memebers as $row)
                                          <option @if(@$_GET["user"]==$row->id) selected @endif value="{{$row->id}}">{{$row->name}}</option>
                                      @endforeach
                                  </select>
                                  </div>
                              @endif
                          @endif

                          <div class="col-sm-5">
                              <span class="report-headline"> By Project : </span>
                              <select name="project" class="form-control" id="project">
                                  <option value="">Select Project</option>
                                  @foreach ($project as $p)
                                          <option @if(@$_GET['project']==$p->id) selected @endif value="{{$p->id}}">{{$p->title}}</option>
                                  @endforeach
                              </select>
                              <!--
                              <span class="report-headline"> By Date : </span>
                              <input name="from" type="date"  name="prefix"  class="form-control" value="{{@$_GET["from"]}}">
                              to
                              <input name="to" type="date"  name="prefix"  class="form-control" value="{{@$_GET["to"]}}">
                              -->
                          </div>
                          <div class="col-sm-4">
                              <span class="report-headline"> By Location : </span>
                              <select name="location" class="form-control" id="location1">
                                  <option value="">Select </option>
                                  @php $locations =array();@endphp
                                  @foreach ($project as $p)
                                      @if(!in_array($p->area,$locations))
                                          @php $locations[]=$p->area; @endphp
                                      @endif
                                  @endforeach
                                  @php sort($locations); @endphp
                                  @foreach ($locations as $p)
                                      <option  value="{{$p}}" @if(@$_GET["location"]==$p) selected @endif >{{$p}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="row mt-1">
                          <div class="col-sm-3">
                              @php
                                  $flat_size = array('501 - 1000', '1001 - 1500', '1501 - 2000' ,'2001 - 2500', '2501 - 3000' ,'3001 - 3500','3501 - 4000','4500 - 5000', '5001 - 8000');
                              @endphp
                              <span class="report-headline">  By Flat Size : </span>
                              <select name="flat_size" class="form-control" id="area_size" style="width: 145px !important;">
                                  <option value="" >All Flat Size</option>
                                  @foreach ($flat_size as $p)
                                      <option  value="{{$p}}" @if(@$_GET["flat_size"]==$p) selected @endif >{{$p}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-sm-8">
                              <span class="report-headline">  By Profession : </span>
                              <select name="profession" class="form-control" id="area_size" style="width: 170px !important;" >
                                  <option value="">Select Profession</option>
                                  @foreach ($profession as $p)
                                      <option  @if(isset($_GET["profession"]) && $_GET['profession']==$p->id) selected @endif  value="{{$p->id}}">{{$p->title}}</option>
                                  @endforeach
                              </select>

                              <span class="report-headline">  Name : </span>
                              <input type="text" name="name" value="{{@$_GET['name']}}" minlength="4" style="width: 130px">
                              <span class="report-headline"> Mobile : </span>
                              <input type="text" name="mobile" value="{{@$_GET['mobile']}}" minlength="5" style="width: 130px">

                              <button type="submit" class="btn btn-success" title="Search" ><i class="fa fa-search"></i>  </button>

                          </div>
                      </div>


                  </form>

              </div>
          </div>

          <!--
          <form method="get" class="pull-right form-inline my-2 my-lg-0" action="">
             <span class="report-headline">  Search  </span>
             <input placeholder="Type here" class="form-control mr-sm-2" type="text" name="s_key">
             <span class="mr-sm-2">Type</span>
                          <select id="type" name="type" class="form-control">
                              <option>Select Type</option>
                              <option value="project">Project</option>
                              <option value="location">Location</option>
                               <option value="area">Area</option>
                              <option value="name">Name</option>
                              <option value="mobile">Mobile</option>
                              <option value="size">Size</option>
                          </select>
             <input type="submit" class="btn btn-secondary my-2 my-sm-0" value=" Search " name="submit">
          </form>
          -->

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
                 @if(session()->has('error'))
                   <div class="alert alert-danger">
                      {{ session()->get('error') }}
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

                    <a class=" btn btn-primary pull-left"  href="{{ url('customers/create') }}"  ><i class="fa fa-plus"></i> New Client </a>

                      <p class="pull-right">  &nbsp;&nbsp;&nbsp;
                          <a title="Download" href="{!! url('download-all-clients') !!}" target="_blank" class="btn btn-success">  <i class="glyphicon glyphicon-download-alt"> </i> </a>
                      </p>

                    @if($customers && count($customers) > 0 )

                      <table class="table  table-fixed">
                          <thead>
                          <tr>
                              <th style="width: 3%; float: left">S# </th>
                              <th style="width: 10%; float: left">ID </th>
                              <th style="width: 30%; float: left">Name </th>
                              <th style="width: 10%; float: left">Mobile </th>
                              <th style="width: 15%; float: left">Team Member</th>
                              <th style="width: 12%; float: left">Team</th>
                              <th style="width: 20%; float: left">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          @php
                              $i=0;
                              $j=0;
                              if(isset($_GET['page'])) $j = (100*((int)$_GET['page']-1));

                          @endphp
                          @foreach($customers as $row)
                              @php
                                  $i++;
                                  $CID = 10000000+$row->id;
                                  $CID = substr($CID,1,7);

                                  $user_info = DB::table('users')
                                               ->select('team_id','name')
                                               ->where('id','=', $row->
                                               created_id)->first();

                                  $team = ''; $user_by = '';
                                  if(isset($user_info->name))
                                  {
                                    $user_by = $user_info->name;
                                  }
                                  if(isset($user_info->team_id))
                                  {
                                      $teams = DB::table('teams')
                                               ->select('name')
                                               ->where('id','=', $user_info->team_id)->first();
                                      $team = $teams->name;
                                  }
                                  $j++;
                              @endphp
                              <tr>
                                  <td style="width: 3%; float: left"> {{ $j }} </td>
                                  <td style="width: 10%; float: left"> {{ $CID}} </td>
                                  <td style="width: 30%; float: left"><b>{{ $row->prefix }} {{ $row->name }}</b> </td>
                                  <td style="width: 10%; float: left">{{ $row->mobile }} </td>
                                  <td style="width: 15%; float: left"> {!! $user_by !!} </td>
                                  <td style="width: 12%; float: left"> {{ $team }} </td>
                                  <td style="width: 20%; float: left">

                                      <a href="{!! url('customers/'.$row->id) !!}"  class="btn btn-warning"><i class="fa fa-edit"></i></a>

                                      <!--<form  class="pull-right delete" action="{{ url('/customers/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >
                                          {{method_field('DELETE')}}
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <button type="submit" class="btn btn-default">Delete</button>
                                      </form>-->
                                      <form style="margin-right: 8px;"  class="pull-left" action="{{ url('/customers/create-ac/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to make prospects?')" >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <input type="hidden" name="type" value="prospects">
                                          <button type="submit" class="btn btn-success" title="Make Prospect" ><i class="glyphicon glyphicon-zoom-in"></i>  </button>
                                      </form>
                                      <a style="margin-left: 4px;" href="{!! url('activity/create?id='.$row->id) !!}" class="btn btn-success" title="Contact"> <i class="glyphicon glyphicon-phone-alt"></i> </a>
                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                      <div class="pull-right">{{ $customers->links() }}</div>
                      
                        @else
                        No data found
                    @endif

                  </div>
                </div>


                    <style>

                        @php $total_c = count($customers); @endphp
                        @if($total_c>12)
                          .table-fixed thead { margin-right: 15px; }
                        @endif

                    </style>



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