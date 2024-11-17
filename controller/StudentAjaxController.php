
<?php
$Dir = "../";

//add controller helper files
require $Dir . '/require/modules.php';
//add aditional requirements
require $Dir.'require/admin/access-control.php';
//========================>Ajax POst Request Start Here<================================//
// Fetching Course Session Years
if (isset($_POST['studUniBtn']) == "submit") {
    $output = " ";
    $fetchUnivercitySessionYear = FETCH_DB_TABLE("SELECT * FROM universities_primary_details AS upd INNER JOIN 	universities_session_years AS usy ON upd.university_id = usy.university_id WHERE upd.university_id='" . $_POST['studUniversityId'] . "' AND upd.university_status= '1'", true);
    if (isset($fetchUnivercitySessionYear)) {
        $output .= '<option>choose session year</option>';
        foreach ($fetchUnivercitySessionYear as $value) {
            $output .= '<option value="' . $value->univ_session_id . '" data-uniid="' . $value->university_id . '">' . $value->univ_session_name . '</option>';
        }
    }
    echo $output;
}

// Fetching  Couses List
if (isset($_POST['studUnversitySessionYearBtn']) == "submit") {
    $output = " ";
    // SessionYearId
    $fetchUnivercitySessionYear = FETCH_DB_TABLE("SELECT * FROM univ_session_course AS usc INNER JOIN universities_courses AS uc ON usc.univ_course_id=uc.univ_course_id WHERE usc.university_id='" . $_POST['studUniversityId'] . "' AND usc.univ_session_id='" . $_POST['SessionYearId'] . "'", true);
    if (isset($fetchUnivercitySessionYear)) {
        $output .= '<option >choose course</option>';
        foreach ($fetchUnivercitySessionYear as $value) {
            $output .= '<option value="' . $value->univ_course_id . '">' . $value->univ_course_name . '</option>';
        }
    }
    echo $output;
}

// Fetching Course Specialization
if (isset($_POST['studUnversityCourseSepcBtn']) == "submit") {
    $output = " ";
    $fetchUnivercitySessionYear = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['univCourseId'] . "'", true);
    if (isset($fetchUnivercitySessionYear)) {
        $output .= '<option >choose course specialization</option>';
        foreach ($fetchUnivercitySessionYear as $val) {
            $output .= '<option value="' . $val->univ_specialization_id . '">' . $val->univ_course_specialization_name . '</option>';
        }
        echo $output;
    }
}

// Fetching University Primary And Address Details
if (isset($_POST['UniversityBtn']) == "ChangeOption") {
    $output = " ";
    $fetchUniversityName = FETCH("SELECT university_name FROM universities_primary_details WHERE university_id='" . $_POST['UniversityId'] . "'", "university_name");
    $output .= '<h5 class="bold">' . '<span class="text-muted">' . "Unversity Name:-" . '</span>' . $fetchUniversityName . '</h5>';
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_billing_address WHERE university_id='" . $_POST['UniversityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $value) {
            $output .= '<p class="mb-0" id="UniversityAddressResponse">' . '<span class="text-muted">' . "Address:-" . '</span>' . $value->univ_reg_address . "<br>" . '<span class="text-muted">' . "Sector:-" . '</span>' . $value->univ_reg_sector . "<br>" . '<span class="text-muted">' . "Landmark:-" . '</span>' . $value->univ_reg_landmark . "<br>" . '<span class="text-muted">' . "City:-" . '</span>' . $value->univ_reg_city . "<br>" . '<span class="text-muted">' . "State:-" . '</span>' . $value->univ_reg_state . "<br>" . '<span class="text-muted">' . "Country:-" . '</span>' . $value->univ_reg_country . "<br>" . '<span class="text-muted">' . "Pincode:-" . '</span>' . $value->univ_reg_pincode . '</p>';
        }
    }
    echo $output;
}



