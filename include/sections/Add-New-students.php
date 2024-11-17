<section class="pop-section hidden" id="AddNewStudents">
  <div class="action-window custome-action-window custom-action-window-height">
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add New Students</h4>
        </div>
      </div>

      <form action="<?php echo CONTROLLER; ?>/StudentsController.php" method="POST">
        <?php FormPrimaryInputs(true, [
          "SubmitBtn" => "SaveStudentData",
          "stud_university_name_id" => "stud_university_name",
        ]); ?>

        <div class="col-md-12">
          <div class="card student-card mx-auto">
            <div class="tab">
              <div class="row">
                <div class="col-md-5">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card-header">
                        Student Primary Details
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label>Student Full Name <?php echo $req; ?></label>
                            <input type="text" name="student_full_name" class="form-control " required="">
                          </div>
                          <div class='col-md-6 form-group'>
                            <label>Phone Number <?php echo $req; ?></label>
                            <input type="tel" placeholder="without +91" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" name="student_phone_no" class="form-control " required="">
                          </div>

                          <div class='col-md-6 form-group'>
                            <label>Alternate Phone Number </label>
                            <input type="tel" placeholder="without +91" name="student_alt_phone_no" class="form-control ">
                          </div>
                          <div class='col-md-6 form-group'>
                            <label>Email-ID </label>
                            <input type="email" oninput="CheckExistingMailId()" id="EmailId" name="student_email_id" class="form-control ">
                          </div>
                          <div class='col-md-6 form-group'>
                            <label>Alternate Email-ID </label>
                            <input type="email" name="student_alt_email_id" class="form-control ">
                          </div>
                          <div class='col-md-6 form-group'>
                            <label>Date of Birth </label>
                            <input type="date" name="student_date_birth" class="form-control ">
                          </div>
                          <div class='col-md-6 form-group'>
                            <label>Gender </label>
                            <select name="student_gender" class="form-control ">
                              <?php
                              $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("GENDER"), true);
                              if ($LeadSource != null) {
                                foreach ($LeadSource as $Source) {
                              ?>
                                  <option value="<?php echo $Source->ConfigValueDetails; ?>"><?php echo $Source->ConfigValueDetails; ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="card-header">
                        Lead Source & Select BDE
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label>Lead Source <?php echo $req; ?></label>
                            <select name="leadSource" class="form-control" id="leadSource" onchange="leadSources()">
                              <option value="">choose lead souces</option>
                              <?php
                              $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("LEAD_SOURCE"), true);
                              if ($LeadSource != null) {
                                foreach ($LeadSource as $Source) {
                              ?>
                                  <option value="<?php echo $Source->ConfigValueDetails; ?>"><?php echo $Source->ConfigValueDetails; ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-md-6" style="display: none;" id="referredBy">
                            <div class="col-md-12 form-group">
                              <label>Referee Name <?php echo $req; ?></label>
                              <input type="text" name="refereeName" class="form-control ">
                            </div>
                            <div class="col-md-12 form-group">
                              <label>Referee Contact <?php echo $req; ?></label>
                              <input type="text" name="refereeContact" class="form-control ">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="col-md-12 form-group">
                              <label>BDE <?php echo $req; ?></label>
                              <select name="stud_bde_name" class="form-control" id="selectBDEDetails">
                                <option value="">choose lead BDE's</option>
                                <?php $fetchBda = FETCH_DB_TABLE("SELECT * FROM bdes_primary_details WHERE bdes_status='1'", true);
                                if (isset($fetchBda)) {
                                  foreach ($fetchBda as $value) { ?>
                                    <option value="<?= $value->bdes_id ?>"><?= $value->bdes_first_name . "" . $value->bdes_last_name ?></option>
                                <?php }
                                } ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label for="">BDE Points</label>
                            <input type="text" class="form-control " name="BDEPoints">
                          </div>
                          <div class="col-md-6">

                            <div class="col-md-12">
                              <div class="accordion shadow-sm " id="accordionExample">
                                <div class="card">
                                  <div class="card-header p-0" id="headingOne">
                                    <h2 class="mb-0">
                                      <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="bi bi-eye-fill text-info"></i> BDE Details
                                      </button>
                                    </h2>
                                  </div>

                                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body" id="BdeDetails">
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
                <div class="col-md-7">
                  <div class="card-header">
                    University Details
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="row mb-2">
                          <div class="col-12 col-xs-12 col-sm-12 form-group">
                            <div class="form-group">
                              <label>Select University</label><br>
                              <select name="university_id" class="form-control selectpicker " data-live-search="true" id="studUniversityName" style="width: 100%;" required="">
                                <option>choose university</option>
                                <?php $fetchUniversity = FETCH_DB_TABLE("SELECT university_id,university_name FROM universities_primary_details WHERE university_status='1'", true);
                                if (isset($fetchUniversity)) {
                                  foreach ($fetchUniversity as $value) { ?>
                                    <option value="<?= $value->university_id ?>"><?= $value->university_name ?></option>
                                <?php }
                                } ?>
                              </select>
                            </div>
                          </div>

                        </div>
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Course Session Years</label>
                        <select class="form-control selectpicker " data-live-search="true" name="univ_session_id" id="UniversityCourseSessionYears" style="width: 100%;" required="">

                        </select>
                      </div>
                      <div class="col-md-6">
                        <div class="row mb-2">
                          <div class="col-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                              <label>Select Couses</label>
                              <select name="univ_courses_id" class="form-control" id="studUniversityCourseName">
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 form-group">
                        <label>Course Specialization</label>
                        <select class="form-control selectpicker " data-live-search="true" name="univ_course_specialization_id" id="UniversityCourseSpecialization" style="width: 100%;" required="">

                        </select>
                      </div>


                      <div class="col-md-6">
                        <div class="accordion shadow-sm " id="accordionExample">
                          <div class="card">
                            <div class="card-header p-0" id="headingTwo">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                  <i class="bi bi-eye-fill text-info"></i> University Details
                                </button>
                              </h2>
                            </div>

                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body" id="UniversityAddressResponse">
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="col-md-6">
                        <div class="accordion shadow-sm " id="accordionExample">
                          <div class="card">
                            <div class="card-header p-0" id="headingThree">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                  <i class="bi bi-eye-fill text-info"></i> Course Details
                                </button>
                              </h2>
                            </div>

                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body" id="UniversityCoursesDetails">
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                    </div>
                    <div class="row">
                      <div class="card-header w-100">
                        Student Registration Details
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6 form-group">
                            <label>Date of Admission</label>
                            <input type="date" name="stud_dof_admission" class="form-control" min="1">
                          </div>
                          <div class="col-md-6 form-group">
                            <label>Student Registration No</label>
                            <input type="text" name="stud_reg_no" class="form-control" min="1">
                          </div>
                          <div class="col-md-6 form-group">
                            <label>Registration Status</label>
                            <select name="stud_reg_status" class="form-control">
                              <?php
                              $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("REGISTRATION_STATUS"), true);
                              if ($LeadSource != null) {
                                foreach ($LeadSource as $Source) {
                              ?>
                                  <option value="<?php echo $Source->ConfigValueDetails; ?>"><?php echo $Source->ConfigValueDetails; ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>

                          <div class="col-md-6 form-group">
                            <label>Payment Mode</label>
                            <select name="stud_fee_payment_mode" class="form-control">
                              <?php
                              $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("PAYMENT_MODE"), true);
                              if ($LeadSource != null) {
                                foreach ($LeadSource as $Source) {
                              ?>
                                  <option value="<?php echo $Source->ConfigValueDetails; ?>"><?php echo $Source->ConfigValueDetails; ?></option>
                              <?php
                                }
                              }
                              ?>

                            </select>
                          </div>
                          <div class="col-md-6 form-group">
                            <label>Payment Type</label>
                            <select name="stud_fee_payment_type" class="form-control">
                              <?php
                              $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("PAYMENT_TYPE"), true);
                              if ($LeadSource != null) {
                                foreach ($LeadSource as $Source) {
                              ?>
                                  <option value="<?php echo $Source->ConfigValueDetails; ?>"><?php echo $Source->ConfigValueDetails; ?></option>
                              <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-md-6 form-group">
                            <label>Inital Payment/Registration Amount</label>
                            <input type="number" name="stud_reg_amount" class="form-control" min="1">
                          </div>
                          <div class="col-md-6 form-group">
                            <label>Payment Date</label>
                            <input type="date" name="stud_payment_date" class="form-control" min="1">
                          </div>

                          <div class="col-md-6 form-group">
                            <label>Notes/Remarks</label>
                            <input type="text" name="stud_reg_note" class="form-control" min="1">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>

            <div class="col-md-12 d-flex justify-content-between btn">
              <a href="#" onclick="Databar('AddNewStudents')" class="btn btn-sm btn-default ">Cancel</a>

              <button type="submit" name="AddNewStudent" value="submit" class="btn btn-sm btn-success ">Save Details</button>
            </div>
          </div>
        </div>
    </div>

    </form>
  </div>
</section>
<script>
  $('#studUniversityName').select2({
    dropdownParent: $('#AddNewStudents'),
    placeholder: "choose university",
  });
  $('.selectpicker').select2({
    dropdownParent: $('#AddNewStudents'),
    placeholder: "Add New Course Specialization",
  });
  $("#studUniversityName").on("change", function(e) {
    e.preventDefault();
    let studUniversityId = $(this).val();
    $.ajax({
      type: "post",
      url: "<?= CONTROLLER ?>/StudentAjaxController.php",
      data: {
        studUniversityId: studUniversityId,
        studUniBtn: "submit",
      },
      success: function(response) {
        $("#UniversityCourseSessionYears").html(response);
      }
    });
  });
  $("#UniversityCourseSessionYears").on("change", function(e) {
    e.preventDefault();
    let SessionYearId = $(this).val();
    let studUniversityId = $(this).find(':selected').data('uniid');
    $.ajax({
      type: "post",
      url: "<?= CONTROLLER ?>/StudentAjaxController.php",
      data: {
        SessionYearId: SessionYearId,
        studUniversityId: studUniversityId,
        studUnversitySessionYearBtn: "submit",
      },
      success: function(response) {
        $("#studUniversityCourseName").html(response);
      }
    });
  });
  $("#studUniversityCourseName").on("change", function(e) {
    e.preventDefault();
    let univCourseId = $(this).val();
    $.ajax({
      type: "post",
      url: "<?= CONTROLLER ?>/StudentAjaxController.php",
      data: {
        univCourseId: univCourseId,
        studUnversityCourseSepcBtn: "submit",
      },
      success: function(response) {
        $("#UniversityCourseSpecialization").html(response);
      }
    });
  });
  // Fetch University Address Details On change Select University Dropdown //
  $("#studUniversityName").on("change", function(e) {

    e.preventDefault();
    let UniversityId = $(this).val();
    $.ajax({
      type: "post",
      url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
      data: {
        UniversityId: UniversityId,
        UniversityBtn: "ChangeOption",
      },
      success: function(response) {
        if (response != null) {
          $("#UniversityAddressResponse").html(response);
        }
      }
    });
  });
  //Fetch University Courses Details //
  $("#UniversityCourseSpecialization").on("change", function(e) {
    e.preventDefault();
    let UniversityCourseSpecName = $(this).val();
    var studUniversityName = $("#studUniversityName").val();
    var UniversitySessionId = $("#UniversityCourseSessionYears").val();
    var UniversityCourseId = $("#studUniversityCourseName").val();
    $.ajax({
      type: "post",
      url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
      data: {
        UniversityCourseSpecName: UniversityCourseSpecName,
        studUniversityName: studUniversityName,
        UniversitySessionId: UniversitySessionId,
        UniversityCourseId: UniversityCourseId,
        UniversityCourseBtn: "UniversityCourseChangeOption",
      },
      success: function(data) {
        if (data != null) {
          $("#UniversityCoursesDetails").html(data);
        }
      }
    });
  });
  // Fetch Discount Amount Details //
  $("#DiscountAmount").on("keyup", function(e) {
    e.preventDefault();
    let DiscountType = $("#DiscountType").val();
    let DscountAmount = $("#DiscountAmount").val();
    let UniversityCourseSpecId = $(this).find(":selected").data('id');
    $.ajax({
      type: "post",
      url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
      data: {
        DiscountType: DiscountType,
        DscountAmount: DscountAmount,
        UniversityCourseSpecId: UniversityCourseSpecId,
        DiscountBtn: "submit",
      },
      success: function(data) {
        if (data != null) {
          $("#AfterDiscountCoursePrice").html(data);
        }
      }
    });
  });
  //Show lead source Div Referred By
  const leadSources = () => {
    const leadSourceSelect = document.getElementById("leadSource");
    const selectedLeadSourceOption = leadSourceSelect.options[leadSourceSelect.selectedIndex].value;
    const referredByDiv = document.getElementById("referredBy");

    if (selectedLeadSourceOption === "Referred By") {
      referredByDiv.style.display = "block";
    } else {
      referredByDiv.style.cssText = "display: none !important;";
    }
  };

  // Fetch Bde Details //
  $("#selectBDEDetails").on("change", function(e) {
    e.preventDefault();
    let BdeId = $(this).val();
    $.ajax({
      type: "post",
      url: "<?= CONTROLLER; ?>/StudentAjaxController.php",
      data: {
        BdeId: BdeId,
        BdeIdBtn: "BdeIdChangeOption",
      },
      success: function(data) {
        if (data != null) {
          $("#BdeDetails").html(data);
        }
      }
    });
  });


  //Add Multiple Semester
  $(document).ready(function() {
    $(".add_semesters_name_btn").click(function(e) {
      e.preventDefault();
      $("#AddMoreSemesters").append(` <div class="row w-100 m-0" id="AddMoreSemesters">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Semester Name <?php echo $req; ?></label>
                              <select name="semester_wise_discount[]" class="form-control ">
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
                              <label>Discount Amount/Percentage <?php echo $req; ?></label>
                              <input type="number" name="semester_wise_discount_amount[]" class="form-control " placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger mt-3  remove_semesters_name_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>

                        </div>`);
    });
    $(document).on('click', '.remove_semesters_name_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
    });
    //Add Multiple Years
    $(".add_more_year_btn").click(function(e) {
      e.preventDefault();
      $("#AddMoreYear").append(` <div class="row w-100 m-0" id="AddMoreYear">
                          <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                              <label>Year Name <?php echo $req; ?></label>
                              <select name="year_wise_discount[]" class="form-control ">
                              <option value="">choose year</option>
                              <option value="1">First Years</option>
                                <option value="2">Second Years</option>
                                <option value="3">Third Years</option>
                                <option value="4">Fourth Years</option>
                                <option value="5">Fifth Years</option>
                              </select>
                            </div>
                            <div class="w-50" style="padding-left: 0.3125rem;">
                              <label>Discount Amount/Percentage <?php echo $req; ?></label>
                              <input type="number" name="year_wise_discount_amount[]" class="form-control " placeholder="10000">
                            </div>
                          </div>
                          <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-danger mt-3 remove_more_year_btn"><i class="bi bi-trash3-fill"></i></button>
                          </div>
                        </div>`);
    });
    $(document).on('click', '.remove_more_year_btn', function(e) {
      e.preventDefault();
      let row_item = $(this).parent().parent();
      $(row_item).remove();
    });
    // LIve Discount On Course Fees
    // $("#DiscountAmount").on("keyup", function(e) {
    //   e.preventDefault();
    //   let discountAmount = $(this).val();
    //   let discountMode = $("#discountMode").val();
    //   let DiscountType = $("#DiscountType").val();
    //   let studUniversityCourseName = $("#studUniversityCourseName").val();

    //   $.ajax({
    //     type: "POST",
    //     url: "<?= CONTROLLER ?>/StudentAjaxController.php",
    //     data: {
    //       discountAmount: discountAmount,
    //       discountMode: discountMode,
    //       studUniversityCourseName: studUniversityCourseName,
    //       DiscountType: DiscountType,
    //       keyUp: "Submit",
    //     },
    //     success: function(response) {
    //       $("#AfterDiscountCoursePrice").html(response);
    //     }
    //   });
    // })

  });
</script>