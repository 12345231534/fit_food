<!-- pages-title-start -->
<div class="container-fluid"  style="background: #eeeeee">
	<div class="row container mx-auto">
		<div class="col-xs-12 py-2">
			<div class="pages-title-text text-center">
				<ul class="text-left">
					<li><a href="home " style="font-size: 15px;">Trang chủ</a></li>
					<li style="font-size: 15px;">
						<span class="mx-2"> / </span>
						<a href="account/login" style="font-size: 15px;">
						Tài khoản </a>
					</li>
					<li style="font-size: 15px; opacity: 0.6"><span class="mx-2"> / </span>Đăng nhập</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>
<section class="container-fluid section-padding" style="background-color: #f8f8f8">
		<div class="container">	
			<div class="row  mx-5" style="background-color:#fff; border-radius: 15px">
				<div class=" mt-4 text-left" style="margin-left: 20px">
					<h3>Đăng nhập tài khoản</h3>
					<div class="" style="font-size: 15px;">
						<span class="mr-3">Bạn chưa có tài khoản? Đăng ký </span>
						
						<a class="text-underline" href="account/register"><u>tại đây</u></a>
					</div>
				</div>
				<div class="col-sm-8 mx-auto px-5"  >
					<div class="main-input py-5 new-customer" id="dangnhap">
						
						<?php if (isset($_COOKIE['noti-type'])) { ?>
							<?php if ($_COOKIE['noti-type']=='success') { ?>
								<div class="alert alert-success">
									<?= $_COOKIE['noti-message'] ?>
								</div>
							<?php } ?>
							<?php if ($_COOKIE['noti-type']=='error') { ?>
								<div class="alert alert-danger">
									<?= $_COOKIE['noti-message'] ?>
								</div>
							<?php } ?>
						<?php } ?>
						<form action="account/login" method="post">
							<div class="mb-3">
								<label for="exampleInputEmail1" class="form-label">Tài khoản</label>
								<span class="text-danger">*</span>
								<input type="text" class="form-control" name="username"  placeholder="Tài khoản...">
							</div>
							<div class="mb-2">
								<label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
								<span class="text-danger">*</span>
								<input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="******">
							</div>
							<div class="mb-3">
								<p class="" href="#">Quên mật khẩu? Nhấn vào <a class="text-underline" href="account/forgot-password"><u>đây</u></a>
								</p>
							</div>
							<button type="submit" class="w-100 mt-3 btn btn-primary">Đăng nhập</button>
						</form>
					</div>
				</div>
			
			</div>
		</div>
	</section>
