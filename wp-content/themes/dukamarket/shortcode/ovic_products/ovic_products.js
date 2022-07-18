(function ($) {
    'use strict';

    $.fn.dukamarket_load_products = function (data_atts, $shortcode_id) {
        var $this             = $(this),
            $tab_animated     = 'fadeInUp',
            $data             = data_atts,
            $contain          = $('.ovic-products.' + $shortcode_id),
            $response_wrapper = $contain.find('ul.products'),
            $next_page        = $response_wrapper.data('next_page'),
            $total_page       = $response_wrapper.data('total_page'),
            $button           = $contain.find('.button-products a.button');

        $data.args.page     = $next_page;
        $data.args.paginate = false;

        $.ajax({
            type      : 'POST',
            url       : dukamarket_params.dukamarket_ajax_url.toString().replace('%%endpoint%%', 'product_load_more'),
            data      : {
                security: dukamarket_params.security,
                data    : $data,
            },
            beforeSend: function () {
                if ($data.pagination === 'load_more') {
                    $button.addClass('loading');
                } else {
                    $contain.addClass('loading');
                }
            },
            success   : function (response) {
                if (!response) {
                    window['is_busy_' + $shortcode_id] = true;
                    return;
                }

                var product_items = $(response).find('.product-item');

                if ($this.closest('.ovic-tabs').length) {
                    $tab_animated = $this.closest('.ovic-tabs').find('.tabs-head a.loaded').data('animate');
                }
                if (product_items.length) {
                    if ($tab_animated !== '' && $data.list_style === 'grid') {
                        product_items.each(function (i) {
                            var $product = $(this),
                                style    = $product.attr('style'),
                                $delay   = i * 100;

                            style = (style === undefined) ? '' : style;
                            $product.attr('style', style +
                                ';-webkit-animation-delay:' + $delay + 'ms;' +
                                '-moz-animation-delay:' + $delay + 'ms;' +
                                '-o-animation-delay:' + $delay + 'ms;' +
                                'animation-delay:' + $delay + 'ms;'
                            ).addClass($tab_animated + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                                $product.removeClass($tab_animated + ' animated');
                                $product.attr('style', style);
                            });
                            $response_wrapper.append($product);
                        });
                    } else {
                        if ($data.list_style === 'owl') {
                            var $slick_config = $response_wrapper.data('slick'),
                                $lastSlide    = $response_wrapper.find('.last-slick').data('slick-index');

                            $slick_config.infinite = false;

                            product_items = $(response).find('.products').slick($slick_config).find('.slick-slide');

                            $response_wrapper.slick('slickAdd', product_items);
                            $response_wrapper.slick('slickGoTo', $lastSlide);
                        } else {
                            $response_wrapper.append(product_items);
                            if ($response_wrapper.hasClass('kute-boutique-isotope') && $.fn.dukamarket_isotope_grid) {
                                $response_wrapper
                                    .isotope('appended', product_items, true)
                                    .isotope('reloadItems')
                                    .dukamarket_isotope_grid();
                            }
                        }
                    }
                    setTimeout(function ($response_wrapper) {
                        if ($response_wrapper.hasClass('equal-container').length) {
                            $response_wrapper.dukamarket_better_equal_elems();
                        }
                        if ($response_wrapper.find('.product-item.style-01').length) {
                            $response_wrapper.find('.product-item.style-01').dukamarket_hover_product();
                        }
                        if ($response_wrapper.find('.product-item.style-02').length) {
                            $response_wrapper.find('.product-item.style-02').dukamarket_hover_product();
                        }
                        if ($response_wrapper.find('.yith-wcqv-button,.compare-button a.compare,.yith-wcwl-add-to-wishlist a').length) {
                            $response_wrapper.find('.yith-wcqv-button,.compare-button a.compare,.yith-wcwl-add-to-wishlist a').dukamarket_bootstrap_tooltip();
                        }
                    }, 100, $response_wrapper);
                    /* SET WINDOW VALUE */
                    if ($next_page + 1 >= $total_page) {
                        if ($data.pagination === 'load_more') {
                            $button.parent().remove();
                        }
                        window['is_busy_' + $shortcode_id] = true;
                    } else {
                        window['is_busy_' + $shortcode_id] = false;
                        $response_wrapper.data('next_page', $next_page + 1);
                    }
                } else {
                    if ($data.pagination === 'load_more') {
                        $button.parent().remove();
                    }
                    window['is_busy_' + $shortcode_id] = true;
                }
                if ($data.pagination === 'load_more') {
                    $button.removeClass('loading');
                } else {
                    $contain.removeClass('loading');
                }
            },
        });
    };

    $.fn.dukamarket_load_infinite = function () {
        $(this).each(function () {
            var $this           = $(this),
                $previousScroll = 0,
                $shortcode_id   = $this.attr('data-id'),
                $data_atts      = window['dukamarket_shortcode_' + $shortcode_id];

            if ($data_atts !== undefined && $data_atts.pagination === 'infinite') {

                window['is_busy_' + $shortcode_id] = false;

                if ($data_atts.list_style !== 'owl') {

                    $(document).on('scroll', function () {

                        var _currentScroll = $(this).scrollTop(),
                            _offset        = $this.height() + $this.offset().top;

                        if (_currentScroll > $previousScroll) {

                            if ($(window).scrollTop() + $(window).height() >= _offset) {

                                if (window['is_busy_' + $shortcode_id] === false) {
                                    $this.dukamarket_load_products($data_atts, $shortcode_id);
                                }
                                window['is_busy_' + $shortcode_id] = true;
                            }
                        }

                        $previousScroll = _currentScroll;

                    });

                } else {

                    $this.find('.owl-slick').on('afterChange', function (event, slick) {
                        var lastSlide = $(event.target).find('.last-slick').data('slick-index');
                        if (lastSlide === slick.slideCount - 1 && window['is_busy_' + $shortcode_id] === false) {
                            $this.dukamarket_load_products($data_atts, $shortcode_id);
                        }
                    });

                }
            }
        });
    };

    $(document).on('click', '.ovic-products .load_more-products', function (e) {
        e.preventDefault();
        var $this         = $(this),
            $shortcode_id = $this.closest('.ovic-products').attr('data-id'),
            $data_atts    = window['dukamarket_shortcode_' + $shortcode_id];

        $this.dukamarket_load_products($data_atts, $shortcode_id);
    });
    document.addEventListener("DOMContentLoaded", function () {
        if ($('.ovic-products.infinite-products').length) {
            $('.ovic-products.infinite-products').dukamarket_load_infinite();
        }
    });
})(window.jQuery);