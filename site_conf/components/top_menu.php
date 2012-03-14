<?php
/* Top Menu partial

 Required variables:
	$section
	$logout
    $sid
    $session_error

*/

?>
<table class="topnav" align="right" border="0" cellpadding="5">
<tbody>
<tr>
<?php
if($section != 'login' && $section != '' && $logout != 'YES')
{
	if(is_null($sid) or $session_error!="none")
	{
		?>
		<td class="topnav-link"><a href="index.html">Home</a></td>
		<td class="topnav-link" width="170"><a href="elearning.html">eLearning <br /></a></td>
		<td class="topnav-link"><a href="/services.htm">Consulting</a></td>                         
		<td class="topnav-link"><a href="faq.html">FAQ/Help</a></td>
		<td class="topnav-link"><a href="contact.html">Contact Us</a></td>
		<td class="topnav-link" id="loginState"><a href="index.php?section=login&sid=<?php echo $sid; ?>">Login</a></td>
<?php } else { ?>
		<td class="topnav-link" id="loginState">
			<a style="" href="index.php?section=<?php echo $section; ?>&logout=YES&sid=<?php echo $sid; ?>">
			Log out</a>
		</td>
		<?php 
		} 
	}
?>
</tr>
</tbody>
</table>