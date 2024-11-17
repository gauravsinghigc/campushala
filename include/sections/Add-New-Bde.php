<section class="pop-section hidden" id="AddNewBdes">
  <div class="action-window">
    <div class='container'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add New Users/BDEs</h4>
        </div>
      </div>
      <form action="<?php echo CONTROLLER; ?>/BdesController.php" method="POST">
        <?php FormPrimaryInputs(true); ?>
        <div class="col-md-12">
          <div class="card student-card mx-auto">
            <div class="tab">
              <div class="card-header">
                Primary Details
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4 form-group">
                    <label>First Name <?php echo $req; ?></label>
                    <input type="text" name="bdes_first_name" class="form-control form-control-sm" required="">
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Last Name</label>
                    <input type="text" name="bdes_last_name" class="form-control form-control-sm">
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Phone Number <?php echo $req; ?></label>
                    <input type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" name="bdes_phone_no" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-6 form-group'>
                    <label>Email-ID <?php echo $req; ?></label>
                    <input type="email" oninput="CheckExistingMailId()" id="EmailId" name="bdes_email_id" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-6 form-group'>
                    <label>Password </label>
                    <input readonly type="password" name="bdes_password" class="form-control form-control-sm">
                  </div>
                  <div class='col-md-6 form-group'>
                    <label>Address <?php echo $req; ?></label>
                    <textarea name="bdes_address_line1" class="form-control form-control-sm" rows="2" required></textarea>
                  </div>
                  <div class='col-md-6 form-group'>
                    <label>Address 2 </label>
                    <textarea name="bdes_address_line2" class="form-control form-control-sm" rows="2"></textarea>
                  </div>
                  <div class='col-md-4 form-group'>
                    <label>City <?php echo $req; ?></label>
                    <input type="text" name="bdes_city" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-4 form-group'>
                    <label>State <?php echo $req; ?></label>
                    <input type="text" name="bdes_state" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-4 form-group'>
                    <label>Country <?php echo $req; ?></label>
                    <select name="bdes_country" class="form-control form-control-sm" required="">
                      <?php foreach (AllCountryList() as $value) { ?>
                        <option><?= $value ?></option>
                      <?php }  ?>
                    </select>
                  </div>
                  <div class='col-md-4 form-group'>
                    <label>Zip </label>
                    <input type="text" name="bdes_zip" class="form-control form-control-sm">
                  </div>
                  <div class="col-md-4 form-group">
                    <label></label>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="checkOut" value="checkOut" id="gridCheck" required> <label class="form-check-label" for="gridCheck"> Check me out </label></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 d-flex justify-content-between btn">
              <a href="#" onclick="Databar('AddNewBdes')" class="btn btn-sm btn-default cancel">Cancel</a>
              <button type="submit" class="btn btn-sm btn-success next" name="SaveBdesData" value="BdesData">Submit</button>
            </div>

          </div>
        </div>
    </div>

    </form>
  </div>
</section>