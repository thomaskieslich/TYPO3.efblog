Ext.ns('TYPO3.Tkblog');

TYPO3.Tkblog.bloglist = Ext.extend(Ext.Panel, {
	border: false,
	id: 'tkblog-bloglist',
	html: '<h1>Hello World, 2nd Component</h1>'
});

TYPO3.ModuleMenu.App.registerNavigationComponent('tkblog-bloglist', function() {
	return new TYPO3.Tkblog.bloglist();
});
