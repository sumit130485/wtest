(function ($) {
    'use strict';

    window.addEventListener("load", function load() {
        /**
         * remove listener, no longer needed
         * */
        window.removeEventListener("load", load, false);
        /**
         *
         * <div class="wrapper-main-content" style="position: relative;">
         *     <div class="sticky-content-wrap">
         *         <div class="sticky-content" data-top="10" data-bottom="10" data-screen="1199">
         *     </div>
         *     <div class="normal-content">
         * </div>
         *
         * @use: $('.sticky-content').ovic_sticky_sidebar();
         * */
        $.fn.ovic_sticky_sidebar = function () {
            var $this = $(this);
            if ($this.closest('.wrapper-main-content').length) {
                if ($this.closest('.sticky-content-wrap').length === 0) {
                    $this.wrap('<div class="sticky-content-wrap"></div>');
                }
                $this.on('ovic_sticky_sidebar', function () {
                    $this.each(function () {
                        var $wrap_content    = $(this).closest('.wrapper-main-content'),
                            $wrap_sticky     = $(this).closest('.sticky-content-wrap'),
                            $sidebar_content = $(this);

                        var $StickyScrollTop    = 0,
                            $StickyScrollBottom = 0,
                            $StickyScrollScreen = 767,
                            $lastScrollTop      = 0;


                        if ($sidebar_content.data('top') !== undefined && $sidebar_content.data('top') !== '') {
                            $StickyScrollTop += $sidebar_content.data('top');
                        }
                        if ($sidebar_content.data('bottom') !== undefined && $sidebar_content.data('bottom') !== '') {
                            $StickyScrollBottom = $sidebar_content.data('bottom');
                        }
                        if ($sidebar_content.data('screen') !== undefined && $sidebar_content.data('screen') !== '') {
                            $StickyScrollScreen = $sidebar_content.data('screen');
                        }
                        if ($('body').hasClass('admin-bar')) {
                            $StickyScrollTop += $('#wpadminbar').outerHeight();
                        }

                        if ($(window).innerWidth() <= $StickyScrollScreen || $sidebar_content.outerHeight() > $wrap_content.children().first().outerHeight()) {
                            return;
                        }

                        $wrap_sticky.css({
                            'min-height': '1px',
                            'display'   : 'inline',
                        });
                        $wrap_content.css({
                            'position': 'relative',
                        });


                        var _height_sidebar = $sidebar_content.outerHeight() + $sidebar_content.offset().top;
                        var _height_content = $wrap_content.height() + $wrap_content.offset().top;

                        $(window).on('scroll', function () {
                            if ($(window).innerWidth() > $StickyScrollScreen) {
                                /* SIDEBAR */
                                var _scroll_window         = $(window).scrollTop(),
                                    _height_window         = $(window).height(),
                                    _scroll_height         = _scroll_window + _height_window,
                                    _offset_sidebar        = $sidebar_content.offset(),
                                    _offset_content        = $wrap_content.offset(),
                                    _full_height_content   = $wrap_content.height() + _offset_content.top,
                                    _scroll_height_sidebar = $sidebar_content.outerHeight() + $sidebar_content.offset().top,
                                    _width_sidebar         = $sidebar_content.outerWidth();

                                /* SCROLL DOWN */
                                if (_scroll_window > $lastScrollTop) {
                                    if (_full_height_content <= _scroll_height && _scroll_height >= _scroll_height_sidebar) {
                                        // console.log('last');
                                        $sidebar_content.css({
                                            top     : (_offset_sidebar.top - _offset_content.top),
                                            bottom  : 'auto',
                                            position: 'absolute',
                                            width   : _width_sidebar,
                                        });
                                    } else {
                                        if (_scroll_height >= _scroll_height_sidebar) {
                                            $sidebar_content.css({
                                                top     : 'auto',
                                                bottom  : $StickyScrollBottom,
                                                position: 'fixed',
                                                width   : _width_sidebar,
                                            });
                                        }
                                        if (_scroll_window < $sidebar_content.offset().top && _height_sidebar < _scroll_height_sidebar) {
                                            $sidebar_content.css({
                                                top     : (_offset_sidebar.top - _offset_content.top),
                                                bottom  : 'auto',
                                                position: 'absolute',
                                                width   : _width_sidebar,
                                            });
                                        }
                                    }
                                } else {
                                    /* SCROLL UP */
                                    if (_offset_sidebar.top >= _scroll_window) {
                                        if (_offset_content.top - $StickyScrollTop > _scroll_window) {
                                            $sidebar_content.css({
                                                top     : 'auto',
                                                bottom  : 'auto',
                                                position: 'inherit',
                                                width   : '',
                                            });
                                        } else if (_offset_sidebar.top - $StickyScrollTop > _scroll_window) {
                                            $sidebar_content.css({
                                                top     : $StickyScrollTop,
                                                position: 'fixed',
                                                bottom  : 'auto',
                                                width   : _width_sidebar,
                                            });
                                        }
                                    } else if (_full_height_content > _scroll_height) {
                                        $sidebar_content.css({
                                            top     : (_offset_sidebar.top - _offset_content.top),
                                            bottom  : 'auto',
                                            position: 'absolute',
                                            width   : _width_sidebar,
                                        });
                                    }
                                }
                                $lastScrollTop = _scroll_window;
                            }
                        });
                    });
                }).trigger('ovic_sticky_sidebar');

                $(window).on('resize', function () {
                    if ($(window).width() > 767) {
                        var $wrap_content = $this.closest('.wrapper-main-content'),
                            $wrap_static  = $wrap_content.find('.sticky-static-content');

                        if ($wrap_static.length) {
                            var $content_width = $wrap_content.outerWidth(true),
                                $static_width  = $wrap_static.outerWidth(true);

                            $this.css({
                                width: ($content_width - $static_width),
                            });
                        }
                    }
                });
            }
        };

        if ($('.sticky-content').length) {
            $('.sticky-content').ovic_sticky_sidebar();
        }
    }, false);

})(window.jQuery);