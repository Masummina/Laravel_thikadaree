@extends('admin.layouts.layout')



@section('content')

@php $org_nmae ='Create User'; @endphp



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


                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('id'){{ url('/bem-users') }}/@yield('id')@else {{ url('/bem-users') }} @endif" method="POST" enctype="multipart/form-data">



                        @section('editMethod')



                        @show






 

                            <div class="form-group">
                                <label for="name"> User Type </label>
                                <select name="usertype"  class="form-control" required>
                                     @php $utypes = ['user','admin']; @endphp
                                     <option value="user"> Select </option> 
                                      @foreach($utypes as $val) 
                                        <option value="{!! $val !!}" @if(old('usertype')==$val) selected @endif >{!! ucfirst($val) !!}</option> 
                                      @endforeach 
                                </select>
                             </div>







                            <div class="form-group">



                                <label for="name">Name</label>



                                <input type="text" name="name" value="{!! old('name') !!}" placeholder="Full Name" class="form-control" id="name" required>



                            </div>



                            <div class="form-group">



                                <label for="name">Email</label>



                                <input type="email" name="email" value="{!! old('email') !!}" placeholder="Email" class="form-control" id="email" required>



                            </div>


                            <div class="form-group">
                                <label for="name">Password</label>
                                <input type="password" name="password" value="{!! old('password') !!}" placeholder="password" class="form-control" id="password" required>
                            </div>



                            <div class="form-group">
                                <label for="name">Confirmed Password</label>
                                <input type="password" name="password_confirmation" value="{!! old('password_confirmation') !!}" placeholder="Confirmed password" class="form-control" id="password_confirmation" required>
                            </div>


                            <button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"> </i>   Submit</button>



                            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

    



                        </div>



 



                    </form>







                </div>



            </div>



        </div>







@endsection



