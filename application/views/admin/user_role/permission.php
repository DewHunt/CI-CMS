<?php $userRoles = $userRoles; ?>
<input type="hidden" name="userroleId" value="<?= $userRoles->id ?>">

<div class="row">
    <div class="col-md-10">
    	<input type="checkbox" class="select_all" name="select_all"> Select All
    </div>
</div>

<div style="padding-bottom: 10px;"></div>
<?php foreach ($userMenus as $rootMenu): ?>
	<?php
        $rolePermission = explode(',', $userRoles->permission);
        if (in_array($rootMenu->id, $rolePermission))
        {
            $checked = "checked";
        }
        else
        {
            $checked = "";
        }
        $countUserMenuAction = $this->HelperModel->GetUserMenuActionCount($rootMenu->id);
	?>

   	<?php if ($rootMenu->parent_menu == NULL): ?>
        <?php if ($countUserMenuAction->count == 0): ?>
        	<?php
        		$parentMenus = $this->HelperModel->GetAllMenus($rootMenu->id);
        	?>

            <div class="row parentMenuBlock">
                <div class="col-md-12">
                	<input class="parentMenu_<?= $rootMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $rootMenu->id ?>" <?= $checked ?>  data-id="<?= $rootMenu->id ?>" <?php if ($rootMenu->id == 1): ?>onclick="return false" checked<?php endif ?>>
                    <span><?= $rootMenu->menu_name ?></span>
                  
                    <div class="row" style="padding-left: 30px;">
                        <?php foreach ($parentMenus as $parentMenu): ?>
                        	<?php
                                $userMenuAction = $this->HelperModel->GetUserMenuAction($parentMenu->id);
                                $rolePermission = explode(',', $userRoles->permission);
                                if (in_array($parentMenu->id, $rolePermission))
                                {
                                    $checked = "checked";
                                }
                                else
                                {
                                    $checked = "";
                                }
                        	?>

                            <div class="col-md-3">
                                <input class="parentMenu_<?= $parentMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $parentMenu->id ?>" <?= $checked ?>  data-id="<?= $parentMenu->id ?>">
                                <span><?= $parentMenu->menu_name ?></span>
                                <div style="margin-left: 26px;margin-top: 3px;">
                                    <?php foreach ($userMenuAction as $action): ?>
                                    	<?php
                                            $actionPermission = explode(',', $userRoles->action_permission);
                                            if (in_array($action->id, $actionPermission))
                                            {
                                                $actionChecked = "checked";
                                            }
                                            else
                                            {
                                                $actionChecked = "";
                                            }
                                    	?>
                                        <input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $actionChecked ?>> <?= $action->action_name ?> <br>
                                    <?php endforeach ?>
                                </div>
                  
                                <div class="row" style="padding-left: 30px;">
                                	<?php
                                		$subMenus = $this->HelperModel->GetAllMenus($parentMenu->id);
                                	?>
                                    <?php foreach ($subMenus as $subMenu): ?>
                                    	<?php
                                            $userMenuAction = $this->HelperModel->GetUserMenuAction($subMenu->id);
                                            $rolePermission = explode(',', $userRoles->permission);
                                            if (in_array($subMenu->id, $rolePermission))
                                            {
                                                $checked = "checked";
                                            }
                                            else
                                            {
                                                $checked = "";
                                            }
                                    	?>

                                        <div class="col-sm-12">
                                            <input class="parentMenu_<?= $subMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $subMenu->id ?>" <?= $checked ?> data-id="<?= $subMenu->id ?>">
                                            <span><?= $subMenu->menu_name ?></span>
                                            <div style="margin-left: 26px;margin-top: 3px;">
                                                <?php foreach ($userMenuAction as $action): ?>
                                                	<?php
                                                        $actionPermission = explode(',', $userRoles->action_permission);
                                                        if (in_array($action->id, $actionPermission))
                                                        {
                                                            $actionChecked = "checked";
                                                        }
                                                        else
                                                        {
                                                            $actionChecked = "";
                                                        }
                                                    ?>
                                                    <input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $actionChecked ?>> <?= $action->action_name ?> <br>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row parentMenuBlock">
            	<?php
                    $userMenuAction = $this->HelperModel->GetUserMenuAction($rootMenu->id);
                    $rolePermission = explode(',', $userRoles->permission);
                    if (in_array($rootMenu->id, $rolePermission))
                    {
                        $checked = "checked";
                    }
                    else
                    {
                        $checked = "";
                    }
                ?>

                <div class="col-md-12">
                    <input class="parentMenu_<?= $rootMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $rootMenu->id ?>" <?= $checked ?> data-id="<?= $rootMenu->id ?>">
                    <span><?= $rootMenu->menu_name ?></span>
                    <div style="margin-left: 26px;margin-top: 3px;">
                        <?php foreach ($userMenuAction as $action): ?>
                        	<?php
                                $actionPermission = explode(',', $userRoles->action_permission);
                                if (in_array($action->id, $actionPermission))
                                {
                                    $actionChecked = "checked";
                                }
                                else
                                {
                                    $actionChecked = "";
                                }
							?>
                            <input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $actionChecked ?>> <?= $action->action_name ?> <br>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        <?php endif ?>
    <?php endif ?>
<?php endforeach ?>