@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="database_server">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Database Configuration') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Database Configuration') }}</li>
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
                                            <label for="database_type" class="detail-label">{{ __('Database Type') }}</label>
                                            <select data-placeholder=""
                                                id="database_type"
                                                name="database_type"
                                                class="form-control htmldb-select2 htmldb-field select-has-option"
                                                data-htmldb-field="database_type"
                                                data-htmldb-value="@{{database_type}}"
                                                style="width: 100%;">
                                                <option value="0">{{ __('MySQL') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="mysql_db_server" class="detail-label">{{ __('MySQL Host') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="mysql_db_server"
                                                name="mysql_db_server"
                                                data-htmldb-field="mysql_db_server"
                                                data-htmldb-value="@{{mysql_db_server}}">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="mysql_db_port" class="detail-label">{{ __('MySQL Port') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="mysql_db_port"
                                                name="mysql_db_port"
                                                data-htmldb-field="mysql_db_port"
                                                data-htmldb-value="@{{mysql_db_port}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                            <label for="mysql_db_name" class="detail-label">{{ __('MySQL Database Name') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="mysql_db_name"
                                                name="mysql_db_name"
                                                data-htmldb-field="mysql_db_name"
                                                data-htmldb-value="@{{mysql_db_name}}">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                            <label for="mysql_db_username" class="detail-label">{{ __('MySQL Username') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="mysql_db_username"
                                                name="mysql_db_username"
                                                data-htmldb-field="mysql_db_username"
                                                data-htmldb-value="@{{mysql_db_username}}">
                                        </div>
                                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                            <label for="mysql_db_password" class="detail-label">{{ __('MySQL Password') }}</label>
                                            <input type="password"
                                                class="form-control htmldb-field"
                                                id="mysql_db_password"
                                                name="mysql_db_password"
                                                data-htmldb-field="mysql_db_password"
                                                data-htmldb-value="@{{mysql_db_password}}"
                                                autocomplete="new-password">
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
    <div id="CheckFTPConnectionHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="htmldb/ftp_server/checkconnection?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>

    <div id="ConfigurationHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="2"
        data-htmldb-read-url="htmldb/database_server/get?_token={{ csrf_token() }}"
        data-htmldb-write-url="htmldb/database_server/post?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>

    <div id="divSaveMessage" class="d-none">{{ __('Database configuration saved.') }}</div>
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
    <script src="/assets/adminlte/js/database_server.js"></script>
</body>
</html>