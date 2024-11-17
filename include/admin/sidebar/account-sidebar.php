 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-primary">
     <!-- Brand Logo -->
     <a href="<?php echo ADMIN_URL; ?>" class="brand-link">
         <img src="<?php echo MAIN_LOGO; ?>" alt="<?php echo APP_NAME; ?>" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
         <span class="brand-text bold mt-2" style="font-size: 1rem !important;font-weight:600 !important;"><?php echo substr(APP_NAME, 0, 20); ?></span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>" class="nav-link">
                         <i class="nav-icon fas fa-tachometer-alt text-dark"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/account/students/index.php" class="nav-link" id="teams">
                         <i class=" nav-icon fas fa-book text-dark"></i>
                         <p>
                             Students
                         </p>
                     </a>
                 </li>


                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/account/university/index.php" class="nav-link" id="teams">
                         <i class=" nav-icon fas fa-book text-dark"></i>
                         <p>
                             Universities
                         </p>
                     </a>
                 </li>


                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/account/bdes/index.php" class="nav-link" id="teams">
                         <i class=" nav-icon fas fa-book text-dark"></i>
                         <p>
                             BDE's
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/account/fees/index.php" class="nav-link" id="teams">
                         <i class=" nav-icon fas fa-book text-dark"></i>
                         <p>
                             Fees
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/account/invoice/index.php" class="nav-link" id="teams">
                         <i class=" nav-icon fas fa-book text-dark"></i>
                         <p>
                             Invoice
                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/accounts/reg" class="nav-link" id="teams">
                         <i class=" nav-icon fas fa-book text-dark"></i>
                         <p>
                             Reports
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/configs/" class="nav-link">
                         <i class="nav-icon fas fa-gear text-dark"></i>
                         <p>
                             System Masters
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/profile/" class="nav-link">
                         <i class="nav-icon fas fa-user text-dark"></i>
                         <p>
                             Profile
                         </p>
                     </a>
                 </li>



                 <li class="nav-item">
                     <a href="<?php echo ADMIN_URL; ?>/logout.php" class="nav-link">
                         <i class="nav-icon fas fa-lock text-danger"></i>
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
 </aside>