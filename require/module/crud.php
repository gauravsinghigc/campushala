<?php

//Update function
function UPDATE($SQL, $die = false)
{
    global $DBConnection;
    $Update = "$SQL";

    //die entry
    if ($die == true) {
        die($Update);
    }
    $Query = mysqli_query($DBConnection, $Update);
    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}

//delete
function DELETE($SQL, $die = false)
{
    global $DBConnection;
    $Update = "$SQL";

    //die entry
    if ($die == true) {
        die($Update);
    }
    $Query = mysqli_query($DBConnection, $Update);
    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}

//Check function
function CHECK($SQL, $die = false)
{
    global $DBConnection;
    $Check = "$SQL";

    //die entry
    if ($die == true) {
        die($Check);
    }
    $Query = mysqli_query($DBConnection, $Check);
    $Count = mysqli_num_rows($Query);
    if ($Count == 0 or $Count == null) {
        return false;
    } else {
        return true;
    }
}


//Insert Data
function SAVE($tablename, array $INSERT, $die = false)
{
    global $DBConnection;
    $tablename = $tablename;
    $Datatables = "";
    $TableValues = "";
    $tablerows = $INSERT;
    $arraycount = count($tablerows);
    $mainarray = $arraycount - 1;

    foreach ($tablerows as $key => $value) {
        global $$value;
    }


    foreach ($tablerows as $key => $value) {
        if ($key == $mainarray) {
            $TableValues .= "'" . htmlentities($$value) . "'";
        } else {
            $TableValues .= "'" . htmlentities($$value) . "', ";
        }
    }

    foreach ($tablerows as $key => $value) {
        if ($key == $mainarray) {
            $Datatables .= "$value";
        } else {
            $Datatables .= "$value, ";
        }
    }
    $InsertNewData = "INSERT INTO $tablename ($Datatables) VALUES ($TableValues)";

    //die entry
    if ($die == true) {
        die($InsertNewData);
    }
    $Query = mysqli_query($DBConnection, $InsertNewData);
    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}

//Select Data
function SELECT($SQL, $die = false)
{
    global $DBConnection;
    $SELECT = "$SQL";

    if ($die == true) {
        die($SELECT);
    }

    $QUERY = mysqli_query($DBConnection, $SELECT);
    if ($QUERY == true) {
        return $QUERY;
    } else {
        return false;
    }
}

//Count Data
function TOTAL($SQL, $die = null)
{
    global $DBConnection;
    $SQL = "$SQL";

    if ($die == true) {
        die($SQL);
    }
    $Query = mysqli_query($DBConnection, $SQL);
    $Count = mysqli_num_rows($Query);
    if ($Count == 0) {
        return "0";
    } else {
        return $Count;
    }
}

//configuration
function CONFIG($Data, $die = false)
{
    global $DBConnection;
    $SELECT_configurations = "SELECT * FROM configurations where configurationname='$Data'";

    //die entry
    if ($die == true) {
        die($SELECT_configurations);
    }
    $QUERY_configurations = mysqli_query($DBConnection, $SELECT_configurations);
    $Configurations = mysqli_fetch_array($QUERY_configurations);
    $IsConfigurationFetched = mysqli_num_rows($QUERY_configurations);
    if ($IsConfigurationFetched == 0) {
        $Value = "null";
    } else {
        $Value = $Configurations['configurationvalue'];
    }

    return $Value;
}

//configuration
function CONFIG_FIELDS($Data, $VALUE, $die = false)
{
    global $DBConnection;
    $SELECT_configurations = "SELECT * FROM configurations where configurationname='$Data'";

    //die entry
    if ($die == true) {
        die($SELECT_configurations);
    }

    $QUERY_configurations = mysqli_query($DBConnection, $SELECT_configurations);
    $Configurations = mysqli_fetch_array($QUERY_configurations);
    $IsConfigurationFetched = mysqli_num_rows($QUERY_configurations);
    if ($IsConfigurationFetched == 0) {
        $Value = "null";
    } else {
        $Value = $Configurations["$VALUE"];
    }

    return $Value;
}

//amount total
function AMOUNT($SQL, $T)
{
    global $DBConnection;
    $TotalAmountPaid = SELECT("$SQL");
    $TotalAmount = 0;
    while ($fetchtotalpayment = mysqli_fetch_array($TotalAmountPaid)) {
        $TotalAmount += $fetchtotalpayment["$T"];
    }
    if ($TotalAmount == 0 or $TotalAmount == null) {
        $TotalAmount = 0;
    } else {
        $TotalAmount = $TotalAmount;
    }
    return $TotalAmount;
}


