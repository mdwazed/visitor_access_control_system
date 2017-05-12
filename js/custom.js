$(document).ready(function(){

		$("select#user_type").change(function(){

		var id = $("select#user_type option:selected").attr('value');
				
		$.post("libraries/select_type.php", {id:id}, function(data){
			$("select#rank").removeAttr("disabled");
			$("select#rank").html(data);

		});
	});
	
});		
		

/*function openPdf()
{
var omyFrame = document.getElementById("myFrame");
omyFrame.style.display="block";
omyFrame.src = "FULLTEXT01.pdf";
}*/



function disableFieldsForSentry() {  
	  
   if (document.registration_form.user_type.value == 3) {

      document.registration_form.appointment.value="";
      document.registration_form.appointment.disabled=true;

 	  document.registration_form.directorate.value="";	  
      document.registration_form.directorate.disabled=true;	  

   }
   else{

      document.registration_form.appointment.disabled=false;
      document.registration_form.directorate.disabled=false;	  
   
   } 

} 



function validateForm_ChangePassword() {

	if (document.getElementById('txtUserName').value=="") {
		alert("Please enter the username.");
		document.getElementById('txtUserName').focus();
		return false;
	}

	if (document.getElementById('txtOldPassword').value=="") {
		alert("Please enter the old password.");
		document.getElementById('txtOldPassword').focus();
		return false;
	}

	if (document.getElementById('txtNewPassword1').value=="") {
		alert("Please enter the new password.");
		document.getElementById('txtNewPassword1').focus();
		return false;
	}

	if (document.getElementById('txtNewPassword2').value=="") {
		alert("Please confirm the new password.");
		document.getElementById('txtNewPassword2').focus();
		return false;
	}

    if (document.getElementById('txtNewPassword1').value != document.getElementById('txtNewPassword2').value)
    {
        alert('New Passwords don\'t match!');
        return false;
    } 

}
