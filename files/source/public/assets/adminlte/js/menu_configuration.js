$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
	$("#menu_json").on("htmldbsetvalue", function (e) {
        setTimeout(function(){
            doMenuJSONSetValue(this, e);
        });
    });

    $("#buttonNewMenuItem").off("click").on("click", function () {
        doButtonNewMenuItemClick(this);
    });

	$("#ConfigurationHTMLDB").on("htmldbmessage", function (e) {
        if (e.detail.messageText == "UPDATED") {
        	AdminLteHTMLDB.sweetAlert("success", document.getElementById("divSaveMessage").innerHTML);
            setTimeout(function () {
                window.location = window.location.href;
            }, 1000);
        }
    });
}

function doMenuJSONSetValue(sender, e) {
    if ("" == e.detail.value) {
        return false;
    }

    var menu_jsonJSON = decodeURIComponent(e.detail.value);
    var menu_json = JSON.parse(menu_jsonJSON);
    
    //icon picker options
    var iconPickerOptions = {searchText: '...', labelHeader: '{0} / {1}'};
                
    var sortableListOptions = {
        placeholderCss: {"background-color": "#cccccc"}
    };

    var editor = new MenuEditor("ulMenuEditor", {listOptions: sortableListOptions, iconPicker: iconPickerOptions});
    editor.setForm($("#formMenuItem"));
    editor.setUpdateButton($("#buttonUpdateMenuItem"));
    editor.setData(menu_json);

    $("#buttonSave-formConfiguration").off("click").on("click", function () {
        var str = editor.getString();
        saveMenuConfiguration(str);
    });

    $("#buttonUpdateMenuItem").off("click").on("click", function(){
        editor.update();
        hideDialog("modalMenuItem");
    });

    $("#buttonAddMenuItem").off("click").on("click", function(){
        editor.add();
        hideDialog("modalMenuItem");
    });

    $( "#ulMenuEditor" ).sortable();
    $( "#ulMenuEditor" ).disableSelection();
}

function doButtonNewMenuItemClick(sender) {
	if (!sender) {
		return;
	}
	
	document.getElementById("text").value = "";
	document.getElementById("href").value = "";
	document.getElementById("visibility").value = 1;

	$("#buttonUpdateMenuItem").hide();
	$("#buttonAddMenuItem").show();
	showDialog("modalMenuItem");
}

function saveMenuConfiguration(menuJson) {
	var tableHTMLDB = HTMLDB.e("ConfigurationHTMLDB");
	var configurationObj = HTMLDB.get(tableHTMLDB, 1);
	configurationObj['menu_json'] = menuJson;
	HTMLDB.update(tableHTMLDB, 1, configurationObj);
}