
<?php
$Dir = "../";

//add controller helper files
require $Dir . '/require/modules.php';
//add aditional requirements
require $Dir . 'require/admin/access-control.php';
//========================>Ajax POst Request Start Here<================================//
if (isset($_POST['CourseSessionYearsBtn']) == "Submit") {
    $fetchData = FETCH_DB_TABLE("SELECT course_id,course_session_year FROM courses WHERE  course_status='1'", true);
    $output = "";
    if (isset($fetchData)) {
        $output .= '<option>choose course session year</option>';
        foreach ($fetchData as $val) {
            $output .= '<option value="' . $val->course_session_year . '" data-id="' . $val->course_id . '">' . $val->course_session_year . '</option>';
        }
        echo $output;
    } else {
        echo '<option>choose course session year</option>';
    }
}
if (isset($_POST['CourseSessionBtn']) == "submit") {

    $CourseSessionYearId = $_POST['CourseSessionYearId'];
    $fetchData = FETCH_DB_TABLE("SELECT course_id,course_name FROM courses WHERE course_id='$CourseSessionYearId' AND course_status='1'", true);
    $output = "";

    if (isset($fetchData)) {
        $output .= '<option>choose course name</option>';
        foreach ($fetchData as $val) {
            $output .= '<option value="' . $val->course_name . '" data-id="' . $val->course_id . '">' . $val->course_name . '</option>';
        }
        echo $output;
    } else {
        echo '<option>choose course name</option>';
    }
} elseif (isset($_POST['CourseNameBtn'])) {
    $CourseNameId = $_POST['CourseNameId'];
    $fetchData = FETCH_DB_TABLE("SELECT course_id,course_specialization FROM courses WHERE course_id='$CourseNameId' AND course_status='1'", true);
    $CourseOutPut = "";
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            $CourseSpecialization = $val->course_specialization;
        }
        $CourseSpecializationList = explode(",", $CourseSpecialization);
        foreach ($CourseSpecializationList as $val) {

            $CourseOutPut .= '<option value="' . $val . '" selected>' . $val . '</option>';
        }
        echo $CourseOutPut;
    } else {
    }
}
//Update Code
if (isset($_POST['UpdateCourseSessionBtn']) == "UpdateCourse") {

    $CourseSessionYearId = $_POST['CourseSessionYearId'];
    $universityId        = $_POST['universityId'];
    $fetchUniversityCourese = FETCH("SELECT univ_course_name FROM universities_courses_offers WHERE univ_course_id='$universityId' AND univ_course_status='1'", "univ_course_name");
    $fetchData = FETCH_DB_TABLE("SELECT course_id,course_name FROM courses WHERE course_id='$CourseSessionYearId' AND course_status='1'", true);
    $output = "";

    if (isset($fetchData)) {
        $output .= '<option>choose course name</option>';
        foreach ($fetchData as $val) {
            if (trim($fetchUniversityCourese) == $val->course_name) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $output .= '<option value="' . $val->course_name . '" data-id="' . $val->course_id . '"' . $selected . '>' . $val->course_name . '</option>';
        }
        echo $output;
    } else {
        echo '<option>choose course name</option>';
    }
} elseif (isset($_POST['UpdateCourseNameBtn']) == "UpdateCourseSpecialization") {
    $CourseNameId = $_POST['CourseNameId'];
    $universityId        = $_POST['universityId'];
    $fetchUniversityCourese = FETCH("SELECT univ_course_specialization FROM universities_courses_offers WHERE univ_course_id='$universityId' AND univ_course_status='1'", "univ_course_specialization");
    $fetchData = FETCH_DB_TABLE("SELECT course_id,course_specialization FROM courses WHERE course_id='$CourseNameId' AND course_status='1'", true);
    $DBUniversityCourses = explode(",", $fetchUniversityCourese);
    foreach ($DBUniversityCourses as $data) {
        $DBCoursesArray[] = trim(html_entity_decode($data));
    }

    $CourseOutPut = "";
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            $CourseSpecialization = $val->course_specialization;
        }
        $CourseSpecializationList = explode(",", $CourseSpecialization);
        foreach ($CourseSpecializationList as $val) {
            if (in_array(trim(html_entity_decode($val)), $DBCoursesArray)) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $CourseOutPut .= '<option value="' . $val . '"' . $selected . '>' . $val . '</option>';
        }
        echo $CourseOutPut;
    } else {
    }
}

