<div class="col-md-3 col-6 flex-s-b">
  <label class="p-1">Source</label>
  <select name="LeadPersonSource" onchange="form.submit()" class="form-control form-control-sm">
    <option value="">All Source</option>
    <?php
    $LeadStages = FETCH_DB_TABLE(CONFIG_DATA_SQL("LEAD_SOURCES"), true);
    if ($LeadStages != null) {
      foreach ($LeadStages as $Stages) {
        if ($LeadPersonSource == $Stages->ConfigValueDetails) {
          $selected = "selected";
        } else {
          $selected = "";
        } ?>
        <option value="<?php echo $Stages->ConfigValueDetails; ?>" <?php echo $selected; ?>><?php echo $Stages->ConfigValueDetails; ?></option>
    <?php
      }
    }  ?>
  </select>
</div>

<div class="col-md-3 col-6 flex-s-b">
  <label class="p-1">Priority</label>
  <select name="level" onchange="form.submit()" class="form-control form-control-sm">
    <option value="">All levels</option>
    <?php
    $LeadStages = FETCH_DB_TABLE(CONFIG_DATA_SQL("LEAD_PERIORITY_LEVEL"), true);
    if ($LeadStages != null) {
      foreach ($LeadStages as $Stages) {
        if ($level == $Stages->ConfigValueDetails) {
          $selected = "selected";
        } else {
          $selected = "";
        } ?>
        <option value="<?php echo $Stages->ConfigValueDetails; ?>" <?php echo $selected; ?>><?php echo $Stages->ConfigValueDetails; ?></option>
    <?php
      }
    }  ?>
  </select>
</div>

<div class="col-md-3 col-6 flex-s-b">
  <label class="p-1">By</label>
  <?php if (LOGIN_UserType == "Admin") {
    $readonly = "";
  } else {
    $readonly = "readonly";
  } ?>
  <select name="by" onchange="form.submit()" <?php echo $readonly; ?> class="form-control form-control-sm">
    <option value="">All Team</option>
    <?php
    $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
    foreach ($Users as $User) {
      if ($User->UserId == $by) {
        $selected = "selected";
      } else {
        $selected = "";
      }
      echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . " - " . FETCH("SELECT * FROM user_employment_details where UserMainUserId='" . $User->UserId . "'", "UserEmpGroupName") . "</option>";
    }
    ?>
  </select>
</div>