<!DOCTYPE html>
<html>
<head>    

    @include('admin.layouts.includes.header-style')
    @yield('extra_style')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
     <!-- jQuery 2.2.3 -->
    <script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    
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
  jQuery(document).ready(function($){
    $('.sidebar-menu li a').each(function(index) {
         //$(this).parent().removeClass("active");
        /*if((this.pathname.trim() == window.location.pathname))
            $(this).parent().addClass("active");
    });*/
});
    function move_ps(d)
  {
    var pid = $(d).attr('pid');
    console.log(pid);
        jQuery('#pid').val(pid);
    
  }
  jQuery(document).ready(function($) {
     //console.log('fff');
    var price =0;
$('#team').on('change', function(){
     
        var team_id = $(this).val();
        if(team_id) {

            $.ajax({
                url: '{!! url('/team/get') !!}/'+team_id,
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


        } else {
            $('select[name="property_id"]').empty();
        }

    });

      $('#property_id').on('change', function(){
          var property_id = $(this).val();
          if(property_id.length>0)
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
          } else {
              $('#flat_price').val(0);
              PurchasePrice();
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

      $('#down_payment').on('keyup', function(){
          var purchase_price = $('#purchase_price').val();
          var down_payment = $('#down_payment').val();
          var loan_amount = Number(purchase_price) - Number(down_payment);
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
        }else{
          jQuery('#parking_type').css('display','none');
        }
      });
      $(".checkbox").change(function() {
          var chk_id = this.id;
          var chk_val = this.value;

          alert(chk_id);

          PurchasePrice();
      })



  });

  //var currentId = $('#element').attr('id');
  function CalParking(kk)
  {
      PurchasePrice();
  }

  function PurchasePrice()
  {
      var flat_price = $('#flat_price').val();
      var parking_price = 0;
      $(".checkbox").each(function(){
          if(this.checked) {
              var current_parking_price = this.title;
              parking_price = Number(parking_price) + Number(current_parking_price);
          }
      });

      var total_price = Number(flat_price)+Number(parking_price);
      $('#purchase_price').val(total_price);
  }


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
</body>
</html>
