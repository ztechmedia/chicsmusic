<div class="review_box review_box_custom">
    <h4>Balas Komentar</h4>
    <form class="row contact_form post-action" action="javascript:(0)" role="form" id="contactForm"
        novalidate="novalidate" data-action="<?=base_url("post-reply-comment/$comment_id/reply/$product_id")?>">

        <div class="col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" placeholder="Alamat Email">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control" name="comment" id="comment" rows="1" placeholder="Komentar"></textarea>
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

        reqFormData(action, "POST", data, (err, response) => {
            if (response.success) {
                $(`#${response.comment_id}`).html('');
                commentList();
            } else {
                console.log("Error: ", err);
            }
        })
    });
</script>