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
            <button class="btn btn-default link-to" data-to="<?=base_url("products")?>"><span class="fa fa-list"></span> Tampilan Kolom</button>
        </div>   
    </div>

    <div class="content-frame-right" style="height: 100vh">

    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="product-list"></div>
    </div>
</div>
<!-- END PAGE CONTENT WRAPPER -->

<script>
    loadContent("<?=base_url("products-grid-list/3/1")?>", ".product-list");
</script>
<style>
    .img {
        width: 100%;
        height: 180px;
    }
</style>