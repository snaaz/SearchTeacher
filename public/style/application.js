$(document).ready(function(){

		$('#confirm_password').on('keyup', function () {
		    if ($('#password').val() == $('#confirm_password').val()) {
		    	 $('#message').html('perfect').css('color', 'green');
		    } else 
		        $('#message').html('confirm password must be same').css('color', 'red');
		});
			
			var divHeight = $('.col-sm-8').height(); 
		    $('.col-sm-2').css('min-height', divHeight+'px');
		

		
	});