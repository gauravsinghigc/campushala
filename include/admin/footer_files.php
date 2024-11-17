<?php include(__DIR__ . "/message.php");
?>
<?php
include(__DIR__ . "/universial-search-popup.php"); ?>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/simple-datatables/simple-datatables.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/js/adminlte.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/js/main.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/js/account-custome.js"></script>
<!-- Vendor JS Files -->
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/chart.js/chart.umd.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/echarts/echarts.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/quill/quill.min.js"></script>

<script src="<?php echo ASSETS_URL; ?>/admin/plugins/tinymce/tinymce.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/admin/plugins/php-email-form/validate.js"></script>

<!-- Databar Code Area Start Here -->
<script>
  function Databar(data) {
    databar = document.getElementById("" + data + "");
    if (databar.style.display === "block") {
      databar.style.display = "none";
    } else {
      databar.style.display = "block";
    }
  }
</script>
<script>
  function SearchData(searchinput, items_box) {
    // Get the search input
    var searchInput = document.getElementById("" + searchinput + "").value;

    // Get all content items
    var contentItems = document.getElementsByClassName("" + items_box + "");

    // Loop through all content items
    for (var i = 0; i < contentItems.length; i++) {
      // Get the current item
      var item = contentItems[i];

      // Get the text of the current item
      var itemText = item.textContent.toLowerCase();

      // Check if the search input is found in the item text
      if (itemText.includes(searchInput.toLowerCase())) {
        // If found, show the item
        item.style.display = "block";
      } else {
        // If not found, hide the item
        item.style.display = "none";
      }
    }
  }

  window.onload = function() {
    document.getElementById("loader").style.display = "none";
  }
</script>

<!-- Universial Search Popup Show On Click and Close -->
<script>
  $(document).ready(function(e) {
    $(document).on("click", "#universalSearch", function(e) {
      $("#universial-search-popup").show();
    });
    $(document).on("click", ".universial-close-btn", function(e) {
      $("#universial-search-popup").hide();
    });

  });
</script>

