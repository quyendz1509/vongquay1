<div class="container-fluid">
    <div class="row">
        <!--  -->
        <div class="see-my-info-wrap mb-20 col-sm-12">
          <div class="card">
              <div class="card-body">
                <h3>Lịch sử nạp thẻ cào</h3>
                <div class="w-100">
                    <table class="table w-100" id="lichsu-giaodich">
                        <thead>
                          <tr>
                              <th>ID</th>
                              <th>Mã giao dịch</th>
                              <th>Serial</th>
                              <th>Mã thẻ</th>
                              <th>Mệnh giá</th>
                              <th>Loại thẻ</th>
                              <th>Nội dung</th>
                              <th>Trạng thái</th>
                              <th>Thời gian</th>

                          </tr>
                      </thead>
                      <tbody>
                          <?php foreach ($lichsu as $key => $value): 
                             switch ($value['type']) {
                                 case 'banks':
                                 $type = 'Ngân hàng';
                                 break;
                                 case 'admin':
                                 $type = 'Trực tiếp';
                                 break;
                                 case 'momo':
                                 $type = 'MoMo';
                                 break;
                                 default:
                                 $type = $value['type'];

                                 break;
                             }
                             ?>
                             <tr style="vertical-align: middle;">
                               <td><?= $value['id'] ?></td>

                               <td class="text-uppercase"><?= $value['trans_id'] ?></td>
                               <td><?=  $value['serial'] ?></td>
                               <td><?=  $value['pin'] ?></td>
                               <td><?=  number_format($value['money']) ?> vnđ</td>
                               <td class="text-uppercase"><?=  $type?></td>

                               <td><textarea class="form-control" id="" cols="30" rows="2" readonly><?=  $value['messages'] ?></textarea></td>
                               <td>
                                <?php if ($value['status'] == 0):?>
                                   <span class="badge bg-danger">Đang xử lý...</span>
                               <?php endif ?>
                               <?php if ($value['status'] == 1):?>
                                   <span class="badge bg-success">Thành công</span>
                               <?php endif ?>
                               <?php if ($value['status'] == 2):?>
                                <span class="badge bg-primary">Bị hủy bởi hệ thống</span>
                            <?php endif ?>
                        </td>
                        <td><?= $value['time_stamp'] ?> </td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<!--  -->
<!--  -->
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
            <h3>Lịch sử tự động ngân hàng - Ví điện tử</h3>
            <div class="w-100">
                <table class="table w-100" id="lichsu-bank">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Ngân hàng</th>
                          <th>Mã giao dịch</th>
                          <th>Giá tiền</th>
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
</div>
<!--  -->
</div>
</div>
</div>
<script>
 $(document).ready( function () {
    $('#lichsu-giaodich').DataTable({
        responsive: true,
        order: ['0', 'desc']
    });
    $('#lichsu-bank').DataTable({
      responsive: true,
      processing: true,
      "language": {
        "emptyTable": "Không thể tải dữ liệu từ hệ thống"
    },
      // serverSide: true,
      ajax: `/ajax/load-autoHis.php`,
      columns: [
      {data: 'id'},
      {data: 'banks'},
      {data: 'idtrans'},
      { data:'price'},
      { data: 'stt'},
      { data: 'date'}
      ],
      order: [[0, 'desc']],
  });
} );
</script>