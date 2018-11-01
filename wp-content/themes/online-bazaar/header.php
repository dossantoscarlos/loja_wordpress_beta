<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Online Bazaar
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- mobile menu -->
<?php do_action( 'metrostore-mobile-menu' ); ?>

<div id="page" class="site">

	<?php 
		/**
		 * @see  metrostore_skip_links() - 5
		 */	
		do_action( 'metrostore_header_before' ); 
	?>

		<div class="header-top">
		  <div class="container">
		    <div class="row">		      
			    <div class="quickinfo_main pull-left">
    				<ul class="quickinfo">
    					<?php
    						$email_address    = get_theme_mod('metrostore_email_title');
    						$phone_number     = get_theme_mod('metrostore_phone_number');
    						$phonenumber      = preg_replace("/[^0-9]/","",$phone_number);
    						$map_address      = get_theme_mod('metrostore_map_address');
    						$shop_open_time   = get_theme_mod('metrostore_start_open_time');
    					
    					if(!empty( $email_address )) { ?>        							
    	                    <li>
    	                    	<a href="mailto:<?php echo esc_attr( antispambot( $email_address ) ); ?>">
    	                    		<i class="fa fa-envelope-o"></i>
    	                    		<?php echo esc_attr( antispambot( $email_address ) ); ?>
    	                    	</a>
    	                    </li>
                        <?php }  ?>
                        
                        <?php if(!empty( $phone_number )) { ?>        							
    	                    <li>
    	                    	<i class="fa fa-volume-control-phone"></i>
    	                    	<a href="tel:<?php echo esc_attr( $phonenumber ); ?>">
    	                    		<?php echo esc_attr( $phone_number ); ?>
    	                    	</a>
    	                    </li>
                        <?php }  ?>
                        
                        <?php if(!empty( $map_address )) { ?>        							
    	                    <li>        	                    	
	                    		<i class="fa fa-map"></i>
	                    		<?php echo esc_attr( $map_address ); ?>
    	                    </li>
                        <?php }  ?>
                        
                        <?php if(!empty( $shop_open_time )) { ?>        							
    	                    <li>
    	                    	<i class="fa fa-clock-o"></i>
    	                    	<?php echo esc_attr( $shop_open_time ); ?>
    	                    </li>
                        <?php }  ?>        	                    
    				</ul>
			        
			    </div>

			    <div class="headerlinkmenu pull-right">
			        <div class="links">

        				<div class="social">
        					<ul class="inline-mode">
        						
        						<?php if ( esc_url( get_theme_mod('metrostore_social_facebook') ) ) { ?>
        	                    <li class="social-network fb"> <a title="Connect us on Facebook" href="<?php echo esc_url(get_theme_mod('metrostore_social_facebook'));?>" <?php if ( esc_attr( get_theme_mod('metrostore_social_facebook_checkbox', 0 ) ) == 1 ) {  echo "target=_blank"; } ?>><i class="fa fa-facebook"></i></a> </li>
        		                <?php } ?>

        		                <?php if ( esc_url( get_theme_mod('metrostore_social_twitter') ) ) { ?>
        		                    <li class="social-network tw"> <a title="Connect us on Twitter" href="<?php echo esc_url( get_theme_mod('metrostore_social_twitter') ); ?>" <?php if (esc_attr( get_theme_mod('metrostore_social_twitter_checkbox', 0 ) ) == 1 ){ echo "target=_blank"; } ?>><i class="fa fa-twitter"></i></a> </li>
        		                <?php } ?>

        		                <?php if ( esc_url( get_theme_mod('metrostore_social_googleplus') ) ) { ?>
        		                    <li class="social-network googleplus"> <a href="<?php echo esc_url( get_theme_mod('metrostore_social_googleplus') ); ?>" <?php if (esc_attr(get_theme_mod('metrostore_social_googleplus_checkbox', 0 ) ) == 1) { echo "target=_blank"; } ?>><i class="fa fa-google-plus"></i></a> </li>
        		                <?php } ?>

        		                <?php if ( esc_url( get_theme_mod('metrostore_social_youtube') ) ) { ?>
        		                    <li class="social-network youtube"> <a href="<?php echo esc_url( get_theme_mod('metrostore_social_youtube') ); ?>" <?php if (esc_attr(get_theme_mod('metrostore_social_youtube_checkbox', 0 ) ) == 1) { echo "target=_blank"; } ?>><i class="fa fa-youtube"></i></a> </li>
        		                <?php } ?>

        		                <?php if (esc_url(get_theme_mod('metrostore_social_instagram'))) { ?>
        		                    <li class="social-network instagram"> <a title="Connect us on Instagram" href="<?php echo esc_url( get_theme_mod('metrostore_social_instagram') ) ; ?>" <?php if ( esc_attr( get_theme_mod('metrostore_social_instagram_checkbox', 0 ) ) == 1) { echo "target=_blank"; } ?>><i class="fa fa-instagram"></i></a> </li>
        		                <?php } ?>

        		                <?php if ( esc_url( get_theme_mod('metrostore_social_linkedin') ) ) { ?>
        		                    <li> <a href="<?php echo esc_url(get_theme_mod('metrostore_social_linkedin')); ?>" <?php if ( esc_attr( get_theme_mod('metrostore_social_linkedin_checkbox', 0 ) ) == 1 ){ echo "target=_blank"; } ?>><i class="fa fa-linkedin"></i></a> </li>
        		                <?php } ?>

        		                <?php if ( esc_url( get_theme_mod('metrostore_social_pinterest') ) ) { ?>
        		                    <li> <a href="<?php echo esc_url(get_theme_mod('metrostore_social_pinterest')); ?>" <?php if ( esc_attr( get_theme_mod('metrostore_social_pinterest_checkbox', 0 ) ) == 1 ){ echo "target=_blank"; } ?>><i class="fa fa-pinterest"></i></a> </li>
        		                <?php } ?>
        						
        					</ul>
        				</div>


			          	<?php if(function_exists( 'metrostore_wishlist' )) {  ?>
				          	<div class="wishlist">
				          		<?php metrostore_wishlist(); ?>
				          	</div>
			          	<?php } ?>

			          	<div class="myaccount">
			          		<a title="My Account" href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
			          			<i class="fa fa-user"></i>
			          			<span class="hidden-xs"><?php esc_html_e('My Account', 'online-bazaar'); ?></span>
			          		</a>
			          	</div>
			          	
			    	</div>
		      	</div>

		    </div>
		  </div>
		</div><!-- End header-top -->

		<div class="container">
		    <div class="row">    
			    <div class="col-md-3 col-xs-12 col-sm-4">
			        <?php if( metrostore_is_woocommerce_activated() ){  echo get_product_search_form(); } ?><!-- End Search --> 
			    </div>

				<div class=" col-sm-4 col-xs-12 col-md-6 text-center">
					<div class="logo site-branding">
					    <?php
					        if ( function_exists( 'the_custom_logo' ) ) {
					            the_custom_logo();
					        }
					    ?>
					    <h1 class="site-title">
					        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					            <?php bloginfo( 'name' ); ?>
					        </a>
					    </h1>
					    <?php
					        $description = get_bloginfo( 'description', 'display' );
					        if ( $description || is_customize_preview() ) : 
					    ?>
					        <p class="site-description"><?php echo $description; ?></p>
					    <?php endif; ?>
					</div><!-- .site-branding -->
				</div><!-- End Header Logo --> 
			    
			    <div class="col-md-3 col-xs-12 col-sm-4 top-cart">
			        <div class="mm-toggle-wrap">
						<div class="mm-toggle">
							<i class="fa fa-align-justify"></i>
							<span class="mm-label"><?php esc_html_e('Menu','online-bazaar'); ?></span> 
						</div>
			        </div>

			        <?php if( metrostore_is_woocommerce_activated() ){ ?>
		        		<div class="top-cart-contain">
		        		    <div class="mini-cart">
		        		        <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
		        		            <a href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>">
		        		                <i class="fa fa-shopping-cart"></i>
		        		                <span class="cart-title">
		        		                    <?php esc_html_e( 'Shopping Cart', 'online-bazaar' ); ?> ( <?php echo WC()->cart->get_cart_contents_count(); ?> )
		        		                </span>
		        		            </a>
		        		        </div>
		        		        <div>
		        		            <div class="top-cart-content">
		        		                <div class="block-subtitle"><?php esc_html_e('Recently added item(s)','online-bazaar'); ?></div>
		        		                <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
		        		            </div>
		        		        </div>
		        		    </div>
		        		</div>		            		
		            <?php }  ?>
			    </div><!-- top cart -->
		    </div>
		</div>

	<?php
	 	do_action( 'metrostore_header_after' ); 
	?>

<nav class="mainnav">
    <div class="container">
      <div class="row">
        <div class="mtmegamenu hove-style-bg text-center">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </div>
      </div>
    </div>
</nav><!-- end nav -->

<?php
	if( is_front_page() ){
		$slider_options = esc_attr( get_theme_mod( 'metrostore_home_slider_options', 'enable' ) );
		if( !empty( $slider_options ) && $slider_options == 'enable' ){
			do_action( 'metrostore_slider' );
		}
	}	
?>

<div id="content" class="site-content">
