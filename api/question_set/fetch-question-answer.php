<?php
require_once "../../config.php";
session_start();
$question_id = isset($_GET['questionId']) ? mysqli_real_escape_string($link, $_GET['questionId']) : "";

$answer_sql = "SELECT answer_choice_number FROM answer WHERE question_id=$question_id";
$get_data_query = mysqli_query($link, $answer_sql) or die(mysqli_error($link));
$result = array();
if (mysqli_num_rows($get_data_query) != 0) {
    $result = array();

    while ($r = mysqli_fetch_array($get_data_query)) {
        extract($r);
        $result[] = $answer_choice_number;
    }
    $json = array("data" => $result);
} else {
    $json = array("data" => $result);
}
@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);