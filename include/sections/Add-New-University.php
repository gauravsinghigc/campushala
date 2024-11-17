<section class="pop-section hidden" id="AddNewUniversitys">
  <div class="action-window custome-action-window custom-action-window-height">
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add New Universities</h4>
        </div>
      </div>

      <form action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">
        <?php FormPrimaryInputs(true, [
          "UniversityBtn" => "SaveUniversityData"
        ]); ?>

        <div class="col-md-12">
          <div class="card student-card mx-auto">
            <div class="tab">
              <div class="row">
                <div class="col-md-6">
                  <div class="card-header custom-card-header">
                    University Primary Details
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-header custom-card-header">
                    University Course Details
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <label>University Name <?php echo $req; ?></label>
                        <input type="text" name="university_name" class="form-control" required="" placeholder="University of Allahabad">
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>Phone Number <?php echo $req; ?></label>
                        <input type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" name="university_phone_no" class="form-control" required="">
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>Email-ID <?php echo $req; ?></label>
                        <input type="email" oninput="CheckExistingMailId()" id="EmailId" name="university_email_id" class="form-control" required placeholder="university@gmail.com">
                      </div>

                      <div class='col-md-6 form-group'>
                        <label>Reg.No </label>
                        <input type="text" name="university_reg_no" class="form-control">
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>GST or Taxation No </label>
                        <input type="text" name="university_gst" class="form-control" placeholder="18AABCU9603R1ZM">
                      </div>
                      <div class="col-md-12 form-group">
                        <label>Address </label>
                        <textarea name="univ_reg_address" class="form-control" rows="2"></textarea>
                      </div>
                      <div class='col-md-7 form-group'>
                        <label>Sector/Area Locality </label>
                        <input type="text" name="univ_reg_sector" class="form-control">
                      </div>
                      <div class='col-md-5 form-group'>
                        <label>Landmark </label>
                        <input type="text" name="univ_reg_landmark" class="form-control">
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>City <?php echo $req; ?></label>
                        <input type="text" name="univ_reg_city" class="form-control" required="">
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>State <?php echo $req; ?></label>
                        <input type="text" name="univ_reg_state" class="form-control" required="">
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>Country <?php echo $req; ?></label>
                        <select name="univ_reg_country" class="form-control" required="">
                          <?php foreach (AllCountryList() as $value) { ?>
                            <option value="<?= $value ?>"><?= $value ?></option>
                          <?php }  ?>
                        </select>
                      </div>
                      <div class='col-md-6 form-group'>
                        <label>Pincode </label>
                        <input type="text" name="univ_reg_pincode" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">

                    <div class="row" id="addNew">
                      <div class="col-md-6 form-group">
                        <label>Course Session Years</label>
                        <select class="form-control  " name="univ_course_session_year[]" id="UniversityCourseSessionYears" style="width: 100%;" required="">
                          <option>choose session year</option>
                          <?php $FetchSession = FETCH_DB_TABLE("SELECT course_id,course_session_year FROM courses WHERE course_status='1' ", true);
                          if (isset($FetchSession)) {
                            foreach ($FetchSession as $value) {
                              echo '<option value="' . $value->course_id . '" data-id="' . $value->course_id . '">' . $value->course_session_year . '</option>';
                            }
                          } ?>
                        </select>
                      </div>

                      <div class="col-md-6 form-group">
                        <label>Courses Name (Available)</label>
                        <select class="form-control  " name="univ_course_name[]" id="UniversityCourseName" style="width: 100%;" required="">

                        </select>
                      </div>

                      <div class="col-md-12 form-group">
                        <label>Course Specialization</label>
                        <select class="form-control  " name="univ_course_specialization[0][]" multiple="multiple" id="UniversityCourseSpecialization" style="width: 100%;" required="">

                        </select>
                      </div>
                      <div class="col-md-5 form-group">
                        <label>University Tuition Fee</label>
                        <input type="text" name="univ_course_tuition_fee[]" class="form-control" placeholder="5000">
                      </div>
                      <div class="col-md-6 form-group d-flex">
                        <div class="w-48">
                          <label>Discount On Tuition Fee</label>
                          <input type="text" name="univ_course_fee_discount[]" class="form-control">
                        </div>
                        <div class="w-48 px-2">
                          <label></label>
                          <select class="form-control " name="univ_course_fee_discount_in[]">
                            <option value="Percentage">Percentage</option>
                            <option value="Amount">Amount</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-1 form-group">
                        <label></label>
                        <button class="btn btn-outline-success mt-4 add-courses-name-btn"><i class="bi bi-plus-circle-fill "></i></button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>
            <div class="col-md-12 d-flex justify-content-between btn">
              <a href="#" onclick="Databar('AddNewUniversitys')" class="btn btn-sm btn-default cancel">Cancel</a>
              <button type="submit" name="SaveUniversityInfo" value="SaveData" class="btn btn-sm btn-success next">Save University</button>
            </div>

          </div>
        </div>


      </form>
    </div>
