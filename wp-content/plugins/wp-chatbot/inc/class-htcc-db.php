<?php
/**
 * Database - values, default values .. 
 * plugin details
 * plugin settings - options page
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HTCC_db' ) ) :

class HTCC_db {


    /**
     * Add plugin Details to db - wp_options table
     * Add plugin version to db - useful while updating plugin
     * 
     * @uses class-htcc-register -> activate()
     * @return void
     */
    public static function db_plugin_details() {

        // plugin details 
        $plugin_details = array(
            'version' => HTCC_VERSION,
        );

        // Always use update_option - override new values .. don't preseve already existing values
        update_option( 'htcc_plugin_details', $plugin_details );
    }




    /**
     * options page - default values.
     * 
     * @uses class-htcc-register -> activate()
     * @return void
     */
    public static function db_default_values() {

        /**
         * plugin details 
         * name: htcc_options
         * @key enable - 1, means true. show the button.
         * 
         * greeting_dialog_display  -  show, hide, fade
         * greeting_dialog_delay  -  number in seconds with in quotes
         */
        $values = array(
            // 'enable' => '1', Deprecated
            'fb_page_id' => '',
            'fb_app_id' => '',
            'log_events' => 'yes',
            'fb_sdk_lang' => 'en_US',

            'fb_color' => '',
            'fb_greeting_login' => '',
            'fb_greeting_logout' => '',
            
            'list_hideon_pages' => '',
            'list_hideon_cat' => '',
            'shortcode' => 'chatbot',

            'greeting_dialog_display' => '',
            'greeting_dialog_delay' => '',
            'ref' => '',
        );

        $db_values = get_option( 'htcc_options', array() );
        $update_values = array_merge($values, $db_values);
        update_option('htcc_options', $update_values);
    }




    /**
     * #browser
     * options page - default values. - htcc_browser
     * 
     * @uses class-htcc-register -> activate()
     * @return void
     */
    public static function htcc_browser() {

        /**
         * name: htcc_browser
         * 
         * checkbox 
         *  safari_12  -  checked for enable .. 
         */
        $values = array(
            'color' => 'blue',
            'p1' => 'bottom',
            'p2' => 'left',
            'p1_value' => '18px',
            'p2_value' => '18px',
            'size' => 'large',
        );

        $db_values = get_option( 'htcc_browser', array() );
        $update_values = array_merge($values, $db_values);
        update_option('htcc_browser', $update_values);
    }
    



}

endif; // END class_exists check