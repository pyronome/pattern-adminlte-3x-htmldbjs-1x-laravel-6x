<div class="modal fade htmldb-dialog-edit" id="modal-Error">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">{{ __('Error') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="pFormErrorText"></p>
            </div>
        </div>
    </div>
</div>

<div class="divDialogContent divLoader" id="divLoader" >
    <img class="center-block" src="/assets/adminlte/img/loader.svg" width="70" height="70" />
    <div id="divLoaderText" class="" data-default-text="{{ __('Loading...') }}"></div>
</div>
    
<div id="__pagepermissionHTMLDB"
    class="htmldb-table"
    data-htmldb-priority="9999"
    data-htmldb-read-url="{{ config('adminlte.main_folder') }}/htmldb/__pagepermission/get/{{ $controllerName }}?_token={{ csrf_token() }}"
    data-htmldb-read-only="1"
    data-htmldb-loader="divLoader">
</div>
@verbatim
<script type="text/html" 
    id="editPermissionTemplate"
    class="htmldb-template"
    data-htmldb-table="__pagepermissionHTMLDB"
    data-htmldb-template-target="editPermission">
    <input type="hidden" id="{{input_id}}" value="{{edit_permission}}">
</script>
@endverbatim
<div id="editPermission" class="d-none"></div>
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.0
    </div>
</footer>