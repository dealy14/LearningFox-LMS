/* 	Copyright (C) 19??-200? Computer Sciences Corp.  All rights reserved.
	============================================================
	 File:			$Source: /mars/cvsroot/scorm12_js/CSC_SCO_bestprac.js,v $
	 Revision:		$Revision: 1.6 $
	 
	 Date:			$Date: 2004/03/09 20:50:03 $
	 Author:		$Author: jmills $
	 Status:		$State: Exp $
	============================================================
	
	This file is designed to be the interface that 
	the actual course (html) uses to activate SCORM
	calls.
	
	This file calls functions from (and thus requires)
	the APIWrapper.js file that is provided by the ADL.
	
	The advantage to using the functions here is that
	the courseware can be altered to work with future
	renditions of SCORM (or even non-SCORM) by simply
	changing the implementation of calls within this
	file.
	
	Consider this the CSC TCE Best Practices for 
	ADL SCORM implementation in our courseware.
*/


var CDROM = 0;	// Set to 1 if you want to play on CD-ROM (avoids SCORM calls)
var DEBUG = 0;	// Activates Debugging Alerts (very annoying)
var count = 0;


var startTime;

// if we have a parent storage start time, use it
if ( typeof( parent.storage ) != "undefined" ) {
	if ( typeof( parent.storage.startTime ) != "undefined" ) {
		startTime = parent.storage.startTime;
	}
}

function finishSCO() {

	getExit();
}

// =================================================
// this function is LMS SPECIFIC! 
// it calls the LMS menu/toc structure
// each LMS usually does this differently
function getTOC( relPath ) {

	// finish sco
	endSCO( "suspend" );

	setTimeout( "closeMyWindow()", 1000 );
	//this.location = relPath + "/index.html"
}

// =================================================
// this function exits the COURSE (by exiting the SCO first)
function getExit() {	
	
	var msg = "Are you sure you want to exit the course?";
	
	if ( confirm(msg) ) {
		endSCO( "logout" );
		setTimeout( "closeMyWindow()", 1000 );
//		alert( "Returning to setTimeout to closeMyWindow2()" );
	}
}

function closeMyWindow() {
	top.window.close();
}

// =================================================
// start up a new sco. Generally called in the onLoad of body tag 
// of the first page of a SCO
function beginSCO( defaultStartPage ) {

	if ( CDROM ) { 
		if ( defaultStartPage ) {
			document.location = defaultStartPage;
		}
		return;
	}

	LMSInitialize();
	
	// get existing status
	var status = LMSGetValue( "cmi.core.lesson_status" );
	
	error_report( 'after get lesson_status' );
	
	if (status == "not attempted") {
		// the student is now attempting the lesson
		result = LMSSetValue( "cmi.core.lesson_status", "incomplete" );
	
	} else if ( status == "incomplete" ) {	
	
		// Ask user if they want to return to their last
		// bookmarked location.
		// If they do, go there
		// If they don't, then stay here and save current page
		// as the last visited page.
		var lastpage = getLessonLocation();
		
		// make sure we have a last page to return to.
		// if no last page, then no bookmark to return to.
		// Move onto real first page.
		if ( lastpage == '' ) {
			//setBookmark( window.location );
			document.location = defaultStartPage;
			return;
		}		

		// See how they they entered. 
		// If they are resuming, then prompt to return
		//var exitStatus = LMSGetValue( "cmi.core.entry" );
		
		//if ( exitStatus == "resume" ) {
			
			// we have a bookmarked location, so lets roll
			if ( confirmBookmark( lastpage ) ) {
				returnToBookmark( lastpage );
				return;
			} else {
				//setBookmark( window.location );
			}
			
		//} else {
			// not resuming. Either first time
			// OR already completed SCO, so leave them at the front.
			
		//}
	}
	
	
	// Move the page!!
	if ( defaultStartPage ) {
		document.location = defaultStartPage;
	
	} else {
		alert( "An error has occured. I cannot find the first page of the SCO.");
	}
	
}


// confirm that you want to return to the last bookmarked page
function confirmBookmark( title ) {

	// bail early if CDROM
	if ( CDROM ) { return; }

	result = confirm('Do you wish to return to your last location (' + title + ')?');
	
	
	// I could just return "result", but this way I can add other things.
	if ( result ) {
		return true;
	} else {
		return false;
	}

}

