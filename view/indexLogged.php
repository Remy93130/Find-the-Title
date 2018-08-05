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
				<a href="#" class="btn btn-primary">Participer</a>
				<a style="color: white" data-toggle="modal" data-target="#leaderboadGeneral" class="btn btn-primary float-right">
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
				<a href="#" class="btn btn-primary">Participer</a>
				<a style="color: white" data-toggle="modal" data-target="#leaderboadTheme" class="btn btn-primary float-right">
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
	<div class="col-sm-4 offset-sm-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Mode solo</h5>
				<p class="card-text">Mode de jeu sans fin avec tout les thèmes</p>
				<a href="#" class="btn btn-primary">Jouer</a>
			</div>
		</div>
	</div>	
</div><br><br>

<!-- Modal Leaderboard -->

<div class="modal fade" id="leaderboadTheme" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">
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
				<h5 class="modal-title" id="exampleModalLongTitle">
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