<?php		
class LoginVerify {
	var $username = '';
	var $password = '';
	var $loginstatus = false;
	
	function LoginVerify($username, $password) {
		$this->username = $username;
		$this->password = $password;
	}
	
	function checkUser($db) {	
		
		$query = "SELECT * FROM tbl_registration WHERE Email = '$this->username' and Password = '$this->password'";
		$result = $db->execQuery($query);
		
		if (is_resource($result)) {
			
		    $arinfo = $db->resultArray($result);
						
		    $this->userid = $arinfo[0]['ID'];
		    
			if ($this->userid > 0) {

			    $_SESSION['_userID'] = $this->userid;

			    return $loginstatus = true;
            } 
            else {
        	    return $loginstatus = false;
            }
	    } else {
			   	return $loginstatus = false;
	    }
    }
}
?>