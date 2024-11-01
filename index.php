<?php
/*
Plugin Name: Skysa App SDK
Plugin URI: http://wordpress.org/extend/plugins/skysa-app-sdk/
Description: Software development kit for creating standalone Skysa App Bar apps for WordPress.
Version: 2.0
Author: Skysa
Author URI: http://www.skysa.com
*/

/*
*************************************************************
*                Skysa App SDK version 2.0                  *
*            Download the latest version here:              *
*    http://wordpress.org/extend/plugins/skysa-app-sdk/     *
*************************************************************

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
MA  02110-1301, USA.
*/

/*
*************************************************************
*                        Quick Start                        *
*************************************************************

This file provides you with working examples of Skysa apps.
To get started making your own Skysa App WordPress Plugin:

(1) Create a new directory for your plugin in the plugins
    directory of your development site.
(2) Copy the skysa-required directory and index.template file
    from this "skysa-app-sdk" plugin directory into your new
    plugin directory.
(3) In your new plugin directory, rename the "index.template"
    file to "index.php".

You may now activate your new plugin and make your changes to
the "index.php" file in it's directory.
*/


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) exit;

// Skysa App plugins require the skysa-req subdirectory,
// and the index file in that directory to be included.
// Here is where we make sure it is included in the project.
include_once dirname( __FILE__ ) . '/skysa-required/index.php';


/*
*************************************************************
*                     Example Skysa Apps                    *
*************************************************************

Generally, you would only register a single Sksya app per plugin.
For this SDK, several working Skysa app examples have been provided 
in the same plugin to display various ways the they can be created.

Each Skysa app must be registered by passing an description array
to this function: 
$GLOBALS['SkysaApps']->RegisterApp

The only required values for the primary array  are 'id' and 'label';
The plugin 'id' must be unique to that app and must be hard set in
your plugin code. To ensure that you have a unique id for your plugin
the first app included is a simple GUID Generator app. To use the GUID
Generator, go to fount-end of the the site this SDK is active on and click
the Generate Uinque App ID button on the Skysa bar at the bottom of the page.

*/


// SDK GUID GENERATOR APP
// Use this app to generator unique IDs for apps you create using this SDK.
// Each app must have a unique ID which is hard set in your code and never changes.
$GLOBALS['SkysaApps']->RegisterApp(array(
    'debug' => 1,
    'id' => '5019241951b61',
    'label' => 'GUID Generator',
    'views' => array( // views can be html or a function which returns html// link to other views using href="#view=view&queryparams", $app_bla replacement in code
        'main' => '<form onsubmit="return false;" style="text-align: center;"><input type="text" value="'.uniqid().'" size="14" onclick="this.select()" onfocus="this.select()" style="font-size: 24px; text-align: center;" /><a href="#view=main" style="font-size: 20px; margin-left: 3px;" class="button">New</a></form>'
    ), 
    'html' => '<div id="$button_id" class="bar-button" apptitle="Generate a Unique ID for Your Skysa Bar App" w="350" h="100"><span class="label">Generate Unique App ID</span></div>',
    'js' => "
        S.on('click',function(){S.open('window','main')});
     "
));

