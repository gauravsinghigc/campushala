<?php
$Dir = "../../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "Lead Details";
$PageDescription = "Manage all customers";

if (isset($_GET['LeadsId'])) {
  $_SESSION['REQ_LeadsId'] = SECURE($_GET['LeadsId'], "d");
  $REQ_LeadsId = $_SESSION['REQ_LeadsId'];
} else {
  $REQ_LeadsId = $_SESSION['REQ_LeadsId'];
}

$PageSqls = "SELECT * FROM leads where LeadsId='$REQ_LeadsId'";
$LeadRequirementDetails = FETCH("SELECT * FROM lead_requirements where LeadMainId='$REQ_LeadsId'", "LeadRequirementDetails");
$ProjectSql = "SELECT * FROM projects where ProjectsId='$LeadRequirementDetails'";
$PROJECT_VIEW_ID = FETCH($ProjectSql, "ProjectsId");
$ProjectMediaSql = "SELECT * FROM project_media_files where ProjectMainId='$PROJECT_VIEW_ID'";
$TypSql = "SELECT * FROM config_values where ConfigValueId='" . FETCH($ProjectSql, "ProjectTypeId") . "'";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo GET_DATA("leads", "LeadPersonFullname", "LeadsId='$REQ_LeadsId'"); ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
  <?php include $Dir . "/include/admin/header_files.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("leads").classList.add("active");
      document.getElementById("all_leads").classList.add("active");
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
                    <?php if (LOGIN_UserType == "Admin") { ?>
                      <div class="col-md-12">
                        <div class="flex-s-b">
                          <a href="?LeadsId=<?php echo SECURE($REQ_LeadsId - 1, "e"); ?>" class="btn btn-primary btn-md"><i class="fa fa-angle-left"></i> Previous Lead</a>
                          <a href="?LeadsId=<?php echo SECURE($REQ_LeadsId + 1, "e"); ?>" class="btn btn-success btn-md"> Next Lead <i class="fa fa-angle-right"></i></a>
                        </div>
                      </div>
                    <?php } ?>
                    <div class="col-md-12">
                      <h4 class="app-heading"><b>All Leads | </b><?php echo $PageName; ?> <small class="text-white"><?php echo LEADID($REQ_LeadsId); ?></small></h4>
                    </div>
                    <?php $CheclEADS = CHECK($PageSqls);
                    if ($CheclEADS != null) { ?>
                      <div class="col-md-12">
                        <a href="../../../index.php" class="btn btn-sm btn-default m-1"><i class="fa fa-angle-left"></i> Dashboard </a>
                        <a href="../../index.php" class="btn btn-sm btn-default m-1"><i class="fa fa-angle-left"></i> ALL Leads </a>
                        <a href="../../../calls/add.php" class="btn btn-sm btn-default m-1"><i class="fa fa-angle-left"></i> Callings Data </a>
                        <a href="edit-deals.php?dealsid=<?php echo SECURE($REQ_LeadsId, "e"); ?>" class="btn btn-sm btn-info m-1 text-white"><i class="fa fa-edit"></i> Edit Details</a>
                        <a onclick="Databar('AddFollowUps')" class="btn btn-sm btn-success pull-right m-1" data-toggle="modal"><i class="fa fa-phone"></i> Add Feedback</a>
                      </div>

                      <div class="col-md-12">
                        <?php if (isset($_GET['alert'])) {
                          $hidden = "";
                        } else {
                          $hidden = "hidden";
                        } ?>
                        <div class="row mt-2">
                          <div class="col-md-6">
                            <div class="p-2 mt-3">
                              <div class="flex-start">
                                <h3><i class="fa fa-user"></i></h3>
                                <h4 class="ml-1 p-1"><?php echo GET_DATA("leads", "LeadPersonFullname", "LeadsId='$REQ_LeadsId'"); ?></h4>
                              </div>
                              <h5><?php echo LeadStage(GET_DATA("leads", "LeadPersonStatus", "LeadsId='$REQ_LeadsId'")); ?> <?php echo LeadStatus(GET_DATA("leads", "LeadPriorityLevel", "LeadsId='$REQ_LeadsId'")); ?></h5>
                              <p class="description mt-1 flex-column">
                                <span>
                                  <?php echo PHONE(GET_DATA("leads", "LeadPersonPhoneNumber", "LeadsId='$REQ_LeadsId'"), "link", "text-black", "fa fa-phone text-primary"); ?>
                                </span><br>
                                <span>
                                  <?php echo EMAIL(GET_DATA("leads", "LeadPersonEmailId", "LeadsId='$REQ_LeadsId'"), "link", "text-black", "fa fa-envelope text-danger"); ?>
                                </span><br>
                                <span>
                                  <?php echo ADDRESS(GET_DATA("leads", "LeadPersonAddress", "LeadsId='$REQ_LeadsId'"), "link", "text-black", "fa fa-map-marker text-success"); ?>
                                </span>
                              </p>
                              <p class="flex-s-b mt-2">
                                <span>
                                  <span class="text-grey">Created By</span><br>
                                  <span class="team-list">
                                    <i class="fa fa-user"></i>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . GET_DATA("leads", 'LeadPersonCreatedBy', "LeadsId='$REQ_LeadsId'") . "'", "UserFullName"); ?>
                                  </span>
                                </span>
                                <span>
                                  <span class="text-grey">Managed By / Assigned To</span><br>
                                  <span class="team-list">
                                    <i class="fa fa-user"></i>
                                    <?php echo FETCH("SELECT * FROM users where UserId='" . GET_DATA("leads", 'LeadPersonManagedBy', "LeadsId='$REQ_LeadsId'") . "'", "UserFullName"); ?>
                                  </span>
                                </span>
                              </p>
                              <p class="desc flex-s-b mt-3">
                                <span>
                                  <span class="text-grey">Created At</span><br>
                                  <span class="text"><?php echo DATE_FORMATE("d M, Y", GET_DATA("leads", "LeadPersonCreatedAt", "LeadsId='$REQ_LeadsId'")); ?></span>
                                </span>

                                <span>
                                  <span class="text-grey">Last Updated At</span><br>
                                  <span class="text"><?php if (DATE_FORMATE("d M, Y", GET_DATA("leads", "LeadPersonLastUpdatedAt", "LeadsId='$REQ_LeadsId'")) ==  "01 Jan, 1970") {
                                                        echo "No Update!";
                                                      } else {
                                                        echo DATE_FORMATE("d M, Y", GET_DATA("leads", "LeadPersonLastUpdatedAt", "LeadsId='$REQ_LeadsId'"));
                                                      }; ?></span>
                                </span>
                              </p>
                              <hr>
                              <h5 class="app-heading">Project Details</h5>
                              <form class="row">
                                <div class="col-md-12 form-group">
                                  <select onload="form.submit()" onchange="form.submit()" name="ProjectName" class="form-control form-control-sm" required="">
                                    <option value="1">Select Project </option>
                                    <?php
                                    $Alldata = FETCH_DB_TABLE("SELECT * FROM projects ORDER BY ProjectName", true);
                                    if ($Alldata != null) {
                                      foreach ($Alldata as $Data) {
                                        if (isset($_GET['ProjectName'])) {
                                          if ($_GET['ProjectName'] == $Data->ProjectsId) {
                                            $selected = "selected";
                                          } else {
                                            $selected = "";
                                          }
                                        } else {
                                          $selected = "";
                                        }
                                        echo "<option value='" . $Data->ProjectsId . "' $selected>" . $Data->ProjectName . "</option>";
                                      }
                                    } else {
                                      echo "<option value='0'>No Project Found!</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </form>
                              <?php
                              if (isset($_GET['ProjectName'])) {
                                $ProjectName = $_GET['ProjectName'];
                                $FetchProjects = FETCH_DB_TABLE("SELECT * FROM projects where ProjectsId='" . $ProjectName . "'", true);
                                if ($FetchProjects == null) {
                                  NoData("No Project Found!");
                                } else {
                                  foreach ($FetchProjects as $Data) {
                                    $ProjectID = $Data->ProjectsId;
                              ?>
                                    <div class="row">
                                      <div class="col-md-12">
                                        <h5 class='app-sub-heading'><span class='small'>Project Description</span> <br> <b><?php echo $Data->ProjectName; ?></b></h5>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="table-responsive">
                                          <table class="table table-striped">
                                            <tbody>
                                              <tr>
                                                <th>Project ID</th>
                                                <td><?php echo $Data->ProjectsId; ?></td>
                                              </tr>
                                              <tr>
                                                <th>Project Name</th>
                                                <th><?php echo $Data->ProjectName; ?></th>
                                              </tr>
                                              <tr>
                                                <th>Project Type</th>
                                                <td><?php echo FETCH("SELECT * FROM config_values where ConfigValueGroupId='5'", "ConfigValueDetails"); ?></td>
                                              </tr>
                                              <tr>
                                                <th>Created At</th>
                                                <td><?php echo DATE_FORMATE("d M, Y", $Data->ProjectCreatedAt); ?></td>
                                              </tr>
                                              <tr>
                                                <th>Created By</th>
                                                <td>(UID<?php echo $Data->ProjectCreatedBy; ?>)-<?php echo FETCH("SELECT * FROM users where UserId='" . $Data->ProjectCreatedBy . "'", "UserFullName"); ?></td>
                                              </tr>
                                              <tr>
                                                <th>Description</th>
                                                <td><?php echo SECURE($Data->ProjectDescriptions, "d"); ?></td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                              <?php
                                  }
                                }
                              } else {
                                $ProjectName = 0;
                              } ?>

                            </div>
                            <?php
                            $ProjectID = $ProjectName;
                            $PROJECT_VIEW_ID = $ProjectID;
                            $ProjectSql = "SELECT * FROM projects where ProjectsId='$ProjectID'";
                            $SharingTemplates = "Hey ";
                            $SharingTemplates .= "*" . FETCH($PageSqls, "LeadPersonFullname") . "*, %0a %0a";
                            $SharingTemplates .= "We are sharing project details of *";
                            $SharingTemplates .= FETCH($ProjectSql, "ProjectName");
                            $SharingTemplates .= "* with you. %0a %0a";
                            $SharingTemplates .= "*♣Project Documents are:* %0a %0a";
                            $FetchData = FETCH_DB_TABLE("SELECT * FROM project_media_files where ProjectMediaFileType='pdf' and ProjectMainId='$PROJECT_VIEW_ID'", true);
                            if ($FetchData != null) {
                              foreach ($FetchData as $data) {
                                $SharingTemplates .= "• " . $data->ProjectMediaFileName . " : %0a";
                                $SharingTemplates .= STORAGE_URL . "/projects/" . $data->ProjectMainId . "/media/" . $data->ProjectMediaFileDocument . "%0a %0a";
                              }
                            }
                            $FetchData = FETCH_DB_TABLE("SELECT * FROM project_media_files where ProjectMediaFileType='images' and ProjectMainId='$PROJECT_VIEW_ID'", true);
                            if ($FetchData != null) {
                              foreach ($FetchData as $data) {
                                $SharingTemplates .= "• " . $data->ProjectMediaFileName . " : %0a";
                                $SharingTemplates .= STORAGE_URL . "/projects/" . $data->ProjectMainId . "/media/" . $data->ProjectMediaFileDocument . "%0a %0a";
                              }
                            }
                            $FetchData = FETCH_DB_TABLE("SELECT * FROM project_media_files where ProjectMediaFileType='u-links' and ProjectMainId='$PROJECT_VIEW_ID'", true);
                            if ($FetchData != null) {
                              foreach ($FetchData as $data) {
                                $SharingTemplates .= "• " . $data->ProjectMediaFileName . " : %0a";
                                $SharingTemplates .= "https://www.youtube.com/embed/" . $data->ProjectMediaFileDocument . "%0a %0a";
                              }
                            }

                            $SharingTemplates .= "- %0a";
                            $SharingTemplates .= "*Regards* %0a";
                            $SharingTemplates .= FETCH("SELECT * FROM users where UserId='" . GET_DATA("leads", 'LeadPersonManagedBy', "LeadsId='$REQ_LeadsId'") . "'", "UserFullName") . "%0a";
                            $SharingTemplates .= FETCH("SELECT * FROM users where UserId='" . GET_DATA("leads", 'LeadPersonManagedBy', "LeadsId='$REQ_LeadsId'") . "'", "UserPhoneNumber") . "%0a";
                            $SharingTemplates .= FETCH("SELECT * FROM users where UserId='" . GET_DATA("leads", 'LeadPersonManagedBy', "LeadsId='$REQ_LeadsId'") . "'", "UserEmailId") . "%0a";
                            ?>
                            <div class="row">
                              <div class="col-md-12">
                                <h5 class="app-heading">Project Details</h5>
                                <div class="flex-s-b">
                                  <a href="whatsapp://send?phone=91<?php echo FETCH($PageSqls, "LeadPersonPhoneNumber"); ?>&text=<?php echo $SharingTemplates; ?>" class="btn btn-sm btn-success"><i class="fa fa-whatsapp"></i> Share Details on Whatsapp</a>
                                  <?php if (DEVICE_TYPE == "MOBILE") { ?>
                                    <a href="share://send?data=<?php echo $SharingTemplates; ?>" class="btn btn-sm btn-info"><i class="fa fa-share"></i> Share Details</a>
                                  <?php } ?>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <h6 class="app-sub-heading">Project Pdf Files</h6>
                                <?php
                                $FetchData = FETCH_DB_TABLE("SELECT * FROM project_media_files where ProjectMediaFileType='pdf' and ProjectMainId='$PROJECT_VIEW_ID'", true);
                                if ($FetchData != null) {
                                  foreach ($FetchData as $data) {
                                ?>
                                    <p class="data-list flex-s-b">
                                      <span class="">
                                        <?php echo $data->ProjectMediaFileName; ?>
                                      </span>
                                      <span class="text-right">
                                        <a href="<?php echo STORAGE_URL; ?>/projects/<?php echo $data->ProjectMainId; ?>/media/<?php echo $data->ProjectMediaFileDocument; ?>" download="<?php echo STORAGE_URL; ?>/projects/<?php echo $data->ProjectMainId; ?>/media/<?php echo $data->ProjectMediaFileDocument; ?>" class='btn btn-xs btn-success' target="_blank"><i class="fa fa-download"></i></a>
                                        <a href="<?php echo STORAGE_URL; ?>/projects/<?php echo $data->ProjectMainId; ?>/media/<?php echo $data->ProjectMediaFileDocument; ?>" class='btn btn-xs btn-info' target="_blank"><i class="fa fa-file-pdf"></i></a>
                                    </p>
                                <?php
                                  }
                                } ?>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <h6 class="app-sub-heading">Images</h6>
                                <?php
                                $FetchData = FETCH_DB_TABLE("SELECT * FROM project_media_files where  ProjectMediaFileType='images' and ProjectMainId='$PROJECT_VIEW_ID'", true);
                                if ($FetchData != null) {
                                  foreach ($FetchData as $data) {
                                ?>
                                    <div class="media-list">
                                      <a target="_blank" href="<?php echo STORAGE_URL; ?>/projects/<?php echo $data->ProjectMainId; ?>/media/<?php echo $data->ProjectMediaFileDocument; ?>">
                                        <div>
                                          <img src="<?php echo STORAGE_URL; ?>/projects/<?php echo $data->ProjectMainId; ?>/media/<?php echo $data->ProjectMediaFileDocument; ?>" class="img-fluid">
                                          <p><?php echo $data->ProjectMediaFileName; ?></p>
                                          <a href="<?php echo STORAGE_URL; ?>/projects/<?php echo $data->ProjectMainId; ?>/media/<?php echo $data->ProjectMediaFileDocument; ?>" download="<?php echo STORAGE_URL; ?>/projects/<?php echo $data->ProjectMainId; ?>/media/<?php echo $data->ProjectMediaFileDocument; ?>" class='btn btn-xs btn-success' target="_blank"><i class="fa fa-download"></i></a>
                                          <a href="<?php echo STORAGE_URL; ?>/projects/<?php echo $data->ProjectMainId; ?>/media/<?php echo $data->ProjectMediaFileDocument; ?>" class='btn btn-xs btn-info' target="_blank"><i class="fa fa-eye"></i></a>
                                        </div>
                                      </a>
                                    </div>
                                <?php
                                  }
                                } ?>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-12">
                                <h6 class="app-sub-heading">Youtube Videos</h6>
                                <?php
                                $FetchData = FETCH_DB_TABLE("SELECT * FROM project_media_files where  ProjectMediaFileType='u-links' and ProjectMainId='$PROJECT_VIEW_ID'", true);
                                if ($FetchData != null) {
                                  foreach ($FetchData as $data) {
                                ?>
                                    <div class="media-list">
                                      <div>
                                        <iframe src="https://www.youtube.com/embed/<?php echo $data->ProjectMediaFileDocument; ?>" title="<?php echo $data->ProjectMediaFileName; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <br> <?php echo $data->ProjectMediaFileName; ?><br>
                                      </div>
                                    </div>
                                <?php
                                  }
                                } ?>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-6">
                            <div class="row">
                              <div class="col-md-12 data-display">
                                <div class="rounded-2">
                                  <h4 class="app-heading bg-danger">Activity History</h4>
                                  <ul class="calling-list pt-0">
                                    <?php
                                    $fetclFollowUps = FETCH_DB_TABLE("SELECT * FROM lead_followups where LeadFollowMainId='$REQ_LeadsId' ORDER BY LeadFollowUpId DESC", true);
                                    if ($fetclFollowUps != null) {
                                      foreach ($fetclFollowUps as $F) { ?>
                                        <li>
                                          <span><?php echo CallTypes("" . $F->LeadFollowUpCallType . ""); ?></span>
                                          <p style="line-height:normal !important;">
                                            <span style="font-size:0.8rem !important;">
                                              <span style="color:grey !important;"><?php echo DATE_FORMATE("d M, Y", $F->LeadFollowUpCreatedAt); ?></span> - <span class="text-grey" style="color:grey !important;"><?php echo $F->LeadFollowCurrentStatus; ?></span><br>
                                              <?php if ($F->LeadFollowStatus == "Follow Up" or $F->LeadFollowStatus == "follow Up" || $F->LeadFollowStatus == "FollowUp" || $F->LeadFollowStatus == "FOLLOW UP") { ?>
                                                <i class="fa fa-clock"></i>
                                              <?php } ?> <span class="text-grey"><?php echo $F->LeadFollowStatus; ?>
                                                <?php if (DATE_FORMATE("d M, Y", $F->LeadFollowUpDate) != "No Update") { ?>
                                                  @ <span class="text-success"><?php echo DATE_FORMATE("d M, Y", $F->LeadFollowUpDate); ?> <?php echo $F->LeadFollowUpTime; ?></span>
                                                <?php } ?>
                                              </span>
                                            </span><br>
                                            <span style="font-size:1rem;">
                                              <span class="text-black"><?php echo $F->LeadFollowUpDescriptions; ?></span>
                                              <br>
                                              <i style="font-size:0.85rem;" class="text-grey">By <?php echo FETCH("SELECT * FROM users where UserId='" . $F->LeadFollowUpHandleBy . "'", "UserFullName"); ?></i>
                                            </span>
                                          </p>
                                        </li>
                                    <?php
                                      }
                                    } else {
                                      NoData("No FollowUps or History Found!");
                                    } ?>
                                  </ul>
                                </div>
                              </div>

                            </div>


                            <div class="lead-actions">
                              <ul>
                                <li>
                                  <a href="mailto:<?php echo FETCH($PageSqls, "LeadPersonEmailId"); ?>">
                                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/mail.jpg" style="width:50px;">
                                  </a>
                                </li>
                                <li>
                                  <a href="tel:+91<?php echo FETCH($PageSqls, "LeadPersonPhoneNumber"); ?>">
                                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/call.png" style="width:50px;">
                                  </a>
                                </li>
                                <li>
                                  <a href="whatsapp://send?phone=91<?php echo FETCH($PageSqls, "LeadPersonPhoneNumber"); ?>&text=Hey <?php echo FETCH($PageSqls, "LeadPersonFullname"); ?>,">
                                    <img src="<?php echo STORAGE_URL_D; ?>/tool-img/whatsapp.png" style="width:50px;">
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        <?php } else {
                        NoData("No Leads Found!");
                      } ?>
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
    <?php
    include $Dir . "/include/sections/Add-Feedback.php";
    include $Dir . "/include/admin/footer.php"; ?>
  </div>
  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>