<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Customers";
$PageDescription = "Manage all customers";
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
      document.getElementById("customers").classList.add("active");
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
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Transfer Leads</h3>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <form action="" method="GET">
                        <h5 class="app-sub-heading">Fetch Leads From</h5>
                        <div class="row">
                          <div class="form-group col-md-12 mb-2">
                            <label>Fetch Leads From</label>
                            <input type="text" list="teammember" class="form-control form-control-sm mb-0" name="From">
                            <datalist id="teammember">
                              <?php
                              if (LOGIN_UserType == "Admin") {
                                $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                              } else {
                                $Users = FETCH_DB_TABLE("SELECT * FROM users, user_employment_details where users.UserId=user_employment_details.UserMainUserId and user_employment_details.UserEmpReportingMember='" . LOGIN_UserId . "' ORDER BY UserFullName ASC", true);
                              }
                              foreach ($Users as $User) {
                                if ($User->UserId == LOGIN_UserId) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                }
                                echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . " - " . FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $User->UserId . "'", "UserEmpGroupName") . "</option>";
                              }
                              ?>
                            </datalist>
                          </div>
                          <input type="text" hidden id="leascurrentstatus" name="LeadPersonSubStatus" value="">
                          <input type="text" hidden id="leasstatus" name="LeadPersonStatus" value="">
                          <div class="col-md-12 col-6 mb-1">
                            <select class="form-control form-control-sm" id="statustype" onchange="CallStatusFunction()">
                              <option value="">Select Lead Status</option>
                              <?php
                              $FetchCallStatus = FETCH_DB_TABLE("SELECT * FROM configs, config_values where configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigGroupName='CALL_STATUS' ORDER BY ConfigValueId DESC", true);
                              if ($FetchCallStatus != null) {
                                foreach ($FetchCallStatus as $CallStatus) { ?>
                                  <option value="<?php echo $CallStatus->ConfigValueId; ?>"><?php echo $CallStatus->ConfigValueDetails; ?></option>
                              <?php
                                }
                              } ?>
                            </select>
                          </div>
                          <div class="col-md-12 col-6 mb-1">
                            <?php
                            $FetchCallStatus = FETCH_DB_TABLE(CONFIG_DATA_SQL("CALL_STATUS"), true);
                            if ($FetchCallStatus != null) {
                              foreach ($FetchCallStatus as $Status) {
                                if ($Status->ConfigValueId == "50") {
                                  $display = "block";
                                } else {
                                  $display = "none";
                                } ?>
                                <select onchange="GetValue_<?php echo $Status->ConfigValueId; ?>()" class="form-control form-control-sm" id="view_<?php echo $Status->ConfigValueId; ?>" style="display:<?php echo $display; ?>;">
                                  <option value="0">Select Call Status</option>
                                  <?php
                                  $FetchCallStatus = FETCH_DB_TABLE("SELECT * FROM configs, config_values where config_values.ConfigReferenceId='" . $Status->ConfigValueId . "' and configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigGroupName='CALL_STATUS_SUB_FIELDS'", true);
                                  if ($FetchCallStatus != null) {
                                    foreach ($FetchCallStatus as $CallStatus) { ?>
                                      <option value="<?php echo $CallStatus->ConfigValueDetails; ?>"><?php echo $CallStatus->ConfigValueDetails; ?></option>
                                  <?php
                                    }
                                  } ?>
                                </select>
                                <script>
                                  function GetValue_<?php echo $Status->ConfigValueId; ?>() {
                                    var leascurrentstatus = document.getElementById("leascurrentstatus")
                                    leascurrentstatus.value = document.getElementById("view_<?php echo $Status->ConfigValueId; ?>").value;
                                  }
                                </script>
                            <?php
                              }
                            } ?>
                          </div>
                          <div class="col-md-12 col-6">
                            <input type="text" value="" name="LeadPriorityLevel" list="LeadPriorityLevel" class="form-control form-control-sm" placeholder="Priority Level">
                            <?php SUGGEST("leads", "LeadPriorityLevel", "ASC"); ?>
                          </div>
                          <div class="col-md-12 col-6">
                            <input type="text" value="" name="LeadPersonSource" list="LeadPersonSource" class="form-control form-control-sm" placeholder="Lead Source">
                            <?php SUGGEST("leads", "LeadPersonSource", "ASC"); ?>
                          </div>
                        </div>
                        <div class="">
                          <a href="index.php" class="btn btn-sm btn-default"><i class="fa fa-angle-left"></i> Back to Leads</a>
                          <button type="submit" name="GetLeadsFrom" value="true" class="btn btn-sm btn-dark"><i class="fa fa-refresh"></i> Fetch leads</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-6">
                      <h5 class="app-sub-heading">Available Leads</h5>
                      <?php

                      if (isset($_GET['GetLeadsFrom'])) {
                        $GetLeadsFrom = $_GET['GetLeadsFrom'];
                        $From = $_GET['From'];
                        $LeadPersonSubStatus = $_GET['LeadPersonSubStatus'];
                        $LeadPersonStatus = $_GET['LeadPersonStatus'];
                        $LeadPriorityLevel = $_GET['LeadPriorityLevel'];
                        $LeadPersonSource = $_GET['LeadPersonSource'];

                        //store request parameters into session 
                        $_SESSION['GetLeadsFrom'] = $GetLeadsFrom;
                        $_SESSION['From'] = $From;
                        $_SESSION['LeadPersonSubStatus'] = $LeadPersonSubStatus;
                        $_SESSION['LeadPersonStatus'] = $LeadPersonStatus;
                        $_SESSION['LeadPriorityLevel'] = $LeadPriorityLevel;
                        $_SESSION['LeadPersonSource'] = $LeadPersonSource;

                        //run last requested parameters and get data accordingly
                      } elseif (isset($_SESSION['GetLeadsFrom'])) {
                        $GetLeadsFrom = $_SESSION['GetLeadsFrom'];
                        $From = $_SESSION['From'];
                        $LeadPersonSubStatus = $_SESSION['LeadPersonSubStatus'];
                        $LeadPersonStatus = $_SESSION['LeadPersonStatus'];
                        $LeadPriorityLevel = $_SESSION['LeadPriorityLevel'];
                        $LeadPersonSource = $_SESSION['LeadPersonSource'];

                        //make null for request parameters in case of no selection
                      } else {
                        $GetLeadsFrom = '';
                        $From = '';
                        $LeadPersonSubStatus = '';
                        $LeadPersonStatus = '';
                        $LeadPriorityLevel = '';
                        $LeadPersonSource = '';
                      }
                      ?>
                      <div class="p-1">
                        <input type="search" placeholder="Search data..." id='srch' oninput="SearchData('srch', 'list-record')" class="form-control form-control-sm">
                      </div>
                      <form action="../../controller/LeadsController.php" method="POST">
                        <?php FormPrimaryInputs(true, [
                          "From" => IfRequested("GET", "From", "null", false),
                          "LeadPersonSubStatus" => IfRequested("GET", "LeadPersonSubStatus", "null", false),
                          "LeadPersonStatus" => IfRequested("GET", "LeadPersonStatus", "null", false),
                          "LeadPriorityLevel" => IfRequested("GET", "LeadPriorityLevel", "null", false),
                          "LeadPersonSource" => IfRequested("GET", "LeadPersonSource", "null", false)
                        ]); ?>
                        <?php
                        //get lead data
                        $CountTotalLeads = TOTAL("SELECT * FROM leads WHERE LeadPersonManagedBy='$From' and LeadPersonSource like '%$LeadPersonSource%' and LeadPriorityLevel like '%$LeadPriorityLevel%' and LeadPersonSubStatus like '%$LeadPersonSubStatus%' and LeadPersonStatus LIKE '%$LeadPersonStatus%' GROUP BY LeadsId ORDER by LeadsId DESC");
                        $TotalItems = $CountTotalLeads;

                        //paginations
                        $start = 0;
                        $end = 50;
                        $view_page = 1;
                        $listcounts = $end;
                        if (isset($_GET['view_page'])) {
                          $view_page = (int)$_GET['view_page'];
                          if ($view_page != 1) {
                            $start = $view_page * $end;
                            $end = $start + $end;
                            $next_page = $view_page + 1;
                            $previous_page = $view_page - 1;
                          } else {
                            $next_page = $view_page + 1;
                            $previous_page = 1;
                          }
                        } else {
                          $next_page = $view_page + 1;
                          $previous_page = 1;
                        }
                        $NetPages = round((int)$TotalItems / $listcounts);
                        if ($NetPages == 0) {
                          $NetPages = 1;
                        } else {
                          $NetPages = $NetPages;
                        }
                        $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads WHERE LeadPersonManagedBy='$From' and LeadPersonSource like '%$LeadPersonSource%' and LeadPriorityLevel like '%$LeadPriorityLevel%' and LeadPersonSubStatus like '%$LeadPersonSubStatus%' and LeadPersonStatus LIKE '%$LeadPersonStatus%' GROUP BY LeadsId ORDER by LeadsId DESC limit $start, $listcounts", true);
                        $Count = 0;
                        if (isset($_GET['view_page'])) {
                          if ($view_page == 1) {
                            $Count = 0;
                          } elseif ($view_page != 1) {
                            $Count = 50 * ($view_page - 1);
                          } else {
                            $Count = $start;
                          }
                        } else {
                          $Count = $Count;
                        }
                        if ($next_page == $NetPages) {
                          $next_page = $NetPages;
                        } else {
                          $next_page = $next_page;
                        }
                        if ($GetLeads == null) {
                          NoData("No Leads Found!");
                        } else {
                          echo "<p class='mb-1 ml-2'>Select leads for move into another account/user</p>
                          <span class='btn btn-sm btn-default ml-2 mb-2'>Total <b>$CountTotalLeads</b> leads found!</span>
                          ";
                          foreach ($GetLeads as $leads) {
                            $Count++;
                            $LeadPersonCreatedBy = $leads->LeadPersonCreatedBy;
                            $LeadsId = $leads->LeadsId;
                            $FollowUpsSQL = "SELECT * FROM lead_followups where LeadFollowMainId='$LeadsId'";
                            $LeadFollowUpDate = FETCH($FollowUpsSQL, "LeadFollowUpDate");
                            $LeadFollowUpTime = FETCH($FollowUpsSQL, "LeadFollowUpTime");
                            $lead_requirements = CHECK("SELECT * FROM lead_requirements where leadMainId='$LeadsId'");
                            include "../../include/admin/common/send-lead-list.php";
                          }
                        }
                        ?>
                        <div class="col-md-12 flex-s-b mt-2 mb-1">
                          <div class="">
                            <h6 class="mb-0" style="font-size:0.75rem;color:grey;">Page <b><?php echo IfRequested("GET", "view_page", $view_page, false); ?></b> from <b><?php echo $NetPages; ?> </b> pages <br>Total <b><?php echo $TotalItems; ?></b> Entries</h6>
                          </div>
                          <div class="flex">
                            <span class="mr-1">
                              <a href="?view_page=<?php echo $previous_page; ?>" class="btn btn-sm btn-default"><i class="fa fa-angle-double-left"></i></a>
                            </span>
                            <span>
                              <span class='btn btn-sm btn-success'><?php echo $view_page; ?></span>
                            </span>
                            <span class="ml-1">
                              <a href="?view_page=<?php echo $next_page; ?>" class="btn btn-sm btn-default"><i class="fa fa-angle-double-right"></i></a>
                            </span>
                            <?php if (isset($_GET['view_page'])) { ?>
                              <span class="ml-1">
                                <a href="send.php" class="btn btn-sm btn-danger mb-0"><i class="fa fa-times m-1"></i></a>
                              </span>
                            <?php } ?>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                      <h5 class="app-sub-heading">Move Leads In</h5>
                      <?php if (isset($_SESSION['GetLeadsFrom'])) { ?>
                        <div class="form-group">
                          <label>Move Leads From</label>
                          <p class="data-list">
                            <span class="text-grey">Name</span><br>
                            <span><?php echo FETCH("SELECT * FROM users where UserId='$From'", "UserFullName"); ?></span>
                          </p>
                          <p class="data-list">
                            <span class="text-grey">Phone Number</span><br>
                            <span><?php echo FETCH("SELECT * FROM users where UserId='$From'", "UserPhoneNumber"); ?></span>
                          </p>
                          <p class="data-list">
                            <span class="text-grey">Email-id</span><br>
                            <span><?php echo FETCH("SELECT * FROM users where UserId='$From'", "UserEmailId"); ?></span>
                          </p>
                        </div>
                        <div class="form-group">
                          <label>Move Leads In</label>
                          <select class="form-control form-control-sm" name="LeadPersonManagedBy">
                            <?php
                            if (LOGIN_UserType == "Admin") {
                              $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                            } else {
                              $Users = FETCH_DB_TABLE("SELECT * FROM users, user_employment_details where users.UserId=user_employment_details.UserMainUserId and user_employment_details.UserEmpReportingMember='" . LOGIN_UserId . "' ORDER BY UserFullName ASC", true);
                            }
                            foreach ($Users as $User) {
                              if ($User->UserId == LOGIN_UserId) {
                                $selected = "selected";
                              } else {
                                $selected = "";
                              }
                              echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . " - " . FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $User->UserId . "'", "UserEmpGroupName") . "</option>";
                            }
                            ?>
                          </select>
                        </div>
                        <div class="mt-2">
                          <button type="submit" name="MoveLeads" class="btn btn-md btn-success"> Move leads <i class="fa fa-exchange"></i></button>
                        </div>
                      <?php } else { ?>
                        <p>Please fetch some leads firsts..</p>
                      <?php } ?>
                    </div>
                    </form>
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
  <script>
    function CallStatusFunction() {
      var statustype = document.getElementById("statustype");
      <?php
      $FetchCallStatus = FETCH_DB_TABLE("SELECT * FROM configs, config_values where configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigGroupName='CALL_STATUS' ORDER BY ConfigValueId DESC", true);
      if ($FetchCallStatus != null) {
        foreach ($FetchCallStatus as $CallStatus) { ?>
          if (statustype.value == <?php echo $CallStatus->ConfigValueId; ?>) {
            document.getElementById("view_<?php echo $CallStatus->ConfigValueId; ?>").style.display = "block";
            document.getElementById("leasstatus").value = "<?php echo $CallStatus->ConfigValueDetails; ?>";
          } else {
            document.getElementById("view_<?php echo $CallStatus->ConfigValueId; ?>").style.display = "none";
          }
      <?php }
      } ?>
    }
  </script>
  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>