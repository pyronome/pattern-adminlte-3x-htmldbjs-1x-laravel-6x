@include('adminlte.head')
<body class="sidebar-mini layout-fixed control-sidebar-slide-open {{ $customization['body'] }}" data-url-prefix="" data-page-initializing="1" data-page-url="profile">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                {{ __('Profile Detail') }}
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item enabled">{{ __('Profile Detail') }}</li>
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
                                <div class="card-header">
                                    <div class="card-tools">
                                        <a  class="btn btn-primary btn-xs btn-on-table text-white"
                                            href="/{{ config('adminlte.main_folder') }}/profile/edit">
                                            <i class="fas fa-pencil-alt" aria-hidden="true"></i> <span>{{ __('Edit') }}</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-12 order-1 order-md-2">
                                            <div class="text-muted text-sm">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('adminlte.footer')
    <div id="ProfileHTMLDB"
        class="htmldb-table"
        data-htmldb-priority="1"
        data-htmldb-read-url="/{{ config('adminlte.main_folder') }}/htmldb/profile/get?_token={{ csrf_token() }}"
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
    <script src="/assets/adminlte/js/profile_detail.js"></script>    
</body>
</html>
