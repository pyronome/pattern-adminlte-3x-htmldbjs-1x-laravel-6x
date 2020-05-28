
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand {{ $customization['main-header'] }}">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Widget Configuration -->
                <li class="nav-item dropdown">
                    <a id="buttonWidgetConfig" class="nav-link" href="javascript:void(0);" style="display:none;">
                        <i class="fas fa-palette nav-icon"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar {{ $customization['main-sidebar'] }} elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link {{ $customization['brand-link'] }}">
                <img src="{{ config('adminlte.brand_logo') }}" alt="Brand Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('adminlte.project_title') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ $user['image'] }}" class="img-circle elevation-2" alt="Profile Image">
                    </div>
                    <div class="info">
                        <a href="/{{ config('adminlte.main_folder') }}/profile/detail" class="d-block">{{ $user['name'] }}</a>
                    </div>
                </div>

                @include('adminlte.divmenulayer')
