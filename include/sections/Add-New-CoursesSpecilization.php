<section class="pop-section hidden" id="add_new_courses_specilization_<?php echo $UniversitId; ?>">
  <div class="action-window custome-action-window " style="width:100% !important;">
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add New Courses Specilization</h4>
        </div>
      </div>
      <form id="universityCourseSpeclizationForm" action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">
        <?php FormPrimaryInputs(true, [
          "UniversityBtn" => "SaveUniversityData"
        ]); ?>
        <input type="hidden" name="universityIdForSpec" value="<?= $UniversitId ?>">
        <div class="row">
          <div class="col-md-12">
            <div class="row m-2 shadow  bg-white rounded" style="background-color: #fff1f1 !important; margin-bottom:20px !important;">
              <div class="col-md-12 p-2">
                <span>
                  <p><span><b class="text-danger">Note:-></b></span>Befor Adding Multiple Specilization Make sure all specilization Course And Tutition Fee are same .If Fees Not Same then add single specilization.</p>
                </span>
              </div>
            </div>
            <div class="row ">
              <div class="col-md-9">
                <div class="row ">
                  <div class='col-md-3 form-group'>
                    <label>Session Years <?php echo $req; ?></label><br>
                    <select class="form-control" name="univ_session_ids" id="universitySessionName" style="width: 100%;" required="">
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
                  <div class='col-md-3 form-group'>
                    <label>Course Name <?php echo $req; ?></label><br>
                    <select name="courseName" id="courseNameId" class="form-control" required>
                    </select>

                  </div>
                  <div class='col-md-6'>
                    <div class="row" id="addMoreSpecialization">
                      <!-- Your existing specialization fields -->
                      <div class="col-md-12 specialization-container">
                        <div class="row">
                          <div class="col-md-11 form-group">
                            <label>Course Specialization <?php echo $req; ?></label><br>
                            <input type="text" name="specialization[]" class="form-control " required>
                          </div>
                          <div class="col-md-1 form-group">
                            <label></label>
                            <button class="btn btn-outline-info add_specialization_btn "><i class="bi bi-plus"></i></button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
              <div class="col-md-3">

                <div class="col-md-12 form-group">
                  <div class="p-2 mt-4 shadow-sm" id="sessionCourseSpeclizationList">

                  </div>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-6 ">
                <div class="card shadow-none p-3 mb-5 bg-light rounded">
                  <h5 class="app-sub-heading text-center">Add Course Fees</h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="row w-100 ">
                        <div class='col-md-12' id="semesterShowList">
                          <div class="row">
                            <div class="col-md-12 form-group">
                              <label>Fees Modes <?php echo $req; ?></label>
                              <select name="tuition_fees_semester_mode" id="TuitionFeesSemester" class="form-control form-control-sm" onchange="showTuitionFeesSemesterFields()" required="">
                                <option value="">Choose Fees Modes</option>
                                <option value="Semesters Wise" selected>Semesters Wise</option>
                              </select>
                            </div>
                            <div class='col-md-12 form-group' id="TuitionFeesSemestersFees" style="display: block !important;">
                              <!-- <div class="row" id="TuitionFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Semester <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                      <option value="1">First Semester</option>
                                      <option value="2">Second Semester</option>
                                      <option value="3">Third Semester</option>
                                      <option value="4">Fourth Semester</option>
                                      <option value="5">Fifth Semester</option>
                                      <option value="6">Sixth Semester</option>
                                      <option value="7">Seventh Semester</option>
                                      <option value="8">Eighth Semester</option>
                                      <option value="9">Ninth Semester</option>
                                      <option value="10">Tenth Semester</option>
                                    </select>
                                  </div>
                                  <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                  </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>

                              </div> -->

                            </div>

                          </div>

                        </div>

                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row w-100 ">
                        <div class='col-md-12'>
                          <div class="row">
                            <div class="col-md-12 form-group">
                              <label>Fees Modes <?php echo $req; ?></label>
                              <select name="tuition_fees_year_mode" id="TuitionFeesYear" class="form-control form-control-sm" onchange="showTuitionFeesYearFields()" required="">
                                <option value="">Choose Fees Modes</option>
                                <option value="Years Wise" selected>Years Wise</option>
                              </select>
                            </div>

                            <div class='col-md-12 form-group ' id="TuitionYearsFees" style="display: block !important;">
                              <!-- <div class="row" id="TuitionYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year <?php echo $req; ?></label>
                                    <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                      <option value="1">First Years</option>
                                      <option value="2">Second Years</option>
                                      <option value="3">Third Years</option>
                                      <option value="4">Fourth Years</option>
                                      <option value="5">Fifth Years</option>
                                    </select>
                                  </div>
                                  <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >

                                  </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>
                              </div> -->
                            </div>

                          </div>

                        </div>

                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="row w-100 ">
                        <div class='col-md-12'>
                          <div class="row">
                            <div class="col-md-12 form-group">
                              <label>Fees Modes <?php echo $req; ?></label>
                              <select name="tuition_fees_oneTime_mode" id="TuitionFeesOneTime" class="form-control form-control-sm" onchange="showTuitionFeesOneTimeFields()" required="">
                                <option value="">Choose Fees Modes</option>
                                <option value="One Time" selected>One Time</option>
                              </select>
                            </div>

                            <div class='col-md-12 form-group ' id="TuitionOneTimeFees" style="display: block !important;">
                              <!-- <div class="row">
                                <div class="col-md-12 form-group d-flex">
                                  <div class="w-50">
                                    <label>Total<?php echo $req; ?></label>
                                    <select name="tuition_course_total_years_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Total</option>
                                      <option value="One Time" selected>One Time</option>
                                    </select>
                                  </div>
                                  <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee<?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_one_time_fee[]" class="form-control form-control-sm" >
                                  </div>
                                </div>

                              </div> -->
                            </div>

                          </div>

                        </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card shadow-none p-3 mb-5 bg-light rounded">
                  <h5 class="app-sub-heading text-center">Add Tutition Fees</h5>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="row w-100 ">
                            <div class='col-md-12'>
                              <div class="row">
                                <div class="col-md-12 form-group">
                                  <label>Fees Modes <?php echo $req; ?></label>
                                  <select name="custom_fees_semester_mode" id="CustomFeesSemester" class="form-control form-control-sm" onchange="showCustomFeesSemesterFields()" required="">
                                    <option value="">Choose Fees Modes</option>
                                    <option value="Semesters Wise" selected>Semesters Wise</option>
                                  </select>
                                </div>
                                <div class='col-md-12 form-group' id="CustomFeesSemestersFees" style="display: block !important;">
                                  <!-- <div class="row" id="CustomFeesAddMoreSemester">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Semester <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                          <option value="1">First Semester</option>
                                          <option value="2">Second Semester</option>
                                          <option value="3">Third Semester</option>
                                          <option value="4">Fourth Semester</option>
                                          <option value="5">Fifth Semester</option>
                                          <option value="6">Sixth Semester</option>
                                          <option value="7">Seventh Semester</option>
                                          <option value="8">Eighth Semester</option>
                                          <option value="9">Ninth Semester</option>
                                          <option value="10">Tenth Semester</option>
                                        </select>
                                      </div>
                                      <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                      </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>

                                  </div> -->

                                </div>

                              </div>

                            </div>

                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="row w-100 ">
                            <div class='col-md-12'>
                              <div class="row">
                                <div class="col-md-12 form-group">
                                  <label>Fees Modes <?php echo $req; ?></label>
                                  <select name="custom_fees_year_mode" id="CustomFeesYear" class="form-control form-control-sm" onchange="showCustomFeesYearFields()" required="">
                                    <option value="">Choose Fees Modes</option>
                                    <option value="Years Wise" selected>Years Wise</option>
                                  </select>
                                </div>

                                <div class='col-md-12 form-group ' id="CustomYearsFees" style="display: block !important;">
                                  <!-- <div class="row" id="CustomYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>
                                          <option value="1">First Years</option>
                                          <option value="2">Second Years</option>
                                          <option value="3">Third Years</option>
                                          <option value="4">Fourth Years</option>
                                          <option value="5">Fifth Years</option>
                                        </select>
                                      </div>
                                      <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >

                                      </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>
                                  </div> -->
                                </div>

                              </div>

                            </div>

                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="row w-100 ">
                            <div class='col-md-12'>
                              <div class="row">
                                <div class="col-md-12 form-group">
                                  <label>Fees Modes <?php echo $req; ?></label>
                                  <select name="custom_one_time_fees_mode" id="CustomFeesOneTime" class="form-control form-control-sm" onchange="showCustomFeesOneTimeFields()" required="">
                                    <option value="">Choose Fees Modes</option>
                                    <option value="One Time" selected>One Time</option>
                                  </select>
                                </div>

                                <div class='col-md-12 form-group ' id="CustomOneTimeFees" style="display: block !important;">
                                  <!-- <div class="row">
                                    <div class="col-md-12 form-group d-flex">
                                      <div class="w-50">
                                        <label>Total<?php echo $req; ?></label>
                                        <select name="custom_course_total_years_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Total</option>
                                          <option value="One Time">One Time</option>
                                        </select>
                                      </div>
                                      <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee<?php echo $req; ?></label>
                                        <input type="number" name="custom_course_one_time_fee[]" class="form-control form-control-sm" >
                                      </div>
                                    </div>

                                  </div> -->
                                </div>

                              </div>

                            </div>

                          </div>
                        </div>


                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 d-flex justify-content-between btn">
          <a href="#" onclick="Databar('add_new_courses_specilization_<?php echo $UniversitId; ?>')" class="btn btn-sm btn-default cancel">Cancel</a>
          <button type="button" onclick="saveCoursesSpecilizationDetails()" class="btn btn-sm btn-success next">Add New Courses</button>
        </div>
    </div>
    </form>


    </form>
  </div>
