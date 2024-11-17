<?php
//run auto load files
$Check = CHECK("SELECT * FROM configurations where configurationname='DEFAULT_RECORD_LISTING'");
if ($Check == null) {
    $values = [
        "configurationname" => "DEFAULT_RECORD_LISTING",
        "configurationvalue" => 15,
    ];
    INSERT("configurations", $values);
} else {
    DEFINE("DEFAULT_RECORD_LISTING", CONFIG("DEFAULT_RECORD_LISTING"));
}

//auto update OD Forms 
$GetODDATA = FETCH_DB_TABLE("SELECT * FROM od_forms where OdFormStatus='APPROVED' ORDER BY OdFormId DESC", true);
if ($GetODDATA != null) {
    foreach ($GetODDATA as $ODs) {
        $OdRequestDate = $ODs->OdRequestDate;
        $CurrentData = date("Y-m-d");
        $OdFormId = $ODs->OdFormId;

        if (strtotime($OdRequestDate) == strtotime($CurrentData)) {
            UPDATE("UPDATE od_forms SET ODFormStatus='ACTIVE' where OdFormId='$OdFormId'");

            $Status = "ACTIVE";
            //save od status
            $od_form_status = [
                "OdFormMainId" => $OdFormId,
                "OdFormStatusAddedBy" => $_SESSION['LOGIN_USER_ID'],
                "OdFormStatusRemarks" => "OD Request is $Status!",
                "OdFormStatusAddedAt" => CURRENT_DATE_TIME,
                "OdFormStatus" => "ACTIVE"
            ];
            INSERT("od_form_status", $od_form_status);

            //send status mail to member
            $UserId = FETCH("SELECT OdMainUserId FROM od_forms WHERE OdFormId='$OdFormId'", "OdMainUserId");
            $SentTO = GET_DATA("users", "UserEmailId", "UserId='$UserId'");

            //Message for mail
            $Title = "Dear " . GET_DATA("users", "UserFullName", "UserId='$UserId'") . ", ";
            $Message = "your OD <b>" . GET_DATA("od_forms", "OdReferenceId", "OdFormId='$OdFormId'") . "</b> has been started today, which is approved on ";
            $Message .= "<b>" . DATE_FORMATE("d M, Y h:i A", CURRENT_DATE_TIME) . "</b> ";
            $Message .= " for date <b>" . DATE_FORMATE("d M, Y", GET_DATA("od_forms", "OdRequestDate", "OdFormId='$OdFormId'")) . "</b> from";
            $Message .= " <b>" . DATE_FORMATE("h:i a", GET_DATA("od_forms", "OdPermissionTimeFrom", "OdFormId='$OdFormId'")) . "</b> to";
            $Message .= " <b>" . DATE_FORMATE("h:i a", GET_DATA("od_forms", "OdPermissionTimeTo", "OdFormId='$OdFormId'")) . "</b> for";
            $Message .= " <b>" . SECURE(GET_DATA("od_forms", "OdBriefReason", "OdFormId='$OdFormId'"), "d") . "</b>";

            SENDMAILS("OD Request is $Status @ " . GET_DATA("od_forms", "OdReferenceId", "OdFormId='$OdFormId'"), $Title, $SentTO, $Message);
        }
    }
}


//auto update OD Forms 
$GetODDATA2 = FETCH_DB_TABLE("SELECT * FROM od_forms where OdFormStatus='ACTIVE' ORDER BY OdFormId DESC", true);
if ($GetODDATA2 != null) {
    foreach ($GetODDATA2 as $ODs2) {
        $OdRequestDate = $ODs2->OdRequestDate;
        $CurrentData = date("Y-m-d");
        $OdFormId = $ODs2->OdFormId;

        if (strtotime($OdRequestDate) < strtotime($CurrentData)) {
            UPDATE("UPDATE od_forms SET ODFormStatus='COMPLETED' where OdFormId='$OdFormId'");

            $Status = "COMPLETED";
            //save od status
            $od_form_status = [
                "OdFormMainId" => $OdFormId,
                "OdFormStatusAddedBy" => $_SESSION['LOGIN_USER_ID'],
                "OdFormStatusRemarks" => "OD Request is $Status!",
                "OdFormStatusAddedAt" => CURRENT_DATE_TIME,
                "OdFormStatus" => "COMPLETED"
            ];
            INSERT("od_form_status", $od_form_status);

            //send status mail to member
            $UserId = FETCH("SELECT OdMainUserId FROM od_forms WHERE OdFormId='$OdFormId'", "OdMainUserId");
            $SentTO = GET_DATA("users", "UserEmailId", "UserId='$UserId'");

            //Message for mail
            $Title = "Dear " . GET_DATA("users", "UserFullName", "UserId='$UserId'") . ", ";
            $Message = "your OD <b>" . GET_DATA("od_forms", "OdReferenceId", "OdFormId='$OdFormId'") . "</b> has been started today, which is approved on ";
            $Message .= "<b>" . DATE_FORMATE("d M, Y h:i A", CURRENT_DATE_TIME) . "</b> ";
            $Message .= " for date <b>" . DATE_FORMATE("d M, Y", GET_DATA("od_forms", "OdRequestDate", "OdFormId='$OdFormId'")) . "</b> from";
            $Message .= " <b>" . DATE_FORMATE("h:i a", GET_DATA("od_forms", "OdPermissionTimeFrom", "OdFormId='$OdFormId'")) . "</b> to";
            $Message .= " <b>" . DATE_FORMATE("h:i a", GET_DATA("od_forms", "OdPermissionTimeTo", "OdFormId='$OdFormId'")) . "</b> for";
            $Message .= " <b>" . SECURE(GET_DATA("od_forms", "OdBriefReason", "OdFormId='$OdFormId'"), "d") . "</b>";

            SENDMAILS("OD Request is $Status @ " . GET_DATA("od_forms", "OdReferenceId", "OdFormId='$OdFormId'"), $Title, $SentTO, $Message);
        }
    }
}
