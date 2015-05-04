/*$(document).ready(function(){

    $(window).resize(function(){
        widtht = $(window).width();
        if (widtht < 768){
            $('ul.topmenu').slideUp();
            $('select.selectmenu').show();
        }else{

            $('ul.topmenu').slideDown();
            $('select.selectmenu').hide();

        }
    });
})*/


jQuery(function($) {
    width = $(window).width();

    $('ul.slideshow').bxSlider({
        mode: 'fade',
        captions: true,
        pager: false,
        auto: true
    });



    $('.prod-slider').bxSlider({
        controls: true,
        pager: false
    });

    if (width > 960) {
        $('.edu-slider').bxSlider({
            controls: true,
            pager: false,
            minSlides: 4,
            maxSlides: 4,
            slideWidth: 270,
            slideMargin: 20
        });
        $('.main .blog-small-list').bxSlider({
            minSlides: 3,
            maxSlides: 3,
            slideWidth: 270,
            slideMargin: 15,
            pager: false
        });
    } else if (width >= 768) {
        $('.edu-slider').bxSlider({
            controls: true,
            pager: false,
            minSlides: 3,
            maxSlides: 3,
            slideWidth: 270,
            slideMargin: 20
        });
        $('.main .blog-small-list').bxSlider({
            pager: false
        });
    } else if (width > 480 && width < 768) {
        $('.edu-slider').bxSlider({
            controls: true,
            pager: false,
            minSlides: 2,
            maxSlides: 2,
            slideWidth: 220,
            slideMargin: 10
        });
        $('.main .blog-small-list').bxSlider({
            pager: false
        });
    } else if (width <= 480) {
        $('.edu-slider').bxSlider({
            controls: true,
            pager: false
        });
        $('.main .blog-small-list').bxSlider({
            pager: false
        });
    }

    [].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
        new SelectFx(el);
    });

    $('.cs-options ul li').click(function() {
        window.location = $(this).attr('data-value');
    });

    var $menu = $('nav'),
        optionsList = '';

    $menu.find('li').each(function() {
        var $this   = $(this),
            $anchor = $this.children('a'),
            depth   = $this.parents('ul').length - 1,
            indent  = '';

        if( depth ) {
            while( depth > 0 ) {
                indent += ' - ';
                depth--;
            }

        }
        $(".topmenu li").parent().addClass("bold");

        optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
    }).end()
        .parent().after('<select class="selectmenu">' + optionsList + '</select>');

    $('select.selectmenu').on('change', function() {
        window.location = $(this).val();
    });

    $('.lang select').on('change', function() {
        window.location = $(this).val();
    });

    var $edumenu = $('div.edu-list'),
        optionsList = '';

    $edumenu.find('li').each(function() {
        var $this   = $(this),
            $anchor = $this.children('a'),
            depth   = $this.parents('ul').length - 1,
            indent  = '';

        if( depth ) {
            while( depth > 0 ) {
                indent += ' - ';
                depth--;
            }

        }

        optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
    }).end()
        .after('<select class="selectedumenu">' + optionsList + '</select>');

    $('select.selectedumenu').on('change', function() {
        window.location = $(this).val();
    });

    /*  */
    var decimal_places = 1;
    var decimal_factor = decimal_places === 0 ? 1 : decimal_places * 10;

    $('.sayi').animateNumber(
        {
            number: 100 * decimal_factor,
            numberStep: function(now, tween) {
                var floored_number = Math.floor(now) / decimal_factor,
                    target = $(tween.elem);
                if (decimal_places > 0) {
                    floored_number = floored_number.toFixed(decimal_places);
                }

                target.text(floored_number + ' %');
            }
        },
        15000
    );


    var dd = new DropDown( $('#dd') );

    $(document).click(function() {
        $('.wrap-dropdown').removeClass('active');
    });
});

function DropDown(el) {
    this.dd = el;
    this.initEvents();
}

DropDown.prototype = {
    initEvents : function() {
        var obj = this;

        obj.dd.on('click', function(event){
            $(this).toggleClass('active');
            event.stopPropagation();
        });
    }
}