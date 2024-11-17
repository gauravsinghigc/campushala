<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Policies";
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
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("teams").classList.add("active");
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
                    <div class="col-md-12">
                      <div class="app-heading">
                        <h4 class="mb-0"><?php echo $PageName; ?>
                          <a href="#" onclick="Databar('AddNewPolicy')" class="btn btn-sm btn-default pull-right"><i class="fa fa-plus"></i> Add New Policies</a>
                        </h4>
                      </div>
                    </div>
                    <?php
                    $FetchData = FETCH_DB_TABLE("SELECT * FROM company_policies ORDER BY date('PolicyActiveFrom') DESC", true);
                    if ($FetchData != null) {
                      $SerialNo = 0;
                      foreach ($FetchData as $Req) {
                        $SerialNo++;
                    ?>
                        <div class='col-md-12'>
                          <p class='data-list p-2 flex-s-b'>
                            <span class='w-pr-5'>
                              <span class='text-grey'>Sno</span><br>
                              <span><?php echo $SerialNo; ?></span>
                            </span>
                            <span class='w-pr-25'>
                              <span class='text-grey'>Policy Name</span><br>
                              <span><a href="#" onclick="Databar('edit_<?php echo $Req->PolicyId; ?>')" class='text-info'><?php echo $Req->PolicyName; ?></a></span>
                            </span>
                            <span class='w-pr-10'>
                              <span class='text-grey'>ActiveFrom</span><br>
                              <span><?php echo DATE_FORMATE("d M, Y", $Req->PolicyActiveFrom); ?></span>
                            </span>
                            <span class='w-pr-40'>
                              <span class='text-grey'>ApplicableFor</span><br>
                              <span>
                                <?php
                                $Fetch = FETCH_DB_TABLE("SELECT * FROM company_policy_applicable_on where PolicyMainId='" . $Req->PolicyId . "'", true);
                                if ($Fetch != null) {
                                  foreach ($Fetch as $Req2) {
                                    echo $Req2->ApplicableGroupName . ", ";
                                  }
                                } ?>
                              </span>
                            </span>
                            <span class='w-pr-10'>
                              <span class='text-grey'>CreatedOn</span><br>
                              <span><?php echo DATE_FORMATE("d M, Y", $Req->PolicyCreatedAt); ?></span>
                            </span>
                            <span class='w-pr-10 text-right'>
                              <span class='text-grey'>Action</span><br>
                              <a href="#" onclick="Databar('edit_<?php echo $Req->PolicyId; ?>')" class='text-info'>Update</a>
                            </span>
                          </p>
                        </div>
                    <?php
                        include $Dir . "/include/sections/Update-Policy-Details.php";
                      }
                    } else {
                      NoData("No Visitor Found!");
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
  include $Dir . "/include/sections/Add-New-Policy.php";
  include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>