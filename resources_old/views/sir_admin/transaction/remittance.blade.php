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

 

             

                    <table id="myTable" class="table table-striped table-hover">

                        <thead>

                        <tr>

                            <th> S.N.</th>
 
                            <th> Voucher no </th>
                            <th> Voucher type </th>
                            <th> credit_amount </th>
                            <th> debit_amount </th>
                            <th> particulars </th>
                            <th> Remarks </th>
                            <th> User_id </th>
                            <th> Transaction_id </th>
                            <th> Date </th>

                            <th width="190px;"> Action </th>
                            <th> Active </th>

                        </tr>

                        </thead>

                        <tbody>

                        @php $i=0; @endphp



                       @foreach($remittance as $row)

                           @php $i++; 
                                 
                           @endphp

                            <tr>

                                <td>{{$i}}</td>
 
                                <td><b>{{$row->vch_no}}</b></td>
                                <td><b>{{$row->vch_type}}</b></td>
                                <td><b>{{$row->credit_amount}}</b></td>
                                <td><b>{{$row->debit_amount}}</b></td>
                                <td><b>{{$row->particulars}}</b></td>
                                <td><b>{{$row->remarks}}</b></td>
                                <td><b>{{$row->user_id}}</b></td>
                                <td><b>{{$row->transaction_id}}</b></td>
                                <td><b>{{$row->txn_date}}</b></td>

                                <td>
                                @if($row->status == 2)
                                <a href="{{url('/bem-remittance/'.$row->id.'/edit?action=update&status=1')}}" onclick="return confirm('Are you sure you want to disable this item?');"  class="btn btn-danger">  <i class="glyphicon glyphicon-ban-circle"> </i> Cancled</a>
                                @else
                                <a href="{{url('/bem-remittance/'.$row->id.'/edit?action=update&status=2')}}" onclick="return confirm('Are you sure you want to disable this item?');"  class="btn btn-success">  <i class="glyphicon glyphicon-ok"> </i> pending</a>

                                @endif
                                

                                    @if(Auth::user()->usertype=='admin')

                                        <form  class="pull-right delete" action="{{ url('/bem-remittance/'.$row->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete?')" >

                                            {{method_field('DELETE')}}

                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <button type="submit" class="btn btn-danger"> <i class="glyphicon glyphicon-trash"> </i> Delete</button>

                                        </form>
                                    @endif

                                </td>

                                <td>

                                    @if($row->status==0)
                                        <a href="{{url('/bem-remittance/'.$row->id.'?action=update&status=1')}}" onclick="return confirm('Are you sure you want to enable this item?');"  class="btn btn-warning">  <i class="glyphicon glyphicon-ban-circle"> </i> Disable </a>
                                    @else 
                                        <a href="{{url('/bem-remittance/'.$row->id.'?action=update&status=0')}}" onclick="return confirm('Are you sure you want to disable this item?');"  class="btn btn-success">  <i class="glyphicon glyphicon-ok"> </i> Enable</a>
                                    @endif

                                </td>



                            </tr>

                       @endforeach

                        </tbody>

                    </table>
                    {{ $remittance->links() }}

                </div>

            </div>

        </div>

</section>



@endsection

