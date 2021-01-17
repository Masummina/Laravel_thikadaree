<!DOCTYPE html>
<html lang=en>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title> OMECA </title>

    <script src="{{ asset('public/front/js/jquery-1.12.4.min.js') }}" ></script>

    <style>
        #map_wrapper { height: 400px; }
        #map_canvas { width: 100%; height: 100%; }
        .imgBorder { padding: 1px; border: 1px solid #8f0612 }
        .dropdown-menu li a:hover { color: white !important }
        .gallery_area a { height: auto !important;}
    </style>

    <link href="{{ asset('public/front/css/optcss2b90.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('public/front/css/flexslider.css') }}" type="text/css" media="screen" />
    <link href="{{ asset('public/front/css/Other/GoogleMap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/front/css/Other/modifiedGallery.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/front/css/Other/paralaxBackground.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/front/css/Other/TopHeader.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/front/css/Other/ButtonStyle.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/front/css/Other/index_tabStyles.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/front/css/Other/newsEventStyle.css') }}" rel="stylesheet">
    <link href="{{ asset('public/front/css/icon.css') }}" rel="stylesheet">

    <style>
        @media screen and (max-width: 699px) and (min-width: 220px) {
            .mobile-menu { display: block !important; width: 65%; float: right; text-align: right; }
            .mobile-menu ul li { background: #eeeeee; }
            .logo_img { width: 30%; }
        }
    </style>
</head>

<body>

  <header id="header">
    <div class="menu_area">
        <nav class="navbar navbar-default navbar-fixed-top navbar-static" style="border-bottom:#bf1430 7px solid;border-top:#333333 3px solid; height: 80px;">
            <div class="container">
                <div class="clearfix">
                    <div class="logo_img">
                        <a href="{{url('/')}}"><img src="{{ asset('public/images/logo.jpg') }}" style="height:93px; weight:90px; display:inline-block;" alt="logo"/></a>
                    </div>

                    @include('layouts.menu');

                </div>
            </div>
        </nav>
    </div>
  </header>

<div>
    <div ng-app=indeApp>

       @yield('content')

    </div>
</div>



  <footer id=footer>
      <div class=footer_top>
          <div class=container>
              <div class=row>

                  @include('layouts.footer-menu');

              </div>
          </div>
      </div>
      <div class="footer_bottom">
          <div class=container>
              <div class=row>

                  <div class="col-md-4">
                      <img src="http://www.reliablecounter.com/count.php?page=omecabd.com9753019&digit=style/plain/5/&reloads=1" alt="" title="" border="0">
                  </div>
                  <div class="col-md-8">
                      <p style="text-align: right;">Design & Development by <a target="_blank" href="www.echosystech.com">Echo System &amp; Technologies</a></p>
                      <p style="text-align: right;">
                        @php
                            $Last_updated_setting = DB::table('settings')->select('*')->whereRaw("`sett_key`='Last_updated'")->get();
                            if(isset($Last_updated_setting[0]->sett_value))
                            {
                                echo $Last_updated_text = $Last_updated_setting[0]->sett_value;
                            }
                        @endphp
                      </p>
                  </div>
              </div>
          </div>
      </div>

  </footer>

<script src="{{ asset('public/front/js/dept.js') }}"></script>
<script src="{{ asset('public/front/js/SmoothScroll.min.js') }}"></script>
<script src="{{ asset('public/front/js/jquery.circliful.min.js') }}"></script>
<script src="{{ asset('public/front/js/MapScript.min.js') }}"></script>
<script src="{{ asset('public/front/js/jquery.flexslider.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
                $('body').removeClass('loading');
            }
        });
    });
</script>

</body>
</html>
