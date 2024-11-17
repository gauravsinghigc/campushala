<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "University Details";
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
    $UniversitId = $_GET['id'];
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
                                        <div class="col-sm-12 col-12">
                                            <h3 class="app-heading"><?php echo $PageName; ?></h3>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">
                                                <?php FormPrimaryInputs(true); ?>
                                                <?php $fetchCourseData = FETCH_DB_TABLE("SELECT * FROM universities_primary_details AS upd INNER JOIN 	universities_billing_address AS uba ON upd.university_id=uba.university_id  WHERE 	upd.university_id='$UniversitId' AND upd.university_status='1'", true);
                                                if (isset($fetchCourseData)) {
                                                    foreach ($fetchCourseData as $val) {
                                                ?>
                                                        <div class="col-md-12">
                                                            <div class="card student-card mx-auto">
                                                                <div class="tab">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="card-header custom-card-header">
                                                                                University Primary Details
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="card-header custom-card-header">
                                                                                University Billing Address Details
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 form-group">
                                                                                        <label>University Name <?php echo $req; ?></label>
                                                                                        <input readonly type="text" name="university_name" class="form-control" value="<?= $val->university_name ?>" placeholder="University of Allahabad">
                                                                                    </div>
                                                                                    <div class='col-md-6 form-group'>
                                                                                        <label>Phone Number <?php echo $req; ?></label>
                                                                                        <input readonly type="tel" placeholder="without +91" id="PhoneNumber" value="<?= $val->university_phone_no ?>" name="university_phone_no" class="form-control">
                                                                                    </div>
                                                                                    <div class='col-md-6 form-group'>
                                                                                        <label>Email-ID <?php echo $req; ?></label>
                                                                                        <input readonly type="email" id="EmailId" name="university_email_id" value="<?= $val->university_email_id ?>" class="form-control" placeholder="university@gmail.com">
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                    <?php }
                                                            } ?>

                                                                    <div class="col-md-8">
                                                                        <div class="row">
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Billing Email-ID <?php echo $req; ?></label>
                                                                                <input readonly type="email" id="EmailId" name="university_emails_id" class="form-control" value="<?= $val->university_emails_id ?>" placeholder="university@gmail.com">
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Billing GST No</label>
                                                                                <input readonly type="text" name="university_gst" class="form-control" value="<?= $val->university_gst ?>" placeholder="18AABCU9603R1ZM">
                                                                            </div>
                                                                            <div class="col-md-12 form-group">
                                                                                <label>Address </label>
                                                                                <textarea readonly name="univ_reg_address" class="form-control"><?= $val->univ_reg_address ?></textarea>
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Sector/Area Locality </label>
                                                                                <input readonly type="text" name="univ_reg_sector" class="form-control" value="<?= $val->univ_reg_sector ?>">
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Landmark </label>
                                                                                <input readonly type="text" name="univ_reg_landmark" class="form-control" value="<?= $val->univ_reg_landmark ?>">
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>City <?php echo $req; ?></label>
                                                                                <input readonly type="text" name="univ_reg_city" class="form-control" value="<?= $val->univ_reg_city ?>">
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>State <?php echo $req; ?></label>
                                                                                <input readonly type="text" name="univ_reg_state" class="form-control" value="<?= $val->univ_reg_state ?>">
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Country <?php echo $req; ?></label>
                                                                                <select readonly name="univ_reg_country" class="form-control" value="<?= $val->univ_reg_country ?>">
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
                                                                                <input readonly type="text" name="univ_reg_pincode" class="form-control" value="<?= $val->univ_reg_pincode ?>">
                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="card-header custom-card-header">
                                                                                    University Courses Details
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-2">
                                                                                        <div class="card card-height">
                                                                                            <h5 class="mb-2 text-center">
                                                                                                <span class="text-secondary small">Course Session Years</span>
                                                                                            </h5>
                                                                                            <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                                                                <?php $sessions = FETCH_DB_TABLE("SELECT * FROM universities_session_years WHERE university_id='$UniversitId' ORDER BY univ_session_id DESC", true);
                                                                                                if (!empty($sessions)) {
                                                                                                    $firstSession = true;
                                                                                                    foreach ($sessions as $session) {
                                                                                                        $isActive = $firstSession ? 'active' : '';
                                                                                                        echo '<a class="nav-link session-nav mb-1 ' . $isActive . '" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" data-sessionid="' . $session->univ_session_id . ' " style="font-weight: 900;">' . $session->univ_session_name . '</a>';
                                                                                                        $firstSession = false;
                                                                                                    }
                                                                                                } else {
                                                                                                    echo '<div class="card shadow p-3 bg-white rounded specilization-card " style="margin-bottom:4px !important; cursor: pointer;" ><span class="text-center text-danger" style="font-weight: 900;">No Data Found</span></div>';
                                                                                                }  ?>
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    <div class="col-md-10">

                                                                                        <div class="tab-content" id="v-pills-tabContent">
                                                                                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                                                                <div class="card card-height">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-4">
                                                                                                            <div class="card">
                                                                                                                <h5 class="mb-2 text-center">
                                                                                                                    <span class="text-secondary small">Courses</span>
                                                                                                                </h5>
                                                                                                                <div class="p-2" id="allCourses">

                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-4">
                                                                                                            <div class="card">
                                                                                                                <h5 class="mb-2 text-center">
                                                                                                                    <span class="text-secondary small">Speclization</span>
                                                                                                                </h5>
                                                                                                                <div class="p-2" id="coursesAllSpecilization">

                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                        <div class="col-md-4">
                                                                                                            <div class="card">
                                                                                                                <h5 class="mb-2 text-center">
                                                                                                                    <span class="text-secondary small">Fees</span>
                                                                                                                </h5>
                                                                                                                <div class="p-2" id="specilizationFees">

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
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12 d-flex justify-content-between btn">
                                                                <a href="index.php" class="btn btn-sm btn-default cancel">Back</a>

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
            // Handle click event for navigation links
            $(".nav-link").click(function() {
                $(".nav-link.active").removeClass("active");
                $(this).addClass("active");
            });

            // Handle click event for courses-card elements
            $(document).on("click", ".courses-card", function(e) {
                $(".courses-card.active").removeClass("active");
                $(this).addClass("active");
            });
            // Handle click event for courses-specilization-card elements
            $(document).on("click", ".specilization-card", function(e) {
                $(".specilization-card.active").removeClass("active");
                $(this).addClass("active");
            });


        });

        $(document).ready(function() {

            //List All University Session Courses And Their Details
            function coursesDetails(universityId, sessionId) {
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/UniversityAjaxController.php",
                    data: {
                        universityId: universityId,
                        sessionId: sessionId,
                        coursesViewDetailsBtn: "submit",
                    },
                    success: function(response) {
                        $("#allCourses").html(response);
                    }
                });
            }
            //List All University Session Courses spaeclization
            function specilizationDetails(universityId, sessionId, courseId) {
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/UniversityAjaxController.php",
                    data: {
                        universityId: universityId,
                        sessionId: sessionId,
                        courseId: courseId,
                        specilizationViewDetailsBtn: "submit",
                    },
                    success: function(response) {
                        $("#coursesAllSpecilization").html(response);
                    }
                });
            }
            //List All University Session Courses specilization Fees Type (Course Fees / Tutition Fees)
            function specilizationFeeDetails(universityId, sessionId, courseId, specilizationId) {
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/UniversityAjaxController.php",
                    data: {
                        universityId: universityId,
                        sessionId: sessionId,
                        courseId: courseId,
                        specilizationId: specilizationId,
                        specilizationFeesViewDetailsBtn: "submit",
                    },
                    success: function(response) {
                        $("#specilizationFees").html(response);
                    }
                });
            }
            //List All University Session Courses specilization Fees Details
            function specilizationFeeTypeDetails(universityId, sessionId, courseId, specilizationId, courseFeesType) {
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/UniversityAjaxController.php",
                    data: {
                        universityId: universityId,
                        sessionId: sessionId,
                        courseId: courseId,
                        specilizationId: specilizationId,
                        courseFeesType: courseFeesType,
                        specilizationFeesTypeViewDetailsBtn: "submit",
                    },
                    success: function(response) {
                        $("#courseFeesTypeDetails").html(response);
                    }
                });
            }

            //On Window Load Show first selected session courses,specilization and fees details
            $(window).on("load", function(e) {
                e.preventDefault();
                // Load Course Details
                var universityId = <?= $UniversitId ?>;
                var sessionId = $(".session-nav").data("sessionid");
                coursesDetails(universityId, sessionId);
            })
            $(window).on("load", function(e) {
                e.preventDefault();
                setTimeout(function() {
                    //Load Selected Course Specilization
                    var universityId = <?= $UniversitId ?>;
                    var sessionId = $(".courses-card").data("sessionid");
                    var courseId = $(".courses-card").data("courseid");
                    specilizationDetails(universityId, sessionId, courseId);
                }, 400)
            })
            $(window).on("load", function(e) {
                e.preventDefault();
                setTimeout(function() {
                    var universityId = <?= $UniversitId ?>;
                    var sessionId = $(".specilization-card").data("sessionid");
                    var courseId = $(".specilization-card").data("courseid");
                    var specilizationId = $(".specilization-card").data("specilizationid");
                    specilizationFeeDetails(universityId, sessionId, courseId, specilizationId);
                }, 600)
            })
            $(window).on("load", function(e) {
                e.preventDefault();
                setTimeout(function() {
                    // Define the first element with the class ".course-fee-btn"
                    var $firstCourseFeeBtn = $(".course-fee-btn:first");
                    // Trigger the click event on the first element
                    $firstCourseFeeBtn.trigger("click");

                    // Handle the first click event
                    var universityId = <?= $UniversitId ?>;
                    var sessionId = $(".course-fee-btn").data("sessionid");
                    var courseId = $(".course-fee-btn").data("courseid");
                    var specilizationId = $(".specilization-card").data("specilizationid");
                    var courseFeesType = $(".course-fee-btn").data("coursetype");
                    specilizationFeeTypeDetails(universityId, sessionId, courseId, specilizationId, courseFeesType);


                    // Add the "active" class to the first element
                    $firstCourseFeeBtn.addClass("active");

                }, 1000)
            })
            //End Here
            //On Click Session To Show All Courses And Their Details.
            $(".session-nav").on("click", function(e) {
                e.preventDefault();
                var universityId = <?= $UniversitId ?>;
                var sessionId = $(this).data("sessionid");
                coursesDetails(universityId, sessionId);
            });
            //On Click University Course List All Specilization.
            $(document).on("click", ".courses-card", function(e) {
                e.preventDefault();
                var universityId = <?= $UniversitId ?>;
                var sessionId = $(this).data("sessionid");
                var courseId = $(this).data("courseid");
                specilizationDetails(universityId, sessionId, courseId);
            })
            //On Click  University Session Courses Specilization Fees Type.
            $(document).on("click", ".specilization-card", function(e) {
                e.preventDefault();
                var universityId = <?= $UniversitId ?>;
                var sessionId = $(this).data("sessionid");
                var courseId = $(this).data("courseid");
                var specilizationId = $(this).data("specilizationid");
                specilizationFeeDetails(universityId, sessionId, courseId, specilizationId);
            })
            // On Click Speclization Fees Type List All Fees Details.
            $(document).on("click", ".course-fee-btn", function(e) {
                e.preventDefault();
                // Handle the first click event
                var universityId = <?= $UniversitId ?>;
                var sessionId = $(this).data("sessionid");
                var courseId = $(this).data("courseid");
                var specilizationId = $(".specilization-card").data("specilizationid");
                var courseFeesType = $(this).data("coursetype");
                specilizationFeeTypeDetails(universityId, sessionId, courseId, specilizationId, courseFeesType);

                // Handle the second click event
                $(".course-fee-btn.active").removeClass("active");
                $(this).addClass("active");
            });

        })
    </script>
</body>

</html>