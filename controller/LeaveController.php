<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';

//start processing
if (isset($_POST['SaveLeaveRequests'])) {

 $user_leaves = [
  "UserMainId" => LOGIN_UserId,
  "UserLeaveType" => $_POST['UserLeaveType'],
  "UserLeaveFrom" => $_POST['UserLeaveFrom'],
  "UserLeaveTo" => $_POST['UserLeaveTo'],
  "UserLeaveReJoinDate" => date("Y-m-d", strtotime($_POST['UserLeaveTo'], strtotime("+1 day"))),
  "UserLeaveReason" => SECURE($_POST['UserLeaveReason'], "e"),
  "UserLeaveCreatedAt" => CURRENT_DATE_TIME,
  "UserLeaveCreatedBy" => LOGIN_UserId,
  "UserLeaveStatus" => "NEW"
 ];

 $Response = INSERT("user_leaves", $user_leaves);
 $UserLeaveId = FETCH("SELECT * FROM user_leaves ORDER BY UserLeaveId DESC limit 1", "UserLeaveId");

 //upload attachments
 $UserLeaveAttachedFile = UPLOAD_FILES("../storage/leaves/" . LOGIN_UserId . "", "null", "Leave_" . $_POST['UserLeaveFrom'], $_POST['UserLeaveTo'], "UserLeaveAttachedFile");
 if ($UserLeaveAttachedFile != NULL) {
  $user_leave_attachments = [
   "UserLeaveMainId" => $UserLeaveId,
   "UserLeaveAttachedFile" => $UserLeaveAttachedFile
  ];
  $Response = INSERT("user_leave_attachments", $user_leave_attachments);
 }

 //user contact person
 if (isset($_POST['UserLeaveContactPersonName'])) {
  if ($_POST['UserLeaveContactPersonName'] != null) {

   $user_leave_contact_nos = [
    "UserLeaveMainId" => $UserLeaveId,
    "UserLeaveContactPersonName" => $_POST['UserLeaveContactPersonName'],
    "UserLeaveContactPersonPhoneNumber" => $_POST['UserLeaveContactPersonPhoneNumber'],
    "UserLeaveContactPersonAddress" => $_POST['UserLeaveContactPersonAddress'],
    "UserLeaveContactPersonRelation" => $_POST['UserLeaveContactPersonRelation']
   ];
   $Response = INSERT("user_leave_contact_nos", $user_leave_contact_nos);
  }
 }

 //save leave status
 $user_leave_status = [
  "UserLeaveMainId" => $UserLeaveId,
  "UserLeaveStatus" => "NEW",
  "UserLeaveStatusAddedBy" => LOGIN_UserId,
  "UserLeaveStatusAddedAt" => CURRENT_DATE_TIME,
  "UserLeaveStatusRemarks" => SECURE($_POST['UserLeaveReason'], "e"),
 ];
 $Response = INSERT("user_leave_status", $user_leave_status);

 //send response to origin
 RequestHandler($Response, [
  "true" => "Leave Request send to HR Successfully!",
  "false" => "Unable to send leave request at the moment!",
 ]);

 //approve the leave requests
} elseif (isset($_POST['ApproveLeaveRequests'])) {
 $UserLeaveId = SECURE($_POST['UserLeaveId'], "d");

 $user_leaves = [
  "UserLeaveStatus" => "APPROVED",
 ];
 $Response = UPDATE_DATA("user_leaves", $user_leaves, "UserLeaveId='$UserLeaveId'");

 //save leave status
 $user_leave_status = [
  "UserLeaveMainId" => $UserLeaveId,
  "UserLeaveStatus" => "APPROVED",
  "UserLeaveStatusAddedBy" => LOGIN_UserId,
  "UserLeaveStatusAddedAt" => CURRENT_DATE_TIME,
  "UserLeaveStatusRemarks" => "Leave is approved!",
 ];
 $Checked = CHECK("SELECT * FROM user_leave_status WHERE UserLeaveMainId='$UserLeaveId' and UserLeaveStatus='APPROVED'");
 if ($Checked == null) {
  RequestHandler($Response, [
   "true" => "Leave Request is approved!",
   "false" => "Unable to send leave request at the moment",
  ]);
 }

 RequestHandler($Response, [
  "true" => "Leave Request is approved!",
  "false" => "Unable to approve the leave request",
 ]);

 //reject leave status
} elseif (isset($_POST['RejectLeaveRequests'])) {
 $UserLeaveId = SECURE($_POST['UserLeaveId'], "d");

 $user_leaves = [
  "UserLeaveStatus" => "REJECTED",
 ];
 $Response = UPDATE_DATA("user_leaves", $user_leaves, "UserLeaveId='$UserLeaveId'");

 //save leave status
 $user_leave_status = [
  "UserLeaveMainId" => $UserLeaveId,
  "UserLeaveStatus" => "REJECTED",
  "UserLeaveStatusAddedBy" => LOGIN_UserId,
  "UserLeaveStatusAddedAt" => CURRENT_DATE_TIME,
  "UserLeaveStatusRemarks" => "Leave is approved!",
 ];
 $Checked = CHECK("SELECT * FROM user_leave_status WHERE UserLeaveMainId='$UserLeaveId' and UserLeaveStatus='REJECTED'");
 if ($Checked == null) {
  RequestHandler($Response, [
   "true" => "Leave Request is rejected!",
   "false" => "Unable to send leave request at the moment",
  ]);
 }

 RequestHandler($Response, [
  "true" => "Leave Request is rejected!",
  "false" => "Unable to rejecte the leave request",
 ]);

 //update leave requests
} elseif (isset($_POST['UpdateLeaveRequests'])) {
 $UserLeaveId = SECURE($_POST['UserLeaveId'], "d");

 $user_leaves = [
  "UserLeaveType" => $_POST['UserLeaveType'],
  "UserLeaveFrom" => $_POST['UserLeaveFrom'],
  "UserLeaveTo" => $_POST['UserLeaveTo'],
  "UserLeaveReJoinDate" => date("Y-m-d", strtotime($_POST['UserLeaveTo'], strtotime("+1 day"))),
  "UserLeaveReason" => SECURE($_POST['UserLeaveReason'], "e"),
  "UserLeaveStatus" => $_POST['UserLeaveStatus'],
 ];

 $Response = UPDATE_DATA("user_leaves", $user_leaves, "UserLeaveId='$UserLeaveId'");

 //update contact person
 $user_leave_contact_nos = [
  "UserLeaveContactPersonName" => $_POST['UserLeaveContactPersonName'],
  "UserLeaveContactPersonPhoneNumber" => $_POST['UserLeaveContactPersonPhoneNumber'],
  "UserLeaveContactPersonAddress" => $_POST['UserLeaveContactPersonAddress'],
  "UserLeaveContactPersonRelation" => $_POST['UserLeaveContactPersonRelation']
 ];
 $Response = UPDATE_DATA("user_leave_contact_nos", $user_leave_contact_nos, "UserLeaveMainId='$UserLeaveId'");

 //update leave attachement
 $UserLeaveAttachedFile = UPLOAD_FILES("../storage/leaves/" . LOGIN_UserId . "", "null", "Leave_" . $_POST['UserLeaveFrom'], $_POST['UserLeaveTo'], "UserLeaveAttachedFile");
 if ($UserLeaveAttachedFile != NULL) {
  $user_leave_attachments = [
   "UserLeaveAttachedFile" => $UserLeaveAttachedFile
  ];
  $Response = UPDATE_DATA("user_leave_attachments", $user_leave_attachments, "UserLeaveMainId='$UserLeaveId'");
 }

 RequestHandler($Response, [
  "true" => "Leave request is updated successfully!",
  "false" => "Unable to update leave requests at the moment!",
 ]);
}
