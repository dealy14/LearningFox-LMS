<?php
class db {
	var $persistent=0;
	var $query;
	var $rowCount=0;
	var $validSelectResult=false;
	private $rlink;

		
	var $user = "rammons_lms";
	var $pass = "brwahp95";
	var $host = "localhost";
	var $mydb = "rammons_lms";

/*
	var $user = "safetytraindemo";
	var $pass = "RZ8Lk55auNQv1e";
	var $host = "safetytraindemo.db.8609376.hostedresource.com";
	var $mydb = "safetytraindemo";
*/
	function connect() {
		if($this->persistent==1) {
			$this->rlink = mysql_connect($this->host,$this->user,$this->pass);
		}
		else {
			$this->rlink = mysql_connect($this->host,$this->user,$this->pass);
		}
		mysql_select_db ($this->mydb);
	}
	
	function query($SQL) {
		$this->query=mysql_query($SQL);// or die( "error with query: ".mysql_error() );
		if ("resource"==gettype($this->query)){
			$this->rowCount = mysql_num_rows($this->query);
			$this->validSelectResult = true;
		}
		else
			$this->validSelectResult = false;
			
//		if ($this->query === false)
//			throw new Exception ( $SQL . ": " . mysql_error());
	}
	
	function getRowCount(){
		if ($this->validSelectResult)
			return $this->rowCount;
		else
			return 0;
	}

	function getRows() {
		if ($this->validSelectResult){	
			$this->moreRows=mysql_fetch_array($this->query);
			return $this->moreRows;
		}
		else{
			return false;
		}

		/*if($this->moreRows<1) {
				@mysql_close($this->rlink);
			}*/
	}

	function row($column) {
		return $this->moreRows[$column];
	}
	
	function rowdata() {
		return $this->moreRows;
	}
	
	function close() {
		if (isset($this->rlink))
			mysql_close($this->rlink);
		else
			trigger_error("Cannot close an un-set MySQL resource connection.");
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

	function get_connection_parameters() {
		return array( "host" 	 => $this->host,
					  "database" => $this->mydb,
					  "user" 	 => $this->user,
					  "password" => $this->pass
					  );
	}
}
?>