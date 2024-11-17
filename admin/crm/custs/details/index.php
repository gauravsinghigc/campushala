<?php
$Dir = "../../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//page header
include $Dir . "/admin/crm/custs/details/sections/pageHeader.php";
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
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php
    include $Dir . "/include/admin/loader.php";
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
                  <?php
                  include $Dir . "/admin/crm/custs/details/sections/navbar.php";
                  include $Dir . "/admin/crm/custs/details/sections/profile.php";
                  include $Dir . "/admin/crm/custs/details/sections/pages.php";
                  ?>
                  <div class="row">
                    <div class="col-md-8 dashboard-record">

                      <!-- start main content -->
                      <?php
                      if (isset($_GET['get'])) {
                        $GetViews = $_GET['get'];
                        if ($GetViews == "Registrations") {
                          include $Dir . "/admin/crm/custs/details/views/main.php";
                        } elseif ($GetViews == "Bookings") {
                          include $Dir . "/admin/crm/custs/details/views/bookings.php";
                        } elseif ($GetViews == "Payments") {
                          include $Dir . "/admin/crm/custs/details/views/payments.php";
                        } elseif ($GetViews == "Documents") {
                          include $Dir . "/admin/crm/custs/details/views/documents.php";
                        } elseif ($GetViews == "Refunds") {
                          include $Dir . "/admin/crm/custs/details/views/refunds.php";
                        } elseif ($GetViews == "Cancellation") {
                          include $Dir . "/admin/crm/custs/details/views/cancellations.php";
                        } else {
                          NoData("No Data found!");
                        }
                      } else {
                        include $Dir . "/admin/crm/custs/details/views/main.php";
                      }
                      ?>
                      <!-- end main content -->
                    </div>
                    <?php
                    include $Dir . "/admin/crm/custs/details/sections/right-activity-bar.php";
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php
    include $Dir . "/include/sections/Add-New-Booking-For-Reg-Customers.php";
    include $Dir . "/include/sections/Update-Customer-Address.php";
    include $Dir . "/include/sections/Update-Customer-Info.php";
    include $Dir . "/include/sections/Add-New-Payment-Record.php";
    include $Dir . "/include/sections/Upload-Customer-Documents.php";
    include $Dir . "/include/sections/Send-Notifications.php";
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>