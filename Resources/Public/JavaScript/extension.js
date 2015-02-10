$(function () {
	//detail tabs
	$('.tx-efblog-detail-container .tab_content').hide();
	$('ul.tabs li:first').addClass('active').show();
	$('.tab_content:first').show();

	$('ul.tabs li').click(function () {

		$('ul.tabs li').removeClass('active');
		$(this).addClass('active');
		$('.tab_content').hide();

		var activeTab = $(this).find('a').attr('id');
		$('.tab_content#' + activeTab).show();
		return false;
	});

	//Social
	if ($('.tx-efblog-detail-social').length > 0) {
		$('.tx-efblog-detail-social').socialSharePrivacy({
			'css_path': '',
			'lang_path': '/typo3conf/ext/efblog/Resources/Public/JavaScript/socialshareprivacy/lang/',
			'language': 'de'
		});
	}

	//Commentform
	$('.tx-efblog-comment-form #tx-efblog-link').parent().parent().hide();

	$('.tx-efblog-comments-list').on('click', '.create-answer a', function () {
		console.log($(this).data('comment'));
		$('#comment-form #tx-efblog-parentComment').val($(this).data('comment'));
	});

	//Post Hit Counter
	if ($('.tx-efblog-detail-container').length > 0) {
		var agent = window.navigator.userAgent;
		var postUid = $('.tx-efblog-detail-container').data('uid') + "";
		var pattern = /bot|googlebot|crawler|spider|robot|crawling/i;

//		$.removeCookie('txEfblogPostCount');
		var postCookie = $.cookie('txEfblogPostCount'),
				postArr = postCookie ? postCookie.split('|').getUnique() : [];

		if (!pattern.test(agent) && $.inArray(postUid, postArr) == -1) {
			$.ajax({
				dataType: "TEXT",
				url: updateViewsUri,
				data: {
					'tx_efblog_fe1[post]': postUid
				},
				success: function (result) {
					if (result == "true") {
						postArr.push(postUid);
						postArr.getUnique();
						$.cookie('txEfblogPostCount', postArr.join('|'), {
							expires: 1
						});
					}
				}
			});
		}
	}

	//Archive menu
	$('.tx-efblog-widget-content .year').next().hide();

	var cookie = $.cookie('txEfblogArchive'),
			expanded = cookie ? cookie.split('|').getUnique() : [],
			cookieExpires = 7;

	$.each(expanded, function () {
		$('#' + this).show();
	});

	$('.tx-efblog-widget-content .year').click(function () {
		$(this).next().slideToggle('300', function () {
			updateCookie(this);
		});
	});

	// Update the Cookie
	function updateCookie(el) {
		var tmp = expanded.getUnique();
		if ($(el).is(':hidden')) {
			tmp.splice(tmp.indexOf(el.id), 1);
		} else {
			tmp.push(el.id);
		}
		expanded = tmp.getUnique();
		$.cookie('txEfblogArchive', expanded.join('|'), {
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


