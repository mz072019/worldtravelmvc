<div class="row">
	<div class="col-md-12">
		<h3>Izdvojene ponude</h3>
	</div>
</div>
<div class="row text-center">
	<?php foreach($offers as $offer) {?>
		<div class="col-md-3 col-sm-6">
			<div class="thumbnail">
				<a href="?controller=offers&action=show&id=<?php echo $offer->id; ?>"><img alt="<?php echo $offer->nazivp; ?>" src="files/images/<?php echo $offer->slika_url; ?>"></a>
				<div class="caption">
					<h3><?php echo $offer->nazivp; ?></h3>
					<a href="?controller=offers&action=show&id=<?php echo $offer->id; ?>" class="btn btn-default">Detaljnije</a>    
				</div>
			</div>
		</div>
	<?php } ?>
</div>