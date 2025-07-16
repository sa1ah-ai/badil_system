<?php
include "database.php";
session_start();


$userInfo = array();
$judge_info = array();
$authority_info = array();

if (isset($_POST["username"])) {
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $passwd = mysqli_real_escape_string($conn, $_POST["pwd"]);

  // Prepare and execute the stored procedure
  $stmt = $conn->prepare("CALL login_user(?, ?)");
  $stmt->bind_param("ss", $username, $passwd);
  $stmt->execute();
  $res = $stmt->get_result();

  if ($res->num_rows > 0) {
    $ro = $res->fetch_assoc();

    if (isset($ro["citizen_id"])) {
      fullUserInfo($ro);
    } elseif (isset($ro["judge_id"])) {
      fullJudgeInfo($ro);
    } elseif (isset($ro["authority_id"])) {
      fullAuthorityInfo($ro);
    }
  } else {
    echo false;
  }
}

function fullUserInfo($ro)
{
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
}

function fullJudgeInfo($ro)
{
  $_SESSION['admin_id'] = $ro["judge_id"];
  $judge_info['judge_name'] = $ro["judge_name"];
  $judge_info['judge_username'] = $ro["judge_username"];
  $judge_info['no_checked_c'] = $ro["no_checked_c"];
  $judge_info['no_yes_c'] = $ro["no_yes_c"];
  $_SESSION['judge_info'] = $judge_info;
  echo true;
}

function fullAuthorityInfo($ro)
{
  $_SESSION['authority_id'] = $ro["authority_id"];
  $authority_info['authority_name'] = $ro["authority_name"];
  $authority_info['governorate'] = $ro["governorate"];
  $authority_info['authority_username'] = $ro["authority_username"];
  $authority_info['no_excuted_c'] = $ro["no_excuted_c"];
  $authority_info['no_waited_c'] = $ro["no_waited_c"];
  $_SESSION['authority_info'] = $authority_info;
  echo true;
}


// $userInfo = array();
// $judge_info = array();
// $authority_info = array();

// if (isset($_POST["username"])) {
//   $username = mysqli_real_escape_string($conn, $_POST["username"]);
//   $passwd = mysqli_real_escape_string($conn, $_POST["pwd"]);


//   // Prepare the SQL query using prepared statements
//   $stmt = $conn->prepare("SELECT * FROM citizen WHERE username = ? AND passwd = ?");
//   $stmt->bind_param("ss", $username, $passwd);
//   $stmt->execute();
//   $res = $stmt->get_result();

//   if ($res->num_rows > 0) {
//     $ro = $res->fetch_assoc();
//     fullUserInfo($ro);
//   } else {
//     // Prepare the SQL query for judge table
//     $stmt = $conn->prepare("SELECT * FROM judge WHERE judge_username = ? AND judge_password = ?");
//     $stmt->bind_param("ss", $username, $passwd);
//     $stmt->execute();
//     $res = $stmt->get_result();

//     if ($res->num_rows > 0) {
//       $ro = $res->fetch_assoc();
//       fullJudgeInfo($ro);
//     } else {
//       $stmt = $conn->prepare("SELECT * FROM executive_authority WHERE authority_username = ? AND authority_password = ?");
//       $stmt->bind_param("ss", $username, $passwd);
//       $stmt->execute();
//       $res = $stmt->get_result();
//       if ($res->num_rows > 0) {
//         $ro = $res->fetch_assoc();
//         fullAuthorityInfo($ro);
//       } else {
//         echo false;
//       }
//     }
//   }
// }


// function fullUserInfo($ro)
// {
//   $_SESSION['user_id'] = $ro["citizen_id"];
//   $userInfo['first_name'] = $ro["first_name"];
//   $userInfo['last_name'] = $ro["last_name"];
//   $userInfo['ID_Number'] = $ro["ID_Number"];
//   $userInfo['ID_Number_type'] = $ro["ID_Number_type"];
//   $userInfo['phone_number'] = $ro["phone_number"];
//   $userInfo['email'] = $ro["email"];
//   $userInfo['username'] = $ro["username"];
//   $userInfo['no_upload_c'] = $ro["no_upload_c"];
//   $userInfo['no_checked_c'] = $ro["no_checked_c"];
//   $userInfo['no_agreed_c'] = $ro["no_agreed_c"];
//   $userInfo['no_no_c'] = $ro["no_no_c"];
//   $_SESSION['user_info'] = $userInfo;
//   echo true;
// }

// function fullJudgeInfo($ro)
// {
//   $_SESSION['admin_id'] = $ro["judge_id"];
//   $judge_info['judge_name'] = $ro["judge_name"];
//   $judge_info['judge_username'] = $ro["judge_username"];
//   $judge_info['no_checked_c'] = $ro["no_checked_c"];
//   $judge_info['no_yes_c'] = $ro["no_yes_c"];
//   $_SESSION['judge_info'] = $judge_info;
//   echo true;
// }

// function fullAuthorityInfo($ro)
// {
//   $_SESSION['authority_id'] = $ro["authority_id"];
//   $authority_info['authority_name'] = $ro["authority_name"];
//   $authority_info['governorate'] = $ro["governorate"];
//   $authority_info['authority_username'] = $ro["authority_username"];
//   $authority_info['no_excuted_c'] = $ro["no_excuted_c"];
//   $authority_info['no_waited_c'] = $ro["no_waited_c"];
//   $_SESSION['authority_info'] = $authority_info;
//   echo true;
// }