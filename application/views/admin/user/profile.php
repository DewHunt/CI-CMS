<div class="card">            
    <div class="custom-card-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><h4 class="custom-card-title"><?= $title ?></h4></div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                <?= $this->Link_model->go_back_link(); ?>
            	<a class="btn btn-outline-info btn-lg waves-effect changePassword" name="changePassword" href="<?= base_url('user/edit/'.$userInfo->id) ?>"><i class="fa fa-edit"></i> Edit</a>
            	<a class="btn btn-outline-info btn-lg waves-effect changePassword" name="changePassword" href="<?= base_url('user/change_password/'.$userInfo->id) ?>"><i class="fa fa-key"></i> Change Password</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <table class="table color-bordered-table muted-bordered-table table-sm">
            <thead class="thead-green">
                <tr>
                    <th colspan="4" style="text-align: center;"><font size="5px"><?= $userInfo->name ?></font></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td rowspan="5" width="125px" align="center"><img src="<?= base_url($userInfo->image) ?>" class="user-image" width="150px" height="150px"></td>
                </tr>

                <tr>
                    <td width="140px">User Role</td>
                    <td width="10px">:</td>
                    <td><?= $userInfo->userRoleName ?></td>
                </tr>

                <tr>
                    <td width="140px">User Name</td>
                    <td width="10px">:</td>
                    <td><?= $userInfo->user_name ?></td>
                </tr>

                <tr>
                    <td width="140px">Email</td>
                    <td width="10px">:</td>
                    <td><?= $userInfo->email ?></td>
                </tr>

                <tr>
                    <td width="140px">Status</td>
                    <td width="10px">:</td>
                    <td>
                    	<?php if ($userInfo->status == 1): ?>
                    		Active
                    	<?php else: ?>
                    		Deactive
                    	<?php endif ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>