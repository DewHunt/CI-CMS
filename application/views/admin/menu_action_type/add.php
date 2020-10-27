<div class="row">
    <div class="col-md-6">
        <label for="action-type-name">Menu Action Type Name</label>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Menu Action Type Name" name="name" value="" required>
        </div>
    </div>

    <div class="col-md-6">
        <label for="action-id">Action Id</label>
        <div class="form-group {{ $errors->has('actionId') ? ' has-danger' : '' }}">
            <input type="number" class="form-control" placeholder="Menu Action Type Id" id="actionId" name="actionId" value="<?= $actionId ?>" required>
        </div>
    </div>
</div>