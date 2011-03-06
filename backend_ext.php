<?php
  if (is_object($TYPO3backend)) {  
        // calling the API generator with the TYPO3.Demo namespace
  	$pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();
  	$pageRenderer->addExtDirectCode();	
	
        // Since version 4.5.1 this code should not be added anymore!
  	// $pageRenderer->addJsFile('ajax.php?ajaxID=ExtDirect::getAPI&namespace=TYPO3.Demo', NULL, FALSE);
 
  	// calling of our own method on the client-side
  	$pageRenderer->addExtOnReadyCode('
  		TYPO3.Tkblog.blogpanel.sayHello(function(result) {
			if (typeof console == "object") {
				console.log(result);
			} else {
				alert(result);
			}
		});
  	');
  }
  ?>