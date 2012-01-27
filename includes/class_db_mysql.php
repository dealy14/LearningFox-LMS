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
	var $user="cosmoscolms";
	var $pass = "tTTS9wVUUW7ZjY";
	var $host="cosmoscolms.db.8685149.hostedresource.com";
	var $mydb="cosmoscolms";

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
		$this->query=mysql_query($SQL)or die( "error with query: ".mysql_error() );
//		if ($this->query === false)
//			echo( $SQL . ": " . mysql_error());
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

}
?>