
    <?php
    session_start();
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
                if (isset($_GET['logged']) && $_GET['logged'] == true) {
                    alert ('Successfully logged!');
                }
    // require 'vendor/autoload.php';
    // session_start();
    
    //     $provider = new Stevenmaguire\OAuth2\Client\Provider\Keycloak([
    //         'authServerUrl' => 'http://pixelatus.com:8080/auth',
    //         'realm' => 'es', 
    //         'clientId' => 'es-client', 
    //         'clientSecret' => '5a7b20be-f607-4307-b450-28092ddcbca2', 
    //         'redirectUri' => 'http://pixelatus.com/ES/home.php']);
    
    //     if (!isset($_GET['code'])) {
    //         // If we don't have an authorization code then get one
    //         $authUrl = $provider->getAuthorizationUrl();
    //         $_SESSION['oauth2state'] = $provider->getState();
    //         header('Location: '.$authUrl);
    //         exit;
        
    //     // Check given state against previously stored one to mitigate CSRF attack
        
    // } else {
    //     if(isset($_GET['state'])){
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
    // }
?> 

<style><?php include 'home.css'; ?></style>
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
    <div class="homeContainer">
        <div class="homeTitle">
      
<p style="text-align: center">Welcome to XAIES,</p>
                <p>the expert platform for Explainable Artificial Intelligence solutions and systems. We use well-established models like the versions of
the LIME (Local Interpretable Model-Agnostic Explanations) algorithm, activations maps, deep Taylor decompositions, etc.  and new models based on computational topology and spline-type spaces interpretability.

XAIES is aiming to enable the next generation expert systems based on statistical learning models of today. The expert systems that can learn with data will be introduced as use-cases featured as XAI competitions.</p>
                <p><i>General artificial intelligence similar to the human mind
        is a longstanding dream of humanity.</i></p>
        </div>
    </div>
        <div class="contentContainer">
                <p>
                The first AI systems
        that were explainable and have been successfully implemented in practice were the Experts Systems.
        Think about MYCIN, deployed after a 6 years effort from the Stanford
        University researchers that was able to treat meningitis better than medical doctors.
        Nowadays, machine learning-based AI systems and especially deep learning
        are statistically developed algorithms with amazing accuracy and learning capabilities. But
        they lack the interpretability and the reasoning of an expert system. 
        Therefore, we consider that at the future core of modern XAI as explainable AI-systems
        it will be a significant place for the next generation machine-learning based expert systems.
                </p>
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
    
