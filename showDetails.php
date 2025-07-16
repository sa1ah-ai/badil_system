<?php
include "database.php";
session_start();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

$case_Details = array();

$sql = "SELECT cases.case_id, cases.isChecked, cases.is_executed, case_details.case_date, citizen.first_name,
 case_details.offender_name, case_details.offender_sex, case_details.crime_type, case_details.crime_category, case_details.crime_details
 FROM cases 
 JOIN citizen ON cases.case_creator = citizen.citizen_id
JOIN case_details ON cases.case_id = case_details.case_id 
WHERE cases.case_id = ?";

// $sql = "SELECT cases.case_id, cases.isChecked, cases.is_executed, case_details.case_date, citizen.first_name, case_details.offender_name, case_details.offender_sex, case_details.crime_type, case_details.crime_details, judge.judge_name 
// FROM cases
//  JOIN citizen ON cases.case_creator = citizen.citizen_id
//  JOIN case_details ON cases.case_id = case_details.case_id 
//  JOIN judge ON cases.case_judge_id = judge.judge_id 
// WHERE cases.case_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $data["case_id"]);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $ro = $res->fetch_assoc();
    $_SESSION['case_info'] = $ro["case_id"];
    $case_Details['case_id'] = $ro["case_id"];
    $case_Details['case_date'] = $ro["case_date"];
    $case_Details['isChecked'] = $ro["isChecked"];
    $case_Details['is_executed'] = $ro["is_executed"];
    $case_Details['first_name'] = $ro["first_name"];
    $case_Details['offender_name'] = $ro["offender_name"];
    $case_Details['offender_sex'] = $ro["offender_sex"];
    $case_Details['crime_type'] = $ro["crime_type"];
    $case_Details['crime_category'] = $ro["crime_category"];
    $case_Details['crime_details'] = $ro["crime_details"];
    $_SESSION['case_details'] = $case_Details;
    $jsonResponse = json_encode($case_Details);
    echo  $jsonResponse;
}


function checkCase($conn, $case_id)
{
    $sql = "UPDATE judge
          SET no_checked_c = no_checked_c + 1
          WHERE judge_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_SESSION["admin_id"]);
    $stmt->execute();
}
