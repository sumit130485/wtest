<?php

/**
 * Plugin Name:             Variation Swatches for WooCommerce
 * Plugin URI:              https://radiustheme.com
 * Description:             Variation Swatches for WooCommerce change beautiful colors, images and buttons variation swatches for WooCommerce product attributes.
 * Version:                 2.1.1.8
 * Author:                  RadiusTheme
 * Author URI:              https://radiustheme.com
 * Requires at least:       4.8
 * Tested up to:            6.0
 * WC requires at least:    3.2
 * WC tested up to:         5.1
 * Domain Path:             /languages
 * Text Domain:             woo-product-variation-swatches.
 */

// Define RTWPVS_PLUGIN_FILE.
if (!defined('RTWPVS_PLUGIN_FILE')) {
	define('RTWPVS_PLUGIN_FILE', __FILE__);
}

// Define RTCL_PLUGIN_FILE.
if (!defined('RTWPVS_VERSION')) {
	define('RTWPVS_VERSION', '2.1.1.8');
}

if (!class_exists('WooProductVariationSwatches')) {
	require_once 'app/WooProductVariationSwatches.php';
}
