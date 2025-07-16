<?php
include "database.php";

session_start();


function getSearchResults($conn, $searchBy, $searchTerm)
{
	$stmt = $conn->prepare("SELECT cases.case_id, case_details.case_date, citizen.first_name, case_details.offender_name
                            FROM cases
                            JOIN citizen ON cases.case_creator = citizen.citizen_id
                            JOIN case_details ON cases.case_id = case_details.case_id
                            WHERE {$searchBy} LIKE CONCAT(?, '%')");
	$stmt->bind_param("s", $searchTerm);
	$stmt->execute();
	$res = $stmt->get_result();

	return $res;
}

if (isset($_POST["sby"])) {
	$searchBy = $_POST["sby"];
	$searchTerm = $_POST["s"];

	switch ($searchBy) {
		case "case_id":
			$res = getSearchResults($conn, "cases.case_id", $searchTerm);
			break;
		case "offender_name":
			$res = getSearchResults($conn, "case_details.offender_name", $searchTerm);
			break;
		case "case_date":
			$res = getSearchResults($conn, "case_details.case_date", $searchTerm);
			break;
		case "victimName":
			$res = getSearchResults($conn, "citizen.first_name", $searchTerm);
			break;
		default:
			$res = getSearchResults($conn, "1", ""); // Return all records if no search criteria is provided
			break;
	}

	if ($res->num_rows > 0) {
		while ($row = $res->fetch_assoc()) {
			echo "<tr>
                <th scope='row'>{$row["case_id"]}</th>
                <td>{$row["case_date"]}</td>
                <td>{$row["first_name"]}</td>
                <td>{$row["offender_name"]}</td>
                <td><button type='button' onclick='showDetails({$row["case_id"]})'>تفاصيل</button></td>
            </tr>";
		}
	} else {
		echo "<p id='notfound'>لم يتم العثور على سجلات مطابقة لبيانات البحث</p>";
	}
} else {
	echo "<p id='notfound'>قم باختيار طريقة البحث</p>";
}
