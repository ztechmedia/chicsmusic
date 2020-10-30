<div class="form-group">
    <label class="col-md-3 control-label">Nama Merek</label>
    <div class="<?=$brand ? "col-md-9" : "col-md-6"?>">
        <input name="brand_name" id="brand_name" type="text" class="validate[required,maxSize[30]] form-control"
            value="<?=$brand ? $brand->brand_name : ""?>" />
        <span class="help-block form-error" id="brand_name-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Icon</label>
    <div class="<?=$brand ? "col-md-9" : "col-md-6"?>">
        <input name="file" id="file" type="file" class="form-control" />
        <span class="help-block form-error" id="file-error"></span>
    </div>
</div>

<script>
    $("#file").fileinput({
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary",
            fileType: "any"
    });  
</script>