


<div id="nav">

<?php	

if (isset($_SESSION['_userName'])) {
	

	if ($_SESSION['_userType'] == 3 ) {
?>	

	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=home">Home</a>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=logout">logout</a>
	 

<?php
	}
	else{
?>	
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=home">Home</a>
	<a href=" <?php echo $_SERVER['PHP_SELF']; ?>?action=policy_information">Policy Information</a>
	<a href=" <?php echo $_SERVER['PHP_SELF']; ?>?action=registration">Registration</a>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=logout">logout</a>
	 

<?php 	
	}
?>
    
     <span style="float:right; font-size:14px; color:#3399FF"  > 
      <?php if (  isset($_SESSION['_userName'])  )	echo "Logged in as : ".$_SESSION['_userName']; ?>
    </span>
    
    
<?php
}
else {
?>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=home">Home</a>
	<a href=" <?php echo $_SERVER['PHP_SELF']; ?>?action=policy_information">Policy Information</a>
	<a href=" <?php echo $_SERVER['PHP_SELF']; ?>?action=registration">Registration</a>
	<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=login">Login</a>    


<?php
}
?>

</div> <!-- end #nav -->
