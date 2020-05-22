$(function(){
	initializeApplication();
    initializePage();
});
function initializePage() {
    initializeInputs();

    $("#buttonSave-formPreferences").off("click").on("click", function () {
    	saveFormPreferences();
    });

    $("#PreferenceHTMLDB").on("htmldbmessage", function (e) {
        if (e.detail.messageText == "UPDATED") {
        	AdminLteHTMLDB.sweetAlert("success", document.getElementById("divSaveMessage").innerHTML);
        	
        	/*setTimeout(function () {
                window.location.reload();
            }, 1000);*/
        }

        HTMLDB.hideLoader(HTMLDB.e("PreferenceHTMLDB"));
    });

    $("#PreferenceHTMLDB").on("htmldbread", function (e) {
    	setInputValues();
    });
}
function initializeInputs() {
	//checked: $('.main-header').hasClass('border-bottom-0')
	$("#formPreferences-main-header_border-bottom-0").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.main-header').addClass('border-bottom-0');
		} else {
			$('.main-header').removeClass('border-bottom-0');
		}
	});
	
	//checked: $('body').hasClass('text-sm')
	$("#formPreferences-body_text-sm").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('body').addClass('text-sm');
		} else {
			$('body').removeClass('text-sm');
		}
	});
	
	//checked: $('.main-header').hasClass('text-sm')
	$("#formPreferences-main-header_text-sm").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.main-header').addClass('text-sm');
		} else {
			$('.main-header').removeClass('text-sm');
		}
	});
	
	//checked: $('.nav-sidebar').hasClass('text-sm')
	$("#formPreferences-nav-sidebar_text-sm").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.nav-sidebar').addClass('text-sm');
		} else {
			$('.nav-sidebar').removeClass('text-sm');
		}
	});

	//checked: $('.main-footer').hasClass('text-sm')
	$("#formPreferences-main-footer_text-sm").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.main-footer').addClass('text-sm');
		} else {
			$('.main-footer').removeClass('text-sm');
		}
	});

	//checked: $('.nav-sidebar').hasClass('nav-flat')
	$("#formPreferences-nav-sidebar_nav-flat").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.nav-sidebar').addClass('nav-flat');
		} else {
			$('.nav-sidebar').removeClass('nav-flat');
		}
	});

	//checked: $('.nav-sidebar').hasClass('nav-legacy')
	$("#formPreferences-nav-sidebar_nav-legacy").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.nav-sidebar').addClass('nav-legacy');
		} else {
			$('.nav-sidebar').removeClass('nav-legacy');
		}
	});

	//checked: $('.nav-sidebar').hasClass('nav-compact')
	$("#formPreferences-nav-sidebar_nav-compact").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.nav-sidebar').addClass('nav-compact');
		} else {
			$('.nav-sidebar').removeClass('nav-compact');
		}
	});

	//checked: $('.nav-sidebar').hasClass('nav-child-indent')
	$("#formPreferences-nav-sidebar_nav-child-indent").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.nav-sidebar').addClass('nav-child-indent');
		} else {
			$('.nav-sidebar').removeClass('nav-child-indent');
		}
	});

	//checked: $('.main-sidebar').hasClass('sidebar-no-expand')
	$("#formPreferences-main-sidebar_sidebar-no-expand").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.main-sidebar').addClass('sidebar-no-expand');
		} else {
			$('.main-sidebar').removeClass('sidebar-no-expand');
		}
	});

	//checked: $('.brand-link').hasClass('text-sm')
	$("#formPreferences-brand-link_text-sm").off("click").on("click", function () {
		if ($(this).is(':checked')) {
			$('.brand-link').addClass('text-sm');
		} else {
			$('.brand-link').removeClass('text-sm');
		}
	});
	
	var navbar_dark_skins = [
		'navbar-primary',
		'navbar-secondary',
		'navbar-info',
		'navbar-success',
		'navbar-danger',
		'navbar-indigo',
		'navbar-purple',
		'navbar-pink',
		'navbar-navy',
		'navbar-lightblue',
		'navbar-teal',
		'navbar-cyan',
		'navbar-dark',
		'navbar-gray-dark',
		'navbar-gray'
	];

	var navbar_light_skins = [
		'navbar-light',
		'navbar-warning',
		'navbar-white',
		'navbar-orange'
	];
 
	var navbar_all_colors = navbar_dark_skins.concat(navbar_light_skins);
	var logo_skins = navbar_all_colors;

	$("#container_navbar_variants > div").off("click").on("click", function () {
		var $main_header = $('.main-header');

		// clean
		$main_header.removeClass('navbar-dark').removeClass('navbar-light');

		navbar_all_colors.map(function (color) {
			$main_header.removeClass(color)
		});
		
		// set
		var header_type = this.getAttribute("data-header-type");
		var color = this.getAttribute("data-color");

		$main_header.addClass(header_type).addClass(color);

		$("#formPreferences-navbar_variants").val((header_type + " " + color));
	});

	var sidebar_colors = [
		'bg-primary',
		'bg-warning',
		'bg-info',
		'bg-danger',
		'bg-success',
		'bg-indigo',
		'bg-lightblue',
		'bg-navy',
		'bg-purple',
		'bg-fuchsia',
		'bg-pink',
		'bg-maroon',
		'bg-orange',
		'bg-lime',
		'bg-teal',
		'bg-olive'
	];

	var accent_colors = [
		'accent-primary',
		'accent-warning',
		'accent-info',
		'accent-danger',
		'accent-success',
		'accent-indigo',
		'accent-lightblue',
		'accent-navy',
		'accent-purple',
		'accent-fuchsia',
		'accent-pink',
		'accent-maroon',
		'accent-orange',
		'accent-lime',
		'accent-teal',
		'accent-olive'
	];

	var sidebar_skins = [
		'sidebar-dark-primary',
		'sidebar-dark-warning',
		'sidebar-dark-info',
		'sidebar-dark-danger',
		'sidebar-dark-success',
		'sidebar-dark-indigo',
		'sidebar-dark-lightblue',
		'sidebar-dark-navy',
		'sidebar-dark-purple',
		'sidebar-dark-fuchsia',
		'sidebar-dark-pink',
		'sidebar-dark-maroon',
		'sidebar-dark-orange',
		'sidebar-dark-lime',
		'sidebar-dark-teal',
		'sidebar-dark-olive',
		'sidebar-light-primary',
		'sidebar-light-warning',
		'sidebar-light-info',
		'sidebar-light-danger',
		'sidebar-light-success',
		'sidebar-light-indigo',
		'sidebar-light-lightblue',
		'sidebar-light-navy',
		'sidebar-light-purple',
		'sidebar-light-fuchsia',
		'sidebar-light-pink',
		'sidebar-light-maroon',
		'sidebar-light-orange',
		'sidebar-light-lime',
		'sidebar-light-teal',
		'sidebar-light-olive'
	];
	
	$("#container_accent_variants > div").off("click").on("click", function () {
		var $body = $('body');

		// clean
		accent_colors.map(function (skin) {
			$body.removeClass(skin)
		})

		// set
		var color = this.getAttribute("data-color");

		$body.addClass(color);

		$("#formPreferences-accent_variants").val(color);
	});
	
	$("#container_sidebar_variants_dark > div").off("click").on("click", function () {
		var $sidebar = $('.main-sidebar');

		// clean
		sidebar_skins.map(function (skin) {
			$sidebar.removeClass(skin)
		})

		// set
		var color = this.getAttribute("data-color");
		var sidebar_class = 'sidebar-dark-' + color.replace('bg-', '');

		$sidebar.addClass(sidebar_class);

		$("#formPreferences-sidebar_variants").val(sidebar_class);
	});

	$("#container_sidebar_variants_light > div").off("click").on("click", function () {
		var $sidebar = $('.main-sidebar');

		// clean
		sidebar_skins.map(function (skin) {
			$sidebar.removeClass(skin)
		})

		// set
		var color = this.getAttribute("data-color");
		var sidebar_class = 'sidebar-light-' + color.replace('bg-', '');

		$sidebar.addClass(sidebar_class);

		$("#formPreferences-sidebar_variants").val(sidebar_class);
	});

	$("#container_logo_variants > div").off("click").on("click", function () {
		var $logo = $('.brand-link');

		// clean
		logo_skins.map(function (skin) {
			$logo.removeClass(skin)
		})

		// set
		var color = this.getAttribute("data-color");

		$logo.addClass(color);

		$("#formPreferences-logo_variants").val(color);
	});

	$("#clear_logo").off("click").on("click", function () {
		var $logo = $('.brand-link');

		// clean
		logo_skins.map(function (skin) {
			$logo.removeClass(skin)
		})

		$("#formPreferences-logo_variants").val("");
	});
}

