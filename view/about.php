<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">A propos</h1>
		<p class="lead">Pour tout savoir sur le site</a></p>		
	</div>
</div>
<div class="row" style="margin-bottom: 3%">
	<div class="col-lg-6 offset-lg-3">
		<h2 class="text-center">A propos de Find the Title :</h2><br>
		<p class="text-justify">
			Find the Title vous permet de jouer à un jeu de question-réponse sur internet
			en mode solo. <br>
			Vous avez la possibilité de jouer en mode tournoi une fois par jour avec un 
			classement à la fin de la partie ou alors sans enregistrement de score 
			et de participation. <br>
			Le jeu a été programmé en Javascript, pour qu'il fonctionne correctement il faut
			que votre navigateur ne bloque pas celui-ci.
		</p><br>
		<h3>Technologies utilisées :</h3><br>
		<p>Ce site internet a été conçu avec les technologies suivantes :</p>
		<ul>
			<li>HTML/CSS/Bootstrap 4</li>
			<li>Javascript et JQuery</li>
			<li>PHP et MySQL</li>
		</ul>
		<p>
			Vous pouvez retrouver le code source du site <a href="">sur GitHub.</a>
		</p><br>
		<h3>L'auteur :</h3><br>
		<p class="text-justify">
			Le site a été conçu par <a href="">Barberet Rémy</a> vous pouvez me contacter 
			par <a href="mailto:remy93130@gmail.com">mail</a> ou utiliser le formulaire de contact ci-dessous. 
		</p><br>
		<h3>Contact :</h3><br>
		<form action="index.php?action=sendMessage" method="post">
			<div class="form-group">
				<label for="name">Votre nom :</label>
				<input type="text" class="form-control" id="name" name="name">
			</div>
			<div class="form-group">
				<label for="mail">Votre adresse mail :</label>
				<input type="email" class="form-control" id="mail" name="email">
				<small class="form-text text-muted">Afin de vous recontacter.</small>
			</div>
			<div class="form-group">
				<label for="message">Votre message :</label>
				<textarea class="form-control" name="message" id="message" rows="3"></textarea>
				<input type="text" name="token" value="<?= $token; ?>" hidden="hidden">
			</div>
			<button type="submit" class="btn btn-primary">Envoyez</button>
		</form>
	</div>
</div>

<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Changelog</h1>
		<p class="lead">Car on est jamais à l'abri d'un bug</a></p>		
	</div>
</div>
<div class="row" style="margin-bottom: 5%">
	<div class="col-lg-6 offset-lg-3">
		<ul class="list-group text-center">
			<li class="list-group-item">12/08/2018 - Mise en ligne de la beta</li>
		</ul>
	</div>
</div>