<div class="row" id="app" style="background-color: lightgrey">
	<div class="col-lg-10 col-sm-10">
		<h3 class="text-center" id="question-app">Question</h3>
		<p class="text-center">
			<img src="https://d32xvgr96w2oxp.cloudfront.net/2016/02/connaitre-caractere-chaton-02-2016.jpg" class="img-fluid" id="img-app">
		</p>
		<form action="index.php?action=game" method="" id="form-app">
			<div class="form-group text-center">
				<input class="form-control" name="result" id="input-app" placeholder="Votre réponse">
			</div>
		</form>
	</div>
	<div class="col-lg-2 col-sm-2">
		<h4 class="text-center">Informations</h4>
		<ul id="stat-app">
			<li>
				Question : <span id="question-count"></span>
			</li>
			<li>
				Bonne réponse : <span id="question-good"></span>
			</li>
			<li>
				Mauvaise réponse : <span id="question-wrong"></span>
			</li>
			<li>
				Point : <span id="points"></span>
			</li>
		</ul>
	</div>
</div>