<?php
$LOGIN_UserViewId = $_SESSION['TEAM_UserId'];
$Leads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId'");
$LeadsToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
$LeadsYesterday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

//all fresh leads
$AllFreshLeads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%FRESH LEAD%'");
$AllFreshLeadsToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%FRESH LEAD%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
$AllFreshLeadsYesterday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%FRESH LEAD%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

//all followusp
$AllFollowUpLeads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%Follow Up%'");
$AllFollowUpLeadsToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%Follow up%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
$AllFollowUpLeadsYesterday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%Follow up%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

//all site visits planned
$AllSiteVisitPlannedLeads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%SITE VISIT PLANNED%'");
$AllSiteVisitPlannedLeadsToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%SITE VISIT PLANNED%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
$AllSiteVisitPlannedLeadsYesterday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%SITE VISIT PLANNED%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");


//all ringing
$AllRingingLeads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%RINGING%'");
$AllRingingToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%RINGING%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
$AllRingingYesterday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%RINGING%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");


//all site visits done
$AllSiteVisitDoneLeads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%SITE VISIT DONE%'");
$AllSiteVisitDoneLeadsToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%SITE VISIT DONE%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
$AllSiteVisitDoneLeadsYesterday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Follow Up%' and LeadPersonSubStatus like '%SITE VISIT DONE%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

//all sale closed
$AllSaleClosedLeads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Sale Closed%' and LeadPersonSubStatus like '%Close%'");
$AllSaleClosedLeadsToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Sale Closed%' and LeadPersonSubStatus like '%Close%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
$AllSaleClosedLeadsYesterday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Sale Closed%' and LeadPersonSubStatus like '%Close%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

//all not interested
$AllNullLeads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Not Interested%'");
$AllNullLeadsToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Not Interested%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
$AllNullLeadsYesterday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Not Interested%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

//all junks
$AllJunkLeads = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Junk%'");
$AllJunkLeadsToday = TOTAL("SELECT * FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Junk%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
$AllJunkLeadsYesterday = TOTAL("SELECT * FROM leads  where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Junk%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");
