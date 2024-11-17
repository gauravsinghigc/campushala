<section class="pop-section hidden" id="add_new_courses_specilization_fees_<?php echo $UniversitId; ?>">
  <div class="action-window custome-action-window " style="width:100% !important;">
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add New Courses Specilization Fees</h4>
        </div>
      </div>
      <form id="universityCourseSpeclizationForm" action="<?php echo CONTROLLER; ?>/UniversityController.php" method="POST">
        <?php FormPrimaryInputs(true, [
          "UniversityBtn" => "SaveUniversityData"
        ]); ?>
        <input type="hidden" name="universityIdForSpecFees" value="<?= $UniversitId ?>">
        <div class="row">
          <div class="col-md-12">
            <div class="row ">
              <div class="col-md-12">
                <div class="row ">
                  <div class='col-md-4 form-group'>
                    <label>Session Years <?php echo $req; ?></label><br>
                    <select class="form-control" name="univ_sessions_ids" id="universitysSessionsNames" style="width: 100%;" required="">
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
                  <div class='col-md-4 form-group'>
                    <label>Course Name <?php echo $req; ?></label><br>
                    <select name="courseNames" id="coursesNamesIds" class="form-control" required>
                    </select>

                  </div>
                  <div class='col-md-4 form-group'>
                    <label>Course Specialization <?php echo $req; ?></label><br>
                    <select name="specializations" id="coursesSpecsNamesIds" class="form-control" required>
                    </select>

                  </div>


                </div>
              </div>
              <div class="col-md-12">
                <div class="p-2 mt-4 shadow-sm " id="sessionCourseSpeclizationFeesList">

                </div>

              </div>
            </div>
            <div class="row" id="ShowAddFeesDetails">
              <div class="col-md-6 ">
                <div class="card shadow-none p-3 mb-5 bg-light rounded">
                  <h5 class="app-sub-heading text-center">Add Course Fees</h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="row w-100 ">
                        <div class='col-md-12'>
                          <div class="row">
                            <div class="col-md-12 form-group">
                              <label>Fees Modes <?php echo $req; ?></label>
                              <select name="tuition_fees_semester_modeWise" id="TuitionFeesSemesterWise" class="form-control form-control-sm" onchange="showTuitionFeesSemesterWiseFields()" required="">
                                <option value="">Choose Fees Modes</option>
                                <option value="Semesters Wise" selected>Semesters Wise</option>
                              </select>
                            </div>
                            <div class='col-md-12 form-group' id="TuitionFeesSemestersWiseFees" style="display: block !important;">
                              <!-- <div class="row" id="TuitionFeesAddMoreSemesterWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Sem Name <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_nameWise[]" class="form-control form-control-sm">
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
                                    <label>Sem Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                  </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
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
                              <select name="tuition_fees_year_modeWise" id="TuitionFeesYearWise" class="form-control form-control-sm" onchange="showTuitionFeesYearWiseFields()" required="">
                                <option value="">Choose Fees Modes</option>
                                <option value="Years Wise" selected>Years Wise</option>
                              </select>
                            </div>

                            <div class='col-md-12 form-group ' id="TuitionYearsWiseFees" style="display: block !important;">
                              <!-- <div class="row" id="TuitionYearsFeesAddMoreYearsWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year Name <?php echo $req; ?></label>
                                    <select name="tuition_course_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                      <option value="1">First Years</option>
                                      <option value="2">Second Years</option>
                                      <option value="3">Third Years</option>
                                      <option value="4">Fourth Years</option>
                                      <option value="5">Fifth Years</option>
                                    </select>
                                  </div>
                                  <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                  </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
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
                              <select name="tuition_fees_oneTime_modeWise" id="TuitionFeesOneTimeWise" class="form-control form-control-sm" onchange="showTuitionFeesOneTimeWiseFields()" required="">
                                <option value="">Choose Fees Modes</option>
                                <option value="One Time" selected>One Time</option>
                              </select>
                            </div>

                            <div class='col-md-12 form-group ' id="TuitionOneTimeWiseFees" style="display: block !important;">
                              <!-- <div class="row">
                                <div class="col-md-12 form-group d-flex">
                                  <div class="w-50">
                                    <label>Total Year Fee<?php echo $req; ?></label>
                                    <select name="tuition_course_total_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">Choose Total Year Fee</option>
                                      <option value="One Time">One Time</option>
                                    </select>
                                  </div>
                                  <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>One Time Fee<?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_one_time_feeWise[]" class="form-control form-control-sm" placeholder="10000">
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
                                  <select name="custom_fees_semester_modeWise" id="CustomFeesSemesterWise" class="form-control form-control-sm" onchange="showCustomFeesSemesterWiseFields()" required="">
                                    <option value="">Choose Fees Modes</option>
                                    <option value="Semesters Wise" selected>Semesters Wise</option>
                                  </select>
                                </div>
                                <div class='col-md-12 form-group' id="CustomFeesSemestersWiseFees" style="display: block !important;">
                                  <!-- <div class="row" id="CustomFeesAddMoreSemesterWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Sem Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
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
                                        <label>Sem Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
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
                                  <select name="custom_fees_year_modeWise" id="CustomFeesYearWise" class="form-control form-control-sm" onchange="showCustomFeesYearWiseFields()" required="">
                                    <option value="">Choose Fees Modes</option>
                                    <option value="Years Wise" selected>Years Wise</option>
                                  </select>
                                </div>

                                <div class='col-md-12 form-group ' id="CustomYearsWiseFees" style="display: block !important;">
                                  <!-- <div class="row" id="CustomYearsFeesAddMoreYearsWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year Name <?php echo $req; ?></label>
                                        <select name="custom_course_years_nameWise[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>
                                          <option value="1">First Years</option>
                                          <option value="2">Second Years</option>
                                          <option value="3">Third Years</option>
                                          <option value="4">Fourth Years</option>
                                          <option value="5">Fifth Years</option>
                                        </select>
                                      </div>
                                      <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                      </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
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
                                  <select name="custom_one_time_fees_modeWise" id="CustomFeesOneTimeWise" class="form-control form-control-sm" onchange="showCustomFeesOneTimeWiseFields()" required="">
                                    <option value="">Choose Fees Modes</option>
                                    <option value="One Time" selected>One Time</option>
                                  </select>
                                </div>

                                <div class='col-md-12 form-group ' id="CustomOneTimeFeesWise" style="display: block !important;">
                                  <!-- <div class="row">
                                    <div class="col-md-12 form-group d-flex">
                                      <div class="w-50">
                                        <label>Total Year Fee<?php echo $req; ?></label>
                                        <select name="custom_course_total_years_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Total Year Fee</option>
                                          <option value="One Time">One Time</option>
                                        </select>
                                      </div>
                                      <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>One Time Fee<?php echo $req; ?></label>
                                        <input type="number" name="custom_course_one_time_feeWise[]" class="form-control form-control-sm" placeholder="10000">
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
          <a href="#" onclick="Databar('add_new_courses_specilization_fees_<?php echo $UniversitId; ?>')" class="btn btn-sm btn-default cancel">Cancel</a>
          <button type="button" onclick="saveCoursesSpecilizationFeesDetails()" class="btn btn-sm btn-success">Add New Fees</button>
        </div>
    </div>
    </form>


    </form>
  </div>
