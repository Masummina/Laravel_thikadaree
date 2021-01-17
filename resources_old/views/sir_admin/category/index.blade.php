@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Scheme List </div>

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif


                    <a class="pull-right btn btn-default" href="{{ url('/scheme/create') }}" >Add New</a>

                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Name</th>
                            <th> Number of Payment</th>
                            <th> Initial Amount (%)</th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($category_list as $row)
                           @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->n_p}}</td>
                                 <td>{{$row->initial_amount}}</td>
                                <td>
                                    <a href="{{ url('/scheme/'.$row->id.'/edit') }}" class="btn btn-default pull-left">Edit</a>

                                    <!--form  class="pull-right delete" action="{{ url('/scheme/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >
                                        {{method_field('DELETE')}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-default">Delete</button>
                                    </form-->
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
