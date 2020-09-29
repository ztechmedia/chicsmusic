<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Roles</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2>Roles</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Tabel Roles</h3>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered" id="roles">
                        <thead>
                            <th width="8%">No</th>
                            <th>Nama</th>
                            <th>Nama tampilan</th>
                            <th width="11%">Tindakan</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<script>
    $(document).ready(() => {
        let url = "<?=base_url('admin/roles-table')?>";
        let csrfTokenName = "<?=$this->security->get_csrf_token_name()?>";
        let getCsrfHash = "<?=$this->security->get_csrf_hash()?>";

        datatables("#roles", url, csrfTokenName, getCsrfHash, [
            {
                data: "no",
            },
            {
                data: "name",
            },
            {
                data: "display_name",
            },
            {
                data: 'actions'
            }
        ]);
    });
</script>