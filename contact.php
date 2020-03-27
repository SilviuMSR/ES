<?php 
session_start();
    // require 'vendor/autoload.php';
    // session_start();
    
    //     $provider = new Stevenmaguire\OAuth2\Client\Provider\Keycloak([
    //         'authServerUrl' => 'http://pixelatus.com:8080/auth',
    //         'realm' => 'es', 
    //         'clientId' => 'es-client', 
    //         'clientSecret' => '5a7b20be-f607-4307-b450-28092ddcbca2', 
    //         'redirectUri' => 'http://pixelatus.com/ES/contact.php']);
    
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
                
        
    //         } catch (Exception $e) {
    //             exit('Failed to get resource owner: '.$e->getMessage());
    //         }
        
    //         // Use this to interact with an API on the users behalf
        
    //         $ar = get_class_methods($provider);
        
    //     }
?> 

<style><?php include 'contact.css'; ?></style>
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
            </div>
</div>
    <div class="detailsContainer">
    <div class="imageContainer">
        <p class="title">Contact Us</p>
        <p class="subtitle">Feel free to contact us for more details!</p>
    </div>
    <div class="contentContainer">
        <div class="contactItem">
            <p>Coordination</p>
            <p>Assoc. Prof. Dr. Darian Onchis</p>
            <p>Lecturer Dr. Codruta Istin</p>
            <p>Signal, Image and Machine Learning Team
UVT and UPT Timisoara</p>
        </div>
        <div class="contactItem">
            <p>Phone Number</p>
            <p>Silviu: 0726664727</p>
            <p>or</p>
            <p>Raul: 0788923442</p>
        </div>
        <div class="contactItem">
            <p>Email</p>
            <p>Silviu: manzursilviu@gmail.com</p>
            <p>or</p>
            <p>Raul: raul@gmail.com</p>
        </div>
        <div class="contactItem">
            <p>Developers</p>
            <p>Manzur Silviu</p>
            <p>Cozloschi Florin</p>
            <p>Giurgi Bogdan</p>
            <p>Sava Daniel</p>
        </div>
        <div class="contactItem">
            <p>Connect with us</p>
            <img src="./facebook.svg" alt="Fb" height="32" width="32">
            <img src="./google.svg" alt="Fb" height="32" width="32">
        </div>
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
    
