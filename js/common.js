function toggleSubmitButton(cb){

	if(cb.checked)	{
		document.getElementById("submitButton").disabled=false;					
	}
	else{
		document.getElementById("submitButton").disabled=true;				
	}

}



function validate() {
    var chk = document.getElementsByName('status[]')
    var len = chk.length

    for(i=0;i<len;i++){
	
         if(chk[i].checked){
	        return true;
         }
    }
 	alert("At least one record must be selected");	
    return false;
}    


$(function() {

		$( "#datepicker_past" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: 0 });		
		
		$( "#datepicker_past1" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: 0 });	
		$( "#datepicker_past2" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: 0 });			

		$( "#datepicker_past3" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: -30 });	
		$( "#datepicker_past4" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: -30 });			

		$( "#datepicker_future1" ).datepicker( { dateFormat: 'dd-mm-yy', minDate: 0 });		
		$( "#datepicker_future2" ).datepicker( { dateFormat: 'dd-mm-yy', minDate: 0 });		
		
	
	});




//$('#datepicker').datepicker({ dateFormat: 'dd-mm-yy' }).val();


function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