</section>
<script>
  // Show Semester Fee Fields
  const showTuitionFeesSemesterWiseFields = () => {
    var semesterSelect = document.getElementById("TuitionFeesSemesterWise");
    var selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    var semesterDiv = document.getElementById("TuitionFeesSemestersWiseFees");
    var courseTotalFeeDiv = document.getElementById("courseTotalFeeDivWise");
    if (selectedSemesterOption === "Semesters Wise") {
      semesterDiv.style.display = "block";
    } else {
      semesterDiv.style.cssText = "display: none !important;";
    }
  };
  //Add Multiple Semester
  $(document).ready(function() {
    $(".add_tution_semesterWise_fee_btn").click(function(e) {
      e.preventDefault();
      $("#TuitionFeesAddMoreSemesterWise").append(` <div class="row m-0" id="TuitionFeesAddMoreSemesterWise">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Sem Name <?php echo $req; ?></label>
                              <select name="tuition_fees_semester_nameWise[]" class="form-control form-control-sm">
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
                              <label>Sem Fee <?php echo $req; ?></label>
                              <input type="number" name="tuition_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_tution_semesterWise_fee_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>

                        </div>`);
    });
    $(document).on('click', '.remove_tution_semesterWise_fee_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
    });
  });
</script>
<script>
  // Show Semester Fee Fields
  const showTuitionFeesYearWiseFields = () => {
    const semesterSelect = document.getElementById("TuitionFeesYearWise");
    const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    const yearsFeesDiv = document.getElementById("TuitionYearsWiseFees");
    const courseTotalFeeDiv = document.getElementById("courseTotalFeeDivWise");
    if (selectedSemesterOption === "Years Wise") {
      yearsFeesDiv.style.display = "block";
    } else {
      yearsFeesDiv.style.cssText = "display: none !important;";
    }
  };
  //Add Multiple Semester
  $(document).ready(function() {
    //Add Multiple Years
    $(".add_tution_yearWise_fee_btn").click(function(e) {
      e.preventDefault();
      $("#TuitionYearsFeesAddMoreYearsWise").append(` <div class="row m-0" id="TuitionYearsFeesAddMoreYearsWise">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year Name <?php echo $req; ?></label>
                              <select name="tuition_course_years_nameWise[]" class="form-control form-control-sm">
                              <option value="">choose year</option>
                              <option value="1">First Years</option>
                                <option value="2">Second Years</option>
                                <option value="3">Third Years</option>
                                <option value="4">Fourth Years</option>
                                <option value="5">Fifth Years</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Year Fee <?php echo $req; ?></label>
                              <input type="number" name="tuition_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_tution_yearWise_fee_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>
                        </div>`);
    });
    $(document).on('click', '.remove_tution_yearWise_fee_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
    });

  });
