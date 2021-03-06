<?php

/*
  Plugin Name: Meet The Author
  Plugin URI: https://github.com/chaos1/WP-Meet-The-Author
  Description: This is a simple WordPress plugin that places a tab at the top of your blog which slides down to present the user with contact information, social media links, RSS link, Gravatar and a short bio. This is my first public WordPress Plugin, please enjoy!
  Author: Syntax_error
  Version: 1.0 trunk
  License: GPLv2
  Author URI: http://codesleepshred.com
  Other Notes: Credit to Cute Profiles authors Tejaswini Deshpande, Sanjeev Mishra for the dashboard part of this plugin. This is my first publically released plugin and I needed to learn how to code the Dashboard. I typed out each line of code to learn. Thanks guys!
 */

function MTA_profiles_url( $path = '' ) {
	global $wp_version;
	if ( version_compare( $wp_version, '2.8', '<' ) ) { // Using WordPress 2.7
		$folder = dirname( plugin_basename( __FILE__ ) );
		if ( '.' != $folder )
			$path = path_join( ltrim( $folder, '/' ), $path );

		return plugins_url( $path );
	}
	return plugins_url( $path, __FILE__ );
}

//on actication options will be populated

function activate_mta() {

    $mta_profiles_opts1 = get_option('mta_profiles_options');

    $mta_profiles_opts2 =  array('amazon'=>'',
			    'aol'=>'',
			    'apple'=>'',
			    'app-store'=>'',
			    'bebo'=>'',
			    'bing'=>'',
			    'blogger'=>'',
			    'ebay'=>'',
			    'freindfeed'=>'',
			    'friendster'=>'',
			    'google'=>'',
			    'google-buzz'=>'',
			    'google-talk'=>'',
			    'gowalla'=>'',
			    'icq'=>'',
			    'metacafe'=>'',
			    'mixx'=>'',
			    'mobileme'=>'',
			    'msn'=>'',
			    'myspace'=>'',
			    'netvibes'=>'',
			    'newsvine'=>'',
			    'paypal'=>'',
			    'photobucket'=>'',
			    'qik'=>'',
			    'scribd'=>'',
			    'skype'=>'',
			    'slashdot'=>'',
			    'squidoo'=>'',
			    'stumbleupon'=>'',
			    'technorati'=>'',
			    'viddler'=>'',
			    'w3'=>'',
			    'wikipedia'=>'',
			    'wordpress'=>'',
			    'yahoo-buzz'=>'');
    $mta_profiles_opts3 = array('contact'=>'Jane Realtor',
			    'address'=>'132 Main St.',
			    'city'=>'Seattle',
			    'region'=>'WA',
			    'zip'=>'98246',
			    'mobile'=>'555-555-5555',
			    'phone'=>'',
			    'fax'=>'',
			    'email'=>'',
			    'top'=>'275',
			    'align'=>'left',
			    'size'=>'2',
			    'theme'=>'2',
			    'insert'=>'auto',
			    'follow'=>'dofollow' );

    if ($mta_profiles_opts1) {

	$mta_profiles = $mta_profiles_opts1 + $mta_profiles_opts2 + $mta_profiles_opts3;

	update_option('mta_profiles_options',$mtaprofiles);

    } else {
	$mta_profiles_opts1 = array('blip'=>'',
			    'delicious'=>'',
			    'digg'=>'',
			    'facebook'=>'',
			    'feedburner'=>'',
			    'flickr'=>'',
			    'foursquare'=>'',
			    'github'=>'',
			    'lastfm'=>'',
			    'linkedin'=>'',
			    'meetup'=>'',
			    'picasa'=>'',
			    'podcast'=>'',
			    'posterous'=>'',
			    'reddit'=>'',
			    'slideshare'=>'',
			    'smugmug'=>'',
			    'social-email'=>'',
			    'social-rss'=>'',
			    'soundcloud'=>'',
			    'tumblr'=>'',
			    'twitter'=>'',
			    'vimeo'=>'',
			    'yelp'=>'',
			    'youtube'=>'');
	$mta_profiles = $mta_profiles_opts1 + $mta_profiles_opts2 + $mta_profiles_opts3;

	add_option('mta_profiles_options',$mta_profiles);
    }
}

global $mta_profiles_networks;