// List All Session Course Details In University View Details Page
if (isset($_POST['coursesViewDetailsBtn'])) {
    //Courses Name
    $courses = FETCH_DB_TABLE("SELECT * FROM univ_session_course AS usc JOIN universities_courses AS uc ON usc.univ_course_id = uc.univ_course_id WHERE usc.univ_session_id='" . $_POST["sessionId"] . "' AND uc.university_id='" . $_POST['universityId'] . "'", true);
    $output = '';
    if (isset($courses)) {
        $firstCourses = true;
        foreach ($courses as $course) {
            $isActive = $firstCourses ? 'active' : '';
            $output .= '<div class="card shadow p-3 bg-white rounded courses-card ' . $isActive . '" data-courseid="' . $course->univ_course_id . '" style="margin-bottom:4px !important; cursor: pointer;" ><span style="    font-weight: 900;" >' . $course->univ_course_name . '</span>
            <span class="d-flex justify-content-between"><span class="fs-10" style=" font-weight: 900;"><i class="fa-solid fa-graduation-cap text-yellow" style="padding-right: 4px;"></i>' . $course->univ_course_type . '</span>
            <span class="fs-10"  style="font-weight: 900;"><i class="fa-solid fa-calendar"style="padding-right: 4px;"></i>' . $course->univ_course_total_year . " Years" . '</span>
            <span class="fs-10" style="font-weight: 900;"><i class="fa-solid fa-clock"style="padding-right: 4px;"></i>' . $course->univ_course_total_semester . " Semesters" . '</span></span></div>';
            $firstCourses = false;
        }
        echo $output;
    } else {
        $output .= '<div class="card shadow p-3 bg-white rounded specilization-card " style="margin-bottom:4px !important; cursor: pointer;" ><span class="text-center " style="font-weight: 900;">No Data Found</span></div>';
        echo $output;
    }
}

// List All Session Course Specilization Details In University View Details Page
if (isset($_POST['specilizationViewDetailsBtn'])) {

    //Courses Name
    $courses = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['courseId'] . "'", true);
    $output = '';
    if (isset($courses)) {
        $firstSpecilization = true;
        foreach ($courses as $course) {
            $isActive = $firstSpecilization ? 'active' : '';
            $output .= '<div class="card shadow p-3 bg-white rounded specilization-card ' . $isActive . '" style="margin-bottom:4px !important; cursor: pointer;" data-specilizationid="' . $course->univ_specialization_id . '"><span style="font-weight: 900;">' . $course->univ_course_specialization_name . '</span></div>';
            $firstSpecilization = false;
        }
        echo $output;
    } else {
        $output .= '<div class="card shadow p-3 bg-white rounded specilization-card " style="margin-bottom:4px !important; cursor: pointer;" ><span class="text-center " style="font-weight: 900;">No Data Found</span></div>';
        echo $output;
    }
}
// List All Session Course Specilization Fee Type Option (Course/Tutition Fee) View Details Page
if (isset($_POST['specilizationFeesViewDetailsBtn'])) {
    $output = '';
    $output .= '
            <div class="row">
            <div class="col-md-6">
            <div class="card shadow p-2 bg-white rounded course-fee-btn active" data-coursetype="courseFees" style="margin-bottom:4px !important; cursor: pointer;" >
            <span style="font-weight: 900;">Course Fee</span>
            </div>
             </div>
            <div class="col-md-6">
            <div class="card shadow p-2 bg-white rounded course-fee-btn" data-coursetype="tutitionFees" style="margin-bottom:4px !important; cursor: pointer;">
            <span style="font-weight: 900;">Tutition Fee</span>
            </div>
              </div>
              <div class="col-md-12 ">
              <div class="card shadow p-2" id="courseFeesTypeDetails">
              </div>
              </div>
            </div>';
    echo $output;
}
// List All Session Course Specilization Fee (Course/Tutition Fee) View Details Page
if (isset($_POST['specilizationFeesTypeViewDetailsBtn'])) {
    $output = '';
    if ($_POST['courseFeesType'] == "courseFees") {
        if (!empty($_POST['specilizationId'])) {
            $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['specilizationId'] . "'", true);
        }
    } elseif ($_POST['courseFeesType'] == "tutitionFees") {
        if (!empty($_POST['specilizationId'])) {
            $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_tutition_fees WHERE university_specialization_id='" . $_POST['specilizationId'] . "'", true);
        }
    }
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

            $output  .= '<div class="card shadow p-2 " id="courseFeesTypeDetails" style="margin-bottom:8px !important;"><h5 class="bold">' . '<span class="text-muted">' . "Fee Mode:- " . '</span>' . $data->univ_course_spec_fee_mode_type .
                '</h5>
             <p class="mb-0">' .
                '<span class="text-muted">';
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
                $output  .= '<span class="text-muted">' . $FeesModeType . " " . $feeModeVal . " => " . '</span>' . "Rs." . $fees[$key] . "<br> ";
            }
            $output  .= '<br><span class="text-muted">Total Fees => </span> ' . "Rs." . $TotalFees . '</div>';
        }
        echo  $output;
    } else {
        $output .= '<div class="card shadow p-3 bg-white rounded specilization-card " style="margin-bottom:4px !important; cursor: pointer;" ><span class="text-center " style="font-weight: 900;">No Data Found</span></div>';
        echo $output;
    }
}

