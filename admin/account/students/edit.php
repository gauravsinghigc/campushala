<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Student Details";
$PageDescription = "Manage all domains";
$btntext = "Add New Leads";
$DomainExpireInCurrentMonth = date("Y-m-d", strtotime("+1 month"));

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $by = $_GET['by'];
    $level = $_GET['level'];
    $LeadPersonSource = $_GET['LeadPersonSource'];
} else {
    $type = "";
    $from = date("Y-m-d");
    $to = date("Y-m-d");
    $by = "1";
    $level = "";
    $LeadPersonSource = "";
}
if (isset($_GET['eid'])) {
    $StudentId = SECURE($_GET['eid'], 'd');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="keywords" content="<?php echo APP_NAME; ?>">
    <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
    <?php include $Dir . "/include/admin/header_files.php"; ?>
    <script type="text/javascript">
        function SidebarActive() {
            document.getElementById("leads").classList.add("active");
            document.getElementById("lead_add_calls").classList.add("active");
        }
        window.onload = SidebarActive;
    </script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include $Dir . "/include/admin/loader.php"; ?>

        <?php
        include $Dir . "/include/admin/header.php";
        include $Dir . "/include/admin/sidebar.php"; ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-5 col-12">
                                            <h3 class="app-heading"><?php echo $PageName; ?></h3>
                                        </div>
                                        <div class="col-sm-7 col-12 text-right">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Update Discount
                                            </button>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">


                                            <form action="<?php echo CONTROLLER; ?>/StudentsController.php" method="POST">
                                                <?php FormPrimaryInputs(true, [

                                                    "studentId" => $StudentId,
                                                ]); ?>

                                                <div class="col-md-12">
                                                    <div class="card student-card mx-auto">
                                                        <div class="tab">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <?php $fetchData = FETCH_DB_TABLE("SELECT * FROM students_primary_details AS spd INNER JOIN students_leadSource_and_bdeDetails AS sld ON spd.student_id = sld.student_id WHERE spd.student_id='$StudentId'", true);
                                                                    if (isset($fetchData)) {
                                                                        foreach ($fetchData as $value) {
                                                                    ?>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="card-header">
                                                                                        Student Primary Details
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Student Full Name <?php echo $req; ?></label>
                                                                                                <input type="text" value="<?php if (!empty($value->student_full_name)) {
                                                                                                                                echo $value->student_full_name;
                                                                                                                            } ?>" name="student_full_name" class="form-control form-control-sm" required="">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Phone Number <?php echo $req; ?></label>
                                                                                                <input type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" value="<?php if (!empty($value->student_phone_no)) {
                                                                                                                                                                                                                echo $value->student_phone_no;
                                                                                                                                                                                                            } ?>" name="student_phone_no" class="form-control form-control-sm" required="">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Alternate Phone Number </label>
                                                                                                <input type="tel" placeholder="without +91" value="<?php if (!empty($value->student_alt_phone_no)) {
                                                                                                                                                        echo $value->student_alt_phone_no;
                                                                                                                                                    } ?>" name="student_alt_phone_no" class="form-control form-control-sm">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Email-ID </label>
                                                                                                <input type="email" oninput="CheckExistingMailId()" id="EmailId" value="<?php if (!empty($value->student_email_id)) {
                                                                                                                                                                            echo $value->student_email_id;
                                                                                                                                                                        } ?>" name="student_email_id" class="form-control form-control-sm">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Alternate Email-ID </label>
                                                                                                <input type="email" value="<?php if (!empty($value->student_alt_email_id)) {
                                                                                                                                echo $value->student_alt_email_id;
                                                                                                                            } ?>" name="student_alt_email_id" class="form-control form-control-sm">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Date of Birth </label>
                                                                                                <input type="date" value="<?php if (!empty($value->student_date_birth)) {
                                                                                                                                echo $value->student_date_birth;
                                                                                                                            } ?>" name="student_date_birth" class="form-control form-control-sm">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Gender </label>
                                                                                                <select name="student_gender" class="form-control form-control-sm">
                                                                                                    <?php InputOptions(['Male', 'Female', 'Others'], $value->student_gender) ?>

                                                                                                </select>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12">
                                                                                    <div class="card-header">
                                                                                        Lead Source & Select BDE
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Lead Source <?php echo $req; ?></label>
                                                                                                <select name="leadSource" class="form-control" id="leadSource" onchange="leadSources()">
                                                                                                    <option value="">choose lead souces</option>
                                                                                                    <?php InputOptions(['Referred By', 'Whatsapp', 'Facebook', 'Instagram'], $value->leadSource) ?>

                                                                                                </select>
                                                                                            </div>
                                                                                            <?php if ($value->leadSource == "Referred By") {
                                                                                                $style = "display: block;";
                                                                                            } else {
                                                                                                $style = "display: none;";
                                                                                            }  ?>
                                                                                            <div class="col-md-6" style="<?= $style ?>" id="referredBy">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Referee Name <?php echo $req; ?></label>
                                                                                                    <input type="text" name="refereeName" class="form-control form-control-sm" value="<?php if (!empty($value->refereeName)) {
                                                                                                                                                                                            echo $value->refereeName;
                                                                                                                                                                                        } ?>">
                                                                                                </div>
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Referee Contact <?php echo $req; ?></label>
                                                                                                    <input type="text" name="refereeContact" class="form-control form-control-sm" value="<?php if (!empty($value->refereeContact)) {
                                                                                                                                                                                                echo $value->refereeContact;
                                                                                                                                                                                            } ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>BDE <?php echo $req; ?></label>
                                                                                                    <select name="stud_bde_name" class="form-control" id="selectBDEDetails">
                                                                                                        <option value="">choose lead BDE's</option>
                                                                                                        <?php $fetchBda = FETCH_DB_TABLE("SELECT * FROM bdes_primary_details", true);
                                                                                                        if (isset($fetchBda)) {
                                                                                                            foreach ($fetchBda as $val) {
                                                                                                                if ($value->bde_id == $val->bdes_id) {
                                                                                                                    $Selected = "selected";
                                                                                                                } else {
                                                                                                                    $Selected = "";
                                                                                                                }
                                                                                                                //Inactive BDE disable Option
                                                                                                                if ($val->bdes_status == '1') {
                                                                                                                    $disabled = "";
                                                                                                                } else {
                                                                                                                    $disabled = "disabled";
                                                                                                                }

                                                                                                        ?>
                                                                                                                <option <?= $disabled ?> value="<?= $val->bdes_id ?>" <?= $Selected ?>><?= $val->bdes_first_name . "" . $val->bdes_last_name ?></option>
                                                                                                        <?php }
                                                                                                        } ?>
                                                                                                    </select>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <label for="">BDE Points</label>
                                                                                                <input type="text" class="form-control form-control-sm" name="BDEPoints" value="<?php if (!empty($value->BDEPoints)) {
                                                                                                                                                                                    echo $value->BDEPoints;
                                                                                                                                                                                } ?>">
                                                                                            </div>

                                                                                            <div class="col-md-12">
                                                                                                <div class="accordion shadow-sm " id="accordionExample">
                                                                                                    <div class="card">
                                                                                                        <div class="card-header p-0" id="headingOne">
                                                                                                            <h2 class="mb-0">
                                                                                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                                                                    <i class="bi bi-eye-fill text-info"></i> BDE Details
                                                                                                                </button>
                                                                                                            </h2>
                                                                                                        </div>

                                                                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                                                                            <div class="card-body" id="BdeDetails">
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    <?php  }
                                                                    }  ?>
                                                                </div>

                                                                <div class="col-md-7">
                                                                    <div class="card-header">
                                                                        University Details
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <?php $fetchData = FETCH_DB_TABLE("SELECT * FROM students_primary_details AS spd  INNER JOIN students_university_courses AS suc ON spd.student_id = suc.student_id  WHERE spd.student_id='$StudentId'", true);
                                                                        if (isset($fetchData)) {
                                                                            foreach ($fetchData as $value) {

                                                                        ?>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-12 col-xs-12 col-sm-12 form-group">
                                                                                                <div class="form-group">
                                                                                                    <label>Select University</label><br>
                                                                                                    <select name="university_id" class="form-control selectpicker " data-live-search="true" id="studUniversityName" style="width: 100%;" required="">
                                                                                                        <option>choose university</option>
                                                                                                        <?php $fetchStudUniversityId = FETCH_DB_TABLE("SELECT university_id,university_name FROM universities_primary_details", true);
                                                                                                        if (isset($fetchStudUniversityId)) {
                                                                                                            foreach ($fetchStudUniversityId as $val) {
                                                                                                                if ($value->university_id == $val->university_id) {
                                                                                                                    $Selected = "selected";
                                                                                                                } else {
                                                                                                                    $Selected = "";
                                                                                                                }  ?>
                                                                                                                <option value="<?= $val->university_id ?>" <?= $Selected ?>><?= $val->university_name ?></option>
                                                                                                        <?php }
                                                                                                        } ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 form-group">
                                                                                        <label>Course Session Years</label>
                                                                                        <select class="form-control selectpicker " data-live-search="true" name="univ_session_id" id="UniversityCourseSessionYears" style="width: 100%;" required="">

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-12 col-xs-12 col-sm-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Select Couses</label>
                                                                                                    <select name="univ_courses_id" class="form-control" id="studUniversityCourseName">
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 form-group">
                                                                                        <label>Course Specialization</label>
                                                                                        <select class="form-control selectpicker " data-live-search="true" name="univ_course_specialization_id" id="UniversityCourseSpecialization" style="width: 100%;" required="">

                                                                                        </select>
                                                                                    </div>


                                                                                    <div class="col-md-6">
                                                                                        <div class="accordion shadow-sm " id="accordionExample">
                                                                                            <div class="card">
                                                                                                <div class="card-header p-0" id="headingTwo">
                                                                                                    <h2 class="mb-0">
                                                                                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                                                                            <i class="bi bi-eye-fill text-info"></i> University Details
                                                                                                        </button>
                                                                                                    </h2>
                                                                                                </div>

                                                                                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                                                                    <div class="card-body" id="UniversityAddressResponse">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="accordion shadow-sm " id="accordionExample">
                                                                                            <div class="card">
                                                                                                <div class="card-header p-0" id="headingThree">
                                                                                                    <h2 class="mb-0">
                                                                                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                                                                            <i class="bi bi-eye-fill text-info"></i> Course Details
                                                                                                        </button>
                                                                                                    </h2>
                                                                                                </div>

                                                                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                                                                    <div class="card-body" id="UniversityCoursesDetails">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>

                                                                                </div>
                                                                        <?php }
                                                                        } ?>
                                                                        <?php $fetchData = FETCH_DB_TABLE("SELECT * FROM students_primary_details AS spd INNER JOIN students_registration_details AS srd ON spd.student_id = srd.student_id WHERE spd.student_id='$StudentId'", true);
                                                                        if (isset($fetchData)) {
                                                                            foreach ($fetchData as $value) {
                                                                        ?>
                                                                                <div class="row">
                                                                                    <div class="card-header w-100">
                                                                                        Student Registration Details
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <div class="row">
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Date of Admission</label>
                                                                                                <input type="date" value="<?php if (!empty($value->stud_dof_admission)) {
                                                                                                                                echo $value->stud_dof_admission;
                                                                                                                            } ?>" name="stud_dof_admission" class="form-control" min="1">
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Student Registration No</label>
                                                                                                <input type="text" value="<?php if (!empty($value->stud_reg_no)) {
                                                                                                                                echo $value->stud_reg_no;
                                                                                                                            } ?>" name="stud_reg_no" class="form-control" min="1">
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Registration Status</label>
                                                                                                <select value="" name="stud_reg_status" class="form-control">
                                                                                                    <?php
                                                                                                    $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("REGISTRATION_STATUS"), true);
                                                                                                    $data = [];
                                                                                                    if ($LeadSource != null) {
                                                                                                        foreach ($LeadSource as $Source) {
                                                                                                            $data[] = $Source->ConfigValueDetails;
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                                    <?php InputOptions($data, $value->stud_reg_status)  ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Payment Mode</label>
                                                                                                <select name="stud_fee_payment_mode" class="form-control">
                                                                                                    <?php InputOptions(['Cash', 'Check', 'UPI', 'Debit card', 'Credit card', 'Internet Banking'], $value->stud_fee_payment_mode)  ?>

                                                                                                </select>
                                                                                            </div>

                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Payment Type</label>
                                                                                                <select name="stud_fee_payment_type" class="form-control">
                                                                                                    <?php InputOptions(['Registration Amount'], $value->stud_fee_payment_type) ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Inital Payment/Registration Amount</label>
                                                                                                <input type="text" value="<?php if (!empty($value->stud_reg_amount)) {
                                                                                                                                echo $value->stud_reg_amount;
                                                                                                                            } ?>" name="stud_reg_amount" class="form-control" min="1">
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Payment Date</label>
                                                                                                <input type="date" value="<?php if (!empty($value->stud_payment_date)) {
                                                                                                                                echo $value->stud_payment_date;
                                                                                                                            } ?>" name="stud_payment_date" class="form-control" min="1">
                                                                                            </div>

                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Notes/Remarks</label>
                                                                                                <input type="text" value="<?php if (!empty($value->stud_reg_note)) {
                                                                                                                                echo $value->stud_reg_note;
                                                                                                                            } ?>" name="stud_reg_note" class="form-control" min="1">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        <?php }
                                                                        } ?>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!--Discount  Modal -->
                                                            <div class="modal  fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-xl modal-dialog-scrollable ">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-16" id="exampleModalLabel">Add Discount On Courses</h1>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <?php $fetchData = FETCH_DB_TABLE("SELECT * FROM students_university_course_discount_details  WHERE student_id='$StudentId'", true);
                                                                        if (isset($fetchData)) {
                                                                            foreach ($fetchData as $val) {
                                                                                $discount_type_names = explode(",", $val->discount_type_names);
                                                                                $discount_type_fees = explode(",", $val->discount_type_fees);
                                                                        ?>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            <div class="row">
                                                                                                <div class="col-md-6 form-group">
                                                                                                    <label>Discount Type</label>
                                                                                                    <select name="discount_type" class="form-control" id="discountMode" onchange="showFeesModesField()">
                                                                                                        <?php InputOptions(['choose discount type', 'Semester Wise Discount', 'Year Wise Discount', 'On Total Fee Discount'], $val->discount_type) ?> </select>
                                                                                                </div>
                                                                                                <div class="col-md-6 form-group">
                                                                                                    <label>Discount Mode</label>
                                                                                                    <select name="discount_mode" class="form-control" id="DiscountType">
                                                                                                        <?php InputOptions(['choose discount mode', 'Amount', 'Percentage'], $val->discount_mode) ?>
                                                                                                    </select>

                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="row">

                                                                                                <div class='col-md-12 form-group' id="SemestersFee" style="display: none !important;">
                                                                                                    <?php
                                                                                                    if ($val->discount_type == "Semester Wise Discount") {
                                                                                                        foreach ($discount_type_names as $key => $value) {
                                                                                                    ?>
                                                                                                            <div class="row" id="AddMoreSemesters">
                                                                                                                <div class="col-md-10 form-group d-flex">
                                                                                                                    <div class="w-50">
                                                                                                                        <label>Semester Name <?php echo $req; ?></label>
                                                                                                                        <select name="semester_wise_discount[]" class="form-control ">
                                                                                                                            <option value="">Choose Semester</option>
                                                                                                                            <option value="1" <?php if ($value == 1) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>First Semester</option>
                                                                                                                            <option value="2" <?php if ($value == 2) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Second Semester</option>
                                                                                                                            <option value="3" <?php if ($value == 3) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Third Semester</option>
                                                                                                                            <option value="4" <?php if ($value == 4) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Fourth Semester</option>
                                                                                                                            <option value="5" <?php if ($value == 5) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Fifth Semester</option>
                                                                                                                            <option value="6" <?php if ($value == 6) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Sixth Semester</option>
                                                                                                                            <option value="7" <?php if ($value == 7) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Seventh Semester</option>
                                                                                                                            <option value="8" <?php if ($value == 8) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Eighth Semester</option>
                                                                                                                            <option value="9" <?php if ($value == 9) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Ninth Semester</option>
                                                                                                                            <option value="10" <?php if ($value == 10) {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Tenth Semester</option>
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                        <label>Discount Amount/Percentage <?php echo $req; ?></label>
                                                                                                                        <input type="number" name="semester_wise_discount_amount[]" class="form-control " placeholder="10000" value="<?= $discount_type_fees[$key] ?>">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-2 form-group ">
                                                                                                                    <label></label>
                                                                                                                    <button class="btn btn-outline-info mt-3  add_semesters_name_btn"><i class="bi bi-plus"></i></button>
                                                                                                                </div>

                                                                                                            </div>
                                                                                                        <?php
                                                                                                        }
                                                                                                    } else { ?>
                                                                                                        <div class="row" id="AddMoreSemesters">
                                                                                                            <div class="col-md-10 form-group d-flex">
                                                                                                                <div class="w-50">
                                                                                                                    <label>Semester Name <?php echo $req; ?></label>
                                                                                                                    <select name="semester_wise_discount[]" class="form-control ">
                                                                                                                        <option value="">Choose Semester</option>
                                                                                                                        <option value="1">First Semester</option>
                                                                                                                        <option value="2">Second Semester</option>
                                                                                                                        <option value="3">Third Semester</option>
                                                                                                                        <option value="4">Fourth Semester</option>
                                                                                                                        <option value="5">Fifth Semester</option>
                                                                                                                        <option value="6">Sixth Semester</option>
                                                                                                                        <option value="7">Seventh Semester</option>
                                                                                                                        <option value="8">Eighth Semester</option>
                                                                                                                        <option value="9">Ninth Semester</option>
                                                                                                                        <option value="10">Tenth Semester</option>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                    <label>Discount Amount/Percentage <?php echo $req; ?></label>
                                                                                                                    <input type="number" name="semester_wise_discount_amount[]" class="form-control " placeholder="10000">
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-2 form-group ">
                                                                                                                <label></label>
                                                                                                                <button class="btn btn-outline-info mt-3  add_semesters_name_btn"><i class="bi bi-plus"></i></button>
                                                                                                            </div>

                                                                                                        </div>
                                                                                                    <?php } ?>
                                                                                                </div>


                                                                                                <div class='col-md-12 form-group ' id="YearsFee" style="display: none !important;">
                                                                                                    <?php
                                                                                                    if ($val->discount_type == "Year Wise Discount") {
                                                                                                        foreach ($discount_type_names as $key => $value) {
                                                                                                    ?>
                                                                                                            <div class="row" id="AddMoreYear">
                                                                                                                <div class="col-md-10 form-group d-flex">
                                                                                                                    <div class="w-50">
                                                                                                                        <label>Year Name <?php echo $req; ?></label>
                                                                                                                        <select name="year_wise_discount[]" class="form-control ">
                                                                                                                            <option value="">choose year</option>
                                                                                                                            <option value="1" <?php if ($value == "1") {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>First Years</option>
                                                                                                                            <option value="2" <?php if ($value == "2") {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Second Years</option>
                                                                                                                            <option value="3" <?php if ($value == "3") {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Third Years</option>
                                                                                                                            <option value="4" <?php if ($value == "4") {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Fourth Years</option>
                                                                                                                            <option value="5" <?php if ($value == "5") {
                                                                                                                                                    echo "selected";
                                                                                                                                                } ?>>Fifth Years</option>
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                        <label>Discount Amount/Percentage <?php echo $req; ?></label>
                                                                                                                        <input type="number" name="year_wise_discount_amount[]" class="form-control " placeholder="10000" value="<?= $discount_type_fees[$key] ?>">

                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="col-md-2 form-group ">
                                                                                                                    <label></label>
                                                                                                                    <button class="btn btn-outline-info mt-3  add_more_year_btn"><i class="bi bi-plus"></i></button>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        <?php
                                                                                                        }
                                                                                                    } else { ?>
                                                                                                        <div class="row" id="AddMoreYear">
                                                                                                            <div class="col-md-10 form-group d-flex">
                                                                                                                <div class="w-50">
                                                                                                                    <label>Year Name <?php echo $req; ?></label>
                                                                                                                    <select name="year_wise_discount[]" class="form-control ">
                                                                                                                        <option value="">choose year</option>
                                                                                                                        <option value="1">First Years</option>
                                                                                                                        <option value="2">Second Years</option>
                                                                                                                        <option value="3">Third Years</option>
                                                                                                                        <option value="4">Fourth Years</option>
                                                                                                                        <option value="5">Fifth Years</option>
                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                    <label>Discount Amount/Percentage <?php echo $req; ?></label>
                                                                                                                    <input type="number" name="year_wise_discount_amount[]" class="form-control " placeholder="10000">

                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-2 form-group ">
                                                                                                                <label></label>
                                                                                                                <button class="btn btn-outline-info mt-3  add_more_year_btn"><i class="bi bi-plus"></i></button>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    <?php  } ?>
                                                                                                </div>


                                                                                                <div class='col-md-12 form-group ' id="OneTimeFee" style="display: none !important;">
                                                                                                    <?php

                                                                                                    if ($val->discount_type == "On Total Fee Discount") {
                                                                                                        foreach ($discount_type_names as $key => $value) {
                                                                                                    ?>
                                                                                                            <div class="row">
                                                                                                                <div class="col-md-12 form-group d-flex">
                                                                                                                    <div class="w-50">
                                                                                                                        <label>Total Year Fee<?php echo $req; ?></label>
                                                                                                                        <select name="onetime_wise_discount[]" class="form-control ">
                                                                                                                            <option value="">Choose Total Year Fee</option>
                                                                                                                            <option value="One Time">One Time</option>
                                                                                                                            <?php InputOptions(['Choose Total Year Fee', 'One Time'], $value); ?>
                                                                                                                        </select>
                                                                                                                    </div>
                                                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                        <label>Discount Amount/Percentage<?php echo $req; ?></label>
                                                                                                                        <input type="number" name="onetime_wise_discount_amount[]" class="form-control " placeholder="10000" value="<?= $discount_type_fees[$key] ?>">
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            </div>
                                                                                                        <?php
                                                                                                        }
                                                                                                    } else { ?>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 form-group d-flex">
                                                                                                                <div class="w-50">
                                                                                                                    <label>Total Discount On Year Fee<?php echo $req; ?></label>
                                                                                                                    <select name="onetime_wise_discount[]" class="form-control ">
                                                                                                                        <option value="">Choose Total Year Fee</option>
                                                                                                                        <option value="One Time">One Time</option>

                                                                                                                    </select>
                                                                                                                </div>
                                                                                                                <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                    <label>Discount Amount/Percentage<?php echo $req; ?></label>
                                                                                                                    <input type="number" name="onetime_wise_discount_amount[]" class="form-control " placeholder="10000">
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        </div>
                                                                                                    <?php  } ?>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                        <?php }
                                                                        } ?>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 d-flex justify-content-between btn">
                                                            <a href="#" onclick="Databar('AddNewStudents')" class="btn btn-sm btn-default ">Cancel</a>
                                                            <button type="submit" name="UpdateStudentDetails" value="submit" class="btn btn-sm btn-success ">Save Details</button>
                                                        </div>
                                                    </div>
                                                </div>


                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php

        include $Dir . "/include/admin/footer.php"; ?>
    </div>

    <?php include $Dir . "/include/admin/footer_files.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            var table = $('#studentsdatatable').DataTable();
        });
    </script>
    <script>
        $('#studUniversityName').select2({

            placeholder: "choose university",
        });
        $('.selectpicker').select2({

            placeholder: "Add New Course Specialization",
        });
        //Fetch University Session Years
        $(window).on("load", function(e) {
            e.preventDefault();
            let studUniversityId = $("#studUniversityName").val();
            var studentId = <?= $StudentId ?>;
            $.ajax({
                type: "post",
                url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                data: {
                    studUniversityId: studUniversityId,
                    studentId: studentId,
                    studUniBtnView: "view",
                },
                success: function(response) {
                    $("#UniversityCourseSessionYears").html(response);
                }
            });
        })
        $("#studUniversityName").on("change", function(e) {
            e.preventDefault();
            var studentId = <?= $StudentId ?>;
            var studUniversityId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                data: {
                    studUniversityId: studUniversityId,
                    studentId: studentId,
                    studUniBtn: "submit",
                },
                success: function(response) {
                    $("#UniversityCourseSessionYears").html(response);
                }
            });
        });
        //Fetch University Courses
        $(window).on("load", function(e) {
            setTimeout(function() {
                var StudentId = <?= $StudentId ?>;
                let studUniversityId = $("#studUniversityName").val();
                let studUniversitySessionId = $("#UniversityCourseSessionYears").val();
                $.ajax({
                    type: "post",
                    url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                    data: {
                        StudentId: StudentId,
                        universitySessionId: studUniversitySessionId,
                        studUniversityId: studUniversityId,
                        studUnversitySessionYearBtnEdit: "submit",
                    },
                    success: function(response) {
                        $("#studUniversityCourseName").html(response);
                    }
                });
            }, 300);
        });
        $("#UniversityCourseSessionYears").on("change", function(e) {
            e.preventDefault();
            var StudentId = <?= $StudentId ?>;
            var studUniversityId = $("#studUniversityName").val();
            var studUniversitySessionId = $("#UniversityCourseSessionYears").val();
            $.ajax({
                type: "post",
                url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                data: {
                    StudentId: StudentId,
                    universitySessionId: studUniversitySessionId,
                    studUniversityId: studUniversityId,
                    studUnversitySessionYearBtnEdit: "submit",
                },
                success: function(response) {
                    $("#studUniversityCourseName").html(response);
                }
            });
        });

        $(window).on("load", function(e) {
            setTimeout(function() {
                let universitySessionId = $("#UniversityCourseSessionYears").val();
                let univCourseId = $("#studUniversityCourseName").val();
                let studUniversityId = $("#studUniversityName").val();
                var studentId = <?= $StudentId ?>;
                $.ajax({
                    type: "post",
                    url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                    data: {
                        studentId: studentId,
                        studUniversityId: studUniversityId,
                        univCourseId: univCourseId,
                        universitySessionId: universitySessionId,
                        studUnversityCourseSepcBtnView: "submit",
                    },
                    success: function(response) {
                        $("#UniversityCourseSpecialization").html(response);
                    }
                });
            }, 400);
        })
        $("#studUniversityCourseName").on("change", function(e) {
            e.preventDefault();
            let universitySessionId = $("#UniversityCourseSessionYears").val();
            let univCourseId = $("#studUniversityCourseName").val();
            let studUniversityId = $("#studUniversityName").val();
            var studentId = <?= $StudentId ?>;
            $.ajax({
                type: "post",
                url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                data: {
                    studentId: studentId,
                    studUniversityId: studUniversityId,
                    univCourseId: univCourseId,
                    universitySessionId: universitySessionId,
                    studUnversityCourseSepcBtn: "submit",
                },
                success: function(response) {
                    $("#UniversityCourseSpecialization").html(response);
                }
            });
        });
        // Fetch University Address Details On change Select University Dropdown //
        $(window).on("load", function(e) {
            e.preventDefault();
            let UniversityId = $("#studUniversityName").val();
            $.ajax({
                type: "post",
                url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
                data: {
                    UniversityId: UniversityId,
                    UniversityBtn: "ChangeOption",
                },
                success: function(response) {
                    if (response != null) {
                        $("#UniversityAddressResponse").html(response);
                    }
                }
            });
        })
        $("#studUniversityName").on("change", function(e) {

            e.preventDefault();
            let UniversityId = $(this).val();
            $.ajax({
                type: "post",
                url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
                data: {
                    UniversityId: UniversityId,
                    UniversityBtn: "ChangeOption",
                },
                success: function(response) {
                    if (response != null) {
                        $("#UniversityAddressResponse").html(response);
                    }
                }
            });
        });
        //Fetch University Courses Details //
        $(window).on("load", function(e) {
            e.preventDefault();
            setTimeout(function() {
                let UniversityCourseSpecName = $("#UniversityCourseSpecialization").val();
                var studUniversityName = $("#studUniversityName").val();
                var UniversitySessionId = $("#UniversityCourseSessionYears").val();
                var UniversityCourseId = $("#studUniversityCourseName").val();
                var StudentId = <?= $StudentId ?>;
                $.ajax({
                    type: "post",
                    url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
                    data: {
                        StudentId: StudentId,
                        studUniversityName: studUniversityName,
                        UniversitySessionId: UniversitySessionId,
                        UniversityCourseSpecName: UniversityCourseSpecName,
                        UniversityCourseId: UniversityCourseId,
                        UniversityCourseBtns: "UniversityCourseChangeOption",
                    },
                    success: function(data) {
                        if (data != null) {
                            $("#UniversityCoursesDetails").html(data);
                        }
                    }
                });
            }, 1000);
        });
        $("#UniversityCourseSpecialization").on("change", function(e) {
            e.preventDefault();
            var StudentId = <?= $StudentId ?>;
            let UniversityCourseSpecName = $("#UniversityCourseSpecialization").val();
            var studUniversityName = $("#studUniversityName").val();
            var UniversitySessionId = $("#UniversityCourseSessionYears").val();
            var UniversityCourseId = $("#studUniversityCourseName").val();
            $.ajax({
                type: "post",
                url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
                data: {
                    StudentId: StudentId,
                    studUniversityName: studUniversityName,
                    UniversitySessionId: UniversitySessionId,
                    UniversityCourseSpecName: UniversityCourseSpecName,
                    UniversityCourseId: UniversityCourseId,
                    UniversityCourseBtns: "UniversityCourseChangeOption",
                },
                success: function(data) {
                    if (data != null) {
                        $("#UniversityCoursesDetails").html(data);
                    }
                }
            });
        });

        //Show lead source Div Referred By
        const leadSources = () => {
            const leadSourceSelect = document.getElementById("leadSource");
            const selectedLeadSourceOption = leadSourceSelect.options[leadSourceSelect.selectedIndex].value;
            const referredByDiv = document.getElementById("referredBy");

            if (selectedLeadSourceOption === "Referred By") {
                referredByDiv.style.display = "block";
            } else {
                referredByDiv.style.cssText = "display: none !important;";
            }
        };
        $(window).on("load", function(e) {
            e.preventDefault();
            let BdeId = $("#selectBDEDetails").val();
            $.ajax({
                type: "post",
                url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
                data: {
                    BdeId: BdeId,
                    BdeIdBtn: "BdeIdChangeOption",
                },
                success: function(data) {
                    if (data != null) {
                        $("#BdeDetails").html(data);
                    }
                }
            });
        });
        // Fetch Bde Details //
        $("#selectBDEDetails").on("change", function(e) {
            e.preventDefault();
            let BdeId = $(this).val();
            $.ajax({
                type: "post",
                url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
                data: {
                    BdeId: BdeId,
                    BdeIdBtn: "BdeIdChangeOption",
                },
                success: function(data) {
                    if (data != null) {
                        $("#BdeDetails").html(data);
                    }
                }
            });
        });
        // LIve Discount On Course Fees
        $(window).on("load", function(e) {
            e.preventDefault();
            setTimeout(function() {
                let discountAmount = $("#DiscountAmount").val();
                let discountMode = $("#discountMode").val();
                let DiscountType = $("#DiscountType").val();
                let studUniversityCourseName = $("#studUniversityCourseName").val();

                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                    data: {
                        discountAmount: discountAmount,
                        discountMode: discountMode,
                        studUniversityCourseName: studUniversityCourseName,
                        DiscountType: DiscountType,
                        keyUp: "Submit",
                    },
                    success: function(response) {
                        $("#AfterDiscountCoursePrice").html(response);
                    }
                });
            }, 1000)
        });
        $("#DiscountAmount").on("keyup", function(e) {
            e.preventDefault();
            let discountAmount = $(this).val();
            let discountMode = $("#discountMode").val();
            let DiscountType = $("#DiscountType").val();
            let studUniversityCourseName = $("#studUniversityCourseName").val();

            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                data: {
                    discountAmount: discountAmount,
                    discountMode: discountMode,
                    studUniversityCourseName: studUniversityCourseName,
                    DiscountType: DiscountType,
                    keyUp: "Submit",
                },
                success: function(response) {
                    $("#AfterDiscountCoursePrice").html(response);
                }
            });
        })
    </script>
    <script>
        // Show Semester Fee Fields
        // Function to handle the visibility of fee-related elements based on the selected option
        const showFeesModesField = () => {
            const semesterSelects = document.getElementById("discountMode");
            const selectedSemesterOptions = semesterSelects.options[semesterSelects.selectedIndex].value;
            const semesterDivs = document.getElementById("SemestersFee");
            const yearsFeesDivs = document.getElementById("YearsFee");
            const oneTimeFeesDivs = document.getElementById("OneTimeFee");

            if (selectedSemesterOptions === "Semester Wise Discount") {
                semesterDivs.style.display = "block";
            } else {
                semesterDivs.style.cssText = "display: none !important;";
            }

            if (selectedSemesterOptions === "Year Wise Discount") {
                yearsFeesDivs.style.display = "block";
            } else {
                yearsFeesDivs.style.cssText = "display: none !important;";
            }

            if (selectedSemesterOptions === "On Total Fee Discount") {
                oneTimeFeesDivs.style.display = "block";
            } else {
                oneTimeFeesDivs.style.cssText = "display: none !important;";
            }
        };

        // Event listener for window load
        window.addEventListener("load", () => {
            showFeesModesField();
        });

        // Event listener for dropdown change
        document.getElementById("discountMode").addEventListener("change", () => {
            showFeesModesField();
        });
        //Add Multiple Semester
        $(document).ready(function() {
            $(".add_semesters_name_btn").click(function(e) {
                e.preventDefault();
                $("#AddMoreSemesters").append(` <div class="row w-100 m-0" id="AddMoreSemesters">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Semester Name <?php echo $req; ?></label>
                              <select name="semester_wise_discount[]" class="form-control ">
                                <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                                <option value="3">Third Semester</option>
                                <option value="4">Fourth Semester</option>
                                <option value="5">Fifth Semester</option>
                                <option value="6">Sixth Semester</option>
                                <option value="7">Seventh Semester</option>
                                <option value="8">Eighth Semester</option>
                                <option value="9">Ninth Semester</option>
                                <option value="10">Tenth Semester</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 0.3125rem;">
                              <label>Discount Amount/Percentage <?php echo $req; ?></label>
                              <input type="number" name="semester_wise_discount_amount[]" class="form-control " placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger mt-3  remove_semesters_name_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>

                        </div>`);
            });
            $(document).on('click', '.remove_semesters_name_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
            //Add Multiple Years
            $(".add_more_year_btn").click(function(e) {
                e.preventDefault();
                $("#AddMoreYear").append(` <div class="row w-100 m-0" id="AddMoreYear">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year Name <?php echo $req; ?></label>
                              <select name="year_wise_discount[]" class="form-control ">
                              <option value="">choose year</option>
                              <option value="1">First Years</option>
                                <option value="2">Second Years</option>
                                <option value="3">Third Years</option>
                                <option value="4">Fourth Years</option>
                                <option value="5">Fifth Years</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 0.3125rem;">
                              <label>Discount Amount/Percentage <?php echo $req; ?></label>
                              <input type="number" name="year_wise_discount_amount[]" class="form-control " placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger mt-3 remove_more_year_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>
                        </div>`);
            });
            $(document).on('click', '.remove_more_year_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
        });
    </script>
</body>

</html>