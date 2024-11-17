<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "ADD New Lead";
$PageDescription = "Manage all leads";
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
      document.getElementById("leads_add").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
  <style>
    .form-group {
      margin-bottom: 0px !important;
    }
  </style>
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
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-heading"><?php echo $PageName; ?> <small>| <?php echo $PageDescription; ?></small></h4>
                </div>
              </div>
              <form action=" <?php echo CONTROLLER; ?>/LeadsController.php" method="POST">
                <?php FormPrimaryInputs(true); ?>
                <div class="row">
                  <div class="col-md-7">
                    <h5 class="app-sub-heading">New Lead Details</h5>
                    <div class="row mb-5px">
                      <div class="form-group col-md-3">
                        <label>Salutation</label>
                        <select name="LeadSalutations" class="form-control">
                          <option value="Mr." selected>Mr</option>
                          <option value="Mrs.">Mrs</option>
                          <option value="Miss.">Miss</option>
                          <option value="Ms.">Ms</option>
                          <option value="Dr.">Dr</option>
                          <option value="Prof.">Prof</option>
                          <option value="Sir.">Sir</option>
                        </select>
                      </div>
                      <div class="form-group col-md-9">
                        <label>Full Name</label>
                        <input type="text" name="LeadPersonFullname" list="LeadPersonFullname" class="form-control" placeholder="Gaurav Singh" required="">
                      </div>
                    </div>

                    <div class="row mb-5px">
                      <div class="form-group col-md-5">
                        <label>Phone Number</label>
                        <input type="phone" name="LeadPersonPhoneNumber" list="LeadPersonPhoneNumber" placeholder="without +91" class="form-control" required="">
                        <?php SUGGEST("leads", "LeadPersonPhoneNumber", "ASC"); ?>
                      </div>
                      <div class="form-group col-md-7">
                        <label>Email</label>
                        <input type="email" name="LeadPersonEmailId" list="LeadPersonEmailId" class="form-control" placeholder="example@domain.tld">
                      </div>
                    </div>
                    <div class="row mb-5px">
                      <div class="form-group col-md-4">
                        <label>Lead Stage </label>
                        <select class="form-control" name="LeadPersonStatus">
                          <?php CONFIG_VALUES("LEAD_STAGES"); ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Lead Priority level </label>
                        <select class="form-control" name="LeadPriorityLevel">
                          <?php CONFIG_VALUES("LEAD_PERIORITY_LEVEL"); ?>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label>Lead Source </label>
                        <select class="form-control" name="LeadPersonSource">
                          <?php CONFIG_VALUES("LEAD_SOURCES"); ?>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-5px">
                      <div class="form-group col-md-12">
                        <label>Address</label>
                        <textarea name="LeadPersonAddress" row="3" class="form-control" placeholder="Address"></textarea>
                      </div>
                    </div>

                    <div class="row mb-5px">
                      <div class="form-group col-md-6">
                        <label>Lead Created By</label>
                        <select class="form-control" name="LeadPersonCreatedBy">
                          <?php
                          $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                          foreach ($Users as $User) {
                            if ($User->UserId == LOGIN_UserId) {
                              $selected = "selected";
                            } else {
                              $selected = "";
                            }
                            echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Lead Assigned To</label>
                        <select class="form-control" name="LeadPersonManagedBy">
                          <?php
                          $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                          foreach ($Users as $User) {
                            if ($User->UserId == LOGIN_UserId) {
                              $selected = "selected";
                            } else {
                              $selected = "";
                            }
                            echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-5px">
                      <div class="form-group col-md-12">
                        <label>Notes/Remarks</label>
                        <textarea name="LeadPersonNotes" class="form-control" rows="3"></textarea>
                      </div>
                    </div>

                    <div class="row mb-5px">
                      <div class="col-md-12">
                        <a href='index.php' class="btn btn-md btn-default mt-3"><i class="fa fa-angle-left"></i> Back to All Leads</a>
                        <button class="btn btn-md btn-dark" name="CreateLeads" TYPE="submit"><i class="fa fa-check"></i> Save Lead Record</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <h4 class="app-heading">Select Need & Requirements</h4>
                    <div class="row mb-5px pt-3">
                      <?php
                      $Requirement = FETCH_DB_TABLE("SELECT * FROM projects", true);
                      foreach ($Requirement as $List) {
                        $ProjectType = FETCH("SELECT * FROM config_values where ConfigValueId='" . $List->ProjectTypeId . "'", "ConfigValueDetails");
                        echo "
                  <div class='form-group col-md-12'>
                  <div class='form-check form-check-inline'>
                  <input class='form-check-input checkbox-list mt-0' type='checkbox' name='LeadRequirementDetails[]' value='" . $List->ProjectName . " - $ProjectType'>
                  <h6 class='form-check-label text-grey mb-0'>" . $List->ProjectName . " - <i class='text-grey'>$ProjectType</i></h6>
                  </div>
                  </div>";
                      } ?>
                    </div>

                  </div>
                </div>
              </form>
            </div>
          </div>
          <script>
            function CheckCallStatus() {
              var call_status = document.getElementById("call_status");
              if (call_status.value == "FollowUp" ||
                call_status.value == "Follow Up" ||
                call_status.value == "follow up" ||
                call_status.value == "Follow up") {
                document.getElementById("call_reminder").classList.remove("hidden");
              } else {
                document.getElementById("call_reminder").classList.add("hidden");
              }
            }
          </script>
        </div>
      </section>
    </div>

    <?php include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>