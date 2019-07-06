<?php
class PagesController {
	
	// Pocetna strana - Prikaz izdvojenih ponuda
	public function home(){
		$offers = Offers::showLast4();		
		require_once('app/views/pages/home.php');
	}
	
	// Strana - O nama
	public function about(){
		require_once('app/views/pages/about.php');
	}
	
	// Strana - Uslovi putovanja
	public function terms(){
		require_once('app/views/pages/terms.php');
	}
	// Stranica koja se prikazuje u slucaju greske 
	public function error(){
		require_once('app/views/pages/error.php');
	}
}
?>