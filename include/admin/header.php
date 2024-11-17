<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav header">
      <li class="nav-item">
         <a class="nav-link h3" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars h1"></i></a>
      </li>
      <?php if (DEVICE_TYPE == "Computer") { ?>
         <li class="navbar-item">
            <span class="nav-link h4"><i class="fa fa-clock"></i> <span id="clock"></span></span>
         </li>
      <?php } ?>
   </ul>
   <?php
   if (DEVICE_TYPE == "MOBILE" || DEVICE_TYPE == "Mobile") {
      $OptimiseView = "mobile-view-of-alert";
   } else {
      $OptimiseView = "";
   } ?>
   <div class="<?php echo $OptimiseView; ?> hidden">
      <ul class="navbar-nav header">

         <li class="nav-item">
            <a class="nav-link" alt="All Notifications" title="All Notifications" href="#">
               <i class="fa fa-bell active"></i>
               <span class="number">12</span>
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link" title="Today Birthdays" alt="Today Birthdays" href="#">
               <i class="fa fa-cake"></i>
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link" alt="Latest Visitors" title="Latest Visitors" href="#">
               <i class="fa fa-users"></i>
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link" alt="Today Site Visits" title="Today Site Visits" href="#">
               <i class="fa fa-map-marker"></i>
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link" title="Payment Reminders" alt="Payment Reminders" href="#">
               <i class="fa fa-inr"></i>
            </a>
         </li>
         <li class="nav-item">
            <a class="nav-link" alt="Meeting & Trainings" title="Meeting & Trainings" href="#">
               <i class="fa fa-video-camera"></i>
            </a>
         </li>
      </ul>
   </div>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto auth-header">
      <li class="nav-item" style=" padding-right: 10px;">
         <input class="form-control mr-sm-2 universals-search" type="text" id="universalSearch" placeholder="Search" style="border-radius: 15px">
         <span style="position: absolute; top: 16px; right: 265px;"><i class="fas fa-search" style="font-size: 16px; color: #6a6adc; cursor: pointer;"></i></span>
      </li>
      <li class="nav-item">
         <a href="<?php echo ADMIN_URL; ?>/profile/" class="nav-link user-panel p-0 pr-2 shadow-sm p-1 rounded">
            <div class="image">
               <img src="<?php echo LOGIN_UserProfileImage; ?>" class="img-circle elevation-2" alt="<?php echo LOGIN_UserFullName; ?>" title="<?php echo LOGIN_UserFullName; ?>" />
               <span class="p-1 h6 float-right"><b><?php echo LOGIN_UserFullName; ?></b> - <?php echo LOGIN_UserType; ?> </span>
            </div>
         </a>
      </li>
   </ul>
</nav>
<!-- /.navbar -->

