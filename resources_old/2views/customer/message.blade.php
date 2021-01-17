
@extends('layouts.app')

@section('content')



<section class="chat-section">
	<div class="container clearfix">
    <div class="people-list" id="people-list">
      <div class="search">
        <input type="text" placeholder="search" />
        <i class="fa fa-search"></i>
      </div>
      <ul class="list">
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Vincent Porter</div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_02.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Aiden Chavez</div>
            <div class="status">
              <i class="fa fa-circle offline"></i> left 7 mins ago
            </div>
          </div>
        </li>
      </ul>
    </div>
    
    <div class="chat">
      <div class="chat-header clearfix">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />
        
        <div class="chat-about">
          <div class="chat-with">   {!! $bider_info->name !!}   </div>
          <div class="chat-num-messages">already 1 902 messages</div>
        </div>
        <i class="fa fa-star"></i>
      </div> <!-- end chat-header -->
      
      <div class="chat-history">
        <ul>
          @if(isset($messages))
          @foreach($messages as $value)
            @php 
              
              //print_r($value);
              $from = $bider_info->id;
              

              if($value->message_from == $from)
              {
                $message_type = '';
                $message_div = "other-message float-right";
                $sender = $bider_info->name;
              } else {
                $message_type = 'align-right';
                $message_div = "my-message";
                $sender = Auth::user()->name;
              }

       
            @endphp

          <li class="clearfix">
            <div class="message-data {!! $message_type !!}">
              <span class="message-data-name">
                <i class="fa fa-circle online"></i> {!! $sender !!}
              </span>
              <span class="message-data-time">10:12 AM, Today</span>
            </div>
            <div class="message {!! $message_div !!}  ">
              {!! $value->message_content !!}
            </div>
          </li>
          

          <!--
          <li class="clearfix">
            <div class="message-data align-right">
              <span class="message-data-time" >10:14 AM, Today</span> &nbsp; &nbsp;
              <span class="message-data-name" >{!! $bider_info->name !!}</span> <i class="fa fa-circle me"></i>
              
            </div>
            <div class="message other-message float-right">
              Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so? Have you faced any problems at the last phase of the project?
            </div>
          </li> -->

          @endforeach
          @endif
          
        </ul>
        
      </div> <!-- end chat-history -->
      
      <div class="chat-message clearfix">
                          <form action="" method="POST">
                           @csrf
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <textarea class="form-control required-field" id="message" placeholder="Your Question" rows="6" required="" name="message"></textarea>
                                 </div>
                              </div><!-- Col 12 end -->

                           </div><!-- Form row end -->
                           <div class="clearfix">
                              <button class="btn btn-primary" name="submit" type="submit">Post Question</button> 
                           </div>
                        </form><!-- Form end -->
                
        <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
        <i class="fa fa-file-image-o"></i>
        
        <button>Send</button>

      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->
    
  </div> <!-- end container -->
</section>



	
	
	<!-- Main container end -->

<style>
.chat-history ul li {
    list-style: none;
}
section.chat-section .container {
	 margin: 0 auto;
	 width: 1024px;
	 background: #444753;
	 border-radius: 5px;
}
ul.list .about .name {
    color: #fff;
}
 .people-list {
	 width: 260px;
	 float: left;
}
 .people-list .search {
	 padding: 20px 0;
}
 .people-list input {
	border-radius: 3px;
    border: none;
    padding: 7px 14px;
    color: white;
    background: #d6d8de;
    width: 90%;
    font-size: 14px;
}
 .people-list .fa-search {
	 position: relative;
	 left: -25px;
}
 .people-list ul {
	padding: 5px;
    overflow-y: scroll;
    height: 700px;
}
 .people-list ul li {
	 padding-bottom: 20px;
}
 .people-list img {
	 float: left;
}
 .people-list .about {
	 float: left;
	 margin-top: 8px;
}
 .people-list .about {
	 padding-left: 8px;
}
 .people-list .status {
	 color: #92959e;
}
 .chat {
	width: calc(100% - 260px);
	 float: left;
	 background: #f2f5f8;
	 border-top-right-radius: 5px;
	 border-bottom-right-radius: 5px;
	 color: #434651;
}
 .chat .chat-header {
	 padding: 20px;
	 border-bottom: 2px solid white;
}
 .chat .chat-header img {
	 float: left;
}
 .chat .chat-header .chat-about {
	 float: left;
	 padding-left: 10px;
	 margin-top: 6px;
}
 .chat .chat-header .chat-with {
	 font-weight: bold;
	 font-size: 16px;
}
 .chat .chat-header .chat-num-messages {
	 color: #92959e;
}
 .chat .chat-header .fa-star {
	 float: right;
	 color: #d8dadf;
	 font-size: 20px;
	 margin-top: 12px;
}
 .chat .chat-history {
    padding: 30px 15px 20px;
    border-bottom: 2px solid white;
    overflow-y: scroll;
    height: 575px;
}
 .chat .chat-history .message-data {
	 margin-bottom: 15px;
}
 .chat .chat-history .message-data-time {
	 color: #a8aab1;
	 padding-left: 6px;
}
 .chat .chat-history .message {
	 color: white;
	 padding: 18px 20px;
	 line-height: 26px;
	 font-size: 16px;
	 border-radius: 7px;
	 margin-bottom: 30px;
	 width: 90%;
	 position: relative;
}
 .chat .chat-history .message:after {
	 bottom: 100%;
	 left: 7%;
	 border: solid transparent;
	 content: " ";
	 height: 0;
	 width: 0;
	 position: absolute;
	 pointer-events: none;
	 border-bottom-color: #86bb71;
	 border-width: 10px;
	 margin-left: -10px;
}
 .chat .chat-history .my-message {
	 background: #86bb71;
}
 .chat .chat-history .other-message {
	 background: #94c2ed;
}
 .chat .chat-history .other-message:after {
	 border-bottom-color: #94c2ed;
	 left: 93%;
}
 .chat .chat-message {
	 padding: 30px;
}
 .chat .chat-message textarea {
	 width: 100%;
	 border: none;
	 padding: 10px 20px;
	 font: 14px/22px "Lato", Arial, sans-serif;
	 margin-bottom: 10px;
	 border-radius: 5px;
	 resize: none;
	 border:1px solid #cabfbf;
}
 .chat .chat-message .fa-file-o, .chat .chat-message .fa-file-image-o {
	 font-size: 16px;
	 color: gray;
	 cursor: pointer;
}
 .chat .chat-message button {
	 float: right;
	 color: #94c2ed;
	 font-size: 16px;
	 text-transform: uppercase;
	 border: none;
	 cursor: pointer;
	 font-weight: bold;
	 background: #f2f5f8;
}
 .chat .chat-message button:hover {
	 color: #75b1e8;
}
 .online, .offline, .me {
	 margin-right: 3px;
	 font-size: 10px;
}
 .online {
	 color: #86bb71;
}
 .offline {
	 color: #e38968;
}
 .me {
	 color: #94c2ed;
}
 .align-left {
	 text-align: left;
}
 .align-right {
	 text-align: right;
}
 .float-right {
	 float: right;
}
 .clearfix:after {
	 visibility: hidden;
	 display: block;
	 font-size: 0;
	 content: " ";
	 clear: both;
	 height: 0;
}
 
</style>
	
	
@endsection





