$(document).ready(function() {

	var s = skrollr.init({
		smoothScrolling: false,
		forceHeight: false
	});
	$('.navbar-link').each(function(i) {
		if (i==0) { $(this).attr('data-margin', '0'); return; }
		var margin = parseInt($(this).prev().attr('data-margin')) + $(this).prev().outerWidth();
		console.log(parseInt($(this).prev().attr('data-margin')) + ', ' + $(this).prev().outerWidth());
		$(this).css({'margin-left': margin}).attr('data-margin', margin);
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
			cls = $(this).hasClass('wrapper-parallax-image-full') ? 'wrapper-parallax-image-full' : cls;
			var height = getHeight(cls);
			if (height == 0) { return; }
			var newHeight = height + viewport_height;
			$(this).attr('data-bottom-top', 'transform: translate3d(0px, ' + newHeight + 'px, 0px);');

			var img = $(this).find('.parallax-image');
			var e = height - (height * height) / viewport_height;
			img.css({'height': height + e});
			img.attr('data-top-bottom', 'transform: translate3d(0px, ' + (height - e) + 'px, 0px);');
		});
		setTimeout(function() { skrollr.get().refresh(); }, 0);
	};

	$('img.size-parallax').each(function(i) {
		$(this).after('<div class="gap gap-sm shadow-inset-sm" id="gap' + (i+1) + '"></div>');
		$(this).closest('p').addClass('p-parallax').next().css('padding-top', '24px');
		$(this).remove();
		$('#content').prepend('\
			<div class="wrapper-parallax-image wrapper-parallax-image-sm"\
			    data-anchor-target="#gap' + (i+1) + '"\
				data-bottom-top="transform: translate3d(0px, 1200px, 0px);"\
				data-top-bottom="transform: translate3d(0px, 0px, 0px);">\
				\
				<div class="parallax-image parallax-image-sm"\
					data-anchor-target="#gap' + (i+1) + '"\
					style="background-image:url(\'' + $(this).attr('src') + '\');"\
					data-bottom-top="transform: translate3d(0px, -300px, 0px);"\
					data-top-bottom="transform: translate3d(0px, 220px, 0px);">\
				</div>\
			</div>');
		setTimeout(refresh_skrollr, 40);
		setTimeout(refresh_skrollr, 200);
	});

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
			wrapper.find('.slide').css('opacity', '');
		}
	});
	$('.slide-info').on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(e) {
		if ($(e.target).is('.slide-info.appearing')) {
			var wrapper = $(e.target).closest('.slide-window').find('.slide-info-wrapper');
			var active = wrapper.find('.slide-info.active');
			var next = wrapper.find('.slide-info.appearing');

			active.removeClass('active');
			next.addClass('active').removeClass('appearing');
			wrapper.find('.slide-info').css('opacity', '');
		}
	});


	// Stretch slider links to appropriate width
	$('.slide-link-wrapper').each(function() {
		var links = $(this).find('.slide-link');
		var width = ($(this).width() / links.length) - 15;
		links.css('width', width);
	});
	$('p').css('color', '');

	$('.size-article').each(function() {
		$(this).after('<div class="article-image shadow-inset-sm" style="background-image: url(' + $(this).attr('src') + ');"></div>');
		$(this).remove();
	});


	// Expand search bar
	var expand_search = function() {
		if ($('#navbar-search').attr('data-expanded') == "true") return;
		$('.navbar-link').each(function(i) {
			var margin = parseInt($(this).css('margin-left'));
			$(this).stop().animate({'padding-left': 20, 'padding-right': 20, 'margin-left': margin - (i*20) }, 400, 'easeInOutQuad');
			$(this).find('.navbar-link-text').css('transition', 'color 0.4s').css('color', '#BBB');
		});
		$('#navbar-search').stop().animate({'width': 195}, 400, 'easeInOutQuad').attr('data-expanded', 'true').addClass('active');
		$('#navbar-search-field').focus().css('opacity', '1.0').animate({'width': 195});
		$('#navbar-search-text').animate({'width': 35});
	}
	var collapse_search = function() {
		if ($('#navbar-search').attr('data-expanded') == "false") return;
		$('.navbar-link').each(function(i) {
			var margin = parseInt($(this).attr('data-margin'));
			$(this).stop().animate({'padding-left': 30, 'padding-right': 30, 'margin-left': margin }, 400, 'easeInOutQuad');
			$(this).find('.navbar-link-text').css('color', '');
		});
		$('#navbar-search').stop().animate({'width': 65}, 400, 'easeInOutQuad', function() {
			$('#navbar-search').attr('data-expanded', 'false');
			$('.navbar-link-text').css('transition', '');
		}).removeClass('active');
		$('#navbar-search-field').blur().css('opacity', '0.0').animate({'width': 65}).val('');
		$('#navbar-search-text').animate({'width': 65});
	}

	$(document).on('click', function(e) {
		var searchbox = $(e.target).closest('#navbar-search');
		if (searchbox.length) { expand_search(); }
		else { collapse_search(); }
	});
	$('#navbar-search-text').on('click', function() {
		if ($('#navbar-search[data-expanded="true"]').length) {
			$('#navbar-search-form').submit();
		}
	});
	$(document).on('keyup', function(e) {
		if (e.which == 27) { collapse_search(); }
	});
	$('#navbar-search-field').on('keyup', function(e) {
		if (e.which == 13) { $('#navbar-search-form').submit(); }
	});
	
	$('blockquote').addClass('quote');
	$('.article p a img').closest('p').addClass('side-image');
	$('.article figure a img').closest('figure').addClass('side-image');
	$('.article a img').each(function() {
		$(this).after('<div class="side-image ' + $(this).attr('class') + '" \
			style="background-image: url(\'' + $(this).attr('src') + '\'); \
			width: ' + $(this).attr('width') + 'px; \
			height: ' + $(this).attr('height') + 'px;"></div>').remove();
	});


	// // Comment section
	// $('#comment').on('focus', function() {
	// 	if ($(this).attr('data-empty') == 'true') {
	// 		$(this).val('').css('color', '#555').attr('data-empty', 'false');
	// 	}
	// })
	// .on('blur', function() {
	// 	if ($(this).val().length == 0) {
	// 		$(this).val('Add a comment').css('color', '#999').attr('data-empty', 'true');
	// 	}
	// });

	$('.about-link').on('click', function() {
		if ($(this).hasClass('active')) return;
		var page = $(this).attr('data-id');
		$('.about-link').removeClass('active').filter('[data-id="' + page + '"]').addClass('active');
		$('.about-section').removeClass('active').filter('[data-id="' + page + '"]').addClass('active');
	})
});

$(window).load(function() {
	$('body').removeAttr('style');
});