
<?php
//add controller helper files
require __DIR__ . '/../require/modules.php';

//add aditional requirements
require '../require/admin/access-control.php';

//============================>University Post Requests ====================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jsonData = file_get_contents("php://input");
    $formData = json_decode($jsonData, true);

    if (isset($formData["SaveUniversityInfo"])) {
        //Stored Form Data In Array
        $universityPrimaryDetails = [
            "university_name" => $formData["university_name"],
            "university_phone_no" => $formData["university_phone_no"],
            "university_email_id" => $formData["university_email_id"],
            "created_by" => LOGIN_UserId,
            "updated_by" => LOGIN_UserId,
        ];
        //Save University Primary Details In Data Base
        $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_primary_details", $universityPrimaryDetails);
        $UniversityId = FETCH("SELECT university_id FROM universities_primary_details ORDER BY university_id DESC limit 1", "university_id");
        if ($Save == true) {
            $universitiesRegisteredAddress = [
                "university_id" => $UniversityId,
                "university_emails_id" => $formData["university_email_id"],
                "university_gst" => $formData["university_gst"],
                "univ_reg_address" => $formData["univ_reg_address"],
                "univ_reg_sector" => $formData["univ_reg_sector"],
                "univ_reg_landmark" => $formData["univ_reg_landmark"],
                "univ_reg_city" => $formData["univ_reg_city"],
                "univ_reg_state" => $formData["univ_reg_state"],
                "univ_reg_country" => $formData["univ_reg_country"],
                "univ_reg_pincode" => $formData["univ_reg_pincode"],
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_billing_address", $universitiesRegisteredAddress);
        }
        if ($Save == true) {
            $response = array(
                "status" => "Success",
                "universityId" => $UniversityId
            );
            echo json_encode($response);
        } else {
            $response = array(
                "status" => "Error"
            );
            echo json_encode($response);
        }
    }
    if (isset($formData["SaveUniversityCourses"])) {
        //Save University Session Year
        $universitySessionYears = [
            "university_id" => $formData["universityId"],
            "univ_session_name" => $formData["course_session_year"],
            "created_by" => LOGIN_UserId,
            "updated_by" => LOGIN_UserId,
        ];
        $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_session_years", $universitySessionYears);
        //Fetch University Course Session Year
        $universitySessionId = FETCH("SELECT univ_session_id FROM universities_session_years WHERE university_id='" . $formData["universityId"] . "' limit 1", "univ_session_id");
        //Save University Courses With University Course Session Id
        foreach ($formData["course_name"] as $key => $value) {
            $universityCoursesDetails = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $universitySessionId,
                "univ_course_name" => $formData["course_name"][$key],
                "univ_course_type" => $formData["course_type"][$key],
                "univ_course_total_semester" => $formData["course_total_semester"][$key],
                "univ_course_total_year" => $formData["course_total_years"][$key],
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses", $universityCoursesDetails);
            $fetchCourseId = FETCH("SELECT univ_course_id FROM universities_courses WHERE university_id='" . $formData["universityId"] . "' AND univ_session_id='" . $universitySessionId . "' ORDER BY univ_course_id DESC  LIMIT 1", "univ_course_id");
            $univ_session_course = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $universitySessionId,
                "univ_course_id" => $fetchCourseId,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("univ_session_course", $univ_session_course);
        }
        if ($Save == true) {
            $response = array(
                "status" => "Success",
                "universityId" => $formData["universityId"],
                "universityCourseSessionId" => $universitySessionId
            );
            echo json_encode($response);
        } else {
            $response = array(
                "status" => "Error"
            );
            echo json_encode($response);
        }
    }
    if (isset($_POST['fetchCourse'])) {
        $fetchUniversityCourses = FETCH_DB_TABLE("SELECT * FROM universities_courses WHERE university_id='" . $_POST['universityId'] . "' AND univ_session_id='" . $_POST['universityCourseSessionId'] . "'", true);
        echo json_encode($fetchUniversityCourses);
    }
    //Save Unvesrsity Course Multiple Specilization
    if (isset($formData['saveCoursesSpecilizationData'])) {
        foreach ($formData["specialization"] as $key => $value) {
            $universityCoursesSpecilization = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universityCourseSessionId"],
                "univ_course_id" => $formData["courseName"],
                "univ_course_specialization_name" => $formData["specialization"][$key],
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations", $universityCoursesSpecilization);
        }

        // $universitySpecializationId = FETCH("SELECT univ_specialization_id  FROM universities_courses_specializations ORDER BY univ_specialization_id DESC LIMIT 1", "univ_specialization_id");
        // if ($Save == true) {
        //     // Save Course Specilization Fee
        //     if ($formData["feesMode"] == "Semesters Wise") {
        //         $specilizationFee = implode(",", $formData["semesterFee"]);
        //         $specilizationFeeName = implode(",", $formData["semesterName"]);
        //     } elseif ($formData["feesMode"] == "Years Wise") {
        //         $specilizationFee = implode(",", $formData["yearFees"]);
        //         $specilizationFeeName = implode(",", $formData["yearName"]);
        //     } elseif ($formData["feesMode"] == "One Time") {
        //         $specilizationFee = implode(",", $formData["oneTimeFees"]);
        //         $specilizationFeeName = implode(",", $formData["oneTimeName"]);
        //     } else {
        //         $specilizationFee = "";
        //         $specilizationFeeName = "";
        //     }
        //     $universityCoursesSpecilizationFees = [
        //         "university_id" => $formData["universityId"],
        //         "univ_session_id" => $formData["universityCourseSessionId"],
        //         "univ_course_id" => $formData["courseName"],
        //         "university_specialization_id" => $universitySpecializationId,
        //         "univ_course_spec_fee_mode_type" => $formData["feesMode"],
        //         "univ_course_spec_fee_name" => $specilizationFeeName,
        //         "univ_course_spec_fee_value" => $specilizationFee,
        //         "univ_course_spec_total_fee_value" => $formData["totalFee"],
        //         "created_by" => LOGIN_UserId,
        //         "updated_by" => LOGIN_UserId,
        //     ];
        //     $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
        // }

        if ($Save == true) {
            $response = array(
                "status" => "Success",
                "universityId" => $formData["universityId"],
                "universityCourseSessionId" => $formData["universityCourseSessionId"]
            );
            echo json_encode($response);
        } else {
            $response = array(
                "status" => "Error"
            );
            echo json_encode($response);
        }
    }
    //Save Unvesrsity Course Multiple Specilization And Move Next
    if (isset($formData['saveCoursesSpecilizationDetailsNext'])) {
        foreach ($formData["specialization"] as $key => $value) {
            $universityCoursesSpecilization = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universityCourseSessionId"],
                "univ_course_id" => $formData["courseName"],
                "univ_course_specialization_name" => $formData["specialization"][$key],
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations", $universityCoursesSpecilization);
        }
        if ($Save == true) {
            $response = array(
                "status" => "Success",
                "universityId" => $formData["universityId"],
                "universityCourseSessionId" => $formData["universityCourseSessionId"]
            );
            echo json_encode($response);
        } else {
            $response = array(
                "status" => "Error"
            );
            echo json_encode($response);
        }
    }
    //Save Unvesrsity Course  Specilization Fees
    if (isset($formData['saveCoursesSpecilizationFeesData'])) {
        if ($formData["feesModeSemester"] == "Semesters Wise") {
            $specilizationFee = implode(",", $formData["semesterFee"]);
            $specilizationFeeName = implode(",", $formData["semesterName"]);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universityCourseSessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeSemester"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
        }
        if ($formData["feesModeYear"] == "Years Wise") {
            $specilizationFee = implode(",", $formData["yearFees"]);
            $specilizationFeeName = implode(",", $formData["yearName"]);
            //Break Fees Equal In Semester Also
            $yearSemName = [];
            $yearSemAmount = [];
            foreach ($formData["yearName"] as $yearKey => $yearValue) {
                if ($yearValue == "1") {
                    foreach (firstYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "2") {
                    foreach (secondYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "3") {
                    foreach (thirdYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "4") {
                    foreach (fourYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "5") {
                    foreach (fiveYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                }
            }
            //Implode
            $yearSemNames = implode(",", $yearSemName);
            $yearSemAmounts = implode(",", $yearSemAmount);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universityCourseSessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeYear"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "univ_course_spec_fee_sem_name" => $yearSemNames,
                "univ_course_spec_fee_sem_value" => $yearSemAmounts,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
        }
        if ($formData["feesModeOneTime"] == "One Time") {
            //Fetch Course Year
            $CourseTotalYear = FETCH("SELECT univ_course_total_year FROM universities_courses WHERE univ_course_id='" . $formData["courseName"] . "'", "univ_course_total_year");
            $specilizationFee = implode(",", $formData["oneTimeFees"]);
            $specilizationFeeName = implode(",", $formData["oneTimeName"]);
            //Break Fees Equal In Semester Also
            $OneTimeSemName = [];
            $OneTimeSemAmount = [];
            foreach ($formData["oneTimeName"] as $oneKey => $OneTimeSemNameData) {
                if ($CourseTotalYear == "1") {
                    foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 2;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "2") {
                    foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 4;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "3") {
                    foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 6;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "4") {
                    foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 8;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "5") {
                    foreach (fiveYearSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 10;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                }
            }

            //Implode
            $OneTimeSemNames = implode(",", $OneTimeSemName);
            $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universityCourseSessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeOneTime"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                "univ_course_spec_fee_sem_value" => $OneTimeSemAmounts,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
        }
        //Save Same Fee For Other Course Specilization
        if (!empty($formData['otherCourseSpecFees'])) {
            foreach ($formData["otherCourseSpecFees"] as $key => $value) {
                $fetchCourseId = FETCH("SELECT univ_course_id FROM universities_courses_specializations WHERE univ_specialization_id='" . $formData["otherCourseSpecFees"][$key] . "'", "univ_course_id");
                if ($formData["feesModeSemester"] == "Semesters Wise") {
                    $specilizationFee = implode(",", $formData["semesterFee"]);
                    $specilizationFeeName = implode(",", $formData["semesterName"]);

                    $universityCoursesSpecilizationFees = [
                        "university_id" => $formData["universityId"],
                        "univ_session_id" => $formData["universityCourseSessionId"],
                        "univ_course_id" => $fetchCourseId,
                        "university_specialization_id" => $formData["otherCourseSpecFees"][$key],
                        "univ_course_spec_fee_mode_type" => $formData["feesModeSemester"],
                        "univ_course_spec_fee_name" => $specilizationFeeName,
                        "univ_course_spec_fee_value" => $specilizationFee,
                        "created_by" => LOGIN_UserId,
                        "updated_by" => LOGIN_UserId,
                    ];
                    $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
                }
                if ($formData["feesModeYear"] == "Years Wise") {
                    $specilizationFee = implode(",", $formData["yearFees"]);
                    $specilizationFeeName = implode(",", $formData["yearName"]);
                    //Break Fees Equal In Semester Also
                    $yearSemName = [];
                    $yearSemAmount = [];
                    foreach ($formData["yearName"] as $yearKey => $yearValue) {
                        if ($yearValue == "1") {
                            foreach (firstYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        } elseif ($yearValue == "2") {
                            foreach (secondYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        } elseif ($yearValue == "3") {
                            foreach (thirdYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        } elseif ($yearValue == "4") {
                            foreach (fourYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        } elseif ($yearValue == "5") {
                            foreach (fiveYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        }
                    }
                    //Implode
                    $yearSemNames = implode(",", $yearSemName);
                    $yearSemAmounts = implode(",", $yearSemAmount);
                    $universityCoursesSpecilizationFees = [
                        "university_id" => $formData["universityId"],
                        "univ_session_id" => $formData["universityCourseSessionId"],
                        "univ_course_id" => $fetchCourseId,
                        "university_specialization_id" => $formData["otherCourseSpecFees"][$key],
                        "univ_course_spec_fee_mode_type" => $formData["feesModeYear"],
                        "univ_course_spec_fee_name" => $specilizationFeeName,
                        "univ_course_spec_fee_value" => $specilizationFee,
                        "univ_course_spec_fee_sem_name" => $yearSemNames,
                        "univ_course_spec_fee_sem_value" => $yearSemAmounts,
                        "created_by" => LOGIN_UserId,
                        "updated_by" => LOGIN_UserId,
                    ];
                    $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
                }
                if ($formData["feesModeOneTime"] == "One Time") {
                    $specilizationFee = implode(",", $formData["oneTimeFees"]);
                    $specilizationFeeName = implode(",", $formData["oneTimeName"]);
                    //Break Fees Equal In Semester Also
                    $OneTimeSemName = [];
                    $OneTimeSemAmount = [];
                    foreach ($formData["oneTimeName"] as $oneKey => $OneTimeSemNameData) {
                        if ($CourseTotalYear == "1") {
                            foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 2;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        } elseif ($CourseTotalYear == "2") {
                            foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 4;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        } elseif ($CourseTotalYear == "3") {
                            foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 6;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        } elseif ($CourseTotalYear == "4") {
                            foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 8;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        } elseif ($CourseTotalYear == "5") {
                            foreach (fiveYearSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 10;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        }
                    }

                    //Implode
                    $OneTimeSemNames = implode(",", $OneTimeSemName);
                    $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
                    $universityCoursesSpecilizationFees = [
                        "university_id" => $formData["universityId"],
                        "univ_session_id" => $formData["universityCourseSessionId"],
                        "univ_course_id" => $fetchCourseId,
                        "university_specialization_id" => $formData["otherCourseSpecFees"][$key],
                        "univ_course_spec_fee_mode_type" => $formData["feesModeOneTime"],
                        "univ_course_spec_fee_name" => $specilizationFeeName,
                        "univ_course_spec_fee_value" => $specilizationFee,
                        "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                        "univ_course_spec_fee_sem_value" => $OneTimeSemAmounts,
                        "created_by" => LOGIN_UserId,
                        "updated_by" => LOGIN_UserId,
                    ];
                    $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
                }
            }
        }


        if ($Save == true) {
            $response = array(
                "status" => "Success",
                "universityId" => $formData["universityId"],
                "universityCourseSessionId" => $formData["universityCourseSessionId"]
            );
            echo json_encode($response);
        } else {
            $response = array(
                "status" => "Error"
            );
            echo json_encode($response);
        }
    }

    //Save Unvesrsity Course tutitions Fees
    if (isset($formData['saveCoursesSpecilizationTutitionsFeesData'])) {
        if ($formData["feesModeSemester"] == "Semesters Wise") {
            $specilizationFee = implode(",", $formData["semesterFee"]);
            $specilizationFeeName = implode(",", $formData["semesterName"]);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universityCourseSessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeSemester"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
        }
        if ($formData["feesModeYear"] == "Years Wise") {
            $specilizationFee = implode(",", $formData["yearFees"]);
            $specilizationFeeName = implode(",", $formData["yearName"]);
            //Break Fees Equal In Semester Also
            $yearSemName = [];
            $yearSemAmount = [];
            foreach ($formData["yearName"] as $yearKey => $yearValue) {
                if ($yearValue == "1") {
                    foreach (firstYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "2") {
                    foreach (secondYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "3") {
                    foreach (thirdYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "4") {
                    foreach (fourYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "5") {
                    foreach (fiveYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                }
            }

            //Implode
            $yearSemNames = implode(",", $yearSemName);
            $yearSemAmounts = implode(",", $yearSemAmount);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universityCourseSessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeYear"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "univ_course_spec_fee_sem_name" => $yearSemNames,
                "univ_course_spec_total_fee_value" => $yearSemAmounts,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
        }
        if ($formData["feesModeOneTime"] == "One Time") {
            //Fetch Course Year
            $CourseTotalYear = FETCH("SELECT univ_course_total_year FROM universities_courses WHERE univ_course_id='" . $formData["courseName"] . "'", "univ_course_total_year");
            $specilizationFee = implode(",", $formData["oneTimeFees"]);
            $specilizationFeeName = implode(",", $formData["oneTimeName"]);
            //Break Fees Equal In Semester Also
            $OneTimeSemName = [];
            $OneTimeSemAmount = [];
            foreach ($formData["oneTimeName"] as $oneKey => $OneTimeSemNameData) {
                if ($CourseTotalYear == "1") {
                    foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 2;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "2") {
                    foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 4;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "3") {
                    foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 6;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "4") {
                    foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 8;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "5") {
                    foreach (fiveYearSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 10;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                }
            }

            //Implode
            $OneTimeSemNames = implode(",", $OneTimeSemName);
            $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universityCourseSessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeOneTime"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                "univ_course_spec_total_fee_value" => $OneTimeSemAmounts,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
        }
        //Save Same Fee For Other Course Specilization
        if (!empty($formData['otherCourseSpecFees'])) {
            foreach ($formData["otherCourseSpecFees"] as $key => $value) {
                $fetchCourseId = FETCH("SELECT univ_course_id FROM universities_courses_specializations WHERE univ_specialization_id='" . $formData["otherCourseSpecFees"][$key] . "'", "univ_course_id");
                if ($formData["feesModeSemester"] == "Semesters Wise") {
                    $specilizationFee = implode(",", $formData["semesterFee"]);
                    $specilizationFeeName = implode(",", $formData["semesterName"]);

                    $universityCoursesSpecilizationFees = [
                        "university_id" => $formData["universityId"],
                        "univ_session_id" => $formData["universityCourseSessionId"],
                        "univ_course_id" => $fetchCourseId,
                        "university_specialization_id" => $formData["otherCourseSpecFees"][$key],
                        "univ_course_spec_fee_mode_type" => $formData["feesModeSemester"],
                        "univ_course_spec_fee_name" => $specilizationFeeName,
                        "univ_course_spec_fee_value" => $specilizationFee,
                        "created_by" => LOGIN_UserId,
                        "updated_by" => LOGIN_UserId,
                    ];
                    $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
                }
                if ($formData["feesModeYear"] == "Years Wise") {
                    $specilizationFee = implode(",", $formData["yearFees"]);
                    $specilizationFeeName = implode(",", $formData["yearName"]);
                    //Break Fees Equal In Semester Also
                    $yearSemName = [];
                    $yearSemAmount = [];
                    foreach ($formData["yearName"] as $yearKey => $yearValue) {
                        if ($yearValue == "1") {
                            foreach (firstYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        } elseif ($yearValue == "2") {
                            foreach (secondYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        } elseif ($yearValue == "3") {
                            foreach (thirdYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        } elseif ($yearValue == "4") {
                            foreach (fourYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        } elseif ($yearValue == "5") {
                            foreach (fiveYearSem() as $semKey => $semName) {
                                $yearSemName[] = $semKey;
                            }
                            $splitFee = $formData["yearFees"][$yearKey] / 2;
                            $yearSemAmount[] = $splitFee;
                            $yearSemAmount[] = $splitFee;
                        }
                    }

                    //Implode
                    $yearSemNames = implode(",", $yearSemName);
                    $yearSemAmounts = implode(",", $yearSemAmount);
                    $universityCoursesSpecilizationFees = [
                        "university_id" => $formData["universityId"],
                        "univ_session_id" => $formData["universityCourseSessionId"],
                        "univ_course_id" => $fetchCourseId,
                        "university_specialization_id" => $formData["otherCourseSpecFees"][$key],
                        "univ_course_spec_fee_mode_type" => $formData["feesModeYear"],
                        "univ_course_spec_fee_name" => $specilizationFeeName,
                        "univ_course_spec_fee_value" => $specilizationFee,
                        "univ_course_spec_fee_sem_name" => $yearSemNames,
                        "univ_course_spec_total_fee_value" => $yearSemAmounts,
                        "created_by" => LOGIN_UserId,
                        "updated_by" => LOGIN_UserId,
                    ];
                    $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
                }
                if ($formData["feesModeOneTime"] == "One Time") {
                    $specilizationFee = implode(",", $formData["oneTimeFees"]);
                    $specilizationFeeName = implode(",", $formData["oneTimeName"]);
                    //Break Fees Equal In Semester Also
                    $OneTimeSemName = [];
                    $OneTimeSemAmount = [];
                    foreach ($formData["oneTimeName"] as $oneKey => $OneTimeSemNameData) {
                        if ($CourseTotalYear == "1") {
                            foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 2;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        } elseif ($CourseTotalYear == "2") {
                            foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 4;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        } elseif ($CourseTotalYear == "3") {
                            foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 6;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        } elseif ($CourseTotalYear == "4") {
                            foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 8;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        } elseif ($CourseTotalYear == "5") {
                            foreach (fiveYearSem() as $semKey => $semName) {
                                $OneTimeSemName[] = $semKey;
                            }
                            $splitFee = $formData["oneTimeFees"][$oneKey] / 10;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                            $OneTimeSemAmount[] = $splitFee;
                        }
                    }

                    //Implode
                    $OneTimeSemNames = implode(",", $OneTimeSemName);
                    $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
                    $universityCoursesSpecilizationFees = [
                        "university_id" => $formData["universityId"],
                        "univ_session_id" => $formData["universityCourseSessionId"],
                        "univ_course_id" => $fetchCourseId,
                        "university_specialization_id" => $formData["otherCourseSpecFees"][$key],
                        "univ_course_spec_fee_mode_type" => $formData["feesModeOneTime"],
                        "univ_course_spec_fee_name" => $specilizationFeeName,
                        "univ_course_spec_fee_value" => $specilizationFee,
                        "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                        "univ_course_spec_total_fee_value" => $OneTimeSemAmounts,
                        "created_by" => LOGIN_UserId,
                        "updated_by" => LOGIN_UserId,
                    ];
                    $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
                }
            }
        }


        if ($Save == true) {
            $response = array(
                "status" => "Success",
                "universityId" => $formData["universityId"],
                "universityCourseSessionId" => $formData["universityCourseSessionId"]
            );
            echo json_encode($response);
        } else {
            $response = array(
                "status" => "Error"
            );
            echo json_encode($response);
        }
    }
}

//Ftech University Course Data  For Edit Page
if (isset($_POST['sessionSubmitBtn'])) {
    $fetchCourse = FETCH_DB_TABLE("SELECT * FROM univ_session_course AS usc JOIN universities_courses AS uc ON usc.univ_course_id = uc.univ_course_id WHERE usc.univ_session_id='" . $_POST['sessionUniversityId'] . "' AND uc.university_id='" . $_POST['universityId'] . "'", true);

    if (isset($fetchCourse)) {

        foreach ($fetchCourse as $value) {
            $outPut = '<option value="' . $value->univ_course_id . '" data-id="' . $value->univ_course_id . '">' . $value->univ_course_name . '</option>';
            echo $outPut;
        }
    }
}
if (isset($_POST['sessionSubmitBtnOnChange'])) {
    $outPut = "";
    $fetchCourse = FETCH_DB_TABLE("SELECT * FROM univ_session_course AS usc JOIN universities_courses AS uc ON usc.univ_course_id = uc.univ_course_id WHERE usc.univ_session_id='" . $_POST['sessionUniversityId'] . "' AND uc.university_id='" . $_POST['universityId'] . "'", true);
    if (isset($fetchCourse)) {
        $outPut .= '<option>choose course</option>';
        foreach ($fetchCourse as $value) {
            $outPut .= '<option value="' . $value->univ_course_id . '" data-id="' . $value->univ_course_id . '">' . $value->univ_course_name . '</option>';
        }
        echo $outPut;
    }
}
//Fetch University Courses Speecilization Data For Edit page
if (isset($_POST['coursesSubmitBtn'])) {
    $fetchCourseSpecilization = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['universityCoursesId'] . "'", true);

    if (isset($fetchCourseSpecilization)) {

        foreach ($fetchCourseSpecilization as $value) {
            $outPut = '<option value="' . $value->univ_specialization_id . '" data-id="' . $value->univ_specialization_id . '">' . $value->univ_course_specialization_name . '</option>';
            echo $outPut;
        }
    }
}
if (isset($_POST['coursesSubmitBtnOnChange'])) {
    $fetchCourseSpecilization = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['universityCoursesId'] . "'", true);
    if (isset($fetchCourseSpecilization)) {
        $outPut .= '<option>choose courses specilization</option>';
        foreach ($fetchCourseSpecilization as $value) {
            $outPut .= '<option value="' . $value->univ_specialization_id . '" data-id="' . $value->univ_specialization_id . '">' . $value->univ_course_specialization_name . '</option>';
        }
        echo $outPut;
    }
}
//Fetch Course Other Details
if (isset($_POST['coursesTypeSubmitBtn'])) {

    $fetchCourseDetails = FETCH_DB_TABLE("SELECT * FROM universities_courses WHERE univ_course_id='" . $_POST['universityCoursesId'] . "'", true);
    if (isset($fetchCourseDetails)) {
        foreach ($fetchCourseDetails as $value) {
            $responseData = array(
                'courseType' => $value->univ_course_type,
                'totalSemesters' => $value->univ_course_total_semester,
                'totalYears' => $value->univ_course_total_year,
            );
            // Convert the response data to JSON format
            $responseJson = json_encode($responseData);

            // Send the JSON response back to the client
            echo $responseJson;
        }
    }
}
if (isset($_POST['coursesTypeSubmitBtnOnChange'])) {

    $fetchCourseDetails = FETCH_DB_TABLE("SELECT * FROM universities_courses WHERE univ_course_id='" . $_POST['universityCoursesId'] . "'", true);
    if (isset($fetchCourseDetails)) {
        foreach ($fetchCourseDetails as $value) {
            $responseData = array(
                'courseType' => $value->univ_course_type,
                'totalSemesters' => $value->univ_course_total_semester,
                'totalYears' => $value->univ_course_total_year,
            );
            // Convert the response data to JSON format
            $responseJson = json_encode($responseData);

            // Send the JSON response back to the client
            echo $responseJson;
        }
    }
}
//Fetch courses fee details
if (isset($_POST['coursesSpecilizationDetailsSubmitBtn'])) {
    $outPut = "";
    $outPut = '
    <div class="row">
        <div class="col-md-6">
        <h5 class="app-sub-heading text-center">Course Fees Details</h5>
       ';
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees AS ucs INNER JOIN universities_courses AS uc ON uc.univ_course_id =ucs.univ_course_id INNER JOIN universities_session_years AS usy ON usy.univ_session_id=ucs.univ_session_id INNER JOIN universities_courses_specializations AS ucse ON ucse.univ_specialization_id=ucs.university_specialization_id WHERE ucs.university_specialization_id = '" . $_POST['universityCoursesSpecilizationId'] . "' AND ucs.university_id = '" . $_POST['universityId'] . "' AND ucs.univ_session_id = '" . $_POST['sessionUniversityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $key => $data) {
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } else {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            }

            $outPut .= '
            <div class="card p-2" style="margin-bottom: 10px !important;">
            <h5 class="bold" style="padding: 4px; border-radius: 4px; background-color: aliceblue;">' . '<span class="text-muted" >' . "" . '</span>' . $data->univ_course_spec_fee_mode_type .
                '</h5>
             <p class="mb-0">' .
                '<span class="text-muted">' . "Course Session Year:-" . '</span>' . $data->univ_session_name . "<br>" .
                '<span class="text-muted">' . "Course Name:-" . '</span>' . $data->univ_course_name . "<br>" .
                '<span class="text-muted">' . "Course Specilization Name:-" . '</span>' . $data->univ_course_specialization_name . "<br>" .
                '<span class="text-muted">' . "Total Semester:-" . '</span>' . $data->univ_course_total_semester . "<br>" .
                '<span class="text-muted">' . "Total Years:-" . '</span>' . $data->univ_course_total_year . "<br>" .
                '<span class="text-muted">' . "Course Fee Payment Mode:-" . '</span>' . $data->univ_course_spec_fee_mode_type . "<br>";
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $FeesModeType = "Semester";
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $FeesModeType = "Year";
            } elseif ($data->univ_course_spec_fee_mode_type == "One Time") {
                $FeesModeType = "One Time";
            }
            $TotalFees = 0;
            foreach ($feeModeWise as $key => $feeModeVal) {
                $TotalFees += $fees[$key];
                $outPut .= '<span class="text-muted">' . $FeesModeType . " " . $feeModeVal . " => " . '</span>' . "Rs." . $fees[$key] . ", ";
            }
            $outPut .= '<br><span class="text-muted">Total Fees => </span>' . "Rs." . $TotalFees . '</div>';
        }
    }
    $outPut .= '</div>
     <div class="col-md-6">
     <h5 class="app-sub-heading text-center">Tutition Fees Details</h5>
      ';
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees AS ucs INNER JOIN universities_courses AS uc ON uc.univ_course_id =ucs.univ_course_id INNER JOIN universities_session_years AS usy ON usy.univ_session_id=ucs.univ_session_id INNER JOIN universities_courses_specializations AS ucse ON ucse.univ_specialization_id=ucs.university_specialization_id WHERE ucs.university_specialization_id = '" . $_POST['universityCoursesSpecilizationId'] . "' AND ucs.university_id = '" . $_POST['universityId'] . "' AND ucs.univ_session_id = '" . $_POST['sessionUniversityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $key => $data) {
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } else {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            }

            $outPut .= '
            <div class="card p-2" style="margin-bottom: 10px !important;">
            <h5 class="bold" style="padding: 4px; border-radius: 4px; background-color: aliceblue;">' . '<span class="text-muted" >' . "" . '</span>' . $data->univ_course_spec_fee_mode_type .
                '</h5>
             <p class="mb-0">' .
                '<span class="text-muted">' . "Course Session Year:-" . '</span>' . $data->univ_session_name . "<br>" .
                '<span class="text-muted">' . "Course Name:-" . '</span>' . $data->univ_course_name . "<br>" .
                '<span class="text-muted">' . "Course Specilization Name:-" . '</span>' . $data->univ_course_specialization_name . "<br>" .
                '<span class="text-muted">' . "Total Semester:-" . '</span>' . $data->univ_course_total_semester . "<br>" .
                '<span class="text-muted">' . "Total Years:-" . '</span>' . $data->univ_course_total_year . "<br>" .
                '<span class="text-muted">' . "Course Fee Payment Mode:-" . '</span>' . $data->univ_course_spec_fee_mode_type . "<br>";
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $FeesModeType = "Semester";
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $FeesModeType = "Year";
            } elseif ($data->univ_course_spec_fee_mode_type == "One Time") {
                $FeesModeType = "One Time";
            }
            $TotalFees = 0;
            foreach ($feeModeWise as $key => $feeModeVal) {
                $TotalFees += $fees[$key];
                $outPut .= '<span class="text-muted">' . $FeesModeType . " " . $feeModeVal . " => " . '</span>' . "Rs." . $fees[$key] . ", ";
            }
            $outPut .= '<br><span class="text-muted">Total Fees => </span>' . "Rs." . $TotalFees . '</div>';
        }
    }
    $outPut .= '</div>
    </div>';

    echo $outPut;
}
if (isset($_POST['coursesSpecilizationDetailsSubmitBtnOnChange'])) {
    $outPut = "";
    $outPut = '
    <div class="row">
        <div class="col-md-6">
        <h5 class="app-sub-heading text-center">Course Fees Details</h5>
       ';
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees AS ucs INNER JOIN universities_courses AS uc ON uc.univ_course_id =ucs.univ_course_id INNER JOIN universities_session_years AS usy ON usy.univ_session_id=ucs.univ_session_id INNER JOIN universities_courses_specializations AS ucse ON ucse.univ_specialization_id=ucs.university_specialization_id WHERE ucs.university_specialization_id = '" . $_POST['universityCoursesSpecilizationId'] . "' AND ucs.university_id = '" . $_POST['universityId'] . "' AND ucs.univ_session_id = '" . $_POST['sessionUniversityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $key => $data) {
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } else {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            }

            $outPut .= '
            <div class="card p-2" style="margin-bottom: 10px !important;">
            <h5 class="bold" style="padding: 4px; border-radius: 4px; background-color: aliceblue;">' . '<span class="text-muted" >' . "" . '</span>' . $data->univ_course_spec_fee_mode_type .
                '</h5>
             <p class="mb-0">' .
                '<span class="text-muted">' . "Course Session Year:-" . '</span>' . $data->univ_session_name . "<br>" .
                '<span class="text-muted">' . "Course Name:-" . '</span>' . $data->univ_course_name . "<br>" .
                '<span class="text-muted">' . "Course Specilization Name:-" . '</span>' . $data->univ_course_specialization_name . "<br>" .
                '<span class="text-muted">' . "Total Semester:-" . '</span>' . $data->univ_course_total_semester . "<br>" .
                '<span class="text-muted">' . "Total Years:-" . '</span>' . $data->univ_course_total_year . "<br>" .
                '<span class="text-muted">' . "Course Fee Payment Mode:-" . '</span>' . $data->univ_course_spec_fee_mode_type . "<br>";
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $FeesModeType = "Semester";
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $FeesModeType = "Year";
            } elseif ($data->univ_course_spec_fee_mode_type == "One Time") {
                $FeesModeType = "One Time";
            }
            $TotalFees = 0;
            foreach ($feeModeWise as $key => $feeModeVal) {
                $TotalFees += $fees[$key];
                $outPut .= '<span class="text-muted">' . $FeesModeType . " " . $feeModeVal . " => " . '</span>' . "Rs." . $fees[$key] . ", ";
            }
            $outPut .= '<br><span class="text-muted">Total Fees => </span>' . "Rs." . $TotalFees . '</div>';
        }
    }
    $outPut .= '</div>
     <div class="col-md-6">
     <h5 class="app-sub-heading text-center">Tutition Fees Details</h5>
      ';
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees AS ucs INNER JOIN universities_courses AS uc ON uc.univ_course_id =ucs.univ_course_id INNER JOIN universities_session_years AS usy ON usy.univ_session_id=ucs.univ_session_id INNER JOIN universities_courses_specializations AS ucse ON ucse.univ_specialization_id=ucs.university_specialization_id WHERE ucs.university_specialization_id = '" . $_POST['universityCoursesSpecilizationId'] . "' AND ucs.university_id = '" . $_POST['universityId'] . "' AND ucs.univ_session_id = '" . $_POST['sessionUniversityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $key => $data) {
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } else {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            }

            $outPut .= '
            <div class="card p-2" style="margin-bottom: 10px !important;">
            <h5 class="bold" style="padding: 4px; border-radius: 4px; background-color: aliceblue;">' . '<span class="text-muted" >' . "" . '</span>' . $data->univ_course_spec_fee_mode_type .
                '</h5>
             <p class="mb-0">' .
                '<span class="text-muted">' . "Course Session Year:-" . '</span>' . $data->univ_session_name . "<br>" .
                '<span class="text-muted">' . "Course Name:-" . '</span>' . $data->univ_course_name . "<br>" .
                '<span class="text-muted">' . "Course Specilization Name:-" . '</span>' . $data->univ_course_specialization_name . "<br>" .
                '<span class="text-muted">' . "Total Semester:-" . '</span>' . $data->univ_course_total_semester . "<br>" .
                '<span class="text-muted">' . "Total Years:-" . '</span>' . $data->univ_course_total_year . "<br>" .
                '<span class="text-muted">' . "Course Fee Payment Mode:-" . '</span>' . $data->univ_course_spec_fee_mode_type . "<br>";
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $FeesModeType = "Semester";
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $FeesModeType = "Year";
            } elseif ($data->univ_course_spec_fee_mode_type == "One Time") {
                $FeesModeType = "One Time";
            }
            $TotalFees = 0;
            foreach ($feeModeWise as $key => $feeModeVal) {
                $TotalFees += $fees[$key];
                $outPut .= '<span class="text-muted">' . $FeesModeType . " " . $feeModeVal . " => " . '</span>' . "Rs." . $fees[$key] . ", ";
            }
            $outPut .= '<br><span class="text-muted">Total Fees => </span>' . "Rs." . $TotalFees . '</div>';
        }
    }
    $outPut .= '</div>
    </div>';

    echo $outPut;
}
//Add New University Session  On Edit Page
if (!empty($_POST['univ_session_name'])) {

    $univ_session_name = $_POST['univ_session_name'];
    $university_id = $_POST['university_id'];
    $AddUniversitySession = [
        "university_id" => $university_id,
        "univ_session_name" => $_POST['univ_session_name'],
        "created_by" => LOGIN_UserId,
        "updated_by" => LOGIN_UserId,
    ];
    $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_session_years", $AddUniversitySession);
    if ($Save == true) {
        if (!empty($_POST['univ_course_name'])) {
            $SessionId = FETCH("SELECT univ_session_id  FROM universities_session_years ORDER BY univ_session_id DESC LIMIT 1", "univ_session_id");
            foreach ($_POST['univ_course_name'] as $key => $value) {
                $AddUniversitySessionCourses = [
                    "university_id" => $university_id,
                    "univ_session_id" => $SessionId,
                    "univ_course_id" => $_POST['univ_course_name'][$key],
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("univ_session_course", $AddUniversitySessionCourses);
            }
        }
    }
    if ($Save == true) {
        $response = array(
            "status" => "Success",
        );
        echo json_encode($response);
    } else {
        $response = array(
            "status" => "Error"
        );
        echo json_encode($response);
    }
}
//Add New University Session Courses On Edit Page
if (!empty($_POST['addcoursesBtn'])) {
    // AS uc INNERE JOIN univ_session_course AS usc ON usc.university_id = uc.university_id WHERE usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "' AND uc.univ_course_status='1'
    $fetchSessionCourseData = FETCH_DB_TABLE("SELECT * FROM universities_courses AS uc INNER JOIN univ_session_course AS usc ON usc.univ_course_id = uc.univ_course_id WHERE usc.univ_session_id='" . $_POST['sessionId'] . "' ", true);
    $outPut = "";
    if (!empty($fetchSessionCourseData)) {
        $outPut .= '<h5>Available Course Details</h5>';
        foreach ($fetchSessionCourseData as $data) {
            $outPut .= '<p><span class="text-muted">' . "Course Name: =>" . '</span>' . $data->univ_course_name . '<span class="text-muted">' . " Type: =>" . '</span>' . $data->univ_course_type . '<span class="text-muted">' . " Total Semster: =>" . '</span>' . $data->univ_course_total_semester . '<span class="text-muted">' . " Total Year: =>" . '</span>' . $data->univ_course_total_year . "<br>" . '</p>';
        }
        echo $outPut;
    } else {
        $outPut .= '<h5>Course Not Found</h5>';
    }
}
//Add New Courses ON EDit Page
if (!empty($_POST['addNewCourses'])) {

    $addNewCourses = [
        'university_id' => $_POST['UniversityId'],
        'univ_session_id' => $_POST['univ_session_id'],
        'univ_course_name' => $_POST['univ_course_name'],
        'univ_course_type' => $_POST['univ_course_type'],
        'univ_course_total_semester' => $_POST['univ_course_total_semesters'],
        'univ_course_total_year' => $_POST['univ_course_total_year'],
        "created_by" => LOGIN_UserId,
        "updated_by" => LOGIN_UserId,
    ];
    $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses", $addNewCourses);
    if ($Save == true) {
        //Fetch Course Id
        $coursesId = FETCH("SELECT univ_course_id FROM universities_courses WHERE university_id='" . $_POST['UniversityId'] . "' AND univ_session_id='" . $_POST['univ_session_id'] . "'ORDER BY univ_course_id DESC LIMIT 1", "univ_course_id");
        $addSessionCourses = [
            "univ_session_id" => $_POST['univ_session_id'],
            "univ_course_id" => $coursesId,
            "university_id" => $_POST['UniversityId'],
            "created_by" => LOGIN_UserId,
            "updated_by" => LOGIN_UserId,
        ];
        $Save = INSERT_DATA_WITHOUT_RESPONSE("univ_session_course", $addSessionCourses);
    }
    if ($Save == true) {
        $response = array(
            "status" => "Success",
        );
        echo json_encode($response);
    } else {
        $response = array(
            "status" => "Error"
        );
        echo json_encode($response);
    }
}
//Show Course List On Add New Specilization
if (!empty($_POST['addcoursesspecBtn'])) {
    // AS uc INNERE JOIN univ_session_course AS usc ON usc.university_id = uc.university_id WHERE usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "' AND uc.univ_course_status='1'
    $fetchSessionCourseData = FETCH_DB_TABLE("SELECT * FROM universities_courses AS uc INNER JOIN univ_session_course AS usc ON usc.univ_course_id = uc.univ_course_id WHERE usc.univ_session_id='" . $_POST['sessionId'] . "' ", true);
    $outPut = "";
    if (!empty($fetchSessionCourseData)) {
        $outPut .= '<option>choose courses</option>';
        foreach ($fetchSessionCourseData as $data) {
            $outPut .= '<option value="' . $data->univ_course_id . '">' . $data->univ_course_name . '</option>';
        }
        echo $outPut;
    } else {
        $outPut .= '<h5>Course Not Found</h5>';
    }
}
//show course specilization  on Add New speclization
if (!empty($_POST['addcoursesspecilizationBtn'])) {
    $fetchSessionCourseData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations AS ucs INNER JOIN  universities_courses AS uc ON uc.univ_course_id = ucs.univ_course_id WHERE ucs.univ_course_id='" . $_POST['coursesId'] . "' AND ucs.university_id='" . $_POST['universityId'] . "' AND ucs.univ_session_id='" . $_POST['sessionId'] . "'", true);
    $outPut = "";
    if (!empty($fetchSessionCourseData)) {
        $outPut .= '<h5>Available Course Specilization Details</h5>';
        foreach ($fetchSessionCourseData as $data) {
            $outPut .= '<p><span class="text-muted">' . "Course Specilization  Name: =>" . '</span>' . $data->univ_course_specialization_name  . "<br>" . '</p>';
        }
        echo $outPut;
    } else {
        $outPut .= '<h5>Course Specilization Not Found</h5>';
    }
}

//show course specilization  on Add New speclization start here
if (!empty($_POST['addcoursesspecilizationSemBtn'])) {
    $outPut = "";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM 	univ_session_course AS usc INNER JOIN  universities_courses AS uc ON uc.univ_course_id = usc.univ_course_id WHERE usc.univ_course_id='" . $_POST['coursesId'] . "' AND usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "'", true);

    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_course_total_year == "1") {
                $semesters = oneTimeFirstYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFirstYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="TuitionFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                 <label>Semester <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                  </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "2") {
                $semesters = oneTimeSecondYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeSecondYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="TuitionFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                 <label>Semester <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                  </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "3") {
                $semesters = oneTimeThirdYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeThirdYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="TuitionFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                 <label>Semester <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                  </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "4") {
                $semesters = oneTimeFourYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFourYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="TuitionFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                 <label>Semester <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                  </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "5") {
                $semesters = oneTimeFiveYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFiveYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="TuitionFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                 <label>Semester <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                  </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } else {
                $outPut .= '<div class="row" id="TuitionFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Semester <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
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
                                    <label>Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                  </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>

                              </div>';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}
if (!empty($_POST['addcoursesspecilizationYearBtn'])) {
    $outPut = "";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM 	univ_session_course AS usc INNER JOIN  universities_courses AS uc ON uc.univ_course_id = usc.univ_course_id WHERE usc.univ_course_id='" . $_POST['coursesId'] . "' AND usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_course_total_year == "1") {
                $years = firstYear();
                $lastYear = array_key_last($years);
                foreach (firstYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year <?php echo $req; ?></label>
                                    <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >

                                  </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "2") {
                $year = secondYear();
                $lastYear = array_key_last($year);
                foreach (secondYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year <?php echo $req; ?></label>
                                    <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >

                                  </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "3") {
                $year = thirdYear();
                $lastYear = array_key_last($year);
                foreach (thirdYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year <?php echo $req; ?></label>
                                    <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >

                                  </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "4") {
                $year = fourthYear();
                $lastYear = array_key_last($year);
                foreach (fourthYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year <?php echo $req; ?></label>
                                    <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >

                                  </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "5") {
                $year = fivethYear();
                $lastYear = array_key_last($year);
                foreach (fivethYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year <?php echo $req; ?></label>
                                    <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >

                                  </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }
                    $outPut .= ' </div>';
                }
            } else {
                $outPut .=
                    '<div class="row" id="TuitionYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year <?php echo $req; ?></label>
                                    <select name="tuition_course_years_name[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                      <option value="1">First Years</option>
                                      <option value="2">Second Years</option>
                                      <option value="3">Third Years</option>
                                      <option value="4">Fourth Years</option>
                                      <option value="5">Fifth Years</option>
                                    </select>
                                  </div>
                                  <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm" >

                                  </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>
                              </div>';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}

if (!empty($_POST['addcoursesspecilizationOneTimeBtn'])) {
    //Courses Specilization
    $outPut = "";
    if (!empty($_POST['coursesId'])) {
        $outPut = '<div class="row">
                                <div class="col-md-12 form-group d-flex">
                                  <div class="w-50">
                                    <label>Total<?php echo $req; ?></label>
                                    <select name="tuition_course_total_years_name[]" class="form-control form-control-sm">
                                      <option value="">Choose Total</option>
                                      <option value="One Time" selected>One Time</option>
                                    </select>
                                  </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Fee<?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_one_time_fee[]" class="form-control form-control-sm" >
                                  </div>
                    </div>

                </div>';
    }
    // Return the result as JSON
    echo $outPut;
}

if (!empty($_POST['addcoursesspecilizationTutitionSemBtn'])) {
    $outPut = "";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM 	univ_session_course AS usc INNER JOIN  universities_courses AS uc ON uc.univ_course_id = usc.univ_course_id WHERE usc.univ_course_id='" . $_POST['coursesId'] . "' AND usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_course_total_year == "1") {
                $semesters = oneTimeFirstYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFirstYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Semester <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
 <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                      </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "2") {
                $semesters = oneTimeSecondYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeSecondYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Semester <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
 <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                      </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "3") {
                $semesters = oneTimeThirdYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeThirdYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Semester <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
 <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                      </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "4") {
                $semesters = oneTimeFourYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFourYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Semester <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
 <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                      </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "5") {
                $semesters = oneTimeFiveYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFiveYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Semester <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                     ';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
 <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                      </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } else {
                $outPut .= '<div class="row" id="CustomFeesAddMoreSemester">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Semester <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
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
                                        <label>Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" >
                                      </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>

                                  </div>';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}
if (!empty($_POST['addcoursesspecilizationTutitionYearBtn'])) {
    $outPut = "";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM 	univ_session_course AS usc INNER JOIN  universities_courses AS uc ON uc.univ_course_id = usc.univ_course_id WHERE usc.univ_course_id='" . $_POST['coursesId'] . "' AND usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_course_total_year == "1") {
                $years = firstYear();
                $lastYear = array_key_last($years);
                foreach (firstYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >

                                      </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "2") {
                $year = secondYear();
                $lastYear = array_key_last($year);
                foreach (secondYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >

                                      </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "3") {
                $year = thirdYear();
                $lastYear = array_key_last($year);
                foreach (thirdYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >

                                      </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "4") {
                $year = fourthYear();
                $lastYear = array_key_last($year);
                foreach (fourthYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >

                                      </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "5") {
                $year = fivethYear();
                $lastYear = array_key_last($year);
                foreach (fivethYear() as $yearKey => $year) {
                    $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >

                                      </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } else {
                $outPut .=
                    '<div class="row" id="CustomYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>
                                          <option value="1">First Years</option>
                                          <option value="2">Second Years</option>
                                          <option value="3">Third Years</option>
                                          <option value="4">Fourth Years</option>
                                          <option value="5">Fifth Years</option>
                                        </select>
                                      </div>
                                      <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" >

                                      </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>
                                  </div>';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}
if (!empty($_POST['addcoursesspecilizationTutitionOneTimeBtn'])) {
    //Courses Specilization
    $outPut = "";
    if (!empty($_POST['coursesId'])) {
        $outPut = '<div class="row">
                                    <div class="col-md-12 form-group d-flex">
                                      <div class="w-50">
                                        <label>Total<?php echo $req; ?></label>
                                        <select name="custom_course_total_years_name[]" class="form-control form-control-sm">
                                          <option value="">Choose Total</option>
                                          <option value="One Time" selected>One Time</option>
                                        </select>
                                      </div>
                                      <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Fee<?php echo $req; ?></label>
                                        <input type="number" name="custom_course_one_time_fee[]" class="form-control form-control-sm" >
                                      </div>
                                    </div>

                                  </div>';
    }
    // Return the result as JSON
    echo $outPut;
}
//show course specilization  on Add New speclization end here

//Add New Courses Specilization On Edit Page
if (isset($formData['saveCoursesSpecilizationDataEditPage'])) {
    foreach ($formData["specialization"] as $specKey => $specilization) {
        $universityCoursesSpecilization = [
            "university_id" => $formData["universityId"],
            "univ_session_id" => $formData["universitySessionId"],
            "univ_course_id" => $formData["courseName"],
            "univ_course_specialization_name" => $formData["specialization"][$specKey],
            "created_by" => LOGIN_UserId,
            "updated_by" => LOGIN_UserId,
        ];
        $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations", $universityCoursesSpecilization);
        $universitySpecializationId = FETCH("SELECT univ_specialization_id  FROM universities_courses_specializations ORDER BY univ_specialization_id DESC LIMIT 1", "univ_specialization_id");
        //Course Fees
        if ($Save == true) {
            if ($formData["feesModeSemester"] == "Semesters Wise") {
                $specilizationFee = implode(",", $formData["semesterFee"]);
                $specilizationFeeName = implode(",", $formData["semesterName"]);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["courseName"],
                    "university_specialization_id" => $universitySpecializationId,
                    "univ_course_spec_fee_mode_type" => $formData["feesModeSemester"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
            }
            if ($formData["feesModeYear"] == "Years Wise") {
                $specilizationFee = implode(",", $formData["yearFees"]);
                $specilizationFeeName = implode(",", $formData["yearName"]);
                //Break Fees Equal In Semester Also
                $yearSemName = [];
                $yearSemAmount = [];
                foreach ($formData["yearName"] as $yearKey => $yearValue) {
                    if ($yearValue == "1") {
                        foreach (firstYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "2") {
                        foreach (secondYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "3") {
                        foreach (thirdYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "4") {
                        foreach (fourYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    }
                }
                //Implode
                $yearSemNames = implode(",", $yearSemName);
                $yearSemAmounts = implode(",", $yearSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["courseName"],
                    "university_specialization_id" => $universitySpecializationId,
                    "univ_course_spec_fee_mode_type" => $formData["feesModeYear"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $yearSemNames,
                    "univ_course_spec_fee_sem_value" => $yearSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
            }
            if ($formData["feesModeOneTime"] == "One Time") {
                //Fetch Course Year
                $CourseTotalYear = FETCH("SELECT univ_course_total_year FROM universities_courses WHERE univ_course_id='" . $formData["courseName"] . "'", "univ_course_total_year");
                $specilizationFee = implode(",", $formData["oneTimeFees"]);
                $specilizationFeeName = implode(",", $formData["oneTimeName"]);
                //Break Fees Equal In Semester Also
                $OneTimeSemName = [];
                $OneTimeSemAmount = [];
                foreach ($formData["oneTimeName"] as $oneKey => $OneTimeSemNameData) {
                    if ($CourseTotalYear == "1") {
                        foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 2;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "2") {
                        foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 4;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "3") {
                        foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 6;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "4") {
                        foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 8;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 10;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    }
                }

                //Implode
                $OneTimeSemNames = implode(",", $OneTimeSemName);
                $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["courseName"],
                    "university_specialization_id" => $universitySpecializationId,
                    "univ_course_spec_fee_mode_type" => $formData["feesModeOneTime"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                    "univ_course_spec_fee_sem_value" => $OneTimeSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
            }
        }
        //TUTITION FEES
        if ($Save == true) {
            if ($formData["feesModeSemestercustom"] == "Semesters Wise") {
                $specilizationFee = implode(",", $formData["semesterFeecustom"]);
                $specilizationFeeName = implode(",", $formData["semesterNamecustom"]);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["courseName"],
                    "university_specialization_id" => $universitySpecializationId,
                    "univ_course_spec_fee_mode_type" => $formData["feesModeSemestercustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
            }
            if ($formData["feesModeYearcustom"] == "Years Wise") {
                $specilizationFee = implode(",", $formData["yearFeescustom"]);
                $specilizationFeeName = implode(",", $formData["yearNamecustom"]);
                //Break Fees Equal In Semester Also
                $yearSemName = [];
                $yearSemAmount = [];
                foreach ($formData["yearNamecustom"] as $yearKey => $yearValue) {
                    if ($yearValue == "1") {
                        foreach (firstYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "2") {
                        foreach (secondYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "3") {
                        foreach (thirdYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "4") {
                        foreach (fourYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    }
                }

                //Implode
                $yearSemNames = implode(",", $yearSemName);
                $yearSemAmounts = implode(",", $yearSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["courseName"],
                    "university_specialization_id" => $universitySpecializationId,
                    "univ_course_spec_fee_mode_type" => $formData["feesModeYearcustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $yearSemNames,
                    "univ_course_spec_total_fee_value" => $yearSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
            }
            if ($formData["feesModeOneTimecustom"] == "One Time") {
                //Fetch Course Year
                $CourseTotalYear = FETCH("SELECT univ_course_total_year FROM universities_courses WHERE univ_course_id='" . $formData["courseName"] . "'", "univ_course_total_year");

                $specilizationFee = implode(
                    ",",
                    $formData["oneTimeFeescustom"]
                );
                $specilizationFeeName = implode(",", $formData["oneTimeNamecustom"]);
                //Break Fees Equal In Semester Also
                $OneTimeSemName = [];
                $OneTimeSemAmount = [];
                foreach ($formData["oneTimeNamecustom"] as $oneKey => $OneTimeSemNameData) {
                    if ($CourseTotalYear == "1") {
                        foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 2;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "2") {
                        foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 4;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "3") {
                        foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 6;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "4") {
                        foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 8;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 10;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    }
                }
                //Implode
                $OneTimeSemNames = implode(",", $OneTimeSemName);
                $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["courseName"],
                    "university_specialization_id" => $universitySpecializationId,
                    "univ_course_spec_fee_mode_type" => $formData["feesModeOneTimecustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                    "univ_course_spec_total_fee_value" => $OneTimeSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
            }
        }
    }
    if ($Save == true) {
        $response = array(
            "status" => "Success",
        );
        echo json_encode($response);
    } else {
        $response = array(
            "status" => "Error"
        );
        echo json_encode($response);
    }
}
//show course specilization  on Add New speclization
if (!empty($_POST['addcoursesspecilizationsBtn'])) {
    // AS uc INNERE JOIN univ_session_course AS usc ON usc.university_id = uc.university_id WHERE usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "' AND uc.univ_course_status='1'
    $fetchSessionCourseData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations AS ucs INNER JOIN univ_session_course AS usc ON ucs.univ_course_id = usc.univ_course_id WHERE usc.univ_session_id='" . $_POST['sessionId'] . "' ", true);
    $outPut = "";
    if (!empty($fetchSessionCourseData)) {
        $outPut .= '<option>choose course specilization</option>';
        foreach ($fetchSessionCourseData as $data) {
            $outPut .= '<option value="' . $data->univ_specialization_id . '">' . $data->univ_course_specialization_name . '</option>';
        }
        echo $outPut;
    } else {
        $outPut .= '<option>Course Specilization Not Found</option>';
    }
}
if (!empty($_POST['showCoursesSpecilizationsFeeBtn'])) {
    // Fetch University Course Specilization Fees Details According To University Session
    $fetchSessionCoursesSpecFee = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['courseSpecitilizationId'] . "' AND univ_session_id='" . $_POST['sessionId'] . "' AND university_id='" . $_POST['universityId'] . "' AND univ_course_id='" . $_POST['coursesId'] . "'", true);

    $outPut = "";
    if (!empty($fetchSessionCoursesSpecFee)) {
        $outPut .= '<h5 class="app-sub-heading text-center">Oops! Fees Details Already Exist. Please do not add a new fee for this Course Specilization..</h5>';
        $outPut .= '<div class="row">';
        foreach ($fetchSessionCoursesSpecFee as $data) {
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            } else {
                $feeModeWise = explode(",", $data->univ_course_spec_fee_name);
                $fees = explode(",", $data->univ_course_spec_fee_value);
            }

            $outPut .= '<div class="col-md-4">
            <div class="card p-2" style="margin-bottom: 10px !important;">
            <h5 class="bold" style="padding: 4px; border-radius: 4px; background-color: aliceblue;">' . '<span class="text-muted" >' . "" . '</span>' . $data->univ_course_spec_fee_mode_type .
                '</h5>
             <p class="mb-0">' .

                '<span class="text-muted pb-1">' . "Course Fee Payment Mode:-" . '</span>' . $data->univ_course_spec_fee_mode_type . "<br>";
            if ($data->univ_course_spec_fee_mode_type == "Semesters Wise") {
                $FeesModeType = "Semester";
            } elseif ($data->univ_course_spec_fee_mode_type == "Years Wise") {
                $FeesModeType = "Year";
            } elseif ($data->univ_course_spec_fee_mode_type == "One Time") {
                $FeesModeType = "One Time";
            }
            $TotalFees = 0;
            foreach ($feeModeWise as $key => $feeModeVal) {
                $TotalFees += $fees[$key];
                $outPut .= '<span class="text-muted">' . $FeesModeType . " " . $feeModeVal . " => " . '</span>' . "Rs." . $fees[$key] . "<br>";
            }
            $outPut .= '<span class="text-muted">Total Fees => </span>' . "Rs." . $TotalFees . '</div></div>';
        }
        $outPut .= '</div>';
        echo $outPut;
    }
}

//show course specilization Fees  on Add New speclization Fees Start Here//
if (!empty($_POST['addcoursesspecilizationFeesSemBtn'])) {
    $outPut = "";
    $fetchSessionCoursesSpecFee = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['courseSpecitilizationId'] . "' AND univ_session_id='" . $_POST['sessionId'] . "' AND university_id='" . $_POST['universityId'] . "' AND univ_course_id='" . $_POST['coursesId'] . "'", true);
    if (empty($fetchSessionCoursesSpecFee)) {
        $fetchData = FETCH_DB_TABLE("SELECT * FROM univ_session_course AS usc INNER JOIN  universities_courses AS uc ON uc.univ_course_id = usc.univ_course_id WHERE usc.univ_course_id='" . $_POST['coursesId'] . "' AND usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "'", true);
        if (isset($fetchData)) {
            foreach ($fetchData as $val) {
                if ($val->univ_course_total_year == "1") {
                    $semesters = oneTimeFirstYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeFirstYearTotalSem() as $semKey => $sem) {
                        $outPut .= '  <div class="row" id="TuitionFeesAddMoreSemesterWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Sem Name <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_nameWise[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                        </div>
                       <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Sem Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                  </div>
                    </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }


                        $outPut .= '  </div>';
                    }
                } elseif ($val->univ_course_total_year == "2") {
                    $semesters = oneTimeSecondYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeSecondYearTotalSem() as $semKey => $sem) {
                        $outPut .= '   <div class="row" id="TuitionFeesAddMoreSemesterWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Sem Name <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_nameWise[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Sem Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                  </div>
                    </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }


                        $outPut .= '  </div>';
                    }
                } elseif ($val->univ_course_total_year == "3") {
                    $semesters = oneTimeThirdYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeThirdYearTotalSem() as $semKey => $sem) {
                        $outPut .=
                            '   <div class="row" id="TuitionFeesAddMoreSemesterWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Sem Name <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_nameWise[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Sem Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                  </div>
                    </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }


                        $outPut .= '  </div>';
                    }
                } elseif ($val->univ_course_total_year == "4") {
                    $semesters = oneTimeFourYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeFourYearTotalSem() as $semKey => $sem) {
                        $outPut .=
                            '   <div class="row" id="TuitionFeesAddMoreSemesterWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Sem Name <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_nameWise[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Sem Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                  </div>
                    </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }


                        $outPut .= '  </div>';
                    }
                } elseif ($val->univ_course_total_year == "5") {
                    $semesters = oneTimeFiveYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeFiveYearTotalSem() as $semKey => $sem) {
                        $outPut .=
                            '   <div class="row" id="TuitionFeesAddMoreSemesterWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Sem Name <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_nameWise[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
                                     ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Sem Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                  </div>
                    </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }


                        $outPut .= '  </div>';
                    }
                } else {
                    $outPut .= '<div class="row" id="TuitionFeesAddMoreSemesterWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Sem Name <?php echo $req; ?></label>
                                    <select name="tuition_fees_semester_nameWise[]" class="form-control form-control-sm">
                                      <option value="">Choose Semester</option>
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
                                    <label>Sem Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                  </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>

                              </div>';
                }
            }
            // Return the result as JSON
            echo $outPut;
        }
    }
}
if (!empty($_POST['addcoursesspecilizationFeesYearBtn'])) {
    $outPut = "";
    $fetchSessionCoursesSpecFee = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['courseSpecitilizationId'] . "' AND univ_session_id='" . $_POST['sessionId'] . "' AND university_id='" . $_POST['universityId'] . "' AND univ_course_id='" . $_POST['coursesId'] . "'", true);
    if (empty($fetchSessionCoursesSpecFee)) {
        $fetchData = FETCH_DB_TABLE("SELECT * FROM 	univ_session_course AS usc INNER JOIN  universities_courses AS uc ON uc.univ_course_id = usc.univ_course_id WHERE usc.univ_course_id='" . $_POST['coursesId'] . "' AND usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "'", true);
        if (isset($fetchData)) {
            foreach ($fetchData as $val) {
                if ($val->univ_course_total_year == "1") {
                    $years = firstYear();
                    $lastYear = array_key_last($years);
                    foreach (firstYear() as $yearKey => $year) {
                        $outPut .= '<div class="row" id="TuitionYearsFeesAddMoreYearsWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year Name <?php echo $req; ?></label>
                                    <select name="tuition_course_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                  </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } elseif ($val->univ_course_total_year == "2") {
                    $year = secondYear();
                    $lastYear = array_key_last($year);
                    foreach (secondYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYearsWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year Name <?php echo $req; ?></label>
                                    <select name="tuition_course_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                       <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                  </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } elseif ($val->univ_course_total_year == "3") {
                    $year = thirdYear();
                    $lastYear = array_key_last($year);
                    foreach (thirdYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYearsWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year Name <?php echo $req; ?></label>
                                    <select name="tuition_course_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                       <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                  </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } elseif ($val->univ_course_total_year == "4") {
                    $year = fourthYear();
                    $lastYear = array_key_last($year);
                    foreach (fourthYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYearsWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year Name <?php echo $req; ?></label>
                                    <select name="tuition_course_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                       <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                  </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } elseif ($val->univ_course_total_year == "5") {
                    $year = fivethYear();
                    $lastYear = array_key_last($year);
                    foreach (fivethYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="TuitionYearsFeesAddMoreYearsWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year Name <?php echo $req; ?></label>
                                    <select name="tuition_course_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                     ';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                       <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                  </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } else {
                    $outPut .=
                        '<div class="row" id="TuitionYearsFeesAddMoreYearsWise">
                                <div class="col-md-10 form-group d-flex">
                                  <div class="w-50">
                                    <label>Year Name <?php echo $req; ?></label>
                                    <select name="tuition_course_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">choose year</option>
                                      <option value="1">First Years</option>
                                      <option value="2">Second Years</option>
                                      <option value="3">Third Years</option>
                                      <option value="4">Fourth Years</option>
                                      <option value="5">Fifth Years</option>
                                    </select>
                                  </div>
                                  <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>Year Fee <?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                  </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                  <label></label>
                                  <button class="btn btn-outline-info  add_tution_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>
                              </div>';
                }
            }
            // Return the result as JSON
            echo $outPut;
        }
    }
}
if (!empty($_POST['addcoursesspecilizationFeesOneTimeBtn'])) {
    //Courses Specilization
    $outPut = "";
    $fetchSessionCoursesSpecFee = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['courseSpecitilizationId'] . "' AND univ_session_id='" . $_POST['sessionId'] . "' AND university_id='" . $_POST['universityId'] . "' AND univ_course_id='" . $_POST['coursesId'] . "'", true);
    if (empty($fetchSessionCoursesSpecFee)) {
        if (!empty($_POST['coursesId'])) {
            $outPut = '<div class="row">
                                <div class="col-md-12 form-group d-flex">
                                  <div class="w-50">
                                    <label>Total Year Fee<?php echo $req; ?></label>
                                    <select name="tuition_course_total_years_nameWise[]" class="form-control form-control-sm">
                                      <option value="">Choose Total Year Fee</option>
                                      <option value="One Time" selected>One Time</option>
                                    </select>
                                  </div>
                                  <div class="w-50" style="padding-left: 0.3125rem;">
                                    <label>One Time Fee<?php echo $req; ?></label>
                                    <input type="number" name="tuition_course_one_time_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                  </div>
                                </div>

                              </div>';
        }
        // Return the result as JSON
        echo $outPut;
    }
}
if (!empty($_POST['addcoursesspecilizationFeesTutitionSemBtn'])) {
    $outPut = "";
    $fetchSessionCoursesSpecFee = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['courseSpecitilizationId'] . "' AND univ_session_id='" . $_POST['sessionId'] . "' AND university_id='" . $_POST['universityId'] . "' AND univ_course_id='" . $_POST['coursesId'] . "'", true);
    if (empty($fetchSessionCoursesSpecFee)) {
        $fetchData = FETCH_DB_TABLE("SELECT * FROM 	univ_session_course AS usc INNER JOIN  universities_courses AS uc ON uc.univ_course_id = usc.univ_course_id WHERE usc.univ_course_id='" . $_POST['coursesId'] . "' AND usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "'", true);
        if (isset($fetchData)) {
            foreach ($fetchData as $val) {
                if ($val->univ_course_total_year == "1") {
                    $semesters = oneTimeFirstYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeFirstYearTotalSem() as $semKey => $sem) {
                        $outPut .= ' <div class="row" id="CustomFeesAddMoreSemesterWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Sem Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                     ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                        </div>
                            <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Sem Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                                                </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }


                        $outPut .= '  </div>';
                    }
                } elseif ($val->univ_course_total_year == "2") {
                    $semesters = oneTimeSecondYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeSecondYearTotalSem() as $semKey => $sem) {
                        $outPut .= '  <div class="row" id="CustomFeesAddMoreSemesterWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Sem Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                                                ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                                </div>
                             <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Sem Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                                                </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }



                        $outPut .= '  </div>';
                    }
                } elseif ($val->univ_course_total_year == "3") {
                    $semesters = oneTimeThirdYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeThirdYearTotalSem() as $semKey => $sem) {
                        $outPut .= '  <div class="row" id="CustomFeesAddMoreSemesterWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Sem Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                                                ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                                                    </div>
                             <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Sem Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                                                </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }



                        $outPut .= '  </div>';
                    }
                } elseif ($val->univ_course_total_year == "4") {
                    $semesters = oneTimeFourYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeFourYearTotalSem() as $semKey => $sem) {
                        $outPut .=
                            '  <div class="row" id="CustomFeesAddMoreSemesterWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Sem Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                                                ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                                                    </div>
                             <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Sem Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                                                </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }



                        $outPut .= '  </div>';
                    }
                } elseif ($val->univ_course_total_year == "5") {
                    $semesters = oneTimeFiveYearTotalSem();
                    $lastSemester = array_key_last($semesters);
                    foreach (oneTimeFiveYearTotalSem() as $semKey => $sem) {
                        $outPut .=
                            '  <div class="row" id="CustomFeesAddMoreSemesterWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Sem Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
                                                                ';
                        foreach (SemesterList() as $AllSemKey => $semName) {
                            if ($AllSemKey == $semKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                        }
                        $outPut .= '</select>
                            </div>
                             <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Sem Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                    </div>';
                        if ($semKey == $lastSemester) {
                            $outPut .= '  <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }


                        $outPut .= '  </div>';
                    }
                } else {
                    $outPut .= '<div class="row" id="CustomFeesAddMoreSemesterWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Sem Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
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
                                        <label>Sem Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>

                                  </div>';
                }
            }
            // Return the result as JSON
            echo $outPut;
        }
    }
}
if (!empty($_POST['addcoursesspecilizationFeesTutitionYearBtn'])) {
    $outPut = "";
    $fetchSessionCoursesSpecFee = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['courseSpecitilizationId'] . "' AND univ_session_id='" . $_POST['sessionId'] . "' AND university_id='" . $_POST['universityId'] . "' AND univ_course_id='" . $_POST['coursesId'] . "'", true);
    if (empty($fetchSessionCoursesSpecFee)) {
        $fetchData = FETCH_DB_TABLE("SELECT * FROM 	univ_session_course AS usc INNER JOIN  universities_courses AS uc ON uc.univ_course_id = usc.univ_course_id WHERE usc.univ_course_id='" . $_POST['coursesId'] . "' AND usc.university_id='" . $_POST['universityId'] . "' AND usc.univ_session_id='" . $_POST['sessionId'] . "'", true);
        if (isset($fetchData)) {
            foreach ($fetchData as $val) {
                if ($val->univ_course_total_year == "1") {
                    $years = firstYear();
                    $lastYear = array_key_last($years);
                    foreach (firstYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYearsWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year Name <?php echo $req; ?></label>
                                        <select name="custom_course_years_nameWise[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                      </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } elseif ($val->univ_course_total_year == "2") {
                    $year = secondYear();
                    $lastYear = array_key_last($year);
                    foreach (secondYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYearsWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year Name <?php echo $req; ?></label>
                                        <select name="custom_course_years_nameWise[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                       <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                      </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } elseif ($val->univ_course_total_year == "3") {
                    $year = thirdYear();
                    $lastYear = array_key_last($year);
                    foreach (thirdYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYearsWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year Name <?php echo $req; ?></label>
                                        <select name="custom_course_years_nameWise[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                       <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                      </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } elseif ($val->univ_course_total_year == "4") {
                    $year = fourthYear();
                    $lastYear = array_key_last($year);
                    foreach (fourthYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYearsWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year Name <?php echo $req; ?></label>
                                        <select name="custom_course_years_nameWise[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                       <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                      </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } elseif ($val->univ_course_total_year == "5") {
                    $year = fivethYear();
                    $lastYear = array_key_last($year);
                    foreach (fivethYear() as $yearKey => $year) {
                        $outPut .= '  <div class="row" id="CustomYearsFeesAddMoreYearsWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Year Name <?php echo $req; ?></label>
                                        <select name="custom_course_years_nameWise[]" class="form-control form-control-sm">
                                          <option value="">choose year</option>';
                        foreach (YearList() as $yearListKey => $year) {
                            if ($yearListKey == $yearKey) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                        }


                        $outPut .= '</select>
                                        </div>
                                       <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>Year Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_course_years_feeWise[]" class="form-control form-control-sm" placeholder="10000">

                                      </div>
                                    </div>';
                        if ($lastYear == $yearKey) {
                            $outPut .= ' <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_yearWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                        }
                        $outPut .= ' </div>';
                    }
                } else {
                    $outPut .=
                        '<div class="row" id="CustomFeesAddMoreSemesterWise">
                                    <div class="col-md-10 form-group d-flex">
                                      <div class="w-50">
                                        <label>Sem Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Semester</option>
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
                                        <label>Sem Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                      <label></label>
                                      <button class="btn btn-outline-info  add_custom_semesterWise_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>

                                  </div>';
                }
            }
            // Return the result as JSON
            echo $outPut;
        }
    }
}
if (!empty($_POST['addcoursesspecilizationFeesTutitionOneTimeBtn'])) {
    //Courses Specilization
    $outPut = "";
    $fetchSessionCoursesSpecFee = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations_fees WHERE university_specialization_id='" . $_POST['courseSpecitilizationId'] . "' AND univ_session_id='" . $_POST['sessionId'] . "' AND university_id='" . $_POST['universityId'] . "' AND univ_course_id='" . $_POST['coursesId'] . "'", true);
    if (empty($fetchSessionCoursesSpecFee)) {
        if (!empty($_POST['coursesId'])) {
            $outPut = '<div class="row">
                                    <div class="col-md-12 form-group d-flex">
                                      <div class="w-50">
                                        <label>Total Year Fee<?php echo $req; ?></label>
                                        <select name="custom_course_total_years_nameWise[]" class="form-control form-control-sm">
                                          <option value="">Choose Total Year Fee</option>
                                          <option value="One Time" selected>One Time</option>
                                        </select>
                                      </div>
                                      <div class="w-50" style="padding-left: 0.3125rem;">
                                        <label>One Time Fee<?php echo $req; ?></label>
                                        <input type="number" name="custom_course_one_time_feeWise[]" class="form-control form-control-sm" placeholder="10000">
                                      </div>
                                    </div>

                                  </div>';
        }
        // Return the result as JSON
        echo $outPut;
    }
}
//show course specilization Fees  on Add New speclization Fees End Here//

//Add New Courses Specilization Fees Details On Edit Page
if (isset($formData['saveCoursesSpecilizationFeesDetails'])) {

    $universitySpecializationFeesId = FETCH("SELECT univ_courses_spec_fee_id  FROM universities_courses_specializations_fees WHERE university_id='" . $formData["universityId"] . "' AND univ_session_id='" . $formData["universitySessionId"] . "' AND univ_course_id='" . $formData["courseName"] . "' AND university_specialization_id='" . $formData["specialization"] . "'", "univ_courses_spec_fee_id");
    if ($universitySpecializationFeesId != true) {
        //Course Fees

        if ($formData["feesModeSemester"] == "Semesters Wise") {
            $specilizationFee = implode(",", $formData["semesterFee"]);
            $specilizationFeeName = implode(",", $formData["semesterName"]);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universitySessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeSemester"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
        }
        if ($formData["feesModeYear"] == "Years Wise") {
            $specilizationFee = implode(",", $formData["yearFees"]);
            $specilizationFeeName = implode(",", $formData["yearName"]);
            //Break Fees Equal In Semester Also
            $yearSemName = [];
            $yearSemAmount = [];
            foreach ($formData["yearName"] as $yearKey => $yearValue) {
                if ($yearValue == "1") {
                    foreach (firstYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "2") {
                    foreach (secondYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "3") {
                    foreach (thirdYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "4") {
                    foreach (fourYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "5") {
                    foreach (fiveYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFees"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                }
            }
            //Implode
            $yearSemNames = implode(",", $yearSemName);
            $yearSemAmounts = implode(",", $yearSemAmount);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universitySessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeYear"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "univ_course_spec_fee_sem_name" => $yearSemNames,
                "univ_course_spec_fee_sem_value" => $yearSemAmounts,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
        }
        if ($formData["feesModeOneTime"] == "One Time") {
            //Fetch Course Year
            $CourseTotalYear = FETCH("SELECT univ_course_total_year FROM universities_courses WHERE univ_course_id='" . $formData["courseName"] . "'", "univ_course_total_year");
            $specilizationFee = implode(",", $formData["oneTimeFees"]);
            $specilizationFeeName = implode(",", $formData["oneTimeName"]);
            //Break Fees Equal In Semester Also
            $OneTimeSemName = [];
            $OneTimeSemAmount = [];
            foreach ($formData["oneTimeName"] as $oneKey => $OneTimeSemNameData) {
                if ($CourseTotalYear == "1") {
                    foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 2;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "2") {
                    foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 4;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "3") {
                    foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 6;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "4") {
                    foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 8;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "5") {
                    foreach (fiveYearSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFees"][$oneKey] / 10;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                }
            }
            //Implode
            $OneTimeSemNames = implode(",", $OneTimeSemName);
            $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universitySessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeOneTime"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                "univ_course_spec_fee_sem_value" => $OneTimeSemAmounts,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
        }

        //TUTITION FEES

        if ($formData["feesModeSemestercustom"] == "Semesters Wise") {
            $specilizationFee = implode(
                ",",
                $formData["semesterFeecustom"]
            );
            $specilizationFeeName = implode(",", $formData["semesterNamecustom"]);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universitySessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeSemestercustom"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
        }
        if ($formData["feesModeYearcustom"] == "Years Wise") {
            $specilizationFee = implode(",", $formData["yearFeescustom"]);
            $specilizationFeeName = implode(",", $formData["yearNamecustom"]);
            //Break Fees Equal In Semester Also
            $yearSemName = [];
            $yearSemAmount = [];
            foreach ($formData["yearNamecustom"] as $yearKey => $yearValue) {
                if ($yearValue == "1") {
                    foreach (firstYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "2") {
                    foreach (secondYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "3") {
                    foreach (thirdYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "4") {
                    foreach (fourYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                } elseif ($yearValue == "5") {
                    foreach (fiveYearSem() as $semKey => $semName) {
                        $yearSemName[] = $semKey;
                    }
                    $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                    $yearSemAmount[] = $splitFee;
                    $yearSemAmount[] = $splitFee;
                }
            }

            //Implode
            $yearSemNames = implode(",", $yearSemName);
            $yearSemAmounts = implode(",", $yearSemAmount);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universitySessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeYearcustom"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "univ_course_spec_fee_sem_name" => $yearSemNames,
                "univ_course_spec_total_fee_value" => $yearSemAmounts,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
        }
        if ($formData["feesModeOneTimecustom"] == "One Time") {
            //Fetch Course Year
            $CourseTotalYear = FETCH("SELECT univ_course_total_year FROM universities_courses WHERE univ_course_id='" . $formData["courseName"] . "'", "univ_course_total_year");
            $specilizationFee = implode(",", $formData["oneTimeFeescustom"]);
            $specilizationFeeName = implode(",", $formData["oneTimeNamecustom"]);
            //Break Fees Equal In Semester Also
            $OneTimeSemName = [];
            $OneTimeSemAmount = [];
            foreach ($formData["oneTimeNamecustom"] as $oneKey => $OneTimeSemNameData) {
                if ($CourseTotalYear == "1") {
                    foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 2;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "2") {
                    foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 4;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "3") {
                    foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 6;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "4") {
                    foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 8;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                } elseif ($CourseTotalYear == "5") {
                    foreach (fiveYearSem() as $semKey => $semName) {
                        $OneTimeSemName[] = $semKey;
                    }
                    $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 10;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                    $OneTimeSemAmount[] = $splitFee;
                }
            }
            //Implode
            $OneTimeSemNames = implode(",", $OneTimeSemName);
            $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
            $universityCoursesSpecilizationFees = [
                "university_id" => $formData["universityId"],
                "univ_session_id" => $formData["universitySessionId"],
                "univ_course_id" => $formData["courseName"],
                "university_specialization_id" => $formData["specialization"],
                "univ_course_spec_fee_mode_type" => $formData["feesModeOneTimecustom"],
                "univ_course_spec_fee_name" => $specilizationFeeName,
                "univ_course_spec_fee_value" => $specilizationFee,
                "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                "univ_course_spec_total_fee_value" => $OneTimeSemAmounts,
                "created_by" => LOGIN_UserId,
                "updated_by" => LOGIN_UserId,
            ];
            $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
        }
    } else {
        $Save = "";
        $IsExists = "Already Exists";
    }
    if ($Save == true) {
        $response = array(
            "status" => "Success",
        );
        echo json_encode($response);
    } elseif ($IsExists == "Already Exists") {
        $response = array(
            "status" => "Already Exists",
        );
        echo json_encode($response);
    } else {
        $response = array(
            "status" => "Error"
        );
        echo json_encode($response);
    }
}
//Show Update Course Deatils
if (isset($formData['updateCoursesData'])) {
    // var_dump($formData['univ_course_name']);
    // die;
    //Update University Session Years Name
    $UniversitySessionYears = [
        "univ_session_name" => $formData['univ_session_name'],
        "updated_by" => LOGIN_UserId,
    ];
    $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_session_years", $UniversitySessionYears, "university_id='" . $formData['universityId'] . "'" and "univ_session_id='" . $formData['universitySessionId'] . "'");
    if ($Update) {
        //Update University Session Courses Name
        $UniversitySessionCourses = [
            "univ_course_name" => $formData['univ_course_name'],
            "univ_course_type" => $formData['univ_course_type'],
            "univ_course_total_year" => $formData['univ_course_total_year'],
            "univ_course_total_semester" => $formData['univ_course_total_semester'],
            "updated_by" => LOGIN_UserId,
        ];
        $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_courses", $UniversitySessionCourses, "univ_course_id='" . $formData['universityCourseId'] . "'");
    }
    if ($Update) {
        //Update University Session Courses Name
        $UniversitySessionCoursesSpec = [
            "univ_course_specialization_name" => $formData['univ_course_specialization_name'],
            "updated_by" => LOGIN_UserId,
        ];
        $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_courses_specializations", $UniversitySessionCoursesSpec, "univ_specialization_id='" . $formData['universityCourseSpecilizationId'] . "'");
    }
    //Course Fees
    if ($Update) {
        if (!empty($formData['UnivCourseSpecSemFeeId'])) {
            if ($formData["feesModeSemester"] == "Semesters Wise") {
                $specilizationFee = implode(",", $formData["semesterFee"]);
                $specilizationFeeName = implode(",", $formData["semesterName"]);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeSemester"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                // $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
                $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees, "university_specialization_id='" . $formData['universityCourseSpecilizationId'] . "' AND university_id='" . $formData['universityId'] . "' AND univ_session_id='" . $formData['universitySessionId'] . "'  AND univ_course_id='" . $formData['universityCourseId'] . "' AND univ_courses_spec_fee_id='" . $formData['UnivCourseSpecSemFeeId'] . "'");
            }
        } else {
            if ($formData["feesModeSemester"] == "Semesters Wise") {
                // "university_specialization_id='" . $formData['universityCourseSpecilizationId'] . "' AND university_id='" . $formData['universityId'] . "' AND univ_session_id='" . $formData['universitySessionId'] . "'  AND univ_course_id='" . $formData['universityCourseId'] . "' AND univ_courses_spec_fee_id='" . $formData['UnivCourseSpecSemFeeId'] . "'
                $specilizationFee = implode(",", $formData["semesterFee"]);
                $specilizationFeeName = implode(",", $formData["semesterName"]);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData["universityCourseSpecilizationId"],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeSemester"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
            }
        }

        if (!empty($formData['UnivCourseSpecYrFeeId'])) {
            if ($formData["feesModeYear"] == "Years Wise") {
                $specilizationFee = implode(",", $formData["yearFees"]);
                $specilizationFeeName = implode(",", $formData["yearName"]);
                //Break Fees Equal In Semester Also
                $yearSemName = [];
                $yearSemAmount = [];
                foreach ($formData["yearName"] as $yearKey => $yearValue) {
                    if ($yearValue == "1") {
                        foreach (firstYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "2") {
                        foreach (secondYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "3") {
                        foreach (thirdYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "4") {
                        foreach (fourYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    }
                }
                //Implode
                $yearSemNames = implode(",", $yearSemName);
                $yearSemAmounts = implode(",", $yearSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeYear"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $yearSemNames,
                    "univ_course_spec_fee_sem_value" => $yearSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees, "university_specialization_id='" . $formData['universityCourseSpecilizationId'] . "' AND university_id='" . $formData['universityId'] . "' AND univ_session_id='" . $formData['universitySessionId'] . "'  AND univ_course_id='" . $formData['universityCourseId'] . "'  AND univ_courses_spec_fee_id='" . $formData['UnivCourseSpecYrFeeId'] . "'");
            }
        } else {
            if ($formData["feesModeYear"] == "Years Wise") {
                $specilizationFee = implode(",", $formData["yearFees"]);
                $specilizationFeeName = implode(",", $formData["yearName"]);
                //Break Fees Equal In Semester Also
                $yearSemName = [];
                $yearSemAmount = [];
                foreach ($formData["yearName"] as $yearKey => $yearValue) {
                    if ($yearValue == "1") {
                        foreach (firstYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "2") {
                        foreach (secondYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "3") {
                        foreach (thirdYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "4") {
                        foreach (fourYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFees"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    }
                }
                //Implode
                $yearSemNames = implode(",", $yearSemName);
                $yearSemAmounts = implode(",", $yearSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeYear"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $yearSemNames,
                    "univ_course_spec_fee_sem_value" => $yearSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
            }
        }

        if (!empty($formData['UnivCourseSpecOneTimeFeeId'])) {
            if ($formData["feesModeOneTime"] == "One Time") {
                //Fetch Course Year
                $CourseTotalYear = $formData['univ_course_total_year'];
                $specilizationFee = implode(",", $formData["oneTimeFees"]);
                $specilizationFeeName = implode(",", $formData["oneTimeName"]);
                //Break Fees Equal In Semester Also
                $OneTimeSemName = [];
                $OneTimeSemAmount = [];
                foreach ($formData["oneTimeName"] as $oneKey => $OneTimeSemNameData) {
                    if ($CourseTotalYear == "1") {
                        foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 2;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "2") {
                        foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 4;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "3") {
                        foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 6;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "4") {
                        foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 8;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 10;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    }
                }

                //Implode
                $OneTimeSemNames = implode(",", $OneTimeSemName);
                $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeOneTime"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                    "univ_course_spec_fee_sem_value" => $OneTimeSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees, "university_specialization_id='" . $formData['universityCourseSpecilizationId'] . "' AND university_id='" . $formData['universityId'] . "' AND univ_session_id='" . $formData['universitySessionId'] . "'  AND univ_course_id='" . $formData['universityCourseId'] . "' AND univ_courses_spec_fee_id='" . $formData['UnivCourseSpecOneTimeFeeId'] . "'");
            }
        } else {
            if ($formData["feesModeOneTime"] == "One Time") {
                //Fetch Course Year
                $CourseTotalYear = $formData['univ_course_total_year'];
                $specilizationFee = implode(",", $formData["oneTimeFees"]);
                $specilizationFeeName = implode(",", $formData["oneTimeName"]);
                //Break Fees Equal In Semester Also
                $OneTimeSemName = [];
                $OneTimeSemAmount = [];
                foreach ($formData["oneTimeName"] as $oneKey => $OneTimeSemNameData) {
                    if ($CourseTotalYear == "1") {
                        foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 2;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "2") {
                        foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 4;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "3") {
                        foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 6;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "4") {
                        foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 8;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFees"][$oneKey] / 10;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    }
                }

                //Implode
                $OneTimeSemNames = implode(",", $OneTimeSemName);
                $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeOneTime"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                    "univ_course_spec_fee_sem_value" => $OneTimeSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_fees", $universityCoursesSpecilizationFees);
            }
        }
    }
    //TUTITION FEES
    if ($Update) {
        if (!empty($formData['UnivCourseSpecCustomSemFeeId'])) {
            if ($formData["feesModeSemestercustom"] == "Semesters Wise") {
                $specilizationFee = implode(",", $formData["semesterFeecustom"]);
                $specilizationFeeName = implode(",", $formData["semesterNamecustom"]);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" =>  $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeSemestercustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees, "university_specialization_id='" . $formData['universityCourseSpecilizationId'] . "' AND university_id='" . $formData['universityId'] . "' AND univ_session_id='" . $formData['universitySessionId'] . "'  AND univ_course_id='" . $formData['universityCourseId'] . "' AND univ_courses_spec_fee_id='" . $formData['UnivCourseSpecCustomSemFeeId'] . "'");
            }
        } else {
            if ($formData["feesModeSemestercustom"] == "Semesters Wise") {
                $specilizationFee = implode(",", $formData["semesterFeecustom"]);
                $specilizationFeeName = implode(",", $formData["semesterNamecustom"]);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" =>  $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeSemestercustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
            }
        }

        if (!empty($formData['UnivCourseSpecCustomSemFeeId'])) {
            if ($formData["feesModeYearcustom"] == "Years Wise") {
                $specilizationFee = implode(",", $formData["yearFeescustom"]);
                $specilizationFeeName = implode(",", $formData["yearNamecustom"]);
                //Break Fees Equal In Semester Also
                $yearSemName = [];
                $yearSemAmount = [];
                foreach ($formData["yearNamecustom"] as $yearKey => $yearValue) {
                    if ($yearValue == "1") {
                        foreach (firstYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "2") {
                        foreach (secondYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "3") {
                        foreach (thirdYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "4") {
                        foreach (fourYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    }
                }

                //Implode
                $yearSemNames = implode(",", $yearSemName);
                $yearSemAmounts = implode(",", $yearSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeYearcustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $yearSemNames,
                    "univ_course_spec_total_fee_value" => $yearSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees, "university_specialization_id='" . $formData['universityCourseSpecilizationId'] . "' AND university_id='" . $formData['universityId'] . "' AND univ_session_id='" . $formData['universitySessionId'] . "'  AND univ_course_id='" . $formData['universityCourseId'] . "' AND univ_courses_spec_fee_id='" . $formData['UnivCourseSpecCustomYrFeeId'] . "'");
            }
        } else {
            if ($formData["feesModeYearcustom"] == "Years Wise") {
                $specilizationFee = implode(",", $formData["yearFeescustom"]);
                $specilizationFeeName = implode(",", $formData["yearNamecustom"]);
                //Break Fees Equal In Semester Also
                $yearSemName = [];
                $yearSemAmount = [];
                foreach ($formData["yearNamecustom"] as $yearKey => $yearValue) {
                    if ($yearValue == "1") {
                        foreach (firstYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "2") {
                        foreach (secondYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "3") {
                        foreach (thirdYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "4") {
                        foreach (fourYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    } elseif ($yearValue == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $yearSemName[] = $semKey;
                        }
                        $splitFee = $formData["yearFeescustom"][$yearKey] / 2;
                        $yearSemAmount[] = $splitFee;
                        $yearSemAmount[] = $splitFee;
                    }
                }

                //Implode
                $yearSemNames = implode(",", $yearSemName);
                $yearSemAmounts = implode(",", $yearSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeYearcustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $yearSemNames,
                    "univ_course_spec_total_fee_value" => $yearSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
            }
        }

        if (!empty($formData['UnivCourseSpecCustomSemFeeId'])) {
            if ($formData["feesModeOneTimecustom"] == "One Time") {
                //Fetch Course Year
                $CourseTotalYear = $formData['univ_course_total_year'];
                $specilizationFee = implode(",", $formData["oneTimeFeescustom"]);
                $specilizationFeeName = implode(",", $formData["oneTimeNamecustom"]);
                //Break Fees Equal In Semester Also
                $OneTimeSemName = [];
                $OneTimeSemAmount = [];
                foreach ($formData["oneTimeNamecustom"] as $oneKey => $OneTimeSemNameData) {
                    if ($CourseTotalYear == "1") {
                        foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 2;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "2") {
                        foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 4;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "3") {
                        foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 6;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "4") {
                        foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 8;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 10;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    }
                }
                //Implode
                $OneTimeSemNames = implode(",", $OneTimeSemName);
                $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeOneTimecustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                    "univ_course_spec_total_fee_value" => $OneTimeSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Update = UPDATE_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees, "university_specialization_id='" . $formData['universityCourseSpecilizationId'] . "' AND university_id='" . $formData['universityId'] . "' AND univ_session_id='" . $formData['universitySessionId'] . "'  AND univ_course_id='" . $formData['universityCourseId'] . "' AND univ_courses_spec_fee_id='" . $formData['UnivCourseSpecCustomOneTimeFeeId'] . "'");
            }
        } else {
            if ($formData["feesModeOneTimecustom"] == "One Time") {
                //Fetch Course Year
                $CourseTotalYear = $formData['univ_course_total_year'];
                $specilizationFee = implode(",", $formData["oneTimeFeescustom"]);
                $specilizationFeeName = implode(",", $formData["oneTimeNamecustom"]);
                //Break Fees Equal In Semester Also
                $OneTimeSemName = [];
                $OneTimeSemAmount = [];
                foreach ($formData["oneTimeNamecustom"] as $oneKey => $OneTimeSemNameData) {
                    if ($CourseTotalYear == "1") {
                        foreach (oneTimeFirstYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 2;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "2") {
                        foreach (oneTimeSecondYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 4;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "3") {
                        foreach (oneTimeThirdYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 6;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "4") {
                        foreach (oneTimeFourYearTotalSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 8;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    } elseif ($CourseTotalYear == "5") {
                        foreach (fiveYearSem() as $semKey => $semName) {
                            $OneTimeSemName[] = $semKey;
                        }
                        $splitFee = $formData["oneTimeFeescustom"][$oneKey] / 10;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                        $OneTimeSemAmount[] = $splitFee;
                    }
                }
                //Implode
                $OneTimeSemNames = implode(",", $OneTimeSemName);
                $OneTimeSemAmounts = implode(",", $OneTimeSemAmount);
                $universityCoursesSpecilizationFees = [
                    "university_id" => $formData["universityId"],
                    "univ_session_id" => $formData["universitySessionId"],
                    "univ_course_id" => $formData["universityCourseId"],
                    "university_specialization_id" => $formData['universityCourseSpecilizationId'],
                    "univ_course_spec_fee_mode_type" => $formData["feesModeOneTimecustom"],
                    "univ_course_spec_fee_name" => $specilizationFeeName,
                    "univ_course_spec_fee_value" => $specilizationFee,
                    "univ_course_spec_fee_sem_name" => $OneTimeSemNames,
                    "univ_course_spec_total_fee_value" => $OneTimeSemAmounts,
                    "created_by" => LOGIN_UserId,
                    "updated_by" => LOGIN_UserId,
                ];
                $Save = INSERT_DATA_WITHOUT_RESPONSE("universities_courses_specializations_tutition_fees", $universityCoursesSpecilizationFees);
            }
        }
    }

    if ($Update == true) {
        $response = array(
            "status" => "Success",
        );
        echo json_encode($response);
    } else {
        $response = array(
            "status" => "Error"
        );
        echo json_encode($response);
    }
}
//Show Course Specilization details
if (isset($_POST['fetchCourseBtn'])) {
    //Courses Specilization
    $outPut = "";
    $outPut .= '<h5>Already Exists Specialization</h5>';
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['courseId'] . "' AND university_id='" . $_POST['UniversityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            $outPut .= '<span class="text-muted">' . $val->univ_course_specialization_name . '</span>' . "<br>";
        }
        echo $outPut;
    }
}
//Show Course SpecilizationTut Details
if (isset($_POST['fetchCourseSpecTut'])) {
    //Courses Specilization
    $outPut = "";
    $outPut .= '<option value="">choose course specilization</option>';
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['CourseId'] . "' AND university_id='" . $_POST['universityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            $outPut .= '<option value="' . $val->univ_specialization_id . '">' . $val->univ_course_specialization_name . '</option>';
        }
        // Return the result as JSON
        echo $outPut;
    }
}
//Fetch Course Details To show Sem and Year Field To add Course Fees
if (isset($_POST['fetchCourseSpecTutSemYearFields'])) {
    //Courses Specilization
    $outPut = "";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses WHERE univ_course_id='" . $_POST['CourseId'] . "' AND university_id='" . $_POST['universityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_course_total_year == "1") {
                $semesters = oneTimeFirstYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFirstYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        ' <div class="row" id="TuitionFeesAddMoreSemester">
                    <div class="col-md-10 form-group d-flex">
                        <div class="w-50">
                            <label>Semester Name <?php echo $req; ?></label>
                            <select name="tuition_fees_semester_name[]" class="form-control form-control-sm" required>
                                <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm"  required>
                        </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                        <label></label>
                        <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "2") {
                $semesters = oneTimeSecondYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeSecondYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        ' <div class="row" id="TuitionFeesAddMoreSemester">
                    <div class="col-md-10 form-group d-flex">
                        <div class="w-50">
                            <label>Semester Name <?php echo $req; ?></label>
                            <select name="tuition_fees_semester_name[]" class="form-control form-control-sm" required>
                                <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm"  required>
                        </div>
                     </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                        <label></label>
                        <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "3") {
                $semesters = oneTimeThirdYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeThirdYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        ' <div class="row" id="TuitionFeesAddMoreSemester">
                    <div class="col-md-10 form-group d-flex">
                        <div class="w-50">
                            <label>Semester Name <?php echo $req; ?></label>
                            <select name="tuition_fees_semester_name[]" class="form-control form-control-sm" required>
                                <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm"  required>
                        </div>
                     </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                        <label></label>
                        <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "4") {
                $semesters = oneTimeFourYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFourYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        ' <div class="row" id="TuitionFeesAddMoreSemester">
                    <div class="col-md-10 form-group d-flex">
                        <div class="w-50">
                            <label>Semester Name <?php echo $req; ?></label>
                            <select name="tuition_fees_semester_name[]" class="form-control form-control-sm" required>
                                <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm"  required>
                        </div>
                     </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                        <label></label>
                        <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "5") {
                $semesters = oneTimeFiveYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFiveYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        ' <div class="row" id="TuitionFeesAddMoreSemester">
                    <div class="col-md-10 form-group d-flex">
                        <div class="w-50">
                            <label>Semester Name <?php echo $req; ?></label>
                            <select name="tuition_fees_semester_name[]" class="form-control form-control-sm" required>
                                <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm"  required>
                        </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                        <label></label>
                        <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                    </div>';
                    }


                    $outPut .= '  </div>';
                }
            } else {
                $outPut .= ' <div class="row" id="TuitionFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                    <div class="w-50">
                                        <label>Semester Name <?php echo $req; ?></label>
                                        <select name="tuition_fees_semester_name[]" class="form-control form-control-sm" required>
                                            <option value="">Choose Semester</option>
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
                                        <label>Semester Fee <?php echo $req; ?></label>
                                        <input type="number" name="tuition_fees_course_semester_fee[]" class="form-control form-control-sm"  required>
                                    </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label></label>
                                    <button class="btn btn-outline-info  add_tution_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>

                            </div>';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}
//Fetch Course Details To show Sem and Year Field To add Course Fees
if (isset($_POST['fetchCourseSpecTutYearFields'])) {
    //Courses Specilization
    $outPut = "";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses WHERE univ_course_id='" . $_POST['CourseId'] . "' AND university_id='" . $_POST['universityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_course_total_year == "1") {
                $years = firstYear();
                $lastYear = array_key_last($years);
                foreach (firstYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="TuitionYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                        <div class="w-50">
                                            <label>Year <?php echo $req; ?></label>
                                            <select name="tuition_course_years_name[]" class="form-control form-control-sm" required>
                                                <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm"  required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= '<div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "2") {
                $year = secondYear();
                $lastYear = array_key_last($year);
                foreach (secondYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="TuitionYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                        <div class="w-50">
                                            <label>Year <?php echo $req; ?></label>
                                            <select name="tuition_course_years_name[]" class="form-control form-control-sm" required>
                                                <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm"  required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= '<div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "3") {
                $year = thirdYear();
                $lastYear = array_key_last($year);
                foreach (thirdYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="TuitionYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                        <div class="w-50">
                                            <label>Year <?php echo $req; ?></label>
                                            <select name="tuition_course_years_name[]" class="form-control form-control-sm" required>
                                                <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm"  required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= '<div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "4") {
                $year = fourthYear();
                $lastYear = array_key_last($year);
                foreach (fourthYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="TuitionYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                        <div class="w-50">
                                            <label>Year <?php echo $req; ?></label>
                                            <select name="tuition_course_years_name[]" class="form-control form-control-sm" required>
                                                <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm"  required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= '<div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "5") {
                $year = fivethYear();
                $lastYear = array_key_last($year);
                foreach (fivethYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="TuitionYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                        <div class="w-50">
                                            <label>Year <?php echo $req; ?></label>
                                            <select name="tuition_course_years_name[]" class="form-control form-control-sm" required>
                                                <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm"  required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= '<div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } else {
                $outPut .=
                    '<div class="row" id="TuitionYearsFeesAddMoreYears">
                                    <div class="col-md-10 form-group d-flex">
                                        <div class="w-50">
                                            <label>Year <?php echo $req; ?></label>
                                            <select name="tuition_course_years_name[]" class="form-control form-control-sm" required>
                                                <option value="">choose year</option>
                                                <option value="1">First Years</option>
                                                <option value="2">Second Years</option>
                                                <option value="3">Third Years</option>
                                                <option value="4">Fourth Years</option>
                                                <option value="5">Fifth Years</option>
                                                </select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="tuition_course_years_fee[]" class="form-control form-control-sm"  required>

                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_tution_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>
                                </div> ';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}
//Fetch Course Details To show Sem and Year Field To add Course Fees
if (isset($_POST['fetchCourseSpecTutOneTimeFields'])) {
    //Courses Specilization
    $outPut = "";
    if (!empty($_POST['CourseId'])) {
        $outPut = '<div class="row">
                <div class="col-md-12 form-group d-flex">
                    <div class="w-50">
                        <label>Total<?php echo $req; ?></label>
                        <select name="tuition_course_total_years_name[]" class="form-control form-control-sm" required>
                            <option value="">Choose Total</option>
                            <option value="One Time" selected>One Time</option>
                        </select>
                    </div>
                    <div class="w-50" style="padding-left: 0.3125rem;">
                        <label>Fee<?php echo $req; ?></label>
                        <input type="number" name="tuition_course_one_time_fee[]" class="form-control form-control-sm"  required>
                    </div>
                </div>

            </div>';
    }


    // Return the result as JSON
    echo $outPut;
}

//Fetch Course Details To show Sem and Year Field To add Course Fees
if (isset($_POST['fetchCourseSpecSemFields'])) {
    //Courses Specilization
    $outPut = "";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses WHERE univ_course_id='" . $_POST['CourseId'] . "' AND university_id='" . $_POST['universityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_course_total_year == "1") {
                $semesters = oneTimeFirstYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFirstYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                        <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                                <label>Semester Name <?php echo $req; ?></label>
                                <select name="custom_fees_semester_name[]" class="form-control form-control-sm" required>
                                    <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" required>
                        </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                    <label></label>
                                    <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "2") {
                $semesters = oneTimeSecondYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeSecondYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                        <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                                <label>Semester Name <?php echo $req; ?></label>
                                <select name="custom_fees_semester_name[]" class="form-control form-control-sm" required>
                                    <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" required>
                        </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                    <label></label>
                                    <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "3") {
                $semesters = oneTimeThirdYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeThirdYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                        <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                                <label>Semester Name <?php echo $req; ?></label>
                                <select name="custom_fees_semester_name[]" class="form-control form-control-sm" required>
                                    <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" required>
                        </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                    <label></label>
                                    <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "4") {
                $semesters = oneTimeFourYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFourYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                        <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                                <label>Semester Name <?php echo $req; ?></label>
                                <select name="custom_fees_semester_name[]" class="form-control form-control-sm" required>
                                    <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" required>
                        </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                    <label></label>
                                    <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } elseif ($val->univ_course_total_year == "5") {
                $semesters = oneTimeFiveYearTotalSem();
                $lastSemester = array_key_last($semesters);
                foreach (oneTimeFiveYearTotalSem() as $semKey => $sem) {
                    $outPut .=
                        '  <div class="row" id="CustomFeesAddMoreSemester">
                        <div class="col-md-10 form-group d-flex">
                            <div class="w-50">
                                <label>Semester Name <?php echo $req; ?></label>
                                <select name="custom_fees_semester_name[]" class="form-control form-control-sm" required>
                                    <option value="">Choose Semester</option>';
                    foreach (SemesterList() as $AllSemKey => $semName) {
                        if ($AllSemKey == $semKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $AllSemKey . '" ' . $selected . '>' . $semName . '</option>';
                    }
                    $outPut .= '</select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Semester Fee <?php echo $req; ?></label>
                            <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" required>
                        </div>
                    </div>';
                    if ($semKey == $lastSemester) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                    <label></label>
                                    <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>';
                    }


                    $outPut .= '  </div>';
                }
            } else {
                $outPut .= '<div class="row" id="CustomFeesAddMoreSemester">
                                <div class="col-md-10 form-group d-flex">
                                    <div class="w-50">
                                        <label>Semester Name <?php echo $req; ?></label>
                                        <select name="custom_fees_semester_name[]" class="form-control form-control-sm" required>
                                            <option value="">Choose Semester</option>
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
                                        <label>Semester Fee <?php echo $req; ?></label>
                                        <input type="number" name="custom_fees_course_semester_fee[]" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-2 form-group ">
                                    <label></label>
                                    <button class="btn btn-outline-info  add_custom_semester_fee_btn"><i class="bi bi-plus"></i></button>
                                </div>

                            </div>';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}
//Fetch Course Details To show Sem and Year Field To add Course Fees
if (isset($_POST['fetchCourseSpecYearFields'])) {
    //Courses Specilization
    $outPut = "";
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses WHERE univ_course_id='" . $_POST['CourseId'] . "' AND university_id='" . $_POST['universityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_course_total_year == "1") {
                $years = firstYear();
                $lastYear = array_key_last($years);
                foreach (firstYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="CustomYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                    <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm" required>
                                            <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "2") {
                $year = secondYear();
                $lastYear = array_key_last($year);
                foreach (secondYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="CustomYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                    <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm" required>
                                            <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "3") {
                $year = thirdYear();
                $lastYear = array_key_last($year);
                foreach (thirdYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="CustomYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                    <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm" required>
                                            <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "4") {
                $year = fourthYear();
                $lastYear = array_key_last($year);
                foreach (fourthYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="CustomYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                    <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm" required>
                                            <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } elseif ($val->univ_course_total_year == "5") {
                $year = fivethYear();
                $lastYear = array_key_last($year);
                foreach (fivethYear() as $yearKey => $year) {
                    $outPut .= ' <div class="row" id="CustomYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                    <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm" required>
                                            <option value="">choose year</option>';
                    foreach (YearList() as $yearListKey => $year) {
                        if ($yearListKey == $yearKey) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }
                        $outPut .= '<option value="' . $yearListKey . '" ' . $selected . '>' . $year . '</option>';
                    }


                    $outPut .= '</select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" required>

                                        </div>
                                    </div>';
                    if ($lastYear == $yearKey) {
                        $outPut .= ' <div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>';
                    }
                    $outPut .= ' </div>';
                }
            } else {
                $outPut .=
                    '<div class="row" id="CustomYearsFeesAddMoreYears">
                                <div class="col-md-10 form-group d-flex">
                                    <div class="w-50">
                                        <label>Year <?php echo $req; ?></label>
                                        <select name="custom_course_years_name[]" class="form-control form-control-sm" required>
                                            <option value="">choose year</option>
                                                <option value="1">First Years</option>
                                                <option value="2">Second Years</option>
                                                <option value="3">Third Years</option>
                                                <option value="4">Fourth Years</option>
                                                <option value="5">Fifth Years</option>
                                                </select>
                                        </div>
                                        <div class="w-50" style="padding-left: 0.3125rem;">
                                            <label>Year <?php echo $req; ?></label>
                                            <input type="number" name="custom_course_years_fee[]" class="form-control form-control-sm" required>

                                        </div>
                                    </div>
                                    <div class="col-md-2 form-group ">
                                        <label></label>
                                        <button class="btn btn-outline-info  add_custom_year_fee_btn"><i class="bi bi-plus"></i></button>
                                    </div>
                                </div> ';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}
//Fetch Course Details To show Sem and Year Field To add Course Fees
if (isset($_POST['fetchCourseSpecOneTimeFields'])) {
    //Courses Specilization
    $outPut = "";
    if (!empty($_POST['CourseId'])) {
        $outPut = '<div class="row">
                    <div class="col-md-12 form-group d-flex">
                        <div class="w-50">
                            <label>Total<?php echo $req; ?></label>
                            <select name="custom_course_total_years_name[]" class="form-control form-control-sm" required>
                                <option value="">Choose Total</option>
                                <option value="One Time" selected>One Time</option>
                            </select>
                        </div>
                        <div class="w-50" style="padding-left: 0.3125rem;">
                            <label>Fee<?php echo $req; ?></label>
                            <input type="number" name="custom_course_one_time_fee[]" class="form-control form-control-sm" required>
                        </div>
                    </div>

                </div>';
    }
    // Return the result as JSON
    echo $outPut;
}

//Show Course OtherSpecilizationTut Details
if (isset($_POST['fetchCourseOtherSpecTut'])) {
    //Courses Specilization
    $outPut = "";
    $outPut .= '<h5>Choose Course Specilization</h5>';
    $fetchData = FETCH_DB_TABLE("SELECT * FROM universities_courses_specializations WHERE univ_course_id='" . $_POST['CourseId'] . "' AND university_id='" . $_POST['universityId'] . "'", true);
    if (isset($fetchData)) {
        foreach ($fetchData as $val) {
            if ($val->univ_specialization_id != $_POST['specilizatioId']) {
                $outPut .= '<div class="form-check">
                            <input class="form-check-input" type="checkbox" name="otherCourseSpecTut[]" value="' . $val->univ_specialization_id . '" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                ' . $val->univ_course_specialization_name . '
                            </label>
                        </div>';
            }
        }
        // Return the result as JSON
        echo $outPut;
    }
}
