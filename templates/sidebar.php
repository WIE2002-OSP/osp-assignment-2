<!DOCTYPE html>
<html lang="en">
<sidebar id="sidebar">
    <div class="sidebar-header">
        <a href="home.php">
            DoQuiz.com
        </a>
    </div>
    <div>
        <a href="profile.php" class="sidebar-user">
            <img src="img/userImage.png" alt="Avatar">
            <div><?php echo $_SESSION["user_name"]; ?>
            </div>
        </a>
    </div>
    <ul class="list-unstyled components">
        <li class="sidebar-item">
            <a href="home.php">
                <i class="fa-solid fa-home"></i>
                Home
            </a>
        </li>
        <li class="sidebar-item">
            <a href="quiz.php">
                <i class="fa-solid fa-chart-line"></i>
                Quiz Created
            </a>
        </li>
        <li class="sidebar-item">
            <a href="profile.php">
                <i class="fa-solid fa-circle-user"></i>
                Profile
            </a>
        </li>
        <li class="sidebar-item">
            <a href="setting.php"><i class="fa-solid fa-gear"></i>
                Settings
            </a>
        </li>
    </ul>
    <?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) : ?>
    <button class="login-btn-sidebar" value=login onclick="window.location='index.php';">
        <i class="fa-solid fa-sign-in"></i>
        Login
    </button>

    <?php elseif ($_SESSION["loggedin"] === true) : ?>
    <button class="logout-btn" value=logout onclick="window.location='logout.php';">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        Logout
    </button>
    <?php endif; ?>


</sidebar>

</html>