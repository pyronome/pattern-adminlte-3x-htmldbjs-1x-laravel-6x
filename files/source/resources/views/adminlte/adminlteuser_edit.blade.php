@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="adminlteuser">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid htmldb-section" data-htmldb-table="AdminLTEUserHTMLDB">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('User Edit') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/adminlteuser/list">{{ __('User List') }}</a></li>
                                <li class="breadcrumb-item itemeditpage-hide@{{id}}">
                                    <a href="/{{ config('adminlte.main_folder') }}/adminlteuser/detail/@{{id}}">
                                        {{ __('User Detail') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('User Edit') }}</li>
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
                                <form id="formUser"  onsubmit="return false;" class="card-body text-sm htmldb-form" data-htmldb-table="AdminLTEUserHTMLDB">
                                    <input type="hidden"
                                        id="formUser-id"
                                        name="formUser-id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        value=""
                                        data-htmldb-reset-value="0">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox"
                                                    id="formUser-enabled"
                                                    name="formUser-enabled"
                                                    class="htmldb-field"
                                                    data-htmldb-field="enabled"
                                                    data-htmldb-value="@{{enabled}}"
                                                    data-htmldb-reset-value="1">
                                                <label for="formUser-enabled" class="detail-label">
                                                    {{ __('Enabled') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formUser-adminlteusergroup_id" class="detail-label">{{ __('User Group') }}</label>
                                            <select data-placeholder="Select a user group"
                                                id="formUser-adminlteusergroup_id"
                                                name="formUser-adminlteusergroup_id"
                                                class="form-control htmldb-select2 htmldb-field htmldb-select"
                                                data-htmldb-option-table="AdminLTEUserGroupHTMLDB"
                                                data-htmldb-option-value="@{{id}}"
                                                data-htmldb-option-title="@{{title}}"
                                                data-htmldb-field="adminlteusergroup_id"
                                                data-htmldb-value="@{{adminlteusergroup_id}}"
                                                style="width: 100%;">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formUser-fullname" class="detail-label">{{ __('Fullname') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="formUser-fullname"
                                                name="formUser-fullname"
                                                data-htmldb-field="fullname"
                                                data-htmldb-value="@{{fullname}}"
                                                placeholder="{{ __('Enter user fullname') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formUser-username" class="detail-label">{{ __('Username') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="formUser-username"
                                                name="formUser-username"
                                                data-htmldb-field="username"
                                                data-htmldb-value="@{{username}}"
                                                placeholder="{{ __('Enter user username') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formUser-email" class="detail-label">{{ __('Email') }}</label>
                                            <input type="email"
                                                class="form-control htmldb-field"
                                                id="formUser-email"
                                                name="formUser-email"
                                                data-htmldb-field="email"
                                                data-htmldb-value="@{{email}}"
                                                placeholder="{{ __('Enter user email address') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formUser-password" class="detail-label">{{ __('Password') }}</label>
                                            <input type="password"
                                                class="form-control htmldb-field"
                                                id="formUser-password"
                                                name="formUser-password"
                                                data-htmldb-field="password"
                                                data-htmldb-value="@{{password}}"
                                                placeholder="{{ __('Enter user password') }}"
                                                autocomplete="new-password">
                                        </div>
                                    </div>
                                </form>

                                <div class="card-footer show_by_permission">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <button type="button"
                                            id="buttonSave-formUser"
                                            name="buttonSave-formUser"
                                            class="btn btn-success btn-md btn-on-table float-right htmldb-button-save"
                                            data-htmldb-form="formUser">
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
    <div id="AdminLTEUserGroupHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="0"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteusergroup/get/0?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>
    
    <div id="AdminLTEUserHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="3"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteuser/get/@{{$URL.-1}}?_token={{ csrf_token() }}"
        data-htmldb-write-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteuser/post?_token={{ csrf_token() }}"
        data-htmldb-redirect="/{{ config('adminlte.main_folder') }}/adminlteuser/last"
        data-htmldb-loader="divLoader">
    </div>

    <!-- jQuery -->
    <script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Select2 -->
    <script src="/assets/adminlte/plugins/select2/js/select2.full.min.js"></script>
    
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
    <script src="/assets/adminlte/js/adminlteuser_edit.js"></script>
</body>
</html>
