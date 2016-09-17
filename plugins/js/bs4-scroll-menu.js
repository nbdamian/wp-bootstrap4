/*
 * Scrolling class change script
 */

jQuery(document).ready(function($) {
	"use strict";

	$(window).scroll(function() {
		var cur_pos = $(window).scrollTop();
		if (cur_pos > scroll_menu.offset) {
			$("#main-navbar").removeClass(scroll_menu.unscrolled).addClass(scroll_menu.scrolled);
			$("body").removeClass("unscrolled").addClass("scrolled");
		} else {
			$("#main-navbar").removeClass(scroll_menu.scrolled).addClass(scroll_menu.unscrolled);
			$("body").removeClass("scrolled").addClass("unscrolled");
		}
	});
});
