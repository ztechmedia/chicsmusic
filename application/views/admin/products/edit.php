<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a class="link-to" data-to="<?=base_url("admin/products")?>">Produk</a></li>
    <li class="active"><?= $product->name === null ? "Tambah Data" : "Edit Data"?></li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="content-frame">

    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-arrow-circle-o-left go-back"></span>
                <?= $product->name === null ? "Tambah Produk" : "Update Produk"?>
            </h2>
        </div>
    </div>

    <div class="content-frame-right" style="height: 100vh">
        
        <div class="block push-up-10">
            <div id="dropzone-products" class="dropzone dropzone-mini"></div>
        </div>

        <div class="pull-right push-up-10">
            <button class="btn btn-primary btn-rounded" id="gallery-toggle-items">Pilih Semua</button>
            <button class="btn btn-danger btn-rounded delete-covers" id="gallery-toggle-items">Hapus</button>
        </div>

        <div class="gallery" id="links">
            <?php $no=1; $covers = unserialize($product->cover);
             foreach ($covers as $cover) { ?>

                <a class="gallery-item" id="<?=$cover?>" href="<?=base_url("assets/images/products/$cover")?>" title="<?=$cover?>"
                    data-gallery>
                    <div class="image">
                        <img class="img" src="<?=base_url("assets/images/products/$cover")?>" alt="<?=$cover?>" />
                        <ul class="gallery-item-controls">
                            <li class="liCheck"><label class="check"><input type="checkbox" class="icheckbox" data-cover="<?=$cover?>" /></label></li>
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
                    data-action="<?=base_url("admin/products/$product->id/update")?>"
                    data-redirect="<?=base_url("admin/products")?>" data-target=".content" action="javascript:(0)">
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
    let cover = [];

    const myDropzone = new Dropzone("#dropzone-products", {
        autoProcessQueue: true,
        url: "<?=base_url("admin/products/$product->id/uploads")?>",
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
        eletePhoto(a.id, "<?=base_url("admin/products/$product->id/removeUpload")?>");
    });

    $(".delete-covers").on("click", () => {
        const data = {
            cover: cover
        }
        const url = "<?=base_url("admin/products/$product->id/delete-covers")?>";
        if(cover.length === 0) return swal("Oopss..!", "Pilih minimal 1 cover untuk melanjutkan", "error");
             
        swal(
            {
                title: "Hapus",
                text: "Anda yakin ingin menghapus cover yang telah dipilihs?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false,
            },
            function () {
            reqJson(url, "POST", data, (err, response) => {
                if (response) {
                    if (!$.isEmptyObject(response.errors)) {
                        swal("Oops..!", response.errors, "error");
                    } else {
                        loadContent("<?= base_url("admin/products/$product->id/edit")?>", ".content");
                        swal("Sukses", response.message, "success");
                    }
                } else {
                    console.log("Error: ", err);
                }
            });
            }
        );
    });

    $(".gallery-item-remove").on("click", function () {
        const element = $(this);
        const photoid = element.data("photoid");
        deletePhoto(photoid, "<?=base_url("admin/products/$product->id/removeUpload")?>");
        $(this)
            .parents(".gallery-item")
            .fadeOut(400, function () {
                $(this).remove();
            });
        return false;
    });

    $("#gallery-toggle-items").on("click", function () {
        $(".gallery-item").each(function () {
            let wr = $(this).find(".iCheck-helper").parent("div");
            let currentCover = wr.find("input").data("cover");
            let filteredCover;

            if (wr.hasClass("checked")) {
                $(this).removeClass("active");
                wr.removeClass("checked");
                wr.find("input").prop("checked", false);
                filteredCover = cover.filter(cvr => cvr !== currentCover);
                cover = filteredCover;
            } else {
                $(this).addClass("active");
                wr.addClass("checked");
                wr.find("input").prop("checked", true);
                cover.unshift(currentCover);
            }
        });
    });

    $(".icheckbox").on('ifChanged', function (e) {
        $(this).trigger("change", e);
        let selectedCover = $(this).data("cover");
        let filteredCover;

        if(!$(this).prop("checked")) {
            filteredCover = cover.filter(cvr => cvr !== selectedCover);
            cover = filteredCover;
        }else{
            cover.unshift(selectedCover);
        }
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
        "<?=base_url("admin/categories/$product->category_id/subcategories/list")?>",
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