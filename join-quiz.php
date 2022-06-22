<?php include('templates/header.php'); ?>
<?php
// Initialize the session
session_start();
include('check-login.php');
$user_id =  $_SESSION["user_id"];

$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$quiz_id = $params['quizId'];
$quiz_name = $params['quizName'];
$quiz_category = $params['quizCategory'];
require_once "./config.php";

// check if user attempted before
$sql = "SELECT * FROM attempt WHERE question_set_id = $quiz_id AND user_attempt_id = $user_id;";
$result = mysqli_query($link, $sql);
$num_rows = mysqli_num_rows($result);
if ($num_rows > 0) {
    header("location: attempted-before.php?quizId=$quiz_id");
} else {
    // Retrieve quiz data into database
    $sql = "SELECT * FROM question WHERE question_set_id=$quiz_id;";
    $get_all_questions_query = mysqli_query($link, $sql);
    $all_questions = mysqli_fetch_all($get_all_questions_query, MYSQLI_ASSOC);
    mysqli_free_result($get_all_questions_query);


    $complete_questions = array();
    $choices = "";
    for ($i = 0; $i < count($all_questions); $i++) {
        $question_id = $all_questions[$i]["question_id"];
        $sql = "SELECT * FROM choice WHERE question_id=$question_id;";
        $get_all_choices_query = mysqli_query($link, $sql);
        $all_choices = mysqli_fetch_all($get_all_choices_query, MYSQLI_ASSOC);
        $complete_questions[$i] = array_merge($all_questions[$i], $all_choices);
        echo "</br>";
        echo "</br>";
        echo "</br>";
    }
    mysqli_close($link);
    $complete_questions = array_unique($complete_questions, SORT_REGULAR);
}

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
            <div class="join-quiz">
                <div class="quiz-title">
                    <div>
                        <div><?php echo $quiz_category; ?>
                        </div>
                        <div><?php echo $quiz_name; ?>
                        </div>
                    </div>
                </div>
                <form id="answer-form" action=<?php echo "quiz-result.php?quizCode=" . $quiz_id; ?> method="POST">
                    <?php foreach (range(0, count($complete_questions) - 1) as $i) { ?>
                    <div class="quiz-card">
                        <div><?php echo $i + 1 . ". " . $complete_questions[$i]["question_name"]; ?>
                        </div>
                        <div class="quiz-option">
                            <?php foreach (range(0, 3) as $j) { ?>
                            <div>
                                  <input required type="radio" id="html"
                                    name=<?php echo $quiz_id . "questionId=" . $complete_questions[$i]["question_id"]; ?>
                                    value=<?php echo $j + 1; ?>>
                                <label>
                                    <?php echo "&nbsp;&nbsp;" . $complete_questions[$i][$j]["choice_name"]; ?>
                                </label>
                            </div>

                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <input class="submit-answer" name="submit-answer" type="submit" value="Submit">
                </form>
            </div>
        </div>
        <?php include('templates/footer.php'); ?>