<!-- start banner Area -->
<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="active-banner-slider owl-carousel">

                <?php foreach ($banners as $banner) {
                    $covers = unserialize($banner->cover);
                ?>
                    <!-- single-slide -->
                    <div class="row single-slide align-items-center d-flex banner-product">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h2><?=$banner->name?></h2>
                                <p><?=$banner->description?></p>
                                <div class="add-bag d-flex align-items-center">
                                    <a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
                                    <span class="add-text text-uppercase">Tambah ke keranjang</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img-custom">
                                <img class="img-fluid img-fluid-banner" src="<?=base_url("assets/images/products/$covers[0]")?>" />
                            </div>
                            <div class="banner-overlay">
                                <?=toRp($banner->price)?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- start features Area -->
<section class="features-area section_gap service-home">
    <div class="container">
        <div class="row features-inner">
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="<?=base_url("assets/karma/img/features/f-icon1.png")?>" alt="">
                    </div>
                    <h6>Pengiriman Cepat</h6>
                    <p>Kami bekerja sama dengan ekspedisi ternama di Indonesia yang sudah terbukti dedikasi &
                        integritasnya</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="<?=base_url("assets/karma/img/features/f-icon2.png")?>" alt="">
                    </div>
                    <h6>Pengembalian Barang</h6>
                    <p>Takut barangmu rusak diperjalanan? Tenang saja, kami memberikan asuransi setiap barang yang kamu
                        beli</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="<?=base_url("assets/karma/img/features/f-icon3.png")?>" alt="">
                    </div>
                    <h6>24/7 Support</h6>
                    <p>Kakak - kakak Admin Chic's Music siap menjawab pertanyan kamu</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="<?=base_url("assets/karma/img/features/f-icon4.png")?>" alt="">
                    </div>
                    <h6>Keamanan Pembayaran</h6>
                    <p>Semua transaks yang terjadi di Chic's Music dijamin 100% aman</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end features Area -->

<!-- Start category Area -->
<section class="category-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="row">

                    <?php
                    $column =[8, 4, 4, 8];
                    $index = 0;
                    foreach($categories as $category){
                        if($index <= 3){ ?>
                        <div class="col-lg-<?=$column[$index]?> col-md-<?=$column[$index]?>">
                            <div class="single-deal">
                                <div class="overlay"></div>
                                <img class="img-fluid w-100 subcategory-icon" src="<?=base_url("assets/images/store_categories/$category->icon")?>" alt="Category Icon">
                                <a href="<?=$category->redirect?>">
                                    <div class="deal-details">
                                        <h6 class="deal-title"><?=$category->name?></h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } $index++; } ?>

                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100 categories-icon" src="<?=base_url("assets/images/store_categories/{$categories[4]->icon}")?>" alt="">
                    <a href="<?=$categories[4]->redirect?>">
                        <div class="deal-details">
                            <h6 class="deal-title"><?=$categories[4]->name?></h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End category Area -->

<!-- start product Area -->
<section class="owl-carousel active-product-area section_gap">
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Produk Terbaru</h1>
                        <p>Produk terbaru dari Chic's Music</p>
                    </div>
                </div>
            </div>
            <div class="row">

                <?php foreach ($latest as $l_product) { $covers = unserialize($l_product->cover); ?>
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid img-product" src="<?=base_url("assets/images/products/$covers[0]")?>" alt="">
                        <div class="product-details">
                            <h6><?=$l_product->name?></h6>
                            <div class="price">
                                <h6><?=toRp($l_product->price)?></h6>
                                <!-- <h6 class="l-through">$210.00</h6> -->
                            </div>
                            <div class="prd-bottom">

                                <a href="" class="social-info">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Add To Bag</p>
                                </a>
                                <a href="" class="social-info">
                                    <span class="lnr lnr-heart"></span>
                                    <p class="hover-text">Wishlist</p>
                                </a>
                                <a href="" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">view more</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Produk Terlaris</h1>
                        <p>Produk Terlaris dari Chic's Music</p>
                    </div>
                </div>
            </div>
            <div class="row">
            <?php foreach ($latest as $l_product) { $covers = unserialize($l_product->cover); ?>
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid img-product" src="<?=base_url("assets/images/products/$covers[0]")?>" alt="">
                        <div class="product-details">
                            <h6><?=$l_product->name?></h6>
                            <div class="price">
                                <h6><?=toRp($l_product->price)?></h6>
                                <!-- <h6 class="l-through">$210.00</h6> -->
                            </div>
                            <div class="prd-bottom">

                                <a href="" class="social-info">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Add To Bag</p>
                                </a>
                                <a href="" class="social-info">
                                    <span class="lnr lnr-heart"></span>
                                    <p class="hover-text">Wishlist</p>
                                </a>
                                <a href="" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">view more</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- end product Area -->

<!-- <section class="exclusive-deal-area">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-left">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-12">
                        <h1>Segera Hadir di Chic's Music</h1>
                        <p>Produk terlaris dari Yamaha Indonesia</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="row clock-wrap">
                            <div class="col clockinner1 clockinner">
                                <h1 class="days">120</h1>
                                <span class="smalltext">Days</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="hours">23</h1>
                                <span class="smalltext">Hours</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="minutes">47</h1>
                                <span class="smalltext">Mins</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="seconds">59</h1>
                                <span class="smalltext">Secs</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="primary-btn">Lihat Produk</a>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="active-exclusive-product-slider">

                    <div class="single-exclusive-slider">
                        <img class="img-fluid" src="<?=base_url("assets/karma/img/product/e-p1.png")?>" alt="">
                        <div class="product-details">
                            <div class="price">
                                <h6>$150.00</h6>
                                <h6 class="l-through">$210.00</h6>
                            </div>
                            <h4>addidas New Hammer sole
                                for Sports person</h4>
                            <div class="add-bag d-flex align-items-center justify-content-center">
                                <a class="add-btn" href=""><span class="ti-bag"></span></a>
                                <span class="add-text text-uppercase">Add to Bag</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- Start brand Area -->
<section class="brand-area section_gap">
    <div class="container">
        <div class="row">
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="<?=base_url("assets/karma/img/brand/1.png")?>" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="<?=base_url("assets/karma/img/brand/2.png")?>" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="<?=base_url("assets/karma/img/brand/3.png")?>" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="<?=base_url("assets/karma/img/brand/4.png")?>" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="<?=base_url("assets/karma/img/brand/5.png")?>" alt="">
            </a>
        </div>
    </div>
</section>
<!-- End brand Area -->

<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Produk Unggulan</h1>
                    <p>Ini dia produk yang menjadi best seller dan kebanggan Chic's Music</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img src="<?=base_url("assets/karma/img/r1.jpg")?>" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Black lace Heels</a>
                                <div class="price">
                                    <h6>$189.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img src="<?=base_url("assets/karma/img/r2.jpg")?>" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Black lace Heels</a>
                                <div class="price">
                                    <h6>$189.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img src="<?=base_url("assets/karma/img/r3.jpg")?>" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Black lace Heels</a>
                                <div class="price">
                                    <h6>$189.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->