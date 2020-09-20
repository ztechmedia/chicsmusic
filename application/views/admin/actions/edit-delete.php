<span title="edit" class="action-edit badge badge-info" data-url="<?=base_url("$table/$data->id/edit")?>"
    data-target=".content">
    <i class="fa fa-pencil-square-o"></i>
</span>

<span title="delete" class="action-delete badge badge-danger" data-id="<?=$data->id?>"
    data-url="<?=base_url("$table/$data->id/delete")?>" data-type="GET"
    data-message="<?=$delete_message?>">
    <i class="fa fa-trash-o"></i>
</span>