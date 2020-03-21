$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
	$("#formUser-__systemusergroup_id").on("change", function () {
        doUserGroupChange(this);
    });
	
	$("#formUser-menu_permission").on("htmldbsetvalue", function (e) {
        doPermissionHTMLDBSetValue(this, e);
    });

    $("#formUser-menu_permission").on("htmldbgetvalue", function (e) {
        doPermissionHTMLDBGetValue(this, e);
    });

	$("#input-view-all").off("click").on("click", function () {
        doCheckAllCheckboxClick(this, "view");
    });

    $("#input-edit-all").off("click").on("click", function () {
        doCheckAllCheckboxClick(this, "edit");
    });

    $("#input-lockgroup-all").off("click").on("click", function () {
        doCheckAllCheckboxClick(this, "lockgroup");
    });
	
	$("#tbodyMenuPermission .input-menu-permission").off("click").on("click", function () {
        updatePermissionCheckboxStates();
    });

    // Service List
        $("#buttonEditServices").off("click").on("click", function () {
            showServiceList();
        });
        
        $("#ulServiceTemplate").on("htmldbrender", function (e) {
            initializeServiceList();
        });

        $("#searchService").off("keyup").on("keyup", function () {
            doSearchService(this);
        });

        $("#buttonSave-Services").off("click").on("click", function () {
            renderServicePermissionTable();
        });

    // Service Permission
        $("#formUser-service_permission").on("htmldbsetvalue", function (e) {
            doServicePermissionHTMLDBSetValue(this, e);
        });

        $("#formUser-service_permission").on("htmldbgetvalue", function (e) {
            doServicePermissionHTMLDBGetValue(this, e);
        });
}

