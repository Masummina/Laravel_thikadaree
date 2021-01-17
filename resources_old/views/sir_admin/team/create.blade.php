@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
         <div class="col-md-12">
            <div class="box">
                <div class="box-header"> Team Add/Update </div>
                <div class="box-body">
                    @if(count($errors)>0)
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif

                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('id'){{ url('/team') }}/@yield('id')@else {{ url('/team') }} @endif" method="POST">
                        @section('editMethod')
                        @show

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="@yield('name')" name="name"  placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Short Note</label>
                            <textarea class="form-control" id="short_note" name="short_note">@yield('short_note')</textarea>

                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    </form>

                </div>
            </div>
        </div>

@endsection
