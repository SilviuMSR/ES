<?php
// Check existence of id parameter before processing further
    // Include config file
//     ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
    session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['addCSVCommpetition']) && !isset($_GET['agree'])) {
      if ($_POST['description'] != '' && $_POST['methods'] != '' && $_POST['dataset'] != '' && $_POST['rules'] != '' && $_POST['category'] != '' && $_POST['expireDate'] != '') {
        require "config.php";
        $descr = $_POST["description"];
        $meth = $_POST["methods"];
        $data = $_POST["dataset"];
        $tosearch = array("'");
        $replacedCode = str_replace($tosearch, "\"", $_POST["code"]);
        $code = serialize($replacedCode);
        $xaiName = $_POST["xaiName"];
        $rules = $_POST["rules"];
        $username = $_SESSION['username'];
    
        $category = $_POST["category"];
        $expireDate = $_POST["expireDate"];
        $sql = "insert into xai (name ,description, methods, dataSets, code, category, expireDate, user,rules) VALUES ('$xaiName' ,'$descr', '$meth', '$data', '$code', '$category', '$expireDate', '$username', '$rules')";
        if ($link->query($sql) === TRUE) {
            header("Location: http://pixelatus.com/competition.php?added=true");
        } else {
            alert("Eroare!");
            echo "Error: " . $sql . "<br>" . $link->error;
        }
        $link->close();
      }
      else {
        header("Location: http://pixelatus.com/xai.php?added=false");
      }
    }
    else {
        if(isset($_POST['addCSVCommpetition']) && $_FILES["file"]["name"] != '' && $isAccepted == 'accepted'){
  		
		$username = $_SESSION['username'];
                $target_dir = "./uploads/";
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
            
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    if($link->query("Insert into csv_files(csv_path, xai_id, username) values('".$target_file."', ".$_GET['descriptionId'].", '$username')") === TRUE){
                        alert("File uploaded");
                    }else{
                    }
                }else{
                    echo "Error uploading file";
                }

        }
        else if ($_FILES["file"]["name"] != '') {
            alert ("You must agree TERMS and RULES");
        }
    }
?>
