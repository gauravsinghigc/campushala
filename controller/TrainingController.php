<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';

//start request processing
if (isset($_POST['SaveTrainingDetails'])) {

 $trainings = [
  "TrainingName" => $_POST['TrainingName'],
  "TrainingDate" => $_POST['TrainingDate'],
  "TrainingDetails" => $_POST['TrainingDetails'],
  "TrainingDescriptions" => SECURE($_POST['TrainingDescriptions'], "e"),
  "TrainingMode" => $_POST['TrainingMode'],
  "TrainingStatus" => $_POST['TrainingStatus'],
  "TrainingCreatedAt" => CURRENT_DATE_TIME,
  "TrainingUpdatedAt" => CURRENT_DATE_TIME,
  "TrainingCreatedBy" => LOGIN_UserId,
  "TrainingUpdatedBy" => LOGIN_UserId
 ];

 $Response = INSERT("trainings", $trainings);
 RESPONSE($Response, "<b>" . $_POST['TrainingName'] . "</b> is saved successfully!", "Unable to save new training record");

 //update training
} elseif (isset($_POST['UpateTrainingDetails'])) {
 $TrainingId = SECURE($_POST['TrainingId'], "d");

 $trainings = [
  "TrainingName" => $_POST['TrainingName'],
  "TrainingDate" => $_POST['TrainingDate'],
  "TrainingDetails" => $_POST['TrainingDetails'],
  "TrainingDescriptions" => SECURE($_POST['TrainingDescriptions'], "e"),
  "TrainingMode" => $_POST['TrainingMode'],
  "TrainingStatus" => $_POST['TrainingStatus'],
  "TrainingUpdatedAt" => CURRENT_DATE_TIME,
  "TrainingUpdatedBy" => LOGIN_UserId
 ];

 $Response = UPDATE_DATA("trainings", $trainings, "TrainingId='$TrainingId'");
 RESPONSE($Response, "<b>" . $_POST['TrainingName'] . "</b> is saved successfully!", "Unable to save new training record");
}
