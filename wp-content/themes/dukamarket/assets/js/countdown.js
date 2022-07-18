(function ($) {
    'use strict';

    function get_digit(number) {
        var text = '',
            str  = number.toString();

        for (var i = 0; i < str.length; i++) {
            text += '<span class="digit">' + str.charAt(i) + '</span>';
        }

        return text;
    }

    function countdown_event(el, event, data) {
        var $text_number = '',
            $days        = parseInt(el.find('.days > .number').text()),
            $hours       = parseInt(el.find('.hours > .number').text()),
            $mins        = parseInt(el.find('.mins > .number').text());

        if (data.days_text !== undefined) {
            $text_number = '%D';
            const num    = event.strftime($text_number);

            if ($days != num) {
                el.find('.days > .number').html(get_digit(num));
                el.find('.days > .number').attr('data-number', num);
                el.find('.days').addClass('flip');
            }
        }
        if (data.hrs_text !== undefined) {
            $text_number = '%H';
            if (data.days_text === undefined) {
                $text_number = '%I';
            }
            const num = event.strftime($text_number);

            if ($hours != num) {
                el.find('.hours > .number').html(get_digit(num));
                el.find('.hours > .number').attr('data-number', num);
                el.find('.hours').addClass('flip');
            }
        }
        if (data.mins_text !== undefined) {
            $text_number = '%M';
            if (data.hrs_text === undefined) {
                $text_number = '%N';
            }
            const num = event.strftime($text_number);

            if ($mins != num) {
                el.find('.mins > .number').html(get_digit(num));
                el.find('.mins > .number').attr('data-number', num);
                el.find('.mins').addClass('flip');
            }
        }
        if (data.secs_text !== undefined) {
            $text_number = '%S';
            if (data.mins_text === undefined) {
                $text_number = '%T';
            }
            const num = event.strftime($text_number);

            el.find('.secs > .number').html(get_digit(num));
            el.find('.secs > .number').attr('data-number', num);
            el.find('.secs').addClass('flip');
        }
        setTimeout(function () {
            el.find('.time').removeClass('flip');
        }, 500);
    };
    $.fn.dukamarket_countdown = function () {
        $(this).not('.loaded').on('dukamarket_countdown', function () {
            $(this).each(function () {
                var el             = $(this),
                    data           = el.data('params'),
                    text_format    = '',
                    text_countdown = '';

                if (data.days_text !== undefined) {
                    text_format += '<span class="time days">';
                    text_format += '    <span class="number" data-number="00">00</span>';
                    text_format += '    <span class="text">' + data.days_text + '</span>';
                    text_format += '</span>';
                }
                if (data.hrs_text !== undefined) {
                    text_format += '<span class="time hours">';
                    text_format += '    <span class="number" data-number="00">00</span>';
                    text_format += '    <span class="text">' + data.hrs_text + '</span>';
                    text_format += '</span>';
                }
                if (data.mins_text !== undefined) {
                    text_format += '<span class="time mins">';
                    text_format += '    <span class="number" data-number="00">00</span>';
                    text_format += '    <span class="text">' + data.mins_text + '</span>';
                    text_format += '</span>';
                }
                if (data.secs_text !== undefined) {
                    text_format += '<span class="time secs">';
                    text_format += '    <span class="number" data-number="00">00</span>';
                    text_format += '    <span class="text">' + data.secs_text + '</span>';
                    text_format += '</span>';
                }

                el.html(text_format);

                el.countdown(el.data('datetime'), {elapse: true}).on('update.countdown', function (event) {
                    if (!event.elapsed) {
                        countdown_event(el, event, data);
                    }
                });

                el.addClass('loaded');
            });
        }).trigger('dukamarket_countdown');
    };

    window.addEventListener("load", function load() {
        /**
         * remove listener, no longer needed
         * */
        window.removeEventListener("load", load, false);
        /**
         * start functions
         * */

        if ($('.dukamarket-countdown').length) {
            $('.dukamarket-countdown').dukamarket_countdown();
        }

    }, false);

})(window.jQuery);