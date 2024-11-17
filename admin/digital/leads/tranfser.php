<?php
$Dir = "../../..";
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

                    <div class="col-md-4">
                      <form action="../../../controller/LeadsController.php" enctype="multipart/form-data" method="POST">
                        <?php
                        if (isset($_GET['continue']) && isset($_GET['selected_leads'])) {
                          foreach ($_GET['selected_leads'] as $key => $Values) { ?>
                            <input type="checkbox" hidden name="Leads[]" checked value="<?php echo $Values; ?>">
                        <?php }
                        } else {
                          $Leads = array();
                        }
                        FormPrimaryInputs(
                          true,
                        ); ?>
                        <h5 class="app-sub-heading">Tranfser Details</h5>
                        <a href="index.php" class="btn btn-sm btn-default"><i class='fa fa-angle-left'></i> Back to All Leads</a>
                        <div class="row">
                          <div class="form-group col-md-12">
                            <label>Transfer Leads in</label>
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
                          <div class="col-md-6 form-group">
                            <label>Lead Stage </label>
                            <select class="form-control form-control-sm" name="LeadPersonStatus">
                              <?php CONFIG_VALUES("LEAD_STAGES"); ?>
                            </select>
                          </div>
                          <div class="col-md-6 form-group">
                            <label>Lead Priority level </label>
                            <select class="form-control form-control-sm" name="LeadPriorityLevel">
                              <?php CONFIG_VALUES("LEAD_PERIORITY_LEVEL"); ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Select Bulk Leads</label>
                          <select name="bulkselect" onchange="CheckSelectionvalue()" id="selectionvalue" class="form-control form-control-sm">
                            <option value="null">Select Leads in counts</option>
                            <?php InputOptions([
                              "10", "20", "30", "50", "70", "100", "custom"
                            ]); ?>
                          </select>
                        </div>
                        <div class="hidden" id="custominput">
                          <label>Enter Custom Value</label>
                          <input type="number" min="1" value="1" class="form-control form-control-sm" name="custom_value">
                        </div>
                        <div class="form-group">
                          <label>Leads Sorted By</label>
                          <select name="sortedby" class="form-control form-control-sm">
                            <option value="ASC">Sort By</option>
                            <?php InputOptions([
                              "ASC",
                              "DESC"
                            ]); ?>
                          </select>
                        </div>
                        <div class="">
                          <button type="submit" name="TransferLeads" class="btn btn-md btn-dark"><i class="fa fa-exchange"></i> Transfer Selected Leads</button>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-8">
                      <h5 class="app-sub-heading">Select Leads for Transfer</h5>
                      <form method="get" action="">
                        <button class="btn btn-sm btn-primary mb-2" name="continue" value="true">Save Selection</button>
                        <?php
                        if (LOGIN_UserType == "Admin") {
                          $AllLeads = TOTAl("SELECT * FROM lead_uploads where LeadStatus='UPLOADED'");
                        } else {
                          $AllLeads = TOTAL("SELECT * FROM lead_uploads where LeadStatus='UPLOADED' and LeadsUploadedfor='" . LOGIN_UserId . "'");
                        }
                        if (isset($_GET['continue']) && isset($_GET['selected_leads'])) {
                          $TotalLeads = 0;
                          foreach ($_GET['selected_leads'] as $key => $values) {
                            $TotalLeads++;
                          }
                        } else {
                          $TotalLeads = 0;
                        }
                        $Left = (int)$AllLeads - (int)$TotalLeads;
                        if (LOGIN_UserType == "Admin") {
                          $TRANSFERRED = TOTAL("SELECT * FROM lead_uploads where LeadStatus='TRANSFERRED'");
                          $All = TOTAL("SELECT * FROM lead_uploads");
                        } else {
                          $TRANSFERRED = TOTAL("SELECT * FROM lead_uploads where LeadStatus='TRANSFERRED' and LeadsUploadedfor='" . LOGIN_UserId . "'");
                          $All = TOTAL("SELECT * FROM lead_uploads where LeadsUploadedfor='" . LOGIN_UserId . "'");
                        }
                        echo "<span class='btn btn-default btn-sm mb-2 mr-1'>All <b>$All</b> leads</span>";
                        echo "<span class='btn btn-default btn-sm mb-2 mr-1'>Transferred <b>$TRANSFERRED</b> leads </span>";
                        echo "<span class='btn btn-default btn-sm mb-2 mr-1'>Available <b>$AllLeads</b> leads</span>";
                        echo "<span class='btn btn-default btn-sm mb-2 mr-1'>Selected Leads <b>$TotalLeads</b> </span>";
                        echo "<span class='btn btn-default btn-sm mb-2 mr-1'>After Select Balance <b>$Left</b> leads </span>";
                        ?>
                        <input type="search" placeholder="Search data..." id='srch' oninput="SearchData('srch', 'list-record')" class="form-control form-control-sm">
                        <?php
                        if (LOGIN_UserType == "Admin") {
                          $Leads = FETCH_DB_TABLE("SELECT * FROM lead_uploads where LeadStatus='UPLOADED' limit 0, 100", true);
                        } else {
                          $Leads = FETCH_DB_TABLE("SELECT * FROM lead_uploads where LeadStatus='UPLOADED' and LeadsUploadedfor='" . LOGIN_UserId . "' limit 0, 100", true);
                        }
                        if ($Leads != null) {
                          $Count = 0;
                          foreach ($Leads as $Data) {
                            $Count++;
                            if (isset($_GET['continue']) && isset($_GET['selected_leads'])) {
                              if (in_array($Data->leadsUploadId, $_GET['selected_leads'])) {
                                $check = "checked";
                              } else {
                                $check = "";
                              }
                            } else {
                              $check = "";
                            } ?>
                            <div class="list-record">
                              <p class="data-list flex-s-b">
                                <span>
                                  <span>
                                    <input type="checkbox" name="selected_leads[]" <?php echo $check; ?> value="<?php echo $Data->leadsUploadId; ?>">
                                  </span>
                                  <?php echo  $Data->LeadsName; ?> |
                                  <?php echo $Data->LeadsPhone; ?> |
                                  <?php echo $Data->LeadsEmail; ?> |
                                  <?php echo $Data->LeadsCity; ?> |
                                  <?php echo $Data->LeadsSource; ?> @ <?php echo DATE_FORMATE("d M, Y", $Data->UploadedOn); ?>
                                </span>
                                <span>
                                  <span class='bg-info text-white p-1 rounded fs-11'><?php echo $Data->LeadStatus; ?></span>
                                </span>
                              </p>
                            </div>
                        <?php }
                        } ?>
                      </form>
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
  <Script>
    function CheckSelectionvalue() {
      var selectionvalue = document.getElementById("selectionvalue");

      if (selectionvalue.value == "custom") {
        document.getElementById("custominput").style.display = "block";
      } else {
        document.getElementById("custominput").style.display = "none";
      }
    }
  </Script>
  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>