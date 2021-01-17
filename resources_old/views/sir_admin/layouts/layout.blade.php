<!DOCTYPE html>
<html>
<head>    

    @include('admin.layouts.includes.header-style')
    @yield('extra_style')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
     <!-- jQuery 2.2.3 -->
    <script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <style>
        #fixednavbar {
            overflow: hidden;
            background-color: #ecf0f5;
            z-index: 1;
        }

 

        /* Page content */
        .content {
            padding: 16px;
        }

        /* The sticky class is added to the navbar with JS when it reaches its scroll position */
        .sticky {
            position: fixed;
            top: 0;
            width: 83%;
            padding-bottom: 20px;
            border-bottom: 4px solid #d2d6de;
        }

        /* Add some top padding to the page content to prevent sudden quick movement (as the navigation bar gets a new position at the top of the page (position:fixed and top:0) */
        .sticky + .content {
            padding-top: 60px;
        }
    </style>
    
</head>
<body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">
        @include('admin.layouts.includes.header')
        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.layouts.includes.left-menu')
         
        @yield('content')
    
    </div>
    <!-- ./wrapper -->
    
    @include('admin.layouts.includes.footer-script')  

    @yield('extra_script');  
<script type="text/javascript">

  function move_ps(d)
  {
      var pid = $(d).attr('pid');
      var uid = $(d).attr('uid');
      jQuery('#pid').val(pid);
      jQuery('#u_id').val(uid);

  }
  jQuery(document).ready(function($) {
     //console.log('fff');
    var price =0;
  $('#team').on('change', function(){
     
        var team_id = $(this).val();
        var u_id = parseInt($('#u_id').val());
        if(u_id>0) var ex_url='&e_u_id='+u_id; else ex_url='';

        if(team_id) {

            $.ajax({
                url: '{!! url('/teams-by-id') !!}?team_id='+team_id+ex_url,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    //$('#loader').css("visibility", "visible");
                    $('select[name="team_member"]').html('<option value=""> Loading... </option>');
                },

                success:function(data) {

                    $('select[name="team_member"]').empty();

                    $('select[name="team_member"]').append('<option value=""> Select Team Memember </option>');
                    $.each(data, function(key, value){
                         $('select[name="team_member"]').append('<option value="'+ key +'">' + value + '</option>');
                         $('select[name="team_member"]').prop('disabled', false);
                    });
                },
                complete: function(){
                    //$('#loader').css("visibility", "hidden");
                }
            });

            
        } else {
            $('select[name="team_member"]').empty();
        }

    });

    $('#project').on('change', function(){
     
        var project_id = $(this).val();
        if(project_id) {

            $.ajax({
                url: '{!! url('/projects/get') !!}/'+project_id,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    //$('#loader').css("visibility", "visible");
                    $('select[name="property_id"]').html('<option value=""> Loading... </option>');
                },

                success:function(data) {

                    $('select[name="property_id"]').empty();

                    $('select[name="property_id"]').append('<option value=""> Select Property </option>');
                    $.each(data, function(key, value){
                         $('select[name="property_id"]').append('<option value="'+ key +'">' + value + '</option>');
                         $('select[name="property_id"]').prop('disabled', false);
                    });
                },
                complete: function(){
                    //$('#loader').css("visibility", "hidden");
                }
            });

            $.ajax({
                url: '{!! url('/projects/GetParking') !!}/'+project_id,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $("#parking_div").html("Loading...");
                },
                success:function(data) {
                    $("#parking_div").html(data);
                },
                complete: function(){
                    //$('#loader').css("visibility", "hidden");
                }
            });
			
			 
            $.ajax({
                url: '{!! url('/projects/GetProjectHandoverDate') !!}/' + project_id,
                type: "GET",
                //dataType:"json",
                beforeSend: function () {
                    //$('#loader').css("visibility", "visible");
                    //$('#purchase_price').val('Loading...');
                },
                success: function (data) {
                    var strArray = data.split(",");
                    //$('#periods').val(strArray[0]);
                    $('#handover_date').val(strArray[1]);

                },
                complete: function () {
                    //$('#loader').css("visibility", "hidden");
                }
            });
			 


        } else {
            $('select[name="property_id"]').empty();
        }

    });



      $('#property_id').on('change', function(){

          var discount_amount = $('#discount_amount').val();
          var property_id = $(this).val();

          if(property_id.length>0)
          {
              $.ajax({
                  url: '{!! url('/projects/GetPropertyPrice') !!}/'+property_id+'?discount='+discount_amount,
                  type:"GET",
                  //dataType:"json",
                  beforeSend: function(){
                      //$('#loader').css("visibility", "visible");
                      //$('#purchase_price').val('Loading...');
                  },
                  success:function(data) {
                    var arr = JSON.parse(data);
                      var price = arr.price;
                      var discounted_price = arr.discounted_price;
                      var earnest_money = arr.earnest_money;
                      var down_payment = arr.down_payment;
                      var balance_down_payment = arr.balance_down_payment;

                      $('#earnest_money').val(Number(earnest_money));                      
                      $('#down_payment').val(Number(down_payment));              
                      $('#flat_price').val(Number(price)); 

                      if(balance_down_payment==0)
                      {
                        $("#balance_down_payment_tr").hide();
                        $("#div_Balance_Down").hide();
                      } else {
                        $("#balance_down_payment_tr").show();
                        $("#div_Balance_Down").show();
                        $('#balance_down_payment').val(Number(balance_down_payment));
                      }

                      PurchasePrice();
                      $('#property_price').val(Number(price));
                  },
                  complete: function(){
                      //$('#loader').css("visibility", "hidden");
                  }
              });

              {{--$.ajax({--}}
                  {{--url: '{!! url('/projects/GetEarnestMoney') !!}/'+property_id,--}}
                  {{--type:"GET",--}}
                  {{--//dataType:"json",--}}
                  {{--beforeSend: function(){--}}
                      {{--//$('#loader').css("visibility", "visible");--}}
                      {{--//$('#purchase_price').val('Loading...');--}}
                  {{--},--}}
                  {{--success:function(data) {--}}
                      {{--$('#earnest_money').val(data);--}}
                  {{--},--}}
                  {{--complete: function(){--}}
                      {{--//$('#loader').css("visibility", "hidden");--}}
                  {{--}--}}
              {{--});--}}
              {{--$.ajax({--}}
                  {{--url: '{!! url('/projects/GetDownPayment') !!}/'+property_id,--}}
                  {{--type:"GET",--}}
                  {{--//dataType:"json",--}}
                  {{--beforeSend: function(){--}}
                      {{--//$('#loader').css("visibility", "visible");--}}
                      {{--//$('#purchase_price').val('Loading...');--}}
                  {{--},--}}
                  {{--success:function(data) {--}}
                      {{--$('#down_payment').val(data);--}}
                  {{--},--}}
                  {{--complete: function(){--}}
                      {{--//$('#loader').css("visibility", "hidden");--}}
                  {{--}--}}
              {{--});--}}

          } else {
              $('#flat_price').val(0);
              PurchasePrice();
              //$('#earnest_money').val(0);
              //$('#down_payment').val(0);
          }
      });

      $('#parking_id').on('change', function(){
          var property_id = $(this).val();
          if(property_id)
          {
              $.ajax({
                  url: '{!! url('/projects/GetPropertyPrice') !!}/'+property_id,
                  type:"GET",
                  //dataType:"json",
                  beforeSend: function(){
                      //$('#loader').css("visibility", "visible");
                      //$('#purchase_price').val('Loading...');
                  },
                  success:function(data) {
                      $('#flat_price').val(Number(data));
                      PurchasePrice();
                  },
                  complete: function(){
                      //$('#loader').css("visibility", "hidden");
                  }
              });
          }
      });


      $('#earnest_money').on('keyup', function(){
          var purchase_price = Number($('#purchase_price').val());
          var earnest_money = Number($('#earnest_money').val());
          var down_payment = Number($('#down_payment').val());
          var balance_down_payment = Number($('#balance_down_payment').val());
          var loan_amount = purchase_price - (earnest_money + down_payment+balance_down_payment);
          $('#loan_amount').val(loan_amount);
      });

      $('#down_payment').on('keyup', function(){
            var purchase_price = Number($('#purchase_price').val());
            var earnest_money = Number($('#earnest_money').val());
            var down_payment = Number($('#down_payment').val());
            var balance_down_payment = Number($('#balance_down_payment').val());
            var loan_amount = purchase_price - (earnest_money + down_payment+balance_down_payment);
            $('#loan_amount').val(loan_amount);
      });

      $('#balance_down_payment').on('keyup', function(){
            var purchase_price = Number($('#purchase_price').val());
            var earnest_money = Number($('#earnest_money').val());
            var down_payment = Number($('#down_payment').val());
            var balance_down_payment = Number($('#balance_down_payment').val());
            var loan_amount = purchase_price - (earnest_money + down_payment+balance_down_payment);
            $('#loan_amount').val(loan_amount);
      });

      $('#periods').on('keyup', function(){
          var loan_amount = $('#loan_amount').val();
          var periods = $('#periods').val();
          var monthly_payment = Number(loan_amount) / Number(periods);
          $('#monthly_payment').val(monthly_payment);
      });

    
      $('#project_dropdown').on('change', function(){

          var project_type = $(this).val();
          if(project_type=='Apartment') {
              jQuery('#property').css('display','block');
        }else{
          jQuery('#property').css('display','none');
        }
      });

      $('#propertytype').on('change', function(){

          var project_type = $(this).val();
          if(project_type=='Parking') {
              jQuery('#parking_type').css('display','block');
              jQuery('.apperment_type').css('display','none');
              jQuery('#Apt_details').css('display','none');
        }else{
          jQuery('#parking_type').css('display','none');
          jQuery('.apperment_type').css('display','block');
          jQuery('#Apt_details').css('display','block');
        }
      });


      $(".checkbox").change(function() {
          var chk_id = this.id;
          var chk_val = this.value;
 

          PurchasePrice();
      })



  });


  function SetDiscount(discount_amount)
  {
    var flat_price = $('#flat_price').val();
    var parking_price = $('#flat_price').val();

    var parking_price = 0;
    $(".checkbox").each(function(){
       if(this.checked) {
          var current_parking_price = this.title;
          parking_price = Number(parking_price) + Number(current_parking_price);
       }
    });
 
    PurchasePrice();
  }

  //var currentId = $('#element').attr('id');
  function CalParking(kk)
  {
      PurchasePrice();
  }
  //Parking Price
  $('#parking_div').on('change', function(){
      var property_id = $(this).val();
      var parking_price = 0;
      $(".checkbox").each(function(){
          if(this.checked) {
              var current_parking_price = this.title;
              parking_price = Number(parking_price) + Number(current_parking_price);
          }
      });
      $('#parking_price').val(parking_price);
  });

  function PurchasePrice()
  {
      var periods = $('#periods').val();
      var discount_amount = $('#discount_amount').val();
      var flat_price = $('#flat_price').val();
      var balance_down_payment = Number($('#balance_down_payment').val());
      var parking_price = 0;
      $(".checkbox").each(function(){
          if(this.checked) {
              var current_parking_price = this.title;
              parking_price = Number(parking_price) + Number(current_parking_price);
              //$('#parking_price').val(parking_price);
          }
      });

        var property_id = $('#property_id').val();
        if(property_id)
        {
            $.ajax({
                url: '{!! url('/projects/GetPropertyPrice') !!}/'+property_id+'?discount='+discount_amount+'&parking='+parking_price,
                type:"GET",                
                success:function(data) {
                    var arr = JSON.parse(data);
                    var price = arr.price;
                    var discounted_price = arr.discounted_price;
                    var earnest_money = arr.earnest_money;
                    var down_payment = arr.down_payment;
                    var balance_down_payment = arr.balance_down_payment;

                    $('#earnest_money').val(Number(earnest_money));
                    
                    $('#down_payment').val(Number(down_payment));
                    $('#balance_down_payment').val(Number(balance_down_payment));
                    
                    $('#purchase_price').val(Number(discounted_price));

                    $('#flat_price').val(Number(price));
                
                    //$('#property_price').val(Number(price));
                    
                    var loan_amount = Number(discounted_price-earnest_money-down_payment-balance_down_payment);
                    $('#loan_amount').val(loan_amount);
                    var monthly_payment = loan_amount/periods;
                    $('#monthly_payment').val(Number(monthly_payment));
                },            
            });
        }
      
  }

    document.getElementById('discount_amount').addEventListener('keydown', function(e) {
        var key   = e.keyCode ? e.keyCode : e.which;

        if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
                (key == 65 && ( e.ctrlKey || e.metaKey  ) ) ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
                (key >= 96 && key <= 105)
            )) e.preventDefault();
    });


  document.getElementById('purchase_price').addEventListener('keydown', function(e) {
      var key   = e.keyCode ? e.keyCode : e.which;

      if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
              (key == 65 && ( e.ctrlKey || e.metaKey  ) ) ||
              (key >= 35 && key <= 40) ||
              (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
              (key >= 96 && key <= 105)
          )) e.preventDefault();
  });

  document.getElementById('down_payment').addEventListener('keydown', function(e) {
      var key   = e.keyCode ? e.keyCode : e.which;

      if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
              (key == 65 && ( e.ctrlKey || e.metaKey  ) ) ||
              (key >= 35 && key <= 40) ||
              (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
              (key >= 96 && key <= 105)
          )) e.preventDefault();
  });

  document.getElementById('periods').addEventListener('keydown', function(e) {
      var key   = e.keyCode ? e.keyCode : e.which;

      if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
              (key == 65 && ( e.ctrlKey || e.metaKey  ) ) ||
              (key >= 35 && key <= 40) ||
              (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
              (key >= 96 && key <= 105)
          )) e.preventDefault();
  });

  document.getElementById('monthly_payment').addEventListener('keydown', function(e) {
      var key   = e.keyCode ? e.keyCode : e.which;

      if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
              (key == 65 && ( e.ctrlKey || e.metaKey  ) ) ||
              (key >= 35 && key <= 40) ||
              (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
              (key >= 96 && key <= 105)
          )) e.preventDefault();
  });

  document.getElementById('delay_rate').addEventListener('keydown', function(e) {
      var key   = e.keyCode ? e.keyCode : e.which;

      if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
              (key == 65 && ( e.ctrlKey || e.metaKey  ) ) ||
              (key >= 35 && key <= 40) ||
              (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
              (key >= 96 && key <= 105)
          )) e.preventDefault();
  });

  document.getElementById('redate_rate').addEventListener('keydown', function(e) {
      var key   = e.keyCode ? e.keyCode : e.which;

      if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
              (key == 65 && ( e.ctrlKey || e.metaKey  ) ) ||
              (key >= 35 && key <= 40) ||
              (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
              (key >= 96 && key <= 105)
          )) e.preventDefault();
  });


</script>


  <script type="text/javascript">


    function PrintElem(elem)
    {
        PrintDiv($(elem).html());
    }

    function PrintDiv(data) 
    {
        var mywindow = window.open('', 'Urban design & development ltd.', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Urban design & development ltd.</title>');
        mywindow.document.write('</head><body >');        
        mywindow.document.write('<style> .box-title { margin-top: 20px; }  </style>');
        mywindow.document.write('<style> h1, h2, h3, h4, h5 { margin: 0px; padding: 0px; } .table {width:98%;} </style>');
        mywindow.document.write('<style> .table tr th,.table tr td{border:1px solid #000; border-width:1px 1px 0px 0px; color: #000; } .table{border-left:1px solid #000;}.table{border-bottom:1px solid #000; } #print_able .table tr th:last,#print_able .table tr td:last{display:none;} </style>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

      function exportTableToExcel(tableID, filename = '',report_header='')
      {
          var downloadLink;
          var dataType = 'application/vnd.ms-excel';
          var tableSelect = document.getElementById(tableID);
          var tableHTML = '';

          if(report_header!='')
          {
              tableHTML = $("#"+report_header).html();
          } else {
              tableHTML = '';
          }

          tableHTML = tableHTML + tableSelect.outerHTML.replace(/ /g, '%20');

          // Specify file name
          filename = filename?filename+'.xls':'excel_data.xls';

          // Create download link element
          downloadLink = document.createElement("a");

          document.body.appendChild(downloadLink);

          if(navigator.msSaveOrOpenBlob){
              var blob = new Blob(['\ufeff', tableHTML], {
                  type: dataType
              });
              navigator.msSaveOrOpenBlob( blob, filename);
          }else{
              // Create a link to the file
              downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

              // Setting the file name
              downloadLink.download = filename;

              //triggering the function
              downloadLink.click();
          }
      }

  </script>


    <script src="{{ asset('js/word/FileSaver.js') }}"></script>
    <script src="{{ asset('js/word/jquery.wordexport.js') }}"></script>

    <script type="text/javascript">
        function wordDownload(content_ID) {
            //$("table").css({"background-color": "yellow", "font-size": "200%"});
            $('table.table').attr('border', '1');
            $("#"+content_ID).wordExport();
        }
    </script>
    <script>
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("fixednavbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>



</body>
</html>
