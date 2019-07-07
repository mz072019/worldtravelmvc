<?php
class Login 
{
	public $username;
	public $password;
	
	public function __construct($username, $password) {
		$this->username      = $username;
		$this->password  = $password;
	}

	public static function checkLogin($email, $sifra) {		
		if(isset($email) && isset($sifra)){
			$db = Db::getInstance();		
			$req = $db->prepare("SELECT * FROM korisnici WHERE email = ? ");
			$req->execute(array($email));
			foreach($req->fetchAll() as $user) 
			{
				if(password_verify($sifra, $user['sifra']))
					return 1;
				else
					return 0;
			}
			
		}
		else
			return 0;
	}
}
?>