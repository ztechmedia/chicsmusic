<div class="stock-center">
    <ul class="pagination pagination-lg">
        <li><a id="decrease">-</a></li>
        <li class="active"><a id="stock"><?=$product->stock?></a></li>
        <li><a id="increase">+</a></li>
    </ul>
</div>

<script>
    let stock = <?=$product->stock?>;
    $("#decrease").on("click", function() {
        stock -= 1;
        if(stock > 0) {
            $("#stock").html(stock);
            const url = "<?=base_url("admin/products/$product->id/stock-update")?>";
            data = {
                stock: stock
            }

            reqJson(url, "POST", data, (err, response) => {
                if(response){
                    let page = $("#page").val();
                    changePage(page);
                }else{
                    console.log("Error:", err);
                }
            });
        }
    });

    $("#increase").on("click", function() {
        stock += 1;
        $("#stock").html(stock);
        const url = "<?=base_url("admin/products/$product->id/stock-update")?>";
        data = {
            stock: stock
        }
        reqJson(url, "POST", data, (err, response) => {
            if(response){
                let page = $("#page").val();
                changePage(page);
            }else{
                console.log("Error:", err);
            }
        }); 
    });
</script>

<style>
    .pagination {
        display: flex;
        justify-content: center;
    }
</style>