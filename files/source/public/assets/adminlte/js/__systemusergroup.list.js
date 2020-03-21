$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
	$("#tbodyUserGroupListTemplate").on("htmldbrender", function (e) {
		AdminLteHTMLDB.initializeTableCheckbox(e.target);
	});
}