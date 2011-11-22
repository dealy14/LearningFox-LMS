<html>
<head>
<script type="text/javascript">
var secondsPerMinute = 60;
var minutesPerHour = 60;

function convertSecondsToHHMMSS(intSecondsToConvert) {
var hours = convertHours(intSecondsToConvert);
var minutes = getRemainingMinutes(intSecondsToConvert);
minutes = (minutes == 60) ? "00" : minutes;
var seconds = getRemainingSeconds(intSecondsToConvert);
if(String(hours).length<2){
	hours="0"+hours;
}
if(String(minutes).length<2){
	minutes="0"+minutes;
}
if(String(seconds).length<2){
	seconds="0"+seconds;
}
return hours+":"+minutes +":"+seconds;
}

function convertHours(intSeconds) {
var minutes = convertMinutes(intSeconds);
var hours = Math.floor(minutes/minutesPerHour);
return hours;
}
function convertMinutes(intSeconds) {
return Math.floor(intSeconds/secondsPerMinute);
}
function getRemainingSeconds(intTotalSeconds) {
return (intTotalSeconds%secondsPerMinute);
}
function getRemainingMinutes(intSeconds) {
var intTotalMinutes = convertMinutes(intSeconds);
return (intTotalMinutes%minutesPerHour);
}

function HMStoSec1(T) { // h:m:s
  var A = T.split(/\D+/) ; return (A[0]*60 + +A[1])*60 + +A[2] }

</script>
</head><body onLoad="">
<FORM name="clock">
 <FONT face="Courier New,Courier" size=4>
 <INPUT type="text"  name="digits"    size=8 maxlength=8 value="Loading" onKeyPress="">
 <script>
var time1 = HMStoSec1("10:00:00");
var time2 = HMStoSec1("12:05:00");
var diff = time2 - time1;
document.write(convertSecondsToHHMMSS(diff));
 </script>
 </FONT>
 </FORM>

</body></html>