</section>
<script>
  $(document).on('click', '.add_specialization_btn', function(e) {
    e.preventDefault();
    // Add a new specialization field in the second column of the existing row
    var newSpecialization = `
            <div class="col-md-6 specialization-container">
                <div class="row">
                    <div class="col-md-10 form-group">
                        <label>Course Specialization <?php echo $req; ?></label><br>
                        <input type="text" name="specialization[]" class="form-control " required>
                    </div>
                    <div class="col-md-1 form-group">
                        <label></label>
                        <button class="btn btn-outline-danger remove_specialization_btn"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            </div>
        `;
    $("#addMoreSpecialization").append(newSpecialization);
  });

  $(document).on('click', '.remove_specialization_btn', function(e) {
    e.preventDefault();
    $(this).closest('.specialization-container').remove();
  });
</script>
<script>
  // Show Semester Fee Fields
  const showTuitionFeesSemesterFields = () => {
    var semesterSelect = document.getElementById("TuitionFeesSemester");
    var selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    var semesterDiv = document.getElementById("TuitionFeesSemestersFees");
    var courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
    if (selectedSemesterOption === "Semesters Wise") {
      semesterDiv.style.display = "block";
    } else {
      semesterDiv.style.cssText = "display: none !important;";
    }
  };
  //Add Multiple Semester
  $(document).ready(function() {
    $(document).on("click", ".add_tution_semester_fee_btn", function(e) {
      e.preventDefault();
      let parentContainer = $(this).closest(".row");
      // Create the new field HTML
      let newField = `<div class="row " id="TuitionFeesAddMoreSemester">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Semester <?php echo $req; ?></label>
                              <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                              <option value="">choose semester</option>
                              <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                                <option value="3">Third Semester</option>
                                <option value="4">Fourth Semester</option>
                                <option value="5">Fifth Semester</option>
                                <option value="6">Sixth Semester</option>
                                <option value="7">Seventh Semester</option>
                                <option value="8">Eighth Semester</option>
                                <option value="9">Ninth Semester</option>
                                <option value="10">Tenth Semester</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Fee <?php echo $req; ?></label>
                              <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_tution_semester_fee_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>

                        </div>`;

      // Insert the new field after the parent container
      $(parentContainer).after(newField);
    });
    $(document).on('click', '.remove_tution_semester_fee_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).closest(".row");
      $(row_item).remove();
    });
  });
