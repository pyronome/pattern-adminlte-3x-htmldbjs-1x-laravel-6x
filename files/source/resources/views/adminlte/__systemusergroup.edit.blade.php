@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="__systemusergroup">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid htmldb-section" data-htmldb-table="__SystemUserGroupHTMLDB">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('User Group Edit') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="__systemusergroup/list">{{ __('User Group List') }}</a></li>
                                <li class="breadcrumb-item itemeditpage-hide{{id}}">
                                    <a href="__systemusergroup/detail/{{id}}">
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
                                <form id="formUserGroup"  onsubmit="return false;" class="card-body text-sm htmldb-form" data-htmldb-table="__SystemUserGroupHTMLDB">
                                    <input type="hidden"
                                        id="formUserGroup-id"
                                        name="formUserGroup-id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        value=""
                                        data-htmldb-reset-value="0">
                                    <input type="hidden"
                                        id="formUserGroup-menu_permission"
                                        name="formUserGroup-menu_permission"
                                        class="htmldb-field"
                                        data-htmldb-field="menu_permission"
                                        value=""/>
                                    <input type="hidden"
                                        id="formUserGroup-service_permission"
                                        name="formUserGroup-service_permission"
                                        class="htmldb-field"
                                        data-htmldb-field="service_permission"
                                        value=""/>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox"
                                                    id="formUserGroup-enabled"
                                                    name="formUserGroup-enabled"
                                                    class="htmldb-field"
                                                    data-htmldb-field="enabled"
                                                    data-htmldb-value="{{enabled}}"
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
                                                    data-htmldb-value="{{widget_permission}}"
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
                                                data-htmldb-value="{{title}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label>{{ __('Menu Permissions') }}</label>
                                            <div class="divPermissionContainer">
                                                <table class="table table-bordered table-permission">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th class="text-left">
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
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyMenuPermission">
                                                        @include('adminlte.__systemusergroup_permissions_edit')
                                                    </tbody>
                                                </table>        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <label>{{ __('Service Permissions') }}</label>
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
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodyServicePermission"></tbody>
                                                </table>        
                                            </div>
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
    <div id="directoryHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="0"
        data-htmldb-read-url="htmldb/__services/get_directories"
        data-htmldb-read-only="1">
    </div>
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

    <div id="fileHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="htmldb/__services/get"
        data-htmldb-read-only="1">
    </div>
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
        </tr>
    </script>

    <div id="__SystemUserGroupHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="2"
        data-htmldb-read-url="htmldb/__systemusergroup/get/{{$URL.-1}}"
        data-htmldb-write-url="htmldb/__systemusergroup/post"
        data-htmldb-redirect="__systemusergroup/last"
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
    <script src="/assets/adminlte/js/__systemusergroup.edit.js"></script>    
</body>
</html>