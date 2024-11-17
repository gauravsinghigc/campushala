<?php
$Dir = "../../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';

//pagevariables
$PageName = "Collect Fees";
$PageDescription = "Manage all domains";
$btntext = "Add New Leads";
$DomainExpireInCurrentMonth = date("Y-m-d", strtotime("+1 month"));

if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $from = $_GET['from'];
    $to = $_GET['to'];
    $by = $_GET['by'];
    $level = $_GET['level'];
    $LeadPersonSource = $_GET['LeadPersonSource'];
} else {
    $type = "";
    $from = date("Y-m-d");
    $to = date("Y-m-d");
    $by = "1";
    $level = "";
    $LeadPersonSource = "";
}
if (isset($_GET['sid']) || isset($_GET['sname'])) {
    $studentId = $_GET['sid'];
    $studentName = $_GET['sname'];
} else {
    $studentId = "";
    $studentName = "";
}
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
            document.getElementById("leads").classList.add("active");
            document.getElementById("lead_add_calls").classList.add("active");
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
                                        <div class="col-md-12">
                                            <h3 class="app-heading"><?php echo $PageName; ?></h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body fee-card-body">
                                                            <ul class="record-list" id="searchStudentsResult">

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <h6 class=""><b>Student Txn Details</b></h6>
                                                    <div class="table-container" style="max-height: 24rem; overflow-y: scroll;">
                                                        <table class="table table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Sem/Year</th>
                                                                    <th scope="col">Fee</th>
                                                                    <th scope="col">Method</th>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Details</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="TxnAllList">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-4" id="CourseDiv">
                                            <div class="card">
                                                <div class="card-body" id="ActiveCourseSemesterDetails">
                                                    <h5 class="card-title ">Active Courses/Semester</h5>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4" id="FeesDiv">
                                            <div class="card">
                                                <div class="card-body " id="payStudentFees">
                                                    <h5 class="card-title ">Collect Fees</h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8" id="DiscountDiv" style="display: none;">
                                            <div class="card">
                                                <div class="card-body " id="discountFees">
                                                    <h5 class="card-title ">Collect Fees</h5>


                                                </div>
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
        include $Dir . "/include/admin/footer.php"; ?>
    </div>

    <?php include $Dir . "/include/admin/footer_files.php"; ?>
    <script>
        $(document).ready(function() {
            $(document).on("click", ".course-fees", function() {
                // Remove the "active" class from all elements
                $('.course-fees').removeClass('active');

                // Add the "active" class to the clicked element
                $(this).addClass('active');
            });
        });
        $(window).on("load", function(e) {
            // This code will run after the page has fully loaded.
            // No need for setTimeout here.
            setTimeout(function() {
                // Select all elements with class course-fee-detail
                $(".course-fee-detail").each(function() {
                    var speciid = $(this).data("speciid");
                    var sessionid = $(this).data("sessionid");
                    var universityId = $(this).data("university_id");

                    // Perform the AJAX request for each element
                    $.ajax({
                        type: "POST",
                        url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                        data: {
                            speciid: speciid,
                            sessionid: sessionid,
                            universityId: universityId,
                            feesDetailsBtnView: "submit"
                        },
                        success: function(response) {
                            // Handle the response here for each element if needed
                            // You can append or update the #feeDetails element accordingly
                            $("#feeDetails").html(response);
                        }
                    });
                });
            }, 300)

        });
        $(document).on("click", ".course-fee-detail", function(e) {
            var speciid = $(this).data("speciid");
            var sessionid = $(this).data("sessionid");
            var universityId = $(this).data("university_id");
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                data: {
                    speciid: speciid,
                    sessionid: sessionid,
                    universityId: universityId,
                    feesDetailsBtnView: "submit"
                },
                success: function(response) {
                    $("#feeDetails").html(response);
                }
            });
        })
        $(document).on("click", ".tutition-fee-detail", function(e) {
            var speciid = $(this).data("speciid");
            var sessionid = $(this).data("sessionid");
            var universityId = $(this).data("university_id");
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                data: {
                    speciid: speciid,
                    sessionid: sessionid,
                    universityId: universityId,
                    feesDetailsTutitionBtnView: "submit"
                },
                success: function(response) {
                    $("#feeDetails").html(response);
                }
            });
        })
        // Show Semester Fee Fields
        const showFeesModesField = () => {
            const semesterSelects = document.getElementById("discountMode");
            const selectedSemesterOptions = semesterSelects.options[semesterSelects.selectedIndex].value;
            const semesterDivs = document.getElementById("SemestersFee");
            const yearsFeesDivs = document.getElementById("YearsFee");
            const oneTimeFeesDivs = document.getElementById("OneTimeFee");
            const courseTotalFeeDivs = document.getElementById("courseTotalFeeDivs");
            if (selectedSemesterOptions === "Semester Wise Discount") {
                semesterDivs.style.display = "block";
            } else {
                semesterDivs.style.cssText = "display: none !important;";
            }
            if (selectedSemesterOptions === "Year Wise Discount") {
                yearsFeesDivs.style.display = "block";
            } else {
                yearsFeesDivs.style.cssText = "display: none !important;";
            }
            if (selectedSemesterOptions === "On Total Fee Discount") {
                oneTimeFeesDivs.style.display = "block";
            } else {
                oneTimeFeesDivs.style.cssText = "display: none !important;";
            }
        };
        // Add Multiple Semester/Years/One Time For Add Discount
        $(document).ready(function() {
            $(document).on("click", ".add_semesters_name_btn", function(e) {

                e.preventDefault();
                $("#AddMoreSemesters").append(` <div class="row w-100 m-0" id="AddMoreSemesters">
            <div class="col-md-10 form-group d-flex">
                <div class="w-50">
                    <label>Semester Name <?php echo $req; ?></label>
                    <select name="semester_wise_discount[]" class="form-control ">
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
                        <option value="3">Third Semester</option>
                        <option value="4">Fourth Semester</option>
                        <option value="5">Fifth Semester</option>
                        <option value="6">Sixth Semester</option>
                        <option value="7">Seventh Semester</option>
                        <option value="8">Eighth Semester</option>
                        <option value="9">Ninth Semester</option>
                        <option value="10">Tenth Semester</option>
                    </select>
                </div>
                <div class="w-50" style="padding-left: 0.3125rem;">
                    <label>Discount Amount <?php echo $req; ?></label>
                    <input type="number" name="semester_wise_discount_amount[]" class="form-control " placeholder="10000">
                </div>
            </div>
            <div class="col-md-2 form-group ">
                <label></label>
                <button class="btn btn-outline-danger mt-3  remove_semesters_name_btn"><i class="bi bi-trash3-fill"></i></button>
            </div>
            </div>`);
            });
            $(document).on('click', '.remove_semesters_name_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
            //Add Multiple Years
            $(document).on("click", ".add_more_year_btn", function(e) {
                e.preventDefault();
                $("#AddMoreYear").append(` <div class="row w-100 m-0" id="AddMoreYear">
                <div class="col-md-10 form-group d-flex">
                <div class="w-50">
                    <label>Year Name <?php echo $req; ?></label>
                    <select name="year_wise_discount[]" class="form-control ">
                        <option value="">choose year</option>
                        <option value="1">First Years</option>
                        <option value="2">Second Years</option>
                        <option value="3">Third Years</option>
                        <option value="4">Fourth Years</option>
                        <option value="5">Fifth Years</option>
                    </select>
                </div>
                <div class="w-50" style="padding-left: 0.3125rem;">
                    <label>Discount Amount <?php echo $req; ?></label>
                    <input type="number" name="year_wise_discount_amount[]" class="form-control " placeholder="10000">
                </div>
            </div>
            <div class="col-md-2 form-group ">
                <label></label>
                <button class="btn btn-outline-danger mt-3 remove_more_year_btn"><i class="bi bi-trash3-fill"></i></button>
            </div>
            </div>`);
            });
            $(document).on('click', '.remove_more_year_btn', function(e) {
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });


        });
        // Search Students By Name & By Window On Change
        $(document).ready(function() {
            // On KeyUp Searxh Name
            $("#searchActiveStudents").on("keyup", function(e) {
                e.preventDefault();
                let SearchValue = $(this).val();
                loadTableTxnDetails();
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                    data: {
                        SearchValue: SearchValue,
                        SearchKeyUpSubmit: "submit",
                    },
                    success: function(response) {
                        $("#searchStudentsResult").html(response);
                    }
                });
            });
            // Search by Student Id
            if (<?= json_encode($studentId) ?> !== "" || <?= json_encode($studentName) ?> !== "") {
                let studentId = <?= json_encode($studentId) ?>;
                let studentName = <?= json_encode($studentName) ?>;
                loadTableTxnDetails(studentId);
                $.ajax({
                    type: "POST",
                    url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                    data: {
                        studentId: studentId,
                        studentName: studentName,
                        SearchKeyUpSubmit: "submit",
                    },
                    success: function(response) {
                        $("#searchStudentsResult").html(response);
                    }
                });
            }


        });
        // Add Fees Mode
        $(document).on("click", "#AddFeesMode", function(e) {
            e.preventDefault();
            var studFeeCollectId = $(this).attr("data-studFeeCollectId");
            var studFeeModesId = $(this).attr("data-studFeeModesId");
            var studSpecilizationFeeId = $(this).attr("data-specilizationFeesId");
            $.ajax({
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                method: "POST",
                data: {
                    studFeeCollectId: studFeeCollectId,
                    studFeeModesId: studFeeModesId,
                    studSpecilizationFeeId: studSpecilizationFeeId,
                    addFeesMode: "Submit",
                },
                success: function(response) {
                    $("#ActiveCourseSemesterDetails").html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Session data:', error);
                },
            });
        });
        // Save Fees Mode
        $(document).on("click", "#saveFeesMode", function(e) {
            e.preventDefault();
            var studentId = <?= $studentId ?>;
            var feeModeId = $("#feeModeId").val();
            var studFeesCollectId = $("#studFeesCollectId").val();
            var studFeesModesId = $("#studFeesModesId").val();
            var studSpeciliFeesId = $("#studSpecilizationFeeId").val();
            $.ajax({
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                method: "POST",
                data: {
                    feeModeId: feeModeId,
                    studFeesCollectId: studFeesCollectId,
                    studFeesModesId: studFeesModesId,
                    studSpeciliFeesId: studSpeciliFeesId,
                    saveFeesMode: "save",
                },
                success: function(response) {
                    $("#ActiveCourseSemesterDetails").html(response);
                    // Refresh/Update Search Student Results
                    refreshStudentSearchResult(studentId);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Session data:', error);
                },
            });
        })
        // Add Discount On The Basic oF Fees Mode
        $(document).on("click", "#addDiscount", function(e) {
            e.preventDefault();
            // Show the "discountFees" div
            var studDiscountId = $(this).attr("data-discountId");
            var studFeeModeId = $(this).attr("data-feeModeId");

            $("#CourseDiv").hide();
            $("#FeesDiv").hide();
            $("#DiscountDiv").show();
            $.ajax({
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                method: "POST",
                data: {
                    studDiscountId: studDiscountId,
                    studFeeModeId: studFeeModeId,
                    addDiscount: "Submit",
                },
                success: function(response) {
                    $("#discountFees").html(response);

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Session data:', error);
                },
            });
        })
        // Add Discount According to Fees Mode
        $(document).on("submit", "#discountForm", function(e) {
            e.preventDefault();
            var studentId = <?= $studentId ?>;
            var formData = {
                studDiscountId: $("input[name='studDiscountId']").val(),
                DiscountType: $("select[name='discount_type']").val(),
                DiscountMode: $("select[name='discount_mode']").val(),
                SemesterWiseName: $("select[ name='semester_wise_discount[]']").map(function() {
                    return this.value;
                }).get(),
                SemesterWiseAmount: $("input[ name='semester_wise_discount_amount[]']").map(function() {
                    return this.value;
                }).get(),
                YearWiseName: $("select[ name='year_wise_discount[]']").map(function() {
                    return this.value;
                }).get(),
                YearWiseAmount: $("input[ name='year_wise_discount_amount[]']").map(function() {
                    return this.value;
                }).get(),
                OneTimeName: $("select[ name='onetime_wise_discount[]']").map(function() {
                    return this.value;
                }).get(),
                OneTimeAmount: $("input[ name='onetime_wise_discount_amount[]']").map(function() {
                    return this.value;
                }).get(),
            };
            // Add the button name and value to the courseSpecilizationData object
            formData.saveDiscountAmount = "SaveDetails";
            $.ajax({
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                method: "POST",
                data: JSON.stringify(formData),
                contentType: "application/json",
                success: function(response) {
                    var responseData = JSON.parse(response);

                    // Now you can access the data from the server
                    var status = responseData.status; // "Success"
                    if (status == "Success") {

                        $("#DiscountDiv").html("");
                        $("#DiscountDiv").hide();
                        $("#CourseDiv").show();
                        $("#CourseDiv").html('<div class="card"><div class="card-body" id="ActiveCourseSemesterDetails"><h5 class="card-title">Active Courses / Semester</h5></div></div>');
                        $("#FeesDiv").show();
                        refreshStudentSearchResult(studentId);

                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error saving data:', error);
                },
            });
        });
        // Show Semmesters/Years/One Time Fees List
        $(document).on("click", "#showSemesterList", function(e) {
            e.preventDefault();
            var studFeeCollectId = $(this).attr("data-studFeeCollectId");
            var studFeeModesId = $(this).attr("data-studFeeModesId");
            var specilizationFeesId = $(this).attr("data-specilizationFeesId");
            var studId = $(this).attr("data-studId");
            var studUniversityId = $(this).attr("data-universityId");
            var sessionId = $(this).attr("data-sessionId");
            var courseId = $(this).attr("data-courseId");
            var specilizationId = $(this).attr("data-specilizationId");
            var specilizationFeeId = $(this).attr("data-specilizationFeeId");
            var discountId = $(this).attr("data-discountId");

            $.ajax({
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                method: "POST",
                data: {
                    studFeeCollectId: studFeeCollectId,
                    studFeeModesId: studFeeModesId,
                    specilizationFeesId: specilizationFeesId,
                    studId: studId,
                    studUniversityId: studUniversityId,
                    sessionId: sessionId,
                    courseId: courseId,
                    specilizationId: specilizationId,
                    specilizationFeeId: specilizationFeeId,
                    discountId: discountId,
                    listFeesModeName: "list",
                },
                success: function(response) {
                    $("#ActiveCourseSemesterDetails").html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Session data:', error);
                },
            });
        });
        // Pay Semester/Years/One Time Fees
        $(document).on("click", ".pay-button", function(e) {
            e.preventDefault();

            var studFeeCollectId = $(this).attr("data-studFeeCollectId");
            var studFeeModesId = $(this).attr("data-studFeeModesId");
            var specilizationFeesId = $(this).attr("data-specilizationFeesId");
            var studId = $(this).attr("data-studId");
            var studUniversityId = $(this).attr("data-universityId");
            var sessionId = $(this).attr("data-sessionId");
            var courseId = $(this).attr("data-courseId");
            var specilizationId = $(this).attr("data-specilizationId");
            var specilizationFeeId = $(this).attr("data-specilizationFeeId");
            var discountId = $(this).attr("data-discountId");
            var samesterName = $(this).attr("data-semesterName");
            var outstandingAmount = $(this).attr("data-outstandingAmount");
            var totalAmount = $(this).attr("data-totalFees");
            var alreadyFeePaid = $(this).attr("data-alreadyFeePaid");
            var totalDiscount = $(this).attr("data-totalDiscount");
            $('.fees-list').removeClass('active');
            $('.pay-button').removeClass('active');
            // Apply the "active" class to the clicked ul element
            $(this).addClass('active');
            $(this).closest('.fees-list').addClass('active');

            $.ajax({
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                method: "POST",
                data: {
                    studFeeCollectId: studFeeCollectId,
                    studFeeModesId: studFeeModesId,
                    specilizationFeesId: specilizationFeesId,
                    studId: studId,
                    studUniversityId: studUniversityId,
                    sessionId: sessionId,
                    courseId: courseId,
                    specilizationId: specilizationId,
                    specilizationFeeId: specilizationFeeId,
                    discountId: discountId,
                    samesterName: samesterName,
                    outstandingAmount: outstandingAmount,
                    totalAmount: totalAmount,
                    alreadyFeePaid: alreadyFeePaid,
                    totalDiscount: totalDiscount,
                    payFees: "Pay",
                },
                success: function(response) {
                    $("#payStudentFees").html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Session data:', error);
                },
            });
        });
        // If Fees Mode In Year And One Time then set Total fees on changes semester seletc
        $(document).on("change", ".year-sem-wise", function(e) {
            e.preventDefault();
            var selectedOption = $(this).find(":selected");
            var dataSubsemtype = selectedOption.data("subsemtype");
            var SemTotalPaidAmount = selectedOption.data("totalamount");
            $(".year-sem-total-fee").val(dataSubsemtype);
            $(".sem-total-amount").val(SemTotalPaidAmount);
            // Calculate and update the due fee if needed
            calculateYearSemDueFee();
        });
        // Function to calculate due fee
        function calculateYearSemDueFee() {
            var totalFee = parseInt($(".year-sem-total-fee").val()) || 0;
            var paidFee = parseInt($(".sem-total-amount").val()) || 0;
            // Calculate due fee
            var dueFee = totalFee - paidFee;
            if (paidFee == totalFee) {
                // Hide paid Fees input and show paid icon
                $(".fee-payment-semester-wise .sem-total-amount").hide();
                $(".fee-payment-semester-wise .already-paid-sem-fee").show();
            } else {
                $(".fee-payment-semester-wise .year-sem-total-fee").show();
                $(".fee-payment-semester-wise .sem-total-amount").show();
                $(".fee-payment-semester-wise .already-paid-sem-fee").hide();
                // Update the due fee input field
                $(".due-fees-for-all").val(dueFee);
            }
        }

        // Check Pay Fees Not More than Due Fees
        $(document).on("input", "#collectPayFees", function(e) {
            var payFees = parseFloat($(this).val());
            var dueFees = parseFloat($('input[name="dueFees"]').val());
            var totalDiscount = parseFloat($('input[name="discountAmount"]').val());
            var afterDiscountDueFees = parseFloat($('input[name="afterDiscountDueFees"]').val());
            var discountMode = $('select[name="discountMode"]').val();
            var errorSpan = $('.error-msg'); // Select the error message <span>
            if (!isNaN(afterDiscountDueFees)) {
                // Check with AfterDiscountDueFees Only
                if (payFees > afterDiscountDueFees || payFees < 0) {
                    $('#collectStudFees').prop('disabled', true);
                    if (payFees < 0) {
                        errorSpan.text("Entered amount cannot be less than 0");
                    } else {
                        errorSpan.text("Entered amount cannot be greater than after discount due fees");
                    }
                } else {
                    $('#collectStudFees').prop('disabled', false);
                    errorSpan.text(""); // Clear the error message
                }
            } else {
                //Check with DueFees Only
                if (payFees > dueFees || payFees < 0) {
                    $('#collectStudFees').prop('disabled', true);
                    if (payFees < 0) {
                        errorSpan.text("Entered amount cannot be less than 0");
                    } else {
                        errorSpan.text("Entered amount cannot be greater than due fees");
                    }
                } else {
                    $('#collectStudFees').prop('disabled', false);
                    errorSpan.text(""); // Clear the error message
                }
            }

        });
        // Discount Amount At The Time Of Fees Collect
        $(document).on("input", "#discountAmount", function(e) {
            e.preventDefault();
            var discountType = $("#discountTypes").val();
            var discountAmount = $(this).val();
            var dueFees = parseFloat($('input[name="dueFees"]').val());
            var errorDiscountSpan = $('.error-discount-msg');
            var newDueFeesInput = $('.new-due-fee');
            var oldDueFeesDiv = $('.old-due-fee');
            if (discountType == "Amount" && (discountAmount > dueFees || discountAmount < 0)) {
                $('#collectStudFees').prop('disabled', true);
                if (discountAmount < 0) {
                    errorDiscountSpan.text("Entered discount amount cannot be less than 0");
                } else {
                    errorDiscountSpan.text("Total discount amount cannot exceed due fees");
                }
                newDueFeesInput.val("");

            } else if (discountType == "Percentage" && (discountAmount > 100 || discountAmount < 0)) {
                $('#collectStudFees').prop('disabled', true);
                if (discountAmount < 0) {
                    errorDiscountSpan.text("Entered discount % cannot be less than 0%");
                } else {
                    errorDiscountSpan.text("Total discount % cannot exceed 100%");
                }
                newDueFeesInput.val("");

            } else {
                $('#collectStudFees').prop('disabled', false);
                errorDiscountSpan.text(""); // Clear the error message
                if (discountType == "Amount" && !isNaN(discountAmount)) {
                    if (discountAmount == "") {
                        var newDueFees = "";
                    } else {
                        var newDueFees = dueFees - discountAmount;
                    }
                    oldDueFeesDiv.removeClass('col-md-12').addClass('col-md-6');
                    $("#afterDiscountDueFeesDiv").show();
                    newDueFeesInput.val(newDueFees);
                }
                if (discountType == "Percentage" && !isNaN(discountAmount)) {
                    if (discountAmount == "") {
                        var newDueFees = "";
                    } else {
                        var newDueFees = dueFees - (dueFees * discountAmount / 100);
                    }
                    oldDueFeesDiv.removeClass('col-md-12').addClass('col-md-6');
                    $("#afterDiscountDueFeesDiv").show();
                    newDueFeesInput.val(newDueFees);
                }
            }

        });
        // Collect Semester/Years/One Time Fees
        $(document).on("submit", "#collectStudFeesForm", function(e) {
            e.preventDefault();
            // Create an object to store form data
            var formData = {
                FeesModeId: $("input[name='FeesModeId']").val(),
                FeeCollectId: $("input[name='FeeCollectId']").val(),
                StudentId: $("input[name='StudentId']").val(),
                UniversityId: $("input[name='UniversityId']").val(),
                SessionId: $("input[name='SessionId']").val(),
                CourseId: $("input[name='CourseId']").val(),
                SpecilizationId: $("input[name='SpecilizationId']").val(),
                SpecilizationFeesId: $("input[name='SpecilizationFeesId']").val(),
                DiscountId: $("input[name='DiscountId']").val(),
                SemesterName: $("input[name='SemesterName']").val(),
                semesterWiseFeesBoxChecked: $("input[name='semesterWiseFeesBoxChecked']").val(),
                subSemesterName: $("select[name='subSemesterName']").val(),
                subSemesterTotalFees: $("input[name='subSemesterTotalFees']").val(),
                feesModeName: $("input[name='feesModeName']").val(),
                dueFees: $("input[name='dueFees']").val(),
                afterDiscountDueFees: $("input[name='afterDiscountDueFees']").val(),
                paymentMode: $("select[name='paymentMode']").val(),
                paymentDate: $("input[name='paymentDate']").val(),
                payFees: $("input[name='payFees']").val(),
                discountMode: $("select[name='discountMode']").val(),
                discountAmount: $("input[name='discountAmount']").val(),
                notes: $("textarea[name='notes']").val(),
                totalAmount: $("input[name='totalAmount']").val(),
                alreadyFeePaid: $("input[name='alreadyFeePaid']").val(),
                discountCheckBox: $("input[name='discountCheckBox']").val(),
                totalDiscount: $("input[name='totalDiscount']").val(),
                collectStudFees: "SaveDetails" // Button name and value
            };
            // Get the StudentId from the form data and assign it to the variable
            StudentId = formData.StudentId;

            // Send the form data as a JSON string via AJAX
            $.ajax({
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                method: "POST",
                data: JSON.stringify(formData),
                contentType: "application/json",
                success: function(response) {
                    $("#FeesDiv").html('<div class="card"><div class ="card-body " id = "payStudentFees" ><div class="row ml-1"><h5 class = "card-title " >Fee Collected Successfully</h5></div><div class="row justify-content-center"><div class="col-md-8"><img src="<?= STORAGE_URL ?>/account-image/animation_ll7pmxg0_small.gif" class="shadow-none" style="width: 250px;"></div><div class="col-md-12 text-center"><h5 class = "text-success fs-18" >Payment Done</h5></div></div></div></div>');
                    refreshStudentFeeList();
                    loadTableTxnDetailsAfterCollectFees(StudentId);
                },
                error: function(xhr, status, error) {
                    console.error('Error saving data:', error);
                    // Handle the error condition as needed
                }
            });
        });
        // Show Discount Fields (Discount Mode,Discount Amount)
        $(document).on("change", "#discountCheckBox1", function(e) {
            if ($(this).is(":checked")) {
                $(".DiscountDivs").show();
            } else {
                $(".DiscountDivs").hide();
            }
        });
        // Show year|| one time (Semester wise fees divs)
        $(document).on("change", "#discountCheckBox2", function(e) {

            if ($(this).is(":checked")) {
                $(".fee-payment-semester-wise").show();
                getOriginalDueAmount();
            } else {
                $(".fee-payment-semester-wise").hide();
                $(".due-fees-for-all").val(getOriginalDueAmount());
            }
        });

        function getOriginalDueAmount() {
            var originalDueAmount = $(".total-outstanding-amount").data("outstandingamount");
            return originalDueAmount;
        }
        // Refresh/Update Search Student Results After Save Fees Mode And Save Discount Mode
        function refreshStudentSearchResult(studentId) {
            var studentId = studentId;
            var searchValue = $("#searchActiveStudents").val();
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                data: {
                    studentId: studentId,
                    SearchValue: searchValue,
                    SearchKeyUpSubmit: "submit",
                },
                success: function(response) {
                    $("#searchStudentsResult").html(response);
                }
            });
        }
        // Refresh/Students Fees List After Collect Fees From student
        function refreshStudentFeeList() {
            var studFeeCollectId = $("#showSemesterList").attr("data-studFeeCollectId");
            var studFeeModesId = $("#showSemesterList").attr("data-studFeeModesId");
            var specilizationFeesId = $("#showSemesterList").attr("data-specilizationFeesId");
            var studId = $("#showSemesterList").attr("data-studId");
            var studUniversityId = $("#showSemesterList").attr("data-universityId");
            var sessionId = $("#showSemesterList").attr("data-sessionId");
            var courseId = $("#showSemesterList").attr("data-courseId");
            var specilizationId = $("#showSemesterList").attr("data-specilizationId");
            var specilizationFeeId = $("#showSemesterList").attr("data-specilizationFeeId");
            var discountId = $("#showSemesterList").attr("data-discountId");
            $.ajax({
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                method: "POST",
                data: {
                    studFeeCollectId: studFeeCollectId,
                    studFeeModesId: studFeeModesId,
                    specilizationFeesId: specilizationFeesId,
                    studId: studId,
                    studUniversityId: studUniversityId,
                    sessionId: sessionId,
                    courseId: courseId,
                    specilizationId: specilizationId,
                    specilizationFeeId: specilizationFeeId,
                    discountId: discountId,
                    listFeesModeName: "list",
                },
                success: function(response) {
                    $("#ActiveCourseSemesterDetails").html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching Session data:', error);
                },
            });
        }
        // Load Student Txn Details
        function loadTableTxnDetails(studentId) {
            var searchValue = $("#searchActiveStudents").val();
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                data: {
                    SearchValue: searchValue,
                    StudentId: studentId,
                    LoadTxnDetails: "load",
                },
                success: function(response) {
                    $("#TxnAllList").html(response);
                }
            });
        }

        function loadTableTxnDetailsAfterCollectFees(StudentId) {
            var StudentId = StudentId;
            $.ajax({
                type: "POST",
                url: "<?= CONTROLLER ?>/FeesCollectionController.php",
                data: {
                    StudentId: StudentId,
                    LoadTxnDetails: "load",
                },
                success: function(response) {
                    $("#TxnAllList").html(response);
                }
            });
        }
        $(document).on("click", ".edit-pen", function(e) {
            e.preventDefault();

            // Find the closest input element within the same parent div.
            var inputElement = $(this).closest('div').find('input');

            // Toggle the readonly attribute.
            inputElement.prop('readonly', !inputElement.prop('readonly'));
        });
        // show Semester Detailes If Fees Mode is(Year,OneTime)
        $(document).ready(function() {
            $(document).on("click", ".sem-details-icon", function(e) {
                // Find the closest "semester-details-div" relative to the clicked icon
                var semesterDetailsDiv = $(this).closest('.record-list').find('.semester-details-div');
                // Check the current visibility state and toggle it
                if (semesterDetailsDiv.is(":visible")) {
                    semesterDetailsDiv.hide(); // Hide if currently visible
                } else {
                    semesterDetailsDiv.show(); // Show if currently hidden
                }
            });
        });
    </script>
</body>

</html>