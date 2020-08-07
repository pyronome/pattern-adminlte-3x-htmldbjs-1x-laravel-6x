$(function(){
	initializeApplication();
    initializePage();
});

function initializePage() {
	$("#ProfileHTMLDB").on("htmldbread", function (e) {
		afterProfileHTMLDBRead(e.target);
	});
}

function afterProfileHTMLDBRead(sender) {
	$(".showBigPhoto").off("click").on("click", function() {
        AdminLteHTMLDB.doShowBigPhotoClick(this);
    });
}