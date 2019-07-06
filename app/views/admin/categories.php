<div class="row">
	<div class="col-md-3">                
		<div class="list-group">
			<a href="?controller=offers&action=manage" class="list-group-item">Upravljanje ponudama</a>
			<a href="?controller=categories&action=manage" class="list-group-item active">Upravljanje kategorijama</a>
			<a href="?controller=login&action=logout" class="list-group-item">Odjava</a>
		</div>
	</div>
	<div class="col-md-9 paddingRight0">	
		<h2>Kategorije <button class="btn btn-success" style="float:right;margin-right:15px" data-toggle="modal" data-target="#addCategory"><i class="fa fa-plus"></i></button></h2>
		<div id="addCategory" class="modal fade" role="dialog">
			<div class="modal-dialog">    
				<div class="modal-content">
					<form action="?controller=categories&action=insert" method="post"  enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title alignLeft">Dodavanje kategorije</h4>
						</div>
						<div class="modal-body">							
							<input type="text" name="naziv" class="form-control jsreq" placeholder="Naziv kategorije" required="required">
							
							<label>Slika</label>
							<input type="file"  name="file">
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
		
		<?php if(isset($categoryAdd) && $categoryAdd==1){?>
		<div class="alert alert-success">
			Kategorija je dodata!
		</div><br/>
		<?php } ?>
		<?php if(isset($categoryEdit) && $categoryEdit==1){?>
		<div class="alert alert-success">
			Kategorija je izmenjena!
		</div><br/>
		<?php } ?>
		<?php if(isset($categoryDelete) && $categoryDelete==1){?>
		<div class="alert alert-success">
			Kategorija je obrisana!
		</div><br/>
		<?php } ?>
		<table class="table-striped">
			<?php 
			foreach($categories as $category) { 
			?>
			<tr>
				<td class="padding8"><?php echo $category->naziv; ?></td>
				<td class="padding8 text-right">
					<button class="btn btn-info" data-toggle="modal" data-target="#editCategory<?php echo $category->id; ?>"><i class="fa fa-pencil"></i></button>
					<div id="editCategory<?php echo $category->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">    
							<div class="modal-content">
								<form action="?controller=categories&action=edit" method="post"   enctype="multipart/form-data">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title alignLeft">Izmena kategorije</h4>
									</div>
									<div class="modal-body">							
										<input type="text" name="naziv" class="form-control jsreqEdit" placeholder="Naziv kategorije" value="<?php echo $category->naziv; ?>" required="required">
										<label>Slika</label>
										<input type="file"  name="file">
										<br/>
										
										<input type="hidden" value="<?php echo $category->id; ?>" name="id" required>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-info validateEdit">Izmeni</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<button class="btn btn-danger" data-toggle="modal" data-target="#deleteCategory<?php echo $category->id; ?>"><i class="fa fa-trash"></i></button>
					<div id="deleteCategory<?php echo $category->id; ?>" class="modal fade" role="dialog">
						<div class="modal-dialog">    
							<div class="modal-content">
								<form action="?controller=categories&action=delete" method="post">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title alignLeft">Brisanje kategorije</h4>
									</div>
									<div class="modal-body">							
										<b class="alignLeft">Da li ste sigurni? &nbsp;</b><div style="clear:both"></div>
										
										<input type="hidden" value="<?php echo $category->id; ?>" name="id">
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
		<br/><br/><br/><br/><br/><br/><br/><br/>
	</div>
</div>  