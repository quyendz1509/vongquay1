 $(document).ready(function() {
  $('#list-nganhang').DataTable({
    responsive: true,
    displayLength: 7,
    lengthMenu: [7, 10, 25, 50, 75, 100],
    language: {
      paginate: {
        previous: "&nbsp;",
        next: "&nbsp;"
      }
    }
  });
  $('#list-nganhang').on('click', '.delete-bank', function(event) {
    event.preventDefault();
    /* Act on the event */
    let id = $(this).data('id');
    Swal.fire({
      title: 'Xóa tài khoản số #'+id,
      text: "Sau khi thực hiện hành động xóa tài khoản sẽ không thể khôi phục !!",
      icon: 'danger',
      showCancelButton: true,
      confirmButtonColor: '#7367F0',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Xóa ngay'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '/Admin/admin_loadform/delete_bank.php',
          type: 'POST',
          data: {id: id},
        })
        .done(function(result) {
          obj = JSON.parse(result);
          if(obj.status == 0){
            toastr.error(obj.messages,'Thông báo !!');
          }else{
            toastr.success(obj.messages,'Thông báo', {
              timeOut: 1500,
              preventDuplicates: true,
              closeButton: true,
                // Redirect 
                onHidden: function() {
                  location.reload();
                }
              });

          }
        })
        .fail(function() {
          toastr.error('Không thể kết nối tới hệ thống.','Thông báo !!',{
            "closeButton": true,
          });
        })

      }
    })
  });
// active auto
$('#list-nganhang').on('click', '.active-unactive-bank', function(event) {
  event.preventDefault();
  /* Act on the event */
  let id = $(this).data('id');
  let action = $(this).data('action');
  let action_na = (action == 0) ? 'TẮT TỰ ĐỘNG' : 'BẬT TỰ ĐỘNG';
  let action_btn = (action == 0) ? 'btn-danger' : 'btn-success';
  let action_html = (action == 0) ? '.untiver' :  '.activer';
  Swal.fire({
    title: ` ${action_na} tự động id:  #${id}`,
    text: "Hệ thống sẽ mất vài giây để thực hiện hành động. Vui lòng kiên nhẫn không tải lại trang.",
    icon: 'danger',
    showCancelButton: true,
    confirmButtonColor: '#7367F0',
    cancelButtonColor: '#d33',
    confirmButtonText: `${action_na}`
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: '/Admin/admin_loadform/active_unactive.php',
        type: 'POST',
        data: {id: id,action:action},
        beforeSend: function(){
          $('#list-nganhang').find(`${action_html}-${id}`).html(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
            <span>Đang xử lý...</span>`).attr('disabled', 'true').removeClass(action_btn).addClass('btn-secondary');
        }
      })
      .done(function(result) {
        obj = JSON.parse(result);
        if(obj.status == 0){
          toastr.error(obj.messages,'Thông báo !!');
        }else{
          toastr.success(obj.messages,'Thông báo', {
            timeOut: 1500,
            preventDuplicates: true,
            closeButton: true,
                // Redirect 
                onHidden: function() {
                  location.reload();
                }
              });

        }
      })
      .fail(function() {
        toastr.error('Không thể kết nối tới hệ thống.','Thông báo !!',{
          "closeButton": true,
        });
      })
      .always(function(){
        setTimeout( function(){
          $('#list-nganhang').find(`${action_html}-${id}`).html(`${action_na}`).removeAttr('disabled').addClass(action_btn).removeClass('btn-secondary');
        },2000)
      });

    }
  })
});

});

 let counter = 0;
 const loading = $('.loadngger');
 const resultbank = $('#result_callback_login_bank');
 $(document).ready(function() {
  $('.img_bank').click(function(event) {
    /* Act on the event */
    let brand = $(this).data('brand');
    let status = $(this).data('status');
    if (status == 1) {
      toastr.warning('Ngân hàng này đang bảo trì hoặc chưa được hỗ trợ. Vui lòng chọn  ngân hàng khác','Thông báo !!');
      counter++;
      if (counter == 10) {
        $.ajax({
          url: '/Admin/admin_loadform/logout.php',
          type: 'POST',
        })
        .done(function(res) {
          if(res == 'done'){
            location.reload();
          }
        });
      }
    }else{

      $('#login-payment').data('brand', brand);

    }
  });

        // load form
        $('#load-form').submit(function(event) {
          /* Act on the event */
          event.preventDefault();
          let taikhoan = $(this).find('input[name="stk_bank"]').val();
          let matkhau = $(this).find('input[name="matkhau_bank"]').val();
           let cuphap = $(this).find('input[name="cuphap_bank"]').val();
          let chuthe = $(this).find('input[name="chuthe_bank"]').val();
          let sotk = $(this).find('input[name="sotk"]').val();
        
          let brand = $(this).find(`button[id="login-payment"]`).data('brand');
          if (taikhoan == '' || matkhau == '') {
            toastr.warning('Không được bỏ trống thông tin', 'Thông báo');
          }else{
            $.ajax({
              url: '/Admin/admin_loadform/add-bank.php',
              type: 'POST',
              data: {taikhoan: taikhoan, matkhau: matkhau, brand: brand,chuthe:chuthe,sotk:sotk,cuphap:cuphap},
              beforeSend: function(){
                $('.loadngger').css('display', 'flex');
              }
            })
            .done(function(result) {
              obj = JSON.parse(result);
              if(obj.status == 0){
                toastr.warning(obj.messages,'Thông báo !!');
              }else{
                toastr.success(obj.messages,'Thông báo', {
                  timeOut: 1500,
                  preventDuplicates: true,
                  closeButton: true,
                // Redirect 
                onHidden: function() {
                  location.reload();
                }
              });

              }
            })
            .fail(function() {
              toastr.error('Không thể kết nối tới hệ thống.','Thông báo !!');

            })
            .always(function() {
              setTimeout( ()=>{
                $('.loadngger').css('display', 'none');

              },100);
            });

          }
        });
      });