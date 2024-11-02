<footer class="footer-two">
    <!-- footer-top area start -->
    <div class="footer-top section-padding">
        <div class="footer-dsc">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="single-text">
                            <div class="footer-title">
                                <h4>Về chúng tôi</h4>
                            </div>
                            <div class="footer-text">
                                <p class="my-2">Bếp của Mẹ - Sạch ngon từ tấm lòng và sự tận tâm của mẹ.</p>
                                <ul>
                                    <li class="mb-2">
                                        <i class="mdi mdi-map-marker"></i>
                                        <p>Địa chỉ: Số 6, ngõ 171 Nguyễn Ngọc Vũ, Hà Nội</p>
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-phone"></i>
                                        <p>Số điện thoại: 0785466688</p>
                                    </li>
                                    <li class="mb-2">
                                        <i class="mdi mdi-email"></i>
                                        <p>Email: fit_food@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 wide-mobile">
                        <div class="single-text">
                            <div class="footer-title">
                                <h4>Tài khoản</h4>
                            </div>
                            <div class="footer-menu">
                                <ul>
                                    <li><a class="footer-menu__link" href="account"><i class="mdi mdi-menu-right"></i>Tài khoản</a></li>
                                    <li><a class="footer-menu__link" href="cart"><i class="mdi mdi-menu-right"></i>Giỏ Hàng</a></li>
                                    <li><a class="footer-menu__link" href="account/login"><i class="mdi mdi-menu-right"></i>Đăng Nhập</a></li>
                                    <li><a class="footer-menu__link" href="checkout"><i class="mdi mdi-menu-right"></i>Thanh Toán</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3 wide-mobile">
                        <div class="single-text">
                            <div class="footer-title">
                                <h4>Danh mục</h4>
                            </div>
                            <div class="footer-menu">
                                <ul>
                                    <?php foreach ($categories as $row) { ?>
                                    <li><a class="footer-menu__link" href="?act=shop&sp=<?=$row['slug']?>"><i class="mdi mdi-menu-right"></i><?=$row['name']?></a></li>
                                    <?php  } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 r-margin-top wide-mobile">
                        <div class="single-text">
                            <div class="footer-title">
                                <h4>Mạng xã hội</h4>
                            </div>
                            <div class="clearfix instagram">
                                <ul>
                                    <li><a href="#"><img src="public/img/footer/in1.png" alt="Instagram" /></a></li>
                                    <li><a href="#"><img src="public/img/footer/in2.png" alt="Instagram" /></a></li>
                                    <li><a href="#"><img src="public/img/footer/in3.png" alt="Instagram" /></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-top area end -->
    <!-- footer-bottom area start -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <p>&copy; DTPPhone 2020. All Rights Reserved.</p>
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                    <a href="https://www.nganluong.vn/vn/home.html" target="_blank"><img src="public/img/footer/payment.png" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom area end -->
</footer>