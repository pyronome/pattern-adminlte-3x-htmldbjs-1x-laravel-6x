@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="ftp_server">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('FTP Configuration') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder'); }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('FTP Configuration') }}</li>
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
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="ftp_secure_enabled" class="detail-label">{{ __('FTP Security') }}</label>
                                            <select data-placeholder=""
                                                id="ftp_secure_enabled"
                                                name="ftp_secure_enabled"
                                                class="form-control htmldb-select2 htmldb-field select-has-option"
                                                data-htmldb-field="ftp_secure_enabled"
                                                data-htmldb-value="@{{ftp_secure_enabled}}"
                                                style="width: 100%;">
                                                <option value="0">{{ __('Standart FTP') }}</option>
                                                <option value="1">{{ __('Secure FTP') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="ftp_host_name" class="detail-label">{{ __('FTP Host') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="ftp_host_name"
                                                name="ftp_host_name"
                                                data-htmldb-field="ftp_host_name"
                                                data-htmldb-value="@{{ftp_host_name}}">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="ftp_port" class="detail-label">{{ __('FTP Port') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="ftp_port"
                                                name="ftp_port"
                                                data-htmldb-field="ftp_port"
                                                data-htmldb-value="@{{ftp_port}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="ftp_user_name" class="detail-label">{{ __('FTP Username') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="ftp_user_name"
                                                name="ftp_user_name"
                                                data-htmldb-field="ftp_user_name"
                                                data-htmldb-value="@{{ftp_user_name}}">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <label for="ftp_password" class="detail-label">{{ __('FTP Password') }}</label>
                                            <input type="password"
                                                class="form-control htmldb-field"
                                                id="ftp_password"
                                                name="ftp_password"
                                                data-htmldb-field="ftp_password"
                                                data-htmldb-value="@{{ftp_password}}"
                                                autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="ftp_home" class="detail-label">{{ __('FTP Home Directory') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="ftp_home"
                                                name="ftp_home"
                                                data-htmldb-field="ftp_home"
                                                data-htmldb-value="@{{ftp_home}}">
                                        </div>
                                    </div>
                                </form>

                                <div class="card-footer ">
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
        data-htmldb-priority="1"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/ftp_server/get?_token={{ csrf_token() }}"
        data-htmldb-write-url="/{{ config('adminlte.main_folder') }}/htmldb/ftp_server/post?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>

    <div id="divSaveMessage" class="d-none">{{ __('FTP configuration saved.') }}</div>
    
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
    <script src="/assets/adminlte/js/ftp_server.js"></script>    
</body>
</html>