// Menu Permission
    function doUserGroupChange (sender) {
    	if (!sender) {
            return;
        }
    	
    	$(".groupMenuPermissionIcon").attr("class", "groupMenuPermissionIcon spanIcon spanIconActive0");

        var groupId = HTMLDB.getInputValue(sender);
        
        if (0 == groupId) {
        	return;
        }

        var UserGroup = HTMLDB.get(HTMLDB.e("__SystemUserGroupHTMLDB"), groupId);
        var groupPermissions = UserGroup["menu_permission"];

        var permissions = [];
        var permissionCount = 0;

        if ("" == groupPermissions) {
            return false;
        }
        
        permissions = groupPermissions.split(",");
        permissionCount = permissions.length;

        var checkbox = null;

        for (var i = 0; i < permissionCount; i++) {
            if (document.getElementById("groupmenupermission-" + permissions[i])) {
                document.getElementById("groupmenupermission-" + permissions[i]).className = "groupMenuPermissionIcon spanIcon spanIconActive1";
            }
        }

        var userGroupServicePermissions = UserGroup["service_permission"];
        initializeGroupServicePermissionTable(userGroupServicePermissions);

        permissions = userGroupServicePermissions.split(",");
        permissionCount = permissions.length;
        
        for (var i = 0; i < permissionCount; i++) {
            if (document.getElementById("groupservicepermission-" + permissions[i])) {
                document.getElementById("groupservicepermission-" + permissions[i]).className = "spanIcon spanIconActive1";
            }
        }
    }

    function initializeGroupServicePermissionTable(servicePermissions) {
        if ("" == servicePermissions) {
            return false;
        }
        
        var templateHTML = document.getElementById("trGroupServicePermission").innerHTML;
        var trHTML = "";
        var tbodyHTML = "";
        
        var listPermission = [];
        var index = 0;
        var permissions = servicePermissions.split(",");
        var permissionToken = "";
        var permissionPart = [];
        var directory_name = "";
        var service_name = "";
        var permissionKey = "";
        
        var permissionCount = permissions.length;

        for (var i = 0; i < permissionCount; i++) {
            permissionToken = permissions[i];
            permissionPart = permissionToken.split("/");
            key = permissionPart[0] + "/" + permissionPart[1];
            
            if (!listPermission.includes(key)) {
                listPermission[index] = key;
                index++;
            }
        }

        /*usedPermission = listPermission;*/
        permissionCount = listPermission.length;

        for (var i = 0; i < permissionCount; i++) {
            permissionToken = listPermission[i];
            permissionPart = permissionToken.split("/");
            directory_name = permissionPart[0];
            service_name = permissionPart[1];

            trHTML = templateHTML;
            trHTML = trHTML.replace(/__DIRECTORY__/g, directory_name).replace(/__SERVICE__/g, service_name);
            tbodyHTML += trHTML;
        };

        document.getElementById("tbodyGroupServicePermission").innerHTML = tbodyHTML;
    }

    function doPermissionHTMLDBSetValue(sender, e) {
        var userPermissions = e.detail.value;
        var permissions = [];
        var permissionCount = 0;

        if (userPermissions != "") {
            permissions = userPermissions.split(",");
        }

        permissionCount = permissions.length;

        $("#input-view-all").prop("checked", false);
        $("#input-edit-all").prop("checked", false);
        $("#input-lockgroup-all").prop("checked", false);
        $("#tbodyMenuPermission .input-menu-permission").prop("checked", false);

        var checkbox = null;
        for (var i = 0; i < permissionCount; i++) {
            checkbox = document.getElementById("input-" + permissions[i]);
            $(checkbox).prop("checked", true);
        }

        updatePermissionCheckboxStates();
    }

    function doPermissionHTMLDBGetValue(sender, e) {
        var checkboxes = $("#tbodyMenuPermission .input-menu-permission");
        var checkboxCount = checkboxes.length;
        var checkbox = null;
        var userPermissions = "";

        for (var i = 0; i < checkboxCount; i++) {
            checkbox = checkboxes[i];
            if (checkbox.checked) {
                if (userPermissions != "") {
                    userPermissions += ",";
                }
                userPermissions += checkbox.getAttribute("data-permission-token");
            }
        }

        $("#formUser-menu_permission").val(userPermissions);
    }

    function doCheckAllCheckboxClick(sender, type) {
        if (!sender) {
            return;
        }
    	
    	var selectorText = "#tbodyMenuPermission .input-" + type;

        $(selectorText).prop("checked", sender.checked);

        updatePermissionCheckboxStates();
    }

    function updatePermissionCheckboxStates() {
        // View
        var inputViewCount = $("#tbodyMenuPermission .input-view").length;
        var inputViewCheckedCount = $("#tbodyMenuPermission .input-view:checked").length;
        
        if (inputViewCount == inputViewCheckedCount) {
            $("#input-view-all").prop("checked", true);
        } else {
            $("#input-view-all").prop("checked", false);
        }

        // Edit
        var inputEditCount = $("#tbodyMenuPermission .input-edit").length;
        var inputEditCheckedCount = $("#tbodyMenuPermission .input-edit:checked").length;

        if (inputEditCount == inputEditCheckedCount) {
            $("#input-edit-all").prop("checked", true);
        } else {
            $("#input-edit-all").prop("checked", false);
        }

        // Lockgroup
        var inputLockCount = $("#tbodyMenuPermission .input-lockgroup").length;
        var inputLockCheckedCount = $("#tbodyMenuPermission .input-lockgroup:checked").length;

        if (inputLockCount == inputLockCheckedCount) {
            $("#input-lockgroup-all").prop("checked", true);
        } else {
            $("#input-lockgroup-all").prop("checked", false);
        }
    }

    function doLockCheckboxClick(sender) {
        if (!sender) {
            return;
        }

        if (sender.checked) {
            $(".group-permission-part", sender.parentNode.parentNode.parentNode).addClass("group-permission-deactive");
        } else {
            $(".group-permission-part", sender.parentNode.parentNode.parentNode).removeClass("group-permission-deactive");
        }
    }

