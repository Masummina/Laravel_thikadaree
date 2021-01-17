@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Manage Team </div>

                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif


                    <a class="pull-right btn btn-default" href="{{ url('/team/create') }}" >Add New</a>
                    <br/>
                    <div class="clearfix"></div>
                    <table id="myTable" class="table table-striped table-hover clearfix">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Name</th>
                            <th> Short Note</th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($category_list as $row)
                           @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td><b>{{$row->name}}</b></td>
                                <td>{{$row->description}}</td>
                                <td style="width: 210px;">
                                    <a href="{{ url('/team/'.$row->id.'/edit') }}" class="btn btn-default pull-left">Edit</a>
                                    <a style="margin-left: 5px;" href="{{ url('/users/?team='.$row->id) }}" class="btn btn-default pull-left">Details</a>    
                                    <form  class="pull-right delete" action="{{ url('/team/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >
                                        {{method_field('DELETE')}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-default">Delete</button>
                                    </form>
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
