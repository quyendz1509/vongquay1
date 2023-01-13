

<footer class="p-4 bg-white shadow md:flex md:items-center  md:justify-between md:p-6 bg-white text-gray-400 border-t-2">
  <div class="container mx-auto flex justify-center">
    <span class="text-sm font-semibold  sm:text-center dark:text-gray-400">© 2022 <a href="./" class="hover:underline uppercase"><?= $setting['web_name'] ?>™</a>. All Rights Reserved.
    </span>

  </div>
</footer>

<!-- Thông báo trúng thưởng -->

<!-- Thông báo -->
<div id="thongbao" class="fixed invisible  align-middle flex items-center bg-gray-900 bg-opacity-50 dark:bg-opacity-80 inset-0 z-40">
  <div class="container mx-auto">
    <div class="flex justify-center items-center px-5">
      <div class="bg-white rounded-lg shadow-xl w-full md:w-8/12">
        <!-- Modal Content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white close-modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="p-6 text-center flex justify-center flex-col">
            
            <div class="mx-auto mb-4 text-gray-400 text-5xl modal-title">🔥</div>
            <h3 class="mb-5 text-lg font-bold text-slate-500 modal-content"></h3>
            <button data-modal-hide="popup-modal" type="button" class="text-white bg-slate-600 hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 w-3/12 dark:focus:ring-slate-800 font-medium rounded-lg close-modal text-sm self-center px-5 py-2.5 text-center mr-2">
             Đóng
            </button>
          </div>
        </div>
        <!-- End content -->
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/flowbite.min.js"></script>
<!--  -->


</body>
</html>