jQuery(document).ready(function($){

// append arrow to menu item
$('li.menu-item-has-children > a').after('<a href="#" class="submenu-toggle"><span class="icon-caret-down"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" class="svg-inline--fa fa-caret-down fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path></svg></span></a>');

// popoups
$(document).on('click', '[data-toggle="class"]', function(){
	var $target = $($(this).data('target'));
	var classes = $(this).data('classes');
	$target.toggleClass(classes);
	return false;
});

// floating contact
function floatingContact(){
	if ( $('.contact-float').length > 0 ) {
		var width = $(window).width();
		var height = $(document).scrollTop() + window.innerHeight;
		var contact = $('.contact-float').offset().top + $('.contact-float').outerHeight();
		
		if ( $('body').hasClass('home') ) {
			
			var sliderHeight = $('#slider').outerHeight();
			var introHeight = $('.home-intro').outerHeight();
			var contentHeight = sliderHeight + introHeight;
			var bar = $('.home-banner-image').outerWidth();
			var footer = $('.site-footer').offset().top;
			
			if ( height > contentHeight && height < footer ) {
				$('.contact-float').removeClass('off');
			} else {
				$('.contact-float').addClass('off');
			}
			
		} else if ( $('body').hasClass('single-agent') ) {
			
			var bar = $('.contact-bar').outerWidth();
			var footer = $('.map-header').offset().top;
			
		} else if ( $('body').hasClass('single-property') ) {
			
			var bar = $('.contact-bar').outerWidth();
			var footer = $('.property-specialists').offset().top;
			
		} else {
			
			//var bar = $('.marketing-item .container .row').outerWidth();
			var bar = width - 30;
			var footer = $('.site-footer').offset().top;
			
		}
		
		var right = (width - bar)/2;
		//$('.contact-float').css('right', right);
		
		if ( width < 576 ) {
			$('.contact-float-btn').css('width', bar);
			$('.contact-float').css('right', right);
		} else {
			$('.contact-float-btn').css('width', 'auto');
			$('.contact-float').css('right', '2.5%');
		}
		
		if ( !$('body').hasClass('home') ) {
			if ( contact >= footer ) {
				$('.contact-float').addClass('off');
			} else {
				$('.contact-float').removeClass('off');
			}
		}
		
	}
}
if ( !$('body').hasClass('single-agent') ) {
	$(window).load(floatingContact);
}
$(window).scroll(floatingContact);
$(window).resize(floatingContact);

});