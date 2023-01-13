<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Quản Lý Luồng Tiền</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="./user">Quản Lý Luồng Tiền</a>
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
         <!-- List image -->
         <div class="col-sm-12">
          <div class="card">
            <div class="card-header border-bottom">
              <h4 class="card-title">Quản Lý Luồng Tiền</h4>
            </div>
            <div class="card-body ">
              <table id="thongke-table" class="table" style="width: 100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Mã giao dịch</th>
                    <th>Người dùng</th>
                    <th>Serial</th>
                    <th>Mã thẻ</th>
                    <th>Mệnh gía</th>
                    <th>Loại</th>
                    <th>Nội dung</th>
                    <th>Trạng thái</th>
                    <th>Thời gian</th>
                  </tr>
                </thead>
                <tbody>

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
<script>
  $(document).ready(function() {
    $('#thongke-table').DataTable({
      responsive: true,
      processing: true,
      "language": {
        "emptyTable": "Không thể tải dữ liệu từ hệ thống"
      },
      // serverSide: true,
      ajax: `/Admin/admin_data/load-luongtien.php`,
      columns: [
      {data: 'id'},
      {data: 'idtrans'},
      { data: 'username'},
      { data: 'serial'},
      { data:'pin'},
      { data:'price'},
      { data: 'type'},
      { data: 'noidung'},
      { data: 'stt'},
      { data: 'date'}
      ],
      order: [[0, 'desc']],
    });
  });
</script>