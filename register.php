<?php 
error_reporting(0);
    // require 'vendor/autoload.php';
    // session_start();
    // if(isset($_GET) && !isset($_POST['xaiName'])){
       

    
    //     $provider = new Stevenmaguire\OAuth2\Client\Provider\Keycloak([
    //         'authServerUrl' => 'http://localhost:8080/auth',
    //         'realm' => 'es', 
    //         'clientId' => 'es-client', 
    //         'clientSecret' => '5a7b20be-f607-4307-b450-28092ddcbca2', 
    //         'redirectUri' => 'http://localhost/ES/xai.php']);
    
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

<style><?php include 'login.css'; ?></style>
<?php
session_start();
    require_once "config.php";
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])) {
        $email = $_POST["email"];
        $username = $_POST["username"];    
        $password = sha1($_POST["password"]);

        $sql = "Insert into users (username, email, password) values ('$username', '$email', '$password')";
        $user = mysqli_query($link, $sql);
   
            if ($user == TRUE) {
echo "<script type='text/javascript'>window.location.href = 'http://localhost/login.php?registered=true'; </script>";
        
            }
         else {
            alert("Fail to register");
        }
        $link->close();
    }
?>
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
                <?php if($_SESSION && $_SESSION['username']) echo '<div class="sidebarItem"><a href="xai.php">XAI</a></div>'; ?>
                <div class="sidebarItem"><a href="competition.php">COMPETITION</a></div>
                <div class="sidebarItem"><a href="contact.php">CONTACT</a></div>
    </div>
            <div class="sidebarCopyrightContainer">
            <?php //if ($username) echo '<span class="text sidebarItem"><a>Logout</a></span>'; else echo '<span class="text sidebarItem"><a href="login.php">Login</a></span>'; ?>
                <span class="text sidebarItem"><a href="terms.php">Terms</a></span>
            </div>
</div>
    <div class="loginContainer" style="height: 70%; display: flex; justify-content:center; align-items:center">
    <form action="register.php" method="post">
                <div style="flex:1; box-shadow: 1px 1px rgba(0,0,0,0.2); border: 1px solid rgba(0,0,0,0.1); padding: 20px 20px 20px 20px">
                <div>
                    <p>Username</p>
                    <input type="text" name="username" placeholder="Enter username" />
                </div>
                <div>
                    <p>Email</p>
                    <input type="text" name="email" placeholder="Enter email" />
                </div>
                <div>
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Enter password" />
                </div>
                <div class="submitButton">
                <label for="submitButton" class="csvLabel">Submit</label>
                    <input id="submitButton" class="csvInput" type="submit" />
                 </div>            
            </form>
    </div>

    </div>
