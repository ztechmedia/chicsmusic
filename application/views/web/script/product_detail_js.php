<script>
     function addSingleProduct() {
        const product_id = "<?=$product->id?>";
        const name = "<?=$product->name?>";
        const qty = $("#sst").val();
        const price = "<?=$product->price?>";

        const stock = "<?=$product->stock?>";

        if(parseInt(qty) > parseInt(stock)) {
            alert("Stock tidak cukup");
            return
        }

        const url = "<?=base_url("addcart")?>";

        const data = {
            product_id: product_id,
            name: name,
            qty: qty,
            price: price
        }
        
        reqJson(url, "POST", data, (err, response) => {
            if(response.success) {
                checkCart();
            }else{
                console.log("Error: ", err);
            }
        });
    }

     $(".post-action").on("submit", function(e) {
        e.preventDefault();
        const element = $(this);
        const action = element.data("action");
        const data = new FormData(this);
        $(".form-error").html("");

        reqFormData(action, "POST", data, (err, response) => {
            if(response) {
                if(response.success) {
                    commentList();
                    document.getElementById("post-form").reset();
                }else{
                    $.each(response.errors, function (key, value) {
                        $(`#${key}-error-p`).html(value);
                    });
                }
            }else{
                console.log("Error: ", err);
            }
        })
    });

    function openCommentBox(commentId) {
        const url = "<?=base_url()?>open-comment-box/"+commentId;
        loadContent(url, `#${commentId}`);
    }

    function commentList() {
        const url = "<?=base_url("comment-list/$product->id")?>";
        loadContent(url, ".comment-list");
    }

    commentList();

    function reviewList() {
        const url = "<?=base_url("review-list/$product->id")?>";
        loadContent(url, ".review-list");
    }

    reviewList();

    let rating = false;

    $(document).mousemove(function(){
        
        if(rating === false) {
            if($(".rating-hover-1:hover").length != 0){
                $(".rating-hover-1").css({"color":"#fbd600"});
            }else{
                $(".rating-hover-1").css({"color":"#ccc"});
            }
        
            if($(".rating-hover-2:hover").length != 0){
                $(".rating-hover-1").css({"color":"#fbd600"});
                $(".rating-hover-2").css({"color":"#fbd600"});
            }else{
                $(".rating-hover-2").css({"color":"#ccc"});
            }

            if($(".rating-hover-3:hover").length != 0){
                $(".rating-hover-1").css({"color":"#fbd600"});
                $(".rating-hover-2").css({"color":"#fbd600"});
                $(".rating-hover-3").css({"color":"#fbd600"});
            }else{
                $(".rating-hover-3").css({"color":"#ccc"});
            }

            if($(".rating-hover-4:hover").length != 0){
                $(".rating-hover-1").css({"color":"#fbd600"});
                $(".rating-hover-2").css({"color":"#fbd600"});
                $(".rating-hover-3").css({"color":"#fbd600"});
                $(".rating-hover-4").css({"color":"#fbd600"});
            }else{
                $(".rating-hover-4").css({"color":"#ccc"});
            }

            if($(".rating-hover-5:hover").length != 0){
                $(".rating-hover-1").css({"color":"#fbd600"});
                $(".rating-hover-2").css({"color":"#fbd600"});
                $(".rating-hover-3").css({"color":"#fbd600"});
                $(".rating-hover-4").css({"color":"#fbd600"});
                $(".rating-hover-5").css({"color":"#fbd600"});
            }else{
                $(".rating-hover-5").css({"color":"#ccc"});
            }
        }
    });

    function ratingStar(star) {
        $("#star").val(star);
        rating = true;
    }

    $(".review-action").on("submit", function(e) {
        e.preventDefault();
        const element = $(this);
        const action = element.data("action");
        const data = new FormData(this);
        $(".form-error").html("");

        reqFormData(action, "POST", data, (err, response) => {
            if(response) {
                if(response.success) {
                    reviewList();
                    rating = false;
                    $(".rating-hover-1").css({"color":"#ccc"});
                    $(".rating-hover-2").css({"color":"#ccc"});
                    $(".rating-hover-3").css({"color":"#ccc"});
                    $(".rating-hover-4").css({"color":"#ccc"});
                    $(".rating-hover-5").css({"color":"#ccc"});
                    document.getElementById("reviews-form").reset();
                }else{
                    $.each(response.errors, function (key, value) {
                        $(`#${key}-error-r`).html(value);
                    });
                }
            }else{
                console.log("Error: ", err);
            }
        })
    });
</script>