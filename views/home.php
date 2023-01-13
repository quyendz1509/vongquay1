<?php 

?>
<!-- banner -->
<div class="w-full  text-center py-5 md:py-12 px-5  break-normal">
 <div class="container mx-auto">
  <h1 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white md:text-4xl lg:text-6xl uppercase">
    <span class="text-transparent bg-clip-text bg-gradient-to-r to-sky-700 from-sky-400 "><?= $setting['web_name'] ?></span> - <span><?= $setting['web_title'] ?></span>.</h1>
    <p class="text-lg  text-gray-500 lg:text-lg font-medium  uppercase"><?=  $setting['web_description'] ?>.</p>
  </div>

</div>

<!-- banner -->
<div class="border-gray-100 bg-white py-5 px-5 ">
  <div class="container mx-auto text-center">
    <p id="thongbao-nguoichoi" class="uppercase text-slate-600 mb-5"></p>
  </div>
  <div class="container mx-auto">
    <div id="lucky-whel" class="text-center bg-slate-100 rounded-md p-5" data-soluot="<?= count($listVongQuay) ?>">
      <h2 class="text-blue-500 font-extrabold text-3xl mb-2 uppercase">Vòng quay may mắn</h2>

      <button class="imgstart py-2 px-3 mb-2 disabled:bg-gray-500 disabled:hover:shadow-none bg-rose-500 text-white text-sm font-extrabold text-xl rounded-md hover:shadow-lg hover:shadow-rose-500/50 ease-in duration-150  self-center gap-1 uppercase">
        Quay Thưởng
      </button>
      <?php if (isset($_SESSION['id'])): ?>
        <h6 class="text-slate-800 mb-2 font-extrabold uppercase text-md">Lượt quay của bạn: <strong id="luotquay" class="text-rose-500"><?= number_format($info['coin']) ?> lượt</strong> </h6> 
      <?php endif ?>
      <ul class="grid-cols-2 md:grid-cols-3 lg:grid-cols-4 grid gap-6">

        <?php
        foreach ($listVongQuay as $key => $value): ?>


          <li class="drop-shadow-md border-4 bg-white rounded-lg py-5 px-5">
            <div class="item flex justify-center items-center flex-col">
              <img src="<?= $value['icon'] ?>" class="w-full md:w-60" />
              <h2 class="text-sm md:text-lg uppercase text-gray-500 font-bold"><?= $value['ten_vat_pham'] ?></h2>
            </div>

          </li>
        <?php endforeach ?>

      </ul>

    </div>


  </div>
</div>

<!-- End banner -->

<!-- End banner -->
<script>
  $(document).ready(function() {
     getRandom()
    setInterval( function(){
      getRandom();
    },5000);

    function getRandom(){
      $.ajax({
        url: '/ajax/random.php',
        type: 'POST',
      })
      .done(function(res) {
       let obj = JSON.parse(res);
       if(obj.status == 9){
        $('#thongbao-nguoichoi').html(obj.smg);
      }
    });
    }
    
  });
</script>