<div class="row">
    <div class="col-md-6">
        <label for="parent">Parent</label>
        <div class="form-group">
            <select class="form-control select2" id="parentMenuId" name="parentMenu">
                <option value="">Select Parent</option>
                <?php foreach ($menus as $menu): ?>
                    <option value="<?= $menu->id ?>"><?= $menu->menu_name ?></option>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <label for="menu-name">Menu Name</label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Menu name" name="menuName" value="" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="menu-link">Menu Link</label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Menu link" name="menuLink" value="">
        </div>
    </div>

    <div class="col-md-3">
        <label for="menu-icon">Menu Icon</label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="fa fa-icon" name="menuIcon" value="">
        </div>
    </div>

    <div class="col-md-3">
        <label for="order-by">Order By</label>
        <div class="form-group">
            <input type="number" class="form-control" placeholder="Order By" id="orderBy" name="orderBy" value="<?= $orderBy ?>" required>
        </div>
    </div>
</div>