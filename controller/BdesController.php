<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';

//======================>Bde's Post Request Start Here<========================================//
if(isset($_POST['SaveBdesData']) == "BdesData" && isset($_POST['checkOut']) == "checkOut"){
    $BdesPrimaryDetails = [
   "bdes_first_name" => $_POST['bdes_first_name'],
   "bdes_last_name" => $_POST['bdes_last_name'],
   "bdes_phone_no" => $_POST['bdes_phone_no'],
   "bdes_email_id" => $_POST['bdes_email_id'],
   "bdes_password" =>password_hash($_POST['bdes_password'], PASSWORD_BCRYPT),
   "bdes_address_line1" => $_POST['bdes_address_line1'],
   "bdes_address_line2" => $_POST['bdes_address_line2'],
   "bdes_city" => $_POST['bdes_city'],
   "bdes_state" => $_POST['bdes_state'],
   "bdes_country" => $_POST['bdes_country'],
   "bdes_zip" => $_POST['bdes_zip'],
   "created_by"=> LOGIN_UserId,
   "updated_by"=> LOGIN_UserId,
    ];

    $Response =INSERT("bdes_primary_details", $BdesPrimaryDetails);
    RESPONSE($Response,"Record is saved successfully!", "Unable to save record this moment please try later!");
} elseif (isset($_POST['UpdateBdesData']) == "UpdateBdesData" && isset($_POST['checkOut']) == "checkOut") {
    if (isset($_POST['BdeId'])) {
        $BdeId = SECURE($_POST['BdeId'], 'd');
    } else {
        RESPONSE($Response, "", "Unable to save record this moment please try later!");
    }
    $fetchPassword = FETCH(
        "SELECT bdes_password FROM bdes_primary_details WHERE bdes_id='$BdeId'",
        "bdes_password"
    );
    if ($fetchPassword == $_POST['bdes_password']) {
        $Password = $_POST['bdes_password'];
    } else {

        $Password =  password_hash($_POST['bdes_password'], PASSWORD_BCRYPT);
    }
    $BdesPrimaryDetails = [
        "bdes_first_name" => $_POST['bdes_first_name'],
        "bdes_last_name" => $_POST['bdes_last_name'],
        "bdes_phone_no" => $_POST['bdes_phone_no'],
        "bdes_email_id" => $_POST['bdes_email_id'],
        "bdes_password" => $Password,
        "bdes_address_line1" => $_POST['bdes_address_line1'],
        "bdes_address_line2" => $_POST['bdes_address_line2'],
        "bdes_city" => $_POST['bdes_city'],
        "bdes_state" => $_POST['bdes_state'],
        "bdes_country" => $_POST['bdes_country'],
        "bdes_zip" => $_POST['bdes_zip'],
        "updated_by" => LOGIN_UserId,
    ];
    $Response = UPDATE_DATA("bdes_primary_details", $BdesPrimaryDetails, "bdes_id='$BdeId'");
    RESPONSE($Response, "Record is update successfully!", "Unable to save record this moment please try later!");
}
