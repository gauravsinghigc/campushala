<?php
//add controller helper files
require __DIR__ . '/../require/modules.php';

//add aditional requirements
require '../require/admin/access-control.php';

if (isset($_POST['loadTableData'])) {
    $pageSize = 5; // Number of records to display per page
    $currentPage = isset($_POST['page']) ? $_POST['page'] : 1; // Current page, default to 1

    // Calculate the offset based on the current page and page size
    $offset = ($currentPage - 1) * $pageSize;

    // Get filter criteria from the POST request
    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];

    if (!empty($filters['regFees'])) {
        $query = "SELECT  *  FROM universities_primary_details AS upd
            LEFT JOIN universities_session_years AS usy ON upd.university_id=usy.university_id
            LEFT JOIN students_university_courses AS suc ON suc.univ_session_id=usy.univ_session_id
            LEFT JOIN students_primary_details AS spd ON spd.student_id=suc.student_id
            LEFT JOIN universities_courses AS uc ON uc.univ_course_id=suc.univ_courses_id
            LEFT JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id
            LEFT JOIN stud_fee_collects AS sfc ON sfc.student_id=spd.student_id
             WHERE sfc.payment_status LIKE '%%'
            ";
    } elseif (!empty($filters)) {
        $query = "SELECT  sfc.total_amount, spd.student_id,spd.student_full_name, upd.university_name, usy.univ_session_name,uc.univ_course_name,ucs.univ_course_specialization_name, sfc.fee_mode_name, sfc.fee_mode, sfc.university_id, sfc.session_id, sfc.course_id, sfc.specilization_id, sfc.specilization_fee_id, sum(sfc.paid_amount) AS totalPaidAmount,
         sum(sfc.discount_amount) AS totalDiscountAmount FROM universities_primary_details AS upd
            LEFT JOIN universities_session_years AS usy ON upd.university_id=usy.university_id
            LEFT JOIN students_university_courses AS suc ON suc.univ_session_id=usy.univ_session_id
            LEFT JOIN students_primary_details AS spd ON spd.student_id=suc.student_id
            LEFT JOIN universities_courses AS uc ON uc.univ_course_id=suc.univ_courses_id
            LEFT JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id
            LEFT JOIN stud_fee_collects AS sfc ON sfc.student_id=spd.student_id
            RIGHT JOIN stud_fees_modes AS sfm ON sfm.stud_fee_mode_id=sfc.stud_fee_mode_id WHERE sfc.payment_status LIKE '%%'
            ";
    } elseif (!empty($filters['universalSearch'])) {
        $query = "SELECT  sfc.total_amount, spd.student_id,spd.student_full_name, upd.university_name, usy.univ_session_name,uc.univ_course_name,ucs.univ_course_specialization_name, sfc.fee_mode_name, sfc.fee_mode, sfc.university_id, sfc.session_id, sfc.course_id, sfc.specilization_id, sfc.specilization_fee_id, sum(sfc.paid_amount),
        sum(sfc.discount_amount) AS totalDiscountAmount AS totalPaidAmount FROM universities_primary_details AS upd
            LEFT JOIN universities_session_years AS usy ON upd.university_id=usy.university_id
            LEFT JOIN students_university_courses AS suc ON suc.univ_session_id=usy.univ_session_id
            LEFT JOIN students_primary_details AS spd ON spd.student_id=suc.student_id
            LEFT JOIN universities_courses AS uc ON uc.univ_course_id=suc.univ_courses_id
            LEFT JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id
            LEFT JOIN stud_fee_collects AS sfc ON sfc.student_id=spd.student_id
            RIGHT JOIN stud_fees_modes AS sfm ON sfm.stud_fee_mode_id=sfc.stud_fee_mode_id WHERE sfc.payment_status LIKE '%%'
            ";
    } else {
        // Query to fetch data for the current page
        $query = "SELECT  sfc.total_amount, spd.student_id,spd.student_full_name, upd.university_name, usy.univ_session_name,uc.univ_course_name,ucs.univ_course_specialization_name, sfc.fee_mode_name, sfc.fee_mode, sfc.university_id, sfc.session_id, sfc.course_id, sfc.specilization_id, sfc.specilization_fee_id,
         sum(sfc.paid_amount) AS totalPaidAmount, sum(sfc.discount_amount) AS totalDiscountAmount FROM universities_primary_details AS upd
            LEFT JOIN universities_session_years AS usy ON upd.university_id=usy.university_id
            LEFT JOIN students_university_courses AS suc ON suc.univ_session_id=usy.univ_session_id
            LEFT JOIN students_primary_details AS spd ON spd.student_id=suc.student_id
            LEFT JOIN universities_courses AS uc ON uc.univ_course_id=suc.univ_courses_id
            LEFT JOIN universities_courses_specializations AS ucs ON ucs.univ_specialization_id=suc.univ_course_specialization_id
            LEFT JOIN stud_fee_collects AS sfc ON sfc.student_id=spd.student_id
            RIGHT JOIN stud_fees_modes AS sfm ON sfm.stud_fee_mode_id=sfc.stud_fee_mode_id WHERE sfc.payment_status LIKE '%%' GROUP BY sfc.student_id,
            sfc.university_id, sfc.session_id, sfc.course_id, sfc.specilization_id, sfc.specilization_fee_id, sfc.fee_mode_name
            ";
    }
    if (!empty($filters['regFees'])) {
        $query .= " AND sfc.fee_mode LIKE '%" . $filters['regFees'] . "%' ";
    }
    if (!empty($filters['feeStatus'])) {
        $query .= " AND sfc.payment_status LIKE '%" . $filters['feeStatus'] . "%'";
    }
    if (!empty($filters['universalSearch'])) {
        $query .= " AND spd.student_full_name LIKE '%" . $filters['universalSearch'] . "%' OR spd.student_phone_no LIKE '%" . $filters['universalSearch'] . "%' OR spd.student_alt_phone_no LIKE '%" . $filters['universalSearch'] . "%' OR spd.student_email_id LIKE '%" . $filters['universalSearch'] . "%' OR spd.student_alt_email_id LIKE '%" . $filters['universalSearch'] . "%' OR upd.university_name LIKE '%" . $filters['universalSearch'] . "%' OR upd.university_phone_no LIKE '%" . $filters['universalSearch'] . "%' OR upd.university_email_id LIKE '%" . $filters['universalSearch'] . "%'";
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

    if (!empty($filters['feeMode'])) {
        $query .= " AND sfc.fee_mode LIKE '%" . $filters['feeMode'] . "%'";
    }

    if (isset($filters['feeModeType']) && $filters['feeModeType'] !== '') {
        $query .= " AND sfc.fee_mode_name LIKE '%" . intval($filters['feeModeType']) . "%'";
    }

    if (!empty($filters['createdFromDate']) && !empty($filters['createdToDate'])) {
        // Assuming 'fromDate' and 'toDate' are in the format 'YYYY-MM-DD'
        $fromDate = $filters['createdFromDate'];
        $toDate = $filters['createdToDate'];
        // Modify the query to filter by date range
        $query .= " AND sfc.created_at BETWEEN '" . $fromDate . " 00:00:00' AND '" . $toDate . " 23:59:59'";
    }
    if (!empty($filters['createdFromDate'])) {
        // Assuming 'fromDate' is in the format 'YYYY-MM-DD'
        $fromDate = $filters['createdFromDate'];
        // Set the 'createdToDate' to today
        $toDate = date('Y-m-d');
        // Modify the query to filter by a date range starting from 'createdFromDate'
        $query .= " AND sfc.created_at BETWEEN '" . $fromDate . " 00:00:00' AND '" . $toDate . " 23:59:59'";
    }

    if (!empty($filters)) {
        $query .= " GROUP BY sfc.student_id, sfc.university_id, sfc.session_id, sfc.course_id, sfc.specilization_id, sfc.specilization_fee_id, sfc.fee_mode_name ";
    }
    //Count Total PAGE FOR PAGNATION
    $pagnationQuery = $query;
    // Add LIMIT and OFFSET for pagination
    $query .= " LIMIT $pageSize OFFSET $offset";
    // echo $query;
    // die;
    // Fetch data from the database
    $FetchStudentData = FETCH_DB_TABLE($query, true);
    // var_dump($FetchStudentData);
    // die;
    $output = "";
    $output .= '<table class="table  table-sm mb-2" id="table-data">
            <thead>
                <tr>
                    <th scope="col">SNo <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">StudentName <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">UniversityName <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">SessionYear <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">CourseName <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Specilization <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">FeeMode <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Semester <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">TotalFee <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">PaidFee <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">FeeStatus <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Action <i class="fa-regular fa-sort sort-icon"></i></th>
                     </tr>
            </thead>
            <tbody >';
    if ($FetchStudentData) {
        $Sno = 0;
        foreach ($FetchStudentData as $value) {

            $Sno++;

            if (!empty($filters['regFees'])) {
                $TotalPaidAmount = $value->paid_amount + $value->discount_amount;
                if ($value->paid_amount  == $value->total_amount) {
                    $status = '<button type="button" class="btn btn-success status-changes-btn" value="1" style="padding:0.09rem 0.3rem">Paid</button>';
                } elseif ($value->paid_amount  != $value->total_amount) {
                    $status = '<button type="button" class="btn btn-warning status-changes-btn" value="1" style="padding:0.09rem 0.3rem">Pending</button>';
                }
            } elseif (!empty($filters)) {
                $TotalPaidAmount = $value->totalPaidAmount + $value->totalDiscountAmount;
                if ($value->totalPaidAmount  == $value->total_amount) {
                    $status = '<button type="button" class="btn btn-success status-changes-btn" value="1" style="padding:0.09rem 0.3rem">Paid</button>';
                } elseif ($value->totalPaidAmount  != $value->total_amount) {
                    $status = '<button type="button" class="btn btn-warning status-changes-btn" value="1" style="padding:0.09rem 0.3rem">Pending</button>';
                }
            } else {
                $TotalPaidAmount = $value->totalPaidAmount + $value->totalDiscountAmount;
                if ($value->totalPaidAmount  == $value->total_amount) {
                    $status = '<button type="button" class="btn btn-success status-changes-btn" value="1" style="padding:0.09rem 0.3rem">Paid</button>';
                } elseif ($value->totalPaidAmount  != $value->total_amount) {
                    $status = '<button type="button" class="btn btn-warning status-changes-btn" value="1" style="padding:0.09rem 0.3rem">Pending</button>';
                }
            }
            $output .= '
             <tr>
                <th scope="row">' . $Sno . '</th>
                <td><a href="' . ADMIN_URL . '/account/students/view.php?id=' . $value->student_id . '" class="view-bdes-link">' . $value->student_full_name .  '</a></td>

                <td>' . $value->university_name . '</td>
                 <td>' . $value->univ_session_name . '</td>
                  <td>' . $value->univ_course_name . '</td>
                  <td>' . $value->univ_course_specialization_name . '</td>
                  <td>' . $value->fee_mode . '</td>
                  <td>' . $value->fee_mode_name . '</td>
                  <td>' . $value->total_amount . '</td>
                  <td>' . $TotalPaidAmount . '</td>
                  <td>' . $status . '</td>
                  <td style="">
                        <a href="' . ADMIN_URL . '/account/fees/add.php?sid=' . $value->student_id . '&sname=' . $value->student_id . '" class="btn btn-sm btn-primary mr-2" style="padding: 0.2rem 0.4rem !important;"><i class="fas fa-plus"></i></a>
                        <a href="' . ADMIN_URL . '/account/students/view.php?id=' . $value->student_id . '" class="btn btn-sm btn-light mr-2" style="padding: 0.2rem 0.4rem !important;" ><img src="' . STORAGE_URL . '/account-image/graduated.png" style="width:20px; height:20px;"></a>
                        <a href="' . ADMIN_URL . '/account/university/view.php?id=' . $value->student_id . '" class="btn btn-sm btn-light " style="padding: 0.2rem 0.4rem !important;"><img src="' . STORAGE_URL . '/account-image/school (1).png" style="width:20px; height:20px;"></a>
                <td>
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
            $output .= '<li class="page-item"><a class="page-link pagination-link fee-pagination-link" href="#" data-page="' . $prevPage . '">Previous</a></li>';
        }

        // Numbered Page Links
        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $currentPage) ? 'active' : '';
            $output .= '<li class="page-item ' . $activeClass . '"><a class="page-link pagination-link fee-pagination-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
        }

        // Next Page Link
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $output .= '<li class="page-item"><a class="page-link pagination-link fee-pagination-link" href="#" data-page="' . $nextPage . '">Next</a></li>';
        }

        $output .= '</ul>';
    }


    // Send the generated HTML as a response
    echo $output;
}
