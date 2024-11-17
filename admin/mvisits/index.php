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
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("teams").classList.add("active");
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
                      <div class="app-heading">
                        <h4 class="mb-0"><?php echo $PageName; ?>
                          <a href="#" onclick="Databar('AddVisitPopUp')" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> Add Visitor</a>
                        </h4>
                      </div>
                    </div>

                    <div class='col-md-12 mb-2 text-left'>
                      <form>
                        <div class="flex-s-b text-left">
                          <a href="../index.php" class='btn btn-sm btn-default w-pr-20 m-1 text-left'>Back to Dashboard</a>
                          <input type="text" onchange="form.submit()" name="VisitorPersonName" placeholder="Person name" list="VisitorPersonName" class="form-control form-control-sm m-1">
                          <?php SUGGEST("visitors", "VisitorPersonName", "ASC"); ?>
                          <?php if (isset($_GET['view_for']) or isset($_GET['VisitorPersonName'])) { ?>
                            <a href="index.php" class='btn btn-sm btn-danger w-pr-20 m-1 text-left'>Clear Filter</a>
                          <?php } ?>
                        </div>
                      </form>
                    </div>
                    <?php
                    if (isset($_GET['view_for'])) {
                      $view_for = $_GET['view_for'];
                      $AllVisitors = FETCH_DB_TABLE("SELECT * FROM visitors where VisitPesonMeetWith='" . LOGIN_UserId . "' and VisitPersonType like '%$view_for%' ORDER BY VisitorId DESC", true);
                    } elseif (isset($_GET['VisitorPersonName'])) {
                      $VisitorPersonName = $_GET['VisitorPersonName'];
                      $AllVisitors = FETCH_DB_TABLE("SELECT * FROM visitors where VisitPesonMeetWith='" . LOGIN_UserId . "' and VisitorPersonName like '%$VisitorPersonName%' order by VisitorId DESC", true);
                    } else {
                      $AllVisitors = FETCH_DB_TABLE("SELECT * FROM visitors where VisitPesonMeetWith='" . LOGIN_UserId . "' ORDER BY VisitorId DESC", true);
                    }
                    if ($AllVisitors != null) {
                      $SerialNo = 0;
                      foreach ($AllVisitors as $Visitor) {
                        $SerialNo++;
                    ?>
                        <div class='col-md-12'>
                          <p class='data-list p-2 flex-s-b'>
                            <span class='w-pr-5'><?php echo $SerialNo; ?></span>
                            <span class='w-pr-15'>
                              <a href="#" onclick="Databar('edit_<?php echo $Visitor->VisitorId; ?>')" class='text-primary bold fs-5'>
                                <?php echo $Visitor->VisitorPersonName; ?>
                              </a>
                            </span>
                            <span class='w-pr-15'><?php echo $Visitor->VisitorPersonPhone; ?></span>
                            <span class='w-pr-15'><?php echo $Visitor->VisitorPersonEmailId; ?></span>
                            <span class='w-pr-15'><?php echo $Visitor->VisitPersonType; ?></span>
                            <span class='w-pr-15'><?php echo FETCH("SELECT * FROM users where UserId='" . $Visitor->VisitPesonMeetWith . "'", "UserFullName"); ?></span>
                            <span class='w-pr-10'><?php echo DATE_FORMATE("d M, Y", $Visitor->VisitPersonCreatedAt); ?></span>
                            <span class='w-pr-10'><?php echo $Visitor->VisitEnquiryStatus; ?></span>
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
                    } ?>
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