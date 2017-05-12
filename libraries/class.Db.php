<?php
class Db {
    
	var $hostname = '';	
	var $username = '';	
	var $password = '';	
	var $databasename = '';	
	var $linkid = false;	
	var $result = false;


	
	function Db($hostname, $username, $password, $databasename, $linkid = false) {
		$this->hostname     = $hostname;
		$this->username     = $username;
		$this->password     = $password;
		$this->databasename = $databasename;
		$this->linkid       = $linkid;
		// Auto connect to the server
		$this->connect();
	}   // End constructor

	/**
	 * Establish connection with the server and database
	 * @return resource on success else boolean
	 */
	function connect() {
		$this->linkid = @mysql_connect($this->hostname, $this->username, $this->password);
		if(!$this->linkid){
			$this->error("Could not connect with server!");
			return false;
		} else {
			$check = @mysql_select_db($this->databasename, $this->linkid);
			if ($check) {
			    return $this->linkid;
			} else {
				$this->error("Could not connect with database!");
				return false;
			}
		}
	} // End function connect
    
	
	function execQuery($query) {
		//$this->result = mysql_query($query,$this->linkid);
		$this->result = mysql_query($query);
		if (!$this->result) {
			$this->error("Query execution failed!");
		}
		if ($this->result)
			return $this->result;
		else
			return NULL;
	} // End function execQuery()
	
	
	function checkExists($query) {
		$this->result = $this->execQuery($query);
		$rows = mysql_num_rows($this->result);
		if($rows != 0)
			return true;
		else
			return false;
	} // End function checkExists()
	
	function resultArray() {
		$arinfo = array();
		$i = 0;
		while($data = mysql_fetch_assoc($this->result)) {
			while(list($key,$value) = each($data))
				$arinfo[$i][$key] = $value;
			$i++;
		}
		//$this->freeResult($this->result);
		return $arinfo;
	} // End function result2array()
    
	/**
	 * get last record
	 * @return int
	 */
	function lastInsert($result){
		$insertid = NULL;
		$insertid = @mysql_insert_id($this->linkid);
		return $insertid;
	} 
	
	/**
	 * Release all memory associated with resultset
	 * @return int
	 */
	function freeResult() {
		return @mysql_free_result($this->result);
	} // End function freeResult()
	
	/**
	 * Closes non persistent link
	 * @return boolean
	 */
	function close() {
		return @mysql_close($this->linkid);
	} //End function close()
	
	/**
	 * Display error message
	 * @param string $message
	 */
	function error($message) {
		$this->error = $message.' '.mysql_error().'.';
		echo $this->error;
	} // End function error
	

	function changeFormatDate($cdate){
		list($day,$month,$year)= explode("-",$cdate);
		return $year."-".$month."-".$day;
	} 

	
}
?>
