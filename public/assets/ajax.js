    $(document).ready(function() {
       $('.pack-hack-custom').click(function(event) {
        $('.pack-hack-custom').removeClass('border-select-tet');
        /* Act on the event */
        let id = $(this).data('id');
        if ($(`input[name="select_pack_${id}"]`).is(':checked')) {
            $(this).addClass('border-select-tet');
        }
    });
   });
 // add-to-cart
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
                        confirmButton: 'btn text-capitalize button-swal-confirm ',
                        cancelButton: 'btn text-capitalize button-swal-cancel '
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
                        confirmButton: 'btn text-capitalize button-swal-confirm ',
                        cancelButton: 'btn text-capitalize button-swal-cancel '
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
            let cate = $(this).data('cate');

            Swal.fire({
              title: 'Thông báo',
              html: "Bạn có muốn mua sản phẩm: #"+sanpham+" với giá: "+money+" vnđ",
              icon: 'info',
              showCancelButton: true,
              confirmButtonText: 'Mua ngay',
              customClass:
              { 
                popup: 'custom_modal',
                confirmButton: 'btn text-capitalize button-swal-confirm ',
                cancelButton: 'btn text-capitalize button-swal-cancel '
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
          if (obj.status == 99) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thông báo',
                html: obj.messages,
                showConfirmButton: false,
                customClass:
                { 
                    popup: 'custom_modal',
                    confirmButton: 'btn text-capitalize button-swal-confirm ',
                    cancelButton: 'btn text-capitalize button-swal-cancel '
                },

                timer: 3000
            }).then( ()=>{
             window.location = '/cate/'+cate+'.html';
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
                confirmButton: 'btn text-capitalize button-swal-confirm ',
                cancelButton: 'btn text-capitalize button-swal-cancel '
            },
        })
        }
    }
} )

   });
    });
// kết thúc mua

$(document).ready(function() {
    $('.btn-delete-cart').click(function(event) {
        /* Act on the event */
        let id = $(this).data('id');
        Swal.fire({
          title: 'Thông báo',
          text: "Bạn có muốn xóa sản phẩm ra khỏi giỏ hàng ?",
          icon: 'warning',
          showCancelButton: true,

          confirmButtonText: 'Xóa ngay',
          customClass:
          { 
            popup: 'custom_modal',
            confirmButton: 'btn text-capitalize button-swal-confirm ',
            cancelButton: 'btn text-capitalize button-swal-cancel '
        },
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            url: '/ajax/cart.php',
            type: 'POST',
            data: {key: 0, id:id},
        })
        .done(function(result) {
         let obj = JSON.parse(result);
         if (obj.status == 99) {
             Swal.fire({
              title: 'Thông báo',
              text: obj.messages,
              icon: 'success',
              showCancelButton: false,
              confirmButtonText: 'Đồng ý',
              customClass:
              { 
                popup: 'custom_modal',
                confirmButton: 'btn text-capitalize button-swal-confirm ',
                cancelButton: 'btn text-capitalize button-swal-cancel '
            },
        }).then( ()=>{
         location.reload();
     } );
    }else{
       Swal.fire({
          title: 'Thông báo',
          text: obj.messages,
          icon: 'warning',
          showCancelButton: false,
          confirmButtonText: 'Đồng ý',
          customClass:
          { 
            popup: 'custom_modal',
            confirmButton: 'btn text-capitalize button-swal-confirm ',
            cancelButton: 'btn text-capitalize button-swal-cancel '
        },
    })
   }
})
        .fail(function() {
            console.log("error");
        });

    }
})
});
});

function copyinput(element) {
    let $term = $("<input>");
    $('body').append($term);
    $term.val($(element).text()).select()
    document.execCommand("copy");
    $term.remove();
    /* Alert the copied text */
    toastr.success(`Copied: ${$(element).text()} `,'', {
        timeOut: 100, }
        )
}
$(document).ready(function() {

// copy to clipboard

var swiper = new Swiper(".image-list-small", {
    spaceBetween: 5,
    slidesPerView: 3,
    watchSlidesProgress: true,
    breakpoints:{
        986:{
         slidesPerView: 5,
     }
 }
});
        // big image 
        var swiper2 = new Swiper(".image-list-details", {
            zoom: true,
            loop: true,
            spaceBetween: 10,
            autoHeight: true,
            autoplay: {
              delay: 1500,
              disableOnInteraction: false,
              pauseOnMouseEnter: true,
          },
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
        // qr-code
        $.ajax({
            url: '/ajax/qr-code.php',
            type: 'GET',
            data: {param: location.href},
            beforeSend: function(){
                $('#qr-code').html('Đang tải mã QR-Code....');
            }
        })
        .done(function(data) {
            $('#qr-code').html(`<img src="${data}" height="150px" alt="">`);
        })
        .fail(function() {
            console.log("error");
        });
        
    });
$(document).ready(function() {
    //cancle search
    $('#search-cancle').click(function(event) {
        /* Act on the event */
        $('#ranks').val('');
        $('#min-price').val('');
        $('#max-price').val('');
        $.ajax({
            url: `/ajax-sanpham`,
            type: 'GET',
            data: {cate_id: pathname,pages:1},
            beforeSend: function(){
                $('#load-san-pham').html(`<img src="/public/uploads/loading.gif" style=" width: 150px; " alt="">`); 
            }
        }).done(function(data) {
         $('#load-san-pham').html(data);
     })
        .fail(function() {
            console.log("error");
        });

    })
                // search
                $('#search-product').click(function(event) {
                 /* Act on the event */
                 event.preventDefault();
                 var rank = $('#ranks').val();
                 var low_price = $('#min-price').val();
                 var max_price = $('#max-price').val();
                 var pages = $(this).data('pages');
                 if(rank != '' || low_price != '' || max_price != ''){
                     $.ajax({
                        url: `/ajax-sanpham`,
                        type: 'GET',
                        data: {pages: pages,cate_id: pathname,rank: rank, min: low_price, max: max_price},
                        beforeSend: function(){
                            $('#load-san-pham').html(`<img src="/public/uploads/loading.png" style=" width: 150px; " alt="">`); 
                        }
                    })
                     .done(function(data) {
                      $('#load-san-pham').html(data);
                  })
                     .fail(function() {
                       alert('Vui lòng kiểm tra kết nối mạng');
                   });

                 }
             });
            });
const pathname = $('#danh-muc').data('catelogries');