function setInputValues() {
	var tableHTMLDB = HTMLDB.e("PreferenceHTMLDB");
	var object = HTMLDB.get(tableHTMLDB, 1);
	var preferences = JSON.parse(object["preferences_json"]);

	if (1 == preferences["main-header_border-bottom-0"]) {
		document.getElementById("formPreferences-main-header_border-bottom-0").checked = true;
	}

	if (1 == preferences["body_text-sm"]) {
		document.getElementById("formPreferences-body_text-sm").checked = true;
	}

	if (1 == preferences["main-header_text-sm"]) {
		document.getElementById("formPreferences-main-header_text-sm").checked = true;
	}

	if (1 == preferences["nav-sidebar_text-sm"]) {
		document.getElementById("formPreferences-nav-sidebar_text-sm").checked = true;
	}

	if (1 == preferences["main-footer_text-sm"]) {
		document.getElementById("formPreferences-main-footer_text-sm").checked = true;
	}

	if (1 == preferences["nav-sidebar_nav-flat"]) {
		document.getElementById("formPreferences-nav-sidebar_nav-flat").checked = true;
	}

	if (1 == preferences["nav-sidebar_nav-legacy"]) {
		document.getElementById("formPreferences-nav-sidebar_nav-legacy").checked = true;
	}

	if (1 == preferences["nav-sidebar_nav-compact"]) {
		document.getElementById("formPreferences-nav-sidebar_nav-compact").checked = true;
	}

	if (1 == preferences["nav-sidebar_nav-child-indent"]) {
		document.getElementById("formPreferences-nav-sidebar_nav-child-indent").checked = true;
	}

	if (1 == preferences["main-sidebar_sidebar-no-expand"]) {
		document.getElementById("formPreferences-main-sidebar_sidebar-no-expand").checked = true;
	}

	if (1 == preferences["brand-link_text-sm"]) {
		document.getElementById("formPreferences-brand-link_text-sm").checked = true;
	}

	document.getElementById("formPreferences-navbar_variants").value = preferences["navbar_variants"];
	document.getElementById("formPreferences-accent_variants").value = preferences["accent_variants"];
	document.getElementById("formPreferences-sidebar_variants").value = preferences["sidebar_variants"];
	document.getElementById("formPreferences-logo_variants").value = preferences["logo_variants"];
}
function saveFormPreferences() {
	HTMLDB.showLoader(HTMLDB.e("PreferenceHTMLDB"));

	var preferences = {};
	preferences["main-header_border-bottom-0"] = (document.getElementById("formPreferences-main-header_border-bottom-0").checked) ? 1 : 0;
	preferences["body_text-sm"] = (document.getElementById("formPreferences-body_text-sm").checked) ? 1 : 0;
	preferences["main-header_text-sm"] = (document.getElementById("formPreferences-main-header_text-sm").checked) ? 1 : 0;
	preferences["nav-sidebar_text-sm"] = (document.getElementById("formPreferences-nav-sidebar_text-sm").checked) ? 1 : 0;
	preferences["main-footer_text-sm"] = (document.getElementById("formPreferences-main-footer_text-sm").checked) ? 1 : 0;
	preferences["nav-sidebar_nav-flat"] = (document.getElementById("formPreferences-nav-sidebar_nav-flat").checked) ? 1 : 0;
	preferences["nav-sidebar_nav-legacy"] = (document.getElementById("formPreferences-nav-sidebar_nav-legacy").checked) ? 1 : 0;
	preferences["nav-sidebar_nav-compact"] = (document.getElementById("formPreferences-nav-sidebar_nav-compact").checked) ? 1 : 0;
	preferences["nav-sidebar_nav-child-indent"] = (document.getElementById("formPreferences-nav-sidebar_nav-child-indent").checked) ? 1 : 0;
	preferences["main-sidebar_sidebar-no-expand"] = (document.getElementById("formPreferences-main-sidebar_sidebar-no-expand").checked) ? 1 : 0;
	preferences["brand-link_text-sm"] = (document.getElementById("formPreferences-brand-link_text-sm").checked) ? 1 : 0;
	preferences["navbar_variants"] = document.getElementById("formPreferences-navbar_variants").value;
	preferences["accent_variants"] = document.getElementById("formPreferences-accent_variants").value;
	preferences["sidebar_variants"] = document.getElementById("formPreferences-sidebar_variants").value;
	preferences["logo_variants"] = document.getElementById("formPreferences-logo_variants").value;

	var tableHTMLDB = HTMLDB.e("PreferenceHTMLDB");
	var object = HTMLDB.get(tableHTMLDB, 1);
	object["preferences_json"] = JSON.stringify(preferences);
	HTMLDB.update(tableHTMLDB, 1, object);
}
