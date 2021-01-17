@extends('admin.layouts.layout')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header clearfix">
            <h1 class="pull-left"> Profession</h1>

        </section>

        <section class="content">
            <div class="content-wrapper">
                <section class="content">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header"> Create/Edit Profession </div>

                            <div class="box-body">

                                @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            {{$error}}
                                        @endforeach
                                    </div>
                                @endif

                                <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{url('professions/create_edit')}}" method="POST">

                                    <div class="form-group">
                                        <label for="name"> Enter new profession </label>
                                        @if(!empty($edit_id))
                                        <input type="text" class="form-control" value="{{$title_name}}" name="title" required><br>
                                            <input type="hidden" name="id" value="{{$edit_id}}">

                                        @else
                                            <input type="text" class="form-control" name="title" required><br>
                                        @endif
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </div>




                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                                </form>

                            </div>
                        </div>
                    </div>
        </section>

@endsection