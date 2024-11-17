<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';

//start request processing
if (isset($_POST['SaveODRequests'])) {
  $OdReferenceId = SECURE($_POST['OdReferenceId'], "d");
  $OdTeamLeaderId = GET_DATA("user_employment_details", "UserEmpReportingMember", "UserMainUserId='" . LOGIN_UserId . "'");

  $Check = CHECK("SELECT OdReferenceId FROM od_forms where OdMainUserId='" . LOGIN_UserId . "' and OdReferenceId='$OdReferenceId'");
  if ($Check == null) {
    $od_forms = [
      "OdReferenceId" => $OdReferenceId,
      "OdMainUserId" => LOGIN_UserId,
      "OdTeamLeaderId" => $OdTeamLeaderId,
      "OdPermissionTimeFrom" => $_POST['OdPermissionTimeFrom'],
      "OdPermissionTimeTo" => $_POST['OdPermissionTimeTo'],
      "OdRequestDate" => $_POST['OdRequestDate'],
      "OdBriefReason" => SECURE($_POST['OdBriefReason'], "e"),
      "OdLeadMainId" => $_POST['OdLeadMainId'],
      "OdLocationDetails" => $_POST['OdLocationDetails'],
      "OdCreatedBy" => LOGIN_UserId,
      "OdCreatedAt" => CURRENT_DATE_TIME,
      "OdUpdatedAt" => CURRENT_DATE_TIME,
      "OdUpdatedBy" => LOGIN_UserId,
      "ODFormStatus" => "NEW"
    ];
    INSERT("od_forms", $od_forms);

    //get latest record
    $OdFormId = FETCH("SELECT OdFormId FROM od_forms ORDER BY OdFormId DESC limit 1", "OdFormId");

    //save od status
    $od_form_status = [
      "OdFormMainId" => $OdFormId,
      "OdFormStatusAddedBy" => LOGIN_UserId,
      "OdFormStatusRemarks" => "OD Request sent!",
      "OdFormStatusAddedAt" => CURRENT_DATE_TIME,
      "OdFormStatus" => "NEW"
    ];
    INSERT("od_form_status", $od_form_status);


    //upload of form attachements
    $od_form_attachements = UploadMultipleFiles("..storage/ods/$OdFormId/files", "OdFormAttachedFile", SAVE("od_form_attachements", ["OdFormMainId", "OdFormAttachedFile"]));


    //sent notifications
    $Message = "<b>" . GET_DATA("users", "UserFullName", "UserId='" . LOGIN_UserId . "'") . "</b>";
    $Message .= " wants to take OD on ";
    $Message .= "<b>" . DATE_FORMATE("d M, Y", $_POST['OdRequestDate']) . "</b> ";
    $Message .= "from ";
    $Message .= "<b>" . DATE_FORMATE("h:i A", $_POST['OdPermissionTimeFrom']) . "</b> to";
    $Message .= " <b>" . DATE_FORMATE("h:i A", $_POST['OdRequestDate']) . "</b> for";
    $Message .= " <b>" . $_POST['OdBriefReason'] . "</b>";

    $Response = CREATE_NOTIFICATION(
      "OD Form Received",
      $OdTeamLeaderId,
      $Message,
      ADMIN_URL . "/hr/ods"
    );

    //send response to user
    RESPONSE($Response, "OD Form Generated and sent to HR and Reporting Manager!", "Unable to generate OD Form!");
  } else {
    RESPONSE(false, "", "OD Form Already Submitted!");
  }

  //approve OD Requests
} elseif (isset($_POST['UpdateODRequestStatus'])) {
  $OdFormId = SECURE($_POST['OdFormId'], "d");
  $Status = SECURE($_POST['Status'], 'd');

  //update OD Status
  $od_forms = [
    "ODFormStatus" => $Status,
    "OdUpdatedAt" => CURRENT_DATE_TIME,
    "OdUpdatedBy" => LOGIN_UserId
  ];
  $Response = UPDATE_DATA("od_forms", $od_forms, "OdFormId='$OdFormId'");

  //save od status
  $od_form_status = [
    "OdFormMainId" => $OdFormId,
    "OdFormStatusAddedBy" => LOGIN_UserId,
    "OdFormStatusRemarks" => "OD Request is $Status!",
    "OdFormStatusAddedAt" => CURRENT_DATE_TIME,
    "OdFormStatus" => $Status
  ];
  $Response = INSERT("od_form_status", $od_form_status);

  //send status mail to member
  $UserId = FETCH("SELECT OdMainUserId FROM od_forms WHERE OdFormId='$OdFormId'", "OdMainUserId");
  $SentTO = GET_DATA("users", "UserEmailId", "UserId='$UserId'");

  //Message for mail
  $Title = "Dear " . GET_DATA("users", "UserFullName", "UserId='$UserId'") . ", ";
  $Message = "your OD <b>" . GET_DATA("od_forms", "OdReferenceId", "OdFormId='$OdFormId'") . "</b> request has been $Status at ";
  $Message .= "<b>" . DATE_FORMATE("d M, Y h:i A", CURRENT_DATE_TIME) . "</b> ";
  $Message .= " by " . GET_DATA("users", "UserFullName", "UserId='" . LOGIN_UserId . "'") . " ";
  $Message .= " for date <b>" . DATE_FORMATE("d M, Y", GET_DATA("od_forms", "OdRequestDate", "OdFormId='$OdFormId'")) . "</b> from";
  $Message .= " <b>" . DATE_FORMATE("h:i a", GET_DATA("od_forms", "OdPermissionTimeFrom", "OdFormId='$OdFormId'")) . "</b> to";
  $Message .= " <b>" . DATE_FORMATE("h:i a", GET_DATA("od_forms", "OdPermissionTimeTo", "OdFormId='$OdFormId'")) . "</b> for";
  $Message .= " <b>" . SECURE(GET_DATA("od_forms", "OdBriefReason", "OdFormId='$OdFormId'"), "d") . "</b>";

  SENDMAILS("OD Request is $Status @ " . GET_DATA("od_forms", "OdReferenceId", "OdFormId='$OdFormId'"), $Title, $SentTO, $Message);

  //sent response
  RESPONSE($Response, "OD Request is $Status successfully!", "Unable to $Status OD Request at the moment!");

  //update OD Requests
} elseif (isset($_POST['UpdateODRequests'])) {
  $OdFormId = SECURE($_POST['OdFormId'], "d");

  $od_forms = [
    "OdPermissionTimeFrom" => $_POST['OdPermissionTimeFrom'],
    "OdPermissionTimeTo" => $_POST['OdPermissionTimeTo'],
    "OdRequestDate" => $_POST['OdRequestDate'],
    "OdBriefReason" => SECURE($_POST['OdBriefReason'], "e"),
    "OdLeadMainId" => $_POST['OdLeadMainId'],
    "OdLocationDetails" => $_POST['OdLocationDetails'],
    "OdUpdatedAt" => CURRENT_DATE_TIME,
    "OdUpdatedBy" => LOGIN_UserId,
    "ODFormStatus" => $_POST['ODFormStatus']
  ];
  $Response = UPDATE_DATA("od_forms", $od_forms, "OdFormId='$OdFormId'");

  if ($_POST['ODFormStatus'] != "NEW") {
    //save od status
    $od_form_status = [
      "OdFormMainId" => $OdFormId,
      "OdFormStatusAddedBy" => LOGIN_UserId,
      "OdFormStatusRemarks" => "OD Request is $Status!",
      "OdFormStatusAddedAt" => CURRENT_DATE_TIME,
      "OdFormStatus" => $Status
    ];
    $Response = INSERT("od_form_status", $od_form_status);

    //send status mail to member
    $UserId = FETCH("SELECT OdMainUserId FROM od_forms WHERE OdFormId='$OdFormId'", "OdMainUserId");
    $SentTO = GET_DATA("users", "UserEmailId", "UserId='$UserId'");

    //Message for mail
    $Title = "Dear " . GET_DATA("users", "UserFullName", "UserId='$UserId'") . ", ";
    $Message = "your OD <b>" . GET_DATA("od_forms", "OdReferenceId", "OdFormId='$OdFormId'") . "</b> request has been $Status at ";
    $Message .= "<b>" . DATE_FORMATE("d M, Y h:i A", CURRENT_DATE_TIME) . "</b> ";
    $Message .= " by " . GET_DATA("users", "UserFullName", "UserId='" . LOGIN_UserId . "'") . " ";
    $Message .= " for date <b>" . DATE_FORMATE("d M, Y", GET_DATA("od_forms", "OdRequestDate", "OdFormId='$OdFormId'")) . "</b> from";
    $Message .= " <b>" . DATE_FORMATE("h:i a", GET_DATA("od_forms", "OdPermissionTimeFrom", "OdFormId='$OdFormId'")) . "</b> to";
    $Message .= " <b>" . DATE_FORMATE("h:i a", GET_DATA("od_forms", "OdPermissionTimeTo", "OdFormId='$OdFormId'")) . "</b> for";
    $Message .= " <b>" . SECURE(GET_DATA("od_forms", "OdBriefReason", "OdFormId='$OdFormId'"), "d") . "</b>";

    SENDMAILS("OD Request is $Status @ " . GET_DATA("od_forms", "OdReferenceId", "OdFormId='$OdFormId'"), $Title, $SentTO, $Message);
  }

  //sent response
  RESPONSE($Response, "OD Request details are updated successfully!", "Unable to update OD Request details!");
}
