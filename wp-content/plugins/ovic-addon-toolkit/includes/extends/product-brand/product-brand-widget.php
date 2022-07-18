<?php
/**
 * Product Categories Widget
 *
 * @package WooCommerce/Widgets
 * @version 2.3.0
 */
defined('ABSPATH') || exit;
/**
 * Product brand widget class.
 *
 * @extends WC_Widget
 */
if (class_exists('WC_Widget') && !class_exists('WC_Widget_Product_Brand')) {
    class WC_Widget_Product_Brand extends WC_Widget
    {
        /**
         * Category ancestors.
         *
         * @var array
         */
        public $cat_ancestors;
        /**
         * Current Category.
         *
         * @var bool
         */
        public $current_cat;

        /**
         * Constructor.
         */
        public function __construct()
        {
            $this->widget_cssclass    = apply_filters('ovic_brand_widget_class',
                'woocommerce widget_product_brand widget_product_categories');
            $this->widget_description = esc_html__('A list or dropdown of product brand.', 'ovic-addon-toolkit');
            $this->widget_id          = 'woocommerce_product_brand';
            $this->widget_name        = esc_html__('Ovic: Product Brand', 'ovic-addon-toolkit');
            $this->settings           = array(
                'title'              => array(
                    'type'  => 'text',
                    'std'   => esc_html__('Product brand', 'ovic-addon-toolkit'),
                    'label' => esc_html__('Title', 'ovic-addon-toolkit'),
                ),
                'orderby'            => array(
                    'type'    => 'select',
                    'std'     => 'name',
                    'label'   => esc_html__('Order by', 'ovic-addon-toolkit'),
                    'options' => array(
                        'order' => esc_html__('Brand order', 'ovic-addon-toolkit'),
                        'name'  => esc_html__('Name', 'ovic-addon-toolkit'),
                    ),
                ),
                'show_as'            => array(
                    'type'    => 'select',
                    'std'     => 'list',
                    'label'   => esc_html__('Show as', 'ovic-addon-toolkit'),
                    'options' => array(
                        'list'     => esc_html__('List', 'ovic-addon-toolkit'),
                        'dropdown' => esc_html__('Dropdown', 'ovic-addon-toolkit'),
                        'logo'     => esc_html__('Logo', 'ovic-addon-toolkit'),
                    ),
                ),
                'count'              => array(
                    'type'  => 'checkbox',
                    'std'   => 0,
                    'label' => esc_html__('Show product counts', 'ovic-addon-toolkit'),
                ),
                'hierarchical'       => array(
                    'type'  => 'checkbox',
                    'std'   => 1,
                    'label' => esc_html__('Show hierarchy', 'ovic-addon-toolkit'),
                ),
                'show_children_only' => array(
                    'type'  => 'checkbox',
                    'std'   => 0,
                    'label' => esc_html__('Only show children of the current category', 'ovic-addon-toolkit'),
                ),
                'hide_empty'         => array(
                    'type'  => 'checkbox',
                    'std'   => 0,
                    'label' => esc_html__('Hide empty brand', 'ovic-addon-toolkit'),
                ),
                'max_depth'          => array(
                    'type'  => 'text',
                    'std'   => '',
                    'label' => esc_html__('Maximum depth', 'ovic-addon-toolkit'),
                ),
            );

            parent::__construct();
        }

        /**
         * Output widget.
         *
         * @param  array  $args  Widget arguments.
         * @param  array  $instance  Widget instance.
         *
         * @see WP_Widget
         */
        public function widget($args, $instance)
        {
            global $wp_query, $post;
            $count                   = isset($instance['count']) ? $instance['count'] : $this->settings['count']['std'];
            $hierarchical            = isset($instance['hierarchical']) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
            $show_children_only      = isset($instance['show_children_only']) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
            $show_as                 = isset($instance['show_as']) ? $instance['show_as'] : $this->settings['show_as']['std'];
            $orderby                 = isset($instance['orderby']) ? $instance['orderby'] : $this->settings['orderby']['std'];
            $hide_empty              = isset($instance['hide_empty']) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
            $dropdown_args           = array(
                'hide_empty' => $hide_empty,
            );
            $list_args               = array(
                'show_count'   => $count,
                'hierarchical' => $hierarchical,
                'taxonomy'     => 'product_brand',
                'hide_empty'   => $hide_empty,
            );
            $max_depth               = absint(isset($instance['max_depth']) ? $instance['max_depth'] : $this->settings['max_depth']['std']);
            $list_args['menu_order'] = false;
            $dropdown_args['depth']  = $max_depth;
            $list_args['depth']      = $max_depth;
            if ('order' === $orderby) {
                $list_args['menu_order'] = 'asc';
            } else {
                $list_args['orderby'] = 'title';
            }
            $this->current_cat   = false;
            $this->cat_ancestors = array();
            if (is_tax('product_brand')) {
                $this->current_cat   = $wp_query->queried_object;
                $this->cat_ancestors = get_ancestors($this->current_cat->term_id, 'product_brand');
            } elseif (is_singular('product')) {
                $terms = wc_get_product_terms(
                    $post->ID, 'product_brand', apply_filters(
                        'woocommerce_product_brand_widget_product_terms_args', array(
                            'orderby' => 'parent',
                            'order'   => 'DESC',
                        )
                    )
                );
                if ($terms) {
                    $main_term           = apply_filters('woocommerce_product_brand_widget_main_term', $terms[0],
                        $terms);
                    $this->current_cat   = $main_term;
                    $this->cat_ancestors = get_ancestors($main_term->term_id, 'product_brand');
                }
            }
            // Show Siblings and Children Only.
            if ($show_children_only && $this->current_cat) {
                if ($hierarchical) {
                    $include = array_merge(
                        $this->cat_ancestors,
                        array($this->current_cat->term_id),
                        get_terms(
                            'product_brand',
                            array(
                                'fields'       => 'ids',
                                'parent'       => 0,
                                'hierarchical' => true,
                                'hide_empty'   => false,
                            )
                        ),
                        get_terms(
                            'product_brand',
                            array(
                                'fields'       => 'ids',
                                'parent'       => $this->current_cat->term_id,
                                'hierarchical' => true,
                                'hide_empty'   => false,
                            )
                        )
                    );
                    // Gather siblings of ancestors.
                    if ($this->cat_ancestors) {
                        foreach ($this->cat_ancestors as $ancestor) {
                            $include = array_merge(
                                $include, get_terms(
                                    'product_brand',
                                    array(
                                        'fields'       => 'ids',
                                        'parent'       => $ancestor,
                                        'hierarchical' => false,
                                        'hide_empty'   => false,
                                    )
                                )
                            );
                        }
                    }
                } else {
                    // Direct children.
                    $include = get_terms(
                        'product_brand',
                        array(
                            'fields'       => 'ids',
                            'parent'       => $this->current_cat->term_id,
                            'hierarchical' => true,
                            'hide_empty'   => false,
                        )
                    );
                }
                $list_args['include']     = implode(',', $include);
                $dropdown_args['include'] = $list_args['include'];
                if (empty($include)) {
                    return;
                }
            } elseif ($show_children_only) {
                $dropdown_args['depth']        = 1;
                $dropdown_args['child_of']     = 0;
                $dropdown_args['hierarchical'] = 1;
                $list_args['depth']            = 1;
                $list_args['child_of']         = 0;
                $list_args['hierarchical']     = 1;
            }

            $this->widget_start($args, $instance);

            if ($show_as == 'dropdown') {
                wc_product_dropdown_categories(
                    apply_filters(
                        'woocommerce_product_brand_widget_dropdown_args', wp_parse_args(
                            $dropdown_args, array(
                                'taxonomy'           => 'product_brand',
                                'name'               => 'product_brand',
                                'show_count'         => $count,
                                'hierarchical'       => $hierarchical,
                                'show_uncategorized' => 0,
                                'orderby'            => $orderby,
                                'selected'           => $this->current_cat ? $this->current_cat->slug : '',
                            )
                        )
                    )
                );
                wp_enqueue_script('selectWoo');
                wp_enqueue_style('select2');
                wc_enqueue_js(
                    "
				jQuery( '.dropdown_product_cat' ).change( function() {
					if ( jQuery(this).val() != '' ) {
						var this_page = '';
						var home_url  = '".esc_js(home_url('/'))."';
						if ( home_url.indexOf( '?' ) > 0 ) {
							this_page = home_url + '&product_brand=' + jQuery(this).val();
						} else {
							this_page = home_url + '?product_brand=' + jQuery(this).val();
						}
						location.href = this_page;
					} else {
						location.href = '".esc_js(wc_get_page_permalink('shop'))."';
					}
				});

				if ( jQuery().selectWoo ) {
					var wc_product_cat_select = function() {
						jQuery( '.dropdown_product_cat' ).selectWoo( {
							placeholder: '".esc_js(esc_html__('Select a category', 'ovic-addon-toolkit'))."',
							minimumResultsForSearch: 5,
							width: '100%',
							allowClear: true,
							language: {
								noResults: function() {
									return '".esc_js(esc_html_x('No matches found', 'enhanced select',
                        'ovic-addon-toolkit'))."';
								}
							}
						} );
					};
					wc_product_cat_select();
				}
			"
                );
            } else {
                add_filter('list_product_cats', array($this, 'add_image_list_product_cats'), 10, 2);

                include_once WC()->plugin_path().'/includes/walkers/class-wc-product-cat-list-walker.php';
                $brand_walker                            = new WC_Product_Cat_List_Walker();
                $brand_walker->tree_type                 = 'product_brand';
                $list_args['walker']                     = $brand_walker;
                $list_args['title_li']                   = '';
                $list_args['pad_counts']                 = 1;
                $list_args['show_option_none']           = esc_html__('No product brand exist.', 'ovic-addon-toolkit');
                $list_args['current_category']           = ($this->current_cat) ? $this->current_cat->term_id : '';
                $list_args['current_category_ancestors'] = $this->cat_ancestors;
                $list_args['max_depth']                  = $max_depth;
                echo '<ul class="product-categories '.esc_attr($show_as).'">';
                wp_list_categories(apply_filters('woocommerce_product_brand_widget_args', $list_args));
                echo '</ul>';

                remove_filter('list_product_cats', array($this, 'add_image_list_product_cats'));
            }

            $this->widget_end($args);
        }

        public function add_image_list_product_cats($name, $cat)
        {
            if ($cat->taxonomy == 'product_brand' && $logo = get_term_meta($cat->term_id, 'logo_id', true)) {
                $name = wp_get_attachment_image($logo, 'full').$name;
            }

            return $name;
        }
    }

    if (!function_exists('product_brand_register_widgets')) {
        function product_brand_register_widgets()
        {
            register_widget('WC_Widget_Product_Brand');
        }
    }
    add_action('widgets_init', 'product_brand_register_widgets');
}
