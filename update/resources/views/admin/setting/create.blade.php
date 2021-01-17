@extends('admin.layouts.layout')



@section('content')

@php $org_nmae ='Create Category'; @endphp



    <!-- Content Wrapper. Contains page content -->


    <div class="content-wrapper">



        <section class="content">



         <div class="col-md-12">



            <div class="box">



                <div class="box-header"> Create New setting </div>


                <div class="box-body">

                    @if(count($errors)>0)


                        <div class="alert alert-danger">



                        @foreach($errors->all() as $error)



                            {{$error}}



                        @endforeach



                        </div>



                    @endif

                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="" method="POST" enctype="multipart/form-data">
                    @section('editMethod')
                        @show
                            <div class="form-group">
                                <label for="name">Title key</label>
                                <input type="text" name="title_key" value="" placeholder="Title key" class="form-control" id="title" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" value="" placeholder="Title" class="form-control" id="title" required>
                            </div>
                            <div class="form-group">
                                <label for="name">value</label>
                                <input type="text" name="value" value="" placeholder="Value" class="form-control" id="value" required>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                            <button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"> </i>Submit</button>
                     </form>
                </div>



            </div>



        </div>







@endsection



