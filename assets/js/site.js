//$(document).ready(function () {
    $("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
                var room = $("#room").val();
                var user = $("#user").val();
		$.post("ViestiController.php", {text: clientmsg, room: room, user: user});				
		$("#usermsg").attr("value", "");
		return false;
	});
//});
