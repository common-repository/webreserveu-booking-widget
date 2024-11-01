<?php
/*
Plugin Name: WebReserv Sidebar Booking Calendar
Plugin URI: http://blog.webreserv.eu/webreserv-booking-widget-for-wordpress/
Description: This is the SideBar add-on to the  WebReserv Embedded Booking Calendar widget. It allows you to create a sidebar component that opens the WebReserv booking system in a new window. To embed the main booking component directly on a PAGE or POST, use the <a href="http://blog.webreserv.eu/webreserv-embedded-booking-calendar-widget-for-wordpress/">WebReserv Embedded Booking Calendar</a>. 
Version: 2.8
Author: WebReserv
Author URI: http://blog.webreserv.eu/webreserv-booking-plugins-for-wordpress/

*/

function widget_webreserv($args) {
	// First we grab the Wordpress theme args, which we
	// use to display the widget
	extract($args);
	
	// Now we sniff around to see if there are
	// any preset options
	$options = get_option("widget_webreserv");


	
	// If no options have been set, we need to set them
	if (!is_array( $options )) {
		$options = array(
	  	'title' => 'Book Online',
	  	'text' => 'This is a WebReserv wordpress sidebar widget. You can modify this text in wordpress under (widgets), look for the WebReserv Widget. To embed the webreserv booking calendar directly in a page or post, try the Webreserv Embedded Booking Calendar',
		'bizid' => 'bobsboatdemogb',
		'widget-background-colour' => 'FFFFFF',
		'widget_text_colour' => '000000',
		'widget_border_colour' => 'F0D6A3',
		'show_webreserv_header' => '1',
		'use_default_wordpress_css' => '1',
		'custom_css' => '',
		'webreserv_list_or_calendar' => 'calendar',
		'include_search_dates' => '1',
		'click_here_text' => 'Click here to book Online',
		'eu_or_com' => '.EU'

	  	);
	}      
	
	// Display the widget!
	echo $before_widget;
	echo $before_title;

	// set URL for booking component
	$wr_url1 = "http://www.webreserv";
	$wr_url2 = "/services/bookonline.do";
	
	// Set business ID parameter'
	$businessid_url = "?businessid=".$options['bizid'];

	// Find out if we should set to show the header of the booking component or not
	$wr_header = "";
	if ($options['show_webreserv_header'] == 0 )
		{
		$wr_header = "&embedded=y";
		}

	// set whether to show list or calendar view
	if ($options['webreserv_list_or_calendar'] == "calendar") 
		{
		$view_type = "&list=n";
		}

	// Check wehther to show search dates
	if ($options['include_search_dates'] == "0")
		{
		$wr_search = "&search=n";
		}

	// Set up the colour parms if they have been given
	if ($options['widget_background_colour'] <> "")
		{
		$colours = "&background-color=".$options['widget_background_colour'];
		}
	if ($options['widget_text_colour'] <> "")
		{
		$colours = $colours."&color=".$options['widget_text_colour'];
		}
	if ($options['widget_border_colour'] <> "")
		{
		$colours = $colours."&border-color=".$options['widget_border_colour'];
		}

	// Work out whether to use .eu or .com url
	// if the business id = bobsboatdemogb, then you must overrule the option and set to .eu
	if ($options['bizid'] == 'bobsboatdemogb')
		{
		$wr_url_eu_or_com = '.EU';
		}
	else
		{
		$wr_url_eu_or_com = $options['eu_or_com'];
		}

	/* CSS cut out until SLL issue resolved
	// work out what CSS to use
	// if choice is set to use default (1=yes), then use css located in /wp-content/themes/.get_stylesheet().style.css
	$wr_css = "";
		if ($options['use_default_wordpress_css'] == 1)
		{
		$wr_css = "&css=".get_option('siteurl')."/wp-content/themes/".get_stylesheet()."/style.css";
		}
	else
		{
		if ($options['custom_css'] <> "")
			{
			$wr_css = "&css=".get_option('custom_css');
			}
		}
	*/	



	// Build the Header URL

	$webreserv_header_link = "<a target=_new href=".$wr_url1.$wr_url_eu_or_com.$wr_url2.$businessid_url.$view_type.$wr_search.$wr_header.$colours.$wr_css.">".$options['title']."</a>";

	// show the link
	echo $webreserv_header_link;

	echo $after_title;
		//Our Widget Content	
	  	echo $options['text'];
		// Build the click_here_link
		$click_here_url = "<br><a target=_new href=".$wr_url1.$wr_url_eu_or_com.$wr_url2.$businessid_url.$view_type.$wr_search.$wr_header.$colours.$wr_css.">".$options['click_here_text']."</a>";
		echo $click_here_url;
	echo $after_widget;
}


