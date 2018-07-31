<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Pour commencer à jouer connectez-vous</h1>
		<p class="lead">Pas encore de compte ? <a href="action.php.action=register">Cliquer ici pour en créer un.</a></p>
	</div>
</div>
<div class="col-lg-6 offset-lg-3">
	<form action="index.php?action=login" method="post">
		<div class="form-group">
			<label for="username">Nom de compte :</label>
			<input type="text" name="username" class="form-control">
		</div>
		<div class="form-group">
			<label for="pwd">Mot de passe :</label>
			<input type="password" name="password" class="form-control">
			<small>Si vous oubliez votre mot de passe, utiliser <a href="index.php?action=about">le formulaire de contact.</a></small>
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
		<ul>
			<li>
				<p class="lead">Un tournoi génerique avec {{ X }} questions sur différents thèmes.</p>
			</li>
			<li>
				<p class="lead">Un tournoi avec {{ X }} questions sur un thème spécifique.</p>
			</li>
		</ul><br>
		Alors qu'attendez-vous ? <a href="action.php.action=register">Créer un compte.</a>
	</p>
</div>