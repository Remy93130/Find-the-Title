const IMG_PATH = "public/image_answer/";

var chrono = {
	secondsLeft: 0,
	timer: undefined,
	start: function(secondsLeft) {
		this.secondsLeft = secondsLeft;
		this.timer = setInterval(this.tick.bind(this), 1000);
	},
	tick: function() {
		document.getElementById("timeleft").innerHTML = --this.secondsLeft;
		if(this.secondsLeft === 0)
			this.stop()
		},

	stop: function() {
		clearInterval(this.timer);
		document.getElementById('result').innerHTML= "FINI";
	}
};

function updateItem() {
	$("#img-app").attr("src", IMG_PATH + "848a8a9331cabc6335f8e73d9f2f07616aa283c6");
}

$(document).ready(function() {
	updateItem();
});