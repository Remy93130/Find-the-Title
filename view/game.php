<div class="row" id="app">
	<input id="token" value="<?= $token; ?>" hidden="hidden">
	<input id="tournament" value="<?= $tournament; ?>" hidden="hidden">
	<div class="col-lg-10 col-sm-10">
		<br><h3 class="text-center" id="question-app">Question</h3>
		<h5 class="text-center" id="coutdown">10</h5>
		<p class="text-center" id="image-container-app">
			<img src="https://d32xvgr96w2oxp.cloudfront.net/2016/02/connaitre-caractere-chaton-02-2016.jpg" class="img-fluid" id="img-app" style="max-height: 475px">
		</p>
		<form id="form-app">
			<div class="form-group text-center">
				<input class="form-control" name="result" id="input-app">
			</div>
		</form>
	</div>
	<div class="col-lg-2 col-sm-2">
		<br><h4 class="text-center">Informations</h4>
		<ul id="stat-app">
			<li>
				Question : <span id="question-count">0</span>
			</li>
			<li>
				Bonne réponse : <span id="question-good">0</span>
			</li>
			<li>
				Mauvaise réponse : <span id="question-wrong">0</span>
			</li>
			<li>
				Point : <span id="points">0</span>
			</li>
		</ul><br>
		<p class="text-center">
			<button class="btn btn-primary" id="start-app">Commencer</button><br>
			<span id="info-app"></span>
		</p>
	</div>
</div>