<div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped"  name="areaTable">
        <thead>
            <tr>
                <th width="20px">SL</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Name</th>
                <th>Role</th>
                <th width="20px">Status</th>
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody id="">
            <?php $sl = 1; ?>
            <?php foreach ($allUsers as $user): ?>
                <tr class="row_<?= $user->id ?>">
                    <td><?=  $sl++ ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->user_name ?></td>
                    <td><?= $user->roleName ?></td>
                    <td><?= $this->Link_model->status($user->id,$user->status) ?></td>
                    <td><?= $this->Link_model->action($user->id) ?></td>
                </tr>                                            
            <?php endforeach ?>
        </tbody>
    </table>
</div>