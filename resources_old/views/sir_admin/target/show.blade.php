@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif
                    <div class="row">
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Client Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Name : </dt>
                <dd> {!! @$clients->name; !!} </dd>
                <dt>Mobile : </dt>
                <dd>{!! @$contacts->mobile !!}</dd>
                <dt>Email : </dt>
                <dd>{!! @$contacts->email !!}</dd>
                <dt>Address :</dt>
                <dd>{!! @$contacts->address_1 !!}</dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
        <div class="col-md-6">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Property Info</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <dl class="dl-horizontal">
                <dt>Property Name : </dt>
                <dd>{!! @$property->title !!}</dd>
                <dt>Floor No : </dt>
                <dd>{!! @$property->floor_no !!}</dd>
                <dt>Unit No : </dt>
                <dd>{!! @$property->unit_no !!}</dd>
                <dt>Price :</dt>
                <dd>{!! number_format(@$property->price) !!}</dd>
              </dl>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- ./col -->
      </div>
                    <div class="panel-heading" style="text-align: center;"> Transaction List </div>
                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Date</th>
                            <th> Amount</th>
                            <th> Check No</th>
                            <th> Bank</th>
                            <th> Remark</th>
                            <th> Status </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($items as $row)
                           @php
                                $i++;
                                if($row->status==0) $status="Pending"; else $status="Approve";
                                if($row->check_no=="") $p_mode="Cash Payment"; else $p_mode=$row->check_no;
                                if($row->bank=="") $bank=$row->mr_no; else $bank=$row->bank;
                           @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td> {!!  date("j F,  Y",strtotime($row->payment_date));  !!}</td>
                                <td>{!! number_format($row->amount) !!}</td>
                                <td>{{$p_mode}}</td>
                                <td>{{$bank}}</td>
                                <td>{!!$row->remark !!}</td>
                                <td>{!!$status !!}</td>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
@endsection
