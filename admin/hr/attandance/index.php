<?php

//required files
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//page variables
$PageName = "All Attandance";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include $Dir . '/include/admin/header_files.php'; ?>
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
          <div class="card card-primary">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <h4 class="app-heading"><?php echo $PageName; ?></h4>
                </div>
              </div>



              <?php
              $Employees = FETCH_DB_TABLE("SELECT * FROM users", true);
              if ($Employees == null) {
                NoData("No User Found!");
              } else {
                foreach ($Employees as $Employee) {
                  $REQ_UserId = $Employee->UserId ?>
                  <form action="<?php echo CONTROLLER; ?>/EmployeeController.php" method="POST">
                    <?php FormPrimaryInputs(true, [
                      "UserAttandanceMainUserId" => $REQ_UserId
                    ]); ?>
                    <div class="row">
                      <div class="col-md-12">
                        <h5><i class="fa fa-briefcase"></i> <span><?php echo $Employee->UserFullName; ?></span> @ <span><?php echo $Employee->UserEmailId; ?></span>, <span><?php echo $Employee->UserPhoneNumber; ?></span></h5>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2 form-group">
                        <label>Check-in Date</label>
                        <input type="date" readonly="" name="UserAttandanceStartDate" class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>">
                      </div>
                      <div class="col-md-2 form-group">
                        <label>Check-in Time</label>
                        <input type="time" readonly="" id="at_times_<?php echo $REQ_UserId; ?>" name="UserAttandanceStartTime" class="form-control form-control-sm" value="">
                        <script>
                          window.setInterval(function() {
                            var todays_<?php echo $REQ_UserId; ?> = new Date();
                            var times_<?php echo $REQ_UserId; ?> = todays_<?php echo $REQ_UserId; ?>.getHours() + ":" + todays_<?php echo $REQ_UserId; ?>.getMinutes();
                            document.getElementById("at_times_<?php echo $REQ_UserId; ?>").value = times_<?php echo $REQ_UserId; ?>;
                          }, 1000);
                        </script>
                      </div>
                      <div class="col-md-2 form-group">
                        <label>Status</label>
                        <select name="UserAttandanceStatus" id="at_status_<?php echo $REQ_UserId; ?>" onchange="CheckLeaves_<?php echo $REQ_UserId; ?>()" class="form-control form-control-sm" required="">
                          <option value="PRESENT">PRESENT</option>
                          <option value="ABSANT">ABSANT</option>
                          <option value="WORK_FROM_HOME">WORK FROM HOME</option>
                          <option value="LEAVE">LEAVE</option>
                        </select>
                      </div>
                      <div class="col-md-3 form-group hidden" id="leavenote_<?php echo $REQ_UserId; ?>">
                        <label>Enter Reason</label>
                        <textarea name="UserAttandanceNotes" class="form-control form-control-sm" rows="1"></textarea>
                      </div>
                      <div class="col-md-2 pt-2">
                        <button type="submit" name="AttandanceRecords" class="btn btn-sm btn-success mt-3">Add Attandance</button>
                      </div>
                    </div>
                  </form>
                  <script>
                    function CheckLeaves_<?php echo $REQ_UserId; ?>() {
                      var at_status_<?php echo $REQ_UserId; ?> = document.getElementById("at_status_<?php echo $REQ_UserId; ?>");

                      if (at_status_<?php echo $REQ_UserId; ?>.value == "LEAVE" || at_status_<?php echo $REQ_UserId; ?>.value == "WORK_FROM_HOME") {
                        document.getElementById("leavenote_<?php echo $REQ_UserId; ?>").style.display = "block";
                      } else {
                        document.getElementById("leavenote_<?php echo $REQ_UserId; ?>").style.display = "none";
                      }
                    }
                  </script>


              <?php
                }
              } ?>

              <div class="row mb-5px">
                <div class="col-md-12">
                  <h5 class="app-sub-heading">Open/Pending/Un-Check-out Attandances</h5>
                  <?php
                  $sql = "SELECT * FROM user_attandances where UserAttandanceEndTime='null' and UserAttandanceEndDate='null' and DATE(UserAttandanceStartDate)='" . DATE('Y-m-d') . "' ORDER BY UserAttandanceId DESC";
                  $FetchAttandances = FETCH_DB_TABLE($sql, true);
                  if ($FetchAttandances != null) {
                    foreach ($FetchAttandances as $Record) {
                      $MonthGroup = $date = $Record->UserAttandanceMonth;
                      $SqlEmp = "SELECT * FROM users where UserId='" . $Record->UserAttandanceMainUserId . "'";  ?>
                      <form action="<?php echo CONTROLLER; ?>/EmployeeController.php" method="POST">
                        <?php FormPrimaryInputs(true, [
                          "UserAttandanceId" => $Record->UserAttandanceId,
                        ]) ?>
                        <div class="row">
                          <div class="col-md-12">
                            <h5><i class="fa fa-briefcase"></i> <span><?php echo FETCH($SqlEmp, "UserFullName"); ?></span> @ <small><?php echo FETCH($SqlEmp, "UserEmailId"); ?></small>, <small><?php echo FETCH($SqlEmp, "UserPhoneNumber"); ?></small></h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <p class="flex-s-b" style="line-height:18px;">
                              <span>
                                <span class="text-grey">Check-in Date</span><br>
                                <span class="text-black fs-17px"><b><?php echo DATE_FORMATE("d M, Y", $Record->UserAttandanceStartDate); ?></b></span>
                              </span>
                              <span>
                                <span class="text-grey">Check-in Time</span><br>
                                <span class="text-black fs-17px"><b><?php echo DATE_FORMATE("h:m A", $Record->UserAttandanceStartTime); ?></b></span>
                              </span>
                              <span>
                                <span class="text-grey">Status</span><br>
                                <span class="text-black fs-17px"><?php echo $Record->UserAttandanceStatus; ?></span>
                              </span>
                            </p>
                          </div>
                          <div class="col-md-7 flex-s-b shadow-sm rounded-1">
                            <div class="form-group">
                              <label>Check-out Date</label>
                              <input type="date" readonly="" name="UserAttandanceEndDate" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                              <label>Check-out Time</label>
                              <input type="time" readonly="" name="UserAttandanceEndTime" id="<?php echo $Record->UserAttandanceId; ?>_times" value="" class="form-control form-control-sm">
                            </div>
                            <script>
                              window.setInterval(function() {
                                var today_<?php echo $Record->UserAttandanceId; ?> = new Date();
                                var times_<?php echo $Record->UserAttandanceId; ?> = today_<?php echo $Record->UserAttandanceId; ?>.getHours() + ":" + today_<?php echo $Record->UserAttandanceId; ?>.getMinutes();
                                document.getElementById("<?php echo $Record->UserAttandanceId; ?>_times").value = times_<?php echo $Record->UserAttandanceId; ?>;
                              }, 1000);
                            </script>
                            <div>
                              <button class="btn btn-warning btn-lg" name="CheckOutRecord">Check-out <i class="fa fa-angle-right"></i></button>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <hr>
                          </div>
                        </div>
                      </form>
                  <?php }
                  } else {
                    NoData("No Pending Attandance Found!");
                  } ?>
                </div>
              </div>

            </div>
            <!--End page content-->
          </div>
        </div>
      </section>
    </div>

    <?php include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>