<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="utf-8">
    <title>WorldTravel</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="files/css/bootstrap.css" rel="stylesheet">
	<link href="files/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		 <div class="row">
            <div class="col-md-2 col-sm-4 col-xs-6">
				<a href="index.php"><img src="files/images/logo.png" class="logo" alt="logo"></a>
			</div>
			<div class="col-md-10 col-sm-8 col-xs-6 alignRight top30">
				<?php
				if(isset($_SESSION['logedIn']) && $_SESSION['logedIn']==1)	{ ?>
				<a href="?controller=offers&action=manage" class="largeLogin black"><i class="fa fa-user largeLogin"></i> Zdravo Admin</a>	
				<?php } else { ?>
				<a href="" data-toggle="modal" data-target="#login" class="largeLogin black"><i class="fa fa-lock largeLogin"></i> Prijava</a>
				<div id="login" class="modal fade" role="dialog">
					<div class="modal-dialog">    
						<div class="modal-content">
							<form action="?controller=login&action=check" method="post">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title alignLeft">Prijava administratora</h4>
								</div>
								<div class="modal-body">							
									<input type="text" name="username" class="form-control" placeholder="Korisničko ime">
									<br/><input type="password" name="password" class="form-control" placeholder="Lozinka">							
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-warning">Prijava</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>			
		</div>
	</div>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#open-menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>                
            </div>
            <div class="collapse navbar-collapse" id="open-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-home"></i> Početna</a>
                    </li>
                    <li >
                        <a href="index.php?controller=categories&action=index">Kategorije</a>
					</li>       
					<li >
                        <a href="index.php?controller=pages&action=about">O nama</a>
					</li>    
					<li >
                        <a href="index.php?controller=pages&action=terms">Uslovi putovanja</a>
					</li>   
                </ul>
            </div>           
        </div>        
    </nav>   
    <div class="container">       
		<?php require_once('app/routes.php'); ?>		
    </div>
	<footer>
		<div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h3 style="color:#fff">WorldTravel</h3>
					<p>Turistička agencija World Travel osnovana je 1983. godine u Beogradu - danas je jedan od vodećih turoperatora u Srbiji. Bavimo se organizacijom aranžmana u zemlji i inostranstvu, prodajom avio karata, kao i minibus prevozom putnika.	</p>
                </div>
				<div class="col-md-3">
					<h3 style="color:#fff">Navigacija</h3>
					<ul >
						<li>
							<a href="index.php">Početna</a>
						</li>
						<li >
							<a href="index.php?controller=categories&action=index">Kategorije</a>
						</li>       
						<li >
							<a href="index.php?controller=pages&action=about">O nama</a>
						</li>    
						<li >
							<a href="index.php?controller=pages&action=terms">Uslovi putovanja</a>
						</li>   
					</ul>
                </div>
				<div class="col-md-4">
					<h3 style="color:#fff">Kontakt</h3>
					<p> 011/222-555<br/>
					063/262-565<br/>
					info@world.com<br/>
					Danijelova 32, Beograd</p>
                </div>
				<div class="col-md-12 text-center">	
					<hr/>
                    <p>Copyright &copy; 2019 WorldTravel <br/>Kreirao Miroslav  Zdravković</p>
                </div>
            </div>
		</div>
    </footer>
	<script src="files/js/jquery.js"></script>
    <script src="files/js/bootstrap.min.js"></script>	
	<script>
	$(".validate").click(function()
	{
		if($(".jsreq").val() == "")
			alert("Morate popuniti naziv");
	});
	
	$(".validateEdit").click(function()
	{
		if($(".jsreqEdit").val() == "")
			alert("Morate popuniti naziv");
	});
	</script>
</body>
</html>