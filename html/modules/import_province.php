<?php
$sql_import_province = "SELECT * FROM province";
$result = $conn->query($sql_import_province);
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        echo '
                <option value="' . $rows['province_id'] . '">&nbsp;' . $rows['province_name'] . '</option>
            ';
    }
}
