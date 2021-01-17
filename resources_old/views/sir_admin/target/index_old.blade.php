@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content">
      <div class="row"> <div class="col-md-12">


            <div class="panel panel-default">
                <div class="panel-heading"> Target Report </div>



                <div class="panel-body">

                    @if (Session::has('msg'))
                        <div class="alert alert-info">{{ Session::get('msg') }}</div>
                    @endif

                    <div class="clearfix">
                        @php
                            $target_year = DB::table('targets')->select('year')->groupBy('year')->get();
                            if(isset($_GET['year'])) $year = $_GET['year']; else $year = $target_year[0]->year;
                        @endphp

                        <form method="get" class="pull-left form-inline my-2 my-lg-0" action="">

                            <span class="report-headline"> Select year </span>
                            <select name="year" class="form-control" id="exampleSelect1" >
                                @foreach ($target_year as $row)
                                    <option @if(@$_GET["year"]==$row->year) selected @endif value="{{$row->year}}">{{$row->year}}</option>
                                @endforeach
                            </select>
                            <span class="report-headline">  Select User </span>
                            <select name="user" class="form-control" id="exampleSelect1" onchange="this.form.submit()" >
                                <option value="all"> All user </option>
                                @foreach ($team_memebers as $user)
                                    <option @if(@$_GET["user"]==$user->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <span class="report-headline"> Team </span>
                            <select name="team" class="form-control" id="exampleSelect1" onchange="this.form.submit()" >
                                <option value=""> All </option>
                                @php
                                    $teams = DB::table('teams')->orderBy('name','asc')->get();
                                @endphp
                                @foreach ($teams as $team)
                                    <option @if(@$_GET["team"]==$team->id) selected @endif value="{{$team->id}}">{{$team->name}}</option>
                                @endforeach
                            </select>


                            </form>


                            <p class="pull-right">  &nbsp;&nbsp;&nbsp;
                                <span class="btn btn-primary glyphicon glyphicon-print  " onclick="PrintElem('#print_able')"> Print </span>
                                <span title="Download" class="btn btn-success" onclick="wordDownload('print_able')"> <i class="glyphicon glyphicon-download-alt"> Download </i> </span>
                            </p>
                            <button type="button" data-target="#Modal-Add" class="btn btn-primary pull-right" data-toggle="modal"> + Add New</button>
                        </div>
                        <br/>
                        <div id="print_able" >
                        <table id="myTable" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th> Team </th>
                                <th> S.N.</th>
                                <th> User </th>
                                <th> Year </th>
                                @for($i=1; $i<=12; $i++)
                                    @php
                                        $dateObj   = DateTime::createFromFormat('!m', $i);
                                        $monthName = $dateObj->format('M');
                                    @endphp
                                <th> {!! $monthName !!} </th>
                                @endfor
                                <th> Total </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            for($j=1; $j<=12; $j++)
                            {
                                $total_target[$j]= 0;
                            }
                            $grand_total_target = 0;
                            $i=0;

                            if(isset($_GET['team']) && (int)$_GET['team'] >0 )
                            {
                                $data = DB::table('users')->select('id','name','team_id',
                                DB::raw("(SELECT `name`  FROM `teams` WHERE `id`=`users`.`team_id` LIMIT 1) as team_name")
                                )->where('team_id',$_GET['team'])->orderBy('team_id','asc')->get();
                            }
                            else if(isset($_GET['user']) && (int)$_GET['user'] >0 )
                            {
                                $data = DB::table('users')->select('id','name','team_id',
                                DB::raw("(SELECT `name`  FROM `teams` WHERE `id`=`users`.`team_id` LIMIT 1) as team_name")
                                )->where('id',$_GET['user'])->orderBy('team_id','asc')->get();
                            } else {
                                $data = DB::table('users')->select('id','name','team_id',
                                DB::raw("(SELECT `name`  FROM `teams` WHERE `id`=`users`.`team_id` LIMIT 1) as team_name")
                                )->whereRaw('group_id>2')->orderBy('team_id','asc')->get();
                            }

                            $team_array = array();
                            foreach($data as $row) $team_array[$row->team_id] = 0;
                            foreach($data as $row) $team_array[$row->team_id]++;

                            $first_team = $data[0]->team_id;
                            $kk = 1;

                        @endphp
                        @if(!empty($data))


                         @foreach($data as $row)
                             @php

                                 if($first_team!=$row->team_id ) $kk=1;

                                 $target_td = '';
                                 $target = 0;
                                 $user_id = $row->id;
                                 $i++;
                                 $targets = DB::table('targets')->select('id','amount','month')->whereRaw('user_id='.$user_id.' and year='.$year)->get();
                             @endphp
                            <tr>
                                @if($kk==1)
                                    @php $first_team=$row->team_id; $i=1;@endphp
                                <td rowspan="{!! $team_array[$row->team_id] !!}"  ><b>{!! $row->team_name !!} </b></td>
                                @endif
                                @php $kk++; @endphp
                                <td>{!! $i !!}</td>
                                <td><b>{!! $row->name !!} </b></td>
                                @for($j=1; $j<=12; $j++)

                                    @php

                                        $amount = '-'; $amount_link ="--";
                                        if(isset($targets[0]))
                                        {
                                            foreach($targets as $tar)
                                            {
                                                if(isset($tar->month) && $tar->month==$j)
                                                {
                                                    $amount = $tar->amount;
                                                    $amount_link = '<a href="#" data-toggle="modal" data-target="#id'.$tar->id.'">'.$amount.'</a>';
                                                    break;
                                                }
                                            }
                                            $target +=$amount;
                                        }
                                        $total_target[$j] += (int)$amount;
                                        $target_td .= '<td style="text-align: center; color:#000;">'.$amount_link.'</td>';
                                    @endphp
                                    @if(isset($tar->id))
                                    <div class="modal fade" id="id{!! $tar->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <br>
                                                    <br>
                                                    <form class="form-horizontal" action="{{ route('update-amount') }}" onsubmit="return confirm('Are you sure you want to submit?')" method="POST">
                                                        <div class="form-group row">
                                                            <label for="amount" class="col-sm-2 col-form-label">Amount</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount" value="{{ $tar->amount }}">
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                        <input type="hidden" name="id" value="{{ $tar->id }}"/>
                                                        <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                                                    </form>
                                                    <div style="clear: both"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endfor

                                <td>{{$year}}</td>
                                {!! $target_td !!}
                                <td> <strong> {!! $target !!} </strong> </td>
                            </tr>
                            @php $grand_total_target +=$target; @endphp
                         @endforeach

                         <tr>
                             <td> -- </td>
                             <td> -- </td>
                             <td> -- </td>
                             <td> -- </td>
                             @for($j=1; $j<=12; $j++)
                                 <td style="text-align: center;"> <strong> {!! $total_target[$j] !!} </strong></td>
                             @endfor
                             <td> <strong>{!! $grand_total_target !!}</strong> </td>
                         </tr>

                        @endif
                        </tbody>
                    </table>
                    </div>


                </div>
            </div>
        </div>
  </section>


        <div class="modal fade" id="Modal-Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"   >
            <div class="modal-dialog" role="document" style="min-width: 900px;" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h3> Add Target </h3>
                    </div>
                    <div class="modal-body">


                        <form class="form-horizontal" action="{!! url('/manage-target/') !!}" onsubmit="return confirm('Are you sure you want to submit?')" method="POST">
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="name"> User </label>
                                <div class="col-sm-2">
                                    <select name="user_id" id="user_id" class="form-control"  required>
                                        <option value="">Select user</option>
                                        @foreach($team_memebers as $row)
                                            <option value="{!! $row->id !!}"> {!! $row->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-1 control-label" for="name"> Year </label>
                                <div class="col-sm-2">
                                    <select name="year" id="year" class="form-control" required >
                                        <option value="">Select year</option>
                                        @php $year = date("Y"); @endphp
                                        @for($i=$year; $i<=$year+3; $i++)
                                            <option value="{!! $i !!}"> {!! $i !!}</option>
                                        @endfor
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">

                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th> Month </th>
                                            <th> Target </th>
                                            <th> Month </th>
                                            <th> Target </th>
                                        </tr>
                                        </thead>
                                        <tbody id="target_list">
                                            @for($i=1; $i<=12; $i++)
                                                @php
                                                    $dateObj   = DateTime::createFromFormat('!m', $i);
                                                    $monthName = $dateObj->format('F');
                                                @endphp
                                                <tr>
                                                    <td> {!! $monthName; !!} </td>
                                                    <td> <input name="amount[{!! $i !!}]" type="number" value="0" autocomplete="off" class="form-control" required> </td>
                                                @php
                                                    $i++;
                                                    $dateObj   = DateTime::createFromFormat('!m', $i);
                                                    $monthName = $dateObj->format('F');
                                                @endphp

                                                    <td> {!! $monthName; !!} </td>
                                                    <td> <input name="amount[{!! $i !!}]" type="number" value="0" autocomplete="off" class="form-control" required> </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                    <label class="col-sm-4 control-label" for="name"> &nbsp;  </label>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary"  >Submit</button>
                                    </div>

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                    {{method_field('POST')}}
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            var countBox =1;
            var boxName = 0;
            function addInput()
            {
                var user, year, month, amount;
                user = $("#user_id").val();
                var res = user.split("=");
                var user_id =res[0];
                var user_name =res[1];
                year = $("#year").val();
                month = $("#month").val();
                amount = $("#amount").val();

                HTML ='<tr id="tr_'+countBox+'">';
                HTML +='<td>'+user_name+' <input type="hidden" name="user[]" value="'+user_id+'"/> </td>';
                HTML +='<td>'+year+' <input type="hidden" name="year[]" value="'+year+'"/> </td>';
                HTML +='<td>'+month+' <input type="hidden" name="month[]" value="'+month+'"/> </td>';
                HTML +='<td>'+amount+' <input type="hidden" name="amount[]" value="'+amount+'"/> </td>';
                HTML +='<td><button type="button" class="btn btn-primary" onclick="removeInput('+"'"+countBox+"'"+')">X</button></td>';
                HTML +='</tr>';

                document.getElementById('target_list').innerHTML +=HTML;
                countBox += 1;
            }

            function removeInput(tr_id)
            {
                 $("#tr_"+tr_id).remove();
            }
        </script>

@endsection
