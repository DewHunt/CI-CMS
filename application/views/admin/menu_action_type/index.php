<div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped"  name="areaTable">
        <thead>
            <tr>
                <th width="20px">SL</th>
                <th>Name</th>
                <th width="60px">Action Id</th>
                <th width="20px">Status</th>
                <th width="50px">Action</th>
            </tr>
        </thead>
        <tbody id="">
        	<?php $sl = 1; ?>
        	<?php foreach ($menuActionTypes as $actionType): ?>
                <tr class="row_<?= $actionType->id ?>">
                    <td><?= $sl++ ?></td>
                    <td><?= $actionType->name ?></td>
                    <td><?= $actionType->action_id ?></td>
                    <td>
                    	<?= $this->Link_model->status($actionType->id,$actionType->status) ?>
					</td>
                    <td><?= $this->Link_model->action($actionType->id) ?></td>
                </tr>                                    		
        	<?php endforeach ?>
        </tbody>
    </table>
</div>