//Suggestion List
function SUGGEST($table = "false", $column, $order, $enc = null)
{
    if ($table != "false") {
        $CHECK_project_tags = CHECK("SELECT $column FROM $table");
        if ($CHECK_project_tags != 0) {
            echo "<datalist id='$column'>";
            $SQL_project_tags = SELECT("SELECT $column FROM $table GROUP by $column ORDER BY $column $order");
            while ($FetchTags = mysqli_fetch_array($SQL_project_tags)) {
                if ($enc == null) {
                    echo "<option value='" . $FetchTags["$column"] . "'>";
                } else { ?>
                    <option value='<?php echo SECURE($FetchTags["$column"], "$enc"); ?>'></option>
                <?php }
            }
            echo "</datalist>";
        }
    } else {
    }
}

//Suggestion List
function SQL_SUGGEST($sql, $column, $enc = null)
{
    if ($sql != "false") {
        $CHECK_project_tags = CHECK($sql);
        if ($CHECK_project_tags != 0) {
            echo "<datalist id='$column'>";
            $SQL_project_tags = SELECT($sql);
            while ($FetchTags = mysqli_fetch_array($SQL_project_tags)) {
                if ($enc == null) {
                    echo "<option value='" . $FetchTags["$column"] . "'>";
                } else { ?>
                    <option value='<?php echo SECURE($FetchTags["$column"], "$enc"); ?>'></option>
<?php }
            }
            echo "</datalist>";
        }
    } else {
    }
}



//fetch values
function FETCH($SQL, $data, $die = false)
{
    if ($die == true) {
        SELECT($SQL, true);
    } else {
        $Query = SELECT($SQL);
        $CountData = mysqli_num_rows($Query);
        if ($CountData == null) {
            $results = null;
        } else {
            $FetchDATA = mysqli_fetch_array($Query);
            $ReturnData = $FetchDATA["$data"];
            $results = $ReturnData;
        }
        return $results;
    }
}
//get single values
function GET_DATA($tableName, $columnName, $conditions, $enc = null, $die = false)
{
    if ($die == true) {
        return SELECT("SELECT $columnName FROM $tableName WHERE $conditions", true);
    } else {
        $FetchedData = FETCH("SELECT $columnName FROM $tableName WHERE $conditions", "$columnName");
        if ($FetchedData == null) {
            $results = 'NA';
        } else {
            if ($enc != null) {
                $results = SECURE($FetchedData, $enc);
            } else {
                $results = $FetchedData;
            }
        }
        return $results;
    }
}

//fetch data
function FETCH_DATA($SQL)
{
    $Query = SELECT($SQL);
    $FetchDATA = mysqli_fetch_array($Query);
    if ($FetchDATA == null) {
        $results = null;
    } else {
        $results = $FetchDATA;
    }

    return $results;
}

//fetch all in array / json formate
function FETCH_DB_TABLE($sql, $array = false)
{
    $Data = SELECT("$sql");
    $Count = CHECK("$sql");
    if ($Count == 0) {
        return null;
    } else {
        while ($FetchAllData = mysqli_fetch_assoc($Data)) {
            $FetchedColumns[] = $FetchAllData;
        }

        if ($array == true) {
            return json_decode(json_encode($FetchedColumns));
        } else {
            return json_encode($FetchedColumns);
        }
    }
}


//upate table
function UPDATE_TABLE($sqltables, array $colums, $conditions, $die = false)
{
    $AvalableArrays = count($colums) - 1;
    $Columns = "";
    foreach ($colums as $key => $value) {
        global $$value;
        if ($AvalableArrays == $key) {
            $Columns .= $value . "='" . $$value . "'";
        } else {
            $Columns .= $value . "='" . $$value . "',";
        }
    }

    $Update = UPDATE("UPDATE $sqltables SET $Columns where $conditions");

    //die entry
    if ($die == true) {
        UPDATE("UPDATE $sqltables SET $Columns where $conditions", true);
    }

    if ($Update == true) {
        return true;
    } else {
        return false;
    }
}

//delete
function DELETE_FROM($table, $conditions, $die = false)
{

    //die entry
    if ($die == true) {
        die(DELETE("DELETE FROM $table WHERE $conditions", true));
    } else {
        $Delete = DELETE("DELETE FROM $table WHERE $conditions");
    }

    //die entry
    if ($die == true) {
        die($Delete);
    }

    if ($Delete == true) {
        return true;
    } else {
        return false;
    }
}