</script>
<script>
  // Show Semester Fee Fields
  const showTuitionFeesYearFields = () => {
    const semesterSelect = document.getElementById("TuitionFeesYear");
    const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    const yearsFeesDiv = document.getElementById("TuitionYearsFees");
    const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
    if (selectedSemesterOption === "Years Wise") {
      yearsFeesDiv.style.display = "block";
    } else {
      yearsFeesDiv.style.cssText = "display: none !important;";
    }
  };
  //Add Multiple Semester
  $(document).ready(function() {
    //Add Multiple Years
    $(document).on("click", ".add_tution_year_fee_btn", function(e) {
      e.preventDefault();
      let parentContainer = $(this).closest(".row");
      // Create the new field HTML
      let newField = `<div class="row " id="TuitionYearsFeesAddMoreYears">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year <?php echo $req; ?></label>
                              <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                              <option value="">choose year</option>
                              <option value="1">First Years</option>
                                <option value="2">Second Years</option>
                                <option value="3">Third Years</option>
                                <option value="4">Fourth Years</option>
                                <option value="5">Fifth Years</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Fee <?php echo $req; ?></label>
                              <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_tution_year_fee_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>
                        </div>`;

      // Insert the new field after the parent container
      $(parentContainer).after(newField);
    });
    $(document).on('click', '.remove_tution_year_fee_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).closest(".row");
      $(row_item).remove();
    });

  });
