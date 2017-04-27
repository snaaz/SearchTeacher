$(document).ready(function(){

		$('#confirm_password').on('keyup', function () {
		    if ($('#password').val() == $('#confirm_password').val()) {
		    	 $('#message').html('perfect').css('color', 'green');
		    } else 
		        $('#message').html('confirm password must be same').css('color', 'red');
		});
			
		var divHeight = $('.col-sm-8').height(); 
	    $('.col-sm-2').css('min-height', divHeight+'px');
	    
	    
	    var max = new Date().getFullYear(),
	    min = max - 47,

	        select = document.getElementById('year-of-passing');

	        for (var i = min; i<=max; i++){
	           var opt = document.createElement('option');
	           opt.value = i;
	           opt.innerHTML = i;
	           select.appendChild(opt);
	        }
		
	        
	        

		
	});
