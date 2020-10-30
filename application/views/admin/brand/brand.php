<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Daftar Merek</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-filter"></span> Daftar Merek</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Data Merek</h3>
                </div>

                <div class="panel-body">
                    <div class="btnContainer">
                        <button class="btn btn-default btn-rounded link-to" data-to="<?=base_url("admin/brands/create")?>">
                            <i class="fa fa-filter"></i> Tambah Merek
                        </button>
                    </div>
                    <table class="table table-bordered" id="brand">
                        <thead>
                            <th width="8%">No</th>
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
        let url = "<?=base_url('admin/brands-table')?>";
        let csrfTokenName = "<?=$this->security->get_csrf_token_name()?>";
        let getCsrfHash = "<?=$this->security->get_csrf_hash()?>";

        datatables("#brand", url, csrfTokenName, getCsrfHash, [
            {
                data: "no",
            },
            {
                data: "brand_name",
            },
            {
                data: 'actions'
            }
        ]);
    });
</script>