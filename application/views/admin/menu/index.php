<div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped"  name="areaTable">
        <thead>
            <tr>
                <th width="20px">SL</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Link</th>
                <th>Icon</th>
                <th width="20px">Order</th>
                <th width="20px">Status</th>
                <th width="50px">Action</th>
            </tr>
        </thead>
        <tbody id="">
        	<?php $sl = 1; ?>
        	<?php foreach ($menus as $menu): ?>
        		<tr class="row_<?= $menu->id ?>">
        			<td><?= $sl++ ?></td>
        			<td><?= $menu->menu_name ?></td>
        			<td><?= $menu->parentName ?></td>
                    <td><?= $menu->menu_link ?></td>
                    <td><?= $menu->menu_icon ?></td>
                    <td><?= $menu->order_by ?></td>
        			<td>
        				<?= $this->LinkModel->Status($menu->id,$menu->status); ?>
        			</td>
        			<td>
        				<?= $this->LinkModel->Action($menu->id); ?>
        			</td>
        		</tr>					                		
        	<?php endforeach ?>
        </tbody>
    </table>
</div>