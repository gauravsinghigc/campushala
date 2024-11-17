<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Assets";
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
                        <h4 class="mb-0"><?php echo $PageName; ?></h4>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Sno</th>
                              <th>AssetName</th>
                              <th>ModalNo</th>
                              <th>SerialNo</th>
                              <th>Cost</th>
                              <th>IssueDate</th>
                              <th>IssueBy</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $AllData = FETCH_DB_TABLE("SELECT * FROM assets where AssetIusseto='" . LOGIN_UserId . "' ORDER BY AssetsId DESC", true);
                            if ($AllData != null) {
                              $SerialNo = 0;
                              foreach ($AllData as $data) {
                                $SerialNo++;
                            ?>
                                <tr>
                                  <td><?php echo $SerialNo; ?></td>
                                  <td>
                                    <a href="#" onclick="Databar('update_<?php echo $data->AssetsId; ?>')" class='text-info'><?php echo $data->AssetName; ?></a>
                                  </td>
                                  </td>
                                  <td><?php echo $data->AssetModalNo; ?></td>
                                  <td><?php echo $data->AssetSerialNo; ?></td>
                                  <td><?php echo $data->AssetsCost; ?></td>
                                  <td><?php echo DATE_FORMATE("d M, Y", $data->AssetDateOfIssue); ?></td>
                                  <td>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . $data->AssetsCreatedBy . "'", "UserFullName"); ?> -
                                  </td>
                                </tr>
                            <?php
                              }
                            } ?>
                          </tbody>
                        </table>
                      </div>
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


  <?php
  include "../../include/sections/Add-New-Assets.php";
  include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>