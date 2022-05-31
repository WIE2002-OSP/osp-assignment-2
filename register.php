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
            <!-- Storing data to MySQL -->
            <?php
                // Include config file
                require_once "config.php";
                // Define variables and initialize with empty values
                $user_name = "";
                $user_email = "";
                $suer_phone = "";
                $user_password = "";
                $user_birthday = "";
                $user_interest = "";
                // Processing form data when form is submitted
                if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
                    // Capture errors related to user email
                    $sql = "SELECT user_id FROM user WHERE user_email = ?";     
                    if($stmt = mysqli_prepare($link, $sql)){
                        $param_useremail = $_POST["user_email"];         
                        mysqli_stmt_bind_param($stmt, "s", $param_useremail);         
                        if(mysqli_stmt_execute($stmt)){         
                            mysqli_stmt_store_result($stmt);         
                            if(mysqli_stmt_num_rows($stmt) == 1){   // Catch for duplicate user_email
                                echo "This email is already taken, please try another email.";
                            } 
                            else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        mysqli_stmt_close($stmt); // Close statement
                        }
                    }
                    // Details to be stored
                    $user_name = $POST_['user_name'];
                    $user_email = $POST_['user_email'];
                    $user_phone = $POST_['user_phone'];
                    $user_password = $POST_['user_password'];
                    $user_birthday = $POST_['user_birthday'];
                    // For user interest
                    $checkbox_interest = $_POST['user_interest'];  
                    $user_interest = "";  
                    foreach($checkbox_interest  as $interest)  
                    {  
                        $user_interest .= $interest.", ";  
                    }  
                    // Store the details into MySQL
                    $sql = "INSERT INTO 'user' ('user_name', 'user_email', 'user_password', 'user_birthday', 'user_interest') VALUES ('$user_name', '$user_email', 
                            '$user_password', '$user_birthday', '$user_interest')";
                    $query = mysqli.query($link, $sql);
                    if($query==1) {  
                        echo '<script>alert("Inserted Successfully")</script>';  
                    }  
                    else {  
                        echo '<script>alert("Failed To Insert")</script>';  
                    }  
                }
            ?>
            <div class="register">
                <div class="register-title">
                    Register
                </div>
                <div class="register-subtitle">
                    <i class="fa-solid fa-circle-user"></i>
                    <div>Demographic</div>
                </div>
                <form action="registration.php" method="post">
                    <div class="form-group">
                        <i class="fas fa-user-tie"></i>
                        <label>Username: </label>
                        <input type="text" name="user_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <label>Email address: </label>
                        <input type="email" name="user_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <i class="fa fa-phone"></i>
                        <label>Telephone number: </label>
                        <input type="tel" class="form-control" name="user_phone" placeholder="0XX-XXX XXXX" pattern="[0-9]{3}-[0-9]{3} [0-9]{4}" required>
                    </div>  
                    <div class="form-group">
                        <i class="fa fa-birthday-cake"></i>
                        <label>Birthday: </label>
                        <input type="date" name="user_birthday" class="form-control" required>
                    </div>

                    <div class="register-subtitle">
                        <i class="fas fa-shield-alt"></i>
                        <div>Security</div>
                    </div>  
                    <div class="form-group">
                        <i class="fa-solid fa-lock"></i>
                        <label>Password (minimum 8 characters): </label> 
                        <input type="password" name="user_password" class="form-control" minlength="8" required>
                    </div>
                    
                    <div class="register-subtitle">
                        <i class="fa fa-thumbs-up"></i>
                        <div>Recommendation</div>
                    </div>  
                    <div class="form-group">
                        <i class="fa fa-check-square"></i>
                        <label>Field of interest: </label>
                        <br></br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Art"> Art<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Business"> Business<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Computer Science"> Computer Science<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Culture and Traditions"> Culture and Traditions<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="English Language Art"> English Language Art<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Finance"> Finance<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="General Knowledge"> General Knowledge<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Geography"> Geography<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="History"> History<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Languages"> Languages<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Law"> Law<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Math"> Math<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Music"> Music<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Science"> Science<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Social Emotional Learning"> Social Emotional Learning<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Social Studies"> Social Studies<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Trivia"> Trivia<br>
                        <input type="checkbox" class='user-interest' name="user_interest[]" value="Other"> Other<br>
                    </div>

                    <script>
                    function checkFormData() {
                        if (!$('input[name=user_interest]:checked').length > 0) {
                            document.getElementById("errMessage").innerHTML = "User interest can not be null";
                            return false;
                        }
                        alert("Success");
                        return true;
                    }
                    </script>
                    <div class="form-group">
                        <input class="register-btn" type="submit" value="Submit">
                    </div>

                    <!-- Lead to login page if already have account -->
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </form>
            </div>    
        </div>
    </div>
</body>
<?php include('templates/footer.php'); ?>