// =================================================
// Set the lesson_status of the SCO to complete
// This DOES NOT end or finish the SCO. 
// Generally called on the last of a SCO
// that does not contain any testing
function completeSCO() {

	// bail early if CDROM
	if ( CDROM ) { return; }

	setLessonStatus( "completed" );
	LMSCommit();
}


// =================================================
// End the SCO. Generally gets called when the user leaves
// the sco in some fashion. This is traditionally on the 
// last page, but that causes a lot of problems (like if the
// user hits the backbutton from the last page)
// So, we usually only call this when the user hits the Main Menu
// or equivalent button. Then we kill the sco and bring up the 
// main menu.
function endSCO( exitStatus ) {

	// bail early if CDROM
	if ( CDROM ) { return; }

	// set default exit status
	if ( exitStatus == "" || exitStatus == null) { 
		exitStatus = "suspend";
	}
	
	// set session time
	if ( startTime ) {
		var totalTime = getSessionTime(startTime);
		//	alert( "startTime: "+startTime );
		if ( totalTime ) {
			//	alert( "totalTime: "+totalTime );
			LMSSetValue( "cmi.core.session_time", totalTime );
		}
	}
	
	// set exit status
	LMSSetValue( "cmi.core.exit", exitStatus );	
	
	// commit all our data so we know it gets stored
	LMSCommit();

	// NOTE: LMSFinish will unload the current SCO.  All processing
	//       relative to the current page must be performed prior
	//		 to calling LMSFinish.
	LMSFinish();
	
//	if ( DEBUG ) { alert2( "finished SCO"); }
}


// =================================================
// Added below function to calculate total SCO time (vek-05.08.03)
function getSessionTime(startTime) {

	// bail early if CDROM
	if ( CDROM ) { return; }
	
	var currentTime = new Date();
	var endTime = currentTime.getTime()
	
	var calculatedTime = endTime-startTime;
	var totalHours = Math.floor(calculatedTime/1000/60/60);
	
	calculatedTime = calculatedTime - totalHours*1000*60*60
	if ( totalHours < 1000 && totalHours > 99 ) {
		totalHours = "0"+totalHours;
	} else if ( totalHours < 100 && totalHours > 9 ) {
		totalHours = "00"+totalHours;
	} else if ( totalHours < 10 ) {
		totalHours = "000"+totalHours;
	}
	
	var totalMinutes = Math.floor(calculatedTime/1000/60);
	calculatedTime = calculatedTime - totalMinutes*1000*60;
	if ( totalMinutes < 10 ) {
		totalMinutes = "0"+totalMinutes;
	}
	
	var totalSeconds = Math.floor(calculatedTime/1000);
	if ( totalSeconds < 10 ) {
		totalSeconds = "0"+totalSeconds;
	}
	
	var totalTime = totalHours+":"+totalMinutes+":"+totalSeconds;
	
	return totalTime;
}

// =================================================
// see which core functions the LMS supports
function supportCheck( LMSobject ) {	

	// bail early if CDROM
	if ( CDROM ) { return; }
	
	// default object to core if none provided
	if ( LMSobject == "" ) { LMSobject = "core"; }
	
	// get comma separated value of supported elements from LMS
	var obj_children = LMSGetValue( "cmi." + LMSobject + "._children" );
	
	// split into array based on comma
	var kids = obj_children.split(',');
	
	// open the window
	w = window.open(	"", 
						"LMS_support", 
						"resizable=1,toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,copyhistory=0,width=400,height=300");
	
	// write to it
	w.document.open();
	w.document.writeln("<html><head><title>LMS SCORM " + LMSobject + " Support</title>");
	w.document.writeln("</head><body><h2>cmi." + LMSobject + " supported elements</h2><ul>");
	
	for ( var i=0; i < kids.length; i++ ) {
		w.document.writeln("<li>" + kids[i] + "</li>");
	}
	w.document.writeln("</ul></body></html>");
	w.document.close();
	
	// bring it to the front
	w.focus();
}



