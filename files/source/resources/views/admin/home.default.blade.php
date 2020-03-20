@include('admin.head')
<body class="hold-transition sidebar-mini layout-fixed text-sm" data-url-prefix="" data-page-url="home">
    @include('admin.header')
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ __('Home') }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">{{ __('Home') }}</li>
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
    <script src="assets/js/home.js"></script>
</body>
</html>