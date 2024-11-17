<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Update Universities Details";
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
    $UniversitId = $_GET['eid'];
} else {
    $UniversitId = "";
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
                                            <a href="#" onclick="Databar('add_new_session_<?php echo $UniversitId; ?>')" class="btn btn-sm btn-dark m-1">Add Session</a>
                                            <a href="#" onclick="Databar('add_new_courses_<?php echo $UniversitId; ?>')" class="btn btn-sm btn-dark m-1">Add Courses</a>
                                            <a href="#" onclick="Databar('add_new_courses_specilization_<?php echo $UniversitId; ?>')" class="btn btn-sm btn-dark m-1">Add Specialization</a>
                                            <a href="#" onclick="Databar('add_new_courses_specilization_fees_<?php echo $UniversitId; ?>')" class="btn btn-sm btn-dark m-1">Add Fees</a>
                                        </div>
                                    </div>
                                    <form action="<?php echo CONTROLLER; ?>/UniversitySimpleController.php" method="POST">
                                        <?php FormPrimaryInputs(true, [
                                            "UniversityId" => $UniversitId,
                                        ]); ?>
                                        <div class="card student-card mx-auto">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <ul class="nav nav-tabs shadow p-2 mb-3 w-100 bg-body rounded" id="myTab" role="tablist">
                                                        <li class="nav-item mr-2" role="presentation">
                                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Primary Info</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Courses</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="row m-0">
                                                    <div class="tab-content" id="myTabContent">
                                                        <?php $fetchCourseData = FETCH_DB_TABLE("SELECT * FROM universities_primary_details AS upd INNER JOIN 	universities_billing_address AS uba ON upd.university_id=uba.university_id  WHERE 	upd.university_id='$UniversitId' AND upd.university_status='1'", true);
                                                        if (isset($fetchCourseData)) {
                                                            foreach ($fetchCourseData as $val) { ?>
                                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <h5 class="">University Primary Details</h5>
                                                                            <div class="row">
                                                                                <div class="col-md-6 form-group">
                                                                                    <label>University Name <?php echo $req; ?></label>
                                                                                    <input type="text" name="university_name" value="<?php if (!empty($val->university_name)) {
                                                                                                                                            echo $val->university_name;
                                                                                                                                        } ?>" class="form-control" required="" placeholder="University of Allahabad">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Phone Number <?php echo $req; ?></label>
                                                                                    <input type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" name="university_phone_no" value="<?php if (!empty($val->university_phone_no)) {
                                                                                                                                                                                                                                echo $val->university_phone_no;
                                                                                                                                                                                                                            } ?>" class="form-control" required="">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Email-ID <?php echo $req; ?></label>
                                                                                    <input type="email" id="EmailId" name="university_email_id" value="<?php if (!empty($val->university_email_id)) {
                                                                                                                                                            echo $val->university_email_id;
                                                                                                                                                        } ?>" class="form-control" required placeholder="university@gmail.com">
                                                                                </div>


                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <h5 class="">University Billing Address Details</h5>
                                                                            <div class="row">
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Billing EmailId </label>
                                                                                    <input type="text" name="university_emails_id" value="<?php if (!empty($val->university_emails_id)) {
                                                                                                                                                echo $val->university_emails_id;
                                                                                                                                            } ?>" class="form-control">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Billing GST No </label>
                                                                                    <input type="text" name="university_gst" value="<?php if (!empty($val->university_gst)) {
                                                                                                                                        echo $val->university_gst;
                                                                                                                                    } ?>" class="form-control" placeholder="18AABCU9603R1ZM">
                                                                                </div>
                                                                                <div class="col-md-12 form-group">
                                                                                    <label>Address </label>
                                                                                    <textarea name="univ_reg_address" class="form-control" rows="2"><?php if (!empty($val->univ_reg_address)) {
                                                                                                                                                        echo $val->univ_reg_address;
                                                                                                                                                    } ?></textarea>
                                                                                </div>
                                                                                <div class='col-md-7 form-group'>
                                                                                    <label>Sector/Area Locality </label>
                                                                                    <input type="text" name="univ_reg_sector" value="<?php if (!empty($val->univ_reg_sector)) {
                                                                                                                                            echo $val->univ_reg_sector;
                                                                                                                                        } ?>" class="form-control">
                                                                                </div>
                                                                                <div class='col-md-5 form-group'>
                                                                                    <label>Landmark </label>
                                                                                    <input type="text" name="univ_reg_landmark" value="<?php if (!empty($val->univ_reg_landmark)) {
                                                                                                                                            echo $val->univ_reg_landmark;
                                                                                                                                        } ?>" class="form-control">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>City <?php echo $req; ?></label>
                                                                                    <input type="text" name="univ_reg_city" value="<?php if (!empty($val->univ_reg_city)) {
                                                                                                                                        echo $val->univ_reg_city;
                                                                                                                                    } ?>" class="form-control" required="">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>State <?php echo $req; ?></label>
                                                                                    <input type="text" name="univ_reg_state" value="<?php if (!empty($val->univ_reg_state)) {
                                                                                                                                        echo $val->univ_reg_state;
                                                                                                                                    } ?>" class="form-control" required="">
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Country <?php echo $req; ?></label>
                                                                                    <select name="univ_reg_country" class="form-control" required="">
                                                                                        <?php foreach (AllCountryList() as $value) {
                                                                                            if ($value == $val->univ_reg_country) {
                                                                                                $Selected = "selected";
                                                                                            } else {
                                                                                                $Selected = "";
                                                                                            } ?>
                                                                                            <option value="<?= $value ?>" <?= $Selected ?>><?= $value ?></option>
                                                                                        <?php }  ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div class='col-md-6 form-group'>
                                                                                    <label>Pincode </label>
                                                                                    <input type="text" name="univ_reg_pincode" class="form-control" value="<?php if (!empty($val->univ_reg_pincode)) {
                                                                                                                                                                echo $val->univ_reg_pincode;
                                                                                                                                                            } ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-end">
                                                                        <div class="col-md-2 form-group">
                                                                            <button type="button " class="btn btn-info form-control" name="updateUniversityPrimaryDetails" value="UpdatePrimaryDetails">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php }
                                                        } ?>
                                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                            <div class="row" id="addNew">
                                                                <!-- <input type="text" value="<?= $val->univ_course_id; ?>" name="univ_course_id[]"> -->
                                                                <div class="col-md-4 form-group">
                                                                    <label>Course Session Years</label>
                                                                    <select class="form-control" name="univ_course_session_year[]" id="UniversityCoursesSessionsYears" style="width: 100%;" required="" data-ids="<?= $val->univ_course_id ?>">
                                                                        <!-- <option>choose session year</option> -->
                                                                        <?php $FetchSession = FETCH_DB_TABLE("SELECT univ_session_id,univ_session_name FROM universities_session_years WHERE university_id='$UniversitId' AND univ_session_status='1'", true);
                                                                        if (isset($FetchSession)) {
                                                                            foreach ($FetchSession as $value) {
                                                                                echo '<option value="' . $value->univ_session_id . '" data-id="' . $value->univ_session_id . '">' . $value->univ_session_name . '</option>';
                                                                            }
                                                                        } ?>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-4 form-group">
                                                                    <label>Courses Name (Available)</label>
                                                                    <select class="form-control" name="univ_course_name" id="UniversitysCoursesNames" style="width: 100%;" required="" data-coursenameid="<?= $val->univ_course_id ?>">

                                                                    </select>
                                                                </div>

                                                                <div class="col-md-4 form-group">
                                                                    <label>Course Specialization</label>
                                                                    <select class="form-control  " name="univ_course_specialization" id="UniversitysCoursesSpecializations" style="width: 100%;" required="">

                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4 form-group">
                                                                    <label>Course Type</label>
                                                                    <input type="text" name="univ_course_type" class="form-control">
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <label>Total Semesters</label>
                                                                    <input type="text" name="univ_course_total_semester" class="form-control">
                                                                </div>
                                                                <div class="col-md-3 form-group">
                                                                    <label>Total Years</label>
                                                                    <input type="text" name="univ_course_total_years" class="form-control">
                                                                </div>

                                                                <div class="col-md-2 form-group text-center">
                                                                    <button type="button" class="btn btn-info w-100 mt-4" onclick="getUpdateURL()">Edit Details</button>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="p-2 mt-3 shadow-sm" id="coursesSpecilizationDetailsCard">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php
        include $Dir . "//include/sections/Add-New-Session.php";
        include $Dir . "//include/sections/Add-New-Courses.php";
        include $Dir . "//include/sections/Add-New-CoursesSpecilization.php";
        // include $Dir . "//include/sections/Update-Courses-Details.php";
        include $Dir . "//include/sections/Add-New-CoursesSpecilizationFees.php";
        include $Dir . "/include/admin/footer.php"; ?>
    </div>

    <?php include $Dir . "/include/admin/footer_files.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $("#UniversityCoursesSessionsYears").select2({

        });
        $("#UniversityCoursesNames").select2({

        })
        $("#UniversityCourseSpecialization").select2({

        })
        //Fetch University Course By session
        $(window).on('load', function() {
            let sessionUniversityId = $("#UniversityCoursesSessionsYears").val();
            var universityId = <?= $UniversitId ?>;
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/UniversityController.php",
                data: {
                    sessionUniversityId: sessionUniversityId,
                    universityId: universityId,
                    sessionSubmitBtn: "submitData",
                },
                success: function(response) {
                    $("#UniversitysCoursesNames").html(response);
                }
            });
        });
        $("#UniversityCoursesSessionsYears").on("change", function(e) {
            e.preventDefault();
            let sessionUniversityId = $(this).val();
            var universityId = <?= $UniversitId ?>;
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/UniversityController.php",
                data: {
                    universityId: universityId,
                    sessionUniversityId: sessionUniversityId,
                    sessionSubmitBtnOnChange: "submitData",
                },
                success: function(response) {
                    $("#UniversitysCoursesNames").html(response);
                }
            });
        })
        //Fetch Course Specilization
        $(window).on('load', function() {
            setTimeout(function() {
                let universityCoursesId = $("#UniversitysCoursesNames").val();
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/UniversityController.php",
                    data: {
                        universityCoursesId: universityCoursesId,
                        coursesSubmitBtn: "submitData",
                    },
                    success: function(response) {

                        $("#UniversitysCoursesSpecializations").html(response);
                    }
                })
            }, 300);

        })
        $("#UniversitysCoursesNames").on("change", function(e) {
            e.preventDefault();
            let universityCoursesId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/UniversityController.php",
                data: {
                    universityCoursesId: universityCoursesId,
                    coursesSubmitBtnOnChange: "submitData",
                },
                success: function(response) {

                    $("#UniversitysCoursesSpecializations").html(response);
                }
            })
        })
        //Fetch More Details of course
        $(window).on('load', function() {
            setTimeout(function() {
                let universityCoursesId = $("#UniversitysCoursesNames").val();
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/UniversityController.php",
                    data: {
                        universityCoursesId: universityCoursesId,
                        coursesTypeSubmitBtn: "submitData",
                    },
                    success: function(response) {
                        // Parse the response JSON object
                        var courseData = JSON.parse(response);
                        // Set the values in the respective input fields
                        $('input[name="univ_course_type"]').val(courseData.courseType);
                        $('input[name="univ_course_total_semester"]').val(courseData.totalSemesters);
                        $('input[name="univ_course_total_years"]').val(courseData.totalYears);
                    }
                });
            }, 350);
        });
        $("#UniversitysCoursesNames").on("change", function(e) {
            e.preventDefault();
            let universityCoursesId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/UniversityController.php",
                data: {
                    universityCoursesId: universityCoursesId,
                    coursesTypeSubmitBtnOnChange: "submitData",
                },
                success: function(response) {
                    // Parse the response JSON object
                    var courseData = JSON.parse(response);
                    // Set the values in the respective input fields
                    $('input[name="univ_course_type"]').val(courseData.courseType);
                    $('input[name="univ_course_total_semester"]').val(courseData.totalSemesters);
                    $('input[name="univ_course_total_years"]').val(courseData.totalYears);
                }
            });
        })
        //Fetch Fee Details
        $(window).on('load', function() {
            setTimeout(function() {
                let sessionUniversityId = $("#UniversityCoursesSessionsYears").val();
                var universityId = <?= $UniversitId ?>;
                let universityCoursesSpecilizationId = $("#UniversitysCoursesSpecializations").val();
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/UniversityController.php",
                    data: {
                        sessionUniversityId: sessionUniversityId,
                        universityId: universityId,
                        universityCoursesSpecilizationId: universityCoursesSpecilizationId,
                        coursesSpecilizationDetailsSubmitBtn: "submitData",
                    },
                    success: function(response) {
                        $("#coursesSpecilizationDetailsCard").html(response);
                    }
                });
            }, 400);
        });
        $("#UniversitysCoursesSpecializations").on("change", function(e) {
            e.preventDefault();
            let universityCoursesSpecilizationId = $(this).val();
            let sessionUniversityId = $("#UniversityCoursesSessionsYears").val();
            var universityId = <?= $UniversitId ?>;
            let universityCoursesId = $("#UniversitysCoursesNames").val();
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/UniversityController.php",
                data: {
                    sessionUniversityId: sessionUniversityId,
                    universityId: universityId,
                    universityCoursesId: universityCoursesId,
                    universityCoursesSpecilizationId: universityCoursesSpecilizationId,
                    coursesSpecilizationDetailsSubmitBtnOnChange: "submitData",
                },
                success: function(response) {
                    $("#coursesSpecilizationDetailsCard").html(response);
                }
            });
        })
    </script>
    <script>
        function getUpdateURL() {
            var UniversityId = "<?= SECURE($UniversitId, 'e') ?>";
            var sessionYear = encodeURIComponent($("#UniversityCoursesSessionsYears").val());
            var courseName = encodeURIComponent($("#UniversitysCoursesNames").val());
            var specialization = encodeURIComponent($("#UniversitysCoursesSpecializations").val());
           
            var updateURL = "update.php?uid=" + UniversityId + "&ucsy=" + sessionYear + "&ucn=" + courseName + "&ucs=" + specialization;

            // Redirect to the update page with the constructed URL
            window.location.href = updateURL;
        }
    </script>
</body>

</html>