$mta_profiles_networks = array( 'blip','delicious','digg','facebook','feedburner','flickr','foursquare','github','lastfm','linkedin','meetup','picasa','podcast','posterous','reddit','slideshare','smugmug','social-email','social-rss','soundcloud','tumblr','twitter','vimeo','yelp','youtube');

global $mta_profiles_networks2;

$mta_profiles_networks2 = array( 'amazon','aol','apple','app-store','bebo','bing','blogger','ebay','freindfeed','friendster','google','google-buzz','google-talk','gowalla','icq','metacafe','mixx','mobileme','msn','myspace','netvibes','newsvine','paypal','photobucket','qik','scribd','skype','slashdot','squidoo','stumbleupon','technorati','viddler','w3','wikipedia','wordpress','yahoo-buzz');

global $mta_profiles_contact;

$mta_profiles_contact = array( 'contact','address','city','region','zip','mobile','phone','fax','email');

register_activation_hook( __FILE__, 'activate_mta');

global $mta_profiles;

$mta_profiles = get_option('mta_profiles_options');

define("MTA_PROFILES_VER","1.0",false);

// Add The CSS and jQuery to the header.
wp_register_style('wp-meettheauthor', WP_PLUGIN_URL .'/wp-meettheauthor/mta.css');
wp_enqueue_style('wp-meettheauthor');
wp_register_script('thismta', WP_PLUGIN_URL . '/wp-meettheauthor/jquery.min.js', array('jquery') );
wp_enqueue_script('thismta');

function your_author(){
    global $mta_profiles;
?>
<div id="top">
  <div id="toppanel">
    <div id="panel">
      <div id="panel_contents"> </div>
      <div class="sidepanel">
        <h2>Contact Us</h2>
        <ul>
	  <?php if($mta_profiles['contact']) {?><li><?php echo $mta_profiles['contact']; ?></li><?php } ?>
	  <?php if($mta_profiles['address']) {?><li><?php echo $mta_profiles['address']; ?></li><?php } ?>
	  <?php if($mta_profiles['city']) {?><li><?php echo $mta_profiles['city']; ?>, <?php echo $mta_profiles['region']; ?> <?php echo $mta_profiles['zip']; ?></li><?php } ?>
	  <?php if($mta_profiles['mobile']) { ?><li>Mobile: <?php echo $mta_profiles['mobile']; ?></li><?php } ?>
	  <?php if($mta_profiles['phone']) { ?><li>Direct: <?php echo $mta_profiles['phone']; ?></li><?php } ?>
	  <?php if($mta_profiles['fax']) { ?><li>Fax: <?php echo $mta_profiles['fax']; ?></li><?php } ?>
	  <?php if($mta_profiles['email']) { ?><li><?php echo antispambot($mta_profiles['email']); ?></li><?php } ?>
        </ul>
      </div>
      <div class="sidepanel">
        <h2>Social Media</h2>
        <ul>
	    <?php
	    global $mta_profiles_networks;
	    foreach ($mta_profiles_networks as $mta_profiles_network) {
		$mta_link = str_replace(" ","",$mta_profiles[$mta_profiles_network]); if (!empty($mta_link)) { ?>
		    <li><a href="<?php echo $mta_profiles[$mta_profiles_network]; ?>" target="_blank"><img src="<?php echo WP_PLUGIN_URL . '/wp-meettheauthor/images/social/' . $mta_profiles_network . '.png'?>" />
		    <?php echo ucwords($mta_profiles_network); ?></a>
		    </li><?php
		}
	    }
	    ?>
	    <?php
	    global $mta_profiles_networks2;
	    foreach ($mta_profiles_networks2 as $mta_profiles_network) {
		$mta_link = str_replace(" ","",$mta_profiles[$mta_profiles_network]); if (!empty($mta_link)) { ?>
		    <li><a href="<?php echo $mta_profiles[$mta_profiles_network]; ?>" target="_blank"><img src="<?php echo WP_PLUGIN_URL . '/wp-meettheauthor/images/social/' . $mta_profiles_network . '.png'?>" />
		    <?php echo ucwords($mta_profiles_network); ?></a>
		    </li><?php
		}
	    }
	    ?>
        </ul>
        <h2>Subscribe For Updates</h2>
        <ul>
          <li><img src="<?php echo WP_PLUGIN_URL . "/wp-meettheauthor/images/social/social-rss.png"; ?>" style="margin-bottom: -3px; margin-right: 10px;"/><a href="<?php bloginfo('rss2_url'); ?>" title="Subscribe via RSS" target="_blank">RSS via Feed Reader</a></li>
        </ul>
      </div>
      <div class="sidepanel">
        <h2>Meet The Author</h2>
        <p><?php echo get_avatar($mta_profiles['gravatar'], '125'); ?><p><?php echo $mta_profiles['biography']; ?></p><?php if ($mta_profiles['readmore']) { ?><a href="<?php echo $mta_profiles['readmore'] ?>">Read More &raquo;</a><?php } ?>
        <br/>
      </div>
    </div>
    <div class="panel_button" id="hide_button" style="display: none;"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAALCAYAAAByF90EAAAAgUlEQVQoz2NgIADevr6fAMK45P///w/GhAwxAOL/UGxAlkFAjQpA/B7JIBBbgSSDgBoEgPg8kiEwDBITIMWg+VgMgeH5RBkEVFiPxxAYrsdrEFBBABGGwHAAVoOgMfSeBINAag1QDMITuIQwOPCRDdpPhiEwvB9sEJARDzWIEhwPAFPbyRQVXiOSAAAAAElFTkSuQmCC" alt="collapse"/> <a href="#">Close Panel</a> </div>
  </div>
  <div class="panel_button" style="display: visible;"><a href="#">Meet The Author</a> </div>
</div>
<script type="text/javascript" charset="utf-8">jQuery(document).ready(function($){$("div.panel_button").click(function(){$("div#panel").animate({height:"500px"})
.animate({height:"400px"},"fast");$("div.panel_button").toggle();});$("div#hide_button").click(function(){$("div#panel").animate({height:"0px"},"fast");});});</script>
<?php
}

