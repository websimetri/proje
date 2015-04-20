jQuery(function($) {
	width = $(window).width();
	
	$('ul.slideshow').bxSlider({
		mode: 'fade',
		captions: true,
		pager: false,
		auto: true
	});
	
	$('.announce-slider').bxSlider({
		mode: 'vertical',
		pager: false,
		controls: true
	});
	
	
	if (width > 960) {
		$('.product-slider').bxSlider({
			controls: true,
			pager: false,
			minSlides: 4,
			maxSlides: 4,
			slideWidth: 270,
			slideMargin: 20
		});
	} else if (width >= 768) {
		$('.product-slider').bxSlider({
			controls: true,
			pager: false,
			minSlides: 3,
			maxSlides: 3,
			slideWidth: 200,
			slideMargin: 20
		});
	} else if (width < 768) {
		$('.product-slider').bxSlider({
			controls: true,
			pager: false
		});
	}
	
	$('.prod-slider').bxSlider({
		controls: true,
		pager: true,
		pagerCustom: '#bx-pager',
	});
	

	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
		new SelectFx(el);
	});
	
	$('.cs-options ul li').click(function() {
		window.location = $(this).attr('data-value');
	});

	/*var $menu = $('nav'),
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
		});*/
	
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