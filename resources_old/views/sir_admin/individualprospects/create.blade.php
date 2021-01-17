@extends('admin.layouts.layout')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
         <div class="col-md-12">
            <div class="box">
                <div class="box-header"> Edit Individual Prospects  </div>
                <div class="box-body">
                    @if(count($errors)>0)
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif

                    <form onsubmit="return confirm('Are you sure you want to submit?')" action="@hasSection('id'){{ url('individual-prospects') }}/@yield('id')@else {{ url('/teindividual-prospects') }} @endif" method="POST">
                        @section('editMethod')
                        @show

                            <div class="form-group">
                                <label for="name">Report date</label>
                                <input type="date" class="form-control" value="@yield('report_date')" name="report_date"  placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="name">previous</label>
                                <input type="text" class="form-control" value="@yield('previous')" name="previous"  placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="name">New</label>
                                <input type="text" class="form-control" value="@yield('new')" name="new"  placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="name">esc</label>
                                <input type="text" class="form-control" value="@yield('esc')" name="esc"  placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="name">Close</label>
                                <input type="text" class="form-control" value="@yield('close')" name="close"  placeholder="Name">
                            </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

                    </form>

                </div>
            </div>
        </div>

@endsection
