<?php
/*
Plugin Name: Woo Multi Tab Product
Description: A plugin to display WooCommerce products with category tabs.
Version: 1.0
Author: Your Name
License: GPL2
*/

// Ensure this file is loaded within WordPress.
defined('ABSPATH') || exit;

add_action( 'wp_enqueue_scripts', 'woo_product_tab_assets' );
function woo_product_tab_assets() {
    wp_enqueue_style( 'woo-product-tab', plugins_url( '/assets/tabs.css' , __FILE__ ) );
    wp_enqueue_script( 'woo-product-jq', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    wp_enqueue_script( 'woo-product-tab', plugins_url( '/assets/tabs.js' , __FILE__ ) );
}

require_once( __DIR__ . '/helper.php' );
// Include the Elementor widget class.
function register_new_widgets( $widgets_manager ) {
    require_once( __DIR__ . '/widget/index.php' );
    require_once( __DIR__ . '/widget/index2.php' );
}
add_action( 'elementor/widgets/register', 'register_new_widgets' );
