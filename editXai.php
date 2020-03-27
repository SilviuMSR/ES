<?php
// Check existence of id parameter before processing further
    // Include config file
function alertEdit($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
    session_start();
    require "config.php";
    if ($_GET['populate'] == 'true' && $_POST['editId'] != '') {
        $sqlGetById = "Select * from xai where id=".$_POST['editId']."";
        $resultGetById = mysqli_query($link, $sqlGetById);
        $row = $resultGetById->fetch_assoc();
        $_SESSION['xaiToEdit'] = $row['id'];
    }
    else {
        if ($_POST['description'] != '' && $_POST['methods'] != '' && $_POST['dataset'] != '' && $_POST['rules'] != '' && $_POST['category'] != '' && $_POST['expireDate'] != '') {
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
            $sql = "update xai set name='$xaiName' ,description='$descr', methods='$meth', dataSets='$data',code='mysql_real_escape_string($code)', category='$category', expireDate='$expireDate', rules='$rules' where id=".$_SESSION['xaiToEdit']."";
            if ($link->query($sql) === TRUE) {
                header("Location: http://pixelatus.com/competition.php?edit=true");
            } else {
                alert("Eroare!");
                echo "Error: " . $sql . "<br>" . $link->error;
            }
          }
          else {
            header("Location: http://pixelatus.com/competition.php?edit=false");
          }
    }
    $link->close();
?>

<style><?php include 'xai.css'; ?></style>
<div class="container">
<div class=sidebarContainer>
    <div class="sidebarTitleContainer">
    <a href="home.php">
                <span class="sidebarTitleText">XAI ES</span>
                <p class="sidebarSubtitleText">Explain AI Expert</p>
                </a>
    </div>
    <div class="sidebarContentContainer">
                <div class="sidebarItem"><a href="home.php">HOME</a></div>
                <div class="sidebarItem"><a href="xai.php">XAI</a></div>
                <div class="sidebarItem"><a href="competition.php">COMPETITION</a></div>
                <div class="sidebarItem"><a href="contact.php">CONTACT</a></div>
    </div>
            <div class="sidebarCopyrightContainer">
            <?php //if ($username) echo '<span class="text sidebarItem"><a>Logout</a></span>'; else echo '<span class="text sidebarItem"><a href="login.php">Login</a></span>'; ?>
            <span class="text sidebarItem"><?php 
            if ($_SESSION['username']) {
                echo '<a href="logout.php">'; echo $_SESSION['username']; echo '</a>';
                } else {
                    echo '<a href="login.php">Login</a>';
                } ?>   </span>
            <span class="text sidebarItem"><a href="terms.php">Terms</a></span>
            </div>
</div>
    <div class="xaiContent">
        <p class="createXaiText">EDIT XAI</p>
        <div class="userDetails">
            <form action="editXai.php" method="post">
                <div style="flex:1; border-right: 1px solid rgba(0,0,0,0.1); padding: 0px 20px 0px 20px">
                <div>
                    <p>Name</p>
                    <input type="text" value="<?php echo $row['name']; ?>" name="xaiName" placeholder="Enter name" />
                </div>
                <div>
                    <p>Methods</p>
                    <input type="text" value="<?php echo $row['methods']; ?>"name="methods" placeholder="Enter methods" />
                </div>
                <div>
                    <p>Data set</p>
                    <input type="text" value="<?php echo $row['dataSets']; ?>" name="dataset" placeholder="Enter data set" />
                </div>
                <div>
                    <p>Category</p>

                    <select id="category" name="category">
                    <option <?php if ($row['category'] == 'inClass') echo 'selected'; ?> value="inClass">In class</option>
                    <option <?php if ($row['category'] == 'industrialXai') echo 'selected'; ?> value="industrialXai">Industrial Xai</option>
                    <option <?php if ($row['category'] == 'bioInformatics') echo 'selected'; ?> value="bioInformatics">Bioinformatics & medicine</option>
                    <option <?php if ($row['category'] == 'patternRecognition') echo 'selected'; ?>v alue="patternRecognition">Pattern recognition</option>
                    <option <?php if ($row['category'] == 'dataScience') echo 'selected'; ?> value="dataScience">Data science</option>
                    <option <?php if ($row['category'] == 'computerVision') { echo 'selected';} ?> value="computerVision">Computer vision</option>
                    </select>
                </div>
                <div>
                    <p>Expire date</p>
                    <input value=<?php echo $row["expireDate"]; ?> type="date" name="expireDate"/>
                </div>
            
                </div>     
                <div style="flex: 2; text-align:center; display: flex; flex-direction: column; border-right: 1px solid rgba(0,0,0,0.1); padding: 0px 20px 0px 20px">
                <div style="flex: 1;">
                    <p>Description</p>
                    <textarea rows="10" cols="70" name="description" placeholder="Enter description"><?php echo $row["description"]; ?> </textarea>
                </div>
                <div style="flex: 1;">
                <p>Code</p>
                <textarea rows="10" cols="70" name="code" placeholder="Enter code"><?php echo $row["code"]; ?></textarea>
                </div>
                </div>
                <div style="flex: 1; text-align:center; padding: 0px 0px 0px 20px">
                <p>Rules</p>
                <textarea rows="15" cols="75" name="rules" placeholder="Enter each rule with a dot at the end. This platform will automatically split the rules and count them."><?php echo $row["rules"]; ?></textarea>
                </div>
                <div class="submitButton">
                <label for="submitButton" class="csvLabel">Submit</label>
                    <input id="submitButton" class="csvInput" type="submit" />
                 </div>            
            </form>
        </div>
    </div>
</div>
    
