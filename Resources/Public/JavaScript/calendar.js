var highlightedDates = [];
getDates();

$(function () {
	$.datepick.setDefaults($.datepick.regionalOptions['de']);

	$("#datepicker").datepick({
		dateFormat: 'yy-mm-dd',
		onShow: function (picker) {
			setDays(picker);
		},
		onSelect: function (dates) {
			getDayDates(dates);
		},
		onChangeMonthYear: function (year, month) {
			getDates(year, month);
		}
	});
	getDayDates();
});

function getDates(year, month) {
	// if no month and year set it to current
	if (!year && !month) {
		var currentTime = new Date();
		year = currentTime.getFullYear();
		month = currentTime.getMonth() + 1;
	}

	$.ajax({
		dataType: "json",
		url: datepickDataUri,
		data: {
			'tx_efblog_fe1[year]': year,
			'tx_efblog_fe1[month]': month
		},
		success: function (result) {
			highlightedDates = result;
		}
	});
}

function setDays(picker) {
	$.each([highlightedDates], function (index, value) {
		picker.find('.dp' + value).addClass('has-dates');
	});
}

function getDayDates(dates) {
	var date = dates[0];
	if (!date) {
		date = new Date();
	}
	$.ajax({
		dataType: "html",
		url: datepickDayUri,
		data: {
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