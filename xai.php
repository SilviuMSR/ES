<?php 
session_start();
function alertxai($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
if (isset($_GET['added']) && $_GET['added'] == 'false') {
    alertxai ("Instead of code, you must complete all fields");
}
    // require 'vendor/autoload.php';
    // session_start();
    // if(isset($_GET) && !isset($_POST['xaiName'])){
       

    
    //     $provider = new Stevenmaguire\OAuth2\Client\Provider\Keycloak([
    //         'authServerUrl' => 'http://pixelatus.com:8080/auth',
    //         'realm' => 'es', 
    //         'clientId' => 'es-client', 
    //         'clientSecret' => '5a7b20be-f607-4307-b450-28092ddcbca2', 
    //         'redirectUri' => 'http://pixelatus.com/ES/xai.php']);
    
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
    // }
?> 

<style><?php include 'xai.css'; ?></style>
<?php include 'addXai.php';?>
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
                echo '<span>'; echo $_SESSION['username']; echo '</span>';
                } else {
                    echo '<a href="login.php">Login</a>';
                } ?>   </span>
                            <span class="text sidebarItem"><?php 
            if ($_SESSION['username']) {
                echo '<a href="logout.php">'; echo 'Logout'; echo '</a>';
                }?>   </span>
            <span class="text sidebarItem"><a href="terms.php">Terms</a></span>
            </div>
</div>
    <div class="xaiContent">
        <p class="createXaiText">CREATE NEW XAI</p>
        <div class="userDetails">
            <form action="addXai.php" type='mutipart/formdata' method="post">
                <div style="flex:1; border-right: 1px solid rgba(0,0,0,0.1); padding: 0px 20px 0px 20px">
                <div>
                    <p>Name</p>
                    <input type="text" name="xaiName" placeholder="Enter name" />
                </div>
                <div>
                    <p>Methods</p>
                    <input type="text" name="methods" placeholder="Enter methods" />
                </div>
                <div>
                    <p>Data set</p>
                    <input type="text" name="dataset" placeholder="Enter data set" />
                </div>
                <div>
                    <p>Category</p>

                    <select id="category" name="category">
                    <option value="inClass">In class</option>
                    <option value="industrialXai">Industrial Xai</option>
                    <option value="bioInformatics">Bioinformatics & medicine</option>
                    <option value="patternRecognition">Pattern recognition</option>
                    <option value="dataScience">Data science</option>
                    <option value="computerVision">Computer vision</option>
                    </select>
                </div>
                <div>
                    <p>Expire date</p>
                    <input type="date" name="expireDate"/>
                </div>
            
                </div>     
                <div style="flex: 2; text-align:center; display: flex; flex-direction: column; border-right: 1px solid rgba(0,0,0,0.1); padding: 0px 20px 0px 20px">
                <div style="flex: 1;">
                    <p>Description</p>
                    <textarea rows="10" cols="70" name="description" placeholder="Enter description"></textarea>
                </div>
                <div style="flex: 1;">
                <p>Code</p>
                <textarea rows="10" cols="70" name="code" placeholder="Enter code"></textarea>
                </div>
                </div>
                <div style="flex: 1; text-align:center; padding: 0px 0px 0px 20px">
                <p>Rules</p>
                <textarea rows="15" cols="75" name="rules" placeholder="Enter each rule with a dot at the end. This platform will automatically split the rules and count them."></textarea>
                </div>
                <div class="submitButton">
                <label for="submitButton" class="csvLabel">Submit</label>
                    <input id="submitButton" class="csvInput" type="submit" />
                 </div>            
            </form>
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
    
