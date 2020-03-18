
<!-- Brand Logo -->
<a href="<?php echo base_url();?>" class="brand-link">
  <img src="<?php echo base_url();?>assets/img/Lgo.png" alt="AdminLTE Logo" class="brand-image"
  style="opacity: .8">
  <span class="brand-text font-weight-light"><b>S</b>istem <b>I</b>nventory</span>
</a>

<!-- Sidebar -->
<div class="sidebar"  style="line-height: 0.5;">
  <!-- Query Menu -->
  <?php
  $role_id = $this->session->userdata('role_id');
  $queryMenu =  "SELECT `mekp_menu`.`id`, `parents`
  FROM `mekp_menu` JOIN `mekp_access_menu`
  ON `mekp_menu`.`id` = `mekp_access_menu`.`menu_id`
  WHERE `mekp_access_menu`.`role_id` = $role_id
  ORDER BY `mekp_access_menu`.`menu_id` ASC
  ";
  $menu = $this->db->query($queryMenu)->result_array(); ?>

  <!-- Sidebar Menu -->
  <nav class="mt-2 ">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <!-- LOPPING MENU -->
           <?php foreach($menu as $m) : ?>
            <li class="nav-header">
              <?php echo $m['parents']; ?>
            </li>

            <?php 
            $menuId = $m['id'];
            $querySubMenu = "SELECT *
            FROM `mekp_sub_menu` JOIN `mekp_menu`
            ON `mekp_sub_menu`.`menu_id` = `mekp_menu`.`id`
            WHERE `mekp_sub_menu`.`menu_id` = $menuId
            AND `mekp_sub_menu`.`is_active` = 1 
            ";
            $subMenu = $this->db->query($querySubMenu)->result_array(); ?>

            <?php foreach($subMenu as $sm) : ?>
              <li class="nav-item">
                <?php if($title == $sm['title']) : ?>
                  <a href="<?php echo base_url($sm['url']); ?>" class="nav-link active">
                    <?php else : ?>
                      <a href="<?php echo base_url($sm['url']); ?>" class="nav-link">
                      <?php endif; ?>
                      <i class="<?php echo $sm['icon']; ?>"></i>
                      <p>
                        <?php echo $sm['title']; ?>
                      </p>
                    </a>
                  </li>
                <?php endforeach; ?>

              <?php endforeach; ?>

              <li class="nav-item">
                <a href="<?php echo base_url('auth/logout')?>" class="nav-link" data-toggle="modal" data-target="#logOutModal">
                  <i class="nav-icon fas fa-fw fa-sign-out-alt"></i>
                  <p>
                    Logout
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
<!-- /.sidebar -->