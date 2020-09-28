<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Produk</li>
</ul>

<!-- END BREADCRUMB -->
<div class="content-frame">   
    <div class="content-frame-top">                        
        <div class="page-title">                    
            <h2><span class="fa fa-shopping-cart"></span> Produk</h2>
        </div>                                      
        <div class="pull-right">                            
            <button class="btn btn-default link-to" data-to="<?=base_url("products-grid")?>"><span class="fa fa-th"></span> Tampilan Kolom</button>
        </div>                         
    </div>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Tabel Produk</h3>
                </div>

                <div class="panel-body">
                    <div class="btnContainer">
                        <button class="btn btn-default btn-rounded link-to-with-prev" data-to="<?=base_url("products/create")?>">
                            <i class="fa fa-shopping-cart"></i> Tambah Produk
                        </button>
                    </div>
                    <table class="table table-bordered" id="products">
                        <thead>
                            <th width="8%">No</th>
                            <th>Nama</th>
                            <th width="15%">Harga</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Subkategori</th>
                            <th>Dibuat</th>
                            <th width="12%">Tindakan</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<style>
    .btnContainer {
        margin-bottom: 10px;
    }

    .page-content-wrap {
        margin-top: 10px;
    }
</style>

<script>
    $(document).ready(() => {
        let url = "<?=base_url('products-table')?>";
        let csrfTokenName = "<?=$this->security->get_csrf_token_name()?>";
        let getCsrfHash = "<?=$this->security->get_csrf_hash()?>";

        datatables("#products", url, csrfTokenName, getCsrfHash, [
            {
                data: "no",
            },
            {
                data: "name",
            },
            {
                data: "price",
            },
            {
                data: "category",
            },
            {
                data: "subcategory",
            },
            {
                data: "createdAt",
            },
            {
                data: 'actions'
            }
        ]);
    });
</script>