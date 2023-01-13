<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Quản lý người dùng</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="./user">Quản lý người dùng</a>
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
              <h4 class="card-title">Quản lý người dùng</h4>
            </div>
            <div class="card-body ">
              <table id="manager-user" class="display dtr-inline" style="width: 100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Vai trò</th>
                    <th>Full name</th>
                    <th>Tài khoản</th>
                    <th>Số dư</th>
                    <th>Email</th>
                    <th>Hành động</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>ID</td>
                    <td>Vai trò</td>
                    <td>Full name</td>
                    <td>Tài khoản</td>
                    <td>Số dư</td>
                    <td>Email</td>
                    <td>Hành động</td>
                  </tr>
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
<!-- MODAL -->
<div class="modal fade text-start modal-primary" id="cong-tru-tien" tabindex="-1" aria-labelledby="myModalLabel110" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel110">Success Modal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <label for="">Nhập số tiền</label>
            <input type="number" name="edit_coin_user" class="form-control" placeholder="Nhập số tiền" value="0">
          </div>
          <div class="col-sm-12 mt-2">
            <label for="">Hành động</label>
            <select name="loai_tien_user" class="form-control">
              <option value="0">Cộng tiền</option>
              <option value="1">Trừ tiền</option>
            </select>
          </div>
          <div class="col-sm-12 mt-2">
            <label for="">Lý do</label>
            <textarea name="lydo_user" class="form-control" cols="30" rows="5"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary waves-effect waves-float waves-light save-edit-user">Save</button>
      </div>
    </div>
  </div>
</div>
<!--  -->
<script>
  $(document).ready(function() {

    $('#manager-user').DataTable({
      responsive: true,
      processing: true,
      "language": {
        "emptyTable": "Không thể tải dữ liệu từ hệ thống"
      },
      // serverSide: true,
      ajax: `/Admin/admin_data/load-user.php`,
      columns: [
      {data: 'id'},
      { data: 'rules'},
      { data: 'fullname'},
      { data:'username'},
      { data: 'sotien'},
      { data: 'email'},
      { data: 'another'},

      ],
      order: [[0, 'asc']],
    });

    $('#cong-tru-tien').on('show.bs.modal', function(event) {
      let button = $(event.relatedTarget); // Button that triggered the modal
  let id = button.data('id'); // Extract info from data-* attributes
  let sotien = $('.sotien-'+id);
  let modal=  $(this);
  modal.find('.modal-title').html('Cộng trừ tiền cho tài khỏa: #'+id);
  modal.find('.save-edit-user').attr('userid', id);
  /* Act on the event */
});
  });
</script>
<script>
  //update game
  $(document).ready(function() {
   $('.save-edit-user').click(function(event) {
     /* Act on the event */
     let id = $(this).attr('userid');
     let sotien = $('input[name="edit_coin_user"]').val();
     let loai = $('select[name="loai_tien_user"]').val();
     let lydo = $('textarea[name="lydo_user"]').val();


     Swal.fire({
      title: 'Thông Báo',
      html: 'Bạn có muốn thực hiện hành động ?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonText: 'Thực hiện'
    }).then((result) => {
      if (result.isConfirmed) {
       $.ajax({
        url: './admin_ajax/cong-tru.php',
        type: 'POST',
        method: 'POST',
        data: {id: id, sotien:sotien, loai:loai, lydo:lydo},
      })
       .done(function(result) {
         obj = JSON.parse(result);
         if (obj.status == 0) {
          toastr.warning(obj.messages);
        }else{
         toastr.success(obj.messages, 'Thành công', {
           timeOut: 1000,
           onHidden: function() {
            location.reload();
          }
        });
       }

     })
       .fail(function() {
         console.log("error");
       });

     }
   })

  });
 });
</script>