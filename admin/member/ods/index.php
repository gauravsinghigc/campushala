<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All ODs Requests";
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
                    <div class="col-md-10">
                      <h4 class="app-heading"><?php echo $PageName; ?>
                        <?php
                        $CheckMemberOD = CHECK("SELECT * FROM user_employment_details where UserEmpReportingMember='" . LOGIN_UserId . "'");
                        if ($CheckMemberOD != null) {
                        ?>
                          <a href="team-ods.php" class='btn btn-sm btn-default pull-right'>View Team ODs</a>
                        <?php
                        } ?>
                      </h4>
                    </div>
                    <div class="col-md-2 text-right">
                      <a href="#" onclick="Databar('Add-OD-REQUEST')" class='btn btn-sm btn-danger btn-block'><i class='fa fa-plus'></i> NEW OD</a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-8">
                      <div class="row">

                        <div class="col-md-3">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT * FROM od_forms where OdMainUserId='" . LOGIN_UserId . "'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">All OD Requests</p>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT * FROM od_forms where ODFormStatus='NEW' and OdMainUserId='" . LOGIN_UserId . "'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Pending OD Requests</p>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT * FROM od_forms where ODFormStatus='APPROVED' and OdMainUserId='" . LOGIN_UserId . "'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Approved OD</p>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="card card-body rounded-3 p-4">
                            <div class="flex-s-b">
                              <h4 class="count mb-0 m-t-5 text-primary">
                                <?php echo TOTAL("SELECT * FROM od_forms where ODFormStatus='REJECTED' and OdMainUserId='" . LOGIN_UserId . "'"); ?>
                              </h4>
                            </div>
                            <p class="mb-0 fs-14 text-grey">Rejected OD</p>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <hr>
                        </div>

                        <div class="col-md-12">
                          <h5 class="app-sub-heading">ALL ODs Requests</h5>
                        </div>
                        <div class='col-md-12'>
                          <?php
                          $start = START_FROM;
                          $listcounts = DEFAULT_RECORD_LISTING;

                          $ALLData = FETCH_DB_TABLE("SELECT * FROM od_forms where OdMainUserId='" . LOGIN_UserId . "' ORDER by OdFormId DESC", true);
                          if ($ALLData != null) {
                            $SerialNo = SERIAL_NO;
                            foreach ($ALLData as $Data) {
                              $ODStatus = ODStatus($Data->ODFormStatus);
                          ?>
                              <div class='data-list od-section <?php echo $ODStatus; ?>'>
                                <div class='od-details'>
                                  <p class="flex-s-b mb-0">
                                    <span class="w-pr-100">
                                      <span class='text-gray'>OD Date & Time</span><br>
                                      <span class="bold">
                                        <i class="fa fa-calendar text-danger"></i> <?php echo DATE_FORMATE("d M, Y", $Data->OdRequestDate); ?><br>
                                        <i class="fa fa-clock text-warning"></i> <?php echo DATE_FORMATE("h:i A", $Data->OdPermissionTimeFrom); ?> to
                                        <?php echo DATE_FORMATE("h:i A", $Data->OdPermissionTimeTo); ?>
                                      </span>
                                    </span>
                                    <span class="w-pr-75">
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
    include $Dir . "/include/sections/Add-OD-Request.php";
    ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>