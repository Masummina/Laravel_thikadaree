@extends('layouts.app')

@section('content')
<div class="bidder-dashboard">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="container">
                <div class="topnav" id="myTopnav">
                  <a href="{{url('dashboard')}}">Dashboard</a>
                  <a href="#news">Inbox</a>
                  <a href="#contact">Feedback</a>
                  <a href="#about">Free Credit</a>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="profile-bg">
    <div class="image">
        <img style="width: 100%;" src="{{ asset('images/banner/banner1.jpg') }}" alt="">
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="user-profile" style="padding: 20px 0">
    <div class="container">
        <div class="pro-left col-md-12 col-sm-8">
            <div class="details">
            <div class="row">
                <div class="col-md-4 col-sm-3">
                    <img style="width: 100%;" src="{{ url(@$userprofile->mobile) }} " alt="">
                </div>
                <div class="col-md-8 col-sm-9">
                    <div class="row">
                        <div class="pull-left">
                            <h4> {{ Auth::user()->name }}</h4>
                           <!--  Welcome {{ Auth::user()->id }} -->
                            
                        </div>
                        <div class="pull-right">
                           <a href="{{ url('editprofile') }}" class="btn btn-success">Edit Profile</a>
                        </div>
                    </div>
                    <div class="content">
                        <p class="gmail"> <b><i class="fa fa-envelope" aria-hidden="true"></i>  {{ Auth::user()->email }}</b> </p>
                        <p class="mobile"><b>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            {!!  @$userprofile->mobile !!}
                    </b>
                    </p>
                        <p class="mobile"><b>Jobs Completed: </b> <span> 20</span></p>
                        <p class="mobile"><b>Jobs Pending: </b> <span> 0</span></p>
                          <p class="review">
                            <b>Review:</b> 
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        </p>
                        <p class="mobile"><b>Address: </b> <span>{!! @$userprofile->address !!}</span></p>
                      
                        <p class="short-dis"><b>Details: </b>
                            {!! @$userprofile->details !!}
                        </p>
                    </div>
                    
                </div>
            </div>
            </div>

        </div>    
    </div>
</div>

@endsection
