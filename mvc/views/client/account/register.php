<div class="container-fluid"  style="background: #eeeeee">
	<div class="row container mx-auto">
		<div class="col-xs-12 py-2">
			<div class="pages-title-text text-center">
				<ul class="text-left">
					<li><a href="home " style="font-size: 15px;">Trang chủ</a></li>
					<li style="font-size: 15px;">
						<span class="mx-2"> / </span>
						<a href="account/register" style="font-size: 15px;">
						Tài khoản </a>
					</li>
					<li style="font-size: 15px; opacity: 0.6"><span class="mx-2"> / </span>Đăng ký</li>
				</ul>
			</div>
		</div>
	</div>
	
</div>
<section class=" section-padding" style="background-color:#f8f8f8;">
	<div class="container" >	
		<div class="row mx-5" style="background-color:#fff; border-radius: 15px">
			<div class=" mt-4 text-left" style="margin-left: 20px">
				<h3>Đăng ký tài khoản</h3>
				<div class="" style="font-size: 15px;">
					<span class="mr-3">Bạn đã có tài khoản? Đăng nhập </span>
					
					<a class="text-underline" href="account/login"><u>tại đây</u></a>
				</div>
			</div>
			<div class="col-sm-8 mx-auto px-5">
				<div class="main-input py-5 new-customer" id="dangky">
					<div class="log-title mb-4 text-center">
						<h5>Thông tin cá nhân</h5>
					</div>
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
					<form action="account/register"  method="post">
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Họ</label>
							<span class="text-danger">*</span>
							<input type="text" name="lastname" class="form-control" placeholder="Họ..."  >
						</div>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Tên</label>
							<span class="text-danger">*</span>
							<input type="text" name="firstname" class="form-control" placeholder="Tên..." >
						</div>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Tài khoản</label>
							<span class="text-danger">*</span>
							<input type="text" class="form-control" name="username"  placeholder="Tài khoản...">
						</div>
						<div class="mb-3">
							<label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
							<span class="text-danger">*</span>
							<input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="******">
						</div>
						<div class="mb-3">
							<label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
							<span class="text-danger">*</span>
							<input type="text" name="phone" class="form-control" placeholder="Số điện thoại của bạn..."  >
						</div>
						<div class="mb-2">
							<label for="exampleInputEmail1" class="form-label">Địa chỉ</label>
							<span class="text-danger">*</span>
							<input type="text" name="address" class="form-control" placeholder="Địa chỉ của bạn..." >
						</div>
					  	<div class="mb-3">
							<label for="disabledSelect" class="form-label">Chọn giới tính</label>
							<span class="text-danger">*</span>
							<select id="disabledSelect" name="gender" class="form-select">
								<option value="male">Nam</option>
								<option value="female">Nữ</option>
								<option value="other">Khác</option>
							</select>
						</div>
						<button type="submit" class="w-100 mt-3 btn btn-warninga">Đăng ký tài khoản</button>
					</form>
				</div>
			</div>
		
		</div>
		<div class="row mx-5" action="account/register">
			<div class="col-sm-8 mx-auto px-5">
				<div class="main-input py-5 new-customer" id="dangky">
					<div class="log-title mb-3 text-center">
						<p style="font-style: bold; font-size: 20px ">Đăng ký nhận tin</p>
					</div>
					<form  method="post" action="account/register-email">
						<div class="mb-2" class="position-relative" style="position: relative;">
							<input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ email..." >
							<button type="submit" class="btn btn-warning position-absolute top-0 bottom-0"  style="z-index: 20; right:0;">Đăng ký</button>

						</div>
					
					</form>
				
				</div>
			</div>
		</div>
	</div>
</section>