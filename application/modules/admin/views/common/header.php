<div class="header border-bottom d-flex flex-row-reverse align-middle d-none">
  <div class="border-left p-2"><a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
          <span><?php echo get_current_user_name() ?></span>
      </a>

      <div class="dropdown-menu dropdown-menu-right">
          <a href="<?= site_url('auth/logout') ?>" class="dropdown-item" style="font-size: 12px;"><i class="icon-switch2"></i>
              Logout</a>
      </div>
  </div>
  <!--<div class="border-left p-2">Messages</div>-->
</div>


<div class="mobile-menu">
    <nav class="navbar navbar-expand-lg navbar-light bg-green-800">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-navicon" style="color:#fff; font-size:28px;"></i>
                </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="menu-item">
                    <a href="<?= site_url('') ?>">Home</a>
                </li>

                <li class="menu-item menu-item-has-children">
                    <a href="#">About Us</a>
                </li>

                <li class="menu-item">
                    <a href="#"> Contacts</a>
                </li>
            </ul>
        </div>
    </nav>
</div><!--./mobile-menu -->