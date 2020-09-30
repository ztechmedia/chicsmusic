<div class="form-group" style="display:none">
    <label class="col-md-3 control-label">Produk ID</label>
    <div class="<?= $product ? "col-md-9" : "col-md-6" ?>">
        <input readonly name="id" id="id" type="text" class="validate[required] form-control"
            value="<?=$product ? $product->id : $id ?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Nama Produk</label>
    <div class="<?= $product ? "col-md-9" : "col-md-6" ?>">
        <input name="name" id="name" type="text" class="validate[required,maxSize[120]] form-control"
            value="<?=$product ? $product->name : ""?>" />
        <span class="help-block form-error" id="name-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Harga</label>
    <div class="<?= $product ? "col-md-9" : "col-md-6" ?>">
        <input name="price" id="price" type="text" class="validate[required,maxSize[20]] form-control"
            value="<?=$product ? $product->price : "Rp. 0"?>" />
    </div>
</div>

<?php if(!$product || !$product->name) { ?>
<div class="form-group">
    <label class="col-md-3 control-label">Stock</label>
    <div class="<?= $product ? "col-md-9" : "col-md-6" ?>">
        <input name="stock" id="stock" type="number" class="validate[required,maxSize[20]] form-control" />
    </div>
</div>
<?php } ?>

<div class="form-group">
    <label class="col-md-3 control-label">Merek</label>
    <div class="<?= $product ? "col-md-9" : "col-md-6" ?>">
        <input name="brand" id="brand" type="text" class="validate[required,maxSize[20]] form-control"
            value="<?=$product ? $product->brand : ""?>" />
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Kategori</label>
    <div class="<?= $product ? "col-md-9" : "col-md-6" ?>">
        <select class="validate[required] form-control nested-select" name="category_id" id="category_id"
            data-target="#subcategory_id" data-empty="Pilih Subkategori"
            data-url="<?=base_url('admin/categories/[id]/subcategories/list')?>">
            <option value="">Pilih Kategori</option>
            <?php foreach ($categories as $category) {
                $selected = null;
                if ($product && $category->id === $product->category_id) {
                    $selected = 'selected';
                }
                echo "<option $selected value=" . $category->id . " >$category->name</option>";
            }?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Subkategori</label>
    <div class="<?= $product ? "col-md-9" : "col-md-6" ?>">
        <select class="validate[required] form-control" name="subcategory_id" id="subcategory_id">
            <option value="">Pilih Subkategori</option>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Deskripsi</label>
    <div class="<?= $product ? "col-md-9" : "col-md-6" ?>">
        <textarea rows="10" name="description" id="description" type="text"
            class="validate[required] form-control"><?=$product ? $product->description : ""?></textarea>
    </div>
</div>