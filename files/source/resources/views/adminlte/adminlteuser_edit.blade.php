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
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="adminlteuser/list">{{ __('User List') }}</a></li>
                                <li class="breadcrumb-item itemeditpage-hide@{{id}}">
                                    <a href="adminlteuser/detail/@{{id}}">
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
                                    <input type="hidden"
                                        id="formUser-menu_permission"
                                        name="formUser-menu_permission"
                                        class="htmldb-field"
                                        data-htmldb-field="menu_permission"
                                        value=""/>
                                    <input type="hidden"
                                        id="formUser-service_permission"
                                        name="formUser-service_permission"
                                        class="htmldb-field"
                                        data-htmldb-field="service_permission"
                                        value=""/>
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
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
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
                                                                {{ __('View Permission') }}<br>
                                                            </th>
                                                            <th class="text-left">
                                                                {{ __('Edit Permission') }}<br>
                                                            </th>
                                                            <th class="text-left border-left-grey">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="checkbox"
                                                                        id="input-view-all"
                                                                        name="input-view-all"
                                                                        value="1">
                                                                    <label for="input-view-all" class="detail-label">
                                                                        {{ __('View Permission') }}
                                                                    </label>
                                                                </div>
                                                            </th>
                                                            <th class="text-left">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="checkbox"
                                                                        id="input-edit-all"
                                                                        name="input-edit-all"
                                                                        value="1">
                                                                    <label for="input-edit-all" class="detail-label">
                                                                        {{ __('Edit Permission') }}
                                                                    </label>
                                                                </div>
                                                            </th>
                                                            <th class="text-left">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="checkbox"
                                                                        id="input-lockgroup-all"
                                                                        name="input-lockgroup-all"
                                                                        value="1">
                                                                    <label for="input-lockgroup-all" class="detail-label">
                                                                        {{ __('Lock Group Permission') }}
                                                                    </label>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyMenuPermission">
                                                        @include('adminlte.adminlteuser_permissions_edit')
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
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
                                            <label>{{ __('User Service Permissions') }}</label>
                                            <div class="divPermissionContainer">
                                                <table class="table table-bordered table-permission">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <button type="button"
                                                                    id="buttonEditServices"
                                                                    class="btn btn-primary btn-xs btn-on-table">
                                                                    <i class="fa fa-plus"></i> <span class="hidden-xxs">{{ __('Add') }}</span>
                                                                </button>
                                                            </th>
                                                            <th class="text-left">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="checkbox"
                                                                        id="input-get-all"
                                                                        name="input-get-all"
                                                                        value="1">
                                                                    <label for="input-get-all" class="detail-label">
                                                                        {{ __('Get Permission') }}
                                                                    </label>
                                                                </div>
                                                            </th>
                                                            <th class="text-left">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="checkbox"
                                                                        id="input-post-all"
                                                                        name="input-post-all"
                                                                        value="1">
                                                                    <label for="input-post-all" class="detail-label">
                                                                        {{ __('Post Permission') }}
                                                                    </label>
                                                                </div>
                                                            </th>
                                                            <th class="text-left">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="checkbox"
                                                                        id="input-delete-all"
                                                                        name="input-delete-all"
                                                                        value="1">
                                                                    <label for="input-delete-all" class="detail-label">
                                                                        {{ __('Delete Permission') }}
                                                                    </label>
                                                                </div>
                                                            </th>
                                                            <th class="text-left">
                                                                <div class="icheck-primary d-inline">
                                                                    <input type="checkbox"
                                                                        id="input-lockgrouppermission-all"
                                                                        name="input-lockgrouppermission-all"
                                                                        value="1">
                                                                    <label for="input-lockgrouppermission-all" class="detail-label">
                                                                        {{ __('Lock Group Permission') }}
                                                                    </label>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyUserServicePermission"></tbody>
                                                </table>
                                            </div>
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
    
    <div class="modal fade" id="modal-ServiceList" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Services') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-top:0px;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 mb-10">
                            <div class="input-group input-group-md" style="padding: 5px;margin-top: 15px;">
                                <input type="search"
                                    id="searchService" name="searchService"
                                    class="form-control float-right inputSearchBar"
                                    placeholder="{{ __('Search') }}">
                                <div class="input-group-append labelSearchBar">
                                    <button type="button" class="btn btn-default">
                                        <i class="fas fa-search text-primary"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul id="ulDirectory" class="list-group ul-permission-directories">

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modalfooter justify-content-between show_by_permission">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button"
                                id="buttonSave-Services"
                                name="buttonSave-Services"
                                class="btn btn-success float-right">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
    
    <div id="directoryHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/__services/get_directories?_token={{ csrf_token() }}"
        data-htmldb-read-only="1">
    </div>
    @verbatim
    <script type="text/html" 
        id="ulDirectoryTemplate"
        class="htmldb-template"
        data-htmldb-table="directoryHTMLDB"
        data-htmldb-template-target="ulDirectory">
        <li class="searchable-service li-directory" data-search-text="{{title}}" data-type="directory">
            <div class="icheck-primary d-inline">
                <input type="checkbox"
                    id="select{{title}}Services"
                    name="select{{title}}Services"
                    class="selectDirectoryServices"
                    data-directory="{{title}}">
                <label for="select{{title}}Services" class="detail-label">
                    {{title}}
                </label>
            </div>
            <ul id="{{title}}Services" class="ul-permission-services"></ul>
        </li>
    </script>
    @endverbatim
    <div id="fileHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="2"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/__services/get?_token={{ csrf_token() }}"
        data-htmldb-read-only="1">
    </div>
    @verbatim
    <script type="text/html" 
        id="ulServiceTemplate"
        class="htmldb-template"
        data-htmldb-table="fileHTMLDB"
        data-htmldb-template-target="{{directory_name}}Services">
        <li class="searchable-service li-service" data-search-text="{{title}}" data-type="service">
            <div class="icheck-primary d-inline">
                <input type="checkbox"
                    id="selectService{{title}}"
                    name="selectService{{title}}"
                    class="{{directory_name}}Service selectService"
                    data-directory="{{directory_name}}"
                    data-file="{{file_name}}">
                <label for="selectService{{title}}" class="detail-label">
                    {{title}}
                </label>
            </div>
        </li>
    </script>
    @endverbatim
    <script type="text/html" id="trServicePermissionInputs">
        <tr>
            <td scope="row">__DIRECTORY__/__SERVICE__</td>
            <td class="text-left">
                <div class="icheck-primary d-inline">
                    <input type="checkbox"
                        id="input-__DIRECTORY__/__SERVICE__/g"
                        name="input-__DIRECTORY__/__SERVICE__/g"
                        class="input-service-permission input-get"
                        data-permission-token="__DIRECTORY__/__SERVICE__/g"
                        value="1">
                    <label for="input-__DIRECTORY__/__SERVICE__/g" class="detail-label">
                    </label>
                </div>
            </td>
            <td class="text-left">
                <div class="icheck-primary d-inline">
                    <input type="checkbox"
                        id="input-__DIRECTORY__/__SERVICE__/p"
                        name="input-__DIRECTORY__/__SERVICE__/p"
                        class="input-service-permission input-post"
                        data-permission-token="__DIRECTORY__/__SERVICE__/p"
                        value="1">
                    <label for="input-__DIRECTORY__/__SERVICE__/p" class="detail-label">
                    </label>
                </div>
            </td>
            <td class="text-left">
                <div class="icheck-primary d-inline">
                    <input type="checkbox"
                        id="input-__DIRECTORY__/__SERVICE__/d"
                        name="input-__DIRECTORY__/__SERVICE__/d"
                        class="input-service-permission input-delete"
                        data-permission-token="__DIRECTORY__/__SERVICE__/d"
                        value="1">
                    <label for="input-__DIRECTORY__/__SERVICE__/d" class="detail-label">
                    </label>
                </div>
            </td>
            <td class="text-left">
                <div class="icheck-primary d-inline">
                    <input type="checkbox"
                        id="input-__DIRECTORY__/__SERVICE__/l"
                        name="input-__DIRECTORY__/__SERVICE__/l"
                        class="input-service-permission input-lockgrouppermission"
                        data-permission-token="__DIRECTORY__/__SERVICE__/l"
                        value="1">
                    <label for="input-__DIRECTORY__/__SERVICE__/l" class="detail-label">
                    </label>
                </div>
            </td>
        </tr>
    </script>

    <div id="AdminLTEUserHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="3"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteuser/get/@{{$URL.-1}}?_token={{ csrf_token() }}"
        data-htmldb-write-url="/{{ config('adminlte.main_folder') }}/htmldb/adminlteuser/post?_token={{ csrf_token() }}"
        data-htmldb-redirect="adminlteuser/last"
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
    <script src="/assets/adminlte/js/adminlte_user_edit.js"></script>
</body>
</html>