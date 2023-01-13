<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Quản lý hình ảnh</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="./quanlyweb">Quản lý hình ảnh</a>
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
          <!-- Basic context menu -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Thêm hình ảnh</h4>
              </div>
              <div class="card-body">
                <p class="card-text">
                 Hệ thống thêm hình ảnh cực nhanh. xử lý hình ảnh nằm ở tầm đỉnh cao :v
               </p>

               <form class="dropzone dropzone-area dz-clickable" id='form-uploads-images'>
                <div class="dz-message d-flex">
                  <img src="./admin_public/uploads/paste.png" width="100px" alt="">
                  Drop files here or click to upload.
                </div>
              </form>
              <button id="btn-uploads-images" class="btn btn-outline-primary mt-1 waves-effect">
                <span class="align-middle"><i data-feather='upload'></i> Tải hình ảnh lên</span>
              </button>
            </div>
          </div>
        </div>
        <!--/ Basic context menu -->
        <!-- List image -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header border-bottom">
              <h4 class="card-title">List hình ảnh</h4>
            </div>
            <div class="card-body ">
              <table id="manager-images" class="display dtr-inline text-center" style="width: 100%;">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Đường dẫn</th>
                    <th>Hành động</th>
                    <th>Hình ảnh</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($images as $key => $value) { ?>
                    <tr>
                      <td><?= $key ?></td>


                      <td>
                        <div class="input-group">
                          <input id="link-<?= $key ?>" class="form-control" type="text" value="<?= $value['links'] ?>" readonly>
                          <button class="btn btn-primary btn-sm" onclick="copyToClipBoard('#link-<?= $key ?>')">Copy</button>
                        </div>
                      </td>
                      <td><button class="btn btn-danger btn-sm btn-xoa-anh" data-id='<?= $value['id'] ?>'>Xóa</button> </td>
                      <td><img src="../..<?= $value['links'] ?>" width='200px' alt=""></td>

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
