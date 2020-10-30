<div class="review_box review_box_custom">
    <h4>Balas Komentar</h4>
    <form class="row contact_form post-action" action="javascript:(0)" role="form" id="contactForm"
        novalidate="novalidate" data-action="<?=base_url("post-reply-comment/$comment_id/reply/$product_id")?>">

        <div class="col-md-12">
            <div class="form-group">
                <input readonly="<?=isset($member)?>" value="<?= isset($name) ? $name : "" ?>" type="text" class="form-control" id="name" name="name" placeholder="Nama">
                <span id="name-error" class="form-error"></span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <input readonly="<?=isset($member)?>" value="<?= isset($email) ? $email : "" ?>" type="email" class="form-control" id="email" name="email" placeholder="Alamat Email">
                <span id="email-error" class="form-error"></span>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control" name="comment" id="comment" rows="1" placeholder="Komentar"></textarea>
                <span id="comment-error" class="form-error"></span>
            </div>
        </div>
        <input style="display:none" type="text" class="form-control" id="status" name="status" value="reply">
        <div class="col-md-12 text-right">
            <button type="submit" value="submit" class="btn primary-btn">Kirim</button>
        </div>
    </form>
</div>

<script>
    $(".post-action").on("submit", function (e) {
        e.preventDefault();
        const element = $(this);
        const action = element.data("action");
        const data = new FormData(this);
        $(".form-error").html("");

        reqFormData(action, "POST", data, (err, response) => {
            if (response) {
                if(response.success) {
                    $(`#${response.comment_id}`).html('');
                    commentList();
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