<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-body">
      <div class="row">
        <div class="col-12">
          <h3 class="text-uppercase fw-bolder">Đăng nhập hệ thống</h3>
        </div>
        <div class="col-12">
          <div class="alert alert-danger" role="alert">
            <div class="alert-body">
              <strong>Info:</strong> Vui lòng điền mật khẩu bí mật để tiếp tục sử dụng chức năng.
              Nếu bạn không có mật khẩu vui lòng liện hệ <a href="https://www.facebook.com/quyensb1509/" class="link-primary">Diệp Quốc Quyền</a> để được cung cấp.
            </div>
          </div>
        </div>
        <!-- form login -->
        <div class="col-12 card">

          <form id="login-payment" class="row pt-2 pb-2">
            <div class="col-md-3 col-sm-12"></div>
            <div class="col-md-6 col-sm-12">
              <label for="">Nhập mật khẩu</label>
              <input type="password" id="passwordpayment" class="form-control" placeholder="Password">
            </div>
            <div class="col-md-3 col-sm-12"></div>
            <!-- row -->
            <div class="col-3"></div>
            <div class="col-6 mt-1">
              <button class="btn btn-sm btn-primary" id="login-payment">Đăng nhập</button>
            </div>
            <div class="col-3"></div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#login-payment').submit(function(event) {
      /* Act on the event */
      event.preventDefault();
      let password = $('#passwordpayment').val();
      if (password == '') {
        toastr.warning('Không được bỏ trống thông tin','Thông báo');
      }else{
        $.ajax({
          url: '/Admin/admin_ajax/passwordpayment.php',
          type: 'POST',
          data: {password: password},
          beforeSend: function(){
            $('#login-payment').find('button').attr('disabled', 'true').html('Đang xử lý').addClass('btn-secondary').removeClass('btn-primary');
          }
        })
        .done(function(result) {
          obj = JSON.parse(result);
          if(obj.status == 0){
            toastr.warning(obj.messages,'Thông báo !!');
          }else{
            toastr.success(obj.messages,'Thông báo', {
              timeOut: 2000,
              preventDuplicates: true,
                // Redirect 
                onHidden: function() {
                  location.reload();
                }
              });

          }
        })
        .fail(function() {
          toastr.warning('Không thể kết nối tới hệ thống. Vui lòng kiểm tra đường truyền','Thông báo');

        })
        .always(function() {
             $('#login-payment').find('button').removeAttr('disabled').html('Đăng nhập').addClass('btn-primary').removeClass('btn-secondary');

        });
        
      }
    });
  });
</script>