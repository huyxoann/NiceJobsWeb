<?php
$sql_import_salary = "SELECT * FROM salary";
$result = $conn->query($sql_import_salary);
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        echo '
                <option value="' . $rows['salary_id'] . '">&nbsp;' . $rows['salary_name'] . '</option>
            ';
    }
}
