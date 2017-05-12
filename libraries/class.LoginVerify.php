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
		
		$query = "select userName, userType from tbl_user_info where userName = '$this->username' and userPassword = '$this->password' and approvalStatus = 1";
		
		$result = $db->execQuery($query);
		
		if (mysql_num_rows($result)>0){
			
		    $arinfo = $db->resultArray($result);
								
		    $this->username = $arinfo[0]['userName'];
		    $this->usertype = $arinfo[0]['userType'];
			 
		    $_SESSION['_userName'] = $this->username;
		    $_SESSION['_userType'] = $this->usertype;		

			return $loginstatus = true;
        } 
        
		else{

       	    return $loginstatus = false;  

        }
    }
}
?>