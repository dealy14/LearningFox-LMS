<?php
class fdb
{
  function getAllRows($thefile)
  {

  $this->rows=file($thefile);
  $this->totalRows=count($this->rows);
  $this->x=0;
    while($this->x<count($this->rows))
    {
    $this->result[]=explode($this->parser,$this->rows[$this->x]);
    $this->x++;
    }
  }

  function orderASC()
  {
  sort($this->result);
  return $this->result;
  }

  function orderDEC()
  {
  rsort($this->result);
  return $this->result;
  }

  function getResult($x,$rname)
  {
    $cols=explode(",",$this->cols);
    $t=0;
    while($t<count($cols))
    {
    $newar[$cols[$t]]=$t;
    $t++;
    }
  return $this->result[$x][$newar[$rname]];
  }
}

/*
----------------------------------------------------------
Usage Example;
----------------------------------------------------------

$fdb = new fdb;
$fdb->cols="course,test,score,answers";
$fdb->parser="|";
$fdb->getAllRows($dir_includes."ttable.txt");
$fdb->orderASC();
while($rows<$fdb->totalRows):
$jj = $fdb->getResult($rows,"score");
$course = $fdb->getResult($rows,"course");
  if($course==">1")
  {
  echo"$jj<BR>";
  }
$rows++;
endwhile;
*/
?>