function setInteraction( q_number, q_id, correct_answer, student_answer ) {	

	// bail early if CDROM
	if ( CDROM ) { return; }

	if ( correct_answer == student_answer ) {
		this_result = "correct";
	} else {
		this_result = "wrong";
	}	
	
	LMSSetValue( "cmi.interactions." + q_number + ".id", "q" + q_id );
	LMSSetValue( "cmi.interactions." + q_number + ".type", "choice" );
	
	if ( ASPEN ) {
		// correct_response is only for Aspen, which does this incorrectly.		
		LMSSetValue( "cmi.interactions." + q_number + ".correct_response", correct_answer );
		
	} else {
		// the real way to do it
		LMSSetValue( "cmi.interactions." + q_number + ".correct_responses.0.pattern", correct_answer );
	}
	
	LMSSetValue( "cmi.interactions." + q_number + ".student_response", student_answer );	
	LMSSetValue( "cmi.interactions." + q_number + ".result", this_result );
	LMSCommit();

	if ( DEBUG ) { alert2( "<p>setting interaction for question q" + q_number + " with id " + q_id + ":\n<li>correct answer: " + correct_answer + "\n<li>student answer: " + student_answer ); }
}




//-----------LESSON STATUS-------------
function getLessonStatus() {

	// bail early if CDROM
	if ( CDROM ) { return; }

	return LMSGetValue( "cmi.core.lesson_status" );
}


function setLessonStatus( status ) {

	// bail early if CDROM
	if ( CDROM ) { return; }
	
	var oldLessonStatus = getLessonStatus();

	// need to filter for valid status values
	// then send the data if we're ok.
	if ( status != "not attempted"	&& 
		 status != "incomplete"		&& 
		 status != "completed"		&& 
		 status != "browsed"		&& 
		 status != "passed"			&& 
		 status != "failed" ) {
		
		if ( DEBUG ) {
			alert( "Got a funky lesson_status from the SCO:\n" + status +
				   "Setting it to 'incomplete' for you." );
		}
		// An invalid lesson status has been passed.
		// to avoid total user error, set it to incomplete.		
		status = "incomplete";
	}
	
	// don't let them un-pass.
	// don't let them un-complete.
	// don't let them un-browse.
	if ( oldLessonStatus == "passed" 	||
		 oldLessonStatus == "completed"	||
		 oldLessonStatus == "browsed") 	{
			
		if ( DEBUG ) { 
			alert(	"old status was " + oldLessonStatus + 
					" and that's better than " + status + 
					" so I'm keeping the old value." );
		}
		
		return;
	}
	
	LMSSetValue( "cmi.core.lesson_status", status );
	if ( DEBUG ) {
		alert( "Set lesson_status of\n" + status );  
	}
}







//------------ LESSON LOCATION ----------------
function getLessonLocation() {

	// bail early if CDROM
	if ( CDROM ) { return; }

	return LMSGetValue( "cmi.core.lesson_location");
}

function setLessonLocation( this_location ) {

	// bail early if CDROM
	if ( CDROM ) { return; }

	LMSSetValue( "cmi.core.lesson_location", this_location );
	LMSCommit();
}

function getFilename ( this_location ) {

	// bail early if CDROM
	if ( CDROM ) { return; }
	
	// get path part of URL
	var this_pathname = this_location.pathname;
	
	// split on /
	var dirs = this_pathname.split('/');
	
	// filename is last element
	return dirs[dirs.length-1];	
}

function setBookmark( this_location ) {

	// bail early if CDROM
	if ( CDROM ) { return; }	
	
	var filename = getFilename( this_location ); 
	
	// set lesson location value 
	setLessonLocation( filename );
	
	// set current value to suspend in case they leave.
	LMSSetValue( "cmi.core.exit", "suspend" );
}

function returnToBookmark( lastpage ) {

	// bail early if CDROM
	if ( CDROM ) { return; }

	var this_location = window.location;
	
	var this_pathname = this_location.pathname;
	var new_pathname  = "";
	
	
	// split on /
	var dirs = this_pathname.split('/');
	
	// set filename (last value) to the lastpage we got
	dirs[dirs.length-1] = lastpage;
	
	for ( var i=0; i < dirs.length; i++ ) {
	
		new_pathname = new_pathname  + "/" + dirs[i];
	}
	// remove first character
	new_pathname = new_pathname.slice(1);
	
	//alert2( this_pathname + "\n" + new_pathname );
	
	// set the location parameter with the new pathname
	// and apparently jump to the page
	this_location.pathname = new_pathname;
}


// -----------SUSPEND DATA-------------
function getSuspendData() {

	if ( CDROM ) { return; }

	return LMSGetValue( "cmi.suspend_data" );
}


function setSuspendData( data ) {

	if ( CDROM ) { return; }
	//alert( "setting suspend data of \n" + data );
	
	LMSSetValue( "cmi.suspend_data", data );
	LMSCommit();       
}

// ------------SCORE----------------    

