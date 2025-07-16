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
    <title>منصة بديل</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
</head>

<body>

    <?php include("header.php"); ?>


    <div class="container">
        <div id="mv" class="olay">
            <div class="olay-content">
                <div class="main">
                    <div class="message">
                        <div class="messageTitle">
                            <h3>بيانات مقدم الطلب</h3>
                        </div>
                        <div class="messageContent">
                            <h5><br> : عزيزي المستخدم يرجى تعبئة بياناتك </h5>
                            <br>
                        </div>
                        <div class="login">
                            <form id="loginForm" dir="rtl">
                                <!-- <label for="chk" aria-hidden="true">تسجيل الدخول</label> -->
                                <input type="text" name="name" id="name" placeholder="اسم مقدم الطلب" required>
                                <br>
                                <input type="text" name="card_id" id="card_id" placeholder="رقم البطاقة الشخصية" required="">
                                <!-- <button onclick='sendRequest()' type="button">دخول</button> -->
                                <!-- <a class="nav-link" id="gobackhome" href="index.php"> العودة الى الصفحة الرئيسية؟ </a> -->
                            </form>
                        </div>
                        <button type="button" onclick="sbmitReq()" id="showReport" name="showReport">تقديم طلب</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="landing">
            <div class="intro-text">
                <h2> ترحب بك Badil منصة </h2>
                <p>تهدف هذه المنصة في مساعدة القضاء على ايجاد الاحكام الاصلاحية البديلة للسجن بالاعتماد على نهح تعليم
                    الآلة</p>
                <?php
                if (isset($_SESSION['user_id'])) {
                    // echo '<p>:لرفع قضية الرجاء الضغط على الزر التالي </p>';
                    echo '<div class="mainbtns">
          <button type="button" onclick="openCitizen_cases()">القضايا المرفوعة مسبقا</button>
          <button type="button" onclick="openCreatePage()">رفع قضية جديدة</button> 
          </div>';
                }
                ?>
            </div>
        </div>

    </div>

    <footer class="container-fluid footer_section">
        <p>
            Badil System
        </p>
    </footer>
    <script>
        function openCreatePage() {
            window.open('create_case.php', '_self');
        }

        function openCitizen_cases() {
            window.open('cases.php', '_self');
        }



        function toggle() {
            document.getElementById("mv").classList.toggle("m_width");
        }

        function sbmitReq() {
            var name = document.getElementById('name').value;
            var card = document.getElementById('card_id').value;
            console.log(name);
            console.log(card);

            if (name != "" && card != "") {
                openCreatePage();
            } else {
                // window.alert("sdf");
            }

        }
    </script>

</body>

</html>