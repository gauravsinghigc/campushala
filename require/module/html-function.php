<?php
//request variables
function Req_Data($req, $method, $sessional = false, $securitylevel = "enc")
{

  //get & post method data access
  if ($method === "GET") {
    $RequestedData = $_GET["$req"];
  } elseif ($method === "POST") {
    $RequestedData = $_POST["$req"];
  } else {
    $RequestedData = false;
  }

  //encrptionlevel
  if ($securitylevel == "enc") {
    $RequestedData = SECURE($RequestedData, "e");
  } else {
    $RequestedData =  SECURE($RequestedData, "d");
  }

  //sessional access
  if ($sessional == true) {
    $_SESSION["$req"] = $RequestedData;
  } else {
    $_SESSION["$req"] = false;
  }

  //reqturn value
  if ($RequestedData == false) {
    return false;
  } else {
    return $RequestedData;
  }
}


//money formate
function moneyFormatIndia($number)
{
  $decimal = (string)($number - floor($number));
  $money = floor($number);
  $length = strlen($money);
  $delimiter = '';
  $money = strrev($money);

  for ($i = 0; $i < $length; $i++) {
    if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
      $delimiter .= ',';
    }
    $delimiter .= $money[$i];
  }

  $result = strrev($delimiter);
  $decimal = preg_replace("/0\./i", ".", $decimal);
  $decimal = substr($decimal, 0, 3);

  if ($decimal != '0') {
    $result = $result . $decimal;
  }

  return $result;
}

//price function display
function Price($price, $class = null, $icon = null)
{
  if ($price == null) {
    $price = 0;
  }
  $price = moneyFormatIndia($price);

  if ($icon == "icon") {
    $icon = "<i class='fa fa-inr'></i>";
  } else if ($icon == "text") {
    $icon = "INR";
  } else {
    $icon = $icon;
  }
  echo "<span class='$class'>$icon" . "" . "$price</span>";
}

//mrp price function display
function MrpPrice($price)
{
  echo "<span class='text-danger'><strike>Rs.$price</strike></span>";
}


//payment status
function PayStatus($paystatus)
{
  if ($paystatus == "Paid" || $paystatus == "Success" || $paystatus == "PAID") {
    echo "<span class='text-success'><i class='fa fa-check-circle'></i> Paid</span>";
  } elseif ($paystatus == "Cleared") {
    echo "<span class='text-success'><i class='fa fa-check-circle'></i> Cleared</span>";
  } else {
    echo "<span class='text-danger'><i class='fa fa-warning'></i> $paystatus</span>";
  }
}

//enquiry status
function EnquiryStatus($enquiryno)
{
  if ($enquiryno == "0") {
    echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Read</span>";
  } elseif ($enquiryno == "1") {
    echo "<span class='text-warning'><i>Read</i></span>";
  } elseif ($enquiryno == "2") {
    echo "<span class='text-success'><i class='fa fa-check-circle-o'></i> Replied</span>";
  } elseif ($enquiryno == "3") {
    echo "<span class='text-info'><i class='fa fa-info-circle'></i> Closed</span>";
  } else {
    echo "<span class='text-danger'><i class='fa fa-warning'></i> Un Read</span>";
  }
}

