<div class="w-full my-5 lg:h-screen  flex justify-center items-center relative px-5 py-5 lg:my-0 sm:z-20" >
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
				<form id="login" action="" class="flex-col flex w-full lg:w-10/12">
					<div class="relative w-full my-3">
						<label for="username" class=" text-slate-500 font-bold">Tài khoản</label>
						<input type="text" name="username" placeholder="Tên đăng nhập..."  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5" autocomplete="true">
						<label for="username" class="error text-sm text-rose-500"></label>
					</div>
					<div class="relative w-full my-3">
						<label for="password" class=" text-slate-500 font-bold">Mật khẩu</label>

						<input type="password" name="password" placeholder="Mật khẩu..."  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-2.5">
						<label for="password" class="error text-sm text-rose-500"></label>
					</div>
					<div class="relative w-full">
						<p class="bg-slate-100 text-rose-500 rounded-lg text-center font-semibold text-sm" id="alert-error">
							
						</p>
					</div>
					<div class="relative  flex gap-3 w-full my-3">
						<a href="/" class="flex w-full justify-center items-center group py-2 px-3 bg-gray-500 text-white text-sm font-semibold rounded-md hover:shadow-lg hover:shadow-gray-500/50 ease-in duration-150  flex self-center uppercase">
							Trở lại
						</a>
						<button id="btn-send-auth" class="flex w-full justify-center items-center group py-2 px-3 bg-sky-500 text-white text-sm font-semibold rounded-md hover:shadow-lg disabled:hover:shadow-none disabled:bg-slate-800 hover:shadow-sky-500/50 ease-in duration-150  flex self-center gap-1 uppercase">Tiếp tục <svg class="w-0 group-hover:w-4 ease-in duration-150 group-hover:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"></path>
						</svg></button>
					</div>
					<div class="relative text-center">
						<p class="text-sm font-semibold">Chưa có tài khoản ? <a class="text-green-500 hover:text-green-400" href="./dangky.html">Đăng ký ngay.</a></p>
					</div>
				</form>

				
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		// check phone
		// check form valid
		$('#login').validate({
			rules:{
				username: {
					required: true,
					minlength: 6,
					maxlength: 24
				},
				password:  {
					required: true,
					minlength: 6,
					maxlength: 24
				}

			},
			messages:{
				username:{
					required: 'Không bỏ trống thông tin.',
					minlength: 'Tối thiểu 6 ký tự.',
					maxlength: 'Tối đa 24 ký tự.'
				},
				password:{
					required: 'Không bỏ trống thông tin.',
					minlength: 'Tối thiểu 6 ký tự.',
					maxlength: 'Tối đa 24 ký tự.'
				}
			}
		})
	});

	$('#login').submit(function(event) {
		/* Act on the event */
		event.preventDefault();
		// check valid before submit
		if($(this).valid() == true){
			let username = $(this).find('input[name="username"]').val();
			let password = $(this).find('input[name="password"]').val();
			$.ajax({
				url: '/handle/auth.php',
				type: 'POST',
				method: 'POST',
				data: {password:password, username: username,key: 1},
				beforeSend: ()=>{
					$('#btn-send-auth').html('Loading...').attr('disabled', '');
					$('input').attr('disabled', 'true');
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
					$('#btn-send-auth').html('Đăng nhập').removeAttr('disabled');
					$('input').removeAttr('disabled');
				}
			})
			.fail(function() {
				alert('Lỗi kết nối đến hệ thống!');
			});
			
		}
	});
</script>