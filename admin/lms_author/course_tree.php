<?php
require_once("../../conf.php");
clear_cache();
?>
<!--
     (Please keep all copyright notices.)
     This frameset document includes the FolderTree script.
     Script found at: http://www.treeview.net
     Author: Marcelino Alves Martins

     Instructions:
     - Do not make any changes to this file outside the style tag.
	 - Through the style tag you can change the colors and types
	   of fonts to the particular needs of your site. 
	 - A predefined block has been made for stylish people with
	   black backgrounds.
-->


<html>
<head>

<!-- if you want black backgound, remove this style block -->
<style>
   BODY {background-color: white;topmargin:0;rightmargin:0;leftmargin:0}
   TD {font-size: 8pt; 
       font-family: verdana,helvetica; 
	   text-decoration: none;
	   white-space:nowrap;}
   A  {text-decoration: none;
       color: black}
</style>

<!-- if you want black backgound, remove this line and the one marked XXXX and keep the style block below 

<style>
   BODY {background-color: black}
   TD {font-size: 10pt; 
       font-family: verdana,helvetica 
	   text-decoration: none;
	   white-space:nowrap;}
   A  {text-decoration: none;
       color: white}
</style>

XXXX -->


<!-- NO CHANGES PAST THIS LINE -->
<!-- Code for browser detection -->
<script src="ua.js"></script>
<!-- Infrastructure code for the tree -->
<script src="ftiens4.js"></script>
<!-- Execution of the code that actually builds the specific tree.
     The variable foldersTree creates its structure with calls to
	 gFld, insFld, and insDoc -->
	 
<script>
function hideMenu()
{
top.document.all.tester.style.visibility="hidden";
}

function openItem(item,item_ID,item_level)
{
alert('top.properties.location=edit_'+item+'.php?ID='+item_ID+'&item_level='+item_level);
}

// Decide if the tree is to to be shown on a separate frame of its own
USEFRAMES = 1;

// Remove the folder and link icons
USEICONS = 1;

// Decide if the names are links or just the icons;
USETEXTLINKS = 1  //replace 0 with 1 for hyperlinks;

// Decide if the tree is to start all open or just showing the root folders;
STARTALLOPEN = 1 //replace 0 with 1 to show the whole tree;

// Make the folder and link labels wrap into multiple lines;
WRAPTEXT = 1;

foldersTree = gFld("&nbsp;<B><?php echo $course_name;?></B>", "#");
foldersTree.iconSrc = "images/course_folder_tree.gif";

document.onclick = hideMenu;
<?php
//get all root level topics;
$root_order[]="";

$result=MetabaseQuery($database,"SELECT topics.title,topics.topic_id,courses_topics.order_num FROM topics,courses_topics WHERE courses_topics.course_id=$course_id AND topics.topic_id = courses_topics.topic_id");
$end_of_result=MetabaseEndOfResult($database,$result);
for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
{
$order_num=MetabaseFetchResult($database,$result,$row,"order_num");
$title=MetabaseFetchResult($database,$result,$row,"title");
$root_order[]=$order_num;
$root_object[$order_num]=$title;
$root_object_type[$order_num]="topic";
$root_object_ID[$order_num]=MetabaseFetchResult($database,$result,$row,"topic_id");
}
MetabaseFreeResult($database,$result);

//get all root level tests;

$result=MetabaseQuery($database,"SELECT tests.title,tests.test_id, courses_tests.order_num FROM tests,courses_tests WHERE courses_tests.course_id=$course_id AND tests.test_id = courses_tests.test_id");
$end_of_result=MetabaseEndOfResult($database,$result);
for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
{
$order_num=MetabaseFetchResult($database,$result,$row,"order_num");
$title=MetabaseFetchResult($database,$result,$row,"title");
$root_order[]=$order_num;
$root_object[$order_num]=$title;
$root_object_type[$order_num]="test";
$root_object_ID[$order_num]=MetabaseFetchResult($database,$result,$row,"test_id");
}
MetabaseFreeResult($database,$result);

//get all the lesson folders;

