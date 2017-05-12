<?php

if(isset($_POST['submit'])){

	$query = "SELECT userName FROM tbl_user_info ". 
		"WHERE userName = '".($_POST['txtUserName'])."' and userPassword = '".($_POST['txtOldPassword'])."'";

	$result = @mysql_query ($query);
	$num = mysql_num_rows ($result);
	
	if ($num == 1) {
	
		$row = mysql_fetch_array($result, MYSQL_NUM);

		$query = "UPDATE tbl_user_info ".
		"SET userPassword = '".($_POST['txtNewPassword1'])."' ".
		"WHERE userName = '".$row[0]."' ";

		$result = @mysql_query ($query);
		
		if (mysql_affected_rows() == 1) {
			$message = "Password has been changed.";
		}
	}
	else{
			$message = "User Name and Password are not correct.";	
	}
}


?>

<?php

//if (!isset($message))
//	$message = '&nbsp;';
?>
<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Change Password</h4>
            
	        <table bordercolor="#006666" border="0"  width="100%"  >        
	<tr>
    <td align="center" >
    
   
    <form name=theForm action="<?php echo $_SERVER['PHP_SELF']; ?>?action=change_password"    onsubmit="return validateForm_ChangePassword()" method="post">
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >
        
       
        <tr bgcolor="#DFDFDF">
                    <td colspan="3" align="center" ><strong><?php if(isset($message)) echo $message; ?></strong></td>           		
        </tr>        

        <tr>
        	<td colspan="3" align="center" >&nbsp;</td>
        </tr>
        
        <tr>
                  <td width="460" align="right"><strong>User Name</strong></td>
                  <td width="35" align="center">:</td>
                  <td width="460"><input id="txtUserName" name="txtUserName" type="text" ></td>
        </tr>    
            
        <tr>
                    <td width="460" align="right"><strong>Old Password</strong></td>
                    <td width="35" align="center">:</td>
                  <td><input id="txtOldPassword" name="txtOldPassword" type="password" ></td>
        </tr>

        <tr>
                    <td width="460" align="right"><strong>New Password</strong></td>
                    <td width="35" align="center">:</td>
                  <td><input id="txtNewPassword1" name="txtNewPassword1" type="password" ></td>
        </tr>
        <tr>
                    <td width="460" align="right"><strong>Confirm New Password</strong></td>
                    <td width="35" align="center">:</td>
                  <td><input id="txtNewPassword2" name="txtNewPassword2" type="password" ></td>
        </tr>                 
        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td><input name="submit" type="submit" value="Change Password">
                  </td>
        </tr>
        <tr bgcolor="#DFDFDF">
                    <td colspan="3">&nbsp;</td>           		
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