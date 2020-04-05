@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-initializing="1" data-page-url="adminlteuser">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                {{ __('User') }}
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/adminlteuser/list">{{ __('User List') }}</a></li>
                                <li class="breadcrumb-item enabled">{{ __('User Detail') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content htmldb-section" data-htmldb-table="AdminLTEUserHTMLDB">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="card">
                                <div class="card-header show_by_permission">
                                    <div class="card-tools">
                                        <a  class="btn btn-primary btn-xs btn-on-table text-white"
                                            href="/{{ config('adminlte.main_folder') }}/adminlteuser/edit/@{{id}}">
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
                                                    <label class="detail-label">{{ __('Fullname') }}</label>
                                                    <div data-htmldb-content="@{{fullname/display_text}}"></div>
                                                </div>
                                                <div class="detail-container">
                                                    <label class="detail-label">{{ __('Username') }}</label>
                                                    <div data-htmldb-content="@{{username/display_text}}"></div>
                                                </div>
                                                <div class="detail-container">
                                                    <label class="detail-label">{{ __('Email') }}</label>
                                                    <div data-htmldb-content="@{{email/display_text}}"></div>
                                                </div>
                                                <div class="detail-container">
                                                    <label class="detail-label">{{ __('User Group') }}</label>
                                                    <div data-htmldb-content="@{{adminlteusergroup_id/display_text}}"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <input type="hidden" id="group_menu_permission" value="@{{group_menu_permission}}">
                                            <input type="hidden" id="menu_permission" value="@{{menu_permission}}">
                                            <label>{{ __('Menu Permissions') }}</label>
                                            <div class="divPermissionContainer">
                                                <table class="table table-bordered table-permission">
                                                    <thead>
                                                        <tr class="table-permission-header">
                                                            <th></th>
                                                            <th colspan="2" class="text-center border-left-grey">{{ __('Group') }}</th>
                                                            <th colspan="3" class="text-center border-left-grey">{{ __('User') }}</th>
                                                        </tr>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-left border-left-grey">
                                                                {{ __('View Permission') }}
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Edit Permission') }}
                                                            </th>
                                                            <th class="text-left border-left-grey">
                                                                {{ __('View Permission') }}
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Edit Permission') }}
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Lock Grup Permission') }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyPermission">
                                                        @include('adminlte.adminlteuser_permissions_detail')
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <input type="hidden" id="group_service_permission" value="@{{group_service_permission}}">
                                            <label>{{ __('Group Service Permissions') }}</label>
                                            <div class="divPermissionContainer">
                                                <table class="table table-bordered table-permission">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-left">
                                                                {{ __('Get Permission') }}
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Post Permission') }}
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Delete Permission') }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyGroupServicePermission">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <input type="hidden" id="service_permission" value="@{{service_permission}}">
                                            <label>{{ __('User Service Permissions') }}</label>
                                            <div class="divPermissionContainer">
                                                <table class="table table-bordered table-permission">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-left">
                                                                {{ __('Get Permission') }}
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Post Permission') }}
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Delete Permission') }}
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Lock Group Permission') }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyUserServicePermission"></tbody>
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
    <div id="AdminLTEUserHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteuser/get/@{{$URL.-1}}?_token={{ csrf_token() }}"
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

    <script type="text/html" id="trUserServicePermission">
        <tr>
            <td scope="row">__DIRECTORY__/__SERVICE__</td>
            <td class="text-left">
                <span id="userservicepermission-__DIRECTORY__/__SERVICE__/g" class="spanIcon spanIconActive0"><i class="fas fa-check-circle text-green"></i></span>
            </td>
            <td class="text-left">
                <span id="userservicepermission-__DIRECTORY__/__SERVICE__/p" class="spanIcon spanIconActive0"><i class="fas fa-check-circle text-green"></i></span>
            </td>
            <td class="text-left">
                <span id="userservicepermission-__DIRECTORY__/__SERVICE__/d" class="spanIcon spanIconActive0"><i class="fas fa-check-circle text-green"></i></span>
            </td>
            <td class="text-left">
                <span id="userservicepermission-__DIRECTORY__/__SERVICE__/l" class="spanIcon spanIconActive0"><i class="fas fa-check-circle text-green"></i></span>
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
    <script src="/assets/adminlte/js/adminlte_user_detail.js"></script>
</body>
</html>