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


                   <!--<a class="pull-right btn btn-default" href="{{ url('/payment/create') }}" >Add New</a> -->

                    <table id="myTable" class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th> S.N.</th>
                            <th> Payment Date </th>
                            <th> Account Name </th>
                            <th> Amount</th>
                            <th> R/D Charge </th>
                            <th> Mode</th>
                            <th> Name/No. </th>
                            <th> Action </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp

                       @foreach($payment_list as $row)
                           @php $i++;
                           $date1=new DateTime($row->payment_date);
                           //$date2=new DateTime($row->next_payment_date);
                           $date2=new DateTime(date("Y-m-d"));
                           $interval=$date2->diff($date1)->days;
                         //  echo ($interval);
                           if($row->status==0 )
                           {
                                echo '<tr class="yellow">';
                           }
                           else if ($row->type=='dr')
                           {
                                echo '<tr class="red">';
                           }
                           else
                           {
                                echo '<tr>';
                           }

                            if($row->check_no=="") $p_mode="Cash Payment"; else $p_mode=$row->check_no;
                            if($row->bank=="") $bank=$row->mr_no; else $bank=$row->bank;

                            if($row->rebate>0) $RD_C="R ".$row->rebate;
                            else if($row->delay_charge>0) $RD_C="D ".$row->delay_charge;
                            else $RD_C="--"

                           @endphp

                                <td>{{$i}}</td>
                                <td>  {!! date("j F,  Y",strtotime($row->payment_date)) !!}  </td>
                                <td>
                                    <a href="{{ url('/account/status/'.$row->account_id) }}" class="btn btn-primary pull-left">{!! $row->title !!}</a>
                                </td>
                                <td>
                                    <a href="{{ url('/account/'.$row->account_id) }}" class="btn btn-primary pull-left"> {!! number_format($row->amount) !!} </a>
                                </td>
                                <td>{!! $RD_C !!} </td>
                                <td>{!! $p_mode !!} </td>
                                <td>{!! $bank !!} </td>

                                <td>
                                    <a href="{{ url('/money-receipt/'.$row->id) }}" class="btn btn-primary" data-toggle="modal">Money Receipt</a>
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
