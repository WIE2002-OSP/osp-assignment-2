<?php
require_once "../../config.php";
$quizId = isset($_GET['quizId']) ? mysqli_real_escape_string($link, $_GET['quizId']) : "";
$sql = "SELECT * FROM question WHERE question_set_id=$quizId;";
$get_data_query = mysqli_query($link, $sql) or die(mysqli_error($link));

$result = array();
if (mysqli_num_rows($get_data_query) != 0) {

    while ($r = mysqli_fetch_array($get_data_query)) {
        extract($r);
        $result[] = array("question_id" => $question_id, "question_name" => $question_name, 'correct_choice_number' => $correct_choice_number);
    }
    $json = array("data" => $result);
} else {
    // $json = array("error" => "Question not found!");
    $json = array("data" => $result);
}
@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);