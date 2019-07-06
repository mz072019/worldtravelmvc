<div class="row">
	
	<div class="col-md-8 ">	
		<h1><?php 	foreach($offers as $offer) echo $offer->nazivp; ?></h1><hr/>
		<?php 
		foreach($offers as $offer) 	
			echo $offer->opis;
		?>
		</div>
	<div class="col-md-4">
		<?php foreach($offers as $offer) ?>		
		<img src="files/images/<?php echo $offer->slika_url; ?>" class="fullWidth" alt="<?php echo $offer->nazivp; ?>">
		<br/><br/><a target="_blank" href="files/prices/<?php echo $offer->cene_pdf; ?>" class="btn btn-default" style="width:100%"><i class="fa fa-euro"></i> Cenovnik</a>
	</div>
</div>