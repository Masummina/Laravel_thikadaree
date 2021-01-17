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
                            <div class="box-header"> Edit Money Receipt Sign </div>

                            <div class="box-body">

                                <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{url('update-sign/'.$details->id)}}" enctype="multipart/form-data" method="POST">

                                    <div class="form-group">
                                        <label for="name"> Edit sign </label>
                                        <input type="file" class="form-control" name="photo" value="{{ $details->photo }}">
                                        <img src="{{ asset('img/'.$details->photo) }}" height="80" width="120">


                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </div>




                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                </form>

                            </div>
                        </div>
                    </div>
                </section>

@endsection