<!DOCTYPE html>
<html>
<head>
	<title>Find the Title - <?= $title ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel="manifest" href="asset/manifest.json">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta charset="utf-8">
</head>
<body>
	<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.php">
			<img src="images/logo.png" width="90" height="55" class="d-inline-block align-top" alt="">
			<!-- Find the title -->
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link hvr-underline-from-center" href="index.php">Accueil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link hvr-underline-from-center" href="index.php?action=addQuestion">Ajouter des questions</a>
				</li>
				<li class="nav-item">
					<a class="nav-link hvr-underline-from-center" href="index.php?action=howToPlay">Comment jouer</a>
				</li>
			</ul>
			<ul class="navbar-nav mr-right">
				<li class="nav-item">
					<a class="nav-link hvr-underline-from-center" href="index.php?action=about">A propos</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="container-fluid" style="padding-top: 70px; ">
		<?php include 'asset/flashBag.php'; ?>
		<?= $content ?>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<?php
	if (isset($scripts)):
		foreach ($scripts as $script):
			echo "<script src=\"js/$script.js\"></script>\n\t";
		endforeach;
	endif; 
	?>

</body>
<script type="text/javascript">
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();   
	});
</script>
</html>