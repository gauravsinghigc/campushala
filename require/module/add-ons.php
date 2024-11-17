<?php

//form submit token
function FormInputToken()
{
 $TokenValue = SECURE(VALIDATOR_REQ, "e");
?><input type="text" name="AuthToken" value="<?php echo $TokenValue; ?>" hidden="">
<?php }

//page access
function AccessUrl($GetAutoUrl = true)
{
 if ($GetAutoUrl == true) {
  $RunningUrl = GET_URL();
 } else {
  $RunningUrl = $GetAutoUrl;
 }
?><input type="text" name="access_url" value="<?php echo SECURE($RunningUrl, "e"); ?>" hidden="">
<?php }

//form primary details
function FormPrimaryInputs($url = true, array $morerequest = null)
{
 FormInputToken();
 if ($url == true) {
  AccessUrl($GetAutoUrl = true);
 } else {
  AccessUrl($GetAutoUrl = $url);
 }
 if ($morerequest != null) {
  foreach ($morerequest as $key => $value) {
   echo "<input type='text' name='" . $key . "' value='" . SECURE($value, "e") . "' hidden=''>";
  }
 }
}

//status view
function StatusView($data)
{
 if ($data == "1" || $data == 1) {
  return "<span class='text-success'><i class='fa fa-check-circle'></i></span>";
 } else {
  return "<span class='text-danger'><i class='fa fa-warning'></i></span>";
 }
}

//status view
function StatusViewWithText($data)
{
 if ($data == "1" or $data == 1 or $data == "Active" or $data == "ACTIVE") {
  return "<span class='text-success'> Active</span>";
 } elseif ($data == "2" or $data == 2 or $data == "Inactive" or $data == "INACTIVE" or $data == "0") {
  return "<span class='text-danger'> Inactive</span>";
 } elseif ($data == "3" or $data == 3 or $data == "Deleted" or $data == "DELETED") {
  return "<span class='text-danger'><i>Deleted!</i></span>";
 } else {
  return "<span class='text-danger'>$data</span>";
 }
}

//return value
function ReturnValue($data)
{
 if ($data == null) {
  return "Not Available";
 } else {
  return $data;
 }
}

function AllCountryList(){
    $AllCountryArray =["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
    return $AllCountryArray;
}
function SemesterList()
{
    $AllSemesterList = ['1' => 'First Semester', '2' => 'Second Semester', '3' => 'Third Semester', '4' => 'Fourth Semester', '5' => 'Fifth Semester', '6' => 'Sixth Semester', '7' => 'Seventh Semester', '8' => 'Eighth Semester', '9' => 'Ninth Semester', '10' => 'Tenth Semester'];
    return $AllSemesterList;
}
function DiscountType()
{
    $Type = ["Amount", "Percentage"];
    return $Type;
}
function NumberPostWords()
{
    $NumberPostWord = ['1' => 'st', '2' => 'nd', '3' => 'rd', '4' => 'th', '5' => 'th', '6' => 'th', '7' => 'th', '8' => 'th', '9' => 'th', '10' => 'th'];
    return $NumberPostWord;
}
function firstYearSem()
{
    $sem = ['1' => 'sem', '2' => 'sem'];
    return $sem;
}
function secondYearSem()
{
    $sem = ['3' => 'sem', '4' => 'sem'];
    return $sem;
}
function thirdYearSem()
{
    $sem = ['5' => 'sem', '6' => 'sem'];
    return $sem;
}
function fourYearSem()
{
    $sem = ['7' => 'sem', '8' => 'sem'];
    return $sem;
}
function fiveYearSem()
{
    $sem = ['9' => 'sem', '10' => 'sem'];
    return $sem;
}
function oneTimeFirstYearTotalSem()
{
    $sem = ['1' => 'sem', '2' => 'sem'];
    return $sem;
}
function oneTimeSecondYearTotalSem()
{
    $sem = ['1' => 'sem', '2' => 'sem', '3' => 'sem', '4' => 'sem'];
    return $sem;
}
function oneTimeThirdYearTotalSem()
{
    $sem = ['1' => 'sem', '2' => 'sem', '3' => 'sem', '4' => 'sem', '5' => 'sem', '6' => 'sem'];
    return $sem;
}
function oneTimeFourYearTotalSem()
{
    $sem = ['1' => 'sem', '2' => 'sem', '3' => 'sem', '4' => 'sem', '5' => 'sem', '6' => 'sem', '7' => 'sem', '8' => 'sem'];
    return $sem;
}
function oneTimeFiveYearTotalSem()
{
    $sem = ['1' => 'sem', '2' => 'sem', '3' => 'sem', '4' => 'sem', '5' => 'sem', '6' => 'sem', '7' => 'sem', '8' => 'sem', '9' => 'sem', '10' => 'sem'];
    return $sem;
}
function firstYear()
{
    $year = ['1' => 'First Year'];
    return $year;
}
function secondYear()
{
    $year = ['1' => 'First Year', '2' => 'Second Year'];
    return $year;
}
function thirdYear()
{
    $year = ['1' => 'First Year', '2' => 'Second Year', '3' => 'Third Year'];
    return $year;
}
function fourthYear()
{
    $year = ['1' => 'First Year', '2' => 'Second Year', '3' => 'Third Year', '4' => 'Fouth Year'];
    return $year;
}
function fivethYear()
{
    $year = ['1' => 'First Year', '2' => 'Second Year', '3' => 'Third Year', '4' => 'Fouth Year', '5' => 'Fifth year'];
    return $year;
}
function YearList()
{
    $year = ['1' => 'First Year', '2' => 'Second Year', '3' => 'Third Year', '4' => 'Fouth Year', '5' => 'Fifth year'];
    return $year;
}
function TableDataNumber()
{
    $Number= ['5','10','15','20','25','50','100','200','250','400','500','600','700','800','900','1000'];
    return $Number;
}