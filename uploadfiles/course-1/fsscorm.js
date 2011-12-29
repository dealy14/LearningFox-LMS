	var InternetExplorer = navigator.appName.indexOf("Microsoft") != -1;

	// define global var as handle to API object
	var mm_adl_API = null;

	// mm_getAPI, which calls findAPI as needed
	function mm_getAPI()
	{
		var myAPI = null;
		var tries = 0, triesMax = 50;
		while (tries < triesMax && myAPI == null)
		{
			window.status = 'Looking for API object ' + tries + '/' + triesMax;
			
			myAPI = findAPI(window);
			if (myAPI == null && typeof(window.parent) != 'undefined')
				myAPI = findAPI(window.parent)
			if (myAPI == null && typeof(window.top) != 'undefined')
				myAPI = findAPI(window.top);
			if (myAPI == null && typeof(window.opener) != 'undefined')
			{
				if (window.opener != null && !window.opener.closed)
				{
					myAPI = findAPI(window.opener);
				}
			}
				
			tries++;
		}
		if (myAPI == null)
		{
			window.status = 'API not found';
		}
		else
		{
			mm_adl_API = myAPI;
			window.status = 'API found';
		}
	}

	// returns LMS API object (or null if not found)
	function findAPI(win)
	{
		// look in this window
		if (typeof(win) != 'undefined' ? typeof(win.API) != 'undefined' : false)
		{
			if (win.API != null )
			  return win.API;
		}
		
		// look in this window's frameset kin (except opener)
		for (var i = 0 ; i < win.frames.length ; i++);
		{
			if (typeof(win.frames[i]) != 'undefined' ? typeof(win.frames[i].API) != 'undefined' : false)
			{
				if (win.frames[i].API != null)
				  return win.frames[i].API;
			}
		}

		// look in all parents of this window
		while (win.API == null &&
			win != null &&
			win.parent != null &&
			win.parent != win)
		{
			win = win.parent;
		}

		return win.API;
	}

	// call LMSInitialize()
	function mm_adlOnload()
	{
		if (mm_adl_API != null)
		{
			mm_adl_API.LMSInitialize("");
		}
	}

	// call LMSFinish()
	function mm_adlOnunload()
	{
		if (mm_adl_API != null)
		{
			mm_adl_API.LMSSetValue("cmi.core.lesson_status", "incomplete");
			mm_adl_API.LMSSetValue("cmi.core.exit", "suspend");
			mm_adl_API.LMSCommit("");		
			mm_adl_API.LMSFinish("");
		}
	}

	// make sure status conforms to scorm standards
	function normalizeStatus(status)
		{
		switch (status.toUpperCase().charAt(0))
			{
			case 'C':	return "completed";
			case 'I':	return "incomplete";
			case 'N':	return "not attempted";
			case 'F':	return "failed";
			case 'P':	return "passed";
			}
		return status;
		}
	
	var InternetExplorer = navigator.appName.indexOf("Microsoft") != -1;

	// Handle all the the FSCommand messages in a Flash movie
	function objFlash_DoFSCommand(command, args) 
	{
		var objFlashObj = InternetExplorer ? objFlash : document.objFlash;
		
		args = String(args);
		command = String(command);
		var F_intData = args.split("::");

		if (command == "wc") { 
			window.close();
		}

		// check for existence of scorm api
		if (mm_adl_API == null)
			return;
		
		switch (command)
			{
			case "MM_StartSession" :
				break;
			
			case "Debug":
				window.alert(F_intData[0]);
				window.top.close();
				break;
				
			case "Failed to Load":
				window.alert(F_intData[0]);
				window.top.close();
				break;
				
			case "Failed search":
				window.alert(F_intData[0]);
				window.top.close();
				break;
				
			case "MM_cmiSendObjectiveInfo" :
				var n = F_intData[0];
				mm_adl_API.LMSSetValue("cmi.objectives." + n + ".id", F_intData[1]);
				mm_adl_API.LMSSetValue("cmi.objectives." + n + ".score.raw", F_intData[2]);
				mm_adl_API.LMSSetValue("cmi.objectives." + n + ".status", normalizeStatus(F_intData[3]));
				mm_adl_API.LMSCommit("");
				break;
				
			case "MM_cmiSendProgressStatus" :
				mm_adl_API.LMSSetValue("cmi.objectives.0.id", "Progress");
				mm_adl_API.LMSSetValue("cmi.objectives.0.score.raw", F_intData[0]);
				mm_adl_API.LMSSetValue("cmi.objectives.0.score.max", F_intData[1]);
				mm_adl_API.LMSCommit("");
				break;
				
			case "MM_cmiSendInteractions" :
				var n = F_intData[0];
				mm_adl_API.LMSSetValue("cmi.interactions." + n + ".id", F_intData[1]);
				mm_adl_API.LMSSetValue("cmi.interactions." + n + ".student_response", F_intData[2]);
				mm_adl_API.LMSSetValue("cmi.interactions." + n + ".result", F_intData[3]);
				mm_adl_API.LMSCommit("");
				break;
				
			case "CMISetScore":
			case "MM_cmiSendScore" :
				mm_adl_API.LMSSetValue("cmi.core.score.raw", F_intData[0]);
				mm_adl_API.LMSSetValue("cmi.core.score.max", "100");
				mm_adl_API.LMSCommit("");
				break;
				
			case "CMISetStatus":
			case "MM_cmiSetLessonStatus" :
				mm_adl_API.LMSSetValue("cmi.core.lesson_status", normalizeStatus(F_intData[0]));
				mm_adl_API.LMSCommit("");
				break;
				
			case "CMISetExitStatus":
				mm_adl_API.LMSSetValue("cmi.core.exit", F_intData[0]);
				break;
				
			case "CMISetTime" :
				mm_adl_API.LMSSetValue("cmi.core.session_time", F_intData[0]);
				break;
			
			case "CMISetCompleted" :
				mm_adl_API.LMSSetValue("cmi.core.lesson_status", "completed");
				break;
			
			case "CMISetStarted" :
				mm_adl_API.LMSSetValue("cmi.core.lesson_status", "incomplete");
				break;
				
			case "CMISetPassed":
				mm_adl_API.LMSSetValue("cmi.core.lesson_status", "passed");
				break;
				
			case "CMISetFailed":
				mm_adl_API.LMSSetValue("cmi.core.lesson_status", "failed");
				break;
				
			case "CMISetLocation":
				mm_adl_API.LMSSetValue("cmi.core.lesson_location",F_intData[0]);
				break;
				
			case "CMISetSuspendData":
				{
					switch (F_intData.length)
					{
					case 1:
						mm_adl_API.LMSSetValue("cmi.suspend_data", F_intData[0]);
						break;
					case 2:
						mm_adl_API.LMSSetValue("cmi.suspend_data", F_intData[0] + "::" + F_intData[1]);
						break;
					case 3:
						mm_adl_API.LMSSetValue("cmi.suspend_data", F_intData[0] + "::" + F_intData[1] + "::" + F_intData[2]);
						break;
					case 4:
					default:
						mm_adl_API.LMSSetValue("cmi.suspend_data", F_intData[0] + "::" + F_intData[1] + "::" + F_intData[2] + "::" + F_intData[3]);
						break;
					}
				}
				mm_adl_API.LMSCommit("");
				break;
				
			case "CMISetTimedOut":
				mm_adl_API.LMSSetValue("cmi.core.exit", "time-out");
				break;
			
			case "CMIInitialize":
				mm_adl_API.LMSInitialize(args);
				break;
			
			case "CMIFinish":
				mm_adl_API.LMSCommit("");
				mm_adl_API.LMSFinish("");
				break;
				
			case "CMIExitAU":
				window.top.close();
				break;
			}
		// END OF CMI FUNCTION MAPPING
	}

// get the API
mm_getAPI();
