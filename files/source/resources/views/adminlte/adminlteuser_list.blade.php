@include('adminlte.head')
<body class="sidebar-mini layout-fixed control-sidebar-slide-open {{ $customization['body'] }}" data-url-prefix="" data-page-url="adminlteuser">
    @include('adminlte.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('User List') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/{{ config('adminlte.main_folder') }}/home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item enabled">{{ __('User List') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div id="widgetContainer" class="row">
                    </div>
                </div>
            </section> 
        </div>
    </div>
    @include('adminlte.widgets')
    <script src="/assets/adminlte/js/adminlteuser_list.js"></script>
</body>
</html>
