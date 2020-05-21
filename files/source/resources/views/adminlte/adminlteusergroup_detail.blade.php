@include('adminlte.head')
<body class="sidebar-mini layout-fixed control-sidebar-slide-open {{ $customization['body'] }}" data-url-prefix="" data-page-initializing="1" data-page-url="adminlteusergroup">
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
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/adminlteusergroup/list">{{ __('User Group List') }}</a></li>
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
                                            href="/{{ config('adminlte.main_folder') }}/adminlteusergroup/edit/@{{id}}">
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
    <script src="/assets/adminlte/js/adminlteusergroup_detail.js"></script>
</body>
</html>