// Service Permission
    // Service List
    function doSearchService(sender) {
        if (!sender) {
            return;
        }

        var searchText = sender.value;

        $(".searchable-service").css("display", "none");

        var arrLI = $(".searchable-service");
        var countLI = arrLI.length;
        var searchedElement = null;
        var searchedText = "";

        for (var i = 0; i < countLI; i++) {
            searchedElement = arrLI[i];
            searchedText = searchedElement.getAttribute("data-search-text");

            if (searchedText.search(new RegExp(searchText, "i")) != -1) {
                /*searchedElement.parentNode.parentNode.style.display = "block";*/
                $(searchedElement).show();

                if ("service" == searchedElement.getAttribute("data-type")) {
                    $(searchedElement.parentNode.parentNode).show();
                }
            }
        }
    }

    function showServiceList() {
        updateServiceList();
        showDialog("modal-ServiceList");
    }

    function updateServiceList() {
        var usedCount = usedPermission.length;
        var checkbox = null;
        var directory_name = "";
        var checkAllElement = null;

        for (var i = 0; i < usedCount; i++) {
            checkbox = document.getElementById("selectService" + usedPermission[i]);
            $(checkbox).prop("checked", true);

            directory_name = checkbox.getAttribute("data-directory");
            checkAllElement = document.getElementById("select" + directory_name + "Services");
            updateSelectServiceCheckboxState(checkAllElement, directory_name);
        }
    }

    function initializeServiceList() {
        
        $(".selectDirectoryServices").off("click").on("click", function () {
            doDirectoryCheckboxClick(this);
        });

        $(".selectService").off("click").on("click", function () {
            doServiceCheckboxClick(this);
        });
    }

    function doDirectoryCheckboxClick(sender) {
        if (!sender) {
            return;
        }
        
        var directory_name = sender.getAttribute("data-directory");
        var serviceCheckboxSelectorText = "." + directory_name + "Service";
        $(serviceCheckboxSelectorText).prop("checked", sender.checked);

        updateSelectServiceCheckboxState(sender, directory_name);
    }

    function doServiceCheckboxClick(sender) {
        if (!sender) {
            return;
        }
        
        var directory_name = sender.getAttribute("data-directory");
        var checkAllElement = document.getElementById("select" + directory_name + "Services");
        updateSelectServiceCheckboxState(checkAllElement, directory_name);
    }

    function updateSelectServiceCheckboxState(checkAllElement, directory_name) {
        var parentElement = document.getElementById(directory_name + "Services");

        var serviceCheckboxSelectorText = "." + directory_name + "Service";
        var checkboxCount = $(serviceCheckboxSelectorText, parentElement).length;

        var serviceSelectedCheckboxSelectorText = "." + directory_name + "Service:checked";
        var selectedCount = $(serviceSelectedCheckboxSelectorText, parentElement).length;
        
        if (0 == selectedCount) {
            $(checkAllElement).prop("checked", false);
        } else {
            if (selectedCount == checkboxCount) {
                $(checkAllElement).prop("checked", true);
            } else {
                $(checkAllElement).prop("checked", false);
            }
        }
    }

    function renderServicePermissionTable() {
        var serviceSelectedCheckbox = $(".selectService:checked");
        var selectedCount = serviceSelectedCheckbox.length;

        var templateHTML = document.getElementById("trServicePermissionInputs").innerHTML;
        var trHTML = "";
        var tbodyHTML = "";
        var service_name = "";
        var directory_name = "";

        for (var i = 0; i < selectedCount; i++) {
            directory_name = serviceSelectedCheckbox[i].getAttribute("data-directory");
            service_name = serviceSelectedCheckbox[i].getAttribute("data-file");

            trHTML = templateHTML;
            trHTML = trHTML.replace(/__DIRECTORY__/g, directory_name).replace(/__SERVICE__/g, service_name);
            tbodyHTML += trHTML;
        }

        document.getElementById("tbodyUserServicePermission").innerHTML = tbodyHTML;

        renderServicePermissionCheckbox();
    
        updateUserPermissionOnTable();

        hideDialog("modal-ServiceList");
    }


