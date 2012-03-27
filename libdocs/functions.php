<?php

if (function_exists('register_sidebars')) {

	register_sidebars(1, array(

		'before_widget' => '<!--- BEGIN Widget --->',

		'before_title' => '<!--- BEGIN WidgetTitle --->',

		'after_title' => '<!--- END WidgetTitle --->',

		'after_widget' => '<!--- END Widget --->'

	));

}



function art_normalize_widget_style_tokens($content) {

	$bw = '<!--- BEGIN Widget --->';

	$bwt = '<!--- BEGIN WidgetTitle --->';

	$ewt = '<!--- END WidgetTitle --->';

	$bwc = '<!--- BEGIN WidgetContent --->';

	$ewc = '<!--- END WidgetContent --->';

	$ew = '<!--- END Widget --->';

	$result = '';

	$startBlock = 0;

	$endBlock = 0;

	while (true) {

		$startBlock = strpos($content, $bw, $endBlock);

		if (false === $startBlock) {

			$result .= substr($content, $endBlock);

			break;

		}

		$result .= substr($content, $endBlock, $startBlock - $endBlock);

		$endBlock = strpos($content, $ew, $startBlock);

		if (false === $endBlock) {

			$result .= substr($content, $endBlock);

			break;

		}

		$endBlock += strlen($ew);

		$widgetContent = substr($content, $startBlock, $endBlock - $startBlock);

		$beginTitlePos = strpos($widgetContent, $bwt);

		$endTitlePos = strpos($widgetContent, $ewt);

		if ((false == $beginTitlePos) xor (false == $endTitlePos)) {

			$widgetContent = str_replace($bwt, '', $widgetContent);

			$widgetContent = str_replace($ewt, '', $widgetContent);

		} else {

			$beginTitleText = $beginTitlePos + strlen($bwt);

			$titleContent = substr($widgetContent, $beginTitleText, $endTitlePos - $beginTitleText);

			if ('&nbsp;' == $titleContent) {

				$widgetContent = substr($widgetContent, 0, $beginTitlePos)

					. substr($widgetContent, $endTitlePos + strlen($ewt));

			}

		}

		if (false === strpos($widgetContent, $bwt)) {

			$widgetContent = str_replace($bw, $bw . $bwc, $widgetContent);

		} else {

			$widgetContent = str_replace($ewt, $ewt . $bwc, $widgetContent);

		}

		$result .= str_replace($ew, $ewc . $ew, $widgetContent);

	}

	return $result;

}



function art_sidebar($index = 1)

{

	if (!function_exists('dynamic_sidebar')) return false;

	ob_start();

	$success = dynamic_sidebar($index);

	$content = ob_get_clean();

	if (!$success) return false;

	$content = art_normalize_widget_style_tokens($content);

	$replaces = array(

		'<!--- BEGIN Widget --->' => "\r\n<div class=\"Block\">\r\n  <div class=\"Block-body\">\r\n",

		'<!--- BEGIN WidgetTitle --->' => "<div class=\"BlockHeader\">\r\n",

		'<!--- END WidgetTitle --->' => "\r\n  <div class=\"l\"></div>\r\n  <div class=\"r\"><div></div></div>\r\n</div>\r\n",

		'<!--- BEGIN WidgetContent --->' => "\r\n<div class=\"BlockContent\">\r\n  <div class=\"BlockContent-body\">\r\n",

		'<!--- END WidgetContent --->' => "\r\n  </div>\r\n  <div class=\"BlockContent-tl\"></div>\r\n  <div class=\"BlockContent-tr\"><div></div></div>\r\n  <div class=\"BlockContent-bl\"><div></div></div>\r\n  <div class=\"BlockContent-br\"><div></div></div>\r\n  <div class=\"BlockContent-tc\"><div></div></div>\r\n  <div class=\"BlockContent-bc\"><div></div></div>\r\n  <div class=\"BlockContent-cl\"><div></div></div>\r\n  <div class=\"BlockContent-cr\"><div></div></div>\r\n  <div class=\"BlockContent-cc\"></div>\r\n</div>\r\n",

		'<!--- END Widget --->' => "\r\n  </div>\r\n  <div class=\"Block-tl\"></div>\r\n  <div class=\"Block-tr\"><div></div></div>\r\n  <div class=\"Block-bl\"><div></div></div>\r\n  <div class=\"Block-br\"><div></div></div>\r\n  <div class=\"Block-tc\"><div></div></div>\r\n  <div class=\"Block-bc\"><div></div></div>\r\n  <div class=\"Block-cl\"><div></div></div>\r\n  <div class=\"Block-cr\"><div></div></div>\r\n  <div class=\"Block-cc\"></div>\r\n</div>\r\n"

	);

	$bwt = '<!--- BEGIN WidgetTitle --->';

	$ewt = '<!--- END WidgetTitle --->';

	if ('' == $replaces[bwt] && '' == $replaces[$ewt]) {

		$startTitle = 0;

		$endTitle = 0;

		$result = '';

		while (true) {

			$startTitle = strpos($content, $bwt, $endTitle);

			if (false == $startTitle) {

				$result .= substr($content, $endTitle);

				break;

			}

			$result .= substr($content, $endTitle, $startTitle - $endTitle);

			$endTitle = strpos($content, $ewt, $startTitle);

			if (false == $endTitle) {

				$result .= substr($content, $startTitle);

				break;

			}

			$endTitle += strlen($ewt);

		}

		$content = $result;

	}

	$content = str_replace(array_keys($replaces), array_values($replaces), $content);



	echo $content;

	return true;

}



