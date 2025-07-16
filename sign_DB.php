<?php
include "database.php";
session_start();



$userInfo = array();

if (isset($_POST["username"])) {
  $first_name = mysqli_real_escape_string($conn, $_POST["firstName"]);
  $last_name = mysqli_real_escape_string($conn, $_POST["lastName"]);
  $ID_Number = (int)$_POST["idNumber"];
  $ID_Number_type = mysqli_real_escape_string($conn, $_POST["idNumberType"]);
  $phone_number = (int)$_POST["phoneNumber"];
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $passwd = mysqli_real_escape_string($conn, $_POST["pwd"]);

  // Prepare and execute the stored procedure
  $stmt = $conn->prepare("CALL insert_citizen(?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssisisss", $first_name, $last_name, $ID_Number, $ID_Number_type, $phone_number, $email, $username, $passwd);
  $stmt->execute();

  // Fetch the result from the stored procedure
  $res = $stmt->get_result();

  if ($res->num_rows > 0) {
    $ro = $res->fetch_assoc();
    $_SESSION['user_id'] = $ro["citizen_id"];
    $userInfo['first_name'] = $ro["first_name"];
    $userInfo['last_name'] = $ro["last_name"];
    $userInfo['ID_Number'] = $ro["ID_Number"];
    $userInfo['ID_Number_type'] = $ro["ID_Number_type"];
    $userInfo['phone_number'] = $ro["phone_number"];
    $userInfo['email'] = $ro["email"];
    $userInfo['username'] = $ro["username"];
    $userInfo['no_upload_c'] = $ro["no_upload_c"];
    $userInfo['no_checked_c'] = $ro["no_checked_c"];
    $userInfo['no_agreed_c'] = $ro["no_agreed_c"];
    $userInfo['no_no_c'] = $ro["no_no_c"];
    $_SESSION['user_info'] = $userInfo;
    echo true;
  } else {
    echo false;
  }
}






// DELIMITER $$
// CREATE PROCEDURE insert_citizen(
//   IN p_first_name VARCHAR(255),
//   IN p_last_name VARCHAR(255),
//   IN p_ID_Number INT,
//   IN p_ID_Number_type VARCHAR(255),
//   IN p_phone_number INT,
//   IN p_email VARCHAR(255),
//   IN p_username VARCHAR(255),
//   IN p_passwd VARCHAR(255)
// )
// BEGIN
//   DECLARE hashed_passwd VARCHAR(255);
//   SET hashed_passwd = PASSWORD_HASH(p_passwd, PASSWORD_DEFAULT);
  
//   INSERT INTO citizen (first_name, last_name, ID_Number, ID_Number_type, phone_number, email, username, passwd) 
//   VALUES (p_first_name, p_last_name, p_ID_Number, p_ID_Number_type, p_phone_number, p_email, p_username, hashed_passwd);
  
//   SELECT * FROM citizen ORDER BY citizen_id DESC LIMIT 1;
// END$$
// DELIMITER ;


// $userInfo = array();


// if (isset($_POST["username"])) {
//   $first_name = mysqli_real_escape_string($conn, $_POST["firstName"]);
//   $last_name = mysqli_real_escape_string($conn, $_POST["lastName"]);
//   $ID_Number = (int)$_POST["idNumber"];
//   $ID_Number_type = mysqli_real_escape_string($conn, $_POST["idNumberType"]);
//   $phone_number = (int)$_POST["phoneNumber"];
//   $email = mysqli_real_escape_string($conn, $_POST["email"]);
//   $username = mysqli_real_escape_string($conn, $_POST["username"]);
//   $passwd = mysqli_real_escape_string($conn, $_POST["pwd"]);





//   $sql = "INSERT INTO citizen (first_name, last_name, ID_Number, ID_Number_type, phone_number, email, username, passwd) 
//           VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

//   $stmt = $conn->prepare($sql);
//   $stmt->bind_param("ssisisss", $first_name, $last_name, $ID_Number, $ID_Number_type, $phone_number, $email, $username, $passwd);

//   if ($stmt->execute()) {
//     $username = lastUser($conn);
//     echo true;
//   } else {
//     echo false;
//   }
// }

// function lastUser($conn)
// {
//   $sql = "SELECT * FROM citizen ORDER BY citizen_id DESC LIMIT 1";
//   $stmt = $conn->prepare($sql);
//   $stmt->execute();
//   $res = $stmt->get_result();

//   if ($res->num_rows > 0) {
//     $ro = $res->fetch_assoc();
//     $_SESSION['user_id'] = $ro["citizen_id"];
//     $userInfo['first_name'] = $ro["first_name"];
//     $userInfo['last_name'] = $ro["last_name"];
//     $userInfo['ID_Number'] = $ro["ID_Number"];
//     $userInfo['ID_Number_type'] = $ro["ID_Number_type"];
//     $userInfo['phone_number'] = $ro["phone_number"];
//     $userInfo['email'] = $ro["email"];
//     $userInfo['username'] = $ro["username"];
//     $userInfo['no_upload_c'] = $ro["no_upload_c"];
//     $userInfo['no_checked_c'] = $ro["no_checked_c"];
//     $userInfo['no_agreed_c'] = $ro["no_agreed_c"];
//     $userInfo['no_no_c'] = $ro["no_no_c"];
//     $_SESSION['user_info'] = $userInfo;
//     return $userInfo['first_name'] . " " . $userInfo['last_name'];
//   }
// }