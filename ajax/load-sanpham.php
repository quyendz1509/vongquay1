<?php 
session_start();
// set time zone
date_default_timezone_set('Asia/Ho_Chi_Minh');
// Gọi database
require '../modules/database.php';
// Gọi product
require '../modules/product.php';

$product = new productClass();

if (isset($_GET['cate_id']) && $_GET['pages']) {
	$cate_id = $_GET['cate_id'];
    // Categogries
	$cate = $product->infoCategogries($cate_id);
    // GameList
   $gamelist = $product->gameList($cate['gamelist_id']);
   if (!$cate){
      echo 'Không tìm thấy danh mục !';
  }else{
    $page = ($_GET['pages'] > 1) ? $_GET['pages'] : 1;
    $rank = (isset($_GET['rank']) && is_numeric($_GET['rank'])) ? htmlspecialchars($_GET['rank']) : '';
    $min = (isset($_GET['min']) && is_numeric($_GET['min'])) ? htmlspecialchars($_GET['min']) : '';
    $max = (isset($_GET['max']) && is_numeric($_GET['max'])) ? htmlspecialchars($_GET['max']) : '';
    $pro_list = $product->getProductByCateId($cate['id'],$page,$rank,$min,$max);

    if (count($pro_list) < 1) {
        echo 'Không tìm thấy sản phẩm';
    }
}

}else{
	echo 'Không tìm thấy danh mục !';
}

