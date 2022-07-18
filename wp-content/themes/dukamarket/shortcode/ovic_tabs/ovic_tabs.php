<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use Elementor\Core\Files\Assets\Svg\Svg_Handler;

/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Ovic_Tabs"
 * @version 1.0.0
 */
class Shortcode_Ovic_Tabs extends Ovic_Addon_Shortcode
{
    /**
     * Shortcode name.
     *
     * @var  string
     */
    public $shortcode = 'ovic_tabs';
    public $default   = array(
        'style' => 'style-01'
    );

    public function product_atts( $atts, $tab )
    {
        $carousel                            = $this->generate_carousel( $atts, 'slides_', false );
        $args                                = $tab;
        $args['carousel']                    = $carousel;
        $args['list_style']                  = 'owl';
        $args['border_style_2']              = $atts['border_style_2'];
        $args['border_style']                = $atts['border_style'];
        $args['overflow_visible']            = $atts['overflow_visible'];
        $args['slides_rows_space']           = $atts['slides_rows_space'];
        $args['product_style']               = $atts['product_style'];
        $args['product_image_size']          = $atts['product_image_size'];
        $args['product_custom_thumb_width']  = $atts['product_custom_thumb_width'];
        $args['product_custom_thumb_height'] = $atts['product_custom_thumb_height'];
        $args['slide_nav']                   = $atts['slide_nav'];
        $args['main_bora']                   = $atts['slide_nav'];
        $args['main_bora_wrap']              = $atts['main_bora_wrap'];
        unset( $args['title'] );
        unset( $args['image'] );
        unset( $args['_id'] );

        return $args;
    }

    public function tab_content( $section )
    {
        foreach ( $section as $tag => $shortcode ) {
            if ( !is_array( $shortcode ) ) {
                if ( class_exists( 'Elementor\Plugin' ) ) {
                    echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $shortcode );
                } else {
                    $post_id = get_post( $shortcode );
                    $content = $post_id->post_content;
                    $content = apply_filters( 'the_content', $content );
                    $content = str_replace( ']]>', ']]>', $content );
                    echo wp_specialchars_decode( $content );
                }
            } else {
                echo ovic_do_shortcode( $tag, $shortcode );
            }
        }
    }

    public function content( $atts, $content = null )
    {
        $sections  = array();
        $is_ajax   = $atts['is_ajax'] == 'yes' ? 1 : 0;
        $classes   = array( 'ovic-tab', 'ovic-tabs', $atts['style'] );
        $css_class = $this->main_class( $atts, $classes );

        ob_start();
        ?>
        <div class="<?php echo esc_attr( $css_class ); ?>">
            <div class="tabs-head">
                <?php if ( !empty( $atts['tab_title'] ) ) : ?>
                    <h3 class="tab-title"><?php echo esc_html( $atts['tab_title'] ) ?></h3>
                <?php endif; ?>
                <ul class="tabs-list">
                    <?php if ( !empty( $atts['tabs'] ) ): ?>
                        <?php foreach ( $atts['tabs'] as $key => $tab ) : ?>
                            <?php
                            $count       = $key + 1;
                            $rendered    = array();
                            $data        = $tab['template_id'];
                            $class_items = array( 'tab-item' );
                            $class_link  = array( 'tab-link' );
                            $tab_id      = $tab['_id'] . '-' . uniqid();

                            if ( $count == $atts['active'] ) {
                                $class_items[] = 'active';
                                $class_link[]  = 'loaded';
                            }
                            if ( !empty( $tab['class'] ) ) {
                                $class_items[] = $tab['class'];
                            }

                            if ( $tab['content'] == 'product' ) {
                                $data = $this->product_atts( $atts, $tab );
                            }
                            $shortcode = array(
                                'ovic_products' => $data
                            );
                            if ( $tab['content'] != 'link' ) {
                                $sections[ $tab_id ] = $shortcode;
                            }
                            $shortcode = json_encode( $shortcode );

                            if ( $tab['content'] == 'link' && !empty( $tab['link']['url'] ) ) {
                                $attributes = $this->add_link_attributes( $tab['link'] );
                            } else {
                                $attributes = array(
                                    'class'        => implode( ' ', $class_link ),
                                    'href'         => '#tab-' . $tab_id,
                                    'data-ajax'    => $is_ajax,
                                    'data-animate' => 'fadeIn',
                                );
                                if ( $is_ajax == 1 ) {
                                    $attributes['data-section'] = $shortcode;
                                }
                            }

                            foreach ( $attributes as $name => $value ) {
                                if ( is_array( $value ) ) {
                                    $value = implode( ' ', $value );
                                }
                                $rendered[] = sprintf( '%1$s="%2$s"', $name, esc_attr( $value ) );
                            }
                            ?>
                            <li class="<?php echo esc_attr( implode( ' ', $class_items ) ); ?>">
                                <a <?php echo implode( ' ', $rendered ); ?>>
                                    <?php if ( $tab['selected_media'] == 'icon' ): ?>
                                        <?php if ( !empty( $tab['selected_icon']['value'] ) ): ?>
                                            <span class="thumb type-icon">
                                                <?php
                                                \Elementor\Icons_Manager::render_icon( $tab['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                                ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if ( !empty( $tab['image']['url'] ) ): ?>
                                            <span class="thumb type-image">
                                                <?php
                                                if ( strpos( basename( $tab['image']['url'] ), '.svg' ) === false ) {
                                                    echo wp_get_attachment_image( $tab['image']['id'], 'full' );
                                                } else {
                                                    echo Svg_Handler::get_inline_svg( $tab['image']['id'] );
                                                }
                                                ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ( !empty( $tab['title'] ) ): ?>
                                        <span class="title"><?php echo esc_html( $tab['title'] ); ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="tabs-container">
                <?php if ( !empty( $sections ) ): ?>
                    <?php
                    $count = 1;
                    foreach ( $sections as $id => $section ) : ?>
                        <?php
                        $active = array( 'tab-panel' );
                        if ( $count == $atts['active'] ) {
                            $active[] = 'active';
                        }
                        ?>
                        <div class="<?php echo esc_attr( implode( ' ', $active ) ); ?>"
                             id="tab-<?php echo esc_attr( $id ); ?>">
                            <?php if ( $is_ajax == true ) :
                                if ( $count == $atts['active'] ) :
                                    $this->tab_content( $section );
                                endif;
                            else :
                                $this->tab_content( $section );
                            endif;
                            $count++;
                            ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php

        return ob_get_clean();
    }
}