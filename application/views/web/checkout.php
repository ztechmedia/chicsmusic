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
                    <a style="background: #ccc" class="nav-link" id="account-tab" href="#account" role="tab"
                        aria-controls="contact" aria-selected="false">Rekening Tujuan</a>
                </li>
                <li class="nav-item">
                    <a style="background: #ccc" class="nav-link" id="order-tab" href="#order" role="tab"
                        aria-controls="order" aria-selected="false">Detail Pembayaran</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="address" role="tabpanel" aria-labelledby="address-tab">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="province">Alamat Pengiriman</label>
                            <select name="address_id" id="address_id" class="form-control" onchange="detailAddress()">
                            <option value="address">Pilih Alamat</option>
                                <?php foreach ($address as $addr) { ?>
                                    <option value="<?=$addr->id?>"><?=$addr->address_name?></option>
                                <?php } ?>
                            </select>
                            <span id="province_id-error" class="form-error"></span>
                        </div>
                    </div>
                    <div id="address-detail">
                        <div class="row">
                            <div class="container">
                                <div class="row order_d_inner">
                                    <div class="col-lg-12">
                                        <div class="details_item">
                                            <h4>Nama Alamat</h4>
                                            <ul class="list">
                                                <li><a href="javascript:(0)"><span>Nama Penerima</span> :</a></li>
                                                <li><a href="javascript:(0)"><span>No. Handphone</span> :</a></li>
                                                <li><a href="javascript:(0)"><span>Alamat</span> :</a></li>
                                                <li><a href="javascript:(0)"><span>Kelurahan</span> :</a></li>
                                                <li><a href="javascript:(0)"><span>Kecamatan</span> :</a></li>
                                                <li><a href="javascript:(0)"><span>Kota</span> :</a></li>
                                                <li><a href="javascript:(0)"><span>Provinsi</span> :</a></li>
                                                <li><a href="javascript:(0)"><span>Kode POS</span> :</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
                    <div class="row">
                        <?php $no = 1; foreach ($banks as $bank) { ?>
                            <div class="container">
                                <div class="section-top-border">
                                    <div class="row bank-list bank-list-<?=$bank->id?>" onclick="getAccount('<?=$bank->id?>', '.bank-list-<?=$bank->id?>')">
                                        <div class="col-md-3" style="display: flex; flex-direction: row; align-items: center; justify-content: flex-start;">
                                            <p><?=$no++;?>. </p>
                                            <img width="450" height="150" 
                                            src="<?=
                                                $bank->icon ? 
                                                base_url("assets/images/banks/$bank->icon")
                                                : base_url("assets/images/no_image200.jpg")?>" alt="<?=$bank->bank_name?>" class="img-fluid">
                                        </div>
                                        <div class="col-md-6 mt-sm-20">
                                            <ul class="list">
                                                <li><span>Atas Nama</span> : <?=$bank->owner?></li>
                                                <li><span>Nomor Rekening</span> : <?=$bank->account?></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                    <div class="row">
                        <div class="container">
                            <div class="row order_d_inner">
                                <div class="col-lg-4">
                                    <div class="details_item">
                                        <h4>Info Pemesanan</h4>
                                        <ul class="list">
                                            <li><a><span>No. Transaksi</span> : 60235</a></li>
                                            <li><a><span>Tanggal</span> : <?=date('d/m/Y')?></a></li>
                                            <li><a><span>Bank Tujuan Transfer</span> : <div id="address-detail-bank"></div></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div id="address-detail-order">
                                    </div>
                                </div>
                            </div>
                            <div class="order_details_table">
                                <h2>Order Details</h2>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="30%">Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th width="45%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $totalsub = 0; $total_weight = 0; foreach ($carts as $cart) { $totalsub += $cart->subtotal; $total_weight += $cart->total_weight; ?>
                                            <tr>
                                                <td>
                                                    <p><?=$cart->name?></p>
                                                </td>
                                                <td>
                                                    <p><?=toRp($cart->price)?></p>
                                                </td>
                                                <td>
                                                    <p>x <?=$cart->qty?></p>
                                                </td>
                                                <td>
                                                    <p><?=toRp($cart->subtotal)?></p>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <p>Total Barang</p>
                                                </td>
                                                <td>
                                                    <input type="number" value="<?=$totalsub?>" id='totalsub' style="display:none">
                                                    <p><?=toRp($totalsub)?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <p>Berat Total</p>
                                                </td>
                                                <td>
                                                    <p><?=$total_weight?> Gram / <?=$total_weight/1000?> Kg</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <p>Pilih Kurir</p>
                                                </td>
                                                <td>
                                                    <select onchange="checkOngkir($(this).val())" class="form-control" id="courier" name="courier">
                                                        <option value="jne">JNE</option>
                                                        <option value="pickup">Ambil Sendiri</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <p>Biaya</p>
                                                </td>
                                                <td>
                                                    <div id="ongkir">Loading...</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <p>Total Keseluruhan</p>
                                                </td>
                                                <td>
                                                    <div id="totalall">Loading...</div>
                                                </td>
                                            </tr>
                                            <tr class="out_button_area">
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                    <div class="checkout_btn_inner d-flex align-items-center">
                                                        <a onclick="checkout()" class="primary-btn" href="javascript:(0)">Bayar</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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