$(function () {
	if ($(".datepicker").length) {
		getDates();
		$.datepick.setDefaults($.datepick.regionalOptions['de']);
	}
});

function initDatepicker(highlightedDates) {

	$(".datepicker").datepick({
		dateFormat: 'yy-mm-dd',
		onShow: function (picker) {
			setDays(picker, highlightedDates);
		},
		onSelect: function (dates) {
			getDayDates(dates);
		},
		onChangeMonthYear: function (year, month) {
			getDates(year, month);
		}
	});
	getDayDates();
}

function setDays(picker, highlightedDates) {
	$.each(highlightedDates, function (index, value) {
		picker.find('.dp' + value).addClass('has-date');
	});
}
