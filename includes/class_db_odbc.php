<?php
class db
{
	var $persistent=0;
	var $query;
	var $user;
	var $pass;
	var $mydb="lt";
	var $rlink;
	var $moreRows;
	
	function connect()
	{
		if($this->persistent==1)
		{
		$this->rlink = odbc_pconnect($this->mydb,$this->user,$this->pass);
		}
		else
		{
		$this->rlink = odbc_connect($this->mydb,$this->user,$this->pass);
		}
	}
	
	
	function query($SQL)
	{
	$this->query= odbc_exec($this->rlink,$SQL);
	}
	
	function getRows()
	{
	$this->moreRows=odbc_fetch_row($this->query);
		if($this->moreRows<1)
		{
		odbc_close($this->rlink);
		}
	return $this->moreRows;
	}
	
	function row($column)
	{
	return odbc_result($this->query,$column);
	}

}
/*
$db = new db;
$db->connect();
$db->query("SELECT * from x_topics");
//$db->query("INSERT INTO x_topics (title) VALUES ('mm10')");
$x=0;

while($db->getRows())
//while(odbc_fetch_into($rlink, $row));
{ 
$x++;
echo $db->row("title")."----".$db->row("ID")."<BR>";
} 

echo "<P>there were $x rows of data";
*/
?>
