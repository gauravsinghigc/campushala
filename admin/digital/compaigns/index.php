<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Digital Compaigns";
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
      document.getElementById("profile").classList.add("active");
      document.getElementById("profile_view").classList.add("active");
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
                      <h5 class='app-heading'>
                        <?php echo $PageName; ?>
                        <a href="add.php" class='btn btn-sm btn-default pull-right' style="margin-top:-0.25rem !important;"><i class='fa fa-plus'></i> Add Compaigns</a>
                      </h5>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'><?php echo $all = TOTAL("SELECT * FROM comaigns"); ?></h5>
                        <small class="mt-0">All Compaigns</small>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'>Rs.<?php echo AMOUNT("SELECT * FROM comaigns", "CompaignAmountSpent"); ?></h5>
                        <small class="mt-0">Net Compaigns Cost</small>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'>
                          Rs.
                          <?php
                          if ($all != 0) {
                            echo round(AMOUNT("SELECT CompaignCPL FROM comaigns", "CompaignCPL") / $all, 2);
                          } else {
                            echo 0;
                          } ?></h5>
                        <small class="mt-0">Net Compaigns CPL</small>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'><?php echo AMOUNT("SELECT NumberOfLeads FROM comaigns", "NumberOfLeads"); ?></h5>
                        <small class="mt-0">Net Leads</small>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'><?php echo TOTAL("SELECT CompaignStatus FROM comaigns where CompaignStatus='Active'"); ?></h5>
                        <small class="mt-0">Active Compaigns</small>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'><?php echo TOTAL("SELECT CompaignStatus FROM comaigns where CompaignStatus='Closed'"); ?></h5>
                        <small class="mt-0">Closed Compaigns</small>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <p class='data-list flex-s-b app-sub-heading'>
                        <span class="w-pr-5">Sno</span>
                        <span class="w-pr-15">CompaignName</span>
                        <span class="w-pr-18">ProjectName</span>
                        <span class="w-pr-10">CompaignDate</span>
                        <span class="w-pr-10">Source</span>
                        <span class="w-pr-10">NoOfLeads</span>
                        <span class="w-pr-10">Cost</span>
                        <span class="w-pr-8">Status</span>
                        <span class="w-pr-10">Action</span>
                      </p>
                      <?php
                      $TotalItems = TOTAL("SELECT * FROM comaigns order by date(CompaignDate) DESC");
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
                      $NetPages = round(($TotalItems / $listcounts) + 0.5);

                      $AllData = FETCH_DB_TABLE("SELECT * FROM comaigns order by date(CompaignDate) DESC limit $start, $listcounts", true);
                      if ($AllData == null) {
                        NoData("No Compaign Found!");
                      } else {
                        $Sno = 0;
                        if (isset($_GET['view_page'])) {
                          $view_page = $_GET['view_page'];
                          if ($view_page == 1) {
                            $Sno = 0;
                          } else {
                            $Sno = $listcounts * ($view_page - 1);
                          }
                        } else {
                          $Sno = $Sno;
                        }
                        foreach ($AllData as $data) {
                          $Sno++; ?>
                          <p class="data-list flex-s-b">
                            <span class="w-pr-5 text-left">
                              <span><?php echo $Sno; ?></span>
                            </span>
                            <span class="w-pr-15 text-left">
                              <span><?php echo $data->CompaignName; ?></span>
                            </span>
                            <span class="w-pr-18 text-left">
                              <span><?php echo FETCH("SELECT * FROM projects where ProjectsId='" . $data->ProjectName . "'", "ProjectName"); ?></span>
                            </span>
                            <span class="w-pr-10 text-left">
                              <span><?php echo DATE_FORMATE("d M, Y", $data->CompaignDate); ?></span>
                            </span>
                            <span class="w-pr-10 text-left">
                              <span><?php echo $data->SourceOfCompaign; ?></span>
                            </span>
                            <span class="w-pr-10 text-left">
                              <span><?php echo $data->NumberOfLeads; ?></span>
                            </span>
                            <span class="w-pr-10 text-left">
                              <span><?php echo Price($data->CompaignAmountSpent, "text-success", "Rs."); ?></span>
                            </span>
                            <span class="w-pr-8 text-left">
                              <span><?php echo StatusViewWithText($data->CompaignStatus); ?></span>
                            </span>
                            <span class='text-right w-pr-10'>
                              <span>
                                <a href="update.php?cid=<?php echo SECURE($data->ComaignId, "e"); ?>" class="text-info">View Details</a>
                              </span>
                            </span>
                          </p>
                      <?php }
                      } ?>
                    </div>
                    <div class="col-md-12 flex-s-b mt-2 mb-1">
                      <div class="">
                        <h6 class="mb-0" style="font-size:0.75rem;color:grey;">Page <b><?php echo IfRequested("GET", "view_page", $page, false); ?></b> from <b><?php echo $NetPages; ?> </b> pages <br>Total <b><?php echo $TotalItems; ?></b> Entries</h6>
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

    <?php
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>