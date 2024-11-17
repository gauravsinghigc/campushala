<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';
//====================================Update University Primary Details==============================//
if (isset($_POST['updateUniversityPrimaryDetails'])) {
    $UniversityId = SECURE($_POST['UniversityId'], 'd');
    $UniversityPrimaryDeatils = [
        "university_name" => $_POST['university_name'],
        "university_phone_no" => $_POST['university_phone_no'],
        "university_email_id" => $_POST['university_email_id'],
        "created_by" => LOGIN_UserId,
        "updated_by" => LOGIN_UserId,
    ];
    $Update = UPDATE_DATA("universities_primary_details", $UniversityPrimaryDeatils, "university_id='$UniversityId'");
    if ($Update) {

        $UniversityBillingAddressDetails = [
            "university_emails_id" => $_POST['university_emails_id'],
            "university_gst" => $_POST['university_gst'],
            "univ_reg_address" => $_POST['univ_reg_address'],
            "univ_reg_sector" => $_POST['univ_reg_sector'],
            "univ_reg_landmark" => $_POST['univ_reg_landmark'],
            "univ_reg_city" => $_POST['univ_reg_city'],
            "univ_reg_state" => $_POST['univ_reg_state'],
            "univ_reg_country" => $_POST['univ_reg_country'],
            "univ_reg_pincode" => $_POST['univ_reg_pincode'],
            "created_by" => LOGIN_UserId,
            "updated_by" => LOGIN_UserId,
        ];
        $Update = UPDATE_DATA("universities_billing_address", $UniversityBillingAddressDetails, "university_id='$UniversityId'");
    }
    RESPONSE($Update, "University details are updated successfully!", "unable to update university details!");
}
