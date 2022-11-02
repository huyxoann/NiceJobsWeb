<?php
$sql_import_corp_field = "SELECT * FROM corp_field";
$result = $conn->query($sql_import_corp_field);
if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
        echo '
                <option value="' . $rows['field_id'] . '">&nbsp;' . $rows['field_name'] . '</option>
            ';
    }
}
