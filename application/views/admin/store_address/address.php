<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a class="link-to" data-to="<?=base_url("admin/store-address")?>">Alamat Toko</a></li>
    <li class="active">Edit Data</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2>Update Alamat Toko</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Form Alamat Toko</h3>
                </div>
                <form id="validate" role="form" class="form-horizontal store-address-action"
                    action="javascript:(0)"
                    data-action="<?=base_url("admin/store-address/update")?>">
                    <div class="panel-body">
                    
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Toko</label>
                            <div class="col-md-6">
                                <input name="store_name" type="text" class="validate[required,maxSize[30]] form-control" value="<?=$address->store_name?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama Toko</label>
                            <div class="col-md-6">
                                <textarea name="address" class="validate[required,maxSize[300]] form-control"><?=$address->address?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Provinsi</label>
                            <div class="col-md-6">
                                <select class="validate[required] select form-control" name="province_id" id="province_id" onchange="getCity($(this).val())">
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach ($provinces as $province) {
                                        $selected = $province->province_id === $address->province_id ? "selected" : null;                                    
                                        echo "<option $selected value='$province->province_id'>$province->province</option>";
                                    }?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Kota</label>
                            <div class="col-md-6">
                                <select class="validate[required] select form-control" name="city_id" id="city_id">
                                    <option value="">Pilih Kota</option>
                                    <?php foreach ($cities as $city) {
                                        $selected = $city->city_id === $address->city_id ? "selected" : null;                                    
                                        echo "<option $selected value='$city->city_id'> $city->type $city->city_name</option>";
                                    }?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="panel-footer">
                        <div class="btn-group pull-right">
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
  function getCity(provinceId) {
    $("#city_id").html("<option value=''>Pilih Kota</option>");
    loadContent("<?=base_url()?>address/regency/"+provinceId, "#city_id");
  }

  $(".store-address-action").on("submit", function(e) {
      e.preventDefault();
      const element = $(this);
      const action = element.data("action");
      const data = new FormData(this);

      reqFormData(action, "POST", data, (err, response) => {
          if(response) {
              swal("Sukses", response.message, "success");
          }else{
              console.log("Error: ", err);
          }
      })
  });
</script>