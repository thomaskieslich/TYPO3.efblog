var baseUrl = '/?type=911&tx_efblog_fe1[controller]=Ajax';

$(function () {
	//update Post views
	if ($('.tx-efblog-detail-container').length > 0) {
		var agent = window.navigator.userAgent;
		var pid = $('.tx-efblog').data('pid') + "";
		var postUid = $('.tx-efblog-detail-container').data('uid') + "";
		var pattern = /bot|googlebot|crawler|spider|robot|crawling/i;

		var txEfblogPostViews = (getLocalStorage('txEfblogPostViews')) ? getLocalStorage('txEfblogPostViews') : [];

		if (!pattern.test(agent) && $.inArray(postUid, txEfblogPostViews) == -1) {
			$.ajax({
				dataType: "text",
				url: baseUrl + '&id=' + pid,
				data: {
					'tx_efblog_fe1[action]': 'updateViews',
					'tx_efblog_fe1[post]': postUid
				},
				success: function (result) {
					if (result == "true") {
						txEfblogPostViews.push(postUid);
						setLocalStorage('txEfblogPostViews', txEfblogPostViews.unique(), 1440 * 90);
					}
				}
			});
		}
	}

	/**
	 * load comments
	 */
	if ($('.tx-efblog-detail-comments-container').length > 0) {
		var pid = $('.tx-efblog').data('pid') + "";
		var postUid = $('.tx-efblog-detail-container').data('uid') + "";
		$.ajax({
			dataType: "html",
			url: baseUrl + '&id=' + pid,
			data: {
				'tx_efblog_fe1[action]': 'loadComments',
				'tx_efblog_fe1[post]': postUid
			},
			success: function (result) {
				$('.tx-efblog-detail-comments-container').html(result);
				$('.tx-efblog-comments-list').on('click', '.create-answer a', function () {
					$('#comment-form #tx-efblog-parentComment').val($(this).data('comment'));
				});
				if (location.hash) {
					$('html, body').animate({scrollTop: $(location.hash).offset().top}, 500);
				}
			}
		});
	}
});

//###Calendar
function getDates(year, month) {
	// if no month and year set it to current
	if (!year && !month) {
		var currentTime = new Date();
		year = currentTime.getFullYear();
		month = currentTime.getMonth() + 1;
	}

	var pid = $('.tx-efblog-calendar-container').data('pid') + "";
	$.ajax({
		dataType: "json",
		url: baseUrl + '&id=' + pid,
		data: {
			'tx_efblog_fe1[action]': 'calendarMonth',
			'tx_efblog_fe1[year]': year,
			'tx_efblog_fe1[month]': month
		},
		success: function (result) {
			initDatepicker(result);
		}
	});
}

function getDayDates(dates) {
	var date;
	if (dates) {
		date = dates[0];
	} else {
		date = new Date();
	}

	var pid = $('.tx-efblog-calendar-container').data('pid') + "";
	$.ajax({
		dataType: "html",
		url: baseUrl + '&id=' + pid,
		data: {
			'tx_efblog_fe1[action]': 'calendarDay',
			'tx_efblog_fe1[date]': date
		},

		success: function (result) {
			$('#todayEntries').html(result);
		}
	});

	$('#todayEntries .toggler').click(function () {
		$(this).next('.details').slideToggle('fast');
		$(this).toggleClass('act');
	})
}