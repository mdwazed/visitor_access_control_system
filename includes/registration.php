<?php
if(isset($_POST['submit'])){

    # connect to the database here
    # search the database to see if the user name has been taken or not
    $query = sprintf("SELECT * FROM tbl_user_info WHERE userName='%s' LIMIT 1",mysql_real_escape_string($_POST['user_name']));
	$sql = mysql_query($query);
    $row = mysql_fetch_array($sql);
    #check too see what fields have been left empty, and if the passwords match
    if($row||empty($_POST['user_name'])|| empty($_POST['first_name'])|| empty($_POST['password'])|| empty($_POST['re_password'])||$_POST['password']!=$_POST['re_password']){
        # if a field is empty, or the passwords don't match make a message
		$message = '';

        if($row){
            $message .= 'User Name already exists<br>';
        }
		else{
		
			if(empty($_POST['user_name'])){
				$message .= 'User Name can\'t be empty<br>';
			}
	
			if(empty($_POST['first_name'])){
				$message .= 'First Name can\'t be empty<br>';
			}

			if(empty($_POST['password'])){
				$message .= 'Password can\'t be empty<br>';
			}
			if(empty($_POST['re_password'])){
				$message .= 'You must re-type your password<br>';
			}
			if($_POST['password']!=$_POST['re_password']){
				$message .= 'Passwords don\'t match<br>';
			}
		}

		$message .= '</p>';

    }else{
        # If all fields are not empty, and the passwords match,
        # create a session, and session variables,
		
		if ( isset($_SESSION['_userType']) && ($_SESSION['_userType']) == 1) {
			$approval_status = 1;
		}
		else{
			$approval_status = 0;		
		}
		
		$query1 = sprintf("INSERT INTO tbl_user_info(userName, userPassword, userType, approvalStatus) VALUES ('%s','%s','%s','%s')", 
					mysql_real_escape_string($_POST['user_name']),
					mysql_real_escape_string($_POST['password']),
					mysql_real_escape_string($_POST['user_type']),
					mysql_real_escape_string($approval_status))or die(mysql_error());							

		
		$insertdate="";
		if (isset($_POST['joining_date']) ) {
			$insertdate = $db->changeFormatDate($_POST['joining_date']);
		}

		if (!isset($_POST['appointment'])) $_POST['appointment']="";
		if (!isset($_POST['directorate'])) $_POST['directorate']="";
		
		$query2 = sprintf("INSERT INTO tbl_registration(userName, firstName, lastName, rank, appointment, directorate, joiningDate, emailAddress, officePhone, cellPhone)
            VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s', '%s')",
			mysql_real_escape_string($_POST['user_name']),
		//	mysql_real_escape_string($_POST['title']),
			mysql_real_escape_string($_POST['first_name']),
			mysql_real_escape_string($_POST['last_name']),			
			mysql_real_escape_string($_POST['rank']),			
			mysql_real_escape_string($_POST['appointment']),			
			mysql_real_escape_string($_POST['directorate']),			
			mysql_real_escape_string($insertdate),												
			mysql_real_escape_string($_POST['email']),
			mysql_real_escape_string($_POST['office_phone']),												
			mysql_real_escape_string($_POST['cell_phone']) )or die(mysql_error());
			
		$sql1 = mysql_query($query1);
		$sql2 = mysql_query($query2);
		
		
		
		if ($sql1 && $sql2){

			if ( isset($_SESSION['_userType']) && ($_SESSION['_userType']) == 1) 			
				$message = "User Created Successfully";				
			else				
				$message = "Registration Request Successful";
				//header("Location:".$_SERVER['PHP_SELF']."?action=login");
				//header("Location:".$_SERVER['PHP11_SELF']."?action=home");			
		}
		else{
			$message = "Registration Request Failed";
		}
		
		//mysql_real_escape_string($_POST['password'])
		
		# Redirect the user to a login page
		
		
		//exit;
    }
}


?> 

<table width="100%" >
	<tr>
		<?php  
            if (isset($_SESSION['_userName'])) {
             ?>	  <td align="left" width="70%" valign="top">

         <?php 
            }
			else {
            ?>   <td align="left" width="100%" valign="top">
		 <?php 
                }
            ?> 
			<h4>Registration</h4>
            
	<table bordercolor="#006666" border="0"  width="100%"  >         <!--      bgcolor="#EEEEEC"       -->
	<tr>
    <td align="center" >
    
    <form name="registration_form" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=registration" method="post">
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >
        
        <tr bgcolor="#DFDFDF"><td colspan="3" align="center" style="color:#990000">
           <h5><?php if(isset($message)) echo $message; ?></h5>
        </td></tr>

        <tr><td colspan="3" align="center" >&nbsp;
           
        </td></tr>
        
        <tr>
                    <td width="460" align="right"><strong>User Type</strong></td>
                  <td width="35" align="center">:</td>
<td width="460">
	<select name="user_type" id="user_type" onchange="disableFieldsForSentry()">

<?php
			if ( isset($_SESSION['_userType']) && ($_SESSION['_userType']) == 1  ){
?>
                                    <option value="">Choose...</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Officer</option>
                                    <option value="3">Sentry</option>
                                    <option value="4">Admin(FL)</option>                                    
<?php			
			} 			
			else{
?>
                                    <option value="">Choose...</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Officer</option>
<?php
			}
