<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a class="link-to" data-to="<?=base_url("roles")?>">Roles</a></li>
    <li class="active">Edit Data</li>
</ul>
<!-- END BREADCRUMB -->

<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left link-to" data-to="<?=base_url("roles")?>"></span> Update Data Role</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Form Role</h3>
                </div>
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("roles/$role->id/update")?>" data-redirect="<?=base_url("roles")?>"
                    data-target=".content" action="javascript:(0)">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama</label>
                            <div class="col-md-6">
                                <input name="name" type="text" class="validate[required,maxSize[15]] form-control"
                                    value="<?=$role->name?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nama tampilan</label>
                            <div class="col-md-6">
                                <input name="display_name" type="text"
                                    class="validate[required,maxSize[30]] form-control"
                                    value="<?=$role->display_name?>" />
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary save" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- END PAGE CONTENT WRAPPER -->

<script>
    formSelect();
    formValidation(".action-submit-update");
</script>