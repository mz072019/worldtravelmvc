<?php
class CategoriesController {
	
	// Prikaz svih kategorija na strani korisnika 
	public function index() {
		$categories = Categories::showAllCategories();	
		if (!isset($_GET['id']))
			$offers = Offers::showAllOffersInCategory("min");	
		else
			$offers = Offers::showAllOffersInCategory($_GET['id']);	
		require_once('app/views/pages/categories.php');
	}
	
	// Prikaz svih kategorija u admin sekciji 
	public function manage() {
		$categories = Categories::showAllCategories();	
		require_once('app/views/admin/categories.php');
	}
	
	// Dodavanje nove kategorije 
	public function insert() {
		if(isset($_POST['naziv']))	{
			$naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
			
			
			$target = "files/images/";
			$code = time();
			$filename = basename($_FILES['file']['name']);	
			$target1 = $target . $code."-".$filename;		
			$type = $_FILES["file"]["type"];
			// Proverava da li je slika JPG
			
			
			
			
			if($type == "image/jpeg")
			{
				if(move_uploaded_file($_FILES['file']['tmp_name'], $target1)){
					$file = $code."-".$filename;
				}
				else {
					$file = "no.png";
				}
			}		
			else
				$file = "no.png";
			$categoryAdd = Categories::insertCategory($naziv, $file);	
			
		}
		$categories = Categories::showAllCategories();	
		require_once('app/views/admin/categories.php');		
	}
	
	// Izmena kategorije
	public function edit() {
		if(isset($_POST['naziv']) && isset($_POST['id'])){
			$naziv = filter_input(INPUT_POST, 'naziv', FILTER_SANITIZE_STRING);
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);			
			
			
			$target = "files/images/";
			$code = time();
			$filename = basename($_FILES['file']['name']);	
			$type = $_FILES["file"]["type"];
			// Proverava da li je slika JPG
			if($type == "image/jpeg" || $type=="")
			{
				$target1 = $target . $code."-".$filename;		
				if(move_uploaded_file($_FILES['file']['tmp_name'], $target1)){
					$file = $code."-".$filename;
				}
				else {
					$file = "no.png";
				}
				$categoryEdit = Categories::editCategory($naziv, $id, $file);	
			}
		}
		$categories = Categories::showAllCategories();	
		require_once('app/views/admin/categories.php');		
	}
	
	// Brisanje kategorije 
	public function delete() {
		if(isset($_POST['id']))
		{
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);			
			$categoryDelete = Categories::deleteCategory($id);	
		}
		$categories = Categories::showAllCategories();	
		require_once('app/views/admin/categories.php');		
	}
}
?>