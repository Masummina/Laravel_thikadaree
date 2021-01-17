@extends('admin.layouts.layout')



@section('content')

 

    <!-- Content Wrapper. Contains page content -->



    <div class="content-wrapper">



        <section class="content">



         <div class="col-md-12">



            <div class="box">



                <div class="box-header"> Setting edit </div>







                <div class="box-body">







                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{$error}}
                            @endforeach
                        </div>
                    @endif


                    <!-- Post edit or Update -->

          <form onsubmit="return confirm('Are you sure you want to submit?')" action="" method="POST" enctype="multipart/form-data">
                       
                            <div class="form-group">
                                <label for="name">Title Key</label>
                                <input type="text" name="title_key" value="{!! @$setting_edit->title_key !!}" placeholder="bid_charge" class="form-control" id="bid_charge" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="title" value="{!! @$setting_edit->title !!}" placeholder="service_charge_employee" class="form-control" id="service_charge_employee" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Value</label>
                                <input type="text" name="value" value="{!! @$setting_edit->value !!}" placeholder="bid_charge" class="form-control" id="bid_charge" required>
                            </div>
                            <button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"> </i>Submit</button>
                            @csrf
                        </div>

                    </form>







                </div>



            </div>



        </div>







@endsection



