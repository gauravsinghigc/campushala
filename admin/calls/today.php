<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Today Scheduled Calls";
$PageDescription = "Manage all Calls";
$btntext = "Add New Domain";
$DomainExpireInCurrentMonth = date("Y-m-d", strtotime("+1 month"));
$CurrentData = date("Y-m-d");


if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $_SESSION['search'] = $search;
} elseif (isset($_SESSION['search'])) {
  $search = $_SESSION['search'];
} else {
  $search = "";
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
      document.getElementById("leads").classList.add("active");
      document.getElementById("all_calls").classList.add("active");
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
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">
                  <div class="row mb-5px">
                    <div class="col-md-8">
                      <div class="mb-3 d-sm-flex fw-bold p-1">
                        <h3><?php echo $PageName; ?></h3>
                      </div>
                    </div>
                    <div class="col-md-4 text-right">
                      <div class="mt-sm-0 mt-2">
                        <a href="#addcallrecords" class="btn btn-xs btn-success" data-toggle="modal"><i class="fa fa-phone"></i> Add Call Records</a>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="rounded-2">
                        <h4 class="app-heading bg-success">All Latest Call Records</h4>
                        <div class="row">
                          <div class="col-md-6 col-xs-6 col-6 mb-5px">
                            <div class="car card-body border-1 rounded-2 shadow-sm">
                              <h2 class="count text-success mb-0"><?php echo TOTAL("SELECT * FROM leads_calls where LeadCallType='Incoming'"); ?></h2>
                              <p class="mb-0">Incoming Calls</p>
                            </div>
                          </div>
                          <div class="col-md-6 col-xs-6 col-6 mb-5px">
                            <div class="car card-body border-1 rounded-2 shadow-sm">
                              <h2 class="count text-danger mb-0"><?php echo TOTAL("SELECT * FROM leads_calls where LeadCallType='Outgoing'"); ?></h2>
                              <p class="mb-0">Outgoing Calls</p>
                            </div>
                          </div>
                        </div>
                        <ul class="calling-list">
                          <?php
                          $FetchCalls = FETCH_DB_TABLE("SELECT * FROM leads_calls where LeadCallStatus!='FollowUp' ORDER BY LeadCallId DESC", true);
                          if ($FetchCalls != null) {
                            foreach ($FetchCalls as $Calls) { ?>
                              <li>
                                <span><?php echo CallTypes("" . $Calls->LeadCallType . ""); ?></span>
                                <p>
                                  <span><b><?php echo DATE_FORMATE("d M, Y", $Calls->LeadCallingDate); ?> <?php echo DATE_FORMATE("d:m A", $Calls->LeadCallingTime); ?></b> <span class="text-grey">- <?php echo $Calls->LeadCallStatus; ?></span></span><br>
                                  <span><i class="fa fa-user text-primary"></i>
                                    <span class="text-grey"><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadSalutations"); ?></span>
                                    <span><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadPersonFullname"); ?></span> |
                                    <span><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadPersonPhoneNumber"); ?></span>
                                  </span><br>
                                  <span><?php echo html_entity_decode(SECURE($Calls->LeadCallNotes, "d")); ?></span><br>
                                  <span class="text-grey">By <?php echo FETCH("SELECT * FROM users where UserId='" . $Calls->CallCreatedBy . "'", "UserFullName"); ?></span>
                                </p>
                              </li>
                          <?php }
                          } ?>

                        </ul>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="rounded-2">
                        <h4 class="app-heading bg-danger">Today Scheduled Calls</h4>
                        <div class="row">
                          <div class="col-md-6 col-xs-6 col-6 mb-5px">
                            <div class="car card-body border-1 rounded-2 shadow-sm">
                              <h2 class="count text-success mb-0"><?php echo TOTAL("SELECT * FROM leads_calls where DATE(LeadCallingReminderDate)<='$CurrentData' and LeadCallStatus='FollowUp'"); ?></h2>
                              <p class="mb-0">Total Calls</p>
                            </div>
                          </div>
                        </div>
                        <ul class="calling-list">
                          <?php
                          $CurrentData = date("Y-m-d");
                          $FetchCalls = FETCH_DB_TABLE("SELECT * FROM leads_calls where DATE(LeadCallingReminderDate)<='$CurrentData' and LeadCallStatus='FollowUp' ORDER BY LeadCallId DESC", true);
                          if ($FetchCalls != null) {
                            foreach ($FetchCalls as $Calls) { ?>
                              <li>
                                <span><?php echo Reminder(); ?></span>
                                <p>
                                  <span><b><?php echo DATE_FORMATE("d M, Y", $Calls->LeadCallingReminderDate); ?> <?php echo DATE_FORMATE("d:m A", $Calls->LeadCallingReminderTime); ?></b></span><br>
                                  <span><i class="fa fa-user text-primary"></i>
                                    <span class="text-grey"><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadSalutations"); ?></span>
                                    <span><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadPersonFullname"); ?></span> |
                                    <span><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadPersonPhoneNumber"); ?></span>
                                  </span><br>
                                  <span><?php echo html_entity_decode(SECURE($Calls->LeadCallRemindNotes, "d")); ?></span><br>
                                  <span class="text-grey">By <?php echo FETCH("SELECT * FROM users where UserId='" . $Calls->CallCreatedBy . "'", "UserFullName"); ?></span>
                                  <a href="#update_call_reminder_<?php echo $Calls->LeadCallId; ?>" class="btn btn-xs btn-primary pull-right remind-btn" data-toggle="modal" class="pull-right btn btn-sm btn btn-primary"><i class="fa fa-edit"></i> Update Call</a>
                                </p>
                              </li>
                              <!-- #modal-dialog -->
                              <div class="modal fade" id="update_call_reminder_<?php echo $Calls->LeadCallId; ?>">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Update Call Reminder Details</h4>
                                      <button type="button" class="btn-close text-white" data-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <form action="<?php echo CONTROLLER; ?>/LeadsController.php" method="POST">
                                      <?php FormPrimaryInputs(true, [
                                        "LeadMainid" => FETCH("SELECT * FROM leads_calls where LeadCallId='" . $Calls->LeadCallId . "'", "LeadMainId"),
                                        "LeadCallId" => $Calls->LeadCallId
                                      ]);  ?>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="form-group col-md-4">
                                            <label>Call Type</label>
                                            <select name="LeadCallType" onchange="CheckCallStatus_<?php echo $Calls->LeadCallId; ?>()" id="call_status_<?php echo $Calls->LeadCallId; ?>" class="form-control">
                                              <option value="Incoming">Incoming</option>
                                              <option value="Outgoing">Outgoing</option>
                                              <option value="Reschedule">Re-Schedule</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div id="call_records_<?php echo $Calls->LeadCallId; ?>">
                                          <div class="row">
                                            <div class="form-group col-md-4">
                                              <label>Call Date</label>
                                              <input type="date" name="LeadCallingDate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                            </div>

                                            <div class="form-group col-md-4">
                                              <label>Call Time</label>
                                              <input type="time" name="LeadCallingTime" class="form-control" value="<?php echo date('h:m'); ?>">
                                            </div>

                                            <div class="form-group col-md-4">
                                              <label>Call Status</label>
                                              <select name="LeadCallStatus" class="form-control" id="call_status_type_<?php echo $Calls->LeadCallId; ?>">
                                                <option value="Fresh">Fresh</option>
                                                <option value="Ringing">Ringing...</option>
                                                <option value="Out Of Reach">Out Of Reach</option>
                                                <option value="Switch Off">Switch Off</option>
                                                <option value="Invalid Number">Invalid Number</option>
                                                <option value="Busy">Busy</option>
                                                <option value="FollowUp">FollowUp</option>
                                              </select>
                                            </div>

                                            <div class="col-md-12">
                                              <label>Call Notes/Remarks</label>
                                              <textarea class="form-control" name="LeadCallNotes" rows="5"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label>Calling By</label>
                                              <select class="form-control" name="CallCreatedBy">
                                                <?php
                                                $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                                                foreach ($Users as $User) {
                                                  if ($User->UserId == LOGIN_UserId) {
                                                    $selected = "selected";
                                                  } else {
                                                    $selected = "";
                                                  }
                                                  echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
                                                }
                                                ?>
                                              </select>
                                            </div>
                                          </div>
                                        </div>

                                        <div style="display:none;" id="reschedule_<?php echo $Calls->LeadCallId; ?>">
                                          <div class="row">
                                            <div class="col-md-4">
                                              <label>Call Reminding Date</label>
                                              <input type="date" name="LeadCallingReminderDate" class="form-control" value="<?php echo date("Y-m-d", strtotime("+1 days")); ?>">
                                            </div>
                                            <div class="col-md-4">
                                              <label>Call Reminding Time</label>
                                              <input type="time" name="LeadCallingReminderTime" class="form-control" value="<?php echo date("h:m", strtotime("+1 days")); ?>">
                                            </div>
                                            <div class="col-md-12">
                                              <label>Remind Notes</label>
                                              <textarea class="form-control" name="LeadCallRemindNotes" row="3"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label>Calling By</label>
                                              <select class="form-control" name="CallCreatedBy">
                                                <?php
                                                $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                                                foreach ($Users as $User) {
                                                  if ($User->UserId == LOGIN_UserId) {
                                                    $selected = "selected";
                                                  } else {
                                                    $selected = "";
                                                  }
                                                  echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
                                                }
                                                ?>
                                              </select>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button class="btn btn-success mt-0 mb-0" name="UpdateCallReminderDetails" value="<?php echo SECURE($Calls->LeadCallId, "e"); ?>" type="Submit">Update Call Record</button>
                                        <button href="javascript:;" type="button" class="btn btn-white mt-0 mb-0" data-dismiss="modal">Close</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                              <script>
                                function CheckCallStatus_<?php echo $Calls->LeadCallId; ?>() {
                                  var call_status_<?php echo $Calls->LeadCallId; ?> = document.getElementById("call_status_<?php echo $Calls->LeadCallId; ?>");
                                  var call_records_<?php echo $Calls->LeadCallId; ?> = document.getElementById("call_records_<?php echo $Calls->LeadCallId; ?>");
                                  var reschedule_<?php echo $Calls->LeadCallId; ?> = document.getElementById("reschedule_<?php echo $Calls->LeadCallId; ?>");
                                  var call_status_type_<?php echo $Calls->LeadCallId; ?> = document.getElementById("call_status_type_<?php echo $Calls->LeadCallId; ?>");

                                  if (call_status_<?php echo $Calls->LeadCallId; ?>.value == "Reschedule") {
                                    call_records_<?php echo $Calls->LeadCallId; ?>.style.display = "none";
                                    reschedule_<?php echo $Calls->LeadCallId; ?>.style.display = "block";
                                  } else {
                                    call_records_<?php echo $Calls->LeadCallId; ?>.style.display = "block";
                                    reschedule_<?php echo $Calls->LeadCallId; ?>.style.display = "none";
                                  }
                                }
                              </script>
                          <?php }
                          } ?>

                        </ul>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="rounded-2">
                        <h4 class="app-heading bg-warning">All Scheduled Calls</h4>
                        <div class="row">
                          <div class="col-md-8 col-xs-8 col-8 mb-5px">
                            <div class="car card-body border-1 rounded-2 shadow-sm">
                              <h2 class="count text-danger mb-0"><?php echo TOTAL("SELECT * FROM leads_calls where LeadCallStatus='FollowUp'"); ?></h2>
                              <p class="mb-0 display-6">Total Scheduled Calls</p>
                            </div>
                          </div>
                        </div>
                        <ul class="calling-list">
                          <?php
                          $CurrentData = date("Y-m-d");
                          $FetchCalls = FETCH_DB_TABLE("SELECT * FROM leads_calls where LeadCallStatus='FollowUp' ORDER BY LeadCallId DESC", true);
                          if ($FetchCalls != null) {
                            foreach ($FetchCalls as $Calls) { ?>
                              <li>
                                <span><?php echo Reminder(); ?></span>
                                <p>
                                  <span><b><?php echo DATE_FORMATE("d M, Y", $Calls->LeadCallingReminderDate); ?> <?php echo DATE_FORMATE("d:m A", $Calls->LeadCallingReminderTime); ?></b></span><br>
                                  <span><i class="fa fa-user text-primary"></i>
                                    <span class="text-grey"><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadSalutations"); ?></span>
                                    <span><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadPersonFullname"); ?></span> |
                                    <span><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $Calls->LeadMainId . "'", "LeadPersonPhoneNumber"); ?></span>
                                  </span><br>
                                  <span><?php echo html_entity_decode(SECURE($Calls->LeadCallRemindNotes, "d")); ?></span><br>
                                  <span class="text-grey">By <?php echo FETCH("SELECT * FROM users where UserId='" . $Calls->CallCreatedBy . "'", "UserFullName"); ?></span>
                                </p>
                              </li>
                          <?php }
                          } ?>

                        </ul>
                      </div>
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

  <!-- #modal-dialog -->
  <div class="modal fade" id="addcallrecords">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Call Records</h4>
          <button type="button" class="btn-close text-white" data-dismiss="modal" aria-hidden="true"></button>
        </div>
        <form action="<?php echo CONTROLLER; ?>/LeadsController.php" method="POST">
          <?php FormPrimaryInputs(true);  ?>
          <div class="modal-body">
            <div class="row">
              <div class="form-group col-md-12">
                <label>Search Customer</label>
                <select class="form-control" name="LeadMainid" required="">
                  <option value="0">Select Lead/Customer</option>
                  <?php
                  $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads", true);
                  if ($GetLeads != null) {
                    foreach ($GetLeads as $Leads) { ?>
                      <option value="<?php echo SECURE($Leads->LeadsId, "e"); ?>"><?php echo $Leads->LeadPersonFullname; ?> | <?php echo $Leads->LeadPersonPhoneNumber; ?> | <?php echo $Leads->LeadPersonCompanyName; ?></option>
                  <?php }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label>Call Date</label>
                <input type="date" name="LeadCallingDate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
              </div>

              <div class="form-group col-md-4">
                <label>Call Time</label>
                <input type="time" name="LeadCallingTime" class="form-control" value="<?php echo date('h:m'); ?>">
              </div>

              <div class="form-group col-md-4">
                <label>Call Type</label>
                <select name="LeadCallType" class="form-control">
                  <option value="Incoming">Incoming</option>
                  <option value="Outgoing">Outgoing</option>
                </select>
              </div>

              <div class="form-group col-md-8">
                <label>Call Status</label>
                <select name="LeadCallStatus" class="form-control">
                  <option value="Fresh">Fresh</option>
                  <option value="Ringing">Ringing...</option>
                  <option value="Out Of Reach">Out Of Reach</option>
                  <option value="Switch Off">Switch Off</option>
                  <option value="Invalid Number">Invalid Number</option>
                  <option value="Busy">Busy</option>
                  <option value="FollowUp">FollowUp</option>
                </select>
              </div>

              <div class="col-md-12">
                <label>Call Notes/Remarks</label>
                <textarea class="form-control" name="LeadCallNotes" rows="5"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label>Calling By</label>
                <select class="form-control" name="CallCreatedBy">
                  <?php
                  $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                  foreach ($Users as $User) {
                    if ($User->UserId == LOGIN_UserId) {
                      $selected = "selected";
                    } else {
                      $selected = "";
                    }
                    echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success mt-0 mb-0" name="ADDCallRecords" value="<?php echo SECURE($REQ_LeadsId, "e"); ?>" type="Submit">Save Call Record</button>
            <button href="javascript:;" type="button" class="btn btn-white mt-0 mb-0" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>