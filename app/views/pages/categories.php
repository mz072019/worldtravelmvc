<div class="row">
	<div class="col-md-3">                
		<div class="list-group">			
		<?php 
		$c = 1;
		foreach($categories as $category) { 
		?>
			<a href="?controller=categories&action=index&id=<?php echo $category->id; ?>" class="list-group-item <?php if($category->id==$_GET['id']) echo 'active'; if($c==1 && $_GET['id']=="") echo 'active';?>  "><?php echo $category->naziv; ?></a>
		<?php 
		$c++;
		} 
		?>
		</div>
	</div>
	<div class="col-md-9 text-center paddingRight0">	
		<?php 
		foreach($offers as $offer) { 
		?>
		<div class="col-md-4 col-sm-6">
			<div class="thumbnail">
				<a href="?controller=offers&action=show&id=<?php echo $offer->id; ?>"><img src="files/images/<?php echo $offer->slika_url; ?>" alt="<?php echo $recipe->title; ?>"></a>
				<div class="caption">
					<h3><?php echo $offer->nazivp; ?></h3>
					<a href="?controller=offers&action=show&id=<?php echo $offer->id; ?>" class="btn btn-default">Detaljnije</a>    
				</div>
			</div>
		</div>	
		<?php
		}
		?>
	</div>
</div>