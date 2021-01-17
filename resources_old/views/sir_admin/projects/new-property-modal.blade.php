

<div class="modal fade AddProperty"  id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

    <div class="modal-dialog"   role="document">

        <div class="modal-content row" >





            <div class="row">

                <div class="col-md-12" style="font-size: 11px;">

                    <div class="box-header with-border" style="text-align: center;">

                        <h3 class="box-title">New property </h3>

                    </div>

                    <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Property title <span class="text-danger">*</span> </label>



                        <div class="col-sm-7">

                            <input type="text" id="p_title" parsley-trigger="change" placeholder="Property title" class="form-control" id="title" required>

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Owner Type<span class="text-danger">*</span> </label>

                        <div class="col-sm-7">

                            <select id="p_ownertype" class="form-control"  required>

                                <option value="">Select Owner Type</option>

                                <option value="UDDL">UDDL</option>

                                <option value="LandOwner">LandOwner</option>

                                <option value="Common">Common</option>

                            </select>

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Apartment Type<span class="text-danger">*</span> </label>

                        <div class="col-sm-7">

                            <select id="p_type" onchange="check_ptype(this.value)" class="form-control"  required>

                                <option value="">Select Apartment Type</option>

                                <option value="Parking">Parking</option>

                                <option value="Apartment-Residential">Apartment-Residential</option>

                                <option value="Apartment-Commercial">Apartment-Commercial</option>

                                <option value="Commercial">Commercial</option>

                                <option value="Common Facilities">Common Facilities</option>

                         <option value="Community Hall">Community Hall</option>

                            </select>

                        </div>

                    </div>
                    <div id="parkingtype" style="display: none;" class="form-group parkingtype">

                    <label for="inputEmail3" class="col-sm-3 control-label">Parking Type<span class="text-danger">*</span> </label>
                    <div class="col-sm-7">

                        <select id="parking_title" name="parkingtype" class="form-control" >

                          

                           <option value="">Select Parking Type</option>

                                <option value="Ground Floor">Ground Floor</option>

                                <option value="Semi Basement">Semi Basement</option>

                                <option value="Basement 1">Basement 1</option>

                                <option value="Basement 2">Basement 2</option>
                                <option value="Basement 3">Basement 3</option>
                                 <option value="Basement 4">Basement 4</option>
                                  <option value="Basement 5">Basement 5</option>
                                <option value="Basement Floor">Basement Floor</option>
                                <option value="Mezzanine Floor">Mezzanine Floor</option>

                        </select>

                    </div>

                    </div>
                   

                    



                    <div id="div_apartment">

                        
                         <div class="form-group" id="div_floor">

                            <label for="inputEmail3" class="col-sm-3 control-label">Floor No <span class="text-danger">*</span> </label>

                            <div class="col-sm-7">

                                <input type="text" id="p_floor_no" parsley-trigger="change" placeholder="Floor No" class="form-control" >

                            </div>

                        </div>


                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-3 control-label">Size <span class="text-danger">*</span></label>



                            <div class="col-sm-7">

                              

                                <input type="text" parsley-trigger="change" id="p_description" placeholder="Size" class="form-control" >

                            </div>

                        </div>

                      

                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-3 control-label">Facing<span class="text-danger">*</span> </label>



                            <div class="col-sm-7">

                                <input type="text" id="p_facing" placeholder="Facing" class="form-control" >

                            </div>

                        </div>

                       

                       

                    </div>





                    <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Property price <span class="text-danger">*</span> </label>



                        <div class="col-sm-7">

                            <input type="text" id="p_price" parsley-trigger="change" placeholder="Property price" class="form-control" id="title" required>

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label">Status <span class="text-danger">*</span></label>



                        <div class="col-sm-7">

                            <select class="form-control" id="p_status" required>

                                <option value="">Select Property status</option>

                                <option value="0">Unsold</option>

                                <option value="1">Sold</option>

                                <option value="2">Booked</option>

                                <option value="3">Landowner</option>

                                <option value="4">Common</option>

                            </select>

                        </div>

                    </div>



                    <div class="form-group">

                        <label for="inputEmail3" class="col-sm-3 control-label"> &nbsp; </label>



                        <div class="col-sm-7">

                            <button type="button" class="btn btn-default pull-right" data-dismiss="modal" id="Close">Close</button>

                            <button onclick="add_property()"  type="button" class="btn btn-danger"  > ADD </button>

                        </div>

                    </div>





                </div>

            </div>





        </div>

    </div>

</div>





<script>



    function add_property()

    {

        var p_title = $("#p_title").val();

        var p_ownertype = $("#p_ownertype").val();

        var p_type = $("#p_type").val();

        var p_parking_type = $("#p_parking_type").val();

        var p_floor_no = $("#p_floor_no").val();

        var parking_title = $("#parking_title").val();
        
        var p_description = $("#p_description").val();

        var p_facing = $("#p_facing").val();

        var p_price = $("#p_price").val();

        var p_status = $("#p_status").val();



        if(p_title==''){

            alert("Please enter property title");

        } else if(p_ownertype==''){

            alert("Please select property owner type");

        } else if(p_type==''){

            alert("Please select property type");

        }



        if(p_type=='Parking')

        {

            if(p_parking_type=='')

            {

                alert("Please select property parking type");

            } else if(p_price==''){

                alert("Please enter property price");

            } else if(p_status==''){

                alert("Please select property status");

            } else {

                $.ajax({

                    type: "POST",

                    url: '{!! url('property/property-ajax') !!}',

                    data: { _token:'{{ csrf_token() }}', title: p_title, ownertype: p_ownertype, type: p_type, parking_type:p_parking_type, floor_no:parking_title,  facing:p_facing, price:p_price, status:p_status },

                    success: function( data ) {

                        $("#property_details").html(data);

                        $('#Close').click();

                    }

                });

            }



        } else {

            if(p_floor_no==''){

                alert("Please enter property floor no");

            } else if(p_description==''){

                alert("Please enter property size");

            }else if(p_facing==''){

                alert("Please enter property facing");

            } else if(p_price==''){

                alert("Please enter property price");

            } else if(p_status==''){

                alert("Please select property status");

            } else {

                $.ajax({

                    type: "POST",

                    url: '{!! url('property/property-ajax') !!}',

                    data: { _token:'{{ csrf_token() }}', title: p_title, ownertype: p_ownertype, type: p_type, parking_type:p_parking_type, floor_no:p_floor_no, description:p_description,  facing:p_facing,  price:p_price, status:p_status },

                    success: function( data ) {

                        $("#property_details").html(data);

                        $('#Close').click();

                    }

                });

            }



        }









    }



    function property_delete(p_id)

    {

        var r = confirm("Are you sure want to delete?");

        if (r == true) {

            $.ajax({

                type: "POST",

                url: '{!! url('property/property-ajax') !!}',

                data: { _token:'{{ csrf_token() }}', delete: p_id},

                success: function( data ) {

                    $("#property_details").html(data);

                }

            });

        }

    }





    function check_ptype(ptype)

    {

        if(ptype=='Parking')

        {

            $("#parking_type").show();
            $("#parkingtype").show();
            $("#div_apartment").hide();

        } else {

            $("#div_apartment").show();
            $("#parkingtype").hide();
            $("#parking_type").hide();

        }

    }





</script>