add_filter('get_footer', 'your_author');

// add settings page

function mta_profiles_settings() {

    // Add submenu under options

    add_options_page('Meet The Author', 'Meet The Author', 9, basename(__FILE__), 'mta_profiles_settings_page');

}

function mta_profiles_admin_head() {
    ?>
<script type="text/javascript">
jQuery(document).ready(function()
{
  //hide the all of the element with class msg_body
  jQuery(".mtainside").hide();
  //toggle the componenet with class msg_body
  jQuery(".mtahndle").click(function()
  {
    jQuery(this).next(".mtainside").slideToggle(600);
  });
  jQuery(".mtacontacts").click(function()
    {
	jQuery(this).next(".mtainsidecontact").slideToggle(600);
    });
  jQuery('#mta_msg_close').click(function () {
			jQuery('#mta_msg_message').fadeOut("slow");
  });
});
</script>

<style type="text/css">
#divFeedityWidget span {
        display:none !important;
}
#divFeedityWidget a{
        color:#06637D !important;
}
#divFeedityWidget a:hover{
		font-size:110%;
}
#mta_msg_message {background-color:#FEF7DA;clear:both;width:72%;}
#mta_msg_close {float:right;}
</style>
<?php
}

add_action('admin_head', 'mta_profiles_admin_head');

function mta_head_style() { ?>
<style type="text/css">
#top {
    clear:both;
    top: <?php if (is_admin_bar_showing() == true) { echo "28px"; } else { echo "0px"; } ?> ;
    left:50%;
    margin-left:-490px;
        z-index: 999999;
    position:fixed;
}
</style>
<?php }

add_action('wp_head', 'mta_head_style');

// display page in options

