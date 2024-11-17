<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="Description" content="Enter your description here" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../../assets/admin/css/app.css">
  <title>All leads</title>
</head>

<body>
  <?php
  $Dir = "../..";
  require $Dir . '/require/modules.php';
  require $Dir . '/require/admin/access-control.php';


  //pagevariables
  $PageName = "All Leads";
  $PageDescription = "Manage all Leads";
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
    $by = LOGIN_UserId;
    $level = "";
    $LeadPersonSource = "";
  }
  ?>
  <div class="container pt-3">
    <div class="row">
      <?php
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads, lead_followups where leads.LeadsId=lead_followups.LeadFollowMainId  GROUP BY LeadsId ORDER by LeadsId DESC limit 100", true);
      if ($GetLeads == null) { ?>
        <div class="col-md-12">
          <div class="card card-body border-0 shadow-sm">
            <div class="text-left">
              <h1><i class="fa fa-globe fa-spin display-4 text-success"></i></h1>
              <h4 class="text-muted">No leads found</h4>
              <p class="text-muted">You can add a new lead by clicking the button above.</p>
              <a href="add.php" class="btn btn-md btn-primary">Add leads</a>
            </div>
          </div>
        </div>
        <?php } else {
        $Count = 0;
        foreach ($GetLeads as $leads) {
          $Count++;
          $LeadPersonCreatedBy = $leads->LeadPersonCreatedBy;
          $LeadsId = $leads->LeadsId;
          $FollowUpsSQL = "SELECT * FROM lead_followups where LeadFollowMainId='$LeadsId'";
          $LeadFollowUpDate = $leads->LeadFollowUpDate;
          $LeadFollowUpTime = $leads->LeadFollowUpTime;
          $lead_requirements = CHECK("SELECT * FROM lead_requirements where leadMainId='$LeadsId'");
        ?>
          <div class="col-md-12 item" loading="lazy">
            <a class="w-100" href="details/index.php?LeadsId=<?php echo SECURE($leads->LeadsId, "e"); ?>">
              <?php
              if (DEVICE_TYPE == "Mobile") {
                $flex = "";
                $MobileConditions = "<br>";
                $pull_right = "pull-right";
                $font_size = "font-size:1rem !important;";
              } else {
                $flex = "flex-s-b";
                $MobileConditions = "";
                $pull_right = "";
                $font_size = "font-size:0.8rem!important;";
              }
              ?>
              <p class="data-list <?php echo $flex; ?>" loading="lazy">
                <span>
                  <span class="text-primary"><span class="right-btn-i"><?php echo $Count; ?></span>
                    <i class="fa fa-tag text-warning"></i>
                    <span><?php echo LeadStage($leads->LeadPersonStatus); ?></span> - <span class="text-primary"><?php echo FETCH("SELECT * FROM lead_followups where LeadFollowMainId='" . $leads->LeadsId . "' ORDER BY LeadFollowUpId DESC", "LeadFollowCurrentStatus"); ?></span>
                    <?php if (DEVICE_TYPE == "Mobile") {
                      echo "<br>";
                    } else {
                      echo "►";
                    } ?>
                    <span class="bold" style="<?php echo $font_size; ?>"><?php echo $leads->LeadSalutations; ?> <?php echo $leads->LeadPersonFullname; ?></span>
                    <?php if (DEVICE_TYPE == "Mobile") {
                      echo "<br>";
                    } ?>
                    <span class="italic text-primary italic" style="font-size:0.7rem !important;">
                      <?php
                      $ProjectID = FETCH("SELECT * FROM lead_requirements where LeadMainId='" . $leads->LeadsId . "'", "LeadRequirementDetails");
                      $ProjectSql = "SELECT * FROM projects where ProjectsId='$ProjectID'";
                      if ($ProjectID != null) {
                        echo "For " . FETCH($ProjectSql, "ProjectName");
                      } ?>
                    </span>
                    <?php if (DEVICE_TYPE == "Mobile") {
                      echo "<br>";
                    } ?>
                    <span class="text-grey"> By <?php echo FETCH("SELECT * FROM users where UserId='" . $leads->LeadPersonManagedBy . "'", "UserFullName"); ?></span>
                    <span class="italic text-warning <?php echo $pull_right; ?>" style="font-size:0.7rem !important;"><?php echo $leads->LeadPersonSource; ?></span>
                    <span class="<?php echo $pull_right; ?>"><?php echo LeadStatus($leads->LeadPriorityLevel); ?></span>
                  </span>
                </span>
                <?php echo $MobileConditions; ?>
                <span class="mt-2px">
                  <?php if (DATE_FORMATE("d M, Y", $LeadFollowUpDate) == "No Update") { ?>
                    <span class="text-info italic" style="font-size:0.75rem !important;"> @ No Follow Up</span>
                  <?php } else { ?>
                    <span class="text-info italic" style="font-size:0.75rem !important;"> @ <?php echo DATE_FORMATE("d M, Y", $LeadFollowUpDate); ?> <?php echo DATE_FORMATE("h:i A", $LeadFollowUpTime); ?> </span>
                  <?php } ?>
                  <span class='right-btn-i text-grey <?php echo $pull_right; ?>' style="width: max-content !important;">
                    <span> <?php echo DATE_FORMATE("d M, Y", $leads->LeadPersonCreatedAt); ?></span>
                  </span>
                </span>
              </p>
            </a>
          </div>
        <?php
        } ?>
      <?php } ?>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>