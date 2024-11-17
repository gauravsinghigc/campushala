<?php
//foreach loop html tag attribute display
function LOOP_TagsAttributes($data)
{
  foreach ($data as $key => $values) {
    echo "$key='$values'";
  }
}

//remove space
function RemoveSpace($string)
{
  $string = str_replace(' ', '-', $string);
  if ($string == null) {
    return null;
  } else {
    return $string;
  }
}

//lowercase all words
function LowerCase($string)
{
  $string = strtolower($string);
  if ($string == null) {
    return null;
  } else {
    return $string;
  }
}

//display data null or data
function Data($data)
{
  if ($data == null || $data == "" || $data == " " || $data == "  ") {
    return "";
  } else {
    return $data;
  }
}


//getworkdays 
function CountWorkingDays($startdate, $endate)
{

  $workingDays = 0;
  $startTimestamp = strtotime($startdate);
  $endTimestamp = strtotime($endate);
  for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
    if (date("N", $i) <= 5) $workingDays = $workingDays + 1;
  }
  return $workingDays;
}

//get weekend days
function CountNonWorkingDays($startDate, $endDate)
{
  $weekendDays = 0;
  $startTimestamp = strtotime($startDate);
  $endTimestamp = strtotime($endDate);
  for ($i = $startTimestamp; $i <= $endTimestamp; $i = $i + (60 * 60 * 24)) {
    if (date("N", $i) > 5) $weekendDays = $weekendDays + 1;
  }
  return $weekendDays;
}


//function GetDays from current date
function GetDays($fromdate)
{
  $ProjectDueDate = $fromdate;
  $TodayDate = strtotime(CURRENT_DATE_TIME);
  $ProjectDaysLefts = strtotime($ProjectDueDate);
  $DaysLeft = (int)$TodayDate - (int)$ProjectDaysLefts;
  $TimeLeft = round($DaysLeft / (60 * 60 * 24));
  if ($TimeLeft <= 0) {
    return 0;
  }
  return $TimeLeft;
}

//function GetDays from current date
function DaysBetweenDates($fromdate, $Todaydate)
{
  $startDate = new DateTime($fromdate);
  $endDate = new DateTime($Todaydate);

  $interval = $startDate->diff($endDate);
  $days = $interval->days;
  return $days;
}


//GET numbers from strings
function GetNumbers($strings)
{
  if ($strings == null) {
    $returns = 0;
  } else {
    preg_match_all('/[+-]?\d+(?:\.\d+)?/', $strings, $matches);
    $returns = $matches[0];
    $return = 0;
    foreach ($returns as $retun) {
      $return += $retun;
    }
    $returns = $return;
  }

  return $returns;
}

//get hours 
function GetHours($starttime, $endtime)
{
  $hours = round((strtotime($endtime) - strtotime($starttime)) / 3600, 1);

  return $hours;
}

//show only limited characters
function LimitText($text, $start, $end)
{
  $LimitText = substr($text, $start, $end) . "...";
  return $LimitText;
}

//uniquer
define("AUTO_GENERATED_REF_NO", date("dmy") . rand(00000, 99999));
