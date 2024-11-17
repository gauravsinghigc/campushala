<section class="pop-section hidden" id="view_course_<?= $value->course_id ?>">
  <div class="action-window ">
    <div class='container'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Course Details</h4>
        </div>
      </div>
      <?php $fetchCourseData = FETCH_DB_TABLE("SELECT * FROM courses WHERE 	course_id='$value->course_id'", true);
      if (isset($fetchCourseData)) {
        foreach ($fetchCourseData as $value) {
      ?>
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
                        <div class="col-md-6 form-group">
                          <h5 class="mb-3">
                            <span class="text-secondary small">Course Name</span><br>
                            <span class="bold"><?= $value->course_name ?></span>
                          </h5>
                        </div>
                        <div class='col-md-6 form-group'>
                          <h5 class="mb-3">
                            <span class="text-secondary small">Course Specialization</span><br>
                            <span class="bold"><?php $Specialization = explode(",", $value->course_specialization);
                                                $count = 1;
                                                foreach ($Specialization as $data) {
                                                  echo $count . "." . $data . "<br>";
                                                  $count++;
                                                } ?></span>
                          </h5>
                        </div>
                        <div class='col-md-6 form-group'>
                          <h5 class="mb-3">
                            <span class="text-secondary small">Course Type</span><br>
                            <span class="bold"><?= $value->course_type ?></span>
                          </h5>

                        </div>
                        <div class='col-md-6 form-group'>
                          <h5 class="mb-3">
                            <span class="text-secondary small">Course Session Year</span><br>
                            <span class="bold"><?= $value->course_session_year ?></span>
                          </h5>

                        </div>
                        <div class='col-md-6 form-group'>
                          <h5 class="mb-3">
                            <span class="text-secondary small">Total Semester</span><br>
                            <span class="bold"><?= $value->course_total_semester . " Semesters" ?></span>
                          </h5>

                        </div>
                        <div class='col-md-6 form-group'>
                          <h5 class="mb-3">
                            <span class="text-secondary small">Total Years</span><br>
                            <span class="bold"><?= $value->course_total_years . " Years" ?></span>
                          </h5>

                        </div>

                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="row justify-content-end">
                        <div class='col-md-5 form-group'>
                          <h5 class="mb-3">
                            <span class="text-secondary small">Fees Modes</span><br>
                            <span class="bold"><?= $value->fees_mode ?></span>
                          </h5>
                        </div>
                        <?php if ($value->fees_mode == "Semesters Wise") {
                        ?>
                          <div class='col-md-7 form-group'>
                            <div class="row">
                              <div class="col-md-10 form-group d-flex">
                                <div class="w-50">
                                  <h5 class="mb-3">
                                    <span class="text-secondary small">Semester Name</span><br>
                                    <span class="bold"><?php $SemesterName = explode(",", $value->fee_mode_semester_wise);
                                                        foreach ($SemesterName as $data) {
                                                          echo $data . " semester" . "<br>";
                                                        }  ?></span>
                                  </h5>

                                </div>
                                <div class="w-50" style="padding-left: 0.3125rem;">
                                  <h5 class="mb-3">
                                    <span class="text-secondary small">Semester Fee</span><br>
                                    <span class="bold"><?php $SemesterFee = explode(",", $value->semester_wise_fee);
                                                        foreach ($SemesterFee as $data) {
                                                          echo $data . '<i class="bi bi-currency-rupee"></i>' . '<br>';
                                                        }  ?></span>
                                  </h5>

                                </div>
                              </div>
                            </div>

                          </div>
                        <?php } elseif ($value->fees_mode == "Years Wise") {
                        ?>
                          <div class='col-md-7 form-group '>
                            <div class="row">
                              <div class="col-md-10 form-group d-flex">
                                <div class="w-50">
                                  <h5 class="mb-3">
                                    <span class="text-secondary small">Year Name</span><br>
                                    <span class="bold"><?php $YearName = explode(",", $value->fee_mode_year_wise);
                                                        foreach ($YearName as $data) {
                                                          echo $data . " year" . "<br>";
                                                        }  ?></span>
                                  </h5>

                                </div>
                                <div class="w-50" style="padding-left: 0.3125rem;">
                                  <h5 class="mb-3">
                                    <span class="text-secondary small">Year Fee</span><br>
                                    <span class="bold"><?php $YearFee = explode(",", $value->year_wise_fee);
                                                        foreach ($YearFee as $data) {
                                                          echo $data . '<i class="bi bi-currency-rupee"></i>' . '<br>';
                                                        }  ?></span>
                                  </h5>
                                </div>
                              </div>

                            </div>
                          </div>
                        <?php } else {
                        ?>
                          <div class='col-md-7 form-group '>
                            <div class="row">
                              <div class="col-md-12 form-group d-flex">
                                <div class="w-50">
                                  <h5 class="mb-3">
                                    <span class="text-secondary small">Total Year Fee</span><br>
                                    <span class="bold"><?= $value->fee_mode_one_time
                                                        ?></span>
                                  </h5>

                                </div>
                                <div class="w-50" style="padding-left: 0.3125rem;">
                                  <h5 class="mb-3">
                                    <span class="text-secondary small">One Time Fee</span><br>
                                    <span class="bold"><?= $value->one_time_fee
                                                        ?></span>
                                  </h5>

                                </div>
                              </div>

                            </div>
                          </div>
                        <?php }  ?>
                        <div class='col-md-7 form-group d-flex'>
                          <div class="w-100">
                            <h5 class="mb-3">
                              <span class="text-secondary small">Course Total Fees</span><br>
                              <span class="bold"><?= $value->course_total_fees . ' <i class="bi bi-currency-rupee"></i>'
                                                  ?></span>
                            </h5>

                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-12 d-flex justify-content-between btn">
                <a href="#" onclick="Databar('view_course_<?php echo $value->course_id ?>')" class="btn btn-sm btn-default cancel">Cancel</a>

              </div>
            </div>
          </div>
      <?php
        }
      } ?>
    </div>

  </div>
</section>