<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Pemesanan</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-money"></span> Pemesanan</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Tabel Pemesanan</h3>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered" id="users">
                        <thead>
                            <th width="8%">No</th>
                            <th>Nama Pembeli</th>
                            <th>Kurir</th>
                            <th>Layanan Kurir</th>
                            <th>Ongkos Kirim</th>
                            <th>Bank Penerima</th>
                            <th>No. Rek</th>
                            <th>Atas Nama</th>
                            <th>Kota Penerima</th>
                            <th>Total</th>
                            <th width="10%">Tindakan</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<style>
    .btnContainer {
        margin-bottom: 10px;
    }
</style>

<script>
    $(document).ready(() => {
        let url = "<?=base_url('admin/orders-table')?>";
        let csrfTokenName = "<?=$this->security->get_csrf_token_name()?>";
        let getCsrfHash = "<?=$this->security->get_csrf_hash()?>";

        datatables("#users", url, csrfTokenName, getCsrfHash, [
            {
                data: "no",
            },
            {
                data: "member_name",
            },
            {
                data: "courier",
            },
            {
                data: "service",
            },
            {
                data: "delivery_cost",
            },
            {
                data: "bank_name",
            },
            {
                data: "account",
            },
            {
                data: "owner",
            },
            {
                data: "regency_name",
            },
            {
                data: "total",
            },
            {
                data: 'actions'
            }
        ]);
    });
</script>