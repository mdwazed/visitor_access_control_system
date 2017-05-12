<?php

if (!isset($message))
	$message = '&nbsp;';
?>
<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Login</h4>
            
            <form method="post" name="frmLogin" id="frmLogin" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=login_verification">
       <p>&nbsp;</p>
       <table width="100%" border="1"  cellpadding="5" cellspacing="1">
        <tr > 
         <td > 
		 <div align="center"><b><?php echo $message; ?></b></div>
		  <table width="100%" border="0" cellpadding="2" cellspacing="1" >
           <tr align="center"> 
            <td colspan="3">&nbsp;</td>
           </tr>
           <tr class="text"> 
            <td width="100" align="right">User Name</td>
            <td width="10" align="center">:</td>
            <td><input name="txtUserName" type="text" class="box" id="txtUserName" value="admin" size="10" maxlength="20"></td>
           </tr>
           <tr> 
            <td width="100" align="right">Password</td>
            <td width="10" align="center">:</td>
            <td><input name="txtPassword" type="password" class="box" id="txtPassword" value="admin" size="10"></td>
           </tr>
           <tr> 
            <td colspan="2">&nbsp;</td>
            <td><input name="btnLogin" type="submit" class="box" id="btnLogin" value="Login"></td>
           </tr>
           <tr align="center"> 
            <td colspan="3">&nbsp;</td>
           </tr>
          </table></td>
        </tr>
       </table>
       <p>&nbsp;</p>
</form>
            
		</td>
	


        <td align="left" width="20%">
			<?php  
            if (isset($_SESSION['_userName'])) {
            
                include('includes/sidebar.php'); 
            
            }
						 
            ?>
        </td>
        
	</tr>
</table>


