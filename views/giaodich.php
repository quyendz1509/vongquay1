<div class="container-fluid">
    <div class="row second-chart-list third-news-update">
        <!--  -->
        <div class="see-my-info-wrap pt-50">
            <div class="row">
            </div>
            <div class="w-100">
                <table class="table" id="lichsu-giaodich">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Loại tài khoản</th>
                          <th>Tài khoản</th>
                          <th>Mật khẩu</th>
                          <th>Giá tiền</th>
                          <th>Thời gian</th>
 <th>Thông tin thêm</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php foreach ($lichsu as $key => $value): 
                        $info_cate = $class->infoCategogries($value['cate_id']);
                        $info_hack_cate = $class->oneInfoHack($value['cate_id']);
                        ?>
                        <tr style="vertical-align: middle;">
                         <td><?= $value['id'] ?></td>
                         <?php if ($value['type'] == 0): ?>
                             <td><span class="badge text-light" style="background: #971e31;"><?=  $info_cate['name'] ?></span></td>
                         <?php endif ?>
                         <?php if ($value['type'] == 1): ?>
                             <td><span class="badge text-light" style="background: #971e31;"><?=  $info_hack_cate['name'] ?></span></td>
                         <?php endif ?>
                         <td><?=  $value['taikhoan'] ?></td>
                         <td><?=  $value['matkhau'] ?></td>
                         <td><?=  number_format($value['price']) ?> vnđ</td>
                         
                         <td><?= $value['buy_at'] ?> </td>
                         <td><textarea class="form-control" id="" rows="3" readonly><?=  $value['info'] ?></textarea></td>

                     </tr>
                 <?php endforeach ?>
             </tbody>
         </table>
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
} );
</script>