?>
<?php 
foreach ($pro_list as $key => $value) { 

    $rankinfo = $product->getListRanks($value['ranks'],$gamelist['loairank']);
    ?>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-10">
        <div class="my-info-box card tet-card mb-30">
           <div class="header-item-box">
            <h4 class="m-0 text_tet_title">Tài khoản: <span>#<?= $value['id'] ?></span></h4>
        </div>
        <div class="my-item-center img-inside">
            <div id="line-duoi"></div>
            <a href="/details/<?= $value['id'] ?>">
                <img src="<?= $value['images'] ?>" alt="" height="250px" width="100%">
            </a>
            <div id="line-tren"></div>

        </div>
        <div class="my-item-info-all">
            <p>Level: <span><?= $value['level'] ?></span> </p>
            <p>Rank: <span><?php echo  (!$rankinfo) ? 'Null' : $rankinfo['name'];  ?></span> </p>
            <p>Skin súng: <span><?= $value['champs'] ?></span></p>
            <p>Số skin: <span><?= $value['skin'] ?></span> </p>
            <p>RP: <span><?= $value['rp'] ?></span> </p>
            <p>Liên kết: <span><?= $value['lienket'] ?></span> </p>

        </div>
        <div class="price-product-info text-center">
            <div id="line-duoi"></div>
            <p class="m-0 font-tet" style="color: #fffebb; padding-top: 6px;"><?= number_format($value['price']) ?> VNĐ </p>
            <div id="line-tren"></div>

        </div>
        <div class="my-item-footer text-center mt-2">
          <!--  -->
          <button class="button-tet btn text_tet_title_red mua-ngay-btns" data-money='<?= number_format($value['price']) ?>' data-sanpham='<?= $value['id'] ?>'><span>Mua ngay</span></button>
      </div>

      <div class="or-footer-item text-center">
          <p>Hoặc</p>
          <a class="btn" href="/details/<?= $value['id'] ?>">Xem chi tiết sản phẩm </a>
      </div>
  </div>
</div>
<?php 
}
echo $product->pagination($cate_id,$_GET['pages'],$rank,$min,$max);
?>
<script>
    $(document).ready(function() {
        // xử lý pagination
        $('.prev-next-pagination').click(function(event) {
            /* Act on the event */
            var id = $(this).data('id');
            var cate = $(this).data('cate');
            $.ajax({
                url: `/ajax-sanpham?cate_id=${cate}&pages=${id}`,
                type: 'GET',
                beforeSend: function(){
                   window.scrollTo(0, 0);
                   $('#load-san-pham').html('Đang tải dữ liệu...');

               }
           })
            .done(function(data) {
                $('#search-product').attr('data-pages', id);
                $('#load-san-pham').html(data);
            })
            .fail(function() {
                console.log("error");
            });
        });
    });

    $(document).ready(function() {
     // xử lý add to cart
     $('.add-to-cart').click(function(event) {
        /* Act on the event */
        let id = $(this).data('sanpham');
        let attr
        $.ajax({
            url: '/handle/cart.php',
            type: 'POST',
            method: 'POST',
            beforeSend: function(){
                $(`.add-to-cart[data-sanpham="${id}"]`).attr('disabled', 'true');
            },
            data: {key: 0, id: id},

        })
        .done(function(result) {
            $(`.add-to-cart[data-sanpham="${id}"]`).removeAttr('disabled');
            let obj = JSON.parse(result);
            if (obj.status == 0) {
                Swal.fire({
                    title: 'Thông báo',
                    html: obj.messages,
                    icon: 'warning',
                    showCancelButton: false,
                    
                    confirmButtonText: 'Đồng ý',
                    customClass:
                    { 
                        popup: 'custom_modal',
                        confirmButton: 'btn text-capitalize button-swal-confirm font-tet',
                        cancelButton: 'btn text-capitalize button-swal-cancel font-tet'
                    },
                })
            }else{
                Swal.fire({
                    title: 'Thông báo',
                    html: obj.messages,
                    icon: 'success',
                    showCancelButton: false,
                    
                    confirmButtonText: 'Đồng ý',
                    customClass:
                    { 
                        popup: 'custom_modal',
                        confirmButton: 'btn text-capitalize button-swal-confirm font-tet',
                        cancelButton: 'btn text-capitalize button-swal-cancel font-tet'
                    },
                })
                $('#soluong-cart-header').load(location.href + " #soluong-cart-header");
                $('#soluong-cart-mobile').load(location.href + " #soluong-cart-mobile");
            }
        })
        .fail(function() {
          $(this).html('Đang xử lý');

      });

    });
 });
    // Mua sản phẩm 
    $(document).ready(function() {
        $('.mua-ngay-btns').click(function(event) {
            /* Act on the event */
            let sanpham = $(this).data('sanpham');
            let money = $(this).data('money');
            Swal.fire({
              title: 'Thông báo',
              html: "Bạn có muốn mua sản phẩm: #"+sanpham+" với giá: "+money+" vnđ",
              icon: 'info',
              showCancelButton: true,
              confirmButtonText: 'Mua ngay',
              customClass:
              { 
                popup: 'custom_modal',
                confirmButton: 'btn text-capitalize button-swal-confirm font-tet',
                cancelButton: 'btn text-capitalize button-swal-cancel font-tet'
            },
            showLoaderOnConfirm: true,
            backdrop: true,
            preConfirm: (data)=>{
             return $.ajax({
                url: '/ajax/accout.php',
                type: 'POST',
                data: {sanpham: sanpham},
            })
             .done(function(result) {
              return result;
          })
             .fail(function() {
                alert('Lỗi kết nối mạng');
            });

         }
     }).then( (result)=>{
        if (result.isConfirmed) {
          obj =  JSON.parse(result.value);
          if (obj.status == "99") {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thông báo',
                html: obj.messages,
                showConfirmButton: false,
                customClass:
                { 
                    popup: 'custom_modal',
                    confirmButton: 'btn text-capitalize button-swal-confirm font-tet',
                    cancelButton: 'btn text-capitalize button-swal-cancel font-tet'
                },
                timer: 3000
            }).then( ()=>{
                location.reload();
            } )
        }else{
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: obj.messages,
              confirmButtonText: 'Đồng ý',
              customClass:
              { 
                popup: 'custom_modal',
                confirmButton: 'btn text-capitalize button-swal-confirm font-tet',
                cancelButton: 'btn text-capitalize button-swal-cancel font-tet'
            },
        })
        }
    }
} )

 });
    });
</script>