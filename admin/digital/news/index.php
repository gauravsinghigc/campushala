<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Newspaper Compaigns";
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
                        <h5 class='text-black mb-0'><?php echo TOTAL("SELECT * FROM newspapercompaigns"); ?></h5>
                        <small class="mt-0">All Compaigns</small>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'>Rs.<?php echo AMOUNT("SELECT * FROM newspapercompaigns", "PublicationCost"); ?></h5>
                        <small class="mt-0">Net Compaigns Cost</small>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'><?php echo TOTAL("SELECT * FROM newspapercompaigns where CompaignStatus='Active'"); ?></h5>
                        <small class="mt-0">Active Compaigns</small>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-6">
                      <div class="bg-light p-2">
                        <h5 class='text-black mb-0'><?php echo TOTAL("SELECT * FROM newspapercompaigns where CompaignStatus='Closed'"); ?></h5>
                        <small class="mt-0">Closed Compaigns</small>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <p class="data-list flex-s-b app-sub-heading">
                        <span class="w-pr-5">Sno</span>
                        <span class="w-pr-15">NewspaperName</span>
                        <span class="w-pr-25">ProjectName</span>
                        <span class="w-pr-15">Edition</span>
                        <span class="w-pr-10">CompaignDate</span>
                        <span class="w-pr-10">PublicateDate</span>
                        <span class="w-pr-10">AdSize</span>
                        <span class="w-pr-7">Cost</span>
                        <span class="w-pr-7">Status</span>
                        <span class="w-pr-5 text-right">Action</span>
                      </p>
                      <?php
                      $start = START_FROM;
                      $listcounts = DEFAULT_RECORD_LISTING;

                      $AllData = FETCH_DB_TABLE("SELECT * FROM newspapercompaigns order by date(CompaignDate) DESC limit $start, $listcounts", true);
                      if ($AllData == null) {
                        NoData("No News Paper Compaign Found!");
                      } else {
                        $Sno = SERIAL_NO;
                        foreach ($AllData as $data) {
                          $Sno++; ?>
                          <p class="data-list flex-s-b">
                            <span class="w-pr-5 text-left">
                              <span><?php echo $Sno; ?></span>
                            </span>
                            <span class="w-pr-15 text-left">
                              <span><?php echo $data->NewsPaperName; ?></span>
                            </span>
                            <span class="w-pr-25 text-left">
                              <span><?php echo FETCH("SELECT * FROM projects where ProjectsId='" . $data->ProjectName . "'", "ProjectName"); ?></span>
                            </span>
                            <span class="w-pr-15 text-left">
                              <span><?php echo $data->NewPaperEditions; ?></span>
                            </span>
                            <span class="w-pr-10 text-left">
                              <span><?php echo DATE_FORMATE("d M, Y", $data->CompaignDate); ?></span>
                            </span>
                            <span class="w-pr-10 text-left">
                              <span><?php echo DATE_FORMATE("d M, Y", $data->PublicationDate); ?></span>
                            </span>
                            <span class="w-pr-10 text-left">
                              <span><?php echo $data->NewPaperAdSize; ?></span>
                            </span>
                            <span class="w-pr-7 text-left">
                              <span><?php echo Price($data->PublicationCost, "text-success", "Rs."); ?></span>
                            </span>
                            <span class="w-pr-7 text-left">
                              <span><?php echo StatusViewWithText($data->CompaignStatus); ?></span>
                            </span>
                            <span class='text-right w-pr-5'>
                              <span>
                                <a href="update.php?cid=<?php echo SECURE($data->NewCompaignId, "e"); ?>" class="text-info">Details</a>
                              </span>
                            </span>
                          </p>
                      <?php }
                      } ?>
                    </div>
                    <?php PaginationFooter(TOTAL("SELECT * FROM newspapercompaigns"), "index.php"); ?>
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