<section class="pop-section hidden" id="AddVisitPopUp">
  <div class="action-window">
    <div class='container'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add Visitor</h4>
        </div>
      </div>
      <form class="row" action="<?php echo CONTROLLER; ?>/VisitController.php" method="POST">
        <?php FormPrimaryInputs(true); ?>
        <div class='col-md-4 form-group'>
          <label>Full Name <?php echo $req; ?></label>
          <input type="text" name="VisitorPersonName" class="form-control form-control-sm" required="">
        </div>
        <div class='col-md-4 form-group'>
          <label>Phone Number <?php echo $req; ?></label>
          <input type="tel" name="VisitorPersonPhone" class="form-control form-control-sm" required="">
        </div>
        <div class='col-md-4 form-group'>
          <label>Email-ID</label>
          <input type="email" name="VisitorPersonEmailId" class="form-control form-control-sm">
        </div>
        <div class='col-md-12 form-group'>
          <label>Purpose <?php echo $req; ?></label>
          <input type="text" name="VisitPurpose" class="form-control form-control-sm" required="">
        </div>
        <div class='col-md-6 form-group'>
          <label>Visit Type <?php echo $req; ?></label>
          <select name="VisitPersonType" class='form-control form-control-sm' required>
            <?php CONFIG_VALUES("VISITOR_TYPES"); ?>
          </select>
        </div>
        <div class='col-md-6 form-group'>
          <label>Meeting With <?php echo $req; ?></label>
          <input type="text" name="VisitPesonMeetWith" list="UserFullName" class='form-control form-control-sm' required="">
          <datalist id="UserFullName">
            <?php
            $Users = FETCH_DB_TABLE("SELECT * FROM users where UserStatus='1' ORDER BY UserFullName ASC", true);
            foreach ($Users as $User) {
              if ($User->UserId == LOGIN_UserId) {
                $selected = "selected";
              } else {
                $selected = "";
              }
              echo "<option value='" . $User->UserId . " - " . $User->UserFullName . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
            }
            ?>
          </datalist>
        </div>
        <div class="form-group col-md-12">
          <label>Add Note & Remarks <?php echo $req; ?></label>
          <textarea name="VisitPeronsDescription" required="" class="form-control" rows="3"></textarea>
        </div>

        <div class='col-md-12 text-right'>
          <a onclick="Databar('AddVisitPopUp')" class="btn btn-md btn-default mt-3 mr-3">Cancel</a>
          <button type="submit" name="CreateVisit" class='btn btn-md btn-success'>Create Visit <i class='fa fa-check'></i></button>
        </div>
      </form>
    </div>
  </div>
</section>