<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Kategori Produk</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left go-back"></span> Kategori Produk</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
    <div class="row">
        <div class="col-md-8 upper">
            <div class="col-1">
                <div class="card" onclick="setCategories('<?=$store_categories[0]->id?>')"
                    style="
                        background: url('<?=base_url("assets/images/store_categories/{$store_categories[0]->icon}")?>');
                        background-size: cover;
                    ">
                </div>

                <div class="overlay">
                    <p>450 x 180</p>
                    <p><?=$store_categories[0]->name?></p>
                </div>
            </div>

            <div class="col-2">
                <div class="card" onclick="setCategories('<?=$store_categories[1]->id?>')"
                    style="
                        background: url('<?=base_url("assets/images/store_categories/{$store_categories[1]->icon}")?>');
                        background-size: cover;
                    ">
                </div>
                <div class="overlay">
                    <p>260 x 220</p>
                    <p><?=$store_categories[1]->name?></p>
                </div>
            </div>
        </div>
        <div class="col-md-8 lower">
            <div class="col-2">
                <div class="card" onclick="setCategories('<?=$store_categories[2]->id?>')"
                    style="
                        background: url('<?=base_url("assets/images/store_categories/{$store_categories[2]->icon}")?>');
                        background-size: cover;
                    ">
                </div>
                <div class="overlay">
                    <p>260 x 220</p>
                    <p><?=$store_categories[2]->name?></p>
                </div>
            </div>

            <div class="col-1">
                <div class="card" onclick="setCategories('<?=$store_categories[3]->id?>')"
                    style="
                        background: url('<?=base_url("assets/images/store_categories/{$store_categories[3]->icon}")?>');
                        background-size: cover;
                    ">
                </div>
                <div class="overlay">
                    <p>450 x 180</p>
                    <p><?=$store_categories[3]->name?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 right-desk">
            <div class="card2" onclick="setCategories('<?=$store_categories[4]->id?>')"
                style="
                        background: url('<?=base_url("assets/images/store_categories/{$store_categories[4]->icon}")?>');
                        background-size: cover;
                    ">
            </div>
            <div class="overlay">
                <p>360 x 420</p>
                <p><?=$store_categories[4]->name?></p>
            </div>
        </div>
    </div>
</div>

<script>
    function setCategories(id) {
        $("#modal_basic").modal("show");
        $(".modal-title").html(`Category on store`);
        const url = '<?=base_url()?>admin/set-shop-categories/'+id;
        loadContent(url, ".modal-body");
    }
</script>

<style>
    .overlay {
        background: rgba(0,0,0,0.5);
        position: absolute;
        top: 0;
        color: #fff;
        padding: 10px;
        border-bottom-right-radius: 20px;
    }

    .card {
        height: 180px;
        width: 100%;
        cursor: pointer;
        color: yellow;
        font-size: 16px;
        padding: 5px;
    }

    .card2 {
        height: 370px;
        width: 100%;
        cursor: pointer;
        color: yellow;
        font-size: 16px;
        padding: 5px;
    }

    .upper {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .right-desk {
        margin-top: -180px;
    }

    .lower {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    .col-1 {
        width: 80%;
        margin-right: 5px;
    }

    .col-2 {
        width: 20%;
        margin-right: 5px;
    }

    @media (max-width: 991px) {
        .right-desk {
            margin-top: 0;
        }
    }
</style>