    <!-- BEGIN: Content-->
    <div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body"><!-- Dashboard Ecommerce Starts -->
          <section id="dashboard-ecommerce">
            <div class="row match-height">
              <!-- Medal Card -->
              <div class="col-xl-4 col-md-6 col-12">
                <div class="card card-congratulation-medal">
                  <div class="card-body">
                    <h3>Xin chào bạn 😍</h3>
                    <p>Chào mừng bạn đến với trang admin. Nếu bạn có thắc mắc hoặc muốn nâng cấp trang web. <br>
Đừng ngại liên hệ qua facebook: <a href="https://www.facebook.com/quyensb1509/">Diệp Quốc Quyền</a>
                    </p>
                    <a href="./quanlyweb" class="btn btn-primary">Quản lý website</a>
                  </div>
                </div>
              </div>
              <!--/ Medal Card -->

              <!-- Statistics Card -->
              <div class="col-xl-8 col-md-6 col-12">
                <div class="card card-statistics">
                  <div class="card-header">
                    <h4 class="card-title">Thống kê hệ thống</h4>
                    <div class="d-flex align-items-center">
                      <p class="card-text font-small-2 me-25 mb-0">Updated 1 second ago</p>
                    </div>
                  </div>
                  <div class="card-body statistics-body">
                    <div class="row">
                      <div class="col-xl-4 col-sm-6 col-12 mb-2">
                        <div class="d-flex flex-row align-items-center">
                          <div class="avatar bg-light-primary me-2">
                            <div class="avatar-content">
                              <i data-feather="trending-up" class="avatar-icon"></i>
                            </div>
                          </div>
                          <div class="my-auto">
                            <h4 class="fw-bolder mb-0"><?= ($doanhthungay % 1000 == 0) ? number_format($doanhthungay/1000).'K' :  number_format($doanhthungay) ; ?></h4>
                            <p class="card-text font-small-3 mb-0">Doanh thu hôm nay </p>
                          </div>
                        </div>
                      </div>
                      <!--  -->
                      <div class="col-xl-4 col-sm-6 col-12 mb-2">
                        <div class="d-flex flex-row align-items-center">
                          <div class="avatar bg-light-primary me-2">
                            <div class="avatar-content">
                              <i data-feather="trending-up" class="avatar-icon"></i>
                            </div>
                          </div>
                          <div class="my-auto">
                            <h4 class="fw-bolder mb-0"><?= ($doanhthuthang % 1000 == 0) ? number_format($doanhthuthang/1000).'K' :  number_format($doanhthuthang) ; ?></h4>
                            <p class="card-text font-small-3 mb-0">Doanh thu bán tháng <?= date('m', time()) ?></p>
                          </div>
                        </div>
                      </div>
                      <!--  -->
                      <div class="col-xl-4 col-sm-6 col-12 mb-2">
                        <div class="d-flex flex-row align-items-center">
                          <div class="avatar bg-light-info me-2">
                            <div class="avatar-content">
                              <i data-feather="user" class="avatar-icon"></i>
                            </div>
                          </div>
                          <div class="my-auto">
                            <h4 class="fw-bolder mb-0"><?= ($countMember % 1000 == 0) ? number_format($countMember/1000).'K' :  number_format($countMember) ; ?></h4>
                            <p class="card-text font-small-3 mb-0">Khách hàng</p>
                          </div>
                        </div>
                      </div>

                      <!--  -->
                      <div class="col-xl-4 col-sm-6 col-12">
                        <div class="d-flex flex-row align-items-center">
                          <div class="avatar bg-light-success me-2">
                            <div class="avatar-content">
                              <i data-feather="dollar-sign" class="avatar-icon"></i>
                            </div>
                          </div>
                          <div class="my-auto">
                            <h4 class="fw-bolder mb-0"><?= ($doanhthuCardToday % 1000 == 0) ? number_format($doanhthuCardToday/1000).'K' :  number_format($doanhthuCardToday) ; ?></h4>
                            <p class="card-text font-small-3 mb-0">Doanh thu nạp tiền hôm nay</p>
                          </div>
                        </div>
                      </div>
                      <!--  -->
                      <div class="col-xl-4 col-sm-6 col-12">
                        <div class="d-flex flex-row align-items-center">
                          <div class="avatar bg-light-success me-2">
                            <div class="avatar-content">
                              <i data-feather="dollar-sign" class="avatar-icon"></i>
                            </div>
                          </div>
                          <div class="my-auto">
                            <h4 class="fw-bolder mb-0"><?= ($doanhthuThangNay % 1000 == 0) ? number_format($doanhthuThangNay/1000).'K' :  number_format($doanhthuThangNay) ; ?></h4>
                            <p class="card-text font-small-3 mb-0">Doanh thu nạp tiền tháng <?= date( 'm', time() ) ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Statistics Card -->
            </div>

            <div class="row match-height">


              <!-- Transaction Card -->
              <div class="col-lg-6 col-md-6 col-12">
                <div class="card card-transaction">
                  <div class="card-header">
                    <h4 class="card-title">Thống kê giao dịch</h4>
                    <span>Doanh thu được tính theo ngày</span>
                  </div>
                  <div class="card-body">
                    <div class="transaction-item">
                      <div class="d-flex">
                        <div class="avatar bg-light-primary rounded float-start">
                          <div class="avatar-content">
                            <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                          </div>
                        </div>
                        <div class="transaction-percentage">
                          <h6 class="transaction-title">Giao dịch ngân hàng</h6>
                          <small>API nạp tự động thẻ thanh toán nội địa.</small>
                        </div>
                      </div>
                      <div class="fw-bolder text-danger"><?= number_format($banks) ?> VNĐ</div>
                    </div>
                    <div class="transaction-item">
                      <div class="d-flex">
                        <div class="avatar bg-light-danger rounded float-start">
                          <div class="avatar-content">
                            <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                          </div>
                        </div>
                        <div class="transaction-percentage">
                          <h6 class="transaction-title">Giao dịch thẻ cào</h6>
                          <small>API nạp tự động thẻ cào.</small>
                        </div>
                      </div>
                      <div class="fw-bolder text-success"><?= number_format($thecao) ?> VNĐ</div>
                    </div>
                    <div class="transaction-item">
                      <div class="d-flex">
                        <div class="avatar bg-light-warning rounded float-start">
                          <div class="avatar-content">
                            <i data-feather="credit-card" class="avatar-icon font-medium-3"></i>
                          </div>
                        </div>
                        <div class="transaction-percentage">
                          <h6 class="transaction-title">Giao dịch MoMo</h6>
                          <small>API nạp tự động MoMo.</small>
                        </div>
                      </div>
                      <div class="fw-bolder text-danger"><?= number_format($momo) ?> VNĐ</div>
                    </div>
                    <div class="transaction-item">
                      <div class="d-flex">
                        <div class="avatar bg-light-info rounded float-start">
                          <div class="avatar-content">
                            <i data-feather="trending-up" class="avatar-icon font-medium-3"></i>
                          </div>
                        </div>
                        <div class="transaction-percentage">
                          <h6 class="transaction-title">Giao dịch trực tiếp</h6>
                          <small>Admin cộng tiền.</small>
                        </div>
                      </div>
                      <div class="fw-bolder text-success"><?= number_format($congtay) ?> VNĐ</div>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Transaction Card -->
            </div>
          </section>
          <!-- Dashboard Ecommerce ends -->

        </div>
      </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Customizer-->
    <div class="customizer d-none d-md-block"><a class="customizer-toggle d-flex align-items-center justify-content-center" href="#"><i class="spinner" data-feather="settings"></i></a><div class="customizer-content">
      <!-- Customizer header -->
      <div class="customizer-header px-2 pt-1 pb-0 position-relative">
        <h4 class="mb-0">Theme Customizer</h4>
        <p class="m-0">Customize & Preview in Real Time</p>

        <a class="customizer-close" href="#"><i data-feather="x"></i></a>
      </div>

      <hr />

      <!-- Styling & Text Direction -->
      <div class="customizer-styling-direction px-2">
        <p class="fw-bold">Skin</p>
        <div class="d-flex">
          <div class="form-check me-1">
            <input
            type="radio"
            id="skinlight"
            name="skinradio"
            class="form-check-input layout-name"
            checked
            data-layout=""
            />
            <label class="form-check-label" for="skinlight">Light</label>
          </div>
          <div class="form-check me-1">
            <input
            type="radio"
            id="skinbordered"
            name="skinradio"
            class="form-check-input layout-name"
            data-layout="bordered-layout"
            />
            <label class="form-check-label" for="skinbordered">Bordered</label>
          </div>
          <div class="form-check me-1">
            <input
            type="radio"
            id="skindark"
            name="skinradio"
            class="form-check-input layout-name"
            data-layout="dark-layout"
            />
            <label class="form-check-label" for="skindark">Dark</label>
          </div>
          <div class="form-check">
            <input
            type="radio"
            id="skinsemidark"
            name="skinradio"
            class="form-check-input layout-name"
            data-layout="semi-dark-layout"
            />
            <label class="form-check-label" for="skinsemidark">Semi Dark</label>
          </div>
        </div>
      </div>

      <hr />

      <!-- Menu -->
      <div class="customizer-menu px-2">
        <div id="customizer-menu-collapsible" class="d-flex">
          <p class="fw-bold me-auto m-0">Menu Collapsed</p>
          <div class="form-check form-check-primary form-switch">
            <input type="checkbox" class="form-check-input" id="collapse-sidebar-switch" />
            <label class="form-check-label" for="collapse-sidebar-switch"></label>
          </div>
        </div>
      </div>
      <hr />

      <!-- Layout Width -->
      <div class="customizer-footer px-2">
        <p class="fw-bold">Layout Width</p>
        <div class="d-flex">
          <div class="form-check me-1">
            <input type="radio" id="layout-width-full" name="layoutWidth" class="form-check-input" checked />
            <label class="form-check-label" for="layout-width-full">Full Width</label>
          </div>
          <div class="form-check me-1">
            <input type="radio" id="layout-width-boxed" name="layoutWidth" class="form-check-input" />
            <label class="form-check-label" for="layout-width-boxed">Boxed</label>
          </div>
        </div>
      </div>
      <hr />

      <!-- Navbar -->
      <div class="customizer-navbar px-2">
        <div id="customizer-navbar-colors">
          <p class="fw-bold">Navbar Color</p>
          <ul class="list-inline unstyled-list">
            <li class="color-box bg-white border selected" data-navbar-default=""></li>
            <li class="color-box bg-primary" data-navbar-color="bg-primary"></li>
            <li class="color-box bg-secondary" data-navbar-color="bg-secondary"></li>
            <li class="color-box bg-success" data-navbar-color="bg-success"></li>
            <li class="color-box bg-danger" data-navbar-color="bg-danger"></li>
            <li class="color-box bg-info" data-navbar-color="bg-info"></li>
            <li class="color-box bg-warning" data-navbar-color="bg-warning"></li>
            <li class="color-box bg-dark" data-navbar-color="bg-dark"></li>
          </ul>
        </div>

        <p class="navbar-type-text fw-bold">Navbar Type</p>
        <div class="d-flex">
          <div class="form-check me-1">
            <input type="radio" id="nav-type-floating" name="navType" class="form-check-input" checked />
            <label class="form-check-label" for="nav-type-floating">Floating</label>
          </div>
          <div class="form-check me-1">
            <input type="radio" id="nav-type-sticky" name="navType" class="form-check-input" />
            <label class="form-check-label" for="nav-type-sticky">Sticky</label>
          </div>
          <div class="form-check me-1">
            <input type="radio" id="nav-type-static" name="navType" class="form-check-input" />
            <label class="form-check-label" for="nav-type-static">Static</label>
          </div>
          <div class="form-check">
            <input type="radio" id="nav-type-hidden" name="navType" class="form-check-input" />
            <label class="form-check-label" for="nav-type-hidden">Hidden</label>
          </div>
        </div>
      </div>
      <hr />

      <!-- Footer -->
      <div class="customizer-footer px-2">
        <p class="fw-bold">Footer Type</p>
        <div class="d-flex">
          <div class="form-check me-1">
            <input type="radio" id="footer-type-sticky" name="footerType" class="form-check-input" />
            <label class="form-check-label" for="footer-type-sticky">Sticky</label>
          </div>
          <div class="form-check me-1">
            <input type="radio" id="footer-type-static" name="footerType" class="form-check-input" checked />
            <label class="form-check-label" for="footer-type-static">Static</label>
          </div>
          <div class="form-check me-1">
            <input type="radio" id="footer-type-hidden" name="footerType" class="form-check-input" />
            <label class="form-check-label" for="footer-type-hidden">Hidden</label>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End: Customizer-->

