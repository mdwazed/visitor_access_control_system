<?php

session_start();

require_once('libraries/class.Db.php');    
$db = new Db('localhost', 'root', '', 'vacs');



if ( (isset($_REQUEST['action'])) && (!empty($_REQUEST['action']))) {
    
	switch ($_REQUEST['action']) {
	
	
		case 'policy_information':
	
        	$body = 'policy_information.php';
	        break; 
			
		case 'upload_policy':
	
        	$body = 'upload_policy.php';
	        break; 

		case 'registration':
	
        	$body = 'registration.php';
	        break; 
	
		case 'registration_approval':
	
        	$body = 'registration_approval.php';
	        break; 
	
		case 'view_user_list':
	
        	$body = 'user_list.php';
	        break; 

		case 'admin_configuration':
	
        	$body = 'admin_configuration.php';
	        break; 	
	
		case 'setup_directorate':
	
        	$body = 'directorate_profile.php';
	        break; 	

		case 'setup_appointment':
	
        	$body = 'appointment_profile.php';
	        break; 	

		case 'setup_rank':
	
        	$body = 'rank_profile.php';
	        break; 	

		case 'setup_visit_purpose':
	
        	$body = 'visit_purpose.php';
	        break; 

			
		case 'create_pass':
	
        	$body = 'create_pass.php';
	        break;	
				
		case 'create_pass_foreigner':
	
        	$body = 'create_pass_foreigner.php';
	        break;			

		case 'create_pass_temporary':
	
        	$body = 'create_pass_temporary.php';
	        break;		

		case 'temporary_approval':
	
        	$body = 'temporary_approval.php';
	        break; 

		case 'foreigner_approval':
	
        	$body = 'foreigner_approval.php';
	        break; 

		case 'foreigner_approval_notification_admin':
	
        	$body = 'foreigner_approval_notification_admin.php';
	        break; 

		case 'foreigner_approval_notification_officer':
	
        	$body = 'foreigner_approval_notification_officer.php';
	        break; 
			
		case 'pass_details':
	
        	$body = 'pass_details.php';
	        break;			

		case 'pass_details_temporary':
	
        	$body = 'pass_details_temporary.php';
	        break;			
			
		case 'pass_details_foreigner':
	
        	$body = 'pass_details_foreigner.php';
	        break;	
			
		case 'pass_details_archive':
	
        	$body = 'pass_details_archive.php';
	        break;	
					

		case 'view_pass_list_partial':
	
        	$body = 'pass_list_partial.php';
	        break; 
			
	
		case 'view_pass_list_admin':
	
        	$body = 'pass_list_admin.php';
	        break; 
			
	

		case 'view_pass_list_unusual_entry':
	
        	$body = 'pass_list_unusual_entry.php';
	        break; 

		case 'view_visitor_unusual_entry_list':
	
        	$body = 'visitor_unusual_entry_list.php';
	        break; 

		case 'view_pass_list_officer':
	
        	$body = 'pass_list_officer.php';
	        break; 
			
		case 'view_pass_list_archive':
	
        	$body = 'pass_list_archive.php';
	        break; 		

		case 'search_pass_current':
	
        	$body = 'search_pass_current.php';
	        break;		

		case 'search_pass_previous':
	
        	$body = 'search_pass_previous.php';
	        break;		
			
		case 'search_temporary_pass':
	
        	$body = 'search_temporary_pass.php';
	        break;		
			
		case 'search_foreigner_pass':
	
        	$body = 'search_foreigner_pass.php';
	        break;		

		case 'notification_officer':                          /* user notified once the temp or foreign pass is approved */
        	$body = 'notification_officer.php';
	        break;	

	case 'reports_list':	
       		$body = 'reports_list.php';
	        break;

		case 'take_photo':	
       		$body = 'take_photo.php';
	        break;	
					
		case 'login_verification':
		
			require_once('libraries/class.LoginVerify.php');			
			
			$loginverify = new LoginVerify($_REQUEST['txtUserName'], $_REQUEST['txtPassword']);
			$loginstatus = $loginverify->checkUser($db);
	
			if ($loginstatus == true) {
		
				$body = 'home.php';				
			} 
			else {			
				$message = 'Invalid Username or Password!';
				$body = 'login.php';				
			}
	        break;


		case 'change_password':
		
			$body ='change_password.php';
			break; 


		case 'home':
	
			/* if ((!isset($_SESSION['_userID'])) && ($_SESSION['_userID'] == "")) {
				header("Location: http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/");
			} */

        	$body = 'home.php';
	        break; 


		case 'logout':

			require_once('includes/archive_pass.php');		
					
			session_unset();
			session_destroy();
			$body ='login.php';
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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<meta name="author" content="" />


<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script> 
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script> 
<script type="text/javascript" src="js/common.js"></script> 
<script type="text/javascript" src="js/custom.js"></script> 
<script type="text/javascript" src="js/webcam.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.23.custom.css" media="screen" />

<title>Visitor Access Control System</title>

</head>

	<body>

		<div id="wrapper">


			<?php include('includes/header.php'); ?>	
            
            
            <?php include('includes/nav.php'); ?>
            
            <div id="content">
	      	    <?php require_once "includes/$body"; ?>					
            </div>
            
            <?php include('includes/footer.php'); ?>

		</div> <!-- End #wrapper -->

	</body>

</html>