//Fetching Couses Details And Course fee
if (isset($_POST['UniversityCourseBtn']) == "UniversityCourseChangeOption") {
    $CoursesDetailOutPut = " ";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees AS ucs INNER JOIN universities_courses AS uc ON uc.univ_course_id =ucs.univ_course_id INNER JOIN universities_session_years AS usy ON usy.univ_session_id=ucs.univ_session_id INNER JOIN universities_courses_specializations AS ucse ON ucse.univ_specialization_id=ucs.university_specialization_id WHERE ucs.university_specialization_id = '" . $_POST['UniversityCourseSpecName'] . "' AND ucs.university_id = '" . $_POST['studUniversityName'] . "' AND ucs.univ_session_id = '" . $_POST['UniversitySessionId'] . "' AND ucs.univ_course_id = '" . $_POST['UniversityCourseId'] . "'", true);
    // echo "<pre>";
    // print_r($fetchData);
    // die;
    if (isset($fetchData)) {

        foreach ($fetchData as $key => $data) {

            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } else {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            }

            $CoursesDetailOutPut .= '<h5 class="bold">' . '<span class="text-muted">' . "Fees Payment Mode:-" . '</span>' . $data->univ_course_spec_fee_mode_type .
                '</h5>
             <p class="mb-0">' .
                '<span class="text-muted">' . "Course Session Year:-" . '</span>' . $data->univ_session_name . "<br>" .
                '<span class="text-muted">' . "Course Name:-" . '</span>' . $data->univ_course_name . "<br>" .
                '<span class="text-muted">' . "Course Specilization Name:-" . '</span>' . $data->univ_course_specialization_name . "<br>" .
                '<span class="text-muted">' . "Total Semester:-" . '</span>' . $data->univ_course_total_semester . "<br>" .
                '<span class="text-muted">' . "Total Years:-" . '</span>' . $data->univ_course_total_year . "<br>" .
                '<span class="text-muted">' . "Course Fee Payment Mode:-" . '</span>' . $data->univ_course_spec_fee_mode_type . "<br>";
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $FeesModeType = "Semester";
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $FeesModeType = "Year";
            } elseif ($data->univ_course_spec_fee_mode_type == "One Time") {
                $FeesModeType = "One Time";
            }
            $TotalFees = 0;
            foreach ($feeModeWise as $key => $feeModeVal) {
                $TotalFees += $fees[$key];
                $CoursesDetailOutPut .= '<span class="text-muted">' . $FeesModeType . " " . $feeModeVal . " => " . '</span>' . "Rs." . $fees[$key] . ", ";
            }
            $CoursesDetailOutPut .= '<br><span class="text-muted">Total Fees => </span>' . "Rs." . $TotalFees;
        }
    }
    echo $CoursesDetailOutPut;
}
//Fetching BDE/ Team Member Details
if (isset($_POST['BdeIdBtn']) == "BdeIdChangeOption") {
    $bdeOutput = " ";
    $fetchData = FETCH_DATA("SELECT * FROM bdes_primary_details WHERE bdes_id='" . $_POST['BdeId'] . "'");
    if (isset($fetchData)) {
        $bdeOutput .= '<h5 class="bold">' . '<span class="text-muted">' . "Bde Name:-" . '</span>' . $fetchData['bdes_first_name'] ." ". $fetchData['bdes_last_name'].'</h5>
            <p class="mb-0" >' . '<span class="text-muted">' . "Phone No.:-". '</span>' . $fetchData['bdes_phone_no'] . "<br>" . '<span class="text-muted">' . "Email Id:-" . '</span>' . $fetchData['bdes_email_id'] . "<br>" . '<span class="text-muted">' . "Address Line 1:-" . '</span>'. $fetchData['bdes_address_line1'] . "<br>" . '<span class="text-muted">' . "Address Line 2:-" . '</span>'. $fetchData['bdes_address_line2'] ."<br>" . '<span class="text-muted">' . "City:-" . '</span>'. $fetchData['bdes_city']."<br>" . '<span class="text-muted">' . "State:-" . '</span>'. $fetchData['bdes_state']."<br>" . '<span class="text-muted">' . "Country:-" . '</span>'. $fetchData['bdes_country']."<br>" . '<span class="text-muted">' . "Pincode:-" . '</span>'. $fetchData['bdes_zip'].'</p>';
    }
    echo $bdeOutput;
}
//Fetching Discount Details
if (isset($_POST['keyUp']) == "submit") {
    $output = "";
    $fetchCourseId = FETCH("SELECT course_id FROM universities_courses_offers WHERE univ_course_id='" . $_POST['studUniversityCourseName'] . "'", "course_id");
    $fetchData = FETCH_DATA("SELECT * FROM courses   WHERE course_id='$fetchCourseId'");

    if(isset($fetchData)){
       $BeforDiscountCourseFee =$fetchData['course_total_fees'];
        $discountAmount = $_POST['discountAmount'];
        $DiscountType = $_POST['DiscountType'];
        if ($DiscountType == "Percentage" && $_POST['discountMode'] == "TotalFee" && !empty($discountAmount)) {
            $NewDiscountPercentageAmount = ($discountAmount / 100) * $BeforDiscountCourseFee;
            $NewStudentCourseFeeAmount = $BeforDiscountCourseFee - $NewDiscountPercentageAmount;
            $totalDiscountWord = "Course Total";
            $amount = "Percentage";
            $sign = "%";
        } elseif ($DiscountType == "Percentage" && $_POST['discountMode'] == "1st Semester" && !empty($discountAmount)) {
            $semeseterWise  = explode(",", $fetchData['fee_mode_semester_wise']);
            $semeseterWiseFee  = explode(",", $fetchData['semester_wise_fee']);
            foreach ($semeseterWise as $key => $semval) {
                if ($semval == "1") {
                    $FirstSemesterTotalFee = $semeseterWiseFee[$key];
                }
            }
            $NewDiscountPercentageAmount = ($discountAmount / 100) * $FirstSemesterTotalFee;
            $NewStudentCourseFeeAmount = $FirstSemesterTotalFee - $NewDiscountPercentageAmount;
            $totalDiscountWord = "1st Semester Total";
            $amount = "Percentage";
            $sign = "%";
        } elseif ($DiscountType == "Amount" && $_POST['discountMode'] == "1st Semester" && !empty($discountAmount)) {
            $semeseterWise  = explode(",", $fetchData['fee_mode_semester_wise']);
            $semeseterWiseFee  = explode(",", $fetchData['semester_wise_fee']);
            foreach ($semeseterWise as $key => $semval) {
                if ($semval == "1") {
                    $FirstSemesterTotalFee = $semeseterWiseFee[$key];
                }
            }
            $NewDiscountPercentageAmount = ($FirstSemesterTotalFee - $discountAmount);
            $NewStudentCourseFeeAmount =  $NewDiscountPercentageAmount;
            $totalDiscountWord = "1st Semester Total";
            $amount = "Amount";
            $sign = "";
        } elseif ($DiscountType == "Amount" && $_POST['discountMode '] == "TotalFee" && !empty($discountAmount)) {
            $NewDiscountPercentageAmount = ($BeforDiscountCourseFee - $discountAmount);
            $NewStudentCourseFeeAmount = $NewDiscountPercentageAmount;
            $totalDiscountWord = "Course Total";
            $amount = "Amount";
            $sign = "";
        }
        if (!empty($NewDiscountPercentageAmount)) {
            $output .= '<h5 class="bold text-center">' . '<span class="text-muted">' . "After Discount Course Total Fee" . '</span>' . '</h5>
        <h5 class="bold">' . '<span class="text-muted">' . "Course Name:-" . '</span>' . $fetchData['course_name'] . '</h5>
            <p class="mb-0" >' . '<span class="text-muted">' . "Branch Name:-" . '</span>' . $fetchData['course_specialization'] . "<br>" .
                '<span class="text-muted">' . "Course Session Year:-" . '</span>' . $fetchData['course_session_year'] . "<br>" .
                '<span class="text-muted">' . "Course Type:-" . '</span>' .
                $fetchData['course_type'] . "<br>" . '<span class="text-muted">' .
                "Total Years:-" . '</span>' . $fetchData['course_total_years'] . "<br>" .
                '<span class="text-muted">' . "Total Semester:-" . '</span>' . $fetchData['course_total_semester'] . "<br>" . '<span class="text-muted">' .
                "Total Discount $amount:-" . '</span>' . $discountAmount . "$sign" . "<br>" . '<span class="text-muted">' .
                "$totalDiscountWord  Amount:-" . '</span>' . $NewDiscountPercentageAmount . "<br>" . '<span class="text-muted">' .
                "After Discount $totalDiscountWord Fees:-" . $NewStudentCourseFeeAmount . '</p>';
        } else {
            $output .= 'On Data Found';
        }

    }else{
        $output .= 'On Data Found';
    }
    echo $output;
}
//Student View University Details IN View page
// Fetching Course Session Years
if (isset($_POST['studUniBtnView']) == "view") {
    $output = " ";
    $fetchUnivercitySessionYear = FETCH_DB_TABLE("SELECT * FROM universities_primary_details AS upd INNER JOIN 	universities_session_years AS usy ON upd.university_id = usy.university_id WHERE upd.university_id='" . $_POST['studUniversityId'] . "' AND upd.university_status= '1'", true);
    if (isset($fetchUnivercitySessionYear)) {
        $output .= '<option>choose session year</option>';
        foreach ($fetchUnivercitySessionYear as $value) {
            if ($value->univ_session_id == FETCH("SELECT univ_session_id FROM students_university_courses WHERE student_id='" . $_POST['studentId'] . "'", "univ_session_id")) {
                $Selected = "selected";
            } else {
                $Selected = "";
            }
            $output .= '<option value="' . $value->univ_session_id . '" ' . $Selected . '>' . $value->univ_session_name . '</option>';
        }
    }
    echo $output;
}

