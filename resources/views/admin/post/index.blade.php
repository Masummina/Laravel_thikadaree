@extends('admin.layouts.layout')
@section('content')
@php $org_nmae ='Users'; @endphp
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content">

      <div class="row"> <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading"> Post Manager </div>



                <div class="panel-body">



                    @if (Session::has('success'))

                        <div class="alert alert-info">{{ Session::get('success') }}</div>

                    @endif

 

                    <p class="pull-right">
                        <a class=" btn btn-primary"  href="{{ url('bem-posts/create/') }}"  ><i class="fa fa-plus"></i> Add New User</a>
                    </p>
                    

                    <!-- filter Start -->

                    <div class="district_search post">
								<div class="form-group">
								<div class="dropdown">
									<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter by post type
									</button>
									<div class="dropdown-menu">
                                        @php
                                        $all_post_type = DB::table('posts')
                                        ->select('post_type')
                                        ->distinct()
                                        ->get();
                                        @endphp
										@if(isset($all_post_type[0]))
											@foreach($all_post_type as $row)
											<?php 
												$string = trim(preg_replace('/\s+/', ' ', $row->post_type));
											  	$post_type_single = ucfirst(strtolower(strip_tags(str_replace(" ",'',$string))));
											  if(isset($_GET['location'])){
												$locations = explode(',',$_GET['location']);
												if(in_array($post_type_single,$locations)){
													$checked = 'checked';
												} else { 
													$checked = '';
												}
											  }
											?>
											<div class="checkbox">
												<label><input type="checkbox" {{ @$checked }} name="posttype[]" value="{!! @$post_type_single !!} "> {!! @$post_type_single !!} </label>
											</div>
											@endforeach
										@endif

									</div>
								</div>


								<script>
									var origin   = window.location.href;
									var url ="{{ url('bem-posts') }}";
										$('input').change(function(){
											var first = 0;
											var parms = '';
											$('input[name="posttype[]"]').each(function(i){
												var discrict = '';
												console.log($(this).is(':checked'));
												if( $(this).is(':checked')){
													var str = $(this).attr('value');
													var res = str.replace(" ", "");
													discrict = ((first==0) ? '?location='+ res : "," + res);
													first = 1;
												}
												parms += discrict;	
											});
										//alert(url+parms);
										window.location.href = url+parms;
										});
								</script>




								</div>
							</div>

                    <!-- filter End -->



                    <table id="myTable" class="table table-striped table-hover">

                        <thead>

                        <tr>

                            <th> S.N.</th>
 
                            <th> Title </th>
                            <th> Post Type </th>
                            <th> Discription </th>
                            <th> Image </th>
                            <th width="150px;"> Action </th>
                            <th> Active </th>

                        </tr>

                        </thead>

                        <tbody>

                        @php $i=0; @endphp



                       @foreach($post as $row)

                           @php $i++; 
                                 
                           @endphp

                            <tr>

                                <td>{{$i}}</td>
 
                                <td><b>{{$row->title}}</b></td>
                                <td><b>{{$row->post_type}}</b></td>
                                <td><b>{{$row->discription}}</b></td>
                                <td><b>{{$row->image}}</b></td>

                                <td>

                                    <a href="{{ url('/bem-posts/'.$row->id.'/edit') }}" class="btn btn-warning pull-left"> <i class="glyphicon glyphicon-pencil"> </i>  Edit</a>

                                    @if(Auth::user()->usertype=='admin')

                                        <form  class="pull-right delete" action="{{ url('/bem-posts/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >

                                            {{method_field('DELETE')}}

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"> </i> Delete</button>

                                        </form>
                                    @endif

                                </td>

                                <td>

                                    @if($row->status==0)
                                        <a href="{{url('/bem-posts/'.$row->id.'/edit?action=update&status=1')}}" onclick="return confirm('Are you sure you want to enable this item?');"  class="btn btn-warning">  <i class="glyphicon glyphicon-ban-circle"> </i> Disable </a>
                                    @else 
                                        <a href="{{url('/bem-posts/'.$row->id.'/edit?action=update&status=0')}}" onclick="return confirm('Are you sure you want to disable this item?');"  class="btn btn-success">  <i class="glyphicon glyphicon-ok"> </i> Enable</a>
                                    @endif

                                </td>



                            </tr>

                       @endforeach

                        </tbody>

                    </table>
                    {{ $post->links() }}

                </div>

            </div>

        </div>

</section>



@endsection

