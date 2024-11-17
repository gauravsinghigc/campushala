<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Booking Details";
$PageDescription = "Manage all customers";

if (isset($_GET['bid'])) {
  $ViewBookingId = SECURE($_GET['bid'], "d");
  $_SESSION['VIEW_BOOKING_ID'] = $ViewBookingId;
} else {
  $ViewBookingId = $_SESSION['VIEW_BOOKING_ID'];
}

$BookingSql = "SELECT * FROM bookings where bookingId='$ViewBookingId'";
$AllData = FETCH_DB_TABLE($BookingSql, true);
$ChecRefundStatus = CHECK("SELECT * FROM booking_refunds where BookingMainId='$ViewBookingId'");
$RefundSql = "SELECT * FROM booking_refunds WHERE BookingMainId='$ViewBookingId'";
foreach ($AllData as $Data) {
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
      document.getElementById("customers").classList.add("active");
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
                    <div class="col-md-4">
                      <h6 class="app-heading">Booking Details</h6>
                      <table class="table table-striped">
                        <tr>
                          <th class="w-pr-40">BookingId</th>
                          <td>B0<?php echo FETCH($BookingSql, "bookingId"); ?></td>
                        </tr>
                        <tr>
                          <th>Ack. Code</th>
                          <td><?php echo FETCH($BookingSql, "BookingAckCode"); ?></td>
                        </tr>
                        <tr>
                          <th>Customer Name</th>
                          <td><?php echo FETCH($BookingSql, "BookingCustomerName"); ?></td>
                        </tr>
                        <tr>
                          <th>Phone Number</th>
                          <td><?php echo FETCH($BookingSql, "BookingCustomerPhone"); ?></td>
                        </tr>
                        <tr>
                          <th>Project name</th>
                          <td>
                            <?php echo FETCH("SELECT * FROM projects where ProjectsId='" . FETCH($BookingSql, "BookingForProject") . "'", "ProjectName"); ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Booking Phase </th>
                          <td><?php echo FETCH($BookingSql, "BookingProjectPhase"); ?></td>
                        </tr>
                        <tr>
                          <th>Booking Amount</th>
                          <td><?php echo Price(FETCH($BookingSql, "BookingAmount"), "text-success", "Rs."); ?></td>
                        </tr>
                        <tr>
                          <th>Payment Mode</th>
                          <td><?php echo FETCH($BookingSql, "BookingPaymentMode"); ?></td>
                        </tr>
                        <tr>
                          <th>Payment Source</th>
                          <td><?php echo FETCH($BookingSql, "BookingPaymentSource"); ?></td>
                        </tr>
                        <tr>
                          <th>Payment Ref No</th>
                          <td><?php echo FETCH($BookingSql, "BookingPaymentRefNo"); ?></td>
                        </tr>
                        <tr>
                          <th>Payment Details</th>
                          <td><?php echo SECURE(FETCH($BookingSql, "BookingPaymentDetails"), "d"); ?></td>
                        </tr>
                        <tr>
                          <th>Booking Date</th>
                          <td><?php echo DATE_FORMATE("d M, Y", FETCH($BookingSql, "BookingDate")); ?></td>
                        </tr>
                        <tr>
                          <th>CreatedAt</th>
                          <td><?php echo DATE_FORMATE("d M, Y", FETCH($BookingSql, "BookingCreatedAt")); ?></td>
                        </tr>
                        <tr>
                          <th>UpdatedAt</th>
                          <td><?php echo DATE_FORMATE("d M, Y", FETCH($BookingSql, "BookingUpdatedAt")); ?></td>
                        </tr>
                        <tr>
                          <th>CreatedBy</th>
                          <td>UID
                            <?PHP echo FETCH($BookingSql, "BookingCreatedBy"); ?> -
                            <?php echo FETCH("SELECT * FROM users where UserId='" . FETCH($BookingSql, "BookingCreatedBy") . "'", "UserFullName"); ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Status</th>
                          <td><?php echo FETCH($BookingSql, "BookingStatus"); ?></td>
                        </tr>
                        <tr>
                          <th>TeamHead</th>
                          <td>UID
                            <?PHP echo FETCH($BookingSql, "BookingTeamHeadId"); ?> -
                            <?php echo FETCH("SELECT * FROM users where UserId='" . FETCH($BookingSql, "BookingTeamHeadId") . "'", "UserFullName"); ?>
                          </td>
                        </tr>
                        <tr>
                          <th>SaleManager</th>
                          <td>UID
                            <?PHP echo FETCH($BookingSql, "BookingDirectSalePersonId"); ?> -
                            <?php echo FETCH("SELECT * FROM users where UserId='" . FETCH($BookingSql, "BookingDirectSalePersonId") . "'", "UserFullName"); ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Booking Notes</th>
                          <td><?php echo SECURE(FETCH($BookingSql, "BookingNotes"), "d"); ?></td>
                        </tr>
                      </table>
                    </div>

                    <div class="col-md-4">
                      <h6 class="app-heading">More Details</h6>
                      <?php
                      if ($ChecRefundStatus == null) {
                        NoData("<h2 class='mb-1'>Booking is active!</h2> <hr class='mb-2 mt-1'> No other details found!");
                      } else {
                      ?>
                        <table class='table table-striped'>
                          <tr>
                            <th class="w-pr-40">RefundId</th>
                            <td>REF0<?php echo FETCH($RefundSql, "BookingRefundId"); ?></td>
                          </tr>
                          <tr>
                            <th>Refund Mode</th>
                            <td><?php echo FETCH($RefundSql, "BookingRefundMode"); ?></td>
                          </tr>
                          <tr>
                            <th>Refund Source</th>
                            <td><?php echo FETCH($RefundSql, "BookingRefundSource"); ?></td>
                          </tr>
                          <tr>
                            <th>Refund Ref No</th>
                            <td><?php echo FETCH($RefundSql, "BookingRefundRefNo"); ?></td>
                          </tr>
                          <tr>
                            <th>Refund Amount</th>
                            <td class="text-success">Rs.<?php echo FETCH($RefundSql, "BookingRefundAmount"); ?></td>
                          </tr>
                          <tr>
                            <th>Refunded To</th>
                            <td><?php echo FETCH($RefundSql, "BookingRefundedTo"); ?></td>
                          </tr>
                          <tr>
                            <th>Refund date</th>
                            <td><?php echo DATE_FORMATE("d M, Y", FETCH($RefundSql, "BookingRefundDate")); ?></td>
                          </tr>
                          <tr>
                            <th>CreatedAt</th>
                            <td><?php echo DATE_FORMATE("d M, Y", FETCH($RefundSql, "BookingRefundCreatedAt")); ?></td>
                          </tr>
                          <tr>
                            <th>UpdatedAt</th>
                            <td><?php echo DATE_FORMATE("d M, Y", FETCH($RefundSql, "BookingRefundUpdatedAt")); ?></td>
                          </tr>
                          <tr>
                            <th>Approx Refund Date</th>
                            <td>
                              <?php echo DATE_FORMATE("d M, Y", FETCH($RefundSql, "BookingRefundApproxClearingDate")); ?>
                            </td>
                          </tr>
                          <tr>
                            <th>Refunded By</th>
                            <td>UID
                              <?PHP echo FETCH($RefundSql, "BookingRefundBy"); ?> -
                              <?php echo FETCH("SELECT * FROM users where UserId='" . FETCH($RefundSql, "BookingRefundBy") . "'", "UserFullName"); ?>
                            </td>
                          </tr>
                          <tr>
                            <th>More details</th>
                            <td>
                              <?php echo SECURE(FETCH($RefundSql, "BookingRefundDetails"), "d");  ?>
                            </td>
                          </tr>
                        </table>
                      <?php } ?>
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
    include $Dir . "/include/sections/Upload-Refund-Documents.php";
    include $Dir . "/include/sections/Update-Refund-Details.php";
    include $Dir . "/include/sections/Upload-Booking-Documents.php";
    include $Dir . "/include/sections/UpdateBookingDetails.php";
    include $Dir . "/include/admin/footer.php";
    ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>