function initializeMediaJS() {
    initializeDropzone();
    
    $(".buttonBrowseFile").off("click").on("click", function () {
        doBrowseButtonClick(this);
    });

    $("#modelEditPage_fileTemplate").on("htmldbrender", function (event) {
        doFileTemplateRender(this, event);
    });

    $("#modelEditPage_imageTemplate").on("htmldbrender", function (event) {
        doFileTemplateRender(this, event);
    });
}

function initializeDropzone() {
    var uploadURL = document.getElementById("dropzone-data").getAttribute("data-action");
    
    var dropzoneElements = $("div.divDropzone");
    var dropzoneElement = null;
    var dropzoneElementCount = dropzoneElements.length;
    var dropzoneObject = null;

    for (var i = 0; i < dropzoneElementCount; i++) {
        dropzoneElement = dropzoneElements[i];
        dropzoneObject = new Dropzone(dropzoneElement, {
            "url": uploadURL,
            "complete": function (fileObject) {
                var responseObject = JSON.parse(String(fileObject.xhr.responseText).trim());
                if (responseObject.errorCount > 0) {      
                    showErrorDialog(responseObject.lastError);
                } else {
                    selectUploadedFiles(responseObject.lastMessage);
                }
            }
        });

        dropzoneObject.on("sending", function(file, xhr, formData) {
            formData.append("target", document.getElementById("dropzone-data").getAttribute("data-target-field"));
            formData.append("media_type", document.getElementById("dropzone-data").getAttribute("data-media-type"));
        });
    }
}

function doFileTemplateRender(sender, event) {
    var targets = event.detail.targets;
    var target = null;
    var targetCount = targets.length;

    if (0 == targetCount) {
        return;
    }

    for (var i = 0; i < targetCount; i++) {
        target = document.getElementById(targets[i]);

        if (!target) {
            return;
        }

        if (target.children.length > 0) {
            $(".aDeleteFileListItem", target).off("click").on("click", function () {
                doDeleteFileListItemLinkClick(this);
            });

            $(target).sortable({
                    items: "li",
                    handle: ".grippy",
                    update: function (event, ui) {
                        updateFileListInput(this);
                    }
            });
            
            $(target).disableSelection();

            target.style.display = "block";
        }
    }
}
function selectUploadedFiles(file_data) {
    var fileData = file_data.split("#");
    var fileId = fileData[0];
    var fileName = fileData[1];
    var filePath = fileData[2];
    
    var mediaType = 1;
    var imageFileExtensions = ["jpg", "jpeg", "png", "gif"];
    var fileExtension = String(fileName.split('.').pop()).toLowerCase();
    if (imageFileExtensions.indexOf(fileExtension) != -1) {
        mediaType = 2;
    } else {
        mediaType = 1;
    }

    var targetFileListId = document.getElementById("dropzone-data").getAttribute("data-target-file-list");
    var targetFileList = document.getElementById(targetFileListId);
    var inputElement = document.getElementById(targetFileList.getAttribute("data-target-input-id"));
    var mediaType = inputElement.getAttribute("data-media-type");
    var maxFileCount = inputElement.getAttribute("data-max-file-count");
    var currentValue = HTMLDB.getInputValue(inputElement);
    var currentFileCount = 0;
    if ("" != currentValue) {
        var temp = currentValue.split(",");
        currentFileCount = temp.length;
    }

    if ((maxFileCount > 0) && (maxFileCount == currentFileCount)) {
        return false;
    }

    var innerElement = document.createElement('li');
    innerElement.id ="liFileListItem" + fileId;
    innerElement.className ="collection-item liMediaType" + mediaType;
    innerElement.setAttribute('data-object-id', fileId);
    innerElement.setAttribute('data-file-name', fileName);
    innerElement.setAttribute('data-file-path', filePath);
    innerElement.setAttribute('data-media-type', mediaType);

    var templateHTML = HTMLDB.e("ulFileListTemplate").innerHTML;
    templateHTML = templateHTML.replace(/__ID__/g, fileId);
    templateHTML = templateHTML.replace(/__MEDIA_TYPE__/g, mediaType);
    templateHTML = templateHTML.replace(/__FILE_NAME__/g, fileName);
    innerElement.innerHTML = templateHTML;

    targetFileList.appendChild(innerElement);

    updateFileListUL(targetFileList);
    updateFileListInput(targetFileList);
}
function updateFileListUL(targetFileList) {
    var imageFileExtensions = ["jpg", "jpeg", "png", "gif"];
    var elementLIList = $(">li", targetFileList);
    var elementLIListCount = elementLIList.length;
    var elementLI = null;
    var fileName = "";
    var filePath = "";
    var fileExtension = "";
    var imageFile = false;
    var src = "";

    $(".aDeleteFileListItem", targetFileList).off("click").on("click", function () {
        doDeleteFileListItemLinkClick(this);
    });

    for (var i = 0; i < elementLIListCount; i++) {
        elementLI = elementLIList[i];
        fileName = elementLI.getAttribute("data-file-name");
        filePath = elementLI.getAttribute("data-file-path");
        fileExtension = String(fileName.split('.').pop()).toLowerCase();
        
        if (imageFileExtensions.indexOf(fileExtension) != -1) {
            src = (__storageURL + filePath);
        } else {
            src = getDefaultImageSRC(fileExtension);
        }

        $(".imgFileListItemFileURL", elementLI).attr("src", src);
        $(".aFileListItemFileURL", elementLI).attr("href", (__storageURL + filePath));
    }

    if (elementLIListCount > 0) {
        targetFileList.style.display = "block";
        $(targetFileList).sortable({
                items: "li",
                handle: ".grippy",
                update: function (event, ui) {
                    updateFileListInput(this);
                }
        });
        
        $(targetFileList).disableSelection();
    } else {
        targetFileList.style.display = "none";
    }
}

