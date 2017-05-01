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
	           if(select){
		           select.appendChild(opt);
	           }
	        }
		
	        function Checkfiles() {
				var fup = document.getElementById('filename');
				var fileName = fup.value;
				var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
				if (ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg"
						|| ext == "jpg" || ext == "JPG") {
					return true;
				} else {
					alert("Upload Gif or Jpg images only");
					fup.focus();
					return false;
				}
			}
	        
	        function validate(){  
	        	   var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	        	   if(!emailReg.test(email)) {  
	        	        alert("Please enter valid email id");
	        	   } 
	        	   var mob = /^\d{10}$/;
	        	   if(!mob.test(mobile)){
	        		   alert("mobile no must have 10 digit");
	        	   }
	        	}
	        
	     //  function ConfirmPassword() {
		    //    var pass1 = document.getElementById("pass1").value;
		    //    var pass2 = document.getElementById("pass2").value;
		    //    if (pass1 && pass2 && pass1 != pass2) {
		     //       alert("Confirm password must be same");
		      //      document.getElementById("pass1").style.borderColor = "#E34234";
		     //       document.getElementById("pass2").style.borderColor = "#E34234";
				//	return false;
		       // }
		        
		    //} 

		
	});
