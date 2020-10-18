<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>Pembayaran</h1>
                <nav class="d-flex align-items-center">
                    <a href="<?=base_url()?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
                    <a href="<?=base_url("carts")?>">Keranjang Belanja<span class="lnr lnr-arrow-right"></span></a>
                    <a href="javascript:(0)">Pembayaran</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<?php if($this->auth->role === "member") { ?>
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="address-tab" data-toggle="tab" href="#address" role="tab" aria-controls="address"
                        aria-selected="true">Alamat Pengiriman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab"
                        aria-controls="contact" aria-selected="false">Rekening Tujuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"
                        aria-controls="order" aria-selected="false">Detail Pembayaran</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="address" role="tabpanel" aria-labelledby="address-tab">
                    <div class="row">
                        Pilih Alamat
                    </div>
                </div>

                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <div class="row">
                        Rekening Tujuan
                    </div>
                </div>
                <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                    <div class="row">
                        Detail Pembayaran
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } else { ?>
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="returning_customer">
                <div class="check_title">
                    <h2>Silakan login untuk melanjutkan? <a href="<?=base_url("login")?>"> Login</a></h2>
                </div>
            </div>
        </div>
    </section>
    <!--================End Checkout Area =================-->
<?php } ?>