<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Ajouter une question</h1>
		<p class="lead">
			Participer au développement du jeu en envoyant vos propres questions !<br>
			Pour ajouter une catégorie, <a href="#">faite une demande dans le formulaire de contact.</a>
		</p>		
	</div>
</div>
<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<h2 class="text-center">Ajouter une question</h2><br>
		<form action="index.php?action=insertQuestion" method="post" enctype="multipart/form-data" style="margin-bottom: 5%">
			<div class="form-group">
				<label for="question">Question :</label>
				<input type="text" class="form-control" id="question" name="question">
			</div>
			<div class="form-group">
				<label for="answer">Réponse :</label>
				<input type="text" class="form-control" id="answer" name="answer">
				<small class="form-text text-muted">Si nom original trop compliqué, le mettre en anglais.</small>
			</div>
			<div class="form-group">
				<label for="category">Catégorie :</label>
				<select class="form-control" name="category">
					<?php foreach ($categories as $category): ?>
					<option value="<?= $category->id; ?>"><?= $category->name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" class="form-control-file" id="image" name="image">
				<small class="form-text text-muted">Facultatif et 64Mo maximum</small>
				<input type="text" name="token" value="<?= $token ?>" hidden="hidden">
			</div>
			<button type="submit" class="btn btn-primary" style="margin-top: 1%">Soumettre</button>
		</form>
	</div>
</div>