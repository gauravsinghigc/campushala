<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Start Calling";
$PageDescription = "Manage all domains";
$btntext = "Add New Leads";
$DomainExpireInCurrentMonth = date("Y-m-d", strtotime("+1 month"));

if (isset($_GET['type'])) {
  $type = $_GET['type'];
  $from = $_GET['from'];
  $to = $_GET['to'];
  $by = $_GET['by'];
  $level = $_GET['level'];
  $LeadPersonSource = $_GET['LeadPersonSource'];
} else {
  $type = "";
  $from = date("Y-m-d");
  $to = date("Y-m-d");
  $by = "1";
  $level = "";
  $LeadPersonSource = "";
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
      document.getElementById("lead_add_calls").classList.add("active");
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
                      <h3 class="app-heading"><?php echo $PageName; ?></h3>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-12 col-12">
                      <form class="row">
                        <div class="col-md-2 col-6 flex-s-b">
                          <label class="p-1">Type</label>
                          <select class="form-control form-control-sm" onchange="form.submit()" name="type">
                            <option value="">All Leads</option>
                            <?php
                            $LeadStages = FETCH_DB_TABLE(CONFIG_DATA_SQL("LEAD_STAGES"), true);
                            if ($LeadStages != null) {
                              foreach ($LeadStages as $Stages) {
                                if ($type == $Stages->ConfigValueDetails) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                } ?>
                                <option value="<?php echo ucfirst($Stages->ConfigValueDetails); ?>" <?php echo $selected; ?>><?php echo $Stages->ConfigValueDetails; ?></option>
                            <?php
                              }
                            }  ?>
                          </select>
                        </div>
                        <div class="col-md-2 col-6 flex-s-b">
                          <label class="p-1">From</label>
                          <input type="date" onchange="form.submit()" name="from" value="<?php echo $from; ?>" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-2 col-6 flex-s-b">
                          <label class="p-1">to</label>
                          <input type="date" onchange="form.submit()" name="to" value="<?php echo $to; ?>" class="form-control form-control-sm">
                        </div>
                        <div class="col-md-2 col-6 flex-s-b">
                          <label class="p-1">By</label>
                          <select name="by" onchange="form.submit()" class="form-control form-control-sm">
                            <option value="">All Team</option>
                            <?php
                            $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                            foreach ($Users as $User) {
                              if ($User->UserId == $by) {
                                $selected = "selected";
                              } else {
                                $selected = "";
                              }
                              echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . " - " . FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $User->UserId . "'", "UserEmpGroupName") . "</option>";
                            }
                            ?>
                          </select>
                        </div>
                        <div class="col-md-2 col-6 flex-s-b">
                          <label class="p-1">Priority</label>
                          <select name="level" onchange="form.submit()" class="form-control form-control-sm">
                            <option value="">All levels</option>
                            <?php
                            $LeadStages = FETCH_DB_TABLE(CONFIG_DATA_SQL("LEAD_PERIORITY_LEVEL"), true);
                            if ($LeadStages != null) {
                              foreach ($LeadStages as $Stages) {
                                if ($level == $Stages->ConfigValueDetails) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                } ?>
                                <option value="<?php echo $Stages->ConfigValueDetails; ?>" <?php echo $selected; ?>><?php echo $Stages->ConfigValueDetails; ?></option>
                            <?php
                              }
                            }  ?>
                          </select>
                        </div>
                        <div class="col-md-2 col-6 flex-s-b">
                          <label class="p-1">Source</label>
                          <select name="LeadPersonSource" onchange="form.submit()" class="form-control form-control-sm">
                            <option value="">All Source</option>
                            <?php
                            $LeadStages = FETCH_DB_TABLE(CONFIG_DATA_SQL("LEAD_SOURCES"), true);
                            if ($LeadStages != null) {
                              foreach ($LeadStages as $Stages) {
                                if ($LeadPersonSource == $Stages->ConfigValueDetails) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                } ?>
                                <option value="<?php echo $Stages->ConfigValueDetails; ?>" <?php echo $selected; ?>><?php echo $Stages->ConfigValueDetails; ?></option>
                            <?php
                              }
                            }  ?>
                          </select>
                        </div>
                        <div class="col-md-2 col-6 flex-s-b mb-2">
                          <?php if (isset($_GET['type'])) {
                          ?>
                            <a href="index.php" class="btn btn-sm btn-danger">Clear Filters <i class="fa fa-times"></i></a>
                          <?php
                          } ?>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="row">
                    <?php
                    if (isset($_GET['view'])) {
                      if (isset($_GET['view'])) {
                        $view = $_GET['view'];
                      } else {
                        $view = "";
                      }
                      $LOGIN_UserId = LOGIN_UserId;
                      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserId' and LeadPersonStatus like '%$view%' ORDER by LeadsId DESC", true);
                    } elseif (isset($_GET['type'])) {
                      $type = $_GET['type'];
                      $from = $_GET['from'];
                      $to = $_GET['to'];
                      $by = $_GET['by'];
                      $level = $_GET['level'];
                      $LeadPersonSource = $_GET['LeadPersonSource'];
                      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads where LeadPersonSource like '%$LeadPersonSource%' and date(LeadPersonCreatedAt)>='$from' and date(LeadPersonCreatedAt)<='$to' and LeadPersonStatus like '%$type%' and LeadPersonManagedBy='$by' and LeadPriorityLevel like '%$level%' ORDER by LeadsId DESC", true);
                    } else {
                      $LOGIN_UserId = LOGIN_UserId;
                      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserId' and LeadPersonStatus NOT LIKE '%Junk%' and LeadPersonStatus NOT LIKE '%NOT Interested%' ORDER by LeadsId DESC", true);
                    }


                    if ($GetLeads == null) { ?>
                      <div class="col-md-12">
                        <div class="card card-body border-0 shadow-sm">
                          <div class="text-left">
                            <h1><i class="fa fa-globe fa-spin display-4 text-success"></i></h1>
                            <h4 class="text-muted">No leads found</h4>
                            <p class="text-muted">You can add a new lead by clicking the button above.</p>
                            <a href="add.php" class="btn btn-md btn-primary">Add leads</a>
                          </div>
                        </div>
                      </div>
                      <?php } else {
                      $Count = 0;
                      foreach ($GetLeads as $leads) {
                        $Count++;
                        $LeadPersonCreatedBy = $leads->LeadPersonCreatedBy;
                      ?>
                        <div class="col-md-12">
                          <a class="w-100" href="../leads/details/index.php?LeadsId=<?php echo SECURE($leads->LeadsId, "e"); ?>">
                            <p class="data-list flex-s-b p-2" style="font-size:1.4rem !important;">
                              <span>
                                <span class="">
                                  <?php echo $Count; ?> -
                                  <?php echo $leads->LeadSalutations; ?> <?php echo $leads->LeadPersonFullname; ?>
                                  <?php if (DEVICE_TYPE != "Computer") {
                                    echo "<br>";
                                  } else {
                                    echo "@";
                                  } ?>
                                  +91<?php echo $leads->LeadPersonPhoneNumber; ?>
                                </span>
                                <span class="text-grey">
                                  <?php echo FETCH("SELECT * FROM lead_followups where LeadFollowMainId='" . $leads->LeadsId . "' ORDER BY LeadFollowUpId DESC", "LeadFollowCurrentStatus"); ?>
                                </span>
                              </span>
                              <span class="mt-2px">
                                <ul class="call-activity">
                                  <li>
                                    <a href="tel:+91<?php echo $leads->LeadPersonPhoneNumber; ?>">
                                      <img src="<?php echo STORAGE_URL_D; ?>/tool-img/call.png">
                                    </a>
                                  </li>
                                  <li>
                                    <a href="https://api.whatsapp.com/send?phone=91<?php echo $leads->LeadPersonPhoneNumber; ?>&text=Hey <?php echo $leads->LeadPersonFullname; ?>,">
                                      <img src="<?php echo STORAGE_URL_D; ?>/tool-img/whatsapp.png">
                                    </a>
                                  </li>
                                </ul>
                              </span>
                            </p>
                          </a>
                        </div>
                      <?php } ?>
                    <?php } ?>
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