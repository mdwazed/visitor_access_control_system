<?php

if (!isset($message))
	$message = '&nbsp;';
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
            
            <h4>Login</h4>
            
	<table bordercolor="#006666" border="0"  width="100%"  >        
	<tr>
    <td align="center" >
    
   
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=login_verification" method="post">
     
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
                  <td width="460"><input name="txtUserName" type="text" value="admin" ></td>
        </tr>    
            
        <tr>
                    <td width="460" align="right"><strong>Password</strong></td>
                  <td width="35" align="center">:</td>
                  <td><input name="txtPassword" type="password" value="a" ></td>
        </tr>
         
        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td><input name="btnLogin" type="submit" value="Login">
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