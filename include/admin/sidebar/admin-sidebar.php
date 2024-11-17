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
           <a href="<?php echo ADMIN_URL; ?>/teams/" class="nav-link">
             <i class="nav-icon fas fa-users text-dark"></i>
             <p>
               All Team
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/projects/" class="nav-link">
             <i class=" nav-icon fas fa-list text-dark"></i>
             <p>
               All Projects
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/visitors/" class="nav-link">
             <i class=" nav-icon fas fa-users text-dark"></i>
             <p>
               All Visitors
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/digital/compaigns/" class="nav-link" id="teams">
             <i class=" nav-icon fa fa-dashboard text-dark"></i>
             <p>
               Digital Compaigns
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/digital/news/" class="nav-link" id="teams">
             <i class=" nav-icon fa fa-file text-dark"></i>
             <p>
               News Paper Compaigns
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/digital/creatives/" class="nav-link" id="teams">
             <i class="nav-icon fa fa-image text-dark"></i>
             <p>
               All Creatives
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/digital/marketings/" class="nav-link" id="teams">
             <i class=" nav-icon fa fa-users text-dark"></i>
             <p>
               Marketing Collaterals
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/crm/bookings" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-book text-dark"></i>
             <p>
               All Bookings
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/crm/reg" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-star text-dark"></i>
             <p>
               All Registration
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/crm/custs" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-users text-dark"></i>
             <p>
               All Customers
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/crm/payments" class="nav-link">
             <i class="nav-icon fas fa-exchange text-dark"></i>
             <p>
               Payments
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/crm/refunds" class="nav-link">
             <i class="nav-icon fas fa-stamp text-dark"></i>
             <p>
               All Refunds
             </p>
           </a>
         </li>

         <li class="nav-item" id="leads">
           <a href="<?php echo ADMIN_URL; ?>/reports/" class="nav-link">
             <i class="nav-icon fas fa-star text-dark"></i>
             <p>
               All Reports
             </p>
           </a>
         </li>


         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/hr/policies/" class="nav-link">
             <i class=" nav-icon fas fa-stamp text-dark"></i>
             <p>
               All Policies
             </p>
           </a>
         </li>


         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/hr/assets/" class="nav-link">
             <i class="nav-icon fas fa-table text-dark"></i>
             <p>
               All Assets
             </p>
           </a>
         </li>


         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/users/" class="nav-link">
             <i class=" nav-icon fas fa-users text-dark"></i>
             <p>
               All Users
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/configs/" class="nav-link">
             <i class="nav-icon fas fa-gear text-dark"></i>
             <p>
               System Configurations
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/hr/ods" class="nav-link">
             <i class="nav-icon fas fa-door-open text-dark"></i>
             <p>
               All OD Requests
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="<?php echo ADMIN_URL; ?>/hr/leaves" class="nav-link" id="teams">
             <i class="nav-icon fas fa-door-closed text-dark"></i>
             <p>
               All Leaves
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
           <a href="<?php echo ADMIN_URL; ?>/hr/circulars" class="nav-link" id="teams">
             <i class=" nav-icon fas fa-circle-notch text-dark"></i>
             <p>
               All Circulars
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