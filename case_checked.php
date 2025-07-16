<?php

include "database.php";
session_start();

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
echo "case_id : " . $data['case_id'];
echo "judge_id : " . $data['judge_id'];
echo "agreement : " . $data['agreement'];

#if agreement is true , the specific case will be checked and agreed or not 
# the judge of case will be determined 
# number of checked for the citizen and number of agree or not