<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li class="active">Users</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-users"></span> Users</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Tabel Users</h3>
                </div>

                <div class="panel-body">
                    <div class="btnContainer">
                        <button class="btn btn-default btn-rounded link-to" data-to="<?=base_url("users/create")?>">
                            <i class="fa fa-user"></i> Tambah User
                        </button>
                    </div>
                    <table class="table table-bordered" id="users">
                        <thead>
                            <th width="8%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Dibuat</th>
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
        let url = "<?=base_url('users-table')?>";
        let csrfTokenName = "<?=$this->security->get_csrf_token_name()?>";
        let getCsrfHash = "<?=$this->security->get_csrf_hash()?>";

        datatables("#users", url, csrfTokenName, getCsrfHash, [
            {
                data: "no",
            },
            {
                data: "name",
            },
            {
                data: "email",
            },
            {
                data: "createdAt",
            },
            {
                data: 'actions'
            }
        ]);
    });
</script>