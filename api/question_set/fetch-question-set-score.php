<?php
require_once "../../config.php";
session_start();
$quiz_id = isset($_GET['quizId']) ? mysqli_real_escape_string($link, $_GET['quizId']) : "";

$sql = "SELECT score FROM attempt WHERE question_set_id=$quiz_id";
$get_data_query = mysqli_query($link, $sql) or die(mysqli_error($link));
$result = array();
if (mysqli_num_rows($get_data_query) != 0) {
    $result = array();

    while ($r = mysqli_fetch_array($get_data_query)) {
        extract($r);
        $result[] = $score;
    }
    $json = array("data" => $result);
} else {
    $json = array("data" => $result);
}
@mysqli_close($link);
// Set Content-type to JSON
header('Content-type: application/json');
echo json_encode($json);