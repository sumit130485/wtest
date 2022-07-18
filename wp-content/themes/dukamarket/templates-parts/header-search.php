<?php
/**
 * Template Search Form
 *
 * @return string
 * @var $category
 *
 * @var $text
 */

use DgoraWcas\Helpers;
use DgoraWcas\Multilingual;

$name        = 's';
$selected    = '';
$params      = '';
$value       = get_search_query();
$uniqueID    = substr( uniqid(), 10, 3 );
$action      = esc_url( home_url( '/' ) );
$placeholder = esc_html__( 'Search ...', 'dukamarket' );
if ( $text != '' ) $placeholder = $text;
if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) {
    $value       = apply_filters( 'dgwt/wcas/search_bar/value', get_search_query(), DGWT_WCAS()->searchInstances );
    $uniqueID    = ++DGWT_WCAS()->searchInstances . substr( uniqid(), 10, 3 );
    $placeholder = Helpers::getLabel( 'search_placeholder' );
    $name        = Helpers::getSearchInputName();
    $action      = Helpers::searchFormAction();
}
?>
<div class="dgwt-wcas-search-wrapp dgwt-wcas-has-submit js-dgwt-wcas-mobile-overlay-enabled">
    <form class="search-form dgwt-wcas-search-form" role="search" method="get"
          action="<?php echo esc_attr( $action ); ?>">

        <?php do_action( 'dukamarket_before_search_form' ); ?>

        <?php if ( $category == 1 && class_exists( 'WooCommerce' ) ) : ?>
            <div class="category">
                <?php
                $selected = '';
                if ( !empty( $_GET['product_cat'] ) ) {
                    $selected = wp_unslash( $_GET['product_cat'] );
                    $params   = json_encode( array(
                        'product_cat' => $selected
                    ) );
                }
                $args = array(
                    'show_option_none'  => esc_html__( 'All Categories', 'dukamarket' ),
                    'taxonomy'          => 'product_cat',
                    'class'             => 'category-search-option',
                    'hide_empty'        => 1,
                    'orderby'           => 'name',
                    'order'             => "ASC",
                    'tab_index'         => true,
                    'hierarchical'      => true,
                    'id'                => rand(),
                    'name'              => 'product_cat',
                    'value_field'       => 'slug',
                    'selected'          => $selected,
                    'option_none_value' => '0',
                );
                wp_dropdown_categories( $args );
                ?>
            </div>
        <?php endif; ?>
        <div class="dgwt-wcas-sf-wrapp">
            <label class="screen-reader-text">
                <?php esc_html_e( 'Products search', 'dukamarket' ) ?>
            </label>
            <?php if ( class_exists( 'WooCommerce' ) ): ?>
                <?php if ( class_exists( 'DGWT_WC_Ajax_Search' ) ) : ?>
                    <?php
                    /* Enqueue required scripts */
                    if ( DGWT_WCAS()->settings->getOption( 'show_details_box' ) === 'on' ) {
                        wp_enqueue_script( 'woocommerce-general' );
                    }
                    wp_enqueue_script( 'jquery-dgwt-wcas' );
                    ?>
                    <input type="hidden" name="dgwt_wcas" value="1"/>
                    <?php if ( Multilingual::isWPML() ): ?>
                        <input type="hidden" name="lang" value="<?php echo Multilingual::getCurrentLanguage(); ?>"/>
                    <?php endif ?>
                <?php endif; ?>
                <input type="hidden" name="post_type" value="product"/>
            <?php endif; ?>
            <div class="search-input">
                <input id="dgwt-wcas-search-input-<?php echo esc_attr( $uniqueID ); ?>"
                       type="search"
                       class="input-text dgwt-wcas-search-input"
                       name="<?php echo esc_attr( $name ); ?>"
                       value="<?php echo esc_attr( $value ); ?>"
                       placeholder="<?php echo esc_attr( $placeholder ); ?>"
                       autocomplete="off"
                       data-custom-params="<?php echo esc_attr( $params ); ?>"
                />
                <span class="input-focus"></span>
                <div class="dgwt-wcas-preloader"></div>
            </div>
            <button type="submit" class="btn-submit dgwt-wcas-search-submit">
                <span class="icon main-icon-search-2"></span>
            </button>
        </div>

        <?php do_action( 'dukamarket_after_search_form' ); ?>
    </form>
</div>
