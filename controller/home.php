<?php 
// error_reporting(0);
// ini_set('display_errors', 0);
// game list

$listVongQuay = $reset->listVongQuay();
// List hack status
$title = 'TRANG CHỦ';
require 'all-header.php';

require 'views/home.php';
?>
<script>
 $(document).ready(function() {
  const modal = $('#thongbao');
  const modal_title = modal.find('.modal-title');
  const modal_content = modal.find('.modal-content');

  const close_modal = $('.close-modal');
close_modal.click(function(event) {
  /* Act on the event */
    modal.removeClass('visible').addClass('invisible');
  
});
  let order =  $('#lucky-whel').data('soluot');
  let array_test = [];
  for (var i = 0; i < parseInt(order); i++) {
   array_test[i] = i;
 }

 var ex_Luckdraw = new Luckdraw('lucky-whel', {
  "order": array_test,
            "round": order, // 标记转动的圈数
            "t": 60, //标记转动的速度，也就是每过60毫秒记重新改变一次
          })

        // 点击触发抽奖 
        //num 代表第几个奖品，一般都是后台返回，callback代表的是成功的回调。
        // ex_Luckdraw.start(num,callback)
 $('.imgstart').on('click', function () {
  $.ajax({
    url: '/ajax/vongquay.php',
    type: 'POST',
    beforeSend: function(){
      $('.imgstart').attr('disabled', 'true').html('Đang quay thưởng....');
      $('#notice').html('');
    }
  })
  .done(function(res) {
    let json = JSON.parse(res);
    if(json.status == 0){
      modal_title.html('⛔');
      modal_content.html(json.smg);

      modal.addClass('visible').removeClass('invisible');
      $('.imgstart').removeAttr('disabled').html('Quay Thưởng');
    }else{
      $('#luotquay').html(`${json.luotquay} lượt`)
      ex_Luckdraw.start(json.position, function () {
       modal_title.html(`<img src="${json.icon}" class="w-40" alt="">`);
      modal_content.html(json.smg);
      modal.addClass('visible').removeClass('invisible');
       $('.imgstart').removeAttr('disabled').html('Quay Thưởng');
       $('#thongbao-nguoichoi').html(json.smg);
     })
    }
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {

  });

})
});
</script>
<script src="/public/vongquay/js/gh_luckdraw.js"></script>
<?php 
require 'views/footer.php';
?>
