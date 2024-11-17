<section class="pop-section hidden" id="add_new_session_<?php echo $UniversitId; ?>" id="add_new_session_popup">
  <div class="action-window" style="width:43%!important;">
    <div class='container'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add University Courses Session</h4>
        </div>
      </div>
      <form action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST" id="sessionForm">
        <?php FormPrimaryInputs(true); ?>
        <div class="col-md-12">
          <div class="card student-card mx-auto">
            <div class="tab">
              <div class="card-header">
                Add Courses Session
              </div>
              <div class="card-body">
                <div class="row">
                  <input type="hidden" name="university_id" value="<?= $UniversitId ?>">
                  <div class="col-md-12 form-group">
                    <label>Session <?php echo $req; ?></label>
                    <input type="text" name="univ_session_name" class="form-control form-control-sm" required="" placeholder="e.g:- session 2016-2020">
                  </div>
                  <?php
                  $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses WHERE university_id='" . $UniversitId . "' AND univ_course_status='1'", true);
                  if (isset($fetchData)) {
                  ?>
                    <div class='col-md-12 form-group'>
                      <label>Courses Lists <?php echo $req; ?></label><br>
                      <select class="form-control" name="univ_course_name[]" multiple="multiple" id="Specialization" style="width: 100%;" required="">
                        <?php
                        foreach ($fetchData as $courseData) {
                          echo '<option value="' . $courseData->univ_course_id . '" selected>' . $courseData->univ_course_name . '</option>';
                        }

                        ?>
                      </select>
                    </div>
                  <?php  } ?>
                  <div class="col-md-12 d-flex justify-content-between btn">
                    <a href="#" onclick="Databar('add_new_session_<?php echo $UniversitId; ?>')" class="btn btn-sm btn-default cancel">Cancel</a>
                    <button type="button" class="btn btn-sm btn-success next" name="addNewSession" value="newSession" onclick="saveSession()">Add Session</button>
                  </div>

                </div>
              </div>
            </div>

      </form>
    </div>
</section>
<script>
  $("#Specialization").select2({
    placeholder: "Add New Courses",
    tags: true,
  });
  //Add New Session
  function saveSession() {
    var form = $("#sessionForm");
    var url = form.attr("action");
    var data = form.serialize();
    $.ajax({
      type: "POST",
      url: url,
      data: data,
      success: function(response) {
        var responseData = JSON.parse(response);
        if (responseData.status === "Success") {
          Swal.fire(
            '',
            'University Session Saved Successfully',
            'success'
          ).then(() => {
            var popupSection = document.getElementById("add_new_session_<?php echo $UniversitId; ?>");
            popupSection.classList.add("hidden");
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Something went wrong! Please try again later',
          })

        }
      },
      error: function(xhr, status, error) {

      }
    });
  }
</script>