<!-- Bde Search Details Ajax Code Area Start Here -->
<script>
  var currentPage = 1; // Variable to track the current page
  // Function to fetch and display paginated data using AJAX
  function fetchBdeData(page, filters) {
    $.ajax({
      url: '<?= CONTROLLER ?>/BdesAjaxController.php',
      type: 'POST',
      data: {
        loadTableData: true,
        page: page,
        filters: filters
      },
      success: function(data) {
        $('.bde-table-data').html(data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  }
  // Function to handle pagination link clicks
  function handleBdePaginationClick(page) {
    fetchBdeData(page, getBdeFilterCriteria());
  }
  // Attach a click event handler to pagination links
  $(document).on('click', '.bde-pagination-link', function(e) {
    e.preventDefault();
    var page = $(this).data('page');
    currentPage = page;
    handleBdePaginationClick(page);
  });
  // Function to get filter criteria from the form
  function getBdeFilterCriteria() {
    var filters = {
      universalSearch: $('#universalSearch').val(),
    };
    return filters;
  }
  // Attach a click event handler to the Apply KeyUp button
  $(document).on("keyup", "#universalSearch", function(e) {
    e.preventDefault();
    fetchBdeData(1, getBdeFilterCriteria()); // Fetch data with filter criteria
  });
</script>

<!-- Student Search Details Ajax Code Area Start Here -->
<script>
  var currentPage = 1; // Variable to track the current page
  // Function to fetch and display paginated data using AJAX
  function fetchStudentData(page, filters) {
    $.ajax({
      url: '<?= CONTROLLER ?>/StudentAjaxController.php',
      type: 'POST',
      data: {
        loadTableData: true,
        page: page,
        filters: filters
      },
      success: function(data) {
        $('.student-table-data').html(data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  }
  // Function to handle pagination link clicks
  function handleStudentPaginationClick(page) {
    fetchStudentData(page, getStudentFilterCriteria());
  }
  // Attach a click event handler to pagination links
  $(document).on('click', '.student-pagination-link', function(e) {
    e.preventDefault();
    var page = $(this).data('page');
    currentPage = page;
    handleStudentPaginationClick(page);
  });
  // Function to get filter criteria from the form
  function getStudentFilterCriteria() {
    var filters = {
      universalSearch: $('#universalSearch').val(),
    };
    return filters;
  }
  // Attach a click event handler to the Apply KeyUp button
  $(document).on("keyup", "#universalSearch", function(e) {
    e.preventDefault();
    fetchStudentData(1, getStudentFilterCriteria()); // Fetch data with filter criteria
  });
  // Attach a click event handler to the Apply Filters button
  $('#ApplyFilters').on('click', function() {
    fetchStudentData(1, getStudentFilterCriteria()); // Fetch data with filter criteria
  });
</script>

<!-- University Search Details Ajax Code Area Start Here -->
<script>
  var currentPage = 1; // Variable to track the current page
  // Function to fetch and display paginated data using AJAX
  function fetchUniversityData(page, filters) {
    $.ajax({
      url: '<?= CONTROLLER ?>/UniversityAjaxController.php',
      type: 'POST',
      data: {
        loadTableData: true,
        page: page,
        filters: filters
      },
      success: function(data) {
        $('.university-table-data').html(data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  }
  // Function to handle pagination link clicks
  function handleUniversityPaginationClick(page) {
    fetchUniversityData(page, getUniversityFilterCriteria());
  }
  // Attach a click event handler to pagination links
  $(document).on('click', '.university-pagination-link', function(e) {
    e.preventDefault();
    var page = $(this).data('page');
    currentPage = page;
    handleUniversityPaginationClick(page);
  });
  // Function to get filter criteria from the form
  function getUniversityFilterCriteria() {
    var filters = {
      universalSearch: $('#universalSearch').val(),
    };
    return filters;
  }
  // Attach a click event handler to the Apply KeyUp button
  $(document).on("keyup", "#universalSearch", function(e) {
    e.preventDefault();
    fetchUniversityData(1, getUniversityFilterCriteria()); // Fetch data with filter criteria
  });
</script>

<!-- Fee Search Details Ajax Code Area Start Here -->
<script>
  var currentPage = 1; // Variable to track the current page
  // Function to fetch and display paginated data using AJAX
  function fetchFeeData(page, filters) {
    $.ajax({
      url: '<?= CONTROLLER ?>/FeeController.php',
      type: 'POST',
      data: {
        loadTableData: true,
        page: page,
        filters: filters
      },
      success: function(data) {
        $('.fee-table-data').html(data);
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
      }
    });
  }
  // Function to handle pagination link clicks
  function handleFeePaginationClick(page) {
    fetchFeeData(page, getFeeFilterCriteria());
  }
  // Attach a click event handler to pagination links
  $(document).on('click', '.fee-pagination-link', function(e) {
    e.preventDefault();
    var page = $(this).data('page');
    currentPage = page;
    handleFeePaginationClick(page);
  });
  // Function to get filter criteria from the form
  function getFeeFilterCriteria() {
    var filters = {
      universalSearch: $('#universalSearch').val(),
    };
    return filters;
  }
  // Attach a click event handler to the Apply Filters button
  $(document).on("keyup", "#universalSearch", function(e) {
    e.preventDefault();
    fetchFeeData(1, getFeeFilterCriteria()); // Fetch data with filter criteria
  });
</script>

<!-- Universial Table Shorting Code In Java Script Area Stat Here -->
<script>
  // Define a variable to keep track of the sorting order
  let isDescending = false;

  $(document).on('click', '.sort-icon', function() {
    const column = $(this).closest('th').index();
    const $table = $(this).closest('table');
    const $rows = $table.find('tbody > tr').get();

    // Toggle the sorting order
    isDescending = !isDescending;

    // Toggle the active state of the clicked column header
    $table.find('.sort-icon').removeClass('active');
    $(this).addClass('active').toggleClass('asc', !isDescending).toggleClass('desc', isDescending);

    $rows.sort(function(a, b) {
      const keyA = $(a).find('td').eq(column).text().toLowerCase();
      const keyB = $(b).find('td').eq(column).text().toLowerCase();

      if (keyA < keyB) return isDescending ? 1 : -1;
      if (keyA > keyB) return isDescending ? -1 : 1;
      return 0;
    });

    // Reorder the table rows based on the sorted order
    $.each($rows, function(index, row) {
      $table.children('tbody').append(row);
    });
  });
</script>