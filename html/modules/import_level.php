<?php
$sql_import_level = "SELECT * FROM level";
$result = $conn->query($sql_import_level);
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        echo '
                <option value="' . $rows['level_id'] . '">&nbsp;' . $rows['level_name'] . '</option>
            ';
    }
}
