<?php
wbc_saveAPIKey();

 function wbc_saveAPIKey()
{
   if ( isset($_POST['api_key']) ){
    $api_key = sanitize_text_field( $_POST['api_key'] );
    $retrieved_nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($retrieved_nonce, 'wbc_api_key_form' ) ) die( 'Failed security check' );

     if (wbc_checkAPIKey($api_key)){
       update_option('spimob_chatbot_api_key', $api_key);
     }
     if (isset($_POST['url'])){
       update_option('spimob_chatbot_url', $_POST['url']);
     }
   }
 }
   
   function wbc_checkAPIKey($api_key){
     $body = wp_remote_retrieve_body( wp_remote_get('https://core.chatbots.ovh/api/verify_api_key/'.$api_key ) );
     $body = json_decode($body);
	 
	
     if ($body == "success"){
       echo '<div class="updated notice">
       <p>Valid API Key ! ChatBot.tn Plugin added successfully</p>
   </div>';
       return true;
     }else{
       echo '<div class="error notice">
       <p>Not Valid API Key ! </p>
   </div>';
   return false;
     }
   }
   ?>

<div class="wrap">
   <div id="icon-options-general" class="icon32"> <br></div>
   <div class="metabox-holder" style="display: block;margin-left: auto;margin-right: auto; width: 60%; padding: 50px">
      <div class="postbox" style="padding: 40px">
         <center>
         <h1>
         <a href="https://www.chatbot.tn/" style="text-decoration: none;" target="_blank">
         <img src="<?=plugins_url( 'images/logo1.png', __FILE__ )?>" style="width: 30%"/></a>
            </h1>
            
            <div style="background-color: #85C1E9;" class="notice wcfm_addon_inactive_notice_box wcfmmp_addon_inactive_notice_box" id="wcfm-groups-sttafs-notice">
              <br>
              <h2 style="color:white;font-weight: 400;line-height: 31px;">
              The easiest way to design, build and publish your chatbot for your website and your Facebook Messenger in minutes. 
              </h2>
              <p>To get your API Key, please login to <a href="https://www.chatbot.tn/" target="_blank">ChatBot.tn</a> and follow the below tutorial.
              </p>				
              <a href="https://developers.chatbot.tn/" class="button button-primary promo-btn" target="_blank">Commencer Gratuitement</a><br><br>
            </div>
            
            <form method="post" action="<?= esc_url( $_SERVER['REQUEST_URI'] )?>">
              <?php wp_nonce_field('wbc_api_key_form'); ?>
               <div style="margin-top: 30px;" >
                  <label><strong> API Key : </strong></label> &nbsp;&nbsp;
                  <input type="text" name="api_key" value="<?php echo get_option( 'spimob_chatbot_api_key' ); ?>" placeholder="Enter API Key here" required style="width: 70%;" />
                  <br /><br /><br />
				          
                  <div class="field_wrapper">
                  
                  <div>
                  <label><strong> Exclude Bot Url : </strong></label> &nbsp;&nbsp;&nbsp;
                  <input type="text" name="url[]" value="<?php if(get_option( 'spimob_chatbot_url' )!=''){ echo get_option( 'spimob_chatbot_url' )[0]; }?>" placeholder="Enter Bot url here" style="width:66%"/>
                  <a href="javascript:void(0);" class="add_button" title="Add field"><img src="../wp-content/plugins/spimob-chatbot/images/add-icon.png"/></a>
                 </div>
                 <span>URLs where Bot will not be seen.</span>


                  <?php if(get_option( 'spimob_chatbot_url' )!=''){ 
                    $urlength = count(get_option( 'spimob_chatbot_url' ));
                    for($i=1; $i<$urlength; $i++) { ?>
                    <div>
                    <label><strong> Exclude Bot Url : </strong></label> &nbsp;&nbsp;&nbsp;
                    <input type="text" name="url[]" value="<?php if(get_option( 'spimob_chatbot_url' )!=''){ echo get_option( 'spimob_chatbot_url' )[$i]; }?>" placeholder="show bot on page url" style="width:66%;margin-top:1em" />
                    <a href="javascript:void(0);" class="remove_button"><img src="../wp-content/plugins/spimob-chatbot/images/remove-icon.png"/></a>
                    </div>
                  <?php } } ?>
                    </div>
                    <br /><br /><br />
                    <input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit">
               </div>
			         <!-- <span>URLs where Bot will not be seen.</span> -->
			   
            </form>
         </center>
      </div>
   </div>
</div>
<!------------------------------2EME BLOC POUR LA VEDIO---------------------------------------->

<div class="wrap">
   <div id="icon-options-general-vedio" class="icon32"> <br></div>
   <div class="metabox-holder" style="display: block;margin-left: auto;margin-right: auto; width: 60%; padding: 10px">
      <div class="postbox" style="padding: 40px">
         <center>
         <h1><a href="https://www.chatbot.tn/plugin/chatbox-chatbot-wordpress-plugin/" target="_blank">Comment ajouter ChatBot.tn ChatBox Plugin sur WordPress</a></h1>
         <br/>
         <iframe width="700" height="400" src="https://www.youtube.com/embed/2o21shsromA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>         
         </center>
      </div>
   </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function( $ ) {
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><label><strong> Page URl : </strong></label> &nbsp;&nbsp;&nbsp;<input type="text" name="url[]" value="" placeholder="show bot on page url" style="width: 66%;margin-top:1em"/><a href="javascript:void(0);" class="remove_button"><img src="../wp-content/plugins/spimob-chatbot/images/remove-icon.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x <= maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>