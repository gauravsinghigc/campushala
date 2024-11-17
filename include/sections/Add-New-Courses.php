<section class="pop-section hidden" id="add_new_courses_<?php echo $UniversitId; ?>">
  <div class="action-window custome-action-window " style="width:83% !important;">
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add New Courses</h4>
        </div>
      </div>
      <form action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST" id="addCourseForm">
        <?php FormPrimaryInputs(true); ?>
        <input type="hidden" name="UniversityId" value="<?= $UniversitId; ?>">

        <div class="col-md-12">
          <div class="card student-card mx-auto">
            <div class="tab">
              <div class="card-header">
                Course Primary Details
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class='col-md-6 form-group'>
                        <label>Course Session Year <?php echo $req; ?></label>
                        <select class="form-control" name="univ_session_id" id="universitySession" style="width: 100%;" required="">
                          <option value="">choose session year</option>
                          <?php $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_session_years  WHERE university_id='" . $UniversitId . "' AND univ_session_status='1'", true);
                          if (isset($fetchData)) {
                            foreach ($fetchData as $sessionData) {
                              echo '<option value="' . $sessionData->univ_session_id . '">' . $sessionData->univ_session_name . '</option>';
                            }
                          }
                          ?>
                        </select>
                      </div>

                      <div class="col-md-6 form-group">
                        <label>Course Name <?php echo $req; ?></label>
                        <input type="text" name="univ_course_name" class="form-control form-control-sm" required="" placeholder="B.tech">
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>Course Type <?php echo $req; ?></label>
                        <select name="univ_course_type" class="form-control form-control-sm" required="">
                          <option>Graduation</option>
                          <option>Post Graduation</option>
                          <option>Under Graduation</option>
                        </select>
                      </div>

                      <div class='col-md-6 form-group'>
                        <label>Total Semester <?php echo $req; ?></label>
                        <input type="number" name="univ_course_total_semesters" class="form-control form-control-sm" required="" placeholder="8">
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>Total Years <?php echo $req; ?></label>
                        <input type="number" name="univ_course_total_year" class="form-control form-control-sm" required="" placeholder="4">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-12">
                      <div class="p-2 mt-3 shadow-sm" id="sessionCourseList">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 d-flex justify-content-between btn">
              <a href="#" onclick="Databar('add_new_courses_<?php echo $UniversitId; ?>')" class="btn btn-sm btn-default cancel">Cancel</a>
              <button type="button" onclick="addNewCourses()" class="btn btn-sm btn-success next">Add New Courses</button>
            </div>
          </div>
        </div>
    </div>

    </form>
  </div>
</section>
<script>
  $(document).ready(function() {
    $("#universitySession").on("change", function(e) {
      e.preventDefault();
      $sessionId = $(this).val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          sessionId: $sessionId,
          universityId: $universityId,
          addcoursesBtn: "submit",
        },
        success: function(response) {
          $("#sessionCourseList").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
  });

  function addNewCourses() {
    var formData = new FormData($("#addCourseForm")[0]);

    // Add button name and value to the form data
    formData.append("addNewCourses", "SaveCourses");

    // Send form data via AJAX
    $.ajax({
      url: $("#addCourseForm").attr("action"),
      type: $("#addCourseForm").attr("method"),
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function(response) {
        var responseData;
        if (typeof response === 'object') {
          responseData = response; // The response is already an object
        } else {
          responseData = JSON.parse(response); // Parse the JSON response
        }
        if (responseData.status === "Success") {
          Swal.fire(
            '',
            'New Course Saved Successfully',
            'success'
          ).then(() => {
            var popupSection = document.getElementById("add_new_courses_<?php echo $UniversitId; ?>");
            popupSection.classList.add("hidden");
            location.reload();
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Something went wrong! Please try again later',
          });
        }
      },
      error: function(xhr, status, error) {

      }
    });
  }
</script>