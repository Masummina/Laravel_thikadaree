@extends('layouts.app')

@section('content')
<div class="bidder-dashboard">
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="container">
                <div class="topnav" id="myTopnav">
                  <a href="#home">Dashboard</a>
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
        <img style="width: 100%;" src="{{ asset('images/banner/banner1.jpg') }} " alt="">
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
                    <img style="width: 100%;" src="{{ asset('images/news/avator2.png') }} " alt="">
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
                            {!! @$userPro->mobile !!}
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
                        <p class="mobile"><b>Address: </b> <span>{!! @$userPro->address !!}</span></p>
                      
                        <p class="short-dis"><b>Details: </b>
                            {!! @$userPro->details!! }
                        </p>
                    </div>
                    
                </div>
            </div>
            </div>
            <div class="profile">
                <div class="row">
                    <h3>Portfolio Items</h3>
                    <div class="col-md-2 col-xs-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img class="img-responsive" src="images/news/news1.jpg" alt="img">
                                    
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html">We Just Completes $17.6 million Medical Clinic in Mid-Missouri</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> July 20, 2017
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 1st post col end -->

                    <div class="col-md-2 col-xs-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img class="img-responsive" src="images/news/news2.jpg" alt="img">
                                    
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> June 17, 2017
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 2nd post col end -->
                    <div class="col-md-2 col-xs-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img class="img-responsive" src="images/news/news1.jpg" alt="img">
                                    
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html">We Just Completes $17.6 million Medical Clinic in Mid-Missouri</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> July 20, 2017
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 1st post col end -->

                    <div class="col-md-2 col-xs-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img class="img-responsive" src="images/news/news2.jpg" alt="img">
                                    
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> June 17, 2017
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 2nd post col end -->
                    <div class="col-md-2 col-xs-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img class="img-responsive" src="images/news/news2.jpg" alt="img">
                                    
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> June 17, 2017
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 2nd post col end -->
                    <div class="col-md-2 col-xs-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img class="img-responsive" src="images/news/news1.jpg" alt="img">
                                    
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html">We Just Completes $17.6 million Medical Clinic in Mid-Missouri</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> July 20, 2017
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 1st post col end -->
                </div>
            </div>

        </div>    
    </div>
</div>

@endsection
