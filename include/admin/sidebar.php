<?php
if (LOGIN_UserType == "Admin") {
  if (isset($_GET['view'])) {
    $AllViews = $_GET['view'];
    $_SESSION['AllViews'] = $AllViews;
  } else {
    if (isset($_SESSION['AllViews'])) {
      $AllViews = $_SESSION['AllViews'];
    } else {
      $AllViews = null;
    }
  }

  //LOAD SIDEBARS 
  if ($AllViews == null) {
    include __DIR__ . "/sidebar/admin-sidebar.php";
  } elseif ($AllViews == "CRM Dashboard") {
    include __DIR__ . "/sidebar/crm-sidebar.php";
  } elseif ($AllViews == "HR Dashboard") {
    include __DIR__ . "/sidebar/hr-sidebar.php";
  } elseif ($AllViews == "Reception Dashboard") {
    include __DIR__ . "/sidebar/reception-sidebar.php";
  } elseif ($AllViews == "Digital Dashboard") {
    include __DIR__ . "/sidebar/digital-sidebar.php";
  } else if ($AllViews == "Lead Dashboard") {
    include __DIR__ . "/sidebar/team-member-sidebar.php";
  } elseif($AllViews == "ACCOUNT"){
     include __DIR__ . "/sidebar/account-sidebar.php";
  } else {
    include __DIR__ . "/sidebar/admin-sidebar.php";
  }

  //else loading
} elseif (LOGIN_UserType == "TeamMember") {
  include __DIR__ . "/sidebar/team-member-sidebar.php";
} elseif (LOGIN_UserType == "Digital") {
  include __DIR__ . "/sidebar/digital-sidebar.php";
} elseif (LOGIN_UserType == "Receptions") {
  include __DIR__ . "/sidebar/reception-sidebar.php";
} elseif (LOGIN_UserType == "CRM") {
  include __DIR__ . "/sidebar/crm-sidebar.php";
}elseif(LOGIN_UserType == "ACCOUNT"){
     include __DIR__ . "/sidebar/account-sidebar.php";
  } elseif (LOGIN_UserType == "HR") {
  include __DIR__ . "/sidebar/hr-sidebar.php";
}
