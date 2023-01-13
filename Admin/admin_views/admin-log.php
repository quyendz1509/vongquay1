<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Quản lý hành động admin</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="./user">Quản lý hành động admin</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-body"><!-- context-menu -->
      <section id="context-menu">
        <div class="row">
         <!-- List image -->
         <div class="col-sm-12">
          <div class="card">
            <div class="card-header border-bottom">
              <h4 class="card-title">Quản lý hành động admin</h4>
            </div>
            <div class="card-body ">
              <table id="manager-gamelist" class="display dtr-inline text-center" style="width: 100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($admin_list as $key => $value) { ?>
                    <tr>
                      <td><?= $value['id'] ?></td>
                      <td><?= $value['noidung'] ?></td>
                     
                      <td><?= $value['create_time'] ?></td>

                    </tr>
                  <?php  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /List images -->
      </div>
    </section>
    <!--/ context-menu -->

  </div>
</div>
</div>
