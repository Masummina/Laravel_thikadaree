@extends('admin.layouts.layout')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>   Activities </h1>
        </section>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="content">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Customer Interest</h3>
                </div>


                <form method="post" action="{!! url('save-activity') !!}" onsubmit="return confirm('Are you sure want to submit?');" >
                  <input type="hidden" name="edit_id" value="{{$edit_info->id}}"/>
                   <input type="hidden" name="customer_id" value="@php echo $_GET["id"]; @endphp"/>
                    <div id="PersonalBlock" class="card-body">

                        <div class="input-group">

                            <span class="input-group-addon">Project </span>

                            <select id="project" name="project_id" class=" form-control" data-live-search="true">
                                @if(isset($project))
                                    @foreach($project as $row)
                                        <option  value="{{ $row->id }}"  @if($edit_info->project_id == $row->id) selected="selected" @endif >{{ $row->title }} </option>
                                    @endforeach
                                @endif
                            </select>
                             <span class="input-group-addon"> Property </span>
                        <select name="property_id" id="property_id" class=" form-control"><option value=""> Select Property </option>
                          @if(isset($property))
                                @foreach($property as $row)
                                    <option  value="{{ $row->id }}"   >{{ $row->title }} </option>
                                @endforeach
                            @endif
                        </select>
                            <span class="input-group-addon"> Contact Method </span>
                            @php $contact_methods = array('Call Received','Call to','Visit to Office','Visit to Project','Internal Visit','Visit to Home'); @endphp
                            <select name="contact_method" class="form-control" required>
                                <option  value=""> Select  </option>
                                @foreach($contact_methods as $v)
                                    <option value="{!! $v !!}" @if($edit_info->contact_method==$v) selected @endif >{!! $v !!}</option>
                                @endforeach
                            </select>

                            <span id="spanContactType" class="input-group-addon">Status </span>
                            @php $lead_status = array('Primary','Secondary','Near to Close','DOL','BFO','Dead','client'); @endphp
                            <select name="lead_status" class="form-control" required>
                                <option  value=""> Select  </option>
                                @foreach($lead_status as $v)
                                    <option value="{!! $v !!}" @if($edit_info->lead_status==$v) selected @endif >{!! $v !!}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">Next Action </span>

                            @php $next_actions = array('Phone Call','Internal Visit','Project Visit','External Visit','Visit to Home'); @endphp
                            <select name="next_action" class="form-control" required>
                                <option  value=""> Select  </option>
                                @foreach($next_actions as $v)
                                    <option value="{!! $v !!}" @if($edit_info->next_action==$v) selected @endif >{!! $v !!}</option>
                                @endforeach
                            </select>

                            @php
                                $time = new DateTime($edit_info->next_action_date);
                                 $date=$time->format('Y-m-d');
                                $time=$time->format('H:i');
                                //dd($date);
                            @endphp

                            <span class="input-group-addon">Date </span>
                            <input name="next_action_date" value="{{$date}}" class="form-control col-md-2" type="date" required>

                            <span class="input-group-addon">Time</span>
                            <input name="next_action_time" type="time" value="{{$time}}" class="form-control">

                        </div>
                        <div id="CustomerRemarks">
                            <textarea name="remarks" placeholder="Description" class="form-control" required >{{$edit_info->remarks}}</textarea>
                        </div>
                    </div>


                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-7">
                                <button type="submit" name="submit" value="edited" class="btn btn-info pull-right"> Submit </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                </form>

            </div>
        </div>
        @endsection
