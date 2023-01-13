
<body>


  <!-- tap on tap ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper">
  <div class="backdrop-blur  z-10 bg-white/60 sticky py-2 px-2 top-0 w-full">
    <div class="container mx-auto">
      <!-- navbar -->

      <nav>
        <div class="container flex flex-wrap items-center justify-between mx-auto">
          <a href="/" class="flex items-center">
            <img src="/public/logo.svg" class="w-7 mr-2 sm:h-10" alt="Game Logo" />
          </a>

          <!-- div chứa phần đuôi -->
          <div class="flex items-center md:flex-row-reverse">
            <?php if (!isset($_SESSION['id'])): ?>
              <a href="/dangnhap.html" class="py-2 px-3 bg-sky-500 text-white text-sm font-semibold rounded-md hover:shadow-lg hover:shadow-sky-500/50 ease-in duration-150 flex self-center gap-1 capitalize">Đăng nhập <svg class="w-4 hidden md:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
              </svg>
            </a>
          <?php endif ?>

          <?php if (isset($_SESSION['id'])): ?>
            <!-- Này là đã login nè -->

              <button id="dropdownAvatarNameButton" data-dropdown-placement="bottom" data-dropdown-toggle="dropdownAvatarName" class="flex items-center text-sm font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:mr-0" type="button">
                <span class="sr-only">Open user menu</span>
                <img class="mr-2 w-8 h-8 rounded-full" src="https://avatars.dicebear.com/api/initials/<?= $info['fullname'] ?>.svg" alt="user photo">
               <?= $info['fullname'] ?>
                <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button>

              <!-- Dropdown menu -->
              <div id="dropdownAvatarName" class="hidden z-10 w-100 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <div class="py-3 px-4">
                   <span class="font-medium px-2 bg-rose-500 rounded-full text-center   text-white <?= ( $info['rules'] == 1 ) ? " bg-indigo-50 text-indigo-500" : " bg-emerald-50 text-emerald-500" ?>"><?= ( $info['rules'] == 1 ) ? "Admin" : "User" ?></span>
                </div>
                <div class="py-3 text-sm flex flex-col gap-3 text-gray-900 dark:text-white">
                 
                  <?php if ($info['rules'] == 1): ?>
                      <a href="./Admin" class="log-out block py-2 px-4 text-sm  hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Admin</a>
                  <?php endif ?>
                  <p class="truncate px-3">Tài khoản: <strong class="text-green-600"><?= $info['username'] ?></strong></p>
                </div>
              
                <div class="py-1">
                  <a href="./logout" class="log-out block py-2 px-4 text-sm  hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Đăng xuất</a>
                </div>
              </div>

            
            <!-- Này là đã login nè -->
          <?php endif ?>


          <!-- chia div -->
        </div>

        <!-- chia div -->
      </div>

    </nav>

    <!-- navbar -->
  </div>
</div>

<!-- banner -->
<div>

</div>
<!-- Page Header Ends -->
<!-- Page Body Start-->
<div class="page-body-wrapper">
 <!-- Page Sidebar Start-->

 <!-- Page Sidebar Ends-->
 <div class="page-body">