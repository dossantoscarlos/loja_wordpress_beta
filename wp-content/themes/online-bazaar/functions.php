<?php
/**
 * Describe child theme functions
 *
 * @package MetroStore
 * @subpackage Online Bazaar
 * 
 */

/*-------------------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'online_bazaar_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function online_bazaar_setup() {
    
    $online_bazaar_theme_info = wp_get_theme();
    $GLOBALS['online_bazaar_version'] = $online_bazaar_theme_info->get( 'Version' );
}
endif;

add_action( 'after_setup_theme', 'online_bazaar_setup' );


/**
 * Register Google fonts for News Portal Lite.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'online_bazaar_fonts_url' ) ) :
    function online_bazaar_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Open+Sans, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Open+Sans font: on or off', 'online-bazaar' ) ) {
            $font_families[] = 'Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i';
        } 

        /*
         * Translators: If there are characters in your language that are not supported
         * by Raleway, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'online-bazaar' ) ) {
            $font_families[] = 'Raleway:100,200,200i,300,400,500,600,700,800';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Managed the theme default color
 */
function online_bazaar_customize_register( $wp_customize ) {

	global $wp_customize;

    $wp_customize->remove_section( 'metrostore_header_service_area' );

    /**
      * Theme Primary Color
    */
    $wp_customize->add_section( 'online_bazaar_primary_theme_color', array(
      'title'    => esc_html__('Primary Color Options', 'online-bazaar'),
      'priority' => 2,
    ));

        $wp_customize->add_setting('online_bazaar_primary_theme_color_options', array(
            'default' => '#e63737',
            'sanitize_callback' => 'sanitize_hex_color',        
        ));

        $wp_customize->add_control('online_bazaar_primary_theme_color_options', array(
            'type'     => 'color',
            'label'    => esc_html__('Primary Colors', 'online-bazaar'),
            'section'  => 'online_bazaar_primary_theme_color',
            'setting'  => 'online_bazaar_primary_theme_color_options',
        ));

}

add_action( 'customize_register', 'online_bazaar_customize_register', 20 );

