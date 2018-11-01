<?php
/**
 * @uses admin.php
 * 
 * #browser
 * to  support for safari 12 
 * 
 * this page may delete, once customer chat plugin supports safari 12 
 * 
 */




 
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Admin_HTCC_Browser' ) ) :

class Admin_HTCC_Browser {


    // wp-chatbot pro menu
    public function menu() {
        add_submenu_page(
            'wp-chatbot',
            'WP-Chabot browser',
            'Browser',
            'manage_options',
            'wp-chatbot-browser-support',
            array( $this, 'settings_page' )
        );
    }


    /**
     * 
     * Call back from - $this->menu -  add_submenu_page
     *
     * @since 3.0
     */
    public function settings_page() {
        
        if ( ! current_user_can('manage_options') ) {
            return;
        }

        ?>

        <div class="wrap">

            <?php settings_errors(); ?>

            <div class="row">
                <div class="col s12 m12 xl8 options">
                    <form action="options.php" method="post" class="">
                        <?php settings_fields( 'htcc_settings_fields_browser' ); ?>
                        <?php do_settings_sections( 'htcc_settings_sections_browser' ) ?>
                        <?php submit_button() ?>
                        <p class="description">Once <a target="_blank" href="https://developers.facebook.com/docs/messenger-platform/discovery/customer-chat-plugin">Customer chat plugin</a> supports safari 12, we plan to remove this feature and update the plugin 'or' you can simply uncheck the enable option </p>
                        <br>
                        <p class="description">approximately <a href="https://caniuse.com/usage-table">1 percent uses Safari 12</a> (29th October, 2018), We know how important it will be that why we added this feature</p>
                    </form>
                </div>
                <!-- <div class="col s12 m12 xl6 ht-cc-admin-sidebar">
                </div> -->
            </div>

        </div>

        <?php
    }


    /**
     * Options page - Regsiter, add section and add setting fields
     *
     * @uses action hook - admin_init
     * 
     * @since 3.0
     * @return void
     */
    public function settings() {

        register_setting( 'htcc_settings_fields_browser', 'htcc_browser' , array( $this, 'options_sanitize' ) );
        
        add_settings_section( 'htcc_browser_section', '', array( $this, 'section_cb' ), 'htcc_settings_sections_browser' );
        
        add_settings_field( 'safari_12', __( 'Browser Support' , 'wp-chatbot' ), array( $this, 'safari_12_cb' ), 'htcc_settings_sections_browser', 'htcc_browser_section' );
        // add_settings_field( 'fb_page_id', __( 'Facebook Page ID' , 'wp-chatbot' ), array( $this, 'fb_page_id_cb' ), 'htcc_settings_sections_browser', 'htcc_browser_section' );
        
    }


    // section heading
    function section_cb() {
        echo '<h1>Browser Support ( Safari 12 ) </h1>';
        ?>
        <p class="description" style="background-color: #e2e2e2; max-width: 455px;"> This is beta, temporary feature until <a target="_blank" href="https://developers.facebook.com/docs/messenger-platform/discovery/customer-chat-plugin">Customer chat plugin</a> not supports Safari 12  </p>
        <br>
        <!-- <p class="description"><a target="_blank" href="https://developers.facebook.com/docs/messenger-platform/discovery/customer-chat-plugin"><?php _e( 'Customer chat plugin' , 'wp-chatbot' ) ?></a> <?php _e( ' temporarily not supporting safari 12 ' , 'wp-chatbot' ) ?>   </p> -->
        <!-- <p class="description"><?php _e( '1 to 2 percent may use safari 12, but our concept is - you should not miss your website users from communication' , 'wp-chatbot' ) ?>   </p> -->
        <p class="description">In Safari 12, this feature adds 'message us' button  </p>
        <p class="description">When user clicks on 'Message Us' button based on device navigates to Messenger.com or Messenger App</p>
        <!-- <p class="description">Once <a target="_blank" href="https://developers.facebook.com/docs/messenger-platform/discovery/customer-chat-plugin">Customer chat plugin</a> supports safari 12, we plan to remove this feature and update the plugin or you can simply remove the feature by uncheck the enable option </p> -->
        <!-- <p class="description">Facebook App id also needed to make this work, please add 'app id' in main plugin settings  </p> -->
        <br><br>
        <?php
    }
    
    
    
