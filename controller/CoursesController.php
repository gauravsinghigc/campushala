<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';
//===================================>Courses Post Request Start Here==========================================//
if(isset($_POST['SaveCourses'])){
    //Save Courses
    if (!empty($_POST['course_specialization'])) {
        $course_specialization = implode(",", $_POST['course_specialization']);
    } else {
        $course_specialization = Null;
    }
    if (!empty($_POST['course_semester_name'])) {
        $course_semester_name = implode(",", $_POST['course_semester_name']);
    } else {
        $course_semester_name = NULL;
    }
    if (!empty($_POST['course_semester_fee'])) {
        $course_semester_fee = implode(",", $_POST['course_semester_fee']);
    } else {
        $course_semester_fee = NULL;
    }
    if (!empty($_POST['course_years_name'])) {
        $course_years_name = implode(",", $_POST['course_years_name']);
    } else {
        $course_years_name = NULL;
    }
    if (!empty($_POST['course_years_fee'])) {
        $course_years_fee = implode(",", $_POST['course_years_fee']);
    } else {
        $course_years_fee = NULL;
    }
    
    $coursesPrimaryDetails=[
        "course_name" => $_POST['course_name'],
        "course_specialization" => $course_specialization,
        "course_type" => $_POST['course_type'],
        "course_session_year" => $_POST['course_session_year'],
        "course_total_years" => $_POST['course_total_years'],
        "course_total_semester" => $_POST['course_total_semester'],
        "fees_mode" => $_POST['fees_mode'],
        "fee_mode_semester_wise" => $course_semester_name,
        "semester_wise_fee" => $course_semester_fee,
        "fee_mode_year_wise" => $course_years_name,
        "year_wise_fee" => $course_years_fee,
        "fee_mode_one_time" => $_POST['course_total_years_name'],
        "one_time_fee" => $_POST['course_one_time_fee'],
        "course_total_fees" => $_POST['course_total_fees'],
        "created_by" => LOGIN_UserId,
        "updated_by" => LOGIN_UserId,
    ];
    $Save = INSERT("courses", $coursesPrimaryDetails);
    RESPONSE($Save,"Course details saved successfully","Unable to save course detail. Please try again later");
} elseif (isset($_POST['UpdateCourses'])) {
    $CourseId = SECURE($_POST['course_id'], 'd');

    //Save Courses
    if (!empty($_POST['course_specialization'])) {
        $course_specialization = implode(",", $_POST['course_specialization']);
    } else {
        $course_specialization = Null;
    }
    if (!empty($_POST['course_semester_name'])) {
        $course_semester_name = implode(",", $_POST['course_semester_name']);
    } else {
        $course_semester_name = NULL;
    }
    if (!empty($_POST['course_semester_fee'])) {
        $course_semester_fee = implode(",", $_POST['course_semester_fee']);
    } else {
        $course_semester_fee = NULL;
    }
    if (!empty($_POST['course_years_name'])) {
        $course_years_name = implode(",", $_POST['course_years_name']);
    } else {
        $course_years_name = NULL;
    }
    if (!empty($_POST['course_years_fee'])) {
        $course_years_fee = implode(",", $_POST['course_years_fee']);
    } else {
        $course_years_fee = NULL;
    }

    $coursesPrimaryDetails = [

        "course_name" => $_POST['course_name'],
        "course_specialization" => $course_specialization,
        "course_type" => $_POST['course_type'],
        "course_session_year" => $_POST['course_session_year'],
        "course_total_years" => $_POST['course_total_years'],
        "course_total_semester" => $_POST['course_total_semester'],
        "fees_mode" => $_POST['fees_mode'],
        "fee_mode_semester_wise" => $course_semester_name,
        "semester_wise_fee" => $course_semester_fee,
        "fee_mode_year_wise" => $course_years_name,
        "year_wise_fee" => $course_years_fee,
        "fee_mode_one_time" => $_POST['course_total_years_name'],
        "one_time_fee" => $_POST['course_one_time_fee'],
        "course_total_fees" => $_POST['course_total_fees'],

        "updated_by" => LOGIN_UserId,
    ];
    $Response = UPDATE_DATA("courses", $coursesPrimaryDetails, "course_id='$CourseId'");
    RESPONSE($Response, "Course details update successfully", "Unable to save course detail. Please try again later");
}