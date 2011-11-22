function tick()
{
var hours, minutes, seconds, ap;
var intHours, intMinutes, intSeconds;
var today;
today = new Date();
intHours = today.getHours();
intMinutes = today.getMinutes();
intSeconds = today.getSeconds();
if (intHours == 0)
{
hours = "12:";
//ap = "It's midnight";
}
else if (intHours < 12) 
{
hours = intHours+":";
//ap = " AM";
}
else if (intHours == 12)
{
hours = "12:";
//ap = "It's noon";
} else
{
intHours = intHours - 12
hours = intHours + ":";
//ap = " PM";
}

if (intMinutes < 10)
 {
minutes = "0"+intMinutes+":";
} else {
minutes = intMinutes+":";
}
if (intSeconds < 10) {
seconds = "0"+intSeconds+" ";
} else {
seconds = intSeconds+" ";
}
timeString1 = fun1();
timeString = hours+minutes+seconds;//+ap;
Clock.innerHTML = timeString1 + "&nbsp;&nbsp;" + timeString;
window.setTimeout("tick();", 100);
}
<body>
</body>