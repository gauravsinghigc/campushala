<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Payments";
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
                      <h4 class='app-heading'><?php echo $PageName; ?></h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <form>
                        <input placeholder="Search Payments...." type="search" oninput="SearchData('payments', 'payment-data')" name="search" id="payments" class="form-control form-control-sm">
                      </form>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <form class="flex-s-b filter-bar">
                        <div class="w-pr-12">
                          <input type="search" value='<?php echo IfRequested('GET', 'RegPayCustRefId', '', false); ?>' placeholder="Txnid..." onchange="form.submit()" name="RegPayCustRefId" list='RegPayCustRefId' class="form-control form-control-sm">
                          <?php SUGGEST("registration_payments", "RegPayCustRefId", "ASC"); ?>
                        </div>
                        <div class="w-pr-12">
                          <select onchange="form.submit()" name="RegMainCustomerId" class="form-control form-control-sm" required="">
                            <option value="">All Customer </option>
                            <?php
                            $AllCustomers = FETCH_DB_TABLE("SELECT * FROM customers ORDER BY CustomerName", true);
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
                        <div class="w-pr-15">
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
                                }
                                echo "<option value='" . $Data->ProjectsId . "' $selected>" . $Data->ProjectName . "</option>";
                              }
                            } else {
                              echo "<option value='0'>No Project Found!</option>";
                            }
                            ?>
                          </select>
                        </div>
                        <div class="w-pr-10">
                          <input type="search" value='<?php echo IfRequested('GET', 'RegAcknowledgeCode', '', false); ?>' placeholder="Ack Code..." onchange="form.submit()" name="RegAcknowledgeCode" list='RegAcknowledgeCode' class="form-control form-control-sm">
                          <?php SUGGEST("registrations", "RegAcknowledgeCode", "ASC"); ?>
                        </div>
                        <div class="w-pr-10">
                          <select onchange="form.submit()" class='form-control form-control-sm' name='RegPayMode' required="">
                            <?php InputOptions(["", "CASH", "ONLINE_TRANSFER", "CHEQUE_DD", "WALLET_UPI"], IfRequested("GET", "RegPayMode", "", false)); ?>
                          </select>
                        </div>
                        <div class="w-pr-10">
                          <input type="date" value='<?php echo IfRequested('GET', 'RegPaymentDate', '', false); ?>' placeholder="Paid date..." onchange="form.submit()" name="RegPaymentDate" list='RegPaymentDate' class="form-control form-control-sm">
                          <?php SUGGEST("registration_payments", "RegPaymentDate", "ASC"); ?>
                        </div>
                        <div class="w-pr-10">
                          <input type="search" value='<?php echo IfRequested('GET', 'RegPayTotalAmount', '', false); ?>' placeholder="Paid Amount..." onchange="form.submit()" name="RegPayTotalAmount" list='RegPayTotalAmount' class="form-control form-control-sm">
                          <?php SUGGEST("registration_payments", "RegPayTotalAmount", "ASC"); ?>
                        </div>
                        <div class="w-pr-10">
                          <select name="RegPaymentStatus" onchange="form.submit()" class="form-control form-control-sm">
                            <?php InputOptions(["Paid", "Pending", "Failed", ""], IfRequested("GET", "RegPaymentStatus", "", false)); ?>
                          </select>
                        </div>
                      </form>
                    </div>
                    <div class='col-md-12'>
                      <p class="data-list flex-s-b app-sub-heading">
                        <span class='w-pr-3'>
                          <span>Sno</span>
                        </span>
                        <span class='w-pr-12'>
                          <span>Txnid</span>
                        </span>
                        <span class='w-pr-18'>
                          <span>Customer</span>
                        </span>
                        <span class='w-pr-15'>
                          <span>ProjectName</span>
                        </span>
                        <span class='w-pr-7'>
                          <span>AckCode</span>
                        </span>
                        <span class='w-pr-10'>
                          <span>PayMode</span>
                        </span>
                        <span class='w-pr-8'>
                          <span>SoldBy</span>
                        </span>
                        <span class='w-pr-10'>
                          <span>PaymentDate</span>
                        </span>
                        <span class='w-pr-10'>
                          <span>PaidAmount</span>
                        </span>
                        <span class='w-pr-7 text-right'>
                          <span>Status</span>
                        </span>
                      </p>
                    </div>

                    <?php
                    $TotalItems = TOTAL("SELECT * FROM registration_payments ORDER BY RegPaymentId DESC");
                    $listcounts = 15;

                    // Get current page number
                    if (isset($_GET["view_page"])) {
                      $page = $_GET["view_page"];
                    } else {
                      $page = 1;
                    }

                    $start = ($page - 1) * $listcounts;
                    $next_page = ($page + 1);
                    $previous_page = ($page - 1);
                    $NetPages = round($TotalItems / $listcounts + 0.5);
                    if (isset($_GET['RegPaymentStatus'])) {
                      $AllCustomers = FETCH_DB_TABLE("SELECT * FROM registrations, registration_payments where RegPaymentStatus like '%" . $_GET['RegPaymentStatus'] . "%' and RegPayTotalAmount like '%" . $_GET['RegPayTotalAmount'] . "%' and RegPaymentDate like '%" . $_GET['RegPaymentDate'] . "%' and RegPayMode like '%" . $_GET['RegPayMode'] . "%' and RegAcknowledgeCode like '%" . $_GET['RegAcknowledgeCode'] . "%' and RegProjectId like '%" . $_GET['ProjectName'] . "%' and RegMainCustomerId like '%" . $_GET['RegMainCustomerId'] . "%' and RegPayCustRefId like '%" . $_GET['RegPayCustRefId'] . "%' and registrations.RegistrationId=registration_payments.RegMainId ORDER BY RegPaymentId DESC limit $start, $listcounts", true);
                    } else {
                      $AllCustomers = FETCH_DB_TABLE("SELECT * FROM registration_payments ORDER BY RegPaymentId DESC limit $start, $listcounts", true);
                    }
                    if ($AllCustomers != null) {
                      $SerialNo = 0;
                      if (isset($_GET['view_page'])) {
                        $view_page = $_GET['view_page'];
                        if ($view_page == 1) {
                          $SerialNo = 0;
                        } else {
                          $SerialNo = $listcounts * ($view_page - 1);
                        }
                      } else {
                        $SerialNo = $SerialNo;
                      }
                      foreach ($AllCustomers as $Data) {
                        $SerialNo++;
                        $CustomerId = GET_DATA("registrations", "RegMainCustomerId", "RegistrationId='" . $Data->RegMainId . "'");
                        $ProjectId = GET_DATA("registrations", "RegProjectId", "RegistrationId='" . $Data->RegMainId . "'");
                        $RegTeamHead = GET_DATA("registrations", "RegTeamHead", "RegistrationId='" . $Data->RegMainId . "'");
                        $RegDirectSale = GET_DATA("registrations", "RegDirectSale", "RegistrationId='" . $Data->RegMainId . "'");
                        $RegBusHead = GET_DATA("registrations", "RegBusHead", "RegistrationId='" . $Data->RegMainId . "'");
                        $RegAcknowledgeCode = GET_DATA("registrations", "RegAcknowledgeCode", "RegistrationId='" . $Data->RegMainId . "'");
                    ?>
                        <div class='col-md-12 payment-data'>
                          <p class="data-list flex-s-b">
                            <span class='w-pr-3 text-left'>
                              <span><?php echo $SerialNo; ?></span>
                            </span>
                            <span class='w-pr-12 text-left'>
                              <span class='bold text-info'><?php echo $Data->RegPayCustRefId; ?></span>
                            </span>
                            <span class='w-pr-18 text-left'>
                              <span>
                                <a class="bold text-primary" href="<?php echo ADMIN_URL; ?>/crm/custs/details/?id=<?php echo $CustomerId; ?>">
                                  <i class="fa fa-user"></i>(<?php echo $CustomerId; ?>) <?php echo GET_DATA("customers", "CustomerName", "CustomerId='$CustomerId'"); ?>
                                </a>
                              </span>
                            </span>
                            <span class="w-pr-15 text-left">
                              <?php echo LimitText(GET_DATA("projects", "ProjectName", "ProjectsId='$ProjectId'"), 0, 25); ?>
                            </span>
                            <span class='w-pr-7'>
                              <span><?php echo $RegAcknowledgeCode; ?></span>
                            </span>
                            <span class='w-pr-10'>
                              <span><?php echo PaymentModes($Data->RegPayMode); ?></span>
                            </span>
                            <span class="w-pr-8 text-left">
                              <span class='members'>
                                <span class='member-count'><i class='fa fa-users'></i> 3+</span>
                                <span class='record-list'>
                                  <span class='list text-black'>
                                    <i class='fa fa-user'></i>
                                    <span class='text-gray'>TeamHead</span><br>
                                    (RNA-<?php echo FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $RegTeamHead . "'", 'UserMainUserId'); ?>)<br>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . $RegTeamHead . "'", "UserFullName"); ?>
                                  </span>
                                  <span class='list text-black'>
                                    <i class='fa fa-user'></i>
                                    <span class='text-gray'>Soldby</span><br>
                                    (RNA-<?php echo FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $RegDirectSale . "'", 'UserMainUserId'); ?>)<br>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . $RegDirectSale . "'", "UserFullName"); ?>
                                  </span>
                                  <span class='list text-black'>
                                    <i class='fa fa-user'></i>
                                    <span class='text-gray'>BusinessHead</span><br>
                                    (RNA-<?php echo FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $RegBusHead . "'", 'UserMainUserId'); ?>)<br>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . $RegBusHead . "'", "UserFullName"); ?>
                                  </span>
                                </span>
                              </span>
                            </span>
                            <span class='w-pr-10'>
                              <span><?php echo DATE_FORMATE("d M, Y", $Data->RegPaymentDate); ?></span>
                            </span>
                            <span class='w-pr-10'>
                              <span><?php echo Price($Data->RegPayTotalAmount, 'text-success', 'Rs.'); ?></span>
                            </span>
                            <span class='w-pr-7 text-right'>
                              <span><?php echo PayStatus($Data->RegPaymentStatus); ?></span>
                            </span>
                          </p>
                        </div>
                    <?php
                      }
                    } else {
                      NoData("No Customer found!");
                    } ?>
                    <div class="col-md-12 flex-s-b mt-2 mb-1">
                      <div class="">
                        <h6 class="mb-0" style="font-size:0.75rem;color:grey;">Page <b><?php echo IfRequested("GET", "view_page", $page, false); ?></b> from <b><?php echo $NetPages; ?> </b> pages <br>Total <b><?php echo $TotalItems; ?></b> entries</h6>
                      </div>
                      <div class="flex">
                        <span class="mr-1">
                          <?php
                          if (isset($_GET['view'])) {
                            $viewcheck = "&view=" . $_GET['view'];
                          } else {
                            $viewcheck = "";
                          }
                          ?>
                          <a href="?view_page=<?php echo $previous_page; ?>" class="btn btn-sm btn-default"><i class="fa fa-angle-double-left"></i></a>
                        </span>
                        <form style="padding:0.3rem !important;">
                          <input type="number" name="view_page" onchange="form.submit()" class="form-control form-control-sm mb-0" min="1" max="<?php echo $NetPages; ?>" value="<?php echo IfRequested("GET", "view_page", 1, false); ?>">
                        </form>
                        <span class="ml-1">
                          <a href="?view_page=<?php echo $next_page; ?>" class="btn btn-sm btn-default"><i class="fa fa-angle-double-right"></i></a>
                        </span>
                        <?php if (isset($_GET['view_page'])) { ?>
                          <span class="ml-1">
                            <a href="index.php" class="btn btn-sm btn-danger mb-0"><i class="fa fa-times m-1"></i></a>
                          </span>
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

    <?php include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>