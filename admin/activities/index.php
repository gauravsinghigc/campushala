<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';


//page variables
$PageName = "All Activities";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include $Dir . "/include/admin/loader.php"; ?>

    <?php
    include $Dir . "/include/admin/header.php";
    include $Dir . "/include/admin/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?php echo $PageName; ?></h1>
            </div>
            <div class="col-sm-6">

            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">
                  <a href="export.php" class="btn btn-sm btn-primary square btn-labeled fa fa-file-pdf-o" target="_blank">Export</a>
                  <table class="table table-striped display">
                    <thead>
                      <tr>
                        <th>SNo</th>
                        <th>logTitle</th>
                        <th>Details</th>
                        <th>created_at</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = 0;
                      $SqlLogs = SELECT("SELECT * FROM systemlogs ORDER by LogsId ASC");
                      while ($FetchLogs =  mysqli_fetch_assoc($SqlLogs)) {
                        $logTitle = SECURE($FetchLogs['logTitle'], "d");
                        $logdesc = SECURE($FetchLogs['logdesc'], "d");
                        $created_at = date("d M, Y h:m:s A", strtotime($FetchLogs['created_at']));
                        $systeminfo = SECURE($FetchLogs['systeminfo'], "d");
                        $count++; ?>
                        <tr>
                          <td><?php echo $count; ?></td>
                          <td><?php echo $logTitle; ?></td>
                          <td><?php echo $logdesc; ?></td>
                          <td><?php echo $created_at; ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>