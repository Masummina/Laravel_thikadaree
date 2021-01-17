@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Accounts List </div>

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif


                    <a class="pull-right btn btn-default" href="{{ url('/account/create') }}" >Add New</a>

                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Account Id</th>
                            <th> Client</th>
                            <th> Project</th>
                            <th> Property</th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($client_list as $row)
                           @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td> 
                                    @php  
                                    $sum = $row->id + 5000;
                                    echo "AC".$sum;
                                    @endphp
                                </td>
                                <td><b>{!!$row->prefix!!} {{$row->name}}</b></td>
                                <td>{{$row->project_title}}</td>
                                 <td>{{$row->property_title}}</td>
                                 <td>

                                     <!--<a href="{{ url('/account/'.$row->id.'/edit') }}" class="btn btn-default pull-left">Edit</a>-->
                                     <a href="{{ url('/account/status/'.$row->id.'/') }}" class="btn btn-default pull-left">Status</a>


                                    <!-- <a style="margin-left: 7px;" href="{{ url('/payment/create?id='.$row->id.'') }}" class="btn btn-default pull-left">Make Payment</a> -->

                                </td>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
@endsection
