$(function(){
	initializeApplication();
    initializePage();
});

function initializePage() {
	$("#divTranslationsTemplate").on("htmldbrender", function (e) {
		afterTranslationsTemplateRender(e.target);
	});

	$("#formLanuage-code").on("change", function() {
		changeTranslationContent(this);
	});

	$("#formLanuage-page").on("change", function() {
		changeTranslationContent(this);
	});

	$("#buttonSaveTranslations").off("click").on("click", function() {
		doSaveTranslationsButtonClick(this);
	});

	$("#buttonNewTranslation").off("click").on("click", function () {
		addNewTranslation(this);
	});

	$("#buttonSave-formNewTranslation").off("click").on("click", function () {
		saveNewTranslation(this);
	});

	$("#buttonShowCopyTranslationsForm").off("click").on("click", function () {
		showCopyTranslationsForm(this);
	});

	$("#buttonSave-formCopyTranslations").off("click").on("click", function () {
		copyTranslations(this);
	});

	$("#TranslationCopyHTMLDB").on("htmldbread", function (e) {
		afterTranslationCopyHTMLDBread(e.target);
	});
}
function afterTranslationsTemplateRender(sender) {
	if ("" == document.getElementById("divTranslations").innerHTML) {
		document.getElementById("divTranslations").innerHTML = document.getElementById("translationsPlaceholderTemplate").innerHTML
	}

	$("#divTranslations .buttonDeleteTranslation").off("click").on("click", function () {
		doDeleteTranslationButtonClick(this);
	});
}

function changeTranslationContent(sender) {
	if (!sender) {
		return;
	}
	
	var code = $("#formLanuage-code").val();
	if (("" == code) == (null === code)) {
		return false;
	}

	var page = $("#formLanuage-page").val();
	if (("" == page) == (null === page)) {
		return false;
	}

	document.getElementById("divTranslations").innerHTML = "";

	var URLPrefix = document.body.getAttribute("data-url-prefix");
	document.getElementById("TranslationHTMLDB").setAttribute("data-htmldb-read-url", (URLPrefix + "htmldb/languages/readtranslation/" + code + "/" + page));

    HTMLDB.read(HTMLDB.e("TranslationHTMLDB"));
}

function doDeleteTranslationButtonClick(sender) {
	if (!sender) {
		return false;
	}

	$(sender.parentNode.parentNode.parentNode).detach();
}

function doSaveTranslationsButtonClick(sender) {
	if (!sender) {
		return;
	}

	HTMLDB.pause();

	var language = $("#formLanuage-code").val();
	var page = $("#formLanuage-page").val();
	var sentence = "";
	var translation = "";
	var id = 0;

	var translations = $("#divTranslations .divTranslation");
	var translationCount = translations.length;
	var translation = null;
	var object = {};

	for (var i = 0; i < translationCount; i++) {
		translation = translations[i];
		id = translation.getAttribute("data-row-id");

		sentence = document.getElementById("labelTranslation" + id).innerHTML;
		translation = document.getElementById("inputTranslation" + id).value;

		object = {};
		object["id"] = 0;
		object["language"] = language;
		object["page"] = page;
		object["sentence"] = sentence;
		object["translation"] = translation;
		
		HTMLDB.update(HTMLDB.e("TranslationHTMLDB"), object["id"], object);
	}

	HTMLDB.resume();
}

function addNewTranslation(sender) {
	if (!sender) {
		return false;
	}

	HTMLDB.setInputValue(HTMLDB.e("formNewTranslation-sentence"), "");
	showDialog("modal-formNewTranslation");
}
function saveNewTranslation(sender) {
	if (!sender) {
		return false;
	}

	var sentence = document.getElementById("formNewTranslation-sentence").value;

	if ("" == sentence) {
		showErrorDialog("You must entry a sentence.");
		return false;
	}

	var content = document.getElementById("newTranslationTemplate").innerHTML;
	var translationCount = $("#divTranslations .divTranslation").length;
	var index = 0;

	if (translationCount > 0) {

		var lastTranslation = $("#divTranslations .divTranslation")[translationCount - 1];
		index = parseInt(lastTranslation.getAttribute("data-row-id"));

	}

	index++;

	content = content.replace(/__ID__/g, index);
	content = content.replace(/__SENTENCE__/g, sentence);

	if (translationCount > 0) {
		document.getElementById("divTranslations").innerHTML += content;
	} else {
		document.getElementById("divTranslations").innerHTML = content;
	}

	hideDialog("modal-formNewTranslation");

	$("#divTranslations .buttonDeleteTranslation").off("click").on("click", function () {
		doDeleteTranslationButtonClick(this);
	});
}

function showCopyTranslationsForm(sender) {
	if (!sender) {
		return false;
	}

	showDialog("modal-formCopyTranslations");
}

function copyTranslations(sender) {
	if (!sender) {
		return false;
	}
	
	var page = $("#formCopyTranslations-page").val();
	if ("" == page) {
		showErrorDialog("Please select a page.");
		return false;
	}

	var fromLanguage = $("#formCopyTranslations-fromLanguage").val();
	if ("" == fromLanguage) {
		showErrorDialog("Please language to be copied from.");
		return false;
	}

	var toLanguage = $("#formCopyTranslations-toLanguage").val();
	if ("" == toLanguage) {
		showErrorDialog("Please select language to be copied to.");
		return false;
	}

	var object = {};
	object["id"] = 0;
	object["page"] = page;
	object["fromLanguage"] = fromLanguage;
	object["toLanguage"] = toLanguage;
	HTMLDB.update(HTMLDB.e("TranslationCopyHTMLDB"), object["id"], object);

	document.body.setAttribute("data-translation-copied", 1);
	hideDialog("modal-formCopyTranslations");
}
function afterTranslationCopyHTMLDBread(sender) {
	if (0 == document.body.getAttribute("data-translation-copied")) {
		return false;
	}
	
	var page = $("#formCopyTranslations-page").val();
	var toLanguage = $("#formCopyTranslations-toLanguage").val();

	$("#formLanuage-code").val(toLanguage);
	$("#formLanuage-code").trigger("change");

	$("#formLanuage-page").val(page);
	$("#formLanuage-page").trigger("change");

	document.getElementById("divTranslations").innerHTML = "";

	var URLPrefix = document.body.getAttribute("data-url-prefix");
	document.getElementById("TranslationHTMLDB").setAttribute("data-htmldb-read-url", (URLPrefix + "htmldb/languages/readtranslation/" + toLanguage + "/" + page));

	HTMLDB.read(HTMLDB.e("TranslationHTMLDB"));
}