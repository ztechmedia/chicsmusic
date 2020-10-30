<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a class="link-to" data-to="<?=base_url("admin/brands")?>">Daftar Merek</a></li>
    <li class="active">Tambah Data</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left link-to" data-to="<?=base_url("admin/brands")?>"></span> Tambah Merek</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Form Merek</h3>
                </div>
                <form id="validate" role="form" class="form-horizontal action-submit-create"
                    data-action="<?=base_url("admin/brands/add")?>" action="javascript:(0)">
                    <div class="panel-body">
                        <?php $data['brand'] = null; $this->load->view('admin/brand/form', $data)?>
                    </div>
                    <div class="panel-footer">
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary save" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<script>
    formValidation(".action-submit-create"); 
</script>