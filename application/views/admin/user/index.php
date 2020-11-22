<div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped"  name="areaTable">
        <thead>
            <tr>
                <th width="20px">SL</th>
                <th width="150px">Name</th>
                <th width="150px">Email</th>
                <th width="80px">User Name</th>
                <th width="80px">Role</th>
                <th>Reject Menu Name</th>
                <th width="20px">Status</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody id="">
            <?php $sl = 1; ?>
            <?php foreach ($allUsers as $user): ?>
                <?php
                    if ($user->permission == "") {
                        $menus = [];
                    } else {
                        // $menuIds = explode(',',$userRole->permission);
                        $menus = $this->Helper_model->get_data_by_multiple_id('tbl_menus',$user->permission);
                    }
                
                    $menuArray = [];
                    foreach ($menus as $menu) {
                        array_push($menuArray, $menu->menu_name);
                    }

                    $menuName = implode(', ', $menuArray);
                ?>
                <tr class="row_<?= $user->id ?>">
                    <td><?=  $sl++ ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->user_name ?></td>
                    <td><?= $user->roleName ?></td>
                    <td><?= $menuName ?></td>
                    <td><?= $this->Link_model->status($user->id,$user->status) ?></td>
                    <td><?= $this->Link_model->action($user->id) ?></td>
                </tr>                                            
            <?php endforeach ?>
        </tbody>
    </table>
</div>