<div class="row">
    <div class="col-md-4"> 
        <div class="form-group">
            <label for="role">User Role</label>
            <select class="form-control select2" id="role" name="role" required>
                <option value=""> Select Role</option>
                <?php foreach ($allUserRoles as $role): ?>
                    <option value="<?= $role->id ?>"><?= $role->name ?></option>
                <?php endforeach ?>
            </select>
        </div>                                       
    </div>

    <div class="col-md-4">                 
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name" value="" required>
        </div>                                       
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="user-name">User Name</label>
            <input type="text" class="form-control" name="username" placeholder="User Name" value="" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4"> 
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="" placeholder="Email" required>
        </div>                                       
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="" placeholder="Password" required>
        </div>                                        
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="user-image">User Image</label>
            <input type="file" class="form-control-file border" name="userImage">
        </div>
    </div>
</div>