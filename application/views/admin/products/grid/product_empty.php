<div class="row">
    <div class="col-md-12">
        <div class="error-container">
            <div class="error-code">Oopps..!</div>
            <div class="error-text">Produk masih kosong</div>
            <div class="error-subtext">Oopss..! sepertinya kamu belum menambahkan data produk, silakan klik tombol
                dibawah ini ya</div>
            <div class="error-actions">
                <div class="row">
                    <div class="col-md-12 center">
                        <button class="btn btn-info btn-block link-to-with-prev btn-rounded"
                            data-to="<?=base_url("admin/products/create")?>">Tambah Produk</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .center {
        display: flex;
        flex-direction: flex-start;
        justify-content: center;
        align-items: center;
    }

    .center button {
        width: 30%;
    }

    .error-text {
        margin-top: 50px !important;
    }
</style>