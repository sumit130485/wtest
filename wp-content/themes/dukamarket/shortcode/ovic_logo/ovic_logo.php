<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Logo"
 * @version 1.0.0
 */
class Shortcode_Ovic_Logo extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_logo';
    public $default   = array();

    public function content( $atts, $content = null )
    {
        return dukamarket_get_logo();
    }
}