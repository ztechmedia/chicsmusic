<div class="form-group">
    <label class="col-md-3 control-label">Nama Pemilik</label>
    <div class="<?=$bank ? "col-md-9" : "col-md-6"?>">
        <input name="owner" id="owner" type="text" class="validate[required,maxSize[30]] form-control"
            value="<?=$bank ? $bank->owner : ""?>" />
        <span class="help-block form-error" id="owner-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">No. Rekening</label>
    <div class="<?=$bank ? "col-md-9" : "col-md-6"?>">
        <input name="account" id="account" type="number" class="validate[required,maxSize[20]] form-control"
            value="<?=$bank ? $bank->account : ""?>" />
        <span class="help-block form-error" id="account-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Nama Bank</label>
    <div class="<?=$bank ? "col-md-9" : "col-md-6"?>">
        <input name="bank_name" id="bank_name" type="text" class="validate[required,maxSize[20]] form-control"
            value="<?=$bank ? $bank->bank_name : ""?>" />
        <span class="help-block form-error" id="bank_name-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Icon</label>
    <div class="<?=$bank ? "col-md-9" : "col-md-6"?>">
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