@extends('admin.layouts.layout')

@section('content')

<div class="content-wrapper" >

    <div class="box" style="padding-top: 20px;">



    {{Form::open(array('url'=>'property/edit-property/'.$property_id,'method'=>'post', 'class'=>'form-horizontal'))}}

        

        <div class="form-group">

            <label for="inputEmail3" class="col-sm-3 control-label">Property title <span class="text-danger">*</span> </label>

            <div class="col-sm-7">

                <input type="text" value="{{$property_fields->title}}" name="title" parsley-trigger="change" placeholder="Property title" class="form-control" required id="title">

            </div>

        </div>



        <div class="form-group">

            <label for="inputEmail3" class="col-sm-3 control-label">Owner Type<span class="text-danger">*</span> </label>

            <div class="col-sm-7">

                <select name="ownertype" class="form-control"  required>

                    <option value="">Select Owner Type</option>

                    <option value="UDDL" @if($property_fields->owner_type=='UDDL')selected @endif>UDDL</option>

                    <option value="LandOwner" @if($property_fields->owner_type=='LandOwner')selected @endif>LandOwner</option>

                    <option value="Common"

                    @if($property_fields->owner_type=='Common')selected @endif>Common</option>

                </select>

            </div>

        </div>



        <div class="form-group">

            <label for="inputEmail3" class="col-sm-3 control-label">Apartment Type<span class="text-danger">*</span> </label>

            <div class="col-sm-7">

                <select id="propertytype" name="propertytype" class="form-control"  required>

                    <option value="">Select Apartment Type</option>

                    <option value="Parking" @if($property_fields->type=='Parking')selected @endif>Parking</option>

                    <option value="Apartment-Residential" @if($property_fields->type=='Apartment-Residential')selected @endif>Apartment-Residential</option>

                    <option value="Apartment-Commercial" @if($property_fields->type=='Apartment-Commercial')selected @endif>Apartment-Commercial</option>

                    <option value="Commercial" @if($property_fields->type=='Commercial')selected @endif>Commercial</option>

                    <option value="Common Facilities" @if($property_fields->type=='Common Facilities')selected @endif>Common Facilities</option> 

                    <option value="Community Hall" @if($property_fields->type=='Community Hall')selected @endif>Community Hall</option>                

                </select>

            </div>

        </div>



        <div id="parking_type" style="display: @if($property_fields->type !='Parking') none @endif;" class="form-group parkingtype">

            <label for="inputEmail3" class="col-sm-3 control-label">Parking Type<span class="text-danger">*</span> </label>

            <div class="col-sm-7">

                <select id="parking_title" name="parkingtype" class="form-control" >

                    

                    <option value="">Select Parking Type</option>

                        <option value="Ground Floor" @if($property_fields->floor_no=='Ground Floor')selected @endif>Ground Floor</option>

                        <option value="Semi Basement" @if($property_fields->floor_no=='Semi Basement')selected @endif>Semi Basement</option>

                        

                        <option value="Basement 1" @if($property_fields->floor_no=='Basement 1')selected @endif>Basement 1</option>

                            <option value="Basement 2" @if($property_fields->floor_no=='Basement 2')selected @endif>Basement 2</option>

                        <option value="Basement 3" @if($property_fields->floor_no=='Basement 3')selected @endif>Basement 3</option>

                            <option value="Basement 4" @if($property_fields->floor_no=='Basement 4')selected @endif>Basement 4</option>

                            <option value="Basement 5" @if($property_fields->floor_no=='Basement 5')selected @endif>Basement 5</option>

                        <option value="Basement Floor" @if($property_fields->floor_no=='Basement Floor')selected @endif>Basement Floor</option>

                        <option value="Mezzanine Floor" @if($property_fields->floor_no=='Mezzanine Floor')selected @endif>Mezzanine Floor</option>

                </select>

            </div>

        </div>

                   

        <div style="display: @if($property_fields->type=='Parking') none @endif" class="apperment_type">

                        

                <div class="form-group">

                    <label for="inputEmail3" class="col-sm-3 control-label">Floor No <span class="text-danger">*</span> </label>

                    <div class="col-sm-7">

                        <input type="text" value="{{$property_fields->floor_no}}" name="floor_no" parsley-trigger="change" placeholder="Floor No" class="form-control" id="title">

                    </div>

                </div>



                {{-- <div class="form-group">

                    <label for="inputEmail3" class="col-sm-3 control-label">Size <span class="text-danger">*</span></label>

                    <div class="col-sm-7">

                    <input type="text" value="{!!$property_fields->description!!}" name="description" 

                                        placeholder="Facing" class="form-control" id="editor_no">

                    </div>

                </div> --}}

            

        

            

                <div class="form-group">

                    <label for="inputEmail3" class="col-sm-3 control-label">Facing<span class="text-danger">*</span> </label>

                    <div class="col-sm-7">

                        <input type="text" value="{!!$property_fields->facing!!}" name="facing" 

                            placeholder="Facing" class="form-control" id="title">

                    </div>

                </div>                 

                    

        </div>

 

