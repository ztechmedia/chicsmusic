<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Banner Produk</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="content-frame">
<div class="page-content-wrap">
    <?php foreach($banners as $banner){
        $covers = unserialize($banner->cover); ?>
        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body panel-body-image">
                    <img class="img" src="<?=base_url("assets/images/products/$covers[0]")?>" alt="Banner" />
                    <div class="banner-list-overlay" style="padding-top: 10px;">
                        <h3><?=$banner->product_name?></h3>
                    </div>
                    <a onclick="setBannerEdit('<?=$banner->id?>')" class="panel-body-inform">
                        <span class="fa fa-pencil"></span>
                    </a>
                </div>
               
                <div class="panel-body" style="height: 120px">
                    <h3><?=max_length($banner->name, 30)?></h3>
                    <p><?=max_length($banner->description, 60)?></p>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
    <div class="content-frame-top">
        <div class="page-title">
            <h2>Pilih Produk</h2>
        </div>
    </div>

    <div class="content-frame-right" style="height: 100vh">
        <form class="form-horizontal" id="form-search" action="javascript:(0)">
            <div class="form-group">
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-search"></span></span>
                        <input type="text" class="form-control" id="search" placeholder="Cari produk..." />
                    </div>
                </div>
            </div>
            <label>Data Perhalaman:</label>
            <div class="form-group">
                <div class="col-md-12">
                    <select class="form-control select" id="limit">
                        <option value="8">8 Produk</option>
                        <option value="16">16 Produk</option>
                        <option value="24">24 Produk</option>
                        <option value="58">58 Produk</option>
                    </select>
                </div>
            </div>
            <label>Urutkan:</label>
            <div class="form-group">
                <div class="col-md-12">
                    <select class="form-control select" id="sort">
                        <option value="latest">Produk Terbaru</option>
                        <option value="oldest">Produk Terlama</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-rounded">Filter</button>
        </form>
    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="product-list"></div>
    </div>
</div>
<!-- END PAGE CONTENT WRAPPER -->

<script>
    function firstLoad() {
        setContentLoader(".product-list");
        const limit = $("#limit").val();
        const search = $("#search").val();
        const page = 1;
        const sort = $("#sort").val();
        let url = `<?=base_url()?>admin/banners-product-list?limit=${limit}&page=${page}&search=${search}&sort=${sort}`;
        loadContent(encodeURI(url), ".product-list");
    }

    firstLoad();

    function changePage(page) {
        setContentLoader(".product-list");
        const limit = $("#limit").val();
        const search = $("#search").val();
        const max = $("#max").val();
        const min = $("#min").val();
        const sort = $("#sort").val();
        let url = `<?=base_url()?>admin/banners-product-list?limit=${limit}&page=${page}&search=${search}&sort=${sort}`;
        if (search) url = `${url}&search=${search}`;
        loadContent(encodeURI(url), ".product-list");
    }

    $("#form-search").submit(function() {
        firstLoad();
    });

    $(".content-frame-right-toggle").on("click", function () {
        $(".content-frame-right").is(":visible")
        ? $(".content-frame-right").hide()
        : $(".content-frame-right").show();
        page_content_onresize();
    });

    function setBanner(productId) {
        $("#modal_basic").modal("show");
        $(".modal-title").html("Banner Produk");
        const url = "<?=base_url()?>admin/set-banners/"+productId;
        setContentLoader(".modal-body");
        loadContent(url, ".modal-body");
    }

    function setBannerEdit(bannerId) {
        $("#modal_basic").modal("show");
        $(".modal-title").html("Update Banner Produk");
        const url = "<?=base_url()?>admin/edit-banners/"+bannerId;
        setContentLoader(".modal-body");
        loadContent(url, ".modal-body");
    }
</script>

<style>
    .img {
        width: 100%;
        height: 150px;
    }

    .banner-list-overlay {
        position: absolute;
        top: 0;
        background-color: rgba(0,0,0,0.5);
        width: 100%;
        height: 100%;
        padding-left: 10px;
    }

    .banner-list-overlay h5,
    .banner-list-overlay h3 {
        color: white;
    }

    .page-content-wrap {
        margin-bottom: 10px;
    }

    .card-banner {
        position: relative;
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;
        border: 1px solid #ccc;
        width: 100%;
        overlay: hidden;
    }

    .text-container {
        position: relative;
        width: 50%;
    }

    .text-field {
        position; absolute;
        top: 0px;
    }

    .img-banner {
        width: 200px;
    }
</style>