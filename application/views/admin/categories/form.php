<div class="form-group">
    <label class="col-md-3 control-label">Nama</label>
    <div class="col-md-6">
        <input name="name" id="name" type="text" class="validate[required,maxSize[30]] form-control"
            value="<?=$category ? $category->name : ""?>" />
        <span class="help-block form-error" id="name-error"></span>
    </div>
</div>