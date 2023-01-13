<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper container-xxl p-0">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-12">
						<h2 class="content-header-title float-start mb-0"><?=  $title ?></h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="../home">Trang chủ</a>
								</li>
								<li class="breadcrumb-item"><a href="../payment">Quản lý ngân hàng</a>
								</li>
								<li class="breadcrumb-item"><a href="<?= $_SERVER['REQUEST_URI'] ?>"><?=  $title ?></a>
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
							<div class="card-header">
								<h4 class="card-title"><?=  $title ?></h4>
							</div>
							<div class="card-body">
								
								<?php if ($hisList['status'] == 0):
									if (isset($_SESSION['time_wait'])) {
										if( time() > $_SESSION['time_wait']){ ?>
											<button class="btn btn-sm btn-primary text-uppercase active-vdt" data-action='<?= $active_stt ?>'  data-id='<?= $hisList['id'] ?>'><?= $active_noidung ?></button>

										<?php }else{ ?>
											<div id="form-otp" class="mb-1">
												<input type="number" class="form-control" placeholder="Nhập mã OTP">
												<small>Bạn chỉ có <strong>1 phút</strong> để nhập OTP. Nếu quá 1 phút vui lòng tải lại trang.</small>
											</div>
											<button class="btn btn-sms btn-success login-otp-acc btn-sm" data-action='3'  data-id='<?= $hisList['id'] ?>'>Đăng nhập ngay</button>
										<?php } 
									}else{ ?>
										<button class="btn btn-sm btn-primary text-uppercase active-vdt" data-action='<?= $active_stt ?>'  data-id='<?= $hisList['id'] ?>'><?= $active_noidung ?></button>

									<?php } ?>

									
								<?php endif ?>
								<?php if ($hisList['status'] == 1): ?>
									<p>Ví điện tử: <strong class="text-success"> <?= $hisList['username'] ?> </strong> đã được kích hoạt. Vui lòng <a href="../payment">Quay trở lại trang quản lý.</a></p>
								<?php endif ?>
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
		$('.active-vdt').click(function(event) {
			/* Act on the event */
			let id = $(this).data('id');
			let action = $(this).data('action');
			let action_btn = (action == 0) ? 'btn-danger' : 'btn-primary';
			let action_na = (action == 0) ? 'TẮT KÍCH HOẠT' : 'KÍCH HOẠT VÍ';

			$.ajax({
				url: '/Admin/admin_loadform/active_unactive.php',
				type: 'POST',
				data: {id: id, action:action},
				beforeSend: function(){
					$('.active-vdt').html(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
						<span>Đang xử lý...</span>`).attr('disabled', 'true').removeClass(action_btn).addClass('btn-secondary');
				}
			})
			.done(function(result) {
				obj = JSON.parse(result);
				if(obj.status == 0){
					toastr.error(obj.messages,'Thông báo !!');
				}else{
					toastr.success(obj.messages, 'Thành công', {
						timeOut: 1000,
						onHidden: function() {
							location.reload();
						}
					});
				}
			})
			.fail(function() {
				toastr.error('Không thể kết nối tới hệ thống.','Thông báo !!',{
					"closeButton": true,
				});
			})
			.always(function() {
				setTimeout( function(){
					$('.active-vdt').html(`${action_na}`).removeAttr('disabled').addClass(action_btn).removeClass('btn-secondary');
				},100)
			});
			
		});

		// xử lý nhập otp 
		$('.login-otp-acc').on('click', function(event) {
			/* Act on the event */
			event.preventDefault();
			let otp = $('#form-otp').find('input').val();
			let action = $(this).data('action');
			let id = $(this).data('id');

			if (otp == '') {
				toastr.error('không được bỏ trống thông tin','Thông báo !!');
			}else{
				$.ajax({
					url: '/Admin/admin_loadform/active_unactive.php',
					type: 'POST',
					data: {id: id, action:action,otp:otp},
					beforeSend: function(){
						$('.login-otp-acc').html(`<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
							<span>Đang xử lý...</span>`).attr('disabled', 'true').removeClass('btn-success').addClass('btn-secondary');
						$('#form-otp').find('input').attr('disabled', 'true');
					}
				})
				.done(function(result) {
					obj = JSON.parse(result);
					if(obj.status == 0){
						toastr.error(obj.messages,'Thông báo !!');
					}else{
						$('.login-otp-acc').addClass('hidden');
						$('#form-otp').html(`<p class="m-0 p-0"><strong class="text-success">${obj.messages}</strong></p>`);

					}			
				})
				.fail(function() {
					toastr.error('Không thể kết nối tới hệ thống.','Thông báo !!',{
						"closeButton": true,
					});
				})
				.always(function() {
					$('.login-otp-acc').html(`Đăng nhập ngay`).removeAttr('disabled').removeClass('btn-secondary').addClass('btn-success');
					$('#form-otp').find('input').removeAttr('disabled');
				});
				
			}
		});
	});
</script>

