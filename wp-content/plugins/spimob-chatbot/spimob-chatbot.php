<?php
global $wp;
/**
  * Trigger this file on Plugin uninstall
  * 
  * @package SpimobChatbotWidget
  */
/*
Plugin Name: ChatBot.tn Plugin
Plugin URI: https://www.chatbot.tn/
description: ChatBot.tn is the easiest way to build a no-code chatbot and Live chat for your business.
Version: 1.2.1
Author: Spimob.io
Author URI: https://www.spimob.io/
License: GPLv2 or later
Text Domain : spimob-chatbot
*/

/*
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
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Added support for whatsapp & SMS

define('WBC_LICENSE', true );
defined( 'ABSPATH' ) or die( 'You cannot accesss this file' );
if ( ! function_exists( 'add_action' ) ){
	echo "Hey, You cannot access this file";
}

add_action( 'admin_menu', 'wbc_register_custom_menu_page' );
add_action( 'wp_footer', 'wbc_footer_scripts' );
  
function wbc_register_custom_menu_page(){

wp_register_style('spimob_chatbot_dashicons', plugins_url('css/spimob-chatbot.css',__FILE__));
wp_enqueue_style('spimob_chatbot_dashicons');

     add_menu_page('ChatBot.tn', 'ChatBot.tn', 'manage_options', 'spimob_api_key', 'wbc_add_api_key_page','dashicons-spimob-chatbot');
  
}

function wbc_add_api_key_page () {
  // echo 'this is where we will edit the variable';
	include_once("api_key.php");
}

// mt_settings_page() displays the page content for the Test Settings submenu
function mt_settings_page() {
    echo "<h2>" . __( 'Footer Settings Configurations', 'menu-test' ) . "</h2>";
	include_once('footer_settings_page.php');
}

function deactivate(){

}


function wbc_footer_scripts(){
    $urls = get_option('spimob_chatbot_url');

  if (get_option('spimob_chatbot_api_key') && (get_option('spimob_chatbot_url')[0] == '' || !in_array("https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $urls) || !in_array("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $urls) || !in_array($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $urls))){

?>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://developers.chatbot.tn/assets/chatbox/chatbot.tn.js"></script>
      <script>$("body").chatbot({"uid":"<?php echo get_option('spimob_chatbot_api_key'); ?>"});</script>


<?php
      }
}