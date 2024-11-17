<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Training";
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
                        <a href="#" onclick="Databar('Add-New-Training')" style='margin-top:-1.9rem !important;' class='btn btn-sm btn-default pull-right'><i class='fa fa-plus'></i> Add New Training</a>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Sno</th>
                              <th>TrainingName</th>
                              <th>TrainingMode</th>
                              <th>TrainingDate</th>
                              <th>CreatedAt</th>
                              <th>Status</th>
                              <th>CreatedBy</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $AllData = FETCH_DB_TABLE("SELECT * FROM trainings ORDER BY TrainingId DESC", true);
                            if ($AllData != null) {
                              $SerialNo = 0;
                              foreach ($AllData as $data) {
                                $SerialNo++;
                            ?>
                                <tr>
                                  <td><?php echo $SerialNo; ?></td>
                                  <td>
                                    <a href="#" onclick="Databar('update_<?php echo $data->TrainingId; ?>')" class='text-info'><?php echo $data->TrainingName; ?></a>
                                  </td>
                                  </td>
                                  <td><?php echo $data->TrainingMode; ?></td>
                                  <td><?php echo DATE_FORMATE("d M, Y", $data->TrainingDate); ?></td>
                                  <td><?php echo DATE_FORMATE("d M, Y", $data->TrainingCreatedAt); ?></td>
                                  <td><?php echo $data->TrainingStatus; ?></td>
                                  <td>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . $data->TrainingCreatedBy . "'", "UserFullName"); ?> -
                                  </td>
                                  <td>
                                    <a href="#" onclick="Databar('update_<?php echo $data->TrainingId; ?>')" class='btn btn-sm btn-info'>View Details</a>
                                    <?php include "../../include/sections/Update-Training-Details.php"; ?>
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
  include "../../include/sections/Add-New-Training.php";
  include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>