 <!-- Start Banner Area -->
 <section class="banner-area organic-breadcrumb">
     <div class="container">
         <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
             <div class="col-first">
                 <h1>Profile Member</h1>
                 <nav class="d-flex align-items-center">
                     <a href="<?=base_url('profile')?>">Akun<span class="lnr lnr-arrow-right"></span></a>
                     <a href="javascript:(0)">Profile</a>
                 </nav>
             </div>
         </div>
     </div>
 </section>
 <!-- End Banner Area -->

 <section class="product_description_area">
     <div class="container">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
             <li class="nav-item">
                 <a class="nav-link <?= $active === "profile" ? "active" : ""?>" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                     aria-controls="profile" aria-selected="true">Profile</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link <?= $active === "address" ? "active" : ""?>" id="address-tab" data-toggle="tab" href="#address" role="tab"
                     aria-controls="address" aria-selected="false">Daftar Alamat</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link <?= $active === "orders" ? "active" : ""?>" id="order-tab" data-toggle="tab" href="#order" role="tab" aria-controls="order"
                     aria-selected="false">Transaksi</a>
             </li>
         </ul>
         <div class="tab-content" id="myTabContent">
             <div class="tab-pane fade <?= $active === "profile" ? "show active" : ""?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="container">
                        <div class="row order_d_inner">
                            <div class="col-lg-12">
                                <div class="details_item">
                                    <h4>Informasi Akun <a href="<?=base_url('profile/edit')?>"> -Edit-</a></h4>
                                    <ul class="list">
                                        <li><a href="javascript:(0)"><span>Nama</span> : <?=$member->name?></a></li>
                                        <li><a href="javascript:(0)"><span>Alamt Email</span> : <?=$member->email?></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="tab-pane fade <?= $active === "address" ? "show active" : ""?>" id="address" role="tabpanel" aria-labelledby="address-tab">
                 <div class="row">
                    <div class="container">
                        <div class="row order_d_inner">
                            <div class="col-md-3 mb-3">
                                <button onclick="window.location='<?=base_url('address/create')?>'" class="btn">
                                    Tambah Alamat
                                </button>
                            </div>
                            <?php foreach ($address as $addr) { ?>
                            <div class="col-lg-12">
                                <div class="details_item">
                                    <h4><?=$addr->address_name?> <a href="<?=base_url("address/$addr->id/edit")?>"> -Edit-</a></h4>
                                    <ul class="list">
                                        <li><a href="javascript:(0)"><span>Nama Penerima</span> : <?=$addr->name?></a></li>
                                        <li><a href="javascript:(0)"><span>No. Handphone</span> : <?=$addr->phone?></a></li>
                                        <li><a href="javascript:(0)"><span>Alamat</span> : <?=$addr->address?></a></li>
                                        <li><a href="javascript:(0)"><span>Kelurahan</span> : <?=ucwords(strtolower($addr->village_name))?></a></li>
                                        <li><a href="javascript:(0)"><span>Kecamatan</span> : <?=ucwords(strtolower($addr->district_name))?></a></li>
                                        <li><a href="javascript:(0)"><span>Kota</span> : <?=$addr->regency_name?></a></li>
                                        <li><a href="javascript:(0)"><span>Provinsi</span> : <?=$addr->province_name?></a></li>
                                        <li><a href="javascript:(0)"><span>Kode POS</span> : <?=$addr->zipcode?></a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php } ?>
                            </div>
                        </div>
                 </div>
             </div>
             
             <div class="tab-pane fade <?= $active === "orders" ? "show active" : ""?>" id="order" role="tabpanel" aria-labelledby="order-tab">
                 <div class="row">
                     Detail Pembayaran
                 </div>
             </div>
         </div>
     </div>
 </section>