<?php
class db
{
	var $persistent=0;
	var $query;

/*	
	var $user="root";
	var $pass = "";
	var $host="localhost";
	var $mydb="lms"; 
*/

	var $user="lmsv1db";
	var $pass = "Technologies14";
	var $host="p50mysql107.secureserver.net";
	var $mydb="lmsv1db";

	function connect()
	{
		if($this->persistent==1)
		{
		$this->rlink = mysql_connect($this->host,$this->user,$this->pass);
		}
		else
		{
		$this->rlink = mysql_connect($this->host,$this->user,$this->pass);
		}
	mysql_select_db ($this->mydb);
	}
	
	
	function query($SQL)
	{
	$this->query=mysql_query($SQL)or die( "error with query: $SQL ".mysql_error() );
	}
	
	function getRows()
	{
	$this->moreRows=mysql_fetch_array($this->query);
	
		if($this->moreRows<1)
		{
		@mysql_close($this->rlink);
		}
	
	return $this->moreRows;
	}
	
	function row($column)
	{
	return $this->moreRows[$column];
	}
	function close()
	{
		@mysql_close($this->rlink);
	}

}
/*
$db = new db;
$db->connect();
$db->query("SELECT * FROM x_groups");
//$db->query("INSERT INTO x_groups (group_ID,name) VALUES ('mm10','mystery tester 10')");

while($db->getRows())
//while(odbc_fetch_into($rlink, $row));
{ 
echo $db->row("name")."---".$db->row("group_ID")."<BR>";
} 
*/
?>
