<input class="form-control" type="hidden" name="menuId" value="<?= $menuInfo->id ?>">

<div class="row">
    <div class="col-md-6">
        <label for="parent">Parent</label>
        <div class="form-group">
            <select class="form-control select2" id="parentMenuId" name="parentMenu">
                <option value="">Select Parent</option>
                <?php foreach ($menus as $menu): ?>
                	<?php
                		if ($menu->id == $menuInfo->parent_menu) {
                			$select = 'selected';
                		} else {
                			$select = '';
                		}						                        		
                	?>
                    <option value="<?= $menu->id ?>" <?= $select ?>><?= $menu->menu_name ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <label for="menu-name">Menu Name</label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Menu name" name="menuName" value="<?= $menuInfo->menu_name ?>" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="menu-link">Menu Link</label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Menu link" name="menuLink" value="<?= $menuInfo->menu_link ?>">
        </div>
    </div>

    <div class="col-md-3">
        <label for="menu-icon">Menu Icon</label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="fa fa-icon" name="menuIcon" value="<?= $menuInfo->menu_icon ?>">
        </div>
    </div>

    <div class="col-md-3">
        <label for="order-by">Order By</label>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="Order By" id="orderBy" name="orderBy" value="<?= $menuInfo->order_by ?>" required>
        </div>
    </div>
</div>