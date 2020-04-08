@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm"
        data-url-prefix=""
        data-page-initializing="1"
        data-translation-copied="0"
        data-page-url="languages">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                {{ __('Languages') }}
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder'); }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item enabled">{{ __('Languages') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content htmldb-section" data-htmldb-table="ServerInformationHTMLDB">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <form id="formLanuage"  onsubmit="return false;" class="card-body text-sm htmldb-form" data-htmldb-table="ProductHTMLDB">
                                    <input type="hidden"
                                        id="formLanuage-id"
                                        name="formLanuage-id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        data-htmldb-value="@{{id}}"
                                        data-htmldb-reset-value="0"
                                        value="">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 d-inline-block float-left">
                                        <label for="formLanuage-code" class="detail-label">{{ __('Language') }}</label>
                                        <select data-placeholder=""
                                            id="formLanuage-code"
                                            name="formLanuage-code"
                                            class="form-control htmldb-select2 htmldb-field htmldb-select"
                                            data-htmldb-option-table="LanguageCodeHTMLDB"
                                            data-htmldb-option-value="@{{code}}"
                                            data-htmldb-option-title="@{{name}}"
                                            data-htmldb-field="code"
                                            data-htmldb-value="@{{code}}"
                                            style="width: 100%;">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12 d-inline-block float-left">
                                        <label for="formLanuage-page" class="detail-label">{{ __('Page') }}</label>
                                        <select data-placeholder=""
                                            id="formLanuage-page"
                                            name="formLanuage-page"
                                            class="form-control htmldb-select2 htmldb-field htmldb-select"
                                            data-htmldb-option-table="PageHTMLDB"
                                            data-htmldb-option-value="@{{id}}"
                                            data-htmldb-option-title="@{{name}}"
                                            data-htmldb-field="page"
                                            data-htmldb-value="@{{page}}"
                                            style="width: 100%;">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-xs-12 d-inline-block">
                                        <div id="divTranslations" style="width: 100%;">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <p class="center">{{ __('Not listing any translation. Please select language and page to list translations.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-xs-12 d-inline-block show_by_permission">
                                        <button type="button"
                                            id="buttonNewTranslation"
                                            name="buttonNewTranslation"
                                            class="btn btn-block btn-primary">
                                            {{ __('Add New Translation...') }}
                                        </button>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-xs-12 d-inline-block show_by_permission">
                                        <button type="button"
                                            id="buttonShowCopyTranslationsForm"
                                            name="buttonShowCopyTranslationsForm"
                                            class="btn btn-block btn-primary">
                                            {{ __('Copy Translations...') }}
                                        </button>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-xs-12 d-inline-block show_by_permission">
                                        <button type="button"
                                            id="buttonSaveTranslations"
                                            name="buttonSaveTranslations"
                                            class="btn btn-block btn-success">
                                            {{ __('Save Translations') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>    
            </section>
        </div>

        <div class="modal fade htmldb-dialog-edit" id="modal-formNewTranslation">
            <div class="modal-dialog modal-md">
                <form id="formNewTranslation" name="formNewTranslation" method="post" class="form-horizontal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"> __('New Translation'); ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-12">
                                <label for="formNewTranslation-sentence" class="detail-label">{{ __('Sentence') }}</label>
                                <textarea id="formNewTranslation-sentence"
                                    name="formNewTranslation-sentence"
                                    class="form-control"
                                    rows="5"></textarea>
                            </div>
                        </div>
                        <div class="modalfooter justify-content-between show_by_permission">
                            <div class="row">
                                <div class="col col-lg-12">
                                    <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                                    <button type="button"
                                        id="buttonSave-formNewTranslation"
                                        name="buttonSave-formNewTranslation"
                                        class="btn btn-success float-right">
                                        {{ __('Add Translation') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade htmldb-dialog-edit" id="modal-formCopyTranslations">
            <div class="modal-dialog modal-md">
                <form id="formCopyTranslations" name="formCopyTranslations" method="post" class="form-horizontal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('Copy Translations') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-lg-12 col-md-12 col-xs-12 d-inline-block">
                                <label for="formCopyTranslations-page" class="detail-label">{{ __('Page') }}</label>
                                <select data-placeholder=""
                                    id="formCopyTranslations-page"
                                    name="formCopyTranslations-page"
                                    class="form-control htmldb-select2 htmldb-field htmldb-select"
                                    data-htmldb-option-table="PageHTMLDB"
                                    data-htmldb-option-value="@{{id}}"
                                    data-htmldb-option-title="@{{name}}"
                                    data-htmldb-field="page"
                                    data-htmldb-value="@{{page}}"
                                    style="width: 100%;">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12 d-inline-block float-left">
                                <label for="formCopyTranslations-fromLanguage" class="detail-label">{{ __('Copy From Language') }}</label>
                                <select data-placeholder=""
                                    id="formCopyTranslations-fromLanguage"
                                    name="formCopyTranslations-fromLanguage"
                                    class="form-control htmldb-select2 htmldb-field htmldb-select"
                                    data-htmldb-option-table="LanguageCodeHTMLDB"
                                    data-htmldb-option-value="@{{code}}"
                                    data-htmldb-option-title="@{{name}}"
                                    data-htmldb-field="fromLanguage"
                                    data-htmldb-value="@{{fromLanguage}}"
                                    style="width: 100%;">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12 d-inline-block float-left">
                                <label for="formCopyTranslations-toLanguage" class="detail-label">{{ __('Copy To Language') }}</label>
                                <select data-placeholder=""
                                    id="formCopyTranslations-toLanguage"
                                    name="formCopyTranslations-toLanguage"
                                    class="form-control htmldb-select2 htmldb-field htmldb-select"
                                    data-htmldb-option-table="LanguageCodeHTMLDB"
                                    data-htmldb-option-value="@{{code}}"
                                    data-htmldb-option-title="@{{name}}"
                                    data-htmldb-field="toLanguage"
                                    data-htmldb-value="@{{toLanguage}}"
                                    style="width: 100%;">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="modalfooter justify-content-between show_by_permission">
                            <div class="row">
                                <div class="col col-lg-12">
                                    <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                                    <button type="button"
                                        id="buttonSave-formCopyTranslations"
                                        name="buttonSave-formCopyTranslations"
                                        class="btn btn-success float-right">
                                        {{ __('Copy Translations') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('adminlte.footer')
    <div id="LanguageCodeHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/languages/get_languages?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>
    <div id="PageHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="2"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/languages/get_pages?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>
    <div id="TranslationCopyHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="3"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/languages/get_copiedtranslation?_token={{ csrf_token() }}"
        data-htmldb-write-url="/{{ config('adminlte.main_folder') }}/htmldb/languages/post_copiedtranslation?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>
    <div id="TranslationHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="4"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/languages/get_translation/en/adminlte?_token={{ csrf_token() }}"
        data-htmldb-write-url="/{{ config('adminlte.main_folder') }}/htmldb/languages/post_translation?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>
    @verbatim
    <script type="text/html" 
        id="divTranslationsTemplate"
        class="htmldb-template"
        data-htmldb-table="TranslationHTMLDB"
        data-htmldb-template-target="divTranslations">
        <div class="card white divTranslation" id="divTranslation{{id}}" data-row-id="{{id}}">
            <div class="card-content card-translation">
                <div class="form-group col-md-12">
                    <label id="labelTranslation{{id}}" for="inputTranslation{{id}}" class="label-with-btn">{{sentence}}</label>
                    <button class="buttonDeleteTranslation noborder-edit-btn text-danger float-right">
                        <i class="fa fa-times"></i>
                    </button>
                    <input type="text"
                        class="form-control htmldb-field"
                        id="inputTranslation{{id}}"
                        name="inputTranslation{{id}}"
                        value="{{translation}}">
                </div>
            </div>
        </div> 
    </script>
    <script type="text/html" id="newTranslationTemplate">
        <div class="card white divTranslation" data-row-id="__ID__">
            <div class="card-content card-translation">
                <div class="form-group col-md-12">
                    <label id="labelTranslation__ID__" for="inputTranslation__ID__" class="label-with-btn">__SENTENCE__</label>
                    <button class="buttonDeleteTranslation noborder-edit-btn text-danger float-right">
                        <i class="fa fa-times"></i>
                    </button>
                    <input type="text"
                        class="form-control htmldb-field"
                        id="inputTranslation__ID__"
                        name="inputTranslation__ID__"
                        value="">
                </div>
            </div>
        </div> 
    </script>
    @endverbatim
    <script type="text/html" id="translationsPlaceholderTemplate">
        <div class="card bg-light">
            <div class="card-body">
                <p class="center">{{ __('Not listing any translation. Please select language and page to list translations.') }}</p>
            </div>
        </div>
    </script>

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
    <script src="/assets/adminlte/js/languages.js"></script>    
</body>
</html>