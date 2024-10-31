<?php
/*
Plugin Name: Wordpress Rate a Positive Post Plugin
Plugin URI: http://www.ambooba.com/plugins/wp_gz
Description: Rate post|page with a positive meter -> information automatically goes to ambooba.com|ambuba.ru|geroszinios.lt site where top post will become articles there
Version: 1.0
Author: marius2j	
Author URI: http://www.framework.lt
License: GPL2
*/

if( !function_exists('wp_gz_like_settings') )
{
	function wp_gz_like_settings ()
	{
		add_menu_page("Positive Article", "Positive Article", 8, basename(__FILE__), "wp_gz_like_opt");
	}
}

if ( !function_exists('wp_gz_like_opt') )
{
	function wp_gz_like_opt()
	{
	?>
	<div class="wrap">
	<div id="icon-themes" class="icon32"></div>
	<h2><strong>"Positive Article" Button Settings</strong></h2>
	
	<?php
	if(isset($_POST['wp_gz_form_submit']))
	{
		echo '<div style="color:green;font-weight:bold;background:#FFC;padding:4px;margin:2px 0;">"Positive Article" Settings were saved successfully!</div>';
	}
	?>
	
	<fieldset>
	<form name="wp_gz_option_form" method="post">
	
	<?php
		$wp_gz_show_front_page = get_option("wp_gz_show_front_page");
		$wp_gz_show_single = get_option("wp_gz_show_single");
		$wp_gz_show_page = get_option("wp_gz_show_page");
	  	if($wp_gz_show_front_page == '') { $wp_gz_show_front_page = 0; }
	  	if($wp_gz_show_single == '') { $wp_gz_show_single = 1; }
	  	if($wp_gz_show_page == '') { $wp_gz_show_page = 1; }
	?>
	<h2>Show in</h2>
	<input name="wp_gz_show_front_page" value="0" type="hidden"><input name="wp_gz_show_front_page" id="wp_gz_show_front_page" <?php echo $wp_gz_show_front_page ? 'checked="checked"' : '' ?> value="1" type="checkbox">
	<label for="wp_gz_show_front_page" class="label optional">Front page</label>
	
	<input name="wp_gz_show_single" value="0" type="hidden"><input name="wp_gz_show_single" id="wp_gz_show_single" <?php echo $wp_gz_show_single ? 'checked="checked"' : '' ?> value="1" type="checkbox">
	<label for="wp_gz_show_single" class="label optional">Posts</label>
	
	<input name="wp_gz_show_page" value="0" type="hidden"><input name="wp_gz_show_page" id="wp_gz_show_page" <?php echo $wp_gz_show_page ? 'checked="checked"' : '' ?> value="1" type="checkbox">
	<label for="wp_gz_show_page" class="label optional">Pages</label>
	
	
	<h2>Select button placement</h2>
	<select name="wp_gz_like_align" id="wp_gz_like_align">
		<option value="nb" <?php if ((get_option("wp_gz_like_align") == "nb") || (!get_option("wp_gz_like_align"))) echo ' selected'; ?>>None (Bottom)</option>
		<option value="nt" <?php if (get_option("wp_gz_like_align") == "nt") echo 'selected'; ?>>None (Top)</option>
		<option value="tl" <?php if (get_option("wp_gz_like_align") == "tl") echo 'selected'; ?>>Top Left</option>
		<option value="tr" <?php if (get_option("wp_gz_like_align") == "tr") echo 'selected'; ?>>Top Right</option>
		<option value="bl" <?php if (get_option("wp_gz_like_align") == "bl") echo 'selected'; ?>>Bottom Left</option>
		<option value="br" <?php if (get_option("wp_gz_like_align") == "br") echo 'selected'; ?>>Bottom Right</option>
	</select>
	
	<h2>Layout Style</h2>
	<div class="description">Determines the size and amount of social context next to the button</div>
	<select name="wp_gz_like_layout" id="wp_gz_like_layout">
		<option value="standard" <?php if (get_option("wp_gz_like_layout") == "standard") echo 'selected'; ?>>standard</option>
	</select>
	
	<?php
	$wp_gz_like_action = get_option("wp_gz_like_action");
	  	if($wp_gz_like_action == '') { $wp_gz_like_action = 'Įvertink straipsnio pozityvumą!'; }
	?>
	<h2>Text to display on hover</h2>
	<input name="wp_gz_like_action" id="wp_gz_like_action" value="<?php echo $wp_gz_like_action ?>" />
	
	<h2>Color Scheme</h2>
	<div class="description">The color scheme of the plugin (Default: light)</div>
	<select name="wp_gz_like_colorscheme" id="wp_gz_like_colorscheme">
		<option value="light" <?php if (get_option("wp_gz_like_colorscheme") == "light") echo 'selected'; ?>>light</option>
<!--		<option value="dark" <?php if (get_option("wp_gz_like_colorscheme") == "dark") echo 'selected'; ?>>dark</option>-->
	</select>
	
	<?php
	$wp_gz_like_width = get_option("wp_gz_like_width");
	  	if($wp_gz_like_width == '') { $wp_gz_like_width = '160'; }
		
	$wp_gz_like_height = get_option("wp_gz_like_height");
	  	if($wp_gz_like_height == '') { $wp_gz_like_height = '24'; }        
	?>
	
	<h2>Width</h2>
	<div class="description">Width of the button frame (Default: 160)</div>
	<input maxlength="4" size="1" type="text" name="wp_gz_like_width" id="wp_gz_like_width" value="<?= $wp_gz_like_width ?>">
	
	<h2>Height</h2>
	<div class="description">Height of the button frame (Default: 24)</div>
	<input maxlength="4" size="1" type="text" name="wp_gz_like_height" id="wp_gz_like_height" value="<?= $wp_gz_like_height ?>">
	
	
	<br />
	
	<input type="submit" value="Save Positive Article Settings" class="button-primary">
	<input type="hidden" name="wp_gz_form_submit" value="true" />
	</form>
	<br />
	<br />
	
	</fieldset>
	
	</div>
	
	<br />
	
	<?php
	}
}

