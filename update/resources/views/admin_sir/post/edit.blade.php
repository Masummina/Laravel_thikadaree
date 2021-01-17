@extends('admin.layouts.layout')



@section('content')

 

    <!-- Content Wrapper. Contains page content -->



    <div class="content-wrapper">



        <section class="content">



         <div class="col-md-12">



            <div class="box">



                <div class="box-header"> Edit Post </div>







                <div class="box-body">







                    @if(count($errors)>0)



                        <div class="alert alert-danger">



                        @foreach($errors->all() as $error)



                            {{$error}}



                        @endforeach



                        </div>



                    @endif


                    <!-- Post edit or Update -->

      <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/bem-posts/'.$post_edit->id) }}" method="POST" enctype="multipart/form-data">
                       {{method_field('PUT')}}
                            
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" value="{!! $post_edit->title !!}" placeholder="Post title" class="form-control" id="title" required>
                            </div>

                            <div class="form-group">
                                <label for="name"> Post Type </label>
                                <select name="post_type"  class="form-control">
                                     <option value="0"> Select </option>
                                        <option value="home_need" @if ($post_edit->post_type=='home_need') selected @endif >home_need</option>
                                        <option value="benefit" @if($post_edit->post_type=='benefit') selected @endif >benefit</option>
                                </select>
                             </div>

                            <div class="form-group">
                                <label for="discription">Discription:</label>
                                <textarea class="form-control" name="discription" rows="5" id="discription" required="">{!! $post_edit->discription !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="short_discription">Short Discription:</label>
                                <textarea class="form-control" name="short_discription" rows="5" id="discription" required="">{!! $post_edit->short_desc !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="image">Project Image:</label>
                                <input type="file" class="form-control" name="image" multiple="" placeholder="image">
                            </div>
                            <div class="form-group">
                                <div class="image_post">
                                    <img style="max-width: 80px;" src="{{ asset('images/post') }}/{!! $post_edit->image !!}">
                                </div>
                            </div>




                            <button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"> </i>Submit</button>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                        </div>

                    </form>







                </div>



            </div>



        </div>







@endsection



