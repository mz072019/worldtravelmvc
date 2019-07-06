<?php
class Categories {
	public $id;
	public $naziv;
	public $slika_url;

	public function __construct($id, $naziv, $slika_url) {
		$this->id = $id;
		$this->naziv = $naziv;
		$this->slika_url = $slika_url;
	}

	public function showAllCategories() {
		$list = [];
		$db = Db::getInstance();
		$req = $db->query("SELECT * FROM vrste_ponuda ORDER BY id ASC");
		foreach($req->fetchAll() as $categories) 
		{
			$list[] = new Categories($categories['id'], $categories['naziv'], $categories['slika_url']);
		}
		return $list;
	}
	
	public function insertCategory($naziv, $slika)	{
		$db = Db::getInstance();
		$req = $db->prepare("INSERT INTO vrste_ponuda(naziv, slika_url) VALUES(?, ?)");
		$req->execute(array($naziv, $slika));
		return $req->rowCount();
	}
	
	public function editCategory($naziv, $id, $slika) {
		$db = Db::getInstance();
		$req = $db->prepare("UPDATE vrste_ponuda SET naziv = ? WHERE id = ?");
		$req->execute(array($naziv, $id));
		
		if($slika !="no.png")
		{
			$req = $db->prepare("UPDATE vrste_ponuda SET slika_url = ? WHERE id = ?");
			$req->execute(array($slika, $id));		
		}
		return $req->rowCount();
	}
	
	public function deleteCategory($id) {
		$db = Db::getInstance();
		$req = $db->prepare("DELETE FROM vrste_ponuda WHERE id = ?");

		// Provera da li je vrednost CEO BROJ
		$req ->bindValue(1, $id, PDO::PARAM_INT);
		$req->execute();
		return $req->rowCount();
	}
}
?>