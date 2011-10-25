<?php
class db
{
	var $persistent=0;
	var $query;
	var $user="learningfo899495";
	var $pass = "ealy14";
	var $host="sqlc6.megasqlservers.com";
	var $mydb="LMS_learningfox_com";
	var $rlink;
	
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
	$this->query=mysql_query($SQL);
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
