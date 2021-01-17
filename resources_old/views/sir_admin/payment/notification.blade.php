@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="row"> <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"> Payment List </div>

                        <div class="panel-body">

                            @if (Session::has('msg'))
                                <div class="alert alert-info">{{ Session::get('msg') }}</div>
                            @endif


                            <a class="pull-right btn btn-default" href="{{ url('/payment/create') }}" >Add New</a>

                            <table id="myTable" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th> S.N.</th>
                                    <th> Account Name</th>
                                    <th> Amount</th>
                                    <th> Date</th>
                                    <th> Next Payment Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i=0; @endphp

                                @foreach($payment_list as $row)
                                    @php
                                   $date1 = new DateTime($row->next_payment_date);
                                   $date2 = new DateTime($row->payment_date);
                                   $interval = $date2->diff($date1)->days;
                                   @endphp
                                    @if($interval<=30)
                                        @php $i++;@endphp
                                       @if($interval<=20 && $interval >10)

                                            <tr class="light-green">

                                       @elseif($interval<=10 && $interval >0 )

                                            <tr class="yellow">

                                       @elseif ($interval<=0)

                                            <tr class="red">


                                       @else
                                            <tr>
                                        @endif
                                    <td>{{$i}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->amount}} tk</td>
                                    <td>{{$row->payment_date}}</td>
                                    <td>{{$row->next_payment_date}}</td>
                                    <td>
                                    <!--a href="{{ url('/payment/'.$row->id.'/edit') }}" class="btn btn-default pull-left">Edit</a-->

                                    <!--form  class="pull-right delete" action="{{ url('/payment/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >
                                        {{method_field('DELETE')}}
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-default">Delete</button>
                                    </form-->
                                    </td>
                                    </tr>
                                       @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>
@endsection
