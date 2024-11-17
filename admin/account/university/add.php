<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';

//pagevariables
$PageName                   = "University";
$PageDescription            = "Manage all domains";
$btntext                    = "Add New Leads";
$DomainExpireInCurrentMonth = date("Y-m-d", strtotime("+1 month"));

if (isset($_GET['type'])) {
    $type             = $_GET['type'];
    $from             = $_GET['from'];
    $to               = $_GET['to'];
    $by               = $_GET['by'];
    $level            = $_GET['level'];
    $LeadPersonSource = $_GET['LeadPersonSource'];
} else {
    $type             = "";
    $from             = date("Y-m-d");
    $to               = date("Y-m-d");
    $by               = "1";
    $level            = "";
    $LeadPersonSource = "";
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
        <?php include $Dir . "/include/admin/loader.php";
        include $Dir . "/include/admin/header.php";
        include $Dir . "/include/admin/sidebar.php";
        ?>
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
                                        <div class="col-sm-12 col-12 ">
                                            <h3 class="app-heading">Add <?php echo $PageName; ?></h3>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <section class="section account-dashboard">
                                                <div class="col-md-12">
                                                    <div class="card student-card mx-auto" id="universityDetails">
                                                        <div class="tab">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="card-header custom-card-header">
                                                                        University Primary Details
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card-header custom-card-header">
                                                                        University Billing Details
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card-body">
                                                                <form id="universityForm" action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">

                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md-6 form-group">
                                                                                    <label>University Name <?php echo $req; ?></label>
                                                                                    <input type="text" name="university_name" class="form-control" required="" placeholder="University of Allahabad">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Phone Number <?php echo $req; ?></label>
                                                                                    <input type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" name="university_phone_no" class="form-control" required="">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Email-ID <?php echo $req; ?></label>
                                                                                    <input type="email" oninput="CheckExistingMailId()" id="EmailId" name="university_email_id" class="form-control" required placeholder="university@gmail.com">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Billing Email-ID <?php echo $req; ?></label>
                                                                                    <input type="email" id="EmailId" name="university_email_id" class="form-control" required placeholder="university@gmail.com">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Billing GST No</label>
                                                                                    <input type="text" name="university_gst" class="form-control" placeholder="18AABCU9603R1ZM">
                                                                                </div>
                                                                                <div class="col-md-12 form-group">
                                                                                    <label>Address </label>
                                                                                    <textarea name="univ_reg_address" class="form-control"></textarea>
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Sector/Area Locality </label>
                                                                                    <input type="text" name="univ_reg_sector" class="form-control">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Landmark </label>
                                                                                    <input type="text" name="univ_reg_landmark" class="form-control">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>City <?php echo $req; ?></label>
                                                                                    <input type="text" name="univ_reg_city" class="form-control" required="">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>State <?php echo $req; ?></label>
                                                                                    <input type="text" name="univ_reg_state" class="form-control" required="">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Country <?php echo $req; ?></label>
                                                                                    <select name="univ_reg_country" class="form-control" required="">
                                                                                        <?php
                                                                                        $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("COUNTRY"), true);
                                                                                        if ($LeadSource != null) {
                                                                                            foreach ($LeadSource as $Source) {
                                                                                        ?>
                                                                                                <option value="<?php echo $Source->ConfigValueDetails; ?>"><?php echo $Source->ConfigValueDetails; ?></option>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Pincode </label>
                                                                                    <input type="text" name="univ_reg_pincode" class="form-control">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 d-flex justify-content-between btn">
                                                                            <a href="index.php" class="btn btn-sm btn-default cancel">Cancel</a>
                                                                            <button type="button" onclick="saveUniversityDetails()" name="SaveUniversityInfo" value="SaveUniversityPrimary&AddressData" class="btn btn-sm btn-success next">Save & Next</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card student-card mx-auto" id="courseDetails" style="display: none;">
                                                        <div class="tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-header custom-card-header">
                                                                        Add University Courses Details
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <form id="universityCoursesForm" action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">
                                                                    <?php FormPrimaryInputs(true, [
                                                                        "UniversityBtn" => "SaveUniversityData",
                                                                    ]); ?>
                                                                    <div class="row">

                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class='col-md-4 form-group'>
                                                                                    <label>Course Session Year <?php echo $req; ?></label>
                                                                                    <input type="hidden" name="universityId" value="" readonly>
                                                                                    <input type="text" name="course_session_year" class="form-control form-control-sm" required="" placeholder="Session Year(July,2023)">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row" id="addMoreCourses" style="width: 100%;">
                                                                                <div class="col-md-3 form-group">
                                                                                    <label>Course Name <?php echo $req; ?></label>
                                                                                    <input type="text" name="course_name[]" class="form-control form-control-sm" required="" placeholder="B.tech">
                                                                                </div>

                                                                                <div class='col-md-3 form-group'>
                                                                                    <label>Course Type <?php echo $req; ?></label>
                                                                                    <select name="course_type[]" class="form-control form-control-sm" required="">
                                                                                        <?php
                                                                                        $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("COURSE_TYPE"), true);
                                                                                        if ($LeadSource != null) {
                                                                                            foreach ($LeadSource as $Source) {
                                                                                        ?>
                                                                                                <option value="<?php echo $Source->ConfigValueDetails; ?>"><?php echo $Source->ConfigValueDetails; ?></option>
                                                                                        <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>

                                                                                <div class='col-md-2 form-group'>
                                                                                    <label>Total Semester <?php echo $req; ?></label>
                                                                                    <input type="number" name="course_total_semester[]" class="form-control form-control-sm" required="" placeholder="8">
                                                                                </div>
                                                                                <div class='col-md-2 form-group'>
                                                                                    <label>Total Years <?php echo $req; ?></label>
                                                                                    <input type="number" name="course_total_years[]" class="form-control form-control-sm" required="" placeholder="4">
                                                                                </div>
                                                                                <div class='col-md-2 form-group'>
                                                                                    <label></label>
                                                                                    <button type="button" class="btn btn-info mt-3 add_courses_btn"><i class="bi bi-plus-lg"></i></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 d-flex justify-content-between btn">
                                                                            <button type="button" onclick="saveCoursesDetails()" name="SaveUniversityCourses" value="SaveUniversityCoursesData" class="btn btn-sm btn-success next">Save & Next</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card student-card mx-auto" id="courseSpecilizationDetails" style="display:none;">
                                                        <div class="tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-header custom-card-header">
                                                                        Add University Courses Specilization Details
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <form id="universityCourseSpeclizationForm" action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">
                                                                    <?php FormPrimaryInputs(true, [
                                                                        "UniversityBtn" => "SaveUniversityData",
                                                                    ]); ?>
                                                                    <input type="hidden" name="universityIdForSpec" id="universityIdForSpecId" readonly>
                                                                    <input type="hidden" name="universityCourseSessionId" readonly>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="row ">
                                                                                <div class='col-md-3 form-group'>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <label>Course Name <?php echo $req; ?></label><br>
                                                                                            <select name="courseName" id="courseName" class="form-control form-control-sm" required>

                                                                                            </select>

                                                                                            <div class="p-2 mt-3 shadow-sm" id="showCourseSpec">

                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class='col-md-9'>
                                                                                    <div class="row" id="addMoreSpecialization">
                                                                                        <!-- Your existing specialization fields -->
                                                                                        <div class="col-md-6 specialization-container">
                                                                                            <div class="row">
                                                                                                <div class="col-md-10 form-group">
                                                                                                    <label>Course Specialization <?php echo $req; ?></label><br>
                                                                                                    <input type="text" name="specialization[]" class="form-control form-control-sm" required>
                                                                                                </div>
                                                                                                <div class="col-md-1 form-group">
                                                                                                    <label></label>
                                                                                                    <button class="btn btn-outline-info add_specialization_btn "><i class="bi bi-plus"></i></button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 d-flex justify-content-between btn">
                                                                            <button type="button" onclick="saveCoursesSpecilizationDetails()" name="saveCoursesSpecilizationData" value="SaveUniversityCoursesSpecilizationData" class="btn btn-sm btn-success next">Save & Add More</button>
                                                                            <button type="button" onclick="saveCoursesSpecilizationDetailsNext()" name="saveCoursesSpecilizationDataNext" value="SaveUniversityCoursesSpecilizationDataNext" class="btn btn-sm btn-success next">Save & Next</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card student-card mx-auto" id="courseSpecilizationTuitionFeesDetails" style="display:none;">
                                                        <div class="tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-header custom-card-header">
                                                                        Add Courses Fees
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <form id="universityCourseSpeclizationTuitionFeesForm" action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">
                                                                    <?php FormPrimaryInputs(true, [
                                                                        "UniversityBtn" => "SaveUniversityData",
                                                                    ]); ?>
                                                                    <input type="hidden" name="universityIdForSpecTut" id="universityIdForSpecIdTut" readonly>
                                                                    <input type="hidden" name="universityCourseSessionIdTut" readonly>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="row ">
                                                                                <div class='col-md-5 form-group'>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <label>Course Name <?php echo $req; ?></label><br>
                                                                                            <select name="courseNameSpecTut" id="showCourseSpecTution" class="form-control form-control-sm" required>

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Course Specialization <?php echo $req; ?></label><br>
                                                                                    <select name="specializationNameTut" id="coursespectut" class="form-control form-control-sm" required>

                                                                                    </select>
                                                                                    <div class="p-2 mt-3 shadow-sm" id="showCourseSpec">

                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="row w-100 ">
                                                                                        <div class='col-md-10'>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Fees Modes <?php echo $req; ?></label>
                                                                                                    <select name="tuition_fees_semester_mode" id="TuitionFeesSemester" class="form-control form-control-sm" onchange="showTuitionFeesSemesterFields()" required="">
                                                                                                        <option value="">Choose Fees Modes</option>
                                                                                                        <option value="Semesters Wise" selected>Semesters Wise</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class='col-md-12 form-group' id="TuitionFeesSemestersFees" style="display: block !important;">

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="row w-100 ">
                                                                                        <div class='col-md-10'>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Fees Modes <?php echo $req; ?></label>
                                                                                                    <select name="tuition_fees_year_mode" id="TuitionFeesYear" class="form-control form-control-sm" onchange="showTuitionFeesYearFields()" required="">
                                                                                                        <option value="">Choose Fees Modes</option>
                                                                                                        <option value="Years Wise" selected>Years Wise</option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class='col-md-12 form-group ' id="TuitionYearsFees" style="display: block !important;">

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <div class="row w-100 ">
                                                                                        <div class='col-md-10'>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Fees Modes <?php echo $req; ?></label>
                                                                                                    <select name="tuition_fees_oneTime_mode" id="TuitionFeesOneTime" class="form-control form-control-sm" onchange="showTuitionFeesOneTimeFields()" required="">
                                                                                                        <option value="">Choose Fees Modes</option>
                                                                                                        <option value="One Time" selected>One Time</option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class='col-md-12 form-group ' id="TuitionOneTimeFees" style="display: block !important;">

                                                                                                </div>
                                                                                                <div class="col-md-12 p-2 mt-3 shadow-sm" id="showCourseOtherSpec">

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 d-flex justify-content-between btn">
                                                                            <button type="button" onclick="saveCoursesSpecilizationTuitionFeesDetails()" name="saveCoursesSpecilizationData" value="SaveUniversityCoursesSpecilizationData" class="btn btn-sm btn-success next">Save & Add More</button>
                                                                            <button type="button" onclick="saveCoursesSpecilizationTuitionFeesDetailsNext()" name="saveCoursesSpecilizationDataNext" value="complete" class="btn btn-sm btn-success next">Save & Next</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card student-card mx-auto" id="courseSpecilizationCustomFeesDetails" style="display:none;">
                                                        <div class="tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-header custom-card-header">
                                                                        Add Courses Tuition fees
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <form id="universityCourseSpeclizationCustomFeesForm" action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">
                                                                    <?php FormPrimaryInputs(true, [
                                                                        "UniversityBtn" => "SaveUniversityData",
                                                                    ]); ?>
                                                                    <input type="hidden" name="universityIdForSpecCustom" id="universityIdForSpecIdCustom" readonly>
                                                                    <input type="hidden" name="universityCourseSessionIdCustom" readonly>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="row ">
                                                                                <div class='col-md-5 form-group'>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <label>Course Name <?php echo $req; ?></label><br>
                                                                                            <select name="customCourseName" id="customCourseName" class="form-control form-control-sm" required>

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Course Specialization <?php echo $req; ?></label><br>
                                                                                    <select name="customSpecilization" id="showCustomSpecilization" class="form-control form-control-sm" required>

                                                                                    </select>
                                                                                    <div class="p-2 mt-3 shadow-sm" id="showCustomCourseSpec">

                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-4">
                                                                                    <div class="row w-100 ">
                                                                                        <div class='col-md-10'>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Fees Modes <?php echo $req; ?></label>
                                                                                                    <select name="custom_fees_semester_mode" id="CustomFeesSemester" class="form-control form-control-sm" onchange="showCustomFeesSemesterFields()" required="">
                                                                                                        <option value="">Choose Fees Modes</option>
                                                                                                        <option value="Semesters Wise" selected>Semesters Wise</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class='col-md-12 form-group' id="CustomFeesSemestersFees" style="display: block !important;">


                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="row w-100 ">
                                                                                        <div class='col-md-10'>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Fees Modes <?php echo $req; ?></label>
                                                                                                    <select name="custom_fees_year_mode" id="CustomFeesYear" class="form-control form-control-sm" onchange="showCustomFeesYearFields()" required="">
                                                                                                        <option value="">Choose Fees Modes</option>
                                                                                                        <option value="Years Wise" selected>Years Wise</option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class='col-md-12 form-group ' id="CustomYearsFees" style="display: block !important;">

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <div class="row w-100 ">
                                                                                        <div class='col-md-10'>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 form-group">
                                                                                                    <label>Fees Modes <?php echo $req; ?></label>
                                                                                                    <select name="custom_one_time_fees_mode" id="CustomFeesOneTime" class="form-control form-control-sm" onchange="showCustomFeesOneTimeFields()" required="">
                                                                                                        <option value="">Choose Fees Modes</option>
                                                                                                        <option value="One Time" selected>One Time</option>
                                                                                                    </select>
                                                                                                </div>

                                                                                                <div class='col-md-12 form-group ' id="CustomOneTimeFees" style="display: block !important;">

                                                                                                </div>
                                                                                                <div class="col-md-12 p-2 mt-3 shadow-sm" id="showCustomOtherCourseSpec">

                                                                                                </div>

                                                                                            </div>

                                                                                        </div>

                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 d-flex justify-content-between btn">
                                                                            <button type="button" onclick="saveCoursesSpecilizationCustomFeeDetails()" name="saveCoursesSpecilizationData" value="SaveUniversityCoursesSpecilizationData" class="btn btn-sm btn-success next">Save & Add More</button>
                                                                            <button type="button" onclick="saveCoursesSpecilizationCustomFeeDetailsComplete()" name="completeSaveProcess" value="complete" class="btn btn-sm btn-success next">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
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
        include $Dir . "//include/sections/Add-New-University.php";
        include $Dir . "/include/admin/footer.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </div>
    <?php include $Dir . "/include/admin/footer_files.php"; ?>
    <!-- Tutition Fees -->
    <script>
        // Show Semester Fee Fields
        const showTuitionFeesSemesterFields = () => {
            var semesterSelect = document.getElementById("TuitionFeesSemester");
            var selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
            var semesterDiv = document.getElementById("TuitionFeesSemestersFees");
            var courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
            if (selectedSemesterOption === "Semesters Wise") {
                semesterDiv.style.display = "block";
            } else {
                semesterDiv.style.cssText = "display: none !important;";
            }
        };

        $(document).ready(function() {
            $(document).on('click', '.add_tution_semester_fee_btn', function(e) {
                e.preventDefault();
                // Find the parent container of the button
                let parentContainer = $(this).closest(".row");

                // Create the new field HTML
                let newField = `<div class="row m-0">
            <div class="col-md-10 form-group d-flex">
                <div class="w-50">
                    <label>Semester Name <?php echo $req; ?></label>
                    <select name="tuition_fees_semester_name[]" class="form-control form-control-sm" required>
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
                <div class="w-50" style="padding-left: 5px;">
                    <label>Semester Fee <?php echo $req; ?></label>
                    <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" required>
                </div>
            </div>
            <div class="col-md-2 form-group">
                <label></label>
                <button class="btn btn-outline-danger remove_tution_semester_fee_btn"><i class="bi bi-trash3-fill"></i></button>
            </div>
        </div>`;

                // Insert the new field after the parent container
                $(parentContainer).after(newField);
            });

            $(document).on('click', '.remove_tution_semester_fee_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).closest(".row");
                $(row_item).remove();
            });
        });
    </script>
    <script>
        // Show Semester Fee Fields
        const showTuitionFeesYearFields = () => {
            const semesterSelect = document.getElementById("TuitionFeesYear");
            const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
            const yearsFeesDiv = document.getElementById("TuitionYearsFees");
            const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
            if (selectedSemesterOption === "Years Wise") {
                yearsFeesDiv.style.display = "block";
            } else {
                yearsFeesDiv.style.cssText = "display: none !important;";
            }
        };
        $(document).ready(function() {
            $(document).on('click', '.add_tution_year_fee_btn', function(e) {
                e.preventDefault();
                // Find the parent container of the button
                let parentContainer = $(this).closest(".row");

                // Create the new field HTML
                let newField = `<div class="row m-0">
            <div class="col-md-10 form-group d-flex">
                <div class="w-50">
                    <label>Year Name <?php echo $req; ?></label>
                    <select name="tuition_course_years_name[]" class="form-control form-control-sm" required>
                        <option value="">choose year</option>
                        <option value="1">First Years</option>
                        <option value="2">Second Years</option>
                        <option value="3">Third Years</option>
                        <option value="4">Fourth Years</option>
                        <option value="5">Fifth Years</option>
                    </select>
                </div>
                <div class="w-50" style="padding-left: 5px;">
                    <label>Year Fee <?php echo $req; ?></label>
                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm"  required>
                </div>
            </div>
            <div class="col-md-2 form-group">
                <label></label>
                <button class="btn btn-outline-danger remove_tution_year_fee_btn"><i class="bi bi-trash3-fill"></i></button>
            </div>
        </div>`;

                // Insert the new field after the parent container
                $(parentContainer).after(newField);
            });

            $(document).on('click', '.remove_tution_year_fee_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).closest(".row");
                $(row_item).remove();
            });
        });
    </script>
    <script>
        // Show Semester Fee Fields
        const showTuitionFeesOneTimeFields = () => {
            const semesterSelect = document.getElementById("TuitionFeesOneTime");
            const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
            const oneTimeFeesDiv = document.getElementById("TuitionOneTimeFees");
            const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");

            if (selectedSemesterOption === "One Time") {
                oneTimeFeesDiv.style.display = "block";
            } else {
                oneTimeFeesDiv.style.cssText = "display: none !important;";
            }
        };
    </script>
    <!-- Tutition Fees -->
    <!-- Specilization Fees -->
    <script>
        // Show Semester Fee Fields
        const showCustomFeesSemesterFields = () => {
            var semesterSelect = document.getElementById("CustomFeesSemester");
            var selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
            var semesterDiv = document.getElementById("CustomFeesSemestersFees");
            var courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
            if (selectedSemesterOption === "Semesters Wise") {
                semesterDiv.style.display = "block";
            } else {
                semesterDiv.style.cssText = "display: none !important;";
            }
        };
        //Add Multiple Semester
        $(document).ready(function() {
            $(document).on('click', '.add_custom_semester_fee_btn', function(e) {
                e.preventDefault();
                // Find the parent container of the button
                let parentContainer = $(this).closest(".row");

                // Create the new field HTML
                let newField = `<div class="row m-0">
            <div class="col-md-10 form-group d-flex">
                <div class="w-50">
                    <label>Semester Name <?php echo $req; ?></label>
                    <select name="custom_fees_semester_name[]" class="form-control form-control-sm" required>
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
                <div class="w-50" style="padding-left: 5px;">
                    <label>Semester Fee <?php echo $req; ?></label>
                    <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm"  required>
                </div>
            </div>
            <div class="col-md-2 form-group">
                <label></label>
                <button class="btn btn-outline-danger remove_custom_semester_fee_btn"><i class="bi bi-trash3-fill"></i></button>
            </div>
        </div>`;

                // Insert the new field after the parent container
                $(parentContainer).after(newField);
            });

            $(document).on('click', '.remove_custom_semester_fee_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).closest(".row");
                $(row_item).remove();
            });
        });
    </script>
    <script>
        // Show Semester Fee Fields
        const showCustomFeesYearFields = () => {
            const semesterSelect = document.getElementById("CustomFeesYear");
            const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
            const yearsFeesDiv = document.getElementById("CustomYearsFees");
            const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
            if (selectedSemesterOption === "Years Wise") {
                yearsFeesDiv.style.display = "block";
            } else {
                yearsFeesDiv.style.cssText = "display: none !important;";
            }
        };
        //Add Multiple Semester
        $(document).ready(function() {
            // Add Multiple Years
            $(".add_custom_year_fee_btn").on("click", function(e) {
                e.preventDefault();
                // Find the parent container of the button
                let parentContainer = $(this).closest(".row");

                // Create the new field HTML
                let newField = `<div class="row m-0">
            <div class="col-md-10 form-group d-flex">
                <div class="w-50">
                    <label>Year Name <?php echo $req; ?></label>
                    <select name="custom_course_years_name[]" class="form-control form-control-sm" required>
                        <option value="">choose year</option>
                        <option value="1">First Years</option>
                        <option value="2">Second Years</option>
                        <option value="3">Third Years</option>
                        <option value="4">Fourth Years</option>
                        <option value="5">Fifth Years</option>
                    </select>
                </div>
                <div class="w-50" style="padding-left: 5px;">
                    <label>Year Fee <?php echo $req; ?></label>
                    <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm"  required>
                </div>
            </div>
            <div class="col-md-2 form-group">
                <label></label>
                <button class="btn btn-outline-danger remove_custom_year_fee_btn"><i class="bi bi-trash3-fill"></i></button>
            </div>
        </div>`;

                // Insert the new field after the parent container
                $(parentContainer).after(newField);
            });

            $(document).on('click', '.remove_custom_year_fee_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).closest(".row");
                $(row_item).remove();
            });
        });
    </script>
    <script>
        // Show Semester Fee Fields
        const showCustomFeesOneTimeFields = () => {
            const semesterSelect = document.getElementById("CustomFeesOneTime");
            const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
            const oneTimeFeesDiv = document.getElementById("CustomOneTimeFees");
            const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");

            if (selectedSemesterOption === "One Time") {
                oneTimeFeesDiv.style.display = "block";
            } else {
                oneTimeFeesDiv.style.cssText = "display: none !important;";
            }
        };
    </script>
    <!-- Specilization Fees -->
    //Add More Courses In University
    <script>
        $(".add_courses_btn").on("click", function(e) {
            e.preventDefault();
            $("#addMoreCourses").append(`
        <div class="row ml-1" id="addMoreCourses" style="width: 100%;">
        <div class="col-md-3 form-group">
            <label>Course Name <?php echo $req; ?></label>
            <input type="text" name="course_name[]" class="form-control form-control-sm" required="" placeholder="B.tech">
        </div>

        <div class='col-md-3 form-group'>
            <label>Course Type <?php echo $req; ?></label>
            <select name="course_type[]" class="form-control form-control-sm" required="">
                <?php
                $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("COURSE_TYPE"), true);
                if ($LeadSource != null) {
                    foreach ($LeadSource as $Source) {
                ?>
                        <option value="<?php echo $Source->ConfigValueDetails; ?>"><?php echo $Source->ConfigValueDetails; ?></option>
                <?php
                    }
                }
                ?>
            </select>

        </div>

        <div class='col-md-2 form-group'>
            <label>Total Semester <?php echo $req; ?></label>
            <input type="number" name="course_total_semester[]" class="form-control form-control-sm" required="" placeholder="8">
        </div>
        <div class='col-md-2 form-group'>
            <label>Total Years <?php echo $req; ?></label>
            <input type="number" name="course_total_years[]" class="form-control form-control-sm" required="" placeholder="4">
        </div>
        <div class='col-md-2 form-group'>
            <label></label>
            <button type="button" class="btn btn-danger remove_courses_btn mt-3" ><i class="bi bi-trash3-fill"></i></button>
        </div>
        </div>`);

        });
        $(document).on('click', '.remove_courses_btn', function(e) {
            e.preventDefault();
            let rowItem = $(this).parent().parent();
            $(rowItem).remove();
        })
    </script>
    //Add more courses Specilization
    <script>
        $(document).on('click', '.add_specialization_btn', function(e) {
            e.preventDefault();
            // Add a new specialization field in the second column of the existing row
            var newSpecialization = `
            <div class="col-md-6 specialization-container">
                <div class="row">
                    <div class="col-md-10 form-group">
                        <label>Course Specialization <?php echo $req; ?></label><br>
                        <input type="text" name="specialization[]" class="form-control form-control-sm" required>
                    </div>
                    <div class="col-md-1 form-group">
                        <label></label>
                        <button class="btn btn-outline-danger remove_specialization_btn"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            </div>
        `;
            $("#addMoreSpecialization").append(newSpecialization);
        });

        $(document).on('click', '.remove_specialization_btn', function(e) {
            e.preventDefault();
            $(this).closest('.specialization-container').remove();
        });
    </script>

    //Save Unversity Primary Info Details
    <script>
        //Save University Details
        function saveUniversityDetails() {
            var universityForm = $('#universityForm');
            var submitButton = universityForm.find('button[name="SaveUniversityInfo"]');

            if (universityForm[0].checkValidity()) {
                // Disable the submit button to prevent multiple submissions
                submitButton.prop('disabled', true);

                var formData = universityForm.serializeArray();
                // Add the button value to the form data
                formData.push({
                    name: 'SaveUniversityInfo',
                    value: 'SaveUniversityPrimary&AddressData'
                });
                var jsonData = {};

                $.each(formData, function(index, field) {
                    jsonData[field.name] = field.value;
                });

                $.ajax({
                    type: 'POST',
                    url: universityForm.attr('action'),
                    data: JSON.stringify(jsonData),
                    contentType: 'application/json',
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        if (responseData.status === "Success") {
                            var universityId = responseData.universityId;
                            Swal.fire(
                                '',
                                'University Primary & Billing Address Successfully Saved',
                                'success'
                            )
                            // Set the university ID in the hidden input field
                            $('input[name="universityId"]').val(universityId);
                            $('#universityDetails').hide();
                            $('#courseDetails').show();

                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later',
                            })
                            // Re-enable the submit button in case of error
                            submitButton.prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving university details:', error);
                        // Re-enable the submit button in case of error
                        submitButton.prop('disabled', false);
                    }
                });
            } else {
                universityForm[0].reportValidity();
            }
        }
    </script>
    //Save University Courses Details
    <script>
        function saveCoursesDetails() {
            var universityCoursesForm = $('#universityCoursesForm');
            var submitButton = universityCoursesForm.find('button[name="SaveUniversityCourses"]');
            if (universityCoursesForm[0].checkValidity()) {
                // Disable the submit button to prevent multiple submissions
                submitButton.prop('disabled', true);
                var courseData = {
                    universityId: $("input[name='universityId']").val(),
                    course_session_year: $("input[name='course_session_year']").val(),
                    course_name: $("input[name='course_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    course_type: $("select[name='course_type[]']").map(function() {
                        return this.value;
                    }).get(),
                    course_total_semester: $("input[name='course_total_semester[]']").map(function() {
                        return this.value;
                    }).get(),
                    course_total_years: $("input[name='course_total_years[]']").map(function() {
                        return this.value;
                    }).get()
                };
                // Add the button name and value to the courseData object
                courseData.SaveUniversityCourses = "SaveUniversityCoursesData";
                $.ajax({
                    url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
                    type: "POST",
                    data: JSON.stringify(courseData),
                    contentType: "application/json",
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        if (responseData.status === "Success") {
                            var universityIdForSpec = responseData.universityId;
                            var universityCourseSessionId = responseData.universityCourseSessionId;
                            Swal.fire(
                                '',
                                'University Courses Successfully Saved',
                                'success'
                            )
                            // Set the university ID in the hidden input field

                            $('input[name="universityIdForSpec"]').val(universityIdForSpec);
                            $('input[name="universityCourseSessionId"]').val(universityCourseSessionId);
                            $('#universityDetails').hide();
                            $('#courseDetails').hide();
                            $('#courseSpecilizationDetails').show();
                            // Fetch and populate saved university courses
                            fetchUniversityCourses(universityIdForSpec, universityCourseSessionId);
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later',
                            })
                            // Re-enable the submit button in case of error
                            submitButton.prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving university details:', error);
                        // Re-enable the submit button in case of error
                        submitButton.prop('disabled', false);
                    }
                });
            } else {
                universityCoursesForm[0].reportValidity();
            }
        }
    </script>
    //Fetch University Saved Courses
    <script>
        function fetchUniversityCourses(universityIdForSpec, universityCourseSessionId) {
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpec,
                    universityCourseSessionId: universityCourseSessionId,
                    fetchCourse: "fetchUniversityCourses"
                },
                success: function(response) {
                    var courses = JSON.parse(response);

                    var selectElement = $("#courseName");
                    selectElement.empty();
                    selectElement.append('<option value="">choose courses</option>');
                    if (courses.length > 0) {
                        courses.forEach(function(course) {
                            selectElement.append('<option value="' + course.univ_course_id + '">' + course.univ_course_name + '</option>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        }
    </script>
    <script>
        //Show Course Speclization
        $("#courseName").on("change", function(e) {
            e.preventDefault();
            var UniversityId = $("#universityIdForSpecId").val();
            var courseId = $(this).val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    courseId: courseId,
                    UniversityId: UniversityId,
                    fetchCourseBtn: "ShowCourseSpec"
                },
                success: function(response) {
                    $("#showCourseSpec").html(response);
                },
            });
        })
    </script>
    //Save University Courses Multiple Specilization
    <script>
        function saveCoursesSpecilizationDetails() {
            var universityCourseSpeclizationForm = $('#universityCourseSpeclizationForm');
            var submitButton = universityCourseSpeclizationForm.find('button[name="saveCoursesSpecilizationData"]');

            if (universityCourseSpeclizationForm[0].checkValidity()) {
                // Disable the submit button to prevent multiple submissions
                var courseSpecilizationData = {
                    universityId: $("input[name='universityIdForSpec']").val(),
                    universityCourseSessionId: $("input[name='universityCourseSessionId']").val(),
                    courseName: $("select[name='courseName']").val(),
                    specialization: $("input[name='specialization[]']").map(function() {
                        return this.value;
                    }).get(),

                };
                // Add the button name and value to the courseSpecilizationData object
                courseSpecilizationData.saveCoursesSpecilizationData = "SaveUniversityCoursesSpecilizationData";
                $.ajax({
                    url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
                    type: "POST",
                    data: JSON.stringify(courseSpecilizationData),
                    contentType: "application/json",
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        if (responseData.status === "Success") {
                            var universityIdForSpec = responseData.universityId;
                            var universityCourseSessionId = responseData.universityCourseSessionId;
                            Swal.fire(
                                '',
                                'Specilization And Fees Successfully Saved',
                                'success'
                            )
                            // Set the university ID in the hidden input field

                            $('input[name="universityIdForSpec"]').val(universityIdForSpec);
                            $('input[name="universityCourseSessionId"]').val(universityCourseSessionId);
                            $('#universityDetails').hide();
                            $('#courseDetails').hide();
                            $('#courseSpecilizationDetails').show();
                            // Fetch and populate saved university courses
                            fetchUniversityCourses(universityIdForSpec, universityCourseSessionId);
                            // Reset the form
                            $('#universityCourseSpeclizationForm')[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later',
                            })
                            // Re-enable the submit button in case of error
                            submitButton.prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving university details:', error);
                        // Re-enable the submit button in case of error
                        submitButton.prop('disabled', false);
                    }
                });
            } else {
                universityCourseSpeclizationForm[0].reportValidity();
            }
        }
    </script>
    //Save University Courses Multiple Specilization And Move Next Step
    <script>
        function saveCoursesSpecilizationDetailsNext() {
            var universityCourseSpeclizationForm = $('#universityCourseSpeclizationForm');
            var submitButton = universityCourseSpeclizationForm.find('button[name="saveCoursesSpecilizationDataNext"]');

            if (universityCourseSpeclizationForm[0].checkValidity()) {
                var courseSpecilizationData = {
                    universityId: $("input[name='universityIdForSpec']").val(),
                    universityCourseSessionId: $("input[name='universityCourseSessionId']").val(),
                    courseName: $("select[name='courseName']").val(),
                    specialization: $("input[name='specialization[]']").map(function() {
                        return this.value;
                    }).get(),

                };
                // Add the button name and value to the courseSpecilizationData object
                courseSpecilizationData.saveCoursesSpecilizationDetailsNext = "saveCoursesSpecilizationDetailsNext";
                $.ajax({
                    url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
                    type: "POST",
                    data: JSON.stringify(courseSpecilizationData),
                    contentType: "application/json",
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        if (responseData.status === "Success") {
                            var universityIdForSpecTut = responseData.universityId;
                            var universityCourseSessionIdTut = responseData.universityCourseSessionId;
                            Swal.fire(
                                '',
                                'Specilization And Fees Successfully Saved',
                                'success'
                            )
                            // Set the university ID in the hidden input field

                            $('input[name="universityIdForSpecTut"]').val(universityIdForSpecTut);
                            $('input[name="universityCourseSessionIdTut"]').val(universityCourseSessionIdTut);
                            $('#universityDetails').hide();
                            $('#courseDetails').hide();
                            $('#courseSpecilizationDetails').hide();
                            $('#courseSpecilizationTuitionFeesDetails').show();
                            // Fetch and populate saved university courses
                            fetchUniversityCoursesForSpecTutitionFee(universityIdForSpecTut, universityCourseSessionIdTut);
                            // Reset the form
                            $('#universityCourseSpeclizationForm')[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later',
                            })
                            // Re-enable the submit button in case of error
                            submitButton.prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving university details:', error);
                        // Re-enable the submit button in case of error
                        submitButton.prop('disabled', false);
                    }
                });
            } else {
                universityCourseSpeclizationForm[0].reportValidity();
            }
        }
    </script>
    <!-- Fetch University Saved Courses For Saved Specilization Tutition Fees -->
    <script>
        function fetchUniversityCoursesForSpecTutitionFee(universityIdForSpec, universityCourseSessionId) {
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpec,
                    universityCourseSessionId: universityCourseSessionId,
                    fetchCourse: "fetchUniversityCourses"
                },
                success: function(response) {
                    var courses = JSON.parse(response);

                    var selectElement = $("#showCourseSpecTution");
                    selectElement.empty();
                    selectElement.append('<option value="">choose courses</option>');
                    if (courses.length > 0) {
                        courses.forEach(function(course) {
                            selectElement.append('<option value="' + course.univ_course_id + '">' + course.univ_course_name + '</option>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        }
    </script>
    <script>
        $("#showCourseSpecTution").on("change", function(e) {
            var CourseId = $(this).val();
            var universityIdForSpecIdTut = $("#universityIdForSpecIdTut").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdTut,
                    CourseId: CourseId,
                    fetchCourseSpecTut: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#coursespectut").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        })
    </script>
    <script>
        $("#showCourseSpecTution").on("change", function(e) {
            var CourseId = $(this).val();
            var universityIdForSpecIdTut = $("#universityIdForSpecIdTut").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdTut,
                    CourseId: CourseId,
                    fetchCourseSpecTutSemYearFields: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#TuitionFeesSemestersFees").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        })
    </script>
    <script>
        $("#showCourseSpecTution").on("change", function(e) {
            var CourseId = $(this).val();
            var universityIdForSpecIdTut = $("#universityIdForSpecIdTut").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdTut,
                    CourseId: CourseId,
                    fetchCourseSpecTutYearFields: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#TuitionYearsFees").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        })
    </script>
    <script>
        $("#showCourseSpecTution").on("change", function(e) {
            var CourseId = $(this).val();
            var universityIdForSpecIdTut = $("#universityIdForSpecIdTut").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdTut,
                    CourseId: CourseId,
                    fetchCourseSpecTutOneTimeFields: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#TuitionOneTimeFees").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        })
    </script>
    <script>
        $("#coursespectut").on("change", function(e) {

            var specilizatioId = $("#coursespectut").val();
            var universityIdForSpecIdTut = $("#universityIdForSpecIdTut").val();
            var CourseId = $("#showCourseSpecTution").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdTut,
                    CourseId: CourseId,
                    specilizatioId: specilizatioId,
                    fetchCourseOtherSpecTut: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#showCourseOtherSpec").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        });
    </script>
    <script>
        function saveCoursesSpecilizationTuitionFeesDetails() {
            var universityCourseSpeclizationTuitionFeesForm = $('#universityCourseSpeclizationTuitionFeesForm');
            var submitButton = universityCourseSpeclizationTuitionFeesForm.find('button[name="saveCoursesSpecilizationData"]');

            if (universityCourseSpeclizationTuitionFeesForm[0].checkValidity()) {
                var courseSpecilizationData = {
                    universityId: $("input[name='universityIdForSpecTut']").val(),
                    universityCourseSessionId: $("input[name='universityCourseSessionIdTut']").val(),
                    courseName: $("select[name='courseNameSpecTut']").val(),
                    specialization: $("select[name='specializationNameTut']").val(),
                    feesModeSemester: $("select[name='tuition_fees_semester_mode']").val(),
                    feesModeYear: $("select[name='tuition_fees_year_mode']").val(),
                    feesModeOneTime: $("select[name='tuition_fees_oneTime_mode']").val(),
                    semesterName: $("select[name='tuition_fees_semester_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    semesterFee: $("input[name='tuition_fees_course_semester_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    yearName: $("select[name='tuition_course_years_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    yearFees: $("input[name='tuition_course_years_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    oneTimeName: $("select[name='tuition_course_total_years_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    oneTimeFees: $("input[name='tuition_course_one_time_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    otherCourseSpecFees: $("input[name='otherCourseSpecTut[]']:checked").map(function() {
                        return this.value;
                    }).get(),

                };
                // Add the button name and value to the courseSpecilizationData object
                courseSpecilizationData.saveCoursesSpecilizationFeesData = "SaveUniversityCoursesSpecilizationTuitionFeesData";
                $.ajax({
                    url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
                    type: "POST",
                    data: JSON.stringify(courseSpecilizationData),
                    contentType: "application/json",
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        if (responseData.status === "Success") {
                            var universityIdForSpec = responseData.universityId;
                            var universityCourseSessionId = responseData.universityCourseSessionId;
                            Swal.fire(
                                '',
                                'Specilization And Fees Successfully Saved',
                                'success'
                            )
                            // Set the university ID in the hidden input field

                            $('input[name="universityIdForSpecTut"]').val(universityIdForSpec);
                            $('input[name="universityCourseSessionIdTut"]').val(universityCourseSessionId);
                            $('#universityDetails').hide();
                            $('#courseDetails').hide();
                            $('#courseSpecilizationDetails').hide();
                            $('#courseSpecilizationTuitionFeesDetails').show();
                            // Fetch and populate saved university courses
                            fetchUniversityCoursesForSpecTutitionFee(universityIdForSpec, universityCourseSessionId);
                            // Reset the form
                            $('#universityCourseSpeclizationTuitionFeesForm')[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later',
                            })
                            // Re-enable the submit button in case of error
                            submitButton.prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving university details:', error);
                        // Re-enable the submit button in case of error
                        submitButton.prop('disabled', false);
                    }
                });
            } else {
                universityCourseSpeclizationTuitionFeesForm[0].reportValidity();
            }
        }
    </script>
    <script>
        function saveCoursesSpecilizationTuitionFeesDetailsNext() {
            var universityCourseSpeclizationTuitionFeesForm = $('#universityCourseSpeclizationTuitionFeesForm');
            var submitButton = universityCourseSpeclizationTuitionFeesForm.find('button[name="saveCoursesSpecilizationDataNext"]');

            if (universityCourseSpeclizationTuitionFeesForm[0].checkValidity()) {
                var courseSpecilizationData = {
                    universityId: $("input[name='universityIdForSpecTut']").val(),
                    universityCourseSessionId: $("input[name='universityCourseSessionIdTut']").val(),
                    courseName: $("select[name='courseNameSpecTut']").val(),
                    specialization: $("select[name='specializationNameTut']").val(),
                    feesModeSemester: $("select[name='tuition_fees_semester_mode']").val(),
                    feesModeYear: $("select[name='tuition_fees_year_mode']").val(),
                    feesModeOneTime: $("select[name='tuition_fees_oneTime_mode']").val(),
                    semesterName: $("select[name='tuition_fees_semester_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    semesterFee: $("input[name='tuition_fees_course_semester_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    yearName: $("select[name='tuition_course_years_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    yearFees: $("input[name='tuition_course_years_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    oneTimeName: $("select[name='tuition_course_total_years_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    oneTimeFees: $("input[name='tuition_course_one_time_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    otherCourseSpecFees: $("input[name='otherCourseSpecTut[]']:checked").map(function() {
                        return this.value;
                    }).get(),

                };
                // Add the button name and value to the courseSpecilizationData object
                courseSpecilizationData.saveCoursesSpecilizationFeesData = "SaveUniversityCoursesSpecilizationTuitionFeesDataNext";
                $.ajax({
                    url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
                    type: "POST",
                    data: JSON.stringify(courseSpecilizationData),
                    contentType: "application/json",
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        if (responseData.status === "Success") {
                            var universityIdForSpec = responseData.universityId;
                            var universityCourseSessionId = responseData.universityCourseSessionId;
                            Swal.fire(
                                '',
                                'Specilization And Fees Successfully Saved',
                                'success'
                            )
                            // Set the university ID in the hidden input field

                            $('input[name="universityIdForSpecCustom"]').val(universityIdForSpec);
                            $('input[name="universityCourseSessionIdCustom"]').val(universityCourseSessionId);
                            $('#universityDetails').hide();
                            $('#courseDetails').hide();
                            $('#courseSpecilizationDetails').hide();
                            $('#courseSpecilizationTuitionFeesDetails').hide();
                            $('#courseSpecilizationCustomFeesDetails').show();
                            // Fetch and populate saved university courses
                            fetchUniversityCoursesForSpecCustomFee(universityIdForSpec, universityCourseSessionId);
                            // Reset the form
                            $('#universityCourseSpeclizationTuitionFeesForm')[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later',
                            })
                            // Re-enable the submit button in case of error
                            submitButton.prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving university details:', error);
                        // Re-enable the submit button in case of error
                        submitButton.prop('disabled', false);
                    }
                });
            } else {
                universityCourseSpeclizationTuitionFeesForm[0].reportValidity();
            }
        }
    </script>
    <!-- Fetch University Saved Courses For Saved Specilization Custom Fees -->
    <script>
        function fetchUniversityCoursesForSpecCustomFee(universityIdForSpec, universityCourseSessionId) {
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpec,
                    universityCourseSessionId: universityCourseSessionId,
                    fetchCourse: "fetchUniversityCourses"
                },
                success: function(response) {
                    var courses = JSON.parse(response);

                    var selectElement = $("#customCourseName");
                    selectElement.empty();
                    selectElement.append('<option value="">choose courses</option>');
                    if (courses.length > 0) {
                        courses.forEach(function(course) {
                            selectElement.append('<option value="' + course.univ_course_id + '">' + course.univ_course_name + '</option>');
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        }
    </script>
    <script>
        $("#customCourseName").on("change", function(e) {
            var CourseId = $(this).val();
            var universityIdForSpecIdCustom = $("#universityIdForSpecIdCustom").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdCustom,
                    CourseId: CourseId,
                    fetchCourseSpecTut: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#showCustomSpecilization").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        })
    </script>
    <script>
        $("#customCourseName").on("change", function(e) {
            var CourseId = $(this).val();
            var universityIdForSpecIdCustom = $("#universityIdForSpecIdCustom").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdCustom,
                    CourseId: CourseId,
                    fetchCourseSpecSemFields: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#CustomFeesSemestersFees").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        })
    </script>
    <script>
        $("#customCourseName").on("change", function(e) {
            var CourseId = $(this).val();
            var universityIdForSpecIdCustom = $("#universityIdForSpecIdCustom").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdCustom,
                    CourseId: CourseId,
                    fetchCourseSpecYearFields: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#CustomYearsFees").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        })
    </script>
    <script>
        $("#customCourseName").on("change", function(e) {
            var CourseId = $(this).val();
            var universityIdForSpecIdCustom = $("#universityIdForSpecIdCustom").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdCustom,
                    CourseId: CourseId,
                    fetchCourseSpecOneTimeFields: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#CustomOneTimeFees").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        })
    </script>
    <script>
        $("#showCustomSpecilization").on("change", function(e) {
            var specilizatioId = $("#showCustomSpecilization").val();
            var universityIdForSpecIdCustom = $("#universityIdForSpecIdCustom").val();
            var CourseId = $("#customCourseName").val();
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request for fetching courses
                type: "POST",
                data: {
                    universityId: universityIdForSpecIdCustom,
                    CourseId: CourseId,
                    specilizatioId: specilizatioId,
                    fetchCourseOtherSpecTut: "fetchUniversityCourses"
                },
                success: function(response) {
                    $("#showCustomOtherCourseSpec").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching university courses:', error);
                }
            });
        });
    </script>
    <script>
        function saveCoursesSpecilizationCustomFeeDetails() {
            var universityCourseSpeclizationCustomFeesForm = $('#universityCourseSpeclizationCustomFeesForm');
            var submitButton = universityCourseSpeclizationCustomFeesForm.find('button[name="saveCoursesSpecilizationData"]');

            if (universityCourseSpeclizationCustomFeesForm[0].checkValidity()) {
                var courseSpecilizationData = {
                    universityId: $("input[name='universityIdForSpecCustom']").val(),
                    universityCourseSessionId: $("input[name='universityCourseSessionIdCustom']").val(),
                    courseName: $("select[name='customCourseName']").val(),
                    specialization: $("select[name='customSpecilization']").val(),
                    feesModeSemester: $("select[name='custom_fees_semester_mode']").val(),
                    feesModeYear: $("select[name='custom_fees_year_mode']").val(),
                    feesModeOneTime: $("select[name='custom_one_time_fees_mode']").val(),
                    semesterName: $("select[name='custom_fees_semester_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    semesterFee: $("input[name='custom_fees_course_semester_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    yearName: $("select[name='custom_course_years_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    yearFees: $("input[name='custom_course_years_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    oneTimeName: $("select[name='custom_course_total_years_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    oneTimeFees: $("input[name='custom_course_one_time_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    otherCourseSpecFees: $("input[name='otherCourseSpecTut[]']:checked").map(function() {
                        return this.value;
                    }).get(),

                };
                // Add the button name and value to the courseSpecilizationData object
                courseSpecilizationData.saveCoursesSpecilizationTutitionsFeesData = "SaveUniversityCoursesSpecilizationCustomFeesData";
                $.ajax({
                    url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
                    type: "POST",
                    data: JSON.stringify(courseSpecilizationData),
                    contentType: "application/json",
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        if (responseData.status === "Success") {
                            var universityIdForSpec = responseData.universityId;
                            var universityCourseSessionId = responseData.universityCourseSessionId;
                            Swal.fire(
                                '',
                                'Specilization And Fees Successfully Saved',
                                'success'
                            )
                            // Set the university ID in the hidden input field

                            $('input[name="universityIdForSpecCustom"]').val(universityIdForSpec);
                            $('input[name="universityCourseSessionIdCustom"]').val(universityCourseSessionId);
                            $('#universityDetails').hide();
                            $('#courseDetails').hide();
                            $('#courseSpecilizationDetails').hide();
                            $('#courseSpecilizationTuitionFeesDetails').hide();
                            $('#courseSpecilizationCustomFeesDetails').show();
                            // Fetch and populate saved university courses
                            fetchUniversityCoursesForSpecTutitionFee(universityIdForSpec, universityCourseSessionId);
                            // Reset the form
                            $('#universityCourseSpeclizationCustomFeesForm')[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later',
                            })
                            // Re-enable the submit button in case of error
                            submitButton.prop('disabled', false);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving university details:', error);
                        // Re-enable the submit button in case of error
                        submitButton.prop('disabled', false);
                    }
                });
            } else {
                universityCourseSpeclizationCustomFeesForm[0].reportValidity();
            }
        }
    </script>
    <script>
        function saveCoursesSpecilizationCustomFeeDetailsComplete() {
            var universityCourseSpeclizationCustomFeesForm = $('#universityCourseSpeclizationCustomFeesForm');
            var submitButton = universityCourseSpeclizationCustomFeesForm.find('button[name="completeSaveProcess"]');

            if (universityCourseSpeclizationCustomFeesForm[0].checkValidity()) {
                var courseSpecilizationData = {
                    universityId: $("input[name='universityIdForSpecCustom']").val(),
                    universityCourseSessionId: $("input[name='universityCourseSessionIdCustom']").val(),
                    courseName: $("select[name='customCourseName']").val(),
                    specialization: $("select[name='customSpecilization']").val(),
                    feesModeSemester: $("select[name='custom_fees_semester_mode']").val(),
                    feesModeYear: $("select[name='custom_fees_year_mode']").val(),
                    feesModeOneTime: $("select[name='custom_one_time_fees_mode']").val(),
                    semesterName: $("select[name='custom_fees_semester_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    semesterFee: $("input[name='custom_fees_course_semester_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    yearName: $("select[name='custom_course_years_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    yearFees: $("input[name='custom_course_years_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    oneTimeName: $("select[name='custom_course_total_years_name[]']").map(function() {
                        return this.value;
                    }).get(),
                    oneTimeFees: $("input[name='custom_course_one_time_fee[]']").map(function() {
                        return this.value;
                    }).get(),
                    otherCourseSpecFees: $("input[name='otherCourseSpecTut[]']:checked").map(function() {
                        return this.value;
                    }).get(),

                };
                // Add the button name and value to the courseSpecilizationData object
                courseSpecilizationData.saveCoursesSpecilizationTutitionsFeesData = "SaveUniversityCoursesSpecilizationCustomFeesData";
                $.ajax({
                    url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
                    type: "POST",
                    data: JSON.stringify(courseSpecilizationData),
                    contentType: "application/json",
                    success: function(response) {
                        var responseData = JSON.parse(response);
                        if (responseData.status === "Success") {

                            Swal.fire(
                                '',
                                'Specilization And Fees Successfully Saved',
                                'success'
                            ).then(function() {
                                // Redirect the user to index.php after the user clicks "OK" on the success message
                                window.location.href = 'index.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: 'Something went wrong! Please try again later',
                            }).then(function() {
                                // Redirect the user to index.php after the user clicks "OK" on the success message
                                window.location.href = 'index.php';
                            });

                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving university details:', error);
                        // Re-enable the submit button in case of error
                        submitButton.prop('disabled', false);
                    }
                });
            } else {
                universityCourseSpeclizationCustomFeesForm[0].reportValidity();
            }
        }
    </script>
</body>

</html>