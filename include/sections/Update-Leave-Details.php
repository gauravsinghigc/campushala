<section class="pop-section hidden" id="update-leave-records-<?php echo $Data->UserLeaveId; ?>">
 <div class="action-window">
  <div class='container'>
   <div class='row'>
    <div class='col-md-12'>
     <h4 class='app-heading'>Update Leave Details</h4>
    </div>
   </div>
   <form class="row" enctype="multipart/form-data" action="<?php echo CONTROLLER; ?>/LeaveController.php" method="POST">
    <?php FormPrimaryInputs(true, [
     "UserLeaveId" => $Data->UserLeaveId
    ]); ?>
    <div class="col-md-3 form-group">
     <label>Leave Type</label>
     <select name="UserLeaveType" onchange="LeaveRequirements()" id='LeaveType' class="form-control form-control-sm">
      <?php InputOptions(['FULL-DAY-LEAVE', 'HALF-DAY', 'SHORT-LEAVE'], $Data->UserLeaveType); ?>
     </select>
    </div>
    <div class='col-md-2 col-6 col-xs-6 form-group'>
     <label>From</label>
     <input type='date' id='leaveFrom' name='UserLeaveFrom' required="" class="form-control form-control-sm" value='<?php echo $Data->UserLeaveFrom; ?>'>
    </div>

    <div class='col-md-2 col-6 col-xs-6 form-group'>
     <label>To</label>
     <input type='date' id='leaveTo' name='UserLeaveTo' required="" class="form-control form-control-sm" value='<?php echo $Data->UserLeaveTo; ?>'>
    </div>

    <div class='col-md-4'>
     <div id='leaveRejoin'>
      <label>Re-Join Date</label>
      <input type='date' name='UserLeaveReJoinDate' class="form-control form-control-sm" value='<?php echo $Data->UserLeaveReJoinDate; ?>'>
     </div>
    </div>

    <div class="form-group col-md-12">
     <label>Leave Reason <?php echo $req; ?></label>
     <textarea name="UserLeaveReason" class="form-control" required="" rows="3"><?php echo SECURE($Data->UserLeaveReason, "d"); ?></textarea>
    </div>

    <div class="col-md-12">
     <h5 class="app-sub-heading">Emergency Contact person during leave</h5>
    </div>
    <div class="col-md-3 form-group">
     <label>Contact peron name</label>
     <input type="text" value="<?php echo GET_DATA("user_leave_contact_nos", "UserLeaveContactPersonName", "UserLeaveMainId='" . $Data->UserLeaveId . "'"); ?>" name="UserLeaveContactPersonName" class="form-control form-control-sm">
    </div>

    <div class="col-md-3 form-group">
     <label>Person phone number</label>
     <input type="text" value="<?php echo GET_DATA("user_leave_contact_nos", "UserLeaveContactPersonPhoneNumber", "UserLeaveMainId='" . $Data->UserLeaveId . "'"); ?>" name="UserLeaveContactPersonPhoneNumber" class="form-control form-control-sm">
    </div>

    <div class="col-md-3 form-group">
     <label>Relation with Employee</label>
     <input value="<?php echo GET_DATA("user_leave_contact_nos", "UserLeaveContactPersonRelation", "UserLeaveMainId='" . $Data->UserLeaveId . "'"); ?>" type="text" name="UserLeaveContactPersonRelation" class="form-control form-control-sm">
    </div>

    <div class="col-md-3 form-group">
     <label>Address</label>
     <input value="<?php echo GET_DATA("user_leave_contact_nos", "UserLeaveContactPersonAddress", "UserLeaveMainId='" . $Data->UserLeaveId . "'"); ?>" name="UserLeaveContactPersonAddress" class="form-control form-control-sm">
    </div>



    <div class=" col-md-9 m-t-10">
     <label>Upload Attachments (png, jpeg only)multiple</label>
     <input type="FILE" name="UserLeaveAttachedFile" value='' class="form-control form-control-sm" accept="image/*" multiple>
    </div>
    <div class="col-md-3 m-t-10">
     <label>Update Status</label>
     <select name="UserLeaveStatus" class="form-control form-control-sm">
      <?php InputOptions(["APPROVED", "REJECTED", "NEW"], $Data->UserLeaveStatus); ?>
     </select>
    </div>

    <div class='col-md-12 text-right'>
     <a onclick=" Databar('update-leave-records-<?php echo $Data->UserLeaveId; ?>')" class="btn btn-md btn-default mt-3 mr-3">Cancel</a>
     <button type="submit" name="UpdateLeaveRequests" class='btn btn-md btn-success'>Update Leave Details <i class='fa fa-check'></i></button>
    </div>
   </form>
  </div>
 </div>
</section>

<script>
 function LeaveRequirements() {
  var LeaveType = document.getElementById('LeaveType');

  //perform leave type requirements & activities
  if (LeaveType.value == 'FULL-DAY-LEAVE') {

  } else if (LeaveType.value == 'HALF-DAY') {

  } else if (LeaveType.value == 'SHORT-LEAVE') {

  }
 }
</script>