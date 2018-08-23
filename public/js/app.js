const IMG_PATH = "image_answer/";
var questions = [];
var win = false;
var pointer = 0;
var res = undefined;

var chrono = {
	secondsLeft: 0,
	timer: undefined,
	start: function (secondsLeft) {
		this.secondsLeft = secondsLeft;
		this.timer = setInterval(this.tick.bind(this), 1000);
	},
	tick: function () {
		document.getElementById("coutdown").innerHTML = --this.secondsLeft;
		if (this.secondsLeft === 0)
			this.stop()
	},

	stop: function () {
		clearInterval(this.timer);
		endQuestion(win);
	}
};

function shuffle(a) {
	for (let i = a.length - 1; i > 0; i--) {
		const j = Math.floor(Math.random() * (i + 1));
		[a[i], a[j]] = [a[j], a[i]];
	}
	return a;
}

function endQuestion(_result) {
	if (_result) {
		str = "Bonne réponse !";
	} else {
		str = "Oups, la bonne réponse était : " + res;
	}
	$('#question-app').empty();
	$('#question-app').append(str);
	pointer++;
	updateScore(_result);
	setTimeout(game, 3000);
}


function updateScore(_win) {
	$('#question-count').empty();
	$('#question-count').append(pointer);
	if (_win) {
		value = $('#question-good').text();
		$('#question-good').empty();
		$('#question-good').append(parseInt(value) + 1);
		score = $('#points').text();
		timeLeft = $('#coutdown').text();
		score = parseInt(score);
		timeLeft = parseInt(timeLeft);
		if (timeLeft >= 7) {
			scoreObtain = 100;
		} else {
			scoreObtain = timeLeft * 10;
		}
		$('#points').empty();
		$('#points').append(score + scoreObtain);
	} else {
		value = $('#question-wrong').text();
		$('#question-wrong').empty();
		$('#question-wrong').append(parseInt(value) + 1);
	}
}

function formatAnswer(_string) {
	_string = _string.replace(/\s/g, '');
	_string = _string.toLowerCase();
	return _string;
}

function getQuestions() {
	if ($('#tournament').val() == 1 || $('#tournament').val() == 2) {
		all = 0;
	} else {
		all = 1;
	}
	$.post(
		"index.php", {
			query: 1,
			request: "getQuestions",
			tournament: $('#tournament').val(),
			all: all,
			token: $("#token").val()
		},
		(_data) => {
			elements = $.parseJSON(_data);
			for (var i = 0; i < elements.length; i++) {
				questions.push(elements[i]);
			}
			shuffle(questions);
		}
	);
}

function setScore() {
	if ($("#tournament").val() == 'null') {
		return 0;
	}
	$.post(
		"index.php", {
			query: 1,
			request: "setScore",
			tournament: $('#tournament').val(),
			token: $('#token').val(),
			score: $('#points').text()
		},
		(_data) => {
		}
	)
}

function checkMatch(_str) {
	if (_str === res) {
		win = true;
		chrono.stop();
	}
}

function game() {
	clearInterval(t);
	win = false;
	$('#info-app').empty();
	if (pointer == questions.length) {
		endGame();
	} else {
		res = formatAnswer(displayQuestion(pointer));
		chrono.start(10);
	}
}

function endGame() {
	$('#question-app').empty();
	$('#image-container-app').empty();
	$('#coutdown').empty();
	$('#question-app').append("Fini, merci d'avoir participé.<br>");
	$('#question-app').append("Vous pouvez trouver vos stats sur le panneau à droite");
	$('#coutdown').append("<a href='index.php'>Retour au menu</a>");
	if ($('#tournament').val() == 1 || $('#tournament').val() == 2) {}
	setScore();
}

function displayQuestion(_index) {
	$('#question-app').empty();
	$('#image-container-app').empty();
	$('#question-app').append(questions[_index].question);
	if (questions[_index].slug !== null) {
		$('#image-container-app').append(
			'<img src="" class="img-fluid" id="img-app" style="max-height: 475px">'
		);
		$("#img-app").attr("src", IMG_PATH + questions[_index].slug);
	}
	return questions[_index].answer;
}

$('body').css({
	'background-color': '#e9ecef'
});

$(document).ready(() => {

	getQuestions();
	$('#start-app').on('click', () => {
		$('#start-app').attr("hidden", "true");
		t = setInterval(game, 2500);
		$('#info-app').append('Lancement...');
	});

	$('#form-app').submit((e) => {
		e.preventDefault();
		str = formatAnswer($('#input-app').val());
		checkMatch(str);
		$('#form-app')[0].reset();

	});
});