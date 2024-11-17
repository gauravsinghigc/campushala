<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Visitors";
$PageDescription = "Manage teams";
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
                      <div class="app-heading">
                        <h4 class="mb-0"><?php echo $PageName; ?>
                          <a href="#" onclick="Databar('AddVisitPopUp')" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> Add Visitor</a>
                        </h4>
                      </div>
                    </div>
                    <div class='col-md-4 mb-2 text-left'>
                      <input type="text" oninput="SearchData('searchinput', 'search-data')" id='searchinput' placeholder="Person name" class="form-control form-control-sm m-1">
                    </div>
                    <div class='col-md-6 mb-2 text-left'>
                      <form class="p-1">
                        <div class="flex-s-b">
                          <div class="flex-s-b w-100">
                            <label class="w-75 btn btn-xs">From date:</label>
                            <input type="date" onchange="form.submit()" value="<?php echo IfRequested("GET", "fromdate", date('Y-m-d'), false); ?>" name="fromdate" class="form-control w-30 form-control-sm">
                          </div>
                          <div class="flex-s-b w-100">
                            <label class="w-50 btn btn-xs">To date :</label>
                            <input type="date" onchange="form.submit()" value="<?php echo IfRequested("GET", "todate", date('Y-m-d'), false); ?>" name="todate" class="form-control w-30 form-control-sm">
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-md-2 text-right">
                      <div class="">
                        <?php if (isset($_GET['fromdate'])) {
                          $From = $_GET['fromdate'];
                          $To = $_GET['todate']; ?>
                          <a target="_blank" href="export.php?fromdate=<?php echo $From; ?>&todate=<?php echo $To; ?>" class="btn btn-xs btn-default"><i class="fa fa-file-pdf-o"></i> Export All</a>
                        <?php } else { ?>
                          <a target="_blank" href="export.php" class="btn btn-xs btn-default"><i class="fa fa-file-pdf"></i> Export All</a>
                        <?php } ?>
                      </div>
                    </div>
                    <?php if (isset($_GET['fromdate'])) {
                      $From = $_GET['fromdate'];
                      $To = $_GET['todate']; ?>
                      <div class=" col-md-12 mb-3">
                        <p class="p-1 mb-2">
                          <i class="fa fa-filter text-danger"></i>
                          <b><?php echo TOTAL("SELECT * FROM visitors where DATE(VisitPersonCreatedAt)>='$From' and DATE(VisitPersonCreatedAt)<='$To'"); ?> </b>
                          Visitors <span class="text-gray">From:</span> <span class="text-black bold"><?php echo DATE_FORMATE("d M, Y", $_GET['fromdate']); ?></span>
                          <span class="text-gray">To :</span> <span class="text-black bold"><?php echo DATE_FORMATE("d M, Y", $_GET['todate']); ?></span>
                          <a href="index.php" class="text-danger pull-right float-right" style='float:right !important;'><i class="fa fa-times"></i> Clear Filter</a>
                        </p>
                      </div>
                    <?php } ?>
                    <?php
                    $start = START_FROM;
                    $viewlimit = DEFAULT_RECORD_LISTING;

                    if (isset($_GET['view_for'])) {
                      $view_for = $_GET['view_for'];
                      $AllVisitors = FETCH_DB_TABLE("SELECT * FROM visitors where VisitPersonType like '%$view_for%' ORDER BY VisitorId DESC limit $start, $viewlimit", true);
                    } elseif (isset($_GET['fromdate'])) {
                      $fromdate = $_GET['fromdate'];
                      $todate = $_GET['todate'];
                      $AllVisitors = FETCH_DB_TABLE("SELECT * FROM visitors where DATE(VisitPersonCreatedAt)>='$fromdate' and DATE(VisitPersonCreatedAt)<='$todate' order by VisitorId DESC limit $start, $viewlimit", true);
                    } elseif (isset($_GET['VisitorPersonName'])) {
                      $VisitorPersonName = $_GET['VisitorPersonName'];
                      $AllVisitors = FETCH_DB_TABLE("SELECT * FROM visitors where VisitorPersonName like '%$VisitorPersonName%' order by VisitorId DESC limit $start, $viewlimit", true);
                    } else {
                      $AllVisitors = FETCH_DB_TABLE("SELECT * FROM visitors ORDER BY VisitorId DESC limit $start, $viewlimit", true);
                    }
                    if ($AllVisitors != null) {
                      $SerialNo = SERIAL_NO;
                      foreach ($AllVisitors as $Visitor) {
                        $SerialNo++;
                    ?>
                        <div class='col-md-12 search-data'>
                          <p class='data-list p-2 flex-s-b'>
                            <span class='w-pr-5'><?php echo $SerialNo; ?></span>
                            <span class='w-pr-15'>
                              <a href="#" onclick="Databar('edit_<?php echo $Visitor->VisitorId; ?>')" class='text-primary bold'>
                                <?php echo $Visitor->VisitorPersonName; ?>
                              </a>
                            </span>
                            <span class='w-pr-12'><?php echo $Visitor->VisitorPersonPhone; ?></span>
                            <span class='w-pr-15'><?php echo $Visitor->VisitPersonType; ?></span>
                            <span class='w-pr-20'><?php echo FETCH("SELECT * FROM users where UserId='" . $Visitor->VisitPesonMeetWith . "'", "UserFullName"); ?></span>
                            <span class='w-pr-10'><?php echo DATE_FORMATE("d M, Y", $Visitor->VisitPersonCreatedAt); ?></span>
                            <span class='w-pr-20'><?php echo $Visitor->VisitEnquiryStatus; ?></span>
                            <span class='w-pr-20'><?php echo DATE_FORMATE("h:i A", $Visitor->VisitPersonCreatedAt); ?> - <?php echo DATE_FORMATE("h:i A", $Visitor->VisitorOutTime); ?></span>
                            <span class='w-pr-10 text-right'>
                              <a href="#" onclick="Databar('edit_<?php echo $Visitor->VisitorId; ?>')" class='text-info'>Update</a>
                            </span>
                          </p>
                        </div>
                    <?php
                        include $Dir . "/include/sections/VisitorUpdatePopWindow.php";
                      }
                    } else {
                      NoData("No Visitor Found!");
                    }
                    PaginationFooter(TOTAL("SELECT * FROM visitors"), "index.php"); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include $Dir . "/include/admin/footer.php"; ?>
  </div>


  <?php
  include $Dir . "/include/sections/VisitorAddPopWindow.php";
  include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>