@extends('admin.layouts.layout')
@section('content')
@php $org_nmae ='Users'; @endphp
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content">

      <div class="row"> <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading"> User Manager </div>



                <div class="panel-body">



                    @if (Session::has('success'))

                        <div class="alert alert-info">{{ Session::get('success') }}</div>

                    @endif

 

                    <p class="pull-right">
                        <a class=" btn btn-primary"  href="{{ url('bem-users/create/') }}"  ><i class="fa fa-plus"></i> Add New User</a>
                    </p>

                    <table id="myTable" class="table table-striped table-hover">

                        <thead>

                        <tr>

                            <th> S.N.</th>

                            <th> Type </th>
 

                            <th> Name </th>

                            <th> Email</th>

                   

                            <th> Action </th>

                        </tr>

                        </thead>

                        <tbody>

                        @php $i=0; @endphp



                       @foreach($user_list as $row)

                           @php $i++; 
                                if($row->usertype!=''){
                                    $usertype = ucfirst($row->usertype);
                                } else {
                                    $usertype = 'User';
                                }
                           @endphp

                            <tr>

                                <td>{{$i}}</td>

                                <td>{{ $usertype }}</td>
 
                                <td><b>{{$row->name}}</b></td>

                                <td>{{$row->email}}</td>
 
                                <td>

                                    <a href="{{ url('/bem-users/'.$row->id.'/edit') }}" class="btn btn-warning pull-left"> <i class="glyphicon glyphicon-pencil"> </i>  Edit</a>

                                    @if(Auth::user()->usertype=='admin')

                                        <form  class="pull-right delete" action="{{ url('/users/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >

                                            {{method_field('DELETE')}}

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"> </i> Delete</button>

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

