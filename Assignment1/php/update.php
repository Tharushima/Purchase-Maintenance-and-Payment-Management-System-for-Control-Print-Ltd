<?php

if (isset($_GET['id'])) {
    include "db_conn.php";

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_GET['id']);



    $sql = "SELECT * FROM maintence WHERE id=$id";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: read.php");
    }
} elseif (isset($_POST['update'])) {
    include "../db_conn.php";


    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $mainid = validate($_POST['mainid']);
    $clientid = validate($_POST['clientid']);
    $lastmain = validate($_POST['lastmain']);
    $nextmain = validate($_POST['nextmain']);

    $id = validate($_POST['id']);


    if (empty($mainid)) {
        header('Location:../update.php?id=$id&error=Maintance ID is  required');
    } elseif (empty($clientid)) {
        header('Location:../update.php?id=$id&error=Client ID  is  required');
    } elseif (empty($lastmain)) {
        header('Location:../update.php?id=$id&error=Last maintance Day is  required');
    } elseif (empty($nextmain)) {
        header('Location:../update.php?id=$id&error=Next Maintance Day is  required');
    } else {

        $sql = " UPDATE  maintence
     SET mainid='$mainid',clientid='$clientid',lastmain='$lastmain',nextmain='$nextmain'
     WHERE id=$id";

        $result = mysqli_query($conn, $sql);
        if ($result) {

            header('Location:../read.php?success=successfully updated');
        } else {

            header('Location:../update.php?id=$id&error=unknown error occurred&$user_data');
        }
    }
} else {
    header("Location: read.php");
}
