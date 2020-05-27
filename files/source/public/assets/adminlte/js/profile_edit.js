$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
	$("#ProfileHTMLDB").on("htmldbmessage", function (e) {
        if (e.detail.messageText == "UPDATED") {
        	AdminLteHTMLDB.sweetAlert("success", document.getElementById("divSaveMessage").innerHTML);

        	var URLPrefix = document.body.getAttribute("data-url-prefix");
            setTimeout(function () {
                var mainFolder = document.body.getAttribute("data-main-folder");
                window.location.href = ("/" + mainFolder + "/profile/detail");
            }, 1000);
        }
    });
}
