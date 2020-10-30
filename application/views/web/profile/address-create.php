 <!-- Start Banner Area -->
 <section class="banner-area organic-breadcrumb">
     <div class="container">
         <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
             <div class="col-first">
                 <h1>Alamat Penerima</h1>
                 <nav class="d-flex align-items-center">
                     <a href="<?=base_url('profile/profile')?>">Akun<span class="lnr lnr-arrow-right"></span></a>
                     <a href="<?=base_url('profile/address')?>">Alamat<span class="lnr lnr-arrow-right"></span></a>
                     <a href="javascript:(0)">Tambah Alamat</a>
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
                 <a style="cursor: no-drop; background: #ccc" class="nav-link" >Profile</a>
             </li>
             <li class="nav-item" id="address-tab" data-toggle="tab" href="#address" role="tab" 
                aria-controls="address" aria-selected="true">
                 <a class="nav-link active">Daftar Alamat</a>
             </li>
             <li class="nav-item">
                 <a style="cursor: no-drop; background: #ccc" class="nav-link" >Transaksi</a>
             </li>
         </ul>
         <div class="tab-content" id="myTabContent">
             <div class="tab-pane fade show active" id="address" role="tabpanel" aria-labelledby="address-tab">
                 <div class="row">

                 <div class="container">
                        <div class="row order_d_inner">
                            <div class="col-lg-8">
                                <div class="details_item">
                                    <h4><a href="<?=base_url('profile/address')?>"><-</a> Tambah Alamat</h4>
                                    <div class="container">
                                        <div class="tracking_box_inner">
                                            <form class="row tracking_form address-action" action="javascript:(0)"
                                                data-action="<?=base_url("address/addaddress")?>"
                                                role="form">
                                                <div class="col-md-12 form-group">
                                                    <label for="regency">Nama Alamat</label>
                                                    <input type="text" class="form-control" value="" id="address_name" name="address_name" 
                                                    placeholder="Contoh: Kantor, Rumah"
                                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Contoh: Kantor, Rumah'">
                                                    <span id="address_name-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="regency">Nama Penerima</label>
                                                    <input type="text" class="form-control" value="" id="name" name="name">
                                                    <span id="name-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="regency">Nomor Handphone</label>
                                                    <input type="number" class="form-control" value="" id="phone" name="phone">
                                                    <span id="phone-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="address">Alamat Lengkap</label>
                                                    <textarea type="text" class="form-control" value="" id="address" name="address"></textarea>
                                                    <span id="address-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="province">Provinsi</label>
                                                    <select name="province_id" id="province_id" class="form-control" onchange="getCity($(this).val())">
                                                    <option value="">Pilih Provinsi</option>
                                                        <?php foreach ($provinces as $province) { ?>
                                                            <option value="<?=$province->province.':'.$province->province_id?>"><?=$province->province?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <span id="province_id-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="regency">Kota</label>
                                                    <select name="regency_id" id="regency_id" class="form-control" onchange="getDistrict($(this).val())">
                                                        <option value="">Pilih Kota</option>
                                                    </select>
                                                    <span id="regency_id-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="district">Kecamatan</label>
                                                    <select name="district_id" id="district_id" class="form-control" onchange="getVillage($(this).val())">
                                                        <option value="">Pilih Kecamatan</option>
                                                    </select>
                                                    <span id="district_id-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="village">Kelurahan</label>
                                                    <select name="village_id" id="village_id" class="form-control">
                                                        <option value="">Pilih Kelurahan</option>
                                                    </select>
                                                    <span id="village_id-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label for="regency">Kode Pos</label>
                                                    <input type="number" class="form-control" value="" id="zipcode" name="zipcode">
                                                    <span id="zipcode-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <button type="submit" value="submit" class="primary-btn">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                 </div>
             </div>
         </div>
     </div>
 </section>