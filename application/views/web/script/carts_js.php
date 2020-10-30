<script>
    function addQty(productId, sst) {
        console.log(parseInt($(sst).val()));
        const data = {
            product_id: productId,
            qty: parseInt($(sst).val())
        }

        const url = "<?=base_url("addqty")?>";
        if($(sst).val() >= 1) {
            reqJson(url, "POST", data, (err, response) => {
                if(response) {
                    if(response.success) {
                        $(`#sub-${response.product_id}`).html(response.subtotal);
                        $("#total").html(response.total);
                    }
                } else {
                    console.log("Error: ", err);
                }
            });
        }
    }
</script>