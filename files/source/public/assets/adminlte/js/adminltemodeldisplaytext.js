$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
    $("#buttonWidgetConfig").detach();
    $("#modal-WidgetList").detach();
            
	$("#ModelDisplayTextHTMLDB").on("htmldbmessage", function (e) {
        if (e.detail.messageText == "UPDATED") {
        	AdminLteHTMLDB.sweetAlert("success", document.getElementById("divSaveMessage").innerHTML);
        	hideDialog("modal-ModelDisplayTextList");  
        }
    });

	$("#tbodyModelListTemplate").on("htmldbrender", function (e) {
        initializeModelList();
    });

    $("#buttonSave-formModelDisplayText").off("click").on("click", function () {
		saveFormModelDisplayText(this);
    });

    $("#ulModelPropertyListTemplate").on("htmldbrender", function () {
        initializeModelAttributeList();
    });

    $("#buttonSave-formEditDisplayText").off("click").on("click", function () {
		saveFormEditDisplayText(this);
    });

    $("#buttonSearchProperty").off("click").on("click", function () {
        showDialog("modal-ModelProportyList");
    });
}

function initializeModelAttributeList() {
    $(".liModelProperty").off("click").on("click", function () {
        addToDisplayText(this);
    });

    $("#ulModelList a:first-child").tab("show")
}

function addToDisplayText(sender) {
    var append = "{{" + sender.getAttribute("data-display-text") + "}}";
    var old_text = $("#formEditDisplayText-display_text").summernote("code");
    $("#formEditDisplayText-display_text").summernote("code", (old_text + append));

    hideDialog("modal-ModelProportyList");
}

function initializeModelList() {
	$(".tdModelDisplayTextEditButton").off("click").on("click", function () {
		showModelDisplayTextList(this);
    });
}

function showModelDisplayTextList(sender) {
	var objectId = sender.getAttribute("data-row-id");

	var tableHTMLDB = HTMLDB.e("ModelDisplayTextHTMLDB");
    var object = HTMLDB.get(tableHTMLDB, objectId);
    
    document.getElementById("formModelDisplayText-id").value = object["id"];
    document.getElementById("formModelDisplayText-model").value = object["model"];
    document.getElementById("formModelDisplayText-display_text_json").value = object["display_text_json"];

    initializeModelPropertyDisplayTextList(object["display_text_json"]);

	showDialog("modal-ModelDisplayTextList");
}

function initializeModelPropertyDisplayTextList(display_text_json) {
	var tbodyElement = document.getElementById("tbodyModelDisplayText");
	tbodyElement.innerHTML = "";

	if ("" == display_text_json) {
        return false;
    }
    
    var templateHTML = document.getElementById("trEditDisplayTextTemplate").innerHTML;
    var trHTML = "";
    var tbodyHTML = "";


    var display_text_jsonJSON = decodeURIComponent(display_text_json);
    var display_texts = JSON.parse(display_text_jsonJSON);
    var display_text = "";
    var decoded_display_text = "";
    var sh_class = "";
    var anti_sh_class = "";
    var tr_class = "";
    var warning = "";
    var index = 1;

	var trElement = null;

    for (var property in display_texts) {
		display_text = display_texts[property];
        decoded_display_text = HTMLDB.decodeHTMLEntities(display_text);
        sh_class = get_type_sh_class(property);
        
        if ("" == sh_class) {
            tr_class = "trEditDisplayText";
            warning = "";
            anti_sh_class = "d-none";
        } else {
            tr_class = "";
            warning = "This type property display text not editable.";
            anti_sh_class = "";
        }

    	trHTML = templateHTML;
        trHTML = trHTML.replace(/__PROPERTY__/g, property).replace(/__DISPLAY_TEXT__/g, decoded_display_text)
            .replace(/__INDEX__/g, index).replace(/__SH_CLASS__/g, sh_class).replace(/__ANTI_SH_CLASS__/g, anti_sh_class);
        
        trElement = document.createElement("TR");
        trElement.id = "trEditDisplayText" + index;
        trElement.className = tr_class;
        trElement.setAttribute("data-index", index);
        trElement.title = warning;

        trElement.innerHTML = trHTML;
        $(trElement).data("property", property);
        $(trElement).data("display_text", display_text);
        tbodyElement.appendChild(trElement);

        index++;
    }
	
	$(".trEditDisplayText").off("click").on("click", function () {
		showEditDisplayTextModal(this);
    });
}

