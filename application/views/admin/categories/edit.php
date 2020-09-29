<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a class="link-to" data-to="<?=base_url("admin/categories")?>">Kategori</a></li>
    <li class="active">Edit Data</li>
</ul>
<!-- END BREADCRUMB -->

<!-- PAGE CONTENT WRAPPER -->
<div class="content-frame">
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-arrow-circle-o-left link-to" data-to="<?=base_url("admin/categories")?>"></span>
                Update Kategori
            </h2>
        </div>
        <button class="btn btn-default content-frame-right-toggle pull-right"><span class="fa fa-bars"></span></button>
    </div>

    <div class="content-frame-right" style="height: 100vh">
        
        <h4>Icon saat ini: </h4>
        <div class="form-group categories-icon">
            <div class="gallery" id="links">
                <a class="gallery-item" 
                    href="<?= 
                        $category->icon ? 
                            base_url("assets/images/categories/$category->icon") : 
                            base_url("assets/images/no_image200.jpg")?>" 
                    title="<?=$category->icon?>"
                    data-gallery>

                    <div class="image">
                        <?php if($category->icon){ ?>
                            <img class="img" src="<?=base_url("assets/images/categories/$category->icon")?>" alt="<?=$category->icon?>" />
                            <ul class="gallery-item-controls">
                                <li><span class="gallery-item-remove"><i class="fa fa-times"></i></span></li>
                            </ul>
                        <?php } else { ?>
                            <img class="img" src="<?=base_url("assets/images/no_image200.jpg")?>" alt="Category Icon" />
                        <?php } ?>
                        
                    </div>  
                </a>
            </div>
        </div>
        
    </div>
    
    <div class="content-frame-body content-frame-body-left">
        <div class="row">
            <div class="col-md-12">
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("admin/categories/$category->id/update")?>"
                    data-redirect="<?=base_url("admin/categories")?>" data-target=".content" action="javascript:(0)">
                    <?php $data['category'] = $category; $this->load->view('admin/categories/form', $data)?>
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
    $(".gallery-item-remove").on("click", function () {
        const element = $(this);
        deletePhoto(null, "<?=base_url("admin/categories/$category->id/removeUpload")?>");
        $(this)
            .parents(".categories-icon")
            .fadeOut(400, function () {
                $(this).remove();
            });
        return false;
    });

    $(".content-frame-right-toggle").on("click", function () {
        $(".content-frame-right").is(":visible")
        ? $(".content-frame-right").hide()
        : $(".content-frame-right").show();
        page_content_onresize();
    });

    formValidation(".action-submit-update");
</script>

<style>
    .gallery .gallery-item {
        width: 100%;
    }

    .img {
        height: 100%;
    }
</style>