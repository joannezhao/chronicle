$(document).ready(function() {

	var s = skrollr.init({
		smoothScrolling: false,
		forceHeight: false
	});

	var getHeight = function (fromClass) {
	    var $inspector = $("<div>").css('display', 'none').addClass(fromClass);
	    $("body").append($inspector);
	    try {
	        return $inspector.height();
	    }
	    finally {
	        $inspector.remove();
	    }
	};

	var refresh_skrollr = function() {
		var viewport_height = $(window).height();
		$('.wrapper-parallax-image').each(function() {
			var cls = new String();
			cls = $(this).hasClass('wrapper-parallax-image-sm') ? 'wrapper-parallax-image-sm' : cls;
			cls = $(this).hasClass('wrapper-parallax-image-lg') ? 'wrapper-parallax-image-lg' : cls;
			var height = getHeight(cls);
			if (height == 0) { return; }
			var newHeight = height + viewport_height;
			$(this).attr('data-bottom-top', 'transform: translate3d(0px, ' + newHeight + 'px, 0px);');
			console.log("h: " + height);
			console.log("v: " + viewport_height);

			var img = $(this).find('.parallax-image');
			var e = height - (height * height) / viewport_height;
			img.css({'height': height + e});
			img.attr('data-top-bottom', 'transform: translate3d(0px, ' + (height - e) + 'px, 0px);');
		});
		setTimeout(function() { skrollr.get().refresh(); }, 0);
	};

	refresh_skrollr();
	$(window).resize(refresh_skrollr);


	// Slider animation
	var animate_slider = function(next) {
		var wrapper = next.closest('.slide-wrapper');
		var active = wrapper.find('.slide.active');

		var info_wrapper = wrapper.closest('.slide-window').find('.slide-info-wrapper');
		var info_active = info_wrapper.find('.slide-info.active');
		var info_next = info_wrapper.find('.slide-info[data-id="' + next.attr('data-id') + '"]');

		if (wrapper.find('.appearing').length || next.is(active)) {
			return false;
		}
		
		next.addClass('appearing').css('opacity', '1');
		active.css('opacity', '0');

		info_next.addClass('appearing').css('opacity', '1');
		info_active.css('opacity', '0');

		var link = wrapper.closest('.slide-window').find('.slide-link[data-id="' + next.attr('data-id') + '"]');
		$('.slide-link.active').removeClass('active');
		link.addClass('active');
	}

	$('.slide-arrow').on('click', function() {
		var wrapper = $(this).closest('.slide-window').find('.slide-wrapper');
		var active = wrapper.find('.slide.active');
		var next;

		if ($(this).hasClass('slide-arrow-left')) {
			next = active.is(':first-child') ? wrapper.find('.slide:last') : active.prev('.slide');
		}
		else {
			next = active.is(':last-child') ? wrapper.find('.slide:first') : active.next('.slide');
		}

		animate_slider(next);
	});

	$('.slide-link').on('click', function() {
		var wrapper = $(this).closest('.slide-window').find('.slide-wrapper');
		var active = wrapper.find('.slide.active');
		var next = wrapper.find('.slide[data-id="' + $(this).attr('data-id') + '"]');

		animate_slider(next);
	});

	$('.slide').on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e) {
		if ($(e.target).is('.slide.appearing')) {
			var wrapper = $(e.target).closest('.slide-window').find('.slide-wrapper');
			var active = wrapper.find('.slide.active');
			var next = wrapper.find('.slide.appearing');

			active.removeClass('active');
			next.addClass('active').removeClass('appearing');
			wrapper.find('.slide').removeAttr('style');
		}
	});
	$('.slide-info').on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e) {
		if ($(e.target).is('.slide-info.appearing')) {
			var wrapper = $(e.target).closest('.slide-window').find('.slide-info-wrapper');
			var active = wrapper.find('.slide-info.active');
			var next = wrapper.find('.slide-info.appearing');

			active.removeClass('active');
			next.addClass('active').removeClass('appearing');
			wrapper.find('.slide-info').removeAttr('style');
		}
	});


	// Stretch slider links to appropriate width
	$('.slide-link-wrapper').each(function() {
		var links = $(this).find('.slide-link');
		var width = ($(this).width() / links.length) - 15;
		links.css('width', width);
	});

});

$(window).load(function() {
	$('body').removeAttr('style');
});