<div class="form-group">
    <label class="col-md-3 control-label">Nama</label>
    <div class="col-md-6">
        <input name="name" type="text" class="validate[required,maxSize[30]] form-control" value="<?=$user ? $user->name : ""?>" />
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">Email</label>
    <div class="col-md-6">
        <input name="email" id="email" type="text" class="validate[required,custom[email]],maxSize[50]] form-control" value="<?=$user ? $user->email : ""?>" />
        <span class="help-block form-error" id="email-error"></span>
    </div>
</div>

<!-- Password just for create -->
<?php if (!$user) {?>
<div class="form-group">
    <label class="col-md-3 control-label">Password</label>
    <div class="col-md-6">
        <input type="password" class="validate[required,minSize[6],maxSize[10]] form-control" name="password"
            id="password" />
        <span class="help-block">Required (min: 6, max: 10)</span>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">Konfirmasi Password:</label>
    <div class="col-md-6">
        <input type="password" class="validate[required,equals[password]] form-control" />
    </div>
</div>
<?php }?>

<div class="form-group">
    <label class="col-md-3 control-label">Role</label>
    <div class="col-md-6">
        <select class="validate[required] select" name="role" id="role">
            <option value="">Pilih Role</option>
            <?php foreach ($roles as $role) {
                $selected = null;
                if ($user && $role->id === $user->role) {
                    $selected = 'selected';
                }
                echo "<option $selected value=" . $role->id . " >$role->display_name</option>";
            }?>
        </select>
    </div>
</div>