//delete confirmation pop 
function CONFIRM_DELETE_POPUP($id, array $Requests, $controller, $btnname = null, $btncss = null)
{
  $id = $id . "_" . rand(000, 9999999999999);
  //if btnname is null
  if ($btnname == null) {
    $btnname = "<i class='fa fa-trash'></i>";
  }

  //if btncss is null
  if ($btncss == null) {
    $btncss = "";
  }

  //create requests
  $CreateRequests = "?";
  foreach ($Requests as $key => $values) {
    if ($key == 0) {
      $CreateRequests .= "" . $key . "=" . SECURE($values, "e");
    } else {
      $CreateRequests .= "&" . $key . "=" . SECURE($values, "e");
    }
  }

  //default request
  $CreateRequests .= "&access_url=" . SECURE(RUNNING_URL, "e") . "&AuthToken=" . SECURE(VALIDATOR_REQ, "e");

  //define controller request 
  $Controller_Requests = CONTROLLER . "/" . $controller . ".php/" . $CreateRequests;
?>
  <a class="sqaure <?php echo $btncss; ?>" onclick="Databar('<?php echo $id; ?>')"><?php echo $btnname; ?></a>
  <section class="popup-background" id="<?php echo $id; ?>">
    <div class="action-area">
      <div class="ref-image">
        <img src="<?php echo ActionDeleteImage; ?>" class="pop-img">
      </div>
      <div class="activity-details">
        <h3 class="action-title">
          <span class="action-title-text"><?php echo ActionDeleteTitle; ?></span>
        </h3>
        <p class="action-desc">
          <span class="action-desc-text"><?php echo ActionDeleteMessage; ?></span>
        </p>
      </div>
      <div class="activity-action">
        <a onclick="Databar('<?php echo $id; ?>')" class="btn btn-lg btn-danger mr-2"><?php echo ActionDeleteCancel; ?></a>
        <a href="<?= $Controller_Requests ?>" class="btn btn-lg btn-success ml-2"><?php echo ActionDeleteConfirm; ?></a>
      </div>
    </div>
  </section>
  <?php }

//function for cal records
function CallTypes($calltype)
{
  if ($calltype == "incoming") {
    echo "<span><img src='" . STORAGE_URL_D . "/tool-img/leads.webp' class='w-50'></span>";
  } elseif ($calltype == "outgoing") {
    echo "<span><img src='" . STORAGE_URL_D . "/tool-img/leads.webp' class='w-50'></span>";
  } else {
    echo "<span><img src='" . STORAGE_URL_D . "/tool-img/leads.webp' class='w-50'></span>";
  }
}

//remindr gif
function Reminder()
{
  echo "<span><img src='" . STORAGE_URL_D . "/tool-img/alert-gif-8.gif' class='reminder-img'></span>";
}

//social accounts links
function SocialAccounts($listclass = null, $anchorclass = null, $iconclass = null)
{
  $SelectSocialAccounts = FETCH_DB_TABLE("SELECT* FROM socialaccounts where socialaccountstatus='1'", true);
  if ($SelectSocialAccounts != null) {
  ?>
    <?php foreach ($SelectSocialAccounts as $Social) {
    ?>
      <li class="mx-2 <?php echo $listclass; ?>">
        <a href="<?php echo $Social->socialaccounturl; ?>" class="<?php echo $anchorclass; ?>" target="<?php echo $Social->socialaccountopenat; ?>" alt="<?php echo $Social->socialaccountname; ?>" title="<?php echo $Social->socialaccountname; ?>">
          <i class="fa <?php echo $Social->socialaccounticon; ?> <?php echo $iconclass; ?>"></i>
        </a>
      </li>
  <?php }
  } else {
    return false;
  }
}


//page heading or page header
function PageHeader($page)
{
  $PageHeadingsName = $page;
  $PageHeadingImage = FETCH("SELECT * FROM page_headings where PageHeadingsName='$PageHeadingsName'", "PageHeadingBgImage");
  if ($PageHeadingImage == null || $PageHeadingImage == "" || $PageHeadingImage == "null") {
    $PageHeadingImage = null;
  } else {
    $PageHeadingImage = STORAGE_URL . "/headings/" . $PageHeadingImage;
  } ?>
  <section class="container-fluid section">
    <div class="row">
      <div class="col-md-12 page-headings account-header text-center p-5" style="background-image:url('<?php echo $PageHeadingImage; ?>') !important;">
        <h3 class="text-center">
          <?php echo FETCH("SELECT * FROM page_headings where PageHeadingsName='$PageHeadingsName'", "PageHeadingTitle"); ?>
        </h3>
        <p class="text-white">
          <?php echo SECURE(FETCH("SELECT * FROM page_headings where PageHeadingsName='$PageHeadingsName'", "PageHeadingDesc"), "d"); ?>
        </p>
      </div>
    </div>
  </section>
<?php }


