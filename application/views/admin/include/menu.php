<?php
    $sessionUserMenuInfo = (object) $this->session->userdata('sessionUserInfo');
    $roleId = $sessionUserMenuInfo->role;

    if ($roleId == 2) {
        $rootMenus = $this->db->query("SELECT * FROM tbl_menus WHERE parent_menu IS NULL AND status = 1 ORDER BY order_by ASC")->result();
    } else {
        $userRole = $this->db->query("SELECT * FROM tbl_user_roles WHERE id = $roleId")->row();
        $rootMenus = $this->db->query("SELECT * FROM tbl_menus WHERE id IN ($userRole->permission) AND parent_menu IS NULL AND status = 1 ORDER BY order_by ASC")->result();
    }    
    // echo $routeName = $this->uri->segment(1) == '' ? 'home' : $this->uri->segment(1);
?>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <?php foreach ($rootMenus as $rootMenu): ?>
                            <?php
                                $parentMenus = $this->db->query("SELECT * FROM tbl_menus WHERE id IN ($userRole->permission) AND parent_menu = $rootMenu->id AND status = 1 ORDER BY order_by ASC")->result();
                            ?>
                            <?php if (count($parentMenus) > 0): ?>
                                <li>
                                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                        <i class="ti-layout-grid2"></i>
                                        <span class="hide-menu"><?= $rootMenu->menu_name ?></span>
                                    </a>
                                    <ul aria-expanded="false" class="collapse">
                                        <?php foreach ($parentMenus as $parentMenu): ?>
                                            <?php
                                                $childMenus = $this->db->query("SELECT * FROM tbl_menus WHERE id IN ($userRole->permission) AND parent_menu = $parentMenu->id AND status = 1 ORDER BY order_by ASC")->result();
                                            ?>
                                            <?php if (count($childMenus) > 0): ?>
                                                <li>
                                                    <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                        <span class="hide-menu"><?= $parentMenu->menu_name ?></span>
                                                    </a>
                                                    <ul aria-expanded="false" class="collapse">
                                                        <?php foreach ($childMenus as $childMenu): ?>
                                                            <li>
                                                                <a href="<?= $childMenu->menu_link ?>">
                                                                    <i class="ti-files"></i><span class="hide-menu"> <?= $childMenu->menu_name ?></span>
                                                                </a>
                                                            </li>
                                                        <?php endforeach ?>
                                                    </ul>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="<?= base_url($parentMenu->menu_link) ?>">
                                                        <i class="ti-settings"></i><span class="hide-menu"> <?= $parentMenu->menu_name ?></span>
                                                    </a>
                                                </li>                                                
                                            <?php endif ?>                                            
                                        <?php endforeach ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="waves-effect waves-dark" href="<?= base_url($rootMenu->menu_link) ?>" aria-expanded="false">
                                        <i class="ti-layout-grid2"></i><span class="hide-menu"><?= $rootMenu->menu_name ?></span>
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