// ANNOUNCEMENTS APP
$GLOBALS['SkysaApps']->RegisterApp(array( //Describer array for the app
    'debug' => 1, // 'debug' => 1 for outputting errors, remove this or set to 0 for production
    'id' => '501924f978c8b', // (REQUIRED) Unique App ID. Each app must have a unique ID which is hard set in your code and never changes. Use the GUID Generator app to create one.
    'label' => 'Announcements', // (REQUIRED) This label is used for the in the WordPress admin menu to access options pages for the app.
	'options' => array( // The options array holds the primary user customizable settings for the app button.
            /*
                Only specific option field names can be used.
                Here are the ones you can use and their primary uses:

                'bar_label' - Used for the app button label text. 
                'icon' - Used to hold the URL for the icon used on the app button.
                'title' - Used for the app button tooltip and the app window title.
                'option1' - Use for anything. Holds text with a max length of 255.
                'option2' - Use for anything. Holds text with a max length of 255.
                'option3' - Use for anything. Holds text with a max length of 255.
                'option4' - Use for anything. Holds text with a max length of 21844.
                'data' - Use for anything. Holds text, no max length.


                Each field is described by an array. The field variables are:
                
                'label' - (REQUIRED) A name discribing the option for the user.
                'type' - (REQUIRED) The type of option. 
                        Supported Types are:
                        'text' - A simple text field.
                        'date' - A text field with a date selector.
                        'image' - A text field with a media selector link to allow the user to insert a URL
                                  from an upload or from a file already uploaded.
                        'textarea' - Simple multi-line text field.
                        'editor' - WordPress' rich text editor.
                        'selectbox' - A dropdown selection box. Each option is set in the value variable seperated by a pipe.
                'value' - (REQUIRED) Default value of the field. For text based fields it is simple text and can be left an
                          empty string. For the selectbox field it must be set, and the default value will be the first value listed.
                'size' - (REQUIRED) The size of the field by character, width then height seperated by a single pipe.
                'info' - (OPTIONAL) A longer discription about the option.
                

            */
		'bar_label' => array( // key is the field name
            'label' => 'Button Label',
			'info' => 'What would you like the bar link label name to be?',
			'type' => 'text',
			'value' => 'Announcements',
			'size' => '30|1'
		),
        'icon' => array(
            'label' => 'Button Icon URL',
            'info' => 'Enter a URL for the an Icon Image. (You can leave this blank for none)',
			'type' => 'image',
			'value' => plugins_url( '/icons/announcements-icon.png', __FILE__ ), // pull in the default icon URL for a local icon file included with the plugin.
			'size' => '50|1'
        ),
        'title' => array(
            'label' => 'App Title',
            'info' => 'What would you like to set as the title for the Announcements window?',
			'type' => 'text',
			'value' => 'Site Announcements',
			'size' => '30|1'
        ),
        'option1' => array(
            'label' => 'Auto Popup for New Announcements',
            'info' => 'Would you like this App to Popup for your visitor when you have a new announcement which they have not yet seen?',
			'type' => 'selectbox',
			'value' => 'Yes|No',
			'size' => '10|1'
        )
	),
    'window' => array( // The window array is optional; for window based apps it provides customization by the user for how the app window displays.
        /*
            Each of the three settings are optional, these are the only settings supported. Set the name as the key, and your default value as the value.
            It is recommended for window based apps with variable size content to include the width and height options to allow those dimensions to be customized.
        */
        'width' => '350',
        'height' => '250',
        'position' => 'Page Center' // The two possible default values for position are 'Page Center' and 'Above the Bar'.
    ),
    'manage' => array( // The manage array is an optional array only needed in apps which need to allow the user (website admin) to add records. In this case, it is for adding announcements.
        /*
            If the manage array is used, the 'label' and 'records' keys are required.
        */
        'label' => 'Announcements', // (REQUIRED) Sets the name of the manage tab in the app's options.
        'add_label' => 'Add Announcement', // (OPTIONAL) Sets the lable for the add record button. If not set, this defaults to simply 'Add'; 
        'records' => array( // (REQUIRED) Setup the fields which will be used for each record created by the site admin.
            /*
                Use any field name you like. The field variables are the same as
                listed above for the "options" fields, except there is one additional 
                field type you may use:
                    
                    'hidden' - Hidden fields are not shown in the when the records
                               are being added or edited in the plugin administration.

                               They can be accesed and changed by a views function and
                               are generaly for storing some kind of interaction.

                               Hidden fields do not require the size attribute.
            */
            'subject' => array(
			    'label' => 'Subject',
			    'type' => 'text',
			    'value' => '',
			    'size' => '30|1'
		    ),
            'body' => array(
			    'label' => 'Your Message',
			    'type' => 'editor',
			    'value' => '',
			    'size' => '50|6'
		    ),
            'expires' => array(
                'label' => 'Expiration Date',
			    'info' => 'Date to display the announcement until.',
			    'type' => 'date',
			    'value' => date("m/d/Y",mktime(0,0,0,date("m"),date("d")+7,date("Y"))), // Set the default value to 1 week from today
			    'size' => '8|1'
		    )
        )
    ),
    'fvars' => array( // The fvars is an optional array which can store any number of special variables for use in the HTML and JavaScript strings of your plugin.
        /*
            Each variable is listed as an array item with a key for the name of the variable pointing to the name of your function to call to return some data.

            To pull in a function variable, add '#fvar_' + function variabl name.
            Example based on the 'created' function variable below: #fvar_created
        */
        'created' => skysa_app_announce_fvar_created
    ),
    'views' => array( // The views array is optional. Each view can be an html string or a function which returns an html string.
        /*
            Unlike fvars, views can be an HTML string or point to a function which returns an HTML string.

            A view is used for displaying the content of an app window. There are two ways to access a view.

            (1) In the 'js' portion of the code, you can open a window to a specific view for your app. 
            (2) From in your app view html, you can link to a view to load into the app window.
                To link to an app view from inside the content HTML, simple add an anchor with #view=view as the href.
                If the view you wish to link to is named main, add this as the href for the anchor tag: "#view=main"
                You can also add query string parameters to the link after the view, which your view function can read.
                The same view link with a query parameter passed would look like this: "#view=main&q=1"
        */
        'main' => skysa_app_announce_view_main
    ), 
    // The html string is optional. It is the HTML which displays in the Skysa app bar.
    /*
        The code below is used to created a default app button, which can be clicked on to launch the app (if the click
        event is set in the 'js' variable of the app). An additional attribute has been added to the app button, the time 
        attribute, to allow the automatic popup of the app if new records (in this case new announcements) have been added.

        The Skysa bar reads the time attribute in the app button and checks if the current viewer of the page has already 
        seen the latest record based on it. If the record is new for that user, and a click event has been setup, the button
        click event will fire automatically; launching the app. If your app does not have manage records set, or does not 
        need to have the app popup when fresh content is available, the time attribute can be removed.

        App options and window settings are pulled into the app html using '$app_' + option name. For example, the app title
        would be set as: $app_title

        Function variables (set in the fvars array of the app) can be pulled in using '#fvar_' + fvar name. The example of 
        this shown in the code below is: #fvar_created

        SPECIAL VARIABLES
        There are two special varibles which pull in data in addition to the specific option.

            $app_icon - This variable pulls from the user set option field 'icon'. However, instead of simply pulling in the URL
                        of the icon field, it creates the correct html for the icon image if the value is not set to an empty string.
            $button_id - This variable creates the correct button id based on the id of your app, allowing click events to be set.

    */
    'html' => '<div id="$button_id" class="bar-button" time="#fvar_created" apptitle="$app_title" w="$app_width" h="$app_height" bar="$app_position">$app_icon<span class="label">$app_bar_label</span></div>',
    // The js string is optional. It allows you to load JavaScript for use with your app.
    /*
        JavaScript set in the 'js' variable of the app is executed within a context of the Skysa app platform allowing your code to
        connect with specific events and functions of the Skysa app platform. Code within the JS section has access to the 'S' namespace.
        In the 'S' namespace are three functions: 'on', 'load' and 'open'. All three are shown in use in the code below.
        
        Function uses:
            S.on(type,callback); - S.on accepts two variables: (string) type and (function) callback.
                type - (REQUIRED) currently supports two possible string values: 'click' and 'load'
                    'click' - calls your callback function when the app button for your app is clicked.
                    'load' - calls your callback function when the app button HTML is loaded.
                callback - (REQUIRED) the function to call when the event fires.

            S.load(type,string/url,top); - S.load accepts three variables: (string) type, (string) string/url, (boolean) top.
                type - (REQUIRED) currently supports three possible string values: 'css', 'cssStr' and 'js'
                    'css' - adds a link tag to the head of the HTML page which links to the URL you supply in the second variable of the load function.
                    'cssStr' - adds css to the page based on a string of css you pass as the second variable of the load function.
                    'js' - adds a script tag to the page which links to the URL you supply in the second variable of the load function.
                string/url - (REQUIRED) a URL string unless you use the 'cssStr' type. If using  the 'cssStr' type, this should be a string of CSS text.
                top - (OPTIONAL) a true or false boolean only used for the 'css' type. Normally, new CSS linked files would be added to the bottom of 
                    the page head tag, allowing for prominance in the CSS cascade. If your CSS needs to be easier to overide by other page styles, you could 
                    set the 'top' variable to true; making the new CSS link add to the top of the head tag instead.

            S.open(type,view,callback); - S.open accepts three variables: (string) type, (string) view, (function) callback.
                type - (REQUIRED) currently only the string variable 'window' is supported. This opens an app window based on the app options.
                view - (REQUIRED) the name of the view to use to display the contents of the app window. Any view you use must be set in the 
                       'views' array of your app discription.
                callback - (OPTIONAL) a JavaScript function to call when the app window has loaded.
    */
    // Set the click event for the app button to open the app window with the 'main' view.
    // Load some CSS related to the app.
    'js' => "
        S.on('click',function(){S.open('window','main')}); 
        S.load('cssStr','.SKYUI-announcement { margin-bottom: 10px;} .SKYUI-announcement h3 { font-size: 20px; margin-bottom: 5px;} .SKYUI-announcement h3 .SKYUI-time { font-size: 12px; display: block;}');
     "
));

