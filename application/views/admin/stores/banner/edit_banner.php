<div class="row">

    <div class="col-md-12">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body panel-body-image">
                    <img class="img" src="<?=base_url("assets/images/products/$covers[0]")?>" alt="Banner produk" />
                </div>
                <div class="panel-body">
                    <h6><?=toRp($banner->price)?></h6>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <h3><?=max_length($banner->product_name, 30)?></h3>
            <p>Stock: <?=$banner->stock?> </p>
            <p>Terjual: <?= 0; ?> </p>
        </div>
    </div>

    <div class="col-md-12">
        <form id="validate" role="form" class="form-horizontal action-submit-modal"
            action="javascript:(0)">
            
            <div class="form-group">
                <label class="col-md-3 control-label">Title banner</label>
                <div class="col-md-9">
                    <input name="name" id="name" type="text" class="validate[required,maxSize[150]] form-control" value="<?=$banner->name?>" />
                    <span class="help-block form-error" id="name-error"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Deskripsi</label>
                <div class="col-md-9">
                    <textarea name="description" id="description" type="text" class="validate[required] form-control"><?=$banner->description?></textarea>
                    <span class="help-block form-error" id="description-error"></span>
                </div>
            </div>

            <div class="btn-group pull-right">
                <button  class="btn btn-primary save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<style>
    .img-list {
        width: 100px;
        height:100px;
    }
</style>

<script>
    $(".action-submit-modal").on("submit", function(e) {
        e.preventDefault();
        const element = $(this);
        const data = {
            name: $("#name").val(),
            description: $("#description").val()
        }
        const url = "<?=base_url("admin/update-banners/$banner->id")?>";
        reqJson(url, "POST", data, (err, response) => {
            if(response) {
                swal("Sukses", response.message, "success");
                loadContent("<?=base_url("admin/banners")?>", ".content");
                $("#modal_basic").modal("hide");
            }
        })
    })
</script>