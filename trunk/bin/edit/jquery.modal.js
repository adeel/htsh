(function($) {

	$.fn.extend({

		openModal : function(settings) {
			// reference to this
			var modal = this;
			// settings
			settings = $.extend({
				width : 500,
				height : 300,
				opacity : 0.3,
			}, settings || {});
			// create overlay div
			$('<div id="overlay"></div>').appendTo('body');
			$('#overlay').css({
				zIndex : 999,
				width : $(window).innerWidth(),
				height : $(window).innerHeight(),
				opacity : settings.opacity,
				backgroundColor : '#000000',
				position : 'absolute',
				left : 0,
				top : 0,
				pointer : 'normal',
			}).click(function() {
				modal.closeModal();
			});
			// position modal
			modal.css({
				width : settings.width,
				height : settings.height,
			}).css({
				left : $(window).scrollLeft() + ($(window).width() - modal.outerWidth())/2,
				top : $(window).scrollTop() + ($(window).height() - modal.outerHeight())/2,
				position : 'absolute',
				zIndex : 1000,
			});
			// show modal
			modal.show();
			// reposition modal when window is scrolled
			$(window).scroll(function() {
				modal.css({
					left : $(window).scrollLeft() + ($(window).width() - modal.outerWidth())/2,
					top : $(window).scrollTop() + ($(window).height() - modal.outerHeight())/2,
				});
			});
			// return jQuery object
			return modal;
		},

		closeModal : function() {
			// remove modal
			this.remove();
			// remove overlay
			//$('#overlay').css({display : 'none', zIndex : 0});
			$('#overlay').remove();
			return this;
		},

	});

})(jQuery);