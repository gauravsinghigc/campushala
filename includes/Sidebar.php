<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <?php foreach (ADMIN_SIDEBAR_MENUS as $Menus) { ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $Menus['url']; ?>" id='<?php echo $Menus['id']; ?>'>
          <i class="<?php echo $Menus['icon']; ?>"></i> <span><?php echo $Menus['name']; ?></span>
        </a>
      </li>
    <?php } ?>
  </ul>
</aside>