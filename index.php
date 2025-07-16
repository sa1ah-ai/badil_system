<?php

include "database.php";
session_start();

?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>تسجيل الدخول</title>
  <link rel="stylesheet" type="text/css" href="css/login_page.css">
  <link href="css/style.css" rel="stylesheet" />
</head>

<body>

  <div id="mv" class="olay">
    <div class="olay-content">
      <div class="main">
        <div class="message">
          <div class="messageTitle">
            <h3>رسالة تنبيهية </h3>
          </div>
          <div class="messageContent">
            <h5 id="messageText">عزيزي المستخدم : كلمة السر أو أسم المستخدم غير صحيح , اضغط تم لاعادة
              المحاولة</h5>
          </div>
          <button type="submit" onclick="showMessage()" id="okbtn" name="ok">تم</button>
        </div>
      </div>
    </div>
  </div>



  <?php include("sign.php");
  ?>

  <?php include("login.php");
  ?>



  <script src="js/index.js"></script>



</body>

</html>