<script type="text/javascript">

    function changeSF(in_value, put_div, in_sft)

    {

        var sft = $("#"+in_sft).val();  

        if(in_value>0){

            var div_value = in_value/sft;

        } else {

            var div_value = 0;

        }    

        

        $("#"+put_div).html('@ '+div_value.toFixed(2)+' p/sft ');

        //var integer = parseInt(text, 10);



        total_price();

    }



    function changeReservedParking()

    {

        total_price();

        //alert("cccc");

    }



    function total_price()

    {

        var t_price = Number($("#apt_comm_price").val());        

        var t_price = t_price+Number($("#planter_price").val());

        var t_price = t_price+Number($("#e_slab_price").val());

        var t_price = t_price+Number($("#g_terrace_price").val());

        $("#price").val(t_price);



        var t_price = t_price+Number($("#r_parking_price").val());

        $("#total_price").val(t_price);

    }





</script>    



        <div style="display: @if($property_fields->type=='Parking') none @endif" class="apperment_type">

          

        



            @php 

               if($property_fields->apt_comm_size>0)

               {

                $apt = number_format($property_fields->apt_comm_price/$property_fields->apt_comm_size,2);

               } else {

                $apt = '';

               }               

            @endphp



            <div class="form-group">

                <label for="inputEmail3" class="col-sm-3 control-label">Apt./Comm. : </label>

                <div class="col-sm-7">

                    <input type="text" value="{!!$property_fields->apt_comm_size!!}" name="apt_comm_size" id="apt_comm_size" class="form-control inp_10" > <span class="inp_20"> sft </span> 

                    <span class="inp_40" id="apt_S"> @ {!! $apt !!} p/sft </span> 

                    <input type="text" value="{!! $property_fields->apt_comm_price !!} " name="apt_comm_price" id="apt_comm_price" onblur="changeSF(this.value,'apt_S','apt_comm_size');" class="form-control inp_30" > <span class="inp_20"> BDT </span> 

                </div>

            </div>

            

            @php 

               if($property_fields->planter_size>0)

               {

                $planter = number_format($property_fields->planter_price/$property_fields->planter_size,2);

               } else {

                $planter = '';

               }               

            @endphp

            <div class="form-group">

                <label for="inputEmail3" class="col-sm-3 control-label">Planter : </label>

                <div class="col-sm-7">

                    <input type="text" value="{!!$property_fields->planter_size!!}" name="planter_size" id="planter_size" class="form-control inp_10" > <span class="inp_20"> sft </span> 

                    <span class="inp_40" id="P_S"> @ {!! $planter !!} p/sft </span> 

                    <input type="text" value="{!! $property_fields->planter_price !!} " name="planter_price" id="planter_price" onblur="changeSF(this.value,'P_S','planter_size');" class="form-control inp_30" > <span class="inp_20"> BDT </span> 

                </div>

            </div>

            @php 

               if($property_fields->e_slab_size>0)

               {

                $Extended = number_format($property_fields->e_slab_price/$property_fields->e_slab_size,2);

               } else {

                $Extended = '';

               }               

            @endphp

            <div class="form-group">

                <label for="inputEmail3" class="col-sm-3 control-label">Extended Slab  : </label>

                <div class="col-sm-7">

                    <input type="text" value="{!!$property_fields->e_slab_size!!}" name="e_slab_size" id="e_slab_size" class="form-control inp_10" > <span class="inp_20"> sft </span>

                    <span class="inp_40" id="ES_S"> @ {!! $Extended !!} p/sft </span> 

                    <input type="text" value="{!!$property_fields->e_slab_price!!}" name="e_slab_price" id="e_slab_price" onblur="changeSF(this.value,'ES_S','e_slab_size');" class="form-control inp_30" > <span class="inp_20"> BDT </span> 

                </div>

            </div>

            @php 

               if($property_fields->g_terrace_size>0)

               {

                $Garden = number_format($property_fields->g_terrace_price/$property_fields->g_terrace_size,2);

               } else {

                $Garden = '';

               }               

            @endphp

            <div class="form-group">

                <label for="inputEmail3" class="col-sm-3 control-label">Garden Terrace : </label>

                <div class="col-sm-7">

                    <input type="text" value="{!!$property_fields->g_terrace_size!!}" name="g_terrace_size" id="g_terrace_size" class="form-control inp_10" > <span class="inp_20"> sft </span>

                    <span class="inp_40" id="GT_S"> @ {!! $Garden; !!} p/sft </span> 

                    <input type="text" value="{!!$property_fields->g_terrace_price!!}" name="g_terrace_price" id="g_terrace_price" onblur="changeSF(this.value,'GT_S','g_terrace_size');" class="form-control inp_30" > <span class="inp_20"> BDT </span>

                </div>

            </div>





        </div>



        <div class="form-group">

            <label for="inputEmail3" class="col-sm-3 control-label">Property price <span class="text-danger">*</span> </label>

            <div class="col-sm-7">       

                    <span class="inp_40">  &nbsp;  </span>

                    <span class="inp_40" >  &nbsp;  </span>  

                    <input type="text" name="price" id="price" value="{{$property_fields->price}}" parsley-trigger="change" placeholder="Property price" required class="form-control inp_30" id="title" required> <span class="inp_20"> BDT </span>

            </div>

        </div>



        <div class="form-group">

            <label for="inputEmail3" class="col-sm-3 control-label">Reserved Parking : </label>

            <div class="col-sm-7">

                <select id="parking_no" name="nop" class="form-control inp_60" >

                    <option value="">Select Parking</option>

                    <option value="0" @if($property_fields->no_parking=='0')selected @endif>0</option>

                    <option value="1" @if($property_fields->no_parking=='1')selected @endif>1</option>

                    <option value="2" @if($property_fields->no_parking=='2')selected @endif>2</option>

                    <option value="3" @if($property_fields->no_parking=='3')selected @endif>3</option>

                </select>

                <!-- <input type="text" value="{!!$property_fields->r_parking!!}" name="r_parking" class="form-control inp_10" > -->

                <span class="inp_20"> nos </span> 

                <span style="float: left; width: 43px;">  &nbsp;  </span>

                <input type="text" value="{!! $property_fields->r_parking_price !!}" name="r_parking_price" id="r_parking_price" onblur="changeReservedParking();" class="form-control inp_30" > <span class="inp_20"> BDT </span> 

            </div>

        </div>

       

        <div class="form-group">

            <label for="inputEmail3" class="col-sm-3 control-label"> Total Property Price <span class="text-danger">*</span> </label>

            <div class="col-sm-7">

                <input type="text" readonly value="{!! ($property_fields->r_parking_price) !!}"  class="form-control" id="total_price" />

            </div>

        </div>



        



        <div style="display: @if($property_fields->type=='Parking') none @endif" class="apperment_type">

          

            <div class="form-group">

                <label for="inputEmail3" class="col-sm-3 control-label">Earnest Money<span class="text-danger">*</span> </label>

                <div class="col-sm-7">

                    <input type="text" value="{!!$property_fields->earnest_money!!}" name="earnest_money"

                        placeholder="Earnest Money" class="form-control" required>

                </div>

            </div>

            <div class="form-group">

                <label for="inputEmail3" class="col-sm-3 control-label">Earnest Money & Down Payment Percentage <span class="text-danger">*</span> </label>

                <div class="col-sm-7">

                    <input type="text" value="{!!$property_fields->e_d_percentage!!}" name="e_d_percentage"

                        placeholder="Percentage" class="form-control" required> 

                </div>

            </div>



            <div class="form-group">

                <label for="inputEmail3" class="col-sm-3 control-label"> Two part of Down Payment ? <span class="text-danger">*</span> </label>

                <div class="col-sm-7">  

                    <select id="two_dp" name="two_dp" class="form-control" >                                                                  

                        <option value="0" @if($property_fields->two_dp == 0) selected="selected" @endif > No </option>

                        <option value="1" @if($property_fields->two_dp=='1') selected="selected" @endif > Yes </option>                                                 

                    </select>

                </div>

            </div>



        </div>



