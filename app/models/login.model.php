<?php
class Login 
{
	public $username;
	public $password;
	
	public function __construct($username, $password) {
		$this->username      = $username;
		$this->password  = $password;
	}

	public static function checkLogin() {		
		if(isset($_POST['username']) && isset($_POST['password'])){
			$db = Db::getInstance();		
			$req = $db->prepare("SELECT * FROM korisnici WHERE email = ? AND sifra = ?");
			$req->execute(array($_POST['username'], md5($_POST['password'])));
			return $req->rowCount();
		}
	}
}
?>