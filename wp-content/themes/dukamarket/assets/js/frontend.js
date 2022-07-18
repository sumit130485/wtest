(function ($) {
    'use strict';

    var get_url = function (endpoint) {
            return dukamarket_params.dukamarket_ajax_url.toString().replace(
                '%%endpoint%%',
                endpoint
            );
        },
        get_cookie = function (name) {
            var e, b, cookie = document.cookie, p = name + '=';
            if (!cookie) {
                return;
            }
            b = cookie.indexOf('; ' + p);
            if (b === -1) {
                b = cookie.indexOf(p);
                if (b !== 0) {
                    return null;
                }
            } else {
                b += 2;
            }
            e = cookie.indexOf(';', b);
            if (e === -1) {
                e = cookie.length;
            }
            return decodeURIComponent(cookie.substring(b + p.length, e));
        },
        set_cookie = function (name, value, expires, path, domain, secure) {
            var d = new Date();
            if (typeof (expires) === 'object' && expires.toGMTString) {
                expires = expires.toGMTString();
            } else if (parseInt(expires, 10)) {
                d.setTime(d.getTime() + (parseInt(expires, 10) * 1000));
                expires = d.toGMTString();
            } else {
                expires = '';
            }
            document.cookie = name + '=' + encodeURIComponent(value) +
                (expires ? '; expires=' + expires : '') +
                (path ? '; path=' + path : '') +
                (domain ? '; domain=' + domain : '') +
                (secure ? '; secure' : '');
        },
        remove_cookie = function (name, path, domain, secure) {
            set_cookie(name, '', -1000, path, domain, secure);
        };

    var Mobile_Detect = {
        Mobile: function () {
            return navigator.userAgent.match(
                /(iPhone|iPod|Android|Phone|DROID|ZuneWP7|silk|BlackBerry|BB10|Windows Phone|Tizen|Bada|webOS|IEMobile|Opera Mini)/
            );
        },
        Tablet: function () {
            return navigator.userAgent.match(
                /(Tablet|iPad|Kindle|Playbook|Nexus|Xoom|SM-N900T|GT-N7100|SAMSUNG-SGH-I717|SM-T330NU)/
            );
        },
        any: function () {
            return (Mobile_Detect.Mobile() || Mobile_Detect.Tablet());
        }
    };

    $(document).on('click', '.view-all-menu > a', function () {
        var button = $(this),
            vertical = button.closest('.header-vertical'),
            items = button.data('items'),
            open = button.data('more'),
            close = button.data('less'),
            menus = vertical.find('ul.vertical-menu > li:nth-child(n+' + (items + 1) + ')');
        button.toggleClass('open-cate close-cate');
        if (button.hasClass('close-cate')) {
            button.html(close);
            menus.slideDown();
        } else {
            button.html(open);
            menus.slideUp();
        }

        return false;
    });

    /* AJAX TABS */
    $(document).on('click', '.ovic-tabs .tabs-list .tab-link, .ovic-accordion .panel-heading a', function (e) {
        e.preventDefault();
        var $this = $(this),
            $data = $this.data(),
            $tabID = $($this.attr('href')),
            $tabItem = $this.closest('.tab-item'),
            $tabContent = $tabID.closest('.tabs-container,.ovic-accordion'),
            $loaded = $this.closest('.tabs-list,.ovic-accordion').find('a.loaded').attr('href');

        if ($data.ajax == 1 && !$this.hasClass('loaded')) {
            $tabContent.addClass('loading');
            $tabItem.addClass('active').closest('.tabs-list').find('.tab-item').not($tabItem).removeClass('active');
            $.ajax({
                type: 'POST',
                url: get_url('content_ajax_tabs'),
                data: {
                    security: dukamarket_params.security,
                    section: $data.section,
                },
                success: function (response) {
                    $('[href="' + $loaded + '"]').removeClass('loaded');
                    if (response) {
                        $tabID.html(response);
                        if ($tabID.find('.owl-slick').length) {
                            $tabID.find('.owl-slick').dukamarket_init_carousel();
                        }
                        if ($tabID.find('.equal-container.better-height').length) {
                            $tabID.find('.equal-container.better-height').dukamarket_better_equal_elems();
                        }
                        if ($tabID.find('.dukamarket-countdown').length && $.fn.dukamarket_countdown) {
                            $tabID.find('.dukamarket-countdown').dukamarket_countdown();
                        }
                        if ($tabID.find('.ovic-products').length && $.fn.dukamarket_load_infinite) {
                            $tabID.find('.ovic-products').dukamarket_load_infinite();
                        }
                        if ($tabID.find('.yith-wcqv-button,.compare-button a.compare,.entry-summary a.compare,.yith-wcwl-add-to-wishlist a').length) {
                            $tabID.find('.yith-wcqv-button,.compare-button a.compare,.entry-summary a.compare,.yith-wcwl-add-to-wishlist a').dukamarket_bootstrap_tooltip();
                        }
                    } else {
                        $tabID.html('<div class="alert alert-warning">' + dukamarket_params.tab_warning + '</div>');
                    }
                    /* for accordion */
                    $this.closest('.panel-default').addClass('active').siblings().removeClass('active');
                    $this.closest('.ovic-accordion').find($tabID).slideDown(400);
                    $this.closest('.ovic-accordion').find('.panel-collapse').not($tabID).slideUp(400);
                },
                complete: function () {
                    $this.addClass('loaded');
                    $tabContent.removeClass('loading');
                    setTimeout(function ($tabID, $tab_animated, $loaded) {
                        $tabID.addClass('active').siblings().removeClass('active');
                        $tabID.animation_tabs($tab_animated);
                        $($loaded).html('');
                    }, 10, $tabID, $data.animate, $loaded);
                },
                ajaxError: function () {
                    $tabContent.removeClass('loading');
                    $tabID.html('<div class="alert alert-warning">' + dukamarket_params.tab_warning + '</div>');
                }
            });
        } else {
            $tabItem.addClass('active').closest('.tabs-list').find('.tab-item').not($tabItem).removeClass('active');
            $tabID.addClass('active').siblings().removeClass('active');
            /* for accordion */
            $this.closest('.panel-default').addClass('active').siblings().removeClass('active');
            $this.closest('.ovic-accordion').find($tabID).slideDown(400);
            $this.closest('.ovic-accordion').find('.panel-collapse').not($tabID).slideUp(400);
            /* for animate */
            $tabID.animation_tabs($data.animate);
        }
    });
    /* ANIMATE */
    $.fn.animation_tabs = function ($tab_animated) {
        $tab_animated = ($tab_animated === undefined || $tab_animated === '') ? '' : $tab_animated;
        if ($tab_animated !== '') {
            $(this).find('.owl-slick .slick-active, .product-list-grid .product-item').each(function (i) {
                var $this = $(this),
                    $style = $this.attr('style'),
                    $delay = i * 200;

                $style = ($style === undefined) ? '' : $style;
                $this.attr('style', $style +
                    ';-webkit-animation-delay:' + $delay + 'ms;' +
                    '-moz-animation-delay:' + $delay + 'ms;' +
                    '-o-animation-delay:' + $delay + 'ms;' +
                    'animation-delay:' + $delay + 'ms;'
                ).addClass($tab_animated + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    $this.removeClass($tab_animated + ' animated');
                    $this.attr('style', $style);
                });
            });
        }
    };
    $.fn.dukamarket_init_carousel = function () {
        $(this).not('.slick-initialized').each(function () {
            var $this = $(this),
                $config = $this.data('slick') !== undefined ? $this.data('slick') : [];

            if ($this.hasClass('flex-control-thumbs')) {
                $config = $this.closest('.single-product-wrapper').data('slick');
            }
            if ($this.hasClass('elementor-section-slide')) {
                $this = $this.children('.elementor-container');

                if ($this.children('.elementor-row').length) {
                    $this = $this.children('.elementor-row');
                }
                if ($this.hasClass('slick-initialized')) {
                    return false;
                }
            }
            if ($config.length <= 0) {
                return false;
            }
            if ($('body').hasClass('rtl')) {
                $config.rtl = true;
            }
            if ($config.vertical == true) {
                $config.prevArrow = '<span class="fa fa-angle-up prev"></span>';
                $config.nextArrow = '<span class="fa fa-angle-down next"></span>';
            } else {
                $config.prevArrow = '<span class="fa fa-angle-left prev"></span>';
                $config.nextArrow = '<span class="fa fa-angle-right next"></span>';
            }
            $config.customPaging = function (slick, index) {
                return '<span class="number">' + (index + 1) + '</span><button type="button">' + (index + 1) + '</button>';
            };

            $this.slick($config);
        });
    };
    $.fn.dukamarket_better_equal_elems = function () {
        if (!Mobile_Detect.Mobile() && dukamarket_params.disable_equal == false) {
            var $this = $(this);

            $this.on('dukamarket_better_equal_elems', function () {
                setTimeout(function () {
                    $this.each(function () {
                        if ($(this).find('.equal-elem').length) {
                            $(this).find('.equal-elem').css({
                                'height': 'auto'
                            });
                            var $height = 0;
                            $(this).find('.equal-elem').each(function () {
                                if ($height < $(this).height()) {
                                    $height = $(this).height();
                                }
                            });
                            $(this).find('.equal-elem').height($height);
                        }
                    });
                }, 300);
            }).trigger('dukamarket_better_equal_elems');

            $(window).on('resize', function () {
                $this.trigger('dukamarket_better_equal_elems');
            });
        }
    };
    $.fn.dukamarket_sticky_header = function () {
        $(this).each(function () {
            var $this = $(this),
                $sticky = $this.find('.header-sticky'),
                $height = $sticky.height();

            if (dukamarket_params.sticky_menu == 'template') {
                $sticky = $('#header-sticky');
            }

            $(document).on('scroll', function (event) {
                var sh = $height,
                    st = $(this).scrollTop();

                if (st > sh) {
                    $sticky.addClass('is-sticky');
                } else {
                    $sticky.removeClass('is-sticky');
                    $('#header-sticky').find('.dukamarket-dropdown.open').removeClass('open');
                }
            });
        });
    };
    /* DROPDOWN */
    $(document).on('click', function (event) {
        var $target = $(event.target).closest('.dukamarket-dropdown'),
            $current = $target.closest('.dukamarket-parent-toggle'),
            $parent = $('.dukamarket-dropdown');

        if ($target.length) {
            $parent.not($target).not($current).removeClass('open');
            if ($(event.target).is('[data-dukamarket="dukamarket-dropdown"]') ||
                $(event.target).closest('[data-dukamarket="dukamarket-dropdown"]').length) {
                if ($target.hasClass('overlay')) {
                    if ($target.hasClass('open')) {
                        $('body').removeClass('active-overlay');
                    } else {
                        $('body').addClass('active-overlay');
                    }
                }
                $target.toggleClass('open');
                event.preventDefault();
            }
        } else {
            $('.dukamarket-dropdown').removeClass('open');
            if ($target.hasClass('overlay') || !$target.length) {
                $('body').removeClass('active-overlay');
            }
        }
    });
    /* POPUP VIDEO */
    $(document).on('click', '.popup-video', function (e) {
        var $this = $(this),
            $href = $this.attr('href'),
            $effect = $this.attr('data-effect');

        if ($.fn.magnificPopup) {
            $.magnificPopup.open({
                items: {
                    src: $href,
                },
                type: 'iframe', // this is a default type
                iframe: {
                    markup: '<div class="mfp-iframe-scaler mfp-with-anim">' +
                        '<div class="mfp-close"></div>' +
                        '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                        '</div>',
                },
                callbacks: {
                    beforeOpen: function () {
                        this.st.mainClass = $effect;
                    },
                },
                removalDelay: 500,
                midClick: true
            });
            e.preventDefault();
        }
    });
    /* BUTTON TOOLTIP */
    $.fn.dukamarket_bootstrap_tooltip = function () {
        if (!Mobile_Detect.any()) {
            $(this).each(function () {
                var $this = $(this),
                    $product = $this.closest('.tooltip-wrap'),
                    $text = $this.text(),
                    $place = 'left',
                    $place_e = 'right';

                if ($('body').hasClass('rtl')) {
                    $place = 'right';
                    $place_e = 'left';
                }
                if ($product.length) {
                    if ($product.hasClass('tooltip-top')) {
                        $this.OVICtooltip({
                            trigger: 'hover',
                            placement: 'top',
                            container: 'body',
                            title: $text,
                        });
                    }
                    if ($product.hasClass('tooltip-start')) {
                        $this.OVICtooltip({
                            trigger: 'hover',
                            placement: $place,
                            container: 'body',
                            title: $text,
                        });
                    }
                    if ($product.hasClass('tooltip-end')) {
                        $this.OVICtooltip({
                            trigger: 'hover',
                            placement: $place_e,
                            container: 'body',
                            title: $text,
                        });
                    }
                }
            });
        }
    }
    /* ZOOM IMAGE */
    $.fn.dukamarket_zoom_product = function () {
        if ($(this).find('.single-product-wrapper.has-gallery').length && $.fn.zoom) {
            $(this).find('.single-product-wrapper.has-gallery .woocommerce-product-gallery .woocommerce-product-gallery__image').each(function () {
                var zoomTarget = $(this),
                    zoomImg = zoomTarget.find('a').attr('href');

                if (zoomTarget.hasClass('flex-active-slide')) {
                    zoomTarget.trigger('zoom.destroy');
                }
                zoomTarget.zoom({url: zoomImg});
            });
        }
    };
    /* TOGGLE WIDGET */
    $.fn.ovic_category_product = function () {
        $(this).each(function () {
            var $main = $(this);
            $main.find('.cat-parent').each(function () {
                if ($(this).hasClass('current-cat-parent')) {
                    $(this).addClass('show-sub');
                    $(this).children('.children').slideDown(400);
                }
                $(this).children('.children').before('<span class="carets"></span>');
            });
            $main.children('.cat-parent').each(function () {
                var curent = $(this).find('.children');
                $(this).children('.carets').on('click', function () {
                    $(this).parent().toggleClass('show-sub');
                    $(this).parent().children('.children').slideToggle(400);
                    $main.find('.children').not(curent).slideUp(400);
                    $main.find('.cat-parent').not($(this).parent()).removeClass('show-sub');
                });
                var next_curent = $(this).find('.children');
                next_curent.children('.cat-parent').each(function () {
                    var child_curent = $(this).find('.children');
                    $(this).children('.carets').on('click', function () {
                        $(this).parent().toggleClass('show-sub');
                        $(this).parent().parent().find('.cat-parent').not($(this).parent()).removeClass('show-sub');
                        $(this).parent().parent().find('.children').not(child_curent).slideUp(400);
                        $(this).parent().children('.children').slideToggle(400);
                    })
                });
            });
        });
    };
    /* UPDATE COUNT WISHLIST */
    $(document).on('added_to_wishlist removed_from_wishlist', function () {
        $.get(get_url('update_wishlist_count'), function (count) {
            if (!count) {
                count = 0;
            }
            $('.block-wishlist .count').text(count);
        });
    });

    $(document).on('click', '.action-to-top', function (e) {
        $('html, body').animate({scrollTop: 0}, 800);
        e.preventDefault();
    });

    if (dukamarket_params.ajax_comment == 1) {
        $(document).on('click', '#comments .woocommerce-pagination a', function () {
            var $this = $(this),
                $comment = $this.closest('#comments'),
                $commentlist = $comment.find('.commentlist'),
                $pagination = $this.closest('.woocommerce-pagination');

            $comment.addClass('loading');
            $.ajax({
                url: $this.attr('href'),
                success: function (response) {
                    if (!response) {
                        return;
                    }
                    var $html = $.parseHTML(response, document, true),
                        $nav = $('#comments .woocommerce-pagination', $html).length ? $('#comments .woocommerce-pagination', $html)[0].innerHTML : '',
                        $content = $('#comments .commentlist', $html).length ? $('#comments .commentlist', $html)[0].innerHTML : '';

                    if ($content !== '') {
                        $commentlist.html($content);
                    }
                    $pagination.html($nav);
                    $comment.removeClass('loading');
                },
            });

            return false;
        });
    }
    /* QUANTITY */
    if (!String.prototype.getDecimals) {
        String.prototype.getDecimals = function () {
            var num = this,
                match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            if (!match) {
                return 0;
            }
            return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
        };
    }
    $(document).on('click', '.quantity-plus, .quantity-minus', function (e) {
        e.preventDefault();
        // Get values
        var $qty = $(this).closest('.quantity').find('.qty'),
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        if (!$qty.is(':disabled')) {
            // Format values
            if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
            if (max === '' || max === 'NaN') max = '';
            if (min === '' || min === 'NaN') min = 0;
            if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = '1';

            // Change the value
            if ($(this).is('.quantity-plus')) {
                if (max && (currentVal >= max)) {
                    $qty.val(max);
                } else {
                    $qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
                }
            } else {
                if (min && (currentVal <= min)) {
                    $qty.val(min);
                } else if (currentVal > 0) {
                    $qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
                }
            }

            // Trigger change event
            $qty.trigger('change');
        }
    });

    // Toggle mobile menu
    $(document).on('click', '.overlay-body', function () {
        $('body').removeClass('ovic-open-mobile-menu');
        $('body').removeClass('open-header-settings');
        $('body').removeClass('open-mobile-sidebar');
        $('body').removeClass('open-popup-vertical');
        $('.ovic-menu-clone-wrap').removeClass('open');
        return false;
    });

    // Toggle popup vertical
    $(document).on('click', '.vertical-open', function () {
        $('body').addClass('open-popup-vertical');
        return false;
    });
    $(document).on('click', '.vertical-close', function () {
        $('body').removeClass('open-popup-vertical');
        return false;
    });
    // Toggle settings menu
    $(document).on('click', '.settings-toggle', function () {
        $('body').addClass('open-header-settings');
        return false;
    });
    $(document).on('click', '.settings-close', function () {
        $('body').removeClass('open-header-settings');
        return false;
    });
    $(document).on('click', '.open-sidebar', function () {
        $('body').addClass('open-mobile-sidebar');
        return false;
    });
    $(document).on('click', '.close-sidebar', function () {
        $('body').removeClass('open-mobile-sidebar');
        return false;
    });

    $(document).on('click', '.post-meta .share-post .toggle', function () {
        $(this).closest('.share-post').toggleClass('open');
        return false;
    });

    $(document).on('click', '.more_seller_product_tab > a', function () {
        var id = $(this).attr('href');

        if ($(id).find('ul.products').length) {
            $(id).find('ul.products').dukamarket_better_equal_elems();
        }
    });

    $(document).on('change', '#dukamarket_disabled_popup_by_user', function () {
        if ($(this).is(":checked")) {
            set_cookie('dukamarket_disabled_popup_by_user', 'true');
        } else {
            set_cookie('dukamarket_disabled_popup_by_user', '');
        }
    });

    $(document).on('change', '.per-page-form .option-perpage', function () {
        $(this).closest('form').submit();
    });

    $(document).on('wc-product-gallery-after-init', function (event, gallery, params) {
        if ($(this).find('.flex-control-thumbs').length) {
            $(this).find('.flex-control-thumbs').dukamarket_init_carousel();
        }
    });

    $(document).on('ovic_success_load_more_post', function (event, content) {
        if ($(event.target).find('.yith-wcqv-button,.compare-button a.compare,.entry-summary a.compare,.yith-wcwl-add-to-wishlist a').length) {
            $(event.target).find('.yith-wcqv-button,.compare-button a.compare,.entry-summary a.compare,.yith-wcwl-add-to-wishlist a').dukamarket_bootstrap_tooltip();
        }
        if ($(event.target).find('.owl-slick').length) {
            $(event.target).find('.owl-slick').dukamarket_init_carousel();
        }
        if ($('.equal-container.better-height').length) {
            $('.equal-container.better-height').dukamarket_better_equal_elems();
        }
    });

    $(document).on('scroll', function () {
        if ($(document).scrollTop() > 400) {
            $('.backtotop').addClass('show');
        } else {
            $('.backtotop').removeClass('show');
        }
    });

    $(document).on('found_variation', function (event, variation) {
        if ($(variation.price_html).length && $(event.target).find('.price').length) {
            $(event.target).find('.price').replaceWith(variation.price_html);
        }
    });

    $(document).on('click', '.reset_variations', function () {
        var form = $(this).closest('.variations_form'),
            price = form.data('price');

        form.find('.price').html(price);
    });

    $(document).on('updated_wc_div', function (event) {
        if ($(event.target).find('.cross-sells .owl-slick').length > 0) {
            $(event.target).find('.cross-sells .owl-slick').dukamarket_init_carousel();
        }
    });

    $(document).on('wc_fragments_refreshed wc_fragments_loaded', function () {
        if ($('.woocommerce-mini-cart').length) {
            $('.woocommerce-mini-cart').scrollbar({'ignoreMobile': true});
        }
    });

    if ($('.woocommerce-product-gallery').attr("data-columns")) {
        $('.woocommerce-product-gallery').css({'--columns': $('.woocommerce-product-gallery').attr("data-columns")});
    }

    $(document).on('click', '.woocommerce-tabs .tabs-toggle > li > a, .woocommerce-tabs .tabs-toggle-full > li > a', function (e) {
        $(this).parent('li').toggleClass('active');
        $(this).parent('li').children('.woocommerce-Tabs-panel').slideToggle();
        e.preventDefault();
    });

    window.addEventListener("load", function load() {
        /**
         * remove listener, no longer needed
         * */
        window.removeEventListener("load", load, false);
        /**
         * start functions
         * */
        if ($('.owl-slick').length) {
            $('.owl-slick').dukamarket_init_carousel();
        }
        if ($('.elementor-section-slide').length) {
            $('.elementor-section-slide').dukamarket_init_carousel();
        }
        if ($('.equal-container.better-height').length) {
            $('.equal-container.better-height').dukamarket_better_equal_elems();
        }
        if ($('.shop-before-control select').length) {
            $('.shop-before-control select').chosen({disable_search_threshold: 10});
        }
        if ($('.widget_product_categories .product-categories').length) {
            $('.widget_product_categories .product-categories').ovic_category_product();
        }
        if ($('.category-search-option').length) {
            $('.category-search-option').chosen();
            $('.category-search-option').on('change', function (event, value) {
                var $this = $(this),
                    $form = $this.closest('form'),
                    $input = $form.find('input[type="search"]');

                $input.removeData();

                if ('selected' in value) {
                    $input.attr('data-custom-params', JSON.stringify({"product_cat": value.selected}));
                }
            });
        }
        /**
         * popup newsletter
         * */
        if ($('.dukamarket-popup-newsletter').length && get_cookie('dukamarket_disabled_popup_by_user') !== 'true' && $.fn.magnificPopup) {
            var popup = document.getElementById('dukamarket-popup-newsletter'),
                effect = popup.getAttribute('data-effect'),
                delay = popup.getAttribute('data-delay');

            setTimeout(function () {
                $.magnificPopup.open({
                    items: {
                        src: '#dukamarket-popup-newsletter'
                    },
                    type: 'inline',
                    removalDelay: 600,
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = effect;
                        }
                    },
                    midClick: true
                });
            }, delay);
        }
        /**
         * check not mobile
         * */
        if (!Mobile_Detect.any()) {
            if ($('.product-page-grid .site-main > .product').length) {
                $('.product-page-grid .site-main > .product').dukamarket_zoom_product();
            }
            if ($('.product-page-slide .site-main > .product').length) {
                $('.product-page-slide .site-main > .product').dukamarket_zoom_product();
            }
            if ($('.product-page-sticky .site-main > .product').length) {
                $('.product-page-sticky .site-main > .product').dukamarket_zoom_product();
            }
            if ($('.header').length && dukamarket_params.sticky_menu !== 'none' && window.matchMedia("(min-width: 1199px)").matches) {
                $('.header').dukamarket_sticky_header();
            }
            if ($('.yith-wcqv-button,.compare-button a.compare,.entry-summary a.compare,.yith-wcwl-add-to-wishlist a').length) {
                $('.yith-wcqv-button,.compare-button a.compare,.entry-summary a.compare,.yith-wcwl-add-to-wishlist a').dukamarket_bootstrap_tooltip();
            }
        }
        /* SCROLLBAR */
        if ($.fn.scrollbar) {
            if ($('.dokan-store-widget #cat-drop-stack > ul').length) {
                $('.dokan-store-widget #cat-drop-stack > ul').scrollbar({'ignoreMobile': true});
            }
        }
    }, false);

    if (dukamarket_params.is_preview) {
        //
        // Elementor scripts
        //
        $(window).on('elementor/frontend/init', function () {
            elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope, $) {
                $scope.find('.owl-slick').dukamarket_init_carousel();
                $scope.find('.elementor-section-slide').dukamarket_init_carousel();
                $scope.find('.equal-container.better-height').dukamarket_better_equal_elems();
                if ($.fn.dukamarket_countdown) {
                    $scope.find('.dukamarket-countdown').dukamarket_countdown();
                }
            });
        });
    }

})(window.jQuery);