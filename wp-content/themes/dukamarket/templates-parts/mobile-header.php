<?php
/**
 * Template Mobile Header
 *
 * @return string
 * @var $data_menus
 *
 * @var $menu_locations
 */
$mobile_banner = dukamarket_get_option('mobile_banner');

if (!$mobile_banner) {
    return;
}

$avatar_id    = null;
$class        = 'login';
$login        = wp_login_url();
$current_user = wp_get_current_user();
$author_name  = esc_html__('Guest', 'dukamarket');
$login_text   = esc_html__('Login', 'dukamarket');
$author_email = esc_html__('Example@email.com', 'dukamarket');
if (class_exists('WooCommerce') && !empty(get_option('woocommerce_myaccount_page_id'))) {
    $login = get_permalink(get_option('woocommerce_myaccount_page_id'));
}
$logout = $login;
if (is_user_logged_in()) {
    $class        = 'logout';
    $avatar_id    = $current_user->ID;
    $author_email = $current_user->user_email;
    $author_name  = $current_user->display_name;
    $login_text   = esc_html__('Logout', 'dukamarket');
    $logout       = wp_logout_url();
}
$avatar = get_avatar_url($avatar_id,
    array('size' => 60)
);
?>
<div class="head-menu-mobile">
    <a href="<?php echo esc_url($logout) ?>"
       class="action <?php echo esc_attr($class); ?>">
        <span class="icon main-icon-enter"></span>
        <?php echo esc_html($login_text); ?>
    </a>
    <a href="<?php echo esc_url($login) ?>" class="avatar">
        <figure>
            <img src="<?php echo esc_url($avatar) ?>"
                 alt="<?php echo esc_attr__('Avatar Mobile', 'dukamarket') ?>">
        </figure>
    </a>
    <div class="author">
        <a href="<?php echo esc_url($login) ?>"
           class="name">
            <?php echo esc_html($author_name); ?>
            <span class="email"><?php echo esc_html($author_email); ?></span>
        </a>
    </div>
</div>
