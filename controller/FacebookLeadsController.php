<?php
//add controller helper files
require 'helper.php';

//add aditional requirements
require '../require/admin/access-control.php';

if(isset($_POST['CreateLeads'])){

    $facebookAccountDetails=[
    "fb_page_name" => $_POST['fb_page_name'],
    "fb_adaccounts_id" =>$_POST['fb_adaccounts_id'],
    "fb_campaigns_id" => $_POST['fb_campaigns_id'],
    "fb_campaigns_name" => $_POST['fb_campaigns_name'],
    "fb_adsets_id" => $_POST['fb_adsets_id'],
    "fb_adsets_name" => $_POST['fb_adsets_name'],
    "fb_ads_id" => $_POST['fb_ads_id'],
    "fb_ads_name" => $_POST['fb_ads_name'],
        "created_by"=> LOGIN_UserId,
        "updated_by"=> LOGIN_UserId,
    ];
    $Save = INSERT("config_facebook_accounts", $facebookAccountDetails);
    RESPONSE($Save,"Facebook account details successfully saved","Something went wrong! Please try again later");

}
if(isset($_POST['FetchAllFBLeads'])){
    $Id = SECURE($_POST['requredid'],'d');
    $fb_page_name = $_POST['fb_page_name'];
    $fb_adaccounts_id =$_POST['fb_adaccounts_id'];
    $fb_campaigns_id = $_POST['fb_campaigns_id'];
    $fb_campaigns_name = $_POST['fb_campaigns_name'];
    $fb_adsets_id = $_POST['fb_adsets_id'];
    $fb_adsets_name = $_POST['fb_adsets_name'];
    $fb_ads_id = $_POST['fb_ads_id'];
    $fb_ads_name = $_POST['fb_ads_name'];
    $ch = curl_init();
    $url = "https://graph.facebook.com/v17.0/me?fields=id%2Cname%2Cadaccounts%7Baccount_id%2Caccount_status%2Ccampaigns%7Bid%2Cname%2Cstatus%2Cstart_time%2Cadsets%7Bid%2Cname%2Cstatus%2Cstart_time%2Cend_time%2Cads%7Bid%2Cname%2Cstatus%2Cleads%7D%7D%7D%7D&access_token=EAAKtlecmNCUBAGr3ddCbr8RPMzB9pxsTdqoPzloVEbuUoTp6aMaRZAc8Lp4BBXQbUZAxzyMJipETeFCfQ0EXzXLp7QdxP5pwPtKVYXD49a2waU7QjuapLImskQomk4k2TznZC0SgqwExzwwyL1rZAblUT7vGM70gWOFayCndZC9VE8jEvHBuu6mEZBpNyqyuf1IsZCzIY7NUyxb9c6HEPQo";
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($ch);
    if($e = curl_error($ch)){
        echo $e;
    }else{
        $decoded =json_decode($resp);
        $campaigns = $decoded-> adaccounts->data[0]->campaigns->data;
        foreach($campaigns as $campaignsData){
            if($campaignsData->id == $fb_campaigns_id){
               $Adsets= $campaignsData->adsets->data;
               foreach($Adsets as $adsetsData){
                if($adsetsData->id == $fb_adsets_id){
                  $Ads=$adsetsData->ads->data;
                  foreach($Ads as $adsData){
                    if($adsData->id == $fb_ads_id){
                     $leads = $adsData->leads->data;
                       foreach($leads as $leadsData){
                        foreach($leadsData->field_data as $leadsFieldData){
                           
                            if($leadsFieldData->name == "your_whatsapp_number"){
                            foreach ($leadsFieldData->values as $leadsFieldValues) {
                             $WhatsAppsNo = $leadsFieldValues;
                            }}
                            if ($leadsFieldData->name == "full_name") {
                            foreach ($leadsFieldData->values as $leadsFieldValues) {
                                $FullName = $leadsFieldValues;
                            }
                            }
                            if ($leadsFieldData->name == "city") {
                            foreach ($leadsFieldData->values as $leadsFieldValues) {
                                                    $City = $leadsFieldValues;
                            }
                               
                            }
                            if ($leadsFieldData->name == "your_mobile_number") {
                            foreach ($leadsFieldData->values as $leadsFieldValues) {
                                                    $MobileNo = $leadsFieldValues;
                            }
                               
                            }
                        }
                        $isLeadExists= CHECK("SELECT LeadsPhone FROM lead_uploads WHERE LeadsPhone='$MobileNo'");
                        if($isLeadExists != true){
                                        $FaceBookLeads = [
                                            "LeadsName" => $FullName,
                                            "LeadsPhone" => $MobileNo,
                                            "LeadsWhatsappPhoneNumber" => $WhatsAppsNo,
                                            "LeadsCity" => $City,
                                            "LeadsSource" => "Facebook",
                                            "UploadedOn" => CURRENT_DATE_TIME,
                                            "LeadStatus" => "Active",
                                            "LeadsUploadBy" => LOGIN_UserId,
                                            "LeadsUploadedfor" => "1",
                                            "LeadsAddress" => "Null",
                                            "LeadsProfession" => "Student",
                                            "LeadProjectsRef" => "Null",
                                        ];
                                        $Save = INSERT("lead_uploads", $FaceBookLeads); 
                        }else{
                            $Save="Null";
                        }
                    }
                                RESPONSE($Save, "All Facebook Lead Saved Successfully", "Something went wrong! Please try again later");
                  }

                }
               }
            }
        }
        }
     
     
    }
    curl_close($ch);
}