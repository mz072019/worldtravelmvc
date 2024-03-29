<?php
class LoginController 
{
	// Provera korisnika 
	public function check() {
		if(isset($_SESSION['logedIn']) && $_SESSION['logedIn']==1)
			require_once('app/views/admin/offers.php');
		else {
			$email = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
			$sifra = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
			$login = Login::checkLogin($email, $sifra);	
			if($login==1) {
				// Ako je login uspesan redirektuj u admin sekciju
				$_SESSION['logedIn']=1;
				header('Location: index.php?controller=offers&action=manage');
			}
			else {
				// Ako je login neuspesan redirektuj na pocetnu stranu
				$offers = Offers::showLast4();		
				require_once('app/views/pages/home.php');
			}
		}
	}
	
	// Odjava korisnika 
	public function logout() {
		$_SESSION = array(); 						
		session_destroy();  	
		header('Location: index.php');
	}
}
?>