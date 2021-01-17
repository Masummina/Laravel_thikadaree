@extends('admin.layouts.layout')
@section('content')
@php $org_nmae ='Users'; @endphp
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content">

      <div class="row"> <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading"> All Transactions </div>



                <div class="panel-body">



                    @if (Session::has('success'))

                        <div class="alert alert-info">{{ Session::get('success') }}</div>

                    @endif

 
 

                    <table id="myTable" class="table table-striped table-hover">

                        <thead>

                        <tr>

                            <th> S.N.</th>
 
                            <th> Particulars </th>
                            <th> Bank Name </th>
                            <th> Narration </th>
                            <th> Amount </th>
                            <th> Transactions date </th>
                            <th> User ID </th>

                            <th width="190px;"> Action </th>

                        </tr>

                        </thead>

                        <tbody>

                        @php $i=0; @endphp



                       @foreach($transactions as $row)
                           @php $i++; 
                           @endphp

                            <tr>

                                <td>{{$i}}</td>
 
                                <td><b>{{$row->particulars}}</b></td>
                                <td><b>{{$row->bank_name}}</b></td>
                                <td><b>{{$row->narration}}</b></td>
                                <td><b>{!! number_format($row->amount, 2) !!}</b></td>
                                <td><b>  {!! date("F j, Y", strtotime($row->txn_date)) !!}  </b></td>
                                <td><b>{{$row->name}}</b></td>

                                <td>
                                @if($row->status == 0)
                                <a href="{{url('/bem-transaction/'.$row->id.'/edit?action=update&status=2')}}" onclick="return confirm('Are you sure you want to disable this item?');"  class="btn btn-danger">  <i class="glyphicon glyphicon-ban-circle"> </i>  Cancel</a>
                                @elseif($row->status == 2)
                                <a href="{{url('/bem-transaction/'.$row->id.'/edit')}}" onclick="return confirm('Are you sure you want to disable this item?');"  class="btn btn-success">  <i class="glyphicon glyphicon-ok"> </i> Canceled</a>

                                @endif
                                

                                    <!-- @if(Auth::user()->usertype=='admin')

                                        <form  class="pull-right delete" action="{{ url('/bem-transaction/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >

                                            {{method_field('DELETE')}}

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"> </i> Delete</button>

                                        </form>
                                    @endif -->

                                    @if($row->status==0)
                                        <a href="{{url('/bem-transaction/'.$row->id.'/edit?action=update&status=1')}}" onclick="return confirm('Are you sure you want to enable this item?');"  class="btn btn-warning">  <i class="glyphicon glyphicon-ban-circle"> </i> Disable </a>
                                    @else 
                                        <a href="{{url('/bem-transaction/'.$row->id.'/edit?action=update&status=0')}}" onclick="return confirm('Are you sure you want to disable this item?');"  class="btn btn-success">  <i class="glyphicon glyphicon-ok"> </i> Enable</a>
                                    @endif

                                </td>

           



                            </tr>

                       @endforeach

                        </tbody>

                    </table>
                    {{ $transactions->links() }}

                </div>

            </div>

        </div>

</section>



@endsection

