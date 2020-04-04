@include('adminlte.head')

<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="adminltemodeldisplaytext">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Model Display Texts Configuration') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Model Display Texts Configuration') }}</li>
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
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Model</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyModelList">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="modal fade" id="modal-ModelDisplayTextList" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Model Display Texts') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-top:0px;">
                    <form id="formModelDisplayText"  onsubmit="return false;">
                        <input type="hidden"
                            id="formModelDisplayText-id"
                            name="formModelDisplayText-id"
                            value="">
                        <input type="hidden"
                            id="formModelDisplayText-model"
                            name="formModelDisplayText-model"
                             value=""/>   
                        <input type="hidden"
                            id="formModelDisplayText-display_text_json"
                            name="formModelDisplayText-display_text_json"
                            value=""/>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Property</th>
                                            <th>Display Text</th>
                                            <th style="width:60px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyModelDisplayText">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modalfooter justify-content-between show_by_permission">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button"
                                id="buttonSave-formModelDisplayText"
                                name="buttonSave-formModelDisplayText"
                                class="btn btn-success float-right">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal-EditDisplayText" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Edit Display Text') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-top:0px;">
                    <form id="formEditDisplayText"  onsubmit="return false;">
                        <input type="hidden"
                            id="formEditDisplayText-index"
                            name="formEditDisplayText-index"
                            value="">
                    </form>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                            <label for="formEditDisplayText-property" class="detail-label">{{ __('Property') }}</label>
                            <input type="text"
                                class="form-control"
                                id="formEditDisplayText-property"
                                name="formEditDisplayText-property"
                                value=""
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                            <label for="formEditDisplayText-display_text" class="label-with-btn">{{ __('Display Text') }}</label>
                            <button id="buttonSearchProperty" class="noborder-edit-btn text-primary float-right" style="width:auto;">
                                <i class="fa fa-search-plus"></i>&nbsp;{{ __('Insert Class Property') }}
                            </button>
                            <textarea id="formEditDisplayText-display_text"
                                name="formEditDisplayText-display_text"
                                class="textarea"
                                rows="5"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modalfooter justify-content-between show_by_permission">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button"
                                id="buttonSave-formEditDisplayText"
                                name="buttonSave-formEditDisplayText"
                                class="btn btn-success float-right">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-ModelProportyList" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Model Properties') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="min-height:350px;">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                            <div id="ulModelList" class="nav flex-column nav-pills" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-9 col-9 tab-content" id="ulModelContentList">
                            
                        </div>
                    </div>
                </div>
                <div class="modalfooter justify-content-between show_by_permission">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Close') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('adminlte.footer')
    <div id="ModelDisplayTextHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="htmldb/__modeldisplaytext/get_model_display_texts?_token={{ csrf_token() }}"
        data-htmldb-write-url="htmldb/__modeldisplaytext/post_model_display_texts?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>
    @verbatim
    <script type="text/html" 
        id="tbodyModelListTemplate"
        class="htmldb-template"
        data-htmldb-table="ModelDisplayTextHTMLDB"
        data-htmldb-template-target="tbodyModelList">
        <tr>
            <td class="tdModelDisplayTextEditButton" data-row-id="{{id}}">
                <i class="fas fa-cog nav-icon"></i>&nbsp;&nbsp;{{model}}
            </td>
        </tr>
    </script>
    @endverbatim
    <div id="ModelRenderHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="htmldb/__modeldisplaytext/get_model_display_texts?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>
    @verbatim
    <script type="text/html" 
        id="ulModelListTemplate"
        class="htmldb-template"
        data-htmldb-table="ModelRenderHTMLDB"
        data-htmldb-template-target="ulModelList">
        <a class="nav-link" id="{{model}}-tab" data-toggle="pill" href="#{{model}}Content" role="tab" aria-controls="{{model}}" aria-selected="false">
            {{model}}
        </a>
    </script>
    <script type="text/html" 
        id="ulModelContentListTemplate"
        class="htmldb-template"
        data-htmldb-table="ModelRenderHTMLDB"
        data-htmldb-template-target="ulModelContentList">
        <div class="tab-pane fade" id="{{model}}Content" role="tabpanel" aria-labelledby="{{model}}-tab">
            <ul class="ulModelPropertyList" id="ul{{model}}PropertyList"></ul>
        </div>
    </script>
    <script type="text/html" id="trEditDisplayTextTemplate">
        <td id="property___INDEX__">__PROPERTY__</td>
        <td><span class="span-display_text" id="display_text___INDEX__">__DISPLAY_TEXT__</span></td>
        <td class="text-center">
            <i id="updated-icon-__INDEX__" class="fas fa-cog nav-icon __SH_CLASS__"></i>
            <i class="fas fa-ban nav-icon text-red __ANTI_SH_CLASS__"></i>
        </td>
    </script>
    @endverbatim
    <div id="PropertyListHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="2"
        data-htmldb-read-url="htmldb/__modeldisplaytext/get_model_property_list?_token={{ csrf_token() }}">
    </div>
    @verbatim
    <script type="text/html" 
        id="ulModelPropertyListTemplate"
        class="htmldb-template"
        data-htmldb-table="PropertyListHTMLDB"
        data-htmldb-template-target="ul{{model}}PropertyList">
        <li class="liModelProperty" data-display-text="{{model}}/{{property}}">
            {{property}}
        </li>
    </script>
    @endverbatim

    <div id="divSaveMessage" class="d-none">{{ __('Model display texts saved.') }}</div>
    
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
    <!-- Summernote -->
    <script src="/assets/adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Toastr -->
    <script src="/assets/adminlte/plugins/toastr/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="/assets/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/assets/adminlte/js/adminlte.js"></script>
    <script src="/assets/adminlte/js/global.js"></script>
    <script src="/assets/adminlte/js/htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlte.htmldb.js"></script>
    <script src="/assets/adminlte/js/adminlte_model_display_texts.js"></script>
</body>
</html>