<?php
// Check existence of id parameter before processing further
    // Include config file
    require_once "config.php";

    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idToDelete = $_POST["deleteId"];

        $sql = "delete from xai where id='$idToDelete'";
        if ($link->query($sql) === TRUE) {
            header("Location: http://pixelatus.com/competition.php?deleted=true");
        } else {
            echo "Error: " . $sql . "<br>" . $link->error;
        }
        $link->close();
    }
?>