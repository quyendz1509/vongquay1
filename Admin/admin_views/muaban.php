<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Lịch sử mua bán</h2>
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./home">Trang chủ</a>
                </li>
                <li class="breadcrumb-item"><a href="./mua-ban">Lịch sử mua bán</a>
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
              <h4 class="card-title">Lịch sử mua bán của người dùng</h4>
            </div>
            <div class="card-body ">
              <table id="manager-muaban" class="display dtr-inline" style="width: 100%;">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Người dùng</th>
                    <th>Giá tiền</th>
                    <th>Ngày mua</th>
                    <th>Loại</th>
                    <th>Thông tin</th>


                  </tr>
                </thead>
                <tbody>
                  <td>id</td>
                  <td>Danh mục</td>
                  <td>Người dùng</td>
                  <td>Giá tiền</td>
                  <td>Ngày mua</td>
                  <td>Loại</td>
                  <td>Thông tin</td>
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

    $('#manager-muaban').DataTable({
      responsive: true,
      processing: true,
      "language": {
        "emptyTable": "Không thể tải dữ liệu từ hệ thống"
      },
      // serverSide: true,
      ajax: `/Admin/admin_data/load-lichsu-muaban.php`,
      columns: [
      {data: 'id'},
      { data: 'danhmuc'},
      { data: 'username'},
      { data:'price'},
      { data: 'buyat'},
      { data: 'type'},
      { data: 'thongtin'},

      ],
      order: [[0, 'desc']],
    });

  });
</script>