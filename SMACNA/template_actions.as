#include "conf.as"

/*
----------------------------------------------------------------------
Grab LMS Info
----------------------------------------------------------------------
*/
//getURL("JavaScript:lmsData();");

/*
----------------------------------------------------------------------
Initialize New Variables
----------------------------------------------------------------------
*/

//initialize lesson arrays;
lesson_names = new Array();
lessons= new Array();
x=0;
a_cnt=0;
while(x<total_lessons)
{
lesson_names[x]="My Lesson "+(x+1);
lessons[x] = new Array();
tr_cnt=0;
  while(tr_cnt<eval("total_topics_"+(x+1)))
  {
  lessons[x][t_cnt] = eval("topic_name_"+(x+1)+"_"+(tr_cnt+1));	
  tr_cnt++;
  a_cnt++;
  }
x++;
}

//initialize course variables;
var allTopics=a_cnt;
if(lmsData ne "loaded")
{
var lesson_number=1;
var topic_number=1;
var t_cnt=1;
}

if(custom_inf==""){var completed_lessons="1_1";}else{var completed_lessons=custom_inf;}


var total_lessons=lesson_names.length;

//mark first checkmark;
eval("_root.container.content.block"+(lesson_number)+"_"+(topic_number)).check._alpha=100;	

//initialize navstate;
navState();

//load the first movie;
getContent();

/*
----------------------------------------------------------------------
Set the custom info for the LMS (used in getContent)
----------------------------------------------------------------------
*/
function reportLocation()
{
  if(_level0.completed_lessons.indexOf(_level0.lesson_number+"_"+_level0.topic_number)<0)
  {
  _level0.completed_lessons=_level0.completed_lessons+(","+_level0.lesson_number+"_"+_level0.topic_number);
  getURL("JavaScript:setClocation('"+_level0.completed_lessons+"');");
  }
}


/*
----------------------------------------------------------------------
Content Loading Function
----------------------------------------------------------------------
*/
function getContent()
{
unloadMovieNum(5);
unloadMovieNum(8);
_root.topic_name=eval("topic_name_"+_root.lesson_number+"_"+_root.topic_number);
tsource=eval("topic_type_"+_root.lesson_number+"_"+_root.topic_number);
	if(tsource ne "custom")
	{
	template="template_"+tsource+".swf";
	loadMovie(template,"content");
	}
	else
	{
	loadMovie(eval("topic_src_"+_root.lesson_number+"_"+_root.topic_number),"content");
	}
_root.content_src=eval("topic_src_"+_root.lesson_number+"_"+_root.topic_number);
_root.unpause();
_root.qa=0;
//reportLocation();
var clesson = _level0.lesson_number+"_"+_level0.topic_number;

  if(_level0.useLMS eq "yes")
  {
  getURL("JavaScript:top.setLocationsSp("+_level0.lesson_number+","+_level0.topic_number+","+_level0.t_cnt+",'"+clesson+"','flash');");
  }
}
/*
----------------------------------------------------------------------
Navigation Interface Control
----------------------------------------------------------------------
*/
//turn the next button off;
function offNext()
{
_root.nextGrey._alpha=100;
_root.lastGrey._alpha=0;
}

//turn the last button off;
function offLast()
{
_root.lastGrey._alpha=100;
_root.nextGrey._alpha=0;
}

//turn both back and next button on;
function navOn()
{
_root.nextGrey._alpha=0;
_root.lastGrey._alpha=0;
}

//determine if the back or next button should be disabled;
function navState()
{
	if(topic_number==1 && lesson_number==1)
	{
	offLast();
	}
	else if(t_cnt==allTopics)
	{
	offNext();
	}
	else
	{
	navOn();
	}
}


/*
----------------------------------------------------------------------
Next/Back Functions
----------------------------------------------------------------------
*/

//next function;
function next()
{

	if(lesson_number<=total_lessons && t_cnt < allTopics)
	{
		if(topic_number < Number(eval("total_topics_"+lesson_number)))
		{
		topic_number++;		
		t_cnt++;		
		}
		else if (topic_number==Number(eval("total_topics_"+lesson_number)))
		{
			if(lesson_number!=total_lessons)
			{				
			lesson_number++;
			topic_number=1;			
			t_cnt++;
			}
		}
	}
eval("_root.container.content.block"+(lesson_number-1)+"_"+(topic_number-1)).check._alpha=100;		
navState();
_root.content.unloadMovie("");
getContent();
}


//back function;
function last()
{
	if(topic_number > 1)
	{
	topic_number--;
	t_cnt--;
	}
	else if(topic_number==1 && lesson_number > 1)
	{
	lesson_number--;
	topic_number=(Number(eval("total_topics_"+lesson_number)));
	t_cnt--;
	}
eval("_root.container.content.block"+(lesson_number-1)+"_"+(topic_number-1)).check._alpha=100;			
navState();	
_root.content.unloadMovie("");
getContent();
}

/*
----------------------------------------------------------------------
Exit
----------------------------------------------------------------------
*/
function exit()
{
getURL("JavaScript:confirm('Exit this course?');top.window.close();");
}
/*


----------------------------------------------------------------------
Pause
----------------------------------------------------------------------
*/
function pause()
{
	if(_level0.paused eq "no" || _level0.paused =="")
 	{
	_level5.stop();
	_level0.paused="yes";
	}
	else
	{
	_level5.play();
	_level0.paused="no";	
	}
}

function unpause()
{
_root.pauseGrey._alpha=0;
_level0.paused="no";	
}

/*
----------------------------------------------------------------------
Sound-loading function (non sync)
----------------------------------------------------------------------
*/
function loadSound()
{
	if(_root.useAudio eq "yes")
	{
	sound_src="sound_"+_root.lesson_number+"_"+_root.topic_number+".swf";
	loadMovieNum(sound_src,5);
	}
}


/*
----------------------------------------------------------------------
Bookmarking w/ LMS
----------------------------------------------------------------------
*/
function setBookmarks()
{
    //Propogate completed AUs based on 'custom_inf';
    var t=0;
    var cAus=custom_inf.split(",");
        while(t<cAus.length)
        {
        btemp=cAus[t].substr(0,(cAus[t].length-1));
        ctemp=btemp.split("_");
        tempLesson=(cTemp[0]-1);
        tempTopic=(cTemp[1]-1);
        //eval("_level0.container.content.block"+tempLesson+"_"+tempTopic).check._alpha=100;
        setProperty("_level0.container.content.block"+tempLesson+"_"+tempTopic+".check",_alpha,100);
        t++;
        }
}