/**
 * Enqueue child theme styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'online_bazaar_scripts', 20 );

function online_bazaar_scripts() {
    
    global $online_bazaar_version;

     wp_enqueue_style( 'online-bazaar-google-font', online_bazaar_fonts_url(), array(), null );
    
    wp_dequeue_style( 'metrostore-style' );
    
	wp_enqueue_style( 'metrostore-parent-style', get_template_directory_uri() . '/style.css', array(), esc_attr( $online_bazaar_version ) );

    wp_enqueue_style( 'online-bazaar-style', get_stylesheet_uri(), array(), esc_attr( $online_bazaar_version ) );
    
    
    $online_bazaar_primary_color = get_theme_mod( 'online_bazaar_primary_theme_color_options', '#ff3366' );
    
    $output_css = '';
    

    $output_css .= "
        .woocommerce-product-search button,
        .mini-cart .basket a .fa-shopping-cart,
        .headerlinkmenu div.links div a,
        .hove-style-bg.mtmegamenu ul>li.current-menu-item, 
        .hove-style-bg.mtmegamenu ul>li:hover,
        .ms-slider .flexslider .caption-adjust .ms-btn a:hover,
        .flex-direction-nav .flex-next,
        .flex-direction-nav .flex-prev,
        .blog-posts .post-item .entry-more a,
        .woocommerce-product-search button:hover,
        .calendar_wrap caption,
        .scrollup,
        .slider-items-products .owl-buttons a:hover,
        .woocommerce #respond input#submit.alt, 
        .woocommerce a.button.alt, 
        .woocommerce button.button.alt, 
        .woocommerce input.button.alt,
        .readMore,
        footer .widget-title:before,
        .info-box-1.square-icon .info-box-icon,
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a,
        .no-results.not-found .backtohome a, 
        .error-404 .backtohome a,
        .icon-new-label,
        .woocommerce #respond input#submit,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
        .woocommerce a.button, 
        .woocommerce button.button, 
        .woocommerce input.button,
        .add-to-cart-mt:hover,
        .pagination-area ul li > .current,
        .pagination-area ul li a:hover, 
        .pagination-area ul li a.current,
        .pr-button .mt-button a:hover,
        .wishlist_table td.product-name a.button:hover,
        .entry-content .wpcf7 input[type='submit'], 
        .entry-content .wpcf7 input[type='button'],
        .wpcf7 input[type='submit'], 
        .wpcf7 input[type='button'],
        .single-collection:hover .collections-link::before,
        .home-nav-tabs>li.active>a, 
        .home-nav-tabs>li.active>a:hover, 
        .home-nav-tabs>li.active>a:focus,
        .woocommerce a.button.wc-forward,
        .collections-link::before{ 

                background-color: ". esc_attr( $online_bazaar_primary_color ) ."

            }\n";

    $output_css .= "
        .single-product .yith-wcwl-wishlistexistsbrowse.show a:hover, 
        .single-product .entry-summary .compare.button:hover, 
        .single-product .yith-wcwl-add-to-wishlist a.add_to_wishlist:hover,
        .woocommerce a.remove{ 

            color: ". esc_attr( $online_bazaar_primary_color ) ." !important;

        }\n";

    $output_css .= "
        .woocommerce div.product .woocommerce-tabs ul.tabs li:hover, 
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active{ 

            background-color: ". esc_attr( $online_bazaar_primary_color ) ." !important;

        }\n"; 

    $output_css .= "
        .woocommerce a.button.wc-forward:hover, 
        .woocommerce a.button.checkout:hover{ 

            color:#FFF!important;

        }\n"; 

    $output_css .= "
        @media (max-width: 767px){.top-cart .mm-toggle-wrap, .mm-toggle { 

            background-color:". esc_attr( $online_bazaar_primary_color ) .";

        } }\n";

    
    $output_css .= "
        .links .social ul.inline-mode li a:hover,
        .headerlinkmenu div.links div a:hover,
        .headerlinkmenu div.links div a:hover span,
        .header-top a:hover,

        a:hover,
        a.play-bnt i:hover,
        .woocommerce #respond input#submit:hover, 
        .woocommerce a.button:hover, 
        .woocommerce button.button:hover, 
        .woocommerce input.button:hover,
        .comment-left a:hover, 
        .comment-left a:hover:before,

        .woocommerce div.product p.price ins, 
        .woocommerce ul.products li.product .price ins, 
        .woocommerce ul.products li.product .price, 
        .woocommerce li.product .price ins, 
        .woocommerce li.product .price,
        .woocommerce .woocommerce-breadcrumb a:hover, 
        .woocommerce .woocommerce-breadcrumb a:hover,

        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, 
        .woocommerce-account .woocommerce-MyAccount-navigation ul li:hover a,

        .no-results.not-found .backtohome a:hover, 
        .error-404 .backtohome a:hover,

        .mtmegamenu ul > li.menu-item:hover a, 
        .mtmegamenu ul > li.page_item:hover a, 
        .mtmegamenu ul > li.current_page_item > a, 
        .mtmegamenu ul > li.current-menu-item > a, 
        .mtmegamenu ul > li.current_page_ancestor > a, 
        .mtmegamenu ul > li.current-menu-ancestor > a, 
        .mtmegamenu ul ul.sub-menu li.menu-item a:hover, 
        .mtmegamenu ul ul.children li.page_item a:hover,

        .woocommerce-message:before,

        .woocommerce #respond input#submit.alt:hover, 
        .woocommerce a.button.alt:hover, 
        .woocommerce button.button.alt:hover, 
        .woocommerce input.button.alt:hover,

        .woocommerce ul.cart_list li a:hover, 
        .woocommerce ul.product_list_widget li a:hover,
        .woocommerce ul.product_list_widget li span.quantity,

        .info-box-1:hover.square-icon .info-box-icon,

        .wishlist_table td.product-name a.button,
        .news h3 a:hover,
        .news ul li a:hover,
        .entry-content .wpcf7 input[type='submit']:hover, 
        .entry-content .wpcf7 input[type='button']:hover,
         .wpcf7 input[type='submit']:hover, 
        .wpcf7 input[type='button']:hover,
        .adress-element .fa,
        .widget a:hover, 
        .widget a:hover::before, 
        .widget li:hover::before,
        .woocommerce p.stars a:hover,
        .woocommerce-info:before,
        .woocommerce-MyAccount-content a:hover, 
        .woocommerce-MyAccount-content a:hover{ 

            color: ". esc_attr( $online_bazaar_primary_color ) ."

        }\n";
    
    $output_css .= "
        .woocommerce-product-search button,
        .headerlinkmenu div.links div a,
        .mtmegamenu ul ul.sub-menu, 
        .mtmegamenu ul ul.children,
        .ms-slider .flexslider .caption-adjust .ms-btn a:hover,
        .blog-posts .post-item .entry-more a,
        .widget-area .widget .widget-title,

        .woocommerce #respond input#submit, 
        .woocommerce a.button, 
        .woocommerce button.button, 
        .woocommerce input.button,
        .pagination-area ul li a:hover, 
        .pagination-area ul li a.current,
        .woocommerce div.product .woocommerce-tabs .panel,
        .woocommerce div.product .woocommerce-tabs ul.tabs:before,

        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, 
        .woocommerce-account .woocommerce-MyAccount-navigation ul li:hover a,
        .woocommerce-account .woocommerce-MyAccount-navigation ul li a,

        .wishlist_table td.product-name a.button,

        .woocommerce-account .woocommerce-MyAccount-content,
        .no-results.not-found .backtohome a, 
        .error-404 .backtohome a,

        .entry-content .wpcf7 input[type='submit'], 
        .entry-content .wpcf7 input[type='button'],
        .entry-content .wpcf7 input[type='submit']:hover, 
        .entry-content .wpcf7 input[type='button']:hover,
        .slider-items-products .owl-buttons a:hover,
        .slider-items-products .owl-buttons a:hover,
        .home-nav-tabs>li.active>a, 
        .home-nav-tabs>li.active>a:hover, 
        .home-nav-tabs>li.active>a:focus,
        .info-box-1:hover.square-icon .info-box-icon,
        .wpcf7 input[type='submit'], 
        .wpcf7 input[type='button'],
        .wpcf7 input[type='submit']:hover, 
        .wpcf7 input[type='button']:hover,
        .cross-sells h2, 
        .cart_totals h2, 
        .woocommerce-billing-fields h3, 
        .woocommerce-shipping-fields h3, 
        #order_review_heading, 
        .upsells h2, 
        .related h2, 
        .woocommerce-account .woocommerce h2,
        .woocommerce-message,
        .woocommerce-info,
        .woocommerce-cart .wc-proceed-to-checkout a.checkout-button{ 

            border-color: ". esc_attr( $online_bazaar_primary_color ) ."

        }\n";

    wp_add_inline_style( 'online-bazaar-style', $output_css );
    
}


/**
 * Managed the widget sections
 *
 * @since 1.0.0
 */