</script>
<script>
  // Show Semester Fee Fields
  const showTuitionFeesOneTimeFields = () => {
    const semesterSelect = document.getElementById("TuitionFeesOneTime");
    const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    const oneTimeFeesDiv = document.getElementById("TuitionOneTimeFees");
    const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");

    if (selectedSemesterOption === "One Time") {
      oneTimeFeesDiv.style.display = "block";
    } else {
      oneTimeFeesDiv.style.cssText = "display: none !important;";
    }
  };
</script>
<!-- Tutition Fees -->
<script>
  // Show Semester Fee Fields
  const showCustomFeesSemesterFields = () => {
    var semesterSelect = document.getElementById("CustomFeesSemester");
    var selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    var semesterDiv = document.getElementById("CustomFeesSemestersFees");
    var courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
    if (selectedSemesterOption === "Semesters Wise") {
      semesterDiv.style.display = "block";
    } else {
      semesterDiv.style.cssText = "display: none !important;";
    }
  };
  //Add Multiple Semester
  $(document).ready(function() {
    $(document).on("click", ".add_custom_semester_fee_btn", function(e) {
      e.preventDefault();
      // Find the parent container of the button
      let parentContainer = $(this).closest(".row");

      // Create the new field HTML
      let newField = ` <div class="row " id="CustomFeesAddMoreSemester">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Semester <?php echo $req; ?></label>
                              <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                              <option value="">choose semester</option>
                              <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                                <option value="3">Third Semester</option>
                                <option value="4">Fourth Semester</option>
                                <option value="5">Fifth Semester</option>
                                <option value="6">Sixth Semester</option>
                                <option value="7">Seventh Semester</option>
                                <option value="8">Eighth Semester</option>
                                <option value="9">Ninth Semester</option>
                                <option value="10">Tenth Semester</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Fee <?php echo $req; ?></label>
                              <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_custom_semester_fee_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>

                        </div>`;

      // Insert the new field after the parent container
      $(parentContainer).after(newField);
    });
    $(document).on('click', '.remove_custom_semester_fee_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).closest(".row");
      $(row_item).remove();
    });
  });
