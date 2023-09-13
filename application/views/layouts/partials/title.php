



    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav narrower gradient-custom header-site">

      <!-- SideNav slide-out button -->
      <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="fas fa-bars"></i></a>
      </div>

      <!-- Breadcrumb -->
      <div class="breadcrumb-dn mr-auto">
        <p><b>Aplikasi <i><?= isset($app_name) ? $app_name : ''; ?></i></b></p>
      </div>

      <div class="d-flex">

        <!-- <div class="ml-auto mb-0 mr-3 change-mode-wrapper">
          <button class="btn btn-outline-black btn-sm" id="dark-mode">Change Mode</button>
        </div> -->

        <!-- Navbar links -->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">

          <!-- Dropdown -->
          <!-- <li class="nav-item dropdown notifications-nav">
            <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <span class="badge red">3</span> 
              <i class="fas fa-bell wow tada animated infinite"></i>
              <span class="d-none d-md-inline-block"><b>Pemberitahuan</b></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

            </div>
          </li>  -->
          <!-- <li class="nav-item">
            <a class="nav-link waves-effect"><i class="fas fa-envelope"></i> <span
                class="clearfix d-none d-sm-inline-block">Contact</span></a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link waves-effect"><i class="far fa-comments"></i> <span
                class="clearfix d-none d-sm-inline-block"><b>Petunjuk</b></span></a>
          </li> -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i> <span class="clearfix d-none d-sm-inline-block"><b>Profile,  <?php echo $this->app_loader->current_name(); ?></b></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
              <!-- <a class="dropdown-item" href="#"><i class="fas fa-user-cog mr-1"></i> My account</a> -->
              <a class="dropdown-item" href="<?= site_url('auth/signin/logout'); ?>"><i class="fas fa-sign-out-alt mr-1"></i> Log Out</a>
            </div>
          </li>

        </ul>
        <!-- Navbar links -->

      </div>

    </nav>
    <!-- Navbar -->