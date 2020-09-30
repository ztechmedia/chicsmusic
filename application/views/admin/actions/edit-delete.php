<span title="edit" class="action-edit badge badge-info link-to" data-to="<?=base_url("admin/$table/$data->id/edit")?>">
    <i class="fa fa-pencil-square-o"></i>
</span>

<span title="delete" class="action-delete badge badge-danger"
    data-url="<?=base_url("admin/$table/$data->id/delete")?>"
    data-message="<?=$delete_message?>">
    <i class="fa fa-trash-o"></i>
</span>