?>

                                </select> <? if(!$row){echo 'value="'.$_POST['user_type'].'"';} ?></td>
        </tr>
        
        
        
        <tr>
                    <td width="460" align="right"><strong>User Name</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="text" name="user_name" id="user_name"/><? if(!$row){echo 'value="'.$_POST['user_name'].'"';} ?></td>
        </tr>
        

            
        <tr>
                    <td width="460" align="right"><strong>First Name</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="text" name="first_name" /><? echo 'value="'.$_POST['first_name'].'"'; ?></td>
        </tr>
         
        <tr>
                    <td width="460" align="right"><strong>Last Name</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="text" name="last_name" /><? echo 'value="'.$_POST['last_name'].'"'; ?></td>
        </tr>
        
        
<!--------------------------------------------------------------------------------------------------------------------->
<tr>
                    <td width="460" align="right"><strong>Rank</strong></td>
                  <td width="35" align="center">:</td>                                    
                  <td><select name="rank" id="rank">
                  
                  			<option value="">Choose... </option>                  
                    

         				</select> </td>                         
</tr>       
<!--------------------------------------------------------------------------------------------------------------------->       
       
<tr>
                    <td width="460" align="right"><strong>Appointment</strong></td>
                  <td width="35" align="center">:</td>                                    
                  <td><select name="appointment" id="appointment" >
                  			<option value="">Choose...</option>
                  
                    
<?php

$sql_search = "SELECT rowID,appointmentName FROM tbl_appointment WHERE isDisabled ='no' ORDER BY rowID";
$result_all_rows = $db->execQuery($sql_search);		
$num_of_rows_found=mysql_num_rows($result_all_rows);

if($num_of_rows_found>0){

		$result_array = $db->resultArray($result_all_rows);
		for($i=0; $i<$num_of_rows_found; $i++){		
?>
                    	<option value="<?php echo $result_array[$i]['rowID'];?>"><?php echo $result_array[$i]['appointmentName'];?></option>
<?php
		}		
}
?>
         				</select> </td>                    
</tr>
<!--------------------------------------------------------------------------------------------------------------------->            
<tr>
                    <td width="460" align="right"><strong>Directorate</strong></td>
                  <td width="35" align="center">:</td>                                    
                  <td><select name="directorate" id="directorate">

                  			<option value="">Choose... </option>                  
                    
<?php

$sql_search = "SELECT rowID,directorateName FROM tbl_directorate WHERE isDisabled ='no' ORDER BY rowID";
$result_all_rows = $db->execQuery($sql_search);		
$num_of_rows_found=mysql_num_rows($result_all_rows);

if($num_of_rows_found>0){

		$result_array = $db->resultArray($result_all_rows);
		for($i=0; $i<$num_of_rows_found; $i++){		
?>
                    	<option value="<?php echo $result_array[$i]['rowID'];?>"><?php echo $result_array[$i]['directorateName'];?></option>
<?php
		}		
}
?>
         				</select></td>                    
</tr>
<!--------------------------------------------------------------------------------------------------------------------->        
        <tr>
                    <td width="460" align="right"><strong>Joining Date</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="text" name="joining_date" id="datepicker_past" /><? echo 'value="'.$_POST['joining_date'].'"'; ?></td>
        </tr>

            
        <tr>
                    <td width="460" align="right"><strong>Email</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="text" name="email" /><? echo 'value="'.$_POST['email'].'"'; ?></td>
        </tr>

        <tr>
                    <td width="460" align="right"><strong>Office Phone</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="text" name="office_phone" /><? echo 'value="'.$_POST['office_phone'].'"'; ?></td>
        </tr>

        <tr>
                    <td width="460" align="right"><strong>Cell Phone</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="text" name="cell_phone" /><? echo 'value="'.$_POST['cell_phone'].'"'; ?></td>
        </tr>
         
        <tr>
                    <td width="460" align="right"><strong>Password</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="password" name="password" /></td>
        </tr>
        
        <tr>
                    <td width="460" align="right"><strong>Retype Password</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input type="password" name="re_password" /></td>
        </tr>
        

        <tr>
                  <td width="460" align="right"></td>
                  <td width="35" align="center"></td>
                  <td><input type="checkbox"  onclick="toggleSubmitButton(this)"  name="chk_policy" id="chk_policy" />
                  I have read the policies</td>
        </tr>


        <tr >
                  <td colspan="2">&nbsp; </td>
           		  <td><input type="submit" disabled="disabled" name="submit" id="submitButton" value="Register" /></td>
        </tr>


        <tr bgcolor="#DFDFDF">
                    <td colspan="3">&nbsp; </td>           		
        </tr>
        </table>
        
    </form> 

</td>

  </tr>
    </table>

            
		</td>
	


        <td align="left" width="20%" valign="top" >
			<?php  
            if (isset($_SESSION['_userName'])) {
            
                include('includes/sidebar.php'); 
            
            }			 
            ?>
            
        </td>
        
	</tr>
</table>