</script>
<script>
  // Show Semester Fee Fields
  const showCustomFeesYearFields = () => {
    const semesterSelect = document.getElementById("CustomFeesYear");
    const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    const yearsFeesDiv = document.getElementById("CustomYearsFees");
    const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");
    if (selectedSemesterOption === "Years Wise") {
      yearsFeesDiv.style.display = "block";
    } else {
      yearsFeesDiv.style.cssText = "display: none !important;";
    }
  };
  //Add Multiple Semester
  $(document).ready(function() {
    //Add Multiple Years
    $(document).on("click", ".add_custom_year_fee_btn", function(e) {
      e.preventDefault();
      // Find the parent container of the button
      let parentContainer = $(this).closest(".row");

      // Create the new field HTML
      let newField = ` <div class="row " id="CustomYearsFeesAddMoreYears">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year <?php echo $req; ?></label>
                              <select name="custom_course_years_name[]" class="form-control form-control-sm">
                              <option value="">choose year</option>
                              <option value="1">First Years</option>
                                <option value="2">Second Years</option>
                                <option value="3">Third Years</option>
                                <option value="4">Fourth Years</option>
                                <option value="5">Fifth Years</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Fee <?php echo $req; ?></label>
                              <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_custom_year_fee_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>
                        </div>`;

      // Insert the new field after the parent container
      $(parentContainer).after(newField);
    });
    $(document).on('click', '.remove_custom_year_fee_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).closest(".row");
      $(row_item).remove();
    });

  });
</script>
<script>
  // Show Semester Fee Fields
  const showCustomFeesOneTimeFields = () => {
    const semesterSelect = document.getElementById("CustomFeesOneTime");
    const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    const oneTimeFeesDiv = document.getElementById("CustomOneTimeFees");
    const courseTotalFeeDiv = document.getElementById("courseTotalFeeDiv");

    if (selectedSemesterOption === "One Time") {
      oneTimeFeesDiv.style.display = "block";
    } else {
      oneTimeFeesDiv.style.cssText = "display: none !important;";
    }
  };
