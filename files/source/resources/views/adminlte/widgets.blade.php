<div class="modal fade htmldb-dialog-edit" id="modal-WidgetList" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Widgets') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-top:0px;">
                <form id="formConfiguration" name="formConfiguration" onsubmit="return false;" class="htmldb-form" data-htmldb-table="ConfigurationHTMLDB">
                    <input type="hidden"
                        id="id"
                        name="id"
                        class="htmldb-field"
                        data-htmldb-field="id"
                        data-htmldb-value="@{{id}}">
                    <input type="hidden"
                        id="widget_json"
                        name="widget_json"
                        class="htmldb-field"
                        data-htmldb-field="widget_json"
                        data-htmldb-value="@{{widget_json}}">
                </form>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <a id="buttonShowUnvisibleWidgets" class="float-left" href="javascript:void(0);" style="padding: 7px 0px;">
                            <span>{{ __('Show Unvisible Widgets') }}</span>
                        </a>
                        <a id="buttonHideUnvisibleWidgets" class="float-left" href="javascript:void(0);" style="padding: 7px 0px;display:none;">
                            <span>{{ __('Hide Unvisible Widgets') }}</span>
                        </a>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12 mb-10">
                        <div class="input-group input-group-md">
                            <input type="search"
                                id="searchWidget" name="searchWidget"
                                class="form-control float-right inputSearchBar"
                                placeholder="{{ __('Search') }}">
                            <div class="input-group-append labelSearchBar">
                                <button type="button" class="btn btn-default">
                                    <i class="fas fa-search text-primary"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-10">
                        <a id="buttonAddEmptyWidget" class="btn btn-primary btn-md float-right" href="javascript:void(0);" style="padding: 7.5px 10px;">
                            <i class="fa fa-plus"></i> <span>{{ __('Add Empty Widget') }}</span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul id="ulWidgetEditor" class="list-group">
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modalfooter justify-content-between show_by_permission">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button"
                            id="buttonSave-Widgets"
                            name="buttonSave-Widgets"
                            class="btn btn-success float-right">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalWidgetItem" tabindex="1" role="dialog">
    <div class="modal-dialog modal-md">
        <form id="formWidgetItem" name="formWidgetItem" method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="widgetModalTitle" class="modal-title">{{ __('Widget Item') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="__widgetconfig-type" name="__widgetconfig-type" class="item-widget">
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <label for="__widgetconfig-model">{{ __('Model') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control item-widget" name="__widgetconfig-model" id="__widgetconfig-model" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <label for="__widgetconfig-text">{{ __('Title') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control item-widget" name="__widgetconfig-text" id="__widgetconfig-text">
                                <div class="input-group-append infobox-inputs">
                                    <button type="button" id="ulWidgetEditor_icon" class="btn btn-outline-secondary"></button>
                                </div>
                            </div>
                            <input type="hidden" id="__widgetconfig-icon" name="__widgetconfig-icon" class="item-widget">
                        </div>
                    </div>
                    <div class="row mb-20 infobox-inputs">
                        <div class="col-md-12">
                            <label for="iconbackgroundPicker">{{ __('Icon Background') }}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="iconbackgroundPicker" id="iconbackgroundPicker">
                            </div>

                            <input type="hidden" id="__widgetconfig-iconbackground" name="__widgetconfig-iconbackground" class="item-widget">
                        </div>
                    </div>
                    <div class="row mb-10 recordgraph-inputs">
                        <div class="col-md-6">
                            <label for="__widgetconfig-graphtype">{{ __('Type') }}</label>
                            <select name="__widgetconfig-graphtype" id="__widgetconfig-graphtype" class="form-control item-widget">
                                <option value="daily">{{ __('Daily') }}</option>
                                <option value="monthly">{{ __('Monthly') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="__widgetconfig-graphperiod">{{ __('Show Last') }}</label>
                            <select name="__widgetconfig-graphperiod" id="__widgetconfig-graphperiod" class="form-control item-widget">
                                <option value="1">{{ __('Month') }}</option>
                                <option value="3">{{ __('3 Months') }}</option>
                                <option value="6">{{ __('6 Months') }}</option>
                                <option value="12">{{ __('Year') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-10 notrecordgraph-inputs">
                        <div class="col-md-12">
                            <label for="__widgetconfig-href">{{ __('URL') }}</label>
                            <input type="text" class="form-control item-widget" id="__widgetconfig-href" name="__widgetconfig-href">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <input type="hidden" id="__widgetconfig-size" name="__widgetconfig-size" class="item-widget">
                        <div class="col-md-4">
                            <label for="large_screen_size">{{ __('Large Screen Size') }}</label>
                            <select id="large_screen_size" name="large_screen_size"  class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12" selected>12</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="medium_screen_size">{{ __('Medium Screen Size') }}</label>
                            <select id="medium_screen_size" name="medium_screen_size"  class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12" selected>12</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="small_screen_size">{{ __('Small Screen Size') }}</label>
                            <select id="small_screen_size" name="small_screen_size"  class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12" selected>12</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-20 recordlist-inputs">
                        <div class="col-md-12">
                            <label for="__widgetconfig-limit">{{ __('Page Length') }}</label>
                            <select name="__widgetconfig-limit" id="__widgetconfig-limit" class="form-control item-widget">
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-20 recordlist-inputs">
                        <div class="col-md-12">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox"
                                    id="__widgetconfig-onlylastrecord"
                                    name="__widgetconfig-onlylastrecord"
                                    class="form-control item-widget"
                                    value="1">
                                <label for="__widgetconfig-onlylastrecord" class="detail-label">
                                    {{ __('Show Only Last Records') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10 recordlist-inputs">
                        <input type="hidden" id="__widgetconfig-columns" name="__widgetconfig-columns" class="item-widget">
                        <input type="hidden" id="__widgetconfig-values" name="__widgetconfig-values" class="item-widget">
                        <div class="col-md-12">
                            <table id="recordlistColumnTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Column') }}</th>
                                        <th>{{ __('Value') }}</th>
                                        <th style="width:20px;"></th>
                                        <th class="text-center" style="width:20px;">
                                            <a id="buttonAddColumn" class="table-icon-primary" href="javascript:void(0);">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyRecordListColumns">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <label for="__widgetconfig-visibility">{{ __('Visibility') }}</label>
                            <select name="__widgetconfig-visibility" id="__widgetconfig-visibility" class="form-control item-widget">
                                <option value="0">{{ __('No') }}</option>
                                <option value="1">{{ __('Yes') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modalfooter justify-content-between show_by_permission">
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button"
                                id="buttonUpdateWidgetItem"
                                name="buttonUpdateWidgetItem"
                                class="btn btn-success float-right">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-RecordListColumns" tabindex="2" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Columns & Values') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="recordlistIndex" name="recordlistIndex" value="0">
                <div class="col-md-12">
                    <label for="recordlistColumn">{{ __('Column Title') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="recordlistColumn" id="recordlistColumn">
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="recordlistValue">{{ __('Value') }}</label>
                    <select id="recordlistValue" name="recordlistValue"  class="form-control">
                    </select>
                </div>
            </div>
            <div class="modalfooter justify-content-between">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button"
                            id="buttonSave-ColumnValue"
                            name="buttonSave-ColumnValue"
                            class="btn btn-success float-right">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalWidgetItemDelete" tabindex="3" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('Delete') }}</h4>
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
                    <div class="col-md-12">
                        <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="button"
                            id="buttonDeleteWidgetItem"
                            name="buttonDeleteWidgetItem"
                            class="btn btn-danger float-right">
                            {{ __('Continue') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="controller" value="{{ $controllerName }}">
<div id="CheckFTPConnectionHTMLDB"
    class="htmldb-table"
    data-htmldb-priority="9000"
    data-htmldb-read-url="htmldb/ftp_server/checkconnection?_token={{ csrf_token() }}"
    data-htmldb-read-only="1">
</div>

<div id="ConfigurationHTMLDB"
    class="htmldb-table"
    data-htmldb-priority="1001"
    data-htmldb-read-url="htmldb/__layout/get_widgetconfig/{{ $controllerName }}?_token={{ csrf_token() }}"
    data-htmldb-write-url="htmldb/__layout/post_widgetconfig/{{ $controllerName }}?_token={{ csrf_token() }}"
    data-htmldb-loader="divLoader">
</div>

<script type="text/html" id="recordlistColumnTemplate">
    <tr id="__column____VALUE__">
        <td>__COLUMN__</td>
        <td>__VALUE__</td>
        <td class="text-center">
            <a data-column="__COLUMN__" data-value="__VALUE__" data-index="__INDEX__" class="table-icon-primary buttonEditColumn" href="javascript:void(0);">
                <i class="fas fa-pen"></i>
            </a>
        </td>
        <td class="text-center">
            <a data-column="__COLUMN__" data-value="__VALUE__" data-index="__INDEX__" class="table-icon-danger buttonRemoveColumn" href="javascript:void(0);">
                <i class="fa fa-times"></i>
            </a>
        </td>
    </tr>
</script>

<div id="AttributeHTMLDB"
    class="htmldb-table"
    data-htmldb-priority="1002"
    data-htmldb-read-url="htmldb/__layout/get_attributes?_token={{ csrf_token() }}"
    data-htmldb-read-only="1">
</div>

<script type="text/html" id="recordlistColumnOptionTemplate">
    <option class="columnOption__MODEL__" value="__ATTRIBUTE__">__ATTRIBUTE__</option>
</script>

<div id="divSaveMessage" class="d-none">{{ __('Widget configuration saved.') }}</div>

<div id="widgetModalTitleDefault" class="d-none">{{ __('Widget Item') }}</div>
<div id="widgetModalTitleinfobox" class="d-none">{{ __('Infobox Widget') }}</div>
<div id="widgetModalTitlerecordlist" class="d-none">{{ __('Record List Widget') }}</div>
<div id="widgetModalTitlerecordgraph" class="d-none">{{ __('Record Graph') }}</div>

<div id="widgetLabelDefault" class="d-none">{{ __('empty') }}</div>
<div id="widgetLabelinfobox" class="d-none">{{ __('infobox') }}</div>
<div id="widgetLabelrecordlist" class="d-none">{{ __('record list') }}</div>
<div id="widgetLabelrecordgraph" class="d-none">{{ __('record graph') }}</div>

<div id="recordgraphLabel" class="d-none">{{ __('Record Count') }}</div>

<div id="WidgetHTMLDB"
    class="htmldb-table"
    data-htmldb-priority="1003"
    data-htmldb-read-url="htmldb/__widgets/get/{{ $controllerName }}?_token={{ csrf_token() }}"
    data-htmldb-read-only="1">
</div>
<script type="text/html" 
    id="widgetTemplate"
    class="htmldb-template"
    data-htmldb-table="WidgetHTMLDB"
    data-htmldb-template-target="widgetContainer">
    @verbatim
    <div class="empty-widget empty-widget-{{type}}">
    </div>
    <div class="{{size}} infobox-{{type}} widget-visible{{visibility}}">
        <div class="info-box clickable-infobox" data-href="{{href}}">
            <span class="info-box-icon elevation-1" style="background-color:{{iconbackground}};"><i class="{{icon}}"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">{{text}}</span>
                <span class="info-box-number" id="{{model}}InfoboxValue">0</span>
            </div>
        </div>
        <div id="{{model}}InfoboxHTMLDBTableContainer" class="infobox-htmldb-table-container" data-row-id="{{id}}"></div>
    </div>
    <div class="{{size}} recordgraph-{{type}} widget-visible{{visibility}}">
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">{{text}}</h3>

                <div class="card-tools">
                    <button type="button" id="buttonSHRecordGraph-{{model}}" class="btn btn-tool buttonSHWidget" data-display="no" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display:none;min-height:250px;">
                <canvas id="{{model}}RecordGraphContainer"></canvas>
            </div>
        </div>
        <div id="{{model}}GraphHTMLDBTableContainer" class="recordgraph-htmldb-table-container" data-row-id="{{id}}"></div>
    </div>
    @endverbatim
    <div class="@{{size}} recordlist-@{{type}} widget-visible@{{visibility}}">
        <div class="card collapsed-card">
            <div class="card-header">
                <h3 class="card-title">@{{text}}</h3>

                <div class="card-tools">
                    <button type="button" id="buttonSHRecords-@{{model}}" class="btn btn-tool buttonSHWidget" data-display="no" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display:none;">
                <div id="@{{model}}RecordListSearchContainer" class="recordlist-search-container" data-row-id="@{{id}}"></div>
                <div id="@{{model}}RecordListContainer" class="recordlist-container" data-row-id="@{{id}}"></div>
                <div id="@{{model}}RecordListPaginationContainer" class="recordlist-pagination-container" data-row-id="@{{id}}"></div>
                <div class="showAllRecordContainer">
                    <a class="showAllRecord@{{onlylastrecord}}" href="@{{href}}">{{ __('View All Records') }}</a>
                </div>
            </div>
        </div>
        @verbatim
        <div id="{{model}}RecordListHTMLDBTableContainer" class="recordlist-htmldb-table-container" data-row-id="{{id}}"></div>
        <div id="{{model}}RecordListHTMLDBTemplateContainer" class="recordlist-htmldb-template-container" data-row-id="{{id}}"></div>
        <div id="{{model}}RecordListModalContainer" class="recordlist-modal-container" data-row-id="{{id}}"></div>
        @endverbatim
    </div>
</script>
<script type="text/html" id="modelInfoboxHTMLBTableTemplate">
    <div id="__MODEL__InfoboxHTMLDB"
        class="__HTMLDBCLASS__ infobox-htmldb-table"
        data-htmldb-priority="__PRIORITY__"
        data-htmldb-read-url="htmldb/__MODEL_LOWERCASE__/get_infoboxvalue/{{ $controllerName }}?_token={{ csrf_token() }}"
        data-htmldb-read-only="1">
    </div>
</script>
<script type="text/html" id="modelGraphHTMLBTableTemplate">
    <div id="__MODEL__RecordGraphHTMLDB"
        class="__HTMLDBCLASS__ recordgraph-htmldb-table"
        data-htmldb-priority="__PRIORITY__"
        data-htmldb-read-url="htmldb/__MODEL_LOWERCASE__/get_recordgraphdata/{{ $controllerName }}"
        data-htmldb-read-only="1">
    </div>
</script>
<script type="text/html" id="modelRecordListHTMLBTableTemplate">
    <div id="__MODEL__HTMLDB"
        class="__HTMLDBCLASS__ recordlist-htmldb-table"
        data-htmldb-priority="__PRIORITY__"
        data-htmldb-read-url="htmldb/__MODEL_LOWERCASE__/get_recordlist/{{ $controllerName }}?_token={{ csrf_token() }}"
        data-htmldb-read-only="1">
    </div>
    <div id="Session__MODEL__HTMLDB"
        class="__HTMLDBCLASS__"
        data-htmldb-priority="__PRIORITY__"
        data-htmldb-read-url="htmldb/__MODEL_LOWERCASE__/get_session/{{ $controllerName }}?_token={{ csrf_token() }}"
        data-htmldb-write-url="htmldb/__MODEL_LOWERCASE__/write_session/{{ $controllerName }}?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>
    <div id="Delete__MODEL__HTMLDB"
        class="__HTMLDBCLASS__ delete-htmldb-table"
        data-htmldb-priority="__PRIORITY__"
        data-htmldb-read-url="htmldb/__MODEL_LOWERCASE__/get_form_delete/{{ $controllerName }}?_token={{ csrf_token() }}"
        data-htmldb-write-url="htmldb/__MODEL_LOWERCASE__/delete/{{ $controllerName }}?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>
</script>
<script type="text/html" id="modelRecordListSearchTemplate">
    <div id="tbody__MODEL__RecordList-searchForm"
        class="input-group input-group-sm divSearchBar htmldb-section float-right"
        data-htmldb-table="Session__MODEL__HTMLDB"
        style="margin-bottom:1rem;">
        <input type="search"
            id="searchText" name="searchText"
            class="form-control float-right inputSearchBar htmldb-input-save"
            placeholder="{{ __('Search') }}"
            data-htmldb-table="Session__MODEL__HTMLDB"
            data-htmldb-input-field="searchText"
            data-htmldb-refresh-table="__MODEL__HTMLDB"
            data-htmldb-table-defaults='{"page":0}'
            data-htmldb-value="@{{searchText}}"
            data-htmldb-save-delay="1000">

        <div class="input-group-append labelSearchBar">
            <button type="button" class="btn btn-default ">
                <img class="imgLoader" src="/assets/adminlte/img/loader.svg" width="14" height="14"/>
                <i class="fas fa-search text-primary"></i>
            </button>
        </div>
    </div>
</script>
<script type="text/html" id="modelRecordListTemplate">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover __TABLE_RECORD_LIST_CLASS__">
            <thead>
                <tr>__TH__</tr>
            </thead>
            <tbody id="tbody__MODEL__RecordList" data-onlylastrecord="__ONLYLASTRECORD__">
            </tbody>
        </table>
    </div>
</script>
<script type="text/html" id="thCheckboxTemplate">
    <th class="text-center show_by_permission">
        <div class="icheck-primary d-inline">
            <input type="checkbox"
                id="tbody__MODEL__RecordList-select_all_row"
                class="select_all_row"
                data-model="__MODEL__"
                data-tbody-id="tbody__MODEL__RecordList"
                data-button-container="tbody__MODEL__RecordList-action_buttons">
            <label for="tbody__MODEL__RecordList-select_all_row"></label>
        </div>
    </th>
</script>
<script type="text/html" id="thTemplate">
    <th>
        <button type="button"
            class="buttonSortColumn buttonTableColumn buttonTableColumn0 htmldb-button-sort"
            data-htmldb-table="Session__MODEL__HTMLDB"
            data-htmldb-sort-field="sortingColumn"
            data-htmldb-sort-value="__VALUE__"
            data-htmldb-direction-field="sortingASC"
            data-htmldb-refresh-table="__MODEL__HTMLDB"
            data-htmldb-table-defaults='{"page":0}'>
            <span>__COLUMN__</span>&nbsp;
            <span class="sorting sorting-loading">
                <img class="imgLoader" src="/assets/adminlte/img/loader.svg" width="14" height="14"/>
            </span>
            <span class="sorting sorting-default text-muted">
                <i class="fa fa-caret-down"></i>
            </span>
            <span class="sorting sorting-desc text-primary">
                <i class="fa fa-caret-down"></i>
            </span>
            <span class="sorting sorting-asc text-primary">
                <i class="fa fa-caret-up"></i>
            </span>
        </button>
    </th>
</script>
<script type="text/html" id="thLastRecordTemplate">
    <th>
        <span>__COLUMN__</span>&nbsp;
    </th>
</script>
<script type="text/html" id="thButtonTemplate">
    <th class="text-center th-btn-1">
        <button type="button"
            id="buttonNew__MODEL__"
            data-href="__MODEL_LOWERCASE__/edit/new"
            class="btn btn-primary btn-xs btn-on-table show_by_permission">
            <i class="fa fa-plus"></i> <span class="hidden-xxs">{{ __('Add') }}</span>
        </button>
        <button type="button"
            id="buttonDelete__MODEL__"
            href="javascript:void(0);"
            class="btn btn-danger btn-xs btn-on-table button-model-delete show_by_permission"
            data-target-input="formDelete__MODEL__-idcsv"
            data-tbody-id="tbody__MODEL__RecordList"
            data-model="__MODEL__"
            style="display:none;">
            <i class="fa fa-trash"></i> <span class="hidden-xxs">{{ __('Delete') }}</span> <span class="selected-count"></span>
        </button>
    </th>
</script>
<div id="modelRecordListHTMLBTemplateTemplate" style="display:none;">
    <script type="text/html" 
        id="tbody__MODEL__RecordListTemplate"
        class="__HTMLDBCLASS__"
        data-htmldb-table="__MODEL__HTMLDB"
        data-htmldb-template-target="tbody__MODEL__RecordList">
        <tr>__TD__</tr>
    </script>
</div>
<script type="text/html" id="tdCheckboxTemplate">
    <td class="text-center show_by_permission">
        <div class="icheck-primary d-inline">
            <input type="checkbox"
                id="tbody__MODEL__RecordList-select_row@{{id}}"
                data-model="__MODEL__"
                data-object-id="@{{id}}"
                class="select_row">
            <label for="tbody__MODEL__RecordList-select_row@{{id}}"></label>
        </div>
    </td>
</script>
<script type="text/html" id="tdTemplate">
    <td>__VALUE__</td>
</script>
<script type="text/html" id="tdLastRecordTemplate">
    <td>__VALUE__</td>
</script>
<script type="text/html" id="tdButtonTemplate">
    <td class="text-center">
        <a class="btn btn-outline-primary btn-xs btn-on-table" href="__MODEL_LOWERCASE__/detail/{{id}}">
            <i class="fa fa-info-circle"></i> <span class="hidden-xxs">{{ __('Detail') }}</span>
        </a>
    </td>
</script>
@verbatim
<script type="text/html" id="modelRecordListPaginationTemplate">
    <ul class="pagination pagination-sm float-right htmldb-pagination htmldb-secondary-pagination"
        data-htmldb-table="Session__MODEL__HTMLDB"
        data-htmldb-page-field="page"
        data-htmldb-page-count-field="pageCount"
        data-htmldb-refresh-table="__MODEL__HTMLDB"
        data-htmldb-table-defaults="">
        <li class="htmldb-pagination-template htmldb-pagination-previous">
            <button class="page-link htmldb-button-page">
                <i class="ion-chevron-left"></i>
            </button>
        </li>
        <li class="htmldb-pagination-template htmldb-pagination-next">
            <button class="page-link htmldb-button-page">
                <i class="ion-chevron-right"></i>
            </button>
        </li>
        <li class="htmldb-pagination-template htmldb-pagination-default">
            <button class="page-link htmldb-button-page">
                <span data-htmldb-content="{{page}}"></span>
            </button>
        </li>
        <li class="htmldb-pagination-template htmldb-pagination-active">
            <button class="page-link htmldb-button-page">
                <span data-htmldb-content="{{page}}"></span>
            </button>
        </li>
        <li class="htmldb-pagination-template htmldb-pagination-hidden">
            <button class="page-link htmldb-button-page" disabled="true">
                <span>...</span>
            </button>
        </li>
    </ul>
</script>
@endverbatim
<script type="text/html" id="modelRecordListModalTemplate">
    <div class="modal fade" id="modal-formDelete__MODEL__">
        <div class="modal-dialog modal-md">
            <form id="formDelete__MODEL__" name="formDelete__MODEL__" method="post" class="form-horizontal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('Selected Record(s) Delete') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden"
                            id="formDelete__MODEL__-id" 
                            name="formDelete__MODEL__-id"
                            value="1">
                        <input type="hidden"
                            id="formDelete__MODEL__-idcsv"
                            name="formDelete__MODEL__-idcsv"
                            value="0">
                        <div class="form-group">
                            <p>{{ __('Selected records will be deleted. Do you confirm?') }}</p>
                        </div>
                    </div>
                    <div class="modalfooter justify-content-between show_by_permission">
                        <div class="row">
                            <div class="col col-lg-12">
                                <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="button"
                                    id="buttonSave-formDelete__MODEL__"
                                    name="buttonSave-formDelete__MODEL__"
                                    data-model="__MODEL__"
                                    class="btn btn-danger float-right">
                                    {{ __('Continue') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</script>

<div class="modal fade" id="modal-formDeleteMultiple">
    <div class="modal-dialog modal-md">
        <form id="formDeleteMultiple" name="formDeleteMultiple" method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Selected Record(s) Delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden"
                        id="formDeleteMultiple-id" 
                        name="formDeleteMultiple-id"
                        value="1">
                    <input type="hidden"
                        id="formDeleteMultiple-classname" 
                        name="formDeleteMultiple-classname"
                        value="">
                    <input type="hidden"
                        id="formDeleteMultiple-attribute" 
                        name="formDeleteMultiple-attribute"
                        value="deleted">
                    <input type="hidden"
                        id="formDeleteMultiple-attribute_value" 
                        name="formDeleteMultiple-attribute_value"
                        value="1">
                    <input type="hidden"
                        id="formDeleteMultiple-idcsv"
                        name="formDeleteMultiple-idcsv"
                        value="0">
                    <div class="form-group">
                        <p>{{ __('Selected records will be deleted. Do you confirm?') }}</p>
                    </div>
                </div>
                <div class="modalfooter justify-content-between show_by_permission">
                    <div class="row">
                        <div class="col col-lg-12">
                            <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">{{ __('Cancel') }}</button>
                            <button type="button"
                                id="buttonSave-formDeleteMultiple"
                                name="buttonSave-formDeleteMultiple"
                                class="btn btn-danger float-right">
                                {{ __('Continue') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="galleryModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="popup-photo" src="">
            </div>
        </div>
    </div>
</div>

@include('adminlte.footer')

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

<!-- bootstrap color picker -->
<script src="/assets/adminlte/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- Toastr -->
<script src="/assets/adminlte/plugins/toastr/toastr.min.js"></script>

<!-- AdminLTE App -->
<script src="/assets/adminlte/js/adminlte.js"></script>
<script src="/assets/adminlte/js/global.js"></script>
<script src="/assets/adminlte/js/htmldb.js"></script>
<script src="/assets/adminlte/js/adminlte.htmldb.js"></script>
<!-- Menu Editor -->
<script src="/assets/adminlte/js/widget_editor.js"></script>
<script src="/assets/adminlte/js/main.js"></script>
<script src="/assets/adminlte/js/adminlte.htmldb.js"></script>