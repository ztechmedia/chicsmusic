<script>
    function addQty(productId, sst, number = 0) {
        const data = {
            product_id: productId,
            qty: parseInt($(sst).val()) + number
        }

        const url = "<?=base_url("addqty")?>";
        if($(sst).val() > 1) {
            reqJson(url, "POST", data, (err, response) => {
                if(response) {
                    if(response.success) {
                        $(`#sub-${response.product_id}`).html(response.subtotal);
                        $("#total").html(response.total);
                    } else {

                    }
                } else {
                    console.log("Error: ", err);
                }
            });
        }
    }
</script>