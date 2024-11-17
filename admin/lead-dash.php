<?php
//all leads
if (LOGIN_UserType == "Admin") {
  $Leads = TOTAL("SELECT LeadsId FROM leads");
  $LeadsToday = TOTAL("SELECT LeadsId FROM leads where Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $LeadsYesterday = TOTAL("SELECT LeadsId FROM leads where Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all fresh leads
  $AllFreshLeads = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%FRESH LEAD%'");
  $AllFreshLeadsToday = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%FRESH LEAD%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $AllFreshLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%FRESH LEAD%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all followusp
  $AllFollowUpLeads = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%Follow Up%'");
  $AllFollowUpLeadsToday = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%Follow up%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $AllFollowUpLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%Follow up%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all site visits planned
  $AllSiteVisitPlannedLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%SITE VISIT PLANNED%'");
  $AllSiteVisitPlannedLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%SITE VISIT PLANNED%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $AllSiteVisitPlannedLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%SITE VISIT PLANNED%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all ringing
  $AllRingingLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%RINGING%'");
  $AllRingingToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%RINGING%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $AllRingingYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%RINGING%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all site visits done
  $AllSiteVisitDoneLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%SITE VISIT DONE%'");
  $AllSiteVisitDoneLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%SITE VISIT DONE%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $AllSiteVisitDoneLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where  LeadPersonSubStatus like '%SITE VISIT DONE%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all registration
  $AllRegistrationsLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%Registration%'");
  $AllRegistrationsLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%Registration%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllRegistrationsLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%Registration%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all sale closed
  $AllSaleClosedLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%Close%'");
  $AllSaleClosedLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%Close%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $AllSaleClosedLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonSubStatus like '%Close%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all not interested
  $AllNullLeads = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%Not Interested%'");
  $AllNullLeadsToday = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%Not Interested%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllNullLeadsYesterday = TOTAL("SELECT LeadsId FROM leads  where leadPersonStatus like '%Not Interested%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all junks
  $AllJunkLeads = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%Junk%'");
  $AllJunkLeadsToday = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%Junk%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllJunkLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where leadPersonStatus like '%Junk%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");
} else {
  $LOGIN_UserViewId = LOGIN_UserId;
  $Leads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId'");
  $LeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $LeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all fresh leads
  $AllFreshLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%FRESH LEAD%'");
  $AllFreshLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%FRESH LEAD%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $AllFreshLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%FRESH LEAD%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all followusp
  $AllFollowUpLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%Follow Up%'");
  $AllFollowUpLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%Follow up%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d") . "'");
  $AllFollowUpLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and leadPersonStatus like '%Follow up%' and Date(leads.LeadPersonCreatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all site visits planned
  $AllSiteVisitPlannedLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%SITE VISIT PLANNED%'");
  $AllSiteVisitPlannedLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and   LeadPersonSubStatus like '%SITE VISIT PLANNED%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllSiteVisitPlannedLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonSubStatus like '%SITE VISIT PLANNED%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all ringing
  $AllRingingLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonSubStatus like '%RINGING%'");
  $AllRingingToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonSubStatus like '%RINGING%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllRingingYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonSubStatus like '%RINGING%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all site visits done
  $AllSiteVisitDoneLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%SITE VISIT DONE%'");
  $AllSiteVisitDoneLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%SITE VISIT DONE%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllSiteVisitDoneLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%SITE VISIT DONE%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all registration
  $AllRegistrationsLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonSubStatus like '%Registration%'");
  $AllRegistrationsLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%Registration%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllRegistrationsLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%Registration%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all sale closed
  $AllSaleClosedLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%Close%'");
  $AllSaleClosedLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%Close%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllSaleClosedLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and  LeadPersonSubStatus like '%Close%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all not interested
  $AllNullLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Not Interested%'");
  $AllNullLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Not Interested%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllNullLeadsYesterday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Not Interested%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");

  //all junks
  $AllJunkLeads = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Junk%'");
  $AllJunkLeadsToday = TOTAL("SELECT LeadsId FROM leads where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Junk%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d") . "'");
  $AllJunkLeadsYesterday = TOTAL("SELECT LeadsId FROM leads  where LeadPersonManagedBy='$LOGIN_UserViewId' and LeadPersonStatus like '%Junk%' and Date(LeadPersonLastUpdatedAt)='" . date("Y-m-d", strtotime("-1 days")) . "'");
} ?>
<div class="row">
  <div class="col-md-12">
    <div class='flex-s-b'>
      <h3 class="app-heading w-pr-80 m-t-0"><i class="fa fa-home"></i> Lead Dashboard </h3>
      <?php if (LOGIN_UserType == 'Admin') { ?>
        <form>
          <select name="view" onchange="form.submit()" class="form-control form-control-sm">
            <?php InputOptions(["Admin Dashboard", 'Lead Dashboard', 'CRM Dashboard', 'HR Dashboard', 'Reception Dashboard', 'Digital Dashboard', "ACCOUNT"], IfRequested('GET', 'view', 'Lead Dashboard', false)); ?>
          </select>
        </form>
      <?php } ?>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $Leads ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $LeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $LeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">All Leads</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?view=Fresh Lead">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllFreshLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllFreshLeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllFreshLeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black"> FRESH LEADS</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?view=Follow up">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllFollowUpLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllFollowUpLeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllFollowUpLeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">TOTAL FOLLOW UPS</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?sub_status=RINGING">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllRingingLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllRingingToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllRingingYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">ALL RINGING CALLS</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?sub_status=Site Visit Planned">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllSiteVisitPlannedLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllSiteVisitPlannedLeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllSiteVisitPlannedLeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">SITE VISITS PLANNED</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?sub_status=Site Visit Done">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllSiteVisitDoneLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllSiteVisitPlannedLeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllSiteVisitPlannedLeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">SITE VISITS DONE</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?sub_status=Registration">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllRegistrationsLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllRegistrationsLeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllRegistrationsLeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">Registration Done</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?sub_status=Close">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllSaleClosedLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllSaleClosedLeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllSaleClosedLeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">SALE CLOSED</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?view=Not Interested">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllNullLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllNullLeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllNullLeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">NOT INTERESTED</p>
      </div>
    </a>
  </div>

  <div class="col-md-3 col-6 mb-10px">
    <a href="leads/index.php?view=junk">
      <div class="card card-window card-body rounded-3 p-4 shadow-lg">
        <div class="flex-s-b">
          <h2 class="count mb-0 m-t-5 h1">
            <?php echo $AllJunkLeads; ?>
          </h2>
          <span class="pull-right text-grey" style="line-height:1rem;">
            <span class="fs-11">Today : </span><span class="fs-13 count">
              <?php echo $AllJunkLeadsToday; ?>
            </span><br>
            <span class="fs-11">Yesterday : </span><span class="fs-13 count">
              <?php echo $AllJunkLeadsYesterday; ?>
            </span>
          </span>
        </div>
        <p class="mb-0 fs-14 text-black">JUNKS</p>
      </div>
    </a>
  </div>

  <?php if (LOGIN_UserType == 'TeamMember') { ?>
    <div class="col-md-3 col-6 mb-10px">
      <a href="leads/index.php?view=junk">
        <div class="card card-window card-body rounded-3 p-4 shadow-lg">
          <div class="flex-s-b">
            <h2 class="count mb-0 m-t-5 h1">
              <?php
              $all = TOTAL("SELECT * FROM comaigns");
              if ($all == 0) {
                $all = 1;
              }
              $AllTeamLeads = TOTAL("SELECT * FROM leads where LeadPersonSource!='Others' and LeadPersonManagedBy='" . LOGIN_UserId . "'");
              $AllOtherLeads = TOTAL("SELECT * FROM leads where LeadPersonSource='Others' and LeadPersonManagedBy='" . LOGIN_UserId . "'");
              $PerLeads = round(AMOUNT("SELECT CompaignCPL FROM comaigns", "CompaignCPL") / $all);
              if ($PerLeads == 0) {
                $PerLeads = 1;
              }
              $OtherLeads = 2;
              $MainLeadsCost = round(AMOUNT("SELECT CompaignCPL FROM comaigns", "CompaignCPL") / $PerLeads) * $AllTeamLeads;
              if ($OtherLeads != 0) {
                $OtherLeadsCost = round($OtherLeads / $PerLeads) * $AllOtherLeads;
              } else {
                $OtherLeadsCost = 0;
              }

              if ($all != 0) {
                echo Price($MainLeadsCost + $OtherLeadsCost, "", "Rs.");
              } else {
                echo 0;
              } ?>
            </h2>
          </div>
          <p class="mb-0 fs-14 text-black">Lead Support Cost (Rs.<?php echo round($PerLeads); ?>/Lead)</p>
        </div>
      </a>
    </div>
  <?php } ?>
</div>

<div class="row">
  <div class="col-md-6">
    <a href="leads/?today_followups=true">
      <h5 class="app-heading">Today's FollowUps <span class="bg-white p-1 rounded pull-right" style="font-size:0.9rem;">
          <?php
          if (LOGIN_UserType == "Admin") {
            echo TOTAL("SELECT * FROM lead_followups where DATE(LeadFollowUpDate)='" . date('Y-m-d') . "' and LeadFollowUpRemindStatus='ACTIVE' ORDER BY LeadFollowUpId DESC");
          } else {
            echo TOTAL("SELECT * FROM lead_followups where LeadFollowUpHandleBy='" . LOGIN_UserId . "' and DATE(LeadFollowUpDate)='" . date('Y-m-d') . "' and LeadFollowUpRemindStatus='ACTIVE' ORDER BY LeadFollowUpId DESC");
          } ?> Follow Ups</span>
      </h5>
    </a>
    <div class="data-display">
      <ul class="calling-list">
        <?php
        if (LOGIN_UserType == "Admin") {
          $fetclFollowUps = FETCH_DB_TABLE("SELECT * FROM lead_followups where DATE(LeadFollowUpDate)='" . date('Y-m-d') . "' and LeadFollowUpRemindStatus='ACTIVE' ORDER BY LeadFollowUpId DESC", true);
        } else {
          $fetclFollowUps = FETCH_DB_TABLE("SELECT * FROM lead_followups where LeadFollowUpHandleBy='" . LOGIN_UserId . "' and DATE(LeadFollowUpDate)='" . date('Y-m-d') . "' and LeadFollowUpRemindStatus='ACTIVE' ORDER BY LeadFollowUpId DESC", true);
        }
        if ($fetclFollowUps != null) {
          foreach ($fetclFollowUps as $F) { ?>
            <li>
              <span><?php echo CallTypes("" . $F->LeadFollowUpCallType . ""); ?></span>
              <p style="line-height:normal !important;">
                <a href="<?php echo DOMAIN; ?>/admin/leads/details/index.php?LeadsId=<?php echo SECURE($F->LeadFollowMainId, "e"); ?>&alert=true">
                  <span style="font-size:1rem !important;font-weight:600 !important;">
                    <?php echo FETCH("SELECT * FROM leads where LeadsId='" . $F->LeadFollowMainId . "'", "LeadSalutations"); ?>
                    <?php echo FETCH("SELECT * FROM leads where LeadsId='" . $F->LeadFollowMainId . "'", "LeadPersonFullname"); ?>
                  </span><br>
                  <span style="font-size:0.8rem !important;">
                    <span class="text-gray"><?php echo DATE_FORMATE("d M, Y", $F->LeadFollowUpCreatedAt); ?></span> - <span class="text-grey" style="color:grey !important;"><?php echo $F->LeadFollowCurrentStatus; ?></span><br>
                    <?php if ($F->LeadFollowStatus == "Follow Up" or $F->LeadFollowStatus == "follow Up" || $F->LeadFollowStatus == "FollowUp" || $F->LeadFollowStatus == "FOLLOW UP") { ?>
                      <i class="fa fa-clock"></i>
                    <?php } ?> <span class="text-grey"><?php echo $F->LeadFollowStatus; ?>
                      <?php if (DATE_FORMATE("d M, Y", $F->LeadFollowUpDate) != "No Update") { ?>
                        @ <span class="text-success"><?php echo DATE_FORMATE("d M, Y", $F->LeadFollowUpDate); ?> <?php echo $F->LeadFollowUpTime; ?></span>
                      <?php } ?>
                    </span>
                  </span><br>
                  <span style="font-size:1.1rem;">
                    <span class="text-dark"><?php echo $F->LeadFollowUpDescriptions; ?></span>
                    <br>
                    <i style="font-size:0.9rem;" class="text-info">By
                      <?php echo FETCH("SELECT * FROM users where UserId='" . $F->LeadFollowUpHandleBy . "'", "UserFullName"); ?>
                      <span class="text-gray">(<?php echo FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $F->LeadFollowUpHandleBy . "'", "UserEmpGroupName"); ?> -
                        <?php echo FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $F->LeadFollowUpHandleBy . "'", "UserEmpLocations"); ?>)
                      </span>
                    </i>
                  </span>
                </a>
              </p>
            </li>
        <?php
          }
        }
        ?>
      </ul>
    </div>
    <a href="<?php echo ADMIN_URL; ?>/leads/?today_followups=true" class="btn btn-md btn-primary pull-right mt-2">View All Today's Follow Ups <i class='fa fa-angle-right'></i></a>
  </div>
  <?php if (LOGIN_UserType == "Admin") { ?>
    <div class="col-md-6">
      <h5 class="app-heading">Current Activity</h5>
      <div class="data-display">
        <ul class="calling-list pt-0">
          <?php
          $fetclFollowUps = FETCH_DB_TABLE("SELECT * FROM lead_followups ORDER BY LeadFollowUpId DESC limit 0, 25", true);
          if ($fetclFollowUps != null) {
            foreach ($fetclFollowUps as $F) { ?>
              <li>
                <span><?php echo CallTypes("" . $F->LeadFollowUpCallType . ""); ?></span>
                <p style="line-height:normal !important;">
                  <span style="font-size:1rem !important;font-weight:600 !important;"><?php echo FETCH("SELECT * FROM leads where LeadsId='" . $F->LeadFollowMainId . "'", "LeadPersonFullname"); ?></span><br>
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
  <?php } ?>
</div>