if( !function_exists('wp_gz_like_update') )
{
	function wp_gz_like_update()
	{
		if(isset($_POST['wp_gz_form_submit']))
		{
			update_option("wp_gz_show_front_page", $_POST['wp_gz_show_front_page']);
			update_option("wp_gz_show_single", $_POST['wp_gz_show_single']);
			update_option("wp_gz_show_page", $_POST['wp_gz_show_page']);
			update_option("wp_gz_like_align", $_POST['wp_gz_like_align']);
			update_option("wp_gz_like_layout", $_POST['wp_gz_like_layout']);
			update_option("wp_gz_like_show_faces", $_POST['wp_gz_like_show_faces']);
			update_option("wp_gz_like_action", $_POST['wp_gz_like_action']);
			update_option("wp_gz_like_colorscheme", $_POST['wp_gz_like_colorscheme']);
			update_option("wp_gz_like_width", intval($_POST['wp_gz_like_width']));
			update_option("wp_gz_like_height", intval($_POST['wp_gz_like_height']));
		}
	}
}

if( !function_exists('wp_gz_like_format') )
{
	function wp_gz_like_format( $align )
	{
		if($align == 'left') { $margin = '5px 5px 5px 0'; }
		if($align == 'none') { $margin = '5px 0'; }
		if($align == 'right') { $margin = '5px 0 5px 5px'; }
		
		$layout = get_option("wp_gz_like_layout");
		if($layout == '') { $layout = 'standard'; }
		
		$action = get_option("wp_gz_like_action");
		if($action == '') { $action = 'Įvertink straipsnio pozityvumą!'; }
		
		$colorscheme = get_option("wp_gz_like_colorscheme");
		if($colorscheme == '') { $colorscheme = 'light'; }
		
		$width = get_option("wp_gz_like_width");
		if($width == '') { $width = '160'; }
		
		$height = get_option("wp_gz_like_height");
		if($height == '') { $height = '24'; }
		
			
		$permalink = get_permalink();
		
		$output = '<iframe id="wp_gz_like_button" style="margin:'.$margin.';float:'.$align.';height:'.$height.'px;width:'.$width.'px;border:none; overflow:hidden;" src="//www.geroszinios.lt/plugins/gz.php?url='. rawurlencode($permalink) .'&amp;layout='. $layout .'&amp;colorscheme='. $colorscheme .'" scrolling="no" frameborder="0" allowTransparency="true"></iframe> ';
		
		return $output;
	}
}

if ( !function_exists('wp_gz_like') )
{
	function wp_gz_like( $content )
	{
		$c1 = get_option("wp_gz_show_front_page");
		$c2 = get_option("wp_gz_show_single");
		$c3 = get_option("wp_gz_show_page");
		
		if ($c1 == '')
			$ck1 = 0;
		else
			$ck1 = !$c1 ? !is_front_page() : 1;
			
		if ($c2 == '')
			$ck2 = 1;
		else
			$ck2 = !$c2 ? !is_single() : 1;
			
		if ($c3 == '')
			$ck3 = 1;
		else
			$ck3 = !$c3 ? !is_page() : 1;
			
		
//		if( !is_feed() && !is_page() && !is_archive() && !is_search() && !is_404() )
		if( !is_feed() && $ck1 && $ck2 && $ck3 && !is_archive() && !is_search() && !is_404() )
		{
			switch( get_option("wp_gz_like_align") )
			{
				case 'tl': // Top Left
					return wp_gz_like_format('left') . $content;
				break;
				
				case 'tr':
					return wp_gz_like_format('right') . $content;
				break;
				
				case 'bl':
					return $content . wp_gz_like_format('left');
				break;
				
				case 'br':
					return $content . wp_gz_like_format('right');
				break;
				
				case 'nt': // None (Top)
					return wp_gz_like_format('none') . $content;
				break;
				
				case 'nb': // None (Bottom)
					return $content . wp_gz_like_format('none');
				break;
				
				default:
					return $content . wp_gz_like_format('none');
			}
		}
		else
		{
			return $content;
		}
	}
}

add_filter('the_content', 'wp_gz_like');
add_action('admin_menu', 'wp_gz_like_settings');
add_action('init', 'wp_gz_like_update');
?>