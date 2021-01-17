@extends('layouts.app')

@section('content')
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
            <div class="how-work">
            <div class="row">
            	<h4 class="text-center help">How can we help?</h4>
            	<div class="col-md-6 col-sm-6 first left">
            		<h4>What kind of work can I get done?</h4>
            		<p>How does "anything you want" sound? We have experts representing every technical, professional, and creative field.</p>
            		<a href="{{url('post-a-project')}}" class="btn btn-success">Post a Project</a>
            	</div>
            	<div class="col-md-6 col-sm-6 right">
            		<img style="width: 100%;" src="{{ asset('images/howWork/howwork.jpg') }} " alt="">
            	</div>
            </div>
            </div>

        </div>    
    </div>
    <hr>
    <div class="container">
    	<div class="help_second">
	    		<p><b>Just give us the details about the work you need completed, and our freelancers will get it done faster, better, and cheaper than you could possibly imagine. This includes:
			</b></p>
    	</div>

    	<div class="job_type">
    		<div class="row">
    			<div class="col-md-4 text-center">
    				<img style="width: 100%;" src="{{ asset('images/howWork/jobstype.png') }} " alt="">
    				<p>Small jobs, large jobs, anything in between</p>
    			</div>
    			<div class="col-md-4 text-center">
    				<img style="width: 100%;" src="{{ asset('images/howWork/howwork.jpg') }} " alt="">
    				<p>Small jobs, large jobs, anything in between</p>
    			</div>
    			<div class="col-md-4 text-center">
    				<img style="width: 100%;" src="{{ asset('images/howWork/howwork.jpg') }} " alt="">
    				<p>Small jobs, large jobs, anything in between</p>
    			</div>
    		</div>
    	</div>
    	
    </div>
    <div class="third_section">
    	<div class="container">
    		<div class="row">
    			<div class="col-md-6 left">
    				<h4>Be in Control. Keep in Contact.</h4>
    				<p>Use our Desktop App to track progress, monitor hours, communicate, share, and do much more. Always know what's going on with your project, what is getting done, and what still needs doing.<br>Use our mobile app for easy on-the-go messaging. Stay in touch with your freelancer or client whenever you have questions, updates, or have something to share.<br>Use our mobile app for easy on-the-go messaging. Stay in touch with your freelancer or client whenever you have questions, updates, or have something to share.</p>
    			</div>	
    			<div class="col-md-6 right">
    				<img style="width: 100%;" src="{{ asset('images/howWork/howwork.jpg') }} " alt="">
    			</div>	
    		</div>
    	</div>
    </div>
</div>

@endsection
