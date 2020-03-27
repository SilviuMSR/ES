
    <?php 
    session_start();
    // require 'vendor/autoload.php';
    // session_start();
    
    //     $provider = new Stevenmaguire\OAuth2\Client\Provider\Keycloak([
    //         'authServerUrl' => 'http://pixelatus.com:8080/auth',
    //         'realm' => 'es', 
    //         'clientId' => 'es-client', 
    //         'clientSecret' => '5a7b20be-f607-4307-b450-28092ddcbca2', 
    //         'redirectUri' => isset($_GET['descriptionId']) ? 'http://pixelatus.com/ES/competition.php?descriptionId='.$_GET['descriptionId'] : 'http://pixelatus.com/ES/competition.php'        ]);
    
    //     if (!isset($_GET['code'])) {
    //         // If we don't have an authorization code then get one
    //         $authUrl = $provider->getAuthorizationUrl();
    //         $_SESSION['oauth2state'] = $provider->getState();
    //         header('Location: '.$authUrl);
    //         exit;
        
    //     // Check given state against previously stored one to mitigate CSRF attack
    //     } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    //         unset($_SESSION['oauth2state']);
    //         exit('Invalid state, make sure HTTP sessions are enabled.');
        
    //     } else {
    //         // Try to get an access token (using the authorization coe grant)
    //         try {
    //             $token = $provider->getAccessToken('authorization_code', [
    //                 'code' => $_GET['code']
    //             ]);
    //         } catch (Exception $e) {
    //             exit('Failed to get access token: '.$e->getMessage());
    //         }
        
    //         // Optional: Now you have a token you can look up a users profile data
    //         try {
    
        
    //             // We got an access token, let's now get the user's details
    //             $user = $provider->getResourceOwner($token);

    //             $username = $user->getName();
    //             $_SESSION['username'] = $username;
                
        
    //         } catch (Exception $e) {
    //             exit('Failed to get resource owner: '.$e->getMessage());
    //         }
        
    //         // Use this to interact with an API on the users behalf
        
    //         $ar = get_class_methods($provider);
        
    //     }
