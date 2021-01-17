@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header clearfix">
          <h1 class="pull-left">  All {!! urldecode($_GET['type']) !!} Prospects   </h1>

          @php $group_id = \Auth::user()->group_id; @endphp


      </section>
      
      <section class="content">
      <div class="row">


        <div class="col-xs-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">



                <div class="col-md-12">
                  <div class="row clearfix">

                  @if(isset($customer_list[0]))

                      @if(isset($customer_list[0]))
                          @php $download_link=url('download-prospect-report'); @endphp
                          <p class="pull-right" >  &nbsp;&nbsp;&nbsp;
                             <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_prospect')" > <i class="fa fa-print"  > </i> </span>
                             <a title="Download" href="{!! $download_link !!}" target="_blank" class="btn btn-success" >  <i class="glyphicon glyphicon-download-alt"  > </i> </a>
                          </p>
                      @endif

                      <div id="print_prospect">
                      <table class="table  table-fixed">
                          <thead>
                          <tr>
                              <th style="width: 5%; float: left" >S# </th>
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
                              if(isset($_GET['page'])) $i = (100*((int)$_GET['page']-1));
                          @endphp
                          @foreach($customer_list as $row)

                                  @php
                                      $CID = 10000000+$row->id;
                                      $CID = substr($CID,1,7);
                                      $i++;
                                  @endphp
                              <tr>
                                  <td style="width: 5%; float: left"> {{ $i }} </td>
                                  <td style="width: 8%; float: left"> {{ $CID }} </td>
                                  <td style="width: 25%; float: left">
                                      <button type="button" data-target="#Modal-Edit{!! $i !!}" class="btn btn-outline-primary" data-toggle="modal" title="Click to view information" > {{ $row->prefix }} {{ $row->name }} </button> </td>
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
                                                  <div class="modal-content" style="width: 700px;">
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
                                                                  <div class="col-sm-9"> : {{ @$contact->address_1.' '.@$contact->city.' '.@$contact->district }} </div>
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
        .bg-green { background-color: #398439 }
        .bg-red { background-color: #c12e2a }
        .bg-yellow { background-color: #9ad717 }
        .flate-box { height: 80px; width: 100%; margin-bottom: 6px; text-align: center; padding-top: 10px; font-size: 16px; }
      </style>
@endsection    