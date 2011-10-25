<?php
function listvariables()
{
	foreach( $_GET  as $name => $value)
	{
		
		eval("\$".addslashes($name)." = \"".addslashes($value)."\";");
		/*
			$myFile = "variables.txt";
			$fh = fopen($myFile, 'a') or die("can't open file");
			$stringData = "GET ".$name."\n";
			
			//echo $stringData."<br>";
			fwrite($fh, $stringData);
			fclose($fh);
		*/
	}
	foreach( $_POST  as $name => $value)
	{
			eval("\$".addslashes($name)." = \"".addslashes($value)."\";");
		/*
			$myFile = "variables.txt";
			$fh = fopen($myFile, 'a') or die("can't open file");
			$stringData = "POST ".$name."\n";
			//echo $stringData."<br>";
			fwrite($fh, $stringData);
			fclose($fh);
		*/
			
	}
}
//listvariables();
//echo $jaja;
?>
