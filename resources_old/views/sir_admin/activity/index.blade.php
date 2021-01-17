@extends('admin.layouts.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header clearfix" id="fixednavbar">
        <h1 class="pull-left">  All Activities </h1>

        @php $group_id = \Auth::user()->group_id; @endphp

          <div class="row">
              <div class="col-xs-12">

            <form id="advanced_s" method="get" class="  form-inline my-2 my-lg-0" action="">

              <div class="row mt-1">
                  <div class="col-sm-3">
                      @if($group_id<4)
                          @php if(!isset($_GET["user"])) $_GET["user"]= Auth::user()->id; @endphp
                          @if(count($team_memebers)>1 && Auth::user()->group_id<4)
                              <span class="report-headline"> Member : </span>
                              <select name="user" class="form-control" id="exampleSelect1" style="width: 170px !important;">
                                  <option value="all">All Memeber</option>
                                  @foreach ($team_memebers as $user)
                                      <option @if(@$_GET["user"]==$user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                  @endforeach
                              </select>
                          @endif
                      @endif
                  </div>
                  <div class="col-sm-5">
                      <span class="report-headline"> By Date : </span>
                      <input name="from" type="date"  name="prefix"  class="form-control" value="{{@$_GET["from"]}}">
                      to
                      <input name="to" type="date"  name="prefix"  class="form-control" value="{{@$_GET["to"]}}">

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
                      <select name="profession" class="form-control" id="area_size" style="width: 140px !important;" >
                          <option value="">Select Profession</option>
                          @foreach ($profession as $p)
                              <option  @if(@$_GET['profession']==$p->id) selected @endif  value="{{$p->id}}">{{$p->title}}</option>
                          @endforeach
                      </select>

                      <span class="report-headline">  Name : </span>
                      <input type="text" name="customer_name" value="{{@$_GET['customer_name']}}" style="width: 130px" >
                      <span class="report-headline"> Mobile : </span>
                      <input type="text" name="customer_mobile" value="{{@$_GET['customer_mobile']}}" style="width: 100px" >
                      <input  type="submit" class="btn btn-primary" value=" Search " name="submit">
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


                  @if($activities)

                      @if(isset($activities[0]))
                          @php $download_link=url('download-activity-report'); @endphp
                          <p class="pull-right" >  &nbsp;&nbsp;&nbsp;
                              <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_able')" > <i class="glyphicon glyphicon-print"  > </i> </span>
                              <a title="Download" href="{!! $download_link !!}" target="_blank" class="btn btn-success" >  <i class="glyphicon glyphicon-download-alt"  > </i> </a>
                          </p>
                      @endif

                      <div id="print_able">
                      <table class="table  table-fixed">
                          <thead>
                          <tr>
                              <th style="width: 3%; float: left">S#</th>
                              <th style="width: 8%; float: left">ID </th>
                              <th style="width: 10%; float: left">Activity Date </th>
                              <th style="width: 12%; float: left">Today's Action </th>
                              <th style="width: 18%; float: left"><b>Name</b></th>
                              <th style="width: 12%; float: left">Project</th>
                              <th style="width: 14%; float: left">Team Member </th>
                              <th style="width: 10%; float: left">Next Action </th>
                              <th style="width: 13%; float: left">Action Date </th>

                          </tr>
                          </thead>
                          <tbody>

                          @php $i=0;
                              $j=0;
                              if(isset($_GET['page'])) $j = (100*((int)$_GET['page']-1));
                              $j++;
                          @endphp
                          @foreach($activities as $row)

                                  @php $i++; @endphp
                                  @php
                                      $CID = 10000000+$row->customer_id;
                                      $CID = substr($CID,1,7);
                                  @endphp

                                <tr>
                                  <td style="width: 3%; float: left"> {{ $j}} </td>
                                  <td style="width: 8%; float: left"> {{ $CID}} </td>
                                  <td style="width: 10%; float: left"> @php echo date('jS  F y g:i A ', strtotime($row->created_at)); @endphp </td>
                                  <td style="width: 12%; float: left"> {{ $row->contact_method }} </td>
                                  <td style="width: 18%; float: left"> <b> {{ $row->prefix }} {{ $row->name }} </b> </td>
                                  @php
                                      $i++; $j++;
                                      $project_name=null;
                                      if(isset($project))
                                      {
                                            foreach ($project as  $p)
                                            {
                                                if($row->project_id == $p->id)
                                                {
                                                    $project_name=$p->title; break;
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
                                                    $property_name=$p->title; break;
                                                }
                                            }
                                      }
                                   @endphp
                                  <td style="width: 12%; float: left">{{$project_name}}</td>

                                  <td style="width: 12%; float: left">{{ $row->created }}  </td>

                                  <td style="width: 10%; float: left">{{ $row->next_action }}</td>
                                  <td style="width: 13%; float: left">
                                      {!! date('jS  F y g:i A', strtotime($row->next_action_date)); !!}
                                      @php
                                      $timeFirst  = strtotime($row->next_action_date);
                                      $timeSecond = strtotime(date("y-m-d H:i:s"));
                                      $differenceInSeconds = $timeFirst-$timeSecond;
                                      $days = floor($differenceInSeconds/86400);
                                      @endphp
                                      <a style="margin-left: 4px;" href="{!! url('activity/create?id='.$row->customer_id) !!}" class="btn btn-success pull-left" title="Contact"> <i class="glyphicon glyphicon-phone-alt"  ></i> </a>  &nbsp;

                                  </td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                      </div>
                      <div class="pull-right" style="display: inline-flex" >
                        {{ $activities->appends($link)->links() }}
                      </div>
                  @endif

                  </div>
                </div>

                <style>
                    @php $total_c = count($activities); @endphp
                    @if($total_c>4)
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