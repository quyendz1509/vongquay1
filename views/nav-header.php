
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
                <div class="py-3 px-4 text-sm text-gray-900 dark:text-white">
                  <span class="font-medium bg-rose-500 rounded-full px-4 text-white <?= ( $info['rules'] == 1 ) ? " bg-indigo-50 text-indigo-500" : " bg-emerald-50 text-emerald-500" ?>"><?= ( $info['rules'] == 1 ) ? "Admin" : "User" ?></span>
                  <div class="truncate"><?= $info['email'] ?></div>
                </div>
               <!--  <ul class="py-1 text-sm  dark:text-gray-200" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                  <li>
                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                  </li>
                  <li>
                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                  </li>
                  <li>
                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                  </li>
                </ul> -->
                <div class="py-1">
                  <a href="./logout" class="log-out block py-2 px-4 text-sm  hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Đăng xuất</a>
                </div>
              </div>

            
            <!-- Này là đã login nè -->
          <?php endif ?>
          <div>
            <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="hidden w-full md:block md:w-auto absolute md:relative right-0" id="navbar-dropdown">
              <ul class="flex flex-col p-4 mt-1 md:mt-4 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm text-slate-700 md:font-bold md:border-0 md:bg-transparent md:items-center">
                <li>
                  <a href="#" class="block uppercase py-2 pl-3 pr-4 hover:text-sky-500  rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-sky-500 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent ">Trang chủ</a>
                </li>

           

              </ul>
            </div>
          </div>

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