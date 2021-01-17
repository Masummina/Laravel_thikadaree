@extends('admin.layouts.layout')

@section('content')

  @php
    $colors = array('72c5e5','00a65a','dd4b39','f39c12','b64dd9');
    $G_M_T_S = '';
    $G_M_T_S_N = '';
    $G_M_PiChart = '';
    $c=0;
    foreach($summery as $row)
    {
      $title = $row->status;
      $total = $row->total;
      $G_M_T_S .= "'".$title."',";
      $G_M_T_S_N .= $total.",";

      $G_M_PiChart .= "{ value : ".$total.", color : '#".$colors[$c]."', highlight: '#353ae7', label : '".$title."' },";
      $c++;
      if($c==5){  $c=0; }
    }
    
    $G_M_T_S = rtrim($G_M_T_S,',');
    $G_M_T_S_N = rtrim($G_M_T_S_N,',');
    $G_M_PiChart = rtrim($G_M_PiChart,',');

    $B_C_L = '';
    $B_C_S_V = '';
    $B_C_US_V = '';
    foreach($chartSummery as $row)
    {      
      $title = $row->value;
      $unsolved = $row->unsolved;
      $solved = $row->solved;
      $B_C_L .= "'".$title."',";
      $B_C_S_V .= $solved.",";
      $B_C_US_V .= $unsolved.",";
    }
  @endphp

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
     <section class="content-header clearfix">
        <h1 id="s16" class="pull-left">  Dashboard </h1>
        <form  method="get" action="">
                <div class="pull-right d_search"> 
                    <span>From
                        <input type="date" name="f_date" value="{{@$_GET["f_date"]}}" class="form-control" style="width:130px">
                    </span><span>To
                        <input type="date" name="to_date" value="{{@$_GET["to_date"]}}" class="form-control" style="width:130px">
                    </span><span>Month
                      <input name="month" id="startDate" value="{{@$_GET["month"]}}" class="form-control" autocomplete="off" style="width:130px">
                  </span>
                 <input type="submit" class="btn btn-primary" value=" GO " name="submit" style="float:right;">
                </div>
                </form>
      </section>
      @php
        if(isset($_GET["month"]) && $_GET["month"]!=''){
          $f_date =  date("Y-m-d", strtotime($_GET['month']));
          $to_date = date("Y-m-t", strtotime($_GET['month']));
        }
        elseif(isset($_GET["f_date"]) && $_GET["f_date"]!=''){
          $f_date = $_GET['f_date'];
          $to_date = $_GET['to_date'];
        }
        else{
          $f_date = date('Y-m-01');
          $to_date = date('Y-m-d');
        } 
      @endphp
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
                  <div class="row clearfix">
                    <div class="row">
                      @foreach($summery as $row)
                      <div class="topbar col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                          <a href="{!! url('complains?status='.$row->status.'&from_date='.@$_GET["f_date"]).'&to_date='.@$_GET["to_date"] !!}">
                          <span class="info-box-icon @if($row->status=='Unsolved') bg-unsolved @elseif($row->status=='Solved') bg-solved @elseif($row->status=='Partially Solved') bg-partially-solved @elseif($row->status=='Active') bg-active @elseif($row->status=='Pending') bg-pending @endif"><i class="fa @if($row->status=='Unsolved') fa-ban @elseif($row->status=='Solved') fa-check @elseif($row->status=='Partially Solved') fa-battery-half @elseif($row->status=='Active') fa-thumbs-up @elseif($row->status=='Pending') fa-spinner @endif" aria-hidden="true"></i></span>
                          <div class="info-box-content">
                            <span id="s14" class="info-box-text">{!! $row->status !!}  </span>
                            <span id="s14" class="info-box-number">{!! $row->total !!}</span>
                          </div>
                          </a>
                        </div>
                      </div>
                      @endforeach
                      <!-- /.col -->
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <i class="fa fa-bar-chart-o"></i>
                            <h3 id="s14" class="box-title">Complaint History </h3>
                            <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                          </div>
                          <div class="box-body">
                            <canvas id="comHistoryChart" style="height: 300px;"></canvas>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="box box-primary">
                           <div class="box-header with-border">
                             <h3 id="s14" class="box-title">Pie Chart Based on Status</h3>
                             <div class="box-tools pull-right">
                               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                               </button>
                               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                             </div>
                           </div>
                           <!-- /.box-header -->
                           <div class="box-body">
                             <div class="row">
                               <div class="col-md-8">
                                 <div class="chart-responsive">
                                   <canvas id="dashCompPieChart" height="170" width="205" style="width: 205px; height: 170px;"></canvas>
                                 </div>
                                 <!-- ./chart-responsive -->
                               </div>
                               <!-- /.col -->
                               <div class="col-md-4">
                                 <ul class="chart-legend clearfix">
                                  @php
                                    $i = 0;
                                    $colors = array('72c5e5','00a65a','dd4b39','f39c12','b64dd9','353ae7');
                                   
                                    @endphp

                                  @foreach($summery as $row)
                                    <li><i class="fa fa-circle-o" style="color: #{!! $colors[$i] !!}"></i>{!! $row->status !!}</li>
                                    @php $i++; @endphp
                                   @endforeach
                                 </ul>
                               </div>
                               <!-- /.col -->
                             </div>
                             <!-- /.row -->
                           </div>
                           <!-- /.box-body -->                       
                         </div>
                      </div>
                    </div>
                                        
                    <div class="row">
                      <div class="col-md-12">
                        <div class="">
                          <!-- /.box-header -->
                          <div class="box-body">
 
                            <div class="row">
                              <div class="col-md-4">
                                <div class="box box-primary">
                                  <div class="box-header with-border">
                                    <h3 id="s14" class="box-title">Highest Complaints by Projects</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                  </div>
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                    <div class="table-responsive">
                                      <table class="table no-margin">
                                        <tbody>
                                          @foreach($highest as $row)
                                            @php 
                                              $per = $row->total*100/$totalComplain;
                                              $per = number_format((float)$per, 2, '.', ''); 
                                            @endphp
                                            <tr>
                                              <td><i class="fa fa-building" aria-hidden="true"></i> {!! $row->title !!}</td>
                                              <td>{!! $row->total !!}</td>
                                              <td>{!! $per !!}%</td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                  </div>
                                  <!-- /.box-body -->
                                  <div class="box-footer clearfix">
                                    <a href="{!! url('project-wise-report?from_date='.@$f_date).'&to_date='.@$to_date !!}" class="btn btn-sm btn-info btn-flat pull-right">View All</a>
                                  </div>
                                  <!-- /.box-footer -->
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="box box-primary">
                                  <div class="box-header with-border">
                                    <h3 id="s14" class="box-title">Lowest Complaints by Projects</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                  </div>
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                    <div class="table-responsive">
                                      <table class="table no-margin">
                                        <tbody>
                                          @foreach($lowest as $row)
                                            @php 
                                              $per = $row->total*100/$totalComplain;
                                              $per = number_format((float)$per, 2, '.', ''); 
                                            @endphp
                                            <tr>
                                              <td><i class="fa fa-building" aria-hidden="true"></i> {!! $row->title !!}</td>
                                              <td>{!! $row->total !!}</td>
                                              <td>{!! $per !!}%</td>
                                            </tr>
                                          @endforeach
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                  </div>
                                  <!-- /.box-body -->
                                  <div class="box-footer clearfix">
                                    <a href="{!! url('project-wise-report?from_date='.@$f_date).'&to_date='.@$to_date !!}" class="btn btn-sm btn-info btn-flat pull-right">View All</a>
                                  </div>
                                  <!-- /.box-footer -->
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="box box-primary">
                                  <div class="box-header with-border">
                                    <h3 id="s14" class="box-title">Complaints by Category</h3>
                                    <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                  </div>
                                  <!-- /.box-header -->
                                  <div class="box-body">
                                    <div class="table-responsive">
                                      <table class="table no-margin">
                                        <thead>     
                                            <tr>
                                                <td> Category </td>
                                                <td> Solved </td>
                                                <td> Unsolved </td>
                                                <td> Total </td>
                                              </tr>
                                        <thead>     
                                        <tbody>     
                                          @foreach($chartSummery as $row)
                                            @if(($row->unsolved+$row->solved)>0)
                                              <tr>
                                                <td><i class="fa fa-building" aria-hidden="true"></i> {!! $row->value !!}</td>
                                                <td>{!! $row->solved !!}</td>
                                                <td>{!! $row->unsolved !!}</td>
                                                <td>{!! ($row->unsolved+$row->solved) !!}</td>
                                              </tr>
                                            @endif
                                          @endforeach
                                        </tbody>
                                      </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                  </div>
                                  <!-- /.box-body -->
                                  <div class="box-footer clearfix">
                                    <a href="{!! url('top-sheet?from_date='.@$f_date).'&to_date='.@$to_date !!}" class="btn btn-sm btn-info btn-flat pull-right">View All</a>
                                  </div> 
                                  <!-- /.box-footer -->
                                </div>
                              </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                  <div class="box box-primary">
                                    <div class="box-header with-border">
                                      <h3 id="s14" class="box-title">Recent Complaints </h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                      <div class="table-responsive">
                                        <table class="table no-margin">
                                          <tbody>
                                            @php
                                              $now = time();
                                            @endphp
                                            @foreach($complains as $row)
                                            <tr>
                                              <td>{!! $row->c_name !!}</td>
                                              <td>{!! $row->com_title !!}</td>
                                              <td><span class="label label-@if($row->status=='Unsolved')error @elseif($row->status=='Solved')success @elseif($row->status=='Partially Solved')warning @elseif($row->status=='Active')running @elseif($row->status=='Pending')pending @else label-default @endif">{!! $row->status !!}</span> 
                                                </td>
                                              <td>
                                                @php
                                                  $comDate = strtotime($row->date);
                                                  $datediff = $now - $comDate;
                                                  $days = round($datediff / (60 * 60 * 24));
                                                @endphp
                                                {!! $days !!} Days ago
                                              </td>
                                            </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer clearfix">
                                      <a href="{!! url('complains?from_date='.@$f_date).'&to_date='.@$to_date !!}" class="btn btn-sm btn-info btn-flat pull-right">View All</a>
                                    </div>
                                    <!-- /.box-footer -->
                                  </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="box box-primary">
                                      <div class="box-header with-border">
                                        <h3 id="s14" class="box-title">Pending Complaints </h3>
                                        <div class="box-tools pull-right">
                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                          </button>
                                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body">
                                        <div class="table-responsive">
                                          <table class="table no-margin">
                                            <tbody>
                                              @php
                                                $now = time();
                                              @endphp
                                              @foreach($pending as $row)
                                              <tr>
                                                <td>{!! $row->c_name !!}</td>
                                                <td>{!! $row->com_title !!}</td>
                                                <td><span style="background-color:#b64dd9; color:white;">Pending</span></td>
                                                <td>
                                                  @php
                                                    $comDate = strtotime($row->date);
                                                    $datediff = $now - $comDate;
                                                    $days = round($datediff / (60 * 60 * 24));
                                                  @endphp
                                                  {!! $days !!} Days ago
                                                </td>
                                              </tr>
                                              @endforeach
                                            </tbody>
                                          </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                      </div>
                                      <!-- /.box-body -->
                                      <div class="box-footer clearfix">
                                        <a href="{!! url('complains?status=Pending'.'&from_date='.@$f_date).'&to_date='.@$to_date !!}" class="btn btn-sm btn-info btn-flat pull-right">View All</a>
                                      </div>
                                      <!-- /.box-footer -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="box box-primary">
                                    <div class="box-header with-border">
                                      <h3 id="s14" class="box-title">Recent Invoicing </h3>
                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                      <div class="table-responsive">
                                        <table class="table no-margin">
                                          <tbody>
                                            @foreach($invoices as $row)
                                            <tr>
                                              <td>IN-{!! $row->id !!}</td>
                                              <td>{!! $row->prob_type !!}</td>
                                              <td>@if($row->status==0) 
                                                  <span class="label label-error">Unpaid</span> 
                                                @elseif($row->status==1) 
                                                  <span class="label label-success">Paid</span> 
                                                @elseif($row->status==2) 
                                                  <span class="label label-warning">Outstanding</span>
                                                @endif</td>
                                              <td>BDT {!! $row->payable !!}</td>
                                            </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.table-responsive -->
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer clearfix">
                                      <a href="{!! url('invoice?from_date='.@$f_date).'&to_date='.@$to_date !!}" class="btn btn-sm btn-info btn-flat pull-right">View All</a>
                                    </div> 
                                    <!-- /.box-footer -->
                                  </div>
                                </div>
                              </div> 

                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- ./box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                    <!-- /.col -->
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
<script>

  
$(function () {
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#dashCompPieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    {!! $G_M_PiChart !!}
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
      // String - A tooltip template
      tooltipTemplate      : '<%=value %> <%=label%>'
    };
    // Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
    // -----------------
    // - END PIE CHART -
    // -----------------
  
});


