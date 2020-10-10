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
                <div class="card" onclick="setCategories(1)">
                    450 x 180
                </div>
            </div>

            <div class="col-2">
                <div class="card" onclick="setCategories(2)">
                    260 x 220
                </div>
            </div>
        </div>
        <div class="col-md-8 lower">
            <div class="col-2">
                <div class="card" onclick="setCategories(3)">
                    260 x 220
                </div>
            </div>

            <div class="col-1">
                <div class="card" onclick="setCategories(4)">
                    450 x 180
                </div>
            </div>
        </div>
        <div class="col-md-4 right-desk">
            <div class="card2" onclick="setCategories(5)">
                360 x 420
            </div>
        </div>
    </div>
</div>

<script>
    function setCategories(position) {
        alert(position);
    }
</script>

<style>
    .card {
        height: 180px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        cursor: pointer;
        color: #fff;
        font-size: 16px;
        padding: 5px;
    }

    .card2 {
        height: 370px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        cursor: pointer;
        color: #fff;
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