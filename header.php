<div class="hero_area">
  <header class="header_section">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand">
          <span>
            <img src="images/logo2.png" width="90px" height="75px" halt="logo">
          </span>
          <span>
            Badil System
          </span>
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ml-auto">

            <?php

            const about_us = '<li class="nav-item active"><a class="nav-link" href="contact.php">عنّا</a></li>';
            const login = '<li class="nav-item active"><a class="nav-link" href="index.php">تسجيل الدخول</a></li>';
            const citizen_cases = '<li class="nav-item active"><a class="nav-link"  href="cases.php">القضايا المرفوعة</a></li>';
            const authority_cases = '<li class="nav-item active"><a class="nav-link"  href="cases.php">المهام</a></li>';
            const home = '<li class="nav-item active"><a class="nav-link" HREF="main.php">الصفحة الرئيسية</a></li>';
            const logout = '<li class="logoutword" ><a class="loglink" href="logout.php">تسجيل الخروج</a></li>';
            const create_case = '<li class="nav-item active"><a class="nav-link" href="create_case.php">رفع شكوى</a></li>';
            const new_case = '<li class="nav-item active"><a class="nav-link"  href="cases.php?page=new">القضايا المستجدة</a></li>';
            const cases_search = '<li class="nav-item active"><a class="nav-link" href="cases.php">
                                  <i class="fa fa-search" aria-hidden="true"></i>البحث عن قضية</a></li>';


            if (isset($_SESSION['admin_id'])) {
              $judge_info = $_SESSION['judge_info'];
              $userName = $judge_info['judge_name'];
              $user_file = '<li class="nav-item active"><a class="nav-link" id="usernameOnHeader" href="user_file.php"> القاضي : <span class= "case_detalis_answer">' . $userName . '</span> </a></li>';
              echo about_us;
              echo cases_search;
              echo new_case;
              echo logout;
              echo $user_file;
            } elseif (isset($_SESSION['user_id'])) {
              $user_info = $_SESSION['user_info'];
              $userName = $user_info['first_name'];
              $user_file = '<li class="nav-item active"><a class="nav-link" id="usernameOnHeader" href="user_file.php">  المستخدم : <span class= "case_detalis_answer">' . $userName . '</span></a></li>';
              echo about_us;
              echo home;
              echo create_case;
              echo citizen_cases;
              echo logout;
              echo $user_file;
            } elseif (isset($_SESSION['authority_id'])) {
              $authority_info =   $_SESSION['authority_info'];
              $userName = $authority_info['authority_name'];
              $user_file = '<li class="nav-item active"><a class="nav-link" id="usernameOnHeader" href="user_file.php">  الجهة التنفيذية : <span class= "case_detalis_answer">' . $userName . '</span></a></li>';
              echo about_us;
              echo home;
              echo authority_cases;
              echo logout;
              echo $user_file;
            } else {
              echo about_us;
              echo home;
              echo login;
            }
            ?>
          </ul>
        </div>
      </nav>
    </div>
  </header>
</div>