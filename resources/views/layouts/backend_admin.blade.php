<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>gtw backoffice</title>

    <meta name="description" content="gtw-backoffice">
    <meta name="author" content="backoffice">
    <meta name="robots" content="noindex, nofollow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('asset/media/favicons/logo_cir.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('asset/media/favicons/logo_cir.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('asset/media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts and Styles -->
    @yield('css_before')
    <!--<link rel="stylesheet" id="css-theme" href="{{ asset('asset/css/dashmix.css') }}">-->

    <link rel="stylesheet" id="css-main" href="{{ asset('asset/css/dashmix.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('asset/css/themes/xplay.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
    <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('assets/js/sweetalert2/sweetalert2.min.css') }}">
    <script src="{{ asset('assets/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <link rel="stylesheet"  href="{{ asset('css/styledis.css') }}">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> 
        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <!-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> -->
<style>
    .progress-bar {
    background-color: #0665d0 !important;
}
</style>
    <link rel="stylesheet" href="{{asset('css/stylesl.css')}}">
    @yield('css_after')

    <!-- Scripts -->
    <script>
        // window.Laravel = {
        //     !!json_encode(['csrfToken' => csrf_token()]) !!
        // };

    </script>
</head>

<body>
  {{-- loading Screen page --}}
<div class="loading-page">
    <div id="loader-wrapper">
        <div id="loader"></div>
        {{-- <div style="padding-top: 10%; ">
            <img src="/image/loading-gif.gif"  style="width: 30%;display:block;margin: auto;"/>
        </div> --}}
    </div>
</div>

 <!-- medium modal -->
<!-- medium modal -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <span id="modalTitle"></span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" id="mediumBody">
            <div>
                <!-- the result to be displayed apply here -->
            </div>
        </div>
    </div>
