<?php
/**
 * @uses htcc-chatbot.php
 * #browser support 
 * safari 12
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

if ( ! class_exists( 'HTCC_Browser' ) ) :

class HTCC_Browser {


    public function __construct() {
        $this->messageus();
        $this->browserjs();
    }

    public function messageus() {

        $htcc_options = ht_cc()->variables->get_option;

        $fb_page_id = esc_attr( $htcc_options['fb_page_id'] );
        $fb_app_id = esc_attr( $htcc_options['fb_app_id'] );

        $htcc_broser = get_option('htcc_browser');


        $p1 = esc_attr( $htcc_broser['p1'] );
        $p2 = esc_attr( $htcc_broser['p2'] );
        $p1_value = esc_attr( $htcc_broser['p1_value'] );
        $p2_value = esc_attr( $htcc_broser['p2_value'] );
        $size = esc_attr( $htcc_broser['size'] );
        $color = esc_attr( $htcc_broser['color'] );


        $css = "$p1: $p1_value; $p2: $p2_value";
        ?>

        <!-- fb-messengermessageus -->

        <div class="htcc_message_us" style="z-index: 99999; position: fixed; <?php echo $css ?>">
            <div class="" 
            messenger_app_id="<?php echo $fb_app_id ?>" 
            page_id="<?php echo $fb_page_id ?>"
            color="<?php echo $color ?>"
            size="<?php echo $size ?>">
            </div>
        </div>


        <?php
    }



    // enqueue - browser.js 
    public function browserjs() {
        // in pro version add content in app.js
        if ( 'true' !== HTCC_PRO ) {
            wp_enqueue_script( 'htcc_browserjs', plugins_url( 'inc/browser/browser.js', HTCC_PLUGIN_FILE ), array('jquery'), HTCC_VERSION, true );
        }
    }


}

$htcc_browser = new HTCC_Browser();

// add_action('wp_enqueue_scripts', array( $htcc_browser, 'browserjs' ) );

endif; // END class_exists check