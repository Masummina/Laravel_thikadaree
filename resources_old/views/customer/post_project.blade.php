@extends('layouts.app')

@section('content')
 	<script>
	 	function addSubCategory(sub_seo_title,sub_cat_title,sub_cat_id){
			var checkBox = document.getElementById(sub_seo_title);
			if (checkBox.checked == true){
				var sub_cat_html = '<span class="tag" id="tag_'+sub_seo_title+'" > <span class="tag-text">'+sub_cat_title+'</span>';
			   		sub_cat_html += '<input type="hidden" name="sub_categories[]" value="'+sub_cat_id+'" />';
			   		sub_cat_html += '<span class="tag-remove" onclick="removeSubCategory('+"'"+'tag_'+sub_seo_title+"'"+')" ></span> </span>';
				$("#form-sub-categories").append(sub_cat_html);
			} else {
				$('#tag_'+sub_seo_title ).remove();
			}
			
		}

		function removeSubCategory(span_id)
		{
			$("#"+span_id ).remove();
		}
	 
	 </script>

	 

	<div class="bidder-dashboard">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="container">
					<div class="topnav" id="myTopnav">
					  @include('customer.myTopnav')
					</div>
				</div>
			</div>
		</nav>
  	</div>

   <section id="post-job" class="main-container post-jon">
      <div class="container">
         <div class="row">
         	<div class="jobPost">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

				<form action="" method="post" enctype="multipart/form-data">
					<h2> Post a Project </h2>
					<p class="hint-text">Create your account. It's free and only takes a minute.</p>
					<div class="form-group">
						<label for="jobname">Job Title:</label>
						<input type="text" class="form-control" name="title" placeholder="Job Title" id="title" required>
					</div>
					
					<div class="form-group">
						<label for="discription">Discription:</label>
						<textarea class="form-control" name="discription" rows="5" id="discription" required></textarea>
					</div>

					<div class="form-group">
						<div class="form-group">
							<label for="wantA">Request for :</label>
							<label class="form-check-label">
								<input type="radio" id="supplier" value="supplier" class="form-check-input" name="wantA" required> BID/Quototion
							</label>
							<label class="form-check-label">
								<input type="radio" id="contructor" value="contructor" class="form-check-input" name="wantA"> EOI/Proposal
							</label>
						</div>
					</div>

					<!-- Quototion start -->
					<div class="form-group">
						<div id="newinput">
							
						</div>
					</div>
					<!-- end -->


					<div class="form-group file_select">
						<input type="file" class="form-control" name="images[]" multiple="" placeholder="images " required>
						<div class="file_text">
							<span> Drag & drop any images or documents that might be helpful in explaining your brief here (Max file size: 10 MB). </span>
						</div>
					</div>


					<div class="form-group">
					    <label for="exampleFormControlSelect2">Select Category: </label>
					    <select id="category" class="browser-default btnCustom4" name="category" > 
						  <option selected>select Category</option>
						  @foreach($categories as $values)
						   <option value="{!! $values->id !!}">{!! $values->title !!}</option>
						  @endforeach
						</select>
					  </div>

					<div id="subcategory_div">
					</div>

					<!-- ***********subcategory_tag************ -->

					<div class="subcategory_tag">
						<div id="form-sub-categories" class="tagsinput" style="width: auto; min-height: auto; height: auto;">
							
						</div>
					</div>


 
					
					<div class="loaction">
						 <div class="form-group">
                            <label for="images">Job Location</label> <br/>
                            <select class="browser-default custom-select" name="district" id="district" required> 
                                <option "" >District</option>
                                @php 
                                    $districts = DB::table('locations')->groupBy('district')->orderBy('district','asc')->get();
                                @endphp
                                @foreach($districts as $values)
                                   <option value="{!! $values->district !!}">{!! ucfirst(strtolower($values->district)) !!}</option>
                                @endforeach
                            </select>
                            <select class="browser-default custom-select float-left" name="area" id="area" required> 
                                <option "" > Area </option>
                            </select>
                            <input type="text" class="form-control" placeholder="Location" id="joblocatio" name="joblocatio">
                        </div>
						 
						 
					</div>

					


					<!-- select Budget type -->

					<div class="form-group budget"><label for="images">Estimated budget</label>
						<table>
						<tr>
							<td>
								<select class="browser-default custom-select" name="project_budget" onchange="estimatedBudget()" id="estimatedbudget" required>
									<option value="" selected>Select Your budget</option>
									@if(isset($budget))
										@foreach($budget as $projectdudget)
										<option value="{!! $projectdudget->id.'-'.$projectdudget->budget_range !!}">{!! @$projectdudget->title !!} {!! @$projectdudget->title_bn !!} {!! @$projectdudget->budget_range !!}</option>
										@endforeach
									@endif
								</select>

								<div id="estimated_alert"> </div>

							</td>
						</tr>
						</table>
					</div>

					<!-- Select paymebt -->

					<div class="form-group">
						<label for="images">Payment Condition</label>
						<br>
						<label class="form-check-label">
							<input type="radio" id="paycondition" value="Daily" class="form-check-input" name="paycondition" required> Daily 
						</label>
						<label class="form-check-label">
							<input type="radio" id="paycondition2" value="Part" class="form-check-input" name="paycondition"> Part Payment 
						</label>
						<label class="form-check-label">
							<input type="radio" id="paycondition3" value="End" class="form-check-input" name="paycondition"> At the End 
						</label>
					</div>

				


					<div class="advance_section">
						<a class=" advance float-right">Advance Option</a>
						<div class="advance_option">

							<table>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="closing_date">Prebit Meeting Date: </label><br>
                                            <input type="date" class="form-control" name="prebit_meeting">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="closing_date">Close date: </label><br>
                                            <input type="date" class="form-control" name="close_date">
                                        </div>
                                    </td>
                                </tr>
                            </table>

							 
							<div class="form-group">
								<label for="images">Experience & Required</label>
								<input type="text" class="form-control" placeholder="Experience & Required" id="experience" name="experience">
							</div>
							<div class="form-group">
								<label for="images">Liquid Avility/Asset Asset/Bank Guarinty</label>
								<input type="text" class="form-control" placeholder="Liquid Asset" id="liquid_asset" name="liquid_asset">
							</div>
							 
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-lg btn-block"> Submit </button>
					</div>

					@csrf
				</form>



       
         

            </div><!-- Content Col end -->

 		</div>
         </div><!-- Main row end -->

      </div><!-- Conatiner end -->
   </section><!-- Main container end -->





