<!-- banner-start -->
<?php
require_once("banner.php")
?>


<!-- collection section end -->
<!-- featured-products section start -->
<section class="single-products  products-two section-padding-top extra-padding-bottom" >
    <div class="container main-container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title text-left">
                    <h3>Sản phẩm phổ biến</h3>
                </div>
            </div>
        </div>
        <div class="wrapper">
           <ul class="load-list load-list-one">
                <?php for ($i = 0; $i < 4; $i++) { ?>
                    <li>
                        <div class="row text-center">
                            <?php
                            if ($product[$i] != null) {
                                foreach ($product[$i] as  $row) { ?>
                                    <!-- single product end -->
                                    <div class="col-xs-12 col-sm-6 col-md-3 r-margin-top">
                                        <div class="single-product">
                                            <div class="product-f">
                                                <a href="?act=detail&id=<?= $row['id'] ?>"><img src="public/<?= $row['image1'] ?>" alt="Product Title" class="img-products" /></a>
                                                <div class="actions-btn">
                                                    <a href="?act=detail&id=<?= $row['id'] ?>"><i class="mdi mdi-cart"></i></a>
                                                    <a href="?act=detail&id=<?= $row['id'] ?>" data-toggle="modal" ><i class="mdi mdi-eye"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-dsc">
                                                <p><a href="?act=detail&id=<?= $row['id'] ?>"><?= $row['name'] ?></a></p>
                                                <span><?= number_format($row['price']) ?> VNĐ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single product end -->
                            <?php }
                            } ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>

            <div class="w-100 d-flex justify-content-center">
                <button id="load-more-one"  class="main-button">Tải thêm</button>
            </div>
        </div>
    </div>
</section>
<!-- featured-products section end -->
<!-- quick view start -->
<?php
include_once("mvc/views/client/quickview.php");
?>
<!-- quick view end -->