function setScore( score, flag ) {	

	// bail early if CDROM
	if ( CDROM ) { return; }
			
	// the value must be sent as a string... so try eval ing it.
	//LMSSetValue( "cmi.core.score.raw", score.toString() );
	
	// get any existing score
	var oldScoreRaw = LMSGetValue( "cmi.core.score.raw" );
	
	// only update if they have a score that's bigger than the old one
	if ((oldScoreRaw < score) || (oldScoreRaw == null)) {
		LMSSetValue( "cmi.core.score.raw", score );
		
		
	
		// if they have send the passfail flag,
		// then use a FIXED mastery score
		// and set lesson_status as well.
		if ( flag == "passfail" ) {
			if ( score >= 70 ) {
				setLessonStatus( "passed" );
			}
		}			
		
		// and commit to the LMS
		LMSCommit();
	
		if ( DEBUG ) {
			alert( "Set score of\n" + score );  
		}
	
	} else {
		if ( DEBUG ) {
			alert( "Keeping old score of " + oldScoreRaw + 
				   " since it's bigger than the new score of " + score );
			
		}
	}
}
	
	
function getScore() {

	// bail early if CDROM
	if ( CDROM ) { return; }

	var scoreRaw, scoreMax, scoreMin;
	var coreChildren = LMSGetValue( "cmi.core._children");
	
	if ( coreChildren.indexOf("score" ) != -1) {
		var scoreChildren = LMSGetValue( "cmi.core.score._children" );
	  
		if ( scoreChildren.indexOf("min") != -1 ) {
			scoreMin = LMSGetValue( "cmi.core.score.min");
		}
		if (scoreChildren.indexOf("max") != -1 ) {
			scoreMax = LMSGetValue( "cmi.core.score.max");
		}
	}  
	scoreRaw = LMSGetValue( "cmi.core.score.raw" );
	
	return scoreRaw();
}

function debugScore () {

	// bail early if CDROM
	if ( CDROM ) { return; }

	var scoreRaw, scoreMax, scoreMin, masteryScore;
	
	scoreMin = LMSGetValue( "cmi.core.score.min");	
	scoreMax = LMSGetValue( "cmi.core.score.max");
	scoreRaw = LMSGetValue( "cmi.core.score.raw" );
	
	
	var student_dataChildren = LMSGetValue( "cmi.student_data._children");
	
	if ( student_dataChildren.indexOf("mastery_score" ) != -1) {
		masteryScore = LMSGetValue( "cmi.student_data.mastery_score" );
	} else {
		masteryScore = "undefined";
	}	
	
	alert( "Scores:\nraw: " + scoreRaw + "\nmax: " + scoreMax + "\nmin: " + scoreMin + "\nMastery: " + masteryScore );
}




//=====================================================
// error reporting function
function error_report( note ) {

	// bail early if CDROM
	if ( CDROM ) { return; }

	if ( DEBUG == 0 ) { return; }
	count++;

	var lastError  = LMSGetLastError();

	if (lastError != 0 ) {
	
		var errorStr   = LMSGetErrorString( lastError );
		var diagnostic = LMSGetDiagnostic( lastError )
	
		// open the window
		w = window.open(	"", 
							"LMS_support" + count, 
							"resizable=1,toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,copyhistory=0,width=400,height=300");
		
		// write to it
		w.document.open();
		w.document.writeln("<html><head><title>LMS SCORM Error</title>");
		w.document.writeln("</head><body><h2>" + note + "</h2>");
		w.document.writeln("<p>error code: " + lastError );
		w.document.writeln("<p>error string: " + errorStr );
		w.document.writeln("<p>diagnostic: " + diagnostic );
		w.document.writeln("</body></html>");
		w.document.close();
		
		// bring it to the front
		w.focus();
	}

}

//=====================================================
// error reporting function
function alert2( note ) {

	if ( DEBUG == 0 ) { return; }
	
	// open the window
	w = window.open(	"", 
						"LMS_support" + count, 
						"resizable=1,toolbar=0,location=0,directories=0,status=1,menubar=0,scrollbars=1,copyhistory=0,width=400,height=300");
	
	// write to it
	w.document.open();
	w.document.writeln("<html><head><title>LMS SCORM Error</title>");
	w.document.writeln("</head><body>");
	w.document.writeln("<p>" + note );
	w.document.writeln("</body></html>");
	w.document.close();
	
	// bring it to the front
	w.focus();
}
