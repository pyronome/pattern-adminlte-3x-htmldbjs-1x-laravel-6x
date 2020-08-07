var AdminLteHTMLDB = {
	"initialize": function () {
		AdminLteHTMLDB.initializeHTMLDBEvents();
	},
	"validate": function () {
		if (!document.getElementById("divErrorDialog")) {
			throw (new Error("Sprit Panel HTMLDB error dialog not found."));
			return false;
		}
	},
	"initializeHTMLDBEvents": function () {
		$(".htmldb-table").on("htmldberror", function (event) {
			AdminLteHTMLDB.showError(event);
		});

		$(".htmldb-template").on("htmldbrender", function (event) {
			AdminLteHTMLDB.doTemplateRender(this, event);
		});

		$(".htmldb-button-edit").on("click", function (event) {
			AdminLteHTMLDB.showEditDialog(this, event);
		});

		$(".htmldb-button-save").on("htmldbsave", function (event) {
			AdminLteHTMLDB.doSave(this);
		});

		$(".htmldb-button-add").on("click", function (event) {
			AdminLteHTMLDB.showEditDialog(this, event);
		});

		/*$("select.htmldb-field").on("htmldbsetvalue", function (event) {
	        AdminLteHTMLDB.updateSelectElements(this, event);
	    });

		$("select.htmldb-field").on("htmldbreset", function (event) {
			AdminLteHTMLDB.doSelectizeReset(this, event);
		});

		$("select.htmldb-field").on("htmldbaddoptionclick", function (event) {
			AdminLteHTMLDB.showEditDialog(this, event);
		});*/
		
		/////////////////////////////
		/////////////////////////////
		///// Yeni Eklediklerim /////
		/////////////////////////////
		/////////////////////////////

		$(".htmldb-buffersize").on("change", function (event) {
			AdminLteHTMLDB.changeBufferSize(this, event);
		});

		AdminLteHTMLDB.initializeSelect2HasOption();

		$("select.htmldb-field").on("htmldbsetoptions", function (event) {
			AdminLteHTMLDB.initializeSelect2Selects();
		});

		$("select.htmldb-select2.htmldb-field").on("htmldbsetvalue", function (event) {
			AdminLteHTMLDB.updateSelectElements(this, event);
		});

		$(".htmldb-editor.htmldb-field").on("htmldbsetvalue", function (event) {
			AdminLteHTMLDB.initializeTextEditor(this, event);
		});

		$(".htmldb-switch.htmldb-field").on("htmldbsetvalue", function (event) {
			AdminLteHTMLDB.updateSwitch(this, event);
		});

		$(".htmldb-datepicker.htmldb-field").on("htmldbsetvalue", function (event) {
			AdminLteHTMLDB.initializeDatepicker(this, event);
		});

		$(".htmldb-datetimepicker.htmldb-field").on("htmldbsetvalue", function (event) {
			AdminLteHTMLDB.initializeDatetimepicker(this, event);
		});

		$(".htmldb-timepicker.htmldb-field").on("htmldbsetvalue", function (event) {
			AdminLteHTMLDB.initializeTimepicker(this, event);
		});

		$(".htmldb-masked.htmldb-field").on("htmldbsetvalue", function (event) {
			AdminLteHTMLDB.initializeMaskedInputs(this, event);
		});

		$(".htmldb-location.htmldb-field").on("htmldbsetvalue", function (event) {
			AdminLteHTMLDB.updateLocationPicker(this, event);
		});

		$(".htmldb-hint").tooltip();

		$("#editPermissionTemplate").on("htmldbrender", function (event) {
			AdminLteHTMLDB.initializePermission();
		});
	},
	"doTemplateRender": function (sender, event) {
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

			$(".htmldb-button-edit", target)
				.off("click.adminltehtmldb")
				.on("click.adminltehtmldb", function (event) {
					AdminLteHTMLDB.showEditDialog(this, event);
				});

			$(".htmldb-button-save", target)
				.off("htmldbsave.adminltehtmldb")
				.on("htmldbsave.adminltehtmldb", function (event) {
					AdminLteHTMLDB.doSave(this);
				});

			$(".htmldb-button-add", target)
				.off("click.adminltehtmldb")
				.on("click.adminltehtmldb", function (event) {
					AdminLteHTMLDB.showEditDialog(this, event);
				});

			$(".trAction", target)
				.off("click.adminltehtmldb")
				.on("click.adminltehtmldb", function (e) {
					AdminLteHTMLDB.doActionTableRowClick(this, e);
				});

			/*AdminLteHTMLDB.initializeTableCheckbox(target);*/
			/*AdminLteHTMLDB.showTableTools(target);*/
		}		
	},
	"doSelectizeSetValue": function (sender, event) {
		if (sender.selectize) {
			sender.selectize.clear(true);
			if (undefined == sender.attributes["multiple"]) {
				sender.selectize.setValue(event.detail.value);
			} else {
				var selections = String(event.detail.value).split(",");
				var selectionCount = selections.length;
				for (var i = 0; i < selectionCount; i++) {
					sender.selectize.addItem(selections[i]);
				}
			}
		}
	},
	"doSelectizeReset": function (sender, event) {
		if (sender.selectize) {
			sender.selectize.clear(true);
		}
		if (event.detail.value != "") {
			AdminLteHTMLDB.doSelectizeSetValue(sender, event);
		}
	},
	"showError": function (event) {
		AdminLteHTMLDB.sweetAlert("error", event.detail.errorText); 
		/*showErrorDialog();*/
	},
	"showEditDialog": function (sender, event) {
		var form = null;
		var dialog = null;

		form = AdminLteHTMLDB.extractElementForm(sender);

		if (!form) {
			return false;
		}

		dialog = AdminLteHTMLDB.extractFormDialog(form);

		if (dialog) {
			showDialog(dialog.id);
		}
	},
	"extractElementForm": function (element) {
		if (!element) {
			return false;
		}

		var formId = "";
		var form = null;
		var tagName = element.tagName.toLowerCase();

		if (("button" == tagName) || ("a" == tagName)) {
			formId = HTMLDB.getHTMLDBParameter(element, "form");
			if ("" == formId) {
				form = HTMLDB.exploreHTMLDBForm(element);
				formId = form.getAttribute("id");
			}
		} else if ("select" == tagName) {
			if ("" == HTMLDB.getHTMLDBParameter(element, "add-option-form")) {
				throw (new Error("Select add option form not specified."));
				return false;
			}
			formId = HTMLDB.getHTMLDBParameter(element, "add-option-form");
		}

		var form = document.getElementById(formId);

		if (!form) {
			throw (new Error(tagName + " target form " + formId + " not found."));
			return false;
		}

		return form;
	},
	"extractFormDialog": function (form) {
		if (!form) {
			return false;
		}

		var parent = form.parentNode;

		while ((!parent.classList.contains("htmldb-dialog-edit"))
			&& (parent.tagName.toLowerCase() != "body")) {
			parent = parent.parentNode;
		}

		if (!parent.classList.contains("htmldb-dialog-edit")) {
			return false;
		}

		return parent;
	},
	"doSave": function (sender) {
		if (!sender) {
			return false;
		}

		var form = null;
		var modal = null;
		var tableId = "";
		var table = null;

		$(sender).addClass("disabled");

		form = AdminLteHTMLDB.extractElementForm(sender);

		if (!form) {
			return false;
		}

		tableId = HTMLDB.getHTMLDBParameter(form, "table");

		if ("" == tableId) {
			return false;
		}

		table = document.getElementById(tableId);

		if (HTMLDB.getHTMLDBParameter(table, "redirect") != "") {
			return true;
		}

		$(sender).removeClass("disabled");

		var closeOnSave = true;

		if ("0" == sender.getAttribute("data-close-on-save")) {
			closeOnSave = false;
		}

		if (closeOnSave) {
			modal = AdminLteHTMLDB.extractFormDialog(form);

			if (modal) {
				$(modal).modal("hide");
			}
		}
	},
	/*"renderSelectElement": function (sender, event) {
		if (!sender) {
			return false;
		}

		var initialValue = undefined;

		if (sender.selectize) {
			initialValue = sender.selectize.getValue();
			sender.selectize.destroy();
		}

		var initialOptions = [];
		var initialOption = null;
		var initialOptionCount = 0;

		if (undefined !== sender.HTMLDBInitials) {
			if (undefined !== sender.HTMLDBInitials.content) {
				sender.innerHTML = sender.HTMLDBInitials.content;
			} else if (undefined !== sender.HTMLDBInitials.initialOptions) {
				initialOptions = sender.HTMLDBInitials.initialOptions;
				initialOptionCount = initialOptions.length;
				for (var i = 0; i < initialOptionCount; i++) {
					initialOption = initialOptions[i];
					sender.options[sender.options.length]
						= new Option(initialOption.text,
							initialOption.value);
				}
			}
		}

		if (sender.multiple) {

			$(sender).selectize({
				preload: false,
				plugins: ["remove_button"],
				create: true,
				createFilter: function (input) {
					return false;
				},
				onChange: function (value) {
					AdminLteHTMLDB.doSelectizeChange(sender, value);
				}
			});

			if ($(".selectize-input.items", sender.parentNode).hasClass("ui-sortable")) {
				$(".selectize-input.items", sender.parentNode).sortable("destroy");
			}

			$(".selectize-input.items", sender.parentNode).sortable({
				axis: "x",
				opacity: 0.7,
				placeholder: "item"
			});

		} else {

			$(sender).selectize({
				preload: false,
				create: false,
				onChange: function (value) {
					AdminLteHTMLDB.doSelectizeChange(sender, value);
				}
			});

		}

		if (initialValue !== undefined) {
			sender.selectize.setValue(initialValue, false);
		}

	},
	"doSelectizeChange": function (sender, value) {
		var form = HTMLDB.extractToggleParentElement(sender);
		var field = HTMLDB.getHTMLDBParameter(sender, "field");
		HTMLDB.doActiveElementToggle(form);
		HTMLDB.doActiveFormFieldUpdate(form, field);
		sender.dispatchEvent(new CustomEvent(
			"change",
			{ detail: {} }));
	},*/
	"doActionTableRowClick": function (sender, e) {
		var parent = e.target.parentNode;

		if (!parent) {
			return false;
		}

		if (undefined != parent.actionTableRowClicked
			&& parent.actionTableRowClicked) {
			return false;
		}

		if (!parent.classList.contains("trAction")) {
			return false;
		}

		parent.actionTableRowClicked = true;

		var actionButtons = $(".buttonTableRowAction", parent);
		var actionButtonCount = actionButtons.length;
		var actionButton = null;

		if (actionButtonCount > 0) {
			actionButton = actionButtons[0];

			if (actionButton.tagName.toLowerCase() == "a") {
				actionButton.click();
			} else if ((actionButton.tagName.toLowerCase() == "button")) {
				var clickEvent = document.createEvent("HTMLEvents");
				clickEvent.initEvent("click", true, false);
				actionButton.dispatchEvent(clickEvent);
			} else if (actionButton.tagName.toLowerCase() == "input") {
				if ((actionButton.type.toLowerCase() == "checkbox")
					|| (actionButton.type.toLowerCase() == "checkbox")) {
					actionButton.checked = !actionButton.checked;
				}
			}

			setTimeout(function () {
				parent.actionTableRowClicked = false;
			}, 1000);
		}
	},
	"initializeTableCheckbox": function (templateElement) {
		var tbodyId = templateElement.getAttribute("data-htmldb-template-target");
		var tbodyElement = HTMLDB.e(tbodyId);

		if (0 == $("tr", tbodyElement).length) {
			return;
		}

		var tableElement = tbodyElement.parentNode;

		if (!($(tableElement).hasClass("checkbox-table"))) {
			return;
		}
		
		if (!document.getElementById(tbodyId + "-select_all_row")) {
			return;
		}
		
		var checkAllElement = document.getElementById(tbodyId + "-select_all_row");
		$(checkAllElement).prop("checked", false);
		
		$(checkAllElement).off("click").on("click", function () {
			AdminLteHTMLDB.doCheckAllCheckboxClick(this);
		});

		var modelName = checkAllElement.getAttribute("data-model");
		
		var csvInputSelectorText = "#formDelete" + modelName + "-idcsv";
		$(csvInputSelectorText).on("htmldbsetvalue", function (e) {
	        AdminLteHTMLDB.updateMultipleDeleteForm();
	    });
		
		var buttonSelectorText = "#buttonDelete" + modelName;
		$(buttonSelectorText).on("click", function () {
			AdminLteHTMLDB.doActionButtonClick(this);
		});	
		
		var saveButtonSelectorText = "#buttonSave-formDelete" + modelName;
		$(saveButtonSelectorText).on("click", function () {
			AdminLteHTMLDB.saveMultipleDelete(this);
		});
		
		var deleteModalId = "modal-formDelete" + modelName;
		var deleteHTMLDBSelectorText = "#Delete" + modelName + "HTMLDB";
		$(deleteHTMLDBSelectorText).on("htmldbmessage", function (e) {
			if (e.detail.messageText == "UPDATED") {
	        	hideDialog(deleteModalId);
	        }
	    });

		$(".select_row", tbodyElement).off("click").on("click", function () {
			AdminLteHTMLDB.doCheckboxClick(this);
		});
	},
	"doActionButtonClick": function(sender) {
		if (!sender) {
	        return;
	    }
		
		var tbodyElement = document.getElementById(sender.getAttribute("data-tbody-id"));
		var modelName = sender.getAttribute("data-model");
	    var idcsv = "";

	    var selectedCheckboxes = $(".select_row:checked", tbodyElement);
	    var selectedCount = selectedCheckboxes.length;

	    for (var i = 0; i < selectedCount; i++) {
	    	if ("" != idcsv) {
	    		idcsv += ",";
	    	}

	    	idcsv += selectedCheckboxes[i].getAttribute("data-object-id");
	    }

	    document.getElementById("formDelete" + modelName + "-idcsv").value = idcsv;

	    var modelTables = AdminLteHTMLDB.getModelTables(modelName);
	    document.getElementById("Delete" + modelName + "HTMLDB").setAttribute("data-refresh-table", modelTables);

	    showDialog("modal-formDelete" + modelName);
	},
	"saveMultipleDelete": function(sender) {
		var modelName = sender.getAttribute("data-model");
		var tableHTMLDB = HTMLDB.e("Delete" + modelName + "HTMLDB");
		var object = {};
		object["id"] = 0;
		object["idcsv"] = document.getElementById("formDelete" + modelName + "-idcsv").value;
		HTMLDB.insert(tableHTMLDB, object);
	},
	"doCheckAllCheckboxClick": function(sender) {
	    if (!sender) {
	        return;
	    }
		
		var model = sender.getAttribute("data-model");
		var tbodyElement = document.getElementById("tbody" + model + "RecordList");

	    $(".select_row", tbodyElement).prop("checked", sender.checked);

	    AdminLteHTMLDB.updateCheckboxStates(sender, model);
	},
	"doCheckboxClick": function(sender) {
	    if (!sender) {
	        return;
	    }
		
		var model = sender.getAttribute("data-model");
	    var checkAllElement = document.getElementById("tbody" + model + "RecordList-select_all_row");
	    AdminLteHTMLDB.updateCheckboxStates(checkAllElement, model);
	},
	"updateCheckboxStates": function(checkAllElement, model) {
		var tbodyElement = document.getElementById("tbody" + model + "RecordList");
		var buttonNew = document.getElementById("buttonNew" + model);
		var buttonDelete = document.getElementById("buttonDelete" + model);

		var checkboxCount = $(".select_row", tbodyElement).length;
		var selectedCount = $(".select_row:checked", tbodyElement).length;
		
		if (0 == selectedCount) {
	        $(checkAllElement).prop("checked", false);
	        
	        $(buttonDelete).hide();
	        $(buttonNew).show();
	    } else {
	    	$(".selected-count", buttonDelete).html(selectedCount);
			
			$(buttonNew).hide();
	    	$(buttonDelete).show();

	    	if (selectedCount == checkboxCount) {
	    		$(checkAllElement).prop("checked", true);
	    	} else {
	    		$(checkAllElement).prop("checked", false);
	    	}
	    }
	},
	"getModelTables": function(model) {
		var modelTables = "";

		if (document.getElementById(model + "InfoboxHTMLDB")) {
			if ("" != modelTables) {
				modelTables += ",";
			}

			modelTables += (model + "InfoboxHTMLDB");
		}

		if (document.getElementById(model + "RecordGraphHTMLDB")) {
			if ("" != modelTables) {
				modelTables += ",";
			}

			modelTables += (model + "RecordGraphHTMLDB");
		}

		if (document.getElementById(model + "HTMLDB")) {
			if ("" != modelTables) {
				modelTables += ",";
			}

			modelTables += (model + "HTMLDB");
		}

		if (document.getElementById("Session" + model + "HTMLDB")) {
			if ("" != modelTables) {
				modelTables += ",";
			}

			modelTables += ("Session" + model + "HTMLDB");
		}

		return modelTables;
	},
	"changeBufferSize": function (sender, event) {
		var tableId = sender.getAttribute("data-htmldb-table");
		var tableHTMLDB = HTMLDB.e(tableId);
		var sessionObject = HTMLDB.get(tableHTMLDB, 1);
		sessionObject["bufferSize"] = sender.value;
		HTMLDB.update(tableHTMLDB, 1, sessionObject);

		HTMLDB.updateReadQueueWithParameter(sender, "refresh-table");
	},
	"initializeSelect2HasOption": function(parent) {
		if (!parent) {
			parent = document.body;
		}
		var selects = $("select.htmldb-select2.htmldb-field.select-has-option", parent);
		var selectCount = selects.length;
		var select = null;
		
		for (var i = 0; i < selectCount; i++) {
			select = selects[i];
			$(select).select2().on("change", function(e){
				AdminLteHTMLDB.doSelect2Change(this);
			});
		}
	},
	"initializeSelect2Selects": function(parent) {
		if (!parent) {
			parent = document.body;
		}
		var selects = $(".htmldb-select2", parent);
		var selectCount = selects.length;
		var select = null;
		var parentId = "";
		var options = {};

		for (var i = 0; i < selectCount; i++) {
			select = selects[i];
			options = {
	        	escapeMarkup: function (text) { return text; },
	    	}
			parentId = $(select).attr("data-select2-parent");
			if (parentId !== undefined) {
				options.dropdownParent = $(document.getElementById(parentId));
			}
			$(select).select2(options).on("change", function(e){
				AdminLteHTMLDB.doSelect2Change(this);
			});
		}
	},
	"doSelect2Change": function (sender) {
		var form = HTMLDB.extractToggleParentElement(sender);
		var field = HTMLDB.getHTMLDBParameter(sender, "field");
		HTMLDB.doActiveElementToggle(sender);
		HTMLDB.doActiveFormFieldUpdate(form, field);
	},
	"updateSelectElements": function(sender, event) {
		var values = event.detail.value.split(",");
		$(sender).val(values);
		$(sender).trigger("change");
	},
	"initializeTextEditor": function() {
		$(".textarea.htmldb-field").summernote({
			"font-styles": false,
		  	"height": 150,
		  	codemirror: {
		    	theme: "monokai"
		    }
		});
		
		// editor içeriği yenilenmiyorsa aşağıdaki denenebilir
		/*$(sender).summernote({
			"font-styles": false,
		  	"height": 150,
		  	codemirror: {
		    	theme: "monokai"
		    }
		});

		$(sender).summernote("code", event.detail.value);*/
	},
	"updateSwitch": function(sender, event) {
		$(sender).bootstrapSwitch("state", (1 == event.detail.value));
		$(".fake-switch-container").hide();
	},
	"initializeDatepicker": function(sender, event) {
		$(sender).daterangepicker({
		    singleDatePicker: true,
		    locale: {
				format: "YYYY-MM-DD"
			}
		});
	},
	"initializeDatetimepicker": function(sender, event) {
		$(sender).daterangepicker({
			singleDatePicker: true,
			timePicker: true,
			timePicker24Hour: true,
			locale: {
				format: "YYYY-MM-DD HH:mm"
			}
		});
	},
	"initializeTimepicker": function(sender, event) {
		$(sender.getAttribute("data-target")).datetimepicker({
			format: "HH:mm"
		});
	},
	"initializeMaskedInputs": function(sender, event) {
		$(sender).inputmask()
	},
	"updateLocationPicker": function(sender, event) {
		var senderId = sender.id;
		var currentLatitude = 41.015;
		var currentLongitude = 28.979;
	    var mapElement = document.getElementById(senderId + "-MapObject");

		if (sender.value != "") {
			coordinates = String(sender.value).split(",");
			if (2 == coordinates.length) {
	            currentLatitude = parseFloat(coordinates[0]);
	            currentLongitude = parseFloat(coordinates[1]);
			}
		}

        var tmRefreshTimer = $(mapElement).data("tmRefreshTimer");
        clearTimeout(tmRefreshTimer);
        tmRefreshTimer = setTimeout(function () {
            google.maps.event.trigger(mapElement, "resize");

            document.getElementById(senderId + "-Latitude").value = currentLatitude;
            document.getElementById(senderId + "-Longitude").value = currentLongitude;

	        $(mapElement).locationpicker({
		        location: {
		            latitude: currentLatitude,
		            longitude: currentLongitude
		        },
		        radius: 100,
		        inputBinding: {
		            latitudeInput: $(document.getElementById(senderId+ "-Latitude")),
		            longitudeInput: $(document.getElementById(senderId+ "-Longitude")),
		            locationNameInput: $(document.getElementById(senderId+ "-Address"))
		        },
		        enableAutocomplete: true,
		        onchanged: function (currentLocation, radius, isMarkerDropped) {
		            sender.value = currentLocation.latitude + "," + currentLocation.longitude;
		        }
		    });
        }, 100);

        $(mapElement).data("tmRefreshTimer", tmRefreshTimer);
	},
	"showGoogleMap": function(sender) {
		var lat = parseFloat(sender.getAttribute("data-lat"));
        var lng = parseFloat(sender.getAttribute("data-lng"));
        var place = {lat: lat, lng: lng};

        // The map, centered at Uluru
        var map = new google.maps.Map(sender, {zoom: 16, center: place});

        // The marker, positioned at Uluru
        var marker = new google.maps.Marker({position: place, map: map});
	},
	"sweetAlert": function(type, msg) {
		switch (type) {
			case "success": toastr.success(msg); break;
			case "info": toastr.info(msg); break;
			case "error":
				/*toastr.options.closeButton = true;*/
				toastr.options.timeOut = 0;
				toastr.options.extendedTimeOut = 0;
				toastr.error(msg);
				break;
			case "warning": toastr.warning(msg); break;
		}
	},
	"initializePermission": function() {
		if (!document.getElementById("editPermission")) {
			return;
		}
		
		var inputs = $("input", document.getElementById("editPermission"));
		if (0 == inputs.length) {
			return;
		}

		var input = inputs[0];

		if (1 == input.value) {
			$(".show_by_permission").removeClass("show_by_permission");
		} else {
			$(".show_by_permission").remove();
		}

		var widgetPermission = parseInt(HTMLDB.e("__pagepermissionHTMLDB_reader_td1widget_permission").innerHTML);

		if (0 == widgetPermission) {
			$("#buttonWidgetConfig").detach();
			$("#modal-WidgetList").detach();
		} else {
			$("#buttonWidgetConfig").show();
		}
	},	
	"doShowBigPhotoClick": function(sender) {	
		if (!sender) {	
			return;	
		}	
		document.getElementById("popup-photo").src = sender.src;	
		showDialog("galleryModal");	
	}
}
AdminLteHTMLDB.initialize();
