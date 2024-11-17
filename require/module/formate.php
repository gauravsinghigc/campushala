<?php
//date formates
function DATE_FORMATE($format, $date)
{
  $newdateformate = $date;
  $checkdate = boolval($date);
  if ($checkdate == null) {
    $newdateformate = "NA";
  } else {
    date_default_timezone_set('Asia/Kolkata');
    $newdateformate = date("$format", strtotime($date));
  }
  return $newdateformate;
}

//CURRENT_DATE_TIME
function GetDateTime()
{
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d h:i:s A');
  return $date;
}
define("CURRENT_DATE_TIME", GetDateTime());
