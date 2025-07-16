<?php
// include "database.php";
session_start();
$pageName = basename($_SERVER['PHP_SELF']);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>انشاء قضية</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/create_case.css" rel="stylesheet" />
</head>

<body>

    <!-- <div id="chooseCat"></div> -->
    <?php include "header.php"; ?>

    <div class="container">
        <div id="mv" class="olay">
            <div class="olay-content">
                <div class="main">
                    <div class="message">
                        <div class="messageTitle">
                            <h3>رسالة تنبيهية</h3>
                        </div>
                        <div class="messageContent">
                            <h5><br> : عزيزي المجني عليه تم الاجابة على الاسئلة السابقة كالتالي </h5>
                            <br>
                            <div class="crimeInfoForJudje">
                                <span id="offenderName"></span>
                                <span id="crimeDate"></span>
                                <span id="crimeG"></span>
                                <br>
                                <!-- <span id="offenderA"></span> -->
                                <span id="crimeC"></span>
                                <span id="crimeT"></span>
                                <br>
                            </div>
                            <span id="crimeDetails"></span>
                            <br>
                            <div class="answerForJugde">
                                <p id="messageText"></p>
                            </div>

                        </div>
                        <div class="details_btns">
                            <button type="button" onclick="sendRequest()" id="showReport"
                                name="showReport">ارسل</button>
                            <button type="button" onclick="toggle()" id="showReport" name="showReport">العودة</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php include("questions.php"); ?>

    </div>

    <footer class="container-fluid footer_section">
        <p>
            BADIL SYSTEM
        </p>
    </footer>


    <!-- <script src="./communicate/c.js"></script> -->
    <!-- <script src="communicate/javaScript.js"></script> -->
    <script>
    // var all_answred = true;

    function submitForm() {
        document.getElementById("question-form").submit();
    }

    function toggle() {
        document.getElementById("mv").classList.toggle("m_width");
    }




    // ********************************************

    var crime_date = "";
    var offender_name = "";
    var offender_gender = "";
    var offender_age = "";
    var crime_cat = "";
    var crime_type = "";
    var crime_Details = "";
    // var answers = ['0', '1', '2', '3'];
    let currentQuestion = 0;
    const progressBar = document.getElementById("progress-bar");
    const questions = document.querySelectorAll(".question");



    function sendRequest() {
        var myRequest = new XMLHttpRequest();
        myRequest.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
                toggle();
            }
        };

        var case_data = {
            offenderName: offender_name,
            crimeDate: crime_date,
            crimeG: offender_gender,
            crimeA: offender_age,
            crimeC: crime_cat,
            crimeT: crime_type,
            crimeD: crime_Details
        };

        myRequest.open("POST", "create_DB.php", true);
        myRequest.setRequestHeader("Content-Type", "application/json");
        myRequest.send(JSON.stringify(case_data));

    }


    function changeElementDependOnResult() {
        // document.getElementById('offenderName').innerHTML = ' اسم الجاني : ' + offender_name;
        document.getElementById('offenderName').innerHTML = " اسم الجاني : <span class='case_detalis_answer'>" +
            offender_name + "</span>";
        document.getElementById('crimeDate').innerHTML = " تاريخ الجناية : <span class='case_detalis_answer'>" +
            crime_date + "</span>";
        document.getElementById('crimeG').innerHTML = " جنس الجاني : <span class='case_detalis_answer'>" +
            offender_gender + "</span>";
        // document.getElementById('offenderA').innerHTML = ' عمر الجاني : ' + offender_age;
        document.getElementById('crimeC').innerHTML = " صنف الجريمة : <span class='case_detalis_answer'>" +
            crime_cat + "</span>";
        document.getElementById('crimeT').innerHTML = " نوع الجناية :<span class='case_detalis_answer'>" +
            crime_type + "</span>";
        toggle();

    }


    function checkAnswered() {
        offender_name = document.getElementById('offender_name').value;
        crime_date = document.getElementById('crime_date').value;
        crime_type = document.getElementById('crime_type').value;
        offender_gender = document.getElementById('offender_gender').value;
        crime_cat = document.getElementById('crime_cat').value;
        // offender_age = document.getElementById('offender_age').value;
        crime_Details = document.getElementById('crime_details').value;
        changeElementDependOnResult();
        // sendPyRequest();
    }

    // function sendPyRequest() {

    //     var spawner = window.sp;
    //     console.log("window.sp : ", window.sp);
    //     console.log("spawner : ", spawner);
    //     var caseData = {
    //         crimeC: "crime_cat",
    //         crimeT: "crime_type",
    //         crimeD: "crime_Details",
    //         dataReturned: undefined,
    //     };

    //     const python_process = spawner("python", ["./pyfile.py",
    //         JSON.stringify(caseData),
    //     ]);
    //     python_process.stdout.on("data", (data) => {
    //         console.log(
    //             "data recieved from python is : " + JSON.stringify(data.toString())
    //         );
    //     });

    //     console.log("data to send to python : " + caseData);



    // const spawner = require("/python/node_modules/child_process").spawn;
    // const spawner = require("./python/node_modules/child_process").spawn;

    // const python_process = spawner("python", ["./python/pyfile.py", JSON.stringify(caseData)]);
    // python_process.stdout.on("data", (data) => {
    //     console.log("data recieved from python is : " + JSON.stringify(data.toString()));
    // });
    // var caseData = {
    //     crimeC: crime_cat,
    //     crimeT: crime_type,
    //     crimeD: crime_Details,
    //     dataReturned: undefined
    // };
    // console.log("data to send to python : " + caseData);

    // const spawner = require("/python/node_modules/child_process").spawn;


    // var xhr = new XMLHttpRequest();
    // var method = "POST";
    // var url = "http://localhost/cgi-bin/analyse.py"; // Replace with the appropriate URL

    // xhr.open(method, url, true);
    // xhr.setRequestHeader("Content-Type", "application/json");


    // var jsonData = JSON.stringify(caseData);

    // xhr.onreadystatechange = function() {
    //     if (xhr.readyState === XMLHttpRequest.DONE) {
    //         if (xhr.status === 200) {
    //             var response = JSON.parse(xhr.responseText);
    //             console.log(response);
    //         } else {
    //             console.error("Request failed with status:", xhr.status);
    //         }
    //     }
    // };

    // xhr.send(jsonData);
    // var url = "/badil_system_v6/python/analyse.py";
    // // var url = "http://localhost/cgi-bin/analyse.py/process_data";
    // var caseData = {
    //     crimeC: crime_cat,
    //     crimeT: crime_type,
    //     crimeD: crime_Details
    // };

    // var xhr = new XMLHttpRequest();
    // xhr.onreadystatechange = function() {
    //     if (xhr.readyState === XMLHttpRequest.DONE) {
    //         if (xhr.status === 200) {
    //             // var data = JSON.parse(xhr.responseText);
    //             var data = this.responseText;
    //             console.log(data);
    //         } else {
    //             console.error("Request failed with status:", xhr.status);
    //         }
    //     }
    // };
    // xhr.open("GET", url, true);
    // xhr.setRequestHeader("Content-Type", "application/json");
    // xhr.send(JSON.stringify(caseData));
    // }
    </script>
    <script src="js/createCase.js"></script>

</body>

</html>