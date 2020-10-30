<script>
    $(".profile-action").on("submit", function (e) {
        e.preventDefault();
        const element = $(this);
        const action = element.data("action");
        const data = new FormData(this);
        $(".form-error").html("");
        console.log("tai");
        reqFormData(action, "POST", data, (err, response) => {
            if (response) {
                if(response.success) {
                    swal("Sukses", response.message, "success");
                }else{
                    $.each(response.errors, function (key, value) {
                        $(`#${key}-error`).html(value);
                    });
                }
            } else {
                console.log("Error: ", err);
            }
        })
    });
</script>