function widget_control() {

	// We need to grab any preset options
	$options = get_option("widget_webreserv");
	
	// No options? No problem! We set them here.
	if (!is_array( $options )) {
		$options = array(
	  	'title' => 'Book Online',
	  	'text' => 'This is a WebReserv wordpress sidebar widget. You can modify this text in wordpress under (widgets), look for the WebReserv Widget. To embed the webreserv booking calendar directly in a page or post, try the Webreserv Embedded Booking Calendar',
	  	'bizid' => 'bobsboatdemogb',
		'widget_background_color' => '',
		'widget_text_color' => '',
		'widget_border_color' => '',
		'show_webreserv_header' => '1',
		'use_default_wordpress_css' => '1',
		'custom_css' => '',
		'webreserv_list_or_calendar' => 'calendar',
		'include_search_dates' => '1',
		'click_here_text' => 'Click here to book Online',
		'eu_or_com' => '.EU'

		);
	}      
	
	// Is the user has set the options and clicked save,
	// Then we grab them using the $_POST function.
	if ($_POST['widgetTutorial-Submit']) {
		$options['title'] = 
		  htmlspecialchars($_POST['widget-WidgetTitle']);
		$options['text'] = 
		  htmlspecialchars($_POST['widget-IntroText']);
		$options['bizid'] = 
		  htmlspecialchars($_POST['widget-bizid']);
		$options['widget_background_colour'] = 
		  htmlspecialchars($_POST['widget-background-colour']);
		$options['widget_text_colour'] = 
		  htmlspecialchars($_POST['widget-text-colour']);
		$options['widget_border_colour'] = 
		  htmlspecialchars($_POST['widget-border-colour']);
		$options['show_webreserv_header'] = 
		  htmlspecialchars($_POST['show-webreserv-header']);
		$options['use_default_wordpress_css'] = 
		  htmlspecialchars($_POST['use-default-wordpress-css']);
		$options['custom_css'] = 
		  htmlspecialchars($_POST['custom-css']);

		$options['webreserv_list_or_calendar'] = 
		  htmlspecialchars($_POST['webreserv-list-or-calendar']);

		$options['include_search_dates'] = 
		  htmlspecialchars($_POST['include-search-dates']);

		$options['click_here_text'] = 
		  htmlspecialchars($_POST['click-here-text']);
		$options['eu_or_com'] = 
		  htmlspecialchars($_POST['eu-or-com']);
		// And we also update the options in the Wordpress Database
		update_option("widget_webreserv", $options);
	}
	
?>
<p>
<b>WebReserv Sidebar Booking Calendar</b><br>
This widget allows you to add the WebReserv booking system to your wordpress website.<br>
To read more about the WebReserv Wordpress plugins - <a href="http://blog.webreserv.eu/webreserv-booking-plugins-for-wordpress/" Target="_new">click here</a>
<hr>
<b>Do you already have a WebReserv Account?</b><br>
Yes I do - <a href="http://blog.webreserv.eu/finding-your-webreserv-business-id-in-the-back-office/" target="_new">click here to find your business ID.</a><br>
No I don't - <a href="http://blog.webreserv.eu/webreserv-booking-plugins-for-wordpress/" target="_new">click here to create a free account.</a>
<hr>
	<label for="widget-bizid"><b>Business ID</b><br></label>
	<input type="text" 
      id="widget-bizid" 
      name="widget-bizid" 
      value="<?php echo $options['bizid'];?>" />
<br>
<i>The business ID associates your plugin with your WebReserv account.<br>
The demo account ID "bobsboatdemogb" can be used to test the system.<br>
<a href="http://blog.webreserv.eu/finding-your-webreserv-business-id-in-the-back-office/" target="_new">Click here to read how to find your business ID</a></i>
<hr>
	<label for="eu-or-com"><b>WebReserv.EU or WebReserv.COM</b><br></label>
	<SELECT 
	NAME="eu-or-com" 
	id="eu-or-com">  
	 <OPTION VALUE=".EU" <?php if($options['eu_or_com'] == '.EU')  echo "SELECTED";?>    > .EU
	 <OPTION VALUE=".COM" <?php if($options['eu_or_com'] == '.COM')  echo "SELECTED";?>    > .COM
	</SELECT>
<br>
<i>Choose whether you have a WebReserv.EU or a WebReserv.COM account.</i>
<hr>
	<label for="widget-WidgetTitle"><b>Title</b><br></label>
	<input type="text" 
      id="widget-WidgetTitle" 
      name="widget-WidgetTitle" 
      value="<?php echo $options['title'];?>" />
<br>
<i>This is the title you will have on the sidebar. Clicking on the Title opens the WebReserv booking component in a new window.</i>
<hr>
	<label for="widget-IntroText"><b>Intro Text</b><br></label>
    	<textarea id="widget-IntroText" 
      name="widget-IntroText" 
      cols="30" rows="4">
	<?php echo $options['text'];?>
    </textarea>
<br>
<i>This is a text that can be shown under Title - Here you can write something like "Book online with our new reservation and booking system"</i>
<hr>
	<label for="show-webreserv-header"><b>Show Header in Booking Module?</b><br></label>
	<SELECT 
	NAME="show-webreserv-header" 
	id="show-webreserv-header">  
	 <OPTION VALUE="1" <?php if($options['show_webreserv_header'] == 1)  echo "SELECTED";?>    > Yes
	 <OPTION VALUE="0" <?php if($options['show_webreserv_header'] == 0)  echo "SELECTED";?>    > No
	</SELECT>
<br>
<i>This turns on and off the header when the booking component opens.</i>
<hr>
	<label for="click-here-text"><b>Click Here Link Text</b><br></label>
	<input type="text" 
      id="click-here-text" 
      name="click-here-text" 
      value="<?php echo $options['click_here_text'];?>" />
<br>
<i>This is where you can change the text for the <u>click here</u> link</i>
<hr>
	<label for="webreserv-list-or-calendar"><b>View Type?</b><br></label>
	<SELECT 
	NAME="webreserv-list-or-calendar" 
	id="webreserv-list-or-calendar">  
	 <OPTION VALUE="list" <?php if($options['webreserv_list_or_calendar'] == "list")  echo "SELECTED";?>    > List View
	 <OPTION VALUE="calendar" <?php if($options['webreserv_list_or_calendar'] == "calendar")  echo "SELECTED";?>    > Calendar View
	</SELECT>
<br>
<i>Choose between the List View or the Calendar View.</i>
<hr>

	<label for="include-search-dates"><b>Search Dates?</b><br></label>
	<SELECT 
	NAME="include-search-dates" 
	id="include-search-dates">  
	 <OPTION VALUE="1" <?php if($options['include_search_dates'] == "1")  echo "SELECTED";?>    > Yes
	 <OPTION VALUE="0" <?php if($options['include_search_dates'] == "0")  echo "SELECTED";?>    > No
	</SELECT>
<br>
<i>Choose whether to show search dates or not.<br>
Search dates only work in list view and should not be used for hourly booking set-ups.</i>
<hr>
<b>Colours</b><br>
<i>You can set the colours of the booking widget when it opens.<br>
The colours you can set are Background colour, Text Colour and Border Colour.<br>
Note: Border colour sets colours for the "List View" View Type.<br>
All colours are in hex - such as FFFFFF or 23232323.</i><br>
	<label for="widget-background-colour"><b>Background Colour</b><br></label>
	<input type="text" maxlength=6 
      id="widget-background-colour" 
      name="widget-background-colour" 
      value="<?php echo $options['widget_background_colour'];?>" />
<br>
	<label for="widget-text-color"><b>Text Colour</b><br></label>
	<input type="text" maxlength=6  
      id="widget-text-colour" 
      name="widget-text-colour" 
      value="<?php echo $options['widget_text_colour'];?>" />
<br>
	<label for="widget-border-colour"><b>Border Colour</b><br></label>
	<input type="text" maxlength=6 
      id="widget-border-colour" 
      name="widget-border-colour" 
      value="<?php echo $options['widget_border_colour'];?>" />
<hr>

<!-- The CSS section is currently not used until we work out the SLL issues
<br>
	<label for="use-default-wordpress-css">Use your default CSS (website style)?</label>
	<SELECT 
	NAME="use-default-wordpress-css" 
	id="use-default-wordpress-css">  
	 <OPTION VALUE="1" <?php if($options['use_default_wordpress_css'] == 1)  echo "SELECTED";?>    > Yes
	 <OPTION VALUE="0" <?php if($options['use_default_wordpress_css'] == 0)  echo "SELECTED";?>    > No
	</SELECT>
<br>
	<label for="custom-css">Custom CSS (full http://... url):<br></label>
	<input type="text" 
      id="custom-css" 
      name="custom-css" 
      value="<?php echo $options['custom_css'];?>" />
-->

	<input type="hidden" 
      id="widgetTutorial-Submit" 
      name="widgetTutorial-Submit" 
      value="1" />

</p>
<?php
}

function widget_init() {
	// These are the Wordpress functions which will register
	// the widget, and also the widget control - or
	// 'options', to you and me.
	register_sidebar_widget('WebReserv Sidebar', 'widget_webreserv');
	register_widget_control('WebReserv Sidebar', 'widget_control');
}

add_action("plugins_loaded", "widget_init");
?>
