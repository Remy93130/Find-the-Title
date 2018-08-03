var usernames;

function getUsernames() {
	$.post(
		"index.php",
		{
			query:1,
			request:"getUser",
			token:$("#token").val()
		},
		function(data) {
			usernames = $.parseJSON(data);
			for (var i = 0; i < usernames.length; i++) {
				usernames[i] = usernames[i].toLowerCase();
			}
		}
	);
}

$(document).ready(function(){

	getUsernames();
	$("#username").keyup(function() {
		var data = $.inArray($("#username").val().toLowerCase(), usernames);
		if (data != -1) {
			$("#error-username").empty();
			$("#error-username").append("Ce pseudo est déjà utilisé !");
			$('button').prop('disabled', true);
		} else {
			$("#error-username").empty();
			$('button').prop('disabled', false);
		}
	});
});
