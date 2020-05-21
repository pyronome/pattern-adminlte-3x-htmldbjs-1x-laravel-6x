@include('adminlte.head')
<body class="sidebar-mini layout-fixed control-sidebar-slide-open {{ $customization['body'] }}" data-url-prefix="" data-page-url="general_settings">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('General Settings') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('General Settings') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="card card-primary">
                                <form id="formConfiguration"  onsubmit="return false;" class="card-body text-sm htmldb-form htmldb-section" data-htmldb-table="ConfigurationHTMLDB">
                                    <input type="hidden"
                                        id="id"
                                        name="id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        data-htmldb-value="@{{id}}">
                                    <input type="hidden"
                                        id="debug_mode"
                                        name="debug_mode"
                                        class="htmldb-field"
                                        data-htmldb-field="debug_mode"
                                        data-htmldb-value="@{{debug_mode}}">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="project_title" class="detail-label">{{ __('Project Title') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="project_title"
                                                name="project_title"
                                                data-htmldb-field="project_title"
                                                data-htmldb-value="@{{project_title}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="main_folder" class="detail-label">{{ __('Main Folder') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="main_folder"
                                                name="main_folder"
                                                data-htmldb-field="main_folder"
                                                data-htmldb-value="@{{main_folder}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="landing_page" class="detail-label">{{ __('Landing Page') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="landing_page"
                                                name="landing_page"
                                                data-htmldb-field="landing_page"
                                                data-htmldb-value="@{{landing_page}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="default_language" class="detail-label">{{ __('Default Language') }}</label>
                                            <select data-placeholder="{{ __('Please Select') }}"
                                                id="default_language"
                                                name="default_language"
                                                class="form-control htmldb-select2 htmldb-field htmldb-select"
                                                data-htmldb-option-table="LanguageHTMLDB"
                                                data-htmldb-option-value="@{{iso}}"
                                                data-htmldb-option-title="@{{name}}"
                                                data-htmldb-field="default_language"
                                                data-htmldb-value="@{{default_language}}"
                                                style="width: 100%;">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="timezone" class="detail-label">{{ __('Timezone') }}</label>
                                            <select data-placeholder="{{ __('Please Select') }}"
                                                id="timezone"
                                                name="timezone"
                                                class="form-control htmldb-select2 htmldb-field htmldb-select"
                                                data-htmldb-option-table="TimezoneHTMLDB"
                                                data-htmldb-option-value="@{{timezone}}"
                                                data-htmldb-option-title="@{{timezone}}"
                                                data-htmldb-field="timezone"
                                                data-htmldb-value="@{{timezone}}"
                                                style="width: 100%;">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="date_format" class="detail-label">{{ __('Date Format') }}</label>
                                            <select data-placeholder="{{ __('Please Select') }}"
                                                id="date_format"
                                                name="date_format"
                                                class="form-control htmldb-select2 htmldb-field select-has-option"
                                                data-htmldb-field="date_format"
                                                data-htmldb-value="@{{date_format}}"
                                                style="width: 100%;">
                                                <option value="d/m/Y">15/06/1981</option>
                                                <option value="j/n/Y">15/6/1981</option>
                                                <option value="d/m/y">15/06/81</option>
                                                <option value="j/n/y">15/6/81</option>
                                                <option value="d-m-Y">15-06-1981</option>
                                                <option value="j-n-Y">15-6-1981</option>
                                                <option value="d-m-y">15-06-81</option>
                                                <option value="j-n-y">15-6-81</option>
                                                <option value="d.m.Y">15.06.1981</option>
                                                <option value="j.n.Y">15.6.1981</option>
                                                <option value="d.m.y">15.06.81</option>
                                                <option value="j.n.y">15.6.81</option>
                                                <option value="m/d/Y">06/15/1981</option>
                                                <option value="n/j/Y">6/15/1981</option>
                                                <option value="m/d/y">06/15/81</option>
                                                <option value="n/j/y">6/15/81</option>
                                                <option value="m-d-Y">06-15-1981</option>
                                                <option value="n-j-Y">6-15-1981</option>
                                                <option value="m-d-y">06-15-81</option>
                                                <option value="n-j-y">6-15-81</option>
                                                <option value="m.d.Y">06.15.1981</option>
                                                <option value="n.j.Y">6.15.1981</option>
                                                <option value="m.d.y">06.15.81</option>
                                                <option value="n.j.y">6.15.81</option>
                                                <option value="Y/m/d">1981/06/15</option>
                                                <option value="Y/n/j">1981/6/15</option>
                                                <option value="y/m/d">81/06/15</option>
                                                <option value="y/n/j">81/6/15</option>
                                                <option value="Y-m-d">1981-06-15</option>
                                                <option value="Y-n-j">1981-6-15</option>
                                                <option value="y-m-d">81-06-15</option>
                                                <option value="y-n-j">81-6-15</option>
                                                <option value="Y.m.d">1981.06.15</option>
                                                <option value="Y.n.j">1981.6.15</option>
                                                <option value="y.m.d">81.06.15</option>
                                                <option value="y.n.j">81.6.15</option>
                                                <option value="j F Y">{{ __('15 June 1981') }}</option>
                                                <option value="j F y">{{ __('15 June 81') }}</option>
                                                <option value="j M Y">{{ __('15 Jun 1981') }}</option>
                                                <option value="j M y">{{ __('15 Jun 81') }}</option>
                                                <option value="F j, Y">{{ __('June 15, 1981') }}</option>
                                                <option value="F j, y">{{ __('June 15, 81') }}</option>
                                                <option value="F j, Y">{{ __('Jun 15, 1981') }}</option>
                                                <option value="M j, y">{{ __('Jun 15, 81') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="year_month_format" class="detail-label">{{ __('Year Month Format') }}</label>
                                            <select data-placeholder="{{ __('Please Select') }}"
                                                id="year_month_format"
                                                name="year_month_format"
                                                class="form-control htmldb-select2 htmldb-field select-has-option"
                                                data-htmldb-field="year_month_format"
                                                data-htmldb-value="@{{year_month_format}}"
                                                style="width: 100%;">
                                                <option value="m/Y">06/1981</option>
                                                <option value="n/Y">6/1981</option>
                                                <option value="m/y">06/81</option>
                                                <option value="n/y">6/81</option>
                                                <option value="m-Y">06-1981</option>
                                                <option value="n-Y">6-1981</option>
                                                <option value="m-y">06-81</option>
                                                <option value="n-y">6-81</option>
                                                <option value="m.Y">06.1981</option>
                                                <option value="n.Y">6.1981</option>
                                                <option value="m.y">06.81</option>
                                                <option value="n.y">6.81</option>
                                                <option value="Y/m">1981/06</option>
                                                <option value="Y/n">1981/6</option>
                                                <option value="y/m">81/06</option>
                                                <option value="y/n">81/6</option>
                                                <option value="Y-m">1981-06</option>
                                                <option value="Y-n">1981-6</option>
                                                <option value="y-m">81-06</option>
                                                <option value="y-n">81-6</option>
                                                <option value="Y.m">1981.06</option>
                                                <option value="Y.n">1981.6</option>
                                                <option value="y.m">81.06</option>
                                                <option value="y.n">81.6</option>
                                                <option value="F Y">{{ __('June 1981') }}</option>
                                                <option value="F y">{{ __('June 81') }}</option>
                                                <option value="M Y">{{ __('Jun 1981') }}</option>
                                                <option value="M y">{{ __('Jun 81') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="time_format" class="detail-label">{{ __('Time Format') }}</label>
                                            <select data-placeholder="{{ __('Please Select') }}"
                                                id="time_format"
                                                name="time_format"
                                                class="form-control htmldb-select2 htmldb-field select-has-option"
                                                data-htmldb-field="time_format"
                                                data-htmldb-value="@{{time_format}}"
                                                style="width: 100%;">
                                                <option value="H:i">17:00</option>
                                                <option value="h:i a">05:00 pm</option>
                                                <option value="H:i:s">17:00:00</option>
                                                <option value="h:i:s a">05:00:00 pm</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="number_format" class="detail-label">{{ __('Number Format') }}</label>
                                            <select data-placeholder="{{ __('Please Select') }}"
                                                id="number_format"
                                                name="number_format"
                                                class="form-control htmldb-select2 htmldb-field select-has-option"
                                                data-htmldb-field="number_format"
                                                data-htmldb-value="@{{number_format}}"
                                                style="width: 100%;">
                                                <option value="tr">1.000.000,00</option>
                                                <option value="en">1,000,000.00</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="google_maps_api_key" class="detail-label">{{ __('Google Maps API Key') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="google_maps_api_key"
                                                name="google_maps_api_key"
                                                data-htmldb-field="google_maps_api_key"
                                                data-htmldb-value="@{{google_maps_api_key}}">
                                        </div>
                                    </div>
                                </form>

                                <div class="card-footer show_by_permission">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <button type="button"
                                            id="buttonSave-formConfiguration"
                                            name="buttonSave-formConfiguration"
                                            class="btn btn-success btn-md btn-on-table float-right htmldb-button-save"
                                            data-htmldb-form="formConfiguration">
                                            <i class="far fa-save" aria-hidden="true"></i> {{ __('Save') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('adminlte.footer')

    <div id="LanguageHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/general_settings/get_languages?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>
    
    <div id="TimezoneHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="2"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/general_settings/get_timezones?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>

    <div id="ConfigurationHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="5"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/general_settings/get?_token={{ csrf_token() }}"
        data-htmldb-write-url="/{{ config('adminlte.main_folder') }}/htmldb/general_settings/post?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>
    
    <div id="divSaveMessage" class="d-none">{{ __('General settings saved.') }}</div>
    <!-- jQuery -->
    <script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Toastr -->
    <script src="/assets/adminlte/plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="/assets/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/adminlte/js/adminlte.js"></script>
    <script src="/assets/adminlte/js/global.js"></script>
    <script src="/assets/adminlte/js/htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlte.htmldb.js"></script>
    <script src="/assets/adminlte/js/general_settings.js"></script>    
</body>
</html>