add_action( 'widgets_init', 'online_bazaar_register_widgets', 11 );

function online_bazaar_register_widgets() {
    
    unregister_sidebar( 'footer_five' );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Payment Logo or ADS', 'online-bazaar' ),
        'id'            => 'payment_logo',
        'description'   => esc_html__( 'Add widgets here.', 'online-bazaar' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title links-title">',
        'after_title'   => '</h3>',
    ));
    
}


/**
 * Remove Parent Widget area & add Child Widget area
 *
 * @since 1.0.0
 */
add_action( 'init' , 'online_bazaar_functiona_area' , 15 );

function online_bazaar_functiona_area() {

    remove_action('metrostore_footer_widget','metrostore_footer_widget_area', 10 );

}

/**
 * Footer Widget Area
*/
if ( ! function_exists( 'metrostore_footer_widget_area' ) ) {

    function metrostore_footer_widget_area(){ ?>

    <div class="footer_widget_main">
        <div class="container">
          <div class="row">
          
            <?php if ( is_active_sidebar('footer_one') ) { ?>
                <div class="col-sm-6 col-md-3 col-xs-12 footer-widget">
                    <?php dynamic_sidebar('footer_one'); ?>
                </div>
            <?php } ?>

            <?php if ( is_active_sidebar('footer_two') ) { ?>
                <div class="col-sm-6 col-md-3 col-xs-12 collapsed-block footer-widget">
                    <?php dynamic_sidebar('footer_two'); ?>
                </div>
            <?php } ?>

            <?php if ( is_active_sidebar('footer_three') ) { ?>
                <div class="col-sm-6 col-md-3 col-xs-12 collapsed-block footer-widget">
                    <?php dynamic_sidebar('footer_three'); ?>
                </div>
            <?php } ?>

            <?php if ( is_active_sidebar('footer_four') ) { ?>
                <div class="col-sm-6 col-md-3 col-xs-12 collapsed-block footer-widget">
                    <?php dynamic_sidebar('footer_four'); ?>
                </div>
            <?php } ?>

          </div>
        </div>
    </div>

    <?php

    }

}
add_action( 'metrostore_footer_widget', 'metrostore_footer_widget_area', 11 );


/**
 * Footer Payment Logo Section
*/

if ( ! function_exists( 'metrostore_footer_payment_logo' ) ) {
    function metrostore_footer_payment_logo(){ ?>
        <div class="footer-payment-logo">
            <div class="container">
                <div class="row">
                    <?php if ( is_active_sidebar('payment_logo') ) { ?>
                        <div class="payment-accept">
                            <?php dynamic_sidebar('payment_logo'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>          
    <?php
    }
}
add_action( 'metrostore_footer_widget', 'metrostore_footer_payment_logo', 12 );