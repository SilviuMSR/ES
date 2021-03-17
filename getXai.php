
<style><?php include 'xai.css'; ?></style>
<?php
error_reporting(0);
        // Use this to interact with an API on the users behalf
// Check existence of id parameter before processing further
    // Include config file
    session_start();
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["descriptionName"]) {
        $compName = $_GET["descriptionName"];
        $sql = "SELECT * from xai where name like '$compName%'";
        $result = mysqli_query($link, $sql);
    }
    else {
        $sql = "SELECT id, name, user FROM xai";
        $result = $link->query($sql);
    }
        
        if ($result->num_rows > 0) {
            // output data of each row
            echo '<div class="contentContainer">
            <div style="flex: 1; display:flex; flex-direction:row;">
            <span style="flex: 1; font-size: 22px; font-weight:bold">XAI NAME</span> 
            </div>
            </div>';
            while($row = $result->fetch_assoc()) {
                echo '
                <div style="flex: 1; padding-left: 30px; display:flex; flex-direction:row;">
                <form method="GET">
                    <button 
                    class="descriptionButton"
style="'; if($row["id"] == $_GET['descriptionId']) echo 'color: #00135f; font-weight: bold;'; echo '"
                    name="descriptionId" value=' .$row["id"] .' >'
                     .$row["name"] . '
                </button>
                </form>';
                echo '<div style="display: flex; flex-direction:row; margin-left: auto">';
                if( $_SESSION && $_SESSION['username'] == 'ESADMIN') echo '<form style="margin-left: auto" action="deleteXai.php" method="POST"><button class="descriptionButton" style="font-weight:bold" name="deleteId" value='.$row["id"].'>X</button></form>';
                if($_SESSION && $_SESSION['username'] == 'ESADMIN' || $_SESSION['username'] == $row['user']) echo '<form style="margin-left: auto" action="editXai.php?populate=true" method="POST"><button class="descriptionButton" style="font-weight:bold" name="editId" value='.$row["id"].'>EDIT</button></form>';
                echo '</div></div>';
            }
        } else {
            echo' <div style="flex: 1; padding-left: 30px; display:flex; flex-direction:row;">
            <span>No results</span>
        </div>';
        }
?>
