<?php 
session_start();
?>
<style><?php include 'terms.css'; ?></style>
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
    <div class="rulesContent">
        <p style="font-size: 24; font-weight: bold;">TERMS</p>
        <ul>
    <li>You can view the XAI competitions and create new competitions in the XAIES platform. To create competitions or to submit your XAI results to an open competition you need to sign up for an account and select a username and a password</li>
    <li>You may not select as your username a name that you don't have the right to use, or another person's name with the intent to impersonate that person. You may not transfer your account to anyone else.</li>
        <li>We prohibit any kind of plagiarism in any form. We do not allow any kind of offensive competitions or other forms of intimidation. All intellectual property rights are to be respected by the platform. </li>
    <li> We do not tolerate any attempt to obtain the account or to violate other security information from the platform. </li>
    <li> You respect the General Data Protection Regulation (EU) 2016/679 (GDPR). </li>
    <li>You explicitly agree with these terms in order to use the XAIES platform.</li>
        </ul>
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
    
