<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Calls";
$PageDescription = "Manage all Calls";
$btntext = "Add New Domain";
$DomainExpireInCurrentMonth = date("Y-m-d", strtotime("+1 month"));
$CurrentData = date("Y-m-d");


if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $_SESSION['search'] = $search;
} elseif (isset($_SESSION['search'])) {
  $search = $_SESSION['search'];
} else {
  $search = "";
}
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
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("leads").classList.add("active");
      document.getElementById("all_calls").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
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
                  <div class="row mb-5px">
                    <div class="col-md-8">
                      <div class="mb-3 d-sm-flex fw-bold p-1">
                        <h3><?php echo $PageName; ?></h3>
                      </div>
                    </div>
                    <div class="col-md-4 text-right">
                      <div class="mt-sm-0 mt-2">
                        <a href="#addcallrecords" class="btn btn-md btn-dark" data-toggle="modal"><i class="fa fa-plus"></i> Add Call Records</a>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="rounded-2">
                        <h4 class="app-heading bg-success">All Latest Call Records</h4>
                        <div class="row">
                          <div class="col-md-6 col-xs-6 col-6 mb-5px">
                            <div class="car card-body border-1 rounded-2 shadow-sm">
                              <h2 class="count text-success mb-0"><?php echo TOTAL("SELECT * FROM lead_followups where LeadFollowUpCallType='incoming'"); ?></h2>
                              <p class="mb-0">Incoming Calls</p>
                            </div>
                          </div>
                          <div class="col-md-6 col-xs-6 col-6 mb-5px">
                            <div class="car card-body border-1 rounded-2 shadow-sm">
                              <h2 class="count text-danger mb-0"><?php echo TOTAL("SELECT * FROM lead_followups where LeadFollowUpCallType='outgoing'"); ?></h2>
                              <p class="mb-0">Outgoing Calls</p>
                            </div>
                          </div>
                        </div>
                        <ul class="calling-list">
                          <?php
                          if (LOGIN_UserType == "Admin") {
                            $fetclFollowUps = FETCH_DB_TABLE("SELECT * FROM lead_followups where LeadFollowUpRemindStatus='ACTIVE' ORDER BY LeadFollowUpId DESC", true);
                          } else {
                            $LoginId = LOGIN_UserId;
                            $fetclFollowUps = FETCH_DB_TABLE("SELECT * FROM lead_followups where LeadFollowUpRemindStatus='ACTIVE' and LeadFollowUpHandleBy='$LoginId' ORDER BY LeadFollowUpId DESC", true);
                          }
                          if ($fetclFollowUps != null) {
                            foreach ($fetclFollowUps as $F) { ?>
                              <li>
                                <span><?php echo CallTypes("" . $F->LeadFollowUpCallType . ""); ?></span>
                                <p>
                                  <span style="font-size:1rem;"><b><?php echo DATE_FORMATE("d M, Y", $F->LeadFollowUpCreatedAt); ?> <?php echo DATE_FORMATE("h:m A", $F->LeadFollowUpCreatedAt); ?></b> <span class="text-grey">- <?php echo $F->LeadFollowStatus; ?></span></span><br>
                                  <span style="font-size:1rem;"><?php echo $F->LeadFollowUpDescriptions; ?></span><br>
                                  <span style="font-size:1rem;" class="text-grey">By <?php echo FETCH("SELECT * FROM users where UserId='" . $F->LeadFollowUpHandleBy . "'", "UserFullName"); ?></span>
                                </p>
                              </li>
                          <?php
                            }
                          }
                          ?>

                        </ul>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="rounded-2">
                        <h4 class="app-heading bg-danger">Today Follow Ups</h4>
                        <div class="row">
                          <div class="col-md-6 col-xs-6 col-6 mb-5px">
                            <div class="car card-body border-1 rounded-2 shadow-sm">
                              <h2 class="count text-success mb-0"><?php echo TOTAL("SELECT * FROM lead_followups where DATE(LeadFollowUpDate)<='$CurrentData' and LeadFollowUpRemindStatus='ACTIVE'"); ?></h2>
                              <p class="mb-0">Total Calls</p>
                            </div>
                          </div>
                        </div>
                        <ul class="calling-list">
                          <?php
                          $CurrentData = date("Y-m-d");
                          $FetchCalls = FETCH_DB_TABLE("SELECT * FROM lead_followups where DATE(LeadFollowUpDate)<='$CurrentData' and LeadFollowUpRemindStatus='ACTIVE' ORDER BY LeadFollowUpId  DESC", true);
                          if ($FetchCalls != null) {
                            foreach ($FetchCalls as $F) { ?>
                              <li>
                                <span><?php echo CallTypes("" . $F->LeadFollowUpCallType . ""); ?></span>
                                <p>
                                  <span style="font-size:1rem;"><b><?php echo DATE_FORMATE("d M, Y", $F->LeadFollowUpCreatedAt); ?> <?php echo DATE_FORMATE("h:m A", $F->LeadFollowUpCreatedAt); ?></b> <span class="text-grey">- <?php echo $F->LeadFollowStatus; ?></span></span><br>
                                  <span style="font-size:1rem;"><?php echo $F->LeadFollowUpRemindNotes; ?></span><br>
                                  <span style="font-size:1rem;" class="text-grey">By <?php echo FETCH("SELECT * FROM users where UserId='" . $F->LeadFollowUpHandleBy . "'", "UserFullName"); ?></span>
                                </p>
                              </li>


                          <?php }
                          } ?>

                        </ul>
                      </div>
                    </div>



                  </div>

                </div>
              </div>
            </div>
          </div>
      </section>
    </div>



    <?php
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>