//Load Table Data With Pagnation And Filter
if (isset($_POST['loadTableData'])) {
    $pageSize = 5; // Number of records to display per page
    $currentPage = isset($_POST['page']) ? $_POST['page'] : 1; // Current page, default to 1

    // Calculate the offset based on the current page and page size
    $offset = ($currentPage - 1) * $pageSize;

    // Get filter criteria from the POST request
    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];

    // Query to fetch data for the current page
    if (!empty($filters['universalSearch'])) {
        // Query to fetch data for the current page
        $query = "SELECT upd.*, COUNT(DISTINCT uc.univ_course_id) AS total_courses, COUNT(DISTINCT
        ucs.univ_specialization_id) AS total_specializations FROM universities_primary_details
        AS upd LEFT JOIN universities_session_years AS usy ON usy.university_id=upd.university_id
        LEFT JOIN universities_courses AS uc ON upd.university_id = uc.university_id LEFT
        JOIN univ_session_course AS usc  ON usc.univ_course_id=uc.univ_course_id LEFT JOIN
        universities_courses_specializations AS ucs ON uc.univ_course_id = ucs.univ_course_id
        WHERE  upd.university_name LIKE '%" . $filters['universalSearch'] . "%'";
    } elseif (isset($_POST['filters'])) {
        $query = "SELECT upd.*, COUNT(DISTINCT uc.univ_course_id) AS total_courses, COUNT(DISTINCT ucs.univ_specialization_id) AS total_specializations FROM universities_primary_details AS upd LEFT JOIN 	universities_session_years AS usy ON usy.university_id=upd.university_id  LEFT JOIN universities_courses AS uc ON upd.university_id = uc.university_id LEFT JOIN univ_session_course AS usc  ON usc.univ_course_id=uc.univ_course_id LEFT JOIN universities_courses_specializations AS ucs ON uc.univ_course_id = ucs.univ_course_id WHERE upd.university_status LIKE '%%' ";
    } else {
        $query = "SELECT upd.*, COUNT(DISTINCT uc.univ_course_id) AS total_courses, COUNT(DISTINCT ucs.univ_specialization_id) AS total_specializations FROM universities_primary_details AS upd LEFT JOIN universities_courses AS uc ON upd.university_id = uc.university_id LEFT JOIN universities_courses_specializations AS ucs ON uc.univ_course_id = ucs.univ_course_id GROUP BY upd.university_id";
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

    if (isset($filters['status']) && $filters['status'] !== '') {
        $query .= " AND upd.university_status LIKE '%" . intval($filters['status']) . "%'";
    }

    if (!empty($filters['createdFromDate']) && !empty($filters['createdToDate'])) {
        // Assuming 'fromDate' and 'toDate' are in the format 'YYYY-MM-DD'
        $fromDate = $filters['createdFromDate'];
        $toDate = $filters['createdToDate'];

        // Modify the query to filter by date range
        $query .= " AND upd.created_at BETWEEN '" . $fromDate . " 00:00:00' AND '" . $toDate . " 23:59:59'";
    }
    if (!empty($filters['feeMode'])) {
        $query .= " AND srd.stud_fee_payment_mode LIKE'%" . $filters['paymentMode'] . "%'";
    }

    //Count Total PAGE FOR PAGNATION
    $pagnationQuery = $query;
    // Add LIMIT and OFFSET for pagination
    if (isset($_POST['filters'])) {
        $query .= " GROUP BY upd.university_id LIMIT $pageSize OFFSET $offset";
        //  echo $query;
        // die;
    } else {

        $query .= " LIMIT $pageSize OFFSET $offset";
    }
    // Fetch data from the database
    $FetchStudentData = FETCH_DB_TABLE($query, true);

    $output = "";
    $output .= '<table class="table  table-sm mb-2" id="table-data">
            <thead>
                <tr>
                    <th scope="col">S.No <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">UniversityName <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">TotalCourses <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">TotalSpecilization <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">TotalStudents <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">StudentStatus <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">StudentReg. <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Status <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Action <i class="fa-regular fa-sort sort-icon"></i></th>
                     </tr>
            </thead>
            <tbody >';

    if ($FetchStudentData) {
        $Sno = 0;
        foreach ($FetchStudentData as $value) {
            $TotalStudent = 0;
            $StudentQuery = "";
            if (isset($_POST['filters'])) {
                if (isset($filters['university']) && $filters['university'] !== '') {
                    $StudentQuery .= " AND suc.university_id LIKE '%" . intval($filters['university']) . "%'";
                }

                if (isset($filters['session']) && $filters['session'] !== '') {
                    $StudentQuery .= " AND suc.univ_session_id LIKE '%" . intval($filters['session']) . "%'";
                }

                if (isset($filters['course']) && $filters['course'] !== '') {
                    $StudentQuery .= " AND suc.univ_courses_id LIKE '%" . intval($filters['course']) . "%'";
                }

                if (isset($filters['specilization']) && $filters['specilization'] !== '') {
                    $StudentQuery .= " AND suc.univ_course_specialization_id LIKE '%" . intval($filters['specilization']) . "%'";
                }
                if (!empty($filters['regState'])) {
                    $StudentQuery .= " AND srd.stud_reg_status LIKE '%" . $filters['regState'] . "%'";
                }

                if (isset($filters['studentStatus']) && $filters['studentStatus'] !== '') {
                    $StudentQuery .= " AND spd.student_status LIKE '%" . intval($filters['studentStatus']) . "%'";
                }
                if (!empty($filters['createdFromDate']) && !empty($filters['createdToDate'])) {
                    // Assuming 'fromDate' and 'toDate' are in the format 'YYYY-MM-DD'
                    $fromDate = $filters['createdFromDate'];
                    $toDate = $filters['createdToDate'];

                    // Modify the query to filter by date range
                    $query .= " AND spd.created_at BETWEEN '" . $fromDate . " 00:00:00' AND '" . $toDate . " 23:59:59'";
                }
                // var_dump("SELECT suc.*, spd.*,srd.*, COUNT(DISTINCT suc.student_id) AS total_students FROM students_university_courses AS suc LEFT JOIN students_primary_details AS spd ON suc.student_id = spd.student_id LEFT JOIN students_registration_details AS srd ON suc.student_id = srd.student_id WHERE suc.university_id = '" . $value->university_id . "' $StudentQuery   GROUP BY spd.student_id");die;
                $StudentData = FETCH_DB_TABLE("SELECT suc.*, spd.*,srd.*, COUNT(DISTINCT suc.student_id) AS total_students FROM students_university_courses AS suc LEFT JOIN students_primary_details AS spd ON suc.student_id = spd.student_id LEFT JOIN students_registration_details AS srd ON suc.student_id = srd.student_id WHERE suc.university_id = '" . $value->university_id . "' $StudentQuery   GROUP BY spd.student_id", true);
            } else {
                $StudentData = FETCH_DB_TABLE("SELECT suc.*, spd.*,srd.*, COUNT(DISTINCT suc.student_id) AS total_students FROM students_university_courses AS suc LEFT JOIN students_primary_details AS spd ON suc.student_id = spd.student_id LEFT JOIN students_registration_details AS srd ON suc.student_id = srd.student_id WHERE suc.university_id = '" . $value->university_id . "' AND srd.stud_reg_status='Registration Pending' GROUP BY spd.student_id", true);
            }
            if (isset($StudentData)) {
                foreach ($StudentData as $studentData) {
                    $studentStatus = $studentData->student_status;
                    $StudentRegStatus = $studentData->stud_reg_status;
                    $TotalStudent += $studentData->total_students;
                }
            } else {
                $studentStatus = "";
                $StudentRegStatus = "";
                $TotalStudent = "";
            }
            $Sno++;
            if ($value->university_status == "1") {
                $Status = "Addmission Open";
                $StatusClass = "success";
            } else {
                $Status = "Addmission Closed";
                $StatusClass = "danger";
            }
            if ($studentStatus == "1") {
                $StudStatus = "Active";
                $Studstyle = "background-color: #b9f3a3;";
            } elseif ($studentStatus == "0") {
                $StudStatus = "Inactive";
                $Studstyle = "background-color: #ff9b9b;";
            } else {
                $StudStatus = "Not Found";
                $Studstyle = "background-color:#ff9bf0;";
            }
            if ($StudentRegStatus == "Addimmision done") {
                $style = "background-color: #b9f3a3;";
                $studRegStatus = $StudentRegStatus;
            } elseif ($StudentRegStatus == "Registration Pending") {
                $style = "background-color: #ff9b9b;";
                $studRegStatus = $StudentRegStatus;
            } elseif ($StudentRegStatus == "Registration Closed") {
                $style = "background-color: #e7ddce;";
                $studRegStatus = $StudentRegStatus;
            } elseif ($StudentRegStatus == "Registration Open") {
                $style = "background-color: #f3c68a;";
                $studRegStatus = $StudentRegStatus;
            } elseif ($StudentRegStatus == "") {
                $style = "background-color:#ff9bf0;";
                $studRegStatus = "Not Found";
            }
            $output .= '
             <tr>
                <th scope="row">' . $Sno . '</th>

                <td><a href="' . ADMIN_URL . '/account/university/view.php?id=' . $value->university_id . '" class="text-info">' . $value->university_name . '</a></td>
                <td>(' . $value->total_courses . ')</td>
                <td>(' . $value->total_specializations . ')</td>
                <td>(' . $TotalStudent . ')</td>
                <td style="padding-top: 5px !important;"><span class="td-style" style="' . $Studstyle . '">' . $StudStatus . '</span></td>
                <td style="padding-top: 5px !important;"><span class="td-style" style="' . $style . '">' . $studRegStatus . '</span></td>

                <td><button type="button" class="btn btn-' . $StatusClass . ' status-changes-btn" value="' . $value->university_id . '" style="padding:0.09rem 0.3rem">' . $Status . '</button></td>
                <td>
                    <a href="' . ADMIN_URL . '/account/university/view.php?id=' . $value->university_id . '" class="text-info"><i class=\'bi bi-eye-fill\'></i></a>
                    <a href="' . ADMIN_URL . '/account/university/edit.php?eid=' . $value->university_id . '" class="text-primary"><i class=\'bi bi-pencil-fill\'></i></a>
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
        $totalRecords = TOTAL("SELECT upd.*, COUNT(DISTINCT uc.univ_course_id) AS total_courses, COUNT(DISTINCT ucs.univ_specialization_id) AS total_specializations FROM universities_primary_details AS upd LEFT JOIN universities_courses AS uc ON upd.university_id = uc.university_id LEFT JOIN universities_courses_specializations AS ucs ON uc.univ_course_id = ucs.univ_course_id GROUP BY upd.university_id");
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
            $output .= '<li class="page-item"><a class="page-link pagination-link university-pagination-link" href="#" data-page="' . $prevPage . '">Previous</a></li>';
        }

        // Numbered Page Links
        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $currentPage) ? 'active' : '';
            $output .= '<li class="page-item ' . $activeClass . '"><a class="page-link pagination-link university-pagination-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
        }

        // Next Page Link
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $output .= '<li class="page-item"><a class="page-link pagination-link university-pagination-link" href="#" data-page="' . $nextPage . '">Next</a></li>';
        }

        $output .= '</ul>';
    }


    // Send the generated HTML as a response
    echo $output;
}
