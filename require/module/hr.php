<?php
define("OD_STATUS", [
  "NEW", "REJECTED", "APPROVED", "ACTIVE", "COMPLETED", 'Select OD Status'
]);

function ODStatus($data)
{
  $return = LowerCase($data);
  return $return;
}

function ODStatusText($data)
{
  if ($data == "APPROVED") {
    $return = "<span class='text-success'>Approved</span>";
  } elseif ($data == "REJECTED") {
    $return = "<span class='text-danger'>Rejected</span>";
  } elseif ($data == "NEW") {
    $return = "<span class='text-primary'>New</span>";
  } elseif ($data == "ACTIVE") {
    $return = "<span class='text-info'><i class='fa fa-check'></i>Active</span>";
  } else {
    $return = "<span class='text-warning'>$data</span>";
  }

  return $return;
}
