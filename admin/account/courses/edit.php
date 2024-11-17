<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Courses";
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
    $CourseId = SECURE($_GET['eid'], 'd');
} else {
    $CourseId = "";
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
                                            <h3 class="app-heading">Update Course</h3>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="<?php echo CONTROLLER; ?>/CoursesController.php" method="POST">
                                                <?php FormPrimaryInputs(true, [
                                                    "course_id" => $CourseId,
                                                ]); ?>
                                                <?php $fetchCourse = FETCH_DB_TABLE("SELECT * FROM courses WHERE course_id='$CourseId' AND course_status='1'", true);
                                                if (isset($fetchCourse)) {
                                                    foreach ($fetchCourse as $val) {
                                                        $CourseSpecialization = explode(",", $val->course_specialization);
                                                        $feeModeSemesterWise = explode(",", $val->fee_mode_semester_wise);
                                                        $feeSemesterWise = explode(",", $val->semester_wise_fee);
                                                        $feeModeYearWise = explode(",", $val->fee_mode_year_wise);
                                                        $feeYearWise = explode(",", $val->year_wise_fee);
                                                ?>
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <div class="col-md-12 form-group">
                                                                            <label>Course Name <?php echo $req; ?></label>
                                                                            <input type="text" name="course_name" value="<?php if (!empty($val->course_name)) {
                                                                                                                                echo $val->course_name;
                                                                                                                            } ?>" class="form-control form-control-sm" required="" placeholder="B.tech">
                                                                        </div>
                                                                        <div class='col-md-12 form-group'>
                                                                            <label>Course Specialization <?php echo $req; ?></label><br>
                                                                            <select class="form-control" name="course_specialization[]" multiple="multiple" id="Specialization" style="width: 100%;" required="">
                                                                                <?php if (isset($CourseSpecialization)) {
                                                                                    foreach ($CourseSpecialization as $data) {
                                                                                        echo '<option value="' . $data . '" selected>' . $data . '</option>';
                                                                                    }
                                                                                } ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class='col-md-6 form-group'>
                                                                            <label>Course Type <?php echo $req; ?></label>
                                                                            <select name="course_type" class="form-control form-control-sm" required="">
                                                                                <?php InputOptions(['Graduation', 'Post Graduation', 'Under Graduation'], $val->course_type); ?>
                                                                                <option>Graduation</option>
                                                                                <option>Post Graduation</option>
                                                                                <option>Under Graduation</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class='col-md-6 form-group'>
                                                                            <label>Course Session Year <?php echo $req; ?></label>
                                                                            <input type="text" id="PhoneNumber" name="course_session_year" value="<?php if (!empty($val->course_session_year)) {
                                                                                                                                                        echo $val->course_session_year;
                                                                                                                                                    } ?>" class="form-control form-control-sm" required="" placeholder="Session Year(July,2023)">
                                                                        </div>
                                                                        <div class='col-md-6 form-group'>
                                                                            <label>Total Semester <?php echo $req; ?></label>
                                                                            <input type="number" name="course_total_semester" value="<?php if (!empty($val->course_total_semester)) {
                                                                                                                                            echo $val->course_total_semester;
                                                                                                                                        } ?>" class="form-control form-control-sm" required="" placeholder="8">
                                                                        </div>
                                                                        <div class='col-md-6 form-group'>
                                                                            <label>Total Years <?php echo $req; ?></label>
                                                                            <input type="number" name="course_total_years" value="<?php if (!empty($val->course_total_years)) {
                                                                                                                                        echo $val->course_total_years;
                                                                                                                                    } ?>" class="form-control form-control-sm" required="" placeholder="4">
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="row justify-content-end">
                                                                        <div class='col-md-5 form-group'>
                                                                            <label>Fees Modes <?php echo $req; ?></label>
                                                                            <select name="fees_mode" id="feesModes" class="form-control form-control-sm" onchange="FeesModesFields()" required="">
                                                                                <option value="" selected>Choose Fees Modes</option>
                                                                                <?php InputOptions(['Semesters Wise', 'Years Wise', 'One Time',], $val->fees_mode) ?>

                                                                            </select>
                                                                        </div>

                                                                        <div class='col-md-7 form-group' id="SemestersFees" style="display: none !important;">
                                                                            <?php
                                                                            if (isset($feeModeSemesterWise) && isset($feeSemesterWise)) {

                                                                                foreach ($feeModeSemesterWise as $key => $value) {

                                                                            ?>
                                                                                    <div class="row" id="AddMoreSemester">
                                                                                        <div class="col-md-10 form-group d-flex">
                                                                                            <div class="w-50">
                                                                                                <label>Semester Name <?php echo $req; ?></label>
                                                                                                <select name="course_semester_name[]" class="form-control form-control-sm">
                                                                                                    <option value="">Choose Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "1") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>First Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "2") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Second Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "3") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Third Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "4") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Fourth Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "5") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Fifth Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "6") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Sixth Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "7") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Seventh Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "8") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Eighth Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "9") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Ninth Semester</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "10") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Tenth Semester</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                <label>Semester Fee <?php echo $req; ?></label>
                                                                                                <input type="number" name="course_semester_fee[]" class="form-control form-control-sm" placeholder="10000" value="<?php echo $feeSemesterWise[$key]; ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2 form-group ">
                                                                                            <label></label>
                                                                                            <button class="btn btn-outline-info mt-3 add_semester_name_btn"><i class="bi bi-plus"></i></button>
                                                                                        </div>

                                                                                    </div>
                                                                            <?php
                                                                                }
                                                                            }  ?>
                                                                        </div>
                                                                        <div class='col-md-7 form-group ' id="YearsFees" style="display: none !important;">
                                                                            <?php
                                                                            if (isset($feeModeYearWise) && isset($feeYearWise)) {
                                                                                foreach ($feeModeYearWise as $key => $value) {
                                                                            ?>
                                                                                    <div class="row" id="AddMoreYears">
                                                                                        <div class="col-md-10 form-group d-flex">
                                                                                            <div class="w-50">
                                                                                                <label>Year Name <?php echo $req; ?></label>
                                                                                                <select name="course_years_name[]" class="form-control form-control-sm">
                                                                                                    <option value="">choose year</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "1") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>First Years</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "2") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Second Years</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "3") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Third Years</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "4") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Fourth Years</option>
                                                                                                    <option value="<?= $value ?>" <?php if ($value == "5") {
                                                                                                                                        echo "selected";
                                                                                                                                    } ?>>Fifth Years</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                                <label>Year Fee <?php echo $req; ?></label>
                                                                                                <input type="number" name="course_years_fee[]" class="form-control form-control-sm" placeholder="10000" value="<?php echo $feeYearWise[$key]; ?>">

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2 form-group ">
                                                                                            <label></label>
                                                                                            <button class="btn btn-outline-info mt-3 add_more_years_btn"><i class="bi bi-plus"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                            <?php
                                                                                }
                                                                            }  ?>
                                                                        </div>
                                                                        <div class='col-md-7 form-group ' id="OneTimeFees" style="display: none !important;">
                                                                            <div class="row">
                                                                                <div class="col-md-12 form-group d-flex">
                                                                                    <div class="w-50">
                                                                                        <label>Total Year Fee<?php echo $req; ?></label>
                                                                                        <select name="course_total_years_name" class="form-control form-control-sm">
                                                                                            <option value="">Choose Total Year Fee</option>

                                                                                            <?php InputOptions(['One Time'], $val->fee_mode_one_time) ?>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="w-50" style="padding-left: 0.3125rem;">
                                                                                        <label>One Time Fee<?php echo $req; ?></label>
                                                                                        <input type="number" name="course_one_time_fee" class="form-control form-control-sm" placeholder="10000" value="<?php if (!empty($val->one_time_fee)) {
                                                                                                                                                                                                            echo $val->one_time_fee;
                                                                                                                                                                                                        } ?>">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class='col-md-7 form-group d-flex'>
                                                                            <div class="w-85">
                                                                                <label>Course Total Fees<?php echo $req; ?></label>
                                                                                <input type="text" readonly name="course_total_fees" class="form-control form-control-sm" value="<?php if (!empty($val->course_total_fees)) {
                                                                                                                                                                                        echo $val->course_total_fees;
                                                                                                                                                                                    } ?>">
                                                                            </div>
                                                                            <div style="padding-left: 0.3125rem;">
                                                                                <label></label>
                                                                                <select name="course_fees_type" class="form-control form-control-sm" readonly>
                                                                                    <option value="rs">Rs</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>



                                                            <div class="col-md-12 d-flex justify-content-between btn">

                                                                <button type="submit" name="UpdateCourses" value="SaveData" class="btn btn-sm btn-success next">Update Course Details</button>
                                                            </div>

                                                        </div>
                                                <?php }
                                                } ?>
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
        $("#Specialization").select2({

            placeholder: "Add New Course Specialization",
            tags: true,
        });
        $(window).on('load', function() {
            var feeMode = $("#feesModes").val();
            var SemesterDiv = document.getElementById("SemestersFees");
            var YearsFeesDiv = document.getElementById("YearsFees");
            var OneTimeFeesDiv = document.getElementById("OneTimeFees");

            if (feeMode === "Semesters Wise") {
                SemesterDiv.style.display = "block";
            } else {
                SemesterDiv.style.display = "none";
            }

            if (feeMode === "Years Wise") {
                YearsFeesDiv.style.display = "block";
            } else {
                YearsFeesDiv.style.display = "none";
            }

            if (feeMode === "One Time") {
                OneTimeFeesDiv.style.display = "block";
            } else {
                OneTimeFeesDiv.style.display = "none";
            }
        });

        // Show Semester Fee Fields
        const FeesModesFields = () => {
            const semesterSelect = document.getElementById("feesModes");
            const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
            const SemesterDiv = document.getElementById("SemestersFees");
            const YearsFeesDiv = document.getElementById("YearsFees");
            const OneTimeFeesDiv = document.getElementById("OneTimeFees");
            // const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
            if (selectedSemesterOption === "Semesters Wise") {
                SemesterDiv.style.display = "block";
            } else {
                SemesterDiv.style.cssText = "display: none !important;";
            }
            if (selectedSemesterOption === "Years Wise") {
                YearsFeesDiv.style.display = "block";
            } else {
                YearsFeesDiv.style.cssText = "display: none !important;";
            }
            if (selectedSemesterOption === "One Time") {
                OneTimeFeesDiv.style.display = "block";
            } else {
                OneTimeFeesDiv.style.cssText = "display: none !important;";
            }
        };
        //Add All Semester Fee
        $(document).on('keyup', '[name="course_semester_fee[]"]', function() {
            var total = 0;

            $('[name="course_semester_fee[]"]').each(function() {
                var fee = parseFloat($(this).val());
                if (!isNaN(fee)) {
                    total += fee;
                }
            });

            $('[name="course_total_fees"]').val(total.toFixed(2));
        });
        //Add All Years Fee
        $(document).on('keyup', '[name="course_years_fee[]"]', function() {
            var total = 0;

            $('[name="course_years_fee[]"]').each(function() {
                var fee = parseFloat($(this).val());
                if (!isNaN(fee)) {
                    total += fee;
                }
            });

            $('[name="course_total_fees"]').val(total.toFixed(2));
        });
        //Add One Time  Fee
        $(document).on('keyup', '[name="course_semester_fee[]"], [name="course_one_time_fee"]', function() {
            var total = 0;

            $('[name="course_semester_fee[]"]').each(function() {
                var fee = parseFloat($(this).val());
                if (!isNaN(fee)) {
                    total += fee;
                }
            });

            var oneTimeFee = parseFloat($('[name="course_one_time_fee"]').val());
            if (!isNaN(oneTimeFee)) {
                total += oneTimeFee;
            }

            $('[name="course_total_fees"]').val(total.toFixed(2));
        });
        //Add Multiple Semester 
        $(document).ready(function() {
            $(".add_semester_name_btn").click(function(e) {
                e.preventDefault();
                $("#AddMoreSemester").append(` <div class="row" id="AddMoreSemester">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Semester Name <?php echo $req; ?></label>
                              <select name="course_semester_name[]" class="form-control form-control-sm">
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
                              <input type="number" name="course_semester_fee[]" class="form-control form-control-sm" placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger mt-3 remove_semester_name_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>

                        </div>`);
            });
            $(document).on('click', '.remove_semester_name_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
            //Add Multiple Years
            $(".add_more_years_btn").click(function(e) {
                e.preventDefault();
                $("#AddMoreYears").append(` <div class="row" id="AddMoreYears">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year Name <?php echo $req; ?></label>
                              <select name="course_years_name[]" class="form-control form-control-sm">
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
                              <input type="number" name="course_years_fee[]" class="form-control form-control-sm" placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger mt-3 remove_more_years_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>
                        </div>`);
            });
            $(document).on('click', '.remove_more_years_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });

        });
    </script>
</body>

</html>