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

	//Commentform
	$('.tx-efblog-comments-list').on('click', '.create-answer a', function () {
		$('#comment-form #tx-efblog-parentComment').val($(this).data('comment'));
	});

	//Archive menu
	$('.tx-efblog-widget-content .year').next().hide();

	var txEfblogArchive = (getLocalStorage('txEfblogArchive')) ? getLocalStorage('txEfblogArchive') : [];
	if (txEfblogArchive) {
		$.each(txEfblogArchive, function (index, value) {
			$('#' + value).show();
		});
	}

	$('.tx-efblog-widget-content .year').click(function () {
		$(this).next().slideToggle('300', function () {
			if ($(this).is(':hidden')) {
				txEfblogArchive.remove($(this).attr('id'));
			} else {
				txEfblogArchive.push($(this).attr('id'));
			}

			//set for 7 days
			setLocalStorage('txEfblogArchive', txEfblogArchive.unique(), 1440 * 7);
		});
	});

	//social
	if ($('.tx-efblog-detail-social').length > 0) {
	}
});

//localStorage
/**
 *
 * @param key
 * @param jsonData
 * @param expires in minutes
 * @returns {*}
 */
function setLocalStorage(key, jsonData, expires) {
	if (!window.localStorage) return false;
	if (expires == undefined || expires == 'null') { expires = 1440 * 7; }
	var expirationMS = expires * 60 * 1000;
	var record = {value: JSON.stringify(jsonData), expires: new Date().getTime() + expirationMS}
	localStorage.setItem(key, JSON.stringify(record));
	return jsonData;
}

/**
 *
 * @param key
 * @returns {*}
 */
function getLocalStorage(key) {
	if (!window.localStorage) return false;
	var record = JSON.parse(localStorage.getItem(key));
	if (!record) {return false;}
	if (new Date().getTime() < record.expires) {
		return JSON.parse(record.value)
	} else {
		localStorage.removeItem(key);
	}
}

/**
 * remove by value
 * @returns {Array}
 */
Array.prototype.remove = function () {
	var what, a = arguments, L = a.length, ax;
	while (L && this.length) {
		what = a[--L];
		while ((ax = this.indexOf(what)) !== -1) {
			this.splice(ax, 1);
		}
	}
	return this;
};

/**
 * Return unique Array
 * @returns {Array}
 */
Array.prototype.unique = function () {
	var n = {}, r = [];
	for (var i = 0; i < this.length; i++) {
		if (!n[this[i]]) {
			n[this[i]] = true;
			r.push(this[i]);
		}
	}
	return r;
};


