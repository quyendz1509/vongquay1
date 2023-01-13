<!DOCTYPE html>
<!--
Template Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/vuexy_admin
Renew Support: https://1.envato.market/vuexy_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<!-- Mirrored from pixinvent.com/demo/vuexy-html-bootstrap-admin-template/html/ltr/vertical-menu-template/dashboard-ecommerce.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Sep 2021 09:20:26 GMT -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="googlebot" content="noindex">
  <meta name="robots" content="noindex">
  <title><?= $title ?></title>
  <link rel="apple-touch-icon" href="/Admin/admin_public/app-assets/images/ico/apple-icon-120.html">
  <link rel="shortcut icon" type="image/x-icon" href="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

  <!-- BEGIN: Vendor CSS-->
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/vendors/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/vendors/css/charts/apexcharts.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/vendors/css/extensions/toastr.min.css">
  <!-- END: Vendor CSS-->

  <!-- BEGIN: Theme CSS-->
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/bootstrap-extended.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/colors.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/components.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/themes/dark-layout.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/themes/bordered-layout.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/themes/semi-dark-layout.min.css">

  <!-- BEGIN: Page CSS-->
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/core/menu/menu-types/vertical-menu.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/pages/dashboard-ecommerce.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/plugins/charts/chart-apex.min.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/css/plugins/extensions/ext-component-toastr.min.css">
  <!-- END: Page CSS-->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css">  <!-- BEGIN: Custom CSS-->
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/assets/dropzone.min.css">
  <!-- END: Custom CSS-->
  <link rel="stylesheet" type='text/css' href='https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css'>
  <script src="../../public/js/vendor/jquery-3.4.1.min.js"></script>
  <script src="/Admin/admin_public/assets/dropzone.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.19.1/full-all/ckeditor.js"></script>
  <link rel="stylesheet" type="text/css" href="/Admin/admin_public/app-assets/vendors/css/extensions/sweetalert2.min.css">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

  <!-- BEGIN: Header-->
  <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
    <div class="navbar-container d-flex content">
      <div class="bookmark-wrapper d-flex align-items-center">
        <ul class="nav navbar-nav d-xl-none">
          <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a></li>
        </ul>
        <ul class="nav navbar-nav bookmark-icons">
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon" data-feather="mail"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon" data-feather="message-square"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calendar.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon" data-feather="calendar"></i></a></li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon" data-feather="check-square"></i></a></li>
        </ul>
        <ul class="nav navbar-nav">
          <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
            <div class="bookmark-input search-input">
              <div class="bookmark-input-icon"><i data-feather="search"></i></div>
              <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
              <ul class="search-list search-list-bookmark"></ul>
            </div>
          </li>
        </ul>
      </div>
      <ul class="nav navbar-nav align-items-center ms-auto">
        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>

        <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder"><?= $info['fullname'] ?></span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="https://avatars.dicebear.com/api/initials/<?= $info['username'] ?>.svg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span></a>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
           <a class="dropdown-item" href="../home.html"><i class="me-50" data-feather="power"></i> Về trang chủ</a>
         </div>
       </li>
     </ul>
   </div>
 </nav>
 <ul class="main-search-list-defaultlist d-none">
  <li class="d-flex align-items-center"><a href="#">
    <h6 class="section-label mt-75 mb-0">Files</h6></a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
      <div class="d-flex">
        <div class="me-75"><img src="/Admin/admin_public/app-assets/images/icons/xls.png" alt="png" height="32"></div>
        <div class="search-data">
          <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
        </div>
      </div><small class="search-data-size me-50 text-muted">&apos;17kb</small></a></li>
      <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
        <div class="d-flex">
          <div class="me-75"><img src="/Admin/admin_public/app-assets/images/icons/jpg.png" alt="png" height="32"></div>
          <div class="search-data">
            <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
          </div>
        </div><small class="search-data-size me-50 text-muted">&apos;11kb</small></a></li>
        <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
          <div class="d-flex">
            <div class="me-75"><img src="/Admin/admin_public/app-assets/images/icons/pdf.png" alt="png" height="32"></div>
            <div class="search-data">
              <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
            </div>
          </div><small class="search-data-size me-50 text-muted">&apos;150kb</small></a></li>
          <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
              <div class="me-75"><img src="/Admin/admin_public/app-assets/images/icons/doc.png" alt="png" height="32"></div>
              <div class="search-data">
                <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
              </div>
            </div><small class="search-data-size me-50 text-muted">&apos;256kb</small></a></li>
            <li class="d-flex align-items-center"><a href="#">
              <h6 class="section-label mt-75 mb-0">Members</h6></a></li>
              <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                <div class="d-flex align-items-center">
                  <div class="avatar me-75"><img src="/Admin/admin_public/app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
                  <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                  </div>
                </div></a></li>
                <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                  <div class="d-flex align-items-center">
                    <div class="avatar me-75"><img src="/Admin/admin_public/app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                      <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                  </div></a></li>
                  <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                    <div class="d-flex align-items-center">
                      <div class="avatar me-75"><img src="/Admin/admin_public/app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
                      <div class="search-data">
                        <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                      </div>
                    </div></a></li>
                    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view-account.html">
                      <div class="d-flex align-items-center">
                        <div class="avatar me-75"><img src="/Admin/admin_public/app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
                        <div class="search-data">
                          <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                        </div>
                      </div></a></li>
                    </ul>
                    <ul class="main-search-list-defaultlist-other-list d-none">
                      <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                        <div class="d-flex justify-content-start"><span class="me-75" data-feather="alert-circle"></span><span>No results found.</span></div></a></li>
                      </ul>
                      <!-- END: Header-->


                      <!-- BEGIN: Main Menu-->
                      <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
                        <div class="navbar-header">
                          <ul class="nav navbar-nav flex-row">
                            <li class="nav-item me-auto"><a class="navbar-brand" href="/Admin/home"><span class="brand-logo">
                              <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                  <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                  </lineargradient>
                                  <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                  </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                      <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                      <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                      <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                      <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                      <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                    </g>
                                  </g>
                                </g>
                              </svg></span>
                              <h2 class="brand-text">K93HAX</h2></a></li>
                              <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
                            </ul>
                          </div>
                          <div class="shadow-bottom"></div>
                          <div class="main-menu-content">
                            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                             <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Thông tin chung</span><i data-feather="more-horizontal"></i>
                             </li> 

                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/home"><i data-feather='home'></i><span class="menu-title text-truncate">Trang chủ</span></a>
                             </li>


                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/gamelist"><i data-feather='play-circle'></i><span class="menu-item text-truncate" data-i18n="Shop">Danh sách game</span></a>
                             </li>
                             <li class="nav-item" ><a class="d-flex align-items-center" href="/Admin/categogries"><i data-feather='folder'></i><span class="menu-item text-truncate" data-i18n="Shop">Quản lý danh mục</span></a>
                             </li>
                             <li class="nav-item" ><a class="d-flex align-items-center" href="/Admin/hinhanh"><i data-feather='image'></i><span class="menu-item text-truncate" data-i18n="Shop">Quản lý hình ảnh</span></a>
                             </li>
                             <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Quản lý luồng tiền</span><i data-feather="more-horizontal"></i>
                             </li> 
                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/thongke"><i data-feather='percent'></i><span class="menu-title text-truncate" data-i18n="Raise Support">Quản lý luồng tiền</span></a>
                             </li>
                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/payment"><i data-feather='credit-card'></i><span class="menu-title text-truncate" data-i18n="Raise Support">Quản lý ngân hàng</span></a>
                             </li>
                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/managerHisAuto"><i data-feather='layers'></i><span class="menu-title text-truncate" data-i18n="Raise Support">Quản lý giao dịch tự động</span></a>
                             </li>
                             <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Admin</span><i data-feather="more-horizontal"></i>
                             </li> 
                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/user"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Raise Support">Quản lý người dùng</span></a>
                             </li>
                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/mua-ban"><i data-feather='users'></i><span class="menu-title text-truncate" data-i18n="Raise Support">Lịch sử mua bán</span></a>
                             </li>

                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/admin-log"><i data-feather='lock'></i><span class="menu-title text-truncate" data-i18n="Raise Support">Lịch sử Admin</span></a>
                             </li>
                             <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/quanlyweb"><i data-feather='shield'></i><span class="menu-title text-truncate" data-i18n="Raise Support">Quản lý trang web</span></a>
                             </li>
                             <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Sự kiện</span><i data-feather="more-horizontal"></i>
                              <li class="nav-item"><a class="d-flex align-items-center" href="/Admin/giftcode"><i data-feather='shield'></i><span class="menu-title text-truncate" data-i18n="Raise Support">Quản lý Giftcode</span></a>
                              </li>
                            </li> 

                          </ul>
                        </div>
                      </div>
                                <!-- END: Main Menu-->