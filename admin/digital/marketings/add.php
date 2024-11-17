<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "ADD Marketing Collaterals";
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
      document.getElementById("profile").classList.add("active");
      document.getElementById("profile_view").classList.add("active");
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
                      <h5 class='app-heading'>
                        <?php echo $PageName; ?>
                      </h5>
                    </div>
                    <div class="col-md-12">
                      <a href="index.php" class='btn btn-sm btn-default'><i class='fa fa-angle-left'></i> Back to All Marketing Collaterals</a>
                    </div>
                  </div>

                  <form action="../../controller/MarketingCollateralController.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="form-group col-md-4">
                        <label>Project Name <?php echo $req; ?></label>
                        <select class="form-control form-control-sm" name="MarketingCoProjectName" required="">
                          <option value="0">Select Project</option>
                          <?php
                          $Alldata = FETCH_DB_TABLE("SELECT * FROM projects ORDER BY ProjectName ASC", true);
                          if ($Alldata != null) {
                            foreach ($Alldata as $data) {
                          ?>
                              <option value="<?php echo $data->ProjectsId; ?>"><?php echo $data->ProjectName; ?></option>
                          <?php
                            }
                          } ?>
                        </select>
                      </div>

                      <div class="col-md-3 form-group">
                        <label>Posted On <?php echo $req; ?></label>
                        <input type="text" value="" list="MaterialName" name="MaterialName" class="form-control form-control-sm" required="">
                        <?php SUGGEST("marketing_collaterals", "MaterialName", "ASC"); ?>
                      </div>
                      <div class="col-md-2 form-group">
                        <label>Allotment Date <?php echo $req; ?></label>
                        <input type="date" value="<?php echo date("Y-m-d"); ?>" name="AllotmentDate" class="form-control form-control-sm" required="">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>No of Materials <?php echo $req; ?></label>
                        <input type="number" value="" list="NumberOfMarketingMaterial" name="NumberOfMarketingMaterial" class="form-control form-control-sm" required="">
                      </div>
                      <div class="col-md-3 form-group">
                        <label>Amount <?php echo $req; ?></label>
                        <input type="number" value="1" min="1" name="Amount" class="form-control form-control-sm" required="">
                      </div>
                      <div class="form-group col-md-6">
                        <label>Issue To <?php echo $req; ?></label>
                        <input type="text" name="IssuedTo" list="CompaignForUserIds" class="form-control form-control-sm" required="">
                        <datalist id="CompaignForUserIds">
                          <?php
                          $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                          foreach ($Users as $User) {
                            echo "<option value='" . $User->UserId . " - " . $User->UserFullName . "'></option>";
                          }
                          ?>
                        </datalist>
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Add Notes</label>
                        <textarea name="NoteAndRemarks" class="form-control form-control-sm" rows="4"></textarea>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="SaveDetails" class="btn btn-md btn-success"><i class="fa fa-check"></i> Save Details</button>
                      </div>
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

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>