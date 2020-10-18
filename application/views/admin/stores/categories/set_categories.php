<div class="row">
    <div class="col-md-12">
        <form role="form" class="form-horizontal action-submit-modal" action="javascript:(0)">

            <div class="form-group">
                <label class="col-md-3 control-label">Title kategori</label>
                <div class="col-md-9">
                    <input value="<?=$storeCategory->name?>" name="name" id="name" type="text" class="validate[required,maxSize[150]] form-control" />
                    <span class="help-block form-error" id="name-error"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Link</label>
                <div class="col-md-9">
                    <input value="<?=$storeCategory->redirect?>" name="redirect" id="redirect" type="text" readonly
                        class="validate[required,maxSize[150]] form-control" />
                    <span class="help-block form-error" id="redirect-error"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Icon</label>
                <div class="col-md-6">
                    <input name="file" id="file" type="file" class="form-control" />
                    <span class="help-block form-error" id="file-error"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <div class="panel panel-default tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active"><a href="#tab2" data-toggle="tab">Subkategori</a></li>
                        </ul>
                        <div class="panel-body tab-content">
                            <div class="tab-pane active" id="tab2">
                                <div class="panel-body list-group list-group-contacts" style="height: 200px; overflow-y: scroll">
                                    <?php foreach ($subcategories as $subcategory) { ?>
                                        <a onclick="genSubcategories('<?=$subcategory->id?>')" class="list-group-item">
                                            <div class="list-group-status status-online"></div>
                                            <img src="<?=base_url("assets/images/subcategories/$subcategory->icon")?>" class="pull-left"
                                                alt="Brad Pitt" />
                                            <span class="contacts-title"><?=$subcategory->name?></span>
                                            <p>asdasd</p>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-group pull-right">
                <button class="btn btn-primary save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<style>
    #redirect {
        color: #000;
    }
</style>

<script>
    $("#file").fileinput({
        showUpload: false,
        showCaption: false,
        browseClass: "btn btn-primary",
        fileType: "any"
    });

    function genCategories(categoryId) {
        const url = `<?=base_url()?>products?categories=${categoryId}`;
        $("#redirect").val(url);
    }

    function genSubcategories(subcategoryId) {
        const url = `<?=base_url()?>products?subcategories=${subcategoryId}`;
        $("#redirect").val(url);
    }

    $(".action-submit-modal").on("submit", function(e) {
        e.preventDefault();
        $(".save").html("Loading...");
        $(".form-error").html('');

        const data = new FormData(this);

        const url = "<?=base_url("admin/update-shop-categories/$id")?>";

        reqFormData(url, "POST", data, (err, response) => {
            if(response) {
                if (!$.isEmptyObject(response.errors)) {
                    $.each(response.errors, function (key, value) {
                        $(`#${key}`).addClass("error");
                        $(`#${key}-error`).html(value);
                    });
                }else{
                    swal("Sukses", response.message, "success");
                    loadContent("<?=base_url("admin/shop-categories")?>", ".content");
                    $("#modal_basic").modal("hide");
                }
            }
            $(".save").html("Simpan");
        })
    })
</script>