$result=MetabaseQuery($database,"SELECT  DISTINCT lessons.title, lessons.lesson_id,courses_lessons.order_num FROM lessons,courses_lessons WHERE courses_lessons.course_id=$course_id AND lessons.lesson_id = courses_lessons.lesson_id");
$end_of_result=MetabaseEndOfResult($database,$result);
for($row=0;($end_of_result=MetabaseEndOfResult($database,$result))==0;$row++)
{
$order_num=MetabaseFetchResult($database,$result,$row,"order_num");
$title=MetabaseFetchResult($database,$result,$row,"title");
$lesson_id=MetabaseFetchResult($database,$result,$row,"lesson_id");
$root_order[]=$order_num;
$root_object[$order_num]=$title;
$root_object_type[$order_num]="lesson";
$root_object_ID[$order_num]=$lesson_id;
	
		//get all 3rd level topics;
		$nresult=MetabaseQuery($database,"SELECT DISTINCT topics.title,topics.topic_id,lessons_topics.order_num FROM topics,lessons_topics WHERE lessons_topics.course_id=$course_id AND lessons_topics.lesson_id=$lesson_id AND topics.topic_id=lessons_topics.topic_id");
		$nend_of_result=MetabaseEndOfResult($database,$nresult);
		for($nrow=0;($nend_of_result=MetabaseEndOfResult($database,$nresult))==0;$nrow++)
		{
		$norder_num=MetabaseFetchResult($database,$nresult,$nrow,"order_num");
		$ntitle=MetabaseFetchResult($database,$nresult,$nrow,"title");
		$sub_order[]=$norder_num;
		$sub_root_object[$order_num][$norder_num]=$ntitle;
		$sub_root_object_type[$order_num][$norder_num]="topic";
		$sub_root_object_ID[$order_num][$norder_num]=MetabaseFetchResult($database,$nresult,$nrow,"topic_id");
		$sub_root_object_lesson_ID[$order_num][$norder_num]=$lesson_id;
		}
		MetabaseFreeResult($database,$nresult);		
		
	
		//get all 3rd level tests;
		$nresult=MetabaseQuery($database,"SELECT DISTINCT tests.title,tests.test_id,lessons_tests.order_num FROM tests,lessons_tests WHERE lessons_tests.course_id=$course_id AND lessons_tests.lesson_id=$lesson_id AND tests.test_id=lessons_tests.test_id");
		$nend_of_result=MetabaseEndOfResult($database,$nresult);
		for($nrow=0;($nend_of_result=MetabaseEndOfResult($database,$nresult))==0;$nrow++)
		{
		$norder_num=MetabaseFetchResult($database,$nresult,$nrow,"order_num");
		$ntitle=MetabaseFetchResult($database,$nresult,$nrow,"title");
		$sub_order[]=$norder_num;		
		$sub_root_object[$order_num][$norder_num]=$ntitle;
		$sub_root_object_type[$order_num][$norder_num]="test";
		$sub_root_object_ID[$order_num][$norder_num]=MetabaseFetchResult($database,$nresult,$nrow,"test_id");
		$sub_root_object_lesson_ID[$order_num][$norder_num]=$lesson_id;
		}
		MetabaseFreeResult($database,$nresult);					
}
MetabaseFreeResult($database,$nresult);

####################################################################################################
#Now extract the tree by loopinig through the arrays;
####################################################################################################
sort($root_order);reset($root_order);
sort($sub_order);reset($sub_order);

$x=0;
while($x<count($root_object))
{
	$x++;
	if($root_object_type[$root_order[$x]]=="lesson")
	{
	echo"aux$x = insFld(foldersTree, gFld('&nbsp;<SPAN ID=lesson_".$root_object_ID[$root_order[$x]].">".$root_object[$root_order[$x]]."</SPAN>', 'edit_lesson.php?ID=".$root_object_ID[$root_order[$x]]."&item_level=root&course_id=$course_id'))\n";
	}
	else if($root_object_type[$root_order[$x]]=="topic")
	{
	echo"insDoc(foldersTree, gLnk(0, '&nbsp;<SPAN ID=topic_".$root_object_ID[$root_order[$x]].">".$root_object[$root_order[$x]]."</SPAN>', 'edit_topic1.php?ID=".$root_object_ID[$root_order[$x]]."&item_level=root&course_id=$course_id'))\n";
	}
	else
	{
	echo"test$x = insDoc(foldersTree, gLnk(0, '&nbsp;<SPAN ID=test_".$root_object_ID[$root_order[$x]].">".$root_object[$root_order[$x]]."</SPAN>', 'edit_test1.php?ID=".$root_object_ID[$root_order[$x]]."&item_level=root&course_id=$course_id'))\n";
	echo"test$x.iconSrc = 'images/test_object_tree.gif'\n";
	}
	
	    if(count($sub_root_object[$root_order[$x]]>0))
		{
		$j=0;
			while($j<count($sub_root_object[$root_order[$x]]))
			{
				$j++;
				if($sub_root_object_type[$root_order[$x]][$j]=="topic")
				{
				echo"insDoc(aux$x, gLnk(0, '&nbsp;<SPAN ID=subtopic_".$sub_root_object_lesson_ID[$root_order[$x]][$j]."_".$sub_root_object_ID[$root_order[$x]][$j].">".$sub_root_object[$root_order[$x]][$j]."</SPAN>', 'edit_subtopic1.php?ID=".$sub_root_object_ID[$root_order[$x]][$j]."&item_level=sub&lesson_id=".$sub_root_object_lesson_ID[$root_order[$x]][$j]."&course_id=$course_id'))\n";
				}
				else
				{
				echo"test$x_$j = insDoc(aux$x, gLnk(0, '&nbsp;<SPAN ID=subtest_".$sub_root_object_lesson_ID[$root_order[$x]][$j]."_".$sub_root_object_ID[$root_order[$x]][$j].">".$sub_root_object[$root_order[$x]][$j]."</SPAN>','edit_subtest1.php?ID=".$sub_root_object_ID[$root_order[$x]][$j]."&item_level=sub&lesson_id=".$sub_root_object_lesson_ID[$root_order[$x]][$j]."&course_id=$course_id'))\n";
				echo"test$x_$j.iconSrc = 'images/test_object_tree.gif'\n";
				}
			}
		}
}
?>

</script>
</head>
<body topmargin=8 marginheight=0 rightmargin=8 leftmargin=8>
<!-- By making any changes to this code you are violating your user agreement.
     Corporate users or any others that want to remove the link should check 
	 the online FAQ for instructions on how to obtain a version without the link -->
<!-- Removing this link will make the script stop from working -->
<div style="position:absolute; top:0; left:0; "><table border=0><tr><td><font size=-2><a style="font-size:7pt;text-decoration:none;color:silver" href=http://www.treeview.net/treemenu/userhelp.asp target=_top></a></font></td></table></div>
<!-- Build the browser's objects and display default view of the 
     tree. -->
<script>initializeDocument()</script>
<noscript>
A tree for site navigation will open here if you enable JavaScript in your browser.
</noscript>
</html>