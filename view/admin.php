<div class="jumbotron jumbotron-fluid" style="margin-top: 1%">
	<div class="container">
		<h1 class="display-4">Administration</h1>
	</div>
</div>
<div class="row">
	<div class="col-lg-10 offset-lg-1">
		<h3 class="text-center">Gestions des messages</h3><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Nom</th>
					<th scope="col">Email</th>
					<th scope="col">Message</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($messages as $message): ?>
					<tr>
						<th scope="row"><?= htmlspecialchars($message->name); ?></th>
						<td><?= htmlspecialchars($message->email); ?></td>
						<td><?= htmlspecialchars($message->message); ?></td>
						<td>
							<a href="<?= $message->getDelete().$token; ?>" class="btn btn-danger">Supprimer</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-lg-8 offset-lg-2">
		<h3 class="text-center">Gestions des membres</h3><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Usernames</th>
					<th scope="col">Email</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($users as $user): ?>
					<tr>
						<th scope="row"><?= $user->id; ?></th>
						<td><?= htmlspecialchars($user->username); ?></td>
						<td><?= htmlspecialchars($user->email); ?></td>
						<td>
							<a href="<?= $user->getDelete().$token; ?>" class="btn btn-danger">Supprimer</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="row" style="margin-bottom: 5%">
	<div class="col-lg-10 offset-lg-1">
		<h3 class="text-center">Gestions des questions</h3><br>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">Question</th>
					<th scope="col">Reponse</th>
					<th scope="col">Image</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($questions as $question): ?>
					<tr>
						<th scope="row"><?= htmlspecialchars($question->question); ?></th>
						<td><?= htmlspecialchars($question->answer); ?></td>
						<td><?= $question->slug; ?></td>
						<td>
							<a href="<?= $question->getDelete().$token; ?>" class="btn btn-danger">Supprimer</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
