# worldtravelmvc
WorldTravel MVC Student Project

Kako je rađen projekat WorldTravel MVC.

WorldTravel je rađen od nule, a koristio sam neki primer koji sam našao na internetu i koji mi je razumljiv. Evo ukratko kako je aplikacija rađena:
1.	U početnom, takozvanom index.php fajlu je postavljena provera da li se u linku preko GET-a mogu dobiti podaci o tome koji kontroler se poziva i koja akcija. Dakle, aplikacija očekuje da link bude u sledećem formatu:  /index.php?controller=controllerName&action=actionName

Ukoliko ne postoje parametri za controller i action uzimaju se podrazumevani kontroler pages i podrazumevana akcija home.

Nakon provere da li postoje parametri za kontroler i akciju poziva se fajl layout.php koji sadrži kompletan HTML code sajta. 

2.	Fajl layout.php se sadrži od header dela gde je smešten logo i glavni meni sajta, središnjeg dela u kojem se nalazi poziv fajla (include) routes.php, i futera sajta. Korišćen je Bootstrap radi postizanja responzivnog dizajna. 
3.	Svo rutiranje je postavljeno u fajlu routes.php. Ovde je postavljen niz svih mogućih slučajeva za parametar controller i za parametar action. 
4.	Kao što se vidi na predhodnoj slici, ukoliko se preko GETa „zatraži“ kombinacija parametara koji nisu na spisku, biće „pozvan“ kontroler pages i akcja error koji samo otvaraju pogled (View) views/pages/error.php, tj stranicu o grešci.
5.	Funckija call() zapravo radi rutiranje, tj određuje koji kontroler će biti „pozvan“ (zato sam i nazvao funkciju call) i koja njegova akcija.
6.	Uzmimo na primer da je korisnik „zahtevao“: index.php?controller=categories&action=manage
Odvija se seledeće:
-	U fajlu routes.php se proverava da li je ta kombinacija dozvoljena, ako jeste poziva se funkcija call()
-	Funkcija učitava fajl app/controllers/categories_controller.php
-	Učitavaju se modeli app/models/categories.model.php i app/models/offers.model.php
-	U kontroleru categories_controller.php se poziva metoda manage
-	Učitavaju se sve kategorije iz baze i prikazuje se pogled app/views/admin/categories.php
Na ovaj način je postignuta MVC struktura, a to je da se svi upiti nad bazom podataka odvijaju u Modelima, svi interakcije između korisnika i baze se odvijaju u Kontrolerima, a sav HTML code se nalazi u Pogledima. 
 
Mere zaštite i validacija

Aplikacija validira korisnikov unos na više načina:
1.	Postavljanjem reqired atributa na obavezna polja u formularima
2.	Javascript validacija, odnosno ispisivanje poruke korisniku kroz javascript alert da nije popunio neko obavezno polje
3.	Provera na backend strani, da li je određeno polje popunjeno, i nedozvoljavanje kontrolera da se „siđe“ do modela ako nije popunjeno.
4.	PHP sanitize – Čišćenje korisničkog inputa kako bi podaci do Modela stigli u odgovarajućem obilku, npr:  $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);		
5.	Provera da li je uploadovan fajl određenog tipa podatka, recimo za slike je dozvoljeno samo JPG format, dok je za dokumenta dozvoljen isključivo PDF format.
6.	U modelu, upiti nad bazom se vrše pomoću PDO biblioteke, i to kao pripreljen upit (prepared statement). To znači da baza najpre dobije pripremljen upit, a kasnije određene parametre upita. Plus se ti parametri dodatno validiraju, kao npr:
$req = $db->prepare("DELETE FROM vrste_ponuda WHERE id = ?");		
$req ->bindValue(1, $id, PDO::PARAM_INT); // Očekuje se isključivo ceo broj!
7.	Lozinke se u tabeli baze podataka čuvaju u hešovanom formatu. Lozinke se zatim proveravaju password_verify() funkcijom.
