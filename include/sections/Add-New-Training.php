<section class="pop-section hidden" id="Add-New-Training">
 <div class="action-window">
  <div class='container'>
   <div class='row'>
    <div class='col-md-12'>
     <h4 class='app-heading'>Add New Training</h4>
    </div>
   </div>
   <form class="row" action="<?php echo CONTROLLER; ?>/TrainingController.php" method="POST">
    <?php FormPrimaryInputs(true); ?>
    <div class='col-md-4 form-group'>
     <label>Training Name <?php echo $req; ?></label>
     <input type="text" name="TrainingName" class="form-control form-control-sm" required="">
    </div>
    <div class='col-md-4 form-group'>
     <label>Training mode <?php echo $req; ?></label>
     <input type="text" name="TrainingMode" class="form-control form-control-sm" required="">
     <?php SUGGEST("assets", "AssetCategory", "ASC"); ?>
    </div>
    <div class='col-md-4 form-group'>
     <label>Training Details <?php echo $req; ?></label>
     <input type="text" name="TrainingDetails" class="form-control form-control-sm" required="">
    </div>
    <div class='col-md-4 form-group'>
     <label>Training date <?php echo $req; ?></label>
     <input type="date" value="<?php echo date('Y-m-d'); ?>" name="TrainingDate" class="form-control form-control-sm" required="">
    </div>
    <div class='col-md-4 form-group'>
     <label>Training Status <?php echo $req; ?></label>
     <select name="TrainingStatus" class="form-control form-cotrol-sm" required>
      <?php InputOptions([
       "New", "Ongoing", "Completed", "Cancelled", "Re-scheduled", "Select Status"
      ], "Select Status"); ?>
     </select>
    </div>
    <div class=" form-group col-md-12">
     <label>Training Description <?php echo $req; ?></label>
     <textarea name="TrainingDescriptions" style="height:auto !important;" class="form-control editor" rows="20"></textarea>
    </div>

    <div class='col-md-12 text-right'>
     <a onclick="Databar('Add-New-Training')" class="btn btn-md btn-default mt-3 mr-3">Cancel</a>
     <button type="submit" name="SaveTrainingDetails" class='btn btn-md btn-success'>Save Training Details <i class='fa fa-check'></i></button>
    </div>
   </form>
  </div>
 </div>
</section>