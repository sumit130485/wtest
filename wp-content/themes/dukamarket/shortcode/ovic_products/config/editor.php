<?php

class Editor_Ovic_Products
{
    public static function shortcode_config()
    {
        return array(
            'name'   => 'ovic_products',
            'title'  => 'Products',
            'fields' => array(
                'title'         => array(
                    'id'    => 'title',
                    'type'  => 'text',
                    'title' => esc_html__('Title', 'dukamarket'),
                ),
                'list_style'    => array(
                    'id'      => 'list_style',
                    'type'    => 'text',
                    'class'   => 'ovic-hidden',
                    'default' => 'none',
                    'title'   => esc_html__('List style', 'dukamarket'),
                ),
                'product_style' => array(
                    'id'          => 'product_style',
                    'type'        => 'select_preview',
                    'title'       => esc_html__('Product style', 'dukamarket'),
                    'options'     => dukamarket_product_options('Shortcode'),
                    'default'     => 'style-01',
                    'description' => esc_html__('Select a style for product item', 'dukamarket'),
                ),
                'target'        => array(
                    'id'          => 'target',
                    'type'        => 'select',
                    'title'       => esc_html__('Target', 'dukamarket'),
                    'options'     => array(
                        'recent_products'       => esc_html__('Recent Products', 'dukamarket'),
                        'featured_products'     => esc_html__('Feature Products', 'dukamarket'),
                        'sale_products'         => esc_html__('Sale Products', 'dukamarket'),
                        'best_selling_products' => esc_html__('Best Selling Products', 'dukamarket'),
                        'top_rated_products'    => esc_html__('Top Rated Products', 'dukamarket'),
                        'products'              => esc_html__('Products', 'dukamarket'),
                        'product_category'      => esc_html__('Products Category', 'dukamarket'),
                        'related_products'      => esc_html__('Products Related', 'dukamarket'),
                    ),
                    'attributes'  => array(
                        'data-depend-id' => 'target',
                    ),
                    'default'     => 'recent_products',
                    'description' => esc_html__('Choose the target to filter products', 'dukamarket'),
                ),
                'ids'           => array(
                    'id'          => 'ids',
                    'type'        => 'select',
                    'chosen'      => true,
                    'multiple'    => true,
                    'sortable'    => true,
                    'ajax'        => true,
                    'options'     => 'posts',
                    'query_args'  => array(
                        'post_type' => 'product',
                    ),
                    'title'       => esc_html__('Products', 'dukamarket'),
                    'description' => esc_html__('Enter List of Products', 'dukamarket'),
                    'dependency'  => array('target', '==', 'products'),
                ),
                'category'      => array(
                    'id'          => 'category',
                    'type'        => 'select',
                    'chosen'      => true,
                    'ajax'        => true,
                    'options'     => 'categories',
                    'placeholder' => esc_html__('Select Products Category', 'dukamarket'),
                    'query_args'  => array(
                        'hide_empty' => true,
                        'taxonomy'   => 'product_cat',
                    ),
                    'title'       => esc_html__('Product Categories', 'dukamarket'),
                    'description' => esc_html__('Note: If you want to narrow output, select category(s) above. Only selected categories will be displayed.',
                        'dukamarket'),
                    'dependency'  => array('target', '!=', 'products'),
                ),
                'limit'         => array(
                    'id'          => 'limit',
                    'type'        => 'number',
                    'unit'        => 'items(s)',
                    'default'     => '6',
                    'title'       => esc_html__('Limit', 'dukamarket'),
                    'description' => esc_html__('How much items per page to show', 'dukamarket'),
                ),
                'orderby'       => array(
                    'id'          => 'orderby',
                    'type'        => 'select',
                    'title'       => esc_html__('Order by', 'dukamarket'),
                    'options'     => array(
                        ''              => esc_html__('None', 'dukamarket'),
                        'date'          => esc_html__('Date', 'dukamarket'),
                        'ID'            => esc_html__('ID', 'dukamarket'),
                        'author'        => esc_html__('Author', 'dukamarket'),
                        'title'         => esc_html__('Title', 'dukamarket'),
                        'modified'      => esc_html__('Modified', 'dukamarket'),
                        'rand'          => esc_html__('Random', 'dukamarket'),
                        'comment_count' => esc_html__('Comment count', 'dukamarket'),
                        'menu_order'    => esc_html__('Menu order', 'dukamarket'),
                        'price'         => esc_html__('Price: low to high', 'dukamarket'),
                        'price-desc'    => esc_html__('Price: high to low', 'dukamarket'),
                        'rating'        => esc_html__('Average Rating', 'dukamarket'),
                        'popularity'    => esc_html__('Popularity', 'dukamarket'),
                        'post__in'      => esc_html__('Post In', 'dukamarket'),
                        'most-viewed'   => esc_html__('Most Viewed', 'dukamarket'),
                    ),
                    'description' => sprintf(esc_html__('Select how to sort retrieved products. More at %s.',
                        'dukamarket'),
                        '<a href="'.esc_url('http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters').'" target="_blank">'.esc_html__('WordPress codex page',
                            'dukamarket').'</a>'),
                ),
                'order'         => array(
                    'id'          => 'order',
                    'type'        => 'select',
                    'title'       => esc_html__('Sort order', 'dukamarket'),
                    'options'     => array(
                        ''     => esc_html__('None', 'dukamarket'),
                        'DESC' => esc_html__('Descending', 'dukamarket'),
                        'ASC'  => esc_html__('Ascending', 'dukamarket'),
                    ),
                    'description' => sprintf(esc_html__('Designates the ascending or descending order. More at %s.',
                        'dukamarket'),
                        '<a href="'.esc_url('http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters').'" target="_blank">'.esc_html__('WordPress codex page',
                            'dukamarket').'</a>'),
                ),
            ),
        );
    }
}