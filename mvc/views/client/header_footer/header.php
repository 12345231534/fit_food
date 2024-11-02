<header class="header ">
    <div class="header-top main-container container mx-auto text-center ">
        <div class="w-100 row h-100 d-flex align-items-center h-100">
            <div class="  col-lg-2 d-flex justify-content-left  ">
                <a href="home" class="d-block"><img src="public/img/logo.png" alt="Sellshop" /></a>
            </div>
            <div class="col-lg-4  header-search">
                <form action="home" method="post" class="position-relative header-form">
                    <input  class="w-100 h-100 " type="text" placeholder="Tìm kiếm sản phẩm..." name="keyword"/>
                    <button class="search-button" type="submit"><i class="mdi mdi-magnify"></i></button>
                </form>
            </div>
            
            <div class=" col-lg-6 d-flex align-items-center justify-content-end gap-4">
                <div class="d-flex align-items-center h-100 ">
                    <a class="mr-3" style="margin-right: 12px; font-size: 20px ;background-color: #73ba4a ; border-radius: 50%; width:28px; height: 28px; color: #fff" >
                        <i class="mdi mdi-phone"></i>
                    </a>
                    <ul class="d-flex flex-column align-items-start">
                  
                        <li style="font-size: 15px; font-style: bold; text-wrap:nowrap">Hỗ trợ khách hàng</li>
                        <li style="font-size: 15px; font-weight: bold ">0785466688</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center h-100 ">
                    <a class="mr-3" style="margin-right: 12px; font-size: 20px ;background-color: #73ba4a ; border-radius: 50%; width:28px; height: 28px; color: #fff" >
                        <i class="mdi mdi-account"></i>
                    </a>
                    <?php  
                        if(isset($_SESSION['user']) ){ 
                    ?>
                        <ul class=" account-box d-flex flex-column align-items-start  position-relative">
                            <li class="account-box__item ">
                                <span style="font-size: 15px; font-weight:bold"><?=$_SESSION['user']['lastname']?> <?=$_SESSION['user']['firstname']?></span>
                            </li>
                            <ul class=" account-box-menu flex-column align-items-start position-absolute " >
                                <li style="padding: 4px 0; margin-top:6px">
                                    <a href="account">Tài khoản</a>
                                 </li>
                                <li style="padding: 4px 0 8px 0; margin-bottom: 6px">
                                    <a href="account/logout">Đăng xuất</a>
                                </li>
                                <?php
                                    if(isset($_SESSION['isLogin_Admin']) || isset($_SESSION['isLogin_Nhanvien'])){ ?>
                                        <li style="padding: 4px 0;"><a href="admin/index.php">Trang quản lý</a></li>
                                <?php } ?>
                            </ul>
                        </ul>
                      
                    <?php }else{ ?>
                    <ul class="d-flex flex-column align-items-start">
                        <li style="font-size: 14px; text-wrap:nowrap"><a href="account/login">Đăng nhập</a></li>
                        <li style="font-size: 12px ; text-wrap:nowrap"><a href="account/register">Đăng ký</a></li>
                    </ul>
                    <?php } ?>
                    </ul>
                </div>
                    <button class="header-cart d-flex align-items-center justify-content-center" >
                        <a  href="?act=cart" class="d-flex align-items-center gap-2  " style="color:#008848">
                            <?php 
                                $soluong = 0;
                                $thanhtien = 0;
                                if(isset($_SESSION['sanpham'])){
                                foreach ($_SESSION['sanpham'] as $value) {
                                    $soluong +=1;
                                    $thanhtien +=$value['ThanhTien'];
                                }}
                            ?>
                            <i class="mdi mdi-cart" style="font-size: 20px"></i>
                            <span style="text-wrap:nowrap">Giỏ hàng</span>
                            <span style="padding: 1px 6px;background-color:#fbc011;color: black;border-radius: 4px; font-size: 14px"  class="quantity">
                                <?=$soluong?> 
                            </span>  
                        </a>
                        <div class="cartdrop">
                            <?php if(isset($_SESSION['sanpham'])){
                                foreach ($_SESSION['sanpham'] as $value) { ?>
                            <div class="sin-itme clearfix">
                            <a href="?act=cart&xuli=deleteall&id=<?= $value['MaSP'] ?>"><i class="mdi mdi-close" title="Remove this product"></i></a>
                                <a class="cart-img" href="?act=cart"><img src="public/<?=$value['HinhAnh1']?>" alt="" /></a>
                                <div class="menu-cart-text">
                                    <a href="?act=detail&id=<?=$value['MaSP']?>">
                                        <h5><?=$value['TenSP']?></h5>
                                    </a>
                                    <b>Số lượng: <?=$value['SoLuong']?></b>
                                    <strong><?=number_format($value['ThanhTien'])?> VNĐ</strong>
                                </div>
                        </div>
                            <?php }} ?>
                        <div class="total">
                            <span>Tổng <strong>= <?=number_format($thanhtien)?> VNĐ</strong></span>
                        </div>
                        <a class="goto" href="index.php?act=cart">Đến giỏ hàng</a>
                        <a class="out-menu" href="index.php?act=checkout">Thanh toán</a>
                    </div>
                </button>
            </div>
           
        </div>
    </div>
	
    <div class="container-fluid g-0 text-center " style="background-color: #008848; height: 50px">
        <nav class="mainmenu main-container container">
            <?php  if($data_collection !== NULL) ?>
            <ul>

                <li class="mainmenu-item"><a href="?act=home">Trang chủ</a></li>
                <li class="mainmenu-item"><a href="?act=shop">Menu Bếp của mẹ</a>
                    
                </li>
                <li class="mainmenu-item"><a href="?act=promotion">Khuyến mãi hot</a></li>
                <li class="mainmenu-item">
                    <a href="#">Món ngon gia đình 
                        <i style="font-size: 20px" class="mdi mdi-chevron-down"></i>
                    </a>
                    <ul class="magamenu">
                        <?php    
                            foreach ($data_collection as $row) { ?>
                            <li>
                                <a href="collections/<?=$row['slug']?>">
                                    <?=$row['name']?>
                                </a>
                            </li>
                         <?php  } ?> 
                    </ul>
                </li>
                <li class="mainmenu-item">
                    <a href="?act=checkout">Thanh toán</a>
                </li>
                <li class="mainmenu-item"><a href="?act=about">Giới thiệu</a></li>
                <li class="mainmenu-item"><a href="?act=contact">Liên hệ</a></li>
            </ul>
        </nav>
        <!-- mobile menu start -->
        <!-- <div class="mobile-menu-area">
            <div class="mobile-menu">
                <nav id="dropdown">
                    <ul>
                        <li><a href="?act=home">Trang chủ</a>
                        </li>
                        <li><a href="?act=shop">Cửa hàng</a>
                            <ul>
                            <?php $i = 1; foreach ($data_chitietDM as $row) { ?>
                                <li>
                                    <a href="?act=shop&sp=<?=$i?>"><h5><?= $data_danhmuc[$i-1]['TenDM'] ?></h5></a>
                                    <ul>
                                        <?php foreach ($row as $value) { ?>
                                        <li><a href="?act=shop&sp=<?=$value['MaDM']?>&loai=<?=$value['TenLSP']?>"><?=$value['TenLSP']?></a></li>
                                        <?php }?>
                                    </ul>
                                </li>
                            <?php $i++; } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="?act=checkout">Thanh Toán</a>
                        </li>
                        <li><a href="?act=about">Giới thiệu</a></li>
                        <li><a href="?act=contac">Liên hệ</a></li>
                    </ul>
                </nav>
            </div>
        </div>
          -->
    </div>
   
</header>