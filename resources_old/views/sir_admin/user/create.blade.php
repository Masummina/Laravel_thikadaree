@extends('admin.layouts.layout')
@section('content')

<script>

    function show_team(group_id)
    {
       if(group_id>2)
       {
         $("#team-div").show(); alert("Please select team");
       } else {
         $("#team-div").hide();
       }
    }

</script>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
         <div class="col-md-12">
            <div class="box">
                <div class="box-header"> Create User </div>

                <div class="box-body">

                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                        </div>
                    @endif

                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('id'){{ url('/users') }}/@yield('id')@else {{ url('/users') }} @endif" method="POST" enctype="multipart/form-data">
                        @section('editMethod')
                        @show

                        @if(Auth::user()->group_id==1)
                            <div class="form-group">
                               <label for="name"> Type </label>
                               <select name="group_id" onchange="show_team(this.value)" class="form-control" required>
                                  @if($user_type)
                                     @foreach($user_type as $row)
                                       <option value="{!! $row->id !!}" @if(old('group_id')==$row->id) selected @endif >{!! $row->name !!}</option>
                                     @endforeach
                                  @endif
                                </select>
                            </div>

                            <div class="form-group" id="team-div" >
                                <label for="name">Select Team </label>
                                <select name="team_id" class="form-control">
                                    <option value=""> Team </option>
                                    @if($team_list)
                                        @foreach($team_list as $row)
                                            <option value="{!! $row->id !!}" @if(old('team_id')==$row->id) selected @endif >{!! $row->name !!}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif

                         <div class="form-group">
                             <label for="name">Name</label>
                             <input type="text" name="name" value="{!! old('name') !!}" placeholder="Full Name" class="form-control" id="name" required>
                         </div>
                         <div class="form-group">
                            <label for="name">Email</label>
                            <input type="email" name="email" value="{!! old('email') !!}" placeholder="Email" class="form-control" id="email" required>
                         </div>
                         <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text" name="phone" value="{!! old('phone') !!}" placeholder="phone" class="form-control" id="phone" required>
                         </div>
                            <div class="form-group">
                                <label for="name">Photo</label>
                                <input type="file" name="photo" value="{!! old('photo') !!}" placeholder="photo" class="form-control" id="photo">
                            </div>
                         <div class="form-group">
                             <label for="name">Password</label>
                             <input type="password" name="password" value="{!! old('password') !!}" placeholder="password" class="form-control" id="password" required>
                         </div>
                         <div class="form-group">
                            <label for="name">Confirmed Password</label>
                            <input type="password" name="password_confirmation" value="{!! old('password_confirmation') !!}" placeholder="Confirmed password" class="form-control" id="password_confirmation" required>
                         </div>


                        <button type="submit" class="btn btn-default">Submit</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    </form>

                </div>
            </div>
        </div>

@endsection
