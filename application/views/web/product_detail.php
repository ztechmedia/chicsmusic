<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Detail Produk</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?=base_url()?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=base_url("products?page=1&limit&12&sort=min")?>">Produk<span
                            class="lnr lnr-arrow-right"></span></a>
                    <a href="javascript:(0)">Detail Produk</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_Product_carousel">
                    <?php
                    $covers = unserialize($product->cover); 
                    foreach ($covers as $cover) { ?>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="<?=base_url("assets/images/products/$cover")?>">
                    </div>
                    <?php } ?>

                    <div class="single-prd-item">
                        <img class="img-fluid" src="<?=base_url("assets/joli/img/logo.png")?>">
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text">
                    <h3><?=$product->name?></h3>
                    <h2><?=toRp($product->price)?></h2>
                    <ul class="list">
                        <li><a class="active" href="<?=base_url("products?page=1&limit=12&sort=min&subcategories=$product->subcategory")?>"><span>Kategori</span> : <?=$product->category?></a></li>
                        <li><a href="#"><span>Stok</span> : <?=$product->stock?></a></li>
                    </ul>
                    <p><?=max_length($product->description, 300)?></p>
                    <div class="product_count">
                        <label for="qty">Quantity:</label>
                        <input type="text" name="qty" id="sst" maxlength="<?=$product->stock?>" value="1" title="Quantity:"
                            class="input-text qty">
                        <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && result.value < <?=$product->stock?>) result.value++;return false;"
                            class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                        <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                            class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                    </div>
                    <div class="card_area d-flex align-items-center">
                        <a class="primary-btn" href="javascript:(0)" onclick="addSingleProduct()">Tambah Ke Keranjang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Deskripsi Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Komentar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                    aria-controls="review" aria-selected="false">Ulasan</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p><?=$product->description?></p>
            </div>

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment-list"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Komentari Produk</h4>
                            <form class="row contact_form post-action" id="post-form" action="javascript:(0)" 
                                role="form"
                                id="contactForm" 
                                novalidate="novalidate"
                                data-action="<?=base_url("post-comment/$product->id/create")?>">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input readonly="<?=isset($member)?>" value="<?= isset($name) ? $name : "" ?>" type="text" class="form-control" id="name" name="name"
                                            placeholder="Nama">
                                        <span id="name-error-p" class="form-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input readonly="<?=isset($member)?>" value="<?= isset($email) ? $email : "" ?>" type="email" class="form-control" id="email" name="email"
                                            placeholder="Alamat Email">
                                        <span id="email-error-p" class="form-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" id="comment" rows="1"
                                            placeholder="Komentar"></textarea>
                                        <span id="comment-error-p" class="form-error"></span>
                                    </div>
                                </div>
                                <input style="display:none" type="text" class="form-control" id="status" name="status" value="new">
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn primary-btn">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="review-list"></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Berikan ulasan</h4>
                            <p>Rating Kamu:</p>
                            <ul class="list">
                                <li><a onclick="ratingStar(1)" href="javascript:(0)"><i class="fa fa-star rating-hover-1"></i></a></li>
                                <li><a onclick="ratingStar(2)" href="javascript:(0)"><i class="fa fa-star rating-hover-2"></i></a></li>
                                <li><a onclick="ratingStar(3)" href="javascript:(0)"><i class="fa fa-star rating-hover-3"></i></a></li>
                                <li><a onclick="ratingStar(4)" href="javascript:(0)"><i class="fa fa-star rating-hover-4"></i></a></li>
                                <li><a onclick="ratingStar(5)" href="javascript:(0)"><i class="fa fa-star rating-hover-5"></i></a></li>
                            </ul>
                            <p>Outstanding</p>
                            <span id="star-error-r" class="form-error"></span>
                            <form class="row contact_form review-action" id="reviews-form" action="javascript:(0)" role="form" id="contactForm"
                                novalidate="novalidate"
                                data-action="<?=base_url("post-review/$product->id/create")?>">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input readonly="<?=isset($member)?>" value="<?= isset($name) ? $name : "" ?>" type="text" class="form-control" id="name" name="name"
                                            placeholder="Nama">
                                        <span id="name-error-r" class="form-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input readonly="<?=isset($member)?>" value="<?= isset($email) ? $email : "" ?>" type="email" class="form-control" id="email" name="email"
                                            placeholder="Alamat Email"">
                                        <span id="email-error-r" class="form-error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="comment" id="comment" rows="1"
                                            placeholder="Ulasan"></textarea></textarea>
                                        <span id="comment-error-r" class="form-error"></span>
                                    </div>
                                </div>
                                <input style="display:none" type="text" class="form-control" id="star" name="star">
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="primary-btn">Kirim Ulasan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->