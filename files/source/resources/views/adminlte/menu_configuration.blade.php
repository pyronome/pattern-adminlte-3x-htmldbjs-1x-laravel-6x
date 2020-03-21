@include('admin.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="menu_configuration">
    @include('admin.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Menu Configuration') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Menu Configuration') }}</li>
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
                                <form id="formConfiguration" name="formConfiguration" onsubmit="return false;" class="htmldb-form" data-htmldb-table="ConfigurationHTMLDB">
                                    <input type="hidden"
                                        id="id"
                                        name="id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        data-htmldb-value="{{id}}">
                                    <input type="hidden"
                                        id="menu_json"
                                        name="menu_json"
                                        class="htmldb-field"
                                        data-htmldb-field="menu_json"
                                        data-htmldb-value="{{menu_json}}">
                                </form>
                                <div class="card-body">
                                    <div class="row mb-10 show_by_permission">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <a id="buttonNewMenuItem" class="btn btn-primary btn-xs btn-on-table float-right" href="javascript:void(0);">
                                                <i class="fa fa-plus"></i> <span class="hidden-xxs">{{ __('New') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12">
                                            <ul id="ulMenuEditor" class="list-group">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer show_by_permission">
                                    <button type="button"
                                        id="buttonSave-formConfiguration"
                                        name="buttonSave-formConfiguration"
                                        class="btn btn-success btn-md btn-on-table float-right">
                                        <i class="far fa-save" aria-hidden="true"></i> {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="modal fade" id="modalMenuItem">
            <div class="modal-dialog modal-md">
                <form id="formMenuItem" name="formMenuItem" method="post" class="form-horizontal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('Menu Item') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="text">{{ __('Title') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control item-menu" name="text" id="text">
                                    <div class="input-group-append">
                                        <button type="button" id="ulMenuEditor_icon" class="btn btn-outline-secondary"></button>
                                    </div>
                                </div>
                                <input type="hidden" name="icon" class="item-menu">

                            </div>
                            <div class="form-group">
                                <label for="href">{{ __('URL') }}</label>
                                <input type="text" class="form-control item-menu" id="href" name="href">
                            </div>
                            <div class="form-group">
                                <label for="visibility">{{ __('Visibility') }}</label>
                                <select name="visibility" id="visibility" class="form-control item-menu">
                                    <option value="0">{{ __('No') }}</option>
                                    <option value="1">{{ __('Yes') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="modalfooter justify-content-between show_by_permission">
                            <div class="row">
                                <div class="col col-lg-12">
                                    <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                                    <button type="button"
                                        id="buttonAddMenuItem"
                                        name="buttonAddMenuItem"
                                        class="btn btn-success float-right"
                                        style="display:none;">
                                        {{ __('Save') }}
                                    </button>
                                    <button type="button"
                                        id="buttonUpdateMenuItem"
                                        name="buttonUpdateMenuItem"
                                        class="btn btn-success float-right"
                                        style="display:none;">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modalMenuItemDelete">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Menu Item Delete') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>{{ __('Selected item will be deleted. Do you confirm?') }}</p>
                        </div>
                    </div>
                    <div class="modalfooter justify-content-between show_by_permission">
                        <div class="row">
                            <div class="col col-lg-12">
                                <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="button"
                                    id="buttonDeleteMenuItem"
                                    name="buttonDeleteMenuItem"
                                    class="btn btn-danger float-right">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
    <div id="CheckFTPConnectionHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="htmldb/ftp_server/checkconnection"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>

    <div id="ConfigurationHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="2"
        data-htmldb-read-url="htmldb/menu_configuration/get"
        data-htmldb-write-url="htmldb/menu_configuration/post"
        data-htmldb-loader="divLoader">
    </div>

    <div id="divSaveMessage" class="d-none">{{ __('Menu configuration saved.') }}</div>
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
    <!-- Bootstrap Icon Picker -->
    <script src="/assets/adminlte/plugins/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js"></script>
    <script src="/assets/adminlte/plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js"></script>
    <!-- Toastr -->
    <script src="/assets/adminlte/plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/adminlte/js/adminlte.js"></script>
    <script src="/assets/adminlte/js/global.js"></script>
    <script src="/assets/adminlte/js/htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlte.htmldb.js"></script>
    <!-- Menu Editor -->
    <script src="/assets/adminlte/js/menu_editor.js"></script>
    <script src="/assets/adminlte/js/menu_configuration.js"></script>    
</body>
</html>