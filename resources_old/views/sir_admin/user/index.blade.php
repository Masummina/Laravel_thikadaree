@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> User List </div>

                <div class="panel-body">

                    @if (Session::has('success'))
                        <div class="alert alert-info">{{ Session::get('success') }}</div>
                    @endif


                    <a class="pull-right btn btn-default" href="{{ url('/users/create') }}" >Add New user</a>

                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Type </th>
                            <th> Team </th>
                            <th> Name </th>
                            <th> Email</th>
                            <th> Photo</th>
                            <th> Created By </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($user_list as $row)
                           @php $i++; @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$row->type}}</td>
                                <td>{{$row->team}}</td>
                                <td><b>{{$row->name}}</b></td>
                                <td>{{$row->email}}</td>
                                <td><img src="{{ asset('img/'.$row->photo) }}" height="80" width="80" alt="User image"></td>
                                <td>{{$row->createdby}}</td>
                                <td>
                                    <a href="{{ url('/users/'.$row->id.'/edit') }}" class="btn btn-default pull-left">Move / Edit</a>
                                    @if(Auth::user()->group_id==1)
                                        <form  class="pull-right delete" action="{{ url('/users/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >
                                            {{method_field('DELETE')}}
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-default">Delete</button>
                                        </form>
                                    @endif
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
