Ext.ns('TYPO3.Tkblog.blogpanel');

TYPO3.Tkblog.blogpanel = Ext.extend(Ext.Panel, {
	id: 'typo3-blogpanel',
	border: false,
	html: 'huhu',
	enableDD: true,
	dragConfig: {
		ddGroup: 'TreeDD'
	}
});

TYPO3.ModuleMenu.App.registerNavigationComponent('tkblog-blogpanel', function() {
	return new TYPO3.Tkblog.blogpanel();
});
