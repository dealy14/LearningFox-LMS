<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="ddaccordion.js"></script>

<script type="text/javascript">

ddaccordion.init({
	headerclass: "headerbar", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
	defaultexpanded: [ ], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "normal", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script>

<style type="text/css">

.urbangreymenu{
width: 190px; /*width of menu*/
}

.urbangreymenu .headerbar{
font: bold 13px Verdana;
color: white;
background: #606060 no-repeat 8px 6px; /*last 2 values are the x and y coordinates of bullet image*/
margin-bottom: 0; /*bottom spacing between header and rest of content*/
padding: 7px 0 7px 10px; /*31px is left indentation of header text*/
}

.urbangreymenu .headerbar a{
text-decoration: none;
color: white;
display: block;
}

.urbangreymenu ul{
list-style-type: none;
margin: 0;
padding: 0;
margin-bottom: 0; /*bottom spacing between each UL and rest of content*/
}

.urbangreymenu ul li{
padding-bottom: 2px; /*bottom spacing between menu items*/
}

.urbangreymenu ul li a{
font: normal 12px Arial;
color: black;
background: #E9E9E9;
display: block;
padding: 5px 0;
line-height: 17px;
padding-left: 8px; /*link text is indented 8px*/
text-decoration: none;
}

.urbangreymenu ul li a:visited{
color: black;
}

.urbangreymenu ul li a:hover{ /*hover state CSS*/
color: white;
background:#CCCCCC;
}

</style>
<td id="ldcLCPageLeftNavTD" align="left" bgColor="#EAEBED" noWrap vAlign="top" width="180" style="padding-left:30px;">
	
	<table class="gs-box" border="0" cellpadding="3" cellspacing="5" width="190">

<tbody>

<tr>

<td class="gs-hdr" colspan="2"><a href="index.php?section=get_started" style="text-decoration:none;">Getting Started!</a></td></tr>

<tr>

<td class="gs-num" valign="top"><span style="color: #184a76;">1</span></td>

<td class="gs-txt" valign="top">Design Your Site<br /></td></tr>

<tr>

<td class="gs-num" valign="top"><span style="color: #184a76;">2</span></td>

<td class="gs-txt" valign="top">Load Your Users and Select Your Courses<br /></td></tr>

<tr>

<td class="gs-num" valign="top"><span style="color: #184a76;">3</span></td>

<td class="gs-txt" valign="top">Log In and Launch Your Course<br /></td></tr></tbody></table>

<!--<table class="leftnav" border="0" cellpadding="0" cellspacing="0" width="190">

     <tbody>

         <tr>

             <td class="leftnav-link">Tools and Resources</td>

         </tr>       

     </tbody>

</table>-->

<table class="leftnav" border="0" cellpadding="0" cellspacing="0" width="190">

<tbody>

<tr>

<td>
<div class="urbangreymenu">

<h3 class="headerbar" style="cursor:pointer;">My Personal eLearning</h3>
<ul class="submenu">
<li><a href="#">My Profile</a></li>
<li><a href="#">My courses scheduled/in progress</a></li>
<li><a href="#">My Completed Courses</a></li>
</ul>

<h3 class="headerbar" style="cursor:pointer;">My Team eLearning</h3>
<ul class="submenu">
<li><a href="#">Team Profile</a></li>
<li><a href="#">Courses Scheduled/Courses In-Progress</a></li>
<li><a href="#">Completed Courses</a></li>	
</ul>

<h3 class="headerbar" style="cursor:pointer;">Tools and Resources</h3>
<ul class="submenu">
<li><a href="#">Resources</a></li>
</ul>					
</div>
</td></tr>





<tr>

<td class="leftnav-link">&nbsp;</td></tr></tbody></table>

<table class="search-box" border="0" cellpadding="5" cellspacing="5" width="190">

<tbody>

<tr>

<td class="leftnav-link"><a href="#">Register as New User</a></td></tr>

<tr>

<td class="leftnav-link"><a href="#">Forgot password?</a></td>
</tr></tbody></table></td>