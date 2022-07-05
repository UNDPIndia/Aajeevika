<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="{{ asset('dist/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/admin-custom.css') }}">
    {{-- <link rel="icon" href="{{ asset('assets/images/logo4.png') }}"> --}}

</head>

<style>
    .breadcrumb-item {
        display: none;
    }

    .active {
        background: gray;

    }

    .active a {
        background: gray;
        color: white !important;
    }

</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('admin') }}" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        role="button">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- <a href="{{ url('/admin') }}" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
            </a> -->
            <div class="sidebar">

                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image" style="color: white">
                        {{-- <i class="nav-icon fa fa-user-circle"></i> --}}
                        <img src="{{asset('/public/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                    </div>
                    <div class="info">

                        <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">


                        <li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <?php
                        $userPermission = App\RolePermission::where('user_id', Auth::user()->id)->get();

                        $permArr = [];
                        foreach ($userPermission as $key => $perm) {
                        $permArr[] = $perm->permission_id;
                        }

                        $permission = App\Permission::wherein('id', $permArr)->get();
                        foreach ($permission as $value) { ?>
                        <li class="nav-item @if (url()->current() === url($value->url)) active @endif">
                            <a href="{{ url($value->url) }}" class="nav-link">
                                {{-- <i class="nav-icon fa fa-user-plus"></i> --}}
                                <i class="fas fa-arrow-right"></i>
                                <p>
                                    <?php echo $value->permission_name; ?>
                                </p>
                            </a>
                        </li>
                        <?php }
                        ?>

                        {{-- <li class="nav-item">
                            <a href="{{ url('/admin/shgartisans') }}" class="nav-link">
                                <i class="nav-icon fa fa-user-plus"></i>
                                <p>SHG/ Artisan Management</p>
                            </a>
                        </li>


                        @if (Auth::user()->role_id == '5')
                            <li class="nav-item">
                                <a href="{{ url('/admin/users') }}" class="nav-link">
                                    <i class="nav-icon fa fa-user-circle"></i>
                                    <p>User Management</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ url('/admin/adminuser') }}" class="nav-link">
                                    <i class="nav-icon fa fa-user-circle"></i>
                                    <p>Admin User Management</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ url('/admin/products') }}" class="nav-link">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>Product Management</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/admin/document') }}" class="nav-link">
                                <i class="nav-icon fa fa-book" aria-hidden="true"></i>
                                <p>Document Management</p>
                            </a>
                        </li>


                        @if (Auth::user()->role_id == '5')
                            <li class="nav-item">
                                <a href="{{ url('/admin/category') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                    <p>Category Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/material') }}" class="nav-link">
                                    <i class="nav-icon fa fa-list-alt" aria-hidden="true"></i>
                                    <p>Material Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/templates') }}" class="nav-link">
                                    <i class="nav-icon fa fa-file" aria-hidden="true"></i>
                                    <p>Template Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/role') }}" class="nav-link">
                                    <i class="nav-icon fa fa-user-secret" aria-hidden="true"></i>
                                    <p>Role Management</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('/admin/banner') }}" class="nav-link">
                                    <i class="nav-icon fa fa-bell" aria-hidden="true"></i>
                                    <p>Banner Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/notification') }}" class="nav-link">
                                    <i class="nav-icon fa fa-bell" aria-hidden="true"></i>
                                    <p>Promo & Marketing Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a target="_blank" href="{{ url('/blog/wp-admin') }}" class="nav-link">
                                    <i class="nav-icon fa fa-rss" aria-hidden="true"></i>
                                    <p>Blog Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/popularproducts') }}" class="nav-link">
                                    <i class="nav-icon fa fa-fire" aria-hidden="true"></i>
                                    <p>Popular Product Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/popupmanager') }}" class="nav-link">
                                    <i class="nav-icon fas fa-chart-bar"></i>
                                    <p>Pop-up Management</p>
                                </a>
                            </li>

                        @endif --}}


                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a
                    href="javascript:void(0)">{{ config('app.name', 'Laravel') }}</a>.</strong> All rights
            reserved.
        </footer>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
    <!-- Magnific Popup core JS file -->
    <script src="{{ asset('dist/js/jquery.magnific-popup.min.js') }}"></script>
    <script>
$(document).ready(function() {

	$('.image-popup-vertical-fit').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
		
	});
    // Reply grivence form

        $('#replyModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var grievance_id = button.data('grievance_id') // Extract info from data-* attributes
        console.log("grievance_id", grievance_id);
        $("#input_grievance_id").val(grievance_id);
    });

});
</script>
    @yield('script')
</body>

</html>
