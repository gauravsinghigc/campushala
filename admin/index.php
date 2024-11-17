<?php
$Dir = "..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Dashboard";
$PageDescription = "Main Dashboard of " . APP_NAME . " for Highlighted and latest checkups about available data";

$LeadFollowUpRecord = FETCH_DB_TABLE("SELECT * FROM lead_followups where LeadFollowUpRemindStatus='ACTIVE' GROUP BY LeadFollowMainId", true);
if ($LeadFollowUpRecord != null) {
  $Count = 0;
  foreach ($LeadFollowUpRecord as $LData) {
    $Count++;
    UPDATE("UPDATE leads SET LeadPersonSubStatus='" . $LData->LeadFollowCurrentStatus . "', LeadPersonStatus='" . $LData->LeadFollowStatus . "', LeadPersonLastUpdatedAt='" . $LData->LeadFollowUpUpdatedAt . "', LeadPersonSubStatus='" . $LData->LeadFollowCurrentStatus . "' where LeadsId='" . $LData->LeadFollowMainId . "'");
  }
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
  <style>
    .card {
      box-shadow: 0px 0px 1px black !important;
      background-color: white !important;
    }
  </style>
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
                    <div class="col-md-12">
                      <?php
                      $GetTodayQuotes = FETCH_DB_TABLE("SELECT * FROM app_quotes where AppQuoteStatus='Active' and DATE(AppQuoteDate)='" . date('Y-m-d') . "'", true);
                      if ($GetTodayQuotes != null) { ?>
                        <div class="flex-s-b daily-quotes">
                          <span class="pull-left">
                            <i class="fa fa-quote-left"></i>
                          </span>
                          <marquee>
                            <?php foreach ($GetTodayQuotes as $Quote) { ?>
                              <span><?php echo SECURE($Quote->AppQuoteName, "d"); ?></span>
                            <?php } ?>
                          </marquee>
                          <span class="pull-right">
                            <i class="fa fa-quote-right"></i>
                          </span>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php
                  if (LOGIN_UserType == "Admin") {
                    if (isset($_GET['view'])) {
                      $ViewDash = $_GET['view'];
                      if ($ViewDash == 'CRM Dashboard') {
                        include 'crm.php';
                      } elseif ($ViewDash == 'HR Dashboard') {
                        include 'hr-dash.php';
                      } elseif ($ViewDash == 'Digital Dashboard') {
                        include 'd-dash.php';
                      } elseif ($ViewDash == 'Lead Dashboard') {
                        include 'lead-dash.php';
                      } elseif ($ViewDash == 'Reception Dashboard') {
                        include 'recep-dash.php';
                      } elseif ($ViewDash == 'ACCOUNT') {
                        include 'account-dash.php';
                      } else {
                        include 'lead-dash.php';
                      }
                    } else {
                      include 'lead-dash.php';
                    }
                  } elseif (LOGIN_UserType == "Digital") {
                    include "d-dash.php";
                  } elseif (LOGIN_UserType == "Receptions") {
                    include "recep-dash.php";
                  } elseif (LOGIN_UserType == "CRM") {
                    include "crm.php";
                  } elseif (LOGIN_UserType == "TeamMember") {
                    include "lead-dash.php";
                  } elseif (LOGIN_UserType == "HR") {
                    include "hr-dash.php";
                  }elseif (LOGIN_UserType == "ACCOUNT") {
                    include "account-dash.php";
                  } ?>
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

</body>

</html>