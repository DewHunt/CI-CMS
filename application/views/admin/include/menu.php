<?php
    $roleId = $this->session->userdata('sessionUserInfo')->role;

    if ($roleId == 2) {
        $permission = "";
    } else {
        $userRole = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $roleId")->row();
        $permission = "id IN ($userRole->permission) AND";
    }

    $rootMenus = $this->db->query("SELECT * FROM tbl_menus WHERE $permission parent_menu IS NULL AND status = 1 ORDER BY order_by ASC")->result();

    // echo "<pre>";
    // print_r($userRole); exit();
?>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <?php foreach ($rootMenus as $rootMenu): ?>
                            <?php
                                $parentMenus = $this->db->query("SELECT * FROM tbl_menus WHERE $permission parent_menu = $rootMenu->id AND status = 1 ORDER BY order_by ASC")->result();
                            ?>
                            <?php if (count($parentMenus) > 0): ?>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                        <i class="<?= $rootMenu->menu_icon == '' ? 'ti-layout-grid2' : $rootMenu->menu_icon ?>"></i>
                                        <span class="hide-menu"><?= $rootMenu->menu_name ?></span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse">
                                        <?php foreach ($parentMenus as $parentMenu): ?>
                                            <?php
                                                $childMenus = $this->db->query("SELECT * FROM tbl_menus WHERE $permission parent_menu = $parentMenu->id AND status = 1 ORDER BY order_by ASC")->result();
                                            ?>
                                            <?php if (count($childMenus) > 0): ?>
                                                <li>
                                                    <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                                        <i class="<?= $parentMenu->menu_icon == '' ? 'ti-settings' : $parentMenu->menu_icon ?>"></i>
                                                        <span class="hide-menu"><?= $parentMenu->menu_name ?></span>
                                                    </a>
                                                    <ul aria-expanded="false" class="collapse">
                                                        <?php foreach ($childMenus as $childMenu): ?>
                                                            <li>
                                                                <a href="<?= $childMenu->menu_link ?>">
                                                                    <i class="<?= $childMenu->menu_icon == '' ? 'ti-files' : $childMenu->menu_icon ?>"></i>
                                                                    <span class="hide-menu"> <?= $childMenu->menu_name ?></span>
                                                                </a>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="<?= base_url($parentMenu->menu_link) ?>">
                                                        <i class="<?= $parentMenu->menu_icon == '' ? 'ti-settings' : $parentMenu->menu_icon ?>"></i>
                                                        <span class="hide-menu"> <?= $parentMenu->menu_name ?></span>
                                                    </a>
                                                </li>                                                
                                            <?php endif ?>                                            
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url($rootMenu->menu_link) ?>" aria-expanded="false">
                                        <i class="<?= $rootMenu->menu_icon == '' ? 'ti-layout-grid2' : $rootMenu->menu_icon ?>"></i>
                                        <span class="hide-menu"><?= $rootMenu->menu_name ?></span>
                                    </a>
                                </li>
                            <?php endif ?>
                        <?php endforeach ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>