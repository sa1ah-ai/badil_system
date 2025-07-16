<?php
include "database.php";
session_start();

$pythonInterpreter = "C:\Users\ph\AppData\Local\Programs\Python\Python311\python.exe";
$pythonScript = "C:\\xampp\\htdocs\\badil_system_v6\\python_code\\app.py";

$command = escapeshellcmd("$pythonInterpreter $pythonScript");
exec($command, $output, $resultCode);
var_dump($output);

// $command = escapeshellcmd("C:\Users\ph\AppData\Local\Programs\Python\Python311\python.exe C:\xampp\htdocs\badil_system_v6\app.py");

// // $command = escapeshellcmd("python ./python_code/app.py");
// $command = escapeshellcmd("C:\Users\ph\AppData\Local\Programs\Python\Python311\python.exe C:\xampp\htdocs\badil_system_v6\python_code\app.py");
// exec($command, $output, $reslutcode);
// var_dump($output);
// $username = $_SERVER['REMOTE_USER'];
// echo $username;

// function getLastCaseId($conn)
// {
//   $sql = "SELECT case_id FROM cases ORDER BY case_id DESC LIMIT 1";
//   $result = $conn->query($sql);
//   if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     return $row["case_id"];
//   }
//   return null;
// }

// function runPythonCode()
// {
//   $command = escapeshellcmd("python ./python_code/app.py");
//   exec($command, $output, $reslutcode);
//   var_dump($output);
// }

// function updateUploadedCase($conn, $caseCreator)
// {
//   $sql = "UPDATE citizen
//           SET no_upload_c = no_upload_c + 1
//           WHERE citizen_id = ?";
//   $stmt = $conn->prepare($sql);
//   $stmt->bind_param("i", $caseCreator);
//   $stmt->execute();
//   $stmt->close();
// }

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//   $jsonData = file_get_contents('php://input');
//   $data = json_decode($jsonData, true);

//   if ($data) {
//     $caseDate = date("Y-m-d", strtotime($data['crimeDate']));
//     $caseCreator = $_SESSION["user_id"];
//     $offenderName = mysqli_real_escape_string($conn, $data['offenderName']);
//     $offenderAge = mysqli_real_escape_string($conn, $data['crimeA']);
//     $offenderSex = mysqli_real_escape_string($conn, $data['crimeG']);
//     $crimeType = mysqli_real_escape_string($conn, $data['crimeT']);
//     $crimeC = mysqli_real_escape_string($conn, $data['crimeC']);
//     $crimeDetails = mysqli_real_escape_string($conn, $data['crimeD']);
//     // $caseSubmitDate = date('Y-m-d');

//     $insertCaseQuery = "INSERT INTO cases (case_creator) VALUES (?)";
//     $stmt = $conn->prepare($insertCaseQuery);
//     $stmt->bind_param("i", $caseCreator);
//     $stmt->execute();
//     $stmt->close();

//     $caseId = getLastCaseId($conn);
//     if ($caseId != null) {
//       $insertDetailsQuery = "INSERT INTO case_details (offender_name, offender_age, offender_sex, crime_type, crime_category, crime_details, case_date, case_id)
//       VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
//       $stmt = $conn->prepare($insertDetailsQuery);
//       $stmt->bind_param("sssssssi", $offenderName, $offenderAge, $offenderSex, $crimeType, $crimeC, $crimeDetails, $caseDate, $caseId);
//       $stmt->execute();
//       $stmt->close();

//       updateUploadedCase($conn, $caseCreator);
//       runPythonCode();
//       echo "Case was inserted successfully.";
//     } else {
//       echo "Error retrieving case ID.";
//     }
//   } else {
//     echo "Invalid JSON data.";
//   }
// } else {
//   echo "Invalid request method.";
// }