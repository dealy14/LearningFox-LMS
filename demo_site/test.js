var _Debug = false; // set this to false to turn debugging off
// and get rid of those annoying alert boxes.
// Define exception/error codes
var _NoError = 0;
var _GeneralException = 101;
var _ServerBusy = 102;
var _InvalidArgumentError = 201;
var _ElementCannotHaveChildren = 202;
var _ElementIsNotAnArray = 203;
var _NotInitialized = 301;
var _NotImplementedError = 401;
var _InvalidSetValue = 402;
var _ElementIsReadOnly = 403;
var _ElementIsWriteOnly = 404;
var _IncorrectDataType = 405;
// local variable definitions
var apiHandle = null;
var api = null;
var findAPITries = 0;
var startDate;
var exitPageStatus;
/***********************************************************************
********
**
** Function: doLMSInitialize()
** Inputs: None
** Return: CMIBoolean true if the initialization was successful, or
** CMIBoolean false if the initialization failed.
**
** Description:
** Initialize communication with LMS by calling the LMSInitialize
** function which will be implemented by the LMS.
**
************************************************************************
*******/
function doLMSInitialize()
{
var api = getAPIHandle();
if (api == null)
{alert("Unable to locate the LMS's API Implementation.\nLMSInitialize was not successful.");
return "false";
}
var result = api.LMSInitialize("");
if (result.toString() != "true")
{
var err = ErrorHandler();
}
startTimer();
return result.toString();
}
/***********************************************************************
********
**
** Function doLMSFinish()
** Inputs: None
** Return: CMIBoolean true if successful
** CMIBoolean false if failed.
**
** Description:
** Close communication with LMS by calling the LMSFinish
** function which will be implemented by the LMS
**
************************************************************************
*******/
function doLMSFinish()
{
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nLMSFinish was not successful.");
return "false";
}else
{
elapsedTime();
result = doLMSCommit();
// call the LMSFinish function that should be implemented by the API
var result = api.LMSFinish("");
if (result.toString() != "true")
{
var err = ErrorHandler();
}
}
return result.toString();
}
/***********************************************************************
********
**
** Function doLMSGetValue(name)
** Inputs: name - string representing the cmi data model defined category or
** element (e.g. cmi.core.student_id)
** Return: The value presently assigned by the LMS to the cmi data model
** element defined by the element or category identified by the name
** input value.
**
** Description:
** Wraps the call to the LMS LMSGetValue method
**
************************************************************************
*******/
function doLMSGetValue(name)
{
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nLMSGetValue was not successful.");
return "";
}
else
{
var value = api.LMSGetValue(name);
var errCode = api.LMSGetLastError().toString();
if (errCode != _NoError)
{
// an error was encountered so display the error description
var errDescription = api.LMSGetErrorString(errCode);
alert("LMSGetValue("+name+") failed. \n"+ errDescription);
return "";
}
else
{
return value.toString();
}
}
}
/***********************************************************************
********
**
** Function doLMSSetValue(name, value)
** Inputs: name -string representing the data model defined category or element
** value -the value that the named element or category will be assigned
** Return: CMIBoolean true if successful
** CMIBoolean false if failed.
**
** Description:
** Wraps the call to the LMS LMSSetValue function
**
************************************************************************
*******/
function doLMSSetValue(name, value)
{
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nLMSSetValue was not successful.");
return;
}
else
{
var result = api.LMSSetValue(name, value);
if (result.toString() != "true")
{
var err = ErrorHandler();
}
}
return;
}
/***********************************************************************
********
**
** Function doLMSCommit()
** Inputs: None
** Return: None
**
** Description:
** Call the LMSCommit function
**
************************************************************************
*******/
function doLMSCommit()
{
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nLMSCommit was not successful.");
return "false";
}
else
{
var result = api.LMSCommit("");
if (result != "true")
{
var err = ErrorHandler();
}
}
return result.toString();
}
/***********************************************************************
********
**
** Function doLMSGetLastError()
** Inputs: None
** Return: The error code that was set by the last LMS function call
**
** Description:
** Call the LMSGetLastError function
**
************************************************************************
*******/
function doLMSGetLastError()
{
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nLMSGetLastError was not successful.");
//since we can't get the error code from the LMS, return a general error
return _GeneralError;
}
return api.LMSGetLastError().toString();
}
/***********************************************************************
********
**
** Function doLMSGetErrorString(errorCode)
** Inputs: errorCode - Error Code
** Return: The textual description that corresponds to the input error code
**
** Description:
** Call the LMSGetErrorString function
**
************************************************************************
********/
function doLMSGetErrorString(errorCode)
{
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nLMSGetErrorString was not successful.");
}
return api.LMSGetErrorString(errorCode).toString();
}
/***********************************************************************
********
**
** Function doLMSGetDiagnostic(errorCode)
** Inputs: errorCode - Error Code(integer format), or null
** Return: The vendor specific textual description that corresponds to the
** input error code
**
** Description:
** Call the LMSGetDiagnostic function
**
************************************************************************
*******/
function doLMSGetDiagnostic(errorCode)
{
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nLMSGetDiagnostic was not successful.");
}
return api.LMSGetDiagnostic(errorCode).toString();
}
/***********************************************************************
********
**
** Function LMSIsInitialized()
** Inputs: none
** Return: true if the LMS API is currently initialized, otherwise false
**
** Description:
** Determines if the LMS API is currently initialized or not.
**
************************************************************************
*******/
function LMSIsInitialized()
{
// there is no direct method for determining if the LMS API is initialized
// for example an LMSIsInitialized function defined on the API so we'll try
// a simple LMSGetValue and trap for the LMS Not Initialized Error
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nLMSIsInitialized() failed.");
return false;
}
else
{
var value = api.LMSGetValue("cmi.core.student_name");
var errCode = api.LMSGetLastError().toString();
if (errCode == _NotInitialized)
{
return false;
}
else
{
return true;
}
}
}
/***********************************************************************
********
**
** Function ErrorHandler()
** Inputs: None
** Return: The current value of the LMS Error Code
**
** Description:
** Determines if an error was encountered by the previous API call
** and if so, displays a message to the user. If the error code
** has associated text it is also displayed.
**
************************************************************************
*******/
function ErrorHandler()
{
var api = getAPIHandle();
if (api == null)
{
alert("Unable to locate the LMS's API Implementation.\nCannot determine LMS error code.");
return;
}
// check for errors caused by or from the LMS
var errCode = api.LMSGetLastError().toString();
if (errCode != _NoError)
{
// an error was encountered so display the error description
var errDescription = api.LMSGetErrorString(errCode);
if (_Debug == true)
{
errDescription += "\n";
errDescription += api.LMSGetDiagnostic(null);
// by passing null to LMSGetDiagnostic, we get any available diagnostics
// on the previous error.
}
alert(errDescription);
}
return errCode;
}
/***********************************************************************
*******
**
** Function getAPIHandle()
** Inputs: None
** Return: value contained by APIHandle
**
** Description:
** Returns the handle to API object if it was previously set,
** otherwise it returns null
**
************************************************************************
*******/
function getAPIHandle()
{
if (apiHandle == null)
{
apiHandle = getAPI();
}
return apiHandle;
}
//######################################################################
###########
// END OF CUSTOM FUNCTIONS
//######################################################################
###########
// -----------------------------------------------------------------
var InternetExplorer = navigator.appName.indexOf("Microsoft") != -1;
var findAPITries = 0;
function findAPI(win)
{
// Check to see if the window (win) contains the API
// if the window (win) does not contain the API and
// the window (win) has a parent window and the parent window
// is not the same as the window (win)
while ( (win.API == null) && (win.parent != null) && (win.parent != win) )
{
// increment the number of findAPITries
findAPITries++;
// Note: 7 is an arbitrary number, but should be more than sufficient
if (findAPITries > 7)
{
alert("Error finding API -- too deeply nested.");
return null;
}
// set the variable that represents the window being
// being searched to be the parent of the current window
// then search for the API again
win = win.parent;
}
return win.API;
}
function getAPI()
{
// start by looking for the API in the current window
var theAPI = findAPI(window);
// if the API is null (could not be found in the current window)
// and the current window has an opener window
if ( (theAPI == null) &&
(window.opener != null) &&
(typeof(window.opener) != "undefined") )
{
// try to find the API in the current window's opener
theAPI = findAPI(window.opener);
}
// if the API has not been found
if (theAPI == null)
{
// Alert the user that the API Adapter could not be found
alert("Unable to find an API adapter");
}
return theAPI;
}
var api = getAPI();
// make sure status conforms to scorm standards
function normalizeStatus(status)
{
switch (status.toUpperCase().charAt(0))
{
case 'C': return "completed";
case 'I': return "incomplete";
case 'N': return "not attempted";
case 'F': return "failed";
case 'P': return "passed";
}
return status;
}
// make sure the question type conforms to scorm standards
function normalizeType(theType)
{
switch (theType.toUpperCase().charAt(0))
{
case 'T': return "true-false";
case 'C': return "choice";
case 'F': return "fill-in";
case 'M': return "matching";
case 'P': return "peformance";
case 'S': return "sequencing";
case 'L': return "likert";
case 'N': return "numeric";
}
return theType;
}
// make sure the question result conforms to scorm standards
function normalizeResult(result)
{
switch (result.toUpperCase().charAt(0))
{
case 'C': return "correct";
case 'W': return "wrong";
case 'U': return "unanticipated";
case 'N': return "neutral";
}
return result;
}
function startTimer()
{
startDate = new Date().getTime();
}
function elapsedTime()
{
if ( startDate != 0 )
{
var currentDate = new Date().getTime();
var elapsedSeconds = ( (currentDate - startDate) / 1000 );
var formattedTime = convertTotalSeconds( elapsedSeconds );
}
else
{
formattedTime = "00:00:00.0";
}
doLMSSetValue( "cmi.core.session_time", formattedTime );
}
/***********************************************************************
********
** this function will convert seconds into hours, minutes, and seconds in
** CMITimespan type format - HHHH:MM:SS.SS (Hours has a max of 4 digits &
** Min of 2 digits
************************************************************************
*******/
function convertTotalSeconds(ts)
{
var sec = (ts % 60);
ts -= sec;
var tmp = (ts % 3600); //# of seconds in the total # of minutes
ts -= tmp; //# of seconds in the total # of hours
// convert seconds to conform to CMITimespan type (e.g. SS.00)
sec = Math.round(sec*100)/100;
var strSec = new String(sec);
var strWholeSec = strSec;
var strFractionSec = "";
if (strSec.indexOf(".") != -1)
{
strWholeSec = strSec.substring(0, strSec.indexOf("."));
strFractionSec = strSec.substring(strSec.indexOf(".")+1, strSec.length);
}
if (strWholeSec.length < 2)
{
strWholeSec = "0" + strWholeSec;
}
strSec = strWholeSec;
if (strFractionSec.length)
{
strSec = strSec+ "." + strFractionSec;
}
if ((ts % 3600) != 0 )
var hour = 0;
else var hour = (ts / 3600);
if ( (tmp % 60) != 0 )
var min = 0;
else var min = (tmp / 60);
if ((new String(hour)).length < 2)
hour = "0"+hour;
if ((new String(min)).length < 2)
min = "0"+min;
var rtnVal = hour+":"+min+":"+strSec;
return rtnVal;
}