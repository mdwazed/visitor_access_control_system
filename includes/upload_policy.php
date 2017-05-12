<?php

if(isset($_POST['submit'])){

	$message = '';

    if(   empty($_POST['sort_order'])  ||  empty($_POST['policy_name'])  ||  $_FILES["upload_file"]["size"] == 0   ){     

        if(empty($_POST['sort_order'])){
            $message .= 'Sort Order can\'t be empty<br>';
        }

        if(empty($_POST['policy_name'])){
            $message .= 'Policy Name can\'t be empty<br>';
        }

        if( $_FILES["upload_file"]["size"] == 0 ){
            $message .= 'File must be selected';
        }

		$message .= '</p>';
		
    }
	else{

//------------------------- File Upload

//		$output_form = 0;                

		if ( $_FILES["upload_file"]["type"] == "application/pdf" ){

				if (file_exists("policy_docs/" . $_FILES["upload_file"]["name"])) {
            $message .= $_FILES["upload_file"]["name"] . " already exists. Policy could not be uploaded. ";
				}
				else{
					move_uploaded_file($_FILES["upload_file"]["tmp_name"], "policy_docs/" . $_FILES["upload_file"]["name"]);
					
					$query = sprintf("INSERT INTO tbl_policy_upload (sortOrder, policyName, policyDescription, fileName)  VALUES   ('%s','%s','%s','%s')",
			
					mysql_real_escape_string($_POST['sort_order']),
					mysql_real_escape_string($_POST['policy_name']),
					mysql_real_escape_string($_POST['policy_description']),									
					mysql_real_escape_string($_FILES["upload_file"]["name"]) ) or die(mysql_error());
			
					$sql = mysql_query($query);
					
					if ($sql){			
							$message = "Policy Upload Successful";
					}
					else{
						$message = "Policy could not be uploaded";
					}
				
				}                          
		}

    }
}

?> 

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Policy Upload</h4>
            
	<table bordercolor="#006666" border="0"  width="100%"  >         <!--      bgcolor="#EEEEEC"       -->
	<tr>
    <td align="center" >
    
   
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=upload_policy" method="post">
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >
        
        <tr bgcolor="#DFDFDF">
        	<td colspan="4" align="center" style="color:#990000">
	           <h5><?php if(isset($message)) echo $message; ?></h5>        	</td>
        </tr>

        <tr><td colspan="4" align="center" >&nbsp;
           
        </td></tr>    
            
        <tr>
                    <td width="428" align="right"><strong>Sort Order</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="sort_order" /> </td>
        </tr>

       
         
        <tr>
                    <td width="428" align="right"><strong>Policy Name</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="policy_name" /></td>
        </tr>
        
        
<!--------------------------------------------------------------------------------------------------------------------->
       
<!--------------------------------------------------------------------------------------------------------------------->       
       




		 <tr>
                    <td width="428" align="right"><strong>Description</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="policy_description" /></td>
        </tr>


        <tr>
                    <td width="428" align="right"><strong>Upload Document</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="file"  name="upload_file" /></td>
        </tr>
        

        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td width="138"><input type="submit" name="submit" value="Save" /></td>
                  <td width="292">&nbsp;</td>
        </tr>
        <tr bgcolor="#DFDFDF">
                    <td colspan="4">&nbsp; </td>           		
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