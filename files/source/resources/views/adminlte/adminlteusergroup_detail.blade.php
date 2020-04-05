@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-initializing="1" data-page-url="adminlteusergroup">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                {{ __('User Group') }}
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="adminlteusergroup/list">{{ __('User Group List') }}</a></li>
                                <li class="breadcrumb-item enabled">{{ __('User Group Detail') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content htmldb-section" data-htmldb-table="AdminLTEUserGroupHTMLDB">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="card">
                                <div class="card-header show_by_permission">
                                    <div class="card-tools">
                                        <a  class="btn btn-primary btn-xs btn-on-table text-white"
                                            href="adminlteusergroup/edit/@{{id}}">
                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i> <span>{{ __('Edit') }}</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
                                            <div class="text-muted text-sm">
                                                <div class="detail-container">
                                                    <label class="detail-label">{{ __('Enabled') }}</label>
                                                    <div data-htmldb-content="@{{enabled/display_text}}"></div>
                                                </div>
                                                <div class="detail-container">
                                                    <label class="detail-label">{{ __('Edit Widget Permission') }}</label>
                                                    <div data-htmldb-content="@{{widget_permission/display_text}}"></div>
                                                </div>
                                                <div class="detail-container">
                                                    <label class="detail-label">{{ __('Title') }}</label>
                                                    <div data-htmldb-content="@{{title/display_text}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" id="menu_permission" value="@{{menu_permission}}">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label>{{ __('Menu Permissions') }}</label>
                                            <div class="divPermissionContainer">
                                                <table class="table table-bordered table-permission">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-left">
                                                                {{ __('View Permission') }}<br>
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Edit Permission') }}<br>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyMenuPermission">
                                                        @include('adminlte.adminlteusergroup_permissions_detail')
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <input type="hidden" id="service_permission" value="@{{service_permission}}">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label>{{ __('Service Permissions') }}</label>
                                            <div class="divPermissionContainer">
                                                <table class="table table-bordered table-permission">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-left">
                                                                {{ __('Get Permission') }}<br>
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Post Permission') }}<br>
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Delete Permission') }}<br>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyGroupServicePermission">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
        data-htmldb-priority="1"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteusergroup/get/@{{$URL.-1}}?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>
    
    <script type="text/html" id="trGroupServicePermission">
        <tr>
            <td scope="row">__DIRECTORY__/__SERVICE__</td>
            <td class="text-left">
                <span id="groupservicepermission-__DIRECTORY__/__SERVICE__/g" class="spanIcon spanIconActive0"><i class="fas fa-check-circle text-green"></i></span>
            </td>
            <td class="text-left">
                <span id="groupservicepermission-__DIRECTORY__/__SERVICE__/p" class="spanIcon spanIconActive0"><i class="fas fa-check-circle text-green"></i></span>
            </td>
            <td class="text-left">
                <span id="groupservicepermission-__DIRECTORY__/__SERVICE__/d" class="spanIcon spanIconActive0"><i class="fas fa-check-circle text-green"></i></span>
            </td>
        </tr>
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
    
    <!-- AdminLTE App -->
    <script src="/assets/adminlte/js/adminlte.js"></script>
    <script src="/assets/adminlte/js/global.js"></script>
    <script src="/assets/adminlte/js/htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlte.htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlte_user_group_detail.js"></script>
</body>
</html>