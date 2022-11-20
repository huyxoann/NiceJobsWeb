<?php
$sql_import_experience = "SELECT * FROM experience";
$result = $conn->query($sql_import_experience);
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        echo '
            <option value="' . $rows['exp_id'] . '">&nbsp;' . $rows['exp_name'] . '</option>
        ';
    }
}
