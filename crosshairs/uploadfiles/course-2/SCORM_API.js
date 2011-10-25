var g_bShowApiErrors = true; // change to false to show no error messages
var g_strAPINotFound = "Management system interface not found.";
var g_strAPITooDeep = "Cannot find API - too deeply nested.";
var g_strAPIInitFailed = "Found API but LMSInitialize failed.";
var g_strAPISetError = "Trying to set value but API not available.";
var g_strDisableErrorMsgs = "Select cancel to disable future warnings.";
var g_bSetCompletedAutomatically = true;

var g_nFindAPITries = 0;
var g_objAPI = null;
var g_bInitDone = false;
var g_bFinishDone = false;



function FindAPI(win) {
	while ((win.API == null) && (win.parent != null) && (win.parent != win)) {
		g_nFindAPITries ++;
		if (g_nFindAPITries > 500) {
			AlertUserOfAPIError(g_strAPITooDeep);
			return null;
		}
		win = win.parent;
	}
	return win.API;
}


function AlertUserOfAPIError(strText) {
	if (g_bShowApiErrors) {
		var s = strText + "\n\n" + g_strDisableErrorMsgs;
		if (!confirm(s)){
			g_bShowApiErrors = false
		}
	}
}

function APIOK() {
	return ((typeof(g_objAPI)!= "undefined") && (g_objAPI != null))
}

function LMS_SCOInitialize() {
	var err = true;
	if (!g_bInitDone) {
		if ((window.parent) && (window.parent != window)){
			g_objAPI = FindAPI(window.parent)
		}
		if ((g_objAPI == null) && (window.opener != null))	{
			g_objAPI = FindAPI(window.opener)
		}
		if ((g_objAPI == null))
			g_objAPI = FindAPI(window)
			
		if (!APIOK()) {
			AlertUserOfAPIError(g_strAPINotFound);
			err = false
		} else {
			err =  g_objAPI.LMSInitialize("");
			if (err == "true") {
				if (g_objAPI.LMSGetValue("cmi.core.lesson_status") == "not attempted")
					err =  g_objAPI.LMSSetValue("cmi.core.lesson_status","incomplete")
			} else {
				AlertUserOfAPIError(g_strAPIInitFailed)
			}
		}
	}
	g_bInitDone = true;
	return (err + "") // Force type to string
}    


function LMS_SCOFinish() {
	if ((APIOK()) && (g_bFinishDone == false)) {
		if (g_bSetCompletedAutomatically){
			LMS_SCOSetStatusCompleted();
		}
		g_bFinishDone = (g_objAPI.LMSFinish("") == "true");
	}
	return (g_bFinishDone + "" ) // Force type to string
}


function LMS_SCOSetStatusCompleted(){
	var stat = LMS_SCOGetValue("cmi.core.lesson_status");
		if ((stat!="completed") && (stat != "passed") && (stat != "failed")){
			return LMS_SCOSetValue("cmi.core.lesson_status","completed")
		}
}


function LMS_SCOGetValue(nam)	{return ((APIOK())?g_objAPI.LMSGetValue(nam.toString()):"")}

function LMS_SCOSetValue(nam,val){
	var err = "";
	if (!APIOK()){
			AlertUserOfAPIError(g_strAPISetError + "\n" + nam + "\n" + val);
			err = "false"
	}
	if (err == ""){
			err =  g_objAPI.LMSSetValue(nam,val.toString() + "");
			if (err != "true") return err
	}
	return err
}