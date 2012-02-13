<?php
class db {
	var $persistent=0;
	var $query;
	private $rlink;

	
/*	var $user="root";
	var $pass = "";
	var $host="localhost";
	var $mydb="lms_davidealytechnologies_com"; */
//var $mydb="";
	var $user="safetytraindemo";
	var $pass = "RZ8Lk55auNQv1e";
	var $host="safetytraindemo.db.8609376.hostedresource.com";
	var $mydb="safetytraindemo";

	function connect() 	{
		if($this->persistent==1) {
			$this->rlink = mysql_connect($this->host,$this->user,$this->pass);
		}
		else {
			$this->rlink = mysql_connect($this->host,$this->user,$this->pass);
		}
		mysql_select_db ($this->mydb);
	}
	
	
	function query($SQL) {
		$this->query=mysql_query($SQL) or die( "error with query: ".mysql_error() );
//		if ($this->query === false)
//			throw new Exception ( $SQL . ": " . mysql_error());
	}
	
	function getRows() {
		$this->moreRows=mysql_fetch_array($this->query);
			if($this->moreRows<1) {
			@mysql_close($this->rlink);
		}
		return $this->moreRows;
	}
	
	function row($column) {
		return $this->moreRows[$column];
	}
	
	function rowdata() {
		return $this->moreRows;
	}
	
	function close() {
		@mysql_close($this->rlink);
	}
	
	function escape_string($str) {
		return mysql_real_escape_string($str, $this->rlink);
	}
	
	function get_column_types($table) {
		$result = mysql_query("SHOW COLUMNS FROM $table", $this->rlink);
		$retval = array();
		while ($row = mysql_fetch_assoc($result)) 
			$retval[$row['Field']] = $row['Type'];
		mysql_free_result($result);
		return $retval;
	}

}
?>