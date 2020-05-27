@include('adminlte.head')
<body class="sidebar-mini layout-fixed control-sidebar-slide-open {{ $customization['body'] }}" data-url-prefix="" data-page-url="profile" data-main-folder="{{ config('adminlte.main_folder') }}">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Profile Edit') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Profile Edit') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content htmldb-section" data-htmldb-table="ProfileHTMLDB">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="card">
                                <div id="formProfile" class="card-body htmldb-form" data-htmldb-table="ProfileHTMLDB">
                                    <input type="hidden"
                                        id="formProfile-id"
                                        name="formProfile-id"
                                        class="htmldb-field"
                                        data-htmldb-field="id"
                                        value=""/>
                                    <div class="row ">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formObject-profile_img" class="detail-label">{{ __('Profile Image') }}  </label>
                                            <div class="input-field">
                                                <input type="hidden"
                                                    class="form-control htmldb-field"
                                                    id="formObject-profile_img"
                                                    name="formObject-profile_img"
                                                    data-htmldb-field="profile_img"
                                                    data-htmldb-value="@{{profile_img}}"
                                                    data-target-field="AdminLTEUser/profile_img"
                                                    data-media-type="2"
                                                    data-max-file-count="1"
                                                    
                                                />
                                                <button type="button"
                                                    id="buttonBrowseprofile_imgFiles"
                                                    name="buttonBrowseprofile_imgFiles" 
                                                    class="buttonBrowseFile btn btn-primary show_by_permission"
                                                    data-target-file-list="ulprofile_imgFileList">
                                                    <i class="ion-ios-folder"></i>&nbsp;{{ __('Browse...') }}
                                                </button>
                                                <ul id="ulprofile_imgFileList" class="col s12 collection ulFileList" data-target-input-id="formObject-profile_img">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formProfile-fullname" class="detail-label">{{ __('Fullname') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="formProfile-fullname"
                                                name="formProfile-fullname"
                                                data-htmldb-field="fullname"
                                                data-htmldb-value="@{{fullname}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formProfile-username" class="detail-label">{{ __('Username') }}</label>
                                            <input type="text"
                                                class="form-control htmldb-field"
                                                id="formProfile-username"
                                                name="formProfile-username"
                                                data-htmldb-field="username"
                                                data-htmldb-value="@{{username}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-12 col-md-12 col-xs-12">
                                            <label for="formProfile-email" class="detail-label">{{ __('Email') }}</label>
                                            <input type="email"
                                                class="form-control htmldb-field"
                                                id="formProfile-email"
                                                name="formProfile-email"
                                                data-htmldb-field="email"
                                                data-htmldb-value="@{{email}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="formProfile-password0" class="detail-label">{{ __('Current Password') }}</label>
                                        <input type="password"
                                            class="form-control htmldb-field"
                                            id="formProfile-password0"
                                            name="formProfile-password0"
                                            data-htmldb-field="password0"
                                            autocomplete="new-password">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="formProfile-password1" class="detail-label">{{ __('New Password') }}</label>
                                        <input type="password"
                                            class="form-control htmldb-field"
                                            id="formProfile-password1"
                                            name="formProfile-password1"
                                            data-htmldb-field="password1"
                                            autocomplete="new-password">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="formProfile-password2" class="detail-label">{{ __('New Password (Re-Type)') }}</label>
                                        <input type="password"
                                            class="form-control htmldb-field"
                                            id="formProfile-password2"
                                            name="formProfile-password2"
                                            data-htmldb-field="password2"
                                            autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class=" col-md-12">
                                        <button type="button"
                                            id="buttonSubmit-formProfile"
                                            name="buttonSubmit-formProfile"
                                            class="btn btn-success btn-md btn-on-table float-right htmldb-button-save"
                                            data-htmldb-form="formProfile">
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

    <div id="AdminLTEUser_FileHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="0"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/profile/get_files?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
        data-htmldb-loader="divLoader">
    </div>
    <div style="display:none;">
        <div id="dropzone-data" data-target-model="AdminLTEUser" data-target-file-list="" data-media-type="" data-action="/{{ config('adminlte.main_folder') }}/media/formupload?_token={{ csrf_token() }}">
            <form id="formUpload" name="formUpload" action="/{{ config('adminlte.main_folder') }}/media/formupload?_token={{ csrf_token() }}" onsubmit="return false;" enctype="multipart/form-data">
                <div id="divDropzone" class="divDropzone row dz-clickable" style="min-height: 400px;">
                    <div class="col s12">
                        <ul id="ulUploadedFiles" class="ulUploadedFiles"></ul>
                        <div id="divUploaderInputContainer">
                            <input accept=".3gp,.7z,.ae,.ai,.avi,.bmp,.cdr,.csv,.divx,.doc,.docx,.dwg,.eps,.flv,.gif,.gz,.ico,.iso,.jpg,.jpeg,.mov,.mp3,.mp4,.mpeg,.pdf,.png,.ppt,.ps,.psd,.rar,.svg,.swf,.tar,.tiff,.txt,.wav,.zip" id="inputUploadMedia" multiple="multiple" name="inputUploadMedia" class="inputUploader" style="display:none;" type="file">
                            <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="5120000">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/html" id="ulFileListTemplate">
        <span class="grippy"></span>
        <a href="" target="_blank" class="aFileListItemFileURL mediaImageContainer aMediaType__MEDIA_TYPE__">
            <img width="64" src="" alt="" class="imgFileListItemFileURL">
        </a>
        <a href="" target="_blank" class="aFileListItemFileURL mediaFilenameContainer text-primary aMediaType__MEDIA_TYPE__">
            <span class="title" class="spanFileListItemFileName">__FILE_NAME__</span>
        </a>
        <a href="JavaScript:void(0);" class="aDeleteFileListItem secondary-content text-primary float-right">
            <i class="ion-android-close"></i>
        </a>
    </script>

    <script type="text/html" 
        id="modelEditPage_imageTemplate"
        class="htmldb-template"
        data-htmldb-table="AdminLTEUser_FileHTMLDB"
        data-htmldb-template-target="ul@{{object_property}}FileList"
        data-htmldb-filter="media_type/eq/2">
        <li id="liFileListItem@{{id}}"
            class="collection-item liMediaType2"
            data-object-id="@{{id}}"
            data-file-name="@{{file_name}}"
            data-file-path="@{{path}}"
            data-media-type="2">
            <span class="grippy"></span>
            <a href="{{ URL::asset('/storage/') }}/@{{path}}" target="_blank" class="aFileListItemFileURL mediaImageContainer aMediaType2">
                <img width="64" src="{{ URL::asset('/storage/') }}/@{{path}}" alt="" class="imgFileListItemFileURL">
            </a>
            <a href="{{ URL::asset('/storage/') }}/@{{path}}" target="_blank" class="aFileListItemFileURL mediaFilenameContainer text-primary aMediaType2">
                <span class="title" class="spanFileListItemFileName">@{{file_name}}</span>
            </a>
            <a href="JavaScript:void(0);" class="aDeleteFileListItem secondary-content text-primary float-right">
                <i class="ion-android-close"></i>
            </a>
        </li>
    </script> 

    <div id="ProfileHTMLDB"
        class="htmldb-table"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/profile/get_form_values?_token={{ csrf_token() }}"
        data-htmldb-write-url="/{{ config('adminlte.main_folder') }}/htmldb/profile/post?_token={{ csrf_token() }}"
        data-htmldb-loader="divLoader">
    </div>
    
    <div id="divSaveMessage" class="d-none">{{ __('Your profile saved.') }}</div>

    <!-- jQuery -->
    <script src="/assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    
    <!-- Toastr -->
    <script src="/assets/adminlte/plugins/toastr/toastr.min.js"></script>
    
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
    <script src="/assets/adminlte/js/profile_edit.js"></script>
</body>
</html>
