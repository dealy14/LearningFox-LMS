<?php
class table
{
var $tcols = array();
var $location;
var $sql;
var $tmpObj;


function global_object ($object_name) 
{ 
eval ("global \$$object_name;"); 
$newo = ${$object_name}; 
return "$newo"; 
} 

function fullInsert($table)
{
$this->location = $GLOBALS["dir_sql"];
$this->tcols=file($this->location."table_".$table);

	$x=0;
	while($x<count($this->tcols))
	{
	  if($x==0)
	  {
		$tsql.=$this->tcols[$x];
		$trsql.="'$".$this->tcols[$x]."'";	  
	  }
	  else
	  {
	  $tsql.=",".$this->tcols[$x];  
	  $theval = $this->tcols[$x];
	  $trsql.=",'$GLOBAL[\"".$this->tcols[$x]."\"]'";  	
	  }
	$x++;
	}
//eval("\$this->sql = \"INSERT INTO $table ($tsql) VALUES ($trsql)\";");
//eval("\$this->sql = \"INSERT INTO $table ($tsql) VALUES ($trsql)\";");
eval("\$this->sql = \"INSERT INTO \$table (\$tsql) VALUES (\$trsql)\";");
$mst = $this->sql;
return $mst;
}
//global ${$this->tcols[1]};

}
?>
