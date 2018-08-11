<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Pour commencer à jouer connectez-vous</h1>
		<p class="lead">Pas encore de compte ? <a href="index.php?action=register">Cliquer ici pour en créer un.</a></p>		
	</div>
</div>
<div class="col-lg-6 offset-lg-3">
	<form action="index.php?action=login" method="post">
		<div class="form-group">
			<!-- <label for="username">Nom de compte :</label> -->
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<i class="fas fa-user"></i>
					</div>
				</div>
				<input type="text" name="username" class="form-control" placeholder="Nom de comte">
			</div>
		</div><br>
		<div class="form-group">
			<!-- <label for="pwd">Mot de passe :</label> -->
			<div class="input-group mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text">
						<i class="fas fa-lock"></i>
					</div>
				</div>
				<input type="password" name="password" class="form-control" placeholder="Mot de passe">
				<input type="text" name="token" value="<?= $token; ?>" hidden="hidden">
			</div>
			<small class="form-text text-muted">
				<a href="#" data-toggle="tooltip" data-placement="bottom" title="Utilisez le formulaire de contact">Mot de passe oublié ?</a>
			</small>
		</div>
		<button type="submit" class="btn btn-primary">Connexion</button>
	</form><br>
</div>
<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Le principe du jeu</h1>

	</div>
</div>
<div class="col-lg-6 offset-lg-3">
	<p class="lead text-justify">
		Une question sur un thème précis avec éventuellement une image.<br>
		Votre objectif ? Répondre le plus rapidement à celle-ci.<br>
		Chaque jour deux nouveaux tournois à accomplir :<br>
	</p>
	<ul>
		<li>
			<p class="lead">Un tournoi génerique avec 10 questions sur différents thèmes.</p>
		</li>
		<li>
			<p class="lead">Un tournoi avec 10 questions sur un thème spécifique.</p>
		</li>
	</ul><br>
	<p class="lead text-justify">
		Vous avez également la possibilité de jouer sans que votre score soit enregistré.<br>
		Vous pouvez même soumettre vos propres questions !<br>
		Alors qu'attendez-vous ? <a href="index.php?action=register">Créer un compte.</a><br><br>
	</p>
</div>
