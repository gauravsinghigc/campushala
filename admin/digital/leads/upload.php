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
                      <h3>Upload Bulk Leads</h3>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-7">
                      <h4 class="app-heading">Upload Leads</h4>
                      <form class="row" action="../../../controller/LeadsController.php" enctype="multipart/form-data" method="POST">
                        <?php FormPrimaryInputs(true); ?>
                        <div class="form-group col-md-6">
                          <label>Select File (.csv)</label>
                          <input type="FILE" name="UploadedFile" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                          <label>Upload Leads For</label>
                          <select class="form-control" name="LeadPersonManagedBy">
                            <?php
                            $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
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
                        <div class="form-group col-md-6">
                          <label>Project Interest</label>
                          <select name="LeadProjectsRef" class="form-control" required="">
                            <option value="0">Select Project</option>
                            <?php
                            $Project = FETCH_DB_TABLE("SELECT * FROM projects ORDER BY ProjectsId DESC", true);
                            if ($Project != null) {
                              foreach ($Project as $Prj) {
                            ?>
                                <option value="<?php echo $Prj->ProjectsId; ?>"><?php echo $Prj->ProjectName; ?></option>
                            <?php
                              }
                            } ?>
                          </select>
                        </div>
                        <div class=" col-md-12">
                          <a href="index.php" class="btn btn-md btn-default mt-3">Back to All Leads</a>
                          <button type="submit" name="UploadLeads" class="btn btn-md btn-dark"><i class="fa fa-upload"></i> Upload & Assign Leads</button>
                          <a href="uploaded-LeadsController.php" class="btn btn-md btn-default mt-3">View Uploaded Leads</a>
                        </div>
                      </form>
                    </div>

                    <div class="col-md-5">
                      <h4 class="app-heading">Upload File Instructions</h4>
                      <ul>
                        <li>File must be in <b>.csv</b> formate</li>
                        <li>file have Fields with header

                          <ul>
                            <li>Name</li>
                            <li>Phone</li>
                            <li>Email</li>
                            <li>Address</li>
                            <li>City</li>
                            <li>Profession</li>
                            <li>Source</li>
                          </ul>
                        </li>
                      </ul>
                      <a style="margin-top:-4rem !important;" href="../../../storage/export/lead-import-formate.csv" download="lead-import-formate.csv" class='pull-right text-dark'><i class='fa fa-download'></i> Download Format</a>
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