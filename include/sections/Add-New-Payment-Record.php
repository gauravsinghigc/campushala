<section class="pop-section hidden" id="ReceivePayments">
  <div class="action-window">
    <div class='container'>
      <div class='row'>
        <div class='col-md-12'>
          <h4 class='app-heading'>Add Payment Record</h4>
        </div>
      </div>
      <form action="<?php echo CONTROLLER; ?>/PaymentController.php" method="POST">
        <?php FormPrimaryInputs(true); ?>
        <div class="row">
          <div class='col-md-3 form-group'>
            <label>Select Bookings</label>
            <select name='RegMainId' class='form-control form-control-sm' required>
              <option value='0'>Select Booking</option>
              <?php
              $AllData = FETCH_DB_TABLE("SELECT * FROM registrations where RegMainCustomerId='$ViewCustomerId' ORDER BY RegistrationId DESC", true);
              if ($AllData != null) {
                foreach ($AllData as $RegNo) {
              ?>
                  <option value='<?php echo $RegNo->RegistrationId; ?>'>ACKCode :<?php echo $RegNo->RegAcknowledgeCode; ?></option>
              <?php }
              } ?>
            </select>
          </div>
          <div class="col-md-3 form-group">
            <label>Payment Mode <?php echo $req; ?></label>
            <select onchange="PaymentMode()" id="PayModes" class='form-control form-control-sm' name='RegPayMode' required="">
              <?php InputOptions(["Select Pay Mode", "CASH", "ONLINE_TRANSFER", "CHEQUE_DD", "WALLET_UPI"], "Select Pay Mode"); ?>
            </select>
          </div>

          <div class="col-md-3 form-group">
            <label>Tax (in %) <?php echo $req; ?></label>
            <select onchange="GetPayingAmount()" id="ApplyTax" name="RegPayTaxPercentage" class="form-control form-control-sm" required="">
              <?php InputOptions(["No Tax", "5", "12", "18", "28"], "No Tax"); ?>
            </select>
          </div>
          <div class="col-md-3 form-group">
            <label>Paying Amount <?php echo $req; ?> <span id="payerrs"></span></label>
            <input type="number" name="PayingAmount" oninput="CustomAmountEntry()" class="form-control form-control-sm" min="1" id="PayingAmount" required="">
          </div>
        </div>

        <!-- CASH PAYMENT -->
        <div id="CASH" class='hidden'>
          <div class="row">
            <div class="col-md-12">
              <h6 class="mb-0 mt-1">Cash Payment Details</h6>
            </div>
            <div class="form-group col-md-3">
              <label>Cash Amount <?php echo $req; ?></label>
              <input type="number" name="CASH_Amount" id="CashAmount" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-6">
              <label>Cash Received By <?php echo $req; ?></label>
              <input type="text" name="CASH_ReceivedBy" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-3">
              <label>Cash Received On <?php echo $req; ?></label>
              <input type="date" name="CASH_ReceiveDate" value="<?php echo date("Y-m-d"); ?>" class="form-control form-control-sm">
            </div>
          </div>
        </div>

        <!-- ONLINE TRANSFER -->
        <div id="ONLINE_TRANSFER" class='hidden'>
          <div class="row">
            <div class="col-md-12">
              <h6 class="mb-0 mt-1">Online Transfer Details</h6>
            </div>
            <div class="col-md-4 form-group">
              <label>Bank Name <?php echo $req; ?></label>
              <input type="text" name="ONLINE_BankName" class="form-control form-control-sm">
            </div>
            <div class="col-md-3 form-group">
              <label>Transfer Type <?php echo $req; ?></label>
              <select name="ONLINE_TransferType" class="form-control form-control-sm">
                <?php InputOptions(["IMPS", "NEFT", "RTGS", "Select Type"], "Select Type"); ?>
              </select>
            </div>
            <div class="col-md-5 form-group">
              <label>Transfer Ref No <?php echo $req; ?></label>
              <input type="text" name="ONLINE_TransferRefNo" class="form-control form-control-sm">
            </div>
            <div class="col-md-3 form-group">
              <label>Transfer Status <?php echo $req; ?></label>
              <select name="ONLINE_TransferStatus" class="form-control form-control-sm">
                <?php InputOptions(["Paid", "Pending", "Failed", "Select Status"], "Select Status"); ?>
              </select>
            </div>
            <div class="col-md-3 form-group">
              <label>Transfer Date <?php echo $req; ?></label>
              <input type="date" value="<?php echo date("Y-m-d"); ?>" name="ONLINE_TransferDate" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-6">
              <label>Received By <?php echo $req; ?></label>
              <input type="text" name="ONLINE_ReceivedBy" value="" class="form-control form-control-sm">
            </div>
          </div>
        </div>

        <!-- CHEQUE OR DD PAYMENT -->
        <div id="CHEQUE_DD" class="hidden">
          <div class="row">
            <div class="col-md-12">
              <h6 class="mb-0 mt-1">Cheque/DD Payment Details</h6>
            </div>
            <div class="col-md-4 form-group">
              <label>Bank Name <?php echo $req; ?></label>
              <input type="text" name="CHEQUE_BankName" class="form-control form-control-sm">
            </div>
            <div class="col-md-4 form-group">
              <label>IFSC Code <?php echo $req; ?></label>
              <input type="text" name="CHEQUE_ISFCCode" class="form-control form-control-sm">
            </div>
            <div class="col-md-4 form-group">
              <label>Cheque/DD No <?php echo $req; ?></label>
              <input type="text" name="CHEQUE_No" class="form-control form-control-sm">
            </div>
            <div class="col-md-3 form-group">
              <label>Cheque/DD Status <?php echo $req; ?></label>
              <select name="CHEQUE_Status" class="form-control form-control-sm">
                <?php InputOptions(["Issued", "Cleared", "Bounce", "Select Status"], "Select Status"); ?>
              </select>
            </div>
            <div class="col-md-3 form-group">
              <label>Issue Date <?php echo $req; ?></label>
              <input type="date" value="<?php echo date("Y-m-d"); ?>" name="CHEQUE_IssueDate" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-6">
              <label>Issued By <?php echo $req; ?></label>
              <input type="text" name="CHEQUE_IssuedBy" value="" class="form-control form-control-sm">
            </div>
          </div>
        </div>

        <!-- WALLET - UPI PAYMENT -->
        <div id="WALLET_UPI" class="hidden">
          <div class="row">
            <div class="col-md-12">
              <h6 class="mb-0 mt-1">Wallat/UPI Payment Details</h6>
            </div>
            <div class="col-md-4 form-group">
              <label>Wallet/UPI App Name <?php echo $req; ?></label>
              <input type="text" name="WALLET_Name" class="form-control form-control-sm">
            </div>
            <div class="col-md-4 form-group">
              <label>Sender Phone no <?php echo $req; ?></label>
              <input type="text" name="WALLET_PhoneNumber" class="form-control form-control-sm">
            </div>
            <div class="col-md-4 form-group">
              <label>Txn Ref No <?php echo $req; ?></label>
              <input type="text" name="WALLET_RefNo" class="form-control form-control-sm">
            </div>
            <div class="col-md-3 form-group">
              <label>Txn Status <?php echo $req; ?></label>
              <select name="WALLET_TxnStatus" class="form-control form-control-sm">
                <?php InputOptions(["Paid", "Pending", "Rejected", "Failed", "Select Status"], "Select Status"); ?>
              </select>
            </div>
            <div class="col-md-3 form-group">
              <label>Txn Date <?php echo $req; ?></label>
              <input type="date" value="<?php echo date("Y-m-d"); ?>" name="WALLET_TxnDate" class="form-control form-control-sm">
            </div>
            <div class="form-group col-md-6">
              <label>Sender Name <?php echo $req; ?></label>
              <input type="text" name="WALLET_SenderName" value="" class="form-control form-control-sm">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 form-group">
            <label>Add More details <?php echo $req; ?></label>
            <textarea name="PAYMENT_MORE_DETAILS" class="form-control form-control-sm" rows="3"></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="flex-s-b">
              <button type="submit" name="SavePaymentDetails" class="btn btn-sm btn-success"><i class='fa fa-check'></i> Save Record</button>
              <a href="#" onclick="Databar('ReceivePayments')" class="btn btn-sm btn-default"> Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<script>
  function PaymentMode() {
    let AvailableModes = ["CASH", "ONLINE_TRANSFER", "CHEQUE_DD", "WALLET_UPI"];
    AvailableModes.forEach((id) => {
      let div = document.getElementById(id);
      div.style.display = 'none';

      //make default all optional
      function makesRequired() {
        let inputs = div.querySelectorAll("input");
        inputs.forEach(input => {
          input.required = false;
        });
      }
      makesRequired();
    });
    let selectedDiv = document.getElementById("PayModes").value;
    let div = document.getElementById(selectedDiv);
    div.style.display = 'block';

    //make selected required
    function makeRequired() {
      let inputs = div.querySelectorAll("input");
      inputs.forEach(input => {
        input.required = true;
      });
    }
    makeRequired();
  }

  function GetPayingAmount() {
    var SelectedAmountSlab = document.getElementById("SelectedAmountSlab");
    var NetPayableAmount = 0;
    var PayingAmount = document.getElementById("PayingAmount");
    var CashAmount = document.getElementById("CashAmount");
    var CurrentPaying_TEXT = document.getElementById("CurrentPaying_TEXT");
    var ApplyTax = document.getElementById("ApplyTax");
    var NetRegPayable = document.getElementById("NetRegPayable");
    var TEXT_NetPayable = document.getElementById("TEXT_NetPayable");
    var TaxTr = document.getElementById("TaxTr");
    var TEXT_TaxAmount = document.getElementById("TEXT_TaxAmount");
    var TEXT_Balance = document.getElementById("TEXT_Balance");

    //calculate taxes
    //No Tax
    if (ApplyTax.value == "No Tax") {
      var TaxableAmount = 0;
      TEXT_TaxAmount.innerHTML = "No Tax";
      ///with tax
    } else {
      var TaxableAmount = NetPayableAmount / 100 * ApplyTax.value;
      var TaxableAmount = Math.round(TaxableAmount);
      TEXT_TaxAmount.innerHTML = "+ Rs." + TaxableAmount + " (" + ApplyTax.value + "% GST )";
    }

    //calculate amount as per percentage slab
    var NetPayableAmount = NetPayableAmount + TaxableAmount;
    var NetPayingAmount = NetPayableAmount / 100 * SelectedAmountSlab.value;
    var NetPayingAmount = Math.round(NetPayingAmount);

    //distribute response
    NetRegPayable.value = NetPayableAmount;
    TEXT_NetPayable.innerHTML = NetPayableAmount;
    PayingAmount.value = NetPayingAmount;
    CurrentPaying_TEXT.innerHTML = NetPayingAmount;
    CashAmount.value = NetPayingAmount;
    TEXT_Balance.innerHTML = NetPayableAmount - NetPayingAmount;
  }

  function CustomAmountEntry() {
    var PayingAmount = document.getElementById("PayingAmount");
    var NetRegPayable = document.getElementById("NetRegPayable");
    var CashAmount = document.getElementById("CashAmount");
    var TEXT_Balance = document.getElementById("TEXT_Balance");
    var CurrentPaying_TEXT = document.getElementById("CurrentPaying_TEXT");
    var payerrs = document.getElementById("payerrs");
    payerrs.style.display = "none";
    CurrentPaying_TEXT.innerHTML = PayingAmount.value;
    CashAmount.value = PayingAmount.value;
    TEXT_Balance.innerHTML = NetRegPayable.value - PayingAmount.value;
    CashAmount.value = PayingAmount.value;
  }
</script>