//text area with editors
function TextareaWithEditor(array $attributes, $id)
{
?>
  <script>
    tinymce.init({
      selector: 'textarea#<?php echo $id; ?>',
      menubar: false
    });
  </script>
  <textarea id="<?php echo $id; ?>" <?php echo LOOP_TagsAttributes($attributes); ?>></textarea>
<?php
}


//lead priority level
function LeadStatus($level)
{
  if ($level == "UPLOADED") {
    echo "<span class='bg-info btn btn-xs rounded fs-10'>$level</span>";
  } elseif ($level == "TRANSFFERED") {
    echo "<span class='bg-success btn btn-xs rounded fs-10'>$level</span>";
  } else {
    echo "<span class='lead-status btn btn-xs'>$level</span>";
  }
}


//lead stage
function LeadStage($stage)
{
  $stage = str_replace("_", " ", $stage);
  $stage = ucwords($stage);
  return "<span class='lead-stage'>$stage</span>";
}


//function phone
function PHONE($phonenumber, $visibility = "text", $class = null, $icon = null)
{
  if ($phonenumber == null || $phonenumber == "" || $phonenumber == "null") {
    return false;
  } else {
    if ($visibility == "text") {
      echo "<span class='$class'><i class='$icon'></i> $phonenumber</span>";
    } else {
      echo "<a href='tel:$phonenumber' target='_blank' class='$class'><i class='$icon'></i> $phonenumber</a>";
    }
  }
}

//function email
function EMAIL($emailid, $visibility = "text", $class = null, $icon = null)
{
  if ($emailid == null || $emailid == "" || $emailid == "null") {
    return false;
  } else {
    if ($visibility == "text") {
      echo "<span class='$class'><i class='$icon'></i> $emailid</span>";
    } else {
      echo "<a href='mailto:$emailid' target='_blank' class='$class'><i class='$icon'></i> $emailid</a>";
    }
  }
}

//function website
function WEBSITE($website, $visibility = "text", $class = null, $icon = null)
{
  if ($website == null || $website == "" || $website == "null") {
    return false;
  } else {
    if ($visibility == "text") {
      echo "<span class='$class'><i class='$icon'></i> $website</span>";
    } else {
      echo "<a href='$website' target='_blank' class='$class'><i class='$icon'></i> $website</a>";
    }
  }
}

//function address
function ADDRESS($address, $visibility = "text", $class = null, $icon = null)
{
  if ($address == null || $address == "" || $address == "null") {
    return false;
  } else {
    if ($visibility == "text") {
      echo "<span class='$class'><i class='$icon'></i> $address</span>";
    } else {
      echo "<a href='https://www.google.com/maps/search/?api=1&query=$address' target='_blank' class='$class'><i class='$icon'></i> $address</a>";
    }
  }
}


//function for create sidebar menus
function SidebarMenus($MenuName, $menuicon, $mainmenid, array $submenus)
{
?>
  <div class="menu-item has-sub" id="<?php echo $mainmenid; ?>">
    <a href="javascript::" class="menu-link">
      <div class="menu-icon">
        <i class="fa <?php echo $menuicon; ?>"></i>
      </div>
      <div class="menu-text"><?php echo $MenuName; ?></div>
      <div class="menu-caret"></div>
    </a>
    <div class="menu-submenu">
      <?php foreach ($submenus as $key => $submenulist) { ?>
        <div class="menu-item" id="<?php echo $key; ?>">
          <a href="<?php echo $submenulist['dir']; ?>" class="menu-link">
            <div class="menu-text"><?php echo $submenulist['menuname']; ?></div>
          </a>
        </div>
      <?php } ?>
    </div>
  </div>
<?php
}

//function for payment modes