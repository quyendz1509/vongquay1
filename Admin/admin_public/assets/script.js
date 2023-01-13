         $(document).ready(function() {
          $('#manager-user').on('click', '.khoa-taikhoan', function(event) {
            event.preventDefault();
            /* Act on the event */
            let id = $(this).data('id');
            let stt = $(this).data('stt');
            Swal.fire({
              title: 'Thông báo thay đổi trạng thái tài khoản: #'+id,
              html: 'Bạn có muốn thực hiện hành động trên ?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Xóa ngay!'
            }).then((result) => {
              if (result.isConfirmed) {
               $.ajax({
                url: './admin_ajax/lock-user.php',
                type: 'POST',
                method: 'POST',
                data: {id: id,status:stt},
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
         $(document).ready(function() {
          $('#save-cate-list').click(function(event) {
            /* Act on the event */
            let cat = $('input[name="cate_name"]').val();
            let game = $('select[name="game_name"]').val();
            let hinhanh = $('input[name="image"]').val();
            let content = $('textarea[name="content"]').val();
            let loai = $('select[name="loai"]').val();
            if (cat == '' || game == '' || hinhanh == '' || content == '' || loai == '') {
             toastr.warning("không được bỏ trống thông tin.", 'Thông báo');
           }else{
             $.ajax({
              url: './admin_ajax/upload-cate.php',
              type: 'POST',
              method: 'POST',
              data: {name: cat, game: game, hinhanh:hinhanh,content: content, loai: loai},
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
//update game
$(document).ready(function() {
 $('.save-edit-game').click(function(event) {
   /* Act on the event */
   let id = $(this).attr('gameid');
   let name = $('input[name="edit_name_game"]').val();
   let status = $('select[name="trangthai_game"]').val();
   let sapxep = $('input[name="sap_xep"]').val();
   let rank = $('select[name="rank_game"]').val();

   Swal.fire({
    title: 'Thông Báo',
    html: 'Bạn có muốn lưu thông tin game '+ id +' ?',
    icon: 'info',
    showCancelButton: true,
    confirmButtonText: 'Sửa ngay'
  }).then((result) => {
    if (result.isConfirmed) {
     $.ajax({
      url: './admin_ajax/edit-game.php',
      type: 'POST',
      method: 'POST',
      data: {id: id, name:name, status:status, sapxep:sapxep, rank:rank},
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

// 
$(document).ready(function() {
  $('#edit-game-list').on('show.bs.modal', function(event) {
       let button = $(event.relatedTarget); // Button that triggered the modal
  let id = button.data('id'); // Extract info from data-* attributes
  let game = button.data('name');
  let modal=  $(this);
  modal.find('.modal-title').html('Chỉnh sửa thông tin: #'+id);
  modal.find('input[name="edit_name_game"]').val(game);
  modal.find('.save-edit-game').attr('gameid', id);
  /* Act on the event */
});
  // cate edit 
  $('#edit-cate-list').on('show.bs.modal', function(event) {
       let button = $(event.relatedTarget); // Button that triggered the modal
  let id = button.data('id'); // Extract info from data-* attributes
  let name = $('.name-cate-'+id).html();
  let noidung = $('.content-cate-'+id).html();
  let hinhanh = $('.img-cate-'+id).html();
  let modal=  $(this);
  modal.find('.modal-title').html('Chỉnh sửa thông tin: #'+id);
  modal.find('input[name="edit_name_cate"]').val(name);
  modal.find('input[name="hinh_anh"]').val(hinhanh);
  modal.find('textarea[name="noidung_cate"]').val(noidung);
  modal.find('.save-edit-cate').attr('cateid', id);
  /* Act on the event */
});
});

$(document).ready(function() {
  $('#manager-gamelist').on('click', '.xoa-payment', function(event) {
    event.preventDefault();
    /* Act on the event */
    let id = $(this).data('id');
    Swal.fire({
      title: 'Xóa mục ngân hàng: #'+id,
      html: 'Bạn có muốn xóa ngân hàng trên ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Xóa ngay!'
    }).then((result) => {
      if (result.isConfirmed) {
       $.ajax({
        url: './admin_ajax/xoa-payment.php',
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


$(document).ready(function() {
  $('#manager-gamelist').on('click', '.xoa-game', function(event) {
    event.preventDefault();
    /* Act on the event */
    let id = $(this).data('id');
    Swal.fire({
      title: 'Xóa mục game: #'+id,
      html: 'Khi xóa game đồng nghĩa với việc sẽ xóa đi cả danh mục và sản phẩm ở trong nó. Hãy lưu ý.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Xóa ngay!'
    }).then((result) => {
      if (result.isConfirmed) {
       $.ajax({
        url: './admin_ajax/xoa-gamelist.php',
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

//

$(document).ready(function() {
  $('#manager-cateList').on('click', '.xoa-cate', function(event) {
    event.preventDefault();
    /* Act on the event */
    let id = $(this).data('id');
    Swal.fire({
      title: 'Xóa mục game: #'+id,
      html: 'Khi xóa game đồng nghĩa với việc sẽ xóa đi tất cả sản phẩm ở trong nó. Hãy lưu ý.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Xóa ngay!'
    }).then((result) => {
      if (result.isConfirmed) {
       $.ajax({
        url: './admin_ajax/xoa-cate.php',
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
function copyToClipBoard(param) {
  /* Get the text field */
  var copyText = document.querySelector(param);

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  toastr.success('Đã copy nội dung thành công', 'Thông báo', {timeOut: 1000});
}
function ChangeToSlug(title)
{
  var slug;

    //Lấy text từ thẻ input title 

    //Đổi chữ hoa thành chữ thường
    slug = title.toLowerCase();

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    return slug;
  }
  $(document).ready(function() {
    $('#manager-images').DataTable({
     responsive: true
   });
    $('#manager-gamelist').DataTable({
     responsive: true,
      dom: 'Bfrtip',
      buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
   });
    $('#manager-cateList').DataTable({
      responsive: true
    })
  });
// xử lý úp hình ảnh
Dropzone.options.formUploadsImages = {
    // Configuration options go here
    addRemoveLinks: true,
    autoProcessQueue: false,
    uploadMultiple: true,
    maxFiles: 10,
    parallelUploads: 10,
    maxFilesize: 2200000,
    acceptedFiles: 'image/*',
    url: './admin_ajax/uploads.php',

    init: function() { 
      var myDropzone = this;
      $('#btn-uploads-images').click(function(event) {
        /* Act on the event */
        event.preventDefault();
        event.stopPropagation();
        myDropzone.processQueue();
      });
      myDropzone.on('success', function(file) {
       this.removeFile(file);
       /* Act on the event */
     });
      myDropzone.on("successmultiple", function(file , responsive) {
        obj = JSON.parse(responsive);
        obj.map( (element)=>{
          if (element.status == 0) {
            toastr.warning(element.messages);
          }else{
           toastr.success(element.messages, 'Thành công', {
            timeOut: 1000,
            onHidden: function() {
              location.reload();
            }
          });
         }
       } )

      });
    }
  };
//  xử lý xóa ảnh
$(document).ready(function() {
  $('#manager-images').on('click', '.btn-xoa-anh', function(event) {
    event.preventDefault();
    /* Act on the event */
    id = $(this).data('id');
    Swal.fire({
      title: 'Bạn có muốn xóa ảnh này ? ',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Xóa ngay!'
    }).then((result) => {
      if (result.isConfirmed) {
       $.ajax({
        url: './admin_ajax/xoa-anh.php',
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