/*
    Create view and fvar functions for the announcements app. Make sure they are uniquly named, so they do not cause any conflicts with other plugins.
    View and fvar functions get a single variable; the record array. 

    The record array holds all the options curretly set by the user (or the default if they have not been set yet). 
    For example $rec['title'] would pull in the currently set title option for the app.

    Addtionally, if a manage array has been setup for the app, the 'content' key will hold an array of all the records currently saved. The content arary
    in order by creation date from newest to oldest holding all the manage records which have been added.
    As shown below, the manage records are pulled in using $rec['content'].

*/
// Main Announcements App View function
function skysa_app_announce_view_main($rec){
    $str = ''; // View functions must return a string. Start the string here.
    if($rec['content'] && count($rec['content']) > 0){ // Check if any manage records (announcements) have been added.
        foreach( $rec['content'] as $created => $item ){ // Loop through all announcements. The created time is the item key.
            $exp = strtotime($item->expires); // Get the expiration date as a time string for comparison.
            if($exp > time()){ // If the announcement has not expired, add the HTML for it to the string.
                $str .= '<div class="SKYUI-announcement">
                    <h3>' . $item->subject . ' <span class="SKYUI-time">' . date("n/d/Y g:i A",$created+ (get_option( 'gmt_offset' )*3600)) . '</span></h3>
                    <div>' . $item->body .'</div>
                </div>';
            }
        }
    }
    if($str == ''){ // If there are not any active announcments display a message to that effect.
        $str = 'There are no active announcements.';
    }
    return $str; // Return the string for display.
}

