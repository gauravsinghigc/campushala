<?php
$Dir = "../../";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Projects - " . APP_NAME;
$PageDescription = "Manage System Profile, address, logo";
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
      document.getElementById("configs").classList.add("active");
      document.getElementById("system_profile").classList.add("active");
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
                      <h4 class="app-heading"><?php echo $PageName; ?></h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <h5 class="app-sub-heading">Add or Update Available Projects
                        <a href="#" class="btn btn-sm btn-dark pull-right right-btn-m" onclick="Databar('add_projects')">Add Projects</a>
                      </h5>
                      <div id="add_projects" class="hidden">
                        <form action="../../controller/ProjectController.php" method="POST">
                          <?php FormPrimaryInputs(true); ?>
                          <div class="row">
                            <div class="col-md-4 form-group">
                              <select class="form-control" name="ProjectTypeId" required="">
                                <option value="0">Select Project Type</option>
                                <?php
                                $ProjectTypes = FETCH_DB_TABLE("SELECT * FROM configs, config_values where configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigGroupName='UNIVERSITIES'", true);
                                if ($ProjectTypes != null) {
                                  foreach ($ProjectTypes as $Types) {
                                ?>
                                    <option value="<?php echo $Types->ConfigValueId; ?>"><?php echo $Types->ConfigValueDetails; ?></option>
                                <?php }
                                } else {
                                  echo "<option value='0'>No Data Available</option>";
                                }
                                ?>
                              </select>
                            </div>
                            <div class="col-md-8 form-group">
                              <input type="text" class="form-control" name="ProjectName" placeholder="Enter Project Name" required="">
                            </div>
                            <div class="col-md-12 form-group">
                              <textarea class="form-control" name="ProjectDescriptions" rows="3" placeholder="Enter Project Description"></textarea>
                            </div>
                            <div class="col-md-12">
                              <button type="submit" name="SaveNewProjects" class="btn btn-md btn-success mt-0 mb-0" style="margin-top:0px !important;">Save</button>
                              <a href="#" onclick="Databar('add_projects')" class="btn btn-md btn-default">Cancel</a>
                              <hr>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="row">
                        <br>
                        <div class="col-md-12">
                          <?php $Projects = FETCH_DB_TABLE("SELECT * FROM projects", true);
                          if ($Projects != null) {
                            $SerialNo = 0;
                            foreach ($Projects as $Data) {
                              $SerialNo++;
                              $ProjectTypeId = $Data->ProjectTypeId;
                              $TypSql = "SELECT * FROM config_values where ConfigValueId='$ProjectTypeId'"; ?>

                              <div class="data-list flex-s-b">
                                <span>
                                  <span class="count"><?php echo $SerialNo; ?></span>
                                  <a href="details/index.php?proid=<?php echo SECURE($Data->ProjectsId, "e"); ?>">
                                    <?php echo $Data->ProjectName; ?> - <i class='text-grey'><?php echo FETCH($TypSql, "ConfigValueDetails"); ?></i>
                                  </a>
                                </span>
                                <span class="menu">
                                  <span class="text-grey"><i class="fa fa-calendar"></i> <?php echo DATE_FORMATE("d M, Y", $Data->ProjectCreatedAt); ?></span>
                                  <a href="#" onclick="Databar('update_<?php echo $Data->ProjectsId; ?>')" class="text-info">Update</a>
                                  <?php CONFIRM_DELETE_POPUP(
                                    "projects_list",
                                    [
                                      "delete_project_records" => true,
                                      "control_id" => $Data->ProjectsId
                                    ],
                                    "ProjectController",
                                    "Remove",
                                    "text-danger"
                                  ); ?>
                                </span>
                              </div>
                              <div id="update_<?php echo $Data->ProjectsId; ?>" class="hidden">
                                <form action="../../controller/ProjectController.php" method="POST">
                                  <?php FormPrimaryInputs(true, [
                                    "ProjectsId" => $Data->ProjectsId
                                  ]); ?>
                                  <div class="row">
                                    <div class="col-md-4 form-group">
                                      <select class="form-control" name="ProjectTypeId" required="">
                                        <option value="0">Select Project Type</option>
                                        <?php
                                        $ProjectTypes = FETCH_DB_TABLE("SELECT * FROM configs, config_values where configs.ConfigsId=config_values.ConfigValueGroupId and configs.ConfigGroupName='UNIVERSITIES'", true);
                                        if ($ProjectTypes != null) {
                                          foreach ($ProjectTypes as $Types) {
                                            if ($Types->ConfigValueId == $Data->ProjectTypeId) {
                                              $selected = "selected";
                                            } else {
                                              $selected = "";
                                            }
                                        ?>
                                            <option value="<?php echo $Types->ConfigValueId; ?>" <?php echo $selected; ?>><?php echo $Types->ConfigValueDetails; ?></option>
                                        <?php }
                                        } else {
                                          echo "<option value='0'>No Data Available</option>";
                                        }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="col-md-8 form-group">
                                      <input type="text" class="form-control" name="ProjectName" value="<?php echo $Data->ProjectName; ?>" placeholder="Enter Project Name" required="">
                                    </div>
                                    <div class="col-md-12 form-group">
                                      <textarea class="form-control" name="ProjectDescriptions" rows="3" placeholder="Enter Project Description"><?php echo SECURE($Data->ProjectDescriptions, "d"); ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                      <button type="submit" name="UpdateProjectsDetails" class="btn btn-md btn-success mt-0 mb-0" style="margin-top:0px !important;">Save</button>
                                      <a href="#" onclick="Databar('update_<?php echo $Data->ProjectsId; ?>')" class="btn btn-md btn-default">Cancel</a>
                                      <hr>
                                    </div>
                                  </div>
                                </form>
                              </div>
                          <?php }
                          } else {
                            NoListsData("<b>No Project Found!</b><br> Please add some projects");
                          } ?>
                        </div>
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

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>