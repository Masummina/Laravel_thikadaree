@extends('admin.layouts.layout')



@section('content')

@php $org_nmae ='Create Category'; @endphp

    <!-- Content Wrapper. Contains page content -->
    
    <div class="content-wrapper">



        <section class="content">



         <div class="col-md-12">



            <div class="box">



                <div class="box-header"> Create Post </div>


                <div class="box-body">

                    @if(count($errors)>0)


                        <div class="alert alert-danger">



                        @foreach($errors->all() as $error)



                            {{$error}}



                        @endforeach



                        </div>



                    @endif

                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('id'){{ url('/bem-posts') }}/@yield('id')@else {{ url('/bem-posts') }} @endif" method="POST" enctype="multipart/form-data">
                        @section('editMethod')
                        @show
                             <div class="form-group">
                                <label for="name"> Post Type </label>
                                <select name="post_type"  class="form-control">
                                     <option value="0"> Select </option>
                                        <option value="home_need">home_need</option>
                                        <option value="benefit">benefit</option>
                                        <option value="slider">slider</option>
                                        <option value="tender">Tender</option>
                                </select>
                             </div>
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" value="" placeholder="Post title" class="form-control" id="title" required>
                            </div>
                            <div class="form-group">
                                <label for="short_discription">Short Discription:</label>
                                <textarea class="form-control" name="short_discription" rows="5" id="discription" required=""></textarea>
                            </div>
                            <div class="form-group">
                                <label for="discription">Discription:</label>
                                <textarea class="form-control" name="discription" rows="5" id="discription" required=""></textarea>
                            </div>



                            <div class="form-group">
                                <label for="image">Project Image:</label>
                                <input type="file" class="form-control" name="image" multiple="" placeholder="images " required="">
                            </div>




                            <button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"> </i>Submit</button>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                        </div>

                    </form>







                </div>



            </div>



        </div>







@endsection



