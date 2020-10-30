<script>
    function getCity(provinceId) {
        $("#district_id").html("<option value=''>Pilih Kecamatan</option>");
        $("#village_id").html("<option value=''>Pilih Kelurahan</option>");

        const data = {
            provinceId: provinceId
        }
        reqJson("<?=base_url("address/regency")?>", "POST", data, (err, response) => {
            if(response) {
                $("#regency_id").html(response.view);
            }else{
                console.log("Error: ", err);
            }
        });
    }

    function getDistrict(regencyId) {
        $("#village_id").html("<option value=''>Pilih Kelurahan</option>");
        const data = {
            regencyId: regencyId
        }
        reqJson("<?=base_url("address/district")?>", "POST", data, (err, response) => {
            if(response) {
                $("#district_id").html(response.view);
            }else{
                console.log("Error: ", err);
            }
        });
    }

    function getVillage(districtId) {
        loadContent("<?=base_url()?>address/village/"+districtId, "#village_id");
    }

    $(".address-action").on("submit", function(e) {
        e.preventDefault();
        const element = $(this);
        const action = element.data("action");
        const data = new FormData(this);

        reqFormData(action, "POST", data, (err, response) => {
            if(response) {
                if(response.success) {
                    if(!response.update) {
                        $(".form-error").html('');
                        $(".address-action").trigger("reset");
                        swal("Sukses", response.message, "success");
                    }else{
                        swal("Sukses", response.message, "success");
                        setTimeout(() => {
                            window.location = "<?=base_url("profile/address")?>";
                        }, 500);
                    }
                }else{
                    $.each(response.errors, function (key, value) {
                        $(`#${key}-error`).html(value);
                    });
                }
            }else{
                console.log("Error: ", err);
            }
        })
    });
</script>