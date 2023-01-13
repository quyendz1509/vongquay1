<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Web Settings</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="./quanlyweb">Quản lý trang web</a>
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
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Thông tin website</h4>
              </div>
              <div class="card-body">
               <form class="row" id="form-quanlyweb">
                 <div class="col-sm-12 mb-2">
                  <label for="">Link facebook</label>
                  <input name='fblinks' type="text" class="form-control toggle-disabled" value="<?= $admins['facebook_links'] ?>" disabled>
                </div>
                <div class="col-sm-6 mb-2">
                  <label for="">Link Zalo</label>
                  <input name='zalolinks' type="text" class="form-control toggle-disabled" value="<?= $admins['zalo_links'] ?>" disabled>
                </div>
                <div class="col-sm-6 mb-2">
                  <label for="">Link Support</label>
                  <input name='support' type="text" class="form-control toggle-disabled" value="<?= $admins['support'] ?>" disabled>
                </div>
                <div class="col-sm-12 mb-2">
                  <label for="">Khuyến mãi nạp thẻ <strong class="text-primary">(%)</strong></label>
                  <input name='kmnapthe' type="text" class="form-control toggle-disabled" value="<?= $admins['km_thecao'] ?>" disabled>
                </div>
                <div class="col-sm-12 mb-2">
                  <label for="">Khuyến mãi nạp MoMo và ATM <strong class="text-primary">(%)</strong></label>
                  <input name="kmatm" type="text" class="form-control toggle-disabled" value="<?= $admins['km_bank_momo'] ?>" disabled>
                </div>
                <div class="col-sm-12 mb-2">
                  <label for="">Cú pháp nạp </label>
                  <input name="cuphap" type="text" class="form-control toggle-disabled" value="<?= $admins['cuphap'] ?>" disabled>
                </div>
                <div class="col-sm-12 mb-2">
                  <label for="">Phone</label>
                  <input name="phone" type="text" class="form-control toggle-disabled" value="<?= $admins['phone'] ?>" disabled>
                </div>
                <div class="col-sm-12 mb-2">
                  <label for="">Nội dung trang chủ</label>
                  <textarea name="noticeHome" rows="6" class="form-control toggle-disabled" disabled><?= $admins['thongtin_home'] ?></textarea>
                </div>
                <div class="col-sm-12 mb-2">
                  <label for="">Nội dung thông báo</label>
                  <textarea name="notice" rows="6" class="form-control toggle-disabled" disabled><?= $admins['notice'] ?></textarea>
                </div>
                <div class="col-sm-12 mb-2">
                  <label for="">Điểm thưởng</label>
                  <input name="diem" type="text" class="form-control toggle-disabled" value="<?= $admins['diem'] ?>" disabled>
                </div>
                <div class="col-sm-6 mb-2">
                  <label for="">Trạng thái website</label>
                  <div class="form-check form-switch">
                    <?php 
                    if ($admins['trangthai'] == 1) {
                      $color_strong = 'text-primary';
                      $check = 'checked';
                    }else{
                      $color_strong = '';
                      $check = '';
                    }
                    ?>
                    <input name="trangthai" type="checkbox" class="form-check-input toggle-disabled" <?=  $check ?> id="customSwitch1" disabled>
                  </div>
                </div>
                <div class="col-sm-6 mb-2">
                  <label for="">Thông báo</label>
                  <div class="form-check form-switch">
                    <?php 
                    if ($admins['status_notice'] == 1) {
                      $color_strong_notice = 'text-primary';
                      $check_notice = 'checked';
                    }else{
                      $color_strong_notice = '';
                      $check_notice = '';
                    }
                    ?>
                    <input name='thongbao' type="checkbox" class="form-check-input toggle-disabled" <?=  $check_notice ?> id="customSwitch1" disabled>
                  </div>
                </div>
                <div class="col-sm-12">
                  <button class="btn btn-outline-warning waves-effect" type="button" id="edit-setting-web" data-rule='0'>Chỉnh sửa</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!--/ Basic context menu -->
      </div>
    </section>
    <!--/ context-menu -->

  </div>
</div>
</div>
<script>
 CKEDITOR.replace('noticeHome');
 $(document).ready(function() {
  $('#edit-setting-web').click(function(event) {
    /* Act on the event */
    let rule = $(this).data('rule');
    if (rule == 0) {
      CKEDITOR.instances['noticeHome'].setReadOnly(false);
     $(this).attr('type', 'button');
     $(this).removeClass('btn-outline-warning').addClass('btn-outline-success');
     $('.toggle-disabled').removeAttr('disabled');
     $(this).data('rule', 1);
     $(this).html('Lưu lại');
   }else{
    CKEDITOR.instances['noticeHome'].setReadOnly(true);
    $(this).attr('type', 'submit');
    $(this).removeClass('btn-outline-success').addClass('btn-outline-warning');
    $('.toggle-disabled').attr('disabled', '');
    $(this).data('rule', 0);
    $(this).html('Chỉnh sửa');
  }
});
});
  // check form quản lý

</script>
<script>
  $(document).ready(function() {
    $('#form-quanlyweb').submit(function(event) {
      /* Act on the event */
      event.preventDefault();
      let fb_link = $('input[name="fblinks"]').val();
      let km_napthe = $('input[name="kmnapthe"]').val();
      let km_atm = $('input[name="kmatm"]').val();
      let cuphap = $('input[name="cuphap"]').val();
      let phone = $('input[name="phone"]').val();
      let noidung = $('textarea[name="notice"]').val();
      let zalo = $('input[name="zalolinks"]').val();
      let support = $('input[name="support"]').val();
      let diem = $('input[name="diem"]').val();
      let trangthai = $('input[name="trangthai"]').is(':checked') ? 1 : 0;
      let thongbao = $('input[name="thongbao"]').is(':checked') ? 1 : 0;
      let noticehome = CKEDITOR.instances['noticeHome'].getData();
      if (fb_link == '' || km_napthe == '' || km_atm == '' || phone == '' || noidung =='' || cuphap == '' || support == '' || zalo == '' || diem == '' || noticehome == '') {
        toastr.info('Không được bỏ trống thông tin', 'Thông báo !!', {
          timeOut: 1500,
          progressBar: true,
        });
      }else{
        $.ajax({
          url: './admin_ajax/setting.php',
          type: 'POST',
          data: {linkfb: fb_link, km_napthe: km_napthe, km_atm: km_atm, phone: phone, trangthai: trangthai, thongbao: thongbao, noidung: noidung,cuphap:cuphap,support:support,zalo:zalo,diem:diem,noticehome:noticehome},
        })
        .done(function(result) {
          obj = JSON.parse(result);
          if (obj.status == 99) {
           toastr.success(obj.messages, 'Thông báo !!', {
            timeOut: 1500,
            progressBar: true,
          });
         }else{
          toastr.warning(obj.messages, 'Thông báo !!', {
            timeOut: 1500,
            progressBar: true,
          });
        }
      })
        .fail(function() {
          console.log("error");
        });
        
      }
    });
  });
</script>