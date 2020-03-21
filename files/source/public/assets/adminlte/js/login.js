$(function(){
    initializePage();
});
function initializePage() {
	$("#loginHTMLDB").on("htmldbmessage", function (e) {
		var URLPrefix = document.body.getAttribute("data-url-prefix");
        window.location.href = URLPrefix + e.detail.messageText;
    });
}