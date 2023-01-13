
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
						<input type="text" name="fullname" placeholder="* Họ và tên"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" autocomplete="true">
						<label for="fullname" class="error text-sm text-rose-500"></label>
					</div>
					<!--  -->
					<!--  -->
					<div class="relative w-full my-3">
						<input type="text" name="username" placeholder="* Tài khoản"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5" autocomplete="true">
						<label for="username" class="error text-sm text-rose-500"></label>
					</div>
					<!--  -->
					<div class="relative w-full my-3">
						<div class="flex grid grid-cols-2 gap-2">
							<div>
								<input type="password" id="password" name="password" placeholder="* Mật khẩu"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5">
								<label for="password" class="error text-sm text-rose-500"></label>
							</div>
							<div>
								<input type="password" name="password" placeholder="* Xác nhận mật khẩu"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5">
								<label for="password" class="error text-sm text-rose-500"></label>
							</div>
						</div>
					</div>
					<!--  -->
					<div class="relative w-full my-3">
						<input type="email" name="email" placeholder="* Địa chỉ email"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5">
						<label for="email" class="error text-sm text-rose-500"></label>
					</div>
					<!--  -->
					<div class="relative w-full my-3">
						<input type="number" name="phone" placeholder="Điện thoại"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5">
						<label for="phone" class="error text-sm text-rose-500"></label>
					</div>

					<div class="relative w-full my-3">

						<div class="g-recaptcha w-full" data-sitekey="6LcT32MdAAAAAIjN__avjyDVQiBso1aCb-9jTEls"></div>

					</div>
					<div class="flex justify-between mb-3">
						<div class="flex items-center">
							<input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-emerald-600 bg-gray-100 rounded focus:ring-0 ">
							<label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-900 text-gray-400">Chấp nhận <a href="" class="text-emerald-600">điều khoản sử dụng</a>.</label>
						</div>

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
				<div class="flex flex-col w-full lg:w-10/12">
					<div class="relative w-full mb-3">
						<p class="text-sm font-semibold">Đã có tài khoản ? <a class="text-sky-500 hover:text-sky-400" href="./dangnhap.html">Đăng nhập ngay.</a></p>
					</div>
					<hr class="custom-divider my-3">
					<div class="flex justify-center mt-3 gap-2">
						<button class="border rounded-md px-5 py-1 flex self-center gap-1 items-center justify-center hover:bg-slate-100">
							<img src="./public/resource/facebook.svg" class="w-5" alt=""> Facebook
						</button>
						<button class="border rounded-md px-5 py-1 flex self-center gap-1 items-center justify-center hover:bg-slate-100">
							<img src="./public/resource/google.svg" class="w-4" alt=""> Google
						</button>
					</div>
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
				},
				email: {
					required: true,
					email: true
				},
				phone: {
					phoneVN: true,
					maxlength: 11,
					number: true
				},
				captcha: {
					required: true,
					maxlength: 4,
					minlength: 4,
					number: true
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
				},
				email:{
					required: 'Không bỏ trống thông tin.',
					email: 'Email không đúng định dạng.'
				},
				phone: {
					phoneVN: 'Số điện thoại phải có đầu số là 0 hoặc 84.',
					maxlength: 'Số điện thoại phải là 11 ký tự.',
					number: 'Số điện thoại phải là chữ số'
				},
				captcha: {
					required: 'Vui lòng nhập mã xác thực.',
					maxlength: 'Mã xác thực không chính xác',
					minlength: 'Mã xác thực không chính xác',
					number: 'Mã xác  thực không chính xác',
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
			let email = $(this).find('input[name="email"]').val();
			let phone = $(this).find('input[name="phone"]').val();
			let captcha = grecaptcha.getResponse();

			$.ajax({
				url: '/handle/auth.php',
				type: 'POST',
				method: 'POST',
				data: {fullname:fullname, username: username, password: password, email: email, phone: phone,  'g-recaptcha-response': captcha,key: 0},
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