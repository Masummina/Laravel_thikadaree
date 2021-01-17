	<div class="col-md-12">
	  <div class="row clearfix">


	  @if($property_list)

		<h3 style="text-align: center">Property</h3>
		@php $floor_title = 0; @endphp      
		@foreach($property_list as $row)
			@if($row->type!='Parking')
			
			   @if($floor_title!=$row->floor_no)
				<div class="row">
				  <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;">Floor {!!$row->floor_no!!}</h4></div>   
				</div> 
				@php $floor_title = $row->floor_no; @endphp
			   @endif

		  @php
			  if($row->status==0) $cls='bg-bg-gray';$status_type = 'Free'; // Free
			  if($row->status==2) $cls='bg-red';$status_type = 'Booked'; // Booked
			  if($row->status==3) $cls='bg-yellow';$status_type = 'Landowner'; // Landowner
			  if($row->status==4) $cls='bg-yellow';$status_type = 'Common'; // Common
			  if($row->status==1) $cls='bg-green';$status_type = 'Sold'; // Sold
		  @endphp
		   <div class="col-md-4">
			   <div class="{!! $cls !!} flate-box" style="text-align: center" >
					{!! $row->title !!} <br/>
					{!! $row->description !!} <br/>
			   </div>
			  <label>Price: {!! number_format($row->price,2) !!} BDT</label><br>
			   <label>Owner Type: {!!$row->owner_type !!}</label><br>
			   
			   <label>Facing: {!!$row->facing !!}</label><br>
			   <label>Status:
			   @php
				  if($row->status==0)
				  echo 'Free';
				  if($row->status==2)
				  echo'Booked';
				  if($row->status==3)
				  echo'Landowner';
				  if($row->status==4)
				  echo'Common';
				  if($row->status==1) echo
				  'Sold';
			   @endphp
			   </label><br>

			   <div class="btn-group">
					  <button type="button" name="edit" value="delete" class="btn btn-danger" onclick="property_delete('{!! $row->id !!}')" >Delete</button>
			   </div>

		   </div>

 			@endif
		@endforeach
	  @endif


		@if($parking_list)
			  <div class="row">

				  <div class="row">
					  <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;"> Parking </h4></div>
				  </div>


				   @php $parking_title = 0; @endphp
				  @foreach($parking_list as $row)
					  @if($row->type=='Parking')
						  @if($parking_title!=$row->parking_type)
					<div class="row">
					  <div class="col-md-12 "> <h4 style="text-align: center;display: block;background: #A569BD;color: #fff;padding: 5px;margin-left: 15px;margin-right: 15px;">
						 @if($row->parking_type=='1')
						  Ground Floor
						  @endif
						   @if($row->parking_type=='2')
						 Semi Basement 
						  @endif
						  @if($row->parking_type=='3')
						 Basement 1
						  @endif
						  @if($row->parking_type=='4')
						 Basement 2
						  @endif
						</h4></div>   
					</div> 
					@php $parking_title = $row->parking_type; @endphp
				   @endif

						  @php
							  if($row->status==0) $cls='bg-gray'; // Free
							  if($row->status==2) $cls='bg-red'; // Booked
							   if($row->status==3) $cls='bg-yellow'; // Booked
							  if($row->status==4) $cls='bg-yellow'; // Booked
							  if($row->status==1) $cls='bg-green'; // Sold
						  @endphp
						  <div class="col-md-3">
							  <div class="{!! $cls !!} flate-box" style="text-align: center">
								  {!! $row->title !!} <br/>
								  {!! $row->description !!} <br/>
								  {!! number_format($row->price,2) !!} BDT
								  <br/>
							  </div>
							  <label>{!!$row->owner_type !!}</label><br>

							  <div class="btn-group">
								  <button type="button" name="edit" value="delete" class="btn btn-danger" onclick="property_delete('{!! $row->id !!}')" >Delete</button>
							  </div>

						  </div>

					  @endif

				  @endforeach
		   </div>
		@endif

	  </div>
	</div>