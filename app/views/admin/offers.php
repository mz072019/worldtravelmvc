<div class="row">
	<div class="col-md-3">                
		<div class="list-group">
			<a href="?controller=offers&action=manage" class="list-group-item active">Upravljanje ponudama</a>
			<a href="?controller=categories&action=manage" class="list-group-item ">Upravljanje kategorijama</a>
			<a href="?controller=login&action=logout" class="list-group-item">Odjava</a>
		</div>
	</div>
	<div class="col-md-9 paddingRight0">	
		<h2>Ponude <button class="btn btn-success" style="float:right;margin-right:15px" data-toggle="modal" data-target="#addOffer"><i class="fa fa-plus"></i></button></h2>
		<div id="addOffer" class="modal fade" role="dialog">
			<div class="modal-dialog">    
				<div class="modal-content">
					<form action="?controller=offers&action=insert" method="post"  enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title alignLeft">Dodavanje ponude</h4>
						</div>
						<div class="modal-body">							
							<label>Naziv ponude</label>
							<input type="text" name="nazivp" class="form-control jsreq" required="required">
							
							<label>Kategorija</label>
							<select name="id_vr_p" class="form-control">
								<?php foreach($categories as $category) { ?>
								<option value="<?php echo $category->id; ?>"><?php echo $category->naziv; ?></option>
								<?php } ?>
							</select>
							
							
							
							<div class="row">
								<div class="col-md-6">
									<label>Slika</label>
									<input type="file"  name="slika_url">
								</div>
								<div class="col-md-6">
									<label>Cenovnik</label>
									<input type="file"  name="cene_pdf">
									<br/>
								</div>
							</div>
							
							<label>Opis</label>
							<textarea  name="opis" class="form-control" ></textarea>
							
							<label>Aktuelno</label>
							<input type="checkbox"  name="aktuelno" value="da">
							<br/>
							
							
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success validate">Dodaj</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<hr/>
		
		<?php if(isset($offerAdd) && $offerAdd==1){?>
		<div class="alert alert-success">
			Ponuda je dodata!
		</div><br/>
		<?php } ?>
		<?php if(isset($offerEdit) && $offerEdit==1){?>
		<div class="alert alert-success">
			Ponuda je izmenjena!
		</div><br/>
		<?php } ?>
		<?php if(isset($offerDelete) && $offerDelete==1){?>
		<div class="alert alert-success">
			Ponuda je obrisana!
		</div><br/>
		<?php } ?>
		<table class="table-striped">
			<?php 
			foreach($offers as $offer) { 
			?>
			<tr>
				<td class="padding8"><?php echo $offer->nazivp; ?></td>
				<td class="padding8 text-right">
					<button class="btn btn-info" data-toggle="modal" data-target="#editOffer<?php echo $offer->id; ?>"><i class="fa fa-pencil"></i></button>
					<div id="editOffer<?php echo $offer->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">    
							<div class="modal-content">
								<form action="?controller=offers&action=edit" method="post"   enctype="multipart/form-data">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title alignLeft">Izmena ponude</h4>
									</div>
									<div class="modal-body alignLeft">							
										
									<label>Naziv ponude</label>
									<input type="text" name="nazivp" class="form-control jsreqEdit" value="<?php echo $offer->nazivp;?>" required="required">
									
									<label>Kategorija</label>
									<select name="id_vr_p" class="form-control">
										<?php foreach($categories as $category) { ?>
										<option <?php if($offer->id_vr_p == $category->id) echo ' selected="selected"';?> value="<?php echo $category->id; ?>"><?php echo $category->naziv; ?></option>
										<?php } ?>
									</select>
									
									<div class="row">
										<div class="col-md-6">
											<label>Slika</label>
											<input type="file"  name="slika_url">
										</div>
										<div class="col-md-6">
											<label>Cenovnik</label>
											<input type="file"  name="cene_pdf">
											<br/>
										</div>
									</div>
									
									<label>Opis</label>
									<textarea  name="opis" class="form-control" ><?php echo $offer->opis;?></textarea>
									
									<label>Aktuelno</label>
									<input type="checkbox"  name="aktuelno" value="da" <?php if($offer->aktuelno == 'da') echo ' checked="checked"';?> >
									<br/>
									
									<input type="hidden" value="<?php echo $offer->id; ?>" name="id">
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-info validateEdit">Izmeni</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<button class="btn btn-danger" data-toggle="modal" data-target="#deleteOffer<?php echo $offer->id; ?>"><i class="fa fa-trash"></i></button>
					<div id="deleteOffer<?php echo $offer->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">    
							<div class="modal-content">
								<form action="?controller=offers&action=delete" method="post">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title alignLeft">Brisanje ponude</h4>
									</div>
									<div class="modal-body">							
										<b class="alignLeft">Da li ste sigurni? &nbsp;</b><div style="clear:both"></div>
										
										<input type="hidden" value="<?php echo $offer->id; ?>" name="id">
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-danger">Obriši</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<?php } ?>					
		</table>
		<br/><br/>
	</div>
</div>  