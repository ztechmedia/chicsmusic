<script>
    const address_link = $("#address-tab");
    const account_link = $("#account-tab");
    const order_link = $("#order-tab");

    let address_id = null;
    let bank_id = null;
    let total_cost = null;
    let timer;

    function detailAddress() {
        const addressId = $("#address_id").val();
        const url = `<?=base_url()?>address/${addressId}/detail`;
        loadContent(url, "#address-detail");
        if(addressId !== "address" || addressId !== undefined) {
            address_id = addressId;
            account_link.attr("data-toggle", "tab");
            account_link.removeAttr("style");
            setTimeout(() => {
                account_link.click();
            }, 500);
        }else{
            address_id = null;
            account_link.css("background", "#ccc");
            account_link.removeAttr("data-toggle");
            bank_id = null;
            order_link.css("background", "#ccc");
            order_link.removeAttr("data-toggle");
            $(".bank-active").removeClass("bank-active");
        }
    }

    function getAccount(bankId, element) {
        $(".bank-active").removeClass("bank-active");
        $(element).addClass("bank-active");
        bank_id = bankId;
        order_link.attr("data-toggle", "tab");
        order_link.removeAttr("style");
        const addressId = $("#address_id").val();
        loadContent(`<?=base_url()?>address/${addressId}/detail`, "#address-detail-order");
        loadContent(`<?=base_url()?>bank/${bankId}/detail`, "#address-detail-bank");
        setTimeout(() => {
            order_link.click();
            checkOngkir('jne');
        }, 500);
    }

    function checkOngkir(code) {
        $("#ongkir").html("Loading...");
        $("#totalall").html("Loading...");
        const addressId = $("#address_id").val();
        const totalsub = $("#totalsub").val();
        loadContent(`<?=base_url()?>ongkir/${addressId}/${totalsub}/${code}`, "#ongkir");
        timer = setInterval(() => {
            checkTotal();
        }, 1000);
    }

    function checkTotal() {
        const total = $("#cost").val();
        let totalfix = "Loading...";
        if(total !== undefined) {
            clearInterval(timer);
            totalfix = total.split(":");
            total_cost = total;
            $("#totalall").html(totalfix[2]);

        }
    }

    function checkout() {
        const data = {
            addressId: address_id,
            bankId: bank_id,
            total_cost: total_cost
        }

        if(address_id !== null && bank_id !== null && total_cost.length > 0) {
            reqJson("<?=base_url("checkout/pay")?>", "POST", data, (err, response) => {
                if(response) {
                    swal("Sukses", response.message, "success");
                    window.location = "<?=base_url("carts")?>";
                }else{
                    console.log("Error: ", err);
                }
            });
        }else{
            swal("Oopss..", "Cob lagi ketika semua data sudah di load", "warning");
        }        
    }
</script>