function art_list_pages_filter($output)

{

	$output = preg_replace('~<li([^>]*)><a([^>]*)>([^<]*)</a>~',

		'<li$1><a$2><span><span>$3</span></span></a>',

		$output);

	$re = '~<li class="([^"]*)(?: current_page_(?:ancestor|item|parent))+([^"]*)"><a ~';

	$output = preg_replace($re, '<li class="$1$2"><a class="active" ', $output, 1);

	$output = preg_replace($re, '<li class="$1$2"><a ', $output);

	return $output;

}



function art_header_page_list_filter($pages)

{

	$result = array();

	foreach ($pages as $page)

		if (0 == $page->post_parent)

			$result[] = $page;

	return $result;

}



function art_menu_items($hierarchy)

{

global $wpdb;

	ob_start();

	bloginfo('home');

	$home = ob_get_clean();
	

	if (!$hierarchy) add_action('get_pages', 'art_header_page_list_filter');

	add_action('wp_list_pages', 'art_list_pages_filter');

	wp_list_pages('title_li=&exclude=58,52,18,2,1492,566,645,706'); //645 - Poll Results //706 - Your Game Profile
	
	//Begin: Join Quiz
	
		$user_id = get_current_user_id();
		 echo '<li><a' . (is_page() ? '' : ' class="active"') . ' href="' . $home . '"><span><span>Home</span></span></a></li>';
		  echo '<li><a' . (is_page() ? '' : ' class="active"') . ' href="' . $home . '/my-quiz/"><span><span>Quiz</span></span></a></li>';
		   echo '<li><a' . (is_page() ? '' : ' class="active"') . ' href="' . $home . '/polls/"><span><span>Polls</span></span></a></li>';
	
	//wp_loginout();
	
if ( 0 == $user_id ) {
    // Not logged in.
    
    echo '<li><a href="http://www.americanrevolutionii.com/wp-login.php?action=register"><span><span>Register</span></span></a></li>';
    echo '<li><a href=" ' . wp_login_url() . '"><span><span>Login</span></span></a></li>';    
    
} else {

//$joined_game = $wpdb->get_row($wpdb->prepare("SELECT joined_game FROM {$wpdb->prefix}users WHERE ID=%d", $user_id));
$joined_game = $wpdb->get_var($wpdb->prepare("SELECT joined_game FROM wp_users WHERE ID=%d", $user_id));

//$user_details = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}users WHERE ID=%d", $user_id));
//echo 'joined_game: ' . $joined_game;
 
    
    if($joined_game == 0)
    {
      //echo "user_id:" . $user_id . '<li><a' . (is_page() ? '' : ' class="active"') . ' href="' . $home . '"><span><span>Home</span></span></a></li>';
      echo '<li><a' . (is_page() ? '' : ' class="active"') . ' href="' . $home . '/join-game/"><span><span>Join Game</span></span></a></li>';
    }
    else
    {
      echo '<li><a' . (is_page() ? '' : ' class="active"') . ' href="' . $home . '/FantasyPolitics/"><span><span>Fanta$y Politic$™</span></span></a></li>';
    }
    
    if (current_user_can('manage_options')) {    
      echo '<li><a' . (is_page() ? '' : ' class="active"') . ' href="' . $home . '/poll-results/"><span><span>Poll Results</span></span></a></li>';
    }
        
    echo '<li><a href="' . admin_url() . '"><span><span>Settings</span></span></a></li>';
    echo '<li><a href="' . wp_logout_url() . '"><span><span>Logout</span></span></a></li>';
}

//End: Join Quiz

//wp_register();



	
	echo
	'<li style="width: 100px; float:right;">
	
	<a href="https://twitter.com/AR2" class="twitter-follow-button" data-show-count="false">Follow @AR2</a><script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>
	
	</li>
	<li style="width: 80px; float: right;">
	<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.americanrevolutionii.com%2F&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>
	
</li>';



	remove_action('wp_list_pages', 'art_list_pages_filter');

	if (!$hierarchy) remove_action('get_pages', 'art_header_page_list_filter');

}

