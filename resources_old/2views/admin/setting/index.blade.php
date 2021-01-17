@extends('admin.layouts.layout')
@section('content')
@php $org_nmae ='Users'; @endphp
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content">

      <div class="row"> <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading"> Manager Setting </div>



                <div class="panel-body">



                    @if (Session::has('success'))

                        <div class="alert alert-info">{{ Session::get('success') }}</div>

                    @endif

 

                 
                    <table id="myTable" class="table table-striped table-hover">

                        <thead>

                        <tr>

                            <th> S#</th>
                            <th> Title Key </th>
                            <th> Title </th>
                            <th> Value</th>
                            <th> Active </th>

                        </tr>

                        </thead>

                        <tbody>

                        @php $i=0; @endphp



                       @foreach($settings as $row)

                           @php $i++; 
                                 
                           @endphp

                            <tr>
                                <td>{{$i}}</td>
                                <td><b>{{$row->title_key}}</b></td>
                                <td><b>{{$row->title}}</b></td>
                                <td><b>{{$row->value}}</b></td>
                                <td>
                                    <a href="{{ url('/bem-settings/'.$row->id.'') }}" class="btn btn-warning pull-left"> <i class="glyphicon glyphicon-pencil"> </i>  Edit</a>
                                
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

