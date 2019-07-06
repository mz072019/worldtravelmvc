<?php
class Offers {
	
	public $id;
	public $nazivp;
	public $id_vr_p;
	public $opis;
	public $slika_url;
	public $aktuelno;
	public $cene_pdf;
	
	public function __construct($id, $nazivp, $id_vr_p, $opis, $slika_url, $aktuelno, $cene_pdf) {
		
		$this->id = $id;
		$this->nazivp  = $nazivp;
		$this->id_vr_p = $id_vr_p;
		$this->opis = $opis;
		$this->slika_url = $slika_url;
		$this->aktuelno = $aktuelno;
		$this->cene_pdf = $cene_pdf;
	}

	public function showAllOffersInCategory($param) {		
		
		$db = Db::getInstance();
		
		if($param == "min") {
			$req = $db->query("SELECT MIN(id) FROM vrste_ponuda");
			foreach($req->fetchAll() as $row) {
				$param = $row['MIN(id)'];
			}
		}		
		$list = [];
		
		$req = $db->query("SELECT * FROM ponude WHERE id_vr_p = $param");
		foreach($req->fetchAll() as $offers) {
			$list[] = new Offers($offers['id'],$offers['nazivp'],$offers['id_vr_p'], $offers['opis'], $offers['slika_url'], $offers['aktuelno'], $offers['cene_pdf']);
		}
		
		return $list;
	}	
	
	public function showAllOffers() {		
		
		$db = Db::getInstance();	
			
		$list = [];
		
		$req = $db->query("SELECT * FROM ponude ORDER BY nazivp ASC");
		foreach($req->fetchAll() as $offers) {
			$list[] = new Offers($offers['id'],$offers['nazivp'],$offers['id_vr_p'], $offers['opis'], $offers['slika_url'],  $offers['aktuelno'], $offers['cene_pdf']);
		}
		
		return $list;
	}

	public function showLast4() {		
		
		$db = Db::getInstance();		
		$list = [];
		
		$req = $db->query("SELECT * FROM ponude WHERE aktuelno = 'da'  LIMIT 8");
		foreach($req->fetchAll() as $offers) {
			$list[] = new Offers($offers['id'],$offers['nazivp'], $offers['id_vr_p'], $offers['opis'], $offers['slika_url'],  $offers['aktuelno'], $offers['cene_pdf']);
		}
		
		return $list;
	}	
	
	public function showOffer($id) {		
		
		$db = Db::getInstance();		
		$list = [];
		
		$req = $db->query("SELECT * FROM ponude WHERE id = $id");
		foreach($req->fetchAll() as $offers) {
			$list[] = new Offers($offers['id'],$offers['nazivp'], $offers['id_vr_p'], $offers['opis'], $offers['slika_url'],  $offers['aktuelno'], $offers['cene_pdf']);
		}
		
		return $list;
	}	
		
	// Metoda za dodavanje ponuda
	public function insertOffer($nazivp, $opis,  $slika_url, $cene_pdf, $id_vr_p, $aktuelno) {		
		$db = Db::getInstance();
		$date = date("Y-m-d H:i:s");
		
		// Unos ponude u tabelu
		$req = $db->prepare("INSERT INTO ponude(id_vr_p, nazivp, opis, slika_url, aktuelno, cene_pdf) VALUES(?,?,?,?,?,?)");
		$req->execute(array($id_vr_p,$nazivp,nl2br($opis), $slika_url,$aktuelno,$cene_pdf));
		$offerID = $db->lastInsertId(); 
		
		return $req->rowCount();
	}
	
	// Metoda za izmenu ponuda
	public function editOffer($id, $nazivp, $opis, $slika_url, $cene_pdf, $id_vr_p, $aktuelno) {
		$db = Db::getInstance();
		$req = $db->prepare("UPDATE ponude SET nazivp = ?, opis = ?, id_vr_p = ?, aktuelno = ? WHERE id = ?");
		$req->execute(array($nazivp, $opis,  $id_vr_p, $aktuelno, $id));
		
		if($slika_url !="no.png")
		{
			$req = $db->prepare("UPDATE ponude SET slika_url = ? WHERE id = ?");
			$req->execute(array($slika_url, $_POST['id']));		
		}
		
		if($cene_pdf !="no.png")
		{
			$req = $db->prepare("UPDATE ponude SET cene_pdf = ? WHERE id = ?");
			$req->execute(array($cene_pdf, $id));		
		}
		return $req->rowCount();
	}
	
	// Metoda za brisanje ponuda
	public function deleteOffer($id) {
		$db = Db::getInstance();
		$req = $db->prepare("DELETE FROM ponude WHERE id = ?");
		$req->execute(array($_POST['id']));
		return $req->rowCount();
	}
	
}
?>