?> 
<style><?php include 'competition.css'; 
?></style>
<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once "config.php";
function alertComp($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
$isAccepted = 'notAccepted';

if ($_GET['descriptionId'] && $_SESSION['username']) {
$getRelation = "Select * from agreed where user_id = ".$_SESSION['userid']. " and comp_id = ".$_GET['descriptionId']."";
        $relation = mysqli_query($link, $getRelation);
            while ($rel = $relation->fetch_assoc()) {
    
                if ($rel['id']) {
                    $isAccepted = 'accepted';
                }
            }
        if ($_FILES["file"]["name"] != '' && $isAccepted == 'notAccepted') {
            $isAccepted = 'notAccepted';
        }
        else if ($_GET['agree'] == 'agree') {
            $relationAdded = mysqli_query($link, "insert into agreed (user_id, comp_id) VALUES (".$_SESSION['userid'].", ".$_GET['descriptionId'].")");
            $isAccepted = 'accepted';
        }
    }
    
    if (isset($_GET['deleted'])) {
        alertComp('Successfully deleted');
    }

    if (isset($_GET['added'])) {
        alertComp ('Successfully added');
    }

    if (isset($_GET['edit'])) {
        if ($_GET['edit'] == 'true') alertComp("Successfully edited");
        else alertComp("Failed to edit");
    }

?>
<?php include 'addXai.php'; ?>
<div class="codeContainer">
<div class=sidebarContainer>
    <div class="sidebarTitleContainer">
    <a href="home.php">
                <span class="sidebarTitleText">XAI ES</span>
                <p class="sidebarSubtitleText">Explain AI Expert</p>
                </a>
    </div>
    <div class="sidebarContentContainer">
    <div class="sidebarItem"><a href="home.php">HOME</a></div>
                <?php if($_SESSION['username']) echo '<div class="sidebarItem"><a href="xai.php">XAI</a></div>'; ?>
                <div class="sidebarItem"><a href="competition.php">COMPETITION</a></div>
                <div class="sidebarItem"><a href="contact.php">CONTACT</a></div>
    </div>
    <div class="sidebarCopyrightContainer">
    <?php //if ($username) echo '<span class="text sidebarItem"><a>Logout</a></span>'; else echo '<span class="text sidebarItem"><a href="login.php">Login</a></span>'; ?>    
                <span class="text sidebarItem"><?php 
            if ($_SESSION['username']) {
                echo '<span>'; echo $_SESSION['username']; echo '</span>';
                } else {
                    echo '<a href="login.php">Login</a>';
                } ?>   </span>
                            <span class="text sidebarItem"><?php 
            if ($_SESSION['username']) {
                echo '<a href="logout.php">'; echo 'Logout'; echo '</a>';
                }?>   </span>
    <span class="text sidebarItem"><a href="terms.php">Terms</a></span>
                <form method="GET" style="margin-bottom: 0px">
                    <input class="searchInputs" name="descriptionName" type="text" placeholder="Search...">
                </form>
            </div>
</div>
    <div class="titleContainer">
        <span>COMPETITIONS</span>
    </div>
    <div class="competitionContainer">
        <div style="width: 20%; padding-right: 20px; border-right: 1px solid rgba(0,0,0,0.1)">
        <?php include 'getXai.php'; ?>
        </div>
        <div style="width: 75%; padding-left: 20px;">
        <?php     
                
                if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["descriptionName"]) {
                    $compName = $_GET["descriptionName"];
                    $sql = "SELECT * from xai where name like '$compName%'";
                    $result = mysqli_query($link, $sql);
                }
                else {
                    $competitionID = $_GET["descriptionId"];
                    
                    $sql = "SELECT * from xai where id=$competitionID";
                    $result = mysqli_query($link, $sql);

                    $files = mysqli_query($link, "Select COUNT(*) as files_nr from csv_files where xai_id = ".$competitionID."");
                    $filesPath = mysqli_query($link, "Select csv_path, username, added_date from csv_files where xai_id = ".$competitionID."");
                    $files_response = $files->fetch_assoc();                    
                    
                }

                if (!$result) {
                    echo 'Choose competition for details!';
                  }
                else {
                    while($row = $result->fetch_assoc()) {
                        $countRules = 1;
                        $splitedRules = explode(".", $row["rules"]);
                        array_pop($splitedRules);
                        $categoryName = "";
                        switch ($row["category"]) {
                            case "computerVision":
                                $categoryName = 'Computer vision';
                            break;
                            case "inClass":
                                $categoryName = 'In class';
                            break;
                            case "bioInformatics":
                                $categoryName = 'Bioinformatics & medicine';
                            break;
                            case "patternRecognition":
                                $categoryName = 'Pattern recognition';
                            break;
                            case "dataScience":
                                $categoryName = 'Data science';
                            break;
                            case "industrialXai":
                                $categoryName = 'Industrial Xai';
                            break;
                        }
                        echo '
                        <p style="padding-top: 10px; font-size: 22px; font-weight:bold">DETAILS</p>
                        <div class="competitionDetails">
                            <form style="word-break: break-all;" action="competition.php?descriptionId='.$_GET['descriptionId']. '&agree=agree" method="post" enctype="multipart/form-data">
                            <input name="addCSVCommpetition" hidden />
                            <div class="competitionDetailsTitle">
                                <div style="padding-top: 18px">
                                <span class="title">Description:</span><span class="subtitle">' .$row["description"]. '</span>
                                </div>
                                <div style="padding-top: 18px">
                                <span class="title">Category:</span><span class="subtitle">' .$categoryName. '</span>
                                </div>
                                <div style="padding-top: 18px">
                                <span class="title">Methods:</span><span class="subtitle">' .$row["methods"]. '</span>
                                </div>
                                <div style="padding-top: 18px">
                                <span class="title">Data sets: </span><span class="subtitle">' .$row["dataSets"]. '</span>
                                </div>
                                <div style="padding-top: 18px">
                                <span class="title">Expire date: </span><span class="subtitle">' .$row["expireDate"]. '</span>
                                </div>
                                <div style="padding-top: 18px">
                                <span class="title">CSVs number: </span><span class="subtitle">' .$files_response['files_nr']. '</span>
                                </div>
                                <div style="padding-top: 18px">
                                <span class="title">Created by: </span><span class="subtitle">' .$row["user"]. '</span>';
                                if ($isAccepted == 'notAccepted' && $_SESSION['username']) echo '<div style="padding-top: 18px">
                                <input onChange="form.submit()" type="checkbox" id="agreeTerm" name="agreeTerm" value="Rules">
                                <label for="agreeTerm"> I agree with the TERMS and RULES</label><br>
                                </div>';
                                echo '<div>
                                
        
                                <div class="csvUpload">
                                <label for="csvUpload" class="csvLabel">Upload CSV or DOC</label>
                                <input id="csvUpload" class="csvInput" type="file" name="file" onchange="form.submit()">
                                ';
                                // if (!$isAgree) {
                                //     echo '
                                //     <div style="padding-top: 20px">
                                //     <input type="checkbox" id="agree" name="agree" value="agree" onchange="form.submit()">
                                //     <label for="agree"> I agree the rules</label><br>
                                //     </div>
                                //     ';
                                // }
                                
                            echo '</div>';

                            if (true) {echo '<div class="filesWrapper">
                                <p style="font-size: 18px; font-weight:bold">UPLOADED RESULTS FILES</p>
                                    <div><ul style="padding-left: 18px">';
                                    while($file = $filesPath->fetch_assoc()) {
                                        $splitFileName = explode("/", $file["csv_path"]);
                                        echo '<li>'. $splitFileName[count($splitFileName) - 1].' - '. $file['username'] . ' - '. $file["added_date"] . ''; if ($_SESSION['username'] && ($_SESSION['username'] == $row["user"] || $_SESSION['username'] == 'ESADMIN')) echo '<a href="http://pixelatus.com/uploads/'.$splitFileName[count($splitFileName) - 1].'" download>Descarca</a>'; echo '</li>';
                                    }
                                    echo '</ul>
                                    </div>
                                </div>';
                                }
                                echo '</div>
                                </div>
                             
                            </form>
                            </div>';
                            if ($_SESSION['username'] && ($_SESSION['username'] == $row["user"] || $_SESSION['username'] == 'ESADMIN')) echo '<div class="codeWrapper">
                            <p style="font-size: 18px; font-weight:bold">CODE SNIPPED</p>
                                <div class="code">
                                    <xmp> '.$row["code"] . '</xmp>
                                </div>
                            </div>';

                            echo '<div class="filesWrapper">
                            <p style="font-size: 18px; font-weight:bold">COMPETITION RULES</p>
                                <div><ul style="padding-left: 0px">';
                                foreach ($splitedRules as $value){ 
                                    echo '<li style="list-style-type: none">' . $countRules . '.' . $value . '</li>';
                                    $countRules = $countRules + 1;
                                  } 
                                echo '</ul></div>';
                                echo '
                            </div>
                        </div>';
                    break;
                    }
                }
            
        ?>
        <!-- <div style="width: 60%; padding: 30px">
        details
        </div> -->
        </div>
    </div>
    <div class="footer">
    <?php 
            require_once "config.php";

            $query = "SELECT * FROM users"; 
      
            // Execute the query and store the result set 
            $result = mysqli_query($link, $query); 
            
            if ($result) 
            { 
                // it return number of rows in the table. 
                $row = mysqli_num_rows($result); 
                ob_start();
                require("getvisitors.php");
                $visitors = ob_get_clean();
                echo '<p class=communityText>COMMUNITY: '.$visitors.' visitors, '. $row .' registered users</p>';
            
                // close the result. 
                mysqli_free_result($result); 
            } 

            $link->close();
        ?>
        <p class=copyRightText>@ SIMT: Signal, Image and Machine Learning Team, UVT and UPT Timisoara</p>
    </div>
</div>  
