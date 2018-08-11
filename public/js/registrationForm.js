var usernames;
var regexMail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

function getUsernames() {
	$.post(
		"index.php",
		{
			query:1,
			request:"getUser",
			token:$("#token").val()
		},
		(_data) => {
			usernames = $.parseJSON(_data);
			for (var i = 0; i < usernames.length; i++) {
				usernames[i] = usernames[i].toLowerCase();
			}
		}
	);
}

$(document).ready(() => {

	getUsernames();
	$("#username").keyup(() => {
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

	$('#email').keyup(() => {
		if ($('#email').val().match(regexMail)) {
			$("#error-email").empty();
			$('button').prop('disabled', false);
		} else {
			$("#error-email").empty();
			$("#error-email").append("Cette adresse Email n'est pas correct !");
			$('button').prop('disabled', true);
		}
	});
});
