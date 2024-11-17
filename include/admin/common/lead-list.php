<div class="col-md-12 item" loading="lazy">
 <a class="w-100" href="details/index.php?LeadsId=<?php echo SECURE($leads->LeadsId, "e"); ?>">
  <?php
  if (DEVICE_TYPE == "Mobile") {
   $flex = "";
   $MobileConditions = "<br>";
   $pull_right = "pull-right";
  } else {
   $flex = "flex-s-b";
   $MobileConditions = "";
   $pull_right = "";
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
     <span class="bold"><?php echo $leads->LeadSalutations; ?> <?php echo $leads->LeadPersonFullname; ?></span>
     <?php if (DEVICE_TYPE == "Mobile") {
      echo "<br>";
     } ?>
     <span class="italic text-primary italic">
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
     <span class="italic text-warning <?php echo $pull_right; ?>"><?php echo $leads->LeadPersonSource; ?></span>
     <span class="<?php echo $pull_right; ?>"><?php echo LeadStatus($leads->LeadPriorityLevel); ?></span>
    </span>
   </span>
   <?php echo $MobileConditions; ?>
   <span class="mt-2px">
    <?php if (DATE_FORMATE("d M, Y", $LeadFollowUpDate) == "No Update") { ?>
     <span class="text-info italic"> @ No Follow Up</span>
    <?php } else { ?>
     <span class="text-info italic"> @ <?php echo DATE_FORMATE("d M, Y", $LeadFollowUpDate); ?> <?php echo DATE_FORMATE("h:i A", $LeadFollowUpTime); ?> </span>
    <?php } ?>
    <span class='right-btn-i text-grey <?php echo $pull_right; ?>' style="width: max-content !important;">
     <span> <?php echo DATE_FORMATE("d M, Y", $leads->LeadPersonCreatedAt); ?></span>
    </span>
   </span>
  </p>
 </a>
</div>