// Fetching  Couses List
if (isset($_POST['studUnversitySessionYearBtnView']) == "submit") {
    $output = " ";

    $fetchStudUnivercityCourseId = FETCH("SELECT univ_courses_id FROM  students_university_courses WHERE student_id='" . $_POST['studentId'] . "'", "univ_courses_id");

    // echo "<pre>";
    // print_r($fetchUnivercitySessionYear);
    // die;
    $fetchUnivercityCourses = FETCH_DB_TABLE("SELECT * FROM univ_session_course AS usc INNER JOIN universities_courses AS uc ON usc.univ_course_id=uc.univ_course_id WHERE usc.university_id='" . $_POST['studUniversityId'] . "' AND usc.univ_session_id='" . $_POST['universitySessionId'] . "'", true);
    if (isset($fetchUnivercityCourses)) {
        $output .= '<option>choose course</option>';
        foreach ($fetchUnivercityCourses as $value) {
            if ($value->univ_course_id == $fetchStudUnivercityCourseId) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $output .= '<option value="' . $value->univ_course_id . '" ' . $selected . ' >' . $value->univ_course_name . '</option>';
        }
    }
    echo $output;
}
// Fetching Course Specialization
if (isset($_POST['studUnversityCourseSepcBtnView']) == "submit") {
    $output = " ";
    $fetchStudentSpecId = FETCH("SELECT univ_course_specialization_id FROM students_university_courses WHERE student_id='" . $_POST['studentId'] . "'", "univ_course_specialization_id");

    $fetchUnivercitySessionYear = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['univCourseId'] . "' ", true);
    if (isset($fetchUnivercitySessionYear)) {
        $output .= '<option>choose course specialization</option>';
        foreach ($fetchUnivercitySessionYear as $val) {
            if ($val->univ_specialization_id == $fetchStudentSpecId) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $output .= '<option value="' . $val->univ_specialization_id  . '" ' . $selected . '>' . $val->univ_course_specialization_name . '</option>';
        }


        echo $output;
    }
}

