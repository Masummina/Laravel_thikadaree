@extends('admin.layouts.layout')



@section('content')

@php $org_nmae ='Create Category'; @endphp



    <!-- Content Wrapper. Contains page content -->


    <div class="content-wrapper">



        <section class="content">



         <div class="col-md-12">



            <div class="box">



                <div class="box-header"> Create User </div>


                <div class="box-body">

                    @if(count($errors)>0)



                        <div class="alert alert-danger">



                        @foreach($errors->all() as $error)



                            {{$error}}



                        @endforeach



                        </div>



                    @endif


                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('id'){{ url('/bem-categories') }}/@yield('id')@else {{ url('/bem-categories') }} @endif" method="POST" enctype="multipart/form-data">
                        @section('editMethod')
                        @show
                            <div class="form-group">
                                <label for="name"> Parents Category </label>
                                <select name="parent_id"  class="form-control">
                                     <option value="0"> Select </option> 
                                      @foreach($root_category as $val) 
                                        <option value="{!! $val->id !!}">{!! $val->title !!}</option> 
                                      @endforeach 
                                </select>
                             </div>
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" value="" placeholder="Create Category" class="form-control" id="title" required>
                            </div>
                            <button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"> </i>   Submit</button>



                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

    



                        </div>



 



                    </form>







                </div>



            </div>



        </div>







@endsection



