<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a class="link-to" data-to="<?=base_url("products")?>">Produk</a></li>
    <li class="active"><?= $product->name === null ? "Tambah Data" : "Edit Data"?></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="content-frame">

    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-arrow-circle-o-left link-to" data-to="<?=base_url("products")?>"></span>
                <?= $product->name === null ? "Tambah Produk" : "Update Produk"?>
            </h2>
        </div>
    </div>

    <div class="content-frame-right" style="height: 100vh">
        
        <div class="block push-up-10">
            <div id="dropzone-products" class="dropzone dropzone-mini"></div>
        </div>

        <div class="pull-right push-up-10">
            <button class="btn btn-primary btn-rounded" id="gallery-toggle-items">Toggle All</button>
        </div>

        <div class="gallery" id="links">
            <?php $no=1; $covers = unserialize($product->cover);
             foreach ($covers as $cover) { ?>

            <a class="gallery-item" href="<?=base_url("assets/images/products/$cover")?>" title="<?=$cover?>"
                data-gallery>
                <div class="image">
                    <img class="img" src="<?=base_url("assets/images/products/$cover")?>" alt="<?=$cover?>" />
                    <ul class="gallery-item-controls">
                        <li><label class="check"><input type="checkbox" class="icheckbox" /></label></li>
                        <li><span class="gallery-item-remove" data-photoid="<?=$cover?>"><i class="fa fa-times"></i></span></li>
                    </ul>
                </div>
                <div class="meta">
                    <strong><?="Foto #".$no++ ?></strong>
                </div>
            </a>

            <?php } ?>
        </div>
    </div>

    <div class="content-frame-body content-frame-body-left">
        <div class="row">
            <div class="col-md-12">
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("products/$product->id/update")?>"
                    data-redirect="<?=base_url("products")?>" data-target=".content" action="javascript:(0)">
                    <?php $data['product'] = $product; $this->load->view('admin/products/form', $data)?>
                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button class="btn btn-primary save" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END PAGE CONTENT WRAPPER -->

<script>
    const myDropzone = new Dropzone("#dropzone-products", {
        autoProcessQueue: true,
        url: "<?=base_url("products/$product->id/uploads")?>",
        maxFilesize: 5,
        acceptedFiles: "image/*",
        dictInvalidFileType: "Type file ini tidak dizinkan",
        addRemoveLinks: true,
        autoDiscover: false
    });

    myDropzone.on("sending", function (a, b, c) {
        a.id = "<?="photo_".$product->id."_".genUnique(5)?>";
        c.append("id", a.id);
    });

    myDropzone.on("removedfile", function (a) {
        eletePhoto(a.id, "<?=base_url("products/$product->id/removeUpload")?>");
    });

    $(".gallery-item .iCheck-helper").on("click", function () {
        var wr = $(this).parent("div");
        if (wr.hasClass("checked")) {
            $(this).parents(".gallery-item").addClass("active");
        } else {
            $(this).parents(".gallery-item").removeClass("active");
        }
    });

    $(".gallery-item-remove").on("click", function () {
        const element = $(this);
        const photoid = element.data("photoid");
        deletePhoto(photoid, "<?=base_url("products/$product->id/removeUpload")?>");
        $(this)
            .parents(".gallery-item")
            .fadeOut(400, function () {
                $(this).remove();
            });
        return false;
    });

    $("#gallery-toggle-items").on("click", function () {
        $(".gallery-item").each(function () {
            var wr = $(this).find(".iCheck-helper").parent("div");

            if (wr.hasClass("checked")) {
                $(this).removeClass("active");
                wr.removeClass("checked");
                wr.find("input").prop("checked", false);
            } else {
                $(this).addClass("active");
                wr.addClass("checked");
                wr.find("input").prop("checked", true);
            }
        });
    });

    if ($(".icheckbox,.iradio").length > 0) {
        $(".icheckbox,.iradio").iCheck({
            checkboxClass: "icheckbox_minimal-grey checked",
            radioClass: "iradio_minimal-grey",
        });
    }

    toRp("#price");
    const name = "<?=$product->name?>";
    if(name) {
        checkNestedSelect(
        "#subcategory_id",
        "<?=base_url("categories/$product->category_id/subcategories/list")?>",
        "Pilih Subkategori",
        "<?=$product->subcategory_id?>");
    }
    formValidation(".action-submit-update");
</script>

<style>
    .gallery .gallery-item {
        width: 50%;
    }

    .img {
        width: 100%;
        height: 150px;
    }
</style>