jQuery(document).ready(function($){

var mainNav = $('#main-navigation');
var mainNavHome = $('body.home #main-navigation');
var mobileNav = $('#mobile-navigation');
var mobileMenu = mobileNav.find('ul.mobile-menu');
var button = $('#toggle-button');
var body = $('body');
var footer = $('footer.site-footer');

if ( typeof mobileMenu === 'undefined' ) {
	button.hide();
	return;
}

button.click(function(){
	//mainNav.toggleClass('on');
	mobileNav.toggleClass('open');
	body.toggleClass('lock');
	//footer.toggleClass('open');
	button.toggleClass('toggled');
	if ( ! mobileNav.hasClass('open') ) {
		button.attr('aria-expanded', 'false');
		mobileMenu.attr('aria-expanded', 'false');
	} else {
		button.attr('aria-expanded', 'true');
		mobileMenu.attr('aria-expanded', 'true');
	}
});

$(document).click(function(event){
	var target = $(event.target);
	if ( !target.closest('.site-header').length ) {
		mobileNav.removeClass('open');
		footer.removeClass('open');
	}
});

var mainItem = $('#main-navigation li.menu-item-has-children');
var mainSubmenu = mainItem.find('ul.sub-menu');

mainItem.mouseover(function(){
	mainSubmenu.addClass('open');
});
mainItem.mouseout(function(){
	mainSubmenu.removeClass('open');
});

var mobileItem = $('#mobile-navigation li.menu-item-has-children');
var mobileItemLink = mobileItem.find('a.submenu-toggle');
var mobileSubmenu = mobileItem.find('ul.sub-menu');
var submenuHeight = mobileSubmenu.outerHeight();

$(mobileItem).on('click', '.submenu-toggle', function(e){
	e.preventDefault();
	$(this).toggleClass('toggled');
	mobileSubmenu.slideToggle();
	/*mobileItem.toggleClass('toggled');
	if ( mobileItem.hasClass('toggled') ) {
		mobileItem.css('height', submenuHeight + 49);
	} else {
		mobileItem.css('height', 49);
	}
	mobileSubmenu.toggleClass('open');*/
});

});

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'mobile-navigation' );
	if ( ! container ) {
		return;
	}

	button = document.getElementById( 'toggle-button' );
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		//button.style.display = 'none';
		//return;
	}

	//menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'mobile-menu' ) ) {
		//menu.className += ' mobile-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'open' ) ) {
			//container.className = container.className.replace( ' open', '' );
			//button.className = button.className.replace( ' toggled', '' );
			//button.setAttribute( 'aria-expanded', 'false' );
			//menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			//container.className += ' open';
			//button.className += ' toggled';
			//button.setAttribute( 'aria-expanded', 'true' );
			//menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		//links[i].addEventListener( 'focus', toggleFocus, true );
		//links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	/*( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );*/
} )();
