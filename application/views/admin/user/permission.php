<input type="hidden" name="userroleId" value="<?= $userRoles->id ?>">
<input type="hidden" name="userId" value="<?= $userInfo->id ?>">

<div class="row">
    <div class="col-md-10">
    	<input type="checkbox" class="select_all" name="select_all"> Select All
    </div>
</div>

<div style="padding-bottom: 10px;"></div>
<?php foreach ($userMenus as $rootMenu): ?>
	<?php
		// echo "<pre>"; print_r($userInfo->reject_permission); exit();
        $rolePermission = explode(',', $userRoles->permission);
        $userPermission = explode(',', $userInfo->permission);
        if (in_array($rootMenu->id, $rolePermission))
        {
            $checked = "checked";
        }
        else
        {
            $checked = "";
        }

        if (in_array($rootMenu->id, $userPermission))
        {
            $userChecked = "checked";
        }
        else
        {
            $userChecked = "";
        }
        $countUserMenuAction = $this->Helper_model->get_user_menu_action_count($rootMenu->id);
	?>

   	<?php if ($rootMenu->parent_menu == NULL): ?>
        <?php if ($countUserMenuAction->count == 0): ?>
        	<?php $parentMenus = $this->Helper_model->get_all_menus($rootMenu->id); ?>

        	<?php if ($checked == "checked"): ?>
	            <div class="row parentMenuBlock">
	                <div class="col-md-12">
	                	<input class="parentMenu_<?= $rootMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $rootMenu->id ?>" <?= $userChecked ?>  data-id="<?= $rootMenu->id ?>" <?php if ($rootMenu->id == 1): ?>onclick="return false" checked<?php endif ?>>
	                    <span><?= $rootMenu->menu_name ?></span>
	                  
	                    <div class="row" style="padding-left: 30px;">
	                        <?php foreach ($parentMenus as $parentMenu): ?>
	                        	<?php
	                                $userMenuAction = $this->Helper_model->get_user_menu_action($parentMenu->id);
	                                $rolePermission = explode(',', $userRoles->permission);
	                                $userPermission = explode(',', $userInfo->permission);
	                                if (in_array($parentMenu->id, $rolePermission))
	                                {
	                                    $checked = "checked";
	                                }
	                                else
	                                {
	                                    $checked = "";
	                                }

							        if (in_array($parentMenu->id, $userPermission))
							        {
							            $userChecked = "checked";
							        }
							        else
							        {
							            $userChecked = "";
							        }
	                        	?>

	                        	<?php if ($checked == "checked"): ?>
		                            <div class="col-md-3">
		                                <input class="parentMenu_<?= $parentMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $parentMenu->id ?>" <?= $userChecked ?>  data-id="<?= $parentMenu->id ?>">
		                                <span><?= $parentMenu->menu_name ?></span>
		                                <div style="margin-left: 26px;margin-top: 3px;">
		                                    <?php foreach ($userMenuAction as $action): ?>
		                                    	<?php
		                                            $actionPermission = explode(',', $userRoles->action_permission);
		                                            $userActionPermission = explode(',', $userInfo->action_permission);
		                                            if (in_array($action->id, $actionPermission))
		                                            {
		                                                $actionChecked = "checked";
		                                            }
		                                            else
		                                            {
		                                                $actionChecked = "";
		                                            }

		                                            if (in_array($action->id, $userActionPermission))
		                                            {
		                                                $userActionChecked = "checked";
		                                            }
		                                            else
		                                            {
		                                                $userActionChecked = "";
		                                            }
		                                    	?>

		                                    	<?php if ($actionChecked == "checked"): ?>
		                                    		<input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $userActionChecked ?>> <?= $action->action_name ?> <br>
		                                    	<?php endif ?>		                                        
		                                    <?php endforeach ?>
		                                </div>
		                  
		                                <div class="row" style="padding-left: 30px;">
		                                	<?php
		                                		$subMenus = $this->Helper_model->get_all_menus($parentMenu->id);
		                                	?>
		                                    <?php foreach ($subMenus as $subMenu): ?>
		                                    	<?php
		                                            $userMenuAction = $this->Helper_model->get_user_menu_action($subMenu->id);
		                                            $rolePermission = explode(',', $userRoles->permission);
		                                            $userPermission = explode(',', $userInfo->permission);
		                                            if (in_array($subMenu->id, $rolePermission))
		                                            {
		                                                $checked = "checked";
		                                            }
		                                            else
		                                            {
		                                                $checked = "";
		                                            }

		                                            if (in_array($subMenu->id, $userPermission))
		                                            {
		                                                $userChecked = "checked";
		                                            }
		                                            else
		                                            {
		                                                $userChecked = "";
		                                            }
		                                    	?>

		                                    	<?php if ($checked == "checked"): ?>
			                                        <div class="col-sm-12">
			                                            <input class="parentMenu_<?= $subMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $subMenu->id ?>" <?= $userChecked ?> data-id="<?= $subMenu->id ?>">
			                                            <span><?= $subMenu->menu_name ?></span>
			                                            <div style="margin-left: 26px;margin-top: 3px;">
			                                                <?php foreach ($userMenuAction as $action): ?>
			                                                	<?php
			                                                        $actionPermission = explode(',', $userRoles->action_permission);
			                                                        $userActionPermission = explode(',', $userInfo->action_permission);
			                                                        if (in_array($action->id, $actionPermission))
			                                                        {
			                                                            $actionChecked = "checked";
			                                                        }
			                                                        else
			                                                        {
			                                                            $actionChecked = "";
			                                                        }

			                                                        if (in_array($action->id, $userActionPermission))
			                                                        {
			                                                            $userActionChecked = "checked";
			                                                        }
			                                                        else
			                                                        {
			                                                            $userActionChecked = "";
			                                                        }
			                                                    ?>
			                                                    <?php if ($actionChecked == "checked"): ?>
			                                                    	<input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $userActionChecked ?>> <?= $action->action_name ?> <br>
			                                                    <?php endif ?>			                                                    
			                                                <?php endforeach ?>
			                                            </div>
			                                        </div>		                                    		
		                                    	<?php endif ?>
		                                    <?php endforeach ?>
		                                </div>
		                            </div>	                        		
	                        	<?php endif ?>
	                        <?php endforeach ?>
	                    </div>
	                </div>
	            </div>        		
        	<?php endif ?>
        <?php else: ?>
        	<?php
                $userMenuAction = $this->Helper_model->get_user_menu_action($rootMenu->id);
                $rolePermission = explode(',', $userRoles->permission);
                $userPermission = explode(',', $userInfo->permission);
                if (in_array($rootMenu->id, $rolePermission))
                {
                    $checked = "checked";
                }
                else
                {
                    $checked = "";
                }

                if (in_array($rootMenu->id, $userPermission))
                {
                    $userChecked = "checked";
                }
                else
                {
                    $userChecked = "";
                }
            ?>
            <?php if ($checked == "checked"): ?>
	            <div class="row parentMenuBlock">
	                <div class="col-md-12">
	                    <input class="parentMenu_<?= $rootMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $rootMenu->id ?>" <?= $userChecked ?> data-id="<?= $rootMenu->id ?>">
	                    <span><?= $rootMenu->menu_name ?></span>
	                    <div style="margin-left: 26px;margin-top: 3px;">
	                        <?php foreach ($userMenuAction as $action): ?>
	                        	<?php
	                                $actionPermission = explode(',', $userRoles->action_permission);
	                                $userActionPermission = explode(',', $userInfo->action_permission);
	                                if (in_array($action->id, $actionPermission))
	                                {
	                                    $actionChecked = "checked";
	                                }
	                                else
	                                {
	                                    $actionChecked = "";
	                                }

	                                if (in_array($action->id, $userActionPermission))
	                                {
	                                    $userActionChecked = "checked";
	                                }
	                                else
	                                {
	                                    $userActionChecked = "";
	                                }
								?>

								<?php if ($actionChecked == "checked"): ?>
									<input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $userActionChecked ?>> <?= $action->action_name ?> <br>
								<?php endif ?>
	                            
	                        <?php endforeach ?>
	                    </div>
	                </div>
	            </div>
            <?php endif ?>
        <?php endif ?>
    <?php endif ?>
<?php endforeach ?>