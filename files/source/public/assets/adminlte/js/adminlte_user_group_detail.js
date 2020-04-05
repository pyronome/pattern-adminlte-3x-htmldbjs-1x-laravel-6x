$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
	$("#AdminLTEUserGroupHTMLDB").on("htmldbread", function (e) {
		initializeUserGroupMenuPermissions();
        initializeUserGroupServicePermissions();
	});
}

function initializeUserGroupMenuPermissions() {
	var userGroupPermissions = HTMLDB.getInputValue(HTMLDB.e("menu_permission"));

    var permissions = [];
    var permissionCount = 0;

    if ("" == userGroupPermissions) {
        return false;
    }
	
	permissions = userGroupPermissions.split(",");
    permissionCount = permissions.length;

    for (var i = 0; i < permissionCount; i++) {
        if (document.getElementById("groupmenupermission-" + permissions[i])) {
            document.getElementById("groupmenupermission-" + permissions[i]).className = "spanIcon spanIconActive1";
        }
    }
}

function initializeUserGroupServicePermissions() {
    var userGroupPermissions = HTMLDB.getInputValue(HTMLDB.e("service_permission"));

    var permissions = [];
    var permissionCount = 0;

    if ("" == userGroupPermissions) {
        return false;
    }

    initializeServicePermissionTable(userGroupPermissions);

    permissions = userGroupPermissions.split(",");
    permissionCount = permissions.length;
    
    for (var i = 0; i < permissionCount; i++) {
        if (document.getElementById("groupservicepermission-" + permissions[i])) {
            document.getElementById("groupservicepermission-" + permissions[i]).className = "spanIcon spanIconActive1";
        }
    }
}

function initializeServicePermissionTable(userPermissions) {
    if ("" == userPermissions) {
        return false;
    }
    
    var templateHTML = document.getElementById("trGroupServicePermission").innerHTML;
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

    document.getElementById("tbodyGroupServicePermission").innerHTML = tbodyHTML;
}