//Fetching Couses Details And  Course fee
if (isset($_POST['UniversityCourseBtns']) == "UniversityCourseChangeOption") {
    $CoursesDetailOutPut = " ";
    $fetchStudFeesId = FETCH("SELECT univ_course_specialization_fee_id FROM students_university_courses WHERE student_id='" . $_POST['StudentId'] . "'", "univ_course_specialization_fee_id");

    $fetchStudFeesModeType = FETCH("SELECT fee_mode FROM stud_fees_modes WHERE student_id='" . $_POST['StudentId'] . "'", "fee_mode");

    $fetchData = FETCH_DATA("SELECT * FROM universities_courses_specializations_fees AS ucs INNER JOIN universities_courses AS uc ON uc.univ_course_id =ucs.univ_course_id INNER JOIN universities_session_years AS usy ON usy.univ_session_id=ucs.univ_session_id INNER JOIN universities_courses_specializations AS ucse ON ucse.univ_specialization_id=ucs.university_specialization_id WHERE ucs.university_specialization_id = '" . $_POST['UniversityCourseSpecName'] . "' AND ucs.university_id = '" . $_POST['studUniversityName'] . "' AND ucs.univ_session_id = '" . $_POST['UniversitySessionId'] . "' AND ucs.univ_course_id = '" . $_POST['UniversityCourseId'] . "' OR ucs.university_specialization_id='$fetchStudFeesId' OR ucs.univ_course_spec_fee_mode_type='$fetchStudFeesModeType'");
    if (isset($fetchData)) {

        if ($fetchData['univ_course_spec_fee_mode_type'] == "Semesters Wise") {
            $feeModeWise = explode(",", $fetchData['univ_course_spec_fee_name']);
            $fees = explode(",", $fetchData['univ_course_spec_fee_value']);
        } elseif ($fetchData['univ_course_spec_fee_mode_type'] == "Years Wise") {
            $feeModeWise = explode(",", $fetchData['univ_course_spec_fee_name']);
            $fees = explode(",", $fetchData['univ_course_spec_fee_value']);
        } else {
            $feeModeWise = explode(",", $fetchData['univ_course_spec_fee_name']);
            $fees = explode(",", $fetchData['univ_course_spec_fee_value']);
        }


        $CoursesDetailOutPut .= '<h5 class="bold">' . '<span class="text-muted">' . "Fees Payment Mode:-" . '</span>' . $fetchData['univ_course_spec_fee_mode_type'] .
            '</h5>
            <p class="mb-0">' .
            '<span class="text-muted">' . "Course Session Year:-" . '</span>' . $fetchData['univ_session_name'] . "<br>" .
            '<span class="text-muted">' . "Course Name:-" . '</span>' . $fetchData['univ_course_name'] . "<br>" .
            '<span class="text-muted">' . "Course Specilization Name:-" . '</span>' . $fetchData['univ_course_specialization_name'] . "<br>" .
            '<span class="text-muted">' . "Total Semester:-" . '</span>' . $fetchData['univ_course_total_semester'] . "<br>" .
            '<span class="text-muted">' . "Total Years:-" . '</span>' . $fetchData['univ_course_total_year'] . "<br>" .
            '<span class="text-muted">' . "Course Fee Payment Mode:-" . '</span>' . $fetchData['univ_course_spec_fee_mode_type'] . "<br>";
        if ($fetchData['univ_course_spec_fee_mode_type'] == "Semesters Wise") {
            $FeesModeType = "Semester";
        } elseif ($fetchData['univ_course_spec_fee_mode_type'] == "Years Wise") {
            $FeesModeType = "Year";
        } elseif ($fetchData['univ_course_spec_fee_mode_type'] == "One Time") {
            $FeesModeType = "One Time";
        }
        $TotalFees = 0;
        foreach ($feeModeWise as $key => $feeModeVal) {

            $TotalFees += $fees[$key];
            $CoursesDetailOutPut .= '<span class="text-muted">' . $FeesModeType . " " . $feeModeVal . " => " . '</span>' . "Rs." . $fees[$key] . ", ";
        }
        $CoursesDetailOutPut .= '<br><span class="text-muted">' . "Total Fees => " . '</span>' . "Rs." . $fees[$key];
    }
    echo $CoursesDetailOutPut;
}

