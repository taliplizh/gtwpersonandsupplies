<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>Gotowin</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="gtw-backoffice">
        <meta name="author" content="backoffice">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="gtw-backoffice">
        <meta property="og:site_name" content="gtw">
        <meta property="og:description" content="gtw-backoffice">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

      <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('asset/media/favicons/logo_cir.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('asset/media/favicons/logo_cir.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('asset/media/favicons/apple-touch-icon-180x180.png') }}">

    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
   
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <link rel="stylesheet" id="css-main" href="{{ asset('asset/css/dashmix.css') }}">
        <link rel="stylesheet" id="css-theme" href="{{ asset('asset/css/themes/xpro.css') }}">
        <link rel="stylesheet" href="{{asset('css/stylesl.css')}}">
        <!-- END Stylesheets -->
     <style>

        #page-container.main-content-boxed > #page-header .content-header, #page-container.main-content-boxed > #page-header .content, #page-container.main-content-boxed > #main-container .content, #page-container.main-content-boxed > #page-footer .content {
            max-width: 1399px;
        }
         .fix{
            position: fixed;
            width: 100%;
            z-index: 5;
         }
     </style>   
        @yield('css_before')
        
          
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/js/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>
        {{-- <link rel="stylesheet" href="{{ asset('assets/js/sweetalert2/sweetalert2.min.css') }}">
        <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.js" integrity="sha512-33a7z5UWvWHAxBi0waVWN71V1WSXylTH1Iier1lEZdKxvE4RdoYkOKWazVr9av5O1GS6aaOcE3nUB3sPQRA7Jg==" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.css" integrity="sha512-EeZYT52DgUwGU45iNoywycYyJW/C2irAZhp2RZAA0X4KtgE4XbqUl9zXydANcIlEuF+BXpsooxzkPW081bqoBQ==" crossorigin="anonymous" />

      
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> 
        <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
    </head>
    <body>
    
        <div id="page-container" class="page-header-dark main-content-boxed page-header-fixed">

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header"  >
                    <!-- Left Section -->
                    <div class="d-flex align-items-center">
                        <!-- Logo -->
                      
                        <a class="link-fx font-size-lg font-w600 text-white" href="">
                        <i class="fa fa-1.5x fa-donate text-warning"></i>
                            <span class="text-white-50"></span><span class="text-white" style="font-weight: normal;font-family: 'Kanit', sans-serif;">งานพัสดุ</span>
                        </a>
                        <!-- END Logo -->

                        <!-- Open Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                   
                        <!-- END Open Search Section -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div>
                        <!-- User Dropdown -->
                        <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-fw fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block" style=" font-family: 'Kanit', sans-serif; font-weight: normal;" >{{ Auth::user()->name }} </span>
                                <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                                <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                                   User Options
                                </div>
                                <div class="p-2">
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="far fa-fw fa-user mr-1"></i> Profile
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                                        <span><i class="far fa-fw fa-envelope mr-1"></i> Inbox</span>
                                        <span class="badge badge-primary">3</span>
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="far fa-fw fa-file-alt mr-1"></i> Invoices
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>

                                    <!-- Toggle Side Overlay -->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                                        <i class="far fa-fw fa-building mr-1"></i> Settings
                                    </a>
                                    <!-- END Side Overlay -->

                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Sign Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                                

                                </div>
                            </div>
                        </div>
                        <!-- END User Dropdown -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header bg-header-dark">
                    <div class="content-header">
                        <form class="w-100" action="be_pages_generic_search.html" method="POST">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-primary" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-fw fa-times-circle"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" placeholder="Search your websites.." id="page-header-search-input" name="page-header-search-input">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-2x fa-spinner fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <!-- Main Container -->
            <main id="main-container">

                <!-- Navigation -->
                <div class="bg-white fix">
                    <div >
                        <!-- Toggle Main Navigation -->
                        <div class="d-lg-none push">
                            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                                Menu
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                        <!-- END Toggle Main Navigation -->

                        <!-- Main Navigation -->
                        <div id="main-navigation" class="d-none d-lg-block ">
                      
                            <ul class="nav-main nav-main-horizontal nav-main-hover" style="width: 95%;margin: auto;">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('manager_supplies/dashboard') ? ' active' : '' }}" href="{{ url('manager_supplies/dashboard') }}">
                                        <i class="nav-main-link-icon fa fa-chart-pie"></i>
                                        <span class="nav-main-link-name" style="font-size: 14px;font-family: 'Kanit', sans-serif;">Dashboard</span>
                    
                                    </a>
                                </li>
                                <li class="nav-main-item"> 
                                        <a class="nav-main-link{{ request()->is('manager_supplies/requestforbuy') ? ' active' : '' }}" href="{{ url('manager_supplies/requestforbuy') }}">
                                        <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                                        <span class="nav-main-link-name" style="font-size: 14px;font-family: 'Kanit', sans-serif;">ขอซื้อขอจ้าง</span>
                    
                                    </a>
                                </li>
                                <li class="nav-main-item"> 
                                        <a class="nav-main-link{{ request()->is('manager_supplies/purchase') ? ' active' : '' }}" href="{{ url('manager_supplies/purchase') }}">
                                        <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                                        <span class="nav-main-link-name" style="font-size: 14px;font-family: 'Kanit', sans-serif;">จัดซื้อจัดจ้าง</span>
                    
                                    </a>
                                </li>
                                <li class="nav-main-item"> 
                                <a class="nav-main-link{{ request()->is('manager_supplies/suppliesinfosub/parcel') ? ' active' : '' }}" href="{{ url('manager_supplies/suppliesinfosub/parcel') }}">
                                        <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                                        <span class="nav-main-link-name" style="font-size: 14px;font-family: 'Kanit', sans-serif;">ข้อมูลวัสดุ</span>
                    
                                    </a>
                                </li>
                                <li class="nav-main-item"> 
                                <a class="nav-main-link{{ request()->is('manager_supplies/suppliesinfosub/article') ? ' active' : '' }}" href="{{ url('manager_supplies/suppliesinfosub/article') }}">
                                        <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                                        <span class="nav-main-link-name" style="font-size: 14px;font-family: 'Kanit', sans-serif;">ข้อมูลครุภัณฑ์</span>
                    
                                    </a>
                                </li>
                                <li class="nav-main-item"> 
                                <a class="nav-main-link{{ request()->is('manager_supplies/suppliesinfosub/service') ? ' active' : '' }}" href="{{ url('manager_supplies/suppliesinfosub/service') }}">
                                        <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                                        <span class="nav-main-link-name" style="font-size: 14px;font-family: 'Kanit', sans-serif;">ข้อมูลบริการ</span>
                    
                                    </a>
                                </li>
                                <li class="nav-main-item"> 
                                <a class="nav-main-link{{ request()->is('manager_supplies/suppliesinfosub/building') ? ' active' : '' }}" href="{{ url('manager_supplies/suppliesinfosub/building') }}">
                                        <i class="nav-main-link-icon fa fa-calendar-alt"></i>
                                        <span class="nav-main-link-name" style="font-size: 14px;font-family: 'Kanit', sans-serif;">ข้อมูลสิ่งปลูกสร้าง</span>
                    
                                    </a>
                                </li>
                            
                             

                                <li class="nav-main-item">
                                <a class="nav-main-link{{ request()->is('manager_supplies/infosoldout') ? ' active' : '' }}" href="{{ url('manager_supplies/infosoldout') }}">
                                        <i class="nav-main-link-icon fa fa-clipboard-list"></i>
                                        <span class="nav-main-link-name" style="font-size: 14px;font-family: 'Kanit', sans-serif;">ขายทอดตลาด</span>
                    
                                    </a>
                                </li>


                                <li class="nav-main-item">
                                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                                        <i class="nav-main-link-icon fa fa-clipboard-list"></i>
                                        <span class="nav-main-link-name">ตั้งค่า</span>
                                    </a>
                                    <ul class="nav-main-submenu">

  
                                    <li class="nav-main-item">
                                            <a class="nav-main-link" href="{{ url('manager_supplies/setupsuppliesvendor') }}">
                                                <span class="nav-main-link-name">ผู้แทนจำหน่าย</span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link" href="{{ url('manager_supplies/setupfsn') }}">
                                                <span class="nav-main-link-name">ตั้งค่า FSN</span>
                                            </a>
                                        </li>
                                        <li class="nav-main-item">
                                            <a class="nav-main-link"
                                                href="{{ url('manager_supplies/setupsupplies_year_material_plan_value') }}">
                                                <span class="nav-main-link-name loadscreen">กำหนดมูลค่าแผนพัสดุ</span>
                                            </a>
                                        </li>
    
                                     
                                     
                                       
                                    </ul>
                                </li>
                          
                            
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- END Main Navigation -->
                    </div>
                </div>
                <!-- END Navigation -->

                <!-- Page Content -->
                <div style="margin-top:50px">
                    @yield('content')
                </div>
             

            </main>
            <!-- END Main Container -->
            <script src="{{ asset('asset/js/dashmix.app.js') }}"></script>
            <!-- Laravel Scaffolding JS -->
            <script src="{{ asset('asset/js/laravel.app.js') }}"></script>
            <script src="{{ asset('js/globalFunction.js') }}"></script>
            <script src="{{ asset('js/formControl.js') }}"></script>

            @yield('footer')
    </body>
</html>