// Service Permission
    var usedPermission = [];

    function doServicePermissionHTMLDBSetValue(sender, e) {
        var userPermissions = e.detail.value;

        initializeServicePermissionTable(userPermissions);

        updateUserPermissionOnTable();
    }

    function initializeServicePermissionTable(userPermissions) {
        if ("" == userPermissions) {
            return false;
        }
        
        var templateHTML = document.getElementById("trServicePermissionInputs").innerHTML;
        var trHTML = "";
        var tbodyHTML = "";
        
        var listPermission = [];
        var index = 0;
        var permissions = userPermissions.split(",");
        var permissionToken = "";
        var permissionPart = [];
        var directory_name = "";
        var service_name = "";
        var permissionKey = "";
        
        var permissionCount = permissions.length;

        for (var i = 0; i < permissionCount; i++) {
            permissionToken = permissions[i];
            permissionPart = permissionToken.split("/");
            key = permissionPart[0] + "/" + permissionPart[1];
            
            if (!listPermission.includes(key)) {
                listPermission[index] = key;
                index++;
            }
        }

        usedPermission = listPermission;
        permissionCount = listPermission.length;

        for (var i = 0; i < permissionCount; i++) {
            permissionToken = listPermission[i];
            permissionPart = permissionToken.split("/");
            directory_name = permissionPart[0];
            service_name = permissionPart[1];

            trHTML = templateHTML;
            trHTML = trHTML.replace(/__DIRECTORY__/g, directory_name).replace(/__SERVICE__/g, service_name);
            tbodyHTML += trHTML;
        };

        document.getElementById("tbodyUserServicePermission").innerHTML = tbodyHTML;

        renderServicePermissionCheckbox();
    }

    function updateUserPermissionOnTable() {
        var userPermissions = document.getElementById("formUser-service_permission").value;
        var permissions = [];
        var permissionCount = 0;

        if ("" != userPermissions) {
            permissions = userPermissions.split(",");
        }

        permissionCount = permissions.length;

        $("#input-get-all").prop("checked", false);
        $("#input-post-all").prop("checked", false);
        $("#input-delete-all").prop("checked", false);
        $("#input-lockgrouppermission-all").prop("checked", false);
        $("#tbodyUserServicePermission .input-service-permission").prop("checked", false);

        var checkbox = null;

        for (var i = 0; i < permissionCount; i++) {
            checkbox = document.getElementById("input-" + permissions[i]);
            $(checkbox).prop("checked", true);
        }

        if (permissionCount > 0) {
            updateServicePermissionCheckboxStates();
        }
    }

    function doServicePermissionHTMLDBGetValue(sender, e) {
        var checkboxes = $("#tbodyUserServicePermission .input-service-permission");
        var checkboxCount = checkboxes.length;
        var checkbox = null;
        var userPermissions = "";

        for (var i = 0; i < checkboxCount; i++) {
            checkbox = checkboxes[i];
            if (checkbox.checked) {
                if (userPermissions != "") {
                    userPermissions += ",";
                }
                userPermissions += checkbox.getAttribute("data-permission-token");
            }
        }

        $("#formUser-service_permission").val(userPermissions);
    }

    function renderServicePermissionCheckbox() {
        $("#input-get-all").off("click").on("click", function () {
            doServicePermissionCheckall(this, "get");
        });

        $("#input-post-all").off("click").on("click", function () {
            doServicePermissionCheckall(this, "post");
        });

        $("#input-delete-all").off("click").on("click", function () {
            doServicePermissionCheckall(this, "delete");
        });

        $("#input-lockgrouppermission-all").off("click").on("click", function () {
            doServicePermissionCheckall(this, "lockgrouppermission");
        });
        
        $("#tbodyUserServicePermission .input-service-permission").off("click").on("click", function () {
            updateServicePermissionCheckboxStates();
        });
    }

    function doServicePermissionCheckall(sender, type) {
        if (!sender) {
            return;
        }
        
        var selectorText = "#tbodyUserServicePermission .input-" + type;

        $(selectorText).prop("checked", sender.checked);

        updateServicePermissionCheckboxStates();
    }

    function updateServicePermissionCheckboxStates() {
        var countGetCheckbox = $("#tbodyUserServicePermission .input-get").length;
        var countCheckedGetCheckbox = $("#tbodyUserServicePermission .input-get:checked").length;

        if (countGetCheckbox == countCheckedGetCheckbox) {
            $("#input-get-all").prop("checked", true);
        } else {
            $("#input-get-all").prop("checked", false);
        }

        var countPostCheckbox = $("#tbodyUserServicePermission .input-post").length;
        var countCheckedPostCheckbox = $("#tbodyUserServicePermission .input-post:checked").length;

        if (countPostCheckbox == countCheckedPostCheckbox) {
            $("#input-post-all").prop("checked", true);
        } else {
            $("#input-post-all").prop("checked", false);
        }

        var countDeleteCheckbox = $("#tbodyUserServicePermission .input-delete").length;
        var countCheckedDeleteCheckbox = $("#tbodyUserServicePermission .input-delete:checked").length;

        if (countDeleteCheckbox == countCheckedDeleteCheckbox) {
            $("#input-delete-all").prop("checked", true);
        } else {
            $("#input-delete-all").prop("checked", false);
        }

        var countLockGroupCheckbox = $("#tbodyUserServicePermission .input-lockgrouppermission").length;
        var countCheckedLockGroupCheckbox = $("#tbodyUserServicePermission .input-lockgrouppermission:checked").length;

        if (countLockGroupCheckbox == countCheckedLockGroupCheckbox) {
            $("#input-lockgrouppermission-all").prop("checked", true);
        } else {
            $("#input-lockgrouppermission-all").prop("checked", false);
        }
    }