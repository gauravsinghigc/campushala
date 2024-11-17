<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Applicable Policies";
$PageDescription = "Manage teams";
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
                      <h4 class="app-heading"><?php echo $PageName; ?></h4>
                    </div>
                    <?php
                    $FetchData = FETCH_DB_TABLE("SELECT * FROM company_policies, company_policy_applicable_on where company_policies.PolicyId=company_policy_applicable_on.PolicyMainId and ApplicableGroupName='" . LOGIN_UserType . "' ORDER BY date('PolicyActiveFrom') DESC", true);
                    if ($FetchData != null) {
                      $SerialNo = 0;
                      foreach ($FetchData as $Req) {
                        $SerialNo++;
                    ?>
                        <div class='col-md-6 col-sm-6 col-12 mb-2'>
                          <a href="details.php?id=<?php echo $Req->PolicyId; ?>">
                            <div class="bg-info p-2 rounded">
                              <h4 class='mb-0 text-white'><i class='fa fa-stamp text-warning'></i> <?php echo $Req->PolicyName; ?></h4>
                              <p class='small text-white'>Active From : <?php echo DATE_FORMATE("d M, Y", $Req->PolicyActiveFrom); ?></p>
                            </div>
                          </a>
                        </div>
                    <?php
                      }
                    } else {
                      NoData("No Applicable Policy Found!");
                    } ?>
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


  <?php
  include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>