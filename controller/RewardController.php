<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';


if (isset($_POST['CreateRewards'])) {

 $user_rewards = [
  "RewardRefNo" => SECURE($_POST['RewardRefNo'], "d"),
  "RewardName" => $_POST['RewardName'],
  "RewardMainUserId" => $_POST['RewardMainUserId'],
  "RewardAttachedCreative" => UPLOAD_FILES("../storage/rewards/" . SECURE($_POST['RewardRefNo'], "d") . "/", "null", "Reward_", $_POST['RewardName'], "RewardAttachedCreative"),
  "RewardCreatedAt" => CURRENT_DATE_TIME,
  "RewardReceiveDate" => $_POST['RewardReceiveDate'],
  "RewardCreatedBy" => LOGIN_UserId,
  "RewardMessage" => SECURE($_POST['RewardMessage'], "e")
 ];

 RequestHandler(INSERT("user_rewards", $user_rewards), [
  "true" => "Reward details are saved successfully!",
  "false" => "Unable to save reward details at the moment!"
 ]);

 //update reward details
} elseif (isset($_POST['UpdateRewards'])) {
 $RewardsId = SECURE($_POST['RewardsId'], "d");

 $user_rewards = [
  "RewardName" => $_POST['RewardName'],
  "RewardMainUserId" => $_POST['RewardMainUserId'],
  "RewardUpdatedAt" => CURRENT_DATE_TIME,
  "RewardReceiveDate" => $_POST['RewardReceiveDate'],
  "RewardUpdatedBy" => LOGIN_UserId,
  "RewardMessage" => SECURE($_POST['RewardMessage'], "e")
 ];

 $RewardAttachedCreative = UPLOAD_FILES("../storage/rewards/" . SECURE($_POST['RewardRefNo'], "d") . "/", "null", "Reward_", $_POST['RewardName'], "RewardAttachedCreative");

 if ($RewardAttachedCreative != null) {
  $Update = UPDATE("UPDATE user_rewards SET RewardAttachedCreative='$RewardAttachedCreative' where RewardsId='$RewardsId'");
 }

 RequestHandler(UPDATE_DATA("user_rewards", $user_rewards, "RewardsId='$RewardsId'"), [
  "true" => "Reward details are updated successfully!",
  "false" => "Unable to update reward details at the moment!"
 ]);

 //remove reward controller
} elseif (isset($_GET['remove_reward_record'])) {
 DeleteReqHandler(
  "remove_reward_record",
  [
   "user_rewards" => "RewardsId='" . SECURE($_GET['RewardsId'], "d") . "'",
  ],
  [
   "true" => "Rewards details are deleted successfully",
   "false" => "Unable to delete reward details at the moment"
  ]
 );
}
