<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All ODs";
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
                            <p class="mb-0 fs-14 text-grey">All OD Requests</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='NEW'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">NEW OD Requests</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='APPROVED'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Approved OD</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='REJECTED'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Rejected OD</p>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT OdFormId FROM od_forms where ODFormStatus='APPROVED' AND DATE(OdRequestDate)='" . date('Y-m-d') . "'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Today Active ODs</p>
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
                          <h5 class="app-sub-heading">Search OD For</h5>
                          <form action="" class="row">
                            <div class="col-md-8 form-group">
                              <input type="search" placeholder="Search via name...." name="VisitPesonMeetWith" list="UserFullName" class='form-control form-control-sm' required="">
                              <datalist id="UserFullName">
                                <?php
                                $Users = FETCH_DB_TABLE("SELECT * FROM users where UserStatus='1' ORDER BY UserFullName ASC", true);
                                foreach ($Users as $User) {
                                  if ($User->UserId == LOGIN_UserId) {
                                    $selected = "selected";
                                  } else {
                                    $selected = "";
                                  }
                                  echo "<option value='" . $User->UserId . " - " . $User->UserFullName . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
                                }
                                ?>
                              </datalist>
                            </div>
                            <div class="col-md-4 form-group">
                              <select name='od_status' class="form-control form-control-sm" required="">
                                <option value=''>All</option>
                                <?php InputOptions(OD_STATUS, 'Select OD Status'); ?>
                              </select>
                            </div>
                          </form>
                        </div>

                        <div class='col-md-12'>
                          <?php
                          $start = START_FROM;
                          $listcounts = DEFAULT_RECORD_LISTING;

                          $ALLData = FETCH_DB_TABLE("SELECT * FROM od_forms ORDER by OdFormId DESC", true);
                          if ($ALLData != null) {
                            $SerialNo = SERIAL_NO;
                            foreach ($ALLData as $Data) {
                              $ODStatus = ODStatus($Data->ODFormStatus);
                          ?>
                              <div class='data-list od-section <?php echo $ODStatus; ?>'>
                                <div class="u-profile">
                                  <img src="<?php echo GetUserImage($Data->OdMainUserId); ?>" class='img'>
                                </div>
                                <div class='od-details'>
                                  <p class="flex-s-b mb-0">
                                    <span class="w-pr-33">
                                      <span class="bold h6"><?php echo GET_DATA("users", "UserFullName", "UserId='" . $Data->OdMainUserId . "'"); ?></span>
                                      <br>
                                      <span class="small">
                                        <span class="text-gray"><?php echo GET_DATA("user_employment_details", "UserEmpJoinedId", "UserMainUserId='" . $Data->OdMainUserId . "'"); ?></span>
                                        (<span class="text-gray"><?php echo GET_DATA("user_employment_details", "UserEmpGroupName", "UserMainUserId='" . $Data->OdMainUserId . "'"); ?></span>)
                                        <br>
                                        <span class="text-gray"><?php echo GET_DATA("user_employment_details", "UserEmpType", "UserMainUserId='" . $Data->OdMainUserId . "'"); ?></span> -
                                        <span class="text-gray"><?php echo GET_DATA("user_employment_details", "UserEmpLocations", "UserMainUserId='" . $Data->OdMainUserId . "'"); ?></span>
                                      </span>
                                    </span>
                                    <span class="w-pr-35">
                                      <span class='text-gray'>OD Date & Time</span><br>
                                      <span class="bold">
                                        <i class="fa fa-calendar text-danger"></i> <?php echo DATE_FORMATE("d M, Y", $Data->OdRequestDate); ?><br>
                                        <i class="fa fa-clock text-warning"></i> <?php echo DATE_FORMATE("h:i A", $Data->OdPermissionTimeFrom); ?> to
                                        <?php echo DATE_FORMATE("h:i A", $Data->OdPermissionTimeTo); ?>
                                      </span>
                                    </span>
                                    <span class="w-pr-40">
                                      <span class='text-gray'>Reason </span><br>
                                      <span class="bold">
                                        <?php echo SECURE($Data->OdBriefReason, "d"); ?>
                                      </span>
                                    </span>
                                  </p>
                                </div>
                                <div class='od-action'>
                                  <form>
                                    <button type='button' onclick="Databar('Update_<?php echo $Data->OdFormId; ?>')" class="btn btn-xs btn-info text-white"><span class="text-white"><i class='fa fa-eye'></i></span></button>
                                  </form>
                                  <?php
                                  if ($Data->ODFormStatus == "NEW") { ?>
                                    <form action='<?php echo CONTROLLER; ?>/ODRequestController.php' method="POST">
                                      <?php FormPrimaryInputs(true, [
                                        "OdFormId" => $Data->OdFormId,
                                        "Status" => "APPROVED",
                                      ]); ?>
                                      <button type="submit" name='UpdateODRequestStatus' class="btn btn-xs btn-success text-white"><span class="text-white"><i class='fa fa-check'></i></span></button>
                                    </form>
                                    <form action='<?php echo CONTROLLER; ?>/ODRequestController.php' method="POST">
                                      <?php FormPrimaryInputs(true, [
                                        "OdFormId" => $Data->OdFormId,
                                        "Status" => "REJECTED",
                                      ]); ?>
                                      <button type="submit" name='UpdateODRequestStatus' class="btn btn-xs btn-danger text-white"><span class="text-white"><i class='fa fa-times'></i></span></button>
                                    </form>
                                  <?php } else {
                                  ?>
                                    <form>
                                      <button type='button' class="btn btn-xs <?php echo $ODStatus; ?> text-white"><?php echo $Data->ODFormStatus; ?></button>
                                    </form>
                                    <span class='members'>
                                      <span class="mt-2">
                                        <span class='member-count'><i class='fa fa-user'></i></span>
                                      </span>
                                      <?php
                                      $AllApprovals = FETCH_DB_TABLE("SELECT * FROM od_form_status where OdFormMainId='" . $Data->OdFormId . "'", true);
                                      if ($AllApprovals != null) {
                                        foreach ($AllApprovals as $Approve) { ?>
                                          <span class='record-list'>
                                            <span class='list text-black'>
                                              <?php echo GetUserDetails($Approve->OdFormMainId); ?>
                                            </span>
                                          </span>
                                      <?php }
                                      } ?>
                                    </span>
                                  <?php
                                  } ?>

                                </div>
                              </div>
                          <?php
                              include $Dir . "/include/sections/Update-OD-Request.php";
                            }
                          } else {
                            NoData("No OD Found!");
                            $ALLData = [];
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