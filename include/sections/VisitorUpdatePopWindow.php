<section class="pop-section hidden" id="edit_<?php echo $Visitor->VisitorId; ?>">
  <div class="action-window">
    <div class='container'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Update Visitor</h4>
        </div>
      </div>
      <form class="row" action="<?php echo CONTROLLER; ?>/VisitController.php" method="POST">
        <?php FormPrimaryInputs(true, [
          "VisitorId" => $Visitor->VisitorId
        ]); ?>
        <div class='col-md-4 form-group'>
          <label>Full Name <?php echo $req; ?></label>
          <input type="text" name="VisitorPersonName" value="<?php echo $Visitor->VisitorPersonName; ?>" class="form-control form-control-sm" required="">
        </div>
        <div class='col-md-4 form-group'>
          <label>Phone Number <?php echo $req; ?></label>
          <input type="tel" name="VisitorPersonPhone" value="<?php echo $Visitor->VisitorPersonPhone; ?>" class="form-control form-control-sm" required="">
        </div>
        <div class='col-md-4 form-group'>
          <label>Email-ID</label>
          <input type="email" name="VisitorPersonEmailId" value="<?php echo $Visitor->VisitorPersonEmailId; ?>" class="form-control form-control-sm">
        </div>
        <div class='col-md-12 form-group'>
          <label>Purpose <?php echo $req; ?></label>
          <input type="text" name="VisitPurpose" VALUE="<?php echo $Visitor->VisitPurpose; ?>" class="form-control form-control-sm" required="">
        </div>
        <div class='col-md-3 form-group'>
          <label>Visit Type <?php echo $req; ?></label>
          <select name="VisitPersonType" class='form-control form-control-sm' required>
            <?php CONFIG_VALUES("VISITOR_TYPES", $Visitor->VisitPersonType); ?>
          </select>
        </div>
        <div class='col-md-3 form-group'>
          <label>Meeting With <?php echo $req; ?></label>
          <input type="text" name="VisitPesonMeetWith" value="<?php echo $Visitor->VisitPesonMeetWith . " - " . FETCH("SELECT * FROM users where UserId='" . $Visitor->VisitPesonMeetWith . "'", "UserFullName"); ?>" list="UserFullName" class='form-control form-control-sm' required="">
          <datalist id="UserFullName">
            <?php
            $Users = FETCH_DB_TABLE("SELECT * FROM users where UserStatus='1' ORDER BY UserFullName ASC", true);
            foreach ($Users as $User) {
              if ($User->UserId == $Visitor->VisitPesonMeetWith) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo "<option value='" . $User->UserId . " - " . $User->UserFullName . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
            }
            ?>
          </datalist>
        </div>
        <div class='col-md-3 form-group'>
          <label>Visit Status <?php echo $req; ?></label>
          <select name="VisitEnquiryStatus" class='form-control form-control-sm' required>
            <?php CONFIG_VALUES("VISITOR_STATUS", $Visitor->VisitEnquiryStatus); ?>
          </select>
        </div>
        <div class='col-md-3 form-group'>
          <label>Out Time </label>
          <input type="time" name="VisitorOutTime" VALUE="<?php echo $Visitor->VisitOutTime; ?>" class="form-control form-control-sm">
        </div>
        <div class="form-group col-md-12">
          <label>Note & Remarks <?php echo $req; ?></label>
          <textarea name="VisitPeronsDescription" required="" class="form-control" rows="3"><?php echo SECURE($Visitor->VisitPeronsDescription, "d"); ?></textarea>
        </div>

        <div class='col-md-12 text-right'>
          <a onclick="Databar('edit_<?php echo $Visitor->VisitorId; ?>')" class="btn btn-md btn-default mt-3 mr-3">Cancel</a>
          <button type="submit" name="UpdateVisit" class='btn btn-md btn-success'>Update Visit <i class='fa fa-check'></i></button>
        </div>
      </form>
    </div>
  </div>
</section>