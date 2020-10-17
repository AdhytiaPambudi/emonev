(function($) {
	$(document).ready(function() {
		$('#sidebar-new nav ul li ul').prev('a').append('<i class="arrow fa fa-chevron-right"></i>');
		$('nav li.has-sub>a').on('click', function() {
			$(this).removeAttr('href');
			var element = $(this).parent('li');
			if (element.hasClass('open')) {
				element.removeClass('open');
				element.find('li').removeClass('open');
				element.find('ul').slideUp();
			} else {
				element.addClass('open');
				element.children('ul').slideDown();
				element.siblings('li').children('ul').slideUp();
				element.siblings('li').removeClass('open');
				element.siblings('li').find('li').removeClass('open');
				element.siblings('li').find('ul').slideUp();
			}
		});
		$('#sidebar-new nav ul li ul li').children('a').each(function() {
			var text = $(this).text();
			if (text.length > 20) {
				$(this).hover(
					function() {
						$(this).stop().animate({ textIndent: -parseInt(text.length) - 20 }, 2000);
					},
					function() {
						$(this).stop().animate({ textIndent: '0' });
					}
				);
			}
		});
		$('#sidebar-new nav ul li ul li ul li').children('a').each(function() {
			var text = $(this).text();
			if (text.length > 10) {
				$(this).hover(
					function() {
						$(this).stop().animate({ textIndent: -parseInt(text.length) - 20 }, 2000);
					},
					function() {
						$(this).stop().animate({ textIndent: '0' });
					}
				);
			}
		});

		// $('#cssmenu>ul>li.has-sub>a').append('<span class="holder"></span>');

		(function getColor() {
			var r, g, b;
			var textColor = $('nav').css('color');
			textColor = textColor.slice(4);
			r = textColor.slice(0, textColor.indexOf(','));
			textColor = textColor.slice(textColor.indexOf(' ') + 1);
			g = textColor.slice(0, textColor.indexOf(','));
			textColor = textColor.slice(textColor.indexOf(' ') + 1);
			b = textColor.slice(0, textColor.indexOf(')'));
			var l = rgbToHsl(r, g, b);
			if (l > 0.7) {
				$('nav>ul>li>a').css('text-shadow', '0 1px 1px rgba(0, 0, 0, .35)');
				$('nav>ul>li>a>span').css('border-color', 'rgba(0, 0, 0, .35)');
			} else {
				$('nav>ul>li>a').css('text-shadow', '0 1px 0 rgba(255, 255, 255, .35)');
				$('nav>ul>li>a>span').css('border-color', 'rgba(255, 255, 255, .35)');
			}
		})();

		function rgbToHsl(r, g, b) {
			(r /= 255), (g /= 255), (b /= 255);
			var max = Math.max(r, g, b),
				min = Math.min(r, g, b);
			var h,
				s,
				l = (max + min) / 2;

			if (max == min) {
				h = s = 0;
			} else {
				var d = max - min;
				s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
				switch (max) {
					case r:
						h = (g - b) / d + (g < b ? 6 : 0);
						break;
					case g:
						h = (b - r) / d + 2;
						break;
					case b:
						h = (r - g) / d + 4;
						break;
				}
				h /= 6;
			}
			return l;
		}
	});
})(jQuery);
$(function menuToggler() {
	$('header .menu-toggler').click(function() {
		if ($('#container-new').hasClass('full')) {
			$('#container-new').removeClass('full');
		} else {
			$('#container-new').addClass('full');
		}
		/*if($('header').offset().left > 0){
            $('header,#wrapper,#pathway').animate({'left':'0px'},400);
            $('#sidebar').animate({'left':'-240px'},600);
        } else {
            $('header,#wrapper,#pathway').animate({'left':'240px'},400);
            $('#sidebar').animate({'left':'0px'},200);
        }*/
	});
});
$(function() {
	$('.breadcrumb').appendTo('#pathway');
});
$(function activeMenu() {
        console.log($('.breadcrumb li').length);

	if ($('.breadcrumb li').length == 1) {
		var active = $('.breadcrumb .current').text();

		$('#sidebar-new nav a')
			.filter(function() {
				var text = $(this).text();
				return text == active;
			})
			.parent()
			.addClass('selected')
			.children('ul')
			.show();
	} else if ($('.breadcrumb li').length == 2) {
		var active = $('.breadcrumb li').eq(1).text();

		$('#sidebar-new nav a')
			.filter(function() {
				var text = $(this).text();
				return text == active;
			})
			.parent()
			.addClass('selected')
			.children('ul')
			.show();
	} else if ($('.breadcrumb li').length == 3) {
		var active = $('.breadcrumb li').eq(1).text(),
			active2 = $('.breadcrumb li').eq(2).text();

		$('#sidebar-new nav a')
			.filter(function() {
				var text = $(this).text();
				return text == active;
			})
			.parent()
			.addClass('open')
			.children('ul')
			.show();

		$('#sidebar-new nav a')
			.filter(function() {
				var text = $(this).text();
				return text == active2;
			})
			.parent()
			.addClass('active');
	} else if ($('.breadcrumb li').length > 3){
		var active = $('.breadcrumb li').eq(0).text(),
			active2 = $('.breadcrumb li').eq(1).text(),
			active3 = $('.breadcrumb li').eq(2).text(),
			active4 = $('.breadcrumb li').eq(3).text();

console.log($('#sidebar-new nav a')
			.filter(function() {
				var text = $(this).text();
				return text == active;
			})
			.parent());
		$('#sidebar-new nav a')
			.filter(function() {
				var text = $(this).text();
				return text == active;
			})
			.parent()
			.addClass('open')
			.children('ul')
			.show();

		$('#sidebar-new nav a')
			.filter(function() {
				var text = $(this).text();
				return text == active2;
			})
			.parent()
			.addClass('open')
			.children('ul')
			.show();

		$('#sidebar-new nav a')
			.filter(function() {
				var text = $(this).text();
				return text == active3;
			})
			.parent()
			.addClass('selected');
	}


	/*if($('.breadcrumb[class!=inactive] li').length == 1){
        var active = $('.breadcrumb .current').text();
        $('#sidebar-new nav a:contains('+active+')').parent().addClass('active');
    }
    else if($('.breadcrumb[class!=inactive] li').length > 1){
        var active  = $('.breadcrumb li').eq(1).text(),
            active2 = $('.breadcrumb li').eq(2).text() ;
        $('#sidebar nav a:contains('+active+')').parent().addClass('active').children('ul').show();
        $('#sidebar nav a:contains('+active2+')').parent().addClass('active').children('ul').show();
    }*/
});
$(function pathway() {
	$('.breadcrumb').prependTo('#pathway');
});
$(function adminTools() {
	$('.admin-tools .tools a.toggler').click(function() {
		if ($(this).parent().find('.popover').is(':hidden')) {
			$('.admin-tools .tools a.toggler').removeClass('active');
			$('.admin-tools .popover').hide();
			$(this).addClass('active').parent().find('.popover').show();
		} else {
			$(this).removeClass('active').parent().find('.popover').hide();
		}
	});
});
