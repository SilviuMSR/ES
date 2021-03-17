<?php
error_reporting(0);
session_start();
    require_once "config.php";
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    
    if ($_GET['registered']) {
        alert ('Account created successfully!');
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST["email"];
    
        $password = sha1($_POST["password"]);

        $sql = "Select * from users where email='$email' and password='$password'";
        $user = mysqli_query($link, $sql);
 
            $current_user = $user->fetch_assoc();    
            if ($current_user['username']) {
                $_SESSION['username'] = $current_user['username'];
                $_SESSION['userid'] = $current_user['id'];
		echo "<script type='text/javascript'>window.location.href = 'http://localhost/home.php?logged=true'; </script>";
            }
         else {
            alert("Fail to login");
        }
        $link->close();
    }
?>
<style><?php include 'login.css'; ?></style>
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
    <form action="login.php" method="post">
                <div style="flex:1; box-shadow: 1px 1px rgba(0,0,0,0.2); border: 1px solid rgba(0,0,0,0.1); padding: 20px 20px 20px 20px">
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
            <div>
        <span>You don't have an account? <a href="register.php">Register<a></span>
</div>
    </div>

    </div>
