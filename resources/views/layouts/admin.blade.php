<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Car wash</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <?php if(config('app.locale', 'en')=='ar') { ?>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlteRTL/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlteRTL/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlteRTL/dist/css/custom.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">

    <?php } else { ?>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlteRTL/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlteRTL/dist/css/adminlte.min.css') }}">

    <?php } ?>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script> window.default_locale_lang = "{{ config('app.locale') }}"; </script>

</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper" id='app'>
        {{ mearge_dic('1.json')}}
        {{ mearge_dic('2.json')}}
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="home" class="nav-link">{{ t('2') }}</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">{{ t('3') }}</a>
                </li>
            </ul>

            {{--  search part  --}}
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <ul class="navbar-nav ml-auto">
                {{--  messages part  --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="{{ asset('vendor/adminlte/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="{{ asset('vendor/adminlte/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <img src="#" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>

                {{--  notifications part  --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>

                {{--  languages part   --}}
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i  @if(config('app.locale', 'en')=='en') class="flag-icon flag-icon-us"  @else class="flag-icon flag-icon-sa" @endif ></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-0">
                        <a href="lang/en"  @if(config('app.locale', 'en')=='en')  class="dropdown-item active" @else  class="dropdown-item"    @endif >
                            <i class="flag-icon flag-icon-us mr-2"></i> {{ t('4') }}
                        </a>
                        <a href="lang/ar"  @if(config('app.locale', 'en')=='ar') class="dropdown-item active" @else   class="dropdown-item"    @endif>
                            <i class="flag-icon flag-icon-sa mr-2"></i> {{ t('5') }}
                        </a>
                    </div>
                </li>


                {{--  logged user and logout link  --}}
                <li>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ session('user')->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/logout">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        {{--  company logo, company name, logged in user name and main sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/home" class="brand-link">
                <div class="row justify-content-center mb-2">
                    <img src="{{ asset('storage/noImage.jpg') }}" alt="AdminLTE Logo" class="rounded-circle img-responsive elevation-3"
                    style="opacity: 1;height:70px;">
                </div>
                <div class="row  justify-content-center">
                    <span class="brand-text font-weight-light">{{ t('6') }}</span>
                </div>
                <div class="row  justify-content-center">
                    <span class="brand-text font-weight-light">{{ session('user')->name }}</span>
                </div>
            </a>

            {{--  main sidebar  --}}
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview {{ url()->current()==url('/tag_setup')?'menu-open':''  }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Setup
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview" style="{{ url()->current()==url('/tag_setup')?'display:block':'' }}">
                                <li class="nav-item {{  url()->current()==url('/tag_setup')?'current':'' }}">
                                    <router-link to='/tag_setup' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tag Setup</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ url()->current()==url('/finance')?'menu-open':''  }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Finance
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview" style="{{ url()->current()==url('/jornals')?'display:block':'' }}">
                                <li class="nav-item {{  url()->current()==url('/jornals')?'current':'' }}">
                                    <router-link to='/jornals' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jornals</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview" style="{{ url()->current()==url('/chart_of_account')?'display:block':'' }}">
                                <li class="nav-item {{  url()->current()==url('/chart_of_account')?'current':'' }}">
                                    <router-link to='/chart_of_account' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Chart of Accounts</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview {{ url()->current()==url('/employees')?'menu-open':''  }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Employees
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview" style="{{ url()->current()==url('/manage_emp')?'display:block':'' }}">
                                <li class="nav-item {{  url()->current()==url('/manage_emp')?'current':'' }}">
                                    <router-link to='/manage_emp' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Employees Management</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview" style="{{ url()->current()==url('/manage_role')?'display:block':'' }}">
                                <li class="nav-item {{  url()->current()==url('/manage_role')?'current':'' }}">
                                    <router-link to='/manage_role' class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Employee Role</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        {{--  router view and progress bar  --}}
        <div class="content-wrapper">
            <div class="content-header" ></div>
            <div class="content" >
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Copyright &copy; 2015-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script src="{{asset('vendor/adminlteRTL/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('vendor/adminlteRTL/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{asset('vendor/adminlteRTL/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
