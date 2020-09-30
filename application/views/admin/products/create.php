<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a class="link-to" data-to="<?=base_url("admin/products")?>">Produk</a></li>
    <li class="active">Tambah Data</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left go-back"></span> Tambah Produk</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Form Produk</h3>
                </div>
                
                <div class="block push-up-10">
                    <div id="dropzone-products" class="dropzone dropzone-mini"></div>
                    <span class="help-block form-error" id="products-error"></span>
                </div>

                <form id="validate" role="form" class="form-horizontal action-submit-create"
                    data-action="<?=base_url("admin/products/$id/add")?>" action="javascript:(0)">
                    <div class="panel-body">
                        <?php $data['product'] = null; $this->load->view('admin/products/form', $data)?>
                    </div>
                    <div class="panel-footer">
                        <div class="btn-group pull-right">
                            <button  class="btn btn-primary save">Simpan</button>
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
        url: "<?=base_url("admin/products/$id/uploads")?>",
        maxFilesize: 5,
        acceptedFiles: "image/*",
        dictInvalidFileType: "Type file ini tidak dizinkan",
        addRemoveLinks: true,
        autoDiscover: false
    });

    myDropzone.on("sending", function (a, b, c) {
        a.id = "<?="photo_".$id."_".genUnique(5)?>";
        c.append("id", a.id);
    });

    myDropzone.on("removedfile", function (a) {
        $.ajax({
            type: "post",
            data: {
                id: a.id
            },
            url: "<?=base_url("admin/products/$id/removeUpload")?>",
            cache: false,
            dataType: 'json',
            success: function (response) {
                console.log(response.message);
            },
            error: function (err) {
                console.log("Error: ", err.message);
            }
        });
    });

    toRp("#price");
    formValidation(".action-submit-create", myDropzone);
</script>