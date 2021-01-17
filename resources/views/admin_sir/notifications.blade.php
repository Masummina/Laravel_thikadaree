@extends('admin.layouts.layout')
@section('content')
@php $org_nmae ='Users'; @endphp
    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

      <!-- Content Header (Page header) -->

      <section class="content">

      <div class="row"> <div class="col-md-12">

            <div class="panel panel-default">

                <div class="panel-heading"> All notifications </div>

                <div class="panel-body">
 

  
                    <table id="myTable" class="table table-striped table-hover">

                        <thead>

                        <tr>

                            <th> S#</th>
                            <th> Notification Text </th>                            
                            <th> Status </th>

                        </tr>

                        </thead>

                        <tbody>

                        @php $i=0; @endphp

                       @foreach($notifications as $row)

                           @php                                 
                                $i++;                                 
                                $action = url($row->action_url);
                           @endphp

                            <tr>
                                <td>{{$i}}</td>
                                <td><b>{{$row->notification_text}}</b></td>
                                <td><b> <a href="{!! $action !!}" class="btn btn-success" onclick="ChangeViewAsSeen('{!!$row->id!!}')" > Go -> </a></b></td>
                            </tr>

                       @endforeach

                        </tbody>

                    </table>
                    {{ $notifications->links() }}

                </div>

            </div>

        </div>

    <script> 
        function ChangeViewAsSeen(notification_id)
        {
            $.ajax({
                type:'GET',
                url:'{!! url('/notification-seen/?notification_id=') !!}'+notification_id,
                success:function(data){
                    //$('#header-noti-count').html(data);
                }
            });
        }
    </script>

        

</section>



@endsection

