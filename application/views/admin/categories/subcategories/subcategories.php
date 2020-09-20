<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a class="link-to" data-to="<?=base_url("categories")?>">Kategori</a></li>
    <li class="active">Subkategori</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left link-to" data-to="<?=base_url("categories")?>"></span> Subkategori</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-3">
            <!-- CONTACT ITEM -->
            <div class="panel panel-default">
                <div class="panel-body profile">
                    <div class="profile-image">
                        <img src="<?=base_url("assets/images/no_image200.jpg")?>" alt="Nadia Ali" />
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name"><?=$category->name?></div>
                        <div class="profile-data-title">Kategori</div>
                    </div>
                    <div class="profile-controls">
                        <a href="#" class="profile-control-left"><span class="fa fa-shopping-cart"></span></a>
                        <a href="#" class="profile-control-right"><span class="fa fa-star"></span></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="contact-info">
                        <p><small>Subkategoti</small><br /><?=$totalSub?> Subkategori</p>
                        <p><small>Produk</small><br />289 Produk</p>
                        <p><small>Total Penjualan</small><br>Rp.700.000.000</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Daftar Subkategori</h3>
                    <ul class="panel-controls">
                        <li>
                            <button class="btn btn-default btn-rounded link-to"
                                data-to="<?=base_url("categories/$category->id/subcategories/create")?>">
                                <i class="fa fa-plus"></i> Tambah Subkategori
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="panel-body list-sub">

                    <div class="list-group list-group-contacts border-bottom push-down-10">
                        <?php foreach ($subcategories as $subcategory) { ?>
                        <a class="list-group-item">
                            <img src="<?=base_url("assets/images/no_image200.jpg")?>" class="pull-left" alt="Produk">
                            <span class="contacts-title">
                                <?=$subcategory->name?>
                            </span>
                            <p>180 Produk</p>
                        </a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT WRAPPER -->

<style>
    .list-sub {
        height: 400px;
        overflow: auto;
        overflowY: scroll;
    }
</style>