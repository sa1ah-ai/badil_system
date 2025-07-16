<div class="main" id="reg">
    <input type="checkbox" id="chk" aria-hidden="true">
    <div class="login">
        <form id="signing" dir="rtl">
            <label for="chk" aria-hidden="true">تسجيل حساب</label>
            <input type="text" name="firstName" placeholder="الاسم الاول" required>
            <input type="text" name="lastName" placeholder="الاسم الثاني" required>
            <input type="number" name="idNumber" placeholder="رقم الهوية" required>
            <div class="dropdown">
                <input id="idNumberType" type="text" name="idNumberType" placeholder="نوع الهوية">
                <ul id="dropdownList" class="dropdown-list">
                    <li class="dropdown-option">جواز سفر</li>
                    <hr>
                    <li class="dropdown-option">بطاقة شخصية</li>
                </ul>
            </div>
            <input type="number" name="phoneNumber" placeholder="رقم الجوال" required>
            <input type="email" name="email" placeholder="الايميل" required>
            <input type="text" name="username" placeholder="اسم المستخدم" required>
            <input type="password" name="pwd" placeholder="كلمة المرور" required>
            <button onclick='sendSignRequest()' type="button">تسجيل</button>
            <!-- <a class="nav-link" id="gobackhome" href="main.php"> العودة الى الصفحة الرئيسية؟ </a> -->
            <a class="nav-link" id="login" href=""> لديك حساب؟ تسجيل الدخول</a>
        </form>
    </div>
</div>


<script>
    function checkSignInfo(response) {
        if (response)
            openHome();
        else
            console.log(response);
    }

    function checkEmptyField(formData) {
        for (let pair of formData.entries()) {
            if (pair[1] === '') {
                return true;
            }
        }
        return false;
    }

    function sendSignRequest() {
        var sRequest = new XMLHttpRequest();
        sRequest.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.response);
                checkSignInfo(this.response);
            }
        };
        var signForm = document.getElementById('signing');
        var formData = new FormData(signForm);

        if (checkEmptyField(formData)) {
            document.getElementById('messageText').innerHTML = "يرجى تعبئة جميع الحقول للتمكن من التسجيل";
            showMessage();
        } else {
            sRequest.open("POST", "sign_DB.php");
            sRequest.send(formData);
        }

    }
</script>