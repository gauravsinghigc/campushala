<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All PIPS";
$PageDescription = "Manage all customers";
$UserPIPRefNo = "#PIP" . date("dmy") . rand(0, 9999);
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
                      <a href="#" onclick="Databar('AddPIPRecord')" class="btn btn-block btn-danger"><i class="fa fa-plus"></i> Send PIP</a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-6">
                      <div class="card p-2">
                        <h1><?php echo TOTAL("SELECT * FROM user_pips"); ?></h1>
                        <p class="text-gray">All PIPS</p>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                      <div class="card p-2">
                        <h1><?php echo TOTAL("SELECT * FROM user_pips where DATE(UserPIPCreatedAt)='" . date('Y-m-d') . "'"); ?></h1>
                        <p class="text-gray">Today Sent PIPs</p>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                      <div class="card p-2">
                        <h1><?php echo TOTAL("SELECT * FROM user_pips where YEAR(UserPIPCreatedAt)='" . date('Y') . "' and MONTH(UserPIPCreatedAt)='" . date('m') . "'"); ?></h1>
                        <p class="text-gray">Current Month PIPs</p>
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-6">
                      <div class="card p-2">
                        <h1><?php echo TOTAL("SELECT * FROM user_pips where YEAR(UserPIPCreatedAt)='" . date('Y') . "'"); ?></h1>
                        <p class="text-gray">This Year PIPs</p>
                      </div>
                    </div>
                  </div>

                  <form class="row mt-2">
                    <div class="col-md-4 form-group">
                      <input type="search" value="<?php echo IfRequested("GET", "UserPIPSubjectName", "", false); ?>" name="UserPIPSubjectName" class="form-control form-control-sm" placeholder="Search PIP...." onchange="form.submit()">
                    </div>
                    <div class="col-md-4 form-group">
                      <select name="UserPIPMainUserId" class="form-control form-control-sm" required="" onchange="form.submit()">
                        <option value="">All Users</option>
                        <?php $AllUsers = FETCH_DB_TABLE("SELECT * FROM users where UserStatus='1' ORDER BY UserFullName ASC", true);
                        if ($AllUsers != null) {
                          foreach ($AllUsers as $User) {
                            if (isset($_GET['UserPIPMainUserId'])) {
                              if ($_GET['UserPIPMainUserId'] == $User->UserId) {
                                $selected = "selected";
                              } else {
                                $selected = "";
                              }
                            } else {
                              $selected = "";
                            }
                        ?>
                            <option value="<?php echo $User->UserId; ?>" <?php echo $selected; ?>><?php echo $User->UserFullName; ?> @ <?php echo $User->UserPhoneNumber; ?></option>
                        <?php
                          }
                        } ?>
                      </select>
                    </div>
                    <?php if (isset($_GET['UserPIPSubjectName'])) {
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
                        <span class="w-pr-20">SubjectName</span>
                        <span class="w-pr-15">MemberName</span>
                        <span class="w-pr-10">SendDate</span>
                        <span class="w-pr-10">MailStatus</span>
                        <span class="w-pr-5 text-right">Action</span>
                      </p>
                    </div>
                    <?php
                    $start = START_FROM;
                    $end = DEFAULT_RECORD_LISTING;

                    if (isset($_GET['UserPIPSubjectName'])) {
                      $TotalItems = TOTAL("SELECT * FROM user_pips where UserPIPSubjectName like '%" . $_GET['UserPIPSubjectName'] . "%' and UserPIPMainUserId='" . $_GET['UserPIPMainUserId'] . "' ORDER by DATE(UserPIPCreatedAt) DESC");
                    } else {
                      $TotalItems = TOTAL("SELECT * FROM user_pips ORDER by DATE(UserPIPCreatedAt) DESC limit $start, $end");
                    }

                    if (isset($_GET['UserPIPSubjectName'])) {
                      $AllRewards = FETCH_DB_TABLE("SELECT * FROM user_pips where UserPIPSubjectName like '%" . $_GET['UserPIPSubjectName'] . "%' and UserPIPMainUserId='" . $_GET['UserPIPMainUserId'] . "' ORDER by DATE(UserPIPCreatedAt) DESC", true);
                    } else {
                      $AllRewards = FETCH_DB_TABLE("SELECT * FROM user_pips ORDER by DATE(UserPIPCreatedAt) DESC limit $start, $end", true);
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
                            <span class="w-pr-20">
                              <a href="#" onclick="Databar('update_<?php echo $Reward->UserPipId; ?>')" class="text-primary">
                                <?php echo $Reward->UserPIPSubjectName; ?>
                              </a>
                            </span>
                            <span class="w-pr-15">
                              <span class="bold">
                                <?php echo FETCH("SELECT UserFullName FROM users where UserId='" . $Reward->UserPIPMainUserId . "'", "UserFullName"); ?>
                              </span>
                            </span>
                            <span class="w-pr-10">
                              <?php echo DATE_FORMATE("d M, Y", $Reward->UserPIPCreatedAt); ?>
                            </span>
                            <span class="w-pr-10">
                              <?php echo $Reward->UserPIPEmailStatus; ?>
                            </span>
                            <span class="w-pr-5 text-right">
                              <a href="#" onclick="Databar('update_<?php echo $Reward->UserPipId; ?>')" class="text-info">Details</a>
                            </span>
                          </div>
                        </div>
                    <?php
                        include $Dir . "/include/sections/Update-PIP-Details.php";
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
    include $Dir . "/include/sections/Add-New-PIPs.php";
    include $Dir . "/include/admin/footer.php";
    ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>