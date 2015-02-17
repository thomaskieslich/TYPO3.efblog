tinymce.init({
	selector: '#tx-efblog-message',
	paste_as_text: true,
	valid_elements: "p,br,strong/b,em,blockquote,a[href|target=_blank|rel],img[src]",
	content_css: '/typo3conf/ext/theme_dev/Resources/Public/Styles/Rte.css',

	plugins: [
		'link code fullscreen wordcount'
	],
	target_list: [
		{title: 'New page', value: '_blank'}
	],
	rel_list: [
		{title: 'No Follow', value: 'nofollow'}
	],

	toolbar1: 'bold italic blockquote link fullscreen',
	menubar: false,
	statusbar: true
});