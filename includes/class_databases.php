<?php
class db
{
var $persistent=0;
var $query;
var $user;
var $pass;
var $mydb="mtest";
var $rlink;

//connect to the mysql server;
//$rlink=mysql_connect ("", "", "");
//select tthe database;
//mysql_select_db ("tester");
//insert data via query;
//mysql_query ("INSERT INTO tablename (first_name, last_name) VALUES ('$first_name', '$last_name')");
//select data from DB (must set query = to "result";
//$SQL="SELECT * FROM x_topics";
/*
$result = mysql_query ($SQL);
//loop through data;
while($row = mysql_fetch_array($result))
{
echo $row["title"]."<BR>";
}
//close the connection;
mysql_close($rlink);
*/


//odbc------;
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
return odbc_fetch_row($this->query);
}

function row($column)
{
return odbc_result($this->query,$column);
}



//close odbc connections;

//odbc_close($rtlink); 
}

$db = new db;
$db->connect();
$db->query("SELECT * from x_topics");
while($db->getRows())
//while(odbc_fetch_into($rlink, $row));
{ 
echo $db->row("title")."<BR>";
} 
?>
