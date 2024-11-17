<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "University Course Details";
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
if (isset($_GET['uid'])) {
    $UniversitId = SECURE($_GET['uid'], 'd');
    $CourseSessionYearId = $_GET['ucsy'];
    $CourseId = $_GET['ucn'];
    $CourseSpecilizationId = $_GET['ucs'];
} else {
    $UniversitId = "";
    $CourseSessionYearId = "";
    $CourseId = "";
    $CourseSpecilizationId = "";
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
                                        <div class="col-sm-12 col-12 ">
                                            <h3 class="app-heading">Update <?php echo $PageName; ?></h3>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <section class="section account-dashboard">
                                                <div class="col-md-12">
                                                    <div class="card student-card mx-auto" id="universityDetails">
                                                        <div class="tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="card-header custom-card-header">
                                                                        Course Primary Details
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="card-body">
                                                                <form id="universityForm" action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <?php
                                                                                $fetchCourse = FETCH_DB_TABLE("SELECT * From univ_session_course AS usc INNER JOIN universities_courses AS uc ON usc.univ_course_id=uc.univ_course_id WHERE usc.univ_session_id='$CourseSessionYearId' AND usc.univ_course_id='$CourseId'AND usc.university_id='$UniversitId' AND uc.univ_course_status='1'", true);
                                                                                if (isset($fetchCourse)) {
                                                                                    foreach ($fetchCourse as $data) {
                                                                                        $CourseName = $data->univ_course_name;
                                                                                        $CourseType = $data->univ_course_type;
                                                                                        $CourseTotalSemester = $data->univ_course_total_semester;
                                                                                        $CourseTotalYears = $data->univ_course_total_year;
                                                                                    }
                                                                                }

                                                                                ?>
                                                                                <div class="col-md-4 form-group">
                                                                                    <label>Course Session Years</label>
                                                                                    <input type="text" class="form-control" name="univ_session_name" id="updateCourseSessionYears" value="<?= FETCH("SELECT univ_session_name FROM universities_session_years WHERE univ_session_id='$CourseSessionYearId' AND university_id='$UniversitId'", "univ_session_name");
                                                                                                                                                                                            ?>">
                                                                                </div>

                                                                                <div class="col-md-4 form-group">
                                                                                    <label>Courses Name</label>
                                                                                    <input type="text" class="form-control" name="univ_course_name" id="updateCourseName" value="<?= $CourseName ?>">
                                                                                </div>
                                                                                <div class="col-md-4 form-group">
                                                                                    <label>Course Specialization</label>
                                                                                    <input type="text" class="form-control" name="univ_course_specialization_name" id="updateCourseSpecilizationName" value="<?= FETCH("SELECT univ_course_specialization_name FROM universities_courses_specializations WHERE university_id='$UniversitId' AND univ_course_id='$CourseId' AND univ_specialization_id = '$CourseSpecilizationId'", "univ_course_specialization_name"); ?>">
                                                                                </div>
                                                                                <div class="col-md-4 form-group">
                                                                                    <label>Course Type</label>
                                                                                    <select class="form-control" name="univ_course_type" id="updateCourseType">
                                                                                        <?php InputOptions(["Graduation", "Post Graduation", "Under Graduation"], $CourseType) ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4 form-group">
                                                                                    <label>Total Semesters</label>
                                                                                    <input type="text" class="form-control" name="univ_course_total_semester" id="updateCourseTotalSemester" value="<?= $CourseTotalSemester ?>">
                                                                                </div>
                                                                                <div class="col-md-4 form-group">
                                                                                    <label>Total Years</label>
                                                                                    <input type="text" class="form-control" name="univ_course_total_year" id="updateCourseTotalYears" value="<?= $CourseTotalYears ?>">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="card shadow-none p-3 mb-5 bg-light rounded">
                                                                                        <h5 class="app-sub-heading text-center">Course Fees</h5>
                                                                                        <div class="row">
                                                                                            <?php
                                                                                            //Fetch University Session Course Specilization Fee Details According To University Id
                                                                                            $fetchCourseSpecilizationFee = FETCH_DB_TABLE("SELECT * From universities_courses_specializations_fees WHERE univ_session_id='$CourseSessionYearId' AND univ_course_id='$CourseId' AND university_id='$UniversitId' AND university_specialization_id='$CourseSpecilizationId'", true);
                                                                                            //Fetch University Session Course Specilization Fee Details According To University Id
                                                                                            $fetchCourseSpecilizationTutitionFee = FETCH_DB_TABLE("SELECT * From universities_courses_specializations_tutition_fees WHERE univ_session_id='$CourseSessionYearId' AND univ_course_id='$CourseId' AND university_id='$UniversitId' AND university_specialization_id='$CourseSpecilizationId'", true);

                                                                                            ?>
                                                                                            <div class="col-md-4">
                                                                                                <div class="row w-100 ">
                                                                                                    <div class='col-md-12' id="semesterShowList">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 form-group">
                                                                                                                <label>Fees Modes <?php echo $req; ?></label>
                                                                                                                <select name="tuition_fees_semester_mode" id="TuitionFeesSemester" class="form-control form-control-sm" onchange="showTuitionFeesSemesterFields()" required="">
                                                                                                                    <option value="">Choose Fees Modes</option>
                                                                                                                    <option value="Semesters Wise" selected>Semesters Wise</option>
                                                                                                                </select>
                                                                                                            </div>

                                                                                                            <div class='col-md-12 form-group' id="TuitionFeesSemestersFees" style="display: block !important;">
                                                                                                                <?php
                                                                                                                if (isset($fetchCourseSpecilizationFee)) {
                                                                                                                    foreach ($fetchCourseSpecilizationFee as $data) {
                                                                                                                        $CourseFeeMode = $data->univ_course_spec_fee_mode_type;

                                                                                                                        if ($CourseFeeMode == "Semesters Wise") {
                                                                                                                            $UnivCourseSpecSemFeeId = $data->univ_courses_spec_fee_id;
                                                                                                                            echo '<input type="hidden" id="UnivCourseSpecSemFeeId" name="UnivCourseSpecSemFeeId" value="' . $UnivCourseSpecSemFeeId . '">';
                                                                                                                            $CourseFeeName = explode(",", $data->univ_course_spec_fee_name);
                                                                                                                            $CourseFee = explode(",", $data->univ_course_spec_fee_value);
                                                                                                                            $lastArrayKey = array_key_last($CourseFeeName);
                                                                                                                            foreach ($CourseFeeName as $courseNameKey => $course) {
                                                                                                                                echo '<div class="row">

                                                                                                                            <div class="col-md-12 form-group d-flex">
                                                                                                                            <div class="w-50">
                                                                                                                                <label>Semester <?php echo $req; ?></label>
                                                                                                                                <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                                                                                                                    <option value="">Choose Semester</option>
                                                                                                                                    <option value="1" ' . ($course == 1 ? "selected" : "") . '>1st Sem</option>
                                                                                                                                    <option value="2" ' . ($course == 2 ? "selected" : "") . '>2nd Sem</option>
                                                                                                                                    <option value="3" ' . ($course == 3 ? "selected" : "") . '>3rd Sem</option>
                                                                                                                                    <option value="4" ' . ($course == 4 ? "selected" : "") . '>4th Sem</option>
                                                                                                                                    <option value="5" ' . ($course == 5 ? "selected" : "") . '>5th Sem</option>
                                                                                                                                    <option value="6" ' . ($course == 6 ? "selected" : "") . '>6th Sem</option>
                                                                                                                                    <option value="7" ' . ($course == 7 ? "selected" : "") . '>7th Sem</option>
                                                                                                                                    <option value="8" ' . ($course == 8 ? "selected" : "") . '>8th Sem</option>
                                                                                                                                    <option value="9" ' . ($course == 9 ? "selected" : "") . '>9th Sem</option>
                                                                                                                                    <option value="10" ' . ($course == 10 ? "selected" : "") . '>10th Sem</option>
                                                                                                                                </select>
                                                                                                                            </div>
                                                                                                                            <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                <label>Fee <?php echo $req; ?></label>
                                                                                                                                <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" value="' . $CourseFee[$courseNameKey] . '">
                                                                                                                            </div>
                                                                                                                            ';
                                                                                                                                if ($lastArrayKey == $courseNameKey) {
                                                                                                                                    echo '<div class="col-md-2 form-group ">
                                                                                                                                    <label></label>
                                                                                                                                    <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                                                                                                                </div>';
                                                                                                                                }
                                                                                                                                echo '</div>
                                                                                                                    </div>';
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo '<div class="row" id="TuitionFeesAddMoreSemester">
                                                                                                                            <div class="col-md-10 form-group d-flex">
                                                                                                                            <div class="w-50">
                                                                                                                                <label>Semester <?php echo $req; ?></label>
                                                                                                                                <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                                                                                                                <option value="">Choose Sem</option>
                                                                                                                                <option value="1">1st Sem</option>
                                                                                                                                <option value="2">2nd Sem</option>
                                                                                                                                <option value="3">3rd Sem</option>
                                                                                                                                <option value="4">4th Sem</option>
                                                                                                                                <option value="5">5th Sem</option>
                                                                                                                                <option value="6">6th Sem</option>
                                                                                                                                <option value="7">7th Sem</option>
                                                                                                                                <option value="8">8th Sem</option>
                                                                                                                                <option value="9">9th Sem</option>
                                                                                                                                <option value="10">10th Sem</option>
                                                                                                                                </select>
                                                                                                                            </div>
                                                                                                                            <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                <label>Fee <?php echo $req; ?></label>
                                                                                                                                <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                                                                                                            </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-2 form-group ">
                                                                                                                            <label></label>
                                                                                                                            <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                                                                                                            </div>

                                                                                                                        </div>';
                                                                                                                } ?>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="row w-100 ">
                                                                                                    <div class='col-md-12'>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 form-group">
                                                                                                                <label>Fees Modes <?php echo $req; ?></label>
                                                                                                                <select name="tuition_fees_year_mode" id="TuitionFeesYear" class="form-control form-control-sm" onchange="showTuitionFeesYearFields()" required="">
                                                                                                                    <option value="">Choose Fees Modes</option>
                                                                                                                    <option value="Years Wise" selected>Years Wise</option>
                                                                                                                </select>
                                                                                                            </div>

                                                                                                            <div class='col-md-12 form-group ' id="TuitionYearsFees" style="display: block !important;">
                                                                                                                <?php
                                                                                                                if (isset($fetchCourseSpecilizationFee)) {
                                                                                                                    foreach ($fetchCourseSpecilizationFee as $data) {
                                                                                                                        $CourseFeeMode = $data->univ_course_spec_fee_mode_type;
                                                                                                                        if ($CourseFeeMode == "Years Wise") {
                                                                                                                            $UnivCourseSpecYrFeeId = $data->univ_courses_spec_fee_id;
                                                                                                                            echo '<input type="hidden" id="UnivCourseSpecYrFeeId" name="UnivCourseSpecYrFeeId" value="' . $UnivCourseSpecYrFeeId . '">';

                                                                                                                            $CourseFeeName = explode(",", $data->univ_course_spec_fee_name);
                                                                                                                            $CourseFee = explode(",", $data->univ_course_spec_fee_value);
                                                                                                                            $lastArrayKey = array_key_last($CourseFeeName);
                                                                                                                            foreach ($CourseFeeName as $courseNameKey => $course) {
                                                                                                                                echo '<div class="row" id="TuitionYearsFeesAddMoreYears">
                                                                                                                                   <div class="col-md-12 form-group d-flex">
                                                                                                                                    <div class="w-50">
                                                                                                                                        <label>Year <?php echo $req; ?></label>
                                                                                                                                        <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                                                                                                                        <option value="">choose year</option>
                                                                                                                                        <option value="1" ' . ($course == 1 ? "selected" : "") . '>1st Yr</option>
                                                                                                                                        <option value="2" ' . ($course == 2 ? "selected" : "") . '>2nd Yr</option>
                                                                                                                                        <option value="3" ' . ($course == 3 ? "selected" : "") . '>3rd Yr</option>
                                                                                                                                        <option value="4" ' . ($course == 4 ? "selected" : "") . '>4th Yr</option>
                                                                                                                                        <option value="5" ' . ($course == 5 ? "selected" : "") . '>5th Yr</option>
                                                                                                                                        </select>
                                                                                                                                    </div>
                                                                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                        <label>Fee <?php echo $req; ?></label>
                                                                                                                                        <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" value="' . $CourseFee[$courseNameKey] . '" >
                                                                                                                                    </div>';
                                                                                                                                if ($lastArrayKey == $courseNameKey) {
                                                                                                                                    echo '<div class="col-md-2 form-group ">
                                                                                                                                        <label></label>
                                                                                                                                        <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                                                                                                                        </div>';
                                                                                                                                }
                                                                                                                                echo '</div>

                                                                                                                                </div>';
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo '<div class="row" id="TuitionYearsFeesAddMoreYears">
                                                                                                                                <div class="col-md-10 form-group d-flex">
                                                                                                                                <div class="w-50">
                                                                                                                                    <label>Year <?php echo $req; ?></label>
                                                                                                                                    <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                                                                                                                    <option value="">choose year</option>
                                                                                                                                    <option value="1">1st Yr</option>
                                                                                                                                    <option value="2">2nd Yr</option>
                                                                                                                                    <option value="3">3rd Yr</option>
                                                                                                                                    <option value="4">4th Yr</option>
                                                                                                                                    <option value="5">5th Yr</option>
                                                                                                                                    </select>
                                                                                                                                </div>
                                                                                                                                <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                    <label>Fee <?php echo $req; ?></label>
                                                                                                                                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >

                                                                                                                                </div>
                                                                                                                                <div class="col-md-2 form-group ">
                                                                                                                                    <label></label>
                                                                                                                                    <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                                                                                                                </div>
                                                                                                                                </div>

                                                                                                                            </div>';
                                                                                                                } ?>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="row w-100 ">
                                                                                                    <div class='col-md-12'>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 form-group">
                                                                                                                <label>Fees Modes <?php echo $req; ?></label>
                                                                                                                <select name="tuition_fees_oneTime_mode" id="TuitionFeesOneTime" class="form-control form-control-sm" onchange="showTuitionFeesOneTimeFields()" required="">
                                                                                                                    <option value="">Choose Fees Modes</option>
                                                                                                                    <option value="One Time" selected>One Time</option>
                                                                                                                </select>
                                                                                                            </div>

                                                                                                            <div class='col-md-12 form-group ' id="TuitionOneTimeFees" style="display: block !important;">
                                                                                                                <?php
                                                                                                                if (isset($fetchCourseSpecilizationFee)) {
                                                                                                                    foreach ($fetchCourseSpecilizationFee as $data) {
                                                                                                                        $CourseFeeMode = $data->univ_course_spec_fee_mode_type;
                                                                                                                        if ($CourseFeeMode == "One Time") {
                                                                                                                            $UnivCourseSpecOneTimeFeeId = $data->univ_courses_spec_fee_id;
                                                                                                                            echo '<input type="hidden" id="UnivCourseSpecOneTimeFeeId" name="UnivCourseSpecOneTimeFeeId" value="' . $UnivCourseSpecOneTimeFeeId . '"> ';
                                                                                                                            $CourseFeeName = explode(",", $data->univ_course_spec_fee_name);
                                                                                                                            $CourseFee = explode(",", $data->univ_course_spec_fee_value);
                                                                                                                            foreach ($CourseFeeName as $courseNameKey => $course) {

                                                                                                                                echo '<div class="row">
                                                                                                                                    <div class="col-md-12 form-group d-flex">
                                                                                                                                    <div class="w-50">
                                                                                                                                        <label>Total<?php echo $req; ?></label>
                                                                                                                                        <select name="tuition_course_total_years_name[]" class="form-control form-control-sm">
                                                                                                                                        <option value="">Choose Total</option>
                                                                                                                                        <option value="One Time" selected>One Time</option>
                                                                                                                                        </select>
                                                                                                                                    </div>
                                                                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                        <label>Fee<?php echo $req; ?></label>
                                                                                                                                        <input type="number" name="tuition_course_one_time_fee[]" class="form-control form-control-sm" value="' . $CourseFee[$courseNameKey] . '" >
                                                                                                                                    </div>
                                                                                                                                    </div>

                                                                                                                                </div>';
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo '<div class="row">
                                                                                                                            <div class="col-md-12 form-group d-flex">
                                                                                                                            <div class="w-50">
                                                                                                                                <label>Total<?php echo $req; ?></label>
                                                                                                                                <select name="tuition_course_total_years_name[]" class="form-control form-control-sm">
                                                                                                                                <option value="">Choose Total</option>
                                                                                                                                <option value="One Time" selected>One Time</option>
                                                                                                                                </select>
                                                                                                                            </div>
                                                                                                                            <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                <label>Fee<?php echo $req; ?></label>
                                                                                                                                <input type="number" name="tuition_course_one_time_fee[]" class="form-control form-control-sm" >
                                                                                                                            </div>
                                                                                                                            </div>

                                                                                                                        </div>';
                                                                                                                } ?>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="card shadow-none p-3 mb-5 bg-light rounded">
                                                                                        <h5 class="app-sub-heading text-center">Tutition Fees</h5>
                                                                                        <div class="row">
                                                                                            <div class="col-md-4">
                                                                                                <div class="row w-100 ">
                                                                                                    <div class='col-md-12'>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 form-group">
                                                                                                                <label>Fees Modes <?php echo $req; ?> </label>
                                                                                                                <select name="custom_fees_semester_mode" id="CustomFeesSemester" class="form-control form-control-sm" onchange="showCustomFeesSemesterFields()" required="">
                                                                                                                    <option value="">Choose Fees Modes</option>
                                                                                                                    <option value="Semesters Wise" selected>Semesters Wise</option>
                                                                                                                </select>
                                                                                                            </div>
                                                                                                            <div class='col-md-12 form-group' id="CustomFeesSemestersFees" style="display: block !important;">
                                                                                                                <?php
                                                                                                                if (isset($fetchCourseSpecilizationTutitionFee)) {
                                                                                                                    foreach ($fetchCourseSpecilizationTutitionFee as $data) {
                                                                                                                        $CourseFeeMode = $data->univ_course_spec_fee_mode_type;
                                                                                                                        if ($CourseFeeMode == "Semesters Wise") {
                                                                                                                            $UnivCourseSpecCustomSemFeeId = $data->univ_courses_spec_fee_id;
                                                                                                                            echo '<input type="hidden" id="UnivCourseSpecCustomSemFeeId" name="UnivCourseSpecCustomSemFeeId" value="' . $UnivCourseSpecCustomSemFeeId . '">';

                                                                                                                            $CourseFeeName = explode(",", $data->univ_course_spec_fee_name);
                                                                                                                            $CourseFee = explode(",", $data->univ_course_spec_fee_value);
                                                                                                                            $lastArrayKey = array_key_last($CourseFeeName);
                                                                                                                            foreach ($CourseFeeName as $courseNameKey => $course) {

                                                                                                                                echo '<div class="row" id="CustomFeesAddMoreSemester">
                                                                                                                                    <div class="col-md-12 form-group d-flex">
                                                                                                                                    <div class="w-50">
                                                                                                                                        <label>Semester <?php echo $req; ?></label>
                                                                                                                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                                                                                                                        <option value="">Choose Semester</option>
                                                                                                                                        <option value="1" ' . ($course == 1 ? "selected" : "") . '>1st Sem</option>
                                                                                                                                        <option value="2" ' . ($course == 2 ? "selected" : "") . '>2nd Sem</option>
                                                                                                                                        <option value="3" ' . ($course == 3 ? "selected" : "") . '>3rd Sem</option>
                                                                                                                                        <option value="4" ' . ($course == 4 ? "selected" : "") . '>4th Sem</option>
                                                                                                                                        <option value="5" ' . ($course == 5 ? "selected" : "") . '>5th Sem</option>
                                                                                                                                        <option value="6" ' . ($course == 6 ? "selected" : "") . '>6th Sem</option>
                                                                                                                                        <option value="7" ' . ($course == 7 ? "selected" : "") . '>7th Sem</option>
                                                                                                                                        <option value="8" ' . ($course == 8 ? "selected" : "") . '>8th Sem</option>
                                                                                                                                        <option value="9" ' . ($course == 9 ? "selected" : "") . '>9th Sem</option>
                                                                                                                                        <option value="10" ' . ($course == 10 ? "selected" : "") . '>10 Sem</option>
                                                                                                                                        </select>
                                                                                                                                    </div>
                                                                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                        <label>Fee <?php echo $req; ?></label>
                                                                                                                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" value="' . $CourseFee[$courseNameKey] . '" >
                                                                                                                                    </div>';
                                                                                                                                if ($lastArrayKey == $courseNameKey) {
                                                                                                                                    echo '<div class="col-md-2 form-group ">
                                                                                                                            <label></label>
                                                                                                                            <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                                                                                                            </div>';
                                                                                                                                }
                                                                                                                                echo '</div>


                                                                                                                                </div>';
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo '<div class="row" id="CustomFeesAddMoreSemester">
                                                                                                                            <div class="col-md-10 form-group d-flex">
                                                                                                                            <div class="w-50">
                                                                                                                                <label>Semester <?php echo $req; ?></label>
                                                                                                                                <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                                                                                                                <option value="">Choose Semester</option>
                                                                                                                                <option value="1">1st Sem</option>
                                                                                                                                <option value="2">2nd Sem</option>
                                                                                                                                <option value="3">3rd Sem</option>
                                                                                                                                <option value="4">4th Sem</option>
                                                                                                                                <option value="5">5th Sem</option>
                                                                                                                                <option value="6">6th Sem</option>
                                                                                                                                <option value="7">7th Sem</option>
                                                                                                                                <option value="8">8th Sem</option>
                                                                                                                                <option value="9">9th Sem</option>
                                                                                                                                <option value="10">10th Sem</option>
                                                                                                                                </select>
                                                                                                                            </div>
                                                                                                                            <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                <label>Fee <?php echo $req; ?></label>
                                                                                                                                <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                                                                                                            </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-2 form-group ">
                                                                                                                            <label></label>
                                                                                                                            <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                                                                                                            </div>

                                                                                                                        </div>';
                                                                                                                } ?>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <div class="row w-100 ">
                                                                                                    <div class='col-md-12'>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 form-group">
                                                                                                                <label>Fees Modes <?php echo $req; ?></label>
                                                                                                                <select name="custom_fees_year_mode" id="CustomFeesYear" class="form-control form-control-sm" onchange="showCustomFeesYearFields()" required="">
                                                                                                                    <option value="">Choose Fees Modes</option>
                                                                                                                    <option value="Years Wise" selected>Years Wise</option>
                                                                                                                </select>
                                                                                                            </div>

                                                                                                            <div class='col-md-12 form-group ' id="CustomYearsFees" style="display: block !important;">
                                                                                                                <?php
                                                                                                                if (isset($fetchCourseSpecilizationTutitionFee)) {
                                                                                                                    foreach ($fetchCourseSpecilizationTutitionFee as $data) {
                                                                                                                        $CourseFeeMode = $data->univ_course_spec_fee_mode_type;
                                                                                                                        if ($CourseFeeMode == "Years Wise") {
                                                                                                                            $UnivCourseSpecCustomYrFeeId = $data->univ_courses_spec_fee_id;
                                                                                                                            echo '<input type="hidden" id="UnivCourseSpecCustomYrFeeId" name="UnivCourseSpecCustomYrFeeId" value="' . $UnivCourseSpecCustomYrFeeId . '">';

                                                                                                                            $CourseFeeName = explode(",", $data->univ_course_spec_fee_name);
                                                                                                                            $CourseFee = explode(",", $data->univ_course_spec_fee_value);
                                                                                                                            $lastArrayKey = array_key_last($CourseFeeName);
                                                                                                                            foreach ($CourseFeeName as $courseNameKey => $course) {

                                                                                                                                echo '<div class="row" id="CustomYearsFeesAddMoreYears">
                                                                                                                                    <div class="col-md-12 form-group d-flex">
                                                                                                                                    <div class="w-50">
                                                                                                                                        <label>Year <?php echo $req; ?></label>
                                                                                                                                        <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                                                                                                                        <option value="">choose year</option>
                                                                                                                                        <option value="1" ' . ($course == 1 ? "selected" : "") . '>1st OneTime</option>
                                                                                                                                        <option value="2" ' . ($course == 2 ? "selected" : "") . '>2nd Yr</option>
                                                                                                                                        <option value="3" ' . ($course == 3 ? "selected" : "") . '>3rd Yr</option>
                                                                                                                                        <option value="4" ' . ($course == 4 ? "selected" : "") . '>4th Yr</option>
                                                                                                                                        <option value="5" ' . ($course == 5 ? "selected" : "") . '>5th Yr</option>
                                                                                                                                        </select>
                                                                                                                                    </div>
                                                                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                        <label>Fee <?php echo $req; ?></label>
                                                                                                                                        <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" value="' . $CourseFee[$courseNameKey] . '"  >

                                                                                                                                    </div>';
                                                                                                                                if ($lastArrayKey == $courseNameKey) {
                                                                                                                                    echo '<div class="col-md-2 form-group ">
                                                                                                                                        <label></label>
                                                                                                                                        <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                                                                                                                        </div>';
                                                                                                                                }
                                                                                                                                echo '  </div>

                                                                                                                                </div>';
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo '<div class="row" id="CustomYearsFeesAddMoreYears">
                                                                                                                            <div class="col-md-10 form-group d-flex">
                                                                                                                            <div class="w-50">
                                                                                                                                <label>Year <?php echo $req; ?></label>
                                                                                                                                <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                                                                                                                <option value="">choose year</option>
                                                                                                                                <option value="1">1st Years</option>
                                                                                                                                <option value="2">2nd Years</option>
                                                                                                                                <option value="3">3rd Years</option>
                                                                                                                                <option value="4">4th Years</option>
                                                                                                                                <option value="5">5th Years</option>
                                                                                                                                </select>
                                                                                                                            </div>
                                                                                                                            <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                <label>Fee <?php echo $req; ?></label>
                                                                                                                                <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >

                                                                                                                            </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-2 form-group ">
                                                                                                                            <label></label>
                                                                                                                            <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                                                                                                            </div>
                                                                                                                        </div>';
                                                                                                                } ?>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-md-4">
                                                                                                <div class="row w-100 ">
                                                                                                    <div class='col-md-12'>
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-12 form-group">
                                                                                                                <label>Fees Modes <?php echo $req; ?></label>
                                                                                                                <select name="custom_one_time_fees_mode" id="CustomFeesOneTime" class="form-control form-control-sm" onchange="showCustomFeesOneTimeFields()" required="">
                                                                                                                    <option value="">Choose Fees Modes</option>
                                                                                                                    <option value="One Time" selected>One Time</option>
                                                                                                                </select>
                                                                                                            </div>

                                                                                                            <div class='col-md-12 form-group ' id="CustomOneTimeFees" style="display: block !important;">
                                                                                                                <?php
                                                                                                                if (isset($fetchCourseSpecilizationTutitionFee)) {
                                                                                                                    foreach ($fetchCourseSpecilizationTutitionFee as $data) {
                                                                                                                        $CourseFeeMode = $data->univ_course_spec_fee_mode_type;
                                                                                                                        if ($CourseFeeMode == "One Time") {
                                                                                                                            $UnivCourseSpecCustomOneTimeFeeId = $data->univ_courses_spec_fee_id;
                                                                                                                            echo '<input type="hidden" id="UnivCourseSpecCustomOneTimeFeeId" name="UnivCourseSpecCustomOneTimeFeeId" value="' . $UnivCourseSpecCustomOneTimeFeeId . '">';

                                                                                                                            $CourseFeeName = explode(",", $data->univ_course_spec_fee_name);
                                                                                                                            $CourseFee = explode(",", $data->univ_course_spec_fee_value);
                                                                                                                            foreach ($CourseFeeName as $courseNameKey => $course) {

                                                                                                                                echo '<div class="row">
                                                                                                                                    <div class="col-md-12 form-group d-flex">
                                                                                                                                    <div class="w-50">
                                                                                                                                        <label>Total<?php echo $req; ?></label>
                                                                                                                                        <select name="custom_course_total_years_name[]" class="form-control form-control-sm">
                                                                                                                                        <option value="">Choose Total</option>
                                                                                                                                        <option value="One Time" selected>One Time</option>
                                                                                                                                        </select>
                                                                                                                                    </div>
                                                                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                        <label>Fee<?php echo $req; ?></label>
                                                                                                                                        <input type="number" name="custom_course_one_time_fee[]" class="form-control form-control-sm" value="' . $CourseFee[$courseNameKey] . '" >
                                                                                                                                    </div>
                                                                                                                                    </div>

                                                                                                                                </div>';
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo '<div class="row">
                                                                                                                            <div class="col-md-12 form-group d-flex">
                                                                                                                            <div class="w-50">
                                                                                                                                <label>Total<?php echo $req; ?></label>
                                                                                                                                <select name="custom_course_total_years_name[]" class="form-control form-control-sm">
                                                                                                                                <option value="">Choose Total</option>
                                                                                                                                <option value="One Time" selected>One Time</option>
                                                                                                                                </select>
                                                                                                                            </div>
                                                                                                                            <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                                                <label>Fee<?php echo $req; ?></label>
                                                                                                                                <input type="number" name="custom_course_one_time_fee[]" class="form-control form-control-sm" >
                                                                                                                            </div>
                                                                                                                            </div>

                                                                                                                        </div>';
                                                                                                                } ?>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>


                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                        <div class="col-md-12 d-flex justify-content-between btn">
                                                                            <a href="index.php" class="btn btn-sm btn-default cancel">Cancel</a>
                                                                            <button type="button" onclick="updateUniversityCourseDetails()" name="SaveUniversityInfo" value="SaveUniversityPrimary&AddressData" class="btn btn-sm btn-success next">Update Course Details</button>
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
        //Add Multiple Semester
        $(document).ready(function() {
            $(document).on("click", ".add_tution_semester_fee_btn", function(e) {
                e.preventDefault();
                let parentContainer = $(this).closest(".row");
                // Create the new field HTML
                let newField = `<div class="row " id="TuitionFeesAddMoreSemester">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Semester <?php echo $req; ?></label>
                              <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                              <option value="">choose sem</option>
                              <option value="1">1st Sem</option>
                                <option value="2">2nd Sem</option>
                                <option value="3">3rd Sem</option>
                                <option value="4">4th Sem</option>
                                <option value="5">5th Sem</option>
                                <option value="6">6th Sem</option>
                                <option value="7">7th Sem</option>
                                <option value="8">8th Sem</option>
                                <option value="9">9th Sem</option>
                                <option value="10">10th Sem</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Fee <?php echo $req; ?></label>
                              <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_tution_semester_fee_btn"><i class="bi bi-trash3-fill"></i></button>
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
        //Add Multiple Semester
        $(document).ready(function() {
            //Add Multiple Years
            $(document).on("click", ".add_tution_year_fee_btn", function(e) {
                e.preventDefault();
                let parentContainer = $(this).closest(".row");
                // Create the new field HTML
                let newField = `<div class="row " id="TuitionYearsFeesAddMoreYears">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year <?php echo $req; ?></label>
                              <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                              <option value="">choose year</option>
                              <option value="1">1st Yr</option>
                                <option value="2">2nd Yr</option>
                                <option value="3">3rd Yr</option>
                                <option value="4">4th Yr</option>
                                <option value="5">5th Yr</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Fee <?php echo $req; ?></label>
                              <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_tution_year_fee_btn"><i class="bi bi-trash3-fill"></i></button>
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
            $(document).on("click", ".add_custom_semester_fee_btn", function(e) {
                e.preventDefault();
                // Find the parent container of the button
                let parentContainer = $(this).closest(".row");

                // Create the new field HTML
                let newField = ` <div class="row " id="CustomFeesAddMoreSemester">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Semester <?php echo $req; ?></label>
                              <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                              <option value="">choose semester</option>
                              <option value="1">1st Semester</option>
                                <option value="2">2nd Sem</option>
                                <option value="3">3rd Sem</option>
                                <option value="4">4th Sem</option>
                                <option value="5">5th Sem</option>
                                <option value="6">6th Sem</option>
                                <option value="7">7th Sem</option>
                                <option value="8">8th Sem</option>
                                <option value="9">9th Sem</option>
                                <option value="10">10th Sem</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Fee <?php echo $req; ?></label>
                              <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_custom_semester_fee_btn"><i class="bi bi-trash3-fill"></i></button>
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
            //Add Multiple Years
            $(document).on("click", ".add_custom_year_fee_btn", function(e) {
                e.preventDefault();
                // Find the parent container of the button
                let parentContainer = $(this).closest(".row");

                // Create the new field HTML
                let newField = ` <div class="row " id="CustomYearsFeesAddMoreYears">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year <?php echo $req; ?></label>
                              <select name="custom_course_years_name[]" class="form-control form-control-sm">
                              <option value="">choose year</option>
                              <option value="1">1st Yr</option>
                                <option value="2">2nd Yr</option>
                                <option value="3">3rd Yr</option>
                                <option value="4">4th Yr</option>
                                <option value="5">5th Yr</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Fee <?php echo $req; ?></label>
                              <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_custom_year_fee_btn"><i class="bi bi-trash3-fill"></i></button>
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
    <script>
        $(window).on('load', function() {
            var selectedMode = $('#updatefeesMode').val();

            if (selectedMode === "Semesters Wise") {
                $('#updateSemestersFee').css('display', 'block');
                $('#updateYearsFee').css('display', 'none');
                $('#updateOneTimeFee').css('display', 'none');
            } else if (selectedMode === "Years Wise") {
                $('#updateSemestersFee').css('display', 'none');
                $('#updateYearsFee').css('display', 'block');
                $('#updateOneTimeFee').css('display', 'none');
            } else if (selectedMode === "One Time") {
                $('#updateSemestersFee').css('display', 'none');
                $('#updateYearsFee').css('display', 'none');
                $('#updateOneTimeFee').css('display', 'block');
            } else {
                $('#updateSemestersFee').css('display', 'none');
                $('#updateYearsFee').css('display', 'none');
                $('#updateOneTimeFee').css('display', 'none');
            }
        });
        // Show Semester Fee Fields
        const UpdateFeesModesField = () => {
            const updatesemesterSelects = document.getElementById("updatefeesMode");
            const updateselectedSemesterOptions = updatesemesterSelects.options[updatesemesterSelects.selectedIndex].value;
            const updatesemesterDivs = document.getElementById("updateSemestersFee");
            const updateyearsFeesDivs = document.getElementById("updateYearsFee");
            const updateoneTimeFeesDivs = document.getElementById("updateOneTimeFee");
            const updatecourseTotalFeeDivs = document.getElementById("updatecourseTotalFeeDivs");
            if (updateselectedSemesterOptions === "Semesters Wise") {
                updatesemesterDivs.style.display = "block";
            } else {
                updatesemesterDivs.style.cssText = "display: none !important;";
            }
            if (updateselectedSemesterOptions === "Years Wise") {
                updateyearsFeesDivs.style.display = "block";
            } else {
                updateyearsFeesDivs.style.cssText = "display: none !important;";
            }
            if (updateselectedSemesterOptions === "One Time") {
                updateoneTimeFeesDivs.style.display = "block";
            } else {
                updateoneTimeFeesDivs.style.cssText = "display: none !important;";
            }
        };
        // Add All Semester Fee
        $(document).on('keyup', '[name="updatecourse_semester_fees[]"]', function() {
            var total = 0;

            $('[name="updatecourse_semester_fees[]"]').each(function() {
                var fee = parseFloat($(this).val());
                if (!isNaN(fee)) {
                    total += fee;
                }
            });

            $('[name="courses_total_fees"]').val(total.toFixed(2));
        });

        // Add All Years Fee
        $(document).on('keyup', '[name="updatecourse_years_fees[]"]', function() {
            var total = 0;

            $('[name="updatecourse_years_fees[]"]').each(function() {
                var fee = parseFloat($(this).val());
                if (!isNaN(fee)) {
                    total += fee;
                }
            });

            $('[name="courses_total_fees"]').val(total.toFixed(2));
        });

        // Add One Time Fee
        $(document).on('keyup', '[name="updatecourse_one_time_fees[]"]', function() {
            var total = 0;

            $('[name="updatecourse_one_time_fees[]"]').each(function() {
                var fee = parseFloat($(this).val());
                if (!isNaN(fee)) {
                    total += fee;
                }
            });

            $('[name="courses_total_fees"]').val(total.toFixed(2));
        });
        //Add Multiple Semester
        $(document).ready(function() {
            $(".updateadd_semesters_name_btn").click(function(e) {
                e.preventDefault();
                $("#updateAddMoreSemesters").append(` <div class="row" id="updateAddMoreSemesters">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Semester Name <?php echo $req; ?></label>
                              <select name="updatecourse_semester_names[]" class="form-control form-control-sm">
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
                              <label>Semester Fee <?php echo $req; ?></label>
                              <input type="number" name="updatecourse_semester_fees[]" class="form-control form-control-sm" placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger   updateremove_semesters_name_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>

                        </div>`);
            });
            $(document).on('click', '.updateremove_semesters_name_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
            //Add Multiple Years
            $(".updateadd_more_year_btn").click(function(e) {
                e.preventDefault();
                $("#updateAddMoreYear").append(` <div class="row" id="updateAddMoreYear">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year Name <?php echo $req; ?></label>
                              <select name="updatecourse_years_names[]" class="form-control form-control-sm">
                              <option value="">choose year</option>
                              <option value="1">First Years</option>
                                <option value="2">Second Years</option>
                                <option value="3">Third Years</option>
                                <option value="4">Fourth Years</option>
                                <option value="5">Fifth Years</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 0.3125rem;">
                              <label>Year Fee <?php echo $req; ?></label>
                              <input type="number" name="updatecourse_years_fees[]" class="form-control form-control-sm" placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  updateremove_more_year_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>
                        </div>`);
            });
            $(document).on('click', '.updateremove_more_year_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });

        });
    </script>
    <script>
        function updateUniversityCourseDetails() {
            var courseDetailsData = {
                universityId: "<?= $UniversitId ?>",
                universitySessionId: "<?= $CourseSessionYearId ?>",
                universityCourseId: "<?= $CourseId ?>",
                universityCourseSpecilizationId: "<?= $CourseSpecilizationId ?>",
                univ_session_name: $("input[name='univ_session_name']").val(),
                univ_course_name: $("input[name='univ_course_name']").val(),
                univ_course_type: $("select[name='univ_course_type']").val(),
                univ_course_total_semester: $("input[name='univ_course_total_semester']").val(),
                univ_course_total_year: $("input[name='univ_course_total_year']").val(),
                univ_course_specialization_name: $("input[name='univ_course_specialization_name']").val(),
                //Course Fees
                feesModeSemester: $("select[name='tuition_fees_semester_mode']").val(),
                feesModeYear: $("select[name='tuition_fees_year_mode']").val(),
                feesModeOneTime: $("select[name='tuition_fees_oneTime_mode']").val(),
                //specilization Fees Id
                UnivCourseSpecSemFeeId: $("input[name='UnivCourseSpecSemFeeId']").val(),
                UnivCourseSpecYrFeeId: $("input[name='UnivCourseSpecYrFeeId']").val(),
                UnivCourseSpecOneTimeFeeId: $("input[name='UnivCourseSpecOneTimeFeeId']").val(),

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
                //Custome Fees
                feesModeSemestercustom: $("select[name='custom_fees_semester_mode']").val(),
                feesModeYearcustom: $("select[name='custom_fees_year_mode']").val(),
                feesModeOneTimecustom: $("select[name='custom_one_time_fees_mode']").val(),

                //specilization Fees Id
                UnivCourseSpecCustomSemFeeId: $("input[name='UnivCourseSpecCustomSemFeeId']").val(),
                UnivCourseSpecCustomYrFeeId: $("input[name='UnivCourseSpecCustomYrFeeId']").val(),
                UnivCourseSpecCustomOneTimeFeeId: $("input[name='UnivCourseSpecCustomOneTimeFeeId']").val(),

                semesterNamecustom: $("select[name='custom_fees_semester_name[]']").map(function() {
                    return this.value;
                }).get(),
                semesterFeecustom: $("input[name='custom_fees_course_semester_fee[]']").map(function() {
                    return this.value;
                }).get(),
                yearNamecustom: $("select[name='custom_course_years_name[]']").map(function() {
                    return this.value;
                }).get(),
                yearFeescustom: $("input[name='custom_course_years_fee[]']").map(function() {
                    return this.value;
                }).get(),
                oneTimeNamecustom: $("select[name='custom_course_total_years_name[]']").map(function() {
                    return this.value;
                }).get(),
                oneTimeFeescustom: $("input[name='custom_course_one_time_fee[]']").map(function() {
                    return this.value;
                }).get(),

            };
            // Add the button name and value to the courseDetailsData object
            courseDetailsData.updateCoursesData = "UpdateCourseUpdateData";
            $.ajax({
                url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
                type: "POST",
                data: JSON.stringify(courseDetailsData),
                contentType: "application/json",
                success: function(response) {

                    var responseData = JSON.parse(response);
                    if (responseData.status === "Success") {
                        Swal.fire(
                            '',
                            'Course Deatils  Successfully Updated',
                            'success'
                        )
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
        }
    </script>


</body>

</html>