<?php
$sql_import_career = "SELECT * FROM career";
$result = $conn->query($sql_import_career);
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        echo '
            <option value="' . $rows['career_id'] . '">&nbsp;' . $rows['career_name'] . '</option>
        ';
    }
}
