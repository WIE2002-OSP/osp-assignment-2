<?php include('templates/header.php');?>

<?php
// Initialize the session
session_start();
include('check-login.php');
$user_id =  $_SESSION["user_id"];
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$quiz_id = $params['quizCode'];

if (isset($_POST['submit-answer'])) {
    // check question by question
    // check if answer choice == correct choice, then set is_correct
    // at the end of the loop set score of attempt
    $is_correct_arr = array();
    require_once "./config.php";
    $score = 0;
    $question_length = 0;
    $question_id = "";
    foreach ($_POST as $key => $val) {
        if ($key == "submit-answer") {
            continue;
        }
        $question_length++;
        $question_id = substr($key, strpos($key, "=") + 1);
        $answer_choice = $val;
        $sql = "SELECT correct_choice_number FROM question WHERE question_id=$question_id;";
        $get_data_query = mysqli_query($link, $sql);
        $question = mysqli_fetch_assoc($get_data_query);
        $correct_choice = $question["correct_choice_number"];
        if ($correct_choice == $answer_choice) {
            $score++;
            array_push($is_correct_arr, 1);
        } else {
            array_push($is_correct_arr, 0);
        }
    }
    // create attempt
    $sql = "INSERT INTO attempt(user_attempt_id, question_set_id, score) VALUES($user_id, $quiz_id, $score);";
    $insert_attempt_query = mysqli_query($link, $sql);
    echo "You scored" . $score . " out of " . $question_length;
    // get attempt id
    $attempt_id = $link->insert_id;

    // post each answer data
    $index = 0;
    foreach ($_POST as $key => $val) {
        if ($key == "submit-answer") {
            continue;
        }
        $question_id = substr($key, strpos($key, "=") + 1);
        $answer_choice = $val;
        $sql = "INSERT INTO answer(question_id,attempt_id,answer_choice_number,user_id, is_correct) VALUES ($question_id, $attempt_id, $answer_choice, $user_id, $is_correct_arr[$index]);";
        $insert_answer_query = mysqli_query($link, $sql);
        $index++;
    }
    @mysqli_close($link);
}
$percentage = round(($score / $question_length) * 100);
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
                <h2>Your score is : <?php echo $percentage; ?>
                    %</h2>
                <div>&nbsp;</div>
                <div>You scored <?php echo $score . " out of " . $question_length . " questions"; ?>
                </div>
                <div>&nbsp;</div>
                <div style="margin-bottom:10px;">You can click the button below to review your answer.</div>
                <a href=<?php echo "review-result.php?quizId=$quiz_id"; ?> class="review-btn">Review
                    Question</a>
            </div>
        </div>
        <?php include('templates/footer.php'); ?>