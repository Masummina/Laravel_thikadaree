
@if(Session::has('success'))<div class="text-center alert alert-success">{{Session::get('success')}}</div> @endif
 
@if(Session::has('message'))<div class="text-center alert alert-success">{{Session::get('message')}}</div> @endif


@if(Session::has('error'))<div class="text-center alert alert-danger">{{Session::get('error')}}</div> @endif