@include('adminlte.head')
<body class="sidebar-mini layout-fixed control-sidebar-slide-open {{ $customization['body'] }}" data-url-prefix="" data-page-url="adminlteusergroup">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid htmldb-section" data-htmldb-table="AdminLTEUserGroupHTMLDB">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('User Group Edit') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/adminlteusergroup/list">{{ __('User Group List') }}</a></li>
                                <li class="breadcrumb-item itemeditpage-hide@{{id}}">
                                    <a href="/{{ config('adminlte.main_folder') }}/adminlteusergroup/detail/@{{id}}">
                                        {{ __('User Group Detail') }}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('User Group Edit') }}</li>
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
                                <form id="formUserGroup"  onsubmit="return false;" class="card-body text-sm htmldb-form" data-htmldb-table="AdminLTEUserGroupHTMLDB">
                                    <input type="hidden"
                                        id="formUserGroup-id"
                                        name="formUserGroup-id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        value=""
                                        data-htmldb-reset-value="0">
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox"
                                                    id="formUserGroup-enabled"
                                                    name="formUserGroup-enabled"
                                                    class="htmldb-field"
                                                    data-htmldb-field="enabled"
                                                    data-htmldb-value="@{{enabled}}"
                                                    data-htmldb-reset-value="1">
                                                <label for="formUserGroup-enabled" class="detail-label">
                                                    {{ __('Enabled') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox"
                                                    id="formUserGroup-widget_permission"
                                                    name="formUserGroup-widget_permission"
                                                    class="htmldb-field"
                                                    data-htmldb-field="widget_permission"
                                                    data-htmldb-value="@{{widget_permission}}"
                                                    data-htmldb-reset-value="1">
                                                <label for="formUserGroup-widget_permission" class="detail-label">
                                                    {{ __('Edit Widget Permission') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formUserGroup-title" class="detail-label">{{ __('Title') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="formUserGroup-title"
                                                name="formUserGroup-title"
                                                data-htmldb-field="title"
                                                data-htmldb-value="@{{title}}">
                                        </div>
                                    </div>
                                </form>

                                <div class="card-footer show_by_permission">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <button type="button"
                                            id="buttonSave-formUserGroup"
                                            name="buttonSave-formUserGroup"
                                            class="btn btn-success btn-md btn-on-table float-right htmldb-button-save"
                                            data-htmldb-form="formUserGroup">
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
        data-htmldb-priority="2"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteusergroup/get/@{{$URL.-1}}?_token={{ csrf_token() }}"
        data-htmldb-write-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteusergroup/post?_token={{ csrf_token() }}"
        data-htmldb-redirect="/{{ config('adminlte.main_folder') }}/adminlteusergroup/last"
        data-htmldb-loader="divLoader">
    </div>

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
    
    <!-- AdminLTE App -->
    <script src="/assets/adminlte/js/adminlte.js"></script>
    <script src="/assets/adminlte/js/global.js"></script>
    <script src="/assets/adminlte/js/htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlte.htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlteusergroup_edit.js"></script>
</body>
</html>
