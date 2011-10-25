
<SCRIPT LANGUAGE=JavaScript>
<!--
var InternetExplorer = navigator.appName.indexOf("Microsoft") != -1;
// Handle all the the FSCommand messages in a Flash movie
function chat_DoFSCommand(command, args) {
  var chatObj = InternetExplorer ? chat : document.chat;
  //
  // Place your code here...
  //
}
// Hook for Internet Explorer 
if (navigator.appName && navigator.appName.indexOf("Microsoft") != -1 && 
	  navigator.userAgent.indexOf("Windows") != -1 && navigator.userAgent.indexOf("Windows 3.1") == -1) {
	document.write('<SCRIPT LANGUAGE=VBScript\> \n');
	document.write('on error resume next \n');
	document.write('Sub chat_FSCommand(ByVal command, ByVal args)\n');
	document.write('  call chat_DoFSCommand(command, args)\n');
	document.write('end sub\n');
	document.write('</SCRIPT\> \n');
}

function push()
{
window.document.chat.SetVariable("chat_dir", "<?=$web_dir;?>chat/");
window.document.chat.SetVariable("username", "<?=$lms_username;?>");
//alert("I am called");
}
//-->
</SCRIPT>
<B>Chat Object:</B> <I>(You may need to clear your browser cache for this to work)</I>
<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" ID=chat WIDTH="500" HEIGHT="300" ALIGN="">
<PARAM NAME=movie VALUE="<?=$web_dir?>/chat/chat.swf"> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#FFFFFF> <EMBED src="<?=$web_dir?>/chat/chat.swf" quality=high bgcolor=#FFFFFF  WIDTH="500" HEIGHT="300" swLiveConnect=true ID=chat NAME=rchat ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
</OBJECT>
