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







                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/bem-users/'.$item->id) }}" method="POST" enctype="multipart/form-data">







                        {{method_field('PUT')}}





                            <div class="form-group">
                               <label for="name"> User Type </label>
                               <select name="usertype"  class="form-control" required>
                                    @php $utypes = ['user','admin']; @endphp
                                    <option value="user"> Select </option> 
                                     @foreach($utypes as $val) 
                                       <option value="{!! $val !!}" @if($item->usertype==$val) selected @endif >{!! ucfirst($val) !!}</option> 
                                     @endforeach 
                               </select>
                            </div>







                         <div class="form-group">



                             <label for="name">Name</label>



                             <input type="text" name="name" value="{!! $item->name !!}" placeholder="Full Name" class="form-control" id="name" required>



                         </div>







                         <div class="form-group">



                            <label for="name">Email</label>



                            <input type="email" name="email" value="{!! $item->email !!}" placeholder="Email" class="form-control" id="email" required>



                         </div>

 






                         <div class="form-group">



                             <label for="name">Password</label>



                             <input type="password" value="" name="password" placeholder="password" class="form-control" id="password" >



                         </div>







                        <button type="submit" class="btn btn-default">Submit</button>



                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>


 

                    </form>







                </div>



            </div>



        </div>







@endsection



