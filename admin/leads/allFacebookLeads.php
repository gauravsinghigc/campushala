<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Facebook New Lead";
$PageDescription = "Manage all leads";
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
            document.getElementById("leads").classList.add("active");
            document.getElementById("leads_add").classList.add("active");
        }
        window.onload = SidebarActive;
    </script>
    <style>
        .form-group {
            margin-bottom: 0px !important;
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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="app-heading"><?php echo $PageName; ?> <small>| <?php echo $PageDescription; ?></small></h4>
                                </div>
                            </div>
                            <?php $fetchLeads = FETCH_DB_TABLE("SELECT * FROM config_facebook_accounts", true);
                            if (isset($fetchLeads)) {
                                foreach ($fetchLeads as $val) {
                                  $Id=  $val->id;
                            ?>
                                    <form action=" <?php echo CONTROLLER; ?>/FacebookLeadsController.php" method="POST">
                                        <?php FormPrimaryInputs(true, [
                                            "requredid" => $Id,

                                        ]); ?>
                                        <div class="row">

                                            <div class="col-md-7">
                                                <h5 class="app-sub-heading">FaceBook Ads Account Details</h5>

                                                <div class="row mb-5px">
                                                    <div class="form-group col-md-5">
                                                        <label>Facebook Page Name</label>
                                                        <input type="text" name="fb_page_name" list="fb_page_name" class="form-control" required="" value="<?= $val->fb_page_name ?>">

                                                    </div>
                                                    <div class="form-group col-md-7">
                                                        <label>Facebook AdAccount Id</label>
                                                        <input type="text" name="fb_adaccounts_id" list="fb_adaccounts_id" class="form-control" required="" value="<?= $val->fb_adaccounts_id ?>">

                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label>Facebook Campaigns Id</label>
                                                        <input type="text" name="fb_campaigns_id" list="fb_campaigns_id" class="form-control" required="" value="<?= $val->fb_campaigns_id ?>">

                                                    </div>
                                                    <div class="form-group col-md-7">
                                                        <label>Facebook Campaigns Name</label>
                                                        <input type="text" name="fb_campaigns_name" list="fb_campaigns_name" class="form-control" required="" value="<?= $val->fb_campaigns_name ?>">

                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label>Facebook Adsets Id</label>
                                                        <input type="text" name="fb_adsets_id" list="fb_adsets_id" class="form-control" required="" value="<?= $val->fb_adsets_id ?>">

                                                    </div>
                                                    <div class="form-group col-md-7">
                                                        <label>Facebook Adsets Name</label>
                                                        <input type="text" name="fb_adsets_name" list="fb_adsets_name" class="form-control" required="" value="<?= $val->fb_adsets_name ?>">

                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label>Facebook AdsId </label>
                                                        <input type="text" name="fb_ads_id" list="fb_ads_id" class="form-control" required="" value="<?= $val->fb_ads_id ?>">

                                                    </div>
                                                    <div class="form-group col-md-7">
                                                        <label>Facebook Ads Name</label>
                                                        <input type="text" name="fb_ads_name" list="fb_ads_name" class="form-control" required="" value="<?= $val->fb_ads_name ?>">

                                                    </div>
                                                </div>

                                                <div class="row mb-5px">
                                                    <div class="col-md-12">
                                                        <a href='index.php' class="btn btn-md btn-default mt-3"><i class="fa fa-angle-left"></i> Back to All Leads</a>
                                                        <button class="btn btn-md btn-dark" name="FetchAllFBLeads" TYPE="submit"><i class="fa fa-check"></i> Fetch New Facebook Leads</button>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                }
                            } ?>
                                    <div class="col-md-5">
                                        <h4 class="app-heading">Select Need & Requirements</h4>
                                        <!-- <div class="row mb-5px pt-3">
                                            <?php
                                            //                             $Requirement = FETCH_DB_TABLE("SELECT * FROM projects", true);
                                            //                             foreach ($Requirement as $List) {
                                            //                                 $ProjectType = FETCH("SELECT * FROM config_values where ConfigValueId='" . $List->ProjectTypeId . "'", "ConfigValueDetails");
                                            //                                 echo "
                                            //   <div class='form-group col-md-12'>
                                            //   <div class='form-check form-check-inline'>
                                            //   <input class='form-check-input checkbox-list mt-0' type='checkbox' name='LeadRequirementDetails[]' value='" . $List->ProjectName . " - $ProjectType'>
                                            //   <h6 class='form-check-label text-grey mb-0'>" . $List->ProjectName . " - <i class='text-grey'>$ProjectType</i></h6>
                                            //   </div>
                                            //   </div>";
                                            //                             } 
                                            ?>
                                        </div> -->

                                    </div>
                                        </div>
                                    </form>
                        </div>
                    </div>
                    <script>
                        function CheckCallStatus() {
                            var call_status = document.getElementById("call_status");
                            if (call_status.value == "FollowUp" ||
                                call_status.value == "Follow Up" ||
                                call_status.value == "follow up" ||
                                call_status.value == "Follow up") {
                                document.getElementById("call_reminder").classList.remove("hidden");
                            } else {
                                document.getElementById("call_reminder").classList.add("hidden");
                            }
                        }
                    </script>
                </div>
            </section>
        </div>

        <?php include $Dir . "/include/admin/footer.php"; ?>
    </div>

    <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>