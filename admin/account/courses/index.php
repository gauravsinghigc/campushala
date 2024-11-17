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
                                            <h3 class="app-heading">All <?php echo $PageName; ?></h3>
                                        </div>
                                        <div class="col-sm-7 col-12 text-right">
                                            <a href="#" onclick="Databar('AddNewCourses')" class="btn btn-sm btn-dark m-1">Add courses</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <section class="section account-dashboard">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <?php $AllCourses = FETCH("SELECT COUNT(course_id) AS TotalCourse FROM courses ", "TotalCourse");
                                                            ?>
                                                            <div class="col-xxl-3 col-md-4">
                                                                <div class="card info-card sales-card">
                                                                    <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                            <li class="dropdown-header text-start">
                                                                                <h6>Filter</h6>
                                                                            </li>
                                                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="card-body account-card-body">
                                                                        <h5 class="card-title">All <?php echo $PageName; ?> <span>| Today</span></h5>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class='bx bxs-book-reader' style='color:#006df9'></i></div>
                                                                            <div class="ps-3">
                                                                                <h6> <?= $AllCourses ?></h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php $AllActiveCourses = FETCH("SELECT COUNT(course_id) AS TotalActiveCourse FROM courses WHERE course_status='1'", "TotalActiveCourse");
                                                            ?>
                                                            <div class="col-xxl-3 col-md-4">
                                                                <div class="card info-card sales-card">
                                                                    <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                            <li class="dropdown-header text-start">
                                                                                <h6>Filter</h6>
                                                                            </li>
                                                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="card-body account-card-body">
                                                                        <h5 class="card-title">Active <?php echo $PageName; ?> <span>| Today</span></h5>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class='bx bxs-bulb' style='color:#1cf807'></i></div>
                                                                            <div class="ps-3">
                                                                                <h6><?= $AllActiveCourses ?></h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php $AllInactiveCourses = FETCH("SELECT COUNT(course_id) AS TotalInactiveCourse FROM courses WHERE course_status='0'", "TotalInactiveCourse");
                                                            ?>
                                                            <div class="col-xxl-3 col-md-4">
                                                                <div class="card info-card revenue-card">
                                                                    <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                                            <li class="dropdown-header text-start">
                                                                                <h6>Filter</h6>
                                                                            </li>
                                                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="card-body account-card-body">
                                                                        <h5 class="card-title">Inactive <?php echo $PageName; ?> <span>| Today</span></h5>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class='bx bxs-bulb bx-rotate-180' style='color:#ff0004'></i></div>
                                                                            <div class="ps-3">
                                                                                <h6><?= $AllInactiveCourses ?></h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                            <section class="section">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-body pt-4">
                                                                <table class="table datatable mt-3" id="studentsdatatable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">S.No.</th>
                                                                            <th scope="col">Course Name</th>
                                                                            <th scope="col">Specialization</th>
                                                                            <th scope="col">Course Type</th>
                                                                            <th scope="col">Session Year</th>
                                                                            <th scope="col">Duration</th>
                                                                            <th scope="col">Fees Mode</th>
                                                                            <th scope="col">Total Fee</th>
                                                                            <th scope="col">Status</th>
                                                                            <th scope="col">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $FetchData = FETCH_DB_TABLE("SELECT * FROM courses", true);
                                                                        if (isset($FetchData)) {
                                                                            foreach ($FetchData as $value) {
                                                                                if ($value->course_status == "1") {
                                                                                    $Status = "Active";
                                                                                    $StatusClass = "success";
                                                                                } else {
                                                                                    $Status = "Inactive";
                                                                                    $StatusClass = "danger";
                                                                                }
                                                                        ?>
                                                                                <tr>
                                                                                    <td><?= $value->course_id ?></td>
                                                                                    <td>
                                                                                        <a href="details/"><?= $value->course_name ?></a>
                                                                                    </td>
                                                                                    <td><?= $value->course_specialization ?></td>
                                                                                    <td><?= $value->course_type ?></td>
                                                                                    <td><?= $value->course_session_year ?></td>
                                                                                    <td><?= $value->course_total_years . " Yrs" ?></td>
                                                                                    <td><?= $value->fees_mode ?></td>
                                                                                    <td><?= $value->course_total_fees ?></td>

                                                                                    <td><button type="button" class="btn btn-<?= $StatusClass ?>" style="padding:0.09rem 0.3rem"><?= $Status ?></button></td>
                                                                                    <td>

                                                                                        <a href="#" onclick="Databar('view_course_<?= $value->course_id ?>')" class="text-info"><i class='bi bi-eye-fill'></i></a>
                                                                                        <a href="edit.php?eid=<?= SECURE($value->course_id, 'e') ?>" class="text-primary"><i class='bi bi-pencil-fill'></i></a>

                                                                                    </td>
                                                                                </tr>
                                                                        <?php
                                                                                include $Dir . "//include/sections/View-Courses-Details.php";
                                                                            }
                                                                        } ?>
                                                                    </tbody>
                                                                </table>
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
        include $Dir . "//include/sections/Add-New-Courses.php";

        include $Dir . "/include/admin/footer.php"; ?>
    </div>

    <?php include $Dir . "/include/admin/footer_files.php"; ?>
    <script>
        $(document).ready(function() {
            $.noConflict();
            var table = $('#studentsdatatable').DataTable();
        });
    </script>

</body>

</html>