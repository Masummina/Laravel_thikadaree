@extends('admin.layouts.layout')
@section('content')

  <style>
    .project-header a{
      text-decoration: none;
    }
  </style>
    @php
    function get_by_id($arr,$id)
    {
            for($x=0;$x<count($arr);$x++)
            {
                    if($arr[$x]->project_id==$id)
                    {
                        return $arr[$x]->quantity;
                    }
            }
            return 0;
    }
    @endphp
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Project Manager
          <small> All projects list </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      
      <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body" id="print_prospect" >
              @if(session()->has('message'))
                   <div class="alert alert-success">
                      {{ session()->get('message') }}
                   </div>
              @endif
             @php
               $empty_apartments = '';
               $available_apartments = '';
               $totalSold = 0;
               $unsold = 0;
               $K_total_sold_proj = 0;
               $K_total_unsold_proj = 0;
               $K_total_ready = 0;
               $K_total_ongoing = 0;
             @endphp

             @foreach($projectTotal as $projectT)
                  @php
                     $total_sold_apartments=get_by_id($sold,$projectT->id);
                     $total_sold_comm=get_by_id($comm_sold,$projectT->id);
                     $total_owner_uddl=get_by_id($uddl,$projectT->id);
                     $total_comm_owner_uddl = get_by_id($comm_uddl,$projectT->id);
                     $total_unsold_apartments=$total_owner_uddl-$total_sold_apartments;
                     $total_unsold_comm = $total_comm_owner_uddl- $total_sold_comm;
                     $totalSold += $total_sold_apartments+$total_sold_comm;
                     $unsold += $total_unsold_apartments+$total_unsold_comm;
                  @endphp
             @endforeach

             @foreach($projects as $project)
             @php
                $total_apartments=get_by_id($total,$project->id);
                $commererceial_apartments=get_by_id($commercial,$project->id);
                $residential_apartments=get_by_id($residential,$project->id);
                 $comm_apartments=get_by_id($app_commerceil,$project->id);
                 $sold_apartments=get_by_id($sold,$project->id);
                 $sold_comm=get_by_id($comm_sold,$project->id);
                 $booked_apartments=get_by_id($booked,$project->id);
                 $owner_apartments=get_by_id($owner,$project->id);
                 $commowner = get_by_id($owner,$project->id);
                 $owner_uddl=get_by_id($uddl,$project->id);
                 $comm_owner_uddl = get_by_id($comm_uddl,$project->id);
                 $comm_landowner = get_by_id($comm_owner,$project->id);
                 $unsold_apartments=$owner_uddl-$sold_apartments;
                 $unsold_comm = $comm_owner_uddl- $sold_comm;
            @endphp
            @if($unsold_apartments==0 && $unsold_comm==0)
              @php
                
                $K_total_sold_proj++;

                $empty_apartments .= '
                <tr>
                  <td>'.$project->area.'</td>
                  <td><b> '.$project->title.' </b></td>
                  <td>'.$project->type.'</td>
                  <td>'.$project->address.'</td>
                  <td>
                    <table>
                    <tr>
                      <td> A. = '.($residential_apartments+$comm_apartments).'</td>
                    </tr>
                    <tr>
                      <td>C. ='.$commererceial_apartments.'</td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table>
                    <tr>
                      <td>'.$owner_uddl.'</td>
                    </tr>
                    <tr>
                      <td>'.$comm_owner_uddl.'</td>
                    </tr>
                    </table>
                  </td>
                  <td>
                      <table>
                        <tr>
                          <td> '.$owner_apartments.'</td>
                        </tr>
                        <tr>
                          <td> '.$comm_landowner.'</td>
                        </tr>
                    </table>
                  </td>
                  <td>
                     <table>
                      <tr>
                        <td> '.$sold_apartments.'</td>
                      </tr>
                      <tr>
                        <td>'.$sold_comm.'</td>
                      </tr>
                    </table>
                  </td>
                  <td>
                    <table>
                      <tr>
                        <td> '.$unsold_apartments.'</td>
                      </tr>
                      <tr>
                        <td>'.$unsold_comm.' </td>
                      </tr>
                    </table>
                  </td>
                  <td>';

                     if ($project->status == 1){
                        $empty_apartments .= '<button type="button" class="btn btn-success">Ready </button>';
                     } elseif ($project->status == 2) {
                        $empty_apartments .= ' <button type="button" class="btn btn-success">Ongoing</button>';
                     } elseif ($project->status == 3) {
                        $empty_apartments .= '<button type="button" class="btn btn-success">Forthcoming</button>';
                     } else {
                      $empty_apartments .= '<button type="button" class="btn btn-warning">Sold</button>';
                     }

                    $empty_apartments .='</td>'; 
                  
                  @endphp
                @php if (Auth::User()->group_id == "1" || Auth::User()->group_id == "2")
                $empty_apartments .= '
                  <td class="remove_td" >
                      <a onclick="return confirm('."'You are going to delete ?'".')" href="'.url('project/delete/'.$project->id).'"  class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                      <a href="'.url('project/edit/'.$project->id).'"  class="btn btn-success"><i class="fa fa-edit"></i></a>
                      <a href="'.url('project-property/'.$project->id).'"  class="btn btn-primary"> View </a>
                  </td>
                </tr> ';
              @endphp
            @else
              @php
                $K_total_unsold_proj++;
                $available_apartments .= '
                <tr>
                  <td>'.$project->area.'</td>
                  <td><b> '.$project->title.' </b></td>
                  <td>'.$project->type.'</td>
                  <td>'.$project->address.'</td>
                  <td>
                    <table>
                    <tr>
                      <td> A. = '.($residential_apartments+$comm_apartments).'</td>
                    </tr>
                    <tr>
                      <td>C. ='.$commererceial_apartments.'</td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table>
                    <tr>
                      <td>'.$owner_uddl.'</td>
                    </tr>
                    <tr>
                      <td>'.$comm_owner_uddl.'</td>
                    </tr>
                    </table>
                  </td>
                  <td>
                      <table>
                        <tr>
                          <td> '.$owner_apartments.'</td>
                        </tr>
                        <tr>
                          <td> '.$comm_landowner.'</td>
                        </tr>
                    </table>
                  </td>
                  <td>
                     <table>
                      <tr>
                        <td> '.$sold_apartments.'</td>
                      </tr>
                      <tr>
                        <td>'.$sold_comm.'</td>
                      </tr>
                    </table>
                  </td>
                  <td>
                    <table>
                      <tr>
                        <td> '.$unsold_apartments.'</td>
                      </tr>
                      <tr>
                        <td>'.$unsold_comm.' </td>
                      </tr>
                    </table>
                  </td>
                  <td>';

                    if ($project->status == 1){
                        $K_total_ready++;
                        $available_apartments .= '<button type="button" class="btn btn-success">Ready </button>';
                    } elseif ($project->status == 2){
                        $K_total_ongoing++;
                        $available_apartments .= ' <button type="button" class="btn btn-success">Ongoing</button>';
                    } elseif ($project->status == 3){
                        $available_apartments .= '<button type="button" class="btn btn-success">Forthcoming</button>';
                    } else {
                        $available_apartments .= '<button type="button" class="btn btn-warning">Sold</button>';
                    }                       
                    $available_apartments .='</td>';

              @endphp
              @php if (Auth::User()->group_id == "1" || Auth::User()->group_id == "2")
                $available_apartments .= '
                  <td class="remove_td" >
                      <a onclick="return confirm('."'You are going to delete ?'".')" href="'.url('project/delete/'.$project->id).'"  class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                      <a href="'.url('project/edit/'.$project->id).'"  class="btn btn-success"><i class="fa fa-edit"></i></a>
                      <a href="'.url('project-property/'.$project->id).'"  class="btn btn-primary"> View </a>
                  </td>
                </tr> ';
              @endphp
            @endif
              @endforeach
                <div class="box-header">
                  <p class="pull-right">
                    @if (Auth::User()->group_id == "1" || Auth::User()->group_id == "2")
                      <a class=" btn btn-primary"  href="{{ url('project/new/') }}"  ><i class="fa fa-plus"></i> New Project</a>
                    @endif                    
                  </p>
                  <br>
                  <div class="project-header" style="font-size: 18px; float:left; width:80%; margin:0px 0px 10px 0px;">
                    {{-- Total : <a href="{!! url('project') !!}"> <i class="btn btn-danger"> {!! count($projectTotal) !!} </i></a> --}}
                    Project # Total : <a href="{!! url('project') !!}"> <i class="btn btn-danger"> {!! count($projectTotal) !!} </i></a>
                    Sold : <a href="{!! url('project') !!}"> <i class="btn btn-danger"> {!! $K_total_sold_proj !!} </i></a>
                    Unsold : <a href="{!! url('project') !!}"> <i class="btn btn-danger"> {!! $K_total_unsold_proj !!} </i></a>
                    {{-- Ready :  <a href="{!! url('project?action=ready') !!}"> <i class="btn btn-danger"> {!! count($ready) !!} </i> </a> --}}
                    Ready :  <a href="{!! url('project?action=ready') !!}"> <i class="btn btn-danger"> {!! $K_total_ready !!} </i> </a>  
                    {{-- Ongoing : <a href="{!! url('project?action=ongoing') !!}"> <i class="btn btn-danger"> {!! count($ongoing) !!} </i> </a> --}}
                    Ongoing : <a href="{!! url('project?action=ongoing') !!}"> <i class="btn btn-danger"> {!! $K_total_ongoing !!} </i> </a>
                  </div>

                  <div class="project-header" style="font-size: 18px; float:left; width:80%">  
                    
                    Apartment # Forthcoming : <a href="{!! url('project?action=forthcoming') !!}"> <i class="btn btn-danger"> {!! count($forthcoming) !!} </i> </a>
                    Total Sold : <a href="{!! url('project?action=sold') !!}"> <i class="btn btn-danger"> {!! $totalSold !!} </i> </a>
                    Total Unsold : <a href="{!! url('project?action=unsold') !!}"> <i class="btn btn-danger"> {!! $unsold !!} </i> </a>
                  </div>
                  <p class="pull-right">
                    <span title="Print" class="btn btn-primary" onclick="PrintElem('#print_prospect')"> <i class="glyphicon glyphicon-print"> </i> </span>
                    <span title="Download" class="btn btn-success" onclick="wordDownload('print_prospect')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
                  </p>
                </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Area</th>
                    <th>Name </th>
                    <th>Type </th>
                    <th>Address</th>
                    <th>Number of units</th>
                    <th>Uddl</th>
                    <th>Lo</th>
                    <th>Sold</th>
                    <th>Unsold</th>
                    <th>Status</th>
                    @if (Auth::User()->group_id == "1" || Auth::User()->group_id == "2")<th width="170" class="remove_td">Action</th>@endif
                  </tr>
                </thead>
                <tbody>
                 {!! $available_apartments !!}
                 @if(isset($_GET['action']) && $_GET['action']!='')
                 @else
                  @if($empty_apartments!=null)
                  <tr>
                     <td colspan="11" style="text-align: center; font-size: 18px; background-color: #7adddd;">
                       All Sold Commercial & Residential Apartments
                     </td>
                  </tr>
                  {!! $empty_apartments !!}
                  @endif
                @endif
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
          <!-- /.box -->
        
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
      <style>
        .right_btn {
              float: right;
              margin: 10px 5px 10px 10px;
          }
      </style>
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