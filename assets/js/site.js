$(document).ready(function () {
    $("#submitmsg").click(function () {
        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});
        $("#usermsg").attr("value", "");
        return false;
    });
});