// Fetching  Couses List
if (isset($_POST['studUnversitySessionYearBtnEdit']) == "submit") {
    $output = " ";

    $fetchStudUnivercityCourseId = FETCH("SELECT univ_courses_id FROM  students_university_courses WHERE student_id='" . $_POST['StudentId'] . "'", "univ_courses_id");
    $fetchUnivercityCourses = FETCH_DB_TABLE("SELECT * FROM univ_session_course AS usc INNER JOIN universities_courses AS uc ON usc.univ_course_id=uc.univ_course_id WHERE usc.university_id='" . $_POST['studUniversityId'] . "' AND usc.univ_session_id='" . $_POST['universitySessionId'] . "'", true);
    if (isset($fetchUnivercityCourses)) {
        $output .= '<option>choose course</option>';
        foreach ($fetchUnivercityCourses as $value) {
            if ($value->univ_course_id == $fetchStudUnivercityCourseId) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $output .= '<option value="' . $value->univ_course_id . '" ' . $selected . ' >' . $value->univ_course_name . '</option>';
        }
    }
    echo $output;
}
//Filter List Changes
if (isset($_POST['studUniBtnFilter']) == "submit") {
    $output = " ";
    $fetchUnivercitySessionYear = FETCH_DB_TABLE("SELECT * FROM universities_primary_details AS upd INNER JOIN 	universities_session_years AS usy ON upd.university_id = usy.university_id WHERE upd.university_id='" . $_POST['studUniversityId'] . "' ", true);
    if (isset($fetchUnivercitySessionYear)) {
        $output .= '<option value="">choose session year</option>';
        foreach ($fetchUnivercitySessionYear as $value) {
            $output .= '<option value="' . $value->univ_session_id . '" data-uniid="' . $value->university_id . '">' . $value->univ_session_name . '</option>';
        }
    }
    echo $output;
}
// Fetching  Couses List
if (isset($_POST['studUnversitySessionYearBtnFilter']) == "submit") {
    $output = " ";
    // SessionYearId
    $fetchUnivercitySessionYear = FETCH_DB_TABLE("SELECT * FROM univ_session_course AS usc INNER JOIN universities_courses AS uc ON usc.univ_course_id=uc.univ_course_id WHERE usc.university_id='" . $_POST['studUniversityId'] . "' AND usc.univ_session_id='" . $_POST['SessionYearId'] . "'", true);
    if (isset($fetchUnivercitySessionYear)) {
        $output .= '<option value="">choose course</option>';
        foreach ($fetchUnivercitySessionYear as $value) {
            $output .= '<option value="' . $value->univ_course_id . '">' . $value->univ_course_name . '</option>';
        }
    }
    echo $output;
}
// Fetching Course Specialization
if (isset($_POST['studUnversityCourseSepcBtnFilter']) == "submit") {
    $output = " ";
    $fetchUnivercitySessionYear = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['univCourseId'] . "'", true);
    if (isset($fetchUnivercitySessionYear)) {
        $output .= '<option value="">choose course specialization</option>';
        foreach ($fetchUnivercitySessionYear as $val) {
            $output .= '<option value="' . $val->univ_specialization_id . '">' . $val->univ_course_specialization_name . '</option>';
        }
        echo $output;
    }
}
if (isset($_POST['loadTableData'])) {
    $pageSize = 5; // Number of records to display per page
    $currentPage = isset($_POST['page']) ? $_POST['page'] : 1; // Current page, default to 1

    // Calculate the offset based on the current page and page size
    $offset = ($currentPage - 1) * $pageSize;

    // Get filter criteria from the POST request
    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
    if (!empty($filters['universalSearch'])) {
        // Query to fetch data for the current page
        $query =
            "SELECT * FROM students_primary_details AS spd
            INNER JOIN students_university_courses AS suc ON spd.student_id=suc.student_id
            INNER JOIN universities_primary_details AS upd ON upd.university_id=suc.university_id
            INNER JOIN students_registration_details AS srd ON srd.student_id =spd.student_id
            INNER JOIN universities_session_years AS usy ON suc.univ_session_id=usy.univ_session_id
            INNER JOIN universities_courses AS uc ON suc.univ_courses_id=uc.univ_course_id
            INNER JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id
             WHERE spd.student_full_name LIKE '%" . $filters['universalSearch'] . "%'
            OR spd.student_phone_no LIKE '%" . $filters['universalSearch'] . "%'
            OR spd.student_alt_phone_no LIKE '%" . $filters['universalSearch'] . "%'
            OR spd.student_email_id LIKE '%" . $filters['universalSearch'] . "%'
            OR spd.student_alt_email_id LIKE '%" . $filters['universalSearch'] . "%'
            OR spd.student_gender LIKE '%" . $filters['universalSearch'] . "%'
            OR upd.university_name LIKE '%" . $filters['universalSearch'] . "%'
            OR upd.university_phone_no LIKE '%" . $filters['universalSearch'] . "%'
            OR upd.university_email_id LIKE '%" . $filters['universalSearch'] . "%'
            OR usy.univ_session_name LIKE '%" . $filters['universalSearch'] . "%'
            OR uc.univ_course_name LIKE '%" . $filters['universalSearch'] . "%'
            OR uc.univ_course_type LIKE '%" . $filters['universalSearch'] . "%'
            OR uc.univ_course_total_semester LIKE '%" . $filters['universalSearch'] . "%'
            OR uc.univ_course_total_year LIKE '%" . $filters['universalSearch'] . "%'
            OR ucs.univ_course_specialization_name LIKE '%" . $filters['universalSearch'] . "%'
            ";
    } else {
        // Query to fetch data for the current page
        $query = "SELECT * FROM students_primary_details AS spd
            INNER JOIN students_university_courses AS suc ON spd.student_id=suc.student_id
            INNER JOIN universities_primary_details AS upd ON upd.university_id=suc.university_id
            INNER JOIN students_registration_details AS srd ON srd.student_id =spd.student_id
            INNER JOIN universities_session_years AS usy ON suc.univ_session_id=usy.univ_session_id
            INNER JOIN universities_courses AS uc ON suc.univ_courses_id=uc.univ_course_id
            INNER JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id WHERE spd.student_status LIKE '%%' ";
    }

    if (!empty($filters['fullName'])) {
        $query .= " AND (spd.student_full_name LIKE '%" . $filters['fullName'] . "%')";
    }

    if (!empty($filters['phone'])) {
        $query .= " AND (spd.student_phone_no LIKE '%" . $filters['phone'] . "%' OR spd.student_alt_phone_no LIKE '%" . $filters['phone'] . "%')";
    }

    if (!empty($filters['email'])) {
        $query .= " AND (spd.student_email_id LIKE '%" . $filters['email'] . "%' OR spd.student_alt_email_id LIKE '%" . $filters['email'] . "%')";
    }

    if (isset($filters['university']) && $filters['university'] !== '') {
        $query .= " AND upd.university_id LIKE '%" . intval($filters['university']) . "%'";
    }

    if (isset($filters['session']) && $filters['session'] !== '') {
        $query .= " AND usy.univ_session_id LIKE '%" . intval($filters['session']) . "%'";
    }

    if (isset($filters['course']) && $filters['course'] !== '') {
        $query .= " AND uc.univ_course_id LIKE '%" . intval($filters['course']) . "%'";
    }

    if (isset($filters['specilization']) && $filters['specilization'] !== '') {
        $query .= " AND ucs.univ_specialization_id LIKE '%" . intval($filters['specilization']) . "%'";
    }

    if (!empty($filters['studentRegNo'])) {
        $query .= " AND srd.stud_reg_no LIKE '%" . $filters['studentRegNo'] . "%'";
    }

    if (!empty($filters['regState'])) {
        $query .= " AND srd.stud_reg_status LIKE '%" . $filters['regState'] . "%'";
    }

    if (isset($filters['status']) && $filters['status'] !== '') {
        $query .= " AND spd.student_status LIKE '%" . intval($filters['status']) . "%'";
    }


    if (!empty($filters['studentDOB'])) {
        $query .= " AND spd.student_date_birth LIKE '%" . $filters['studentDOB'] . "%'";
    }
    if (!empty($filters['filterByDate'])) {
        if ($filters['filterByDate'] == "DOA") {
            if (!empty($filters['createdFromDate']) && !empty($filters['createdToDate'])) {
                // Assuming 'fromDate' and 'toDate' are in the format 'YYYY-MM-DD'
                $fromDate = $filters['createdFromDate'];
                $toDate = $filters['createdToDate'];

                // Modify the query to filter by date range
                $query .= " AND srd.stud_dof_admission BETWEEN '" . $fromDate . "' AND '" . $toDate . "'";
            }
        } elseif ($filters['filterByDate'] == "PaymentDate") {
            if (!empty($filters['paymentMode'])) {
                $query .= " AND srd.stud_fee_payment_mode LIKE'%" . $filters['paymentMode'] . "%'";
            }
            if (!empty($filters['createdFromDate']) && !empty($filters['createdToDate'])) {
                // Assuming 'fromDate' and 'toDate' are in the format 'YYYY-MM-DD'
                $fromDate = $filters['createdFromDate'];
                $toDate = $filters['createdToDate'];

                // Modify the query to filter by date range
                $query .= " AND srd.stud_payment_date BETWEEN '" . $fromDate . "' AND '" . $toDate . "'";
            }
        } else {
            ///
        }
    } else {
        if (!empty($filters['createdFromDate']) && !empty($filters['createdToDate'])) {
            // Assuming 'fromDate' and 'toDate' are in the format 'YYYY-MM-DD'
            $fromDate = $filters['createdFromDate'];
            $toDate = $filters['createdToDate'];

            // Modify the query to filter by date range
            $query .= " AND spd.created_at BETWEEN '" . $fromDate . " 00:00:00' AND '" . $toDate . " 23:59:59'";
        }
    }
    if (!empty($filters['paymentMode'])) {
        $query .= " AND srd.stud_fee_payment_mode LIKE'%" . $filters['paymentMode'] . "%'";
    }

    //Count Total PAGE FOR PAGNATION
    $pagnationQuery = $query;
    // Add LIMIT and OFFSET for pagination
    $query .= " LIMIT $pageSize OFFSET $offset";
    // echo $query;
    // die;
    // Fetch data from the database
    $FetchStudentData = FETCH_DB_TABLE($query, true);

    $output = "";
    $output .= '<table class="table  table-sm mb-2" id="table-data">
            <thead>
                <tr>
                    <th scope="col">S.No <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">StudentsName <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">StudentsPhone <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">University <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Session Years <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">CourseName <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Specialization <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">StudentReg. <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Status <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Action <i class="fa-regular fa-sort sort-icon"></i></th>
                     </tr>
            </thead>
            <tbody >';
    if ($FetchStudentData) {
        $Sno = 0;
        foreach ($FetchStudentData as $value) {
            $Sno++;
            if ($value->student_status == "1") {
                $Status = "Active";
                $StatusClass = "success";
            } else {
                $Status = "Inactive";
                $StatusClass = "danger";
            }
            if ($value->stud_reg_status == "Addimmision done") {
                $style = "background-color: #b9f3a3;";
            } elseif ($value->stud_reg_status == "Registration Pending") {
                $style = "background-color: #ff9b9b;";
            } elseif ($value->stud_reg_status == "Registration Closed") {
                $style = "background-color: #e7ddce;";
            } elseif ($value->stud_reg_status == "Registration Open") {
                $style = "background-color: #f3c68a;";
            } else {
                $style = "";
            }
            $output .= '
             <tr>
                <th scope="row">' . $value->student_id . '</th>
                <td><a href="' . ADMIN_URL . '/account/students/view.php?id=' . $value->student_id . '" class="view-bdes-link">' . $value->student_full_name .  '</a></td>
                <td>' . $value->student_phone_no . '</td>

                <td>' . $value->university_name . '</td>
                 <td>' . $value->univ_session_name . '</td>
                  <td>' . $value->univ_course_name . '</td>
                  <td>' . $value->univ_course_specialization_name . '</td>
                  <td style="padding-top: 5px !important;"><span class="td-style" style="' . $style . '">' . $value->stud_reg_status . '</span></td>
                   <td><button type="button" class="btn btn-' . $StatusClass . ' status-changes-btn" value="' . $value->student_id . '" style="padding:0.09rem 0.3rem">' . $Status . '</button></td>
                <td>
                    <a href="' . ADMIN_URL . '/account/students/view.php?id=' . $value->student_id . '" class="text-info"><i class=\'bi bi-eye-fill\'></i></a>
                    <a href="' . ADMIN_URL . '/account/students/edit.php?eid=' . SECURE($value->student_id, "e") . '" class="text-primary"><i class=\'bi bi-pencil-fill\'></i></a>
                </td>
            </tr>
             ';
        }
    } else {
        $output .=
            '<tr>
            <td></td>
            <td>No Record Found<td></tr>
             ';
    }
    $output .= '</tbody>
        </table>';

    // Fetch the total number of records for pagination
    if (isset($_POST['filters'])) {
        $totalRecords = TOTAL($pagnationQuery);
    } else {
        $totalRecords = TOTAL("SELECT spd.student_id FROM students_primary_details AS spd
                            INNER JOIN students_university_courses AS suc ON spd.student_id=suc.student_id
                            INNER JOIN universities_primary_details AS upd ON upd.university_id=suc.university_id
                            INNER JOIN students_registration_details AS srd ON srd.student_id =spd.student_id
                            INNER JOIN universities_session_years AS usy ON suc.univ_session_id=usy.univ_session_id
                            INNER JOIN universities_courses AS uc ON suc.univ_courses_id=uc.univ_course_id
                            INNER JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id");
    }

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $pageSize);
    // Generate pagination links
    if ($totalPages >= 1) {
        $output .= '
        <ul class="pagination">';

        // Previous Page Link
        if ($currentPage > 1) {
            $prevPage = $currentPage - 1;
            $output .= '<li class="page-item"><a class="page-link pagination-link student-pagination-link" href="#" data-page="' . $prevPage . '">Previous</a></li>';
        }

        // Numbered Page Links
        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $currentPage) ? 'active' : '';
            $output .= '<li class="page-item ' . $activeClass . '"><a class="page-link pagination-link student-pagination-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
        }

        // Next Page Link
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $output .= '<li class="page-item"><a class="page-link pagination-link student-pagination-link" href="#" data-page="' . $nextPage . '">Next</a></li>';
        }

        $output .= '</ul>';
    }


    // Send the generated HTML as a response
    echo $output;
}