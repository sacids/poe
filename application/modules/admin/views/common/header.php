<div class="header border-bottom d-flex flex-row-reverse align-middle" >
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
