<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Quản lý ngân hàng</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="./payment">Quản lý ngân hàng</a>
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
            <div class="row">
              <div class="col-12 col-lg-4">
                <div class="card">

                 <div class="card-body text-center">

                  <?php
                  $time_ex = strtotime($settings_Banks['expires_time']);
                  $today_ex =  strtotime(date('d-m-Y',time()));
                  $tg_hethan = (date('d-m-Y', time()));
                  if ( $today_ex > $time_ex){
                    $tg_hethan = '<span class="badge bg-danger">Quá hạn </span>';
                  }else{
                    $tg_hethan = '<span class="badge bg-primary">'.$settings_Banks['expires_time'].'</span>';

                  } ?>



                  <h4>Ngày đến hạn thanh toán: <?= ($settings_Banks['expires_time'] == 99) ? '<span class="badge bg-success">Vĩnh viễn</span>' : $tg_hethan ?></h4>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-4">
              <div class="card">
                <div class="card-body text-center">
                  <h4>Đã sử dụng: <?= ( $tinhtoanb == 0 ) ? '<span class="badge bg-danger">Hết lượt</span>' : '<span class="badge bg-success">'.$tinhtoanb['bank_using'].'/'.$tinhtoanb['bank_exits'].'</span>' ?> </h4>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card">
            <div class="loadngger">
              <span class="spinner-border text-light"></span>
              <span class="badge bg-primary">Đang tải dữ liệu</span>
            </div>
            <div class="card-header">
              <h4 class="card-title">Thêm Ngân Hàng</h4>
            </div>
            <div class="card-body">
              <p class="card-text">
               Thêm tài khoản ngân hàng để thanh toán.
             </p>
             <div class="row">
              <div class="col-sm-12 col-lg-12 mb-2">

               <div class="row">
                <?php foreach ($list_bank as $key => $value): ?>
                  <div class="item_bank col-3 col-lg-2 col-sm-3 col-md-4 col-xs-6 text-center mb-1">

                    <input type="radio" name="radio" <?= ($key == 0) ? 'checked' : ''  ?> id="box<?= $key?>" <?= ($value['status'] == 1) ? 'disabled': ''  ?>>
                    <label data-brand="<?= $value['brand'] ?>" data-status="<?= $value['status'] ?>" class="img_bank shadow-sm" for="box<?= $key ?>">
                      <img src="<?= $value['images'] ?>" width="100%" height="30px" alt="" style='max-width: 150px;'>
                    </label>
                  </div>
                <?php endforeach ?>
              </div>

            </div>
            <form id="load-form">
              <div class="col-sm-12 mb-2">
                <label for="">Số tài khoản </label>
                <input type="text" class="form-control" name="sotk"  placeholder="Số tài khoản">
                <small class="text-danger">Số tài khoản chỉ để hiển thị ra trang chủ. Vui lòng điền đúng số tài khoản nhận tiền để tạo QR hoặc khách chuyển chính xác số tiền.</small>
              </div>
              <div class="col-sm-12 mb-2">
                <label for="">Chủ thẻ</label>
                <input type="text" class="form-control" name="chuthe_bank"  placeholder="Nguyen Van A">
              </div>
              <div class="col-sm-12 mb-2">
                <label for="">Tài khoản hoặc số diện thoại đăng nhập</label>
                <input type="text" class="form-control" name="stk_bank"  placeholder="Tài khoản hoặc số điện thoại">
              </div>
              <div class="col-sm-12 mb-2">
                <label for="">Mật khẩu </label>
                <input type="password" class="form-control" name="matkhau_bank"  placeholder="Mật khẩu đăng nhập">
              </div>
                 <div class="col-sm-12 mb-2">
                <label for="">Cú pháp nạp </label>
                <input type="text" class="form-control" name="cuphap_bank"  placeholder="Cú pháp nạp tiền">
              </div>
              <div id="result_callback_login_bank">

              </div>
              <div class="col-sm-12 col-lg-12 mb-2">
               <button class="btn btn-outline-primary" id="login-payment" data-brand="<?= $list_bank[0]['brand'] ?>"><i data-feather='log-in'></i> Đăng nhập</button>
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>

   <!-- List image -->
   <div class="col-sm-12">
    <div class="card">
      <div class="card-header border-bottom">
        <h4 class="card-title">Danh sách tài khoản</h4>
      </div>
      <?php 

      ?>
      <div class="card-body ">

        <table id="list-nganhang" class="table mt-2 mb-2" width="100%" >

          <thead>
            <tr style="width: 100%;">
              <th>ID</th>
              <th>Chủ thẻ</th>

              <th>Tài khoản</th>
              <th>ngân hàng</th>
              <th>Trạng thái</th>
              <th></th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($listPayment['data'] as $key => $value):
              switch ($value['status']) {
                case 1:
                    // code...
                $status = 'Đã kích hoạt';
                $bg = 'bg-success';
                break;
                case 2:
                    // code...
                $status = 'Đã hết hạn sử dụng';
                $bg = 'bg-danger';
                break;
                default:
                $status = 'Chưa kích hoạt';
                $bg = 'bg-secondary';
                break;
              }
              ?>
              <tr>
                <td><?= $value['id'] ?></td>
                <td><strong class="text-primary"><?= $value['chuthe'] ?></strong></td>
                <td><?= $value['username'] ?></td>
                <td><?= $listPayment['bank'][$key]['name_bank'] ?></td>
                <td><span class="badge <?= $bg ?>"><?= $status ?></span></td>
                <td>
                  <div class="btn-group">
                   <?php if ($value['bank_name'] == 'momo'){ ?>

                    <?php if ($value['status'] == 0): ?>
                      <a class="btn btn-sm btn-info " href="./activer/<?= $value['id'] ?>"> XÁC THỰC </a>
                    <?php endif ?>
                    <?php if ($value['status'] == 1): ?>
                     <button class="btn btn-sm btn-danger active-unactive-bank untiver-<?= $value['id'] ?>"  data-action="0"  data-id="<?= $value['id'] ?>">TẮT TỰ ĐỘNG</button>
                     <a href="/Admin/manager-bank/<?= $value['id'] ?>" class="btn btn-sm btn-primary"> QUẢN LÝ</a>
                     
                   <?php endif ?>
                 <?php }else{ ?>
                   <?php if ($value['status'] == 0){ ?>
                    <button class="btn btn-sm btn-success active-unactive-bank activer-<?= $value['id'] ?>" data-action="1" data-id="<?= $value['id'] ?>">BẬT TỰ ĐỘNG</button>

                  <?php }else{ ?>

                    <button class="btn btn-sm btn-danger active-unactive-bank untiver-<?= $value['id'] ?>"  data-action="0"  data-id="<?= $value['id'] ?>">TẮT TỰ ĐỘNG</button>
                    <a href="/Admin/manager-bank/<?= $value['id'] ?>" class="btn btn-sm btn-primary"> QUẢN LÝ</a>

                  <?php   } ?>
                <?php } ?>

                <button class="btn btn-sm btn-danger delete-bank" data-id="<?= $value['id'] ?>"> DELETE</button>
              </div>
            </td>

          </tr>
        <?php endforeach ?>
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
<script src="/Admin/admin_public/assets/payment.js"></script>
