<?php
include "database.php";
session_start();
$pageName = basename($_SERVER['PHP_SELF']);
// $page = '';
// $page = $_GET['page'];
// echo "The value of the variable is: " . $page;
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>البحث عن قضية</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/table_style.css">
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/review_case.css" rel="stylesheet" />
</head>

<body>

    <?php include "header.php";

    $caseD = array();
    ?>

    <div class="container">
        <div id="mv" class="olay">
            <div class="olay-content">
                <div class="main">
                    <div class="message">
                        <div class="messageTitle">
                            <h3>رسالة تنبيهية</h3>
                        </div>
                        <div class="messageContent">
                            <h5><br> :بيانات القضية كالتالي </h5>
                            <br>
                            <div class="crimeInfoForJudje">
                                <span id="offenderName"></span>
                                <span id="offender_sex"></span>
                                <span id="caseDate"></span>
                                <!-- <br> -->
                                <span id="victimName"></span>
                                <span id="crimeC"></span>
                                <span id="crimeT"></span>
                                <!-- <br> -->
                                <hr id="sperator">
                                <span id="judgeName"></span>
                                <!-- <br> -->
                                <span id="altenative"></span>
                                <!-- <br> -->
                                <span id="agreementOfjudge"></span>
                                <span id="executed"></span>
                                <span id="crimeDetails"></span>
                            </div>

                            <?php
                            if (isset($_SESSION['admin_id'])) {
                                echo
                                ' <input type="text" name="dos" id="dos" placeholder="مدة الحكم">
                                 <label for="DurationOfSentencing"> : مدة الحكم  </label>
                            
                                    <br>
                                    <br>
                                 <div class="details_btns">
                                    <button type="button" onclick="agreement(1,' . $_SESSION['admin_id'] . ')">موافق</button>
                                    <button type="button" onclick="agreement(0,' . $_SESSION['admin_id'] . ')">غير موافق</button>
                                </div>';
                            }
                            ?>



                            <span id="crimeDetails"></span>
                            <br>
                            <div class="answerForJugde">
                                <p id="messageText"></p>
                            </div>

                        </div>
                        <button type="button" onclick="showMessage()" id="showReport" name="showReport">العودة</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="main2">
            <input type="checkbox" id="chk" aria-hidden="true">
            <div class="caseInfo">
                <?php

                if (isset($_SESSION['authority_id'])) {
                    echo ' <div class="form_title">
                    <h5>المهام المستجدة </h5>
                    <p>اضغط على تفاصيل لرؤية تفاصيل أي مهمة</p>
                </div>';
                } else if (isset($_GET['page']) == 'new') {
                    echo '<div class="form_title">
                    <h5>: القضايا المستجدة </h5>
                    <p>اضغط على تفاصيل لرؤية تفاصيل أي قضية</p>
                </div>';
                } else {

                    echo '<div class="form_title">
                    <h5>: للبحث عن قضية سابقة </h5>
                    <p>ضع هنا اسم الجاني او اسم القاضي او رقم القضية</p>
                </div>';
                }

                ?>
                <?php
                if (empty($_SESSION['authority_id']) && isset($_GET['page']) != 'new') {
                    echo '
                        <div class="search_content">
                    <div class="dropdown">
                    <input id="textboxInput" type="text" placeholder="ابحث عن طريق؟">
                        <ul id="dropdownList" class="dropdown-list">
                            <li class="dropdown-option" id="case_id">رقم القضية</li>
                            <li class="dropdown-option" id="offender_name">اسم الجاني</li>';

                    if (empty($_SESSION['user_id'])) {
                        echo '<li class="dropdown-option" id="victimName">اسم المجني عليه</li>';
                    }

                    echo '<li class="dropdown-option" id="case_date">تاريخ الجريمة</li>
                            </ul>
                            </div>
                            <input type="search" name="" id="search" onclick="" dir="rtl" placeholder="ضع بيانات ذات صلة بالقضية">
                            </div>';
                }

                include("cases_tables.php");
                ?>
            </div>
        </div>
    </div>

    <footer class="container-fluid footer_section">
        <p>
            BADIL SYSTEM
        </p>
    </footer>

    <script src="js/jquery.js"></script>
    <script>
        var CASEID = undefined;

        function showMessage() {
            document.getElementById("mv").classList.toggle("m_width");
        }

        function agreement(value, judge_id) {
            var caseReq = new XMLHttpRequest();
            caseReq.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    // var jsonData = JSON.parse(this.response);
                    console.log(this.responseText)
                    location.reload();
                }
            };

            var data = {
                case_id: CASEID,
                judge_id: judge_id,
                agreement: value
            };

            caseReq.open("POST", "case_checked.php", true);
            caseReq.setRequestHeader("Content-Type", "application/json");
            caseReq.send(JSON.stringify(data));
        }



        function updateDate(response) {

            var jsonData = JSON.parse(response);
            var offenderName = document.getElementById("offenderName");
            var caseDate = document.getElementById("caseDate");
            var offenderSex = document.getElementById("offender_sex");
            var crimeType = document.getElementById("crimeT");
            var crimeCategory = document.getElementById("crimeC");
            var judgeName = document.getElementById("judgeName");
            var victimName = document.getElementById("victimName");
            var alternative = document.getElementById("altenative");
            var executed = document.getElementById("executed");
            var agreement = document.getElementById("agreementOfjudge");
            var crimeDetails = document.getElementById("crimeDetails");

            var case_id = jsonData.case_id;
            var isChecked = jsonData.isChecked;
            var is_executed = jsonData.is_executed;
            var alternative_judgement = jsonData.alternative;
            // var crime_details = jsonData.crime_details;
            // var judge_name = jsonData.judge_name;

            if (jsonData.crime_details != "")
                crimeDetails.innerHTML = "تفاصيل الجريمة: <span class='case_detalis_answer'>" + jsonData.crime_details +
                "</span>";


            if (isChecked == false)
                isChecked = " لم يعالج بعد";
            else
                isChecked = "تم النظر";


            if (is_executed == false)
                is_executed = " لم ينفذ بعد";
            else
                is_executed = "تم التنفيذ";



            offenderName.innerHTML = "اسم الجاني: <span class='case_detalis_answer'>" + jsonData.offender_name +
                "</span>";
            caseDate.innerHTML = "تاريخ الجناية: <span class='case_detalis_answer'>" + jsonData.case_date + "</span>";
            offenderSex.innerHTML = "جنس الجاني: <span class='case_detalis_answer'>" + jsonData.offender_sex + "</span>";
            crimeType.innerHTML = "نوع الجريمة: <span class='case_detalis_answer'>" + jsonData.crime_type + "</span>";
            crimeCategory.innerHTML = "صنف الجريمة: <span class='case_detalis_answer'>" + jsonData.crime_category +
                "</span>";
            victimName.innerHTML = "اسم المجني عليه: <span class='case_detalis_answer'>" + jsonData.first_name + "</span>";
            // the rest
            judgeName.innerHTML = "اسم القاضي: <span class='case_detalis_answer'>" + " لم يحدد بعد" + "</span>";
            alternative.innerHTML = "الحكم البديل:<span class='case_detalis_answer'>" + " لم يعالج بعد" + "</span>";
            executed.innerHTML = "التنفيذ:<span class='case_detalis_answer'>" + is_executed + "</span>";
            agreement.innerHTML = "الموافقة: <span class='case_detalis_answer'>" + isChecked + "</span>";

        }

        function showDetails(caseid) {
            CASEID = caseid;
            var req = new XMLHttpRequest();
            req.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    var jsonData = JSON.parse(this.response);
                    // console.log(jsonData);
                    updateDate(this.response);
                    showMessage();
                }
            };

            var data = {
                case_id: caseid
            };

            req.open("POST", "showDetails.php", true);
            req.setRequestHeader("Content-Type", "application/json");
            req.send(JSON.stringify(data));

        }



        const textboxInput = document.getElementById('textboxInput');
        const dropdownList = document.getElementById('dropdownList');
        let searchBy;

        textboxInput.addEventListener('click', function() {
            dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
        });

        const dropdownOptions = document.getElementsByClassName('dropdown-option');
        for (let i = 0; i < dropdownOptions.length; i++) {
            dropdownOptions[i].addEventListener('click', function() {
                textboxInput.value = dropdownOptions[i].textContent;
                searchBy = dropdownOptions[i].id;
                dropdownList.style.display = 'none';
            });
        }

        document.addEventListener("click", function(event) {
            if (!dropdownList.contains(event.target) && event.target !== textboxInput) {
                dropdownList.style.display = "none";
            }
        });

        $(document).ready(function() {
            $("#search").keyup(function() {
                var txt = $("#search").val();
                $.post("search.php", {
                    s: txt,
                    sby: searchBy
                }, function(data) {
                    console.log(data);
                    $("#box").html(data);
                });
            });
        });
    </script>
</body>

</html>