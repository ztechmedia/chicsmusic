<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Daftar Rekening</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-filter"></span> Daftar Rekening</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Data Rekening</h3>
                </div>

                <div class="panel-body">
                    <div class="btnContainer">
                        <button class="btn btn-default btn-rounded link-to" data-to="<?=base_url("admin/banks/create")?>">
                            <i class="fa fa-filter"></i> Tambah Rekening
                        </button>
                    </div>
                    <table class="table table-bordered" id="bank">
                        <thead>
                            <th width="8%">No</th>
                            <th>Pemilik</th>
                            <th>No. Rek</th>
                            <th>Nama BANK</th>
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
        let url = "<?=base_url('admin/banks-table')?>";
        let csrfTokenName = "<?=$this->security->get_csrf_token_name()?>";
        let getCsrfHash = "<?=$this->security->get_csrf_hash()?>";

        datatables("#bank", url, csrfTokenName, getCsrfHash, [
            {
                data: "no",
            },
            {
                data: "owner",
            },
            {
                data: "account",
            },
            {
                data: "bank_name",
            },
            {
                data: 'actions'
            }
        ]);
    });
</script>