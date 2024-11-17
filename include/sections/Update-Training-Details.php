<section class="pop-section hidden" id="update_<?php echo $data->TrainingId; ?>">
 <div class="action-window">
  <div class='container'>
   <div class='row'>
    <div class='col-md-12'>
     <h4 class='app-heading'>Update Training Details</h4>
    </div>
   </div>
   <form class="row" action="<?php echo CONTROLLER; ?>/TrainingController.php" method="POST">
    <?php FormPrimaryInputs(true, [
     "TrainingId" => $data->TrainingId
    ]); ?>
    <div class='col-md-4 form-group'>
     <label>Training Name <?php echo $req; ?></label>
     <input type="text" name="TrainingName" value="<?php echo $data->TrainingName; ?>" class="form-control form-control-sm" required="">
    </div>
    <div class='col-md-4 form-group'>
     <label>Training mode <?php echo $req; ?></label>
     <input type="text" name="TrainingMode" value="<?php echo $data->TrainingMode; ?>" class="form-control form-control-sm" required="">
     <?php SUGGEST("trainings", "TrainingMode", "ASC"); ?>
    </div>
    <div class='col-md-4 form-group'>
     <label>Training link <?php echo $req; ?></label>
     <input type="text" name="TrainingDetails" value="<?php echo $data->TrainingDetails; ?>" class="form-control form-control-sm">
    </div>
    <div class='col-md-4 form-group'>
     <label>Training date <?php echo $req; ?></label>
     <input type="date" value="<?php echo $data->TrainingDate; ?>" name="TrainingDate" class="form-control form-control-sm" required="">
    </div>
    <div class='col-md-4 form-group'>
     <label>Training Status <?php echo $req; ?></label>
     <select name="TrainingStatus" class="form-control form-control-sm" required>
      <?php InputOptions([
       "New", "Ongoing", "Completed", "Cancelled", "Re-scheduled", "Select Status"
      ], $data->TrainingStatus); ?>
     </select>
    </div>
    <div class=" form-group col-md-12">
     <label>Training Description <?php echo $req; ?></label>
     <textarea name="TrainingDescriptions" style="height:auto !important;" class="form-control editor" rows="20"><?php echo SECURE($data->TrainingDescriptions, "d"); ?></textarea>
    </div>
    <div class='col-md-12 text-right'>
     <a onclick="Databar('update_<?php echo $data->TrainingId; ?>')" class="btn btn-md btn-default mt-3 mr-3">Cancel</a>
     <button type="submit" name="UpateTrainingDetails" class='btn btn-md btn-success'>Update Training Details <i class='fa fa-check'></i></button>
    </div>
   </form>
  </div>
 </div>
</section>