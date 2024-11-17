<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';
//===================================>Student Post Request Start Here===================================//

if (isset($_POST['AddNewStudent']) == "submit") {
     //Save Primary Details
     $StudentPrimaryDetails = [
          "student_full_name" => $_POST["student_full_name"],
          "student_phone_no" => $_POST["student_phone_no"],
          "student_alt_phone_no" => $_POST["student_alt_phone_no"],
          "student_email_id" => $_POST["student_email_id"],
          "student_alt_email_id" => $_POST["student_alt_email_id"],
          "student_date_birth" => $_POST["student_date_birth"],
          "student_gender" => $_POST["student_gender"],
          "created_by" => LOGIN_UserId,
          "updated_by" => LOGIN_UserId,
     ];
     $Save = INSERT("students_primary_details", $StudentPrimaryDetails);
     $FetchId = FETCH("SELECT student_id FROM students_primary_details ORDER BY student_id DESC limit 1", "student_id");
     // Save Lead Source And BDE Details
     if ($Save == true) {
          $studentsBdDetails = [
               "student_id" => $FetchId,
               "bde_id" => $_POST["stud_bde_name"],
               "BDEPoints" => $_POST["BDEPoints"],
               "leadSource" => $_POST["leadSource"],
               "refereeName" => $_POST["refereeName"],
               "refereeContact" => $_POST["refereeContact"],
               "stud_team_member" => "",
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = INSERT("students_leadSource_and_bdeDetails", $studentsBdDetails);
     }
     if ($Save == true) {
          //Fetch Course Specilization Fees Id

          $StudentUniversityCourseDetails = [
               "student_id" => $FetchId,
               "university_id" => $_POST["university_id"],
               "univ_session_id" => $_POST['univ_session_id'],
               "univ_courses_id" => $_POST["univ_courses_id"],
               "univ_course_specialization_id" => $_POST["univ_course_specialization_id"],
               "univ_course_specialization_fee_id" =>  $_POST["univ_course_specialization_id"],
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = INSERT("students_university_courses", $StudentUniversityCourseDetails);
     }
     if ($Save == true) {
          //Fetch Course Specilization Fees Id

          $studentsRegistrationDetails = [
               "student_id" => $FetchId,
               "university_id" => $_POST["university_id"],
               "univ_session_id" => $_POST['univ_session_id'],
               "univ_courses_id" => $_POST["univ_courses_id"],
               "univ_course_specialization_id" => $_POST["univ_course_specialization_id"],
               "univ_course_specialization_fee_id" =>  $_POST["univ_course_specialization_id"],
               "stud_dof_admission" => $_POST["stud_dof_admission"],
               "stud_reg_no" => $_POST["stud_reg_no"],
               "stud_reg_status" => $_POST["stud_reg_status"],
               "stud_fee_payment_mode" => $_POST["stud_fee_payment_mode"],
               "stud_reg_amount" => $_POST["stud_reg_amount"],
               "stud_payment_date" => $_POST["stud_payment_date"],
               "stud_fee_payment_type" => $_POST["stud_fee_payment_type"],
               "stud_reg_note" => $_POST["stud_reg_note"],
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = INSERT(
               "students_registration_details",
               $studentsRegistrationDetails
          );
     }
     //Save Student Registration Amount In studFeeTxn
     if ($Save == true) {
          //Fetch Course Specilization Fees Id

          $studentFeesTxn = [
               "student_id" => $FetchId,
               "university_id" => $_POST["university_id"],
               "session_id" => $_POST['univ_session_id'],
               "course_id" => $_POST["univ_courses_id"],
               "specilization_id" => $_POST["univ_course_specialization_id"],
               "specilization_fee_id" =>  $_POST["univ_course_specialization_id"],
               "discount_amount" => "0",
               "fee_mode" => "Registration Fee",
               "fee_mode_name" => $_POST["stud_fee_payment_type"],
               "fee_mode_amount" => $_POST["stud_reg_amount"],
               "feePayment" => $_POST['stud_reg_amount'],
               "payment_method" => $_POST["stud_fee_payment_mode"],
               "payment_status" => "Done",
               "transaction_date_time" => CURRENT_DATE_TIME,
               "is_completed" => "Completed",
               "description" => $_POST["stud_reg_note"],
               "transaction_type" => "Payment",
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = INSERT("student_fee_txns", $studentFeesTxn);
     }
     //Save Student Registration Amount In studFeeCollect
     if ($Save == true) {
          //Fetch studFeeTxn Id
          $studFeeTxnId = FETCH("SELECT stud_fee_txns_id FROM student_fee_txns ORDER BY stud_fee_txns_id  DESC LIMIT 1", "stud_fee_txns_id");

          //Fetch Course Specilization Fees Id
          $studentFeesCollect = [
               "student_id" => $FetchId,
               "university_id" => $_POST["university_id"],
               "session_id" => $_POST['univ_session_id'],
               "course_id" => $_POST["univ_courses_id"],
               "specilization_id" => $_POST["univ_course_specialization_id"],
               "specilization_fee_id" =>  $_POST["univ_course_specialization_id"],
               "fee_mode" => "Registration Fee",
               "fee_mode_name" => $_POST["stud_fee_payment_type"],
               "fee_mode_amount" => $_POST["stud_reg_amount"],
               "total_amount" => $_POST["stud_reg_amount"],
               "paid_amount"  => $_POST["stud_reg_amount"],
               "outstanding_amount" => "0",
               "due_date" => "N/A",
               "last_payment_date" => "N/A",
               "is_overdue" => "N/A",
               "payment_method" => $_POST["stud_fee_payment_mode"],
               "payment_status" => "Done",
               "stud_fee_txns_id" => $studFeeTxnId,
               "is_completed" => "Completed",
               "transaction_type" => "Payment",
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = INSERT("stud_fee_collects", $studentFeesCollect);
     }
     //Create Student Fees Mode By default (N/A) In Stud_fee_modes table
     if ($Save == true) {
          $firstFeesEntry = [
               "student_id" => $FetchId,
               "university_id" => $_POST["university_id"],
               "session_id" => $_POST['univ_session_id'],
               "course_id" => $_POST["univ_courses_id"],
               "specilization_id" => $_POST["univ_course_specialization_id"],
               "specilization_fee_id" =>  $_POST["univ_course_specialization_id"],
               "fee_mode" => "N/A",
               "fee_mode_status" => "Pending",
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = INSERT("stud_fees_modes", $firstFeesEntry);
          $studFeeModeId = FETCH(
               "SELECT stud_fee_mode_id
               FROM stud_fees_modes
               ORDER BY stud_fee_mode_id DESC
               LIMIT 1;
               ",
               "stud_fee_mode_id"
          );
     }
     //Create Student Discount BY Default (N/A) In students_discount_details
     if ($Save == true) {


          $studentsDiscountDetails = [
               "student_id" => $FetchId,
               "university_id" => $_POST["university_id"],
               "session_id" => $_POST['univ_session_id'],
               "course_id" => $_POST["univ_courses_id"],
               "specilization_id" => $_POST["univ_course_specialization_id"],
               "specilization_fee_id" =>  $_POST["univ_course_specialization_id"],
               "discount_type" => "N/A",
               "discount_mode" => "N/A",
               "discount_type_names" => "N/A",
               "discount_type_fees" => "N/A",
               "discount_status" => "Pending",
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = INSERT("students_university_course_discount_details", $studentsDiscountDetails);
          $DiscountId = FETCH("SELECT discount_id FROM students_university_course_discount_details ORDER BY discount_id DESC LIMIT 1", "discount_id");
     }
     //Create Student First Fee Entry In  stud_fee_collects Table With DEfault Value(N/A)
     if ($Save == true) {
          //Fetch Course Specilization Fees Id
          $firstFeesEntry = [
               "student_id" => $FetchId,
               "university_id" => $_POST["university_id"],
               "session_id" => $_POST['univ_session_id'],
               "course_id" => $_POST["univ_courses_id"],
               "specilization_id" => $_POST["univ_course_specialization_id"],
               "specilization_fee_id" => $_POST["univ_course_specialization_id"],
               "discount_id" => $DiscountId,
               "fee_mode" => "N/A",
               "fee_mode_name" => "N/A",
               "fee_mode_amount" => "N/A",
               "total_amount" => "N/A",
               "paid_amount"  => "N/A",
               "outstanding_amount" => "N/A",
               "due_date" => "N/A",
               "last_payment_date" => "N/A",
               "is_overdue" => "N/A",
               "payment_method" => "N/A",
               "payment_status" => "Pending",
               "stud_fee_txns_id" => "N/A",
               "stud_fee_mode_id" => $studFeeModeId,
               "is_completed" => "N/A",
               "transaction_type" => "N/A",
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = INSERT("stud_fee_collects", $firstFeesEntry);
     }

     RESPONSE($Save, "Student details are saved successfully!", "Unable to save Student details  at the moment please try again later!");
} elseif (isset($_POST['UpdateStudentDetails']) == "submit") {
     if (isset($_POST['studentId'])) {
          $StudentId = SECURE($_POST['studentId'], 'd');
     }
     //Update Primary Details
     $StudentPrimaryDetails = [
          "student_full_name" => $_POST["student_full_name"],
          "student_phone_no" => $_POST["student_phone_no"],
          "student_alt_phone_no" => $_POST["student_alt_phone_no"],
          "student_email_id" => $_POST["student_email_id"],
          "student_alt_email_id" => $_POST["student_alt_email_id"],
          "student_date_birth" => $_POST["student_date_birth"],
          "student_gender" => $_POST["student_gender"],
          "created_by" => LOGIN_UserId,
          "updated_by" => LOGIN_UserId,
     ];
     $Save = UPDATE_DATA("students_primary_details", $StudentPrimaryDetails, "student_id='" . $StudentId . "'");

     // Update Lead Source And BDE Details
     if ($Save == true) {
          $studentsBdDetails = [

               "bde_id" => $_POST["stud_bde_name"],
               "BDEPoints" => $_POST["BDEPoints"],
               "leadSource" => $_POST["leadSource"],
               "refereeName" => $_POST["refereeName"],
               "refereeContact" => $_POST["refereeContact"],
               "stud_team_member" => "",
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = UPDATE_DATA("students_leadSource_and_bdeDetails", $studentsBdDetails, "student_id='" . $StudentId . "'");
     }
     if ($Save == true) {
          //Fetch Course Specilization Fees Id
          $courseSpecId = FETCH("SELECT univ_courses_spec_fee_id FROM universities_courses_specializations_fees WHERE 	university_specialization_id='" . $_POST['univ_course_specialization_id'] . "'", "univ_courses_spec_fee_id");
          $StudentUniversityCourseDetails = [
               "university_id" => $_POST["university_id"],
               "univ_session_id" => $_POST['univ_session_id'],
               "univ_courses_id" => $_POST["univ_courses_id"],
               "univ_course_specialization_id" => $_POST["univ_course_specialization_id"],
               "univ_course_specialization_fee_id" =>  $courseSpecId,
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = UPDATE_DATA("students_university_courses", $StudentUniversityCourseDetails, "student_id='" . $StudentId . "'");
     }
     // if ($Save == true) {
     //      if ($_POST["discount_type"] == "Semester Wise Discount") {
     //           $discount_type_names = implode(",", $_POST["semester_wise_discount"]);
     //           $discount_type_fees = implode(",", $_POST["semester_wise_discount_amount"]);
     //      } elseif ($_POST["discount_type"] == "Year Wise Discount") {
     //           $discount_type_names = implode(",", $_POST["year_wise_discount"]);
     //           $discount_type_fees = implode(",", $_POST["year_wise_discount_amount"]);
     //      } else {
     //           $discount_type_names = implode(",", $_POST["onetime_wise_discount"]);
     //           $discount_type_fees = implode(",", $_POST["onetime_wise_discount_amount"]);
     //      }

     //      $studentsRegistrationDetails = [
     //           "university_id" => $_POST["university_id"],
     //           "session_id" => $_POST['univ_session_id'],
     //           "course_id" => $_POST["univ_courses_id"],
     //           "specilization_id" => $_POST["univ_course_specialization_id"],
     //           "specilization_id" =>  $courseSpecId,
     //           "discount_type" => $_POST["discount_type"],
     //           "discount_mode" => $_POST["discount_mode"],
     //           "discount_type_names" => $discount_type_names,
     //           "discount_type_fees" => $discount_type_fees,
     //           "created_by" => LOGIN_UserId,
     //           "updated_by" => LOGIN_UserId,
     //      ];
     //      $Save = UPDATE_DATA("students_university_course_discount_details", $studentsRegistrationDetails, "student_id='" . $StudentId . "'");
     // }
     if ($Save == true) {
          //Fetch Course Specilization Fees Id
          $courseSpecId = FETCH("SELECT univ_courses_spec_fee_id FROM universities_courses_specializations_fees WHERE 	university_specialization_id='" . $_POST['univ_course_specialization_id'] . "'", "univ_courses_spec_fee_id");
          $studentsRegistrationDetails = [
               "university_id" => $_POST["university_id"],
               "univ_session_id" => $_POST['univ_session_id'],
               "univ_courses_id" => $_POST["univ_courses_id"],
               "univ_course_specialization_id" => $_POST["univ_course_specialization_id"],
               "univ_course_specialization_fee_id" =>  $courseSpecId,
               "stud_dof_admission" => $_POST["stud_dof_admission"],
               "stud_reg_no" => $_POST["stud_reg_no"],
               "stud_reg_status" => $_POST["stud_reg_status"],
               "stud_fee_payment_mode" => $_POST["stud_fee_payment_mode"],
               "stud_reg_amount" => $_POST["stud_reg_amount"],
               "stud_payment_date" => $_POST["stud_payment_date"],
               "stud_fee_payment_type" => $_POST["stud_fee_payment_type"],
               "stud_reg_note" => $_POST["stud_reg_note"],
               "created_by" => LOGIN_UserId,
               "updated_by" => LOGIN_UserId,
          ];
          $Save = UPDATE_DATA("students_registration_details", $studentsRegistrationDetails, "student_id='" . $StudentId . "'");
     }
     RESPONSE($Save, "Student Details successfully update", "Something went wrong!");
}
