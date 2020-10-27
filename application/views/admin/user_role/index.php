<div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped"  name="areaTable">
        <thead>
            <tr>
                <th width="20px">SL</th>
                <th width="100px">Name</th>
                <th>Menu Name</th>
                <th width="20px">Status</th>
                <th width="50px">Action</th>
            </tr>
        </thead>
        <tbody id="">
        	<?php $sl = 1; ?>
        	<?php foreach ($allUserRole as $userRole): ?>
                <?php
                    if ($userRole->permission == "")
                    {
                        $menus = [];
                    }
                    else
                    {
                        // $menuIds = explode(',',$userRole->permission);
                        $menus = $this->HelperModel->GetDataByMultipleId('tbl_menus',$userRole->permission);
                    }
                
                    $menuArray = [];
                    foreach ($menus as $menu)
                    {
                        array_push($menuArray, $menu->menu_name);
                    }

                    $menuName = implode(', ', $menuArray);
                ?>
        		<tr class="row_<?= $userRole->id ?>">
        			<td><?= $sl++ ?></td>
        			<td><?= $userRole->name ?></td>
                    <td><?= $menuName ?></td>
        			<td>
        				<?= $this->LinkModel->Status($userRole->id,$userRole->status); ?>
        			</td>
        			<td>
        				<?= $this->LinkModel->Action($userRole->id); ?>
        			</td>
        		</tr>					                		
        	<?php endforeach ?>
        </tbody>
    </table>
</div>