// Announcements Created Function Variable
function skysa_app_announce_fvar_created($rec){
    if($rec['content'] && count($rec['content']) > 0 && $rec['option1'] == 'Yes'){ // Check for any manage records (announcements) and check if the popup option is set to Yes.
        foreach( $rec['content'] as $created => $item ){ 
            $exp = strtotime($item->expires);
            if($exp > time()){
                return $created+ (get_option( 'gmt_offset' )*3600); // return th time string for the most recently added active announcement.
                break;
            }
        }
    }
    return 0; // If not, return 0, the announcements app will not pop up.
}


//POLLS APP
$GLOBALS['SkysaApps']->RegisterApp(array( // 'debug' => 1 for javascript errors
    'debug' => 1,
    'id' => '50192521bc875',
    'label' => 'Polls',
	'options' => array(
		'bar_label' => array( // key is the field name
            'label' => 'Button Label',
			'info' => 'What would you like the bar link label name to be?',
			'type' => 'text',
			'value' => 'Poll',
			'size' => '30|1'
		),
        'icon' => array(
            'label' => 'Button Icon URL',
            'info' => 'Enter a URL for the an Icon Image. (You can leave this blank for none)',
			'type' => 'image',
			'value' => plugins_url( '/icons/poll-icon.png', __FILE__ ),
			'size' => '50|1'
        ),
        'title' => array(
            'label' => 'App Title',
            'info' => 'What would you like to set as the title for the Polls window?',
			'type' => 'text',
			'value' => 'Site Polls',
			'size' => '30|1'
        ),
        'option1' => array(
            'label' => 'Auto Popup for New Polls',
            'info' => 'Would you like this App to Popup for your visitor when you have a new poll which they have not yet seen?',
			'type' => 'selectbox',
			'value' => 'Yes|No',
			'size' => '10|1'
        )
	),
    'window' => array(
        'width' => '350',
        'height' => '250',
        'position' => 'Page Center'
    ),
    'manage' => array(
        'label' => 'Polls',
        'add_label' => 'Add Poll',
        /*
            Optionally you can add the dis_edit key to your manage array. This removes the option for the site admin to 
            edit records after they have been added. This is could be important for a poll app, which requires that the
            same answer values stay intact throughout the life of the poll.
        */
        'dis_edit' => 1, // Disable editing.
        'records' => array(
            /*
                
                An additional field variable is available for manage records fields:
                
                'output' - Set a manage area ouput function to create custom output for the records list. The output function
                           receives the current record item as an argument. With the 'answers' field below, the output function
                           is set to display the current vote results.
            */
            'question' => array(
			    'label' => 'Poll Question',
			    'type' => 'text',
			    'value' => '',
			    'size' => '30|1'
		    ),
            'answers' => array(
			    'label' => 'Poll Answers',
                'info' => 'Enter one answer per line.',
			    'type' => 'textarea',
			    'value' => '',
			    'size' => '50|6',
                'output' => 'skysa_app_poll_manage_output'
		    ),
            'expires' => array(
                'label' => 'Expiration Date',
			    'info' => 'Date to display the poll until.',
			    'type' => 'date',
			    'value' => date("m/d/Y",mktime(0,0,0,date("m"),date("d")+7,date("Y"))), // default to 1 week from today
			    'size' => '8|1'
		    ),
            'votes' => array( // Set a hidden field for storing poll votes.
                'type' => 'hidden',
                'value' => ''
            )
        )
    ),
    'fvars' => array(
        'created' => skysa_app_poll_fvar_created
    ),
    'views' => array(
        'main' => skysa_app_poll_view_main
    ),
    'html' => '<div id="$button_id" class="bar-button" time="#fvar_created" apptitle="$app_title" w="$app_width" h="$app_height" bar="$app_position">$app_icon<span class="label">$app_bar_label</span></div>',
    'js' => "
        S.on('click',function(){S.open('window','main')});
        S.load('cssStr','.SKYUI-polls h3 { font-size: 20px;}');
     "
));

