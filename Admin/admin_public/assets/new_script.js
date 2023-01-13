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
  let action_na = (action == 0) ? 'tắt kích hoạt' : 'kích hoạt';
  let action_btn = (action == 0) ? 'btn-danger' : 'btn-success';

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
          $('#list-nganhang').find('.active-unactive-bank').html(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
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
        $('#list-nganhang').find('.active-unactive-bank').html(`${action_na}`).removeAttr('disabled').addClass(action_btn).removeClass('btn-secondary');
      });

    }
  })
});

});