var areaChartData = {
 labels  : [{!! $B_C_L !!}],
 datasets: [
   {
     label               : 'Unsolved',
     fillColor           : '#dd4b39',
     strokeColor         : '#dd4b39',
     pointColor          : '#dd4b39',
     pointStrokeColor    : '#dd4b39',
     pointHighlightFill  : '#fff',
     pointHighlightStroke: '#dd4b39',
     data                : [{!! $B_C_US_V !!}]
   },
   {
     label               : 'Solved',
     fillColor           : '#00a65a',
     strokeColor         : '#00a65a',
     pointColor          : '#00a65a',
     pointStrokeColor    : '#00a65a',
     pointHighlightFill  : '#fff',
     pointHighlightStroke: '#00a65a',
     data                : [{!! $B_C_S_V !!}]
   }
 ]
}

$(function () {
 var barChartCanvas                   = $('#comHistoryChart').get(0).getContext('2d')
 var barChart                         = new Chart(barChartCanvas)
 var barChartData                     = areaChartData
 barChartData.datasets[1].fillColor   = '#00a65a'
 barChartData.datasets[1].strokeColor = '#00a65a'
 barChartData.datasets[1].pointColor  = '#00a65a'
 var barChartOptions                  = {
   //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
   scaleBeginAtZero        : true,
   //Boolean - Whether grid lines are shown across the chart
   scaleShowGridLines      : true,
   //String - Colour of the grid lines
   scaleGridLineColor      : 'rgba(0,0,0,.05)',
   //Number - Width of the grid lines
   scaleGridLineWidth      : 1,
   //Boolean - Whether to show horizontal lines (except X axis)
   scaleShowHorizontalLines: true,
   //Boolean - Whether to show vertical lines (except Y axis)
   scaleShowVerticalLines  : true,
   //Boolean - If there is a stroke on each bar
   barShowStroke           : true,
   //Number - Pixel width of the bar stroke
   barStrokeWidth          : 2,
   //Number - Spacing between each of the X value sets
   barValueSpacing         : 12,
   //Number - Spacing between data sets within X values
   barDatasetSpacing       : 10,
   //String - A legend template
   legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',

   //Boolean - whether to make the chart responsive
   responsive              : true,
   maintainAspectRatio     : true
 }

 barChartOptions.datasetFill = false
 barChart.Bar(barChartData, barChartOptions);

});
$(function() {
        $("#startDate").datepicker( {
            format: "dd-mm-yyyy",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });
    });
</script>

@endsection    