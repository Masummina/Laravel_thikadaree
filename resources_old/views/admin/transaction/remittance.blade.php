@extends('admin.layouts.layout')
@section('content')
@php $org_nmae ='Users'; @endphp
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content">

      <div class="row"> <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading">Manage Remittance </div>



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
                                <td><b>{!! date("F j, Y", strtotime($row->txn_date)) !!}</b></td>

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

