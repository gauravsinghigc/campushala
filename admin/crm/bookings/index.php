<?php
$Dir = "../../..";
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
                        <a href="create/" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> New
                          Bookings</a>
                      </h4>
                    </div>
                  </div>

                  <form class="row">
                    <div class="col-md-2 form-group">
                      <select onchange="form.submit()" name="ProjectName" class="form-control form-control-sm" required="">
                        <option value="">All Project </option>
                        <?php
                        $Alldata = FETCH_DB_TABLE("SELECT * FROM projects ORDER BY ProjectName", true);
                        if ($Alldata != null) {
                          foreach ($Alldata as $Data) {
                            if (isset($_GET['ProjectName'])) {
                              if ($_GET['ProjectName'] == $Data->ProjectsId) {
                                $selected = "selected";
                              } else {
                                $selected = "";
                              }
                            } else {
                              $selected = "";
                            }
                            echo "<option value='" . $Data->ProjectsId . "' $selected>" . $Data->ProjectName . "</option>";
                          }
                        } else {
                          echo "<option value='0'>No Project Found!</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-2 form-group">
                      <select onchange="form.submit()" name="RegMainCustomerId" class="form-control form-control-sm" required="">
                        <option value="">All Customer </option>
                        <?php
                        if (isset($_GET['ProjectName'])) {
                          $ProjectName = $_GET['ProjectName'];
                          $AllCustomers = FETCH_DB_TABLE("SELECT * FROM customers, registrations where RegProjectId like '%$ProjectName%' and customers.CustomerId=registrations.RegMainCustomerId GROUP BY CustomerId ORDER BY CustomerName", true);
                        } else {
                          $AllCustomers = FETCH_DB_TABLE("SELECT * FROM customers, registrations where customers.CustomerId=registrations.RegMainCustomerId GROUP BY CustomerId ORDER BY CustomerName", true);
                        }
                        if ($AllCustomers != null) {
                          foreach ($AllCustomers as $Customer) {
                            if (isset($_GET['RegMainCustomerId'])) {
                              if ($_GET['RegMainCustomerId'] == $Customer->CustomerId) {
                                $selected = "selected";
                              } else {
                                $selected = "";
                              }
                            } else {
                              $selected = "";
                            }
                            echo "<option value='" . $Customer->CustomerId . "' $selected>" . $Customer->CustomerName . " @ " . $Customer->CustomerPhoneNumber . "</option>";
                          }
                        } else {
                          echo "<option value='0'>No Customer Found!</option>";
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <select name="RegBusHead" onchange="form.submit()" class="form-control form-control-sm" required="">
                        <option value="">All Business Head</option>
                        <option value="1">Assign Admin</option>
                        <?php
                        $AllCustomers = FETCH_DB_TABLE("SELECT * FROM users, user_employment_details where UserEmpGroupName='BH' and users.UserId=user_employment_details.UserMainUserId ORDER BY UserEmpDetailsId Desc", true);
                        if ($AllCustomers != null) {
                          $Sno = 0;
                          foreach ($AllCustomers as $Customers) {
                            $Sno++;
                            $UserMainUserId = $Customers->UserMainUserId;
                            $selected = "";
                        ?>
                            <option value="<?php echo $UserMainUserId; ?>" <?php echo $selected; ?>>
                              <?php echo $Customers->UserFullName; ?> @ <?php echo $Customers->UserPhoneNumber; ?>
                            </option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <select name="RegTeamHead" onchange="form.submit()" class="form-control form-control-sm" required="">
                        <option value="">All Team Head</option>
                        <option value="1">Assign Admin</option>
                        <?php
                        $AllCustomers = FETCH_DB_TABLE("SELECT * FROM users, user_employment_details where UserEmpGroupName='TH' and users.UserId=user_employment_details.UserMainUserId ORDER BY UserEmpDetailsId Desc", true);
                        if ($AllCustomers != null) {
                          $Sno = 0;
                          foreach ($AllCustomers as $Customers) {
                            $Sno++;
                            $UserMainUserId = $Customers->UserMainUserId;
                            $selected = "";
                        ?>
                            <option value="<?php echo $UserMainUserId; ?>" <?php echo $selected; ?>>
                              <?php echo $Customers->UserFullName; ?> @ <?php echo $Customers->UserPhoneNumber; ?>
                            </option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>

                    <div class="col-md-2">
                      <select name="RegDirectSale" onchange="form.submit()" class="form-control form-control-sm" required="">
                        <option value="">All Sale Person</option>
                        <option value="1">Assign Admin</option>
                        <?php
                        $AllCustomers1 = FETCH_DB_TABLE("SELECT * FROM users, user_employment_details where users.UserId=user_employment_details.UserMainUserId ORDER BY UserEmpDetailsId Desc", true);
                        if ($AllCustomers1 != null) {
                          $Sno = 0;
                          foreach ($AllCustomers1 as $Customers1) {
                            $Sno++;
                            $UserMainUserId1 = $Customers1->UserMainUserId;
                            $selected1 = "";
                        ?>
                            <option value="<?php echo $UserMainUserId1; ?>" <?php echo $selected1; ?>>
                              <?php echo $Customers1->UserFullName; ?> @ <?php echo $Customers1->UserPhoneNumber; ?>
                            </option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-2 form-group">
                      <select name="RegStatus" onchange="form.submit()" class="form-control form-control-sm" required="">
                        <?php InputOptions(["", "Pending", "Done"], IfRequested("GET", "RegStatus", "", false)); ?>
                      </select>
                    </div>
                    <div class="col-md-12">
                      <?php if (isset($_GET['ProjectName'])) { ?>
                        <a href="index.php" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Clear Filters</a>
                      <?php } ?>
                    </div>
                  </form>

                  <div class="row">
                    <div class="col-md-12">
                      <p class="data-list flex-s-b app-sub-heading">
                        <span class="w-pr-5">Sno</span>
                        <span class="w-pr-10">AckCode/Phase</span>
                        <span class="w-pr-15">CustomerName</span>
                        <span class="w-pr-28">ProjectName</span>
                        <span class="w-pr-10">UnitPrice</span>
                        <span class="w-pr-10">SoldBy</span>
                        <span class="w-pr-10">RegDate</span>
                        <span class="w-pr-10">Progress</span>
                        <span class="w-pr-7">BBAStatus</span>
                      </p>
                    </div>
                    <?php
                    if (isset($_GET['fromdate'])) {
                      $From = $_GET['fromdate'];
                      $To = $_GET['todate'];
                      $TotalItems = TOTAL("SELECT * FROM registrations where DATE(RegistrationDate)>='$From' and DATE(RegistrationDate)<='$To' ORDER BY RegistrationId DESC");
                    } elseif (isset($_GET['ProjectName'])) {
                      $TotalItems = TOTAL("SELECT * FROM registrations where RegMainCustomerId like '%" . $_GET['RegMainCustomerId'] . "%' AND RegProjectId LIKE '%" . $_GET['ProjectName'] . "%' and RegTeamHead like '%" . $_GET['RegTeamHead'] . "%' and RegDirectSale like '%" . $_GET['RegDirectSale'] . "%' and RegBusHead like '%" . $_GET['RegBusHead'] . "%' and RegStatus like '%" . $_GET['RegStatus'] . "%' ORDER BY RegistrationId DESC");
                    } else {
                      $TotalItems = TOTAL("SELECT * FROM registrations ORDER BY RegistrationId DESC");
                    }
                    $listcounts = 15;

                    $start = START_FROM;
                    $listcounts = DEFAULT_RECORD_LISTING;

                    if (isset($_GET['fromdate'])) {
                      $From = $_GET['fromdate'];
                      $To = $_GET['todate'];
                      $AllData = FETCH_DB_TABLE("SELECT * FROM registrations where DATE(RegistrationDate)>='$From' and DATE(RegistrationDate)<='$To' ORDER BY RegistrationId DESC limit $start, $listcounts", true);
                    } elseif (isset($_GET['ProjectName'])) {
                      $AllData = FETCH_DB_TABLE("SELECT * FROM registrations where RegMainCustomerId like '%" . $_GET['RegMainCustomerId'] . "%' AND RegProjectId LIKE '%" . $_GET['ProjectName'] . "%' and RegTeamHead like '%" . $_GET['RegTeamHead'] . "%' and RegDirectSale like '%" . $_GET['RegDirectSale'] . "%' and RegBusHead like '%" . $_GET['RegBusHead'] . "%' and RegStatus like '%" . $_GET['RegStatus'] . "%' ORDER BY RegistrationId DESC", true);
                    } else {
                      $AllData = FETCH_DB_TABLE("SELECT * FROM registrations ORDER BY RegistrationId DESC limit $start, $listcounts", true);
                    }
                    if ($AllData != null) {
                      $SerialNo = SERIAL_NO;

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
                        } ?>
                        <div class="col-md-12 registrations-data ">
                          <p class="data-list flex-s-b <?php echo $bg; ?>">
                            <span class='w-pr-5'>
                              <span class="name"><?php echo $SerialNo; ?></span>
                            </span>
                            <span class='w-pr-10 text-left'>
                              <span><?php echo $Data->RegAcknowledgeCode; ?></span><br>
                              <span class='text-gray small'><?php echo $Data->RegAllotmentPhase; ?></span>
                            </span>
                            <span class='w-pr-15 text-left'>
                              <span class="bold">
                                <a href="../custs/details/?id=<?php echo $Data->RegMainCustomerId; ?>" class="text-primary">
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
                                  <?php
                                  $Area = GetNumbers($Data->RegUnitSizeApplied);
                                  $UnitRate = round((float)$Data->RegUnitCost / $Area, 2);
                                  echo "@ Rs." . $UnitRate . "/sq unit";
                                  ?>
                                </span>
                              </span>
                            </span>
                            <span class='w-pr-10 text-left'>
                              <span class='members'>
                                <span class='member-count'><i class='fa fa-users'></i> 3+</span>
                                <span class='record-list'>
                                  <span class='list text-black'>
                                    <i class='fa fa-user'></i>
                                    <span class='text-gray'>TeamHead</span><br>
                                    (RNA-<?php echo FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $Data->RegTeamHead . "'", 'UserMainUserId'); ?>)<br>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . $Data->RegTeamHead . "'", "UserFullName"); ?>
                                  </span>
                                  <span class='list text-black'>
                                    <i class='fa fa-user'></i>
                                    <span class='text-gray'>Soldby</span><br>
                                    (RNA-<?php echo FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $Data->RegDirectSale . "'", 'UserMainUserId'); ?>)<br>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . $Data->RegDirectSale . "'", "UserFullName"); ?>
                                  </span>
                                  <span class='list text-black'>
                                    <i class='fa fa-user'></i>
                                    <span class='text-gray'>BusinessHead</span><br>
                                    (RNA-<?php echo FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $Data->RegBusHead . "'", 'UserMainUserId'); ?>)<br>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . $Data->RegBusHead . "'", "UserFullName"); ?>
                                  </span>
                                </span>
                              </span>
                            </span>
                            <span class='w-pr-10 text-left'>
                              <span><?php echo DATE_FORMATE("d M, Y", $Data->RegistrationDate); ?></span>
                            </span>
                            <span class='w-pr-10 text-left'>
                              <?php
                              $NetPayable = $Data->RegUnitCost;
                              $NetPAID = AMOUNT("SELECT RegPayTotalAmount FROM registration_payments where RegMainId='" . $Data->RegistrationId . "' and RegPaymentStatus='Paid'", "RegPayTotalAmount");
                              $NetPAID += AMOUNT("SELECT RegPayTotalAmount FROM registration_payments where RegMainId='" . $Data->RegistrationId . "' and RegPaymentStatus='Cleared'", "RegPayTotalAmount");
                              $NetPAID += (int)AMOUNT("SELECT * FROM bookings where BookingMainCustomerId='" . $Data->RegMainCustomerId . "'", "BookingAmount");
                              $PercentageStatus = round($NetPAID / $NetPayable * 100);
                              echo $PercentageStatus; ?>% /
                              <?php echo $Days; ?> days
                            </span>
                            <span class='w-pr-7 text-right'>
                              <span><?php echo $Data->RegStatus; ?></span>
                            </span>
                          </p>
                        </div>
                    <?php
                      }
                    } else {
                      NoData("No Bookings Found!");
                    }
                    PaginationFooter($TotalItems, "index.php"); ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>