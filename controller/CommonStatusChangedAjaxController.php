<?php
$Dir = "../";

//add controller helper files
require $Dir . '/require/modules.php';
//add aditional requirements
require $Dir . 'require/admin/access-control.php';

//=================================POST REQUEST ========================================

// Changes Bde Account Status (Active /Inactive)
if (isset($_POST['changeBdeStatusBtn'])) {
    $isStatus = FETCH("SELECT bdes_status FROM bdes_primary_details WHERE bdes_id='" . $_POST['bdeId'] . "' ", "bdes_status");
    if ($isStatus == "1") {
        $newStatus = "0";
    } else {
        $newStatus = "1";
    }
    $Update = UPDATE("UPDATE bdes_primary_details SET bdes_status='$newStatus' WHERE bdes_id='" . $_POST['bdeId'] . "' ");
    if ($Update == true) {
        echo "true";
    } else {
        echo "false";
    }
}

// Changes Student Account Status (Active /Inactive)
if (isset($_POST['changeStudentStatusBtn'])) {
    $isStatus = FETCH("SELECT student_status FROM students_primary_details WHERE student_id='" . $_POST['studentId'] . "' ", "student_status");

    if ($isStatus == "1") {
        $newStatus = "0";
    } else {
        $newStatus = "1";
    }
    $Update = UPDATE("UPDATE students_primary_details SET student_status='$newStatus' WHERE student_id='" . $_POST['studentId'] . "' ");
    if ($Update == true) {
        echo "true";
    } else {
        echo "false";
    }
}

// Changes University Account Status (Active /Inactive)
if (isset($_POST['changeUniversityStatusBtn'])) {
    $isStatus = FETCH("SELECT university_status FROM universities_primary_details WHERE university_id='" . $_POST['universityId'] . "' ", "university_status");
    if ($isStatus == "1") {
        $newStatus = "0";
    } else {
        $newStatus = "1";
    }
    $Update = UPDATE("UPDATE universities_primary_details SET university_status='$newStatus' WHERE university_id='" . $_POST['universityId'] . "' ");
    if ($Update == true) {
        echo "true";
    } else {
        echo "false";
    }
}