</script>
<script>
  // Show Semester Fee Fields
  const showTuitionFeesOneTimeWiseFields = () => {
    const semesterSelect = document.getElementById("TuitionFeesOneTimeWise");
    const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    const oneTimeFeesDiv = document.getElementById("TuitionOneTimeWiseFees");
    const courseTotalFeeDiv = document.getElementById("courseTotalFeeDivWise");

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
  const showCustomFeesSemesterWiseFields = () => {
    var semesterSelect = document.getElementById("CustomFeesSemesterWise");
    var selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    var semesterDiv = document.getElementById("CustomFeesSemestersWiseFees");
    var courseTotalFeeDiv = document.getElementById("courseTotalFeeDivWise");
    if (selectedSemesterOption === "Semesters Wise") {
      semesterDiv.style.display = "block";
    } else {
      semesterDiv.style.cssText = "display: none !important;";
    }
  };
  //Add Multiple Semester
  $(document).ready(function() {
    $(".add_custom_semesterWise_fee_btn").click(function(e) {
      e.preventDefault();
      $("#CustomFeesAddMoreSemesterWise").append(` <div class="row m-0" id="CustomFeesAddMoreSemesterWise">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Sem Name <?php echo $req; ?></label>
                              <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
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
                              <label>Sem Fee <?php echo $req; ?></label>
                              <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_custom_semesterWise_fee_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>

                        </div>`);
    });
    $(document).on('click', '.remove_custom_semesterWise_fee_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
    });
  });
</script>
<script>
  // Show Semester Fee Fields
  const showCustomFeesYearWiseFields = () => {
    const semesterSelect = document.getElementById("CustomFeesYearWise");
    const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    const yearsFeesDiv = document.getElementById("CustomYearsWiseFees");
    const courseTotalFeeDiv = document.getElementById("courseTotalFeeDivWise");
    if (selectedSemesterOption === "Years Wise") {
      yearsFeesDiv.style.display = "block";
    } else {
      yearsFeesDiv.style.cssText = "display: none !important;";
    }
  };
  //Add Multiple Semester
  $(document).ready(function() {
    //Add Multiple Years
    $(".add_custom_yearWise_fee_btn").click(function(e) {
      e.preventDefault();
      $("#CustomYearsFeesAddMoreYearsWise").append(` <div class="row m-0" id="CustomYearsFeesAddMoreYearsWise">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year Name <?php echo $req; ?></label>
                              <select name="custom_course_years_nameWise[]" class="form-control form-control-sm">
                              <option value="">choose year</option>
                              <option value="1">First Years</option>
                                <option value="2">Second Years</option>
                                <option value="3">Third Years</option>
                                <option value="4">Fourth Years</option>
                                <option value="5">Fifth Years</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 5px;">
                              <label>Year Fee <?php echo $req; ?></label>
                              <input type="number" name="custom_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger  remove_custom_yearWise_fee_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>
                        </div>`);
    });
    $(document).on('click', '.remove_custom_yearWise_fee_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
    });

  });