function getDefaultImageSRC(extension) {
    return  (__publicAssetsURL + "adminlte/img/" + extension + ".png");
}

function doDeleteFileListItemLinkClick(element) {
    if (!element) {
        return;
    }

    var elementUL = element.parentNode.parentNode;

    $(element.parentNode).detach();

    if (0 == $(">li", elementUL).length) {
        elementUL.style.display = "none";
    }

    updateFileListInput(elementUL);
}
function updateFileListInputs() {

    var fileLists = $("#formObject .ulFileList");
    var fileListCount = fileLists.length;

    for (var i = 0; i < fileListCount; i++) {
        updateFileListInput(fileLists[i].getAttribute("id"));
    }

}
function updateFileListInput(targetFileList) {
    var targetFileListInputId = targetFileList.getAttribute("data-target-input-id");
    var targetFileListInput = document.getElementById(targetFileListInputId);

    targetFileListInput.value = "";

    var targetFileListItems = $(">li", targetFileList);
    var targetFileListItemCount = targetFileListItems.length;
    var targetFileListItem = null;
    var fileListInputValue = "";

    for (var i = 0; i < targetFileListItemCount; i++) {
        targetFileListItem = targetFileListItems[i];

        if (fileListInputValue != "") {
            fileListInputValue += ",";
        }

        fileListInputValue += targetFileListItem.getAttribute("data-object-id");
    }

    HTMLDB.setInputValue(targetFileListInput, fileListInputValue);
}

function doBrowseButtonClick(sender) {
    if (!sender) {
        return;
    }

    var targetFileListElementId = sender.getAttribute("data-target-file-list");
    var targetFileListElement = document.getElementById(targetFileListElementId);

    var targetInputElementId = targetFileListElement.getAttribute("data-target-input-id");
    var targetInputElement = document.getElementById(targetInputElementId)
    var targetField = targetInputElement.getAttribute("data-target-field");
    var mediaType = targetInputElement.getAttribute("data-media-type");

    document.getElementById("dropzone-data").setAttribute("data-target-file-list", targetFileListElement.id);
    document.getElementById("dropzone-data").setAttribute("data-target-field", targetField);
    document.getElementById("dropzone-data").setAttribute("data-media-type", mediaType);

    $("#divDropzone").trigger("click");
}
function humanFileSize (bytes, si) {
    var thresh = si ? 1000 : 1024;
    if(Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }
    var units = si
    ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
    : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
    var u = -1;
    do {
        bytes /= thresh;
        ++u;
    } while(Math.abs(bytes) >= thresh && u < units.length - 1);
    return bytes.toFixed(1)+' '+units[u];
}
function generateGUID(strPrefix) {
    var dtNow = new Date();
    var strToken0 = String(dtNow.getUTCFullYear())
    + String((dtNow.getUTCMonth() + 1))
    + String(dtNow.getUTCDate())
    + String(dtNow.getHours())
    + String(dtNow.getMinutes())
    + String(dtNow.getSeconds());
    var strToken1 = 'xxxx'.replace(/[xy]/g, function(c) {var r = Math.random()*16|0,v=c=='x'?r:r&0x3|0x8;return v.toString(16);});
    var strToken2 = 'xxxx'.replace(/[xy]/g, function(c) {var r = Math.random()*16|0,v=c=='x'?r:r&0x3|0x8;return v.toString(16);});  
    return strPrefix + strToken0 + strToken1 + strToken2;
}
