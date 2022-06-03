<?php include('templates/header.php');

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>

<body>

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

                <form action="setting.php">
                    <label>Email</label>
                    <input id="email" name="email" value="<?php echo "" ?>">
                    <label>Phone number</label>
                    <input id="phone-number" name="phone-number" value="<?php echo "" ?>">
                    <label>Username</label>
                    <input id="username" name="username" value="<?php echo "" ?>">
                    <input class="setting-btn" name="change-account-setting" type="submit" value="Save changes">
                    </input>
                </form>

                <div class="setting-subtitle">
                    <i class="fa-solid fa-language"></i>
                    <div>Language</div>
                </div>
                <label>Select preferred language</label>
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
                </div>
                <div class="setting-subtitle">
                    <i class="fa-solid fa-lock"></i>
                    <div>Password</div>
                    <i class="ae flag"></i>
                </div>

                <form action="setting.php">
                    <label>Old password</label>
                    <input id="old-pw" name="old-pw" value="<?php echo "" ?>">
                    <label>New password</label>
                    <input id="new-pw" name="new-pw" value="<?php echo "" ?>">
                    <label>Confirm new password</label>
                    <input id="confirm-new-pw" name="confirm-new-pw" value="<?php echo "" ?>">
                    <input class="setting-btn" name="change-account-setting" type="submit" value="Update password">
                    </input>
                </form>
            </div>
        </div>
    </div>
    <?php include('templates/footer.php'); ?>