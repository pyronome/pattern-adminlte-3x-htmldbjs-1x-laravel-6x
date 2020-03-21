@include('admin.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="__systemusergroup">
    @include('admin.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('User Group List') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="home">{{ __('Home') }}</a></li>
                                <li class="breadcrumb-item enabled">{{ __('User Group List') }}</li>
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
    @include('admin.widgets')
    <script src="/assets/adminlte/js/__systemusergroup.list.js"></script>
</body>
</html>