<?php if(isset($address)){ ?>
<div class="row">
    <div class="container">
        <div class="row order_d_inner">
            <div class="col-lg-12">
                <div class="details_item">
                    <h4><?=$address->address_name?></h4>
                    <ul class="list">
                        <li><a href="javascript:(0)"><span>Nama Penerima</span> : <?=$address->name?></a></li>
                        <li><a href="javascript:(0)"><span>No. Handphone</span> : <?=$address->phone?></a></li>
                        <li><a href="javascript:(0)"><span>Alamat</span> : <?=$address->address?></a></li>
                        <li><a href="javascript:(0)"><span>Kelurahan</span> : <?=ucwords(strtolower($address->village_name))?></a></li>
                        <li><a href="javascript:(0)"><span>Kecamatan</span> : <?=ucwords(strtolower($address->district_name))?></a></li>
                        <li><a href="javascript:(0)"><span>Kota</span> : <?=$address->regency_name?></a></li>
                        <li><a href="javascript:(0)"><span>Provinsi</span> : <?=$address->province_name?></a></li>
                        <li><a href="javascript:(0)"><span>Kode POS</span> : <?=$address->zipcode?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }else{ ?>
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
<?php } ?>