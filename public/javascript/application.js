$(document).ready(function(){

		$('#confirm_password').on('keyup', function () {
		    if ($('#password').val() == $('#confirm_password').val()) {
		    	document.getElementById('confirm_password').style.borderColor="";
		    } else 
		        document.getElementById('confirm_password').style.borderColor="red";
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
		
	       
	        
//	        function validate(){  
//	        	   var emailReg = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
//	        	   if(!emailReg.test(email)) {  
//	        	        alert("Please enter valid email id");
//	        	   } 
//	        	   var mob = /^\d{10}$/;
//	        	   if(!mob.test(mobile)){
//	        		   alert("mobile no must have 10 digit");
//	        	   }
//	        	}
	        
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

		
	        var options = [];

	        $( '.dropdown-menu a' ).on( 'click', function( event ) {

	           var $target = $( event.currentTarget ),
	               val = $target.attr( 'data-value' ),
	               $inp = $target.find( 'input' ),
	               idx;

	           if ( ( idx = options.indexOf( val ) ) > -1 ) {
	              options.splice( idx, 1 );
	              setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
	           } else {
	              options.push( val );
	              setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
	           }

	           $( event.target ).blur();
	         
	          document.getElementById("sub").value= options;
	        //  $('#sub').val = options;
	        //  console.log(document.getElementById("sub").value );
	           return false;
	        });
	        
	       
	       
      /***          $(".ratingRadio").click(function () {
                	           
                	var id=document.getElementById("id").value;
                	//console.log(id);
                    $.post('../controller/rating.php',{rate:$(this).val(),id:id},function(d){
                    
                    
                        if(d>0)
                        {
                            console.log("hii");
                        }else{
                            alert('Thanks For Rating');
                        }
                    });
                    $(this).attr("checked");
                }); ***/
           
	   
	        
	        $("#send").click(function () {
	        	var msg=$("#comments").val();
	        	var id=$("#eid").val();
               $.ajax({
            	   type:"POST",
            	   url:"../controller/sendmail.php",
            	   data:'message='+msg+'&id='+id,
            	   dataType:'json',
            	   success: function(data){
            		  
            		   $('#contactModal').modal('toggle');
            		  
            	   }
            	   
               });
               
            });
	        
	        
	       
	        
	}); 


function getdistrict(val){
	$.ajax({
		type: "GET",
		url: "../controller/select_district.php",
		data: 'state_id=' +val,
		dataType: 'json',
		success: function(data){
			var select = $('#district-list'); 
			var options= '';
			select.empty();
		
			for(var i=0; i<data.length; i++){
			
				options+="<option value='"+data[i].id+"'>"+data[i].name+"</option>"
			}
			select.append(options);
		}

	});
};


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
};


function checkEmpty() {
	var valueofId=document.getElementById("search-text").value;
	if((valueofId.match(/\s/g)) || (!valueofId)){
	        alert("Please insert valid input");
	        return false;
	    }
	};

	
	function validateRadio() {
		var type = document.getElementsByName("select");
        if (type[0].checked == false && type[1].checked == false) {
        	alert("You must select your teacher/student");
        	$('#teacher').html('').css('color', 'green');
        	$('#student').html('').css('color', 'green');
        	return false; 
        }
        else{
        	return true;
        }
    
		};

 