// // Main Poll App View function
function skysa_app_poll_view_main($rec,$saveitem){ // second variable is a save content item function($sk_recid,$field,$newval);
    $str = '';
    if($rec['content'] && count($rec['content']) > 0){
        if(isset($_GET['page'])){ // Look for the page query string parameter.
            $pageindex = $_GET['page'];
        }
        else{ // If the page has not been set, set the page index to zero.
            $pageindex = 0;
        }
        $recCount = count($rec['content']); // Count the total polls which have been added.
        $page = array_slice($rec['content'],$pageindex,1,false); // Make an array with a single item based on the page.
        $item = $page[0]; // Set the item based on the page array.
        $answers = explode(chr(13),$item->answers); // Get all the answers for the current poll.
        $votes = $item->votes; // Get all the votes.
        $votes = explode(',',$votes); // Turn the votes into an array.
        $voteCount = 0; // Set a total vote count variable to store the total number of votes for the poll.
        
        foreach($answers as $i => $answer){ // Count the votes
            if(!array_key_exists($i,$votes)){
                $votes[$i] = 0;
            }
            else{
                $voteCount += intval($votes[$i]);
            }
        }
        unset($answer);
        unset($i);
        
        $exp = strtotime($item->expires); // Set an expires time varible based on the date the poll is set to end.
        if(isset($_COOKIE["sk_app_poll_voted"])){ // Check if the user has voted on any polls.
            $voted = explode(',',$_COOKIE["sk_app_poll_voted"]);
            $voted = array_flip($voted); // flip voted array to allow easy checking against keys to see if the user has already voted on this poll.
        }
        else{
            $voted = array(); // So we can check against a voted array without errors later, set the voted variable to an array if not set cookie is not found.
        }
        if(isset($_GET['vote'])){ // Check for the 'vote' query string parameter. This is set if a vote needs to be recorded because a vote link has been clicked.
            $voted[$item->sk_recid] = 1; // Set the voted variable for this poll.
            $votes[intval($_GET['vote'])] += 1;
            $voteCount += 1;
            //save the vote to this poll record in the database using the $saveitem function.
            $saveitem($item->sk_recid,'votes',implode(',',$votes)); // item record ID, record field (the hidden votes field), the new votes value. The votes value is based on the votes array implode to turn into a comma seperated string.
            setcookie("sk_app_poll_voted", implode(',',array_keys($voted)), time()+60*60*24*90,'/'); // Save a cookie to the user to not allow further voting and to just display poll results.
        }
        
        $str .= '<div class="SKYUI-polls">
            <h3 style="padding:0px;margin:0px 0px 10px 0px">' . $item->question . '</h3>'; // Set the opening CSS for the poll.
        if($exp > time() && !array_key_exists($item->sk_recid,$voted)){ // If the poll is not expired and has not been voted on by the current viewer, show the answer options and vote links. Vote links have a class as button, so they display as buttons.
            $answerindex = 0;
            foreach($answers as $i => $answer){ // setup the HREF in the vote link to point to this view, set the current page and set the vote answer number.
                $str .= '<div style="margin:5px 0; padding:3px 0;"><a href="#view=main&page='.$pageindex.'&vote='.$answerindex.'" class="button" style="margin-left: 0; margin-right: 5px;">Vote</a> <strong>' . $answer .'</strong></div>';
                $answerindex++;
            }
            unset($answer);
            unset($answerindex);
            $str .= '<p style="margin-top: 10px;">This poll was created on <strong>'.date("m/d/Y",$item->sk_created+ (get_option( 'gmt_offset' )*3600)).'</strong> and closes on <strong>'.date("m/d/Y",$exp+ (get_option( 'gmt_offset' )*3600)).'</strong></p>';
        }
        else{ // If the poll has expired or has already been voted on by the current viewer, draw the results.
            foreach($answers as $i => $answer){
                $answerVotes = $votes[$i] && $votes[$i] != '' ? $votes[$i] : 0;
                $percent = $answerVotes != 0 && $voteCount != 0 ? round($answerVotes/($voteCount/100)) : 0; // calculate percentages based on answer count and total poll answer count.
                $str .= '<div style="margin:5px 0; padding:3px 0;"><div style="margin-bottom: 3px;">'.$answer.' - <strong>Votes: '.$answerVotes.' ('.$percent.'%)</strong></div><div class="SKYUI-Poll-bar-outer"><div class="SKYUI-Poll-bar" style="width: '.$percent.'%;"></div></div>';
            }
            unset($answer);
            $str .= '<p style="margin-top: 10px;">Total Votes: <strong>'.$voteCount.'</strong></p><p style="margin-bottom: 0;">This poll was created on <strong>'.date("m/d/Y",$item->sk_created+ (get_option( 'gmt_offset' )*3600)).'</strong> and ';
            if($exp <= time()){
                $str .= 'closed on <strong>'.date("m/d/Y",$exp+ (get_option( 'gmt_offset' )*3600)).'</strong></p>';
            }
            else{
                $str .= 'closes on <strong>'.date("m/d/Y",$exp+ (get_option( 'gmt_offset' )*3600)).'</strong></p>';
            }
        }
        $str .= '</div>';
        if($recCount > 1){ // Setup same basic Older, Newer pageing. 
            $str .= '<!--D--><div style="text-align: center;">'; // App content can be devided by the <!--D--> tag to add the content after the tag to the footer of the app window instead of the body section.
            if($pageindex != $recCount -1){
                $str .= '<a href="#view=main&page='.($pageindex + 1).'" class="button" style="margin: 0 3px;">Older</a>';
            }
            if($pageindex != 0){
                 $str .= '<a href="#view=main&page='.($pageindex - 1).'" class="button" style="margin: 0 3px;">Newer</a>';
            }
            $str .= '</div>';
        }
    }
    if($str == ''){ // No active polls
        $str = 'There are no active polls.';
    }
    return $str;
}

