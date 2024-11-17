<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Invoices";
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
                                            <a href="#" onclick="Databar('AddNewInvoices')" class="btn btn-sm btn-dark m-1">Add Invoices</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <section class="section account-dashboard">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="row">
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
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bx bxs-school"></i></div>
                                                                            <div class="ps-3">
                                                                                <h6>145</h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bx bxs-user"></i></div>
                                                                            <div class="ps-3">
                                                                                <h6>145</h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-rupee"></i></div>
                                                                            <div class="ps-3">
                                                                                <h6>145</h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
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
                                                                <table class="table datatable mt-3">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">#</th>
                                                                            <th scope="col">Name</th>
                                                                            <th scope="col">Position</th>
                                                                            <th scope="col">Age</th>
                                                                            <th scope="col">Start Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">1</th>
                                                                            <td>Brandon Jacob</td>
                                                                            <td>Designer</td>
                                                                            <td>28</td>
                                                                            <td>2016-05-25</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">2</th>
                                                                            <td>Bridie Kessler</td>
                                                                            <td>Developer</td>
                                                                            <td>35</td>
                                                                            <td>2014-12-05</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">3</th>
                                                                            <td>Ashleigh Langosh</td>
                                                                            <td>Finance</td>
                                                                            <td>45</td>
                                                                            <td>2011-08-12</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">4</th>
                                                                            <td>Angus Grady</td>
                                                                            <td>HR</td>
                                                                            <td>34</td>
                                                                            <td>2012-06-11</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">5</th>
                                                                            <td>Raheem Lehner</td>
                                                                            <td>Dynamic Division Officer</td>
                                                                            <td>47</td>
                                                                            <td>2011-04-19</td>
                                                                        </tr>
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
        include $Dir . "//include/sections/Add-New-Invoices.php";
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