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
            <button class="btn btn-default link-to-with-prev" data-to="<?=base_url("admin/products/create")?>">
                <i class="fa fa-shopping-cart"></i> Tambah Produk
            </button>
            <button class="btn btn-default link-to" data-to="<?=base_url("admin/products")?>"><span class="fa fa-list"></span>
                Tampilan Tabel</button>
            <button class="btn btn-default content-frame-right-toggle pull-right"><span class="fa fa-bars"></span></button>
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

            <div class="form-group">
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon">Harga Minimal:</span>
                        <input type="number" class="form-control" id="min" placeholder="Rp. 0" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="input-group">
                        <span class="input-group-addon">Harga Maximal:</span>
                        <input type="number" class="form-control" id="max" placeholder="Rp. 0" />
                    </div>
                </div>
            </div>

            <label>Urutkan:</label>
            <div class="form-group">
                <div class="col-md-12">
                    <select class="form-control select" id="sort">
                        <option value="min-price">Harga Termurah</option>
                        <option value="max-price">Harga Termahal</option>
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
        const limit = $("#limit").val();
        const search = $("#search").val();
        const page = 1;
        const max = $("#max").val();
        const min = $("#min").val();
        const sort = $("#sort").val();
        let url = `<?=base_url()?>admin/products-grid-list?limit=${limit}&page=${page}&search=${search}&max=${max}&min=${min}&sort=${sort}`;
        if(min > 0 && max > 0 && min > max) {
            swal("Error", "Harga minmal harus lebih kecil dari hara maksimal", "error");
            return;
        }
        setContentLoader(".product-list");
        loadContent(encodeURI(url), ".product-list");
    }

    firstLoad();

    function changePage(page) {
       
        const limit = $("#limit").val();
        const search = $("#search").val();
        const max = $("#max").val();
        const min = $("#min").val();
        const sort = $("#sort").val();
        let url = `<?=base_url()?>admin/products-grid-list?limit=${limit}&page=${page}&search=${search}&max=${max}&min=${min}&sort=${sort}`;
        if (search) url = `${url}&search=${search}`;

        if(min > 0 && max > 0 && min > max) {
            swal("Error", "Harga minmal harus lebih kecil dari hara maksimal", "error");
            return;
        }
        setContentLoader(".product-list");
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

    $(document.body).on("click", ".action-delete-grid", function (e) {
        const element = $(this);
        const url = element.data("url");
        const message = element.data("message");
        const page = element.data("page");

        swal(
            { 
            title: "Hapus",
            text: message,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya, Hapus!",
            closeOnConfirm: false,
            },
            function () {
            reqJson(url, "GET", {}, (err, response) => {
                if (response) {
                if (!$.isEmptyObject(response.errors)) {
                    swal("Oops..!", response.errors, "error");
                } else {
                    swal.close();
                    changePage(page);
                }
                } else {
                console.log("Error: ", err);
                }
            });
            }
        );
    });

    function stock(productId, productName) {
        $("#modal_basic").modal("show");
        $(".modal-title").html(`Update ${productName}`);
        const url = "<?=base_url()?>admin/products/"+productId+"/stock";
        setContentLoader(".modal-body");
        loadContent(url, ".modal-body");
    }

    function fav(productId, productName, page, favorite) {
        
        const data = {
            productId: productId,
            fav: favorite === 1 ? 0 : 1,
        }

        swal(
            { 
            title: "Hapus",
            text: `Jadikan produk ${productName} sebagai produk unggulan ?`,
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Ya",
            closeOnConfirm: false,
            },
            function () {
            reqJson("<?=base_url("admin/products/fav")?>", "POST", data, (err, response) => {
                if (response) {
                    swal("Sukses", response.message, "success");
                    changePage(page);
                } else {
                    console.log("Error: ", err);
                }
            });
            }
        );
    }

</script>
<style>
    .img {
        width: 100%;
        height: 150px;
    }
</style>