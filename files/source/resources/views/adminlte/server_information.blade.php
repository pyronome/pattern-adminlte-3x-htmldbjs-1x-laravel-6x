@include('adminlte.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-initializing="1" data-page-url="server_information">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                {{ __('Server Information') }}
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item enabled">{{ __('Server Information') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content htmldb-section" data-htmldb-table="ServerInformationHTMLDB">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="card card-solid">
                                <div class="card-body pb-0">
                                    <div class="row d-flex align-items-stretch">
                                        <div class="col-12 col-sm-12 col-md-6 d-flex align-items-stretch">
                                            <div class="card bg-light server_info_card">
                                                <div class="card-header text-muted border-bottom-0">
                                                    {{ __('Operating System') }}
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>@{{OS_header}}</b></h2>
                                                            <p class="text-muted text-sm">@{{OS_detail}}</p>
                                                        </div>
                                                        <div class="col-5 text-right">
                                                            <img data-htmldb-content="/assets/adminlte/img/@{{OS_icon_src}}" src="" alt="" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 d-flex align-items-stretch">
                                            <div class="card bg-light server_info_card">
                                                <div class="card-header text-muted border-bottom-0">
                                                    {{ __('Web Server') }}
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>@{{WEB_header}}</b></h2>
                                                            <p class="text-muted text-sm">@{{WEB_detail}}</p>
                                                        </div>
                                                        <div class="col-5 text-right">
                                                            <img data-htmldb-content="/assets/adminlte/img/@{{WEB_icon_src}}" src="" alt="" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 d-flex align-items-stretch">
                                            <div class="card bg-light server_info_card">
                                                <div class="card-header text-muted border-bottom-0">
                                                    {{ __('Application Server') }}
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>@{{APP_header}}</b></h2>
                                                            <p class="text-muted text-sm">@{{APP_detail}}</p>
                                                        </div>
                                                        <div class="col-5 text-right">
                                                            <img data-htmldb-content="/assets/adminlte/img/@{{APP_icon_src}}" src="" alt="" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6 d-flex align-items-stretch">
                                            <div class="card bg-light server_info_card">
                                                <div class="card-header text-muted border-bottom-0">
                                                    {{ __('Database Server') }}
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <h2 class="lead"><b>@{{DB_header}}</b></h2>
                                                            <p class="text-muted text-sm">@{{DB_detail}}</p>
                                                        </div>
                                                        <div class="col-5 text-right">
                                                            <img data-htmldb-content="/assets/adminlte/img/@{{DB_icon_src}}" alt="" class="img-fluid">
                                                        </div>
                                                    </div>
                                                </div>
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
    <div id="ServerInformationHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="htmldb/server_information/get?_token={{ csrf_token() }}"
        data-htmldb-read-only="1"
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
    <script src="/assets/adminlte/js/server_information.js"></script>    
</body>
</html>