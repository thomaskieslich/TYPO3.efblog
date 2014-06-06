$(function () {
	//detail tabs
	$(".tab_content").hide();
	$("ul.tabs li:first").addClass("active").show();
	$(".tab_content:first").show();

	$("ul.tabs li").click(function () {

		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();

		var activeTab = $(this).find("a").attr("id");
		$('.tab_content#' + activeTab).show();
		return false;
	});

	//Social
	if ($('.tx-efblog-detail-social').length > 0) {
		$('.tx-efblog-detail-social').socialSharePrivacy({
			"css_path": "/typo3conf/ext/efblog/Resources/Public/Js/socialshareprivacy/socialshareprivacy.css",
			"lang_path": "/typo3conf/ext/efblog/Resources/Public/Js/socialshareprivacy/lang/",
			"language": "de"
		});
	}

	//Commentform
	$('#tx-efblog-comment-form #tx-efblog-link').parent().hide();

	//Archive menu
	$('.tx-efblog-widget-content .year').next().hide();

	var cookie = $.cookie("tx_efblog"),
		expanded = cookie ? cookie.split("|").getUnique() : [],
		cookieExpires = 7;

	$.each(expanded, function () {
		$('#' + this).show();
	})

	$('.tx-efblog-widget-content .year').click(function () {
		$(this).next().slideToggle('300', function () {
			updateCookie(this);
		});
	})

	// Update the Cookie
	function updateCookie(el) {
		var tmp = expanded.getUnique();
		if ($(el).is(':hidden')) {
			tmp.splice(tmp.indexOf(el.id), 1);
		} else {
			tmp.push(el.id);
		}
		expanded = tmp.getUnique();
		$.cookie("tx_efblog", expanded.join('|'), {
			expires: cookieExpires
		});
	}

});

// Return a unique array.
Array.prototype.getUnique = function (sort) {
	var u = {}, a = [], i, l = this.length;
	for (i = 0; i < l; ++i) {
		if (this[i] in u) {
			continue;
		}
		a.push(this[i]);
		u[this[i]] = 1;
	}
	return (sort) ? a.sort() : a;
}


