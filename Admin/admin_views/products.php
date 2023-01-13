<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Quản lý sản phẩm: <strong class="text-success"> <?= $info_cate['name'] ?></strong></h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/Admin/home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="/Admin/products/<?= $info_cate['id'] ?>">Quản lý sản phẩm #<?= $info_cate['name'] ?></a>
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
                <h4 class="card-title">Thêm sản phẩm</h4>
              </div>
              <div class="card-body">
                <p class="card-text">
                 Thêm sản phẩm cho <?= $info_cate['name']  ?>.
               </p>
               <div class="row">
                <div class="col-sm-12 col-lg-6 mb-2">
                  <label for="">Tài khoản</label>
                  <input name="taikhoan" type="text" id="name-cate" class="form-control" placeholder="Tài khoản">
                </div>
                <div class="col-sm-12 col-lg-6 mb-2">
                  <label for="">Mật khẩu</label>
                  <input name="matkhau" type="text" id="name-cate" class="form-control" placeholder="Mật khẩu">
                </div>
                <div class="col-sm-12 col-lg-6 mb-2">
                  <label for="">Giá tiền</label>
                  <input name="price" type="number" id="name-cate" class="form-control" placeholder="Giá tiền">
                </div>
                <div class="col-sm-12 col-lg-6 mb-2">
                 <label for="">Thông tin thêm</label>
                 <input name="info" class="form-control" placeholder="Nhập thông tin thêm">
               </div>
               <div class="col-sm-6 col-lg-3 mb-2">
                <label for="">Rank</label>
                <select name="rank" id="" class="form-control">
                 <?php foreach ($info_ranks as $key => $value): ?>
                   <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                 <?php endforeach ?>
               </select>
             </div>
             <div class="col-sm-6 col-lg-3 mb-2">
               <label for="">Level</label>
               <input name="level" class="form-control" placeholder="Level">
             </div>
             <div class="col-sm-6 col-lg-3 mb-2">
              <label for="">Skin</label>
              <input name="skin" class="form-control" placeholder="Skin">
            </div>

            <div class="col-sm-6 col-lg-3 mb-2">
              <label for="">Skin súng</label>
              <input name="champs" class="form-control" placeholder="Skin súng">
            </div>
             <div class="col-sm-6 col-lg-6 mb-2">
               <label for="">Liên kết</label>
               <input name="lienket" class="form-control" placeholder="Liên Kết">
             </div>
              <div class="col-sm-6 col-lg-6 mb-2">
               <label for="">RP</label>
               <input name="rp" class="form-control" placeholder="RP">
             </div>
            <div class="col-sm-12 col-lg-12 mb-2">
              <label for="">Hình ảnh</label>
              <input name="images" class="form-control" placeholder="Hình ảnh">
            </div>
            <div class="col-sm-12 col-lg-12 mb-2">
              <label for="">List Hình ảnh</label>
              <textarea name="list_images" cols="30" rows="6" class="form-control" placeholder="List hình ảnh"></textarea>
            </div>

            <div class="col-sm-12 col-lg-12 mb-2">
              <button class="btn btn-outline-primary" id="upload-products" data-cate="<?=  $info_cate['id'] ?>"><i data-feather='save'></i> Upload</button>
              <a class="btn btn-outline-secondary" href='/Admin/categogries'>
               Trở lại
             </a>
           </div>
         </div>
       </div>
     </div>
   </div>

   <script>
    $(document).ready(function() {
      $('#upload-products').click(function(event) {
        /* Act on the event */
        let taikhoan = $('input[name="taikhoan"]').val();
        let matkhau = $('input[name="matkhau"]').val();
        let price = $('input[name="price"]').val();
        let info = $('input[name="info"]').val();
        let level = $('input[name="level"]').val();
        let skin = $('input[name="skin"]').val();
        let rank = $('select[name="rank"]').val();
        let champs = $('input[name="champs"]').val();
        let images = $('input[name="images"]').val();
        let rp = $('input[name="rp"]').val();
        let lienket = $('input[name="lienket"]').val();

        let List_images = $('textarea[name="list_images"]').val();
        let cate = $(this).data('cate');
        if (taikhoan == '' || matkhau == '' || price == '' || info == '' || level == '' || skin == '' || rank == '' || champs == '' || images == '' || List_images == '' || cate == '' || rp == '' || lienket == '') {
          toastr.warning('Không được bỏ trống thông tin', 'Thông báo');
        }else{
         $.ajax({
          url: '/Admin/admin_ajax/upload-products.php',
          type: 'POST',
          method: 'POST',
          data: {rp:rp,lienket:lienket,taikhoan: taikhoan, matkhau: matkhau, list_img: List_images, champs:champs, rank:rank, skin:skin,images:images, info:info,level:level, price:price, cate: cate},
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

     });
    });
  </script>
  <!--/ Basic context menu -->

  <!-- List image -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header border-bottom">
        <h4 class="card-title">List tài khoản của: <?= $info_cate['name'] ?></h4>
      </div>
      <div class="card-body ">
        <table id="manager-cateList" class="display dtr-inline text-center" style="width: 100%;">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tài khoản</th>
              <th>Mật khẩu</th>
              <th>Giá tiền</th>
              <th>Danh mục</th>
              <th>Hình ảnh</th>
              <th>Thông tin phụ</th>
              <th>Level-Skin-Ranks-Tướng</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            foreach ($list_acc as $key => $value) {

              ?>
              <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['taikhoan'] ?></td>

                <td><?= $value['password'] ?></td>
                <td><span class='badge bg-success'><?= number_format($value['price']) ?> vnđ</span></td>
                <td><span class="badge bg-danger"><?= $reset->check_cate_id( $value['cate_id'] )['name'] ?></span></td>
                <td><img src="<?= $value['images'] ?>" width='120px' alt=""></td>
                <td> <?= $value['info'] ?></td>
                <td>
                  <ul style="list-style: none;">
                    <li class="nav-item mb-1">Level: <?= $value['level'] ?></li>
                    <li class="nav-item mb-1">Skin: <?= $value['skin'] ?></li>
                    <li class="nav-item mb-1">Ranks: <?= $reset->rank_list($value['ranks'],1)['name'] ?></li>
                    <li class="nav-item mb-1">Skin súng: <?= $value['champs'] ?></li>
                    <li class="nav-item mb-1">RP: <?= $value['rp'] ?></li>
                    <li class="nav-item mb-1">Liên kết: <?= $value['lienket'] ?></li>

                  </ul>
                </td>
                <td>
                  <button class="btn btn-danger btn-sm xoa-product" data-id='<?= $value['id'] ?>'>Xóa</button>
                </td>
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
<!-- MODAL -->
<!--  -->
<script>
  $(document).ready(function() {
   $('#manager-cateList').on('click', '.xoa-product', function(event) {
     event.preventDefault();
     /* Act on the event */
     let id = $(this).data('id');
     Swal.fire({
      title: 'Xóa tài khoản: #'+id,
      html: 'Bạn có muốn xóa tài khoản số: #'+id,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Xóa ngay!'
    }).then((result) => {
      if (result.isConfirmed) {
       $.ajax({
        url: '/Admin/admin_ajax/xoa-products.php',
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
           timeOut: 100,
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