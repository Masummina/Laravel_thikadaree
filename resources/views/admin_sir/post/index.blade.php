@extends('admin.layouts.layout')
@section('content')
@php $org_nmae ='Users'; @endphp
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content">

      <div class="row"> <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading"> Post Manager </div>



                <div class="panel-body">



                    @if (Session::has('success'))

                        <div class="alert alert-info">{{ Session::get('success') }}</div>

                    @endif

 

                    <p class="pull-right">
                        <a class=" btn btn-primary"  href="{{ url('bem-posts/create/') }}"  ><i class="fa fa-plus"></i> Add New User</a>
                    </p>

                    <table id="myTable" class="table table-striped table-hover">

                        <thead>

                        <tr>

                            <th> S.N.</th>
 
                            <th> Title </th>
                            <th> Post Type </th>
                            <th> Discription </th>
                            <th> Image </th>

                            <th width="150px;"> Action </th>
                            <th> Active </th>

                        </tr>

                        </thead>

                        <tbody>

                        @php $i=0; @endphp



                       @foreach($post as $row)

                           @php $i++; 
                                 
                           @endphp

                            <tr>

                                <td>{{$i}}</td>
 
                                <td><b>{{$row->title}}</b></td>
                                <td><b>{{$row->post_type}}</b></td>
                                <td><b>{{$row->discription}}</b></td>
                                <td><b>{{$row->image}}</b></td>

                                <td>

                                    <a href="{{ url('/bem-posts/'.$row->id.'/edit') }}" class="btn btn-warning pull-left"> <i class="glyphicon glyphicon-pencil"> </i>  Edit</a>

                                    @if(Auth::user()->usertype=='admin')

                                        <form  class="pull-right delete" action="{{ url('/bem-posts/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >

                                            {{method_field('DELETE')}}

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"> </i> Delete</button>

                                        </form>
                                    @endif

                                </td>

                                <td>

                                    @if($row->status==0)
                                        <a href="{{url('/bem-posts/'.$row->id.'/edit?action=update&status=1')}}" onclick="return confirm('Are you sure you want to enable this item?');"  class="btn btn-warning">  <i class="glyphicon glyphicon-ban-circle"> </i> Disable </a>
                                    @else 
                                        <a href="{{url('/bem-posts/'.$row->id.'/edit?action=update&status=0')}}" onclick="return confirm('Are you sure you want to disable this item?');"  class="btn btn-success">  <i class="glyphicon glyphicon-ok"> </i> Enable</a>
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

