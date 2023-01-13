<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0"><span class="text-primary"><?= $info_pack_hacks['name'] ?></span></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/Admin/home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="">Các gói hack: <span class="text-primary"><?= $info_pack_hacks['name'] ?></span></a>
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
                <h4 class="card-title">Thêm gói hack: <span class="text-primary"><?= $info_pack_hacks['name'] ?></span></h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 col-lg-6 mb-2">
                    <label>Giá tiền: <strong class="badge bg-primary" id="gia-tien">0 vnđ</strong></label>
                    <input name="pack_money" type="number" id="name-cate" class="form-control" placeholder="10000">
                  </div>
                  <div class="col-sm-12 col-lg-6 mb-2">
                   <label>Thời gian ( chỉ nhập số thôi )</label>
                   <input name="pack_time" type="number" class="form-control" placeholder="10000">
                 </div>
                 <div class="col-sm-12 col-lg-6 mb-2">
                   <label for="">Nhập loại</label>
                   <input name="pack_type" type="text" class="form-control" placeholder="Ngày, giờ, phút, giây....">
                 </div>
                 <div class="col-sm-12 col-lg-6 mb-2">
                  <label for="">Bản hack</label>
                  <input type="text" class="form-control" placeholder="Giới thiệu bản hack ngắn" readonly value="<?=$info_pack_hacks['name'] ?>">
                </div>

                <div class="col-sm-12 col-lg-12 mb-2">
                  <button class="btn btn-outline-primary" id="btn-uploads-pack" data-id='<?= $info_pack_hacks['id'] ?>'>
                    <i data-feather='save'></i> Lưu lại
                  </button>
                  <a href="/Admin/products/<?= $info_pack_hacks['cate_id'] ?>" class="btn btn-outline-secondary">Trở lại</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /List images -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header border-bottom">
              <h4 class="card-title">Danh sách các gói hack: <span class="text-primary"><?= $info_pack_hacks['name'] ?></span></h4>
            </div>
            <div class="card-body ">
              <table id="manager-gamelist" class="display dtr-inline text-center" style="width: 100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Số lượng key</th>
                    <th>Bản hack</th>
                    <th>Giá tiền</th>
                    <th>Thời gian</th>
                    <th>Loại</th>
                    <th>Hành động</th>
                    <th>Quản lý</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($packList as $key => $value) { ?>
                    <tr>
                      <td><?= $value['id'] ?></td>
                      <td><span class="badge bg-info"> <?= count($reset->listKeyHack($value['id'])) ?></span></td>
                      <td><span class="badge bg-primary"><?= $info_pack_hacks['name'] ?></span></td>
                      <td><?= number_format($value['price']) ?> vnđ</td>
                      <td><?= $value['time'] ?></td>
                      <td><?= $value['loai'] ?></td>
                      <td>
                        <button class="btn btn-danger btn-sm xoa-pack" data-id='<?= $value['id'] ?>'>Xóa</button>
                        <a class="btn btn-primary btn-sm" href="/Admin/editPack/<?= $value['id'] ?>">Sửa</a>
                      </td>
                      <td><a href="/Admin/key/<?= $value['id'] ?>" class="btn btn-sm btn-success">Quản lý key</a></td>
                    </tr>
                  <?php  }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--/ context-menu -->

  </div>
</div>
</div>
<script>

  $(document).ready(function() {
    $('#name-cate').keyup(function(event) {
      let valer = Number( $(this).val());
      let nformat = Intl.NumberFormat().format(valer);
      $('#gia-tien').html(`${nformat} vnđ`);
    });
    // click uploads
    $('#btn-uploads-pack').click(function(event) {
      /* Act on the event */
      let id = $(this).data('id');
      let money = $('input[name="pack_money"]').val();
      let time = $('input[name="pack_time"]').val();
      let type = $('input[name="pack_type"]').val();
      if (money == '' || time == '' || type == '') {
        toastr.warning('Không bỏ trống thông tin');
      }else{
       $.ajax({
        url: '/Admin/admin_ajax/upload-pack.php',
        type: 'POST',
        method: 'POST',
        data: {id:id,money:money,time:time,type:type},
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
        toastr.warning('Lỗi kết nối mạng.','Thông báo');
      });
     }
   });
          // xóa pack 

          $('#manager-gamelist').on('click','.xoa-pack',function(event) {
            /* Act on the event */
            let id = $(this).data('id');
            Swal.fire({
              title: 'Xóa gói hack: #'+id,
              html: 'Bạn có muốn thực hiện hành động trên ?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Xóa ngay!'
            }).then((result) => {
              if (result.isConfirmed) {
               $.ajax({
                url: '/Admin/admin_ajax/xoa-pack.php',
                type: 'POST',
                method: 'POST',
                data: {id: id},
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