function mta_profiles_settings_page() {
// displaying plugin version info
	require_once(ABSPATH.'/wp-admin/includes/plugin-install.php');
	$plug_api = plugins_api('plugin_information', array('slug' => sanitize_title('Meet The Authors') ));
		if ( is_wp_error($plug_api) ) {
			wp_die($plug_api);
		}
?>

<div class="wrap">
    
<h2>Meet The Author</h2>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="KMFN9KXQ3DL3G">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<div style="clear:both;"></div>
<form  method="post" action="options.php">
<div id="poststuff" class="metabox-holder has-right-sidebar">

<div style="float:left;width:55%;">
<?php
settings_fields('mta-profiles-group');
$mta_profiles = get_option('mta_profiles_options');
?>
<h2>Profile Links</h2>
<p>Enter the respective <strong>Profile URLs</strong> for your Blog here. For the Profile which you don't wish to display, keep the box empty.</p>

<!-- Contact Info -->
<div class="postbox">
    <h3 class="mtacontacts" style="cursor:pointer;"><span>Contact Information</span><img style="float:right;" src="<?php echo mta_profiles_url('images/arrows.png'); ?>" /></h3>
    <div class="mtainsidecontact">
	<table class="form-table">
	    <?php
	    global $mta_profiles_contact;
	    $count = 0;
	    foreach ($mta_profiles_contact as $mta_profiles_contacts) { $count++; ?>
	    <tr <?php if ($count % 2) { echo 'class="alternate"';} ?> valign="top">
		<th scope="row" style="width:20%;"><label for="mta_profiles_options[<?php echo $mta_profiles_contact;?>]"><?php echo ucwords($mta_profiles_contacts); ?></label></th>
		<td><input type="text" name="mta_profiles_options[<?php echo $mta_profiles_contacts;?>]" value="<?php echo $mta_profiles[$mta_profiles_contacts]; ?>" class="regular-text code" /></td>
	    </tr>
	    <?php } ?>
	</table>
	</div>
</div>

<!-- Set 1 Profiles -->
<div class="postbox">
<h3 class="mtahndle" style="cursor:pointer;"><span>Social Network Profiles - Set 1 </span><img style="float:right;" src="<?php echo mta_profiles_url('images/arrows.png'); ?>" /></h3>
<div class="mtainside">
<table class="form-table">
<?php
global $mta_profiles_networks;
$count = 0;
foreach ($mta_profiles_networks as $mta_profiles_network) { $count++; ?>
<tr <?php if ($count % 2) { echo 'class="alternate"';} ?> valign="top">
	<th scope="row" style="width:20%;"><label for="mta_profiles_options[<?php echo $mta_profiles_network;?>]"><?php if ($mta_profiles_network == "stumble") {echo "Stumbleupon";} elseif ($mta_profiles_network == "ff") {echo "FriendFeed";} elseif ($mta_profiles_network == "wp") {echo "Wordpress";} elseif ($mta_profiles_network == "rss") {echo "RSS";} else { echo ucwords($mta_profiles_network); }?></label></th>
	<td><input type="text" name="mta_profiles_options[<?php echo $mta_profiles_network;?>]" value="<?php echo $mta_profiles[$mta_profiles_network]; ?>" class="regular-text code" /></td>
</tr>
<?php } ?>
</table>
</div>
</div>

<!-- Set 2 Profiles -->
<div class="postbox">
<h3 class="mtahndle" style="cursor:pointer;"><span>Social Network Profiles - Set 2 </span><img style="float:right;" src="<?php echo mta_profiles_url('images/arrows.png'); ?>" /></h3>
<div class="mtainside">
<table class="form-table">
<?php
global $mta_profiles_networks2;
$count = 0;
foreach ($mta_profiles_networks2 as $mta_profiles_network) { $count++; ?>
<tr <?php if ($count % 2) { echo 'class="alternate"';} ?> valign="top">
	<th scope="row" style="width:20%;"><label for="mta_profiles_options[<?php echo $mta_profiles_network;?>]"><?php if ($mta_profiles_network == "stumble") {echo "Stumbleupon";} elseif ($mta_profiles_network == "ff") {echo "FriendFeed";} elseif ($mta_profiles_network == "wp") {echo "Wordpress";} elseif ($mta_profiles_network == "rss") {echo "RSS";} else { echo ucwords($mta_profiles_network); }?></label></th>
	<td><input type="text" name="mta_profiles_options[<?php echo $mta_profiles_network;?>]" value="<?php echo $mta_profiles[$mta_profiles_network]; ?>" class="regular-text code" /></td>
</tr>
<?php } ?>
</table>
</div>
</div>

<h2>Author Information</h2>
<p>Here you can fill out a short bio, connect your Gravatar and link to your authors page. If you don't have a Gravatar yet, head over to <a href="http://gravatar.com" target="_blank">Gravatar.com</a>, register and upload your avatar.</p>

<h3>Your Current Gravatar</h3>
<?php echo get_avatar($mta_profiles['gravatar'], '96'); ?>

<table class="form-table">
    <tr valign="top">
    <th scope="row"><label for="mta_profiles_options[gravatar]">Gravatar E-mail</label></th>
    <td><input type="text" size="35" name="mta_profiles_options[gravatar]" class="big-text" value="<?php echo $mta_profiles['gravatar']; ?>" /></td>
    </tr>
    <tr valign="top">
    <th scope="row"><label for="mta_profiles_options[biography]">Biography</label></th>
    <td><textarea type="text" cols="35" rows="5" name="mta_profiles_options[biography]" class="big-text" value="<?php echo $mta_profiles['biography']; ?>" /><?php echo $mta_profiles['biography']; ?></textarea>
    </td>
    </tr>
    <tr valign="top">
    <th scope="row"style="width:300px;"><label for="mta_profiles_options[gravatar]">"Read More" Link To Author Page</label></th>
    <td><input type="text" size="35" name="mta_profiles_options[readmore]" class="big-text" value="<?php echo $mta_profiles['readmore']; ?>" /></td>
    </tr>
</table>

<h2>Customize Looks</h2>
<p>Customize the Profile Links and Icons</p>

<table class="form-table">

<tr valign="top">
<th scope="row"><label for="mta_profiles_options[follow]">Profile Links rel attribute</label></th>
<td><select name="mta_profiles_options[follow]">
<option value="dofollow" <?php if ($mta_profiles['follow'] == "dofollow"){ echo "selected";}?> >Dofollow</option>
<option value="nofollow" <?php if ($mta_profiles['follow'] == "nofollow"){ echo "selected";}?> >No Follow</option>
</select></td>
</tr>

<tr valign="top">
<th scope="row"><label for="mta_profiles_options[top]">Icons Distance From Top</label></th>
<td><input type="text" name="mta_profiles_options[top]" class="small-text" value="<?php echo $mta_profiles['top']; ?>" />&nbsp;px</td>
</tr>

</table>
<p>Note:- For Automatic Insertion, your Wordpress theme should have get_footer in the template file like index.php or single.php of the theme. For manual insertion use the tag <strong>put_mta_profiles();</strong></p>
<p>Refer the Usage section of the plugin for more details on how to use the tempate tag.</p>

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</div>


<div id="side-info-column" class="inner-sidebar">
    <div class="postbox">
        <h3 class="hndle"><span>About this Plugin:</span></h3>
        <div class="inside">
            <ul>
                <li><a href="http://codesleepshred.com/wp-meet-the-author-plugin/" title="mta Profiles Homepage" target="_blank" >Plugin Homepage</a></li>
            </ul>
        </div>
    </div>
</div>

    <div id="side-info-column" class="inner-sidebar">
                    <div class="postbox">
                    <h3 class="hndle"><span>Credits:</span></h3>
                        <div class="inside">
                            <ul>
                                <li><a href="http://codesleepshred.com" target="_blank">CodeSleepShred</a></li>
                                <li><a href="http://codex.wordpress.org/Main_Page" title="WordPress Help" target="_blank">WordPress Codex</a></li>
                            </ul>
                        </div>
                    </div>
    </div>

    <div id="side-info-column" class="inner-sidebar">
                    <div class="postbox">
                      <h3 class="hndle"><span>Support &amp; Donations</span></h3>
                          <div class="inside">
                          <ul>
                              <li><a href="https://github.com/chaos1/WP-Meet-The-Author/issues" target="_blank" >Report Issues</a></li>
                              <li><a href="http://codesleepshred.com/donate/" target="_blank" alt="Give this guy a beer!">Donate Today</a></li>
                          </ul>

                        </div>
                    </div>
    </div>

</div> <!--end of poststuff -->

</form>
</div> <!--end of float wrap -->
<?php
}

// Hook for adding admin menus

if ( is_admin() ){ // admin actions
  add_action('admin_menu', 'mta_profiles_settings');
  add_action( 'admin_init', 'register_mta_profiles_settings' );
}
function register_mta_profiles_settings() { // whitelist options
  register_setting( 'mta-profiles-group', 'mta_profiles_options' );
}

?>