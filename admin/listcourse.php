<script language="javascript1.2" type="text/javascript" >
function cnfdel(x){
alert("delete");
}
function openpreview(x,y){
window.location.href="uploadfiles/"+x+"/"+y;
}
function sizechart(course,folder,file) {
var str="uploadfiles/"+folder+"/"+file;
window.open('content-preview.php?ref='+str,'popupWindow1','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=600,height=800,screenX=150,screenY=150,top=150,left=150')
}
function callfile(course,cid,folder){
var a=confirm('Do you really want to delete the lesson from the selected course');
if(a){
window.location.href="delete-lessons.php?ref="+cid+"&fn="+folder+"&co="+course;
}

}

</script>
<?php
//include("../conf.php");

//echo $courseid;

//$cntTotal = mysql_result(mysql_query("Select count(*) from crab_lessons where courseid = $courseid"),0);

//echo $cntTotal;

$qryTotal = "Select count(*) from crab_lessons where course_id = $courseid";

$db = new db;
$db->connect();
$db->query($qryTotal);

$cntTotal = $db->getRows();

//echo $cntTotal[0];

if($cntTotal[0] >0) {
echo "<div> <strong> Existing Lessons Are :- </strong> </div>";

$qryAll = "select * from crab_lessons where course_id = $courseid";
$db->query($qryAll);
?>
<table border="0" style="border:1px solid #0000CC" cellspacing="10">
	
		<tr>
			<th>Lesson Name</th>
			<th>Date Of Creation</th>
			<th>Action</th>
		</tr>
		
<?php
		while($db->getRows()){
//		
?>
			<tr>
				<td><?php echo ucwords(strtolower($db->row("lesson_name"))); ?></td>
				<td><?php echo $db->row("date_of_creation"); ?></td>
				<td><a href="javascript:callfile('<?php echo $_SESSION['coursename'];?>',<?php echo $db->row('id');?>,'<?php echo $db->row('folder_name');?>');"  style="text-decoration:none">Delete</a>
				<a href="javascript:sizechart('<?php echo $_SESSION['coursename'];?>','<?php echo $db->row('folder_name');?>','<?php echo $db->row('file_name');?>');" style="text-decoration:none">Preview</a></td>
			</tr>		
<?php
		}
?>


	</table>
<?php
} // if close
?>