<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Leaves";
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

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">All Leaves</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='NEW'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">NEW Leave Requests</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='APPROVED'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Approved Leaves</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='REJECTED'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Rejected Leaves</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='APPROVED' AND DATE(OdRequestDate)='" . date('Y-m-d') . "'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Today Active Leaves</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='APPROVED' AND DATE(OdRequestDate)>='" . date('Y-m-d') . "'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Upcoming Active ODs</p>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <hr>
                        </div>

                        <div class="col-md-12">
                          <h5 class="app-sub-heading">Search Leaves For</h5>
                          <form action="" class="row">
                            <div class="col-md-4 form-group">
                              <input type="month" name="LeaveMonth" class="form-control form-control-sm" value='<?php echo IfRequested("GET", "LeaveMonth", date("Y-m"), null); ?>'>
                            </div>
                          </form>
                        </div>

                        <div class='col-md-12'>
                          <?php
                          $start = START_FROM;
                          $listcounts = DEFAULT_RECORD_LISTING;

                          $ALLData = FETCH_DB_TABLE("SELECT * FROM user_leaves where UserMainId='" . LOGIN_UserId . "' ORDER by DATE(UserLeaveFrom) DESC", true);
                          if ($ALLData != null) {
                            $SerialNo = SERIAL_NO;
                            foreach ($ALLData as $Data) {
                          ?>
                              <div class='data-list od-section'>
                                <div class='od-details w-100'>
                                  <p class="flex-s-b mb-0">
                                    <span class="w-pr-45">
                                      <span class='text-gray'>Leave Period</span><br>
                                      <span class="bold">
                                        <i class="fa fa-calendar text-danger"></i> <?php echo DATE_FORMATE("d M, Y", $Data->UserLeaveFrom); ?> -
                                        <?php echo DATE_FORMATE("d M, Y", $Data->UserLeaveTo); ?>
                                      </span><br>
                                      <span><i class="fa fa-calendar-day text-success"></i>
                                        <?php echo DaysBetweenDates($Data->UserLeaveFrom, $Data->UserLeaveTo); ?> days
                                      </span><br>
                                      <span><i class="fa fa-refresh text-warning"></i> <span class="text-secondary">Re-Join :</span>
                                        <?php echo DATE_FORMATE("d M, Y", $Data->UserLeaveReJoinDate); ?>
                                      </span>
                                    </span>
                                    <span class="w-pr-55 pt-2">
                                      <b class="bold">Reason</b><br>
                                      <span class="text-black"><?php echo SECURE($Data->UserLeaveReason, "d"); ?></span>
                                    </span>
                                  </p>
                                </div>
                                <div class='od-action'>
                                  <?php
                                  if ($Data->UserLeaveStatus == "APPROVED") { ?>
                                    <span class="btn btn-xs btn-success">APPROVED</span>
                                  <?php } elseif ($Data->UserLeaveStatus == "NEW") {
                                  ?>
                                    <span class="btn btn-xs btn-info">Waiting..</span>
                                    <a onclick="Databar('update-leave-records-<?php echo $Data->UserLeaveId; ?>')" class="btn btn-xs btn-info text-white m-l-2"><span class="text-white"><i class='fa fa-eye'></i></span></a>
                                  <?php
                                  } else { ?>
                                    <span class="btn btn-xs btn-danger">REJECTED</span>
                                  <?php } ?>
                                </div>
                              </div>
                          <?php
                              include $Dir . "/include/sections/Update-Leave-Details.php";
                            }
                          } else {
                            NoData("No OD Found!");
                          }
                          ?>
                        </div>
                        <?php PaginationFooter(count($ALLData), "index.php"); ?>
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
    include $Dir . "/include/admin/footer.php";
    ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>