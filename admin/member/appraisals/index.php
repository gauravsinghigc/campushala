<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Appraisals";
$PageDescription = "Manage all customers";
$UserAppraisalRefNo = "#APR" . date("dmy") . rand(0, 9999);
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
      document.getElementById("expanses").classList.add("active");
      document.getElementById("all_expanses").classList.add("active");
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
                      <h2 class="app-heading"><?php echo $PageName; ?></h2>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-6">
                      <div class="card p-2">
                        <h1><?php echo TOTAL("SELECT * FROM user_appraisals where UserAppraisalMainUserId='" . LOGIN_UserId . "'"); ?></h1>
                        <p class="text-gray">All Appraisals</p>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                      <div class="card p-2">
                        <h1><?php echo TOTAL("SELECT * FROM user_appraisals where UserAppraisalMainUserId='" . LOGIN_UserId . "' and DATE(UserAppraisalDate)='" . date('Y-m-d') . "'"); ?></h1>
                        <p class="text-gray">Today Appraisals</p>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                      <div class="card p-2">
                        <h1><?php echo TOTAL("SELECT * FROM user_appraisals where UserAppraisalMainUserId='" . LOGIN_UserId . "' and YEAR(UserAppraisalDate)='" . date('Y') . "' and MONTH(UserAppraisalDate)='" . date('m') . "'"); ?></h1>
                        <p class="text-gray">Current Month Appraisals</p>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                      <div class="card p-2">
                        <h1><?php echo TOTAL("SELECT * FROM user_appraisals where UserAppraisalMainUserId='" . LOGIN_UserId . "' and YEAR(UserAppraisalDate)='" . date('Y') . "'"); ?></h1>
                        <p class="text-gray">This Year Appraisals</p>
                      </div>
                    </div>
                  </div>

                  <form class="row mt-2">
                    <div class="col-md-4 form-group">
                      <input type="search" value="<?php echo IfRequested("GET", "UserAppraisalName", "", false); ?>" name="UserAppraisalName" class="form-control form-control-sm" placeholder="Search appraisals by name...." onchange="form.submit()">
                    </div>
                    <?php if (isset($_GET['UserAppraisalName'])) {
                    ?>
                      <div class="col-md-4">
                        <a href="index.php" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Clear Filter</a>
                      </div>
                    <?php
                    } ?>
                  </form>

                  <div class="row">
                    <div class="col-md-12">
                      <p class='data-list flex-s-b app-sub-heading'>
                        <span class="w-pr-3 text-left">Sno</span>
                        <span class="w-pr-20">AppraisalName</span>
                        <span class="w-pr-10">AppraisalDate</span>
                        <span class="w-pr-10">CreatedAt</span>
                        <span class="w-pr-10">ViewStatus</span>
                        <span class="w-pr-15">ViewAt</span>
                        <span class="w-pr-5 text-right">Action</span>
                      </p>
                    </div>
                    <?php
                    $start = START_FROM;
                    $end = DEFAULT_RECORD_LISTING;

                    if (isset($_GET['UserAppraisalName'])) {
                      $TotalItems = TOTAL("SELECT * FROM user_appraisals where UserAppraisalMainUserId='" . LOGIN_UserId . "' and UserAppraisalName like '%" . $_GET['UserAppraisalName'] . "%' ORDER by DATE(UserAppraisalDate) DESC");
                    } else {
                      $TotalItems = TOTAL("SELECT * FROM user_appraisals where UserAppraisalMainUserId='" . LOGIN_UserId . "' ORDER by DATE(UserAppraisalDate) DESC limit $start, $end");
                    }

                    if (isset($_GET['UserAppraisalName'])) {
                      $AllRewards = FETCH_DB_TABLE("SELECT * FROM user_appraisals where UserAppraisalMainUserId='" . LOGIN_UserId . "' and UserAppraisalName like '%" . $_GET['UserAppraisalName'] . "%' ORDER by DATE(UserAppraisalDate) DESC", true);
                    } else {
                      $AllRewards = FETCH_DB_TABLE("SELECT * FROM user_appraisals where UserAppraisalMainUserId='" . LOGIN_UserId . "' ORDER by DATE(UserAppraisalDate) DESC limit $start, $end", true);
                    }
                    if ($AllRewards == null) {
                      NoData("No rewards found!");
                    } else {
                      $SerialNo = SERIAL_NO;
                      foreach ($AllRewards as $Reward) {
                        $SerialNo++;
                    ?>
                        <div class="col-md-12">
                          <div class="data-list flex-s-b">
                            <span class="w-pr-3 text-left"><?php echo $SerialNo; ?></span>
                            <span class="w-pr-20">
                              <a href="#" onclick="Databar('update_<?php echo $Reward->UserAppraisalId; ?>')" class="text-primary">
                                <?php echo $Reward->UserAppraisalName; ?>
                              </a>
                            </span>
                            <span class="w-pr-10">
                              <?php echo DATE_FORMATE("d M, Y", $Reward->UserAppraisalDate); ?>
                            </span>
                            <span class="w-pr-10">
                              <?php echo DATE_FORMATE("d M, Y", $Reward->UserAppraisalDate); ?>
                            </span>
                            <span class="w-pr-10">
                              <?php echo $Reward->UserAppraisalStatus; ?>
                            </span>
                            <span class="w-pr-15">
                              <?php echo DATE_FORMATE("d M, Y", $Reward->UserAppraisalViewAt); ?>
                            </span>
                            <span class="w-pr-5 text-right">
                              <a href="#" onclick="Databar('update_<?php echo $Reward->UserAppraisalId; ?>')" class="text-info">Details</a>
                            </span>
                          </div>
                        </div>
                    <?php
                      }
                    }
                    PaginationFooter($TotalItems, "index.php"); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php
    include $Dir . "/include/sections/Add-New-Appraisals.php";
    include $Dir . "/include/admin/footer.php";
    ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>