    // checkboxes - where to run / update the values ..
    public function safari_12_cb() {
        $options = get_option('htcc_browser');
        
        $color_value = $options['color'];
        $size_value = $options['size'];
        $p1 = $options['p1'];
        $p2 = $options['p2'];
        ?>
        <?php
        
        // safari_12 - enable
        if ( isset( $options['safari_12'] ) ) {
            ?>
            <p>
                <label>
                    <input name="htcc_browser[safari_12]" type="checkbox" value="1" <?php checked( $options['safari_12'], 1 ); ?> id="safari_12" />
                    <span><?php _e( 'Enable Message Us button in safari 12' , 'wp-chatbot' ) ?></span>
                </label>
            </p>
            <?php
        } else {
            ?>
            <p>
                <label>
                    <input name="htcc_browser[safari_12]" type="checkbox" value="1" id="safari_12" />
                    <span><?php _e( 'Enable Message Us button in safari 12' , 'wp-chatbot' ) ?></span>
                </label>
            </p>
            <?php
        }
        
        ?>

        <p class="description"><?php _e( 'If checked, Message Us button will appear on safari 12 browser ' , 'wp-chatbot' ) ?> </p>
        <br><br>

        <!-- color -->
        <div class="row">
            <div class="input-field col s12">
                <label for=""><?php _e( 'Color' , 'wp-chatbot' ) ?></label>
                <select name="htcc_browser[color]" class="select-1">
                <option value="blue" <?php echo $color_value == "blue" ? 'SELECTED' : ''; ?> >Blue (default)</option>
                <option value="white" <?php echo $color_value == "white" ? 'SELECTED' : ''; ?> >White</option>
                </select>
            </div>
        </div>

        <br>

        <!-- size -->
        <div class="row">
            <div class="input-field col s12">
                <label for=""><?php _e( 'Size' , 'wp-chatbot' ) ?></label>
                <select name="htcc_browser[size]" class="select-1">
                <option value="standard" <?php echo $size_value == "standard" ? 'SELECTED' : ''; ?> >standard</option>
                <option value="large" <?php echo $size_value == "large" ? 'SELECTED' : ''; ?> >large (default)</option>
                <option value="xlarge" <?php echo $size_value == "xlarge" ? 'SELECTED' : ''; ?> >xlarge</option>
                </select>
            </div>
        </div>


        <br>

        <!-- p1 -->
        <div class="input-field col s12">
            <label for=""><?php _e( 'position' , 'wp-chatbot' ) ?></label>
            <select name="htcc_browser[p1]" class="select-1">
            <option value="bottom" <?php echo $p1 == "bottom" ? 'SELECTED' : ''; ?> >bottom</option>
            <option value="top" <?php echo $p1 == "top" ? 'SELECTED' : ''; ?> >top</option>
            </select>
            
            <!-- p1 value -->
            <input type="text" name="htcc_browser[p1_value]" id="p1_value" value="<?php echo esc_attr( $options['p1_value'] ) ?>">
        </div>


        <!-- p2 -->
        <div class="input-field col s12">
            <label for=""><?php _e( 'position' , 'wp-chatbot' ) ?></label>
            <select name="htcc_browser[p2]" class="select-1">
            <option value="right" <?php echo $p2 == "right" ? 'SELECTED' : ''; ?> >right</option>
            <option value="left" <?php echo $p2 == "left" ? 'SELECTED' : ''; ?> >left</option>
            </select>

            <!-- p2 value -->
            <input type="text" name="htcc_browser[p2_value]" id="p2_value" value="<?php echo esc_attr( $options['p2_value'] ) ?>">
        </div>


        <?php
        
    }



   







    /**
     * Sanitize each setting field as needed
     *
     * @since 1.0
     * @param array $input Contains all settings fields as array keys
     */
    public function options_sanitize( $input ) {

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'not allowed to modify - please contact admin ' );
        }

        $new_input = array();

        foreach ($input as $key => $value) {
            if( isset( $input[$key] ) ) {
                $new_input[$key] = sanitize_text_field( $input[$key] );
            }
        }


        return $new_input;
    }





}



$admin_htcc_Browser = new Admin_HTCC_Browser();
add_action('admin_menu', array($admin_htcc_Browser, 'menu') );
add_action('admin_init', array($admin_htcc_Browser, 'settings') );


endif; // END class_exists check