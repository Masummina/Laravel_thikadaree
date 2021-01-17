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







                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="{{ url('/bem-categories/'.$item->id) }}" method="POST" enctype="multipart/form-data">







                        {{method_field('PUT')}}





                            <div class="form-group">



                               <label for="name"> User Type </label>



                               <select name="parent_id"  class="form-control" required>
                                    <!-- @php $utypes = ['user','admin']; @endphp -->
                                    <option value="user"> Select </option> 
                                     @foreach($root_category as $category) 
                                       <option value="{!! $category->id !!}" @if($item->parent_id == $category->id) selected @endif >{!! $category->title !!}</option> 
                                     @endforeach 
                               </select>



                            </div>


                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" value="{!! $item->title !!}" class="form-control" id="title" required>
                             </div>


                        <button type="submit" class="btn btn-default">Update</button>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>


 

                    </form>







                </div>



            </div>



        </div>







@endsection



