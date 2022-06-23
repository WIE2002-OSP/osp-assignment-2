<?php include('templates/header.php'); ?>
<?php
session_start();
require_once "./config.php";
include('check-login.php');
$user_id =  $_SESSION["user_id"];
$url = $_SERVER['REQUEST_URI'];
$url_components = parse_url($url);
parse_str($url_components['query'], $params);
$quiz_id = $params['quizId'];

// obtain quiz data
$sql = "SELECT * FROM question_set WHERE question_set_id=$quiz_id;";
$get_quiz = mysqli_query($link, $sql);
$quiz = mysqli_fetch_assoc($get_quiz);
$quiz_name = $quiz["question_set_name"];

// get each question
$sql = "SELECT * FROM question WHERE question_set_id=$quiz_id;";
$get_all_questions_query = mysqli_query($link, $sql);
$all_questions = mysqli_fetch_all($get_all_questions_query, MYSQLI_ASSOC);
mysqli_free_result($get_all_questions_query);

$complete_questions = array();
$all_answers_arr = array();
for ($i = 0; $i < count($all_questions); $i++) {
    $question_id = $all_questions[$i]["question_id"];
    $answer_sql = "SELECT answer_choice_number, is_correct FROM answer WHERE question_id = $question_id AND user_id=$user_id";
    $get_all_answers_query = mysqli_query($link, $answer_sql);
    $single_answers = mysqli_fetch_assoc($get_all_answers_query);
    array_push($all_answers_arr, $single_answers);

    $sql = "SELECT * FROM choice WHERE question_id=$question_id;";
    $get_all_choices_query = mysqli_query($link, $sql);
    $all_choices = mysqli_fetch_all($get_all_choices_query, MYSQLI_ASSOC);
    $complete_questions[$i] = array_merge($all_questions[$i], $all_choices);
    echo "</br>";
    echo "</br>";
    echo "</br>";
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
                        <h4><?php echo "Answer Review"; ?>
                        </h4>
                        <div><?php echo $quiz_name; ?>
                        </div>
                    </div>
                </div>
                <form id="answer-form" action=<?php echo "quiz-result.php?quizCode=" . $quiz_id; ?> method="POST">
                    <?php foreach (range(0, count($complete_questions) - 1) as $i) { ?>
                    <div class="quiz-card">
                        <div><?php echo $i + 1 . ". " . $complete_questions[$i]["question_name"]; ?>
                        </div>
                        <?php
                            $is_correct =  $all_answers_arr[$i]['is_correct'] ?? "Nothing";
                            $answer_chosen = $all_answers_arr[$i]['answer_choice_number'] ?? "This is newly added question!";
                            $correct_choice = ($complete_questions[$i]["correct_choice_number"]); ?>
                        <div class="quiz-option">
                            <?php foreach (range(0, 3) as $j) { ?>
                            <div>
                                  <input disabled type="radio" id="html">
                                <label>
                                    <?php echo "&nbsp;&nbsp;" . $complete_questions[$i][$j]["choice_name"]; ?>
                                </label>
                            </div>

                            <?php } ?>
                        </div>
                        <?php if ($is_correct == "Nothing") :; ?>
                        <div style="font-weight:bold; color:#FED600">
                            <?php echo "This a newly added question"; ?>
                            . The correct answer is <?php echo $correct_choice; ?>
                        </div>
                        <!-- <div style="font-weight:bold; color:#0FBB0A">You pick <?php echo $correct_choice; ?>. You answer
                            this question correctly!</div> -->
                        <?php elseif ($is_correct == false) : ?>
                        <div style="font-weight:bold; color:#F66C6E">You pick&nbsp;
                            <?php echo $answer_chosen; ?>
                            . The correct answer is <?php echo $correct_choice; ?>
                        </div>
                        <?php else : ?>
                        <div style="font-weight:bold; color:#0FBB0A">You pick <?php echo $correct_choice; ?>. You answer
                            this question correctly!</div>
                        <?php endif; ?>
                    </div>
                    <?php } ?>
                    <a href="home.php" style="text-align:center;" class="review-btn">Back to Homepage</a>
                </form>
            </div>
        </div>
        <?php include('templates/footer.php'); ?>