<!-- Modal -->
<div id="myModal4" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
        <select id="selection4">
          <option value="volvo">Volvo</option>
          <option value="saab">Saab</option>
          <option value="mercedes">Mercedes</option>
          <option value="audi">Audi</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

 

   <script>
   		var g_element_id = 1;
		var element = document.getElementById("supplier");
		element.onchange = function() {
			var bidder_type = element.value;
 			
 			var item_element = ' '+
					'<div class="bid_quototion" >'+
						'<div class="form-group">'+
							'<label for="quotation_dis">Discription of item</label>'+
							'<input type="text" class="form-control" placeholder="item title" id="item" name="items[]">'+
						'</div>'+
						'<div class="form-group">'+
							'<label for="unit">Unit</label> <br/>'+
							'<select name="units[]">'+
					          '<option value="Sqft">Sqft</option>'+
					          '<option value="Acre">Acre</option>'+
					          '<option value="Meter">Meter</option>'+
					          '<option value="Feet">Feet</option>'+
					        '</select>'+
						'</div>'+
						'<div class="form-group">'+
							'<label for="quotation_dis">Quantity</label> '+
							'<input type="number" class="form-control" placeholder="quantity" name="quantity[]">'+
						'</div>'+
						'<div class="form-group"> <br/> '+
							'<span class="btn btn-primary" onclick="AddItemElement('+g_element_id+')" ><i class="fa fa-plus"></i></span>'+
						'</div>'+
					'</div>';

			$('#newinput').html(item_element);

		}
		var element2 = document.getElementById("contructor");
		element2.onchange = function() {
			var bidder_type = element2.value;
			$('#newinput').html('<div class="form-group"> <label for="images">Upload TOR/SOW or any other related file</label></div>');
		}


		function AddItemElement(element_id)
		{
			g_element_id++;
			var item_element = ' '+
					'<div class="bid_quototion" id="item_element_'+g_element_id+'" >'+
						'<div class="form-group">'+				
							'<input type="text" class="form-control" placeholder="item title" id="item" name="items[]">'+
						'</div>'+
						'<div class="form-group">'+							
							'<select name="units[]">'+
					          '<option value="Sqft">Sqft</option>'+
					          '<option value="Acre">Acre</option>'+
					          '<option value="Meter">Meter</option>'+
					          '<option value="Feet">Feet</option>'+
					        '</select>'+
						'</div>'+
						'<div class="form-group">'+						
							'<input type="number" class="form-control" placeholder="quantity" name="quantity[]">'+
						'</div>'+
						'<div class="form-group">'+
							'<span class="btn btn-warning" onclick="removeItemElement('+g_element_id+')" ><i class="fa fa-minus"></i></span>'+
						'</div>'+
					'</div>';

					

			$('#newinput').append(item_element);		

		}

		function removeItemElement(element_id)
		{
			$('#item_element_'+element_id).remove();	
		}


		// Category load

		//var element = document.getElementById("categoryname");

		$("#category_uu").change(function() {
			var category_id = $("#category").val();

			$.ajax({
               type:'POST',
               url:"{!! url('GetSubCategory') !!}",
               data:['_token:<?php echo csrf_token() ?>'],
               success:function(data) {
                  $("#msg").html(data.msg);
               }
            });
		 
			//$("#subcategory_div").html(category_id);
		});

		$("#category").change(function() {
			var category_id = $("#category").val();

			$.ajax({
               type:'get',
               url:"{!! url('GetSubCategory') !!}"+'?category_id='+category_id,
               data:['category_id='+category_id],
               success:function(data) {
                  $("#subcategory_div").html(data);
               }
            });
		 
			//$("#subcategory_div").html(category_id);
		});


		$("#district").change(function() {
			var district = $("#district").val();

			$("#area").html('<option value="" > Loading... </option>');
			$.ajax({ 
               type:'get',
               url:"{!! url('GetThanaByDistrict') !!}"+'?district='+district,
               data:['district='+district],
               success:function(data) {
                  $("#area").html(data);
               }
            });
		 
			//$("#subcategory_div").html(category_id);
		});	


		//Estimated budget deposit money
        function estimatedBudget() 
        {
            var budget = document.getElementById("estimatedbudget").value;
            if(budget == ''){
                document.getElementById("estimated_alert").innerHTML = '';
            }else{
                document.getElementById("estimated_alert").innerHTML = '<div class="deposit_budget">'+
                '<div class="alert alert-warning">'+
                    '<strong>Note!</strong> You will need to deposit 20% on this amoutn.'+ budget +
                '</div></div>';
            }
        }	

		
</script>


	
@endsection



