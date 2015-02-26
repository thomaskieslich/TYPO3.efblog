$(function () {
	//fb like
	if (getLocalStorage('txEfblogSocial-fblike') == true) {
		$('.tx-efblog-detail-social .fb-like-container #fb-switch').addClass('on');
		$('.tx-efblog-detail-social .fb-like-container .dummyButtonContainer').addClass('off');
		loadFbLike();
	}

	$('.tx-efblog-detail-social .fb-like-container').on('click touchstart', '#fb-switch', function (e) {
		$(this).toggleClass('on');
		if ($(this).hasClass('on')) {
			setLocalStorage('txEfblogSocial-fblike', true, 1440 * 90);
			$('.tx-efblog-detail-social .fb-like-container .dummyButtonContainer').addClass('off');
			if ($('.tx-efblog-detail-social .fb-like-container #fb-like-btn').hasClass('off')) {
				$('.tx-efblog-detail-social .fb-like-container #fb-like-btn').removeClass('off')
			} else {
				loadFbLike();
			}
		} else {
			setLocalStorage('txEfblogSocial-fblike', false, 1);
			$('.tx-efblog-detail-social .fb-like-container .dummyButtonContainer').removeClass('off');
			$('.tx-efblog-detail-social .fb-like-container #fb-like-btn').addClass('off');
		}
		e.preventDefault();
	});


	//fb share
	if (getLocalStorage('txEfblogSocial-fbshare') == true) {
		$('.tx-efblog-detail-social .fb-share-container #fb-switch').addClass('on');
		$('.tx-efblog-detail-social .fb-share-container .dummyButtonContainer').addClass('off');
		loadFbShare();
	}

	$('.tx-efblog-detail-social .fb-share-container').on('click touchstart', '#fb-switch', function (e) {
		$(this).toggleClass('on');
		if ($(this).hasClass('on')) {
			setLocalStorage('txEfblogSocial-fbshare', true, 1440 * 90);
			$('.tx-efblog-detail-social .fb-share-container .dummyButtonContainer').addClass('off');
			if ($('.tx-efblog-detail-social .fb-share-container #fb-share-btn').hasClass('off')) {
				$('.tx-efblog-detail-social .fb-share-container #fb-share-btn').removeClass('off')
			} else {
				loadFbShare();
			}
		} else {
			setLocalStorage('txEfblogSocial-fblike', false, 1);
			$('.tx-efblog-detail-social .fb-share-container .dummyButtonContainer').removeClass('off');
			$('.tx-efblog-detail-social .fb-share-container #fb-share-btn').addClass('off');
		}
		e.preventDefault();
	});
});

function loadFbLike() {
	$("#fb-like-btn").load("typo3conf/ext/efblog/Resources/Public/Social/fb-like.html");
}

function loadFbShare() {
	$("#fb-like-btn").load("typo3conf/ext/efblog/Resources/Public/Social/fb-share.html");
}