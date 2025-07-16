<?php

$conn = mysqli_connect("localhost", "root", "", "badil_mansa");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

// $GLOBALS['userInfo'] = array();

function hashPassword($password)
{
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	return $hashedPassword;
}


function verifyPassword($password, $hashedPassword)
{
	if (password_verify($password, $hashedPassword)) {
		return true;
	} else {
		return false;
	}
}
