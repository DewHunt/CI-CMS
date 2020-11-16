<div class="row">
    <input class="form-control" type="hidden" name="userId" value="<?= $userInfo->id ?>">

    <div class="col-md-4"> 
        <div class="form-group">
            <label for="role">User Role</label>
            <select class="form-control" name="role" required>
                <option value=""> Select Role</option>
                <?php foreach ($allUserRoles as $role): ?>
                	<?php
                		if ($role->id == $userInfo->role) {
                			$select = "selected";
                		} else {
                			$select = "";
                		}						                        		
                	?>
                    <option value="<?= $role->id ?>" <?= $select ?>><?= $role->name ?></option>
                <?php endforeach ?>
            </select>
        </div>                                       
    </div>

    <div class="col-md-4">                 
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control form-control-danger" name="name" value="<?= $userInfo->name ?>" required>
        </div>                                       
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="user-name">User Name</label>
            <input type="text" class="form-control form-control-danger" name="username" value="<?= $userInfo->user_name ?>" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4"> 
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control form-control-danger" name="email" value="<?= $userInfo->email ?>" required>
        </div>                                       
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="user-image">User Image</label>
            <input type="file" class="form-control-file border" name="userImage">
            <input type="text" class="form-control-file border" name="previousUserImage" value="<?= $userInfo->image ?>">
        </div>
    </div>

    <div class="col-md-4">
    	<?php if ($userInfo->image): ?>				                    		
            <img src="<?= base_url($userInfo->image) ?>" class="img-thumbnail" alt="User Image" width="100px" height="100px">
    	<?php else: ?>
    		<img src="<?= base_url('/public/others_images/no_image.png') ?>" class="img-thumbnail" alt="User Image" width="100px" height="100px">
    	<?php endif ?>
    </div>
</div>