</script>
<script>
  $(document).ready(function() {
    $("#universitySessionName").on("change", function(e) {
      e.preventDefault();
      $sessionId = $(this).val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          sessionId: $sessionId,
          universityId: $universityId,
          addcoursesspecBtn: "submit",
        },
        success: function(response) {
          $("#courseNameId").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    //show course speclization
    $("#courseNameId").on("change", function(e) {
      e.preventDefault();
      $coursesId = $(this).val();
      $sessionId = $("#universitySessionName").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          addcoursesspecilizationBtn: "submit",
        },
        success: function(response) {
          $("#sessionCourseSpeclizationList").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#courseNameId").on("change", function(e) {
      e.preventDefault();
      $coursesId = $(this).val();
      $sessionId = $("#universitySessionName").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          addcoursesspecilizationSemBtn: "submit",
        },
        success: function(response) {
          $("#TuitionFeesSemestersFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#courseNameId").on("change", function(e) {
      e.preventDefault();
      $coursesId = $(this).val();
      $sessionId = $("#universitySessionName").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          addcoursesspecilizationYearBtn: "submit",
        },
        success: function(response) {
          $("#TuitionYearsFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#courseNameId").on("change", function(e) {
      e.preventDefault();
      $coursesId = $(this).val();
      $sessionId = $("#universitySessionName").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          addcoursesspecilizationOneTimeBtn: "submit",
        },
        success: function(response) {
          $("#TuitionOneTimeFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#courseNameId").on("change", function(e) {
      e.preventDefault();
      $coursesId = $(this).val();
      $sessionId = $("#universitySessionName").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          addcoursesspecilizationTutitionSemBtn: "submit",
        },
        success: function(response) {
          $("#CustomFeesSemestersFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#courseNameId").on("change", function(e) {
      e.preventDefault();
      $coursesId = $(this).val();
      $sessionId = $("#universitySessionName").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          addcoursesspecilizationTutitionYearBtn: "submit",
        },
        success: function(response) {
          $("#CustomYearsFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#courseNameId").on("change", function(e) {
      e.preventDefault();
      $coursesId = $(this).val();
      $sessionId = $("#universitySessionName").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          addcoursesspecilizationTutitionOneTimeBtn: "submit",
        },
        success: function(response) {
          $("#CustomOneTimeFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
  });

  function saveCoursesSpecilizationDetails() {
    var courseSpecilizationData = {
      universityId: $("input[name='universityIdForSpec']").val(),
      universitySessionId: $("select[name='univ_session_ids']").val(),
      courseName: $("select[name='courseName']").val(),
      specialization: $("input[name='specialization[]']").map(function() {
        return this.value;
      }).get(),
      //Course Fees
      feesModeSemester: $("select[name='tuition_fees_semester_mode']").val(),
      feesModeYear: $("select[name='tuition_fees_year_mode']").val(),
      feesModeOneTime: $("select[name='tuition_fees_oneTime_mode']").val(),
      semesterName: $("select[name='tuition_fees_semester_name[]']").map(function() {
        return this.value;
      }).get(),
      semesterFee: $("input[name='tuition_fees_course_semester_fee[]']").map(function() {
        return this.value;
      }).get(),
      yearName: $("select[name='tuition_course_years_name[]']").map(function() {
        return this.value;
      }).get(),
      yearFees: $("input[name='tuition_course_years_fee[]']").map(function() {
        return this.value;
      }).get(),
      oneTimeName: $("select[name='tuition_course_total_years_name[]']").map(function() {
        return this.value;
      }).get(),
      oneTimeFees: $("input[name='tuition_course_one_time_fee[]']").map(function() {
        return this.value;
      }).get(),
      //Custome Fees
      feesModeSemestercustom: $("select[name='custom_fees_semester_mode']").val(),
      feesModeYearcustom: $("select[name='custom_fees_year_mode']").val(),
      feesModeOneTimecustom: $("select[name='custom_one_time_fees_mode']").val(),
      semesterNamecustom: $("select[name='custom_fees_semester_name[]']").map(function() {
        return this.value;
      }).get(),
      semesterFeecustom: $("input[name='custom_fees_course_semester_fee[]']").map(function() {
        return this.value;
      }).get(),
      yearNamecustom: $("select[name='custom_course_years_name[]']").map(function() {
        return this.value;
      }).get(),
      yearFeescustom: $("input[name='custom_course_years_fee[]']").map(function() {
        return this.value;
      }).get(),
      oneTimeNamecustom: $("select[name='custom_course_total_years_name[]']").map(function() {
        return this.value;
      }).get(),
      oneTimeFeescustom: $("input[name='custom_course_one_time_fee[]']").map(function() {
        return this.value;
      }).get(),

    };
    // Add the button name and value to the courseSpecilizationData object
    courseSpecilizationData.saveCoursesSpecilizationDataEditPage = "SaveUniversityCoursesSpecilizationData";
    $.ajax({
      url: "<?php echo CONTROLLER; ?>/UniversityController.php", // PHP script to handle the AJAX request
      type: "POST",
      data: JSON.stringify(courseSpecilizationData),
      contentType: "application/json",
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
            'New Course Specilization Saved Successfully',
            'success'
          ).then(() => {
            var popupSection = document.getElementById("add_new_courses_specilization_<?php echo $UniversitId; ?>");
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