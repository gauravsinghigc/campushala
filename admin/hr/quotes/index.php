<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Daily Quotes";
$PageDescription = "Manage all customers";
$UserPIPRefNo = "#QUTE" . date("dmy") . rand(0, 9999);
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
      document.getElementById("expanses").classList.add("active");
      document.getElementById("all_expanses").classList.add("active");
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
                    <div class="col-md-10">
                      <h2 class="app-heading"><?php echo $PageName; ?></h2>
                    </div>
                    <div class="col-md-2">
                      <a href="#" onclick="Databar('AddNewQuotes')" class="btn btn-block btn-danger"><i class="fa fa-plus"></i> New Quotes</a>
                    </div>
                  </div>

                  <form class="row mt-2">
                    <div class="col-md-4 form-group">
                      <input type="month" value="<?php echo IfRequested("GET", "AppQuoteDate", date("Y-m"), false); ?>" name="AppQuoteDate" class="form-control form-control-sm" placeholder="Search PIP...." onchange="form.submit()">
                    </div>
                    <?php if (isset($_GET['AppQuoteDate'])) {
                    ?>
                      <div class="col-md-4">
                        <a href="index.php" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Clear Filter</a>
                      </div>
                    <?php
                    } ?>
                  </form>

                  <div class="row">
                    <div class="col-md-12">
                      <p class='data-list flex-s-b app-sub-heading'>
                        <span class="w-pr-3 text-left">Sno</span>
                        <span class="w-pr-82">Qoutes</span>
                        <span class="w-pr-10">ForDate</span>
                        <span class="w-pr-5 text-right">Action</span>
                      </p>
                    </div>
                    <?php
                    $start = START_FROM;
                    $end = DEFAULT_RECORD_LISTING;

                    if (isset($_GET['AppQuoteDate'])) {
                      $Month  = DATE_FORMATE("m", $_GET['AppQuoteDate']);
                      $Year  = DATE_FORMATE("Y", $_GET['AppQuoteDate']);
                      $TotalItems = TOTAL("SELECT * FROM app_quotes where YEAR(AppQuoteDate)='" . $Year . "' and MONTH(AppQuoteDate)='" . $Month . "' ORDER by DATE(AppQuoteDate) DESC");
                    } else {
                      $TotalItems = TOTAL("SELECT * FROM app_quotes ORDER by DATE(AppQuoteDate) DESC limit $start, $end");
                    }

                    if (isset($_GET['AppQuoteDate'])) {
                      $Month  = DATE_FORMATE("m", $_GET['AppQuoteDate']);
                      $Year  = DATE_FORMATE("Y", $_GET['AppQuoteDate']);
                      $AllRewards = FETCH_DB_TABLE("SELECT * FROM app_quotes where YEAR(AppQuoteDate)='" . $Year . "' and MONTH(AppQuoteDate)='" . $Month . "'  ORDER by DATE(AppQuoteDate) DESC", true);
                    } else {
                      $AllRewards = FETCH_DB_TABLE("SELECT * FROM app_quotes ORDER by DATE(AppQuoteDate) DESC limit $start, $end", true);
                    }
                    if ($AllRewards == null) {
                      NoData("No rewards found!");
                    } else {
                      $SerialNo = SERIAL_NO;
                      foreach ($AllRewards as $Reward) {
                        $SerialNo++;
                    ?>
                        <div class="col-md-12">
                          <div class="data-list flex-s-b">
                            <span class="w-pr-3 text-left"><?php echo $SerialNo; ?></span>
                            <span class="w-pr-82">
                              <a href="#" onclick="Databar('update_<?php echo $Reward->AppQuotesId; ?>')" class="text-primary">
                                <?php echo SECURE($Reward->AppQuoteName, "d"); ?>
                              </a>
                            </span>
                            <span class="w-pr-10">
                              <?php echo DATE_FORMATE("d M, Y", $Reward->AppQuoteDate); ?>
                            </span>
                            <span class="w-pr-5 text-right">
                              <a href="#" onclick="Databar('update_<?php echo $Reward->AppQuotesId; ?>')" class="text-info">Details</a>
                            </span>
                          </div>
                        </div>
                    <?php
                        include $Dir . "/include/sections/Update-Daily-Quotes-Details.php";
                      }
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

    <?php
    include $Dir . "/include/sections/Add-New-Daily-Quotes.php";
    include $Dir . "/include/admin/footer.php";
    ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>