<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Member";
$PageDescription = "Manage teams";

if (isset($_GET['view'])) {
  $View = $_GET['view'];
  $PageName = "All $View";
}

$REQ_UserId = LOGIN_UserId;
$UserSql = "SELECT * FROM users where UserId='$REQ_UserId'";
$EmpSql = "SELECT * FROM user_employment_details where UserMainUserId='$REQ_UserId'";

if (isset($_GET['view'])) {
  $UserEmpGroupName = $_GET['view'];
  $location = $_GET['location'];
  $search_value = $_GET['search_value'];
  $search_in = $_GET['search_in'];
  $TotalItems = TOTAL("SELECT * FROM users, user_employment_details where users.UserId=user_employment_details.UserMainUserId and $search_in like '%$search_value%' and UserEmpLocations like '%$location%' and  UserEmpGroupName like '%$UserEmpGroupName%' ORDER BY UserEmpDetailsId Desc");
} else {
  $TotalItems = TOTAL("SELECT * FROM users, user_employment_details where users.UserId=user_employment_details.UserMainUserId ORDER BY UserEmpDetailsId Desc");
}

$listcounts = 15;

// Get current page number
if (isset($_GET["view_page"])) {
  $page = $_GET["view_page"];
} else {
  $page = 1;
}
$start = ($page - 1) * $listcounts;
$next_page = ($page + 1);
$previous_page = ($page - 1);
$NetPages = round(($TotalItems / $listcounts) + 0.5);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
  <?php include $Dir . "/include/admin/header_files.php"; ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include $Dir . "/include/admin/loader.php"; ?>

    <?php
    include $Dir . "/include/admin/header.php";
    include $Dir . "/include/admin/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-12">
                      <div class="flex-s-b">
                        <h3 class="app-heading mb-0 w-pr-90 mt-0"><?php echo $PageName; ?></h3>
                        <a href="tree.php" class="btn btn-sm btn-primary"><i class='fa fa-tree'></i> Tree View</a>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <?php
                        $leadStages = FETCH_DB_TABLE("SELECT ConfigValueDetails FROM configs, config_values where configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigGroupName='WORK_GROUP'", true);
                        if ($leadStages != null) {
                          foreach ($leadStages as $g) { ?>
                            <a class="col" href="?view=<?php echo $g->ConfigValueDetails; ?>&location=&search_in=users.UserFullName&search_value=">
                              <p class="data-list flex-s-b">
                                <span class="data-name p-3"><?php echo $g->ConfigValueDetails; ?></span>
                                <span class="data-count">
                                  <?php
                                  $Totalusers = 0;
                                  if (isset($_GET['view'])) {
                                    $UserEmpGroupName = $_GET['view'];
                                    $location = $_GET['location'];
                                    echo  TOTAL("SELECT UserEmpDetailsId FROM user_employment_details where UserEmpLocations like '%$location%' and  UserEmpGroupName like '%" . $g->ConfigValueDetails . "%' ORDER BY UserEmpDetailsId Desc");
                                  } else {
                                    echo TOTAL("SELECT UserEmpDetailsId FROM user_employment_details where UserEmpGroupName='" . $g->ConfigValueDetails . "'");
                                  }
                                  ?>
                                </span>
                              </p>
                            </a>
                        <?php }
                        } else {
                          echo "<option value='Null'>No Data Found!</option>";
                        }
                        ?>
                        <hr>
                        <a class="col" href="index.php">
                          <p class="data-list flex-s-b">
                            <span class="data-name p-2">Total Users:</span>
                            <span class="data-count"><?php echo TOTAL("SELECT UserId FROM users where UserType!='Admin'"); ?></span>
                          </p>
                        </a>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <?php
                      $EmpSql = "SELECT * FROM user_employment_details where UserMainUserId='" . LOGIN_UserId . "'";
                      if (FETCH($EmpSql, "UserEmpGroupName") != "SM" || FETCH($EmpSql, "UserEmpGroupName") != "Management") { ?>
                        <form action="" method="get" style="display:flex;justify-content:start;">
                          <div class="form-group mb-0">
                            <select name="view" class="form-control form-control-sm mb-0" onchange="form.submit()">
                              <option value="">All Group</option>
                              <?php
                              $leadStages = FETCH_DB_TABLE("SELECT * FROM configs, config_values where configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigGroupName='WORK_GROUP'", true);
                              if ($leadStages != null) {
                                foreach ($leadStages as $g) {
                                  if (isset($_GET['view'])) {
                                    if ($_GET['view'] == $g->ConfigValueDetails) {
                                      $selected = "selected";
                                    } else {
                                      $selected = "";
                                    }
                                  } else {
                                    $selected = "";
                                  } ?> <option value="<?php echo $g->ConfigValueDetails; ?>" <?php echo $selected; ?>><?php echo $g->ConfigValueDetails; ?></option>
                              <?php }
                              } else {
                                echo "<option value='Null'>No Data Found!</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group ml-2 mb-0">
                            <select name="location" class="form-control mb-0 form-control-sm" onchange="form.submit()">
                              <option value="">All location</option>
                              <?php InputOptions(["Noida", "Gurgaon"], IfRequested("GET", "location", "", false)); ?>
                            </select>
                          </div>
                          <div class="form-group ml-2 mb-0">
                            <select name="search_in" class="form-control mb-0 form-control-sm">
                              <?php InputOptions(["UserFullName", "UserPhoneNumber"], IfRequested("GET", "search_in", "", false)); ?>
                            </select>
                          </div>
                          <div class="form-group ml-2 mb-0">
                            <input ype="text" name="search_value" value="<?php echo IfRequested("GET", "search_value", "", false); ?>" list="UserId" onchange="form.submit()" class="form-control form-control-sm mb-0" placeholder="Enter User Full name">
                            <datalist id="UserId">
                              <?php
                              $Users = FETCH_DB_TABLE("SELECT * FROM users where UserType!='Admin' ORDER BY UserId", true);
                              if ($Users != null) {
                                foreach ($Users as $User) {
                                  if (isset($_GET['UserId'])) {
                                    if ($_GET['UserId'] == $User->UserId) {
                                      $selected = "selected";
                                    } else {
                                      $selected = "";
                                    }
                                  } else {
                                    $selected  = "";
                                  } ?>
                                  <option value="<?php echo $User->UserFullName; ?>"></option>
                                  <option value="<?php echo $User->UserPhoneNumber; ?>"></option>
                              <?php }
                              } ?>
                            </datalist>
                          </div>
                          <?php if (isset($_GET['view'])) { ?>
                            <a href=" index.php" class="btn btn-sm btn-danger ml-2"><i class="fa fa-times"></i> Clear Search & View All</a>
                          <?php } ?>
                        </form>
                      <?php
                      }
                      ?>
                    </div>

                    <div class="col-md-12">
                      <div class="data-list shadow-sm app-sub-heading">
                        <p class="flex-s-b">
                          <span class="w-pr-3 text-left">Sno</span>
                          <span class="w-pr-15 text-left">MemberName</span>
                          <span class="w-pr-10 text-left">Desgination</span>
                          <span class="w-pr-10 text-left">PhoneNumber</span>
                          <span class="w-pr-13 text-left">TotalLeads</span>
                          <span class="w-pr-13 text-left">FollowUps</span>
                          <span class="w-pr-13 text-left">Freshleads</span>
                          <span class="w-pr-13 text-left">TodaysFollowUps</span>
                        </p>
                      </div>
                      <?php

                      if (isset($_GET['view'])) {
                        $UserEmpGroupName = $_GET['view'];
                        $location = $_GET['location'];
                        $search_value = $_GET['search_value'];
                        $search_in = $_GET['search_in'];
                        $AllCustomers = FETCH_DB_TABLE("SELECT * FROM users, user_employment_details where users.UserId=user_employment_details.UserMainUserId and $search_in like '%$search_value%' and UserEmpLocations like '%$location%' and  UserEmpGroupName like '%$UserEmpGroupName%' ORDER BY UserEmpDetailsId Desc limit $start, $listcounts", true);
                      } else {
                        $AllCustomers = FETCH_DB_TABLE("SELECT * FROM users, user_employment_details where users.UserId=user_employment_details.UserMainUserId ORDER BY UserEmpDetailsId Desc limit $start, $listcounts", true);
                      }
                      if ($AllCustomers != null) {
                        $Sno = 0;
                        if (isset($_GET['view_page'])) {
                          $view_page = $_GET['view_page'];
                          if ($view_page == 1) {
                            $Sno = 0;
                          } else {
                            $Sno = $listcounts * ($view_page - 1);
                          }
                        } else {
                          $Sno = $Sno;
                        }
                        foreach ($AllCustomers as $Customers) {
                          $Sno++;
                          $UserMainUserId = $Customers->UserMainUserId;
                      ?>
                          <div class="p-1 mb-1 shadow-sm rounded-2 bg-white data-list">
                            <p class="mb-0 flex-s-b">
                              <span class='w-pr-3'>
                                <?php echo $Sno; ?>
                              </span>
                              <span class='w-pr-18'>
                                <a href="details/?uid=<?php echo SECURE(FETCH("SELECT * FROM users where UserId='$UserMainUserId'", "UserId"), "e"); ?>" class="bold">
                                  <span>
                                    <b>
                                      <?php echo StatusView(FETCH("SELECT UserStatus FROM users where UserId='$UserMainUserId'", "UserStatus")); ?>
                                      <?php echo FETCH("SELECT UserSalutation FROM users where UserId='$UserMainUserId'", "UserSalutation"); ?></span> <?php echo FETCH("SELECT UserFullName FROM users where UserId='$UserMainUserId'", "UserFullName"); ?>
                                  </b>
                                </a>
                              </span>
                              <span class='w-pr-10'>
                                <span><?php echo $Customers->UserEmpGroupName; ?> - <?php echo $Customers->UserEmpLocations; ?></span>
                              </span>
                              <span class='w-pr-10'>
                                <a href="tel:<?php echo FETCH("SELECT * FROM users where UserId='$UserMainUserId'", "UserPhoneNumber"); ?>">
                                  <?php echo FETCH("SELECT * FROM users where UserId='$UserMainUserId'", "UserPhoneNumber"); ?>
                                </a>
                              </span>

                              <span class='w-pr-13'>
                                <span class="text-grey">Total leads :</span>
                                <b><?php echo TOTAL("SELECT * FROM leads where LeadPersonManagedBy='" . $Customers->UserMainUserId . "'"); ?></b>
                              </span>
                              <span class='w-pr-13'>
                                <span class="text-grey">Follow Ups :</span>
                                <b><?php echo TOTAL("SELECT * FROM leads where LeadPersonStatus like '%Follow Up%' and LeadPersonManagedBy='" . $Customers->UserMainUserId . "'"); ?></b>
                              </span>
                              <span class='w-pr-13'>
                                <span class="text-grey">Fresh Leads :</span>
                                <b><?php echo TOTAL("SELECT * FROM leads where LeadPersonStatus like '%Fresh lead%' and LeadPersonManagedBy='" . $Customers->UserMainUserId . "'"); ?></b>
                              </span>
                              <span class='w-pr-13'>
                                <span class="text-grey">Today FollowUps :</span>
                                <b><?php echo TOTAL("SELECT * FROM lead_followups where LeadFollowStatus like '%Follow Up%' and DATE(LeadFollowUpDate)='" . date('Y-m-d') . "' and LeadFollowUpHandleBy='" . $Customers->UserMainUserId . "'"); ?></b>
                              </span>
                            </p>
                          </div>
                      <?php
                        }
                      }
                      ?>
                    </div>
                    <div class="col-md-12 flex-s-b mt-2 mb-1">
                      <div class="">
                        <h6 class="mb-0" style="font-size:0.75rem;color:grey;">Page <b><?php echo IfRequested("GET", "view_page", $page, false); ?></b> from <b><?php echo $NetPages; ?> </b> pages <br>Total <b><?php echo $TotalItems; ?></b> Entries</h6>
                      </div>
                      <div class="flex">
                        <span class="mr-1">
                          <?php
                          if (isset($_GET['view'])) {
                            $viewcheck = "&view=" . $_GET['view'];
                          } else {
                            $viewcheck = "";
                          }
                          ?>
                          <a href="?view_page=<?php echo $previous_page; ?>" class="btn btn-sm btn-default"><i class="fa fa-angle-double-left"></i></a>
                        </span>
                        <form style="padding:0.3rem !important;">
                          <input type="number" name="view_page" onchange="form.submit()" class="form-control form-control-sm mb-0" min="1" max="<?php echo $NetPages; ?>" value="<?php echo IfRequested("GET", "view_page", 1, false); ?>">
                        </form>
                        <span class="ml-1">
                          <a href="?view_page=<?php echo $next_page; ?>" class="btn btn-sm btn-default"><i class="fa fa-angle-double-right"></i></a>
                        </span>
                        <?php if (isset($_GET['view_page'])) { ?>
                          <span class="ml-1">
                            <a href="index.php" class="btn btn-sm btn-danger mb-0"><i class="fa fa-times m-1"></i></a>
                          </span>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>