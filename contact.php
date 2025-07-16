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
  <title>Badil System</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/contact.css" rel="stylesheet" />
</head>

<body>

  <?php include("header.php"); ?>

  <section class="contact_section layout_padding">
    <div class="landing" dir="rtl">
      <div class="intro-text">
      </div>
    </div>
    <div class="container">
      <div class="heading_container">
        <br>

        <div class="contact_items">

          <a href="">
            <div class="img-box">
              <img src="images/location.png" alt="">
            </div>
            <h6>
              Taiz
            </h6>
          </a>
          <a href="">
            <div class="img-box">
              <img src="images/call.png" alt="">
            </div>
            <h6>
              (+966 1234456789)
            </h6>
          </a>
          <a href="">
            <div class="img-box">
              <img src="images/mail.png" alt="">
            </div>
            <h6>
              BadilSystem@gmail.com
            </h6>
          </a>

        </div>
        <div class="social_container">
          <div class="social-box">
            <div>
              <a href="">
                <img src="images/fb.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/twitter.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/insta.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
  </section>

  <footer class="container-fluid footer_section">
    <p>
      Badil System
    </p>
  </footer>

  <script src="js/jquery-3.4.1.min.js"></script>

</body>

</html>