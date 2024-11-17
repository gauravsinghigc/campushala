<div class="row">
  <?php
  if (isset($_GET['view'])) {
    $view = $_GET['view'];
    if (LOGIN_UserType == "Admin") {
      $TotalItems = TOTAL("SELECT * FROM leads WHERE LeadPersonStatus LIKE '%$view%' GROUP BY LeadsId ORDER by LeadsId DESC");
    } else {
      $LOGIN_UserId = LOGIN_UserId;
      $TotalItems = TOTAL("SELECT * FROM leads where LeadPersonStatus LIKE '%$view%' and LeadPersonManagedBy='$LOGIN_UserId' GROUP BY LeadsId ORDER by LeadsId DESC");
    }
  } elseif (isset($_GET['search_true'])) {
    $LeadPersonSubStatus = $_GET['LeadPersonSubStatus'];
    $LeadPersonStatus = $_GET['LeadPersonStatus'];
    $LeadPersonFullname = $_GET['LeadPersonFullname'];
    $LeadPersonPhoneNumber = $_GET['LeadPersonPhoneNumber'];
    $LeadPriorityLevel = $_GET['LeadPriorityLevel'];
    $LeadPersonSource = $_GET['LeadPersonSource'];
    $LeadPersonManagedBy = $_GET['LeadPersonManagedBy'];
    if ($LeadPersonManagedBy == null) {
      $Managed = "LeadPersonManagedBy like '%$LeadPersonManagedBy%' and";
    } else {
      $Managed = "LeadPersonManagedBy='$LeadPersonManagedBy' and";
    }
    if (LOGIN_UserType == "Admin") {
      $TotalItems = TOTAL("SELECT * FROM leads WHERE $Managed LeadPersonSource like '%$LeadPersonSource%' and LeadPriorityLevel like '%$LeadPriorityLevel%' and LeadPersonPhoneNumber like '%$LeadPersonPhoneNumber%' and LeadPersonFullname like '%$LeadPersonFullname%' and LeadPersonSubStatus like '%$LeadPersonSubStatus%' and LeadPersonStatus LIKE '%$LeadPersonStatus%' GROUP BY LeadsId ORDER by LeadsId DESC");
    } else {
      $LOGIN_UserId = LOGIN_UserId;
      $TotalItems = TOTAL("SELECT * FROM leads where $Managed LeadPersonSource like '%$LeadPersonSource%' and LeadPriorityLevel like '%$LeadPriorityLevel%' and LeadPersonPhoneNumber like '%$LeadPersonPhoneNumber%' and LeadPersonFullname like '%$LeadPersonFullname%' and LeadPersonSubStatus like '%$LeadPersonSubStatus%' and LeadPersonStatus LIKE '%$LeadPersonStatus%' and LeadPersonManagedBy='$LOGIN_UserId' GROUP BY LeadsId ORDER by LeadsId DESC");
    }
  } elseif (isset($_GET['sub_status'])) {
    $sub_status = $_GET['sub_status'];
    if (LOGIN_UserType == "Admin") {
      $TotalItems = TOTAL("SELECT * FROM leads WHERE LeadPersonSubStatus like '%$sub_status%' GROUP BY LeadsId ORDER by LeadsId DESC");
    } else {
      $LOGIN_UserId = LOGIN_UserId;
      $TotalItems = TOTAL("SELECT * FROM leads where LeadPersonSubStatus like '%$sub_status%' and LeadPersonManagedBy='$LOGIN_UserId' GROUP BY LeadsId ORDER by LeadsId DESC");
    }
  } else {
    if (LOGIN_UserType == "Admin") {
      $TotalItems = TOTAL("SELECT * FROM leads GROUP BY LeadsId ORDER by LeadsId DESC");
    } else {
      $LOGIN_UserId = LOGIN_UserId;
      $TotalItems = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserId' GROUP BY LeadsId ORDER by LeadsId DESC");
    }
  }
  //paginations
  $start = 0;
  $end = 20;
  $view_page = 1;
  $listcounts = $end;
  if (isset($_GET['view_page'])) {
    $view_page = (int)$_GET['view_page'];
    if ($view_page != 1) {
      $start = $view_page * $end;
      $end = $start + $end;
      $next_page = $view_page + 1;
      $previous_page = $view_page - 1;
    } else {
      $next_page = $view_page + 1;
      $previous_page = 1;
    }
  } else {
    $next_page = $view_page + 1;
    $previous_page = 1;
  }
  $NetPages = round((int)$TotalItems / $listcounts);
  if ($NetPages == 0) {
    $NetPages = 1;
  } else {
    $NetPages = $NetPages;
  }
  ?>
  <?php
  if (isset($_GET['view'])) {
    $view = $_GET['view'];
    if (LOGIN_UserType == "Admin") {
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads WHERE LeadPersonStatus LIKE '%$view%' GROUP BY LeadsId ORDER by LeadsId DESC limit $start, $listcounts", true);
    } else {
      $LOGIN_UserId = LOGIN_UserId;
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads where LeadPersonStatus LIKE '%$view%' and LeadPersonManagedBy='$LOGIN_UserId' GROUP BY LeadsId ORDER by LeadsId DESC limit $start, $listcounts", true);
    }
  } elseif (isset($_GET['search_true'])) {
    $LeadPersonSubStatus = $_GET['LeadPersonSubStatus'];
    $LeadPersonStatus = $_GET['LeadPersonStatus'];
    $LeadPersonFullname = $_GET['LeadPersonFullname'];
    $LeadPersonPhoneNumber = $_GET['LeadPersonPhoneNumber'];
    $LeadPriorityLevel = $_GET['LeadPriorityLevel'];
    $LeadPersonSource = $_GET['LeadPersonSource'];
    $LeadPersonManagedBy = $_GET['LeadPersonManagedBy'];
    if ($LeadPersonManagedBy == null) {
      $Managed = "LeadPersonManagedBy like '%$LeadPersonManagedBy%' and";
    } else {
      $Managed = "LeadPersonManagedBy='$LeadPersonManagedBy' and";
    }
    if (LOGIN_UserType == "Admin") {
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads WHERE $Managed LeadPersonSource like '%$LeadPersonSource%' and LeadPriorityLevel like '%$LeadPriorityLevel%' and LeadPersonPhoneNumber like '%$LeadPersonPhoneNumber%' and LeadPersonFullname like '%$LeadPersonFullname%' and LeadPersonSubStatus like '%$LeadPersonSubStatus%' and LeadPersonStatus LIKE '%$LeadPersonStatus%' GROUP BY LeadsId ORDER by LeadsId DESC limit $start, $listcounts", true);
    } else {
      $LOGIN_UserId = LOGIN_UserId;
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads where $Managed LeadPersonSource like '%$LeadPersonSource%' and LeadPriorityLevel like '%$LeadPriorityLevel%' and LeadPersonPhoneNumber like '%$LeadPersonPhoneNumber%' and LeadPersonFullname like '%$LeadPersonFullname%' and LeadPersonSubStatus like '%$LeadPersonSubStatus%' and LeadPersonStatus LIKE '%$LeadPersonStatus%' and LeadPersonManagedBy='$LOGIN_UserId' GROUP BY LeadsId ORDER by LeadsId DESC limit $start, $listcounts", true);
    }
  } elseif (isset($_GET['sub_status'])) {
    $sub_status = $_GET['sub_status'];
    if (LOGIN_UserType == "Admin") {
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads WHERE LeadPersonSubStatus like '%$sub_status%' GROUP BY LeadsId ORDER by LeadsId DESC limit $start, $listcounts", true);
    } else {
      $LOGIN_UserId = LOGIN_UserId;
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads where LeadPersonSubStatus like '%$sub_status%' and LeadPersonManagedBy='$LOGIN_UserId' GROUP BY LeadsId ORDER by LeadsId DESC limit $start, $listcounts", true);
    }
  } else {
    if (LOGIN_UserType == "Admin") {
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads GROUP BY LeadsId ORDER by LeadsId DESC limit $start,$listcounts", true);
    } else {
      $LOGIN_UserId = LOGIN_UserId;
      $GetLeads = FETCH_DB_TABLE("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserId' GROUP BY LeadsId ORDER by LeadsId DESC limit $start, $listcounts", true);
    }
  }
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
    if (isset($_GET['view_page'])) {
      if ($view_page == 1) {
        $Count = 0;
      } elseif ($view_page != 1) {
        $Count = 20 * ($view_page - 1);
      } else {
        $Count = $start;
      }
    } else {
      $Count = $Count;
    }
    if ($next_page == $NetPages) {
      $next_page = $NetPages;
    } else {
      $next_page = $next_page;
    }


    if (DEVICE_TYPE == "Mobile") {
      $flex = "";
    } else {
      $flex = "flex-s-b";
    }

    foreach ($GetLeads as $leads) {
      $Count++;
      $LeadPersonCreatedBy = $leads->LeadPersonCreatedBy;
      $LeadsId = $leads->LeadsId;
      $FollowUpsSQL = "SELECT * FROM lead_followups where LeadFollowMainId='$LeadsId'";
      $LeadFollowUpDate = FETCH($FollowUpsSQL, "LeadFollowUpDate");
      $LeadFollowUpTime = FETCH($FollowUpsSQL, "LeadFollowUpTime");
      $lead_requirements = CHECK("SELECT * FROM lead_requirements where leadMainId='$LeadsId'");
      include "../../include/admin/common/lead-list.php";
    } ?>
  <?php } ?>
  <?php include "../../include/admin/common/pagination.php"; ?>
</div>