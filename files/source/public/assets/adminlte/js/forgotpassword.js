$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
	$("#ResetPasswordHTMLDB").on("htmldbmessage", function (e) {
        if (e.detail.messageText == "UPDATED") {
        	AdminLteHTMLDB.sweetAlert("success", document.getElementById("divSaveMessage").innerHTML);

        	var URLPrefix = document.body.getAttribute("data-url-prefix");
            setTimeout(function () {
                window.location.href = URLPrefix + "login";
            }, 1000);
        }
    });
}