@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
         <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border"> <h3 class="box-title"> Create Account </h3> </div>
                <div class="box-body">
                    @if(count($errors)>0)
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif

                    <form class="form-horizontal" onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('id'){{ url('/account') }}/@yield('id')@else {{ url('/account') }} @endif" method="POST">
                        @section('editMethod')
                        @show
                        <div class="form-group">
                          <label class="col-sm-3 control-label" for="name">Client</label>
                           <div class="col-sm-7">
                           <select id="client" name="client_id" class="selectpicker form-control" data-live-search="true">
                               <option  value="" > Select Client </option>
                            @if(isset($clients))
                                @foreach($clients as $row)
                                    <option  value="{{ $row->id }}"  @if(isset($item->client_id) && $item->client_id == $row->id) selected="selected" @endif >{{ $row->prefix }} {{ $row->name }} </option>
                                @endforeach
                            @endif
                          </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Project</label>
                            <div class="col-sm-7">
                            <select id="project" name="project_id" class="selectpicker form-control" data-live-search="true" required>
                                <option  value="" > Select Project </option>
                            @if(isset($projects))
                                @foreach($projects as $row)
                                    <option  value="{{ $row->id }}"  @if(isset($item->project_id) && $item->project_id == $row->id) selected="selected" @endif >{{ $row->title }} </option>
                                @endforeach
                            @endif
                          </select>
                        </div>
                        
                        </div>

                         <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Appartment No</label>
                            <div class="col-sm-7">
                           <select name="property_id" id="property_id" class=" form-control" required>
                            @if(isset($proparties))
                                @foreach($proparties as $row)
                                    <option  value="{{ $row->id }}"  @if(isset($item->property_id) && $item->property_id == $row->id) selected="selected" @endif >{{ $row->title }} </option>
                                @endforeach
                            @endif
                             
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name">Car Parking </label>
                            <div class="col-sm-7" id="parking_div" >

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Discount Amount </label>
                            <div class="col-sm-7">
                                <input name="discount_amount" onblur="SetDiscount(this.value);" id="discount_amount" type="text" value="0" class="form-control"  required/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Purchase price </label>
                            <div class="col-sm-7">
                                <input name="purchase_price" id="purchase_price" type="text" value="{!! old('purchase_price') !!}" class="form-control" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Earnest Money </label>
                            <div class="col-sm-7">
                                <input name="earnest_money" id="earnest_money" type="text" autocomplete="off" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Down Payment </label>
                            <div class="col-sm-7">
                                <input name="down_payment" id="down_payment" type="text" autocomplete="off" value="" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Balance  amount   </label>
                            <div class="col-sm-7">
                                <input name="loan_amount" id="loan_amount" type="text" value="" readonly class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Periods (Months) </label>
                            <div class="col-sm-7">
                                <input name="periods" id="periods" type="text" value="" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Monthly payment  </label>
                            <div class="col-sm-7">
                                <input name="monthly_payment" id="monthly_payment" readonly type="text" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Delay rate (%) </label>
                            <div class="col-sm-7">
                                <input name="delay_rate" id="delay_rate" type="text" value="" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Rebate rate (%) </label>
                            <div class="col-sm-7">
                                <input name="redate_rate" id="redate_rate" type="text" value="{!! old('redate_rate') !!}" autocomplete="off" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> First payment date  </label>
                            <div class="col-sm-7">
                                <input name="frist_payment_date" id="frist_payment_date" type="date" value="{!! old('frist_payment_date') !!}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-3 control-label" for="name"> Handover date  </label>
                                <div class="col-sm-7">
                                    <input name="handover_date" id="handover_date" type="date" value="{!! old('handover_date') !!}" class="form-control" required>
                                </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="name"> Sales Person </label>
                            <div class="col-sm-7">
                                <select id="saler_id" name="saler_id" class="selectpicker form-control" data-live-search="true" required>
                                    <option  value="" > Select Sales Person </option>
                                    @if(isset($Sales_Person))
                                        @foreach($Sales_Person as $row)
                                            <option  value="{{ $row->id }}"  @if(isset($item->saler_id) && $item->saler_id == $row->id) selected="selected" @endif >{{ $row->name }} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="col-sm-3">&nbsp;</div> 
                            <div class="col-sm-7">
                          <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </div>
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                        <input type="hidden" id="flat_price" value=""/>
                        <input type="hidden" id="parking_price" value=""/>

                    </form>

                </div>
            </div>
        </div>

            <style>
                .checkbox { float: left; margin: 0px 5px; }
            </style>

            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

@endsection
