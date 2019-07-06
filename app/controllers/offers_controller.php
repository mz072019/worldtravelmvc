<?php
class OffersController {
	
	// Prikaz svih kategorija u admin sekciji 
	public function manage() {
		$categories = Categories::showAllCategories();	
		$offers = Offers::showAllOffers();	
		require_once('app/views/admin/offers.php');
	}
	
	// Prikaz pojedinacne ponude 
	public function show(){
		if(isset($_GET['id'])){		
			// Cisti id tako da bude samo ceo broj
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
			
			$offers = Offers::showOffer($id);					
			require_once('app/views/pages/offer.php');
		}
		else {
			// Ukoliko iz nekog razloga nedostaje ID u linku, redirektuj na spisak kategorija 
			require_once('app/views/pages/categories.php');
		}
	}
	
	// Dodavanje ponude 
	public function insert() {
		
		if(isset($_POST['nazivp']))	{
			$target = "files/images/";
			$target2 = "files/prices/";
			$code = time();
			$filename = basename($_FILES['slika_url']['name']);	
			$target1 = $target . $code."-".$filename;	
			$target2 = $target2 . $code."-".$filename;	
			
			$typeS = $_FILES["slika_url"]["type"];
			$typeC = $_FILES["cene_pdf"]["type"];
			
			// Ako je tip fajla JPG dozvoli upload
			if($typeS == "image/jpeg"){
				if(move_uploaded_file($_FILES['slika_url']['tmp_name'], $target1)){
					$slika_url = $code."-".$filename;
				}
				else {
					$slika_url = "no.png";
				}
			}
			else {
					$slika_url = "no.png";
			}
			
			// Ako je tip fajla PDF dozvoli upload
			if($typeC == "application/pdf"){
				if(move_uploaded_file($_FILES['cene_pdf']['tmp_name'], $target2)){
					$cene_pdf = $code."-".$filename;
				}
				else {
					$cene_pdf = "no.png";
				}
			}
			else {
				$cene_pdf = "no.png";
			}
			
			
			$id_vr_p = filter_input(INPUT_POST, 'id_vr_p', FILTER_SANITIZE_NUMBER_INT);
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);			
			$nazivp = filter_input(INPUT_POST, 'nazivp', FILTER_SANITIZE_STRING);
			$opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);
			
			if(isset($_POST['aktuelno']) && $_POST['aktuelno']=="da")
				$aktuelno = "da";
			else
				$aktuelno = "ne";
			$offerAdd = Offers::insertOffer($nazivp, $opis, $slika_url, $cene_pdf, $id_vr_p, $aktuelno); 
		}
		$categories = Categories::showAllCategories();	
		$offers = Offers::showAllOffers();	
		
		// Ucitavanje pogleda
		require_once('app/views/admin/offers.php');	
	}	

	// Izmena ponude
	public function edit() {
		if(isset($_POST['nazivp']) && isset($_POST['id']))
		{
			$target = "files/images/";
			$target2 = "files/prices/";
			$code = time();
			$filename = basename($_FILES['slika_url']['name']);	
			$target1 = $target . $code."-".$filename;	
			$target2 = $target2 . $code."-".$filename;	
			if(move_uploaded_file($_FILES['slika_url']['tmp_name'], $target1)){
				$slika_url = $code."-".$filename;
			}
			else {
				$slika_url = "no.png";
			}
			
			if(move_uploaded_file($_FILES['cene_pdf']['tmp_name'], $target2)){
				$cene_pdf = $code."-".$filename;
			}
			else {
				$cene_pdf = "no.png";
			}
			
			$id_vr_p = filter_input(INPUT_POST, 'id_vr_p', FILTER_SANITIZE_NUMBER_INT);
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);			
			$nazivp = filter_input(INPUT_POST, 'nazivp', FILTER_SANITIZE_STRING);
			$opis = filter_input(INPUT_POST, 'opis', FILTER_SANITIZE_STRING);
			
			if(isset($_POST['aktuelno']) && $_POST['aktuelno']=="da")
				$aktuelno = "da";
			else
				$aktuelno = "ne";
			
			$offerEdit = Offers::editOffer($id, $nazivp, $opis, $slika_url, $cene_pdf, $id_vr_p, $aktuelno);	
		}
		$categories = Categories::showAllCategories();	
		$offers = Offers::showAllOffers();	
		require_once('app/views/admin/offers.php');	
	}
	
	// Brisanje kategorije 
	public function delete() {
		if(isset($_POST['id']))
		{
			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);			
			$offerDelete = Offers::deleteOffer($id);	
		}
		$categories = Categories::showAllCategories();	
		$offers = Offers::showAllOffers();	
		require_once('app/views/admin/offers.php');	
	}
}
?>