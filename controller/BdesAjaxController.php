<?php
// Include necessary files and connect to the database
$Dir = "../";
require $Dir . '/require/modules.php';
require $Dir . 'require/admin/access-control.php';

if (isset($_POST['loadTableData'])) {
    $pageSize = 5; // Number of records to display per page
    $currentPage = isset($_POST['page']) ? $_POST['page'] : 1; // Current page, default to 1

    // Calculate the offset based on the current page and page size
    $offset = ($currentPage - 1) * $pageSize;

    // Get filter criteria from the POST request
    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
    if (!empty($filters['universalSearch'])) {
        // Query to fetch data for the current page
        $query = "SELECT * FROM bdes_primary_details WHERE
  (CONCAT(bdes_first_name, ' ', bdes_last_name) LIKE '%" . $filters['universalSearch'] . "%')
  OR bdes_first_name LIKE '%" . $filters['universalSearch'] . "%'
  OR bdes_last_name LIKE '%" . $filters['universalSearch'] . "%'
  OR bdes_phone_no LIKE '%" . $filters['universalSearch'] . "%'
  OR bdes_email_id LIKE '%" . $filters['universalSearch'] . "%'
  OR bdes_city LIKE '%" . $filters['universalSearch'] . "%'
  OR bdes_state LIKE '%" . $filters['universalSearch'] . "%'
  OR bdes_country LIKE '%" . $filters['universalSearch'] . "%'
  OR bdes_status LIKE '%" . $filters['universalSearch'] . "%'";
    } else {
        // Query to fetch data for the current page
        $query = "SELECT * FROM bdes_primary_details WHERE bdes_status LIKE '%%'";
    }
    if (!empty($filters['fullName'])) {
        $query .= " AND (bdes_first_name LIKE '%" . $filters['fullName'] . "%' OR bdes_last_name LIKE '%" . $filters['fullName'] . "%')";
    }

    if (!empty($filters['phone'])) {
        $query .= " AND bdes_phone_no LIKE '%" . $filters['phone'] . "%'";
    }

    if (!empty($filters['email'])) {
        $query .= " AND bdes_email_id LIKE '%" . $filters['email'] . "%'";
    }

    if (!empty($filters['city'])) {
        $query .= " AND bdes_city LIKE '%" . $filters['city'] . "%'";
    }


    if (!empty($filters['state'])) {
        $query .= " AND bdes_state LIKE '%" . $filters['state'] . "%'";
    }

    if (isset($filters['status']) && $filters['status'] !== '') {
        $query .= " AND bdes_status LIKE '%"  . intval($filters['status']) . "%'";
    }

    if (!empty($filters['fromDate']) && !empty($filters['toDate'])) {
        // Assuming 'fromDate' and 'toDate' are in the format 'YYYY-MM-DD'
        $fromDate = $filters['fromDate'];
        $toDate = $filters['toDate'];

        // Modify the query to filter by date range
        $query .= " AND created_at BETWEEN '" . $fromDate . " 00:00:00' AND '" . $toDate . " 23:59:59'";
    }
    //Count Total PAGE FOR PAGNATION
    $pagnationQuery = $query;
    // Add LIMIT and OFFSET for pagination
    $query .= " LIMIT $pageSize OFFSET $offset";

    // Fetch data from the database
    $FetchBdesData = FETCH_DB_TABLE($query, true);

    $output = "";
    $output .= '<table class="table  table-sm mb-2" id="table-data">
            <thead>
                <tr>
                    <th scope="col">Id <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Name <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Phone No. <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Email Id <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">City <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">State <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Status <i class="fa-regular fa-sort sort-icon"></i></th>
                    <th scope="col">Action <i class="fa-regular fa-sort sort-icon"></i></th>
                </tr>
            </thead>
            <tbody >';
    if ($FetchBdesData) {
        foreach ($FetchBdesData as $value) {
            $BdeStatus = ($value->bdes_status == "1") ? "Active" : "Inactive";
            $StatusClass = ($value->bdes_status == "1") ? "success" : "danger";

            $output .= '
            <tr>
                <th scope="row">' . $value->bdes_id . '</th>
                <td><a href="view.php?id=' . SECURE($value->bdes_id, "e") . '" class="view-bdes-link">' . $value->bdes_first_name . " " . $value->bdes_last_name . '</a></td>
                <td>' . $value->bdes_phone_no . '</td>
                <td>' . $value->bdes_email_id . '</td>
                <td>' . $value->bdes_city . '</td>
                <td>' . $value->bdes_state . '</td>
                <td><button type="button" class="btn btn-' . $StatusClass . ' status-changes-btn" value="' . $value->bdes_id . '" style="padding: 0.09rem 0.3rem">' . $BdeStatus . '</button></td>
                <td>
                    <a href="' . ADMIN_URL . '/account/bdes/view.php?id=' . SECURE($value->bdes_id, "e") . '" class="text-info"><i class=\'bi bi-eye-fill\'></i></a>
                    <a href="' . ADMIN_URL . '/account/bdes/edit.php?id=' . SECURE($value->bdes_id, "e") . '" class="text-primary"><i class=\'bi bi-pencil-fill\'></i></a>
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
        $totalRecords = TOTAL("SELECT bdes_id FROM bdes_primary_details");
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
            $output .= '<li class="page-item"><a class="page-link pagination-link bde-pagination-link" href="#" data-page="' . $prevPage . '">Previous</a></li>';
        }

        // Numbered Page Links
        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $currentPage) ? 'active' : '';
            $output .= '<li class="page-item ' . $activeClass . '"><a class="page-link pagination-link bde-pagination-link" href="#" data-page="' . $i . '">' . $i . '</a></li>';
        }

        // Next Page Link
        if ($currentPage < $totalPages) {
            $nextPage = $currentPage + 1;
            $output .= '<li class="page-item"><a class="page-link pagination-link bde-pagination-link" href="#" data-page="' . $nextPage . '">Next</a></li>';
        }

        $output .= '</ul>';
    }


    // Send the generated HTML as a response
    echo $output;
}
