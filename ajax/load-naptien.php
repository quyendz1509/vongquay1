     <div class="shadow-sm mt-3 mb-3 card-noidung">
         <div>
            <span class="text-uppercase">Quét Mã QR</span>
        </div>
        <div>
            <img class="border" src="https://img.vietqr.io/image/tpbank-quyendev-qr_only.jpg?amount=10000%5C&addInfo=quyendev&accountName=Di%E1%BB%87p%20Qu%E1%BB%91c%20quy%E1%BB%81n" width="100%" alt="" style="max-width: 250px;">
        </div>
        <div class="mt-1">
            <span>Hoặc chuyển khoản với thông tin bên dưới</span>

        </div>
        <div class="border d-block rounded mt-1" style="padding: 12px 24px; background: #7366fe12;">

            <ul>
             <li>
              Số tài khoản: <br> <strong class="text-primary text-uppercase"><?= ($value['stk'] != '') ?$value['stk'] : 'NULL' ?> </strong>
          </li>
          <li>
              Người nhận: <br>
              <strong class="text-primary text-uppercase"><?= ($value['chuthe'] != '') ?$value['chuthe'] : 'NULL' ?> </strong>
          </li>
          <li>
           Số tiền: <br>
           <strong class="text-primary text-light rounded bg-success" style="padding: 3px 12px;"><?= number_format(100000) ?> đ </strong>
       </li>
       <li>
        Nội dung: <br>
        <strong class="text-primary text-light rounded bg-info text-uppercase" style="padding: 0.375rem 1.75rem;"><?= $value['key_bank'] ?> <?= $reset->generateRandomString(8) ?> </strong>
        <button class="btn btn-sm btn-info">Coppy</button>

    </li>
    <li>
        <span><strong class="text-danger">Lưu ý:</strong> Nội dung sẽ là<br> <strong class="bg-danger text-uppercase" style="padding: 0px 6px;"><?= $value['key_bank'] ?>+(dấu cách)+nội dung ck</strong><br> Nếu sợ sai có thể bấm nút <strong class="text-primary">"COPPY"</strong> bên cạnh để coppy nội dung.
            <br>
            <strong class="text-success">"Quét mã QR"</strong> độ chính xác sẽ cao hơn - nhanh hơn. <br><a href="">Xem hướng dẫn tại đây</a>
        </span>
    </li>
</ul>
</div>
</div>