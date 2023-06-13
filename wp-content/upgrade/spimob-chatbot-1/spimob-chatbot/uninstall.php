<?php

/**
  * Trigger this file on Plugin uninstall
  * 
  * @package SpimobChatbotWidget
  */


if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;

}

delete_option( 'spimob_chatbot_api_key' );
