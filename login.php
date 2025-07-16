<div class="main2" id="log">
    <input type="checkbox" id="chk" aria-hidden="true">
    <div class="login">
        <form id="loginForm" dir="rtl">
            <label for="chk" aria-hidden="true">تسجيل الدخول</label>
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            <input type="password" name="pwd" placeholder="كلمة المرور" required>
            <button onclick='sendLoginRequest()' type="button">دخول</button>
            <!-- <a class="nav-link" id="gobackhome" href="main.php"> العودة الى الصفحة الرئيسية؟ </a> -->
            <a class="nav-link" id="registerAccount" href="">ليس لديك حساب؟ تسجيل حساب</a>
        </form>
    </div>
</div>

<script>
    function checkloginInfo(reponse) {


        if (reponse == true) {

            document.getElementById('messageText').innerHTML = "  تم تسجيل الدخول بنجاح <br><br> ...جاري الانتقال للصفحة الرئيسية  ";
            document.getElementById('okbtn').style.display = 'none';
            showMessage();
            setTimeout(() => {
                openHome();
            }, 1000);
        } else {
            document.getElementById('messageText').innerHTML = ".كلمة السر او اسم المستخدم غير صحيح";
            showMessage();
        }
    }

    function checkEmptyField(formData) {
        for (let pair of formData.entries()) {
            if (pair[1] === '') {
                return true;
            }
        }
        return false;
    }

    function sendLoginRequest() {
        var myRequest = new XMLHttpRequest();
        myRequest.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.response);
                checkloginInfo(this.response);
            }
        };

        var loginform = document.getElementById('loginForm');
        var formData = new FormData(loginform);

        if (checkEmptyField(formData)) {
            document.getElementById('messageText').innerHTML = "يرجى تعبئة الحقلين للتمكن من تسجيل الدخول";
            showMessage();
        } else {
            myRequest.open("POST", "login_DB.php");
            myRequest.send(formData);
        }


    }
</script>