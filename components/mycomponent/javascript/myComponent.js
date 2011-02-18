Ext.ns('TYPO3.CustomNavDemo');

TYPO3.CustomNavDemo.CustomNav = Ext.extend(Ext.Panel, {
	border: false,
	id: 'typo3-myComponent',

	initComponent: function() {
		TYPO3.CustomNavDemo.Test.getContent(function(result) {
			this.update(result);
		}, this);

		TYPO3.CustomNavDemo.CustomNav.superclass.initComponent.call(this);
	}
});

TYPO3.ModuleMenu.App.registerNavigationComponent('typo3-myComponent', function() {
	return new TYPO3.CustomNavDemo.CustomNav();
});
