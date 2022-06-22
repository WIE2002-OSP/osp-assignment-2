<?php include('templates/header.php'); ?>
<?php session_start();
// Check if the user is logged in, if not then redirect him to login page
include('check-login.php');
$user_id =  $_SESSION["user_id"];
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$quiz_id = $params['quizId'];
?>

<body>
    <!-- Sidebar  -->
    <div class="wrapper">
        <?php include('templates/sidebar.php'); ?>


        <!-- Page Content  -->
        <div id="content">
            <!-- Navbar  -->
            <?php include('templates/navbar.php'); ?>

            <!-- Profile -->
            <div class="attempted-before">
                <h2>You've already attempted.</h2>
                <div>&nbsp;</div>
                <div>You can only attempt the quiz once.</div>
                <div>&nbsp;</div>
                <div style="margin-bottom:10px;">You can click the button below to review your answer.</div>
                <a href=<?php echo "review-result.php?userId=$user_id&quizId=$quiz_id"; ?> class="review-btn">Review
                    Question</a>
            </div>
        </div>
        <?php include('templates/footer.php'); ?>