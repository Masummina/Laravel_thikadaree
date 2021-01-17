@extends('admin.layouts.layout')

@section('content')

  @php
    $colors = array('72c5e5','00a65a','dd4b39','f39c12','b64dd9');
    $G_M_T_S = '';
    $G_M_T_S_N = '';
    $G_M_PiChart = '';
    $c=0;
  
    
    $G_M_T_S = rtrim($G_M_T_S,',');
    $G_M_T_S_N = rtrim($G_M_T_S_N,',');
    $G_M_PiChart = rtrim($G_M_PiChart,',');

    $B_C_L = '';
    $B_C_S_V = '';
    $B_C_US_V = '';
  
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
                      @if(isset($summery))
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
                      @endif
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
                                  
                               </div>
                               <!-- /.col -->
                             </div>
                             <!-- /.row -->
                           </div>
                           <!-- /.box-body -->                       
                         </div>
                      </div>
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
 
@endsection    