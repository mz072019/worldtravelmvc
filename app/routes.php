<?php
function call($controller, $action){
	
	require_once('controllers/' . $controller . '_controller.php');
	switch($controller) {
		case 'pages':
			require_once('models/offers.model.php');
			$controller = new PagesController();
		break;
		
		case 'categories':
			require_once('models/categories.model.php');
			require_once('models/offers.model.php');
			$controller = new CategoriesController();
		break;
		
		case 'login':
			require_once('models/login.model.php');
			$controller = new LoginController();
		break;
				
		case 'offers':
			require_once('models/categories.model.php');			
			require_once('models/offers.model.php');
			$controller = new OffersController();
		break;
		
	}
	$controller->{ $action }();
}


$controllers = array	(	'pages' => ['home', 'error', 'about', 'terms'],							
							'categories' => ['index',  'manage', 'insert', 'edit', 'delete'],
							'login' => ['check', 'logout'],
							'offers' => ['add', 'insert', 'show', 'manage', 'edit', 'delete']
						);

if (array_key_exists($controller, $controllers)) {
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action);
	} 
	else {
		call('pages', 'error');
	}
}
else {
	call('pages', 'error');
}
?>