</div>
</div>
</div>
 {{-- End Modal Content --}}


    <div id="page-container"
        class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header -->
            <div class="bg-image"
                style="background-image: url('{{ asset('asset/media/various/bg_side_overlay_header.jpg') }}');">
                <div class="bg-primary-op">
                    <div class="content-header">
                        <!-- User Avatar 
                        <a class="img-link mr-1" href="javascript:void(0)">
                            <img class="img-avatar img-avatar48" src="{{ asset('asset/media/avatars/avatar10.jpg') }}"
                                alt="">
                        </a>
                       END User Avatar -->

                        <!-- User Info -->
                        <div class="ml-2">
                            <a class="text-white font-w600" href="javascript:void(0)">Gotowin solution</a>
                            <div class="text-white-75 font-size-sm font-italic">คู่มือแนะนำการใช้งาน </div>
                           
                        </div>
                        {{-- <div class="ml-2">
                            <a class="text-white font-w600" href="{{ url('youtube/youtubeindex') }}">Gotowin solution</a>
                            <div class="text-white-75 font-size-sm font-italic">คู่มือและวิดิโอแนะนำการใช้งาน</div>
                        </div> --}}
                        <!-- END User Info -->

                        <!-- Close Side Overlay -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="ml-auto text-white" href="javascript:void(0)" data-toggle="layout"
                            data-action="side_overlay_close">
                            <i class="fa fa-times-circle"></i>
                        </a>
                        <!-- END Close Side Overlay -->
                    </div>
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="content-side">
                <p>
                    <a href=" https://drive.google.com/drive/folders/1K1ScT_BTl2RGY4wno04NUilrHzFTF-n4?fbclid=IwAR1pPQxqa-qADhCq4u_OEmah7s65XkFdAJ8l9CK4Ru6RJmhr2lHd9omCjvs" target="_blank">คู่มือการใช้งาน</a>
                </p>
            </div>
            <!-- END Side Content -->
        </aside>
        <!-- END Side Overlay -->
        <nav id="sidebar" aria-label="Main Navigation">
            <!-- Side Header -->
            <div class="bg-header-dark">
                <div class="content-header bg-white-10">
                    <!-- Logo -->
                    <a id="mediumButton" class="link-fx font-w600 font-size-lg text-white" href="{{ url('check-for-update')}}">
                        <span class="smini-visible">
                            <span class="text-white-75">D</span><span class="text-white">x</span>
                        </span>
                        <span class="smini-hidden">
                            <span class="text-white-75" style=" font-size: 30px;">BACK</span><span class="text-white"
                                style=" font-size: 30px;">office</span>
                            <span style=" font-size: 14;"> version <?= env('APP_VERSION');?></span>
                        </span>
                    </a>
                    <!-- END Logo -->

                    <!-- Options -->
                    <div>
                        <!-- Toggle Sidebar Style -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
                        <a class="js-class-toggle text-white-75" data-target="#sidebar-style-toggler"
                            data-class="fa-toggle-off fa-toggle-on" data-toggle="layout"
                            data-action="sidebar_style_toggle" href="javascript:void(0)">
                            <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
                        </a>
                        <!-- END Toggle Sidebar Style -->

                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="d-lg-none text-white ml-2" data-toggle="layout" data-action="sidebar_close"
                            href="javascript:void(0)">
                            <i class="fa fa-times-circle"></i>
                        </a>
                        <!-- END Close Sidebar -->
                    </div>
                    <!-- END Options -->
                </div>
            </div>
            <!-- END Side Header -->
            <?php
            $status = Auth::user()->status;
            $id_user = Auth::user()->PERSON_ID;
            ?>

            <!-- Side Navigation -->
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('dashboardadmin') ? ' active' : '' }}"
                            href="{{ url('/dashboardadmin') }}">
                            <i class="nav-main-link-icon si si-cursor"></i>
                            <span class="nav-main-link-name loadscreen">Dashboard</span>

                        </a>
                    </li> 
                   <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('backups') ? ' active' : '' }}"
                            href="{{ url('/backups') }}">
                            <i class="fas fa-database nav-main-link-icon"></i>
                            <span class="nav-main-link-name loadscreen"> สำรองข้อมูล</span>

                        </a>
                    </li> 
                    <!--<li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('datacentersync') ? ' active' : '' }}"
                            href="{{ url('/datacentersync') }}">
                            <i class="fas fa-server nav-main-link-icon"></i>
                            <span class="nav-main-link-name loadscreen"> Datacenter Sync</span>

                        </a>
                    </li>-->
                    @if ($id_user !== '0')
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}"
                                href="{{ url('/dashboard/' . $id_user) }}" target="_blank">
                                <i class="nav-main-link-icon fa fa-address-card"></i>
                                <span class="nav-main-link-name">เข้าหน้าต่างผู้ใช้งาน</span>

                            </a>
                        </li>
                    @endif
                        <li class="nav-main-heading">STEP 1</li>

                        <li class="nav-main-item{{ request()->is('admin_person/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">ตั้งค่าข้อมูลบุคคล</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfoworkgroup') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfoworkgroup') }}">
                                        <span class="nav-main-link-name loadscreen" >กลุ่มภารกิจ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfodepartment') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfodepartment') }}">
                                        <span class="nav-main-link-name loadscreen" >กลุ่มงาน</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfoinstitution') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfoinstitution') }}">
                                        <span class="nav-main-link-name loadscreen" >หน่วยงาน</span>
                                    </a>
                                </li>                          
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfolevel') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfolevel') }}">
                                        <span class="nav-main-link-name loadscreen" >ระดับ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfostatus') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfostatus') }}">
                                        <span class="nav-main-link-name loadscreen" >สถานะปัจจุบัน</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfokind') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfokind') }}">
                                        <span class="nav-main-link-name loadscreen" >กลุ่มข้าราชการ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfokindtype') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfokindtype') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทข้าราชการ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfopersongroup') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfopersongroup') }}">
                                        <span class="nav-main-link-name loadscreen" >กลุ่มบุคลากร</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person/setupinfopersonteamposition') ? ' active' : '' }}"
                                        href="{{ url('admin_person/setupinfopersonteamposition') }}">
                                        <span class="nav-main-link-name loadscreen" >ตำแหน่งทีม</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('person/all') ? ' active' : '' }}"
                                href="{{ url('person/all') }}">
                                <i class="nav-main-link-icon fa fa-user"></i>
                                <span class="nav-main-link-name loadscreen"> เพิ่มข้อมูลบุคคล</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('admin_permis/setupinfopermis') ? ' active' : '' }}"
                                href="{{ url('admin_permis/setupinfopermis') }}">
                                <i class="nav-main-link-icon fa fa-user"></i>
                                <span class="nav-main-link-name loadscreen">กําหนดสิทธิ์ใช้งาน</span>
                            </a>
                        </li>

                        <li class="nav-main-item{{ request()->is('admin_person_H/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name">ตั้งค่าตำแหน่งบุคคล</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person_H/setupinfoworkgroup_H') ? ' active' : '' }}"
                                        href="{{ url('admin_person_H/setupinfoworkgroup_H') }}">
                                        <span class="nav-main-link-name loadscreen" >กลุ่มงาน</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person_H/setupinfodepartment_H') ? ' active' : '' }}"
                                        href="{{ url('admin_person_H/setupinfodepartment_H') }}">
                                        <span class="nav-main-link-name loadscreen" >ฝ่าย/แผนก</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person_H/setupinfoinstitution_H') ? ' active' : '' }}"
                                        href="{{ url('admin_person_H/setupinfoinstitution_H') }}">
                                        <span class="nav-main-link-name loadscreen" >หน่วยงาน</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_person_H/setupinfopersonteam') ? ' active' : '' }}"
                                        href="{{ url('admin_person_H/setupinfopersonteam') }}">
                                        <span class="nav-main-link-name loadscreen" >ทีมนำองค์กร</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('admin_leave_H/setupinfoapprov') ? ' active' : '' }}"
                                href="{{ url('admin_leave_H/setupinfoapprov') }}">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name loadscreen">กำหนดสิทธิการเห็นชอบ</span>
                            </a>
                        </li>

                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('admin_leave_H/setupinfomenu') ? ' active' : '' }}"
                                href="{{ url('admin_leave_H/setupinfomenu') }}">
                                <i class="nav-main-link-icon fa fa-users"></i>
                                <span class="nav-main-link-name loadscreen">เปิดใช้เมนูบุคคล</span>
                            </a>
                        </li>

                        <li class="nav-main-heading">STEP 2</li>
                        <li class="nav-main-item{{ request()->is('admin/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fa fa-cogs"></i>
                                <span class="nav-main-link-name">ทั่วไป</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin/setupinfoorg') ? ' active' : '' }}"
                                        href="{{ url('admin/setupinfoorg') }}">
                                        <span class="nav-main-link-name loadscreen" >ตั้งค่าองค์กร</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin/setupinfobudget') ? ' active' : '' }}"
                                        href="{{ url('admin/setupinfobudget') }}">
                                        <span class="nav-main-link-name loadscreen">ตั้งค่าปีงบประมาณ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin/setupinfoposition') ? ' active' : '' }}"
                                        href="{{ url('admin/setupinfoposition') }}">
                                        <span class="nav-main-link-name loadscreen" >ตั้งค่าตำแหน่ง</span>
                                    </a>
                                </li>                         
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin/setupinfodaytype') ? ' active' : '' }}"
                                        href="{{ url('admin/setupinfodaytype') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทวัน</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-main-heading">STEP 3</li>

                       
                        <li class="nav-main-item{{ request()->is('admin_dev/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fa fa-user-cog"></i>
                                <span class="nav-main-link-name">ประชุม/อบรม/ดูงาน</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfobranch') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfobranch') }}">
                                        <span class="nav-main-link-name loadscreen">สาขาที่เกี่ยวข้อง</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfocapacity') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfocapacity') }}">
                                        <span class="nav-main-link-name loadscreen" >ด้านที่ได้รับ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfogo') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfogo') }}">
                                        <span class="nav-main-link-name loadscreen" >ลักษณะการไป</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfoorg') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfoorg') }}">
                                        <span class="nav-main-link-name loadscreen" >หน่วยงานที่จัด</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfoorglocation') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfoorglocation') }}">
                                        <span class="nav-main-link-name loadscreen" >สถานที่จัด</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfotype') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfotype') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทการไป</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfolevel') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfolevel') }}">
                                        <span class="nav-main-link-name loadscreen" >ระดับการไป</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfoknow') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfoknow') }}">
                                        <span class="nav-main-link-name loadscreen">การนำความรู้ไปใช้</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/setupinfodoctype') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/setupinfodoctype') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทเอกสาร</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_dev/openform_perdev') ? ' active' : '' }}"
                                        href="{{ url('admin_dev/openform_perdev') }}">
                                        <span class="nav-main-link-name loadscreen" >เปิดฟังก์ชั่นฟอร์ม</span>
                                    </a>
                                </li>                          
                            </ul>
                        </li>

                      

                        <li class="nav-main-item{{ request()->is('admin_asset_supplies/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fa fa-boxes"></i>
                                <span class="nav-main-link-name">งานทรัพย์สินและพัสดุ</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliespurchase') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliespurchase') }}">
                                        <span class="nav-main-link-name loadscreen" >ทะเบียนคุม</span>
                                    </a>
                                </li>


                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliestypekind') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliestypekind') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทพัสดุ</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesunit') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesunit') }}">
                                        <span class="nav-main-link-name loadscreen" >หน่วยนับ</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliestypelist') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliestypelist') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทรายการ</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliestypebudget') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliestypebudget') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทเงิน</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliestype') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliestype') }}">
                                        <span class="nav-main-link-name loadscreen">หมวดพัสดุ</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesbuy') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesbuy') }}">
                                        <span class="nav-main-link-name loadscreen">วิธีการจัดซื้อ/จัดจ้าง</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesbrand') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesbrand') }}">
                                        <span class="nav-main-link-name loadscreen" >ยี่ห้อสินค้า</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesmodel') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesmodel') }}">
                                        <span class="nav-main-link-name loadscreen" >รุ่นสินค้า</span>
                                    </a>
                                </li>
                            
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliestrimart') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliestrimart') }}">
                                        <span class="nav-main-link-name loadscreen" >ไตรมาส</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesordertype') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesordertype') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทการเบิก</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliespriceref') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliespriceref') }}">
                                        <span class="nav-main-link-name loadscreen" >แหล่งอ้างอิง</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesposition') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesposition') }}">
                                        <span class="nav-main-link-name loadscreen" >ตำแหน่งกรรมการ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesstatusregis') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesstatusregis') }}">
                                        <span class="nav-main-link-name loadscreen" >สถานะทะเบียนคุม</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesmethod') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesmethod') }}">
                                        <span class="nav-main-link-name loadscreen" >วิธีการจัดหา</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesdecline') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesdecline') }}">
                                        <span class="nav-main-link-name loadscreen">อัตราค่าเสื่อมราคา</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesconpremise') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesconpremise') }}">
                                        <span class="nav-main-link-name loadscreen" >หลักฐานการรับ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliescontypelist') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliescontypelist') }}">
                                        <span class="nav-main-link-name loadscreen">ประเภทสินค้าที่รับ</span>
                                    </a>
                                </li>
                            
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesexpiretype') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesexpiretype') }}">
                                        <span class="nav-main-link-name loadscreen" >แทงจำหน่าย</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesboardlist') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesboardlist') }}">
                                        <span class="nav-main-link-name loadscreen" >กลุ่มกรรมการ</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliestypemaster') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliestypemaster') }}">
                                        <span class="nav-main-link-name loadscreen" >ชนิดพัสดุหลัก</span>
                                    </a>
                                </li>
                                {{-- <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliessendmoneyitem') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliessendmoneyitem') }}">
                                        <span class="nav-main-link-name loadscreen" >ส่งการเงิน</span>
                                    </a>
                                </li> --}}
                                <!--<li class="nav-main-item">
                                            <a class="nav-main-link{{ request()->is('admin_car/setupcaraccessory') ? ' active' : '' }}" href="{{ url('admin_car/setupcaraccessory') }}">
                                                <span class="nav-main-link-name loadscreen" >พัสดุเบิกได้เฉพาะ</span>
                                            </a>
                                        </li>--->
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupsuppliesvendor') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupsuppliesvendor') }}">
                                        <span class="nav-main-link-name loadscreen" >ผู้แทนจำหน่าย</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupassettypevalue') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupassettypevalue') }}">
                                        <span class="nav-main-link-name loadscreen" >ประเภทตามมูลค่า</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_asset_supplies/setupofficer') ? ' active' : '' }}"
                                        href="{{ url('admin_asset_supplies/setupofficer') }}">
                                        <span class="nav-main-link-name loadscreen" >เจ้าหน้าที่พัสดุ</span>
                                    </a>
                                </li>



                            </ul>

                        </li>
 
                        <li class="nav-main-item{{ request()->is('admin_other/*') ? ' open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                                aria-expanded="true" href="#">
                                <i class="nav-main-link-icon fa fa fas fa-swatchbook"></i>
                                <span class="nav-main-link-name">อื่นๆ</span>
                            </a>
                            <ul class="nav-main-submenu">
    
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_other/setupinfopublicityimage') ? ' active' : '' }}"
                                        href="{{ url('admin_other/setupinfopublicityimage') }}">
                                        <span class="nav-main-link-name loadscreen">ภาพประชาสัมพันธ์</span>
                                    </a>
                                </li>
    
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_other/setupinformation/publicize*') ? ' active' : '' }}"
                                        href="{{ route('admin.setupinfo.publicize') }}">
                                        <span class="nav-main-link-name loadscreen">ลิงก์ประชาสัมพันธ์</span>
                                    </a>
                                </li>

                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_other/setupinformation/pagefacebook*') ? ' active' : '' }}"
                                        href="{{ route('admin.setupinfo.pagefacebook') }}">
                                        <span class="nav-main-link-name loadscreen">เพจเฟซบุ๊ก</span>
                                    </a>
                                </li>
    
                                <li class="nav-main-item">
                                    <a class="nav-main-link{{ request()->is('admin_other/setuplinetoken') ? ' active' : '' }}"
                                        href="{{ url('admin_other/setuplinetoken') }}">
                                        <span class="nav-main-link-name loadscreen" >LINE GROUP</span>
                                    </a>
                                </li>
    
    
                            </ul>
                        </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div>
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                    <button type="button" class="btn btn-dual mr-1" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                    <!-- END Toggle Sidebar -->


                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div>
                    <!-- User Dropdown -->
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-fw fa-user d-sm-none"></i>
                            <span class="d-none d-sm-inline-block"
                                style=" font-family: 'Kanit', sans-serif; font-weight: normal;">{{ Auth::user()->name }}
                            </span>
                            <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                            <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                                User Options
                            </div>
                            <div class="p-2">                                                            

                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Sign Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>



                            </div>
                        </div>
                    </div>
                    <!-- END User Dropdown -->                   

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <button onclick="window.location.href='{{ url('changpassword') }}' " type="button"
                        class="btn btn-dual">
                        <i class=" fa fa-key"></i>
                    </button>
                    <button type="button" class="btn btn-dual" data-toggle="layout" data-action="side_overlay_toggle">
                        <i class="far fa-fw fa-list-alt"></i>
                    </button>
                    <!-- END Toggle Side Overlay -->
                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header bg-primary">
                <div class="content-header">
                    <form class="w-100" action="/dashboard" method="POST">
                        @csrf
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <button type="button" class="btn btn-primary loadscreen" data-toggle="layout"
                                    data-action="header_search_off">
                                    <i class="fa fa-fw fa-times-circle"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control border-0" placeholder="Search or hit ESC.."
                                id="page-header-search-input" name="page-header-search-input">
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
            <div id="page-header-loader" class="overlay-header bg-primary-darker">
                <div class="content-header">
                    <div class="w-100 text-center">
                        <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->

        <!-- Main Container -->
        <main id="main-container">
            @yield('content')
        </main>
        <!-- END Main Container -->


    </div>
    <!-- END Page Container -->
