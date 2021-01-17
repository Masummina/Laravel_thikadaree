@extends('admin.layouts.layout')



@section('content')

 

    <!-- Content Wrapper. Contains page content -->



    <div class="content-wrapper">



        <section class="content">



         <div class="col-md-12">



            <div class="box">



                <div class="box-header"> Edit charges </div>







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
                                <label for="name">Title</label>
                                <input type="text" name="title" value="{!! @$charges->title !!}" placeholder="bid_charge" class="form-control" id="bid_charge" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Title Bn</label>
                                <input type="text" name="title_bn" value="{!! @$charges->title_bn !!}" placeholder="service_charge_employee" class="form-control" id="service_charge_employee" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Bid charge</label>
                                <input type="text" name="bid_charge" value="{!! @$charges->bid_charge !!}" placeholder="bid_charge" class="form-control" id="bid_charge" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Service Charge Employee</label>
                                <input type="text" name="service_charge_employee" value="{!! @$charges->service_charge_employee !!}" placeholder="bid_charge" class="form-control" id="bid_charge" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Budget Range</label>
                                <input type="text" name="budget_range" value="{!! @$charges->budget_range !!}" placeholder="bid_charge" class="form-control" id="bid_charge" required>
                            </div>
                            <button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-ok"> </i>Submit</button>
                            @csrf
                        </div>

                    </form>







                </div>



            </div>



        </div>







@endsection



