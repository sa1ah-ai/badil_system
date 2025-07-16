<div class="main2">
    <input type="checkbox" id="chk" aria-hidden="true">
    <div class="caseInfo">
        <div class="form_title">
            <h5>: لرفع شكوى</h5>
            <p>: ادخل بيانات الجاني وصنف الجريمة ثم انتقل للصفحة التالية لكتابة تفاصيل الجريمة </p>
        </div>
        <div id="progress-bar"></div>
        <form id="question-form">

            <div class="question">
                <div class="qus_input">
                    <label for="offender">اسم الجاني :</label>
                    <input type="text" name="offender_name" id="offender_name" placeholder="اسم الجاني">
                    <span class="date_qus_input">
                        <label for="offender"> تاريخ الجناية : </label>
                        <input type="date" name="crime_date" id="crime_date">
                    </span>
                </div>

                <div class="qus_input">
                    <label for="offender">جنس الجاني :</label>
                    <input type="text" id="offender_gender" placeholder="جنس الجاني">
                    <span class="dropdown_2 dropdown">
                        <ul id="dropdownList_2" class="dropdown-list_2 dropdown-list">
                            <li class="dropdown-option_2 dropdown-option">ذكر</li>
                            <hr>
                            <li class="dropdown-option_2 dropdown-option">أنثى</li>
                        </ul>
                    </span>
                    <span class="date_qus_input">
                        <span id="warning"><i class="fa-solid fa-circle-exclamation"></i>اذا كنت ضحية بشكل مباشر اختر
                            نعم </span>

                        <label for="offender"> هل أنت ضحية؟</label>

                        <input type="text" id="victimOrNot" placeholder="نعم او لا">

                        <span class="dropdown_1 dropdown">
                            <ul id="dropdownList_1" class="dropdown-list_1 dropdown-list">
                                <li class="dropdown-option_1 dropdown-option">نعم</li>
                                <hr>
                                <li class="dropdown-option_1 dropdown-option">لا</li>
                            </ul>
                        </span>
                    </span>
                </div>

                <div class="qus_input">

                    <label for="offender"> صنف الجريمة : </label>
                    <input type="text" id="crime_cat" placeholder="صنف الجريمة">
                    <span class="dropdown_4 dropdown">
                        <ul id="dropdownList_4" class="dropdown-list_4 dropdown-list">
                            <li class="dropdown-option_4 dropdown-option" id="insult">الاهانة والقذف</li>
                            <hr>
                            <li class="dropdown-option_4 dropdown-option" id="properties">الممتلكات</li>
                            <hr>
                            <li class="dropdown-option_4 dropdown-option" id="environment">متعلقة بالبيئة</li>
                            <hr>
                            <li class="dropdown-option_4 dropdown-option" id="drugs">متعلقة بالمخدرات</li>
                            <li class="dropdown-option_4 dropdown-option" id="others">أخرى</li>
                            <hr>
                        </ul>
                    </span>

                    <span class="date_qus_input">
                        <label for="offender">نوع الجريمة :</label>
                        <input type="text" id="crime_type" placeholder="نوع الجريمة">
                        <span class="dropdown_3 dropdown">
                            <ul id="dropdownList_3" class="dropdown-list_3 dropdown-list">
                                <li class="dropdown-option_3 dropdown-option">سرقة</li>
                                <hr>
                                <li class="dropdown-option_3 dropdown-option">سطو</li>
                                <hr>
                                <li class="dropdown-option_3 dropdown-option">احتيال</li>
                                <hr>
                                <li class="dropdown-option_3 dropdown-option">تزوير</li>
                            </ul>

                            <ul id="dropdownList_5" class="dropdown-list_5 dropdown-list">
                                <li class="dropdown-option_5 dropdown-option">تلوث البيئة</li>
                                <hr>
                                <li class="dropdown-option_5 dropdown-option">صيد غير مشروع</li>
                                <hr>
                                <li class="dropdown-option_5 dropdown-option">تجارة غير مشروعة للمواد الحيوانية او
                                    النباتية المهددة بالانقراض </li>
                            </ul>

                            <ul id="dropdownList_6" class="dropdown-list_6 dropdown-list">
                                <li class="dropdown-option_6 dropdown-option">تجارة</li>
                                <li class="dropdown-option_6 dropdown-option">تعاطي</li>
                                <li class="dropdown-option_6 dropdown-option">تحريض</li>
                            </ul>

                            <ul id="dropdownList_7" class="dropdown-list_7 dropdown-list">
                                <li class="dropdown-option_7 dropdown-option">سب وشتم</li>
                                <li class="dropdown-option_7 dropdown-option">عنصرية</li>
                            </ul>
                        </span>
                    </span>
                </div>
                <div class="btns">
                    <button type="button" onclick="nextQuestion()">التالي</button>
                </div>
            </div>

            <div class="question hide">
                <h3>تفاصيل الجريمة :</h3>
                <div class="answers">
                    <input type="text" name="q1" id="crime_details" placeholder="اكتب هنا حيثيات الجريمة">
                </div>
                <div class="btns">
                    <button type="button" onclick="prevQuestion()">العودة</button>
                    <button onclick="checkAnswered()" type="button">تأكيد</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script src="js/ques.js">
</script>