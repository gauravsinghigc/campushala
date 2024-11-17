<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "All Holidays";
$PageDescription = "Manage all customers";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
  <?php include $Dir . "/include/admin/header_files.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("expanses").classList.add("active");
      document.getElementById("all_expanses").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include $Dir . "/include/admin/loader.php"; ?>

    <?php
    include $Dir . "/include/admin/header.php";
    include $Dir . "/include/admin/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-10">
                      <h4 class="app-heading"><?php echo $PageName; ?></h4>
                    </div>
                    <div class="col-md-2">
                      <a href="#" onclick="Databar('AddHolidays')" class='btn btn-sm btn-danger btn-block'><i class="fa fa-plus"></i> Add Holidays</a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="calendar">
                        <?php
                        // Get the current year and month
                        if (isset($_GET['month']) && isset($_GET['year'])) {
                          $month = $_GET['month'];
                          $year = $_GET['year'];
                          $date = $_GET['day'];
                        } else {
                          $month = date('n');
                          $year = date('Y');
                          $date = date('d');
                        }

                        // Get the number of days in the current month
                        $numDays = date('t', mktime(0, 0, 0, $month, 1, $year));

                        // Get the first day of the month
                        $firstDay = date('N', mktime(0, 0, 0, $month, 1, $year));

                        // Create an array of month names
                        $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

                        //view past or future month
                        // Create links to navigate between months
                        $prevMonth = $month - 1;
                        $prevYear = $year;
                        if ($prevMonth == 0) {
                          $prevMonth = 12;
                          $prevYear--;
                        }
                        $nextMonth = $month + 1;
                        $nextYear = $year;
                        if ($nextMonth == 13) {
                          $nextMonth = 1;
                          $nextYear++;
                        }
                        $prevMonthName = date('F', mktime(0, 0, 0, $prevMonth, 1));
                        $nextMonthName = date('F', mktime(0, 0, 0, $nextMonth, 1));

                        if (isset($_GET['month'])) {
                          $Reset = "<a href='index.php' class='btn btn-xs btn-danger'><i class='fa fa-calendar'></i> Go to Today Date</a> ";
                        } else {
                          $Reset = "";
                        }

                        $Calendar = "<div>
                        <h4 class='current-date'><i class='fa fa-calendar-day text-warning'></i> " . $date . " " . $months[$month] . " " . $year . "</h4>
                        <h5 class='mb-4'><i class='fa fa-clock text-success'></i> <span id='clock2'>" . date("h:i A") . "</span></h5>
                        <p class='flex-s-b m-b-10'>
                        <a href='?month=$prevMonth&amp;year=$prevYear&day=$date' class='btn btn-xs btn-default'><i class='fa fa-angle-double-left'></i> $prevMonthName</a> 
                        <a href='?month=$nextMonth&amp;year=$nextYear&day=$date' class='btn btn-xs btn-default'>$nextMonthName <i class='fa fa-angle-double-right'></i></a>
                        </p>
                        <form class='flex-s-b mb-2'>
                        <input type='hidden' name='day' value='$date'>
                        <select name='month' class='form-control form-control-sm w-50 m-r-2' onchange='form.submit()'>
                        ";
                        $Calendar .=  InputOptionWithKeys($months, IfRequested('GET', 'month', $month, false));
                        $Calendar .= "
                        </select>
                        <input type='number' value='" . IfRequested('GET', 'year', date('Y'), false) . "' name='year' min='1900' max='2100' class='form-control form-control-sm m-l-2 w-50' onchange='form.submit()'>
                        </form>
                        </div>
                        ";
                        // Create the calendar table
                        $Calendar .= "<table class='table'>";
                        $Calendar .= "<tr class='cal-header'><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr>";

                        // Create the first row of the calendar
                        $Calendar .= "<tr>";

                        for ($i = 1; $i < $firstDay; $i++) {
                          $Calendar .= "<td></td>";
                        }
                        for ($i = 1; $i <= 7 - $firstDay; $i++) {
                          if ($date == $i) {
                            $select = "active";
                          } else {
                            $select = "";
                          }

                          $HolidayDate1 = "$year-$month-$date";
                          $HolidayDate1 = date("Y-m-d", strtotime($HolidayDate1));
                          $RunningDateV = date("Y-m-d");

                          if ($HolidayDate1 == $RunningDateV) {
                            $active = "";
                          } else {
                            $active = "holiday";
                          }
                          $Calendar .= "<td" . (($i == date('j') && $month == date('n') && $year == date('Y')) ? " class='today'" : "") . ">
                          <a class='$select $active'  href='?month=$month&year=$year&day=$i'>$i</a>
                          </td>";
                        }
                        $Calendar .= "</tr>";

                        // Create the rest of the calendar
                        for ($j = 1; $j <= ceil(($numDays - 7 + $firstDay) / 7); $j++) {
                          $Calendar .= "<tr>";
                          for ($i = 1; $i <= 7; $i++) {
                            $day = $i + ($j - 1) * 7 + (7 - $firstDay + 1);
                            if ($day <= $numDays) {
                              if ($day == $date) {
                                $select = "active";
                              } else {
                                $select = "";
                              }

                              $HolidayDate2 = "$year-$month-$date";

                              $RunningDateD = date("Y-m-d");

                              if ($HolidayDate1 == $RunningDateV) {
                                $active2 = "";
                              } else {
                                $active2 = "holiday";
                              }
                              $Calendar .= "<td" . (($day == date('j') && $month == date('n') && $year == date('Y')) ? " class='today'" : "") . ">
                              <a class='$select $active2' href='?month=$month&year=$year&day=$day'>$day</a>
                              </td>";
                            } else {
                              $Calendar .= "<td></td>";
                            }
                          }
                          $Calendar .= "</tr>";
                        }

                        $Calendar .= "</table>";

                        $Calendar .=  $Reset;

                        echo $Calendar;
                        if ($month < 10) {
                          $month = "0" . $month;
                        }

                        $ViewData = date("$year-$month-$date");
                        $ViewData = date("Y-m", strtotime($ViewData));
                        ?>
                      </div>
                    </div>
                    <div class='col-md-6'>
                      <h4 class='app-sub-heading' style='font-size:1.3rem !important;'>All Holidays for : <?php echo date("M, Y", strtotime($ViewData)); ?></h4>
                      <div class='row'>
                        <?php
                        $AllHolidays = FETCH_DB_TABLE("SELECT * FROM config_holidays where MONTH(ConfigHolidayFromDate)='$month' and YEAR(ConfigHolidayFromDate)='$year' ORDER BY DATE(ConfigHolidayFromDate) ASC", true);
                        if ($AllHolidays == null) {
                          NoData("<h4>No Holidays!</h3>");
                        } else {
                          foreach ($AllHolidays as $Holiday) {
                            $TodayDate = date("Y-m-d");
                            $RunningDate = date("Y-m-d", strtotime($Holiday->ConfigHolidayFromDate));

                            if ($TodayDate == $RunningDate) {
                              $ActiveData = "bg-success";
                            } else {
                              $ActiveData = "bg-info";
                            }
                        ?>
                            <div class='col-md-12'>
                              <div class="data-list flex-s-b">
                                <div class="w-pr-25">
                                  <h1 class="mb-0 <?php echo $ActiveData; ?> text-left p-2 rounded"><?php echo date("d", strtotime($Holiday->ConfigHolidayFromDate)); ?>
                                    <small class="fs-12"><?php echo date("M", strtotime($ViewData)); ?></small>
                                  </h1>
                                </div>
                                <div class="w-pr-75">
                                  <div class="p-1">
                                    <h5><?php echo $Holiday->ConfigHolidayName; ?></h5>
                                    <p class="text-secondary"><?php echo SECURE($Holiday->ConfigHolidayNotes, "d"); ?></p>
                                  </div>
                                </div>

                                <a href=""></a>
                              </div>
                            </div>
                        <?php
                          }
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php
    include $Dir . "/include/sections/Add-New-Holiday.php";
    include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>