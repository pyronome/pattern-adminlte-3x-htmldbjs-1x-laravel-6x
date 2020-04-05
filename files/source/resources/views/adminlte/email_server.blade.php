@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="email_server">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Email Configuration') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Email Configuration') }}</li>
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
                                <form id="formConfiguration" name="formConfiguration" onsubmit="return false;" class="card-body text-sm htmldb-form" data-htmldb-table="ConfigurationHTMLDB">
                                    <input type="hidden"
                                        id="id"
                                        name="id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        data-htmldb-value="@{{id}}">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="email_type" class="detail-label">{{ __('Email Type') }}</label>
                                            <select data-placeholder=""
                                                id="email_type"
                                                name="email_type"
                                                class="form-control htmldb-select2 htmldb-field select-has-option"
                                                data-htmldb-field="email_type"
                                                data-htmldb-value="@{{email_type}}"
                                                style="width: 100%;">
                                                <option value="0">{{ __('Standart Mail') }}</option>
                                                <option value="1">{{ __('SMTP') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="email_from_name" class="detail-label">{{ __('Email From Name') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="email_from_name"
                                                name="email_from_name"
                                                data-htmldb-field="email_from_name"
                                                data-htmldb-value="@{{email_from_name}}">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="email_reply_to" class="detail-label">{{ __('Email Reply To') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="email_reply_to"
                                                name="email_reply_to"
                                                data-htmldb-field="email_reply_to"
                                                data-htmldb-value="@{{email_reply_to}}">
                                        </div>
                                    </div>
                                    <div class="htmldb-toggle" data-htmldb-filter="email_type/eq/1" style="display:none;">
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label for="email_smtp_host" class="detail-label">{{ __('SMTP Host') }}</label>
                                                <input type="text"
                                                    class="form-control htmldb-field"
                                                    id="email_smtp_host"
                                                    name="email_smtp_host"
                                                    data-htmldb-field="email_smtp_host"
                                                    data-htmldb-value="@{{email_smtp_host}}">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label for="email_smtp_user" class="detail-label">{{ __('SMTP User') }}</label>
                                                <input type="text"
                                                    class="form-control htmldb-field"
                                                    id="email_smtp_user"
                                                    name="email_smtp_user"
                                                    data-htmldb-field="email_smtp_user"
                                                    data-htmldb-value="@{{email_smtp_user}}">
                                            </div>
                                            <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                                <label for="email_smtp_password" class="detail-label">{{ __('SMTP Password') }}</label>
                                                <input type="password"
                                                    class="form-control htmldb-field"
                                                    id="email_smtp_password"
                                                    name="email_smtp_password"
                                                    data-htmldb-field="email_smtp_password"
                                                    data-htmldb-value="@{{email_smtp_password}}"
                                                    autocomplete="new-password">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label for="email_smtp_encryption" class="detail-label">{{ __('Encryption') }}</label>
                                                <select data-placeholder=""
                                                    id="email_smtp_encryption"
                                                    name="email_smtp_encryption"
                                                    class="form-control htmldb-select2 htmldb-field select-has-option"
                                                    data-htmldb-field="email_smtp_encryption"
                                                    data-htmldb-value="@{{email_smtp_encryption}}"
                                                    style="width: 100%;">
                                                    <option value="0">{{ __('TLS') }}</option>
                                                    <option value="1">{{ __('SSL') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <label for="email_smtp_port" class="detail-label">{{ __('Port') }}</label>
                                                <input type="text"
                                                    class="form-control htmldb-field"
                                                    id="email_smtp_port"
                                                    name="email_smtp_port"
                                                    data-htmldb-field="email_smtp_port"
                                                    data-htmldb-value="@{{email_smtp_port}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="email_format" class="detail-label">{{ __('Mail Format') }}</label>
                                            <select data-placeholder=""
                                                id="email_format"
                                                name="email_format"
                                                class="form-control htmldb-select2 htmldb-field select-has-option"
                                                data-htmldb-field="email_format"
                                                data-htmldb-value="@{{email_format}}"
                                                style="width: 100%;">
                                                <option value="0">{{ __('HTML') }}</option>
                                                <option value="1">{{ __('Text') }}</option>
                                            </select>
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

    <div id="ConfigurationHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="2"
        data-htmldb-read-url="{{ config('adminlte.main_folder') }}/htmldb/email_server/get?_token={{ csrf_token() }}"
        data-htmldb-write-url="{{ config('adminlte.main_folder') }}/htmldb/email_server/post?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>

    <div id="divSaveMessage" class="d-none">{{ __('Email configuration saved.') }}</div>
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
    <script src="/assets/adminlte/js/email_server.js"></script>    
</body>
</html>