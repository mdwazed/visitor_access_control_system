<?php

session_start();

require_once('libraries/class.Db.php');    
$db = new Db('localhost', 'root', '', 'academic_project');



if (   (isset($_REQUEST['action'])) && (!empty($_REQUEST['action']))) {
    
	switch ($_REQUEST['action']) {
	
		case 'login_verify':
		
			require_once('libraries/class.LoginVerify.php');			
			session_destroy();
			$loginverify = new LoginVerify($_REQUEST['txtUserName'], $_REQUEST['txtPassword']);
			$loginstatus = $loginverify->checkUser($db);
	
			if ($loginstatus == true) {
		
				$body = 'body.php';				
			} 
			else {			
				//$message = 'Invalid Username or Password!';
				$body = 'login.php';				
			}
	        break;
		

		case 'home':
	
			if ((!isset($_SESSION['_userID'])) && ($_SESSION['_userID'] == "")) {
				header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/");
			}

        	$body = 'body.php';
	        break; 


		case 'logout':
		
			session_unset();
			session_destroy();
			$body ='logout.php';
			break; 
			
		
		default:		
		
			$body = 'login.php';
	        break; 					

	}

}
else {
	$body = 'login.php';
}
?>



<?php include('includes/header.php'); ?>
<?php include('includes/nav.php'); ?>


<div id="content">

<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center" class="bodytext">
			<tr>
				<td align="center">&nbsp;</td>
			</tr>
			<tr>
				<td align="center">&nbsp;</td>
			</tr>
			<tr>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center">&nbsp;</td>
					</tr>
					<tr>
						<td align="center"><?php require_once "includes/$body"; ?></td>
					</tr>
					<tr>
						<td align="center">&nbsp;</td>
					</tr>
					<tr>
						<td align="center">&nbsp;</td>
					</tr>
					
				</table>
				</td>
			</tr>
</table>


</div> <!-- end #content -->


<?php include('includes/sidebar.php'); ?>
<?php include('includes/footer.php'); ?>



