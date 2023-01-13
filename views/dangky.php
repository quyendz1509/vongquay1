
<div class=" w-full lg:h-screen flex justify-center items-center sm:z-20 relative px-5 py-5">
	<div class="transform rounded-lg bg-white relative w-full md:w-6/12">
		<div class="grid 2xl:grid-cols-2 grid-cols-1 rounded-lg shadow-lg overflow-hidden">
			<div class="bg-center  bg-contain hidden 2xl:block  bg-no-repeat h-full relative" style="background-image: url(<?= $images_array[$rand] ?>);">
			</div>
			<div class=" flex items-center justify-center flex flex-col  px-5 py-5">
				<a href="./"><img src="/public/logo.svg" class="w-12 mb-5"></a>
				<div>
					<h3 class="text-uppercase font-bold text-lg uppercase"><?= $title ?></h3>
				</div>
				<!-- firt item -->
				<form id="register" action="" class="flex-col flex w-full lg:w-10/12">
					<!--  -->
					<div class="relative w-full my-3">
						<label for="fullname" class=" text-slate-500 font-bold">Họ và tên</label>

						<input type="text" name="fullname" placeholder="* Họ và tên"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" autocomplete="true">
						<label for="fullname" class="error text-sm text-rose-500"></label>
					</div>
					<!--  -->
					<!--  -->
					<div class="relative w-full my-3">
						<label for="username" class=" text-slate-500 font-bold">Tài khoản</label>

						<input type="text" name="username" placeholder="* Tài khoản"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" autocomplete="true">
						<label for="username" class="error text-sm text-rose-500"></label>
					</div>
					<!--  -->
					<div class="relative w-full my-3">
						<label for="password" class=" text-slate-500 font-bold">Mật khẩu</label>
						

							<input type="password" id="password" name="password" placeholder="* Mật khẩu"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5">
							<label for="password" class="error text-sm text-rose-500"></label>
						
					</div>
					<div class="relative w-full my-3">
						<label for="username" class=" text-slate-500 font-bold">Xác nhận mật khẩu</label>

						
							<input type="password" name="repassword" placeholder="* Xác nhận mật khẩu"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5">
							<label for="repassword" class="error text-sm text-rose-500"></label>
						
						
					</div>
				
				

				
					<div class="relative w-full">
						<p class="bg-slate-100 text-rose-500 rounded-lg text-center font-semibold text-sm" id="alert-error">
							
						</p>
					</div>
					<div class="relative w-full my-3">
						<button id="btn-send-auth" class="flex w-full justify-center items-center group py-2 px-3 bg-emerald-500 text-white text-sm font-semibold rounded-md hover:shadow-lg disabled:hover:shadow-none disabled:bg-slate-800 hover:shadow-emerald-500/50 ease-in duration-150 flex self-center gap-1">Đăng ký <svg class="w-0 group-hover:w-4 ease-in duration-150 group-hover:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
						</svg></button>
					</div>
				</form>
				
					<div class="relative w-full mb-3 text-center">
						<p class="text-sm font-semibold">Đã có tài khoản ? <a class="text-sky-500 hover:text-sky-400" href="./dangnhap.html">Đăng nhập ngay.</a></p>
					</div>
		
				

			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		// check phone
		$.validator.addMethod("phoneVN", function (value, element) {
			return this.optional(element) || /^(0|84)[0-9]/.test(value);
		}, "Số điện thoại phải là chữ số và có đầu số là 0 hoặc 84");
		// fullname
		$.validator.addMethod("fullname", function (value, element) {
			return this.optional(element) || /^[a-zA-Z-' ]*$/g.test(value);
		}, "Vui lòng nhập họ tên không dấu.");
		// check form valid
		$('#register').validate({
			rules:{
				fullname: {
					required: true,
					minlength: 3,
					maxlength: 24,
					fullname: true
				},
				username: {
					required: true,
					minlength: 6,
					maxlength: 24
				},
				password:  {
					required: true,
					minlength: 6,
					maxlength: 24
				},
				repassword:{
					required: true,
					minlength: 6,
					maxlength: 24,
					equalTo: '#password'
				}

			},
			messages:{
				fullname:{
					required: 'Không bỏ trống thông tin.',
					minlength: 'Tối thiểu 3 ký tự.',
					maxlength: 'Tối đa 24 ký tự.'
				},
				username:{
					required: 'Không bỏ trống thông tin.',
					minlength: 'Tối thiểu 6 ký tự.',
					maxlength: 'Tối đa 24 ký tự.'
				},
				password:{
					required: 'Không bỏ trống thông tin.',
					minlength: 'Tối thiểu 6 ký tự.',
					maxlength: 'Tối đa 24 ký tự.'
				},
				repassword:{
					required: 'Không bỏ trống thông tin.',
					minlength: 'Tối thiểu 6 ký tự.',
					maxlength: 'Tối đa 24 ký tự.',
					equalTo: 'Mật khẩu không trùng khớp.'
				}
			}
		})
	});

	$('#register').submit(function(event) {
				/* Act on the event */
		event.preventDefault();
		// check valid before submit
		if($(this).valid() == true){
			let fullname = $(this).find('input[name="fullname"]').val();
			let username = $(this).find('input[name="username"]').val();
			let password = $(this).find('input[name="password"]').val();
			

			$.ajax({
				url: '/handle/auth.php',
				type: 'POST',
				method: 'POST',
				data: {fullname:fullname, username: username, password: password,key: 0},
				beforeSend: ()=>{
					$('#btn-send-auth').html('Loading...').attr('disabled', '');
					$('input').attr('disabled','true');

				}
			})
			.done(function(result) {

				let obj = JSON.parse(result);
				if(obj.status == 99){

					$('#alert-error').html(obj.messages).removeClass('text-rose-500').addClass('text-emerald-500');
					setTimeout( function(){
						location.reload();

					},1200 )
				}else{
					$('#alert-error').html(obj.messages);
					$('#btn-send-auth').html('Đăng nhập ngay').removeAttr('disabled');
					$('input').removeAttr('disabled');
				}
			})
			.fail(function() {
				alert('Lỗi kết nối đến hệ thống!');
			});

		}
	});
</script>