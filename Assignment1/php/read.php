<?php
include "db_conn.php";

$sql = "SELECT * FROM maintence ORDER BY id ASC";

$result = mysqli_query($conn, $sql);