
@extends('layouts.app')

@section('content')


   <section id="main-container" class="main-container">
		<div class="container">
			<h4>Your conversation</h4>
			<div class="messate">
				<div class="message-field">
					<div class="row">
						<div class="pull-left">
							<b>Me</b>
							 @foreach($messageForm as $val)
							 <p style="background: blue; padding: 6px; border-radius: 5px; color: #fff">{!! $val->messageall !!}</p>
							 @endforeach
						</div>
					</div>
					<div class="row">
						<div class="pull-right">
							{!! $projectUserid->name !!}
							@foreach($messageTo as $vahl)
								<p style="background: red; padding: 6px; border-radius: 5px; color: #fff">{!! $vahl->messageall !!}</p>
							 @endforeach
						</div>
					</div>
					
				</div>
				<div class="message-write">
					<form action="" method="POST">
                   	@csrf
						  <textarea class="form-control rounded-0" name="messagewrite" id="messagewrite" rows="2"></textarea>
						  <input type="submit" name="sentmessage" value="Sent">

					</form>
				</div>
			</div>
		</div><!-- Container end -->
	</section><!-- Main container end -->
	
	
@endsection





