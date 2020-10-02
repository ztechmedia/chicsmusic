<div class="stock-center">
    <ul class="pagination pagination-lg">
        <li><a onclick="decrease(30)">-30</a></li>
        <li><a onclick="decrease(15)">-15</a></li>
        <li><a onclick="decrease(5)">-5</a></li>
        <li class="active"><a class="pointer" onclick="decrease(1)">-</a></li>
        <li class="active"><a id="stock"><?=$product->stock?></a></li>
        <li class="active"><a class="pointer" onclick="increase(1)">+</a></li>
        <li><a onclick="increase(5)">+5</a></li>
        <li><a onclick="increase(15)">+15</a></li>
        <li><a onclick="increase(30)">+30</a></li>
    </ul>
</div>

<script>
    let stock = <?=$product->stock?>;

    function decrease(min) {
        if((stock - min) >= 0) {
            stock -= min;
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
    }

    function increase(add) {
        stock += add;
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
</script>

<style>
    .pagination {
        display: flex;
        justify-content: center;
    }

    #stock {
        color: #fa6d03;
    }
</style>