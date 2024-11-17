<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Bookings";
$PageDescription = "Manage all customers";
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
                  <div class='row'>
                    <div class="col-md-12">
                      <h4 class='app-heading'><?php echo $PageName; ?>
                      </h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <form>
                        <input type="search" oninput="SearchData('SearchRegistration', 'registrations-data')" name="search" id="SearchRegistration" class="form-control form-control-sm" placeholder="Search Bookings...">
                      </form>
                    </div>
                    <div class="col-md-5 text-right">
                      <form class="">
                        <div class="flex-s-b">
                          <div class="flex-s-b w-100">
                            <label class="w-75 btn btn-xs">From date:</label>
                            <input type="date" onchange="form.submit()" value="<?php echo IfRequested("GET", "fromdate", date('Y-m-d'), false); ?>" name="fromdate" class="form-control w-30 form-control-sm">
                          </div>
                          <div class="flex-s-b w-100">
                            <label class="w-50 btn btn-xs">To date :</label>
                            <input type="date" onchange="form.submit()" value="<?php echo IfRequested("GET", "todate", date('Y-m-d'), false); ?>" name="todate" class="form-control w-30 form-control-sm">
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <?php if (isset($_GET['fromdate'])) {
                    $From = $_GET['fromdate'];
                    $To = $_GET['todate']; ?>
                    <div class="row">
                      <div class="col-md-12 mb-2">
                        <p class="p-1"><i class="fa fa-filter text-danger"></i>
                          <b><?php echo TOTAL("SELECT * FROM bookings where DATE(BookingDate)>='$From' and DATE(BookingDate)<='$To'"); ?>
                          </b>
                          Bookings <span class="text-gray">From:</span> <span class="text-black bold"><?php echo DATE_FORMATE("d M, Y", $_GET['fromdate']); ?></span>
                          <span class="text-gray">To :</span> <span class="text-black bold"><?php echo DATE_FORMATE("d M, Y", $_GET['todate']); ?></span>
                          <a href="index.php" class="text-danger pull-right"><i class="fa fa-times"></i> Clear Filter</a>
                        </p>
                      </div>
                    </div>
                  <?php } ?>

                  <div class="row">
                    <div class="col-md-12">
                      <p class="data-list flex-s-b app-sub-heading">
                        <span class="w-pr-5">Sno</span>
                        <span class="w-pr-10">AckCode/Phase</span>
                        <span class="w-pr-15">CustomerName</span>
                        <span class="w-pr-28">ProjectName</span>
                        <span class="w-pr-10">UnitPrice</span>
                        <span class="w-pr-10">NetPaid</span>
                        <span class="w-pr-10">Balance</span>
                        <span class="w-pr-10">RegDate</span>
                        <span class="w-pr-10">Progress</span>
                        <span class="w-pr-7">BBAStatus</span>
                      </p>
                    </div>
                    <?php
                    $LOGIN_UserId = LOGIN_UserId;
                    $UserType = FETCH("SELECT * FROM user_employment_details where UserMainUserId='$LOGIN_UserId'", 'UserEmpGroupName');
                    if ($UserType == 'BH') {
                      $AllData = FETCH_DB_TABLE("SELECT * FROM registrations where RegBusHead='$LOGIN_UserId' ORDER BY RegistrationId DESC", true);
                    } elseif ($UserType == 'TH') {
                      $AllData = FETCH_DB_TABLE("SELECT * FROM registrations where RegTeamHead='$LOGIN_UserId' ORDER BY RegistrationId DESC", true);
                    } else {
                      $AllData = FETCH_DB_TABLE("SELECT * FROM registrations where RegDirectSale='$LOGIN_UserId' ORDER BY RegistrationId DESC", true);
                    }
                    if ($AllData == null) {
                      NoData('No Booking Found!');
                    } else {
                      $SerialNo = 0;
                      foreach ($AllData as $Data) {
                        $SerialNo++;
                        $Days = GetDays(DATE_FORMATE("Y-m-d", $Data->RegistrationDate));

                        if ($Data->RegProjectCost == 0) {
                          $bg = "";
                        } else {
                          if ($Days >= $Data->RegProjectCost) {
                            $bg = 'bg-warning text-white';
                          } else {
                            $bg = '';
                          }
                        }
                        $Area = GetNumbers($Data->RegUnitSizeApplied);
                        $UnitRate = round((float)$Data->RegUnitCost / $Area, 2);
                        $NetPayable = $Data->RegUnitCost;
                        $NetPAID = AMOUNT("SELECT RegPayTotalAmount FROM registration_payments where RegMainId='" . $Data->RegistrationId . "' and RegPaymentStatus='Paid'", "RegPayTotalAmount");
                        $NetPAID += AMOUNT("SELECT RegPayTotalAmount FROM registration_payments where RegMainId='" . $Data->RegistrationId . "' and RegPaymentStatus='Cleared'", "RegPayTotalAmount");
                        $PercentageStatus = round($NetPAID / $NetPayable * 100);
                    ?>
                        <div class="col-md-12 registrations-data <?php echo $bg; ?>">
                          <p class="data-list flex-s-b">
                            <span class='w-pr-5'>
                              <span class="name"><?php echo $SerialNo; ?></span>
                            </span>
                            <span class='w-pr-10 text-left'>
                              <span><?php echo $Data->RegAcknowledgeCode; ?></span><br>
                              <span class='text-gray small'><?php echo $Data->RegAllotmentPhase; ?></span>
                            </span>
                            <span class='w-pr-15 text-left'>
                              <span class="bold">
                                <a href="" class="text-primary">
                                  <i class='fa fa-user text-primary'></i>
                                  <?php echo FETCH("SELECT * FROM customers where CustomerId='" . $Data->RegMainCustomerId . "'", "CustomerName"); ?>
                                </a><br>
                                <a href="tel:<?php echo FETCH("SELECT * FROM customers where CustomerId='" . $Data->RegMainCustomerId . "'", "CustomerPhoneNumber"); ?>" class="text-primary small">
                                  <i class='fa fa-phone text-info'></i>
                                  <?php echo FETCH("SELECT * FROM customers where CustomerId='" . $Data->RegMainCustomerId . "'", "CustomerPhoneNumber"); ?>
                                </a>
                              </span>
                            </span>
                            <span class='w-pr-28 text-left'>
                              <span><?php echo LimitText(FETCH("SELECT * FROM projects where ProjectsId='" . $Data->RegProjectId . "'", "ProjectName"), 0, 35); ?></span>
                              <br>
                              <span class="text-gray small">
                                <span><?php echo $Data->RegUnitAlloted; ?></span> -
                                <span><?php echo $Data->RegUnitSizeApplied; ?></span>
                              </span>
                            </span>
                            <span class='w-pr-10 text-left'>
                              <span><?php echo Price($Data->RegUnitCost, "", "Rs."); ?></span><br>
                              <span class="text-gray small">
                                <span>
                                  <?php echo "@ Rs." . $UnitRate . "/sq unit"; ?>
                                </span>
                              </span>
                            </span>
                            <span class='w-pr-10'>
                              <span><?php echo Price($NetPAID, '', 'Rs.'); ?></span>
                            </span>
                            <span class='w-pr-10'>
                              <span><?php echo Price($NetPayable - $NetPAID, '', 'Rs.'); ?></span>
                            </span>
                            <span class='w-pr-10 text-left'>
                              <span><?php echo DATE_FORMATE("d M, Y", $Data->RegistrationDate); ?></span>
                            </span>
                            <span class='w-pr-10 text-left'>
                              <span>
                                <?php echo $PercentageStatus; ?>%
                              </span>/
                              <span>
                                <?php echo $Days; ?> days
                              </span>
                            </span>
                            <span class='w-pr-7 text-right'>
                              <span><?php echo $Data->RegStatus; ?></span>
                            </span>
                          </p>
                        </div>
                    <?php
                      }
                    }
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
    include $Dir . "/include/sections/AddNewBookings.php";
    include $Dir . "/include/admin/footer.php";
    ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>