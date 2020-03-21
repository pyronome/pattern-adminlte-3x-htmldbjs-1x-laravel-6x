$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
	$("#ConfigurationHTMLDB").on("htmldbmessage", function (e) {
        if (e.detail.messageText == "UPDATED") {
        	AdminLteHTMLDB.sweetAlert("success", document.getElementById("divSaveMessage").innerHTML);           
        }
    });
}