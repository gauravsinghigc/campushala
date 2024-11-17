<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';

//start request processing
if (isset($_POST['CreateVisit'])) {

 $Visitors = [
  "VisitorPersonName" => $_POST['VisitorPersonName'],
  "VisitorPersonPhone" => $_POST['VisitorPersonPhone'],
  "VisitorPersonEmailId" => $_POST['VisitorPersonEmailId'],
  "VisitPurpose" => $_POST['VisitPurpose'],
  "VisitPesonMeetWith" => GetNumbers($_POST['VisitPesonMeetWith']),
  "VisitPersonType" => $_POST['VisitPersonType'],
  "VisitPeronsDescription" => SECURE($_POST['VisitPeronsDescription'], "e"),
  "VisitPersonCreatedAt" => CURRENT_DATE_TIME,
  "VisitPersonUpdatedAt" => CURRENT_DATE_TIME,
  "VisitEnquiryStatus" => "NEW",
  "VisitEntryCreatedBy" => LOGIN_UserId
 ];

 $Response = INSERT("visitors", $Visitors);
 RESPONSE($Response, "Visitor Record saved successfully!", "Unable to save visitor record at the moment!");

 //update visitor record
} elseif (isset($_POST['UpdateVisit'])) {
 $VisitorId = SECURE($_POST['VisitorId'], "d");
 $Visitors = [
  "VisitorPersonName" => $_POST['VisitorPersonName'],
  "VisitorPersonPhone" => $_POST['VisitorPersonPhone'],
  "VisitorPersonEmailId" => $_POST['VisitorPersonEmailId'],
  "VisitPurpose" => $_POST['VisitPurpose'],
  "VisitPesonMeetWith" => GetNumbers($_POST['VisitPesonMeetWith']),
  "VisitPersonType" => $_POST['VisitPersonType'],
  "VisitPeronsDescription" => SECURE($_POST['VisitPeronsDescription'], "e"),
  "VisitPersonUpdatedAt" => CURRENT_DATE_TIME,
  "VisitEnquiryStatus" => $_POST['VisitEnquiryStatus'],
  "VisitEntryCreatedBy" => LOGIN_UserId,
  "VisitorOutTime" => $_POST['VisitorOutTime'],
 ];

 $Response = UPDATE_DATA("visitors", $Visitors, "VisitorId='$VisitorId'");
 RESPONSE($Response, "Visitor Record updated successfully!", "Unable to update visitor record at the moment!");
}
