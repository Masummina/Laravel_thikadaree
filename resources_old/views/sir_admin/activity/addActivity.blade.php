@extends('admin.layouts.layout')
@section('content')

  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1> Activities {!!$customer->prefix!!} {!!$customer->name!!} {!!$customer->mobile!!}</h1>
        </section>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      @if(session()->has('success'))
          <div class="alert alert-success">
              {{ session()->get('success') }}
          </div>
      @endif

       <div class="content">

         <div class="box">
             <div class="box-header with-border">
                 <h3 class="box-title">Customer Interest</h3>
             </div>


             <form method="post" action="{!! url('save-activity') !!}" onsubmit="return confirm('Are you sure want to submit?');" >
              <input type="hidden" name="customer_id" value="{{$customer_id}}"/>
              <div id="PersonalBlock" class="card-body">

                    <div class="input-group">


                        <span class="input-group-addon">Project </span>
                        <select id="project" name="project_id" class=" form-control" data-live-search="true" style="width: 150px; float: left;">
                            <option  value="0"> Select  </option>
                            @if(isset($project))
                                @foreach($project as $row)
                                    <option  value="{{ $row->id }}"  @if(isset($current_project) && $current_project == $row->id) selected="selected" @endif >{{ $row->title }} </option>
                                @endforeach
                            @endif
                        </select>
                        <span class="input-group-addon"> Property  </span>
                        <select name="property_id" id="property_id" class=" form-control"><option value=""> Select Property </option>
                            <option  value=""> Select  </option>
                            @if(isset($property))
                                @foreach($property as $row)
                                    <option  value="{{ $row->id }}" @if(isset($current_property) && $current_property == $row->id) selected="" @endif  >{{ $row->title }} </option>
                                @endforeach
                            @endif
                        </select>


                        <span class="input-group-addon"> Contact Method </span>
                        @php $contact_methods = array('Call to','Call received','Visit to Office','Visit to Project','Internal Visit','Both','Visit to Home'); @endphp
                        <select name="contact_method" class="form-control" required>
                            <option  value=""> Select  </option>
                            @foreach($contact_methods as $v)
                                <option value="{!! $v !!}" @if(old('contact_method')==$v) selected @endif >{!! $v !!}</option>
                            @endforeach
                        </select>

                        <span id="spanContactType" class="input-group-addon">Status </span>
                        @php $lead_status = array('Primary','Secondary','Near to Close','DOL','BFO','Dead','Client'); @endphp
                        <select name="lead_status" class="form-control" required>
                            <option  value=""> Select  </option>
                            @foreach($lead_status as $v)
                                <option value="{!! $v !!}" @if(isset($history[0]->lead_status) && $history[0]->lead_status==$v) selected @endif >{!! $v !!}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="input-group" >
                        <span class="input-group-addon">Next Action </span>

                        @php $next_actions = array('Call Receivd','Call to','Internal Visit','Project Visit','External Visit','Visit to Home'); @endphp
                        <select name="next_action" class="form-control" required>
                            <option  value=""> Select  </option>
                            @foreach($next_actions as $v)
                                <option value="{!! $v !!}" @if(old('next_plan')==$v) selected @endif >{!! $v !!}</option>
                            @endforeach
                        </select>

                        <span class="input-group-addon">Date </span>
                        <input name="next_action_date" value="{!! old('next_action_date') !!}" class="form-control col-md-2" type="date" required>

                        <span class="input-group-addon">Time</span>
                        <input name="next_action_time" type="time" value="{!! old('next_action_time') !!}" class="form-control">

                    </div>

                      <div id="area_of_interest" class="card-body" style="margin: 20px 0px;">
                          Area of Interest
                          <div class="input-group input-group-sm">
                              <span class="input-group-addon">Area</span>
								<select name="district_name" class="form-control" onchange="show_location(this.value)">                                       <option value="">Select district </option>                                    @php                                     $district_list = DB::table('locations')                                                                            ->select('id','district')                                                                      ->groupBy('district')                                        ->orderBy('district', 'asc')                                        ->get();                                        foreach($district_list as $row){                                            if($row->district=='Dhaka') $sel='selected="selected"'; else $sel='';                                            echo '<option value="'.$row->district.'" '.$sel.' >'.$row->district.'</option>';                                        }                                       @endphp                                                                                       </select>								
                                <select name="area_of_interest" id="area_of_interest" class="form-control">                               
                                    <option value="">Select Area </option>
                                    @php 
                                    $locations = DB::table('locations')
                                        ->whereRaw("`district` LIKE 'dhaka'")										->orderBy('location','asc')
                                        ->get();
                                        foreach($locations as $row){
                                            echo '<option value="'.$row->location.'">'.$row->location.'</option>';
                                        }   
                                    @endphp 
                                </select>  
                               
                                                                                          
                              <span class="input-group-addon">Size(sft)</span>
                              <input name="size_of_interest" value="{!! old('size_of_interest') !!}" placeholder="Size" class="form-control ">
                              <span class="input-group-addon">Price(tk)</span>
                              <input name="price_of_interest" value="{!! old('price_of_interest') !!}" placeholder="Price" class="form-control ">
                          </div>
                      </div>
                    
                     <div id="CustomerRemarks">
                        <textarea name="remarks" placeholder="Description" class="form-control" required></textarea>
                    </div>
              </div>
             

              <div class="box-footer">
                <div class="form-group">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-7">
                        <button type="submit" class="btn btn-info pull-right"> Submit </button>
                    </div>
                </div>
            </div>
                 <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
         </form>

      </div>

      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Activity History</h3>
            <p class="pull-right" >  &nbsp;&nbsp;&nbsp;
                <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_prospect')" > <i class="glyphicon glyphicon-print"  > </i> </span>
            </p>
        </div>
        <!-- /.box-header -->
        <div class="box-body scroll-table" id="print_prospect">


            <h1 class="hidden" style="text-align: center;"> Activities of {!!$customer->prefix!!} {!!$customer->name!!} {!!$customer->mobile!!}</h1>


            @if(isset($history[0]))
                <table class="table table-bordered">
                    <tbody><tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 60px">Project Name</th>
                        <th style="width: 60px">Property Name</th>
                        <th style="width: 120px">Date</th>
                        <th>Description</th>
                        <th style="width: 60px" >Contact</th>
                        <th style="width: 60px" >Lead Status</th>
                        <th style="width: 60px" >Action</th>
                        <th style="width: 200px" >Action Date</th>
                    </tr>

                    @php $i=count($history); @endphp
                    @foreach($history as $row)
                        <tr>
                       @php

                          $project_name=null;
                          if(isset($project))
                          {
                                    foreach ($project as  $p)
                                    {
                                            if($row->project_id == $p->id)
                                            {
                                                $project_name=$p->title;
                                                break;
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
                                                $property_name=$p->title;
                                                break;
                                            }

                                    }

                          }

                          if($project_name=='') $project_name = $customer->area_of_interest;

                       @endphp

                      <td>{{$i}}</td>
                      <td>{{$project_name}} </td>
                      <td>{!!$property_name!!} </td>
                      <td> @php 
                                      echo date('jS  F Y h:i:s A', strtotime($row->created_at));
                                  @endphp</td>
                      <td>{{$row->remarks}}</td>
                      <td>{{$row->contact_method}}</td>
                      <td>{{$row->lead_status}}</td>
                      <td>{{$row->next_action}}</td>
                      <td>
                          @php
                               echo date('jS  F Y h:i:s A', strtotime($row->next_action_date));
                              $date1=new DateTime($row->created_at);
                              $date2=new DateTime(date('Y-m-d H:i:s'));
                              $interval=$date2->diff($date1)->days;
                             // dd($interval);
                          @endphp
                          @if($interval<2 ||Auth::user()->group_id ==2 || Auth::user()->group_id == 1)
                            <!-- <a href="{{ url('activity/'.$row->id) }}?id={{$row->customer_id}}"  class="btn btn-success"><i class="fa fa-edit"></i></a> -->
                          @endif
                      </td>
                        </tr>
                      @php $i--; @endphp
                    @endforeach

                </tbody></table>
            @else
                Activity Not found
            @endif
        </div>

    </div>

    </div>

</div>

    <style>
        .hidden { display: none; }
    </style>

<script type="text/javascript">

    function show_location(district)
    {
        $.ajax({
            url: '{!! url('show-location/?district=') !!}'+district,
            type:"GET",
            //dataType:"json",
            beforeSend: function(){
                //$('#loader').css("visibility", "visible");
                $('#area_of_interest').html('<option value="">Loading... </option>');
            },
            success:function(data) {
                $('#area_of_interest').html(data);                  
            },
            complete: function(){
                //$('#loader').css("visibility", "hidden");
            }
        });
    }
        
</script>

@endsection