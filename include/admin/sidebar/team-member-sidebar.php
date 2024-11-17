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
         <li class="nav-item" id="leads">
           <a href="<?php echo ADMIN_URL; ?>/leads/?TotalItems=1" class="nav-link">
             <i class="nav-icon fas fa-star text-dark"></i>
             <p>
               All Leads
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/mvisits/" class="nav-link">
             <i class="nav-icon fas fa-users text-dark"></i>
             <p>
               Visitors
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/teams/" class="nav-link">
             <i class="nav-icon fas fa-users text-dark"></i>
             <p>
               My Team
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/mypolicies/" class="nav-link">
             <i class="nav-icon fas fa-stamp text-dark"></i>
             <p>
               Company Policies
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/my-bookings/" class="nav-link">
             <i class="nav-icon fas fa-list text-dark"></i>
             <p>
               My Bookings
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/my-assets/" class="nav-link">
             <i class="nav-icon fas fa-table text-dark"></i>
             <p>
               My Assets
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/member/ods" class="nav-link">
             <i class="nav-icon fas fa-door-open text-dark"></i>
             <p>
               OD Requests
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/member/leaves" class="nav-link">
             <i class="nav-icon fas fa-door-closed text-dark"></i>
             <p>
               My Leaves
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/member/circulars" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-circle-notch text-dark"></i>
             <p>
               All Circulars
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/member/rewards" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-medal text-dark"></i>
             <p>
               My Rewards
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/member/appraisals" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-filter text-dark"></i>
             <p>
               My Appraisals
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/member/pips" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-hourglass-end text-dark"></i>
             <p>
               My PIPs
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/member/assets" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-table text-dark"></i>
             <p>
               My Assets
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/member/holidays" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-calendar-day text-dark"></i>
             <p>
               Holiday Calendar
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