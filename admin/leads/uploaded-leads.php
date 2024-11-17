<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Uploaded Leads";
$PageDescription = "Manage all customers";

if (isset($_GET['view'])) {
  $PageName = "All " . ucfirst($_GET['view']) . " Leads";
  $view = "TRANSFERRED";
} else {
  $PageName = "All Uploaded Leads";
  $view = "UPLOADED";
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
                      <h4 class="app-heading"><?php echo $PageName; ?>
                        <?php
                        $CheckReportingManagersStatus = CHECK("SELECT * FROM user_employment_details where UserEmpReportingMember='" . LOGIN_UserId . "'");
                        if ($CheckReportingManagersStatus != NULL) { ?>
                          <a href="tranfser.php" class="btn btn-sm btn-default pull-right"><i class="fa fa-exchange"></i> Transfer leads</a>
                        <?php } ?>
                        <a href="upload.php" class="btn btn-sm btn-default pull-right mr-1"><i class="fa fa-upload"></i> Upload leads</a>
                      </h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-10">
                      <div class="btn-group btn-group-md">
                        <?php if (isset($_GET['UploadedOn'])) {
                          $UploadedOn = $_GET['UploadedOn'];
                        } else {
                          $UploadedOn = date("Y-m-d");
                        } ?>
                        <a href="uploaded-LeadsController.php?all_leads=true" class="btn btn-sm btn-default">All Transffered leads <span class="bg-success p-1 rounded fs-11"><?php echo $sent = TOTAL("SELECT * FROM lead_uploads where LeadStatus='TRANSFERRED'"); ?></span></a>
                        <a href="uploaded-LeadsController.php" class="btn btn-sm btn-default">All Uploaded Leads <span class="bg-primary p-1 rounded fs-11"><?php echo $All = TOTAL("SELECT * FROM lead_uploads where LeadStatus='UPLOADED'"); ?></span></a>
                        <a href="uploaded-LeadsController.php" class="btn btn-sm btn-default">Balance <span class="bg-warning p-1 rounded fs-11"><?php echo (int)$All - (int)$sent; ?></span></a>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <form method="get" action="">
                        <div class="form-group">
                          <input type="date" name="UploadedOn" value="<?php if (isset($_GET['UploadedOn'])) {
                                                                        echo $_GET['UploadedOn'];
                                                                      } else {
                                                                        echo date("Y-m-d");
                                                                      }; ?>" onchange="form.submit()" class="form-control form-control-sm">
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <?php
                      if (LOGIN_UserType == "Admin") {
                        if (isset($_GET['UploadedOn'])) {
                          $UploadedOn = $_GET['UploadedOn'];
                          $TotalItems = TOTAL("SELECT leadsUploadId FROM lead_uploads where LeadStatus='$view' and DATE(UploadedOn)='$UploadedOn'");
                        } else {
                          $UploadedOn = '';
                          $TotalItems = TOTAL("SELECT leadsUploadId FROM lead_uploads where LeadStatus='$view'");
                        }
                      } elseif (isset($_GET['all_leads'])) {
                        $TotalItems = TOTAL("SELECT leadsUploadId FROM lead_uploads", true);
                      } else {
                        if (isset($_GET['UploadedOn'])) {
                          $UploadedOn = $_GET['UploadedOn'];
                          $TotalItems = TOTAL("SELECT leadsUploadId FROM lead_uploads where LeadStatus='$view' and DATE(UploadedOn)='$UploadedOn'");
                        } else {
                          $TotalItems = TOTAL("SELECT leadsUploadId FROM lead_uploads where LeadStatus='$view'");
                        }
                      }
                      //paginations
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
                      $NetPages = round($TotalItems / $listcounts + 0.5);

                      if (LOGIN_UserType == "Admin") {
                        if (isset($_GET['UploadedOn'])) {
                          $UploadedOn = $_GET['UploadedOn'];
                          $Leads = FETCH_DB_TABLE("SELECT * FROM lead_uploads where LeadStatus='$view' and DATE(UploadedOn)='$UploadedOn' limit $start, $listcounts", true);
                        } else {
                          $UploadedOn = '';
                          $Leads = FETCH_DB_TABLE("SELECT * FROM lead_uploads where LeadStatus='$view' limit $start, $listcounts", true);
                        }
                      } elseif (isset($_GET['all_leads'])) {
                        $Leads = FETCH_DB_TABLE("SELECT * FROM lead_uploads limit $start, $listcounts", true);
                      } else {
                        if (isset($_GET['UploadedOn'])) {
                          $UploadedOn = $_GET['UploadedOn'];
                          $Leads = FETCH_DB_TABLE("SELECT * FROM lead_uploads where LeadStatus='$view' and DATE(UploadedOn)='$UploadedOn' limit $start, $listcounts", true);
                        } else {
                          $UploadedOn = "";
                          $Leads = FETCH_DB_TABLE("SELECT * FROM lead_uploads where LeadStatus='$view' limit $start, $listcounts", true);
                        }
                      }
                      if ($Leads != null) {
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
                        foreach ($Leads as $Data) {
                          $Sno++; ?>
                          <p class="data-list flex-s-b">
                            <span>
                              <span class="count"><?php echo $Sno; ?></span>
                              <?php echo  $Data->LeadsName; ?> |
                              <?php echo $Data->LeadsPhone; ?> |
                              <?php echo $Data->LeadsEmail; ?> |
                              <?php echo $Data->LeadsCity; ?> |
                              <?php echo $Data->LeadsSource; ?> @ <?php echo DATE_FORMATE("d M, Y", $Data->UploadedOn); ?>
                              for <span class='text-warning'><?php echo FETCH("SELECT * FROM projects where ProjectsId='" . $Data->LeadProjectsRef . "'", "ProjectName"); ?></span>

                              <br>
                              <span class="text-grey">
                                Uploaded By :
                              </span>
                              <span class="bold">
                                <?php echo FETCH("SELECT * FROM users where UserId='" . $Data->LeadsUploadBy . "'", "UserFullName"); ?>
                              </span>
                              <span class="text-grey">
                                Uploaded For :
                              </span>
                              <span class="bold">
                                <?php echo FETCH("SELECT * FROM users where UserId='" . $Data->LeadsUploadedfor . "'", "UserFullName"); ?>
                              </span>
                            </span>
                            <span>
                              <span class='text-info p-2'><?php echo LeadStatus($Data->LeadStatus); ?></span>
                            </span>
                          </p>
                      <?php }
                      } ?>
                      <div class="col-md-12 flex-s-b mt-2 mb-1">
                        <div class="">
                          <h6 class="mb-0" style="font-size:0.75rem;color:grey;">Page <b><?php echo IfRequested("GET", "view_page", $page, false); ?></b> from <b><?php echo $NetPages; ?> </b> pages <br>Total <b><?php echo $TotalItems; ?></b> entries</h6>
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

    <?php
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>