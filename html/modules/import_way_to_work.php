<?php
$sql_import_wtw = "SELECT * FROM way_to_work";
$result = $conn->query($sql_import_wtw);
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        echo '
                <option value="' . $rows['way_to_work_id'] . '">&nbsp;' . $rows['way_to_work_name'] . '</option>
            ';
    }
}
