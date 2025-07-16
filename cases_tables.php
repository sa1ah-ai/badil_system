<div class="container2">
    <div class="row">
        <div class="col-md-12">
            <div class="table-wrap">
                <table class="table table-bordered table-borderless table-hover" dir="rtl">
                    <thead>
                        <tr>
                            <th>رقم القضية</th>
                            <th>تاريخ الحصول</th>
                            <th>المجني عليه</th>
                            <!-- <th>صنف الجريمة</th> -->
                            <th>اسم الجاني</th>
                            <th>تفاصيل القضية</th>
                        </tr>
                    </thead>
                    <tbody id="box">
                        <?php
                        if (isset($_SESSION['user_id'])) {
                            $sql = "SELECT cases.case_id, case_details.case_date, citizen.first_name, case_details.offender_name,
                            case_details.crime_category
                            FROM cases
                            JOIN citizen ON cases.case_creator = citizen.citizen_id
                            JOIN case_details ON cases.case_id = case_details.case_id
                            where  citizen.citizen_id = '{$_SESSION['user_id']}'";
                        } else {
                            $sql = "SELECT cases.case_id, case_details.case_date, citizen.first_name, case_details.offender_name
                            FROM cases
                            JOIN citizen ON cases.case_creator = citizen.citizen_id
                            JOIN case_details ON cases.case_id = case_details.case_id";
                        }

                        $res = $conn->query($sql);
                        if ($res->num_rows > 0) {
                            while ($row = $res->fetch_assoc()) {
                                echo "<tr>
                                       <th scope='row'>{$row["case_id"]}</th>
                                       <td>{$row["case_date"]}</td>
                                       <td>{$row["first_name"]}</td>
                                       <td>{$row["offender_name"]}</td>
                                       <td><button type='button' onclick='showDetails({$row["case_id"]})'>تفاصيل</button></td>
                                       </tr>
                                   ";
                            }
                        } else {
                            echo "<p>لم يتم العثور على سجلات مطابقة لبيانات البحث</p>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>