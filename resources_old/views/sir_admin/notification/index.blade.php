@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>   Notifications </h1>
      </section>
        <div class="row">
            <div class="col-xs-12">

                <form id="advanced_s" method="get" class="  form-inline my-2 my-lg-0" action="">

                        <div class="pull-right" style="margin-right: 30px;">
                            <span class="report-headline">  Search By Date  : </span>
                            <input type="date" name="date" value="{{@$_GET['date']}}" class="form-control" >

                            <input  type="submit" class="btn btn-primary" value=" Search " name="submit">
                        </div>

                </form>

            </div>
        </div>
      
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
                @if(session()->has('success'))
                   <div class="alert alert-success">
                      {{ session()->get('success') }}
                   </div>
                @endif

                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <div class="col-md-12">
                  <div class="row clearfix">

                  @php //print_r($property_list); @endphp

                  @if(count($notification_list)>0)
                      <table class="table  table-striped">
                          <thead>
                          <tr>
                              <th>S# </th>
                              <th style="width: 170px;">Notification Date </th>
                              <th>Notification </th>
                              
                          </tr>
                          </thead>
                          <tbody>
                          @php $i=0 @endphp
                          @foreach($notification_list as $row)
                              @php
                                    $i++;
                                    $created_at = date("Y-m-d",strtotime($row->created_at));
                                    if(date("Y-m-d")==$created_at || $row->viewed==0 )
                                        $bg='class="bg-yellow"';
                                    else
                                        $bg='';
                              @endphp
                              <tr  >
                                  <td {!! $bg !!} >{{ $i }} </td>
                                  <td {!! $bg !!} > @php
                                      echo date('l jS  F Y ', strtotime($row->created_at));
                                  @endphp</td>
                                  <td {!! $bg !!} >{{ $row->massage }} </td>
                                  
                                  
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                  @else
                      Data not found
                  @endif

                  </div>
                </div>

                    <style>
                        .bg-green { background-color: #398439 }
                        .bg-red { background-color: #c12e2a }
                        .bg-yellow { background-color: #9ad717 }
                    </style>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          @php
              $group_id = Auth::user()->group_id;
              if($group_id<3)
              {
                    DB::table('notifications')->update(array('viewed_admin' => '1'));
              } else {
                    $user_id = Auth::user()->id;
                    DB::table('notifications')->where('user_already', $user_id)->update(array('viewed' => '1'));
              }

          @endphp
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

  <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
@endsection    