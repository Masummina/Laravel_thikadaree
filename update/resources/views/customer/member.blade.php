@extends('layouts.app')

@section('content')
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
                    <img style="width: 80%;" src="{{url('images/upload/profile')}}/{!!  @$memberprofile->images !!}" alt="user image">
                    
                </div>
                <div class="col-md-8 col-sm-9">
                    <div class="row">
                        <div class="pull-left">
                            <h4 style="padding-left: 15px;"> {!!  @$memberprofile->name !!}</h4>
                        </div>
                        
                        @php 
	                        $userId = $memberprofile->id;
	                        $authId = Auth::user()->id;
                            if(isset($_GET['pid'])){ 
                                $proId = $_GET['pid'];
                                $prouid = $_GET['prouid'];
                        }
	                    @endphp   


	                    @if($userId==$authId)
	                       <div class="pull-right">
	                           <a href="{{ url('editprofile') }}" class="btn btn-success">Edit Profile</a>
	                       </div>
                           @else 
                           <div class="pull-right">
                            <a class="btn btn-success" href="{{url('message')}}/{{$userId}}?pid={{@$proId}}&prouid={{@$prouid}}">Message</a>
                        </div>
                           
				        @endif
                        
                        

                        

                     
                        
                    </div>
                    <div class="content">
                        <p class="gmail"> <b><i class="fa fa-envelope" aria-hidden="true"></i> {!!  @$memberprofile->email !!}</b> </p>
                        <p class="mobile"><b>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            {!!  @$memberprofile->mobile !!}
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
                        <p class="short-dis"><b>Skills: </b>
                            {!! @$memberprofile->skills !!}
                        </p>
                        <p class="short-dis"><b>District: </b>
                            {!! @$memberprofile->district !!}
                        </p>
                        <p class="mobile"><b>Address: </b> <span>{!! @$memberprofile->address !!}</span></p>
                      	
                        <p class="short-dis"><b>Details: </b>ff
                            {!! @$memberprofile->details !!}
                        </p>

                    </div>
                    
                </div>
            </div>
            </div>

        </div>    
    </div>
</div>

@endsection
