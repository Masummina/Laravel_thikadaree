@extends('admin.layouts.layout')



@section('content')

 

    <!-- Content Wrapper. Contains page content -->



    <div class="content-wrapper">



        <section class="content">



         <div class="col-md-12">



            <div class="box">



                <div class="box-header"> Edit User </div>







                <div class="box-body">







                    @if(count($errors)>0)



                        <div class="alert alert-danger">



                        @foreach($errors->all() as $error)



                            {{$error}}



                        @endforeach



                        </div>



                    @endif







                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/bem-projects/'.$project_edit->id) }}" method="POST">




                        {{method_field('PUT')}}


                            <div class="form-group">
                               <label for="name"> User Type </label>
                            </div>
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" value="{!! $project_edit->title !!}" class="form-control" id="title" required>
                            </div>
                            <div class="form-group discription">
                                <label for="discription">Discription:</label>
                                <textarea class="form-control" name="discription" rows="5" id="discription" required="">{!! $project_edit->discription !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Skills:</label>
                                <input type="text" name="skills" value="{!! $project_edit->skills !!}" class="form-control" id="title">
                            </div>


                        <button type="submit" class="btn btn-default">Update</button>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>


 

                    </form>







                </div>



            </div>



        </div>







@endsection



