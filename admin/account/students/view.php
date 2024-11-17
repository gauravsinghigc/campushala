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
if (isset($_GET['id'])) {
    $StudentId = $_GET['id'];
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
                                        <div class="col-sm-12 col-12">
                                            <h3 class="app-heading"><?php echo $PageName; ?></h3>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">


                                            <form action="<?php echo CONTROLLER; ?>/StudentsController.php" method="POST">
                                                <?php FormPrimaryInputs(true, [
                                                    "SubmitBtn" => "SaveStudentData",
                                                    "stud_university_name_id" => "stud_university_name",
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
                                                                                                <input readonly type="text" value="<?php if (!empty($value->student_full_name)) {
                                                                                                                                        echo $value->student_full_name;
                                                                                                                                    } ?>" name="student_full_name" class="form-control form-control-sm" required="">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Phone Number <?php echo $req; ?></label>
                                                                                                <input readonly type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" value="<?php if (!empty($value->student_phone_no)) {
                                                                                                                                                                                                                        echo $value->student_phone_no;
                                                                                                                                                                                                                    } ?>" name="student_phone_no" class="form-control form-control-sm" required="">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Alternate Phone Number </label>
                                                                                                <input readonly type="tel" placeholder="without +91" value="<?php if (!empty($value->student_alt_phone_no)) {
                                                                                                                                                                echo $value->student_alt_phone_no;
                                                                                                                                                            } ?>" name="student_alt_phone_no" class="form-control form-control-sm">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Email-ID </label>
                                                                                                <input readonly type="email" oninput="CheckExistingMailId()" id="EmailId" value="<?php if (!empty($value->student_email_id)) {
                                                                                                                                                                                        echo $value->student_email_id;
                                                                                                                                                                                    } ?>" name="student_email_id" class="form-control form-control-sm">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Alternate Email-ID </label>
                                                                                                <input readonly type="email" value="<?php if (!empty($value->student_alt_email_id)) {
                                                                                                                                        echo $value->student_alt_email_id;
                                                                                                                                    } ?>" name="student_alt_email_id" class="form-control form-control-sm">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Date of Birth </label>
                                                                                                <input readonly type="date" value="<?php if (!empty($value->student_date_birth)) {
                                                                                                                                        echo $value->student_date_birth;
                                                                                                                                    } ?>" name="student_date_birth" class="form-control form-control-sm">
                                                                                            </div>
                                                                                            <div class='col-md-6 form-group'>
                                                                                                <label>Gender </label>
                                                                                                <select readonly disabled name="student_gender" class="form-control form-control-sm">
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
                                                                                                <select readonly disabled name="leadSource" class="form-control" id="leadSource" onchange="leadSources()">
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
                                                                                                    <input readonly type="text" name="refereeName" class="form-control form-control-sm" value="<?php if (!empty($value->refereeName)) {
                                                                                                                                                                                                    echo $value->refereeName;
                                                                                                                                                                                                } ?>">
                                                                                                </div>
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Referee Contact <?php echo $req; ?></label>
                                                                                                    <input readonly type="text" name="refereeContact" class="form-control form-control-sm" value="<?php if (!empty($value->refereeContact)) {
                                                                                                                                                                                                        echo $value->refereeContact;
                                                                                                                                                                                                    } ?>">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>BDE <?php echo $req; ?></label>
                                                                                                    <select readonly disabled name="stud_bde_name" class="form-control" id="selectBDEDetails">
                                                                                                        <option value="">choose lead BDE's</option>
                                                                                                        <?php $fetchBda = FETCH_DB_TABLE("SELECT * FROM bdes_primary_details", true);
                                                                                                        if (isset($fetchBda)) {
                                                                                                            foreach ($fetchBda as $val) {
                                                                                                                if ($value->bde_id == $val->bdes_id) {
                                                                                                                    $Selected = "selected";
                                                                                                                } else {
                                                                                                                    $Selected = "";
                                                                                                                }  ?>
                                                                                                                <option value="<?= $val->bdes_id ?>" <?= $Selected ?>><?= $val->bdes_first_name . "" . $val->bdes_last_name ?></option>
                                                                                                        <?php }
                                                                                                        } ?>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="col-md-12">
                                                                                                    <div class="accordion shadow-sm " id="accordionExample">
                                                                                                        <div class="card">
                                                                                                            <div class="card-header p-0" id="headingOne">
                                                                                                                <h2 class="mb-0">
                                                                                                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                                                                        <i class="bi bi-eye-fill text-info"></i> View BDE Details
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
                                                                                            <div class="col-md-6">
                                                                                                <label for="">BDE Points</label>
                                                                                                <input readonly type="text" class="form-control form-control-sm" name="BDEPoints" value="<?php if (!empty($value->BDEPoints)) {
                                                                                                                                                                                                echo $value->BDEPoints;
                                                                                                                                                                                            } ?>">
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
                                                                        <?php $fetchData = FETCH_DB_TABLE("SELECT * FROM students_primary_details AS spd INNER JOIN students_university_courses AS suc ON spd.student_id = suc.student_id INNER JOIN students_university_course_discount_details AS sucdd ON sucdd.student_id = spd.student_id WHERE spd.student_id='$StudentId'", true);
                                                                        if (isset($fetchData)) {
                                                                            foreach ($fetchData as $value) {
                                                                        ?>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-12 col-xs-12 col-sm-12 form-group">
                                                                                                <div class="form-group">
                                                                                                    <label>Select University</label><br>
                                                                                                    <select readonly name="university_id" class="form-control selectpicker " data-live-search="true" id="studUniversityName" style="width: 100%;" required="">
                                                                                                        <option>choose university</option>
                                                                                                        <?php $fetchUniversity = FETCH_DB_TABLE("SELECT university_id,university_name FROM universities_primary_details ", true);
                                                                                                        if (isset($fetchUniversity)) {
                                                                                                            foreach ($fetchUniversity as $val) {
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
                                                                                        <select class="form-control selectpicker " data-live-search="true" name="univ_session_year" id="UniversityCourseSessionYears" style="width: 100%;" required="">

                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-12 col-xs-12 col-sm-12">
                                                                                                <div class="form-group">
                                                                                                    <label>Select Couses</label>
                                                                                                    <select name="university_courses_id" class="form-control" id="studUniversityCourseName">
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 form-group">
                                                                                        <label>Course Specialization</label>
                                                                                        <select class="form-control selectpicker " data-live-search="true" name="course_specialization" id="UniversityCourseSpecialization" style="width: 100%;" required="">

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

                                                                                    <div class="col-md-6 form-group">
                                                                                        <label>Discount Type</label>
                                                                                        <select disabled name="discount_type" class="form-control" id="discountMode" onchange="showFeesModesField()">
                                                                                            <?php InputOptions(['choose discount type', 'Semester Wise Discount', 'Year Wise Discount', 'On Total Fee Discount',], $value->discount_type); ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-6 form-group">
                                                                                        <label>Discount Mode</label>
                                                                                        <select disabled name="discount_mode" class="form-control" id="DiscountType">
                                                                                            <?php InputOptions(['choose discount mode', 'Amount', 'Percentage'], $value->discount_mode); ?>
                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="col-md-12 form-group">
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-md-12">
                                                                                                <div class="accordion shadow-sm " id="accordionExample">
                                                                                                    <div class="card">
                                                                                                        <div class="card-header p-0" id="headingFour">
                                                                                                            <h2 class="mb-0">
                                                                                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                                                                                    <i class="bi bi-eye-fill text-info"></i> Discount Details
                                                                                                                </button>
                                                                                                            </h2>
                                                                                                        </div>

                                                                                                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                                                                                            <div class="card-body" id="UniversityCoursesDetails">
                                                                                                                <?php
                                                                                                                if ($value->discount_type == "Semester Wise Discount") {
                                                                                                                    $feeModeWise = explode(",", $value->discount_type_names);
                                                                                                                    $fees = explode(",", $value->discount_type_fees);
                                                                                                                } elseif ($value->discount_type == "Year Wise Discount") {
                                                                                                                    $feeModeWise = explode(",", $value->discount_type_names);
                                                                                                                    $fees = explode(",", $value->discount_type_fees);
                                                                                                                } else {
                                                                                                                    $feeModeWise = explode(",", $value->discount_type_names);
                                                                                                                    $fees = explode(",", $value->discount_type_fees);
                                                                                                                }
                                                                                                                echo '<h5 class="bold">' . '<span class="text-muted">' . "Fees Discount Details:-" . '</span></h5>' . "<br>";
                                                                                                                echo '<span class="text-muted">' . "Fees Discount Type:-" . ' </span>' . $value->discount_type  .  "<br>";
                                                                                                                echo '<span class="text-muted">' . "Fees Discount Mode:-" . ' </span>' .  $value->discount_mode . "<br>";
                                                                                                                foreach ($feeModeWise as $key => $feeModeVal) {
                                                                                                                    echo '<span class="text-muted">' . "Semester" . $feeModeVal . " => " . '</span>' . $fees[$key] . ",<br> ";
                                                                                                                }

                                                                                                                ?>
                                                                                                            </div>
                                                                                                        </div>
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
                                                                                                <input readonly type="date" value="<?php if (!empty($value->stud_dof_admission)) {
                                                                                                                                        echo $value->stud_dof_admission;
                                                                                                                                    } ?>" name="stud_dof_admission" class="form-control" min="1">
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Student Registration No</label>
                                                                                                <input readonly type="text" value="<?php if (!empty($value->stud_reg_no)) {
                                                                                                                                        echo $value->stud_reg_no;
                                                                                                                                    } ?>" name="stud_reg_no" class="form-control" min="1">
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Registration Status</label>
                                                                                                <select readonly disabled value="" name="stud_reg_status" class="form-control">
                                                                                                    <?php InputOptions(['Done', 'Pending'], $value->stud_reg_status)  ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Payment Mode</label>
                                                                                                <select readonly disabled name="stud_fee_payment_mode" class="form-control">
                                                                                                    <?php InputOptions(['Cash', 'Check', 'UPI', 'Debit card', 'Credit card', 'Internet Banking'], $value->stud_fee_payment_mode)  ?>

                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Payment Type</label>
                                                                                                <select readonly disabled name="stud_fee_payment_type" class="form-control">
                                                                                                    <?php InputOptions(['Registration Amount'], $value->stud_fee_payment_type) ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Inital Payment/Registration Amount</label>
                                                                                                <input readonly type="text" value="<?php if (!empty($value->stud_reg_amount)) {
                                                                                                                                        echo $value->stud_reg_amount;
                                                                                                                                    } ?>" name="stud_reg_amount" class="form-control" min="1">
                                                                                            </div>
                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Payment Date</label>
                                                                                                <input readonly type="date" value="<?php if (!empty($value->stud_payment_date)) {
                                                                                                                                        echo $value->stud_payment_date;
                                                                                                                                    } ?>" name="stud_payment_date" class="form-control" min="1">
                                                                                            </div>

                                                                                            <div class="col-md-6 form-group">
                                                                                                <label>Notes/Remarks</label>
                                                                                                <input readonly type="text" value="<?php if (!empty($value->stud_reg_note)) {
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



                                                                <div class="col-md-12">
                                                                    <div class="card-header">
                                                                        Student Fees Tnx Details
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12 shadow p-3 mb-5 bg-white rounded">
                                                                                <table class="table table-sm">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th scope="col">S.No</th>
                                                                                            <th scope="col">FeeMode</th>
                                                                                            <th scope="col">Sem/Year</th>
                                                                                            <th scope="col">Fee</th>
                                                                                            <th scope="col">DiscountAmount</th>
                                                                                            <th scope="col">PaymentMethod</th>
                                                                                            <th scope="col">PaymentDate</th>
                                                                                            <th scope="col">PaymentStatus</th>
                                                                                            <th scope="col">TxnType</th>
                                                                                            <th scope="col">Note</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <?php
                                                                                        $fetchTxnDetails = FETCH_DB_TABLE("SELECT * FROM student_fee_txns WHERE student_id='$StudentId' ORDER BY stud_fee_txns_id DESC", true);
                                                                                        if (!empty($fetchTxnDetails)) {
                                                                                            $SNo = 0;
                                                                                            foreach ($fetchTxnDetails as $key => $value) {
                                                                                                $SNo++;
                                                                                                if ($value->discount_amount == "null") {
                                                                                                    $DiscountAmount = 0;
                                                                                                } else {
                                                                                                    $DiscountAmount = $value->discount_amount;
                                                                                                }
                                                                                                foreach (NumberPostWords() as $keys => $data) {
                                                                                                    if ($keys == $value->fee_mode_name) {
                                                                                                        $NumberPostWords = $data;
                                                                                                    } else {
                                                                                                        $NumberPostWords = "";
                                                                                                    }
                                                                                                }
                                                                                                if ($value->fee_mode == "Semesters Wise") {
                                                                                                    $feesMode = $NumberPostWords . " " . "Sem";
                                                                                                } elseif ($value->fee_mode == "Years Wise") {
                                                                                                    $feesMode = $NumberPostWords . " " . "Year";
                                                                                                } elseif ($value->fee_mode == "One Time") {
                                                                                                    $feesMode = $NumberPostWords . " ";
                                                                                                } elseif ($value->fee_mode == "Registration Fee") {
                                                                                                    $feesMode =  "";
                                                                                                }

                                                                                        ?>
                                                                                                <tr>
                                                                                                    <th scope="row"><?= $SNo ?></th>
                                                                                                    <td><?= $value->fee_mode  ?></td>
                                                                                                    <td><?= $value->fee_mode_name . "" . $feesMode ?></td>
                                                                                                    <td><?= $value->feePayment ?></td>
                                                                                                    <td><?= $DiscountAmount ?></td>

                                                                                                    <td><?= $value->payment_method ?></td>
                                                                                                    <td><?= $value->transaction_date_time ?></td>
                                                                                                    <td><?= $value->payment_status ?></td>
                                                                                                    <td><?= $value->transaction_type ?></td>
                                                                                                    <td><?= $value->description ?></td>
                                                                                                </tr>
                                                                                        <?php

                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-12 d-flex justify-content-between btn">
                                                            <a href="index.php" class="btn btn-sm btn-default ">Back</a>
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
        //Fetch University Courses
        $(window).on("load", function(e) {
            setTimeout(function() {
                let universitySessionId = $("#UniversityCourseSessionYears").val();
                let studUniversityId = $("#studUniversityName").val();
                var studentId = <?= $StudentId ?>;
                $.ajax({
                    type: "post",
                    url: "<?= CONTROLLER ?>/StudentAjaxController.php",
                    data: {
                        studentId: studentId,
                        universitySessionId: universitySessionId,
                        studUniversityId: studUniversityId,
                        studUnversitySessionYearBtnView: "submit",
                    },
                    success: function(response) {
                        $("#studUniversityCourseName").html(response);
                    }
                });
            }, 300);
        });
        //Fetch University Courses Specilization
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
        //Fetch University Courses Details //
        $(window).on("load", function(e) {
            e.preventDefault();
            setTimeout(function() {
                let UniversityCourseSpecName = $("#UniversityCourseSpecialization").val();
                var StudentId = <?= $StudentId ?>;
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
            }, 1000);
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
    </script>
</body>

</html>