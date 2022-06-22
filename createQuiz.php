<?php
// Initialize the session
session_start();
include('check-login.php');

require_once "config.php";

$errors = ['quizName' => ''];
$quiz_name = "";
$creator_id =  $_SESSION["user_id"];

if (isset($_POST['create-quiz'])) {
    if (empty($_POST['quiz-name'])) {
        $errors["quizName"] = '* A quiz name is required *<br />';
    } else {
        $quiz_name = $_POST['quiz-name'];
    }

    if (!array_filter($errors)) {
        // if form is invalid
        $quiz_name = mysqli_real_escape_string($link, $_POST['quiz-name']);
        $category = mysqli_real_escape_string($link, $_POST['category']);

        // create sql
        $sql = "INSERT INTO question_set(question_set_name,category,creator_id) VALUES('$quiz_name', '$category', '$creator_id')";

        // save to db and check
        if (mysqli_query($link, $sql)) {
            // success
            header('Location: quiz.php');
        } else {
            // error
            echo 'query error: ' . mysqli_error($link);
        };
    }
}


?>


<?php include('templates/header.php'); ?>


<!-- Sidebar  -->
<div class="wrapper">
    <?php include('templates/sidebar.php'); ?>


    <!-- Page Content  -->
    <div id="content">
        <!-- Navbar  -->
        <?php include('templates/navbar.php'); ?>
        <!-- create quiz -->
        <div class="create-quiz">
            <div class="create-quiz-title">
                Create a Quiz
            </div>
            <form action="createQuiz.php" method="POST">
                <div class="create-quiz-subtitle">
                    <i class="fa-solid fa-info-circle"></i>
                    <div>Quiz Information</div>
                </div>
                <label>Quiz Name</label>
                <input id="quiz-name" name="quiz-name" value="<?php echo $quiz_name ?>">
                <div class="red-text"><?php echo $errors['quizName']; ?></div>
                <input type="hidden" name="category" value="Mathematics" id="category-dropdown-input" />
                <label class="create-quiz-label">Select Quiz Category</label>
                <div class="dropdown">
                    <button type="button" class="btn create-quiz-category-btn dropdown-toggle" data-toggle="dropdown">
                        <div>
                            Mathematics
                        </div>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">
                            <div>Science</div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div>Geography</div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div>English</div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div>Malay</div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div>Physics</div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div>Biology</div>
                        </a>
                        <a class="dropdown-item" href="#">
                            <div>Japanese</div>
                        </a>
                    </div>
                </div>
                <input class="create-quiz-btn" name="create-quiz" type="submit" value="Create Quiz">
                </input>
            </form>
        </div>
    </div>
</div>


<?php include('templates/footer.php'); ?>