function get_type_sh_class(property) {
    var sh_class = "";
    var exceptions = ["image", "file", "selection_multiple", "selection_single", "location"];
    var model = document.getElementById("formModelDisplayText-model").value;
    var trList = $("#PropertyListHTMLDB_reader_tbody > tr");
    var trLength = trList.length;
    var rowId = 0;
    var result_found = false;

    for (var i = 0; i < trLength; i++) {
        if (result_found) {
            break;
        }

        rowId = trList[i].getAttribute("data-row-id");
        result_found = (model == document.getElementById("PropertyListHTMLDB_reader_td" + rowId + "model").innerHTML);
        result_found = result_found && (property == document.getElementById("PropertyListHTMLDB_reader_td" + rowId + "property").innerHTML);
        if (result_found) {
            if (-1 != exceptions.indexOf(document.getElementById("PropertyListHTMLDB_reader_td" + rowId + "type").innerHTML)) {
                sh_class = "d-none";
            }            
        }
    }

    return sh_class;
}

function showEditDisplayTextModal(sender) {
	var index = sender.getAttribute("data-index");
	var property = $(sender).data("property");
	var display_text = $(sender).data("display_text");

    var decoded_display_text = HTMLDB.decodeHTMLEntities(display_text);

	document.getElementById("formEditDisplayText-index").value = index;
	document.getElementById("formEditDisplayText-property").value = property;
    
    $("#formEditDisplayText-display_text").summernote({
        "font-styles": false,
        "height": 150,
        codemirror: {
            theme: "monokai"
        }
    });

    $("#formEditDisplayText-display_text").summernote("code", decoded_display_text);

	showDialog("modal-EditDisplayText");
}

function saveFormEditDisplayText() {
	var index = document.getElementById("formEditDisplayText-index").value;
	var property = document.getElementById("formEditDisplayText-property").value;
	var display_text = document.getElementById("formEditDisplayText-display_text").value;

	document.getElementById("property_" + index).innerHTML = property;
	document.getElementById("display_text_" + index).innerHTML = display_text;

	var trEditDisplayText = document.getElementById("trEditDisplayText" + index);
	
    var encoded_display_text = HTMLDB.encodeHTMLEntities(display_text);
	$(trEditDisplayText).data("property", property);
	$(trEditDisplayText).data("display_text", encoded_display_text);

	document.getElementById("updated-icon-" + index).className = "fas fa-check icon-updated-item";

	hideDialog("modal-EditDisplayText");
}

function saveFormModelDisplayText () {
	var tableHTMLDB = HTMLDB.e("ModelDisplayTextHTMLDB");
	var objectId = document.getElementById("formModelDisplayText-id").value;
    var object = HTMLDB.get(tableHTMLDB, objectId);
	
	var trEditDisplayTextList = $(".trEditDisplayText");
	var countTR = trEditDisplayTextList.length;
	var displayTextList = [];
	var objectDisplayText = {};
	var property = "";
	var display_text = "";

	for (var i = 0; i < countTR; i++) {
		property = $(trEditDisplayTextList[i]).data("property");
		display_text = $(trEditDisplayTextList[i]).data("display_text");

		objectDisplayText = {};
        objectDisplayText[property] = HTMLDB.encodeHTMLEntities(display_text);

        displayTextList.push(objectDisplayText);
	}

	object["display_text_json"] = JSON.stringify(displayTextList);
	HTMLDB.update(tableHTMLDB, objectId, object);
}
