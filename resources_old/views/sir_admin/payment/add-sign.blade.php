@extends('admin.layouts.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header clearfix">
            <h1 class="pull-left"> Money</h1>

        </section>

        <section class="content">
            <div class="content-wrapper">
                <section class="content">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header"> Create Money Receipt Sign</div>

                            <div class="box-body">

                                <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{url('save-sign')}}" enctype="multipart/form-data" method="POST">

                                    <div class="form-group">
                                        <label for="name"> Add new sign </label>
                                            <input type="file" class="form-control" name="photo" required><br>
                                        <input type="hidden" class="form-control" name="type" value="sign">

                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </div>




                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                </form>

                            </div>
                        </div>
                    </div>
                </section>

@endsection