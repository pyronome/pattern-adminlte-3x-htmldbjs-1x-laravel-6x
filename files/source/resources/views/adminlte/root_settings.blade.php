@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed" data-url-prefix="" data-page-url="profile">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Root Login Settings') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Root Login Settings') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content htmldb-section" data-htmldb-table="ProfileHTMLDB">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="card">
                                <div id="formProfile" class="card-body htmldb-form" data-htmldb-table="ProfileHTMLDB">
                                    <input type="hidden"
                                        id="formProfile-id"
                                        name="formProfile-id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        value=""/>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="formProfile-username" class="detail-label">{{ __('Username') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="formProfile-username"
                                                name="formProfile-username"
                                                data-htmldb-field="username"
                                                data-htmldb-value="{{username}}">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="formProfile-password0" class="detail-label">{{ __('Current Password') }}</label>
                                            <input type="password"
                                                class="form-control htmldb-field"
                                                id="formProfile-password0"
                                                name="formProfile-password0"
                                                data-htmldb-field="password0"
                                                autocomplete="new-password">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="formProfile-password1" class="detail-label">{{ __('New Password') }}</label>
                                            <input type="password"
                                                class="form-control htmldb-field"
                                                id="formProfile-password1"
                                                name="formProfile-password1"
                                                data-htmldb-field="password1"
                                                autocomplete="new-password">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="formProfile-password2" class="detail-label">{{ __('New Password (Re-Type)') }}</label>
                                            <input type="password"
                                                class="form-control htmldb-field"
                                                id="formProfile-password2"
                                                name="formProfile-password2"
                                                data-htmldb-field="password2"
                                                autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class=" col-md-12">
                                        <button type="button"
                                            id="buttonSubmit-formProfile"
                                            name="buttonSubmit-formProfile"
                                            class="btn btn-success btn-md btn-on-table float-right htmldb-button-save"
                                            data-htmldb-form="formProfile">
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
    <div id="ProfileHTMLDB"
        class="htmldb-table"
        data-htmldb-read-url="htmldb/__root/get"
        data-htmldb-write-url="htmldb/__root/post"
        data-htmldb-loader="divLoader">
    </div>
    
    <div id="divSaveMessage" class="d-none">{{ __('Your profile saved.') }}</div>

    <!-- jQuery -->
    <script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    
    <!-- Toastr -->
    <script src="/assets/adminlte/plugins/toastr/toastr.min.js"></script>
    
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Toastr -->
    <script src="/assets/adminlte/plugins/toastr/toastr.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="/assets/adminlte/js/adminlte.js"></script>
    <script src="/assets/adminlte/js/global.js"></script>
    <script src="/assets/adminlte/js/htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlte.htmldb.js"></script>
    <script src="/assets/adminlte/js/root_settings.js"></script>    
</body>
</html>