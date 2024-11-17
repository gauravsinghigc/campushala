<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Users/BDEs";
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
                                            <a href="#" onclick="Databar('AddNewBdes')" class="btn btn-sm btn-dark m-1">Add Users/BDEs</a>
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
                                                                    <?php $AllBdes = FETCH("SELECT COUNT(bdes_id) AS TotalBDE FROM bdes_primary_details ", "TotalBDE");
                                                                    ?>
                                                                    <div class="card-body account-card-body">
                                                                        <h5 class="card-title">All <?php echo $PageName; ?> <span>| Today</span></h5>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bx bxs-school"></i></div>
                                                                            <div class="ps-3">
                                                                                <h6><?= $AllBdes ?></h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
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
                                                                    <?php $AllActiveBdes = FETCH("SELECT COUNT(bdes_id) AS TotalActiveBDE FROM bdes_primary_details WHERE bdes_status='1' ", "TotalActiveBDE");
                                                                    ?>
                                                                    <div class="card-body account-card-body">
                                                                        <h5 class="card-title">Active <?php echo $PageName; ?> <span>| Today</span></h5>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bx bxs-user"></i></div>
                                                                            <div class="ps-3">
                                                                                <h6><?= $AllActiveBdes ?></h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
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
                                                                    <?php $AllInactiveBdes = FETCH("SELECT COUNT(bdes_id) AS TotalInactiveBDE FROM bdes_primary_details WHERE bdes_status='0' ", "TotalInactiveBDE");
                                                                    ?>
                                                                    <div class="card-body account-card-body">
                                                                        <h5 class="card-title">Inactive <?php echo $PageName; ?> <span>| Today</span></h5>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-rupee"></i></div>
                                                                            <div class="ps-3">
                                                                                <h6><?= $AllInactiveBdes ?></h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
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
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control" id="FullName" placeholder="Name">

                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control" id="Phone" placeholder="Phone">

                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control" id="Email" placeholder="Email">

                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control" id="City">
                                                                            <option value="">City</option>
                                                                            <?php
                                                                            $fetchCity = FETCH_DB_TABLE("SELECT DISTINCT bdes_city FROM bdes_primary_details", true);
                                                                            if (isset($fetchCity)) {
                                                                                foreach ($fetchCity as $city) {
                                                                                    echo '<option value="' . $city->bdes_city . '">' . $city->bdes_city . '</option>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control" id="State">
                                                                            <option value="">State</option>
                                                                            <?php
                                                                            $fetchState = FETCH_DB_TABLE("SELECT DISTINCT bdes_state FROM bdes_primary_details", true);
                                                                            if (isset($fetchState)) {
                                                                                foreach ($fetchState as $state) {
                                                                                    echo '<option value="' . $state->bdes_state . '">' . $state->bdes_state . '</option>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <select class="form-control" id="Status">
                                                                            <option value="">Status</option>
                                                                            <option value="1">Active </option>
                                                                            <option value="0">Inactive</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-light dropdown-toggle form-control" type="button" data-toggle="dropdown" aria-expanded="false" style="background-color: #f6f6fe;">
                                                                                <i class="fa-solid fa-sliders"></i> Advanced Filter
                                                                            </button>
                                                                            <div class="dropdown-menu custom-dropdown-menu">
                                                                                <label for="">From</label>
                                                                                <input type="date" class="form-control" id="CreatedFromDate">
                                                                                <label for="">To</label>
                                                                                <input type="date" class="form-control" id="CreatedToDate">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button type="button" class="btn btn-dark form-control" id="ApplyFilters">Apply Filters</button>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button type="button" class="btn btn-dark form-control" id="ResetFilters">Reset Filters</button>
                                                                    </div>
                                                                    <div class="col-md-6 ">
                                                                        <div class="row justify-content-end">
                                                                            <div class="col-md-4">
                                                                                <input type="text" class="form-control" id="UniversalSearch" placeholder="Search...">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="table-data">

                                                                </div>
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
        include $Dir . "//include/sections/Add-New-Bde.php";
        include $Dir . "/include/admin/footer.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </div>

    <?php include $Dir . "/include/admin/footer_files.php"; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var currentPage = 1; // Variable to track the current page
        // Function to fetch and display paginated data using AJAX
        function fetchData(page, filters) {
            $.ajax({
                url: '<?= CONTROLLER ?>/BdesAjaxController.php',
                type: 'POST',
                data: {
                    loadTableData: true,
                    page: page,
                    filters: filters
                },
                success: function(data) {
                    $('#table-data').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        // Function to handle pagination link clicks
        function handlePaginationClick(page) {
            fetchData(page, getFilterCriteria());
        }
        // Attach a click event handler to pagination links
        $(document).on('click', '.pagination-link', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            currentPage = page;
            handlePaginationClick(page);
        });
        // Function to get filter criteria from the form
        function getFilterCriteria() {
            var filters = {
                fullName: $('#FullName').val(),
                phone: $('#Phone').val(),
                email: $('#Email').val(),
                city: $('#City').val(),
                state: $('#State').val(),
                status: $('#Status').val(),
                fromDate: $('#CreatedFromDate').val(),
                toDate: $('#CreatedToDate').val(),
            };
            return filters;
        }
        // Attach a click event handler to the Apply Filters button
        $('#ApplyFilters').on('click', function() {
            fetchData(1, getFilterCriteria()); // Fetch data with filter criteria
        });
        // Attach a click event handler to the Reset Filters button
        $('#ResetFilters').on('click', function() {
            // Clear filter inputs and fetch all data
            $('#FullName').val('');
            $('#Phone').val('');
            $('#Email').val('');
            $('#City').val('');
            $('#State').val('');
            $('#Status').val('');
            $('#CreatedFromDate').val('');
            $('#CreatedToDate').val('');
            fetchData(1, {}); // Fetch all data
        });

        // Attach a click event handler to the status change buttons
        $(document).on("click", ".status-changes-btn", function(e) {
            e.preventDefault();
            const bdeId = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/CommonStatusChangedAjaxController.php",
                data: {
                    bdeId: bdeId,
                    changeBdeStatusBtn: "submit",
                },
                success: function(response) {
                    if (response == "true") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Account Status',
                            text: 'BDE Account Status Successfully Changed',
                        }).then(function() {
                            // Refresh the current page to maintain pagination
                            fetchData(currentPage, getFilterCriteria());
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again later',
                        }).then(function() {
                            // Refresh the current page to maintain pagination
                            fetchData(currentPage, getFilterCriteria());
                        });
                    }
                }
            });
        });

        // Initial fetch of data
        fetchData(1, {});
    </script>
    <script>
        // Add an event listener to the "Search" input field using jQuery
        $(document).on('input', '#UniversalSearch', function() {
            const searchTerm = $(this).val().toLowerCase(); // Get the search term in lowercase

            // Loop through the table rows and hide/display based on search term
            $('#table-data tbody tr').each(function() {
                const rowData = $(this).text().toLowerCase(); // Get row data in lowercase
                if (rowData.includes(searchTerm)) {
                    $(this).show(); // Display matching rows
                } else {
                    $(this).hide(); // Hide non-matching rows
                }
            });
        });
    </script>
    <script>
        // Define a variable to keep track of the sorting order
        let isDescending = false;

        $(document).on('click', '.sort-icon', function() {
            const column = $(this).closest('th').index();
            const $table = $(this).closest('table');
            const $rows = $table.find('tbody > tr').get();

            // Toggle the sorting order
            isDescending = !isDescending;

            // Toggle the active state of the clicked column header
            $table.find('.sort-icon').removeClass('active');
            $(this).addClass('active').toggleClass('asc', !isDescending).toggleClass('desc', isDescending);

            $rows.sort(function(a, b) {
                const keyA = $(a).find('td').eq(column).text().toLowerCase();
                const keyB = $(b).find('td').eq(column).text().toLowerCase();

                if (keyA < keyB) return isDescending ? 1 : -1;
                if (keyA > keyB) return isDescending ? -1 : 1;
                return 0;
            });

            // Reorder the table rows based on the sorted order
            $.each($rows, function(index, row) {
                $table.children('tbody').append(row);
            });
        });
    </script>

</body>

</html>