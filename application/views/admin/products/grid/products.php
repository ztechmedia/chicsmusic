<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Produk</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="content-frame">

    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-shopping-cart"></span> Produk</h2>
        </div>
        <div class="pull-right">
            <button class="btn btn-default link-to-with-prev" data-to="<?=base_url("products/create")?>">
                <i class="fa fa-shopping-cart"></i> Tambah Produk
            </button>
            <button class="btn btn-default link-to" data-to="<?=base_url("products")?>"><span class="fa fa-list"></span>
                Tampilan Tabel</button>
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
                        <option value="3">3 Data Perhalaman</option>
                        <option value="6">6 Data Perhalaman</option>
                        <option value="12">12 Data Perhalaman</option>
                        <option value="24">24 Data Perhalaman</option>
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
        const limit = $("#limit").val();
        const search = $("#search").val();
        const page = 1;
        let url = `<?=base_url()?>products-grid-list?limit=${limit}&page=${page}&search=${search}`;
        loadContent(url, ".product-list");
    }

    firstLoad();
    function changePage(page) {
        const limit = $("#limit").val();
        const search = $("#search").val();
        let url = `<?=base_url()?>products-grid-list?limit=${limit}&page=${page}&search=${search}`;
        if (search) url = `${url}&search=${search}`;
        loadContent(url, ".product-list");
    }

    $("#form-search").submit(function() {
        console.log("form-search");
        firstLoad();
    });

</script>
<style>
    .img {
        width: 100%;
        height: 180px;
    }
</style>