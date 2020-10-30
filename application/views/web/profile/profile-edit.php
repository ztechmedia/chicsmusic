 <!-- Start Banner Area -->
 <section class="banner-area organic-breadcrumb">
     <div class="container">
         <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
             <div class="col-first">
                 <h1>Edit Profile</h1>
                 <nav class="d-flex align-items-center">
                     <a href="<?=base_url('profile')?>">Akun<span class="lnr lnr-arrow-right"></span></a>
                     <a href="<?=base_url('profile')?>">Profile<span class="lnr lnr-arrow-right"></span></a>
                     <a href="javascript:(0)">Edit Profile</a>
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
                 <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                     aria-controls="profile" aria-selected="true">Profile</a>
             </li>
             <li class="nav-item">
                 <a style="cursor: no-drop; background: #ccc" class="nav-link">Daftar Alamat</a>
             </li>
             <li class="nav-item">
                 <a style="cursor: no-drop; background: #ccc" class="nav-link" >Transaksi</a>
             </li>
         </ul>
         <div class="tab-content" id="myTabContent">
             <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                 <div class="row">

                 <div class="container">
                        <div class="row order_d_inner">
                            <div class="col-lg-8">
                                <div class="details_item">
                                    <h4><a href="<?=base_url('profile')?>"><-</a> Edit Profile</h4>
                                    <div class="container">
                                        <div class="tracking_box_inner">
                                            <p>* Data dibawah ini tidak boleh kosong</p>
                                            <form class="row tracking_form profile-action" action="javascript:(0)"
                                                data-action="<?=base_url("profile/update")?>"
                                                role="form">
                                                <div class="col-md-12 form-group">
                                                    <input type="text" class="form-control" value="<?=$member->name?>" id="name" name="name" 
                                                    placeholder="Nama" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama'">
                                                    <span id="name-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <input type="email" class="form-control" value="<?=$member->email?>" id="email" name="email" 
                                                    placeholder="Alamat Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat Email'">
                                                    <span id="email-error" class="form-error"></span>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <button type="submit" value="submit" class="primary-btn">Update</button>
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