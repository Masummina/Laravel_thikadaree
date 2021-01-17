@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header clearfix">
          <h1 class="pull-left">  All Prospects   </h1>

          @php $group_id = \Auth::user()->group_id; @endphp

          <div class="row">
              <div class="col-xs-12">

                  <form id="advanced_s" method="get" class="  form-inline my-2 my-lg-0" action="">

                      <div class="row mt-1">

                          @if($group_id!=4)
                              @php if(!isset($_GET["user"])) $_GET["user"]= Auth::user()->id; @endphp
                              @if(count($team_memebers)>1 && Auth::user()->group_id<4)
                                  <div class="col-sm-3">
                                      <span class="report-headline"> Member : </span>
                                      <select name="user" class="form-control" id="exampleSelect1" style="width: 170px !important;">
                                          <option value="all">All Memeber</option>
                                          @foreach ($team_memebers as $team)
                                              <option @if(@$_GET["user"]==$team->id) selected @endif value="{{$team->id}}">{{$team->name}}</option>
                                          @endforeach
                                      </select>
                                  </div>
                              @endif
                          @endif

                          <div class="col-sm-5">
                              <span class="report-headline"> By Date : </span>
                              <input name="from" type="date"  name="prefix"  class="form-control" value="{{@$_GET["from"]}}">
                              to
                              <input name="to" type="date"  name="prefix"  class="form-control" value="{{@$_GET["to"]}}">
                          </div>

                          <div class="col-sm-4">
                              <span class="report-headline"> By Location : </span>
                              <select name="location" class="form-control" id="location1">
                                  @if(isset($_GET["location"]))
                                      <option>{{@$_GET["location"]}}</option>
                                  @else
                                      <option value="">Select </option>
                                  @endif
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
                                      @if(isset($_GET["flat_size"]) && $_GET["flat_size"]==$p)
                                          <option value="{{$p}}" selected="">{{$p}}</option>
                                      @else
                                          <option  value="{{$p}}">{{$p}}</option>
                                      @endif
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-sm-8">
                              <span class="report-headline">  By Profession : </span>
                              <select name="profession" class="form-control" id="area_size" style="width: 160px !important;" >
                                  <option value="">Select Profession</option>
                                  @foreach ($profession as $p)
                                      <option  @if(isset($_GET["profession"]) && $_GET['profession']==$p->id) selected @endif  value="{{$p->id}}">{{$p->title}}</option>
                                  @endforeach
                              </select>

                              <span class="report-headline">  Name : </span>
                              <input type="text" name="customer_name" value="{{@$_GET['customer_name']}}" style="width: 120px">
                              <span class="report-headline"> Mobile : </span>
                              <input type="text" name="customer_mobile" value="{{@$_GET['customer_mobile']}}" style="width: 100px" >

                              <input  type="submit" class="btn btn-primary" value=" Search " name="submit">

                          </div>
                      </div>
                      <div class="row mt-1">
                          <div class="col-sm-4"> &nbsp; </div>
                          <div class="col-sm-4">

                          </div>

                      </div>

                  </form>

              </div>
          </div>

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
                      <p class="pull-left" >
                          <a class="btn btn-success" title="New prospect"  href="{{ url('customers/create') }}"  ><i class="fa fa-plus"></i> New Prospect </a>
                      </p>
                      @php
                          $group_id = \Auth::user()->group_id;

                          if(isset($_GET['member']))
                            $member=$_GET['member'];
                          else if($group_id<3)
                            $member=1;
                          else
                            $member=\Auth::user()->id;

                      @endphp
                      <div style="font-size: 18px; float:left; margin-left:10px ">
                          Total : <i class="btn btn-danger"> {!! $header['total'] !!} </i>
                          Primary :  <a href="{!! url('prospect-summery/?member='.$member.'&type=Primary') !!}"> <i class="btn btn-danger"> {!! $header['Primary'] !!} </i> </a>
                          Secondary : <a href="{!! url('prospect-summery/?member='.$member.'&type=Secondary') !!}"> <i class="btn btn-danger"> {!! $header['Secondary'] !!} </i> </a>
                          Near to Close : <a href="{!! url('prospect-summery/?member='.$member.'&type=Near to Close') !!}"> <i class="btn btn-danger"> {!! $header['NTC'] !!} </i> </a>
                          Others : <a href="{!! url('prospect-summery/?member='.$member.'&type=Others') !!}"> <i class="btn btn-danger"> {!! $header['Others'] !!} </i> </a>
                          Clients : <a href="{!! url('customers?member='.$member) !!}"> <i class="btn btn-danger"> {!! $header['Clients'] !!} </i> </a>
                      </div>
                  @if($customer_list && count($customer_list) > 0 )

                      @if(isset($customer_list[0]))
                          @php $download_link=url('download-prospect-report'); @endphp
                          <p class="pull-right" >  &nbsp;&nbsp;&nbsp;
                             <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_prospect')" > <i class="glyphicon glyphicon-print"  > </i> </span>
                             <a title="Download" href="{!! $download_link !!}" target="_blank" class="btn btn-success" >  <i class="glyphicon glyphicon-download-alt"  > </i> </a>
                          </p>
                      @endif

                      <div id="print_prospect">
                      <table class="table  table-fixed">
                          <thead>
                          <tr>
                              <th style="width: 5%; float: left">S# </th>
                              <th style="width: 8%; float: left" >ID </th>
                              <th style="width: 25%; float: left">Name </th>
                              <th style="width: 12%; float: left">Mobile </th>
                              <th style="width: 20%; float: left">Team Member</th>
                              <!-- <th style="width: 18%; float: left">Team</th> -->
                              <th style="width: 30%; float: left">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          @php
                                $already=array();
                                $i=0;
                                $j=0;
                                if(isset($_GET['page'])) $j = (50*((int)$_GET['page']-1));
                                //$j++;
                          @endphp
                          @foreach($customer_list as $row)
                                  @if(in_array($row->id,$already))

                                        @continue;
                                  @else
                                      @php $already[]=$row->id;$i++; @endphp
                                  @endif
                                  @php
                                      $j++;
                                      $CID = 10000000+$row->id;
                                      $CID = substr($CID,1,7);
                                  @endphp
                              <tr>
                                  <td style="width: 5%; float: left"> {{ $j }} </td>
                                  <td style="width: 8%; float: left"> {{ $CID }} </td>
                                  <td style="width: 25%; float: left">
                                      <span data-target="#Modal-Edit{!! $i !!}" class="link" data-toggle="modal" title="Click to view information" > {{ $row->prefix }} {{ $row->name }} </span> </td>
                                  <td style="width: 12%; float: left">{{ $row->mobile }} </td>
                                  <td style="width: 20%; float: left">

                                      @php
                                          $users = DB::table('users')
                                                       ->select('team_id','name')
                                                       ->where('id','=', $row->
                                                       created_id)->first();
                                      @endphp
                                      @if(isset($users->name)) {{ $users->name }} @endif

                                  </td>
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
                                  <td style="width: 30%; float: left">



                                      <!--<form  class="pull-right delete" action="{{ url('/customers/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >
                                          {{method_field('DELETE')}}
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <button type="submit" class="btn btn-default">Delete</button>
                                      </form>-->

                                      <a style="margin-left: 4px;" href="{!! url('activity/create?id='.$row->id) !!}" class="btn btn-success pull-left" title="Contact"> <i class="glyphicon glyphicon-phone-alt"  ></i> </a>
                                      <a style="margin-left: 4px;" href="{!! url('customers/'.$row->id) !!}"  class="btn btn-success"> <i class="fa fa-edit" title="Edit" ></i>   </a>
                                      <a style="margin-left: 4px;" href="{!! url('pre-schedules/'.$row->id) !!}" class="btn btn-success pull-left" title="Pre-Schedule" > <i class="glyphicon glyphicon-list-alt" ></i> </a>

                                      <form style="margin:0px 5px ;"  class="pull-left " action="{{ url('/customers/create-ac/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to create?')" >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <button type="submit" class="btn btn-success" title="Make Client"> <i class="glyphicon glyphicon-user" ></i>  </button>
                                      </form>
                                      <form  class="pull-left" action="{{ url('/customers/create-cb/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to common bin?')" >
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <button type="submit" class="btn btn-danger" title="Make Common Bin"> <i class="fa fa-trash-o" ></i> </button>
                                      </form>
                                      @if(\Auth::user()->group_id==1)
                                        <button onclick="move_ps(this)" style="margin-right: 5px;" id="move_ps" data="{!! $row->id !!}" pid="{!! $row->id !!}" uid="{!! $row->created_id !!}" type="button" data-target="#Modal-Edit" class="btn btn-primary " data-toggle="modal" title="Move Prospect"> <i class="glyphicon glyphicon-move" ></i>  </button>
                                      @endif

                                          <div class="modal fade" id="Modal-Edit{!! $i !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content" style="width: 900px;">
                                                      <div class="modal-header">
                                                          <h3> Prospect information </h3>
                                                      </div>
                                                      <div class="modal-body"  >
                                                          @php
                                                              $contact = DB::table('contacts')
                                                                           ->where('type','Home')
                                                                           ->where('customer_id',$row->id)
                                                                           ->first();
                                                              $c_info = DB::table('customers')
                                                                           ->select('area_of_interest','size_of_interest','price_of_interest')
                                                                           ->where('id',$row->id)
                                                                           ->first();
                                                          @endphp


                                                          <div id="area_of_interest" class="card-body">

                                                              <div class="input-group input-group-sm">
                                                                  <span class="input-group-addon"> Name </span>
                                                                  <input name="area_name" value=" {{ $row->prefix }} {{ $row->name }} "  class="form-control" readonly >
                                                                  <span class="input-group-addon"> Mobile </span>
                                                                  <input name="area_size" value="{{ $row->mobile }}" class="form-control" readonly>
                                                                  <span class="input-group-addon"> Email </span>
                                                                  <input name="area_price" value="{{ @$contact->email }}" class="form-control" readonly>
                                                              </div>
                                                              <div class="input-group input-group-sm">
                                                                  <span class="input-group-addon"> Address </span>
                                                                  <div class="col-sm-9"> : {{ @$contact->address_1.' '.$contact->city.' '.$contact->district }} </div>
                                                              </div>

                                                          </div>

                                                          <div id="area_of_interest" class="card-body">
                                                              <br/> Area of Interest
                                                              <div class="input-group input-group-sm">
                                                                  <span class="input-group-addon">Area</span>
                                                                  <input name="area_name" value="{!! $c_info->area_of_interest !!}"  class="form-control" readonly>
                                                                  <span class="input-group-addon">Size(sft)</span>
                                                                  <input name="area_size" value="{!! $c_info->size_of_interest !!}" class="form-control" readonly>
                                                                  <span class="input-group-addon">Price(tk)</span>
                                                                  <input name="area_price" value="{!! $c_info->price_of_interest !!}" class="form-control" readonly>
                                                              </div>
                                                          </div>

                                                          <div id="area_of_interest" class="card-body">
                                                              <br/> Activity History
                                                              <div class="input-group input-group-sm">
                                                              @php
                                                                  $activities = DB::table('activities')
                                                                    ->select('*',
                                                                        DB::raw("(SELECT `title`  FROM `projects` WHERE `id`=`activities`.`project_id` LIMIT 1) as project_name"),
                                                                        DB::raw("(SELECT `title`  FROM `property` WHERE  `id`=`activities`.`property_id` LIMIT 1) as property_name ")
                                                                    )
                                                                    ->whereRaw("customer_id=".$row->id)
                                                                    ->orderBy('id','desc')
                                                                    ->paginate(10);

                                                              @endphp

                                                                  @if(isset($activities[0]))
                                                                      <table class="table table-fix">
                                                                          <tbody>
                                                                          <tr>
                                                                              <th style="float: left; width: 3%; ">#</th>
                                                                              <th style="float: left; width: 12%;">Project Name</th>
                                                                              <th style="float: left; width: 12%;">Property Name</th>
                                                                              <th style="float: left; width: 10%;">Date</th>
                                                                              <th style="float: left; width: 20%;">Description</th>
                                                                              <th style="float: left; width: 10%;" >Contact</th>
                                                                              <th style="float: left; width: 10%;" >Lead Status</th>
                                                                              <th style="float: left; width: 10%;" >Action</th>
                                                                              <th style="float: left; width: 12%;" >Action Date</th>
                                                                          </tr>

                                                                          @php $k=count($activities); @endphp
                                                                          @foreach($activities as $row)
                                                                              <tr>
                                                                                  <td style="float: left; width: 3%;">{{$k}} </td>
                                                                                  <td style="float: left; width: 12%;">{{$row->project_name}} </td>
                                                                                  <td style="float: left; width: 12%;">{{$row->property_name}} </td>
                                                                                  <td style="float: left; width: 10%;">{!! date('jS  F y g:i A', strtotime($row->created_at)) !!}</td>
                                                                                  <td style="float: left; width: 20%;">{{$row->remarks}}</td>
                                                                                  <td style="float: left; width: 10%;">{{$row->contact_method}}</td>
                                                                                  <td style="float: left; width: 10%;">{{$row->lead_status}}</td>
                                                                                  <td style="float: left; width: 10%;">{{$row->next_action}}</td>
                                                                                  <td style="float: left; width: 12%;">{!! date('jS  F Y g:i A', strtotime($row->next_action_date)) !!}</td>
                                                                              </tr>
                                                                              @php $k--; @endphp
                                                                          @endforeach

                                                                          </tbody></table>
                                                                  @else
                                                                      Activity Not found
                                                                  @endif

                                                              </div>
                                                          </div>

                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>


                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                      </div>
                      <div class="pull-right">{{ $customer_list->appends($link)->links() }}</div>
                      
                        @else
                          No data found
                    @endif

                  </div>
                </div>


                <style>
                    @php $total_c = count($customer_list); @endphp
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
     <div class="modal fade" id="Modal-Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3> Move Prospects </h3>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" action="{!! url('/customers/create-cp') !!}" method="POST">

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Team </label>
                            <div class="col-md-6">
                           <select name="team" class="form-control " id="team">
                            <option>Select Team</option>

                            @foreach ($allteams as $team)
                              <option value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach
                      </select>
                </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Team Member</label>
                            <div class="col-md-6">
                           <select name="team_member" class="form-control ">
                            <option>Select Team Member</option>
                  
                      </select>
                </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name"> &nbsp; </label>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                        <input id="u_id" type="hidden" name="u_id" value=""/>
                        <input id="pid" type="hidden" name="pid" value=""/>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    </form>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
      <style>
        .right_btn {
              float: right;
              margin: 10px 5px 10px 10px;
          }
        .link { background-color: #ccc; cursor: pointer; padding: 5px; }
        .intable td { border: 1px solid;  }

        .bg-green { background-color: #398439 }
        .bg-red { background-color: #c12e2a }
        .bg-yellow { background-color: #9ad717 }
        .flate-box { height: 80px; width: 100%; margin-bottom: 6px; text-align: center; padding-top: 10px; font-size: 16px; }
      </style>
@endsection    