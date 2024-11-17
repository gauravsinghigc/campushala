
<?php
$Dir = "../";

//add controller helper files
require $Dir . '/require/modules.php';
//add aditional requirements
require $Dir . 'require/admin/access-control.php';
//========================>Ajax POst Request Start Here================================

// Search Student By Name (To Pay Fees)
if (isset($_POST['SearchKeyUpSubmit']) == "submit") {
    $output = "";
    if (!empty($_POST['SearchValue'])) {
        $SearchValue = mysqli_escape_string($DBConnection, $_POST['SearchValue']);
        $fetchStudentData = FETCH_DB_TABLE(
            "SELECT * FROM universities_primary_details AS upd
            INNER JOIN universities_session_years AS usy ON upd.university_id=usy.university_id
            INNER JOIN students_university_courses AS suc ON suc.univ_session_id=usy.univ_session_id
            INNER JOIN students_primary_details AS spd ON spd.student_id=suc.student_id
            INNER JOIN universities_courses AS uc ON uc.univ_course_id=suc.univ_courses_id
            INNER JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id
            INNER JOIN stud_fee_collects AS sfc ON sfc.student_id=spd.student_id INNER JOIN stud_fees_modes AS sfm ON sfc.stud_fee_mode_id= sfm.stud_fee_mode_id
            INNER JOIN students_university_course_discount_details AS sucdd ON sucdd.discount_id=sfc.discount_id WHERE student_full_name LIKE '%$SearchValue%'",
            true
        );
    }

    if (isset($_POST['studentId']) || isset($_POST['studentName'])) {
        $studentId = $_POST['studentId'];
        // $studentName = $_POST['studentName'];
        // AND spd.student_full_name LIKE '%$studentName%'
        $fetchStudentData = FETCH_DB_TABLE(
            "SELECT * FROM universities_primary_details AS upd
            INNER JOIN universities_session_years AS usy ON upd.university_id=usy.university_id
            INNER JOIN students_university_courses AS suc ON suc.univ_session_id=usy.univ_session_id
            INNER JOIN students_primary_details AS spd ON spd.student_id=suc.student_id
            INNER JOIN universities_courses AS uc ON uc.univ_course_id=suc.univ_courses_id INNER JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id
            INNER JOIN stud_fee_collects AS sfc ON sfc.student_id=spd.student_id INNER JOIN stud_fees_modes AS sfm ON sfc.stud_fee_mode_id= sfm.stud_fee_mode_id
            INNER JOIN students_university_course_discount_details AS sucdd ON sucdd.discount_id=sfc.discount_id
             WHERE spd.student_id LIKE '%$studentId%'",
            true
        );
    }
    if (isset($fetchStudentData)) {
        foreach ($fetchStudentData as $value) {

            $output = '
        <li>
            <div style="margin-top:10px;">
                <h5 class="bold mb-0" style="padding-bottom:2px;"> <span class=""><i class="fa-solid fa-user user-icon-col  fs-17"></i> </span> ' . $value->student_full_name . '</h5>
                 <p class="mb-1" style="padding-bottom:3px;">
                    <span><i class="fa-solid fa-building-columns university-icon-col fs-17"></i> </span><span class="fs-14" style="font-weight: 600;">' . $value->university_name . '</span>
                </p>

                <p class="flex-s-b  fees-course-details">
                 <span class="text-secondary session-icon-css "><span>
                <i class="fa-solid fa-hourglass-half fs-15"></i></span>
                <span class="session-text">' . $value->univ_session_name . '</span></span>
                <span class="graduation-icon-css"><i class="fa-solid fa-graduation-cap"></i> <span>' . $value->univ_course_name . ' </span></span>
                <span class="specilization-icon-css"><span><i class="fa-solid fa-book-open-reader fs-15"></i> </span> ' . $value->univ_course_specialization_name . '</span>
                <span class="duration-icon-css"><span><i class="fa-solid fa-clock"></i> </span> ' . $value->univ_course_total_year . "year" . '</span>
                  </p>
                  <p class="fees-course-details mt-1 ">
                  <span class="flex-s-b  mb-2 ">
                  <span class="course-fees active course-fee-detail" data-speciid="' . $value->univ_course_specialization_fee_id . '" data-sessionid="' . $value->univ_session_id . '" data-university_id="' . $value->university_id . '">Course Fee <i class="fa fa-eye" aria-hidden="true"></i></span>
                  <span class="course-fees tutition-fee-detail "  data-speciid="' . $value->univ_course_specialization_fee_id . '" data-sessionid="' . $value->univ_session_id . '" data-university_id="' . $value->university_id . '">Tutition Fee <i class="fa fa-eye" aria-hidden="true"></i></span>
                  </span>';
            $output .= '<span class="flex-s-b" id="feeDetails">
            </span>
            </pre>
                <hr>

                <p>
                <span class="flex-s-b align-items-sm-center">';
            if ($value->fee_mode_status == "Pending") {
                $FeeMode = "N/A";
                $FeeModeName = "";
                $output .= '<span class="text-secondary"><b>Add Fees Mode:-</b></span>
                <span><button type="button" class="btn btn-sm btn-outline-danger" id="AddFeesMode" data-studFeeCollectId="' . $value->stud_fee_collect_id . '" data-studFeeModesId="' . $value->stud_fee_mode_id . '"  style="padding: 0.2rem 0.9rem !important;">Add</button></span>';
            } else {
                $FeeMode = $value->fee_mode;
                if ($FeeMode == "Semesters Wise") {
                    $SemesterName = "Semester";
                } elseif ($FeeMode == "Years Wise") {
                    $SemesterName = "Years"; // Corrected the assignment operator here
                } else {
                    $SemesterName = "One Time";
                }

                $output .= '<span><b>Fees Mode:-</b><span class="text-secondary"> ' .   $SemesterName . '</span></span>';
                $output .= '<span><button type="button" class="btn btn-sm btn-outline-info" id="showSemesterList" data-studFeeCollectId="' . $value->stud_fee_collect_id . '" data-studFeeModesId="' . $value->stud_fee_mode_id . '" data-specilizationFeesId="' . $value->specilization_fee_id . '" data-studId="' . $value->student_id . '" data-universityId="' . $value->university_id . '" data-sessionId="' . $value->session_id . '" data-courseId="' . $value->course_id . '"  data-specilizationId="' . $value->specilization_id . '" data-specilizationFeeId="' . $value->specilization_fee_id . '" data-discountId="' . $value->discount_id . '"  style="padding: 0.2rem 0.9rem !important;">List Active ' . $SemesterName . '</button></span>';
            }

            $output .=
                '</span> </p>
                 <hr>
                 <p>
                 <span class="flex-s-b align-items-sm-center">';
            if ($value->fee_mode_status == "Pending") {
                $FeeMode = "N/A";
                $FeeModeName = "";
                $output .= '<span class="text-secondary"><b>Add Discount Mode:-</b></span>
                <span><button disabled type="button" class="btn btn-sm btn-outline-danger " style="padding: 0.2rem 0.9rem !important;">Add</button></span>';
            } elseif ($value->fee_mode_status == "Done" && $value->discount_status == "Pending") {
                $output .= '<span class="text-secondary"><b>Add Discount Mode:-</b></span>
                <span><button type="button" class="btn btn-sm btn-outline-danger"  id="addDiscount" style="padding: 0.2rem 0.9rem !important;" data-discountId="' . $value->discount_id . '" data-feeModeId="' . $value->stud_fee_mode_id . '">Add</button></span>';
            } elseif ($value->fee_mode_status == "Done" && $value->discount_status = "Done") {
                $output .= '
                <span><b>Discount Type</b><br><span class="text-secondary"> ' .  $value->discount_type . '</span></span>
                 <span><b>Discount Mode</b><br><span class="text-secondary"> ' .  $value->discount_mode . '</span></span>';
            } else {
                $FeeMode = $value->fee_mode;
                $FeeModeName = $value->fee_mode_name;
                $output .= '<span class="text-secondary">' . $FeeMode . '</span><br>
                        <span>' . $FeeModeName . '</span>';
            }

            $output .= '</span>
                </p>
            </div>
        </li>';
        }
    } else {
        $output = '
        <li>
            <div class="text-center">
                   <span >
                       <span class="text-secondary "><i class="bi bi-exclamation-circle text-danger " style="font-size: 2.3125rem;"></i></span>
                        <span class="text-secondary "><h5>No Record Found</h5></span>
                    </span>
            </div>
        </li>';
    }
    echo $output;
}
// Show Fees Mode (For Student Pay Fees According To (Semester/Years/One Time) In Future)
if (isset($_POST['addFeesMode'])) {

    $output = "";
    $output .= '<h5 class="card-title courses-title">
                 Add Fees Mode</h5>
            <form>
             <input type="hidden" id="studFeesCollectId" value="' . $_POST['studFeeCollectId'] . '">
              <input type="hidden" id="studFeesModesId" value="' . $_POST['studFeeModesId'] . '">

             <div class="form-group">
                    <label>Semester</label>
                    <select class="form-control" id="feeModeId" reqired>
                    <option value="">choose fee mode</option>
                        <option value="Semesters Wise">Semesters Wise</option>
                        <option value="Years Wise">Years Wise</option>
                        <option value="One Time">One Time</option>
                        </select>
                </div>
                <div class="text-center">
                    <button class="btn btn-sm btn-primary" id="saveFeesMode">Save</button>
                </div>
            </form>';
    echo $output;
}
// Save Fees Mode(In (Semester/Years/One Time) )
if (isset($_POST['saveFeesMode'])) {
    $Update = true;
    //Update Fees Mode Table BY Id
    $Update = UPDATE("UPDATE stud_fees_modes SET fee_mode='" . $_POST['feeModeId'] . "',fee_mode_status='Done' WHERE stud_fee_mode_id='" . $_POST['studFeesModesId'] . "'");
    $Update = UPDATE("UPDATE stud_fee_collects SET fee_mode='" . $_POST['feeModeId'] . "' WHERE stud_fee_collect_id='" . $_POST['studFeesCollectId'] . "'");
    if ($Update == "true") {
        echo '<h5 class="card-title courses-title">
    Add Discount Mode</h5>

        <ul class="record-list">
            <li>
                <div>
                    <p class="mb-3 text-center">
                       <img src="' . STORAGE_URL . '/account-image/discount.png" class="">
                    </p>
                    <p class="mb-0 text-center">
                      <span class="text-danger">Now Add Discount Mode</span>
                    </p>
                </div>
            </li>
        </ul>';
    }
}
// Add Discount According to Fees Mode (Semester/Years/One Time)
if (isset($_POST['addDiscount'])) {
    $FeeModeType = FETCH("SELECT * FROM stud_fees_modes WHERE stud_fee_mode_id='" . $_POST['studFeeModeId'] . "'", "fee_mode");
    if ($FeeModeType == "Semesters Wise") {
        $SemesterDisabled = "";
        $YearDisabled = "disabled";
        $OneTime = "disabled";
    } elseif ($FeeModeType == "Years Wise") {
        $SemesterDisabled = "disabled";
        $YearDisabled = "";
        $OneTime = "disabled";
    } elseif ($FeeModeType == "One Time") {
        $SemesterDisabled = "disabled";
        $YearDisabled = "disabled";
        $OneTime = "";
    } else {
        $SemesterDisabled = "";
        $YearDisabled = "";
        $OneTime = "";
    }
    $output = "";
    $output .= '<h5 class="card-title courses-title">
                 Add Discount</h5>
    <form id="discountForm">
    <input type="hidden" id="StudDiscountId" name="studDiscountId" value="' . $_POST['studDiscountId'] . '">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Discount Type</label>
                    <select name="discount_type" class="form-control" id="discountMode" onchange="showFeesModesField()" required>
                        <option value="">choose discount type</option>
                        <option value="Semester Wise Discount" ' . $SemesterDisabled . '>Semester Wise Discount</option>
                        <option value="Year Wise Discount" ' . $YearDisabled . '>Year Wise Discount</option>
                        <option value="On Total Fee Discount" ' . $OneTime . '>On Total Fee Discount</option>
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Discount Mode</label>
                    <select name="discount_mode" class="form-control" id="DiscountType">
                        <option value="">choose discount mode</option>
                        <option value="Amount">Amount</option>
                        <option value="Percentage">Percentage</option>
                    </select>

                </div>
                <div class="col-md-12 form-group">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <div class="p-2 mt-3 shadow-sm" id="AfterDiscountCoursePrice">
                            </div>
                        </div>
                    </div>
                </div>

            <div class="col-md-12 form-group ">
                <button type="submit" class="btn btn-sm btn-success" id="SaveDiscountData">Save Discount Amount</button>
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12 form-group" id="SemestersFee" style="display: none !important;">
                    <div class="row" id="AddMoreSemesters">
                        <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                                <label>Semester Name <?php echo $req; ?></label>
                                <select name="semester_wise_discount[]" class="form-control ">
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
                                <label>Discount Amount <?php echo $req; ?></label>
                                <input type="number" name="semester_wise_discount_amount[]" class="form-control " placeholder="10000">
                            </div>
                        </div>
                        <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-info mt-3  add_semesters_name_btn"><i class="bi bi-plus"></i></button>
                        </div>

                    </div>

                </div>
                <div class="col-md-12 form-group " id="YearsFee" style="display: none !important;">
                    <div class="row" id="AddMoreYear">
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
                                <label>Discount Amount <?php echo $req; ?></label>
                                <input type="number" name="year_wise_discount_amount[]" class="form-control " placeholder="10000">

                            </div>
                        </div>
                        <div class="col-md-2 form-group ">
                            <label></label>
                            <button class="btn btn-outline-info mt-3  add_more_year_btn"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 form-group " id="OneTimeFee" style="display: none !important;">
                    <div class="row">
                        <div class="col-md-12 form-group d-flex">
                            <div class="w-50">
                                <label>Total Year Fee<?php echo $req; ?></label>
                                <select name="onetime_wise_discount[]" class="form-control ">
                                    <option value="">Choose Total Year Fee</option>
                                    <option value="One Time">One Time</option>
                                </select>
                            </div>
                            <div class="w-50" style="padding-left: 0.3125rem;">
                                <label>Discount Amount/Percentage<?php echo $req; ?></label>
                                <input type="number" name="onetime_wise_discount_amount[]" class="form-control " placeholder="10000">
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
    </form>';
    echo $output;
}
// Save Discount By Fees Mode (Sem/Year/OneTime)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $json_data = file_get_contents('php://input');

    // Decode the JSON data into an associative array
    $formData = json_decode($json_data, true);
    if (isset($formData['saveDiscountAmount'])) {
        if ($formData['DiscountType'] == "Semester Wise Discount") {
            $discount_type_names = implode(",", $formData['SemesterWiseName']);
            $discount_type_fees = implode(",", $formData['SemesterWiseAmount']);
        } elseif ($formData['DiscountType'] == "Year Wise Discount") {
            $discount_type_names = implode(",", $formData['YearWiseName']);
            $discount_type_fees = implode(",", $formData['YearWiseAmount']);
        } else {
            $discount_type_names = implode(",", $formData['OneTimeName']);
            $discount_type_fees = implode(",", $formData['OneTimeAmount']);
        }

        $UpdateDiscountData = [
            "discount_type" => $formData['DiscountType'],
            "discount_mode" => $formData['DiscountMode'],
            "discount_type_names" => $discount_type_names,
            "discount_type_fees" => $discount_type_fees,
            "discount_status" => "Done",
        ];
        $Update = UPDATE_DATA_WITHOUT_RESPONSE("students_university_course_discount_details", $UpdateDiscountData, "discount_id='" . $formData['studDiscountId'] . "'");
        if ($Update == "true") {
            $response = array(
                'status' => 'Success',
                'message' => 'Data saved successfully',
            );

            $json_response = json_encode($response);

            echo $json_response;
        }
    }
}
// Show list Of Fees Mode By Name sem/year/one time
if (isset($_POST['listFeesModeName'])) {
    //Fetch Fees Mode Type
    $FeeModeType = FETCH("SELECT fee_mode FROM 	stud_fees_modes WHERE stud_fee_mode_id='" . $_POST['studFeeModesId'] . "'", "fee_mode");
    if ($FeeModeType == "Semesters Wise") {
        $SemesterName = "Semester";
    } elseif ($FeeModeType == "Years Wise") {
        $SemesterName = "Year";
    } else {
        $SemesterName = "One Time";
    }

    //Fetch Specilization fees
    $specilizationFees = FETCH_DB_TABLE(
        "SELECT * FROM universities_courses_specializations_fees  WHERE
        university_specialization_id='" . $_POST['specilizationFeesId'] . "' AND univ_course_spec_fee_mode_type='$FeeModeType'",
        true
    );
    if (isset($specilizationFees)) {
        $output = "";
        $output .= '<h5 class="card-title courses-title">
                       Active Courses/Semester</h5>';

        foreach ($specilizationFees as $value) {
            $FeesMode = $value->univ_course_spec_fee_mode_type;
            $FeeModeName = explode(",", $value->univ_course_spec_fee_name);
            $FeesModeNameFees = explode(",", $value->univ_course_spec_fee_value);
            $FeeModeYearSemName = explode(",", $value->univ_course_spec_fee_sem_name);
            $FeesModeYearValueFees = explode(",", $value->univ_course_spec_fee_sem_value);
            $TotalSemesterCount = count(explode(",", $value->univ_course_spec_fee_sem_name));
        }


        foreach ($FeeModeName as $key => $val) {
            $PostName = "";
            foreach (NumberPostWords() as $NuKeys => $data) {
                if ($NuKeys == $val) {
                    $PostName = $data;
                }
            }
            $TotalPaidFees = FETCH_DB_TABLE("SELECT * FROM stud_fee_collects WHERE student_id='" . $_POST['studId'] . "' AND  university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "'  AND course_id='" . $_POST['courseId'] . "'  AND specilization_id='" . $_POST['specilizationId'] . "'  AND specilization_fee_id='" . $_POST['specilizationFeeId'] . "'  AND fee_mode_name='$val'", true);
            // Initialize $TotalPaidFee to 0 for each semester
            $feeCollectId = "";
            $TotalPaidFee = 0;
            $TotalDiscount = 0;
            $TotalOutstandingAmount = 0;
            if (isset($TotalPaidFees)) {
                foreach ($TotalPaidFees as $feeData) {
                    $feeCollectId = $feeData->stud_fee_collect_id;

                    if ($feeData->fee_mode_name == $val) {
                        $TotalPaidFee += intval($feeData->paid_amount) + intval($feeData->discount_amount);
                        $TotalDiscount += intval($feeData->discount_amount);
                        if ($TotalPaidFee == $FeesModeNameFees[$key]) {
                            $TotalOutstandingAmount = 0;
                        } else {
                            $TotalOutstandingAmount = $FeesModeNameFees[$key] - $TotalPaidFee;
                        }
                    }
                }
            } else {
                $feeCollectId = $_POST['studFeeCollectId'];
                $TotalOutstandingAmount = $FeesModeNameFees[$key];
            }

            $output .= '
                <ul class="record-list fees-list ">
                    <li>
                        <div>
                            <p class="flex-s-b mb-0">
                                <span class="mb-2">
                                    <span class="text-secondary">' . $SemesterName . ':-</span> <span>' . $val . "" . $PostName . ' <span class="text-info sem-details sem-details-icon" ><i class="fa-solid fa-eye"></i></span></span>
                                </span>
                                 <span class="mb-2">
                                    <span class="text-secondary"><img class="shadow-none" src="' . STORAGE_URL . '/account-image/tag_1017425 (1).png" style="width:20px; height:20px;"></span> <span >' . $TotalDiscount . '/Rs</span>
                                </span>
                            </p>

                            <p class="mb-0 flex-s-b">
                                <span><i class="bi bi-inr"></i><b class="text-secondary" >Total Fee</b><br> Rs.' . $FeesModeNameFees[$key] . '</span><br>
                                 <span><i class="bi bi-inr"></i><b class="text-secondary">Paid Fee</b><span class="text-green"><br> Rs.' . $TotalPaidFee . '</span></span>
                                 <span>
                                 ';
            if ($TotalOutstandingAmount == 0) {
                $output .= '<i class="bi bi-inr"></i></span>
                        <span class="text-success fs-18"><i class="bi bi-check2-circle"></i> Paid</span>
                    ';
            } else {
                $output .= '<i class="bi bi-inr"></i><b class="text-secondary">Due Fee</b><span class="text-danger total-outstanding-amount" data-outstandingamount="' . $TotalOutstandingAmount . '"><br> Rs.' . $TotalOutstandingAmount . '</span></span>
                <span class="text-success"><button type="button" class="btn btn-sm  btn-outline-success pay-button" id="payFees"
                data-studFeeCollectId="' . $feeCollectId . '" data-studFeeModesId="' . $_POST['studFeeModesId'] . '" data-specilizationFeesId="' . $_POST['specilizationFeesId'] . '" data-studId="' . $_POST['studId'] . '" data-universityId="' . $_POST['studUniversityId'] .  '" data-sessionId="' . $_POST['sessionId'] . '" data-courseId="' . $_POST['courseId'] . '"  data-specilizationId="' . $_POST['specilizationId'] . '" data-specilizationFeeId="' . $_POST['specilizationFeeId'] .  '" data-discountId="' . $_POST['discountId'] . '" data-semesterName="' . $val . '" data-dueAmount="' . $_POST['specilizationFeeId'] . '" data-outstandingAmount="' . $TotalOutstandingAmount . '" data-totalFees="' . $FeesModeNameFees[$key] . '" data-alreadyFeePaid="' . $TotalPaidFee . '" data-totalDiscount="' . $TotalDiscount . '">Pay</button></span>';
            }

            if ($FeeModeType == "Years Wise") {
                //Show semester details
                $output .= '<div class="semester-details-div" style="display:none;"><hr>
             <h6>Semester Details:=></h6>';
                $semName = "Sem";
                if ($val == "1") {
                    $semsterCheck = firstYearSem();
                } elseif ($val == "2") {
                    $semsterCheck = secondYearSem();
                } elseif ($val == "3") {
                    $semsterCheck = thirdYearSem();
                } elseif ($val == "4") {
                    $semsterCheck = fourYearSem();
                } elseif ($val == "5") {
                    $semsterCheck = fiveYearSem();
                }
                $SemTotalFees = 0;
                $SemTotalPaidAmount = 0;
                $SemTotalDiscount = 0;
                foreach ($semsterCheck as $yearSemKey => $yearSemValue) {
                    foreach (NumberPostWords() as $NuPostKeys => $postData) {
                        if ($NuPostKeys == $yearSemKey) {
                            $SemPostName = $postData;
                        }
                    }
                    foreach ($FeeModeYearSemName as $feeSemNameKey => $FeeSemName) {
                        if ($yearSemKey == $FeeSemName) {

                            $fetchSemesterWiseDetails = FETCH_DB_TABLE("SELECT * FROM stud_fee_collects WHERE student_id='" . $_POST['studId'] . "' AND  university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "'  AND course_id='" . $_POST['courseId'] . "'  AND specilization_id='" . $_POST['specilizationId'] . "'  AND specilization_fee_id='" . $_POST['specilizationFeeId'] . "'  AND 	fee_mode_sem_name='$yearSemKey'", true);
                            if (isset($fetchSemesterWiseDetails)) {
                                $SemTotalFees = 0;
                                $SemTotalPaidAmount = 0;
                                $SemTotalDiscount = 0;
                                foreach ($fetchSemesterWiseDetails as $semesterKeyDetails => $details) {
                                    $SemTotalFees = $details->fee_mode_sem_name_value;
                                    $SemTotalPaidAmount += $details->paid_amount;
                                    $SemTotalDiscount += $details->discount_amount;
                                }
                            } else {
                                $SemTotalFees = 0;
                                $SemTotalPaidAmount = 0;
                                $SemTotalDiscount = 0;
                            }
                            //Total Out Standing Amount
                            $TotalSemesterOutstandingAmount = intval($FeesModeYearValueFees[$feeSemNameKey]) - ($SemTotalPaidAmount + $SemTotalDiscount);
                        }
                    }
                    $output .= '<div class="card mt-2 shadow p-2 bg-white rounded" style="background-color: #f7f7ef !important">
                          <p class="flex-s-b mb-0">
                                <span class="mb-2">
                                    <span class="text-secondary">' . $semName . ':-</span> <span>' . $yearSemKey  . "" . $SemPostName . ' </span>
                                </span>
                                 <span class="mb-2">
                                    <span class="text-secondary"><img class="shadow-none" src="' . STORAGE_URL . '/account-image/tag_1017425 (1).png" style="width:20px; height:20px;"></span> <span >' . $SemTotalDiscount .
                        '/Rs</span>
                                </span>
                            </p>
                             <p class="mb-0 flex-s-b">
                                <span><i class="bi bi-inr"></i><b class="text-secondary" >Total Fee</b><br> Rs.' . $FeesModeYearValueFees[$feeSemNameKey] . '</span><br>
                                 <span><i class="bi bi-inr"></i><b class="text-secondary">Paid Fee</b><span class="text-green"><br> Rs.' . $SemTotalPaidAmount + $SemTotalDiscount . '</span></span>
                                 <span>
                                 ';
                    if ($TotalSemesterOutstandingAmount == 0) {
                        $output .= '<i class="bi bi-inr"></i></span>
                        <span class="text-success fs-18"><i class="bi bi-check2-circle"></i> Paid</span>
                    ';
                    } else {
                        $output .= '<i class="bi bi-inr"></i></span>
                        <span class="text-warning fs-18"><i class="fa-solid fa-clock"></i> Pending</span>
                    ';
                    }
                    $output .= '  </div>';
                }
            } elseif ($FeeModeType == "One Time") {
                //Show semester details
                $output .= '<div class="semester-details-div" style="display:none;"><hr>
             <h6>Semester Details:=></h6>';
                $semName = "Sem";
                if ($TotalSemesterCount == "2") {
                    $semsterCheck = oneTimeFirstYearTotalSem();
                } elseif ($TotalSemesterCount == "4") {
                    $semsterCheck = oneTimeSecondYearTotalSem();
                } elseif ($TotalSemesterCount == "6") {
                    $semsterCheck = oneTimeThirdYearTotalSem();
                } elseif ($TotalSemesterCount == "8") {
                    $semsterCheck = oneTimeFourYearTotalSem();
                } elseif ($TotalSemesterCount == "10") {
                    $semsterCheck = oneTimeFiveYearTotalSem();
                }
                $SemTotalFees = 0;
                $SemTotalPaidAmount = 0;
                $SemTotalDiscount = 0;
                foreach ($semsterCheck as $yearSemKey => $yearSemValue) {
                    foreach (NumberPostWords() as $NuPostKeys => $postData) {
                        if ($NuPostKeys == $yearSemKey) {
                            $SemPostName = $postData;
                        }
                    }
                    foreach ($FeeModeYearSemName as $feeSemNameKey => $FeeSemName) {
                        if ($yearSemKey == $FeeSemName) {

                            $fetchSemesterWiseDetails = FETCH_DB_TABLE("SELECT * FROM stud_fee_collects WHERE student_id='" . $_POST['studId'] . "' AND  university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "'  AND course_id='" . $_POST['courseId'] . "'  AND specilization_id='" . $_POST['specilizationId'] . "'  AND specilization_fee_id='" . $_POST['specilizationFeeId'] . "'  AND 	fee_mode_sem_name='$yearSemKey'", true);
                            if (isset($fetchSemesterWiseDetails)) {
                                $SemTotalFees = 0;
                                $SemTotalPaidAmount = 0;
                                $SemTotalDiscount = 0;
                                foreach ($fetchSemesterWiseDetails as $semesterKeyDetails => $details) {
                                    $SemTotalFees = $details->fee_mode_sem_name_value;
                                    $SemTotalPaidAmount += $details->paid_amount;
                                    $SemTotalDiscount += $details->discount_amount;
                                }
                            } else {
                                $SemTotalFees = 0;
                                $SemTotalPaidAmount = 0;
                                $SemTotalDiscount = 0;
                            }
                            //Total Out Standing Amount
                            $TotalSemesterOutstandingAmount = $FeesModeYearValueFees[$feeSemNameKey] - ($SemTotalPaidAmount + $SemTotalDiscount);
                        }
                    }
                    $output .= '<div class="card mt-2 shadow p-2 bg-white rounded" style="background-color: #f7f7ef !important">
                          <p class="flex-s-b mb-0">
                                <span class="mb-2">
                                    <span class="text-secondary">' . $semName . ':-</span> <span>' . $yearSemKey  . "" . $SemPostName . ' </span>
                                </span>
                                 <span class="mb-2">
                                    <span class="text-secondary"><img class="shadow-none" src="' . STORAGE_URL . '/account-image/tag_1017425 (1).png" style="width:20px; height:20px;"></span> <span >' . $SemTotalDiscount .
                        '/Rs</span>
                                </span>
                            </p>
                             <p class="mb-0 flex-s-b">
                                <span><i class="bi bi-inr"></i><b class="text-secondary" >Total Fee</b><br> Rs.' . $FeesModeYearValueFees[$feeSemNameKey] . '</span><br>
                                 <span><i class="bi bi-inr"></i><b class="text-secondary">Paid Fee</b><span class="text-green"><br> Rs.' . $SemTotalPaidAmount + $SemTotalDiscount . '</span></span>
                                 <span>
                                 ';
                    if ($TotalSemesterOutstandingAmount == 0) {
                        $output .= '<i class="bi bi-inr"></i></span>
                        <span class="text-success fs-18"><i class="bi bi-check2-circle"></i> Paid</span>
                    ';
                    } else {
                        $output .= '<i class="bi bi-inr"></i></span>
                        <span class="text-warning fs-18"><i class="fa-solid fa-clock"></i> Pending</span>
                    ';
                    }
                    $output .= '  </div>';
                }
            }



            $output .= '
            </div>  </p>
                        </div>
                    </li>

                </ul>';
        }
        echo $output;
    }
}
//Here User/Student Can Choose Sem/Year Wise Pay Fees
if (isset($_POST['payFees'])) {
    $fetchDiscount = FETCH_DB_TABLE("SELECT * FROM students_university_course_discount_details WHERE discount_id='" . $_POST['discountId'] . "'", true);
    if (isset($fetchDiscount)) {
        foreach ($fetchDiscount as $value) {
            $DiscountName = explode(",", $value->discount_type_names);
            $DiscountFees = explode(",", $value->discount_type_fees);
        }

        // Check if $_POST['samesterName'] exists in the $DiscountName array
        if (in_array($_POST['samesterName'], $DiscountName)) {
            $semesterName = $_POST['samesterName'];
        } else {
            $semesterName = $_POST['samesterName'];
        }
    } else {
        $DiscountName = "";
        $DiscountFees = "";
    }
    $DiscountValue = ""; // Initialize $DiscountValue before the loop
    foreach ($DiscountName as $key => $DisCount) {
        if ($DisCount == $semesterName) {
            if ($semesterName == "One Time") {
                $semesterName = 1;
                $DiscountValue = $DiscountFees[$key];
                if ($DiscountValue >= $_POST['totalDiscount']) {

                    $LeftDiscountBalance = $DiscountValue - $_POST['totalDiscount'];
                } else {

                    $LeftDiscountBalance = 0;
                }
                break; // Exit loop once the value is found
            } else {

                $DiscountValue = $DiscountFees[$key];
                if ($DiscountValue >= $_POST['totalDiscount']) {

                    $LeftDiscountBalance = $DiscountValue - $_POST['totalDiscount'];
                } else {
                    $LeftDiscountBalance = 0;
                }
                break; // Exit loop once the value is found
            }
        } else {
            $LeftDiscountBalance = 0;
        }
    }
    $fetchFeesMode = FETCH("SELECT fee_mode FROM stud_fees_modes WHERE stud_fee_mode_id='" . $_POST['studFeeModesId'] . "'", "fee_mode");
    if ($fetchFeesMode == "Semesters Wise") {
        $SemYearLable = "Semester";
    } elseif ($fetchFeesMode == "Years Wise") {
        $SemYearLable = "Year";
    } elseif ($fetchFeesMode == "One Time") {
        $SemYearLable = "One Time";
    }
    $fetchCourseFees = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees  WHERE university_specialization_id='" . $_POST['specilizationFeeId'] . "' AND 	univ_course_spec_fee_mode_type='$fetchFeesMode'", true);
    if (isset($fetchCourseFees)) {
        foreach ($fetchCourseFees as $courseFees) {
            $specSubSemName = explode(",", $courseFees->univ_course_spec_fee_sem_name);
            $specSubSemFees = explode(",", $courseFees->univ_course_spec_fee_sem_value);

            // Re-index the $specSubSemName array starting from 1
            $specSubSemName = array_values($specSubSemName);
            $reindexedSpecSubSemName = array();
            foreach ($specSubSemName as $key => $semNameval) {
                $reindexedSpecSubSemName[$key + 1] = $semNameval;
            }

            // Re-index the $specSubSemFees array starting from 1
            $specSubSemFees = array_values($specSubSemFees);
            $reindexedSpecSubSemFees = array();
            foreach ($specSubSemFees as $key => $semFeeval) {
                $reindexedSpecSubSemFees[$key + 1] = $semFeeval;
            }

            // $reindexedSpecSubSemName and $reindexedSpecSubSemFees now have keys starting from 1
        }
    } else {
        $specSubSemName = "";
        $specSubSemFees = "";
    }

    $output = "";
    $output .= ' <form class="p-2" id="collectStudFeesForm">
                   <input type="hidden" name="FeesModeId" value="' . $_POST['studFeeModesId'] . '">
                   <input type="hidden" name="totalAmount" value="' . $_POST['totalAmount'] . '">
                   <input type="hidden" name="FeeCollectId" value="' . $_POST['studFeeCollectId'] . '">
                   <input type="hidden" name="StudentId" value="' . $_POST['studId'] . '">
                   <input type="hidden" name="UniversityId" value="' . $_POST['studUniversityId'] . '">
                   <input type="hidden" name="SessionId" value="' . $_POST['sessionId'] . '">
                   <input type="hidden" name="CourseId" value="' . $_POST['courseId'] . '">
                   <input type="hidden" name="SpecilizationId" value="' . $_POST['specilizationId'] . '">
                   <input type="hidden" name="SpecilizationFeesId" value="' . $_POST['specilizationFeeId'] . '">
                   <input type="hidden" name="DiscountId" value="' . $_POST['discountId'] . '">
                   <input type="hidden" name="SemesterName" value="' . $_POST['samesterName'] . '">
                   <input type="hidden" name="alreadyFeePaid" value="' . $_POST['alreadyFeePaid'] . '">
                   <input type="hidden" name="totalDiscount" value="' . $_POST['totalDiscount'] . '">

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>' . $SemYearLable . '</label>
                            <input type="text" name="feesModeName" class="form-control" value="' . $semesterName . "st" . '" required>
                        </div>';
    if ($fetchFeesMode == "Years Wise" || $fetchFeesMode == "One Time") {
        $output .= '<div class="col-sm-12 col-md-12 form-group form-check ">
                        <input type="checkbox" class="form-check-input" name="semesterWiseFeesBoxChecked" value="semesterWiseFeesBoxChecked" id="discountCheckBox2" style="margin-left: -0.7rem;" >
                        <label class="form-check-label text-info fs-12" for="discountCheckBox2" style="margin-left: 0.5rem;">Pay Fee Semester Wise <span class="text-danger">(Click Pen Icon to Edit Fees)</span></label>
                        </div>

                        <div class="col-md-4 fee-payment-semester-wise" style="display:none;">
                        <label class="text-info">Semsters</label>
                        <select name="subSemesterName" class="form-control year-sem-wise"  required>
                        <option>Semster List</option>';
        if ($fetchFeesMode == "Years Wise") {
            if ($semesterName == '1') {
                $TotalAmount = 0;
                $TotalDiscountAmount = 0;
                foreach (firstYearSem() as $semKey => $semType) {
                    $TotalAmount = 0;
                    $TotalDiscountAmount = 0;
                    $fetchYearSemTotalPaidFees = FETCH_DB_TABLE("SELECT paid_amount,discount_amount FROM stud_fee_collects WHERE fee_mode_sem_name='$semKey' AND fee_mode='Years Wise' AND student_id='" . $_POST['studId'] . "' AND university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "' AND course_id='" . $_POST['courseId'] . "'", true);
                    if (isset($fetchYearSemTotalPaidFees)) {
                        foreach ($fetchYearSemTotalPaidFees as $semTotalPaidFees) {
                            $TotalAmount  += intval($semTotalPaidFees->paid_amount);
                            $TotalDiscountAmount += intval($semTotalPaidFees->discount_amount);
                        }
                    } else {
                        $TotalAmount = 0;
                    }
                    foreach (NumberPostWords() as $NuKey => $NuData) {

                        if ($semKey == $NuKey) {
                            $output .= '<option value="' . $NuKey . '" data-subsemtype="' . $reindexedSpecSubSemFees[$semKey] . '" data-totalAmount="' . $TotalAmount + $TotalDiscountAmount . '">' . $NuKey . "" . $NuData . " " . $semType . '</option>';
                        }
                    }
                }
            } elseif ($semesterName == '2') {
                $TotalAmount = 0;
                $TotalDiscountAmount = 0;
                foreach (secondYearSem() as $semKey => $semType) {
                    $TotalAmount = 0;
                    $TotalDiscountAmount = 0;
                    $fetchYearSemTotalPaidFees = FETCH_DB_TABLE("SELECT paid_amount,discount_amount FROM stud_fee_collects WHERE fee_mode_sem_name='$semKey' AND fee_mode='Years Wise' AND student_id='" . $_POST['studId'] . "' AND university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "' AND course_id='" . $_POST['courseId'] . "'", true);
                    if (isset($fetchYearSemTotalPaidFees)) {

                        foreach ($fetchYearSemTotalPaidFees as $semTotalPaidFees) {
                            $TotalAmount  += intval($semTotalPaidFees->paid_amount);
                            $TotalDiscountAmount += intval($semTotalPaidFees->discount_amount);
                        }
                    } else {
                        $TotalAmount = 0;
                    }
                    foreach (NumberPostWords() as $NuKey => $NuData) {
                        if ($semKey == $NuKey) {
                            $output .= '<option value="' . $NuKey . '" data-subsemtype="' . $reindexedSpecSubSemFees[$semKey] . '" data-totalAmount="' . $TotalAmount + $TotalDiscountAmount . '">' . $NuKey . "" . $NuData . " " . $semType . '</option>';
                        }
                    }
                }
            } elseif ($semesterName == '3') {
                $TotalAmount = 0;
                $TotalDiscountAmount = 0;
                foreach (thirdYearSem() as $semKey => $semType) {
                    $TotalAmount = 0;
                    $TotalDiscountAmount = 0;
                    $fetchYearSemTotalPaidFees = FETCH_DB_TABLE("SELECT paid_amount,discount_amount FROM stud_fee_collects WHERE fee_mode_sem_name='$semKey' AND fee_mode='Years Wise' AND student_id='" . $_POST['studId'] . "' AND university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "' AND course_id='" . $_POST['courseId'] . "'", true);
                    if (isset($fetchYearSemTotalPaidFees)) {
                        foreach ($fetchYearSemTotalPaidFees as $semTotalPaidFees) {
                            $TotalAmount  += intval($semTotalPaidFees->paid_amount);
                            $TotalDiscountAmount += intval($semTotalPaidFees->discount_amount);
                        }
                    } else {
                        $TotalAmount = 0;
                    }
                    foreach (NumberPostWords() as $NuKey => $NuData) {
                        if ($semKey == $NuKey) {
                            $output .= '<option value="' . $NuKey . '" data-subsemtype="' . $reindexedSpecSubSemFees[$semKey] . '" data-totalAmount="' . $TotalAmount + $TotalDiscountAmount . '">' . $NuKey . "" . $NuData . " " . $semType . '</option>';
                        }
                    }
                }
            } elseif ($semesterName == '4') {
                $TotalAmount = 0;
                $TotalDiscountAmount = 0;
                foreach (fourYearSem() as $semKey => $semType) {
                    $TotalAmount = 0;
                    $TotalDiscountAmount = 0;
                    $fetchYearSemTotalPaidFees = FETCH_DB_TABLE("SELECT paid_amount,discount_amount FROM stud_fee_collects WHERE fee_mode_sem_name='$semKey' AND fee_mode='Years Wise' AND student_id='" . $_POST['studId'] . "' AND university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "' AND course_id='" . $_POST['courseId'] . "'", true);
                    if (isset($fetchYearSemTotalPaidFees)) {
                        foreach ($fetchYearSemTotalPaidFees as $semTotalPaidFees) {
                            $TotalAmount  += intval($semTotalPaidFees->paid_amount);
                            $TotalDiscountAmount += intval($semTotalPaidFees->discount_amount);
                        }
                    } else {
                        $TotalAmount = 0;
                    }
                    foreach (NumberPostWords() as $NuKey => $NuData) {
                        if ($semKey == $NuKey) {
                            $output .= '<option value="' . $NuKey . '" data-subsemtype="' . $reindexedSpecSubSemFees[$semKey] . '" data-totalAmount="' . $TotalAmount + $TotalDiscountAmount . '">' . $NuKey . "" . $NuData . " " . $semType . '</option>';
                        }
                    }
                }
            } elseif ($semesterName == '5') {
                $TotalAmount = 0;
                $TotalDiscountAmount = 0;
                foreach (fiveYearSem() as $semKey => $semType) {
                    $TotalAmount = 0;
                    $TotalDiscountAmount = 0;
                    $fetchYearSemTotalPaidFees = FETCH_DB_TABLE("SELECT paid_amount,discount_amount FROM stud_fee_collects WHERE fee_mode_sem_name='$semKey' AND fee_mode='Years Wise' AND student_id='" . $_POST['studId'] . "' AND university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "' AND course_id='" . $_POST['courseId'] . "'", true);
                    if (isset($fetchYearSemTotalPaidFees)) {
                        foreach ($fetchYearSemTotalPaidFees as $semTotalPaidFees) {
                            $TotalAmount  += intval($semTotalPaidFees->paid_amount);
                            $TotalDiscountAmount += intval($semTotalPaidFees->discount_amount);
                        }
                    } else {
                        $TotalAmount = 0;
                    }
                    foreach (NumberPostWords() as $NuKey => $NuData) {
                        if ($semKey == $NuKey) {
                            $output .= '<option value="' . $NuKey . '" data-subsemtype="' . $reindexedSpecSubSemFees[$semKey] . '" data-totalAmount="' . $TotalAmount + $TotalDiscountAmount . '">' . $NuKey . "" . $NuData . " " . $semType . '</option>';
                        }
                    }
                }
            }
        } elseif ($fetchFeesMode == "One Time") {
            $TotalAmount = 0;
            $TotalDiscountAmount = 0;
            foreach ($reindexedSpecSubSemName as $semKey => $semName) {
                $TotalAmount = 0;
                $TotalDiscountAmount = 0;
                $fetchYearSemTotalPaidFees = FETCH_DB_TABLE("SELECT paid_amount,discount_amount FROM stud_fee_collects WHERE fee_mode_sem_name='$semKey' AND fee_mode='One Time' AND student_id='" . $_POST['studId'] . "' AND university_id='" . $_POST['studUniversityId'] . "' AND session_id='" . $_POST['sessionId'] . "' AND course_id='" . $_POST['courseId'] . "'", true);
                if (isset($fetchYearSemTotalPaidFees)) {
                    foreach ($fetchYearSemTotalPaidFees as $semTotalPaidFees) {
                        $TotalAmount  += intval($semTotalPaidFees->paid_amount);
                        $TotalDiscountAmount += intval($semTotalPaidFees->discount_amount);
                    }
                } else {
                    $TotalAmount = 0;
                    $TotalDiscountAmount = 0;
                }
                foreach (NumberPostWords() as $NuKey => $NuData) {

                    if ($semKey == $NuKey) {
                        $output .= '<option value="' . $NuKey . '" data-subsemtype="' . $reindexedSpecSubSemFees[$semKey] . '" data-totalAmount="' . $TotalAmount + $TotalDiscountAmount . '">' . $NuKey . "" . $NuData . '</option>';
                    }
                }
            }
        }
        $output .= '</select>

                        </div>
                     <div class="col-md-4 fee-payment-semester-wise" style="display:none;">

                        <label class="text-info">Total Fee (Rs) <span class="edit-pen text-dark"><i class="fa-solid fa-pen "></i></span></label>
                        <input type="text" readonly name="subSemesterTotalFees" class="form-control year-sem-total-fee"  required>
                        </input>
                        </div>
                       <div class="col-md-4 fee-payment-semester-wise" style="display:none;">
                        <label class="text-success w-100">Paid Fee (Rs)</label>
                         <input type="text" readonly name="paymentMode" class="form-control border border-success sem-total-amount"  required>
                        </input>
                        <div class="already-paid-sem-fee" style="display:none;">
                        <i class="fa-solid fa-circle-check fs-16 text-success"></i>
                        <span class="fs-16 text-success ">Already Paid</span>
                        </div>
                        </div>';
    }
    $output .= '<div class="col-md-12 form-group old-due-fee">
                            <label class="text-danger">Due Fees (Rs)</label>
                            <input readonly type="text"  name="dueFees" class="form-control border border-danger due-fees-for-all" value="' . $_POST['outstandingAmount'] . '" required>
                        </div>
                        <div class="col-md-6 form-group " id="afterDiscountDueFeesDiv" style="display:none;" >
                            <label class="text-success">After Discount Due Fees (Rs)</label>
                            <input readonly type="text" name="afterDiscountDueFees" class="form-control border border-success new-due-fee"  required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Payment Mode</label>
                            <select name="paymentMode" class="form-control"  required>';
    $LeadSource = FETCH_DB_TABLE(CONFIG_DATA_SQL("PAYMENT_MODE"), true);
    if ($LeadSource != null) {
        foreach ($LeadSource as $Source) {
            $output .= '  <option value="' . $Source->ConfigValueDetails . '">' . $Source->ConfigValueDetails . '</option>';
        }
    }
    $output .=
        '</select>
            </div>
                        <div class="col-md-6 form-group">
                            <label class="">Payment Date</label>
                            <input type="datetime-local" name="paymentDate" class="form-control " value="" required>
                        </div>
                        ';


    $output .=
        '
    <div class="col-md-12">
    <div class="row">
    <div class="col-sm-12 col-md-12 form-group form-check ">
      <input type="checkbox" class="form-check-input" name="discountCheckBox" value="discountBoxChecked" id="discountCheckBox1" style="margin-left: -0.7rem;" >
    <label class="form-check-label text-info fs-12" for="discountCheckBox1" style="margin-left: 0.5rem;">Add Discount <span class="text-danger">(Max Discount Left Rs.' . $LeftDiscountBalance . ')</span></label>

    </div>
    <div class="col-sm-6 col-md-6 form-group DiscountDivs" style="display:none;">
                            <label class="text-info">Discount Mode</label>
                            <select name="discountMode" class="form-control"  id="discountTypes">';


    foreach (DiscountType() as $type) {
        if ($type == $value->discount_mode) {
            $selected = "selected";
            $disabled = "";
        } else {
            $selected = "";
            $disabled = "";
        }
        $output .= ' <option value="' . $type . '" ' . $selected . ' ' . $disabled . '>' . $type . '</option>';
    }
    $output .= ' </select>
                        </div>
                        <div class="col-sm-6 col-md-6 form-group DiscountDivs" style="display:none;">
                            <label class="text-info">Discount Amount </label>
                            <input  type="text" name="discountAmount" class="form-control" value=""  id="discountAmount">
                            <span class="error-discount-msg text-danger"></span>
                        </div>
    </div>

    </div>

                        <div class="col-md-12 form-group">
                            <label class="text-success">Pay Fees (Rs)</label>
                            <input type="text" name="payFees" class="form-control border border-success" value="" id="collectPayFees" required>
                            <span class="error-msg text-danger"></span>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="4" id="notes"></textarea>
                        </div>
                        <div class=" col-md-12 text-center form-group">
                            <button class="btn btn-sm btn-success" type="submit" id="collectStudFees">Collect Fees</button>
                        </div>
                    </div>

                </form>';
    echo $output;
}
//Collect Fees And Save In Database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the JSON data from the request
    $jsonData = file_get_contents("php://input");
    // Decode the JSON data
    $formData = json_decode($jsonData, true);
    if (isset($formData['collectStudFees'])) {
        if (!empty($formData['afterDiscountDueFees'])) {
            $DueAmount = $formData['afterDiscountDueFees'] - $formData['payFees'];
        } else {
            $DueAmount = $formData['totalAmount'] - ($formData['payFees'] - $formData['alreadyFeePaid']);
        }
        $TxnDateTime = new DateTime($formData['paymentDate']);
        $TxnFormatedDateTime = $TxnDateTime->format("Y-m-d H:i:s A");
        //Fetch Fee Mode
        $DBFeeMode = FETCH("SELECT fee_mode FROM stud_fees_modes WHERE  stud_fee_mode_id='" . $formData['FeesModeId'] . "'", "fee_mode");
        // Saved In student_fee_txns

        $StudentsFeesTxns = [
            "student_id" => $formData['StudentId'],
            "university_id" => $formData['UniversityId'],
            "session_id" => $formData['SessionId'],
            "course_id" => $formData['CourseId'],
            "specilization_id" => $formData['SpecilizationId'],
            "specilization_fee_id" => $formData['SpecilizationFeesId'],
            "discount_id" => $formData['DiscountId'],
            "discount_mode" => $formData['discountMode'],
            "discount_amount" => $formData['discountAmount'],
            "fee_mode" => $DBFeeMode,
            "fee_mode_name" => $formData['SemesterName'],
            "fee_mode_amount" => $formData['totalAmount'],
            "feePayment" => $formData['payFees'],
            "dueAmount" => $DueAmount,
            "payment_method" => $formData['paymentMode'],
            "payment_status" => "Done",
            "description" => $formData['notes'],
            "is_completed" => "Completed",
            "transaction_date_time" => $TxnFormatedDateTime,
            "transaction_type" => "Payment",
            "created_by" => LOGIN_UserId,
            "updated_by" => LOGIN_UserId,
        ];
        $Save = INSERT("student_fee_txns", $StudentsFeesTxns);
        if ($Save == true) {
            $StudentFeesTxnId = FETCH("SELECT stud_fee_txns_id FROM student_fee_txns ORDER BY stud_fee_txns_id DESC LIMIT 1", "stud_fee_txns_id");
        }
        if ($DBFeeMode == "One Time") {

            //Fetch Course Fees From DB
            $fetchOneTimeCourseFees = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $formData['SpecilizationFeesId'] . "' AND univ_course_spec_fee_mode_type='" . $DBFeeMode . "'", true);
            if (isset($fetchOneTimeCourseFees)) {
                foreach ($fetchOneTimeCourseFees as $data) {
                    $courseOneTimeSemName = explode(",", $data->univ_course_spec_fee_sem_name);
                    $courseOneTimeSemFees = explode(",", $data->univ_course_spec_fee_sem_value);
                }
            }
            // Initialize an array to store the payments for each semester
            $semesterPayments = array_fill(0, count($courseOneTimeSemName), 0);
            // Count the remaining semesters
            $remainingSemesters = count($courseOneTimeSemName);

            //Divided Fees Equal In All Related Semesters
            $totalAmount = intval($formData['payFees']) + intval($formData['discountAmount']);

            if ($formData['subSemesterName'] != "Semster List"  && $formData['subSemesterTotalFees'] != "semesterWiseFeesBoxChecked" || empty($formData['subSemesterName'])  || empty($formData['subSemesterTotalFees'])) {
                foreach ($courseOneTimeSemName as $semKey => $semName) {
                    //Fetch stud_fee_collects Already Pay Fees By Student
                    $fetchStudFeeCollectData = FETCH_DB_TABLE("SELECT * FROM stud_fee_collects WHERE student_id='" . $formData['StudentId'] . "' AND university_id='" . $formData['UniversityId'] . "' AND session_id='" . $formData['SessionId'] . "' AND course_id='" . $formData['CourseId'] . "' AND specilization_id='" . $formData['SpecilizationId'] . "' AND specilization_fee_id='" . $formData['SpecilizationFeesId'] . "' AND fee_mode_sem_name='" . $semName . "'", true);
                    $DBfeeCollectSemNameValue = 0;
                    $DBfeeCollectSemName = 0;
                    $DBdiscountAmount = 0;
                    if (isset($fetchStudFeeCollectData)) {
                        foreach ($fetchStudFeeCollectData as $feeCollectKey => $feeCollectVal) {
                            $DBfeeCollectSemNameValue += $feeCollectVal->paid_amount;
                            $DBdiscountAmount += $feeCollectVal->discount_amount;
                            $DBfeeCollectSemName = $feeCollectVal->fee_mode_sem_name;
                        }
                    }
                    //Check Remaining  Semester Count For Equally Divided Discount Amount
                    if ($DBfeeCollectSemNameValue + $DBdiscountAmount == $courseOneTimeSemFees[$semKey]) {
                        $remainingSemesters--;
                    } else {
                        if ($formData['subSemesterName'] == "Semster List") {
                            $DiscountAmount = intval($formData['discountAmount']) / $remainingSemesters;
                        } else {
                            $DiscountAmount = intval($formData['discountAmount']);
                        }
                        if ($totalAmount > 0) {

                            if ($DBfeeCollectSemNameValue != $courseOneTimeSemFees[$semKey]) {

                                if ($DBfeeCollectSemNameValue < $courseOneTimeSemFees[$semKey]) {
                                    //Find Semester Remaining Amount
                                    $RemainingSemFees = $courseOneTimeSemFees[$semKey] - $DBfeeCollectSemNameValue;
                                    //Pay Remaining Sem Amount
                                    // var_dump($RemainingSemFees);
                                    // die;

                                    if ($totalAmount >= $RemainingSemFees) {

                                        $DiscountAmount = $DiscountAmount;
                                        $semesterPayments[$semKey] = $courseOneTimeSemFees[$semKey] - $DBfeeCollectSemNameValue - $DiscountAmount;
                                        $totalAmount -= $courseOneTimeSemFees[$semKey] - $DBfeeCollectSemNameValue;
                                        $DueAmount = $courseOneTimeSemFees[$semKey] - ($DBfeeCollectSemNameValue + $semesterPayments[$semKey] + $DiscountAmount);
                                    } else {

                                        $DiscountAmount = $DiscountAmount;
                                        $semesterPayments[$semKey] = $totalAmount - $DiscountAmount;
                                        $totalAmount = 0;
                                        $DueAmount = $courseOneTimeSemFees[$semKey] - ($DBfeeCollectSemNameValue + $semesterPayments[$semKey] + $DiscountAmount);
                                    }

                                    //Change Status
                                    if ($DueAmount == "0") {
                                        $semPaymentStatu = "Done";
                                    } else {
                                        $semPaymentStatu = "Pending";
                                    }
                                }
                                if (!empty($formData['FeeCollectId'])) {
                                    //Update In stud_fees_collect_table
                                    $is_Exists_N_A = FETCH("SELECT stud_fee_collect_id FROM stud_fee_collects WHERE stud_fee_collect_id ='" . $formData['FeeCollectId'] . "' AND stud_fee_txns_id = 'N/A' AND is_completed = 'N/A'", "stud_fee_collect_id");
                                    $UpdateCollectFees = [
                                        "discount_mode" => $formData['discountMode'],
                                        "discount_amount" => $DiscountAmount,
                                        "fee_mode_name" => $formData['SemesterName'],
                                        "fee_mode_sem_name" => $semName,
                                        "fee_mode_sem_name_value" => $courseOneTimeSemFees[$semKey],
                                        "fee_mode_amount" => $formData['totalAmount'],
                                        "total_amount" => $courseOneTimeSemFees[$semKey],
                                        "paid_amount" => $semesterPayments[$semKey],
                                        "outstanding_amount" => $DueAmount,
                                        "due_date" => "N/A",
                                        "last_payment_date" => "N/A",
                                        "is_overdue" => "N/A",
                                        "payment_method" => $formData['paymentMode'],
                                        "payment_status" => $semPaymentStatu,
                                        "transaction_type" => "Payment",
                                        "is_completed" => "Completed",
                                        "stud_fee_txns_id" => $StudentFeesTxnId,
                                    ];
                                    if ($is_Exists_N_A == $formData['FeeCollectId']) {
                                        $Save = UPDATE_DATA("stud_fee_collects", $UpdateCollectFees, "stud_fee_collect_id='" . $formData['FeeCollectId'] . "'");
                                    } else {
                                        $UpdateCollectFees = [
                                            "student_id" => $formData['StudentId'],
                                            "university_id" => $formData['UniversityId'],
                                            "session_id" => $formData['SessionId'],
                                            "course_id" => $formData['CourseId'],
                                            "specilization_id" => $formData['SpecilizationId'],
                                            "specilization_fee_id" => $formData['SpecilizationFeesId'],
                                            "discount_id" => $formData['DiscountId'],
                                            "discount_mode" => $formData['discountMode'],
                                            "discount_amount" => $DiscountAmount,
                                            "fee_mode" => $DBFeeMode,
                                            "fee_mode_name" => $formData['SemesterName'],
                                            "fee_mode_sem_name" => $semName,
                                            "fee_mode_sem_name_value" => $courseOneTimeSemFees[$semKey],
                                            "fee_mode_amount" => $formData['totalAmount'],
                                            "total_amount" => $courseOneTimeSemFees[$semKey],
                                            "paid_amount" => $semesterPayments[$semKey],
                                            "outstanding_amount" => $DueAmount,
                                            "due_date" => "N/A",
                                            "last_payment_date" => "N/A",
                                            "is_overdue" => "N/A",
                                            "payment_method" => $formData['paymentMode'],
                                            "payment_status" => $semPaymentStatu,
                                            "transaction_type" => "Payment",
                                            "is_completed" => "Completed",
                                            "stud_fee_txns_id" => $StudentFeesTxnId,
                                            "stud_fee_mode_id" => $formData['FeesModeId'],
                                            "created_by" => LOGIN_UserId,
                                            "updated_by" => LOGIN_UserId,
                                        ];
                                        $Save = INSERT("stud_fee_collects", $UpdateCollectFees);
                                    }
                                } else {
                                    // New Insert In stud_fees_collect_table
                                    $UpdateCollectFees = [
                                        "student_id" => $formData['StudentId'],
                                        "university_id" => $formData['UniversityId'],
                                        "session_id" => $formData['SessionId'],
                                        "course_id" => $formData['CourseId'],
                                        "specilization_id" => $formData['SpecilizationId'],
                                        "specilization_fee_id" => $formData['SpecilizationFeesId'],
                                        "discount_id" => $formData['DiscountId'],
                                        "discount_mode" => $formData['discountMode'],
                                        "discount_amount" => $formData['discountAmount'],
                                        "fee_mode" => $DBFeeMode,
                                        "fee_mode_name" => $formData['SemesterName'],
                                        "fee_mode_sem_name" => $semName,
                                        "fee_mode_sem_name_value" => $courseOneTimeSemFees[$semKey],
                                        "fee_mode_amount" => $formData['totalAmount'],
                                        "total_amount" => $courseOneTimeSemFees[$semKey],
                                        "paid_amount" => $semesterPayments[$semKey],
                                        "outstanding_amount" => $DueAmount,
                                        "due_date" => "N/A",
                                        "last_payment_date" => "N/A",
                                        "is_overdue" => "N/A",
                                        "payment_method" => $formData['paymentMode'],
                                        "payment_status" => "Pending",
                                        "transaction_type" => "Payment",
                                        "is_completed" => "Completed",
                                        "stud_fee_txns_id" => $StudentFeesTxnId,
                                        "stud_fee_mode_id" => $formData['FeesModeId'],
                                        "created_by" => LOGIN_UserId,
                                        "updated_by" => LOGIN_UserId,
                                    ];
                                    $Save = INSERT("stud_fee_collects", $UpdateCollectFees);
                                }
                            }
                        } else {
                            // No more funds to pay
                            break;
                        }
                    }
                }
            }
        } elseif ($DBFeeMode == "Semesters Wise") {
            // //Fetch Course Fees From DB
            // $fetchOneTimeCourseFees = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $formData['SpecilizationFeesId'] . "' AND univ_course_spec_fee_mode_type='" . $DBFeeMode . "'", true);
            // if (isset($fetchOneTimeCourseFees)) {
            //     foreach ($fetchOneTimeCourseFees as $data) {
            //         $courseOneTimeSemName = explode(",", $data->univ_course_spec_fee_sem_name);
            //         $courseOneTimeSemFees = explode(",", $data->univ_course_spec_fee_sem_value);
            //     }
            // }

            // foreach ($courseOneTimeSemName as $semNameKey => $semNameVal) {
            //     if ($formData['SemesterName'] == $semNameVal) {
            //         //Fetch stud_fee_collects Already Pay Fees By Student
            //         $fetchStudFeeCollectData = FETCH_DB_TABLE("SELECT * FROM stud_fee_collects WHERE student_id='" . $formData['StudentId'] . "' AND university_id='" . $formData['UniversityId'] . "' AND session_id='" . $formData['SessionId'] . "' AND course_id='" . $formData['CourseId'] . "' AND specilization_id='" . $formData['SpecilizationId'] . "' AND specilization_fee_id='" . $formData['SpecilizationFeesId'] . "' AND fee_mode_sem_name='" . $formData['SemesterName'] . "'", true);
            //         $DBfeeCollectSemNameValue = 0;
            //         $DBfeeCollectSemName = 0;
            //         $DBdiscountAmount = 0;
            //         if (isset($fetchStudFeeCollectData)) {
            //             foreach ($fetchStudFeeCollectData as $feeCollectKey => $feeCollectVal) {
            //                 $DBfeeCollectSemNameValue += $feeCollectVal->paid_amount;
            //                 $DBdiscountAmount += $feeCollectVal->discount_amount;
            //                 $DBfeeCollectSemName = $feeCollectVal->fee_mode_sem_name;
            //             }
            //         } else {
            //             $DBfeeCollectSemNameValue = 0;
            //             $DBfeeCollectSemName = 0;
            //             $DBdiscountAmount = 0;
            //         }
            //         // Fees Status
            //         if ($courseOneTimeSemFees[$semNameKey] == $DBfeeCollectSemNameValue + $DBdiscountAmount) {
            //             $status = "Done";
            //         } else {
            //             $status = "Pending";
            //         }
            //     }
            // }
            if (!empty($formData['FeeCollectId'])) {
                //Update In stud_fees_collect_table
                $is_Exists_N_A = FETCH("SELECT stud_fee_collect_id FROM stud_fee_collects WHERE stud_fee_collect_id ='" . $formData['FeeCollectId'] . "' AND stud_fee_txns_id = 'N/A' AND is_completed = 'N/A'", "stud_fee_collect_id");
                $UpdateCollectFees = [
                    "discount_mode" => $formData['discountMode'],
                    "discount_amount" => $formData['discountAmount'],
                    "fee_mode_name" => $formData['SemesterName'],
                    "fee_mode_amount" => $formData['totalAmount'],
                    "total_amount" => $formData['totalAmount'],
                    "paid_amount" => $formData['payFees'],
                    "outstanding_amount" => $DueAmount,
                    "due_date" => "N/A",
                    "last_payment_date" => "N/A",
                    "is_overdue" => "N/A",
                    "payment_method" => $formData['paymentMode'],
                    "payment_status" => "Pending",
                    "transaction_type" => "Payment",
                    "is_completed" => "Completed",
                    "stud_fee_txns_id" => $StudentFeesTxnId,
                ];
                if ($is_Exists_N_A == $formData['FeeCollectId']) {
                    $Save = UPDATE_DATA("stud_fee_collects", $UpdateCollectFees, "stud_fee_collect_id='" . $formData['FeeCollectId'] . "'");
                } else {
                    $UpdateCollectFees = [
                        "student_id" => $formData['StudentId'],
                        "university_id" => $formData['UniversityId'],
                        "session_id" => $formData['SessionId'],
                        "course_id" => $formData['CourseId'],
                        "specilization_id" => $formData['SpecilizationId'],
                        "specilization_fee_id" => $formData['SpecilizationFeesId'],
                        "discount_id" => $formData['DiscountId'],
                        "discount_mode" => $formData['discountMode'],
                        "discount_amount" => $formData['discountAmount'],
                        "fee_mode" => $DBFeeMode,
                        "fee_mode_name" => $formData['SemesterName'],
                        "fee_mode_amount" => $formData['totalAmount'],
                        "total_amount" => $formData['totalAmount'],
                        "paid_amount" => $formData['payFees'],
                        "outstanding_amount" => $DueAmount,
                        "due_date" => "N/A",
                        "last_payment_date" => "N/A",
                        "is_overdue" => "N/A",
                        "payment_method" => $formData['paymentMode'],
                        "payment_status" => "Pending",
                        "transaction_type" => "Payment",
                        "is_completed" => "Completed",
                        "stud_fee_txns_id" => $StudentFeesTxnId,
                        "stud_fee_mode_id" => $formData['FeesModeId'],
                        "created_by" => LOGIN_UserId,
                        "updated_by" => LOGIN_UserId,
                    ];
                    $Save = INSERT("stud_fee_collects", $UpdateCollectFees);
                }
            } else {
                // New Insert In stud_fees_collect_table
                $UpdateCollectFees = [
                    "student_id" => $formData['StudentId'],
                    "university_id" => $formData['UniversityId'],
                    "session_id" => $formData['SessionId'],
                    "course_id" => $formData['CourseId'],
                    "specilization_id" => $formData['SpecilizationId'],
                    "specilization_fee_id" => $formData['SpecilizationFeesId'],
                    "discount_id" => $formData['DiscountId'],
                    "discount_mode" => $formData['discountMode'],
                    "discount_amount" => $formData['discountAmount'],
                    "fee_mode" => $DBFeeMode,
                    "fee_mode_name" => $formData['SemesterName'],
                    "fee_mode_amount" => $formData['totalAmount'],
                    "total_amount" => $formData['totalAmount'],
                    "paid_amount" => $formData['payFees'],
                    "outstanding_amount" => $DueAmount,
                    "due_date" => "N/A",
                    "last_payment_date" => "N/A",
                    "is_overdue" => "N/A",
                    "payment_method" => $formData['paymentMode'],
                    "payment_status" => "Pending",
                    "transaction_type" => "Payment",
                    "is_completed" => "Completed",
                    "stud_fee_txns_id" => $StudentFeesTxnId,
                    "stud_fee_mode_id" => $formData['FeesModeId'],
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT("stud_fee_collects", $UpdateCollectFees);
            }
        } elseif ($DBFeeMode == "Years Wise") {
            if ($formData['SemesterName'] == "1") {
                $courseYearSemName = firstYearSem();
            } elseif ($formData['SemesterName'] == "2") {
                $courseYearSemName = secondYearSem();
            } elseif ($formData['SemesterName'] == "3") {
                $courseYearSemName = thirdYearSem();
            } elseif ($formData['SemesterName'] == "4") {
                $courseYearSemName = fourYearSem();
            } elseif ($formData['SemesterName'] == "5") {
                $courseYearSemName = fiveYearSem();
            }
            //Fetch Course Fees From DB
            $fetchOneTimeCourseFees = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $formData['SpecilizationFeesId'] . "' AND univ_course_spec_fee_mode_type='" . $DBFeeMode . "'", true);
            if (isset($fetchOneTimeCourseFees)) {
                foreach ($fetchOneTimeCourseFees as $data) {
                    $courseOneTimeSemName = explode(",", $data->univ_course_spec_fee_sem_name);
                    $courseOneTimeSemFees = explode(",", $data->univ_course_spec_fee_sem_value);
                }
            }

            // Initialize an array to store the payments for each semester
            $semesterPayments = array_fill(0, count($courseYearSemName), 0);
            // Count the remaining semesters
            $remainingSemesters = count($courseYearSemName);

            //Divided Fees Equal In All Related Semesters
            $totalAmount = intval($formData['payFees']) + intval($formData['discountAmount']);

            if ($formData['subSemesterName'] != "Semster List"  && $formData['subSemesterTotalFees'] != "semesterWiseFeesBoxChecked" || empty($formData['subSemesterName'])  || empty($formData['subSemesterTotalFees'])) {
                foreach ($courseYearSemName as $yearSemKey => $yearKeyValue) {
                    foreach ($courseOneTimeSemName as $semKey => $semName) {

                        //Fetch stud_fee_collects Already Pay Fees By Student
                        $fetchStudFeeCollectData = FETCH_DB_TABLE("SELECT * FROM stud_fee_collects WHERE student_id='" . $formData['StudentId'] . "' AND university_id='" . $formData['UniversityId'] . "' AND session_id='" . $formData['SessionId'] . "' AND course_id='" . $formData['CourseId'] . "' AND specilization_id='" . $formData['SpecilizationId'] . "' AND specilization_fee_id='" . $formData['SpecilizationFeesId'] . "' AND fee_mode_sem_name='" . $semName . "'", true);
                        $DBfeeCollectSemNameValue = 0;
                        $DBfeeCollectSemName = 0;
                        $DBdiscountAmount = 0;
                        if (isset($fetchStudFeeCollectData)) {
                            foreach ($fetchStudFeeCollectData as $feeCollectKey => $feeCollectVal) {
                                $DBfeeCollectSemNameValue += $feeCollectVal->paid_amount;
                                $DBdiscountAmount += $feeCollectVal->discount_amount;
                                $DBfeeCollectSemName = $feeCollectVal->fee_mode_sem_name;
                            }
                        }
                        if ($semName == $yearSemKey) {
                            //Check Remaining  Semester Count For Equally Divided Discount Amount
                            if ($DBfeeCollectSemNameValue + $DBdiscountAmount == $courseOneTimeSemFees[$semKey]) {
                                $remainingSemesters--;
                            } else {

                                if ($formData['subSemesterName'] == "Semster List") {

                                    $DiscountAmount = intval($formData['discountAmount']) / $remainingSemesters;
                                } else {
                                    $DiscountAmount = intval($formData['discountAmount']);
                                }
                                if ($totalAmount > 0) {

                                    if ($DBfeeCollectSemNameValue != $courseOneTimeSemFees[$semKey]) {

                                        if ($DBfeeCollectSemNameValue < $courseOneTimeSemFees[$semKey]) {
                                            //Find Semester Remaining Amount
                                            $RemainingSemFees = $courseOneTimeSemFees[$semKey] - $DBfeeCollectSemNameValue;
                                            //Pay Remaining Sem Amount

                                            if ($totalAmount >= $RemainingSemFees) {
                                                $DiscountAmount = $DiscountAmount;
                                                $semesterPayments[$semKey] = $courseOneTimeSemFees[$semKey] - $DBfeeCollectSemNameValue - $DiscountAmount;
                                                $totalAmount -= $courseOneTimeSemFees[$semKey] - $DBfeeCollectSemNameValue;
                                                $DueAmount = $courseOneTimeSemFees[$semKey] - ($DBfeeCollectSemNameValue + $semesterPayments[$semKey] + $DiscountAmount);
                                            } else {
                                                $DiscountAmount = $DiscountAmount;
                                                $semesterPayments[$semKey] = $totalAmount - $DiscountAmount;
                                                $totalAmount = 0;
                                                $DueAmount = $courseOneTimeSemFees[$semKey] - ($DBfeeCollectSemNameValue + $semesterPayments[$semKey] + $DiscountAmount);
                                            }

                                            //Change Status
                                            if ($DueAmount == "0") {
                                                $semPaymentStatu = "Done";
                                            } else {
                                                $semPaymentStatu = "Pending";
                                            }
                                        }
                                        if (!empty($formData['FeeCollectId'])) {
                                            //Update In stud_fees_collect_table
                                            $is_Exists_N_A = FETCH("SELECT stud_fee_collect_id FROM stud_fee_collects WHERE stud_fee_collect_id ='" . $formData['FeeCollectId'] . "' AND stud_fee_txns_id = 'N/A' AND is_completed = 'N/A'", "stud_fee_collect_id");
                                            $UpdateCollectFees = [
                                                "discount_mode" => $formData['discountMode'],
                                                "discount_amount" => $DiscountAmount,
                                                "fee_mode_name" => $formData['SemesterName'],
                                                "fee_mode_sem_name" => $semName,
                                                "fee_mode_sem_name_value" => $courseOneTimeSemFees[$semKey],
                                                "fee_mode_amount" => $formData['totalAmount'],
                                                "total_amount" => $courseOneTimeSemFees[$semKey],
                                                "paid_amount" => $semesterPayments[$semKey],
                                                "outstanding_amount" => $DueAmount,
                                                "due_date" => "N/A",
                                                "last_payment_date" => "N/A",
                                                "is_overdue" => "N/A",
                                                "payment_method" => $formData['paymentMode'],
                                                "payment_status" => $semPaymentStatu,
                                                "transaction_type" => "Payment",
                                                "is_completed" => "Completed",
                                                "stud_fee_txns_id" => $StudentFeesTxnId,
                                            ];
                                            if ($is_Exists_N_A == $formData['FeeCollectId']) {
                                                $Save = UPDATE_DATA("stud_fee_collects", $UpdateCollectFees, "stud_fee_collect_id='" . $formData['FeeCollectId'] . "'");
                                            } else {
                                                $UpdateCollectFees = [
                                                    "student_id" => $formData['StudentId'],
                                                    "university_id" => $formData['UniversityId'],
                                                    "session_id" => $formData['SessionId'],
                                                    "course_id" => $formData['CourseId'],
                                                    "specilization_id" => $formData['SpecilizationId'],
                                                    "specilization_fee_id" => $formData['SpecilizationFeesId'],
                                                    "discount_id" => $formData['DiscountId'],
                                                    "discount_mode" => $formData['discountMode'],
                                                    "discount_amount" => $DiscountAmount,
                                                    "fee_mode" => $DBFeeMode,
                                                    "fee_mode_name" => $formData['SemesterName'],
                                                    "fee_mode_sem_name" => $semName,
                                                    "fee_mode_sem_name_value" => $courseOneTimeSemFees[$semKey],
                                                    "fee_mode_amount" => $formData['totalAmount'],
                                                    "total_amount" => $courseOneTimeSemFees[$semKey],
                                                    "paid_amount" => $semesterPayments[$semKey],
                                                    "outstanding_amount" => $DueAmount,
                                                    "due_date" => "N/A",
                                                    "last_payment_date" => "N/A",
                                                    "is_overdue" => "N/A",
                                                    "payment_method" => $formData['paymentMode'],
                                                    "payment_status" => $semPaymentStatu,
                                                    "transaction_type" => "Payment",
                                                    "is_completed" => "Completed",
                                                    "stud_fee_txns_id" => $StudentFeesTxnId,
                                                    "stud_fee_mode_id" => $formData['FeesModeId'],
                                                    "created_by" => LOGIN_UserId,
                                                    "updated_by" => LOGIN_UserId,
                                                ];
                                                $Save = INSERT("stud_fee_collects", $UpdateCollectFees);
                                            }
                                        } else {
                                            // New Insert In stud_fees_collect_table
                                            $UpdateCollectFees = [
                                                "student_id" => $formData['StudentId'],
                                                "university_id" => $formData['UniversityId'],
                                                "session_id" => $formData['SessionId'],
                                                "course_id" => $formData['CourseId'],
                                                "specilization_id" => $formData['SpecilizationId'],
                                                "specilization_fee_id" => $formData['SpecilizationFeesId'],
                                                "discount_id" => $formData['DiscountId'],
                                                "discount_mode" => $formData['discountMode'],
                                                "discount_amount" => $formData['discountAmount'],
                                                "fee_mode" => $DBFeeMode,
                                                "fee_mode_name" => $formData['SemesterName'],
                                                "fee_mode_sem_name" => $semName,
                                                "fee_mode_sem_name_value" => $courseOneTimeSemFees[$semKey],
                                                "fee_mode_amount" => $formData['totalAmount'],
                                                "total_amount" => $courseOneTimeSemFees[$semKey],
                                                "paid_amount" => $semesterPayments[$semKey],
                                                "outstanding_amount" => $DueAmount,
                                                "due_date" => "N/A",
                                                "last_payment_date" => "N/A",
                                                "is_overdue" => "N/A",
                                                "payment_method" => $formData['paymentMode'],
                                                "payment_status" => "Pending",
                                                "transaction_type" => "Payment",
                                                "is_completed" => "Completed",
                                                "stud_fee_txns_id" => $StudentFeesTxnId,
                                                "stud_fee_mode_id" => $formData['FeesModeId'],
                                                "created_by" => LOGIN_UserId,
                                                "updated_by" => LOGIN_UserId,
                                            ];
                                            $Save = INSERT("stud_fee_collects", $UpdateCollectFees);
                                        }
                                    }
                                } else {
                                    // No more funds to pay
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        if ($formData['discountCheckBox'] == "discountBoxChecked" && $formData['discountMode'] != "" &&  $formData['discountAmount'] != "") {
            $FetchDiscount = FETCH_DB_TABLE("SELECT * FROM students_university_course_discount_details WHERE discount_id='" . $formData['DiscountId'] . "'", true);
            if (isset($FetchDiscount)) {
                foreach ($FetchDiscount as $key => $data) {
                    $discountMode = $data->discount_mode;
                    $discountTypeNames = explode(",", $data->discount_type_names);
                    $discountTypeFees = explode(",", $data->discount_type_fees);
                }
                $semesterFound = false;
                //List All Discount Type Name
                foreach ($discountTypeNames as $key => $val) {
                    //Match Semester Name
                    if ($val == $formData['SemesterName']) {
                        $semesterFound = true;
                        //Match Semester Discount Amount
                        if ($formData['discountAmount'] == $discountTypeFees[$key] && $formData['totalDiscount'] == $discountTypeFees[$key]) {
                            // Update In Array Of New Discount Which Is less than $discountTypeFees[$key]
                            $discountTypeFees[$key] = $formData['discountAmount'];
                        } elseif ($formData['discountAmount'] > $discountTypeFees[$key] && $formData['totalDiscount'] >= $discountTypeFees[$key]) {
                            // Update In Array Of New Discount Which Is greater than $discountTypeFees[$key]
                            $discountTypeFees[$key] += $formData['discountAmount'];
                        } elseif ($formData['discountAmount'] <= $discountTypeFees[$key] && $formData['totalDiscount'] == $discountTypeFees[$key]) {
                            $discountTypeFees[$key] += $formData['discountAmount'];
                        } elseif ($formData['discountAmount'] <= $discountTypeFees[$key] && $formData['totalDiscount'] >= $discountTypeFees[$key]) {
                            $discountTypeFees[$key] += $formData['discountAmount'];
                        }
                    }
                }
                if (!$semesterFound) {
                    $discountTypeNames[] = $formData['SemesterName'];
                    $discountTypeFees[] = $formData['discountAmount'];
                    $UpdateNewDiscountAmount = [
                        "discount_type_names" => implode(",", $discountTypeNames),
                        "discount_type_fees" => implode(",", $discountTypeFees),
                    ];
                    $Save = UPDATE_DATA("students_university_course_discount_details", $UpdateNewDiscountAmount, "discount_id='" . $formData['DiscountId'] . "'");
                } else {
                    $UpdateNewDiscountAmount = [
                        "discount_type_names" => implode(",", $discountTypeNames),
                        "discount_type_fees" => implode(",", $discountTypeFees),
                    ];
                    $Save = UPDATE_DATA("students_university_course_discount_details", $UpdateNewDiscountAmount, "discount_id='" . $formData['DiscountId'] . "'");
                }
            }
        }
        if ($Save == true) {
            echo "success";
        }
    }
}
// Show Student Fees TXN Details
if (isset($_POST['LoadTxnDetails'])) {
    $output = '';
    // Show By Search Input
    if (!empty($_POST['SearchValue'])) {
        $SearchValue = $_POST['SearchValue'];
        $StudTxnDetails = FETCH_DB_TABLE("SELECT * FROM students_primary_details AS spd INNER JOIN 	student_fee_txns AS sft ON spd.student_id=sft.student_id WHERE 	spd.student_full_name LIKE '%$SearchValue%' ORDER BY sft.stud_fee_txns_id DESC ", true);
    }
    if (!empty($_POST['StudentId'])) {
        $StudentId = $_POST['StudentId'];
        // Show After Collect Fees From Students (StudId and ....)
        $StudTxnDetails = FETCH_DB_TABLE("SELECT * FROM students_primary_details AS spd INNER JOIN 	student_fee_txns AS sft ON spd.student_id=sft.student_id WHERE 	spd.student_id LIKE '%$StudentId%' ORDER BY sft.stud_fee_txns_id DESC", true);
    }

    if (isset($StudTxnDetails)) {
        foreach ($StudTxnDetails as $key => $val) {
            foreach (NumberPostWords() as $keys => $data) {
                if ($keys == $val->fee_mode_name) {
                    $NumberPostWords = $data;
                } else {
                    $NumberPostWords = "";
                }
            }

            if ($val->fee_mode == "Semesters Wise") {
                $feesMode = $NumberPostWords . " " . "Sem";
            } elseif ($val->fee_mode == "Years Wise") {
                $feesMode = $NumberPostWords . " " . "Year";
            } elseif ($val->fee_mode == "One Time") {
                $feesMode = $NumberPostWords . " ";
            } elseif ($val->fee_mode == "Registration Fee") {
                $feesMode =  "";
            }

            $output .= '
            <tr>
            <th scope="row">' . $val->fee_mode_name . $feesMode . '</th>
            <td>' . $val->feePayment . '</td>
            <td>' . $val->payment_method . '</td>
            <td>' . $val->transaction_date_time . '</td>
            <td><a href="#" class="btn btn-sm btn-light " style="padding: 0.2rem 0.9rem !important;">More</a></td>
            </tr>';
        }
        echo $output;
    }
}
if (isset($_POST['feesDetailsBtnView'])) {
    $courseFees = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['speciid'] . "' AND univ_session_id='" . $_POST['sessionid'] . "' AND university_id='" . $_POST['universityId'] . "'", true);
    $output = "";
    if (isset($courseFees)) {
        foreach ($courseFees as $courseKey => $courseFee) {
            if ($courseFee->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $courseName = explode(",", $courseFee->univ_course_spec_fee_name);
                $coursefees = explode(",", $courseFee->univ_course_spec_fee_value);
                $output .=
                    '<span style="padding: 4px;background: #bdd3e7; border-radius: 6px;">
                <b>Semester Wise</b><br>';
                foreach ($courseName as $courseKey => $courseName) {
                    foreach (NumberPostWords() as $NumKey => $Num) {
                        if ($NumKey == $courseName) {
                            $output .= $courseName . $Num . " ->Rs. " . $coursefees[$courseKey] . '<br>';
                        }
                    }
                }
                $output .= '</span>';
            } elseif ($courseFee->univ_course_spec_fee_mode_type == "Years Wise") {
                $courseName = explode(",", $courseFee->univ_course_spec_fee_name);
                $coursefees = explode(",", $courseFee->univ_course_spec_fee_value);
                $output .= '<span style="padding: 4px;background: #bdd3e7; border-radius: 6px;">
                <b>Year Wise</b><br>';
                foreach ($courseName as $courseKey => $courseName) {
                    foreach (NumberPostWords() as $NumKey => $Num) {
                        if ($NumKey == $courseName) {
                            $output .= $courseName . $Num . "->Rs." . $coursefees[$courseKey] . '<br>';
                        }
                    }
                }
                $output .=
                    ' </span>';
            } elseif ($courseFee->univ_course_spec_fee_mode_type == "One Time") {
                $courseName = $courseFee->univ_course_spec_fee_name;
                $coursefees = $courseFee->univ_course_spec_fee_value;

                $output .=
                    '<span style="padding: 4px;background: #bdd3e7; border-radius: 6px;">
                <b>One Time</b><br>';

                $output .= "1st" . "->Rs." . $coursefees . '<br>';


                $output .=   '</span>';
            }
        }
        echo $output;
    } else {
    }
}
if (isset($_POST['feesDetailsTutitionBtnView'])) {
    $courseFees = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_tutition_fees WHERE university_specialization_id='" . $_POST['speciid'] . "' AND univ_session_id='" . $_POST['sessionid'] . "' AND university_id='" . $_POST['universityId'] . "'", true);
    $output = "";
    if (isset($courseFees)) {
        foreach ($courseFees as $courseKey => $courseFee) {
            if ($courseFee->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $courseName = explode(",", $courseFee->univ_course_spec_fee_name);
                $coursefees = explode(",", $courseFee->univ_course_spec_fee_value);
                $output .=
                    '<span style="padding: 4px;background: #bdd3e7; border-radius: 6px;">
                <b>Semester Wise</b><br>';
                foreach ($courseName as $courseKey => $courseName) {
                    foreach (NumberPostWords() as $NumKey => $Num) {
                        if ($NumKey == $courseName) {
                            $output .= $courseName . $Num . " ->Rs. " . $coursefees[$courseKey] . '<br>';
                        }
                    }
                }
                $output .= '</span>';
            } elseif ($courseFee->univ_course_spec_fee_mode_type == "Years Wise") {
                $courseName = explode(",", $courseFee->univ_course_spec_fee_name);
                $coursefees = explode(",", $courseFee->univ_course_spec_fee_value);
                $output .= '<span style=" padding: 4px;background: #bdd3e7; border-radius: 6px;">
                <b>Year Wise</b><br>';
                foreach ($courseName as $courseKey => $courseName) {
                    foreach (NumberPostWords() as $NumKey => $Num) {
                        if ($NumKey == $courseName) {
                            $output .= $courseName . $Num . "->Rs." . $coursefees[$courseKey] . '<br>';
                        }
                    }
                }
                $output .=
                    ' </span>';
            } elseif ($courseFee->univ_course_spec_fee_mode_type == "One Time") {
                $courseName = $courseFee->univ_course_spec_fee_name;
                $coursefees = $courseFee->univ_course_spec_fee_value;

                $output .=
                    '<span style=" padding: 4px;background: #bdd3e7; border-radius: 6px;">
                <b>One Time</b><br>';

                $output .= "1st" . "->Rs." . $coursefees . '<br>';


                $output .=   '</span>';
            }
        }
        echo $output;
    } else {
    }
}
