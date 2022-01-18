 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-light text-uppercase">Admin system</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?php echo _WEB_HOST_ROOT_ADMIN; ?>" class="nav-link <?php echo activeMenuSidebar('')?'active':false; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> 
                Tổng quan
              </p>
            </a>
          </li>
          <!--Categories -->
          <li class="nav-item <?php echo activeMenuSidebar('category')?'menu-open':false; ?> ">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('category')?'active':false; ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Danh mục sản phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item <?php echo activeMenuSidebar('list')?'active':false; ?>">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=category&action=list'; ?>" class="nav-link <?php echo activeMenuSidebar('list')?'active':false;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách danh mục</p>
                </a>
              </li>
              <li class="nav-item <?php echo activeMenuSidebar('add')?'active':false; ?>">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=category&action=add'; ?>" class="nav-link <?php echo activeMenuSidebar('add')?'active':false; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới danh mục</p>
                </a>
              </li>
            </ul>
          </li>
          <!--End Categories -->
          <!--Products -->
          <li class="nav-item <?php echo activeMenuSidebar('product')?'menu-open':false; ?> ">
            <a href="#" class="nav-link <?php echo activeMenuSidebar('product')?'active':false; ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản lý sản phẩm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=product&action=list'; ?>" class="nav-link <?php echo activeMenuSidebar('list')?'active':false;?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách sản phẩm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo _WEB_HOST_ROOT_ADMIN.'?module=product&action=add'; ?>" class="nav-link <?php echo activeMenuSidebar('add')?'active':false; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm mới sản phẩm</p>
                </a>
              </li>
            </ul>
          </li>
          <!--End Products -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">