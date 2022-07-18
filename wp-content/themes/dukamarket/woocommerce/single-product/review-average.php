<?php
/**
 * Review Average
 *
 * @var $average
 * @var $stars
 * @var $review_count
 * @var $rating_count
 *
 * @package ovic-addon-toolkit/templates
 * @version 1.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<div class="ovic-panel-rating">
    <p class="average"><span><?php echo esc_html( $average ); ?></span> / 5</p>
    <p class="star-rating">
        <span style="width:<?php echo( ( $average / 5 ) * 100 ); ?>%"></span>
    </p>
    <p class="review-count"><?php echo sprintf( esc_html( _n( '%1$s Review', '%1$s Reviews', $rating_count, 'dukamarket' ) ), sprintf( "%02d", $rating_count ) ); ?></p>
    <ul class="detail">
        <?php foreach ( $stars as $key => $rating ): ?>
            <?php
            $process = 0;
            if ( $rating > 0 ) {
                $process = ( $rating / $rating_count ) * 100;
            }
            ?>
            <li>
                <span class="star"><?php echo esc_html( $key ) . esc_html__( ' Star', 'dukamarket' ); ?></span>
                <span class="process">
                    <span class="process-bar" style="width:<?php echo esc_attr( $process ); ?>%"></span>
                </span>
                <span class="count"><?php echo esc_html( round( $process ) ); ?>%</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
