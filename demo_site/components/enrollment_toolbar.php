<?php if($section=="enrollment"){echo"<B>All Courses</B>";}else{?><A HREF="index.php?section=enrollment&sid=<?php echo $sid; ?>">All Courses</A><?}?> | 
<?php if($section=="enrollment_ic"){echo"<B>Incomplete Courses</B>";}else{?><A HREF="index.php?section=enrollment_ic&sid=<?php echo $sid; ?>">Incomplete Courses</A><?}?> | 
<?php if($section=="enrollment_c"){echo"<B>Completed Courses</B>";}else{?><A HREF="index.php?section=enrollment_c&sid=<?php echo $sid; ?>">Completed Courses</A><?}?>
<BR>
<BR>