<?php include('templates/header.php');

require_once "config.php";

session_start();
include('check-login.php');
$user_id =  $_SESSION["user_id"];
$pw_errors = ['old' => '', 'new' => '', 'confirm' => ''];
$errors = ['email' => ''];



if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

if (isset($_POST['change-account-setting'])) {
    if (!empty($_POST['email'])) {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] =  "Email must be a valid email address <br />";
        } else {
            $sql = "UPDATE user SET user_email='$email' WHERE user_id=$user_id";
            if (mysqli_query($link, $sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $link->error;
            }
        }
    }

    if (!empty($_POST['phone-number'])) {
        $phone = $_POST['phone-number'];
        $sql = "UPDATE user SET user_phone='$phone' WHERE user_id=$user_id";
        if (mysqli_query($link, $sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error;
        }
    }

    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
        $sql = "UPDATE user SET user_name='$username' WHERE user_id=$user_id";
        if (mysqli_query($link, $sql) === TRUE) {
            $_SESSION["user_name"] = $username;
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $link->error;
        }
    }
}

if (isset($_POST['update-pw'])) {
    if (empty($_POST['old-pw'])) {
        $pw_errors["old"] = '* Please enter your old password *<br />';
    }

    if (empty($_POST['new-pw'])) {
        $pw_errors["new"] = '* Please enter your new password *<br />';
    } else {
        if (strlen($_POST['new-pw']) < 8) {
            $pw_errors["new"] = '* Password must have at least 8 characters *<br />';
        }
    }

    if (empty($_POST['confirm-new-pw'])) {
        $pw_errors["confirm"] = '* Please confirm your password *<br />';
    } else {
        if ($_POST['new-pw'] != $_POST['confirm-new-pw']) {
            $pw_errors["confirm"] = '* Confirmed password is different *<br />';
        }
    }

    if (!array_filter($pw_errors)) {
        $old_pw = $_POST['old-pw'];
        $new_pw = $_POST['new-pw'];
        // make sql
        $sql = "SELECT * FROM user where user_id = $user_id";

        // get the query result
        $result = mysqli_query($link, $sql);

        // fetch result
        $user = mysqli_fetch_assoc($result);
        if ($user['user_password'] != $old_pw) {
            $pw_errors["old"] = '* Old password does not match *<br />';
        } else {
            $pw_errors["old"] = '';
            $sql = "UPDATE user SET user_password='$new_pw' WHERE user_id=$user_id";
            if (mysqli_query($link, $sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $link->error;
            }
        }
    }
}



?>

<!-- Sidebar  -->
<?php include('templates/sidebar.php'); ?>
<div class="wrapper">

    <!-- Page Content  -->
    <div id="content">
        <!-- Navbar  -->
        <?php include('templates/navbar.php'); ?>

        <!-- Settings -->
        <div class="setting">
            <div class="setting-title">
                Settings
            </div>

            <div class="setting-subtitle">
                <i class="fa-solid fa-circle-user"></i>
                <div>Account</div>
            </div>

            <form action="setting.php" method="POST">
                <label>Email</label>
                <input id="email" name="email" value="<?php echo "" ?>">
                <div class="red-text"><?php echo $errors['email']; ?></div>
                <label>Phone number</label>
                <input type="tel" id="phone-number" name="phone-number" value="<?php echo "" ?>" placeholder="0XX-XXX XXXX"
                            pattern="[0-9]{3}-[0-9]{3} [0-9]{4}">
                <label>Username</label>
                <input id="username" name="username" value="<?php echo "" ?>">
                <input class="setting-btn" name="change-account-setting" type="submit" value="Save changes">
                </input>
            </form>

            <!-- <div class="setting-subtitle">
                <i class="fa-solid fa-language"></i>
                <div>Language</div>
            </div> -->
            <!-- <label>Select preferred language</label>
            <div class="dropdown">
                <button type="button" class="btn  setting-language-btn dropdown-toggle" data-toggle="dropdown">
                    <img src="img/us-flag.svg" alt="">
                    <div>
                        English
                    </div>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">
                        <img src="img/us-flag.svg" alt="">
                        <div>English</div>
                    </a>
                    <a class="dropdown-item" href="#"> <img src="img/malaysia-flag.svg" alt="">
                        <div>Malay</div>
                    </a>
                </div>
            </div> -->
            <div class="setting-subtitle">
                <i class="fa-solid fa-lock"></i>
                <div>Password</div>
                <i class="ae flag"></i>
            </div>

            <form action="setting.php" method="POST">
                <label>Old password</label>
                <input type="password" id="old-pw" name="old-pw" value="<?php echo "" ?>">
                <div class="red-text"><?php echo $pw_errors['old']; ?></div>
                <label>New password (minimum 8 characters) </label>
                <input type="password" id="new-pw" name="new-pw" value="<?php echo "" ?>">
                <div class="red-text"><?php echo $pw_errors['new']; ?></div>
                <label>Confirm new password</label>
                <input type="password" id="confirm-new-pw" name="confirm-new-pw" value="<?php echo "" ?>">
                <div class="red-text"><?php echo $pw_errors['confirm']; ?></div>
                <input class="setting-btn" name="update-pw" type="submit" value="Update password">
                </input>
            </form>
        </div>
    </div>
</div>
<?php include('templates/footer.php'); ?>