<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "BDE Update Details";
$PageDescription = "Manage all domains";
$btntext = "Add New Leads";
$DomainExpireInCurrentMonth = date("Y-m-d", strtotime("+1 month"));

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $by = $_GET['by'];
    $level = $_GET['level'];
    $LeadPersonSource = $_GET['LeadPersonSource'];
} else {
    $type = "";
    $from = date("Y-m-d");
    $to = date("Y-m-d");
    $by = "1";
    $level = "";
    $LeadPersonSource = "";
}
if (isset($_GET['id'])) {
    $bdes_id = SECURE($_GET['id'], "d");
} else {
    $bdes_id = "";
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
    <script type="text/javascript">
        function SidebarActive() {
            document.getElementById("leads").classList.add("active");
            document.getElementById("lead_add_calls").classList.add("active");
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
                                        <div class="col-sm-12 col-12">
                                            <h3 class="app-heading"><?php echo $PageName; ?></h3>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <form action="<?php echo CONTROLLER; ?>/BdesController.php" method="POST">
                                                <?php FormPrimaryInputs(true, [
                                                    "BdeId" => $bdes_id,
                                                ]); ?>
                                                <?php $fetchBdes = FETCH_DB_TABLE("SELECT * FROM bdes_primary_details WHERE bdes_id='$bdes_id'", true);
                                                if (isset($fetchBdes)) {
                                                    foreach ($fetchBdes as $val) {

                                                ?>
                                                        <div class="col-md-12">
                                                            <div class="card student-card mx-auto">
                                                                <div class="tab">
                                                                    <div class="card-header">
                                                                        Primary Details
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-4 form-group">
                                                                                <label>First Name <?php echo $req; ?></label>
                                                                                <input type="text" value="<?php if (isset($val->bdes_first_name)) {
                                                                                                                echo $val->bdes_first_name;
                                                                                                            } ?>" name="bdes_first_name" class="form-control form-control-sm" required="">
                                                                            </div>
                                                                            <div class="col-md-4 form-group">
                                                                                <label>Last Name</label>
                                                                                <input type="text" value="<?php if (isset($val->bdes_last_name)) {
                                                                                                                echo $val->bdes_last_name;
                                                                                                            } ?>" name="bdes_last_name" class="form-control form-control-sm">
                                                                            </div>
                                                                            <div class="col-md-4 form-group">
                                                                                <label>Phone Number <?php echo $req; ?></label>
                                                                                <input type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" value="<?php if (isset($val->bdes_phone_no)) {
                                                                                                                                                                                                echo $val->bdes_phone_no;
                                                                                                                                                                                            } ?>" name="bdes_phone_no" class="form-control form-control-sm" required="">
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Email-ID <?php echo $req; ?></label>
                                                                                <input type="email" oninput="CheckExistingMailId()" id="EmailId" value="<?php if (isset($val->bdes_email_id)) {
                                                                                                                                                            echo $val->bdes_email_id;
                                                                                                                                                        } ?>" name="bdes_email_id" class="form-control form-control-sm" required="">
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Password </label>
                                                                                <input readonly type="password" value="<?php if (isset($val->bdes_password)) {
                                                                                                                            echo $val->bdes_password;
                                                                                                                        } ?>" name="bdes_password" class="form-control form-control-sm">
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Address <?php echo $req; ?></label>
                                                                                <textarea name="bdes_address_line1" class="form-control form-control-sm" rows="2" required><?php if (isset($val->bdes_address_line1)) {
                                                                                                                                                                                echo $val->bdes_address_line1;
                                                                                                                                                                            } ?></textarea>
                                                                            </div>
                                                                            <div class='col-md-6 form-group'>
                                                                                <label>Address 2 </label>
                                                                                <textarea name="bdes_address_line2" class="form-control form-control-sm" rows="2"><?php if (isset($val->bdes_address_line2)) {
                                                                                                                                                                        echo $val->bdes_address_line2;
                                                                                                                                                                    } ?></textarea>
                                                                            </div>
                                                                            <div class='col-md-4 form-group'>
                                                                                <label>City <?php echo $req; ?></label>
                                                                                <input type="text" value="<?php if (isset($val->bdes_city)) {
                                                                                                                echo $val->bdes_city;
                                                                                                            } ?>" name="bdes_city" class="form-control form-control-sm" required="">
                                                                            </div>
                                                                            <div class='col-md-4 form-group'>
                                                                                <label>State <?php echo $req; ?></label>
                                                                                <input type="text" value="<?php if (isset($val->bdes_state)) {
                                                                                                                echo $val->bdes_state;
                                                                                                            } ?>" name="bdes_state" class="form-control form-control-sm" required="">
                                                                            </div>
                                                                            <div class='col-md-4 form-group'>
                                                                                <label>Country <?php echo $req; ?></label>
                                                                                <select name="bdes_country" class="form-control form-control-sm" required="">
                                                                                    <?php foreach (AllCountryList() as $values) {
                                                                                        if ($values == $val->bdes_country) {
                                                                                            $Selected = "selected";
                                                                                        } else {
                                                                                            $Selected = "";
                                                                                        } ?>
                                                                                        <option value="<?= $values ?>" <?= $Selected ?>><?= $values ?></option>
                                                                                    <?php }  ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class='col-md-4 form-group'>
                                                                                <label>Zip </label>
                                                                                <input type="text" value="<?php if (isset($val->bdes_zip)) {
                                                                                                                echo $val->bdes_zip;
                                                                                                            } ?>" name="bdes_zip" class="form-control form-control-sm">
                                                                            </div>
                                                                            <div class="col-md-4 form-group">
                                                                                <label></label>
                                                                                <div class="form-check"><input class="form-check-input" type="checkbox" name="checkOut" value="checkOut" id="gridCheck" required> <label class="form-check-label" for="gridCheck"> Check me out </label></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 d-flex justify-content-between btn">
                                                                    <a href="index.php" class="btn btn-sm btn-default cancel">Back</a>
                                                                    <button type="submit" class="btn btn-sm btn-success next" name="UpdateBdesData" value="UpdateBdesData">Update Bde Details</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                <?php  }
                                                } ?>
                                        </div>

                                        </form>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</body>

</html>