<div class="form-group">

    <label for="inputEmail3" class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>

    <div class="col-sm-7">

        <select required class="form-control" name="status" required>

            @php

                $selected_property=null;

                if($property_fields->status == 0) $selected_property='Unsold';

                else if($property_fields->status == 1) $selected_property='Sold';

                else if($property_fields->status == 3) $selected_property='Landowner';

                else if($property_fields->status == 4) $selected_property='Common';

                else $selected_property='Booked';

            @endphp

            <option value="">Select Property status</option>

            <option value="0">Unsold</option>

            <option value="1">Sold</option>

            <option value="2">Booked</option>

            <option value="3">Landowner</option>

            <option value="4">Common</option>

            <option value="{{$property_fields->status}}" selected="{{$property_fields->status}}">{{$selected_property}}</option>

        </select>

    </div>

</div>

<div class="box-footer">

    <div class="form-group">

        <button type="submit" name="edit" value="update" class="btn btn-info pull-right">Update</button>

        <input type="hidden" name="property_id" value="{!! $property_id !!}" >

    </div>

</div>



 





<style>

    .inp_10 { float: left; width: 70px; }

    .inp_30 { float: left; width: 120px; text-align: right; }

    .inp_40 { float: left; width: 130px; text-align: left; }

    .inp_60 { float: left; width: 160px; text-align: left; }

    .inp_20 { float: left; width: 60px; padding: 0px 15px; }

</style>



<!-- /.box-footer -->

{{Form::close()}}

</div>

</div>

@endsection