</section>
<script>
  $(document).ready(function() {
    let counter = 0;
    $('.add-courses-name-btn').click(function(e) {
      e.preventDefault();
      $('#addNew').prepend(`<div class="row" id="addNew">
                      <div class="col-md-6 form-group">
                        <label>Course Session Years</label>
                        <select class="form-control" name="new_univ_course_session_year[]" id="UniversityCourseSessionYears" style="width: 100%;" required="">
                          <option>choose session year</option>
                          <?php $FetchSession = FETCH_DB_TABLE("SELECT course_id,course_session_year FROM courses WHERE course_status='1' ", true);
                          if (isset($FetchSession)) {
                            foreach ($FetchSession as $value) {
                              echo '<option value="' . $value->course_id . '" data-id="' . $value->course_id . '">' . $value->course_session_year . '</option>';
                            }
                          } ?>
                        </select>
                      </div>

                      <div class="col-md-6 form-group">
                        <label>Courses Name (Available)</label>
                        <select class="form-control  " name="new_univ_course_name[]" id="UniversityCourseName" style="width: 100%;" required="">

                        </select>
                      </div>

                      <div class="col-md-12 form-group">
                        <label>Course Specialization</label>
                        <select class="form-control  " name="new_univ_course_specialization[${counter}][]" multiple="multiple" id="UniversityCourseSpecialization" style="width: 100%;" required="">

                        </select>
                      </div>
                      <div class="col-md-5 form-group">
                        <label>University Tuition Fee</label>
                        <input type="text" name="new_univ_course_tuition_fee[]" class="form-control" placeholder="5000">
                      </div>
                      <div class="col-md-6 form-group d-flex">
                        <div class="w-48">
                          <label>Discount On Tuition Fee</label>
                          <input type="text" name="new_univ_course_fee_discount[]" class="form-control">
                        </div>
                        <div class="w-48 px-2">
                          <label></label>
                          <select class="form-control " name="new_univ_course_fee_discount_in[]">
                            <option value="Percentage">Percentage</option>
                            <option value="Amount">Amount</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-1 form-group">
                        <label></label>
                        <button class="btn btn-outline-danger mt-4 remove-courses-name-btn"><i class="bi bi-plus-circle-fill "></i></button>
                      </div>
                    </div>`);
      counter++;

    });
    // Remove course row
    $(document).on('click', '.remove-courses-name-btn', function() {
      $(this).closest('.row').remove();
    });

    // Event handler for course session years change
    $(document).on('change', '#UniversityCourseSessionYears', function(e) {
      e.preventDefault();
      var CourseSessionYearId = $(this).find(":selected").data('id');
      var targetSelect = $(this).closest('.row').find('#UniversityCourseName');
      loadCourseNames(CourseSessionYearId, targetSelect);
    });

    // Event handler for course name change
    $(document).on('change', '#UniversityCourseName', function(e) {
      e.preventDefault();
      var CourseNameId = $(this).find(":selected").data('id');
      var targetSelect = $(this).closest('.row').find('#UniversityCourseSpecialization');
      loadCourseSpecializations(CourseNameId, targetSelect);
    });

    // Load course names
    function loadCourseNames(CourseSessionYearId, targetSelect) {
      $.ajax({
        type: "post",
        url: "<?php echo CONTROLLER; ?>/UniversityAjaxController.php",
        data: {
          CourseSessionYearId: CourseSessionYearId,
          CourseSessionBtn: "Submit"
        },
        success: function(response) {
          targetSelect.html(response);
        }
      });
    }

    // Load course specializations
    function loadCourseSpecializations(CourseNameId, targetSelect) {
      $.ajax({
        type: "post",
        url: "<?php echo CONTROLLER; ?>/UniversityAjaxController.php",
        data: {
          CourseNameId: CourseNameId,
          CourseNameBtn: "Submit"
        },
        success: function(response) {
          targetSelect.html(response);
        }
      });
    }
  });
</script>