//upate table
function UPDATE_DATA($sqltables, array $colums, $conditions, $die = false)
{
    $AvalableArrays = count($colums) - 1;
    $Columns = "";
    $countkeys = 0;
    echo "<br><b style='color:green;'>• REQUESTING </b> -> <b>[$sqltables]</b> ---- <b style='color:green;'>Sent!</b> <br><b style='color:red'><i> Data Received</i></b> <b>[$sqltables]</b> @ [<br>";
    foreach ($colums as $key => $value) {
        $countkeys++;
        $$value = $value;
        global $$value;
        echo "&nbsp;&nbsp; <b style='color:grey;'> Index:</b> $countkeys ( <b> " . $key . "</b> : " . $value . " ) <br>";
        if ($countkeys <= $AvalableArrays) {
            $Columns .= "$key='" . htmlentities($value) . "', ";
        } else {
            $Columns .= "$key='" . htmlentities($value) . "' ";
        }
    }

    echo "]<br> ---<b style='color:primary;'>END</b><br><hr>---";

    $Update = UPDATE("UPDATE $sqltables SET $Columns where $conditions");

    //die entry
    if ($die == true) {
        UPDATE("UPDATE $sqltables SET $Columns where $conditions", true);
    }

    if ($Update == true) {
        return true;
    } else {
        return false;
    }
}
//upate table
function UPDATE_DATA_WITHOUT_RESPONSE($sqltables, array $colums, $conditions, $die = false)
{
    $AvalableArrays = count($colums) - 1;
    $Columns = "";
    $countkeys = 0;
    // echo "<br><b style='color:green;'>• REQUESTING </b> -> <b>[$sqltables]</b> ---- <b style='color:green;'>Sent!</b> <br><b style='color:red'><i> Data Received</i></b> <b>[$sqltables]</b> @ [<br>";
    foreach ($colums as $key => $value) {
        $countkeys++;
        $$value = $value;
        global $$value;
        // echo "&nbsp;&nbsp; <b style='color:grey;'> Index:</b> $countkeys ( <b> " . $key . "</b> : " . $value . " ) <br>";
        if ($countkeys <= $AvalableArrays) {
            $Columns .= "$key='" . htmlentities($value) . "', ";
        } else {
            $Columns .= "$key='" . htmlentities($value) . "' ";
        }
    }

    // echo "]<br> ---<b style='color:primary;'>END</b><br><hr>---";

    $Update = UPDATE("UPDATE $sqltables SET $Columns where $conditions");

    //die entry
    if ($die == true) {
        UPDATE("UPDATE $sqltables SET $Columns where $conditions", true);
    }

    if ($Update == true) {
        return true;
    } else {
        return false;
    }
}
//INsert new data
function INSERT($tablename, array  $RequestedData, $die = false)
{

    global $DBConnection;

    $TableValues = "";
    $Datatables = "";

    $table_columns = array_keys($RequestedData);
    $arraycount = count($table_columns);
    $mainarray = $arraycount - 1;
    $countkeys = 0;
    $requesting = "";

    foreach ($RequestedData as $key => $data) {
        $countkeys++;
        $$data = $data;
        global $$data;
        if ($data == null || $data == " " || $data == "") {
            $d_r = "style='color:red;'";
        } else {
            $d_r = "";
        }
        if ($countkeys <= $mainarray) {
            $TableValues .= "'" . htmlentities($data) . "', ";
        } else {
            $TableValues .= "'" . htmlentities($data) . "' ";
        }

        if ($countkeys <= $mainarray) {
            $Datatables .= "$key, ";
        } else {
            $Datatables .= "$key ";
        }
    }

    $InsertNewData = "INSERT INTO $tablename ($Datatables) VALUES ($TableValues)";

    //die entry
    if ($die == true) {
        die($InsertNewData);
    }
    $Query = mysqli_query($DBConnection, $InsertNewData);

    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}
//INsert new data without response
function INSERT_DATA_WITHOUT_RESPONSE($tablename, array  $RequestedData, $Response = false, $die = false)
{

    global $DBConnection;

    $TableValues = "";
    $Datatables = "";

    $table_columns = array_keys($RequestedData);
    $arraycount = count($table_columns);
    $mainarray = $arraycount - 1;
    $countkeys = 0;
    if ($Response == true) {
        echo "<br><b style='color:green;'>• REQUESTING </b> -> <b>[$tablename]</b> ---- <b style='color:green;'>Sent!</b> <br><b style='color:red'><i> Data Received</i></b> <b>[$tablename]</b> @ [<br>";
    }
    foreach ($RequestedData as $key => $data) {
        $countkeys++;
        $$data = $data;
        global $$data;
        if ($Response == true) {
            echo "&nbsp;&nbsp; <b style='color:grey;'> Index:</b> $countkeys ( <b> " . $key . "</b> : " . $data . " ) <br>";
        }
        if (
            $countkeys <= $mainarray
        ) {
            $TableValues .= "'" . htmlentities($data) . "', ";
        } else {
            $TableValues .= "'" . htmlentities($data) . "' ";
        }

        if (
            $countkeys <= $mainarray
        ) {
            $Datatables .= "$key, ";
        } else {
            $Datatables .= "$key ";
        }
    }
    if ($Response == true) {
        echo "]<br> ---<b style='color:primary;'>END</b><br><hr>---";
    }

    $InsertNewData = "INSERT INTO $tablename ($Datatables) VALUES ($TableValues)";

    //die entry
    if ($die == true) {
        die($InsertNewData);
    }
    $Query = mysqli_query($DBConnection, $InsertNewData);
    if ($Query == true) {
        return true;
    } else {
        return false;
    }
}
