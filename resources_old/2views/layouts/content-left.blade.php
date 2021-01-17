 

                <div class="col-sm-3 col-md-3">
                    <div class="panel-group wow fadeInLeft animated animated" id="accordion" style="text-align: center; visibility: visible; animation-name: fadeInLeft;">

                        <div class="panel panel-default">
                            @php if(isset($parent_info)) { @endphp
                            <div class="panel-heading" style="background:#3D4351;color:white">
                                <h4 class="panel-title"> <strong>  {!! $parent_info->title !!} </strong> </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse in">
                                <div class="list-group">
                                    @if(isset($content_list))
                                        @foreach($content_list as $row)
                                            @php $seo_url = str_replace(' ','-',$row['title']).'-'.$row['id']; @endphp
                                            <a href="{{url($url_name.'/'.$seo_url)}}" class="list-group-item"> {{ $row['title'] }} </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            @php } @endphp


                        </div>


                        <div class="panel panel-default">

                            <div class="panel-heading" style="background:#3D4351;color:white">
                                <h4 class="panel-title"> <strong>  যেভাবে পেয়েছি omeca-কে </strong> </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse in">
                                <div class="list-group">
                                    @if(isset($how_find))
                                        @foreach($how_find as $row)
                                            @php $seo_url = str_replace(' ','-',$row['title']).'-'.$row['id']; @endphp
                                            <a href="{{url('about-omeca/'.$seo_url)}}" class="list-group-item"> {{ $row['title'] }} </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <div class="panel-heading " style="background:#3D4351;color:white">
                                <h4 class="panel-title"> <a href="{{ url('student-registration') }}">Online registration </a> </h4>
                            </div>
                            <div class="panel-heading" style="background:#3D4351;color:white; margin-top: 5px;">
                                <h4 class="panel-title"> <a href="{{ url('student-login') }}">Login</a> </h4>
                            </div>
                        </div>

                    </div>
                </div>
 
