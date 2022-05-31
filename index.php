<?php include('templates/header.php'); ?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Sidebar  -->
    <div class="wrapper">
        <?php include('templates/sidebar.php'); ?>
        <!-- Page Content  -->
        <div id="content">
            <!-- Navbar  -->
            <?php include('templates/navbar.php'); ?>
            <!-- Check for the user credential and allow to move into profile page-->
            <?php
                // Initialize the session
                session_start();
                // Check if the user is already logged in, if yes then redirect him to profile page
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                    header("location: profile.php"); //head to profile page
                    exit;
                }
                // Include config file
                require_once "config.php";
                // Define variables and initialize with empty values
                $user_email = "";
                $user_password = "";
                // Processing form data when form is submitted
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    // Validate credentials
                    if(!empty($_POST["user_password"]) && !empty($_POST["user_email"])){
                        // Declare the variables
                        $user_email  = $_POST["user_email"];
                        $user_password = $_POST["user_password"];

                        $sql = "SELECT user_id, user_email, user_password FROM user WHERE user_email = ?";  // Prepare a select statement
                        
                        if($stmt = mysqli_prepare($link, $sql)){
                            $param_useremail = $user_email;   // Set parameters
                            mysqli_stmt_bind_param($stmt, "s", $param_useremail); // Bind variables to the prepared statement as parameter
                            // Attempt to execute the prepared statement
                            if(mysqli_stmt_execute($stmt)){
                                mysqli_stmt_store_result($stmt); // Store result
                                // Check if useremail exists, if yes then verify password
                                if(mysqli_stmt_num_rows($stmt) == 1){                    
                                    // Bind result variables
                                    mysqli_stmt_bind_result($stmt, $user_id, $user_email, $user_password_db);
                                    if(mysqli_stmt_fetch($stmt)){
                                        if($user_password_db == $user_password){
                                            // Password is correct, so start a new session
                                            session_start();
                                            // Store data in session variables
                                            $_SESSION["loggedin"] = true;
                                            $_SESSION["user_id"] = $user_id;
                                            $_SESSION["user_email"] = $user_email;                            
                                            // Redirect user to home page
                                            header("location: home.php");
                                        } 
                                        else{
                                            // Password is not valid, display a generic error message
                                            echo "Invalid password.";
                                        }
                                    }
                                } 
                                else{
                                    // Useremail doesn't exist, display a generic error message
                                    echo "Invalid useremail";
                                }
                            } 
                            else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                            mysqli_stmt_close($stmt);   // Close statement
                        }
                    }
                    mysqli_close($link);    // Close connection
                }
            ?>
            <div class="login">
                <div class="login-title">
                    Login
                </div>
                <div class="login-subtitle">
                    <i class="fa fa-sign-in"></i>
                    <div>Login with registered email and password</div>
                </div>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <label>Email address: </label>
                        <input type="email" name="user_email" class="form-control" required>
                    </div>    
                    <div class="form-group">
                        <i class="fa-solid fa-lock"></i>
                        <label>Password: </label>
                        <input type="password" name="user_password" class="form-control" minlength="8" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="login-btn" value="Login">
                    </div>
                    <!-- lead to register if no account exist-->
                    <p>Don't have an account? <a href="register.php">Sign up now</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
<?php include('templates/footer.php'); ?>