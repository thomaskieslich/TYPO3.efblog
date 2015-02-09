tinymce.init({
	selector:'#tx-efblog-message',
	paste_as_text: true,
	valid_elements : "p,br,strong/b,em,blockquote,a[href|target=_blank],img[src]",
	content_css : 'typo3conf/ext/theme_dev/Resources/Public/Styles/Rte.css',


	plugins: [
		'link code fullscreen wordcount'
	],

	toolbar1: 'bold italic blockquote link fullscreen',
	menubar : false,
	statusbar: true
});