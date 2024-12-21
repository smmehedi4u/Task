<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Bytedash - Admin Template</title>

    <!-- favicon -->
    <link rel=icon href={{ asset('html/favicons.png') }}" sizes="16x16" type="icon/png">
    <!-- animate -->
    <link rel="stylesheet" href={{ asset('html/assets/css/animate.css') }}>
    <!-- bootstrap -->
    <link rel="stylesheet" href={{ asset('html/assets/css/bootstrap.min.css') }}>
    <!-- All Icon -->
    <link rel="stylesheet" href={{ asset('html/assets/css/icon.css') }}>
    <!-- slick carousel  -->
    <link rel="stylesheet" href={{ asset('html/assets/css/slick.css') }}>
    <!-- Select2 Css -->
    <link rel="stylesheet" href={{ asset('html/assets/css/select2.min.css') }}>
    <!-- Sweet alert Css -->
    <link rel="stylesheet" href={{ asset('html/assets/css/sweetalert.css') }}>
    <!-- Flatpickr Css -->
    <link rel="stylesheet" href={{ asset('html/assets/css/flatpickr.min.css') }}>
    <!-- Fancy box Css -->
    <link rel="stylesheet" href={{ asset('html/assets/css/fancybox.css') }}>
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href={{ asset('html/assets/css/dashboard.css') }}>
    <!-- dark css -->

</head>

<body>

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="loader_bars">
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- Dashboard start -->
    <div class="body-overlay"></div>
    <div class="dashboard__area">
        <div class="container-fluid p-0">
            <div class="dashboard__contents__wrapper">
                <div class="dashboard__left dashboard-left-content">
                    <div class="dashboard__left__main">
                        <div class="dashboard__left__close close-bars"><i class="fa-solid fa-times"></i></div>
                        <div class="dashboard__top">
                            <div class="dashboard__top__logo">
                                <a href="index.html">
                                    <img class="main_logo" src="html/assets/img/logo.webp" alt="logo">
                                    <img class="iocn_view__logo" src="html/assets/img/Favicon.png" alt="logo_icon">
                                </a>
                            </div>
                        </div>
                        <div class="dashboard__bottom mt-5">
                            <ul class="dashboard__bottom__list dashboard-list">
                                <li class="dashboard__bottom__list__item has-children show open active">
                                    <a href="javascript:void(0)"><i class="material-symbols-outlined">dashboard</i>
                                        <span class="icon_title">Dashboard</span></a>
                                    <ul class="submenu">
                                        <li class="dashboard__bottom__list__item {{ Route::is('home') ? 'selected' : '' }}">
                                            <a href="/">Country</a>
                                        </li>
                                        <li class="dashboard__bottom__list__item {{ Route::is('state.index') ? 'selected' : '' }}">
                                            <a href="{{ route('state.index') }}">States</a>
                                        </li>
                                        <li class="dashboard__bottom__list__item {{ Route::is('city.index') ? 'selected' : '' }}">
                                            <a href="{{ route('city.index') }}">Cities</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="dashboard__right">
                    <div class="dashboard__header single_border_bottom">
                        <div class="row gx-4 align-items-center justify-content-between">
                            <div class="col-sm-2">
                                <div class="dashboard__header__left">
                                    <div class="dashboard__header__left__inner">
                                        <span class="dashboard__sidebarIcon d-none d-lg-block"></span>
                                        <span class="dashboard__sidebarIcon__mobile sidebar-icon d-lg-none"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 d-none d-sm-block">
                                <div class="dashboard__header__middle">
                                    <div class="dashboard__header__middle__search">
                                        {{-- <div class="dashboard__header__middle__search__item">
                                            <input class="form--control radius-5" type="text"
                                                placeholder="Search anything...">
                                            <button class="search_icon"><i
                                                    class="material-symbols-outlined">search</i></button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="dashboard__header__right">
                                    <div class="dashboard__header__right__flex">
                                        <div class="dashboard__header__right__item responsive_search">
                                            <a href="javascript:void(0)" class="dashboard__search__icon search__click">
                                                <i class="material-symbols-outlined">search</i> </a>
                                            {{-- <div class="search__wrapper">
                                                <form class="search__wrapper__form" action="#">
                                                    <div class="search__wrapper__close"> <i
                                                            class="fa-solid fa-times"></i> </div>
                                                    <input class="search__wrapper__input" type="text"
                                                        placeholder="Search Here.....">
                                                    <button type="submit"><i
                                                            class="material-symbols-outlined">search</i></button>
                                                </form>
                                            </div> --}}
                                        </div>
                                        <div class="dashboard__header__right__item">
                                            <a href="javascript:void(0)"
                                                class="dashboard__header__notification__icon lightMode"
                                                id="mode_change"> <i class="material-symbols-outlined">wb_sunny</i>
                                            </a>
                                        </div>
                                        <div class="dashboard__header__right__item">
                                            <div class="dashboard__header__author">
                                                <a href="javascript:void(0)"
                                                    class="dashboard__header__author__flex flex-btn">
                                                    <div class="dashboard__header__author__thumb">
                                                        <img src="html/assets/img/author_nav_new.jpg" alt="authorImg">
                                                    </div>
                                                </a>
                                                <div class="dashboard__header__author__wrapper">
                                                    <div class="dashboard__header__author__wrapper__list">
                                                        @guest
                                                            <!-- Links for guests (not logged in) -->
                                                            <a href="{{ route('login') }}" class="dashboard__header__author__wrapper__list__item">
                                                                Log In
                                                            </a>
                                                            <a href="{{ route('register') }}" class="dashboard__header__author__wrapper__list__item">
                                                                Registration
                                                            </a>
                                                        @endguest

                                                        @auth
                                                            <!-- Links for logged-in users -->
                                                            <a href="{{ route('logout') }}" class="dashboard__header__author__wrapper__list__item"
                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                                Log Out
                                                            </a>
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        @endauth
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <main>
                        @yield('content')
                    </main>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Dashboard end -->





    <!-- jquery -->
    <script src="{{ asset('html/assets/js/jquery-3.6.0.min.js') }}"></script>
    <!-- jquery Migrate -->
    <script src="{{ asset('html/assets/js/jquery-migrate.min.js') }}"></script>
    <!-- bootstrap -->
    <script src="{{ asset('html/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('html/assets/js/slick.js') }}"></script>
    <!-- Plugins Js -->
    <script src="{{ asset('html/assets/js/plugin.js') }}"></script>
    <!-- Fancy Box Js -->
    <script src="{{ asset('html/assets/js/fancybox.umd.js') }}"></script>

    <!-- main js -->
    <script src="{{ asset('html/assets/js/main.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>


    @stack('javascript')


</body>

</html>
