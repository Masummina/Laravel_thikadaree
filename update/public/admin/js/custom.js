var message = $('.message-area');
function getMessage(message, type) {   
    return '<div class="alert text-center alert-'+type+'" style="margin-top: -1px !important;">'+ message+'</div>';
}

/**
*  this method show validation errors
**/
function validation_errors( action, errors ) {
	$('#'+action+'Modal' ).find('.error-message').html('<div class="alert text-center alert-danger" style="margin-top: -1px !important;"><ul class="validation-message-list"></ul></div>');            
    $.each(errors, function(key, error) {                         
        $('.validation-message-list').append('<li>'+error+'</li>'); 
    });
    $('.validation-message-list').show();
    $('.error-message').fadeIn().delay(2000).fadeOut(2000);
}

/**
* common delete method
**/
function delete_items(path, id, current) {
  
	var token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
	type: "POST",
	url: '/'+path+'/'+id,
	data: '_method=DELETE&_token=' + token,
	    success: function (response) {
	        if(response.status == '200')
	        {
	            current.parent('td').parent('tr').remove();
	            message.html(getMessage('Successfully deleted', 'success')).fadeIn().delay(1200).fadeOut(1200);
	        }
	        else
	        {
	            message.html(getMessage('Not successfully deleted', 'danger')).fadeIn().delay(1200).fadeOut(1200);
	        }           
	    }
	});
}

$( document ).on('click', '.common-delete-btn', function() {
	if( confirm('Are you sure to delete this') == true ) {
		var id = $(this).attr('delete-attr-id');
		var path = window.location.href.split("/").pop();        
		if( id == null && path == null ) {
		  return false;
		}
		delete_items(path, id, $(this));		
	}
});

/**
* common save method
**/
$( document ).on('click', '.common-save-btn', function() {
    
	var input = {};
	$.each( $('form').serializeArray(), function(i, field) {
	  input[field.name] = field.value;
	}); 
	input['_token'] = $('meta[name="csrf-token"]').attr('content');
	var action = window.location.pathname.split("/").slice(-1)[0];
	$.ajax({
	  type: "POST",
	  url: action,
	  data: input,
	  success: function( response ) {
	        if( response.status == 200 && response.buyer != null ){
				$('.message-area').html('<div class="alert text-center alert-success" style="margin-top: -1px !important;">Successfully created </div>').fadeIn().delay(1200).fadeOut(1200);
				var buyer = response.buyer;
				var buyer_info = '<tr><td>'+buyer.cbuyer+'</td><td>'+buyer.buyer+'</td><td>'+buyer.buyer_country+'</td><<td><i buyer-id="'+buyer.id+'" class="fa fa-fw fa-edit buyer-edit-btn"></i> | <i buyer-del-id="'+buyer.id+'" class="fa fa-fw fa-trash-o buyer-delete-btn"></i></td></tr>';
				$('.buyer-list').prepend( buyer_info );
				$('#'+action+'Modal').modal('hide');
	        }else if( response.status == 403 ) {
	            validation_errors( action, response.errors );
	        }else{
	          $('.error-message').html('<div class="alert text-center alert-danger" style="margin-top: -1px !important;">Not successfully created</div>').fadeIn().delay(2000).fadeOut(2000);
	        }
	    }
	});
});

/**
* get order list when select buyer
**/
$( document ).on('change', '.cbuyer-colour', function() {
	
	var cbuyer = $(this).val();
	$.ajax({
	  type: "GET",
	  url: 'get-order-list',
	  data: { cbuyer:cbuyer },
	  success: function( response ) {
	        if( response.status == 200 && response.buyer != null ){
				
				var buyer = response.order;
				var buyer_info = '<tr><td>'+buyer.cbuyer+'</td><td>'+buyer.buyer+'</td><td>'+buyer.buyer_country+'</td><<td><i buyer-id="'+buyer.id+'" class="fa fa-fw fa-edit buyer-edit-btn"></i> | <i buyer-del-id="'+buyer.id+'" class="fa fa-fw fa-trash-o buyer-delete-btn"></i></td></tr>';
				$('.cbuyer-colour').append( buyer_info );				
	        }else if( response.status == 403 ) {
	            validation_errors( action, response.errors );
	        }else{
	          $('.error-message').html('<div class="alert text-center alert-danger" style="margin-top: -1px !important;">Not successfully created</div>').fadeIn().delay(2000).fadeOut(2000);
	        }
	    }
	});
});

/**
* get order list when select buyer  add-more-colour-btn  
**/
$( document ).on('click', '.add-more-colour-btn', function() {
    $('.coloured-fields').clone().appendTo('.clonedColourFiled');	
	
});

/**
* get order list when select buyer  add-more-colour-btn  $('.clonedInput').last().remove();
**/
$( document ).on('click', '.remove-colour-btn', function() {
    $('.clonedColourFiled').find('.coloured-fields:last').remove();	
	
});
$( document ).on('change', '#exampleSelect1', function() {
	
	var cbuyer = $(this).val();
	
	if(cbuyer=="Bank"){
console.log(cbuyer);
		$('.bank-hide').removeClass('hide');
	}else{
		$('.bank-hide').addClass('hide');
	}
});
$(function () {
  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    {
      value    : 700,
      color    : '#f56954',
      highlight: '#f56954',
      label    : 'Chrome'
    },
    {
      value    : 500,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'IE'
    },
    {
      value    : 400,
      color    : '#f39c12',
      highlight: '#f39c12',
      label    : 'FireFox'
    },
    {
      value    : 600,
      color    : '#00c0ef',
      highlight: '#00c0ef',
      label    : 'Safari'
    },
    {
      value    : 300,
      color    : '#3c8dbc',
      highlight: '#3c8dbc',
      label    : 'Opera'
    },
    {
      value    : 100,
      color    : '#d2d6de',
      highlight: '#d2d6de',
      label    : 'Navigator'
    }
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%> users'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------
  
});
