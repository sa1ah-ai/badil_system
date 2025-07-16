<?php
include "database.php";
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
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/user_file.css" rel="stylesheet" />
</head>

<body>

    <?php include("header.php");
    $judge = false;
    $citezen = false;
    $special_info = array();
    $special_judge_info = array();
    if (isset($_SESSION['admin_id'])) {
        $judge = true;
    } else if (isset($_SESSION['user_id'])) {
        $citezen = true;
    }

    ?>


    <div class="container">
        <div class="landing">
            <div class="intro-text">
                <?php if ($judge) {
                    echo '<h3> <span class= "case_detalis_answer">' . $judge_info['judge_name'] . '</span> : الصفحة الشخصية للقاضي</h3>';
                    $stmt = $conn->prepare("SELECT no_checked_c,no_yes_c FROM judge WHERE judge_id = ?");
                    $stmt->bind_param("i", $_SESSION['admin_id']);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows > 0) {
                        $ro = $res->fetch_assoc();
                        $special_judge_info['no_checked_c']  = $ro["no_checked_c"];
                        $special_judge_info['no_yes_c'] = $ro["no_yes_c"];
                    }
                } else if ($citezen) {
                    echo '<h3> <span class= "case_detalis_answer">' . $user_info['first_name'] . '</span> : الصفحة الشخصية للمستخدم </h3>';
                    $stmt = $conn->prepare("SELECT no_upload_c,no_checked_c,no_agreed_c,no_no_c FROM citizen WHERE citizen_id = ?");
                    $stmt->bind_param("i", $_SESSION['user_id']);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows > 0) {
                        $ro = $res->fetch_assoc();
                        $special_info['no_upload_c'] = $ro["no_upload_c"];
                        $special_info['no_checked_c'] = $ro["no_checked_c"];
                        $special_info['no_agreed_c'] = $ro["no_agreed_c"];
                        $special_info['no_no_c'] = $ro["no_no_c"];
                    }
                } else {
                    echo '<h3>   الصفحة الشخصية لجهة التنفيذ : <span class= "case_detalis_answer">' . $authority_info['authority_name'] . '</span></h3>';
                    $stmt = $conn->prepare("SELECT no_upload_c,no_checked_c,no_agreed_c,no_no_c FROM citizen WHERE citizen_id = ?");
                    $stmt->bind_param("i", $_SESSION['user_id']);
                    $stmt->execute();
                    $res = $stmt->get_result();
                    if ($res->num_rows > 0) {
                        $ro = $res->fetch_assoc();
                        $special_info['no_upload_c'] = $ro["no_upload_c"];
                        $special_info['no_checked_c'] = $ro["no_checked_c"];
                        $special_info['no_agreed_c'] = $ro["no_agreed_c"];
                        $special_info['no_no_c'] = $ro["no_no_c"];
                    }
                }

                ?>

                <div class="INfo">

                    <div class="personalInfo">
                        <div class="DataTitle">
                            <h4>البيانات الشخصية</h4>
                        </div>

                        <?php
                        if ($judge) {
                            echo ' <div>
                            <label for="name">الاسم:</label>
                            <input type="text" name="" id="" value= ' . $judge_info['judge_name']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="judge_username">اسم المستخدم:</label>
                            <input type="text" name="" id="" value= ' . $judge_info['judge_username']  . ' readonly>
                        </div>';
                            echo '</div>
                            <div class="personalInfo">
                        <div class="DataTitle">
                            <h4>البيانات المتعلقة بالقضايا</h4>
                        </div>';
                            echo '<div>
                            <label for="judge_username">عدد القضايا التي تم النظر اليها:</label>
                            <input type="number" name="" id="" value= ' . $special_judge_info['no_checked_c']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="judge_username">عدد القضايا الموافقة عليها:</label>
                            <input type="number" name="" id="" value= ' . $special_judge_info['no_yes_c']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="judge_username">  الغير الموافقة عليها:</label>
                            <input type="number" name="" id="" value= ' . ($special_judge_info['no_checked_c'] - $special_judge_info['no_yes_c'])  . ' readonly>
                        </div></div>';
                        } else if ($citezen) {

                            echo ' <div>
                            <label for="firstName">الاسم الاول:</label>
                            <input type="text" name="" id="" value= ' . $user_info['first_name']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="lastName">الاسم الاخير:</label>
                            <input type="text" name="" id="" value= ' . $user_info['last_name']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="ID_Number">رقم الهوية:</label>
                            <input type="text" name="" id="" value= ' . $user_info['ID_Number']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="ID_Number_type">نوع الهوية:</label>
                            <input type="text" name="" id="" value= ' . $user_info['ID_Number_type']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="phone_number">رقم الجوال:</label>
                            <input type="text" name="" id="" value= ' . $user_info['phone_number']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="email">حساب الايميل:</label>
                            <input type="text" name="" id="" value= ' . $user_info['email']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="username"> اسم المستخدم:</label>
                            <input type="text" name="" id="" value= ' . $user_info['username']  . ' readonly>
                        </div>';
                            echo '</div>
                            <div class="personalInfo">
                        <div class="DataTitle">
                            <h4>البيانات المتعلقة بالقضايا</h4>
                        </div>';
                            echo '<div>
                            <label for="no_upload_c">عدد القضايا المرفوعة:</label>
                            <input type="number" name="" id="" value=' . $special_info['no_upload_c']  . ' readonly >
                        </div>';
                            echo '<div>
                            <label for="no_checked_c">عدد القضايا التي تم النظر اليها:</label>
                            <input type="number" name="" id="" value=' . $special_info['no_checked_c'] . ' readonly>
                        </div>';
                            echo '<div>
                            <label for="no_agreed_c">عدد القضايا الموافق عليها:</label>
                            <input type="number" name="" id="" value=' . $special_info['no_agreed_c']  . ' readonly>
                        </div>';
                            echo '<div>
                            <label for="no_no_c">عدد القضايا الملغية:</label>
                            <input type="number" name="" id="" value=' . $special_info['no_no_c']  . ' readonly>
                        </div></div>';
                        } else {
                            echo ' <div>
                            <label for="firstName">الاسم:</label>
                            <input type="text" name="" id="" value= ' . $authority_info['authority_name']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="lastName">المحافظة:</label>
                            <input type="text" name="" id="" value= ' . $authority_info['governorate']  . ' readonly>
                        </div>';
                            echo ' <div>
                            <label for="ID_Number">اسم المستخدم:</label>
                            <input type="text" name="" id="" value= ' . $authority_info['authority_username'] . ' readonly>
                        </div>';
                            echo '</div>
                            <div class="personalInfo">
                        <div class="DataTitle">
                            <h4>البيانات المتعلقة بالقضايا</h4>
                        </div>';

                            echo ' <div>
                            <label for="lastName">عدد المهام المنتظر تنفيذها:</label>
                            <input type="text" name="" id="" value= ' . $authority_info['no_waited_c']  . ' readonly>
                        </div>';

                            echo '<div>
                            <label for="no_agreed_c"> التي تم تنفيذها :</label>
                            <input type="number" name="" id="" value=' . $authority_info['no_excuted_c']  . ' readonly>
                        </div>';

                            echo '</div>';
                        }
                        ?>

                    </div>
                </div>
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