<script>
    $(document).ready(function () {
        $('#about-version').click(function (e) { 
            e.preventDefault();
            alert();
        });

        $(".about-version").click(function (e) {
            e.preventDefault();
            var href = $(this).attr("href");
            var title = $(this).attr("title");
            // alert();
            $("#mediumBody").html('xxx').show();
            // $.ajax({
            //     url: href,
            //     beforeSend: function () {
            //         loadWait();
            //     },
            //     success: function (result) {
            //         $(".label-header").html(title);
            //         $(".modal-dialog").removeClass("modal-md");
            //         $("#mediumBody").html(result).show();
            //     },
            //     complete: function () {},
            //     error: function (jqXHR, testStatus, error) {
            //         console.log(error);
            //         alert("Page " + href + " cannot open. Error:" + error);
            //     },
            // });
        });

        // display a modal (medium modal)
        $('body').on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('href');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html('<h1 class="text-center">Loading...</h1>');
             
                },
                // return the result
                success: function(result) {
                    $('#modalTitle').html('<h4>ตรวจสอบและอัปเดตเวอร์ชัน</h4>')
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    // alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                // timeout: 8000
            })
        });



    });
</script>
    <!-- Dashmix Core JS -->
    <script src="{{ asset('asset/js/dashmix.app.js') }}"></script>
   

    <!-- Laravel Scaffolding JS -->
    <script src="{{ asset('asset/js/laravel.app.js') }}"></script>
    <script src="{{ asset('js/globalFunction.js') }}"></script>
    <script src="{{ asset('js/formControl.js') }}"></script>
    <script src="{{ asset('js/crud.js') }}"></script>

    @yield('footer')
</body>

</html>
