@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Pre-Schedule </div>

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-info">{{ Session::get('error') }}</div>
                    @endif


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#pre-schedule-modal">
                        <i class="fa fa-plus" ></i>  Add New
                    </button>

                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Schedule ID</th>
                            <th> Prospect </th>
                            <th> Project</th>
                            <th> Property</th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($pre_schedules as $row)
                           @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>PS{!! $row->id +1000 !!} </td>
                                <td><b>{!!$row->prefix!!} {{$row->name}}</b></td>
                                <td>{{$row->project_title}}</td>
                                <td>{{$row->property_title}}</td>
                                <td>
                                    <a href="{{ url('/pre-schedules-status/'.$row->id.'/') }}" class="btn btn-success pull-left"> <i class="fa fa-eye" ></i> View</a>
                                    <a href="{{ url('/pre-schedules-delete/'.$row->id.'/') }}" class="btn btn-danger " style="margin-left: 4px;"  onclick="return confirm('Are you sure you want to delete?')" > <i class="fa fa-trash-o" ></i> Delete </a>
                                </td>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


          <!-- Modal -->
          <div class="modal fade" id="pre-schedule-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"> Create Pre-Schedule </h5>

                      </div>
                      <div class="modal-body">
                          <form class="form-horizontal" onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/create-pre-schedule') }}" method="POST">
                              <input type="hidden" name="prospect_id" value="{!! $prospect_id !!}">
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name">Project</label>
                                  <div class="col-sm-5">
                                      <select id="project" name="project_id" class="selectpicker form-control" data-live-search="true">
                                          <option  value="" > select </option>
                                          @if(isset($projects))
                                              @foreach($projects as $row)
                                                  <option  value="{{ $row->id }}"  @if(isset($item->project_id) && $item->project_id == $row->id) selected="selected" @endif >{{ $row->title }} </option>
                                              @endforeach
                                          @endif
                                      </select>
                                  </div>

                              </div>

                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name">Appartment No</label>
                                  <div class="col-sm-5">
                                      <select name="property_id" id="property_id" class=" form-control">
                                          @if(isset($proparties))
                                              @foreach($proparties as $row)
                                                  <option  value="{{ $row->id }}"  @if(isset($item->property_id) && $item->property_id == $row->id) selected="selected" @endif >{{ $row->title }} </option>
                                              @endforeach
                                          @endif

                                      </select>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name">Car Parking </label>
                                  <div class="col-sm-5" id="parking_div" >

                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Discount Amount </label>
                                  <div class="col-sm-5">
                                      <input name="discount_amount" onblur="SetDiscount(this.value);" id="discount_amount" type="text" value="0" class="form-control"  />
                                  </div>
                              </div>


                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Purchase price </label>
                                  <div class="col-sm-5">
                                      <input name="purchase_price" id="purchase_price" type="text" value="" class="form-control" readonly required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Earnest Money </label>
                                  <div class="col-sm-5">
                                      <input name="earnest_money" id="earnest_money" type="text" autocomplete="off" value="0" class="form-control" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Down Payment </label>
                                  <div class="col-sm-5">
                                      <input name="down_payment" id="down_payment" type="text" autocomplete="off" value="0" class="form-control" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Balance amount   </label>
                                  <div class="col-sm-5">
                                      <input name="loan_amount" id="loan_amount" type="text" value="" readonly class="form-control" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Periods (Months) </label>
                                  <div class="col-sm-5">
                                      <input name="periods" id="periods" type="text" value="" class="form-control" autocomplete="off" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Monthly payment  </label>
                                  <div class="col-sm-5">
                                      <input name="monthly_payment" id="monthly_payment" readonly type="text" value="" class="form-control" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Delay rate (%) </label>
                                  <div class="col-sm-5">
                                      <input name="delay_rate" id="delay_rate" type="text" value="" autocomplete="off" class="form-control" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Rebate rate (%) </label>
                                  <div class="col-sm-5">
                                      <input name="redate_rate" id="redate_rate" type="text" value="{!! old('redate_rate') !!}" autocomplete="off" class="form-control" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-5 control-label" for="name"> Frist payment date  </label>
                                  <div class="col-sm-5">
                                      <input name="frist_payment_date" id="frist_payment_date" type="date" value="{!! old('frist_payment_date') !!}" class="form-control" required>
                                  </div>
                              </div>


                              <div class="form-group">
                                  <div class="col-sm-5">&nbsp;</div>
                                  <div class="col-sm-5">
                                      <button type="submit" class="btn btn-info pull-right">Submit</button>
                                  </div>
                              </div>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                              <input type="hidden" id="flat_price" value=""/>
                              <input type="hidden" id="parking_price" value=""/>

                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>

          <style>
              #parking_div .checkbox { float: left; margin-right:4px; clear: both; }
          </style>

</section>

@endsection
