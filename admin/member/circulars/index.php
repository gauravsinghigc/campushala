<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Circulars";
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
                      <h4 class="app-heading"><?php echo $PageName; ?></h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-12">
                          <p class="data-list bg-dark text-white flex-s-b">
                            <span class="w-pr-5">SNo</span>
                            <span class="w-pr-30">CircularName</span>
                            <span class="w-pr-15">CreateDate</span>
                            <span class="w-pr-10">Status</span>
                            <span class="w-pr-10">Action</span>
                          </p>
                        </div>
                        <?php
                        $start = START_FROM;
                        $end = DEFAULT_RECORD_LISTING;
                        $Sql = "SELECT * FROM circulars ORDER BY DATE(CircularDate) DESC limit $start, $end";
                        $AllRecords = FETCH_DB_TABLE($Sql, true);
                        if ($AllRecords == null) {
                          NoData("No Circulars found!");
                        } else {
                          $SerialNo = SERIAL_NO;
                          foreach ($AllRecords as $Record) {
                            $SerialNo++;
                            $ReadBy = CHECK("SELECT CircularStatusId from circular_status where CircularMainUserId='" . LOGIN_UserId . "' and CircularMainId='" . $Record->CircularId . "'");
                            if ($ReadBy == null) {
                              $ReadStatus = "<span class='text-info'>NEW</span>";
                            } else {
                              $ReadStatus = "<span class='text-success'>READ</span>";
                            }
                        ?>
                            <div class="col-md-12">
                              <p class="data-list flex-s-b">
                                <span class="w-pr-5"><?php echo $SerialNo; ?></span>
                                <span class="w-pr-30">
                                  <a href='#' class="text-primary" onclick="Databar('update_details_<?php echo $Record->CircularId; ?>')">
                                    <?php echo $Record->CircularName; ?>
                                  </a>
                                </span>
                                <span class="w-pr-15"><?php echo DATE_FORMATE('d M, Y', $Record->CircularDate); ?></span>
                                <span class="w-pr-10">
                                  <?php echo $ReadStatus; ?>
                                </span>
                                <span class="w-pr-10">
                                  <a href='#' onclick="Databar('view_details_<?php echo $Record->CircularId; ?>')"><i class='fa fa-eye'></i> Details</a>
                                </span>
                              </p>
                            </div>
                        <?php
                            include $Dir . "/include/sections/View-Circular-Details.php";
                          }
                        }
                        ?>
                        <?php PaginationFooter(TOTAL("SELECT * FROM circulars"), "index.php"); ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class='calendar'>
                        <?php echo GENERATE_CALENDAR; ?>
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
    include $Dir . "/include/sections/Add-New-Circulars.php";
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>