// Polls Manage Records Output
function skysa_app_poll_manage_output($item){
    $str = '';
    $answers = explode(chr(13),$item->answers); // Get all the answers for the current poll.
    $votes = $item->votes; // Get all the votes.
    $votes = explode(',',$votes); // Turn the votes into an array.
    $voteCount = 0; // Set a total vote count variable to store the total number of votes for the poll.
        
    foreach($answers as $i => $answer){ // Count the votes
        if(!array_key_exists($i,$votes)){
            $votes[$i] = 0;
        }
        else{
            $voteCount += intval($votes[$i]);
        }
    }
    unset($answer);
    unset($i);
    foreach($answers as $i => $answer){
        $answerVotes = $votes[$i] && $votes[$i] != '' ? $votes[$i] : 0;
        $percent = $answerVotes != 0 && $voteCount != 0 ? round($answerVotes/($voteCount/100)) : 0; // calculate percentages based on answer count and total poll answer count.
        $str .= '<div style="margin:3px 0;"><div style="margin-bottom: 3px;">'.$answer.' - <strong>Votes: '.$answerVotes.' ('.$percent.'%)</strong></div><div style="height: 10px; border: 1px solid; border-color: #ddd #eee #fff #eee; background: #f5f5f5 ; -moz-box-shadow: inset 0 5px 5px rgba(0,0,0,0.05); -webkit-box-shadow: inset 0 5px 5px rgba(0,0,0,0.05); box-shadow: inset rgba(0,0,0,0.05) 0 5px 5px;"><div class="SKYUI-Poll-bar" style="width: '.$percent.'%; font-size: 10px; font-weight: bold; color: white; background: #166ccd; height: 10px; overflow: hidden; -moz-box-shadow: inset 0 0px 1px rgba(0,0,0,0.5), inset 0 5px 0px rgba(255,255,255,0.25), inset 0 0px 5px rgba(255,255,255,1); -webkit-box-shadow: inset 0 0px 1px rgba(0,0,0,0.5), inset 0 5px 0px rgba(255,255,255,1), inset 0 0px 5px rgba(255,255,255,1); box-shadow: inset rgba(0,0,0,0.5) 0 0px 1px, inset rgba(255,255,255,0.25) 0 5px 0px, inset rgba(255,255,255,1) 0 0px 5px;"></div></div>';
    }
    unset($answer);
    $str .= '<p style="margin: 3px 0;">Total Votes: <strong>'.$voteCount.'</strong></p>';
    return $str;
}

// Polls Created Function Variable
function skysa_app_poll_fvar_created($rec){
    if($rec['content'] && count($rec['content']) > 0 && $rec['option1'] == 'Yes'){
        foreach( $rec['content'] as $created => $item ){
            $exp = strtotime($item->expires);
            if($exp > time()){
                return $created+ (get_option( 'gmt_offset' )*3600);
                break;
            }
        }
    }
    return 0;
}

?>