</script>
<script>
  // Show Semester Fee Fields
  const showCustomFeesOneTimeWiseFields = () => {
    const semesterSelect = document.getElementById("CustomFeesOneTimeWise");
    const selectedSemesterOption = semesterSelect.options[semesterSelect.selectedIndex].value;
    const oneTimeFeesDiv = document.getElementById("CustomOneTimeFeesWise");
    const courseTotalFeeDiv = document.getElementById("courseTotalFeeDivWise");

    if (selectedSemesterOption === "One Time") {
      oneTimeFeesDiv.style.display = "block";
    } else {
      oneTimeFeesDiv.style.cssText = "display: none !important;";
    }
  };
</script>

<script>
  $(document).ready(function() {
    $("#universitysSessionsNames").on("change", function(e) {
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
          $("#coursesNamesIds").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    //show course speclization
    $("#coursesNamesIds").on("change", function(e) {
      e.preventDefault();
      $coursesId = $(this).val();
      $sessionId = $("#universitysSessionsNames").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          addcoursesspecilizationsBtn: "submit",
        },
        success: function(response) {
          $("#coursesSpecsNamesIds").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#coursesSpecsNamesIds").on("change", function(e) {
      e.preventDefault();
      $courseSpecitilizationId = $(this).val();
      $coursesId = $("#coursesNamesIds").val();
      $sessionId = $("#universitysSessionsNames").val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          courseSpecitilizationId: $courseSpecitilizationId,
          showCoursesSpecilizationsFeeBtn: "submit",
        },
        success: function(response) {
          if ($.trim(response) !== "") {
            $("#ShowAddFeesDetails").hide();
            $("#sessionCourseSpeclizationFeesList").html(response);
          } else {
            $("#ShowAddFeesDetails").show();
            $("#sessionCourseSpeclizationFeesList").html(response);
          }

        },
        error: function(xhr, status, error) {

        }
      });
    });

    //Show Fees Field By Fees Mode Area Start Here
    $("#coursesSpecsNamesIds").on("change", function(e) {
      e.preventDefault();
      $coursesId = $("#coursesNamesIds").val();
      $sessionId = $("#universitysSessionsNames").val();
      $courseSpecitilizationId = $(this).val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          courseSpecitilizationId: $courseSpecitilizationId,
          addcoursesspecilizationFeesSemBtn: "submit",
        },
        success: function(response) {
          $("#TuitionFeesSemestersWiseFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#coursesSpecsNamesIds").on("change", function(e) {
      e.preventDefault();
      $coursesId = $("#coursesNamesIds").val();
      $sessionId = $("#universitysSessionsNames").val();
      $courseSpecitilizationId = $(this).val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          courseSpecitilizationId: $courseSpecitilizationId,
          addcoursesspecilizationFeesYearBtn: "submit",
        },
        success: function(response) {
          $("#TuitionYearsWiseFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#coursesSpecsNamesIds").on("change", function(e) {
      e.preventDefault();
      $coursesId = $("#coursesNamesIds").val();
      $sessionId = $("#universitysSessionsNames").val();
      $courseSpecitilizationId = $(this).val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          courseSpecitilizationId: $courseSpecitilizationId,
          addcoursesspecilizationFeesOneTimeBtn: "submit",
        },
        success: function(response) {
          $("#TuitionOneTimeWiseFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#coursesSpecsNamesIds").on("change", function(e) {
      e.preventDefault();
      $coursesId = $("#coursesNamesIds").val();
      $sessionId = $("#universitysSessionsNames").val();
      $courseSpecitilizationId = $(this).val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          courseSpecitilizationId: $courseSpecitilizationId,
          addcoursesspecilizationFeesTutitionSemBtn: "submit",
        },
        success: function(response) {
          $("#CustomFeesSemestersWiseFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#coursesSpecsNamesIds").on("change", function(e) {
      e.preventDefault();
      $coursesId = $("#coursesNamesIds").val();
      $sessionId = $("#universitysSessionsNames").val();
      $courseSpecitilizationId = $(this).val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          courseSpecitilizationId: $courseSpecitilizationId,
          addcoursesspecilizationFeesTutitionYearBtn: "submit",
        },
        success: function(response) {
          $("#CustomYearsWiseFees").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    $("#coursesSpecsNamesIds").on("change", function(e) {
      e.preventDefault();
      $coursesId = $("#coursesNamesIds").val();
      $sessionId = $("#universitysSessionsNames").val();
      $courseSpecitilizationId = $(this).val();
      $universityId = <?php echo $UniversitId; ?>;
      $.ajax({
        type: "POST",
        url: "<?= CONTROLLER ?>/UniversityController.php",
        data: {
          coursesId: $coursesId,
          universityId: $universityId,
          sessionId: $sessionId,
          courseSpecitilizationId: $courseSpecitilizationId,
          addcoursesspecilizationFeesTutitionOneTimeBtn: "submit",
        },
        success: function(response) {
          $("#CustomOneTimeFeesWise").html(response);
        },
        error: function(xhr, status, error) {

        }
      });
    });
    //Show Fees Field By Fees Mode Area End Here
  });

  function saveCoursesSpecilizationFeesDetails() {
    var courseSpecilizationData = {
      universityId: $("input[name='universityIdForSpecFees']").val(),
      universitySessionId: $("select[name='univ_sessions_ids']").val(),
      courseName: $("select[name='courseNames']").val(),
      specialization: $("select[name='specializations']").val(),
      //Course Fees
      feesModeSemester: $("select[name='tuition_fees_semester_modeWise']").val(),
      feesModeYear: $("select[name='tuition_fees_year_modeWise']").val(),
      feesModeOneTime: $("select[name='tuition_fees_oneTime_modeWise']").val(),
      semesterName: $("select[name='tuition_fees_semester_nameWise[]']").map(function() {
        return this.value;
      }).get(),
      semesterFee: $("input[name='tuition_fees_course_semester_feeWise[]']").map(function() {
        return this.value;
      }).get(),
      yearName: $("select[name='tuition_course_years_nameWise[]']").map(function() {
        return this.value;
      }).get(),
      yearFees: $("input[name='tuition_course_years_feeWise[]']").map(function() {
        return this.value;
      }).get(),
      oneTimeName: $("select[name='tuition_course_total_years_nameWise[]']").map(function() {
        return this.value;
      }).get(),
      oneTimeFees: $("input[name='tuition_course_one_time_feeWise[]']").map(function() {
        return this.value;
      }).get(),
      //Custome Fees
      feesModeSemestercustom: $("select[name='custom_fees_semester_modeWise']").val(),
      feesModeYearcustom: $("select[name='custom_fees_year_modeWise']").val(),
      feesModeOneTimecustom: $("select[name='custom_one_time_fees_modeWise']").val(),
      semesterNamecustom: $("select[name='custom_fees_semester_nameWise[]']").map(function() {
        return this.value;
      }).get(),
      semesterFeecustom: $("input[name='custom_fees_course_semester_feeWise[]']").map(function() {
        return this.value;
      }).get(),
      yearNamecustom: $("select[name='custom_course_years_nameWise[]']").map(function() {
        return this.value;
      }).get(),
      yearFeescustom: $("input[name='custom_course_years_feeWise[]']").map(function() {
        return this.value;
      }).get(),
      oneTimeNamecustom: $("select[name='custom_course_total_years_nameWise[]']").map(function() {
        return this.value;
      }).get(),
      oneTimeFeescustom: $("input[name='custom_course_one_time_feeWise[]']").map(function() {
        return this.value;
      }).get(),
    };
    // Add the button name and value to the courseSpecilizationData object
    courseSpecilizationData.saveCoursesSpecilizationFeesDetails = "SaveUniversityCoursesSpecilizationFeesData";
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
            'New Course Specilization Fees Saved Successfully',
            'success'
          ).then(() => {
            var popupSection = document.getElementById("add_new_courses_specilization_fees_<?php echo $UniversitId; ?>");
            popupSection.classList.add("hidden");
            location.reload();
          });
        } else if (responseData.status === "Already Exists") {
          Swal.fire(
            '',
            'Course Specilization Fees Already Exists',
            'warning'
          ).then(() => {
            var popupSection = document.getElementById("add_new_courses_specilization_fees_<?php echo $UniversitId; ?>");
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