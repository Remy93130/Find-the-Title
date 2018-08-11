<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Participer à un tounoi</h1>
		<p class="lead">Attention vous ne pouvez faire participer qu'une fois par jour !</p>
	</div>
</div>

<div class="row">
	<div class="col-sm-4 offset-sm-1">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Tournoi général</h5>
				<p class="card-text">Dix questions sur différents thèmes.</p>
				<a href="index.php?action=game&tournament=1" class="btn btn-primary">Participer</a>
				<a style="color: white" data-toggle="modal" data-target="#leaderboadGeneral" class="btn btn-secondary float-right">
					Classement
				</a>
			</div>
		</div>
	</div>
	<div class="col-sm-4 offset-sm-1">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Tournoi thématique</h5>
				<p class="card-text">Dix questions portant sur le même thème.</p>
				<a href="index.php?action=game&tournament=2" class="btn btn-primary">Participer</a>
				<a style="color: white" data-toggle="modal" data-target="#leaderboadTheme" class="btn btn-secondary float-right">
					Classement
				</a>
			</div>
		</div>
	</div>
</div>

<div class="jumbotron jumbotron-fluid" style="margin-top: 5%">
	<div class="container">
		<h1 class="display-4">Déjà fait les tounois ?</h1>
		<p class="lead">Vous pouvez jouer en mode solo.</p>
	</div>
</div>
<div class="row">
	<div class="col-sm-4 offset-sm-1">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Mode solo</h5>
				<p class="card-text">Mode de jeu sans fin avec tout les thèmes</p>
				<a href="index.php?action=game&tournament=null" class="btn btn-primary">Jouer</a>
			</div>
		</div>
	</div>
	<div class="col-sm-4 offset-sm-1">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Mode solo à Thème (a venir)</h5>
				<p class="card-text">Mode de jeu sans fin avec les thème selectionnés</p>
				<a href="" class="btn btn-primary disabled" disabled='disabled'>Jouer</a>
			</div>
		</div>
	</div>
</div>

<div class="jumbotron jumbotron-fluid" style="margin-top: 5%">
	<div class="container">
		<h1 class="display-4">Gestion du compte</h1>
		<p class="lead">Section pour gerer votre compte.</p>
	</div>
</div><br>
<div class="row">
	<div class="col-sm-8 offset-sm-2">
		<h2 class="text-center">Modification de vos donnéees personnelles</h2><br>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a href="#email" class="nav-link active" data-toggle="tab">Adresse Email</a>
			</li>
			<li class="nav-item">
				<a href="#password" class="nav-link" data-toggle="tab">Mot de passe</a>
			</li>
			<li class="nav-item">
				<a href="#delete" class="nav-link" data-toggle="tab">Supprimer le compte</a>
			</li>
		</ul>
	</div>
</div>

<!-- Tab panes -->

<div class="tab-content" style="margin-bottom: 20vh">
	<div id="email" class="col-sm-8 offset-sm-2 tab-pane active"><br>
		<h4>Changement d'adresse Email</h4><br>
		<form class="form-inline" action="index.php?action=updateEmail" method="post">
			<label for="email">Adresse Email : &nbsp </label>
			<input type="email" value="<?= $_SESSION['email'] ?>" class="form-control" id="email" name="email" style="margin-right: 1rem"><br>
			<input type="text" name="token" value="<?= $token ?>" hidden='hidden'>
			<button type="submit" class="btn btn-primary">Modifier</button>
		</form>
	</div>
	<div id="password" class="col-sm-8 offset-sm-2 tab-pane fade"><br>
		<h4>Changement de mot de passe</h4><br>
		<form action="index.php?action=updatePassword" method="post">
			<div class="form-group">
				<label for="old-password">Ancien mot de passe :</label>
				<input type="password" class="form-control" id="old-password"name="old-password">
			</div>
			<div class="form-group">
				<label for="password">Nouveau mot de passe :</label>
				<input type="password" class="form-control" id="password" name="password">
				<input type="text" name="token" value="<?= $token ?>" hidden='hidden'>
			</div>
			<button type="submit" class="btn btn-primary">Modifier</button>
		</form>
	</div>
	<div id="delete" class="col-sm-8 offset-sm-2 tab-pane fade"><br>
		<h4>Suppression de votre compte</h4><br>
		<b>Attention ! </b> Si vous faite cela, vous ne pourrez plus revenir en arrière.<br><br>
		<form action="index.php?action=deleteAccount" method="post">
			<div class="form-group">
				<label for="password">Mot de passe :</label>
				<input type="password" class="form-control" id="password" name="password">
				<input type="text" name="token" value="<?= $token ?>" hidden='hidden'>
			</div>
			<button type="submit" class="btn btn-danger">Supprimer</button>
		</form>
	</div>
</div>


<!-- Modal Leaderboard -->

<div class="modal fade" id="leaderboadTheme" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					Classement du tournoi thématique
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Place</th>
							<th scope="col">Nom</th>
							<th scope="col">Points</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach ($tournamentsData['Thematique'][0] as $data):
							echo "<tr>";
							echo "<th scope='row'>$i</th>";
							echo "<td>$data->username</td>";
							echo "<td>$data->points</td>";
							echo "<tr>";
							$i++;
						endforeach;
						?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="leaderboadGeneral" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">
					Classement du tournoi général
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">Place</th>
							<th scope="col">Nom</th>
							<th scope="col">Points</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach ($tournamentsData['General'][0] as $data):
							echo "<tr>";
							echo "<th scope='row'>$i</th>";
							echo "<td>$data->username</td>";
							echo "<td>$data->points</td>";
							echo "<tr>";
							$i++;
						endforeach;
						?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>